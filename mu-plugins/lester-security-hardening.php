<?php
/**
 * Lester's Security Hardening Plugin
 *
 * Advanced security hardening for WordPress with SRE-focused monitoring
 * Must-Use Plugin for automatic activation
 *
 * @package Lester_Security
 * @version 1.0.0
 * @author  Toribio (Lester's AI Assistant)
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class LesterSecurityHardening
 * 
 * Comprehensive security hardening for WordPress
 */
class LesterSecurityHardening {
    
    private $failed_attempts = array();
    private $suspicious_activity = array();
    
    public function __construct() {
        add_action('init', array($this, 'init'));
        add_action('wp_login_failed', array($this, 'handle_failed_login'));
        add_action('wp_login', array($this, 'handle_successful_login'), 10, 2);
        add_filter('authenticate', array($this, 'check_brute_force'), 30, 3);
        
        // Security headers and hardening
        add_action('init', array($this, 'security_headers'));
        add_action('init', array($this, 'disable_dangerous_features'));
        
        // File upload security
        add_filter('upload_mimes', array($this, 'restrict_upload_mimes'));
        add_filter('wp_handle_upload_prefilter', array($this, 'scan_uploaded_files'));
        
        // SQL injection protection
        add_action('init', array($this, 'sql_injection_protection'));
        
        // XSS protection
        add_filter('pre_comment_content', array($this, 'sanitize_comment_content'));
        
        // Monitor suspicious activity
        add_action('init', array($this, 'monitor_suspicious_activity'));
        
        // Security logging
        add_action('wp_login', array($this, 'log_security_event'));
        add_action('wp_logout', array($this, 'log_security_event'));
        
        // Add monitoring endpoints
        add_action('init', array($this, 'add_security_endpoints'));
    }
    
    /**
     * Initialize security features
     */
    public function init() {
        // Hide WordPress version
        remove_action('wp_head', 'wp_generator');
        
        // Hide login errors
        add_filter('login_errors', array($this, 'generic_login_error'));
        
        // Disable file editing
        if (!defined('DISALLOW_FILE_EDIT')) {
            define('DISALLOW_FILE_EDIT', true);
        }
        
        // Force SSL for admin and logins
        if (!defined('FORCE_SSL_ADMIN') && isset($_SERVER['HTTPS'])) {
            define('FORCE_SSL_ADMIN', true);
        }
        
        // Session security
        $this->secure_session_handling();
        
        // Rate limiting
        $this->implement_rate_limiting();
    }
    
    /**
     * Add security headers
     */
    public function security_headers() {
        if (!is_admin()) {
            // Prevent clickjacking
            header('X-Frame-Options: SAMEORIGIN');
            
            // XSS protection
            header('X-XSS-Protection: 1; mode=block');
            
            // MIME type sniffing protection
            header('X-Content-Type-Options: nosniff');
            
            // Referrer policy
            header('Referrer-Policy: strict-origin-when-cross-origin');
            
            // Content Security Policy
            $csp = "default-src 'self'; " .
                   "script-src 'self' 'unsafe-inline' fonts.googleapis.com; " .
                   "style-src 'self' 'unsafe-inline' fonts.googleapis.com; " .
                   "font-src 'self' fonts.gstatic.com; " .
                   "img-src 'self' data: https:; " .
                   "connect-src 'self'; " .
                   "frame-ancestors 'self';";
            
            header('Content-Security-Policy: ' . $csp);
            
            // HSTS (if HTTPS)
            if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
                header('Strict-Transport-Security: max-age=31536000; includeSubDomains; preload');
            }
            
            // Permissions Policy
            header('Permissions-Policy: camera=(), microphone=(), geolocation=(), usb=(), magnetometer=()');
        }
    }
    
    /**
     * Disable dangerous features
     */
    public function disable_dangerous_features() {
        // Disable XML-RPC
        add_filter('xmlrpc_enabled', '__return_false');
        
        // Remove XML-RPC pingback
        add_filter('wp_headers', function($headers) {
            unset($headers['X-Pingback']);
            return $headers;
        });
        
        // Disable user enumeration
        add_action('template_redirect', function() {
            if (isset($_REQUEST['author'])) {
                wp_redirect(home_url());
                exit;
            }
        });
        
        // Block user enumeration via REST API
        add_filter('rest_user_query', function($args, $request) {
            if (!current_user_can('manage_options')) {
                return new WP_Error('rest_user_cannot_view', 'Sorry, you are not allowed to list users.', array('status' => rest_authorization_required_code()));
            }
            return $args;
        }, 10, 2);
        
        // Disable file editing in dashboard
        if (!defined('DISALLOW_FILE_EDIT')) {
            define('DISALLOW_FILE_EDIT', true);
        }
        
        // Disable plugin/theme installation
        if (!defined('DISALLOW_FILE_MODS') && !current_user_can('manage_options')) {
            define('DISALLOW_FILE_MODS', true);
        }
    }
    
    /**
     * Handle failed login attempts
     */
    public function handle_failed_login($username) {
        $ip = $this->get_client_ip();
        $timestamp = time();
        
        // Log failed attempt
        $this->log_security_event('login_failed', array(
            'username' => $username,
            'ip' => $ip,
            'timestamp' => $timestamp,
        ));
        
        // Track failed attempts per IP
        if (!isset($this->failed_attempts[$ip])) {
            $this->failed_attempts[$ip] = array();
        }
        
        $this->failed_attempts[$ip][] = $timestamp;
        
        // Clean old attempts (older than 15 minutes)
        $this->failed_attempts[$ip] = array_filter($this->failed_attempts[$ip], function($time) {
            return ($time > (time() - 900));
        });
        
        // Store in cache for persistence across requests
        wp_cache_set('failed_attempts_' . $ip, $this->failed_attempts[$ip], 'security', 900);
        
        // If too many attempts, log as brute force
        if (count($this->failed_attempts[$ip]) >= 5) {
            $this->log_security_event('brute_force_detected', array(
                'ip' => $ip,
                'attempts' => count($this->failed_attempts[$ip]),
                'timeframe' => '15_minutes',
            ));
        }
    }
    
    /**
     * Check for brute force attacks
     */
    public function check_brute_force($user, $username, $password) {
        if (empty($username) || empty($password)) {
            return $user;
        }
        
        $ip = $this->get_client_ip();
        
        // Get failed attempts from cache
        $failed_attempts = wp_cache_get('failed_attempts_' . $ip, 'security');
        if (!$failed_attempts) {
            $failed_attempts = array();
        }
        
        // Clean old attempts
        $failed_attempts = array_filter($failed_attempts, function($time) {
            return ($time > (time() - 900));
        });
        
        // Block if too many failed attempts
        if (count($failed_attempts) >= 5) {
            $this->log_security_event('login_blocked', array(
                'ip' => $ip,
                'username' => $username,
                'reason' => 'brute_force_protection',
            ));
            
            return new WP_Error('too_many_attempts', 
                'Too many failed login attempts. Please try again in 15 minutes.',
                array('status' => 429)
            );
        }
        
        return $user;
    }
    
    /**
     * Handle successful login
     */
    public function handle_successful_login($user_login, $user) {
        $ip = $this->get_client_ip();
        
        // Clear failed attempts on successful login
        wp_cache_delete('failed_attempts_' . $ip, 'security');
        
        // Log successful login
        $this->log_security_event('login_success', array(
            'user_login' => $user_login,
            'user_id' => $user->ID,
            'ip' => $ip,
        ));
        
        // Check for suspicious login patterns
        $this->check_suspicious_login($user_login, $ip);
    }
    
    /**
     * Check for suspicious login patterns
     */
    private function check_suspicious_login($username, $ip) {
        // Get recent logins for this user
        $recent_logins = wp_cache_get('recent_logins_' . $username, 'security') ?: array();
        
        // Add current login
        $recent_logins[] = array(
            'ip' => $ip,
            'time' => time(),
        );
        
        // Keep only last 10 logins
        $recent_logins = array_slice($recent_logins, -10);
        
        // Cache for 24 hours
        wp_cache_set('recent_logins_' . $username, $recent_logins, 'security', 86400);
        
        // Check for multiple IPs in short timeframe
        $unique_ips = array();
        $recent_time = time() - 3600; // Last hour
        
        foreach ($recent_logins as $login) {
            if ($login['time'] > $recent_time) {
                $unique_ips[] = $login['ip'];
            }
        }
        
        $unique_ips = array_unique($unique_ips);
        
        if (count($unique_ips) > 3) {
            $this->log_security_event('suspicious_login_pattern', array(
                'username' => $username,
                'unique_ips' => count($unique_ips),
                'timeframe' => '1_hour',
                'ips' => $unique_ips,
            ));
        }
    }
    
    /**
     * Restrict file upload MIME types
     */
    public function restrict_upload_mimes($mimes) {
        // Remove potentially dangerous file types
        unset($mimes['exe']);
        unset($mimes['scr']);
        unset($mimes['bat']);
        unset($mimes['cmd']);
        unset($mimes['com']);
        unset($mimes['pif']);
        unset($mimes['scf']);
        unset($mimes['vbs']);
        unset($mimes['wsf']);
        
        // Only allow safe image types
        $safe_mimes = array(
            'jpg|jpeg|jpe' => 'image/jpeg',
            'gif' => 'image/gif',
            'png' => 'image/png',
            'webp' => 'image/webp',
            'pdf' => 'application/pdf',
            'txt' => 'text/plain',
            'md' => 'text/markdown',
        );
        
        return $safe_mimes;
    }
    
    /**
     * Scan uploaded files for malware
     */
    public function scan_uploaded_files($file) {
        // Basic malware pattern detection
        $dangerous_patterns = array(
            '<?php',
            '<script',
            'eval(',
            'exec(',
            'system(',
            'shell_exec(',
            'base64_decode(',
        );
        
        // Read file content for text files
        if (isset($file['tmp_name']) && is_readable($file['tmp_name'])) {
            $content = file_get_contents($file['tmp_name'], false, null, 0, 8192); // Read first 8KB
            
            foreach ($dangerous_patterns as $pattern) {
                if (stripos($content, $pattern) !== false) {
                    $this->log_security_event('malicious_file_upload', array(
                        'filename' => $file['name'],
                        'pattern' => $pattern,
                        'ip' => $this->get_client_ip(),
                    ));
                    
                    $file['error'] = 'File contains suspicious content and has been blocked.';
                    break;
                }
            }
        }
        
        return $file;
    }
    
    /**
     * SQL injection protection
     */
    public function sql_injection_protection() {
        $suspicious_patterns = array(
            'union select',
            'drop table',
            'insert into',
            'delete from',
            'update set',
            '1=1',
            '1 or 1',
            'concat(',
            'char(',
        );
        
        $request_data = array_merge($_GET, $_POST);
        
        foreach ($request_data as $key => $value) {
            if (is_string($value)) {
                foreach ($suspicious_patterns as $pattern) {
                    if (stripos($value, $pattern) !== false) {
                        $this->log_security_event('sql_injection_attempt', array(
                            'parameter' => $key,
                            'value' => substr($value, 0, 200),
                            'pattern' => $pattern,
                            'ip' => $this->get_client_ip(),
                            'url' => $_SERVER['REQUEST_URI'],
                        ));
                        
                        // Block the request
                        wp_die('Suspicious activity detected.', 'Security Alert', array('response' => 403));
                    }
                }
            }
        }
    }
    
    /**
     * Monitor suspicious activity
     */
    public function monitor_suspicious_activity() {
        $ip = $this->get_client_ip();
        $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
        $request_uri = $_SERVER['REQUEST_URI'] ?? '';
        
        // Check for suspicious user agents
        $suspicious_agents = array(
            'sqlmap',
            'nmap',
            'nikto',
            'wpscan',
            'dirbuster',
            'acunetix',
        );
        
        foreach ($suspicious_agents as $agent) {
            if (stripos($user_agent, $agent) !== false) {
                $this->log_security_event('suspicious_user_agent', array(
                    'user_agent' => $user_agent,
                    'ip' => $ip,
                    'url' => $request_uri,
                ));
                
                wp_die('Access denied.', 'Security Alert', array('response' => 403));
            }
        }
        
        // Check for admin area access from non-logged-in users
        if (strpos($request_uri, '/wp-admin') !== false && !is_user_logged_in() && !defined('DOING_AJAX')) {
            $this->log_security_event('unauthorized_admin_access', array(
                'ip' => $ip,
                'url' => $request_uri,
                'user_agent' => $user_agent,
            ));
        }
        
        // Check for directory traversal attempts
        if (strpos($request_uri, '..') !== false || strpos($request_uri, '../') !== false) {
            $this->log_security_event('directory_traversal_attempt', array(
                'ip' => $ip,
                'url' => $request_uri,
            ));
            
            wp_die('Invalid request.', 'Security Alert', array('response' => 403));
        }
    }
    
    /**
     * Sanitize comment content
     */
    public function sanitize_comment_content($content) {
        // Remove potentially dangerous HTML tags and attributes
        $content = wp_kses($content, array(
            'a' => array('href' => array(), 'title' => array()),
            'b' => array(),
            'i' => array(),
            'strong' => array(),
            'em' => array(),
            'p' => array(),
            'br' => array(),
            'blockquote' => array(),
        ));
        
        // Check for suspicious content
        $suspicious_patterns = array(
            '<script',
            'javascript:',
            'onclick=',
            'onerror=',
            'onload=',
        );
        
        foreach ($suspicious_patterns as $pattern) {
            if (stripos($content, $pattern) !== false) {
                $this->log_security_event('malicious_comment_content', array(
                    'content' => substr($content, 0, 200),
                    'pattern' => $pattern,
                    'ip' => $this->get_client_ip(),
                ));
                
                return wp_kses($content, array()); // Strip all HTML
            }
        }
        
        return $content;
    }
    
    /**
     * Secure session handling
     */
    private function secure_session_handling() {
        // Set secure session parameters
        if (!headers_sent()) {
            ini_set('session.cookie_httponly', 1);
            ini_set('session.cookie_secure', isset($_SERVER['HTTPS']) ? 1 : 0);
            ini_set('session.use_strict_mode', 1);
        }
    }
    
    /**
     * Implement rate limiting
     */
    private function implement_rate_limiting() {
        $ip = $this->get_client_ip();
        $cache_key = 'rate_limit_' . $ip;
        
        $requests = wp_cache_get($cache_key, 'security') ?: 0;
        $requests++;
        
        // Allow 60 requests per minute
        if ($requests > 60) {
            $this->log_security_event('rate_limit_exceeded', array(
                'ip' => $ip,
                'requests' => $requests,
            ));
            
            wp_die('Rate limit exceeded. Please slow down.', 'Rate Limited', array('response' => 429));
        }
        
        wp_cache_set($cache_key, $requests, 'security', 60);
    }
    
    /**
     * Generic login error message
     */
    public function generic_login_error() {
        return 'Invalid login credentials.';
    }
    
    /**
     * Get client IP address
     */
    private function get_client_ip() {
        $ip_headers = array(
            'HTTP_CF_CONNECTING_IP',     // Cloudflare
            'HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_X_CLUSTER_CLIENT_IP',
            'HTTP_FORWARDED_FOR',
            'HTTP_FORWARDED',
            'REMOTE_ADDR'
        );
        
        foreach ($ip_headers as $header) {
            if (!empty($_SERVER[$header])) {
                $ip = $_SERVER[$header];
                
                // Handle comma-separated IPs
                if (strpos($ip, ',') !== false) {
                    $ip = trim(explode(',', $ip)[0]);
                }
                
                // Validate IP
                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
                    return $ip;
                }
            }
        }
        
        return $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    }
    
    /**
     * Log security events
     */
    public function log_security_event($event_type = '', $data = array()) {
        $log_entry = array(
            'timestamp' => current_time('mysql'),
            'event_type' => $event_type,
            'ip' => $this->get_client_ip(),
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
            'url' => $_SERVER['REQUEST_URI'] ?? '',
            'data' => $data,
        );
        
        // Store in cache for monitoring
        $recent_events = wp_cache_get('security_events', 'security') ?: array();
        array_unshift($recent_events, $log_entry);
        
        // Keep only last 100 events
        $recent_events = array_slice($recent_events, 0, 100);
        wp_cache_set('security_events', $recent_events, 'security', 3600);
        
        // Log to file for serious events
        $serious_events = array('brute_force_detected', 'sql_injection_attempt', 'malicious_file_upload');
        if (in_array($event_type, $serious_events)) {
            error_log('SECURITY ALERT: ' . $event_type . ' - ' . json_encode($log_entry));
        }
    }
    
    /**
     * Add security monitoring endpoints
     */
    public function add_security_endpoints() {
        add_action('wp_ajax_nopriv_security_status', array($this, 'security_status'));
        add_action('wp_ajax_security_status', array($this, 'security_status'));
        
        add_action('wp_ajax_security_events', array($this, 'get_security_events'));
    }
    
    /**
     * Security status endpoint
     */
    public function security_status() {
        if (!current_user_can('manage_options')) {
            wp_die('Unauthorized', 'Security Alert', array('response' => 403));
        }
        
        $status = array(
            'timestamp' => current_time('timestamp'),
            'security_features' => array(
                'brute_force_protection' => 'enabled',
                'rate_limiting' => 'enabled',
                'file_upload_scanning' => 'enabled',
                'sql_injection_protection' => 'enabled',
                'xss_protection' => 'enabled',
                'security_headers' => 'enabled',
            ),
            'recent_threats' => $this->get_threat_summary(),
        );
        
        wp_send_json($status);
    }
    
    /**
     * Get security events endpoint
     */
    public function get_security_events() {
        if (!current_user_can('manage_options')) {
            wp_die('Unauthorized', 'Security Alert', array('response' => 403));
        }
        
        $events = wp_cache_get('security_events', 'security') ?: array();
        wp_send_json($events);
    }
    
    /**
     * Get threat summary
     */
    private function get_threat_summary() {
        $events = wp_cache_get('security_events', 'security') ?: array();
        
        $threat_counts = array();
        $recent_time = time() - 3600; // Last hour
        
        foreach ($events as $event) {
            $event_time = strtotime($event['timestamp']);
            if ($event_time > $recent_time) {
                $type = $event['event_type'];
                $threat_counts[$type] = isset($threat_counts[$type]) ? $threat_counts[$type] + 1 : 1;
            }
        }
        
        return $threat_counts;
    }
}

// Initialize the security hardening
new LesterSecurityHardening();