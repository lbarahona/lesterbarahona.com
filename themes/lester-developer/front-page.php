<?php
/**
 * Front Page Template
 * Used when a static front page is set in WordPress
 *
 * @package Lester_Developer
 */

get_header();

// Hero visual option: 'terminal' or 'image'
$hero_visual = get_theme_mod('hero_visual_style', 'image');
?>

<main id="primary" class="site-main">
    <!-- Hero Section -->
    <section class="hero <?php echo $hero_visual === 'image' ? 'hero--with-image' : ''; ?>">
        <div class="hero-bg-grid"></div>
        <div class="container">
            <div class="hero-content">
                <div class="hero-badge">
                    <span class="hero-badge__icon">🚀</span>
                    <span>Available for consulting</span>
                </div>
                <h1 class="hero-title">
                    I build infrastructure<br>
                    that just works.
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
                        <span class="hero-stat__number">∞</span>
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

            <?php if ($hero_visual === 'terminal') : ?>
            <!-- Terminal Visual -->
            <div class="hero-visual">
                <div class="hero-terminal">
                    <div class="terminal-header">
                        <span class="terminal-dot terminal-dot--red"></span>
                        <span class="terminal-dot terminal-dot--yellow"></span>
                        <span class="terminal-dot terminal-dot--green"></span>
                        <span class="terminal-title">infrastructure.yaml</span>
                    </div>
                    <div class="terminal-body">
                        <pre><code><span class="yaml-key">apiVersion:</span> sre/v1
<span class="yaml-key">kind:</span> Infrastructure
<span class="yaml-key">metadata:</span>
  <span class="yaml-key">name:</span> <span class="yaml-value">production</span>
<span class="yaml-key">spec:</span>
  <span class="yaml-key">reliability:</span> <span class="yaml-value">99.99%</span>
  <span class="yaml-key">automation:</span> <span class="yaml-value">maximum</span>
  <span class="yaml-key">complexity:</span> <span class="yaml-value">hidden</span>
  <span class="yaml-key">status:</span> <span class="yaml-success">✓ Running</span></code></pre>
                    </div>
                </div>
            </div>
            <?php else : ?>
            <!-- Hero Image -->
            <div class="hero-visual hero-visual--image">
                <?php 
                $hero_image = get_theme_mod('hero_image');
                if ($hero_image) : 
                ?>
                    <img src="<?php echo esc_url($hero_image); ?>" alt="Lester Barahona" class="hero-image">
                <?php else : ?>
                    <div class="hero-image-placeholder">
                        <div class="hero-image-placeholder__content">
                            <svg viewBox="0 0 400 400" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <defs>
                                    <linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="100%">
                                        <stop offset="0%" style="stop-color:#3b82f6;stop-opacity:0.8" />
                                        <stop offset="100%" style="stop-color:#a855f7;stop-opacity:0.8" />
                                    </linearGradient>
                                </defs>
                                <circle cx="200" cy="200" r="180" stroke="#3b82f6" stroke-width="1" fill="none" opacity="0.2"/>
                                <circle cx="200" cy="200" r="140" stroke="#3b82f6" stroke-width="1" fill="none" opacity="0.2"/>
                                <circle cx="200" cy="200" r="100" stroke="#3b82f6" stroke-width="1" fill="none" opacity="0.2"/>
                                <rect x="160" y="160" width="80" height="80" rx="8" fill="url(#grad1)" opacity="0.9"/>
                                <rect x="175" y="180" width="50" height="6" rx="3" fill="#fff" opacity="0.8"/>
                                <rect x="175" y="195" width="35" height="6" rx="3" fill="#fff" opacity="0.6"/>
                                <rect x="175" y="210" width="45" height="6" rx="3" fill="#fff" opacity="0.4"/>
                            </svg>
                            <p class="hero-image-placeholder__text">
                                <span class="upload-hint">Add your photo in Customizer</span>
                            </p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Companies Section -->
    <section class="companies-section">
        <div class="container">
            <h2 class="section-title section-title--center">Trusted by Industry Leaders</h2>
            <p class="section-subtitle">I've built and maintained infrastructure for these amazing companies</p>
            <div class="companies-grid">
                <a href="https://www.microsoft.com/" target="_blank" rel="noopener noreferrer" class="company-logo" title="Microsoft">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/microsoft.svg" alt="Microsoft" loading="lazy">
                </a>
                <a href="https://www.starbucks.com/" target="_blank" rel="noopener noreferrer" class="company-logo" title="Starbucks">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/starbucks.svg" alt="Starbucks" loading="lazy">
                </a>
                <a href="https://www.meta.com/" target="_blank" rel="noopener noreferrer" class="company-logo" title="Meta">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/meta.svg" alt="Meta" loading="lazy">
                </a>
                <a href="https://fueled.com/" target="_blank" rel="noopener noreferrer" class="company-logo" title="Fueled">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/fueled.svg" alt="Fueled" loading="lazy">
                </a>
                <a href="https://www.pinterest.com/" target="_blank" rel="noopener noreferrer" class="company-logo" title="Pinterest">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/pinterest.svg" alt="Pinterest" loading="lazy">
                </a>
                <a href="https://investorplace.com/" target="_blank" rel="noopener noreferrer" class="company-logo" title="InvestorPlace">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/investorplace.svg" alt="InvestorPlace" loading="lazy">
                </a>
                <a href="https://www.sandals.com/" target="_blank" rel="noopener noreferrer" class="company-logo" title="Sandals Resorts">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/sandals.svg" alt="Sandals Resorts" loading="lazy">
                </a>
                <a href="https://www.beaches.com/" target="_blank" rel="noopener noreferrer" class="company-logo" title="Beaches Resorts">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/beaches.svg" alt="Beaches Resorts" loading="lazy">
                </a>
            </div>
        </div>
    </section>

    <!-- Posts Section -->
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
