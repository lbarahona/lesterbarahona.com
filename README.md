# lesterbarahona.com

Personal site of Lester Barahona: a static [Astro](https://astro.build) site served by a Cloudflare Worker.

## Develop

```bash
npm install
npm run dev      # local dev server
npm run build    # static build into ./dist
```

## Structure

- `src/pages/`: pages. Blog posts are served at `/<slug>/`, their original WordPress addresses.
- `src/content/blog/`: posts as Markdown.
- `src/components/PortScene.astro`: the scroll-driven port scene on the homepage.
- `src/data/`: site copy and CV content. `/cv/` and `public/lester-barahona-cv.pdf` come from `src/data/cv.ts`; regenerate the PDF by printing `/cv/` after changing it.
- `worker/index.ts`: the Worker. It serves `./dist` and handles the contact form at `POST /api/contact`.
- `public/_redirects`: redirects from the old WordPress addresses.

## Deploy

GitHub Actions (`.github/workflows/deploy.yaml`):

- `main` deploys the production Worker `lesterbarahona-com` (lesterbarahona.com).
- Any other branch deploys the preview Worker `lesterbarahona-preview`, marked noindex.

Needs the repository secrets `CLOUDFLARE_API_TOKEN` and `CLOUDFLARE_ACCOUNT_ID`. The custom domains are attached to the production Worker in the Cloudflare dashboard.

Email for the domain uses Cloudflare Email Routing; the contact form sends through Cloudflare Email Service.
