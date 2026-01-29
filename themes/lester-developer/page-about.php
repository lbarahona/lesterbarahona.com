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
            <header class="about-header">
                <h1 class="about-title"><?php the_title(); ?></h1>
            </header>

            <div class="about-content entry-content">
                <?php the_content(); ?>
            </div>

            <!-- Certifications Section -->
            <section class="certifications-section">
                <h2>Certifications</h2>
                <div class="certifications-grid">
                    <div class="certification-card">
                        <div class="certification-card__icon">
                            <svg viewBox="0 0 64 64" width="48" height="48">
                                <path fill="#FF9900" d="M32 0C14.327 0 0 14.327 0 32s14.327 32 32 32 32-14.327 32-32S49.673 0 32 0z"/>
                                <path fill="#252F3E" d="M32 8c13.255 0 24 10.745 24 24S45.255 56 32 56 8 45.255 8 32 18.745 8 32 8z"/>
                                <path fill="#FF9900" d="M18.5 35.5c0 .8.3 1.5.8 2.1.5.6 1.2.9 2 .9.7 0 1.3-.2 1.8-.6.5-.4.9-.9 1.1-1.5h2.3c-.3 1.2-.9 2.2-1.8 3-.9.8-2 1.2-3.4 1.2-1.5 0-2.7-.5-3.6-1.4-.9-1-1.4-2.2-1.4-3.8 0-1.6.5-2.9 1.4-3.9.9-1 2.1-1.5 3.6-1.5 1.3 0 2.4.4 3.3 1.2.9.8 1.5 1.8 1.8 3.1h-2.3c-.2-.6-.5-1.1-1-1.5-.5-.4-1.1-.6-1.7-.6-.8 0-1.5.3-2 .9-.5.6-.8 1.4-.8 2.4zM28 40h2.2l1-3h4.6l1 3h2.3l-4.3-12h-2.5L28 40zm4-5l1.5-4.6L35 35h-3zm11.5-5h-1.8l-2.5 7.8V28h-2v12h2l3.3-9.5 3.3 9.5h2V28h-2v7.8L43.5 30z"/>
                            </svg>
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
        <section class="companies-section companies-section--about">
            <div class="container">
                <h2 class="section-title section-title--center">Companies I've Worked With</h2>
                <p class="section-subtitle">Over the years, I've had the privilege of building infrastructure for these amazing companies</p>
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

        <div class="container container--narrow">
            <div class="about-cta">
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
