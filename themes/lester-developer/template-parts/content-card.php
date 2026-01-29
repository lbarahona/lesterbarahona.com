<?php
/**
 * Template part for displaying post cards
 *
 * @package Lester_Developer
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
    <a href="<?php the_permalink(); ?>" class="post-card__image">
        <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('large'); ?>
        <?php else : ?>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/default-post-image.svg" 
                 alt="<?php the_title_attribute(); ?>" 
                 class="post-card__default-image">
        <?php endif; ?>
    </a>

    <div class="post-card__content">
        <div class="post-card__meta">
            <?php
            $categories = get_the_category();
            if (!empty($categories)) :
            ?>
                <span class="post-card__category">
                    <?php echo esc_html($categories[0]->name); ?>
                </span>
            <?php endif; ?>
            <span class="post-card__date"><?php echo get_the_date(); ?></span>
            <span class="post-card__reading-time"><?php echo lester_developer_reading_time(); ?></span>
        </div>

        <h2 class="post-card__title" style="display: block !important; visibility: visible !important; opacity: 1 !important; color: #fff !important; font-size: 1.25rem !important; font-weight: 700 !important; margin-bottom: 0.5rem !important; line-height: 1.4 !important;">
            <a href="<?php the_permalink(); ?>" style="color: #fff !important; text-decoration: none !important; display: block !important;">
                <?php the_title(); ?>
            </a>
        </h2>

        <div class="post-card__excerpt">
            <?php the_excerpt(); ?>
        </div>

        <a href="<?php the_permalink(); ?>" class="post-card__read-more">
            Read more
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </a>
    </div>
</article>
