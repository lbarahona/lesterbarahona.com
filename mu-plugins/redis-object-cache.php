<?php
/**
 * Redis Object Cache Implementation
 *
 * High-performance Redis-based object cache for WordPress
 * Integrates with the Redis instance running in Kubernetes
 *
 * @package Lester_Redis_Cache
 * @version 1.0.0
 * @author  Toribio (Lester's AI Assistant)
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Redis Object Cache Drop-in replacement for WordPress
 */
class LesterRedisObjectCache {
    
    private $redis;
    private $connected = false;
    private $cache_prefix;
    private $default_expiration = 3600; // 1 hour
    private $stats = array(
        'hits' => 0,
        'misses' => 0,
        'sets' => 0,
        'deletes' => 0,
    );
    
    public function __construct() {
        $this->cache_prefix = $this->get_cache_prefix();
        $this->connect();
        
        // Add hooks for cache management
        add_action('init', array($this, 'init_cache_hooks'));
        add_action('wp_footer', array($this, 'show_cache_stats'));
    }
    
    /**
     * Connect to Redis
     */
    private function connect() {
        if (!class_exists('Redis')) {
            return false;
        }
        
        try {
            $this->redis = new Redis();
            
            // Try to connect to Redis service in Kubernetes
            $redis_host = getenv('REDIS_HOST') ?: 'redis.lbarahona-blog.svc.cluster.local';
            $redis_port = getenv('REDIS_PORT') ?: 6379;
            $redis_password = getenv('REDIS_PASSWORD') ?: '';
            
            $this->redis->connect($redis_host, $redis_port, 5); // 5 second timeout
            
            if ($redis_password) {
                $this->redis->auth($redis_password);
            }
            
            // Test connection
            $this->redis->ping();
            $this->connected = true;
            
            // Configure Redis for optimal WordPress performance
            $this->redis->setOption(Redis::OPT_SERIALIZER, Redis::SERIALIZER_IGBINARY);
            $this->redis->setOption(Redis::OPT_COMPRESSION, Redis::COMPRESSION_LZ4);
            
            return true;
            
        } catch (Exception $e) {
            $this->connected = false;
            error_log('Redis connection failed: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Get cache prefix
     */
    private function get_cache_prefix() {
        $prefix = 'wp_';
        
        if (defined('WP_CACHE_KEY_SALT')) {
            $prefix = WP_CACHE_KEY_SALT . '_';
        }
        
        // Include site URL in prefix for multisite compatibility
        $prefix .= md5(get_option('siteurl')) . '_';
        
        return $prefix;
    }
    
    /**
     * Initialize cache hooks
     */
    public function init_cache_hooks() {
        // Clear cache when posts are updated
        add_action('save_post', array($this, 'clear_post_cache'));
        add_action('delete_post', array($this, 'clear_post_cache'));
        
        // Clear cache when comments are updated
        add_action('wp_insert_comment', array($this, 'clear_comment_cache'));
        add_action('wp_delete_comment', array($this, 'clear_comment_cache'));
        add_action('wp_set_comment_status', array($this, 'clear_comment_cache'));
        
        // Clear cache when options are updated
        add_action('updated_option', array($this, 'clear_options_cache'));
        
        // Clear transients cache
        add_action('delete_transient', array($this, 'clear_transient_cache'));
        add_action('set_transient', array($this, 'clear_transient_cache'));
    }
    
    /**
     * Get cached object
     */
    public function get($key, $group = 'default') {
        if (!$this->connected) {
            return false;
        }
        
        $cache_key = $this->build_key($key, $group);
        
        try {
            $value = $this->redis->get($cache_key);
            
            if ($value !== false) {
                $this->stats['hits']++;
                return maybe_unserialize($value);
            } else {
                $this->stats['misses']++;
                return false;
            }
        } catch (Exception $e) {
            error_log('Redis get error: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Set cached object
     */
    public function set($key, $value, $group = 'default', $expiration = 0) {
        if (!$this->connected) {
            return false;
        }
        
        if ($expiration <= 0) {
            $expiration = $this->get_expiration_time($group);
        }
        
        $cache_key = $this->build_key($key, $group);
        $serialized_value = maybe_serialize($value);
        
        try {
            $result = $this->redis->setex($cache_key, $expiration, $serialized_value);
            
            if ($result) {
                $this->stats['sets']++;
                return true;
            }
            return false;
            
        } catch (Exception $e) {
            error_log('Redis set error: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Delete cached object
     */
    public function delete($key, $group = 'default') {
        if (!$this->connected) {
            return false;
        }
        
        $cache_key = $this->build_key($key, $group);
        
        try {
            $result = $this->redis->del($cache_key);
            
            if ($result) {
                $this->stats['deletes']++;
                return true;
            }
            return false;
            
        } catch (Exception $e) {
            error_log('Redis delete error: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Flush all cache
     */
    public function flush() {
        if (!$this->connected) {
            return false;
        }
        
        try {
            // Only flush keys with our prefix to avoid affecting other applications
            $pattern = $this->cache_prefix . '*';
            $keys = $this->redis->keys($pattern);
            
            if (!empty($keys)) {
                return $this->redis->del($keys);
            }
            return true;
            
        } catch (Exception $e) {
            error_log('Redis flush error: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Build cache key
     */
    private function build_key($key, $group) {
        return $this->cache_prefix . $group . '_' . $key;
    }
    
    /**
     * Get expiration time based on group
     */
    private function get_expiration_time($group) {
        $expirations = array(
            'posts'     => 3600,  // 1 hour
            'comments'  => 1800,  // 30 minutes
            'options'   => 7200,  // 2 hours
            'themes'    => 86400, // 24 hours
            'plugins'   => 86400, // 24 hours
            'users'     => 3600,  // 1 hour
            'transient' => 3600,  // 1 hour
            'default'   => $this->default_expiration,
        );
        
        return isset($expirations[$group]) ? $expirations[$group] : $this->default_expiration;
    }
    
    /**
     * Clear post-related cache
     */
    public function clear_post_cache($post_id) {
        if (!$this->connected) {
            return;
        }
        
        // Clear specific post cache
        $this->delete($post_id, 'posts');
        $this->delete('post_' . $post_id, 'posts');
        
        // Clear related caches
        $this->flush_group('posts');
        $this->flush_group('post_meta');
        
        // Clear front page cache if this is a published post
        $post = get_post($post_id);
        if ($post && $post->post_status === 'publish') {
            $this->delete('front_page', 'posts');
            $this->flush_group('queries');
        }
    }
    
    /**
     * Clear comment-related cache
     */
    public function clear_comment_cache($comment_id) {
        if (!$this->connected) {
            return;
        }
        
        $comment = get_comment($comment_id);
        if ($comment) {
            // Clear post cache that contains this comment
            $this->clear_post_cache($comment->comment_post_ID);
        }
        
        $this->flush_group('comments');
    }
    
    /**
     * Clear options cache
     */
    public function clear_options_cache($option_name) {
        if (!$this->connected) {
            return;
        }
        
        $this->delete($option_name, 'options');
        
        // Clear all options if it's a critical option
        $critical_options = array('active_plugins', 'template', 'stylesheet');
        if (in_array($option_name, $critical_options)) {
            $this->flush_group('options');
        }
    }
    
    /**
     * Clear transient cache
     */
    public function clear_transient_cache($transient) {
        if (!$this->connected) {
            return;
        }
        
        $this->delete($transient, 'transient');
    }
    
    /**
     * Flush entire cache group
     */
    private function flush_group($group) {
        if (!$this->connected) {
            return;
        }
        
        try {
            $pattern = $this->cache_prefix . $group . '_*';
            $keys = $this->redis->keys($pattern);
            
            if (!empty($keys)) {
                $this->redis->del($keys);
            }
        } catch (Exception $e) {
            error_log('Redis flush group error: ' . $e->getMessage());
        }
    }
    
    /**
     * Get cache statistics
     */
    public function get_stats() {
        $stats = $this->stats;
        $stats['connected'] = $this->connected;
        
        if ($this->connected) {
            try {
                $info = $this->redis->info();
                $stats['redis_memory'] = isset($info['used_memory_human']) ? $info['used_memory_human'] : 'unknown';
                $stats['redis_keys'] = $this->redis->dbSize();
            } catch (Exception $e) {
                $stats['redis_memory'] = 'error';
                $stats['redis_keys'] = 'error';
            }
        }
        
        return $stats;
    }
    
    /**
     * Show cache stats for admins
     */
    public function show_cache_stats() {
        if (!current_user_can('manage_options') || is_admin()) {
            return;
        }
        
        $stats = $this->get_stats();
        $hit_ratio = $stats['hits'] + $stats['misses'] > 0 
            ? round(($stats['hits'] / ($stats['hits'] + $stats['misses'])) * 100, 1) 
            : 0;
        
        ?>
        <!-- Redis Cache Stats -->
        <script>
        console.log('Redis Cache Stats:', {
            connected: <?php echo $stats['connected'] ? 'true' : 'false'; ?>,
            hits: <?php echo $stats['hits']; ?>,
            misses: <?php echo $stats['misses']; ?>,
            hit_ratio: '<?php echo $hit_ratio; ?>%',
            sets: <?php echo $stats['sets']; ?>,
            deletes: <?php echo $stats['deletes']; ?>,
            redis_memory: '<?php echo isset($stats['redis_memory']) ? $stats['redis_memory'] : 'N/A'; ?>',
            redis_keys: <?php echo isset($stats['redis_keys']) ? $stats['redis_keys'] : 0; ?>
        });
        </script>
        <?php
        
        // Add to admin bar
        add_action('admin_bar_menu', function($wp_admin_bar) use ($stats, $hit_ratio) {
            $wp_admin_bar->add_node(array(
                'id'    => 'redis_cache_stats',
                'title' => sprintf('🔴 Redis: %s%% hit ratio | %d keys', $hit_ratio, isset($stats['redis_keys']) ? $stats['redis_keys'] : 0),
                'href'  => false,
            ));
        }, 1000);
    }
}

// Initialize Redis Object Cache
$redis_cache = new LesterRedisObjectCache();

/**
 * WordPress Object Cache API compatibility
 */
if (!function_exists('wp_cache_get')) {
    function wp_cache_get($key, $group = '') {
        global $redis_cache;
        return $redis_cache->get($key, $group);
    }
}

if (!function_exists('wp_cache_set')) {
    function wp_cache_set($key, $data, $group = '', $expire = 0) {
        global $redis_cache;
        return $redis_cache->set($key, $data, $group, $expire);
    }
}

if (!function_exists('wp_cache_delete')) {
    function wp_cache_delete($key, $group = '') {
        global $redis_cache;
        return $redis_cache->delete($key, $group);
    }
}

if (!function_exists('wp_cache_flush')) {
    function wp_cache_flush() {
        global $redis_cache;
        return $redis_cache->flush();
    }
}

if (!function_exists('wp_cache_add')) {
    function wp_cache_add($key, $data, $group = '', $expire = 0) {
        global $redis_cache;
        // Only add if key doesn't exist
        if ($redis_cache->get($key, $group) === false) {
            return $redis_cache->set($key, $data, $group, $expire);
        }
        return false;
    }
}

if (!function_exists('wp_cache_replace')) {
    function wp_cache_replace($key, $data, $group = '', $expire = 0) {
        global $redis_cache;
        // Only replace if key exists
        if ($redis_cache->get($key, $group) !== false) {
            return $redis_cache->set($key, $data, $group, $expire);
        }
        return false;
    }
}

// Advanced caching for expensive queries
add_action('init', function() {
    // Cache expensive queries
    add_filter('posts_request', function($query, $wp_query) {
        if (is_admin() || empty($query)) {
            return $query;
        }
        
        // Create a cache key based on the query
        $cache_key = 'query_' . md5($query);
        
        // Try to get from cache
        $cached_result = wp_cache_get($cache_key, 'queries');
        if ($cached_result !== false) {
            // Return cached result - we need to modify the query to return our cached data
            global $wpdb;
            $wpdb->last_result = $cached_result;
            return $query;
        }
        
        // Cache the result after the query executes
        add_filter('posts_results', function($posts, $wp_query) use ($cache_key, $query) {
            if (!is_admin() && !empty($posts)) {
                wp_cache_set($cache_key, $posts, 'queries', 300); // Cache for 5 minutes
            }
            return $posts;
        }, 10, 2);
        
        return $query;
    }, 10, 2);
});

/**
 * Preload critical cache on WordPress init
 */
add_action('wp_loaded', function() {
    // Preload front page content
    if (is_front_page() && !wp_cache_get('front_page_preloaded', 'preload')) {
        // Preload recent posts
        $recent_posts = wp_cache_get('recent_posts_5', 'posts');
        if ($recent_posts === false) {
            $recent_posts = get_posts(array('numberposts' => 5));
            wp_cache_set('recent_posts_5', $recent_posts, 'posts', 1800);
        }
        
        // Mark as preloaded
        wp_cache_set('front_page_preloaded', true, 'preload', 300);
    }
});