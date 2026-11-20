export const email = 'lester@lesterbarahona.com';

export const workedAt = 'Pinterest and Sandals Resorts';
export const clients =
  'Microsoft, Google, Meta, Starbucks, T-Mobile, TripAdvisor, Jefferies, InvestorPlace and the California DMV';

export const cargo = [
  {
    label: 'Kubernetes',
    title: 'Kubernetes platforms',
    body: 'EKS and AKS clusters, designed, upgraded and scaled with Terraform and Helm.',
    fill: '#16A3A8',
    text: '#06282C',
    x: 430,
    y: 450,
  },
  {
    label: 'Pipelines',
    title: 'Delivery pipelines',
    body: 'Argo CD, Flux and CI, so nothing ships by hand.',
    fill: '#F2B705',
    text: '#2A2000',
    x: 560,
    y: 450,
  },
  {
    label: 'Observability',
    title: 'Observability',
    body: 'SigNoz, Datadog and Prometheus, with alerts worth waking up for.',
    fill: '#FFFFFF',
    text: '#0B3C49',
    x: 690,
    y: 450,
  },
  {
    label: 'On-call',
    title: 'On-call',
    body: 'Twelve years of triage, root cause and retrospectives a client can read.',
    fill: '#7CC6D6',
    text: '#06282C',
    x: 495,
    y: 380,
  },
  {
    label: 'AI agents',
    title: 'AI agents for SRE',
    body: 'Agents I built take first response on the pager. They investigate read-only, log their evidence, and wait for my approval before anything changes.',
    fill: '#FF6B4A',
    text: '#2B0A02',
    x: 625,
    y: 380,
  },
];

export const agents = [
  ['An on-call agent', 'It groups related pages into one case and investigates read-only. It has three trust levels, and I raise them by typed confirmation.'],
  ['An evidence ledger', 'Every number in a report traces to a command run in that session.'],
  ['A guard on destructive commands', 'Deletes, drops and CDN writes stop and ask first. The guard has its own tests.'],
  ['Fleet health sweeps', 'One read-only agent per client environment, run side by side, one table back.'],
  ['A second opinion', "Other vendors' models review plans and root-cause write-ups before anything runs."],
];

export const ports = [
  ['2022 to today', 'Senior systems engineer, Fueled and 10up', 'Platforms and on-call for client sites.'],
  ['2020', 'Traffic engineer, Pinterest', 'Moved a fleet of 800 applications to an Envoy service mesh.'],
  ['2014 to 2021', 'SRE manager, San Services', 'Reliability for Sandals Resorts: containers, CI/CD and PCI compliance.'],
  ['2008 to 2013', 'Web applications developer, Sandals Resorts', 'High-availability booking sites and APIs.'],
  ['2003 to 2008', 'Graphic designer, Grupo Carrion', 'Ran the design and print department.'],
];

export const posts = [
  ['Migrating ingress-nginx to Envoy Gateway: 7 services, zero downtime, 6 gotchas', 'March 2026'],
  ['How I built a multi-agent AI development workflow', 'March 2026'],
  ['20 years in tech: from developer to SRE', 'January 2026'],
];
