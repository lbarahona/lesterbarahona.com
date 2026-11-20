---
title: "20 Years in Tech: From Developer to SRE"
date: 2026-01-29
categories: ["Career", "DevOps & SRE"]
description: "After 20 years in tech — 8 as a developer, 12 in SRE/DevOps — here are the lessons that shaped how I build and operate systems today."
---

I started writing code in 2006. Back then, “DevOps” wasn’t a thing, containers were something you shipped goods in, and deploying meant FTPing files to a server and hoping for the best.

Two decades later, I’ve spent 8 years building software and 12 years keeping it running. Here’s what I’ve learned along the way.

## The Developer Years (2006-2014)

### Lesson 1: Code is liability

Every line of code you write is a line of code you have to maintain. Early in my career, I loved writing code. I’d build elaborate solutions, clever abstractions, and “elegant” architectures.

Then I had to maintain them. At 2 AM. On a Saturday.

Now I celebrate every line of code I *don’t* write. The best solution is often the simplest one. The second-best is using someone else’s well-tested code.

### Lesson 2: Your deployment pipeline is your product

I was always the developer who cared about “how does this get to production?” While my colleagues focused on features, I obsessed over deployments. How fast? How reliable? How reversible?

This obsession led me to SRE. It turns out there’s a whole discipline built around caring about the boring parts of software that make or break your users’ experience.

### Lesson 3: The operations team isn’t the enemy

For too long, developers and operations lived in separate worlds. Devs wanted to ship fast. Ops wanted stability. We blamed each other when things went wrong.

The DevOps movement fixed this by putting us in the same room (or the same team). When you’re responsible for running what you build, you build differently.

## The SRE Years (2014-Present)

### Lesson 4: Everything fails. Plan for it.

Early in my SRE career, I treated failures as anomalies. Things to prevent at all costs. Now I know they’re inevitable.

The question isn’t “how do I prevent failure?” It’s “how do I make failure boring?” Automated failover. Circuit breakers. Graceful degradation. Design systems that fail in expected, recoverable ways.

### Lesson 5: Automation isn’t optional

Every manual task is:

- Time you’ll never get back
- A potential source of human error
- Something that doesn’t scale

If I do something twice, I automate it. If I do something three times, I build a platform so others can automate it. The best SRE work is the work that eliminates future SRE work.

### Lesson 6: Kubernetes is not the answer (but it might be)

I’ve seen teams adopt Kubernetes because it’s “what everyone uses”. Then drown in complexity. I’ve also seen Kubernetes transform chaotic deployments into elegant, self-healing systems.

The difference? Understanding *why* you need it before you adopt it. Technology choices should solve specific problems, not satisfy resume requirements.

### Lesson 7: Observability is everything

You can’t fix what you can’t see. I’ve spent more time building monitoring, logging, and tracing systems than almost anything else. It’s not glamorous work, but it’s the difference between “something’s broken” and “I know exactly what’s broken and why.”

Invest in observability early. You’ll thank yourself at 3 AM.

### Lesson 8: Incident response is a skill

Your first instinct in an incident is usually wrong. Panic leads to bad decisions. Tunnel vision leads to missed solutions.

Good incident response is calm, systematic, and collaborative. Write runbooks before you need them. Practice chaos engineering. Make your team comfortable with failure before it happens in production.

## What I’m Still Learning

### AI is changing everything (including SRE)

We’re at the beginning of a massive shift. AI coding assistants are already writing better boilerplate than I do. Soon, AI will be handling incident response, capacity planning, and infrastructure optimization.

This doesn’t scare me. It excites me. I’ll have more time for the creative, strategic work. The toil I’ve spent 12 years automating will get automated even further.

### The human side matters more than ever

As systems get more complex and AI handles more technical work, the ability to communicate, collaborate, and make good decisions under pressure becomes more valuable.

The best SREs I know are great communicators. They can explain complex systems to non-technical stakeholders. They stay calm in incidents. They build trust across teams.

## Advice for the Next 20 Years

If I could go back and tell 2006-me anything:

1.  **Learn to write, not just code.** Documentation, incident reports, postmortems, blog posts. Clear writing is a superpower.
2.  **Invest in fundamentals.** Linux, networking, and distributed systems. Tools change; principles don’t.
3.  **Build relationships.** The best opportunities came from people who trusted me, not job boards.
4.  **Stay curious.** The moment you think you know everything is the moment you start falling behind.
5.  **Take care of yourself.** On-call burnout is real. Set boundaries. Sleep matters more than uptime.

Here’s to the next 20 years. 🚀

------------------------------------------------------------------------

*What lessons have shaped your tech career? I’d love to hear from you. Reach out on [Twitter](https://twitter.com/lesterbarahona) or [LinkedIn](https://linkedin.com/in/lesterbarahona).*
