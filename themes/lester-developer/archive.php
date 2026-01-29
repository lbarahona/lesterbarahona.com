<?php
/**
 * Template for displaying archive pages
 *
 * @package Lester_Developer
 */

get_header();
?>

<main id="primary" class="site-main">
    <header class="archive-header">
        <div class="container">
            <?php
            the_archive_title('<h1 class="archive-title">', '</h1>');
            the_archive_description('<div class="archive-description">', '</div>');
            ?>
        </div>
    </header>

    <section class="posts-section">
        <div class="container">
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
                    <h2>No posts found</h2>
                    <p>No posts match your criteria.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php
get_footer();
