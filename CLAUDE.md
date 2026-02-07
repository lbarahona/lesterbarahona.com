# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Personal portfolio/blog for Lester Barahona — a WordPress site with a custom theme ("Lester Developer" v2.0.0) deployed to Kubernetes via Docker. The site uses an industrial, terminal-inspired aesthetic with Space Mono font and amber/cyan accent colors on a dark background.

## Build & Deploy

### Local Setup
```bash
composer install --no-dev
```

### Full Build (mirrors CI)
```bash
./ci-scripts/build-site.sh
```
This downloads WordPress 6.9, installs Composer dependencies, fetches the S3-Uploads plugin, and assembles everything into a `payload/` directory for Docker.

### Docker Build
```bash
docker build -t lbarahona/lbarahona-blog .
```

### Deployment
Deployed via GitHub Actions on push to `main`:
1. Runs `build-site.sh`
2. Builds and pushes Docker image to Docker Hub (`lbarahona/lbarahona-blog`)
3. Helm upgrade to Kubernetes cluster using values from `.kube/wp-production-values.yaml`

Branch pushes (non-main) trigger `build-plugins-theme.yaml` for build validation only.

There are no automated tests — validation is build success + manual QA.

## Architecture

### Key Directories
- **`themes/lester-developer/`** — Custom WordPress theme (the primary code you'll edit)
- **`mu-plugins/`** — Must-use plugins: AJAX contact form handler, S3/R2 uploads config, content cleanup
- **`plugins/`** — Managed by Composer via wpackagist; do not edit directly
- **`ci-scripts/`** — Build and deployment scripts
- **`.kube/`** — Helm values for Kubernetes production deployment
- **`.github/workflows/`** — CI/CD pipelines
- **`payload/`** — Generated build output (gitignored)

### Infrastructure Stack
- **Runtime**: PHP 8.3 on `10up/wp-php-fpm` Docker image
- **Database**: MariaDB (external to cluster)
- **Cache**: Redis for WordPress object caching
- **CDN**: Cloudflare with APO (Automatic Platform Optimization)
- **Uploads**: Cloudflare R2 (S3-compatible) — no local file storage
- **Orchestration**: Kubernetes with Helm, nginx ingress, 2-4 replica autoscaling

### Contact Form Flow
The contact form uses a custom AJAX implementation (not WPForms) to bypass Cloudflare APO caching of POST requests:
- `themes/lester-developer/page-contact.php` → renders form with nonce
- `themes/lester-developer/assets/js/contact-form.js` → intercepts submit, sends to admin-ajax.php
- `mu-plugins/contact-form-ajax.php` → validates, sanitizes, sends via `wp_mail()`

### Theme Design Decisions
- No build tools — CSS is a single `style.css` file (no SCSS/PostCSS)
- No jQuery — vanilla JavaScript only
- No sidebars or widget areas — full-width layout throughout
- WordPress search is intentionally disabled in `functions.php`
- Hero section supports two modes via Customizer: "terminal" (YAML config display) or "image"
- Reading time calculated at 200 words/min in `functions.php`

## Plugin Management

Plugins are installed via Composer from wpackagist. To add/update a plugin:
```bash
composer require wpackagist-plugin/<plugin-name>:<version>
```
The `.gitignore` excludes plugin directories since they're resolved at build time. The `s3-uploads` plugin is an exception — it's downloaded directly in `build-site.sh` from GitHub releases.

## Secrets & Environment

These are injected at deploy time via GitHub Actions secrets and Helm values — never committed:
- Database credentials
- Redis password
- S3/R2 credentials (bucket, key, secret)
- KUBECONFIG for cluster access
- Docker registry credentials
