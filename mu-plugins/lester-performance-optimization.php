<?php
/**
 * Lester's Performance Optimization Plugin
 *
 * Advanced performance optimizations for WordPress tailored for SRE needs.
 * Must-Use Plugin for automatic activation.
 *
 * @package Lester_Performance
 * @version 1.0.0
 * @author  Toribio (Lester's AI Assistant)
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class LesterPerformanceOptimization
 * 
 * Comprehensive performance optimizations for WordPress
 */
class LesterPerformanceOptimization {
    
    public function __construct() {
        add_action('init', array($this, 'init'));
        add_action('wp_enqueue_scripts', array($this, 'optimize_assets'), 999);
        add_action('wp_head', array($this, 'add_performance_headers'), 1);
        add_action('template_redirect', array($this, 'setup_caching_headers'));
        add_filter('script_loader_tag', array($this, 'add_async_defer_attributes'), 10, 3);
        add_filter('style_loader_tag', array($this, 'optimize_css_delivery'), 10, 2);
        
        // Database optimizations
        add_action('wp_loaded', array($this, 'optimize_database_queries'));
        
        // Security headers
        add_action('send_headers', array($this, 'add_security_headers'));
        
        // Cleanup and optimization
        $this->cleanup_wordpress();
        
        // Add monitoring endpoints
        add_action('init', array($this, 'add_monitoring_endpoints'));
    }
    
    /**
     * Initialize plugin
     */
    public function init() {
        // Remove query strings from static resources
        add_filter('script_loader_src', array($this, 'remove_query_strings'), 15, 1);
        add_filter('style_loader_src', array($this, 'remove_query_strings'), 15, 1);
        
        // Optimize heartbeat
        add_filter('heartbeat_settings', array($this, 'optimize_heartbeat'));
        
        // Disable unnecessary features
        $this->disable_unnecessary_features();
    }
    
    /**
     * Add performance-related headers
     */
    public function add_performance_headers() {
        ?>
        <!-- Performance Optimization Headers -->
        <link rel="dns-prefetch" href="//fonts.googleapis.com">
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        
        <!-- Critical Resource Hints -->
        <link rel="prefetch" href="<?php echo esc_url(get_stylesheet_uri()); ?>">
        
        <!-- Viewport and Performance Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="x-dns-prefetch-control" content="on">
        
        <!-- Performance Monitoring -->
        <script>
        // Performance monitoring for SRE
        window.addEventListener('load', function() {
            if ('performance' in window) {
                var perfData = performance.timing;
                var pageLoadTime = perfData.loadEventEnd - perfData.navigationStart;
                var domContentLoadedTime = perfData.domContentLoadedEventEnd - perfData.navigationStart;
                
                // Log performance data to console (can be sent to monitoring)
                console.log('Page Load Time:', pageLoadTime + 'ms');
                console.log('DOM Content Loaded:', domContentLoadedTime + 'ms');
                
                // Send to monitoring endpoint if needed
                if (pageLoadTime > 3000) { // Alert if page load > 3s
                    console.warn('Slow page load detected:', pageLoadTime + 'ms');
                }
            }
        });
        </script>
        <?php
    }
    
    /**
     * Setup caching headers
     */
    public function setup_caching_headers() {
        if (is_admin()) {
            return;
        }
        
        // Set cache headers based on content type
        if (is_front_page()) {
            // Homepage - cache for 5 minutes
            header('Cache-Control: public, max-age=300, s-maxage=300');
        } elseif (is_single() || is_page()) {
            // Posts and pages - cache for 1 hour
            header('Cache-Control: public, max-age=3600, s-maxage=3600');
        } elseif (is_archive()) {
            // Archives - cache for 30 minutes
            header('Cache-Control: public, max-age=1800, s-maxage=1800');
        }
        
        // Add ETag for better caching
        $etag = md5(get_the_modified_date() . get_the_modified_time());
        header('ETag: "' . $etag . '"');
        
        // Handle conditional requests
        if (isset($_SERVER['HTTP_IF_NONE_MATCH']) && $_SERVER['HTTP_IF_NONE_MATCH'] === '"' . $etag . '"') {
            http_response_code(304);
            exit;
        }
    }
    
    /**
     * Add security headers
     */
    public function add_security_headers() {
        if (is_admin()) {
            return;
        }
        
        // Security headers for production
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: SAMEORIGIN');
        header('X-XSS-Protection: 1; mode=block');
        header('Referrer-Policy: strict-origin-when-cross-origin');
        header('Permissions-Policy: camera=(), microphone=(), geolocation=()');
        
        // Content Security Policy for blog
        $csp = "default-src 'self'; " .
               "script-src 'self' 'unsafe-inline' fonts.googleapis.com; " .
               "style-src 'self' 'unsafe-inline' fonts.googleapis.com; " .
               "font-src 'self' fonts.gstatic.com; " .
               "img-src 'self' data: https:; " .
               "connect-src 'self';";
        
        header('Content-Security-Policy: ' . $csp);
    }
    
    /**
     * Optimize asset loading
     */
    public function optimize_assets() {
        // Remove unnecessary default WordPress scripts/styles
        if (!is_admin()) {
            wp_deregister_script('wp-embed');
            wp_dequeue_style('wp-block-library');
            wp_dequeue_style('wp-block-library-theme');
            wp_dequeue_style('wc-block-style'); // WooCommerce blocks if present
            wp_dequeue_style('global-styles');
            
            // Remove emoji scripts
            remove_action('wp_head', 'print_emoji_detection_script', 7);
            remove_action('wp_print_styles', 'print_emoji_styles');
        }
    }
    
    /**
     * Add async/defer to scripts
     */
    public function add_async_defer_attributes($tag, $handle, $src) {
        // Don't add async/defer to admin or if no src
        if (is_admin() || !$src) {
            return $tag;
        }
        
        // Scripts that should be deferred
        $defer_scripts = array(
            'lester-developer-navigation',
            'comment-reply'
        );
        
        // Scripts that should be async
        $async_scripts = array();
        
        if (in_array($handle, $defer_scripts)) {
            return str_replace('<script ', '<script defer ', $tag);
        }
        
        if (in_array($handle, $async_scripts)) {
            return str_replace('<script ', '<script async ', $tag);
        }
        
        return $tag;
    }
    
    /**
     * Optimize CSS delivery
     */
    public function optimize_css_delivery($tag, $handle) {
        // Don't optimize admin styles
        if (is_admin()) {
            return $tag;
        }
        
        // Critical CSS handles that should load immediately
        $critical_styles = array(
            'lester-developer-style',
            'lester-developer-fonts'
        );
        
        // Non-critical styles can be loaded asynchronously
        if (!in_array($handle, $critical_styles)) {
            $tag = str_replace('rel="stylesheet"', 'rel="preload" as="style" onload="this.onload=null;this.rel=\'stylesheet\'"', $tag);
            $tag .= '<noscript>' . str_replace('rel="preload" as="style" onload="this.onload=null;this.rel=\'stylesheet\'"', 'rel="stylesheet"', $tag) . '</noscript>';
        }
        
        return $tag;
    }
    
    /**
     * Remove query strings from static resources
     */
    public function remove_query_strings($src) {
        if (strpos($src, '?ver=')) {
            $src = remove_query_arg('ver', $src);
        }
        return $src;
    }
    
    /**
     * Optimize WordPress heartbeat
     */
    public function optimize_heartbeat($settings) {
        // Slow down heartbeat to reduce server load
        $settings['interval'] = 60; // 60 seconds instead of default 15-60
        return $settings;
    }
    
    /**
     * Database query optimizations
     */
    public function optimize_database_queries() {
        // Limit post revisions
        if (!defined('WP_POST_REVISIONS')) {
            define('WP_POST_REVISIONS', 3);
        }
        
        // Optimize database queries
        add_filter('posts_request', function($query) {
            // Add SQL_NO_CACHE for better performance monitoring
            if (!is_admin() && !str_contains($query, 'SQL_NO_CACHE')) {
                $query = str_replace('SELECT', 'SELECT SQL_NO_CACHE', $query);
            }
            return $query;
        });
    }
    
    /**
     * Disable unnecessary WordPress features
     */
    private function disable_unnecessary_features() {
        // Disable XML-RPC
        add_filter('xmlrpc_enabled', '__return_false');
        
        // Disable REST API for non-admin users if not needed
        add_filter('rest_authentication_errors', function($result) {
            if (!is_user_logged_in()) {
                return new WP_Error('rest_disabled', 'REST API is disabled for unauthenticated users.', array('status' => 401));
            }
            return $result;
        });
        
        // Remove unnecessary meta tags
        remove_action('wp_head', 'wp_generator');
        remove_action('wp_head', 'wlwmanifest_link');
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wp_shortlink_wp_head');
        
        // Disable unnecessary features
        add_filter('show_admin_bar', '__return_false');
        
        // Clean up <head>
        remove_action('wp_head', 'feed_links_extra', 3);
        remove_action('wp_head', 'feed_links', 2);
        remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);
    }
    
    /**
     * WordPress cleanup
     */
    private function cleanup_wordpress() {
        // Auto-delete spam and trash comments older than 30 days
        add_action('wp_scheduled_delete', function() {
            global $wpdb;
            
            // Delete spam comments older than 30 days
            $wpdb->query("DELETE FROM {$wpdb->comments} WHERE comment_approved = 'spam' AND comment_date < DATE_SUB(NOW(), INTERVAL 30 DAY)");
            
            // Delete trash comments older than 30 days
            $wpdb->query("DELETE FROM {$wpdb->comments} WHERE comment_approved = 'trash' AND comment_date < DATE_SUB(NOW(), INTERVAL 30 DAY)");
            
            // Optimize database tables
            $wpdb->query("OPTIMIZE TABLE {$wpdb->posts}");
            $wpdb->query("OPTIMIZE TABLE {$wpdb->comments}");
            $wpdb->query("OPTIMIZE TABLE {$wpdb->options}");
        });
        
        // Clean up post revisions older than 30 days
        add_action('wp_scheduled_delete', function() {
            global $wpdb;
            $wpdb->query("DELETE FROM {$wpdb->posts} WHERE post_type = 'revision' AND post_date < DATE_SUB(NOW(), INTERVAL 30 DAY)");
        });
    }
    
    /**
     * Add monitoring endpoints for SRE
     */
    public function add_monitoring_endpoints() {
        // Health check endpoint
        add_action('wp_ajax_nopriv_health', array($this, 'health_check'));
        add_action('wp_ajax_health', array($this, 'health_check'));
        
        // Performance metrics endpoint
        add_action('wp_ajax_nopriv_metrics', array($this, 'performance_metrics'));
        add_action('wp_ajax_metrics', array($this, 'performance_metrics'));
    }
    
    /**
     * Health check endpoint
     */
    public function health_check() {
        // Check database connectivity
        global $wpdb;
        $db_status = $wpdb->get_var("SELECT 1");
        
        // Check WordPress core
        $wp_status = function_exists('wp_version_check');
        
        $health = array(
            'status' => 'healthy',
            'timestamp' => current_time('timestamp'),
            'checks' => array(
                'database' => $db_status ? 'ok' : 'error',
                'wordpress' => $wp_status ? 'ok' : 'error',
                'php_version' => PHP_VERSION,
                'wp_version' => get_bloginfo('version'),
                'memory_usage' => memory_get_usage(true),
                'memory_peak' => memory_get_peak_usage(true),
            )
        );
        
        // If any checks fail, mark as unhealthy
        if (in_array('error', $health['checks'])) {
            $health['status'] = 'unhealthy';
            http_response_code(503);
        }
        
        wp_send_json($health);
    }
    
    /**
     * Performance metrics endpoint
     */
    public function performance_metrics() {
        global $wpdb;
        
        $metrics = array(
            'timestamp' => current_time('timestamp'),
            'database' => array(
                'queries' => $wpdb->num_queries,
                'query_time' => timer_stop(0, 3),
            ),
            'memory' => array(
                'current' => memory_get_usage(true),
                'peak' => memory_get_peak_usage(true),
                'limit' => ini_get('memory_limit'),
            ),
            'cache' => array(
                'object_cache' => wp_using_ext_object_cache() ? 'enabled' : 'disabled',
                'opcache' => function_exists('opcache_get_status') ? 'enabled' : 'disabled',
            ),
            'posts' => array(
                'total' => wp_count_posts()->publish,
                'comments' => wp_count_comments()->approved,
            ),
        );
        
        wp_send_json($metrics);
    }
}

// Initialize the performance optimization
new LesterPerformanceOptimization();

// Additional performance constants
if (!defined('WP_CACHE_KEY_SALT')) {
    define('WP_CACHE_KEY_SALT', 'lester_blog_' . ABSPATH);
}

// Optimize WordPress for production
if (!defined('WP_DEBUG')) {
    define('WP_DEBUG', false);
}

if (!defined('WP_DEBUG_LOG')) {
    define('WP_DEBUG_LOG', false);
}

if (!defined('WP_DEBUG_DISPLAY')) {
    define('WP_DEBUG_DISPLAY', false);
}

// Memory optimization
if (!defined('WP_MEMORY_LIMIT')) {
    define('WP_MEMORY_LIMIT', '256M');
}

/**
 * Log performance issues for monitoring
 */
function lester_log_performance_issue($message, $data = array()) {
    if (defined('WP_DEBUG') && WP_DEBUG) {
        error_log('PERFORMANCE ISSUE: ' . $message . ' - Data: ' . print_r($data, true));
    }
}

/**
 * Monitor slow queries
 */
add_filter('query', function($query) {
    global $wpdb;
    
    $start_time = microtime(true);
    
    add_filter('posts_request', function($query_result) use ($start_time, $query) {
        $end_time = microtime(true);
        $execution_time = ($end_time - $start_time) * 1000; // Convert to milliseconds
        
        // Log slow queries (>500ms)
        if ($execution_time > 500) {
            lester_log_performance_issue('Slow Query Detected', array(
                'execution_time' => $execution_time . 'ms',
                'query' => $query,
                'url' => $_SERVER['REQUEST_URI'] ?? 'unknown'
            ));
        }
        
        return $query_result;
    });
    
    return $query;
});

/**
 * Add performance timing to admin bar for logged-in users
 */
add_action('admin_bar_menu', function($wp_admin_bar) {
    if (!current_user_can('manage_options')) {
        return;
    }
    
    global $wpdb;
    $page_load_time = timer_stop(0, 3);
    $memory_usage = size_format(memory_get_peak_usage(true));
    
    $wp_admin_bar->add_node(array(
        'id'    => 'performance_stats',
        'title' => sprintf('⚡ %ss | %s | %d queries', $page_load_time, $memory_usage, $wpdb->num_queries),
        'href'  => false,
    ));
}, 999);