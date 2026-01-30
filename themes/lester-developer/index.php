<?php
/**
 * The main template file
 *
 * @package Lester_Developer
 */

get_header();

// Hero visual option: 'terminal', 'image', or 'both'
$hero_visual = get_theme_mod('hero_visual_style', 'image'); // Changed default to 'image'
?>

<main id="primary" class="site-main">
    <?php if (is_front_page() && !is_paged()) : ?>
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
                        <span class="hero-title__highlight">that just works.</span>
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
                        <!-- Placeholder with abstract tech visualization -->
                        <div class="hero-image-placeholder">
                            <div class="hero-image-placeholder__content">
                                <svg viewBox="0 0 400 400" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <!-- Abstract infrastructure/cloud visualization -->
                                    <defs>
                                        <linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="100%">
                                            <stop offset="0%" style="stop-color:#3b82f6;stop-opacity:0.8" />
                                            <stop offset="100%" style="stop-color:#a855f7;stop-opacity:0.8" />
                                        </linearGradient>
                                        <linearGradient id="grad2" x1="0%" y1="0%" x2="100%" y2="100%">
                                            <stop offset="0%" style="stop-color:#3b82f6;stop-opacity:0.3" />
                                            <stop offset="100%" style="stop-color:#a855f7;stop-opacity:0.3" />
                                        </linearGradient>
                                    </defs>
                                    
                                    <!-- Background circles -->
                                    <circle cx="200" cy="200" r="180" stroke="url(#grad2)" stroke-width="1" fill="none" opacity="0.5"/>
                                    <circle cx="200" cy="200" r="140" stroke="url(#grad2)" stroke-width="1" fill="none" opacity="0.5"/>
                                    <circle cx="200" cy="200" r="100" stroke="url(#grad2)" stroke-width="1" fill="none" opacity="0.5"/>
                                    
                                    <!-- Central server/cloud icon -->
                                    <rect x="160" y="160" width="80" height="80" rx="8" fill="url(#grad1)" opacity="0.9"/>
                                    <rect x="175" y="180" width="50" height="6" rx="3" fill="#fff" opacity="0.8"/>
                                    <rect x="175" y="195" width="35" height="6" rx="3" fill="#fff" opacity="0.6"/>
                                    <rect x="175" y="210" width="45" height="6" rx="3" fill="#fff" opacity="0.4"/>
                                    
                                    <!-- Connection nodes -->
                                    <circle cx="100" cy="120" r="20" fill="url(#grad1)" opacity="0.7"/>
                                    <circle cx="300" cy="120" r="20" fill="url(#grad1)" opacity="0.7"/>
                                    <circle cx="100" cy="280" r="20" fill="url(#grad1)" opacity="0.7"/>
                                    <circle cx="300" cy="280" r="20" fill="url(#grad1)" opacity="0.7"/>
                                    <circle cx="200" cy="60" r="15" fill="url(#grad1)" opacity="0.6"/>
                                    <circle cx="200" cy="340" r="15" fill="url(#grad1)" opacity="0.6"/>
                                    <circle cx="60" cy="200" r="15" fill="url(#grad1)" opacity="0.6"/>
                                    <circle cx="340" cy="200" r="15" fill="url(#grad1)" opacity="0.6"/>
                                    
                                    <!-- Connection lines -->
                                    <line x1="120" y1="130" x2="160" y2="170" stroke="url(#grad1)" stroke-width="2" opacity="0.5"/>
                                    <line x1="280" y1="130" x2="240" y2="170" stroke="url(#grad1)" stroke-width="2" opacity="0.5"/>
                                    <line x1="120" y1="270" x2="160" y2="230" stroke="url(#grad1)" stroke-width="2" opacity="0.5"/>
                                    <line x1="280" y1="270" x2="240" y2="230" stroke="url(#grad1)" stroke-width="2" opacity="0.5"/>
                                    <line x1="200" y1="75" x2="200" y2="160" stroke="url(#grad1)" stroke-width="2" opacity="0.5"/>
                                    <line x1="200" y1="240" x2="200" y2="325" stroke="url(#grad1)" stroke-width="2" opacity="0.5"/>
                                    <line x1="75" y1="200" x2="160" y2="200" stroke="url(#grad1)" stroke-width="2" opacity="0.5"/>
                                    <line x1="240" y1="200" x2="325" y2="200" stroke="url(#grad1)" stroke-width="2" opacity="0.5"/>
                                    
                                    <!-- Animated pulse circles (CSS will animate) -->
                                    <circle cx="200" cy="200" r="60" stroke="url(#grad1)" stroke-width="2" fill="none" class="pulse-ring"/>
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

        <!-- Tech Stack Section -->
        <section class="tech-stack">
            <div class="container">
                <p class="tech-stack__label">Technologies I work with</p>
                <div class="tech-stack__icons">
                    <div class="tech-icon" title="Kubernetes">
                        <svg viewBox="0 0 32 32" width="32" height="32"><path fill="currentColor" d="M15.9.5c-.4 0-.8.2-1.1.4L3.1 7.2c-.7.4-1.1 1.1-1.1 1.9v13.3c0 .8.4 1.5 1.1 1.9l11.7 6.3c.7.4 1.5.4 2.2 0l11.7-6.3c.7-.4 1.1-1.1 1.1-1.9V9.1c0-.8-.4-1.5-1.1-1.9L17 .9c-.3-.3-.7-.4-1.1-.4z"/></svg>
                    </div>
                    <div class="tech-icon" title="Terraform">
                        <svg viewBox="0 0 32 32" width="32" height="32"><path fill="currentColor" d="M21.3 11.2v9.5l8.2-4.7v-9.5l-8.2 4.7zm-10.3 5.9v9.5l8.2 4.7v-9.5l-8.2-4.7zm0-10.6v9.5l8.2 4.7v-9.5l-8.2-4.7zm-8.5 4.9v9.5l8.2 4.7v-9.5l-8.2-4.7z"/></svg>
                    </div>
                    <div class="tech-icon" title="AWS">
                        <svg viewBox="0 0 32 32" width="32" height="32"><path fill="currentColor" d="M9.2 13.8l-1.4 4.6h2.9l-1.5-4.6zm14.4-1.3c-.7 0-1.2.2-1.6.7-.4.4-.6 1-.6 1.8s.2 1.4.6 1.8c.4.4.9.7 1.6.7.7 0 1.2-.2 1.6-.7.4-.4.6-1 .6-1.8s-.2-1.4-.6-1.8c-.4-.5-.9-.7-1.6-.7z"/><path fill="currentColor" d="M16 2C8.3 2 2 8.3 2 16s6.3 14 14 14 14-6.3 14-14S23.7 2 16 2zm-5.3 18.8H8.5l-.5-1.6H4.9l-.5 1.6H2.3l3.1-9h2.3l3 9zm8.1-5c0 1.4-.4 2.5-1.1 3.3-.7.8-1.8 1.2-3.1 1.2-1.3 0-2.3-.4-3.1-1.2-.8-.8-1.1-1.9-1.1-3.3s.4-2.5 1.1-3.3c.8-.8 1.8-1.2 3.1-1.2 1.3 0 2.3.4 3.1 1.2.7.8 1.1 1.9 1.1 3.3zm8.8 2.4c0 .9-.3 1.6-1 2.1-.7.5-1.6.8-2.8.8-1.1 0-2-.2-2.8-.5v-1.8c.9.5 1.9.7 2.8.7.6 0 1-.1 1.3-.3.3-.2.4-.5.4-.8 0-.2-.1-.4-.2-.6-.1-.2-.3-.3-.6-.5-.3-.2-.7-.4-1.2-.6-.8-.3-1.4-.7-1.8-1.1-.4-.5-.6-1-.6-1.7 0-.8.3-1.5.9-2 .6-.5 1.4-.7 2.5-.7.5 0 1 .1 1.5.2.5.1.9.2 1.3.4v1.8c-.8-.5-1.7-.7-2.6-.7-.5 0-.8.1-1.1.3-.3.2-.4.4-.4.8 0 .3.1.5.4.7.3.2.7.5 1.4.8.8.3 1.4.7 1.8 1.1.4.6.6 1.1.6 1.6z"/></svg>
                    </div>
                    <div class="tech-icon" title="Docker">
                        <svg viewBox="0 0 32 32" width="32" height="32"><path fill="currentColor" d="M31.5 13.7c-.2-.2-1.2-.9-3.5-1 0-.7-.2-2.4-1.6-3.5l-.6-.5-.5.5c-.6.7-1.1 1.6-1.2 2.4-.2 1.1 0 2.2.6 3.1-1.1.6-2.8.8-3.3.8H.8c-.5 0-.8.4-.8.8 0 2 .3 4 1.1 5.8.8 1.7 2 3 3.5 3.8 1.8.9 4.8 1.5 8.2 1.5 7.3 0 13.4-3.4 16.1-10.7 1.9 0 3-.4 3.7-1.5l.3-.5-.4-.5c-.4-.3-.8-.5-1-.6zM3.9 15.5h3.1v2.9H3.9v-2.9zm4 0h3.1v2.9H7.9v-2.9zm0-3.7h3.1v2.9H7.9v-2.9zm3.9 3.7h3.1v2.9h-3.1v-2.9zm0-3.7h3.1v2.9h-3.1v-2.9zm-7.9 3.7h3.1v2.9H3.9v-2.9zm11.9 0h3.1v2.9h-3.1v-2.9zm0-3.7h3.1v2.9h-3.1v-2.9zm3.9 3.7h3.1v2.9h-3.1v-2.9z"/></svg>
                    </div>
                    <div class="tech-icon" title="Python">
                        <svg viewBox="0 0 32 32" width="32" height="32"><path fill="currentColor" d="M15.9 2c-1.3 0-2.6.1-3.7.4-3.2.7-3.8 2.2-3.8 5v3.7h7.6v1.2H7.4c-2.2 0-4.1 1.3-4.7 3.9-.7 2.9-.7 4.7 0 7.8.5 2.3 1.8 3.9 4 3.9h2.6v-3.5c0-2.5 2.1-4.7 4.7-4.7h7.6c2.1 0 3.8-1.7 3.8-3.8V8.5c0-2.1-1.8-3.6-3.8-4.1-1.3-.3-2.7-.4-4-.4h-.1zm-4.1 2.4c.8 0 1.4.6 1.4 1.4 0 .8-.6 1.4-1.4 1.4-.8 0-1.4-.6-1.4-1.4 0-.8.6-1.4 1.4-1.4z"/><path fill="currentColor" d="M24.7 12.4v3.4c0 2.6-2.2 4.8-4.7 4.8H12.4c-2.1 0-3.8 1.8-3.8 3.8v7.1c0 2.1 1.8 3.3 3.8 3.8 2.4.6 4.7.7 7.6 0 1.9-.5 3.8-1.5 3.8-3.8v-2.9h-7.6V27H28c2.2 0 3-1.5 3.8-3.8.8-2.4.7-4.7 0-7.8-.5-2.2-1.6-3.8-3.8-3.8h-2.8zm-4.3 15.2c.8 0 1.4.6 1.4 1.4 0 .8-.6 1.4-1.4 1.4-.8 0-1.4-.6-1.4-1.4 0-.8.6-1.4 1.4-1.4z"/></svg>
                    </div>
                    <div class="tech-icon" title="Go">
                        <svg viewBox="0 0 32 32" width="32" height="32"><path fill="currentColor" d="M2.8 11.4c-.1 0-.1 0-.1-.1s0-.1.1-.1l4.9-.3c.1 0 .1 0 .1.1l.8 1.3c0 .1 0 .1-.1.1l-4.9.3c-.1 0-.1 0-.1-.1l-.7-1.2zm-1.5 2.1c-.1 0-.1 0-.1-.1s0-.1.1-.1l6.3-.4c.1 0 .1 0 .1.1l.5 1c0 .1 0 .1-.1.1l-6.3.4c-.1 0-.1 0-.1-.1l-.4-.9zm2.4 2c-.1 0-.1 0-.1-.1 0-.1 0-.1.1-.1l4-.2c.1 0 .1 0 .1.1l.3.8c0 .1 0 .1-.1.1l-3.9.2c-.1 0-.1 0-.1-.1l-.3-.7zm17.1-3.3c0-.1-.1-.2-.2-.2l-3.1.2c-.1 0-.2.1-.2.2v6.2c0 .1.1.2.2.2l3.1-.2c.1 0 .2-.1.2-.2v-6.2zm7.7-.5l-.9 1.3c-.1.1-.2.1-.3 0l-1-.7c-.1-.1-.1-.2 0-.3l.9-1.3c.1-.1.2-.1.3 0l1 .7c.1.1.1.2 0 .3zm-.9 8.4c-2.4.1-4.4-1.7-4.5-4.1-.1-2.4 1.7-4.4 4.1-4.5s4.4 1.7 4.5 4.1c.1 2.4-1.7 4.4-4.1 4.5zm.1-6.1c-1 .1-1.8.9-1.7 2 .1 1 .9 1.8 2 1.7 1-.1 1.8-.9 1.7-2-.1-1-.9-1.8-2-1.7zm-9.5 6c-2.4.1-4.4-1.7-4.5-4.1-.1-2.4 1.7-4.4 4.1-4.5s4.4 1.7 4.5 4.1c.1 2.4-1.7 4.4-4.1 4.5zm.1-6.1c-1 .1-1.8.9-1.7 2 .1 1 .9 1.8 2 1.7 1-.1 1.8-.9 1.7-2-.1-1-.9-1.8-2-1.7z"/></svg>
                    </div>
                    <div class="tech-icon" title="Node.js">
                        <svg viewBox="0 0 32 32" width="32" height="32"><path fill="currentColor" d="M16 30.3c-.4 0-.8-.1-1.2-.3l-3.8-2.3c-.6-.3-.3-.4-.1-.5.8-.3.9-.3 1.7-.8.1 0 .2 0 .2.1l2.9 1.7c.1.1.2.1.3 0l11.4-6.6c.1-.1.2-.2.2-.3V8.2c0-.1-.1-.3-.2-.3L16.1 1.3c-.1-.1-.2-.1-.3 0L4.4 7.9c-.1.1-.2.2-.2.3v13.2c0 .1.1.3.2.3l3.1 1.8c1.7.9 2.8-.2 2.8-1.3V9.3c0-.2.1-.3.3-.3h1.4c.2 0 .3.1.3.3v12.9c0 2.5-1.4 4-3.8 4-.7 0-1.4 0-3-.8l-3-1.7c-.7-.4-1.2-1.2-1.2-2.1V8.2c0-.9.5-1.7 1.2-2.1L13.9.5c.7-.4 1.7-.4 2.4 0l11.4 6.6c.7.4 1.2 1.2 1.2 2.1v13.2c0 .9-.5 1.7-1.2 2.1l-11.4 6.6c-.4.2-.8.2-1.3.2z"/></svg>
                    </div>
                </div>
            </div>
        </section>

        <!-- Companies Section -->
        <section class="companies-section">
            <div class="container">
                <h2 class="section-title section-title--center">Companies I've Worked With</h2>
                <p class="section-subtitle">I've built and maintained infrastructure for these amazing companies</p>
                <div class="companies-grid">
                    <div class="company-logo" title="Fueled">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/fueled.svg" alt="Fueled" loading="lazy">
                    </div>
                    <div class="company-logo" title="10up">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/10up.svg" alt="10up" loading="lazy">
                    </div>
                    <div class="company-logo" title="Pinterest">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/pinterest.svg" alt="Pinterest" loading="lazy">
                    </div>
                    <div class="company-logo" title="Microsoft">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/microsoft.svg" alt="Microsoft" loading="lazy">
                    </div>
                    <div class="company-logo" title="Sandals Resorts">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/sandals.svg" alt="Sandals Resorts" loading="lazy">
                    </div>
                    <div class="company-logo" title="InvestorPlace">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/investorplace.svg" alt="InvestorPlace" loading="lazy">
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- Posts Section -->
    <section class="posts-section">
        <div class="container">
            <?php if (is_front_page() && !is_paged()) : ?>
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
            <?php endif; ?>

            <?php if (have_posts()) : ?>
                <div class="posts-grid">
                    <?php
                    while (have_posts()) :
                        the_post();
                        get_template_part('template-parts/content', 'card');
                    endwhile;
                    ?>
                </div>

                <?php
                the_posts_pagination(array(
                    'mid_size'  => 2,
                    'prev_text' => '← Previous',
                    'next_text' => 'Next →',
                ));
                ?>

            <?php else : ?>
                <div class="no-posts">
                    <h2>No posts yet</h2>
                    <p>Check back soon for new content!</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <?php if (is_front_page() && !is_paged()) : ?>
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
    <?php endif; ?>
</main>

<?php
get_footer();
