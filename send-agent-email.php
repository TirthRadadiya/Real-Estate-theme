<?php
// Load WordPress functions
require_once('../../../wp-load.php');

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitted'])) {

    wp_redirect(home_url());

    // Sanitize form data
    // $name = sanitize_text_field($_POST['full_name']);
    // $email = sanitize_email($_POST['email']);
    // $subject = sanitize_text_field($_POST['subject']);
    // $message = sanitize_textarea_field($_POST['message']);
    // $agent_email = sanitize_email($_POST['agent_email']);

    // // Email subject and body
    // $mail_subject = "New message from: " . $name . " - " . $subject;
    // $mail_body = "You have received a new message from " . $name . " (" . $email . ").\n\nMessage:\n" . $message;

    // // Send email
    // $headers = array('Content-Type: text/html; charset=UTF-8', 'Reply-To: ' . $name . ' <' . $email . '>');
    // $sent = wp_mail($agent_email, $mail_subject, $mail_body, $headers);

    // // Redirect or show confirmation message
    // if ($sent) {
    //     echo '<p>Thank you! Your message has been sent to the agent.</p>';
    // } else {
    //     echo '<p>There was an issue sending your message. Please try again.</p>';
    // }
} else {
    // If form wasn't submitted, redirect or show error
    echo '<p>Invalid form submission.</p>';
}
