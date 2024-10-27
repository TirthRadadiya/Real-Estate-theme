<?php

/**
** User is able to save images and other property details,
    Need to add securtiy check, that if registered user is not an agent or an admin, then they should be not be
    able to visit register property page and even if they do, they shoud not be able to enter any detail and even
    if they enter details that details should not be added into database.
*/

if (!defined('ABSPATH')) {
    define('ABSPATH', dirname(__FILE__) . '/');
}

add_action('wp_ajax_file_upload2', 'file_upload_callback2');
add_action('wp_ajax_nopriv_file_upload2', 'file_upload_callback2');

function file_upload_callback2()
{
    if (is_user_logged_in()) {
        $current_user = wp_get_current_user();
        if ( ! (array_intersect(['agent', 'administrator'], $current_user->roles) !== []) ) {
            wp_send_json_error(['message' => 'You do not have permission to add property']);
        }
    } else {
        wp_send_json_error(['message' => 'Please login to be able to register property']);
    }

    if(empty($_FILES['thumbnail'])) {
        wp_send_json_error(['message' => 'Thumbnail Is required']);
    }

    // Perform actions or queries based on the data
    // Sanitize and validate the input fields
    $name = sanitize_text_field($_POST['name']);
    $address = sanitize_text_field($_POST['address']);
    $rooms = sanitize_text_field($_POST['rooms']);
    $beds = sanitize_text_field($_POST['beds']);
    $bath = sanitize_text_field($_POST['bath']);
    $area = sanitize_text_field($_POST['area']);
    $description = sanitize_textarea_field($_POST['description']);

    // Create a new property post
    $post_data = [
        'post_title' => $name,
        'post_content' => $description,  // The description as the main post content
        'post_status' => 'publish',
        'post_type' => 'property',
        'post_author' => get_current_user_id(),
    ];

    $post_id = wp_insert_post($post_data);

    if (is_wp_error($post_id)) {
        wp_send_json_error(['message' => 'Error creating property.']);
    }

    if (!empty($post_id)) {
        // Update post meta with additional fields
        update_post_meta($post_id, 'address', $address);
        update_post_meta($post_id, 'rooms', $rooms);
        update_post_meta($post_id, 'bed', $beds);
        update_post_meta($post_id, 'bath', $bath);
        update_post_meta($post_id, 'area', $area);
    }
   
    // uploading thumbnail image
    $attachment_id = handle_file_upload($_FILES['thumbnail'], $post_id);
    set_post_thumbnail($post_id, $attachment_id);


    // uploading other images
    if (!empty($_FILES['files']['name'][0])) {
        foreach ($_FILES['files']['name'] as $key => $name) {
            handle_file_upload($_FILES['files'], $post_id, $key);
        }
    }

    update_post_meta($post_id, '_added_by', get_current_user_id());

    wp_send_json( [ 'success' => true, 'message' => 'Property Registeration completed' ] );

    wp_die();
}