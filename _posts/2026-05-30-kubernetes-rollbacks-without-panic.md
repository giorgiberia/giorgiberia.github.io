---
layout: post
title: "Kubernetes Rollbacks Without Panic"
date: 2026-05-30
categories: [devops, kubernetes]
tags: [kubernetes, deployments, rollbacks, ci-cd]
description: "A practical and friendly look at making Kubernetes deployment rollbacks safer with unique image tags and rollout history."
---

# Kubernetes Rollbacks Without Panic

Deployments are exciting when everything works. But when a new version breaks something, the most important question becomes simple:

> How fast and safely can we go back?

Recently I improved a Kubernetes deployment workflow to make rollbacks easier, clearer, and less stressful. The idea was not to build something complicated. The goal was to make the rollback path predictable before it is needed.

## The problem

A rollback is risky when the team is not sure what version is currently running or what version should be restored.

This usually happens when deployments reuse image tags like:

```text
my-api:latest
```

`latest` is convenient, but it is not great for recovery. It can change over time, and during an incident nobody wants to guess what image it pointed to yesterday.

So the first improvement was simple: every deployment should create a unique image tag.

## Unique image tags

Instead of reusing the same tag, the deployment script builds an image with a timestamp and Git SHA:

```text
registry.example.com/my-api:2026-05-31-1430-git-28aec39
```

This makes deployments easier to understand later.

You can quickly answer:

- which version is running;
- when it was deployed;
- which Git commit it came from;
- what Kubernetes can roll back to.

A simplified tagging example:

```bash
GIT_SHA="$(git rev-parse --short HEAD)"
BUILD_TIME="$(date +%Y-%m-%d-%H%M)"
IMAGE_TAG="${BUILD_TIME}-git-${GIT_SHA}"

IMAGE="registry.example.com/my-api:${IMAGE_TAG}"
```

The exact format is not the most important part. The important part is that the tag is unique and not overwritten.

## Deployment flow

The deployment scripts follow this general flow:

1. pull the latest code;
2. run quick checks if needed;
3. build a Docker image with a unique tag;
4. push the image;
5. apply the Kubernetes manifest;
6. wait for the rollout;
7. print the running image and rollout history.

The last step is very useful:

```bash
kubectl rollout status deployment/my-api

kubectl get deployment my-api   -o jsonpath="{.spec.template.spec.containers[*].image}"

kubectl rollout history deployment/my-api
```

After every deployment, the operator immediately sees what is running and what rollback history is available.

## Keeping rollback history

Kubernetes rollbacks depend on Deployment revision history. If old ReplicaSets are not kept, `kubectl rollout undo` will not have anything useful to restore.

A small but important manifest setting is:

```yaml
spec:
  revisionHistoryLimit: 2
```

For many services, keeping two revisions is enough for the common case: return to the previous working version.

For high-risk releases, it may be better to temporarily keep more history.

## Rollback script

The rollback script is intentionally simple. It does not hide what it is doing.

Before changing anything, it shows:

- the current image;
- the rollout history;
- a confirmation prompt.

Then it runs the rollback and waits for Kubernetes to finish.

Example:

```bash
#!/usr/bin/env bash
set -euo pipefail

DEPLOYMENT="${DEPLOYMENT:-my-api}"
NAMESPACE="${NAMESPACE:-default}"
REVISION="${1:-}"

echo "Current image:"
kubectl -n "$NAMESPACE" get deployment "$DEPLOYMENT"   -o jsonpath="{.spec.template.spec.containers[*].image}"
echo

echo "Rollout history:"
kubectl -n "$NAMESPACE" rollout history deployment/"$DEPLOYMENT"

echo
read -r -p "Continue with rollback? [y/N] " CONFIRM

if [ "$CONFIRM" != "y" ] && [ "$CONFIRM" != "Y" ]; then
  echo "Rollback cancelled."
  exit 0
fi

if [ -n "$REVISION" ]; then
  kubectl -n "$NAMESPACE" rollout undo deployment/"$DEPLOYMENT"     --to-revision="$REVISION"
else
  kubectl -n "$NAMESPACE" rollout undo deployment/"$DEPLOYMENT"
fi

kubectl -n "$NAMESPACE" rollout status deployment/"$DEPLOYMENT"

echo "Image after rollback:"
kubectl -n "$NAMESPACE" get deployment "$DEPLOYMENT"   -o jsonpath="{.spec.template.spec.containers[*].image}"
echo
```

For the normal case, rollback is just:

```bash
./rollback_my_api.sh
```

For a specific revision:

```bash
./rollback_my_api.sh 5
```

The script also supports namespaces:

```bash
NAMESPACE=production ./rollback_my_api.sh
```

## What to check before rolling back

Rollback should be fast, but not blind.

Before rolling back, it helps to capture the current state:

```bash
kubectl get pods
kubectl get deployment my-api
kubectl rollout history deployment/my-api
kubectl describe deployment my-api
```

This gives useful context for debugging and for writing a short incident note later.

## What rollback does not solve

A Kubernetes rollback usually restores the previous container image. It does not automatically roll back everything around it.

It will not fix:

- database migrations;
- incompatible schema changes;
- external service failures;
- runtime configuration problems;
- sensitive configuration changes;
- other services deployed separately.

This is why rollback planning should be part of release planning, especially when database changes are involved.

## Verifying after rollback

After rollback, do not stop at “rollout successful”. Kubernetes can say the Deployment is ready while the application still has a real problem.

Useful checks:

```bash
kubectl rollout status deployment/my-api
kubectl get pods -l app=my-api
kubectl logs deployment/my-api --tail=100
```

And if the service has a health endpoint:

```bash
curl -fsS https://example.com/health
```

The safest pattern is:

1. inspect;
2. confirm;
3. roll back;
4. verify Kubernetes;
5. verify the application.

## Security note

Deployment and rollback scripts should print useful operational information, not sensitive information.

It is helpful to print:

- deployment name;
- namespace;
- image tag;
- rollout status;
- rollout history.

It is not helpful to print secret values, tokens, passwords, connection strings, or full private configuration.

## Final takeaway

A good rollback process does not need to be complex.

For me, the biggest improvements were:

- unique image tags;
- visible rollout history;
- small rollback scripts;
- confirmation before rollback;
- support for specific revisions;
- verification after rollback.

Rollback is not a sign that deployment failed as a practice. It is part of safe deployment design.

The best time to prepare your rollback process is before you urgently need it.
