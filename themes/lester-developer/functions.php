<?php
/**
 * Lester Developer Theme Functions
 *
 * @package Lester_Developer
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme Setup
 */
function lester_developer_setup() {
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(1200, 675, true);

    register_nav_menus(array(
        'primary' => __('Primary Menu', 'lester-developer'),
        'footer'  => __('Footer Menu', 'lester-developer'),
    ));

    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');

    add_theme_support('custom-logo', array(
        'height'      => 50,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Editor color palette
    add_theme_support('editor-color-palette', array(
        array(
            'name'  => __('Primary Amber', 'lester-developer'),
            'slug'  => 'primary',
            'color' => '#f59e0b',
        ),
        array(
            'name'  => __('Accent Blue', 'lester-developer'),
            'slug'  => 'accent',
            'color' => '#2563eb',
        ),
        array(
            'name'  => __('Background', 'lester-developer'),
            'slug'  => 'background',
            'color' => '#fafafa',
        ),
        array(
            'name'  => __('Card Background', 'lester-developer'),
            'slug'  => 'card-bg',
            'color' => '#ffffff',
        ),
        array(
            'name'  => __('Text', 'lester-developer'),
            'slug'  => 'text',
            'color' => '#1a1a2e',
        ),
        array(
            'name'  => __('Muted Text', 'lester-developer'),
            'slug'  => 'text-muted',
            'color' => '#8888a0',
        ),
    ));
}
add_action('after_setup_theme', 'lester_developer_setup');

/**
 * Enqueue scripts and styles
 */
function lester_developer_scripts() {
    wp_enqueue_style(
        'lester-developer-style',
        get_stylesheet_uri(),
        array(),
        wp_get_theme()->get('Version')
    );

    // Google Fonts — Plus Jakarta Sans + Inter + JetBrains Mono
    wp_enqueue_style(
        'lester-developer-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400&family=Plus+Jakarta+Sans:wght@700;800&display=swap',
        array(),
        null
    );

    wp_enqueue_script(
        'lester-developer-navigation',
        get_template_directory_uri() . '/assets/js/navigation.js',
        array(),
        wp_get_theme()->get('Version'),
        true
    );

    wp_enqueue_script(
        'lester-developer-theme-toggle',
        get_template_directory_uri() . '/assets/js/theme-toggle.js',
        array(),
        wp_get_theme()->get('Version'),
        true
    );

    wp_enqueue_script(
        'lester-developer-scroll-reveal',
        get_template_directory_uri() . '/assets/js/scroll-reveal.js',
        array(),
        wp_get_theme()->get('Version'),
        true
    );

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'lester_developer_scripts');

/**
 * Custom excerpt length
 */
function lester_developer_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'lester_developer_excerpt_length');

/**
 * Custom excerpt more
 */
function lester_developer_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'lester_developer_excerpt_more');

/**
 * Add custom classes to body
 */
function lester_developer_body_classes($classes) {
    if (is_singular()) {
        $classes[] = 'singular';
    }
    $classes[] = 'no-sidebar';
    return $classes;
}
add_filter('body_class', 'lester_developer_body_classes');

/**
 * Remove sidebar widgets (we don't use them)
 */
function lester_developer_widgets_init() {
    // Intentionally empty - no sidebars in this theme
}
add_action('widgets_init', 'lester_developer_widgets_init');

/**
 * Disable search functionality
 */
function lester_developer_disable_search($query, $error = true) {
    if (is_search() && !is_admin()) {
        $query->is_search = false;
        $query->query_vars['s'] = false;
        $query->query['s'] = false;

        if ($error) {
            $query->is_404 = true;
        }
    }
}
add_action('parse_query', 'lester_developer_disable_search');

/**
 * Remove search form
 */
function lester_developer_remove_search_form($form) {
    return '';
}
add_filter('get_search_form', 'lester_developer_remove_search_form');

/**
 * Custom post navigation
 */
function lester_developer_post_navigation() {
    $prev_post = get_previous_post();
    $next_post = get_next_post();

    if (!$prev_post && !$next_post) {
        return;
    }

    echo '<nav class="post-navigation">';

    if ($prev_post) {
        echo '<a href="' . esc_url(get_permalink($prev_post)) . '" class="nav-previous">';
        echo '<span class="nav-label">&larr; Previous</span>';
        echo '<span class="nav-title">' . esc_html(get_the_title($prev_post)) . '</span>';
        echo '</a>';
    }

    if ($next_post) {
        echo '<a href="' . esc_url(get_permalink($next_post)) . '" class="nav-next">';
        echo '<span class="nav-label">Next &rarr;</span>';
        echo '<span class="nav-title">' . esc_html(get_the_title($next_post)) . '</span>';
        echo '</a>';
    }

    echo '</nav>';
}

/**
 * Get reading time estimate
 */
function lester_developer_reading_time($post_id = null) {
    $post_id = $post_id ?: get_the_ID();
    $content = get_post_field('post_content', $post_id);
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200);

    return $reading_time . ' min read';
}

/**
 * Custom comment callback
 */
function lester_developer_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    ?>
    <li <?php comment_class('comment'); ?> id="comment-<?php comment_ID(); ?>">
        <article class="comment-body">
            <header class="comment-meta">
                <?php echo get_avatar($comment, 40); ?>
                <div class="comment-author-info">
                    <span class="comment-author"><?php comment_author(); ?></span>
                    <time class="comment-date" datetime="<?php comment_time('c'); ?>">
                        <?php printf('%1$s at %2$s', get_comment_date(), get_comment_time()); ?>
                    </time>
                </div>
            </header>
            <div class="comment-content">
                <?php comment_text(); ?>
            </div>
            <?php
            comment_reply_link(array_merge($args, array(
                'depth'     => $depth,
                'max_depth' => $args['max_depth'],
                'before'    => '<div class="reply">',
                'after'     => '</div>',
            )));
            ?>
        </article>
    <?php
}

/**
 * Preload fonts
 */
function lester_developer_preload_fonts() {
    ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php
}
add_action('wp_head', 'lester_developer_preload_fonts', 1);

/**
 * Add meta tags
 */
function lester_developer_meta_tags() {
    ?>
    <meta name="theme-color" content="#fafafa" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#0f0f13" media="(prefers-color-scheme: dark)">
    <meta name="color-scheme" content="light dark">
    <?php
}
add_action('wp_head', 'lester_developer_meta_tags');

/**
 * Customizer settings for hero section
 */
function lester_developer_customize_register($wp_customize) {
    // Hero Section
    $wp_customize->add_section('hero_section', array(
        'title'    => __('Hero Section', 'lester-developer'),
        'priority' => 30,
    ));

    // Hero Image
    $wp_customize->add_setting('hero_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_image', array(
        'label'    => __('Hero Image', 'lester-developer'),
        'section'  => 'hero_section',
        'settings' => 'hero_image',
        'description' => __('Upload a professional photo. Recommended: square, 500x500px or larger. Will be displayed in a circle.', 'lester-developer'),
    )));
}
add_action('customize_register', 'lester_developer_customize_register');
