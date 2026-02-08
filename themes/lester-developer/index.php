<?php
/**
 * The main template file — blog listing
 *
 * @package Lester_Developer
 */

get_header();
?>

<main id="primary" class="site-main">
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
                    'prev_text' => '&larr; Previous',
                    'next_text' => 'Next &rarr;',
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
</main>

<?php
get_footer();
