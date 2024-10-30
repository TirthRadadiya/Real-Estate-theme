<?php
if ( isset( $_POST['update_password'] ) && isset( $_POST['_wpnonce'] ) && wp_verify_nonce( $_POST['_wpnonce'], 'password_change_nonce' ) ) {
    $new_password = sanitize_text_field( $_POST['new_password'] );
    $confirm_password = sanitize_text_field( $_POST['confirm_password'] );

    if ( empty( $new_password ) || empty( $confirm_password ) ) {
        $error = __( 'Please fill in all fields.', 'textdomain' );
    } elseif ( $new_password !== $confirm_password ) {
        $error = __( 'Passwords do not match.', 'textdomain' );
    } else {
        // Update the password
        wp_update_user( array(
            'ID' => get_current_user_id(),
            'user_pass' => $new_password
        ) );
        $success = __( 'Password updated successfully.', 'textdomain' );
    }
}
?>

<?php get_header(); ?>

<?php if ( is_user_logged_in() ) : 
    // Get current user data
    $current_user = wp_get_current_user(); ?>

    <div class="max-w-lg mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-6 text-center"><?php esc_html_e( 'User Profile', 'textdomain' ); ?></h2>

        <!-- Display user details -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700"><?php esc_html_e( 'Full Name:', 'textdomain' ); ?></label>
            <p class="text-lg text-gray-900"><?php echo esc_html( $current_user->display_name ); ?></p>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700"><?php esc_html_e( 'Email:', 'textdomain' ); ?></label>
            <p class="text-lg text-gray-900"><?php echo esc_html( $current_user->user_email ); ?></p>
        </div>

        <!-- Display error/success messages -->
        <?php if ( ! empty( $error ) ) : ?>
            <p class="text-red-600 mb-4"><?php echo esc_html( $error ); ?></p>
        <?php endif; ?>

        <?php if ( ! empty( $success ) ) : ?>
            <p class="text-green-600 mb-4"><?php echo esc_html( $success ); ?></p>
        <?php endif; ?>

        <!-- Password Change Form -->
        <div class="mt-8">
            <h3 class="text-xl font-semibold mb-4"><?php esc_html_e( 'Change Password', 'textdomain' ); ?></h3>
            <form method="POST" class="space-y-6">
                <div>
                    <label for="new_password" class="block text-sm font-medium text-gray-700"><?php esc_html_e( 'New Password', 'textdomain' ); ?></label>
                    <input type="password" name="new_password" id="new_password"
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                           required>
                </div>

                <div>
                    <label for="confirm_password" class="block text-sm font-medium text-gray-700"><?php esc_html_e( 'Confirm Password', 'textdomain' ); ?></label>
                    <input type="password" name="confirm_password" id="confirm_password"
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                           required>
                </div>

                <div>
                    <?php wp_nonce_field( 'password_change_nonce' ); ?>
                    <button type="submit" name="update_password"
                            class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <?php esc_html_e( 'Update Password', 'textdomain' ); ?>
                    </button>
                </div>
            </form>
        </div>

        <br /><br />
        <?php if ( ! in_array( 'agent', (array) $current_user->roles, true ) ) : ?>
            <a href="<?php echo esc_url( site_url( '/become-agent' ) ); ?>"
               class="w-full bg-indigo-600 text-white py-2 px-4 flex justify-center rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <?php esc_html_e( 'Become an Agent', 'textdomain' ); ?>
            </a>
        <?php else : ?>
            <a href="<?php echo esc_url( site_url( '/register-property' ) ); ?>"
               class="w-full bg-indigo-600 text-white py-2 px-4 flex justify-center rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <?php esc_html_e( 'Register a Property', 'textdomain' ); ?>
            </a>
        <?php endif; ?>
    </div>

<?php else : ?>
    <a href="<?php echo esc_url( site_url( '/login' ) ); ?>"
       class="bg-indigo-600 flex justify-center w-[200px] mx-auto text-white py-2 px-4 rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        <?php esc_html_e( 'Login', 'textdomain' ); ?>
    </a>
<?php endif; ?>

<?php get_footer(); ?>