---
layout: post
title: "Kubernetes Pod Autoscaling with HPA Working Example"
date:   2023-03-18 10:58:41 +0400
categories: blog
---

# Kubernetes Pod Autoscaling with HPA Working Example

In this article, I will show how to scale pods in Kubernetes using Horizontal Pod Autoscaler (HPA).
I will consider that you have a deployment running in Kubernetes, and you want to scale it automatically based on CPU or RAM usage.

## 1 find a spec of  deployment

{% highlight yaml %}

    spec:
      containers:
        - name: mobile-api
          image: mobile-api:1
          ports:
            - containerPort: 8007
          volumeMounts:
            - name: pv-volume
              mountPath: /app/mobile/fileStorage
      resources:
        requests:
          cpu: 100m
          memory: 500Mi

{% endhighlight %}

For autoscaling, most important part is the resources section, 
where you can specify the minimum amount of CPU and RAM that your pod needs to run.

## 2 create HPA

{% highlight Shell %}

    kubectl autoscale deployment mobile-api --min=1 --max=3 --cpu-percent=5

{% endhighlight %}

here we are creating HPA for deployment mobile-api, telling that we want to scale it from 1 to 3 pods based on CPU usage.
HPA will check the CPU usage and if it is more than 5%, it will scale the deployment.

## 3 check HPA

{% highlight Shell %}

    kubectl get hpa
    
    NAME         REFERENCE               TARGETS   MINPODS   MAXPODS   REPLICAS   AGE
    mobile-api   Deployment/mobile-api   2%/5%     1         3         2          116m

{% endhighlight %}

by current CPU usage, HPA scaled the deployment to 2 pods.

![pod-count.png](/img/blog/pod-count.png)

we can also make stress test to see how HPA works.

## 4 stress test

{% highlight Shell %}

    kubectl run -i --tty load-generator --image=busybox /bin/sh

{% endhighlight %}

this will create a pod with busybox image, and we can use it to stress test our deployment.

{% highlight Shell %}

    while true; do wget -q -O- http://mobile-api:8007; done

{% endhighlight %}

this will make a request to our deployment every second, and we can see how HPA scales the deployment.

hpa decided to scale the deployment to 3 pods.
![new-pod-count](/img/blog/new-pod-count.png)

we can see HPA events in the events section of the dashboard.
![events-dash.png](/img/blog/events-dash.png)

whenever HPA saw that CPU usage is more than 5%, it scaled the deployment to 3 pods.
Scaled up replica set mobile-api-78775d59fc to 3 from 2

if we stop the stress test, HPA will scale down the deployment to less pods.
![scale-down.png](/img/blog/scale-down.png)

if you need delete HPA, you can use this command.
## 5 delete HPA

{% highlight Shell %}

    kubectl delete hpa mobile-api

{% endhighlight %}


