<?php
/**
 * Plugin Name: Content Cleanup
 * Description: Cleans up content by replacing em-dashes with proper punctuation
 * Author: Lester Barahona
 * Version: 1.1.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Replace em-dashes with appropriate punctuation in content
 * Makes text more natural and readable
 */
function lester_cleanup_em_dashes($content) {
    if (empty($content)) {
        return $content;
    }
    
    // All types of em-dashes and en-dashes
    $dashes = [
        '—',  // em-dash (U+2014)
        '–',  // en-dash (U+2013)
        '‒',  // figure dash (U+2012)
        '―',  // horizontal bar (U+2015)
        '&mdash;',  // HTML entity
        '&ndash;',  // HTML entity
        '&#8212;',  // Numeric entity em-dash
        '&#8211;',  // Numeric entity en-dash
    ];
    
    // Replace dashes with context-aware punctuation
    foreach ($dashes as $dash) {
        // Pattern: word — word (surrounded by spaces)
        $content = preg_replace('/\s*' . preg_quote($dash, '/') . '\s*/', '. ', $content);
    }
    
    // Clean up any double periods
    $content = preg_replace('/\.(\s*)\./', '.', $content);
    
    // Clean up period followed by comma
    $content = preg_replace('/\.\s*,/', ',', $content);
    
    // Clean up multiple spaces
    $content = preg_replace('/\s+/', ' ', $content);
    
    // Capitalize letter after period (sentence start)
    $content = preg_replace_callback('/\.\s+([a-z])/', function($matches) {
        return '. ' . strtoupper($matches[1]);
    }, $content);
    
    // Fix any awkward ". ." patterns
    $content = str_replace('. .', '.', $content);
    
    // Trim extra whitespace
    $content = trim($content);
    
    return $content;
}

// Apply to post/page content (high priority to run early)
add_filter('the_content', 'lester_cleanup_em_dashes', 1);

// Apply to excerpts
add_filter('the_excerpt', 'lester_cleanup_em_dashes', 1);
add_filter('get_the_excerpt', 'lester_cleanup_em_dashes', 1);

// Apply to titles
add_filter('the_title', 'lester_cleanup_em_dashes', 1);

// Apply to widget text
add_filter('widget_text', 'lester_cleanup_em_dashes', 1);
add_filter('widget_text_content', 'lester_cleanup_em_dashes', 1);

// Apply to comments
add_filter('comment_text', 'lester_cleanup_em_dashes', 1);

// Apply to post meta
add_filter('the_meta_key', 'lester_cleanup_em_dashes', 1);

/**
 * Also clean up page titles in browser
 */
function lester_cleanup_document_title($title) {
    if (is_array($title)) {
        foreach ($title as $key => $value) {
            if (is_string($value)) {
                $title[$key] = lester_cleanup_em_dashes($value);
            }
        }
        return $title;
    }
    return lester_cleanup_em_dashes($title);
}
add_filter('document_title_parts', 'lester_cleanup_document_title', 1);
add_filter('wp_title', 'lester_cleanup_em_dashes', 1);
