---
layout: post
title: "I’m Shipping a Self-Hosted WebSocket Chat You Can Run on Any VPS"
date: 2025-10-14 09:00:00 +0400
categories: blog
---

**I finally have the lightweight, privacy-first chat stack I’ve wanted for my own projects. Here’s what’s shipping.**

### TL;DR
- A self-hosted WebSocket chat that snaps into Django or runs standalone on any VPS.
- Ships as static assets for Django templates and behaves behind Nginx or Caddy without hassle.

### What’s inside (today)
- Realtime messaging with typing indicators plus delivery and read receipts for truly live conversations.
- Direct messages, file uploads, and online presence so teammates can coordinate fast.
- Admin console with RBAC, audit trails, and export tooling for clean operations.
- Drop-in Django integration or standalone deployment on your VPS of choice.
- Static assets that plug into Django templates and stay reverse-proxy friendly.

### Where this fits
- Internal team chat when data must remain on your own servers.
- Customer portals where authenticated users can DM support and exchange files securely.
- Project workspaces for agencies or contractors coordinating deliverables in real time.

### Why I built it
SaaS chat is convenient until you need strict privacy, predictable costs, or deep control over authentication and data flow. I wanted something compact, understandable, and production-ready that I can theme and extend without wrestling a black box.

### Want to try it?
If you’d like a walkthrough or deployment notes for your VPS stack, reach out. I’m happy to help you go from zero to chatting fast.

#WebSocket #Realtime #SelfHosted #Django #VPS #RBAC #Security
