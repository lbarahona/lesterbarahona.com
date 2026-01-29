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
        <section class="companies-section companies-section--about">
            <div class="container">
                <h2 class="section-title section-title--center">Companies I've Worked With</h2>
                <p class="section-subtitle">Over the years, I've had the privilege of building infrastructure for these amazing companies</p>
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
