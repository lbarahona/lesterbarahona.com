# One CLI to Rule Your Monitoring Stack: Argus v0.7.0

*Slug: one-cli-monitoring-stack-argus-v070*
*Category: DevOps, Open Source*
*Tags: argus, observability, cli, prometheus, grafana, loki, alertmanager, sre*
*Status: Draft*

---

When I built Argus, it started as a pretty specific tool: an AI-powered CLI for querying Signoz. Cool, useful, solved my own itch. But every SRE I know runs more than one observability tool. You've got Prometheus for metrics, Grafana for dashboards, Alertmanager for (you guessed it) alerts, and Loki for logs. That's four browser tabs minimum just to figure out why your service is melting down at 3 AM.

v0.7.0 changes the game. Argus now speaks to your entire observability stack from a single terminal.

## The Problem Nobody Talks About

Here's a workflow that every on-call engineer knows too well:

1. PagerDuty goes off
2. Open Alertmanager to see what fired
3. Jump to Grafana to check the dashboard
4. Switch to Prometheus to run a PromQL query
5. Open Loki to grep through logs
6. Somewhere around step 4, you've lost your train of thought because you're juggling browser tabs like a circus performer

The context switching is the real enemy. Not the incident itself, the six different UIs you need to navigate while your brain is trying to correlate data across all of them.

## What v0.7.0 Brings

Four new integrations, 28 new commands, zero new browser tabs.

### Alertmanager (`argus am`)

```bash
# What's firing right now?
argus am alerts

# Quick severity breakdown
argus am summary

# Silence a noisy alert while you investigate
argus am silence-create --matchers 'alertname=HighMemory,namespace=staging' --duration 2h --comment "investigating"

# Check AM health
argus am status
```

Six commands covering the full Alertmanager v2 API. View alerts, manage silences, get summaries. The `summary` command groups alerts by severity and name, so you can see "oh, 14 of these are the same staging alert" in one glance instead of scrolling through a wall of amber badges.

### Prometheus (`argus prom`)

```bash
# Run a PromQL query right from your terminal
argus prom query 'rate(http_requests_total{status=~"5.."}[5m])'

# What rules are configured?
argus prom rules

# Which scrape targets are up (or not)?
argus prom targets

# Alerts from Prometheus' own alerting engine
argus prom alerts

# Cluster health at a glance
argus prom summary
```

This is where it gets good. Run PromQL directly from your terminal and get formatted results. No more copy-pasting queries between a text editor and the Prometheus UI. The `targets` command shows scrape health at a glance, so you know immediately if a target dropped off instead of digging through the Targets page.

### Grafana (`argus grafana`)

```bash
# List all dashboards organized by folder
argus grafana dashboards

# Search for anything
argus grafana search "kubernetes"

# Get dashboard details including panels and variables
argus grafana dashboard abc123

# What datasources are configured?
argus grafana datasources

# Any alerts firing in Grafana Alerting?
argus grafana firing

# Full instance overview
argus grafana summary
```

Nine commands. Browse dashboards, search across your entire Grafana instance, check alert rules and firing alerts, inspect datasources. The `summary` command is especially useful, it gives you a single-screen overview of your Grafana instance: dashboard count, datasource count, folder structure, alert status.

### Loki (`argus loki`)

```bash
# Query logs with LogQL
argus loki query '{namespace="production"} |= "error"' --since 1h

# What label names exist?
argus loki labels

# What values does a label have?
argus loki label-values namespace

# Active log streams
argus loki series '{namespace="production"}'

# Ingestion stats
argus loki stats '{app="api-gateway"}' --since 24h

# Health check
argus loki status
```

Seven commands with full LogQL support. The client handles basic auth and multi-tenant headers (`X-Scope-OrgID`) out of the box, so it works with both vanilla Loki and Grafana Cloud. The `stats` command is a hidden gem, it shows ingestion volume for a label set so you can identify which services are flooding your log storage.

## The Full Picture

After v0.7.0, here's what Argus covers:

| Tool | Commands | What You Can Do |
|------|----------|-----------------|
| Signoz | 20+ | Logs, traces, metrics, services, dashboards, AI analysis |
| Alertmanager | 6 | Alerts, silences, status, summaries |
| Prometheus | 6 | PromQL queries, rules, targets, alerts |
| Grafana | 9 | Dashboards, search, datasources, alerts |
| Loki | 7 | LogQL queries, labels, series, stats |
| **Core** | 14+ | Incidents, runbooks, SLOs, reports, anomaly detection |

That's **62+ commands** across a unified CLI. One config file. One tool in your `$PATH`.

## Configuration

Adding a new integration is just a few lines in `~/.argus/config.yaml`:

```yaml
prometheus:
  url: http://prometheus.internal:9090

alertmanager:
  url: http://alertmanager.internal:9093

grafana:
  url: https://grafana.company.com
  api_key: glsa_xxxxxxxxxxxx

loki:
  url: http://loki.internal:3100
  basic_auth:
    username: admin
    password: secret
  tenant_id: my-org
```

Or run `argus config init` and it walks you through it interactively.

## Built for On-Call

The real value isn't any single command. It's the workflow. When an alert fires:

```bash
# 1. What's going on?
argus am alerts

# 2. Check the metrics
argus prom query 'rate(http_requests_total{status="500"}[5m])'

# 3. Pull the logs
argus loki query '{app="payments"} |= "error"' --since 30m

# 4. Silence while you fix it
argus am silence-create --matchers 'alertname=PaymentsErrors' --duration 1h

# 5. Let AI correlate everything
argus ask "why is the payments service returning 500s?"
```

Five commands. One terminal. No tab switching. And step 5 is the kicker, Argus' AI engine (Claude, GPT-4o, or Bedrock) can pull context from Signoz and give you a synthesized analysis. The kind of "here's what happened, here's what's likely causing it, here's what to check" output that saves you 20 minutes of manual correlation.

## By the Numbers

- **4 new integrations** in 5 nights of development
- **28 new commands** (from 34 to 62+)
- **222 new tests** across the four packages
- **~9,000 lines of code** added
- **90%+ test coverage** on all four new packages (91.3% to 95.1%)
- **Zero external dependencies** beyond the standard library for HTTP clients

Each integration follows the same pattern: typed HTTP client, structured API models, terminal rendering with color-coded output. Consistency matters when you're switching between `argus am alerts` and `argus grafana firing` at 3 AM.

## What's Next

Argus started as a Signoz CLI. Now it's a unified observability terminal. The roadmap from here:

- **Cross-tool correlation**: "Show me alerts that fired around the same time as this error spike in Loki"
- **MCP server expansion**: The existing 17-tool MCP server will grow to include Prometheus, Grafana, Loki, and Alertmanager tools for AI agent integration
- **Composite dashboards**: A unified `argus dashboard` that pulls data from all configured sources
- **Homebrew tap update**: `brew install lbarahona/tap/argus` gets you everything

## Try It

```bash
# Install
brew install lbarahona/tap/argus

# Or from source
go install github.com/lbarahona/argus/cmd/argus@latest

# Configure
argus config init

# Go
argus am summary
argus prom targets
argus grafana dashboards
argus loki query '{app="api"}' --since 1h
```

The repo is at [github.com/lbarahona/argus](https://github.com/lbarahona/argus). Stars welcome, PRs even more so.

If you're an SRE juggling five observability UIs during incidents, give Argus a shot. Your 3 AM self will thank you.

---

*Argus is free and open source under the MIT license. Built with Go, tested obsessively, and battle-tested in production.*
