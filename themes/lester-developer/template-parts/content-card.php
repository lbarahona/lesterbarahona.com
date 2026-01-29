<?php
/**
 * Template part for displaying post cards
 *
 * @package Lester_Developer
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
    <?php if (has_post_thumbnail()) : ?>
        <a href="<?php the_permalink(); ?>" class="post-card__image">
            <?php the_post_thumbnail('large'); ?>
        </a>
    <?php else : ?>
        <a href="<?php the_permalink(); ?>" class="post-card__image">
            <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: var(--color-text-muted);">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                    <polyline points="21 15 16 10 5 21"></polyline>
                </svg>
            </div>
        </a>
    <?php endif; ?>

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

        <h2 class="post-card__title">
            <a href="<?php the_permalink(); ?>">
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
