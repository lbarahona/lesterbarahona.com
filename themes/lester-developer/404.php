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
            <h1>404</h1>
            <h2>Page Not Found</h2>
            <p>The page you're looking for doesn't exist or has been moved.</p>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn--primary">
                Go Home
            </a>
        </div>
    </section>
</main>

<?php
get_footer();
