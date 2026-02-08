<?php
/**
 * Template part: Company logos
 * Reusable across front-page, about, and index
 *
 * @package Lester_Developer
 */

$logos = array(
    array('name' => 'Microsoft',     'slug' => 'microsoft',     'url' => 'https://www.microsoft.com/'),
    array('name' => 'Starbucks',     'slug' => 'starbucks',     'url' => 'https://www.starbucks.com/'),
    array('name' => 'Meta',          'slug' => 'meta',          'url' => 'https://www.meta.com/'),
    array('name' => 'Fueled',        'slug' => 'fueled',        'url' => 'https://fueled.com/'),
    array('name' => 'Pinterest',     'slug' => 'pinterest',     'url' => 'https://www.pinterest.com/'),
    array('name' => 'InvestorPlace', 'slug' => 'investorplace', 'url' => 'https://investorplace.com/'),
    array('name' => 'Sandals Resorts', 'slug' => 'sandals',     'url' => 'https://www.sandals.com/'),
    array('name' => 'Beaches Resorts', 'slug' => 'beaches',     'url' => 'https://www.beaches.com/'),
);

$template_dir = get_template_directory_uri();
?>

<?php if (!empty($args['marquee'])) : ?>
<div class="companies-marquee">
    <?php foreach ($logos as $logo) : ?>
        <a href="<?php echo esc_url($logo['url']); ?>" target="_blank" rel="noopener noreferrer" class="company-logo" title="<?php echo esc_attr($logo['name']); ?>">
            <img src="<?php echo esc_url($template_dir . '/assets/images/logos/' . $logo['slug'] . '.svg'); ?>" alt="<?php echo esc_attr($logo['name']); ?>" loading="lazy">
        </a>
    <?php endforeach; ?>
    <?php /* Duplicate set for seamless marquee loop */ ?>
    <?php foreach ($logos as $logo) : ?>
        <a href="<?php echo esc_url($logo['url']); ?>" target="_blank" rel="noopener noreferrer" class="company-logo" title="<?php echo esc_attr($logo['name']); ?>" aria-hidden="true" tabindex="-1">
            <img src="<?php echo esc_url($template_dir . '/assets/images/logos/' . $logo['slug'] . '.svg'); ?>" alt="" loading="lazy">
        </a>
    <?php endforeach; ?>
</div>
<?php else : ?>
<div class="companies-grid">
    <?php foreach ($logos as $logo) : ?>
        <a href="<?php echo esc_url($logo['url']); ?>" target="_blank" rel="noopener noreferrer" class="company-logo" title="<?php echo esc_attr($logo['name']); ?>">
            <img src="<?php echo esc_url($template_dir . '/assets/images/logos/' . $logo['slug'] . '.svg'); ?>" alt="<?php echo esc_attr($logo['name']); ?>" loading="lazy">
        </a>
    <?php endforeach; ?>
</div>
<?php endif; ?>
