<?php
/**
 * The main template file
 *
 * @package Lester_Developer
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php if (is_front_page() && !is_paged()) : ?>
        <!-- Hero Section -->
        <section class="hero">
            <div class="container">
                <div class="hero-content">
                    <p class="hero-greeting">Hi, I'm</p>
                    <h1 class="hero-title">Lester Barahona</h1>
                    <p class="hero-subtitle">
                        Site Reliability Engineer with 20 years of experience building and scaling high-availability systems. 
                        I make complex infrastructure simple, reliable, and automated.
                    </p>
                    <div class="hero-cta">
                        <a href="<?php echo esc_url(home_url('/about/')); ?>" class="btn btn--primary">About Me</a>
                        <a href="https://github.com/lbarahona" class="btn btn--outline" target="_blank" rel="noopener">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                            </svg>
                            GitHub
                        </a>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- Posts Section -->
    <section class="posts-section">
        <div class="container">
            <?php if (is_front_page() && !is_paged()) : ?>
                <header class="section-header">
                    <h2 class="section-title">Latest Posts</h2>
                    <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="btn btn--outline">
                        View All
                    </a>
                </header>
            <?php endif; ?>

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
                // Pagination
                the_posts_pagination(array(
                    'mid_size'  => 2,
                    'prev_text' => '← Previous',
                    'next_text' => 'Next →',
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
