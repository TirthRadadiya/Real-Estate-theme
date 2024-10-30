<?php
/**
 * User is able to save images and other property details.
 * Security check: If a registered user is not an agent or an administrator,
 * they should not be able to access the register property page or add details to the database.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

add_action( 'wp_ajax_file_upload2', 'file_upload_callback2' );
add_action( 'wp_ajax_nopriv_file_upload2', 'file_upload_callback2' );

function file_upload_callback2() {
    if ( ! is_user_logged_in() ) {
        wp_send_json_error( [ 'message' => 'Please login to be able to register a property.' ] );
    }

    $current_user = wp_get_current_user();
    if ( ! array_intersect( [ 'agent', 'administrator' ], $current_user->roles ) ) {
        wp_send_json_error( [ 'message' => 'You do not have permission to add a property.' ] );
    }

    // Check for required fields and sanitize inputs
    if ( empty( $_FILES['thumbnail'] ) ) {
        wp_send_json_error( [ 'message' => 'Thumbnail is required.' ] );
    }

    $name = sanitize_text_field( $_POST['name'] ?? '' );
    $address = sanitize_text_field( $_POST['address'] ?? '' );
    $rooms = sanitize_text_field( $_POST['rooms'] ?? '' );
    $beds = sanitize_text_field( $_POST['beds'] ?? '' );
    $bath = sanitize_text_field( $_POST['bath'] ?? '' );
    $area = sanitize_text_field( $_POST['area'] ?? '' );
    $description = sanitize_textarea_field( $_POST['description'] ?? '' );

    // Create a new property post
    $post_data = [
        'post_title'   => $name,
        'post_content' => $description,
        'post_status'  => 'publish',
        'post_type'    => 'property',
        'post_author'  => get_current_user_id(),
    ];

    $post_id = wp_insert_post( $post_data );

    if ( is_wp_error( $post_id ) ) {
        wp_send_json_error( [ 'message' => 'Error creating property.' ] );
    }

    // Update post meta with additional fields
    update_post_meta( $post_id, 'address', $address );
    update_post_meta( $post_id, 'rooms', $rooms );
    update_post_meta( $post_id, 'bed', $beds );
    update_post_meta( $post_id, 'bath', $bath );
    update_post_meta( $post_id, 'area', $area );

    // Upload thumbnail image
    $attachment_id = handle_file_upload( $_FILES['thumbnail'], $post_id );
    set_post_thumbnail( $post_id, $attachment_id );

    // Upload additional images
    if ( ! empty( $_FILES['files']['name'][0] ) ) {
        foreach ( $_FILES['files']['name'] as $key => $name ) {
            handle_file_upload( $_FILES['files'], $post_id, $key );
        }
    }

    // Add meta to track the user who added the property
    update_post_meta( $post_id, '_added_by', get_current_user_id() );

    wp_send_json_success( [ 'message' => 'Property registration completed successfully.' ] );

    wp_die();
}