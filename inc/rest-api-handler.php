<?php

add_action( 'rest_api_init', function () {
    register_rest_route( 'realestate/v1', '/manageLikes', [
        'methods'             => 'POST',
        'callback'            => 'save_user_like_rest',
        'permission_callback' => function () {
            return is_user_logged_in(); // Ensure only logged-in users can like
        },
    ] );
} );

function save_user_like_rest( WP_REST_Request $request ) {
    // Retrieve the post ID from the request body
    $post_id = $request->get_param( 'postId' );
    $user_id = get_current_user_id();

    // Check if the user already liked the post
    $like = get_post_meta( $post_id, 'liked_by_user_' . $user_id, true );

    if ( ! empty( $like ) ) {
        // User already liked, so remove the like
        if ( $like == $user_id ) {
            $deleted = delete_post_meta( $post_id, 'liked_by_user_' . $user_id, $user_id );

            if ( $deleted ) {
                return new WP_REST_Response( [ 'success' => true, 'message' => 'Like removed successfully.' ], 200 );
            } else {
                return new WP_REST_Response( [ 'success' => false, 'message' => 'Failed to remove like.' ], 200 );
            }
        }
    }

    if ( $user_id && $post_id ) {
        // Save the user ID as post meta with the key 'liked_by_user_[user_id]'
        update_post_meta( $post_id, 'liked_by_user_' . $user_id, $user_id );

        // Optionally, store an array of user IDs who liked the post
        /*
        $likes = get_post_meta( $post_id, 'liked_users', true );
        if ( ! is_array( $likes ) ) {
            $likes = [];
        }
        if ( ! in_array( $user_id, $likes, true ) ) {
            $likes[] = $user_id;
            update_post_meta( $post_id, 'liked_users', $likes );
        }
        */

        return new WP_REST_Response( [ 'success' => true, 'message' => 'Like saved successfully.' ], 200 );
    }

    return new WP_REST_Response( [ 'success' => false, 'message' => 'Invalid post ID or user not logged in.' ], 400 );
}