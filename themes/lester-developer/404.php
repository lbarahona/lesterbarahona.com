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
            <h2>This page has better uptime than your production cluster.</h2>
            <p class="error-404__subtitle">Just kidding. It's a 404. The page you wanted doesn't exist, got deleted, or was never here in the first place. That's a 100% miss rate. Even your monitoring doesn't catch everything.</p>

            <div class="error-404__links">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="error-404__link">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    Go home
                </a>
                <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="error-404__link">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                        <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                    </svg>
                    Read the blog instead
                </a>
            </div>

            <p class="error-404__footer-text">No incident report will be filed for this one.</p>
        </div>
    </section>
</main>

<?php
get_footer();
