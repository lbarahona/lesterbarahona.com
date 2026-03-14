<?php
/**
 * Template Name: Services Page
 * Template for the content agency services page
 *
 * @package Lester_Developer
 */

get_header();
?>

<main id="primary" class="site-main">
    <article id="post-<?php the_ID(); ?>" <?php post_class('services-page'); ?>>

        <!-- Hero Section -->
        <section class="services-hero">
            <div class="container">
                <div class="services-hero__content" data-reveal>
                    <span class="services-hero__label">Technical Content Services</span>
                    <h1 class="services-hero__title">Technical content that developers<br>actually want to read.</h1>
                    <p class="services-hero__subtitle">
                        We write blog posts, tutorials, and documentation for DevTools companies.
                        Built by an SRE with 20 years in the trenches, powered by AI agents that actually know what they're talking about.
                    </p>
                    <div class="services-hero__actions">
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary btn--large">
                            Start a Project
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                        <a href="#packages" class="btn btn--outline btn--large">
                            View Pricing
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- What We Do -->
        <section class="services-what" data-reveal>
            <div class="container">
                <h2 class="section-title--center">What We Do</h2>
                <p class="services-section-subtitle">
                    Most technical content reads like it was written by someone who's never SSHed into a production server.
                    Ours doesn't.
                </p>
                <div class="services-grid services-grid--3">
                    <div class="service-card">
                        <div class="service-card__icon">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                        </div>
                        <h3>Blog Posts</h3>
                        <p>Product launches, opinion pieces, "how we built X" stories. The kind of content that gets shared in Slack channels and bookmarked on Hacker News.</p>
                    </div>
                    <div class="service-card">
                        <div class="service-card__icon">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <polyline points="16 18 22 12 16 6"></polyline>
                                <polyline points="8 6 2 12 8 18"></polyline>
                            </svg>
                        </div>
                        <h3>Tutorials &amp; Deep-Dives</h3>
                        <p>Step-by-step guides with working code, tested commands, and architecture diagrams. Because nobody trusts a tutorial that starts with "just run this."</p>
                    </div>
                    <div class="service-card">
                        <div class="service-card__icon">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <polyline points="10 9 9 9 8 9"></polyline>
                            </svg>
                        </div>
                        <h3>Documentation</h3>
                        <p>Full doc overhauls, API references, quickstart guides. We audit what you have, figure out what's missing, and rewrite the whole thing so developers actually use it.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- How It Works -->
        <section class="services-process" data-reveal>
            <div class="container">
                <h2 class="section-title--center">How It Works</h2>
                <p class="services-section-subtitle">Simple process, no BS. You tell us what you need, we deliver quality content.</p>
                <div class="process-steps">
                    <div class="process-step">
                        <div class="process-step__number">01</div>
                        <div class="process-step__content">
                            <h3>Brief</h3>
                            <p>Tell us the topic, audience, and goals. We'll do the keyword research and competitive analysis.</p>
                        </div>
                    </div>
                    <div class="process-step">
                        <div class="process-step__number">02</div>
                        <div class="process-step__content">
                            <h3>Research</h3>
                            <p>Our AI research agent digs deep, then a human SRE validates every technical claim. No hallucinated kubectl commands.</p>
                        </div>
                    </div>
                    <div class="process-step">
                        <div class="process-step__number">03</div>
                        <div class="process-step__content">
                            <h3>Write &amp; Review</h3>
                            <p>Draft delivered in 5-7 business days. One round of revisions included. Code samples are tested, not guessed.</p>
                        </div>
                    </div>
                    <div class="process-step">
                        <div class="process-step__number">04</div>
                        <div class="process-step__content">
                            <h3>Publish</h3>
                            <p>Final content delivered in Markdown or Google Docs. SEO-optimized with meta descriptions, headers, and internal linking strategy.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Pricing Packages -->
        <section class="services-packages" id="packages" data-reveal>
            <div class="container">
                <h2 class="section-title--center">Packages</h2>
                <p class="services-section-subtitle">Transparent pricing. No discovery calls just to see numbers.</p>

                <div class="services-grid services-grid--3">
                    <!-- Blog Post -->
                    <div class="package-card">
                        <div class="package-card__header">
                            <h3>Blog Post</h3>
                            <div class="package-card__price">$500<span>-800</span></div>
                            <p class="package-card__label">per post</p>
                        </div>
                        <ul class="package-card__features">
                            <li>800-1,500 words</li>
                            <li>Keyword &amp; competitive research</li>
                            <li>SEO-optimized (meta, headers)</li>
                            <li>1 round of revisions</li>
                            <li>5 business day turnaround</li>
                        </ul>
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--outline btn--full">Get Started</a>
                    </div>

                    <!-- Tutorial -->
                    <div class="package-card package-card--featured">
                        <div class="package-card__badge">Most Popular</div>
                        <div class="package-card__header">
                            <h3>Tutorial / Deep-Dive</h3>
                            <div class="package-card__price">$800<span>-1,500</span></div>
                            <p class="package-card__label">per piece</p>
                        </div>
                        <ul class="package-card__features">
                            <li>1,500-3,500 words</li>
                            <li>Everything in Blog Post, plus:</li>
                            <li>Tested, working code samples</li>
                            <li>Up to 2 architecture diagrams</li>
                            <li>7 business day turnaround</li>
                        </ul>
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary btn--full">Get Started</a>
                    </div>

                    <!-- Documentation Overhaul -->
                    <div class="package-card">
                        <div class="package-card__header">
                            <h3>Docs Overhaul</h3>
                            <div class="package-card__price">$5,000<span>+</span></div>
                            <p class="package-card__label">per project</p>
                        </div>
                        <ul class="package-card__features">
                            <li>Full audit &amp; restructure</li>
                            <li>API reference cleanup</li>
                            <li>Quickstart &amp; getting started guides</li>
                            <li>Style guide included</li>
                            <li>Custom timeline</li>
                        </ul>
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--outline btn--full">Get a Quote</a>
                    </div>
                </div>

                <!-- Retainers -->
                <h3 class="services-retainer-heading">Monthly Retainers</h3>
                <p class="services-section-subtitle services-section-subtitle--small">Consistent output, dedicated writer, priority scheduling.</p>

                <div class="services-grid services-grid--3">
                    <div class="package-card">
                        <div class="package-card__header">
                            <h3>Starter</h3>
                            <div class="package-card__price">$2,000<span>-3,000</span></div>
                            <p class="package-card__label">per month</p>
                        </div>
                        <ul class="package-card__features">
                            <li>4 posts per month</li>
                            <li>Dedicated writer</li>
                            <li>Monthly content calendar</li>
                            <li>Keyword research per piece</li>
                            <li>Priority scheduling</li>
                            <li>Slack/email access</li>
                        </ul>
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--outline btn--full">Let's Talk</a>
                    </div>

                    <div class="package-card package-card--featured">
                        <div class="package-card__badge">Best Value</div>
                        <div class="package-card__header">
                            <h3>Growth</h3>
                            <div class="package-card__price">$3,500<span>-5,000</span></div>
                            <p class="package-card__label">per month</p>
                        </div>
                        <ul class="package-card__features">
                            <li>8 posts per month</li>
                            <li>Everything in Starter, plus:</li>
                            <li>2 rounds of revisions</li>
                            <li>Bi-weekly strategy check-ins</li>
                            <li>Monthly performance review</li>
                            <li>Social media snippets included</li>
                        </ul>
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary btn--full">Let's Talk</a>
                    </div>

                    <div class="package-card">
                        <div class="package-card__header">
                            <h3>Scale</h3>
                            <div class="package-card__price">$7,000<span>+</span></div>
                            <p class="package-card__label">per month</p>
                        </div>
                        <ul class="package-card__features">
                            <li>12+ posts per month</li>
                            <li>Everything in Growth, plus:</li>
                            <li>Dedicated content strategist</li>
                            <li>Weekly strategy calls</li>
                            <li>Quarterly content audit</li>
                            <li>Distribution &amp; promotion support</li>
                        </ul>
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--outline btn--full">Let's Talk</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Why Us -->
        <section class="services-why" data-reveal>
            <div class="container container--narrow">
                <h2 class="section-title--center">Why Work With Us</h2>
                <div class="why-list">
                    <div class="why-item">
                        <div class="why-item__icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>
                        </div>
                        <div>
                            <h3>Written by engineers, not marketers</h3>
                            <p>Our lead writer has 20 years of hands-on SRE experience. The content is technically accurate because the person writing it has been on-call at 3 AM.</p>
                        </div>
                    </div>
                    <div class="why-item">
                        <div class="why-item__icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="2" y1="12" x2="22" y2="12"></line>
                                <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3>AI-augmented, human-verified</h3>
                            <p>We use specialized AI agents for research and drafting, then every piece goes through human review. You get the speed of AI with the quality of a senior engineer.</p>
                        </div>
                    </div>
                    <div class="why-item">
                        <div class="why-item__icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="16 18 22 12 16 6"></polyline>
                                <polyline points="8 6 2 12 8 18"></polyline>
                            </svg>
                        </div>
                        <div>
                            <h3>Code that actually works</h3>
                            <p>Every code sample is tested. Every command is validated. We don't ship tutorials that break on the reader's first try.</p>
                        </div>
                    </div>
                    <div class="why-item">
                        <div class="why-item__icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="3" y1="9" x2="21" y2="9"></line>
                                <line x1="9" y1="21" x2="9" y2="9"></line>
                            </svg>
                        </div>
                        <div>
                            <h3>SEO that developers don't hate</h3>
                            <p>Optimized for search without the keyword-stuffing cringe. Content that ranks AND reads well, because the two aren't mutually exclusive.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Portfolio -->
        <section class="services-portfolio" data-reveal>
            <div class="container">
                <h2 class="section-title--center">Recent Work</h2>
                <p class="services-section-subtitle">A few examples of what we produce.</p>
                <div class="services-grid services-grid--3">
                    <a href="<?php echo esc_url(home_url('/?p=906')); ?>" class="portfolio-card">
                        <div class="portfolio-card__tag">Tutorial</div>
                        <h3>How I Use Argus to Investigate Production Issues</h3>
                        <p>A real-world walkthrough of debugging a production incident using an AI-powered CLI tool.</p>
                    </a>
                    <a href="<?php echo esc_url(home_url('/?p=862')); ?>" class="portfolio-card">
                        <div class="portfolio-card__tag">Product Launch</div>
                        <h3>I Built an AI-Powered Observability CLI</h3>
                        <p>The story behind Argus, why existing tools weren't cutting it, and what we built instead.</p>
                    </a>
                    <a href="<?php echo esc_url(home_url('/?p=858')); ?>" class="portfolio-card">
                        <div class="portfolio-card__tag">Opinion</div>
                        <h3>AIOps in 2026: Hype vs Reality</h3>
                        <p>A grounded take on what AI actually does for operations, from someone who's been on-call through the hype cycle.</p>
                    </a>
                </div>
            </div>
        </section>

        <!-- CTA -->
        <section class="services-cta" data-reveal>
            <div class="container container--narrow">
                <div class="services-cta__inner">
                    <h2>Ready to level up your content?</h2>
                    <p>Tell us about your project. We'll get back to you within 24 hours with a proposal.</p>
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary btn--large">
                        Start a Project
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                </div>
            </div>
        </section>

    </article>
</main>

<?php
get_footer();
