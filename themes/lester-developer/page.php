<?php
/**
 * Template for displaying pages
 *
 * @package Lester_Developer
 */

get_header();
?>

<main id="primary" class="site-main">
    <article id="post-<?php the_ID(); ?>" <?php post_class('page-content'); ?>>
        <div class="container container--narrow">
            <header class="page-header">
                <h1 class="page-title"><?php the_title(); ?></h1>
            </header>

            <div class="entry-content">
                <?php
                the_content();

                wp_link_pages(array(
                    'before' => '<div class="page-links">' . __('Pages:', 'lester-developer'),
                    'after'  => '</div>',
                ));
                ?>
            </div>

            <?php
            // Comments on pages (if enabled)
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
            ?>
        </div>
    </article>
</main>

<?php
get_footer();
