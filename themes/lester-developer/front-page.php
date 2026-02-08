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
            <div class="hero-content">
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
            <div class="hero-visual">
                <?php
                $hero_image = get_theme_mod('hero_image');
                if ($hero_image) :
                ?>
                    <img src="<?php echo esc_url($hero_image); ?>" alt="Lester Barahona" class="hero-image">
                <?php else : ?>
                    <div class="hero-image-placeholder">
                        <div class="hero-image-placeholder__content">
                            <svg viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="100" cy="100" r="90" stroke="#e5e5e5" stroke-width="1" fill="none"/>
                                <circle cx="100" cy="80" r="30" fill="#e5e5e5"/>
                                <ellipse cx="100" cy="140" rx="45" ry="28" fill="#e5e5e5"/>
                            </svg>
                            <p class="hero-image-placeholder__text">
                                <span class="upload-hint">Add your photo in Customizer</span>
                            </p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Companies Section — Marquee -->
    <section class="companies-section">
        <div class="container">
            <h2 class="section-title--center">Companies I've Worked With</h2>
        </div>
        <?php get_template_part('template-parts/companies-logos', null, array('marquee' => true)); ?>
    </section>

    <!-- Latest Articles -->
    <section class="posts-section">
        <div class="container">
            <header class="section-header">
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
                    while ($recent_posts->have_posts()) :
                        $recent_posts->the_post();
                        get_template_part('template-parts/content', 'card');
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

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2 class="cta-title">Ready to build something reliable?</h2>
                <p class="cta-subtitle">Let's discuss how I can help transform your infrastructure</p>
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary btn--large">
                    Get in Touch
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
