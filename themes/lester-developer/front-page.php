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
                    <span>Open to projects</span>
                </div>
                <h1 class="hero-title">
                    I keep things running<br>
                    <mark>so you can sleep at night.</mark>
                </h1>
                <p class="hero-subtitle">
                    20 years of telling computers what to do (and watching them not listen). SRE, infrastructure nerd, occasional blogger. I automate everything, break some of it, and write about both. Based in Honduras, deployed globally.
                </p>
                <div class="hero-stats">
                    <div class="hero-stat">
                        <span class="hero-stat__label">20 years mass-producing YAML</span>
                    </div>
                    <div class="hero-stat">
                        <span class="hero-stat__label">caffeine-to-uptime converter</span>
                    </div>
                    <div class="hero-stat">
                        <span class="hero-stat__label">if it can be automated, it will be</span>
                    </div>
                </div>
                <div class="hero-cta">
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary btn--large">
                        Let's talk
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                    <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="btn btn--outline btn--large">
                        Read my stuff
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
            <div class="services-simple" data-reveal>
                <h2 class="services-simple__title">What I actually do</h2>
                <p class="services-simple__content">I design cloud infrastructure, build deployment pipelines, and make sure things stay up. AWS, Kubernetes, Terraform, the usual suspects. I've spent the last decade automating myself out of boring work and into more interesting problems. Sometimes I write about it.</p>
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
                <h2 class="cta-title">I write sometimes.</h2>
                <p class="cta-subtitle">Mostly about infrastructure, automation, and the things that keep me up at night (besides my dogs). No spam, no "growth hacking" garbage. Just posts when I have something worth saying.</p>
                <form class="newsletter-form" action="#" method="post">
                    <input type="email" name="email" placeholder="your@email.com" required aria-label="Email address">
                    <button type="submit" class="btn btn--primary">Sure, let me know</button>
                </form>
                <p class="cta-secondary-link">
                    Or <a href="<?php echo esc_url(home_url('/contact/')); ?>">get in touch</a>.
                </p>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
