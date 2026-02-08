<?php
/**
 * Template for displaying single posts
 *
 * @package Lester_Developer
 */

get_header();
?>

<main id="primary" class="site-main">
    <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
        <div class="container container--narrow">
            <header class="post-header">
                <div class="post-header__meta">
                    <?php
                    $categories = get_the_category();
                    if (!empty($categories)) :
                    ?>
                        <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>" class="post-header__category">
                            <?php echo esc_html($categories[0]->name); ?>
                        </a>
                    <?php endif; ?>
                    <span class="post-header__date"><?php echo get_the_date(); ?></span>
                    <span>&middot;</span>
                    <span class="post-header__reading-time"><?php echo lester_developer_reading_time(); ?></span>
                </div>

                <h1 class="post-header__title"><?php the_title(); ?></h1>

                <?php if (has_excerpt()) : ?>
                    <p class="post-header__excerpt"><?php echo get_the_excerpt(); ?></p>
                <?php endif; ?>
            </header>
        </div>

        <?php if (has_post_thumbnail()) : ?>
            <div class="post-featured-image">
                <div class="container">
                    <?php the_post_thumbnail('full'); ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="container container--narrow">
            <div class="post-content">
                <?php
                the_content();

                wp_link_pages(array(
                    'before' => '<div class="page-links">' . __('Pages:', 'lester-developer'),
                    'after'  => '</div>',
                ));
                ?>
            </div>

            <footer class="post-footer">
                <?php
                $tags = get_the_tags();
                if ($tags) :
                ?>
                    <div class="post-tags">
                        <?php foreach ($tags as $tag) : ?>
                            <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="post-tag">
                                #<?php echo esc_html($tag->name); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php lester_developer_post_navigation(); ?>
            </footer>

            <?php
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
            ?>
        </div>
    </article>
</main>

<?php
get_footer();
