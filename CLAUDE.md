# CLAUDE.md

Guidance for Claude Code when working in this repository.

## Project

Personal site of Lester Barahona. Static Astro site served by a Cloudflare Worker. See README.md for structure, commands and deploys.

## Rules

- The product brief and positioning live outside this public repo. Do not add working notes about unconfirmed facts here.
- Facts about Lester's career come from `src/data/site.ts` and `src/data/cv.ts`. Do not invent metrics, testimonials or client outcomes. Client names may appear; nothing specific about work done for a named client.
- The homepage scene must keep working with reduced motion and without JavaScript.
- After changing `src/data/cv.ts`, regenerate `public/lester-barahona-cv.pdf` from `/cv/`.
- `main` deploys to production. Work on a branch; every branch deploys to the preview Worker.
- Design work uses the Impeccable skill in `.claude/skills/impeccable`.
