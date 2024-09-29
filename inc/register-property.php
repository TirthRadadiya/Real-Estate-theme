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

    // check_ajax_referer('file_upload', 'security');
    $arr_img_ext = array('image/png', 'image/jpeg', 'image/jpg', 'image/gif');

    if (in_array($_FILES['thumbnail']['type'], haystack: $arr_img_ext)) {
        $upload = wp_upload_bits($_FILES["thumbnail"]["name"], null, file_get_contents($_FILES["thumbnail"]["tmp_name"]));
        // echo $upload['url'];

        if (!$upload['error']) {
            $filename = $upload['file'];
            $wp_filetype = wp_check_filetype($filename, null);
            $attachment = array(
                'post_mime_type' => $wp_filetype['type'],
                'post_title' => sanitize_file_name($filename),
                'post_content' => '',
                'post_status' => 'inherit',
                'guid' => $upload['url']
            );
            $attachment_id = wp_insert_attachment($attachment, $filename, $post_id);
            if (!is_wp_error($attachment_id)) {
                require_once(ABSPATH . 'wp-admin/includes/image.php');
                $attachment_data = wp_generate_attachment_metadata($attachment_id, $filename);
                wp_update_attachment_metadata($attachment_id, $attachment_data);
                set_post_thumbnail($post_id, $attachment_id);
            }
        }
    }

    if (!empty($_FILES['files']['name'][0])) {
        $uploaded_files = array();

        foreach ($_FILES['files']['name'] as $key => $name) {
            if (in_array($_FILES['files']['type'][$key], $arr_img_ext)) {
                $upload = wp_upload_bits($name, null, file_get_contents($_FILES['files']['tmp_name'][$key]));

                if (!$upload['error']) {
                    $filename = $upload['file'];
                    $wp_filetype = wp_check_filetype($filename, null);
                    $attachment = array(
                        'post_mime_type' => $wp_filetype['type'],
                        'post_title' => sanitize_file_name($filename),
                        'post_content' => '',
                        'post_status' => 'inherit',
                        'guid' => $upload['url']
                    );
                    $attachment_id = wp_insert_attachment($attachment, $filename, $post_id);
                }

                if (isset($upload['url'])) {
                    $uploaded_files[] = $upload['url']; // Store each uploaded file URL
                }
            }
        }

        // Return the URLs of the uploaded files
        // echo json_encode($uploaded_files);
    }

    update_post_meta($post_id, '_added_by', get_current_user_id());

    wp_die();
}
