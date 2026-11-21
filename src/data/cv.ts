// Source of truth for the CV page and the PDF generated from it.
export const summary =
  'Senior site reliability engineer with more than 20 years in tech. I design and run Kubernetes platforms on AWS and Azure, automate the path to production, and lead incident response. I also build AI agents that do SRE work (on-call triage, investigation, fleet health checks) and run them under rules strict enough for production.';

export const roles = [
  {
    company: 'Fueled and 10up',
    title: 'Senior Systems Engineer',
    dates: 'January 2022 to today',
    note: 'Joined 10up as Systems Engineer. 10up merged with Fueled in 2023.',
    points: [
      'Run infrastructure, security and on-call for client sites, including Microsoft, Google, Meta, Starbucks, T-Mobile, TripAdvisor, Jefferies, InvestorPlace and the California DMV.',
      'Designed and built Kubernetes clusters on EKS and AKS with Terraform, with GitOps delivery through Flux CD, Argo CD and GitHub Actions.',
      "Designed and built the company’s first internal developer platform, giving engineers self-service actions across development and staging environments.",
      'Built remote development environments on AWS for clients that do not allow their code on engineer laptops.',
      'Upgraded the Terraform, Ansible and Helm configuration behind the ElasticPress service, covering external-dns, cert-manager, Redis, cluster autoscaling, logging and ingress.',
    ],
  },
  {
    company: 'Pinterest',
    title: 'Traffic Engineer, Site Reliability Engineering',
    dates: 'March 2020 to November 2020',
    points: [
      'Migrated a fleet of 800 applications from AWS Elastic Load Balancers to an Envoy service mesh.',
      'Moved builds and deployments from scripts and manual steps to CI pipelines on Jenkins, Spinnaker and Buildkite.',
      'Improved service discovery using Envoy.',
    ],
  },
  {
    company: 'San Services (Sandals Resorts)',
    title: 'Site Reliability Engineering Manager',
    dates: 'January 2014 to December 2021',
    points: [
      'Led a distributed SRE team that introduced continuous integration and delivery across the company.',
      'Containerised applications with Docker, Docker Swarm and Kubernetes.',
      'Built a microservices platform on the Kong API gateway, with NGINX Plus load balancing.',
      'Automated build, test, packaging and deployment for ColdFusion, Lucee, Go, Java and Node.js applications.',
      'Owned PCI compliance requirements and production incident response across cloud and on-premise systems.',
    ],
  },
  {
    company: 'San Services (Sandals Resorts)',
    title: 'Web Applications Developer',
    dates: 'June 2008 to December 2013',
    points: [
      'Built and maintained high-availability booking websites, APIs and internal systems.',
      'Planned and carried out the move from a commercial CFML engine to an open-source one.',
      'Wrote the first build and deployment automation for the web applications.',
    ],
  },
];

export const agentWork = {
  intro:
    'Tools I built for my own SRE work and use every day. They are read-only by default, log their evidence, and wait for my approval before anything changes.',
  points: [
    'On-call responder: groups related pages into one case and investigates read-only. Three trust levels (shadow, agents, live), raised only by typed confirmation.',
    'Evidence ledger: every number or live-state claim in a report traces to a command run in that session.',
    'Destructive-command guard: deletes, drops and CDN writes stop and ask first. The guard has its own tests.',
    'Fleet health sweeps: one read-only agent per client environment, run side by side, one table back.',
    'Cross-model review: plans and root-cause write-ups are reviewed by models from other vendors before anything runs.',
    'Argus (past project): an open-source CLI in Go that queries SigNoz, Prometheus, Grafana, Alertmanager and Loki and uses AI to help investigate incidents from the terminal.',
  ],
};

export const earlier = [
  'Co-founder and software architect, Fluky Factory (2013 to 2022)',
  'Graphic designer and print department manager, Grupo Carrion (2003 to 2008)',
];

export const skills = [
  ['Orchestration', 'Kubernetes (EKS, AKS), Docker, Helm'],
  ['Infrastructure as code', 'Terraform, Ansible, Crossplane'],
  ['Delivery', 'Argo CD, Flux CD, GitHub Actions, GitLab CI, Jenkins'],
  ['Observability', 'SigNoz, Datadog, Prometheus'],
  ['Edge and data', 'Cloudflare, CloudFront, Envoy, NGINX, MySQL Galera, Redis'],
  ['Cloud', 'AWS, Azure, DigitalOcean'],
  ['Languages', 'Python, Go, Bash'],
  ['AI agents', 'Claude Code hooks, skills and subagents; multi-model review'],
];

export const education = [
  'AWS Certified Solutions Architect',
  'Computer Engineering, Universidad Cristiana de Honduras (UCRISH)',
  'Cloud DevOps Engineer Nanodegree, Udacity (2019)',
  'React Nanodegree, Udacity (2018)',
];
