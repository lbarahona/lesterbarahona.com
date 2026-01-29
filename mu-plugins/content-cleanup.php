<?php
/**
 * Plugin Name: Content Cleanup
 * Description: Cleans up content by replacing em-dashes with proper punctuation
 * Author: Lester Barahona
 * Version: 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Replace em-dashes with appropriate punctuation in content
 */
function lester_cleanup_em_dashes($content) {
    // Common patterns where em-dash is used
    $replacements = [
        // Em-dash used as a pause/break - replace with period or comma
        ' — ' => '. ',  // Default: replace with period and space
        '— '  => '. ',  // Em-dash at start of clause
        ' —'  => '.',   // Em-dash at end
    ];
    
    // Apply replacements
    $content = str_replace(array_keys($replacements), array_values($replacements), $content);
    
    // Clean up any double periods or awkward spacing
    $content = preg_replace('/\.\s*\./', '.', $content);
    $content = preg_replace('/\s+/', ' ', $content);
    
    // Fix cases where the replacement created awkward sentences
    // "It was a natural evolution. I'd" -> keep as is (good)
    // "challenge. if I had" -> "challenge. If I had" (capitalize after period)
    $content = preg_replace_callback('/\.\s+([a-z])/', function($matches) {
        return '. ' . strtoupper($matches[1]);
    }, $content);
    
    return $content;
}

// Apply to post content
add_filter('the_content', 'lester_cleanup_em_dashes', 5);

// Apply to excerpts
add_filter('the_excerpt', 'lester_cleanup_em_dashes', 5);

// Apply to widget text
add_filter('widget_text', 'lester_cleanup_em_dashes', 5);
