<?php
/**
 * Front Page Template
 *
 * @package Lester_Developer
 */

get_header();
?>

<main id="primary" class="site-main">
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content" data-reveal>
                <div class="hero-badge">
                    <span class="hero-badge__dot"></span>
                    <span>Available for consulting</span>
                </div>
                <h1 class="hero-title">
                    I build infrastructure<br>
                    <mark>that just works.</mark>
                </h1>
                <p class="hero-subtitle">
                    Senior Site Reliability Engineer with 20 years of experience. I transform complex systems
                    into reliable, automated infrastructure that scales effortlessly and lets your team focus
                    on what matters.
                </p>
                <div class="hero-stats">
                    <div class="hero-stat">
                        <span class="hero-stat__number">20+</span>
                        <span class="hero-stat__label">Years Experience</span>
                    </div>
                    <div class="hero-stat">
                        <span class="hero-stat__number">99.99%</span>
                        <span class="hero-stat__label">Uptime Target</span>
                    </div>
                    <div class="hero-stat">
                        <span class="hero-stat__number">&infin;</span>
                        <span class="hero-stat__label">Automation</span>
                    </div>
                </div>
                <div class="hero-cta">
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary btn--large">
                        Let's Work Together
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                    <a href="<?php echo esc_url(home_url('/about/')); ?>" class="btn btn--outline btn--large">
                        Learn More About Me
                    </a>
                </div>
            </div>

            <!-- Hero Photo -->
            <div class="hero-visual" data-reveal data-reveal-delay="200">
                <?php
                $hero_image = get_theme_mod('hero_image');
                if ($hero_image) :
                ?>
                    <img src="<?php echo esc_url($hero_image); ?>" alt="Lester Barahona" class="hero-image">
                <?php else : ?>
                    <div class="hero-initials">
                        <span class="hero-initials__text">LB</span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Services / What I Do Section -->
    <section class="services-section">
        <div class="container">
            <h2 class="section-title--center" data-reveal>What I Do</h2>
            <div class="services-grid">
                <div class="service-card" data-reveal data-reveal-delay="100">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 10h-1.26A8 8 0 1 0 9 20h9a5 5 0 0 0 0-10z"></path>
                        </svg>
                    </div>
                    <h3 class="service-card__title">Infrastructure & Cloud</h3>
                    <p class="service-card__description">Design and manage cloud infrastructure on AWS, GCP, and Azure. Kubernetes orchestration, Terraform IaC, and cost optimization.</p>
                </div>
                <div class="service-card" data-reveal data-reveal-delay="200">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="3"></circle>
                            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                        </svg>
                    </div>
                    <h3 class="service-card__title">CI/CD & Automation</h3>
                    <p class="service-card__description">Build deployment pipelines that ship reliably. GitHub Actions, Jenkins, automated testing, and zero-downtime deployments.</p>
                </div>
                <div class="service-card" data-reveal data-reveal-delay="300">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                        </svg>
                    </div>
                    <h3 class="service-card__title">Reliability & Observability</h3>
                    <p class="service-card__description">Implement SLOs, monitoring, alerting, and incident response. Prometheus, Grafana, and on-call best practices.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Companies Section — Marquee -->
    <section class="companies-section" data-reveal>
        <div class="container">
            <h2 class="section-title--center">Companies I've Worked With</h2>
        </div>
        <?php get_template_part('template-parts/companies-logos', null, array('marquee' => true)); ?>
    </section>

    <!-- Latest Articles -->
    <section class="posts-section">
        <div class="container">
            <header class="section-header" data-reveal>
                <div>
                    <h2 class="section-title">Latest Articles</h2>
                    <p class="section-description">Thoughts on SRE, DevOps, automation, and building reliable systems</p>
                </div>
                <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="btn btn--outline">
                    View All Articles
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
            </header>

            <?php
            $recent_posts = new WP_Query(array(
                'posts_per_page' => 6,
                'post_status'    => 'publish',
            ));

            if ($recent_posts->have_posts()) :
            ?>
                <div class="posts-grid">
                    <?php
                    $post_index = 0;
                    while ($recent_posts->have_posts()) :
                        $recent_posts->the_post();
                        ?>
                        <div data-reveal data-reveal-delay="<?php echo esc_attr($post_index * 100); ?>">
                            <?php get_template_part('template-parts/content', 'card'); ?>
                        </div>
                        <?php
                        $post_index++;
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            <?php else : ?>
                <div class="no-posts">
                    <h2>No posts yet</h2>
                    <p>Check back soon for new content!</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Newsletter CTA Section -->
    <section class="cta-section" data-reveal>
        <div class="container">
            <div class="cta-content">
                <h2 class="cta-title">Ready to build something reliable?</h2>
                <p class="cta-subtitle">Get notified when I publish new articles about infrastructure and reliability.</p>
                <form class="newsletter-form" action="#" method="post">
                    <input type="email" name="email" placeholder="you@company.com" required aria-label="Email address">
                    <button type="submit" class="btn btn--primary">Subscribe</button>
                </form>
                <p class="cta-secondary-link">
                    Or <a href="<?php echo esc_url(home_url('/contact/')); ?>">get in touch</a> to discuss a project.
                </p>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
