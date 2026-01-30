<?php
/**
 * Contact Form AJAX Handler
 * 
 * Handles contact form submissions via AJAX to bypass Cloudflare APO caching.
 *
 * @package Lester_Developer
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register AJAX handlers for contact form
 */
add_action('wp_ajax_submit_contact_form', 'lester_handle_contact_form_ajax');
add_action('wp_ajax_nopriv_submit_contact_form', 'lester_handle_contact_form_ajax');

/**
 * Handle contact form AJAX submission
 */
function lester_handle_contact_form_ajax() {
    // Set JSON header
    header('Content-Type: application/json');
    
    // Verify nonce
    if (!isset($_POST['contact_nonce']) || !wp_verify_nonce($_POST['contact_nonce'], 'contact_form_submit')) {
        wp_send_json_error(['message' => 'Security check failed. Please refresh the page and try again.'], 403);
    }
    
    // Sanitize input
    $name = sanitize_text_field($_POST['name'] ?? '');
    $email = sanitize_email($_POST['email'] ?? '');
    $subject = sanitize_text_field($_POST['subject'] ?? 'Contact Form Submission');
    $message = sanitize_textarea_field($_POST['message'] ?? '');
    
    // Validate required fields
    if (empty($name) || empty($email) || empty($message)) {
        wp_send_json_error(['message' => 'Please fill in all required fields.'], 400);
    }
    
    if (!is_email($email)) {
        wp_send_json_error(['message' => 'Please enter a valid email address.'], 400);
    }
    
    // Build email
    $to = 'lestermiller26@gmail.com';
    $email_subject = '[Contact Form] ' . $subject;
    $email_body = "You have received a new message from your website contact form.\n\n";
    $email_body .= "Name: $name\n";
    $email_body .= "Email: $email\n";
    $email_body .= "Subject: $subject\n\n";
    $email_body .= "Message:\n$message\n";
    
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . get_bloginfo('name') . ' <noreply@lesterbarahona.com>',
        'Reply-To: ' . $name . ' <' . $email . '>',
    );
    
    // Send email
    $sent = wp_mail($to, $email_subject, $email_body, $headers);
    
    if ($sent) {
        wp_send_json_success(['message' => 'Thanks for reaching out! I\'ll get back to you as soon as possible.']);
    } else {
        wp_send_json_error(['message' => 'There was an error sending your message. Please try again or email me directly at lester@lesterbarahona.com'], 500);
    }
}

/**
 * Enqueue contact form script on contact page
 */
add_action('wp_enqueue_scripts', 'lester_enqueue_contact_form_script');

function lester_enqueue_contact_form_script() {
    if (is_page_template('page-contact.php')) {
        wp_enqueue_script(
            'lester-contact-form',
            get_template_directory_uri() . '/assets/js/contact-form.js',
            [],
            filemtime(get_template_directory() . '/assets/js/contact-form.js'),
            true
        );
        
        wp_localize_script('lester-contact-form', 'lesterContact', [
            'ajaxUrl' => admin_url('admin-ajax.php'),
        ]);
    }
}
