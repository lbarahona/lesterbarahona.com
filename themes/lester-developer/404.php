<?php
/**
 * Template for displaying 404 pages
 *
 * @package Lester_Developer
 */

get_header();
?>

<main id="primary" class="site-main">
    <section class="error-404">
        <div class="container container--narrow">
            <div class="error-404__code error-404__code--animated">404</div>
            <h2>Page Not Found</h2>
            <p class="error-404__subtitle">Looks like this page has been decommissioned.</p>

            <div class="error-404__links">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="error-404__link">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    Home
                </a>
                <a href="<?php echo esc_url(home_url('/about/')); ?>" class="error-404__link">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    About
                </a>
                <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="error-404__link">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                        <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                    </svg>
                    Blog
                </a>
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="error-404__link">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                    Contact
                </a>
            </div>

            <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn--primary btn--large">
                Back to Home
            </a>
        </div>
    </section>
</main>

<?php
get_footer();
