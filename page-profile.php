<?php
if (isset($_POST['update_password']) && wp_verify_nonce($_POST['_wpnonce'], 'password_change_nonce')) {
    $new_password = sanitize_text_field($_POST['new_password']);
    $confirm_password = sanitize_text_field($_POST['confirm_password']);

    if (empty($new_password) || empty($confirm_password)) {
        $error = 'Please fill in all fields.';
    } elseif ($new_password !== $confirm_password) {
        $error = 'Passwords do not match.';
    } else {
        // Update the password
        wp_update_user(array(
            'ID' => $current_user->ID,
            'user_pass' => $new_password
        ));
        $success = 'Password updated successfully.';
    }
}
?>


<?php

get_header();

if (is_user_logged_in()) {
    // Get current user data
    $current_user = wp_get_current_user();
    ?>
    <div class="max-w-lg mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-6 text-center">User Profile</h2>

        <!-- Display user details -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Full Name:</label>
            <p class="text-lg text-gray-900"><?php echo esc_html($current_user->display_name); ?></p>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Email:</label>
            <p class="text-lg text-gray-900"><?php echo esc_html($current_user->user_email); ?></p>
        </div>

        <!-- Display error/success messages -->
        <?php if (@$error) {
            echo '<p class="text-red-600 mb-4">' . esc_html($error) . '</p>';
        } ?>
        <?php if (@$success) {
            echo '<p class="text-green-600 mb-4">' . esc_html($success) . '</p>';
        } ?>

        <!-- Password Change Form -->
        <div class="mt-8">
            <h3 class="text-xl font-semibold mb-4">Change Password</h3>
            <form method="POST" class="space-y-6">
                <div>
                    <label for="new_password" class="block text-sm font-medium text-gray-700">New Password</label>
                    <input type="password" name="new_password" id="new_password"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        required>
                </div>

                <div>
                    <label for="confirm_password" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        required>
                </div>

                <div>
                    <?php wp_nonce_field('password_change_nonce'); ?>
                    <button type="submit" name="update_password"
                        class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Update Password
                    </button>
                </div>
            </form>
        </div>
        <br /><br />
        <?php
        if (!in_array('agent', $current_user->roles)) { ?>
            <a href="<?php echo esc_url(site_url("/become-agent")); ?>"
                class="w-full bg-indigo-600 text-white py-2 px-4 flex justify-center rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Become an Agent
            </a>
        <?php } else { ?>
            <a href="<?php echo esc_url(site_url("/register-property")); ?>"
                class="w-full bg-indigo-600 text-white py-2 px-4 flex justify-center rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Register a Property
            </a>
        <?php }
        ?>
    </div>
    <?php
} else {
    echo '<a href=' . esc_url(site_url("/login")) . '  class="bg-indigo-600 flex justify-center w-[200px] mx-auto text-white py-2 px-4 rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"><button>Login</button></a>';
}

get_footer();