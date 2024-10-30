<?php
/**
 * User registration form handling.
 * Registers a new user, logs them in, and redirects to the home page upon success.
 */

// https://wordpress.stackexchange.com/questions/160422/add-custom-column-to-users-admin-panel - Add password in user column or in meta
// https://wordpress.stackexchange.com/questions/13535/check-the-password-of-a-user - get password of a user
// https://developer.wordpress.org/reference/functions/wp_authenticate_username_password/ - wordpress user authentication function

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registeration']) && $_POST['registeration'] === 'Register Account') {
    if (isset($_REQUEST['user_register']) && wp_verify_nonce($_REQUEST['user_register'], 'saved_in_database_for_register')) {
        $error = null;
        
        if ($_POST['password'] === $_POST['confirm_password']) {
            $username = sanitize_text_field($_POST['full_name']);
            $email = sanitize_email($_POST['email']);
            $password = sanitize_text_field($_POST['password']);

            // Check if the username or email already exists
            if (username_exists($username) || email_exists($email)) {
                $error = __('Username or email already exists.', 'your-text-domain');
            } else {
                // Create the new user
                $user_id = wp_insert_user([
                    'user_login' => $username,
                    'first_name' => $username,
                    'user_email' => $email,
                    'user_pass'  => $password,
                ]);

                // Check if user creation was successful
                if (!is_wp_error($user_id)) {
                    wp_set_auth_cookie($user_id, true);
                    wp_set_current_user($user_id, $username);
                    do_action('wp_login', $username);

                    // Redirect to home page after logging in
                    wp_safe_redirect(home_url());
                    exit();
                } else {
                    $error = __('User registration failed.', 'your-text-domain');
                }
            }
        } else {
            $error = __('Passwords do not match.', 'your-text-domain');
        }
    }
}
?>

<?php get_header(); ?>

<?php echo get_page_banner(__('Sign Up', 'your-text-domain'), esc_url(site_url('/sign-up'))); ?>

<div class="flex items-center justify-center py-20 bg-background">
    <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center text-primary"><?php esc_html_e('Create Your Account', 'your-text-domain'); ?></h2>
        
        <form method="POST">
            <?php wp_nonce_field('saved_in_database_for_register', 'user_register'); ?>

            <?php if (!empty($error)) : ?>
                <p class="text-xl text-red-500 my-5 text-center"><?php echo esc_html($error); ?></p>
            <?php endif; ?>

            <div>
                <label for="full_name" class="block text-sm font-medium text-muted mb-2 mt-4"><?php esc_html_e('Full Name', 'your-text-domain'); ?></label>
                <input type="text" id="full_name" name="full_name" placeholder="<?php esc_attr_e('Full Name', 'your-text-domain'); ?>" value="<?php echo isset($_POST['full_name']) ? esc_attr($_POST['full_name']) : ''; ?>" class="mt-1 block w-full p-3 border border-border rounded-md focus:outline-none focus:ring focus:ring-ring" />
            </div>
            
            <div>
                <label for="email" class="block text-sm font-medium text-muted mb-2 mt-4"><?php esc_html_e('Email Address', 'your-text-domain'); ?></label>
                <input type="email" id="email" name="email" placeholder="<?php esc_attr_e('Email Address', 'your-text-domain'); ?>" value="<?php echo isset($_POST['email']) ? esc_attr($_POST['email']) : ''; ?>" class="mt-1 block w-full p-3 border border-border rounded-md focus:outline-none focus:ring focus:ring-ring" />
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-muted mb-2 mt-4"><?php esc_html_e('Password', 'your-text-domain'); ?></label>
                <input type="password" id="password" name="password" placeholder="<?php esc_attr_e('Password', 'your-text-domain'); ?>" class="mt-1 block w-full p-3 border border-border rounded-md focus:outline-none focus:ring focus:ring-ring" />
            </div>

            <div>
                <label for="confirm_password" class="block text-sm font-medium text-muted mb-2 mt-4"><?php esc_html_e('Confirm Password', 'your-text-domain'); ?></label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="<?php esc_attr_e('Confirm Password', 'your-text-domain'); ?>" class="mt-1 block w-full p-3 border border-border rounded-md focus:outline-none focus:ring focus:ring-ring" />
            </div>

            <input type="submit" name="registeration" class="w-full mt-4 bg-[#0984E3] text-white text-primary-foreground p-3 rounded-md hover:bg-primary/80" value="<?php esc_attr_e('Register Account', 'your-text-domain'); ?>" />
        </form>
    </div>
</div>

<?php get_footer(); ?>