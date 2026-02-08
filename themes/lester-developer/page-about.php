<?php
/**
 * Template Name: About Page
 * Template for the about page with companies section
 *
 * @package Lester_Developer
 */

get_header();
?>

<main id="primary" class="site-main">
    <article id="post-<?php the_ID(); ?>" <?php post_class('about-page'); ?>>
        <div class="container container--narrow">
            <header class="about-header" data-reveal>
                <h1 class="about-title"><?php the_title(); ?></h1>
            </header>

            <div class="about-content entry-content" data-reveal>
                <?php the_content(); ?>
            </div>

            <!-- Tech Stack Section -->
            <section class="tech-stack" data-reveal>
                <h2>Tech Stack</h2>
                <div class="tech-stack-categories">
                    <div class="tech-stack-category">
                        <div class="tech-stack-category__label">Cloud</div>
                        <div class="tech-stack-badges">
                            <span class="tech-badge">AWS</span>
                            <span class="tech-badge">GCP</span>
                            <span class="tech-badge">Azure</span>
                        </div>
                    </div>
                    <div class="tech-stack-category">
                        <div class="tech-stack-category__label">Orchestration</div>
                        <div class="tech-stack-badges">
                            <span class="tech-badge">Kubernetes</span>
                            <span class="tech-badge">Docker</span>
                            <span class="tech-badge">Helm</span>
                        </div>
                    </div>
                    <div class="tech-stack-category">
                        <div class="tech-stack-category__label">IaC</div>
                        <div class="tech-stack-badges">
                            <span class="tech-badge">Terraform</span>
                            <span class="tech-badge">Ansible</span>
                            <span class="tech-badge">CloudFormation</span>
                        </div>
                    </div>
                    <div class="tech-stack-category">
                        <div class="tech-stack-category__label">CI/CD</div>
                        <div class="tech-stack-badges">
                            <span class="tech-badge">GitHub Actions</span>
                            <span class="tech-badge">Jenkins</span>
                            <span class="tech-badge">ArgoCD</span>
                        </div>
                    </div>
                    <div class="tech-stack-category">
                        <div class="tech-stack-category__label">Observability</div>
                        <div class="tech-stack-badges">
                            <span class="tech-badge">Prometheus</span>
                            <span class="tech-badge">Grafana</span>
                            <span class="tech-badge">Datadog</span>
                        </div>
                    </div>
                    <div class="tech-stack-category">
                        <div class="tech-stack-category__label">Languages</div>
                        <div class="tech-stack-badges">
                            <span class="tech-badge">Python</span>
                            <span class="tech-badge">Go</span>
                            <span class="tech-badge">Bash</span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Certifications Section -->
            <section class="certifications-section" data-reveal>
                <h2>Certifications</h2>
                <div class="certifications-grid">
                    <div class="certification-card">
                        <div class="certification-card__icon">
                            <div class="aws-badge">
                                <span class="aws-badge__text">AWS</span>
                            </div>
                        </div>
                        <div class="certification-card__content">
                            <h3>AWS Solutions Architect</h3>
                            <p>Amazon Web Services</p>
                            <span class="certification-card__badge">Certified</span>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Companies Section -->
        <section class="companies-section companies-section--about" data-reveal>
            <div class="container">
                <h2 class="section-title--center">Companies I've Worked With</h2>
            </div>
            <?php get_template_part('template-parts/companies-logos', null, array('marquee' => true)); ?>
        </section>

        <div class="container container--narrow">
            <div class="about-cta" data-reveal>
                <h2>Let's Connect</h2>
                <p>Interested in working together? I'd love to hear from you.</p>
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary btn--large">
                    Get in Touch
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
            </div>
        </div>
    </article>
</main>

<?php
get_footer();
