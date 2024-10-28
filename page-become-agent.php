<?php
if ( is_user_logged_in() ) {
    $current_user = wp_get_current_user();
    $user_id = $current_user->ID;

    // Check if the user already has the 'agent' role
    if ( in_array( 'agent', $current_user->roles, true ) ) {
        wp_safe_redirect( site_url( '/profile' ) );
        exit;
    }
}


if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
    // Handle form submission
    if ( in_array( 'subscriber', $current_user->roles ) ) {
        if ( empty( $_FILES['profile_image']['name'] ) ) {
            wp_send_json_error( array( 'message' => __( 'Please add a thumbnail', 'text-domain' ) ) );
        }

        // Handle image upload
        if ( ! empty( $_FILES['profile_image']['name'] ) ) {
            require_once ABSPATH . 'wp-admin/includes/file.php';

            $uploadedfile = $_FILES['profile_image']['name'];
            $upload = wp_upload_bits( $uploadedfile, null, file_get_contents($_FILES['profile_image']['tmp_name'] ) );

            if ( isset( $upload['error'] ) && $upload['error'] ) {
                wp_send_json_error( array( 'message' => $upload['error'] ) );
            }

            $filename = $upload['file'];
            $wp_filetype = wp_check_filetype( $filename, null );
            $attachment = array(
                'post_mime_type' => $wp_filetype['type'],
                'post_title'     => sanitize_file_name( $filename ),
                'post_content'   => '',
                'post_status'    => 'inherit',
                'guid'           => $upload['url']
            );

            $attachment_id = wp_insert_attachment( $attachment, $filename );
            require_once ABSPATH . 'wp-admin/includes/image.php';
            $attachment_data = wp_generate_attachment_metadata( $attachment_id, $filename );
            wp_update_attachment_metadata( $attachment_id, $attachment_data );
        }

        if ( ! empty( $_POST['description'] ) ) {
            update_user_meta( $user_id, 'profile_image', $upload['url'] );

            $agent_args = array(
                'post_title'   => $current_user->user_nicename,
                'post_type'    => 'agent',
                'post_content' => sanitize_textarea_field( $_POST['description'] ),
                'post_status'  => 'publish'
            );

            $agent_id = wp_insert_post( $agent_args );

            if ( ! empty( $agent_id ) ) {
                set_post_thumbnail( $agent_id, $attachment_id );

                // Save social media links
                if ( ! empty( $_POST['facebook'] ) ) {
                    update_post_meta( $agent_id, 'facebook', esc_url_raw( $_POST['facebook'] ) );
                }
                if ( ! empty( $_POST['twitter'] ) ) {
                    update_post_meta( $agent_id, 'twitter', esc_url_raw( $_POST['twitter'] ) );
                }
                if ( ! empty( $_POST['linkedin'] ) ) {
                    update_post_meta( $agent_id, 'linkedin', esc_url_raw( $_POST['linkedin'] ) );
                }
                if ( ! empty( $_POST['description'] ) ) {
                    update_post_meta( $agent_id, 'description', sanitize_textarea_field( $_POST['description'] ) );
                }

                // Update user role to 'agent'
                $current_user->set_role( 'agent' );

                wp_safe_redirect( site_url( '/profile' ) );
                exit;
            }
        }
    }
}
?>

<?php get_header(); ?>

<form id="agentForm" action="" method="POST" enctype="multipart/form-data" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
    <div class="mb-4">
        <label for="profile_image" class="block text-gray-700 font-bold mb-2"><?php esc_html_e( 'Profile Image:', 'text-domain' ); ?></label>
        <input 
            type="file" 
            id="profile_image" 
            name="profile_image" 
            accept="image/*" 
            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
    </div>

    <div class="mb-4">
        <label for="facebook" class="block text-gray-700 font-bold mb-2"><?php esc_html_e( 'Facebook:', 'text-domain' ); ?></label>
        <input 
            type="url" 
            id="facebook" 
            name="facebook" 
            placeholder="<?php echo esc_attr( 'https://facebook.com/yourprofile', 'text-domain' ); ?>" 
            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
    </div>

    <div class="mb-4">
        <label for="twitter" class="block text-gray-700 font-bold mb-2"><?php esc_html_e( 'Twitter:', 'text-domain' ); ?></label>
        <input 
            type="url" 
            id="twitter" 
            name="twitter" 
            placeholder="<?php echo esc_attr( 'https://twitter.com/yourprofile', 'text-domain' ); ?>" 
            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
    </div>

    <div class="mb-4">
        <label for="linkedin" class="block text-gray-700 font-bold mb-2"><?php esc_html_e( 'LinkedIn:', 'text-domain' ); ?></label>
        <input 
            type="url" 
            id="linkedin" 
            name="linkedin" 
            placeholder="<?php echo esc_attr( 'https://linkedin.com/in/yourprofile', 'text-domain' ); ?>" 
            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
    </div>

    <div class="mb-4">
        <label for="description" class="block text-gray-700 font-bold mb-2"><?php esc_html_e( 'Description:', 'text-domain' ); ?></label>
        <textarea 
            id="description" 
            name="description" 
            rows="5" 
            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        ></textarea>
    </div>

    <div class="text-center">
        <button 
            type="submit" 
            id="submit_form" 
            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-700"
        >
            <?php esc_html_e( 'Submit', 'text-domain' ); ?>
        </button>
    </div>

    <div id="response_message" class="mt-4 text-center text-red-500"></div>
</form>

<?php get_footer(); ?>