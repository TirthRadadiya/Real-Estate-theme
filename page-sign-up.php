<!-- 
    Upon registeration user is not being logged in and cookie is not being saved 
    and user is not being redirected

    Will be adding it.
-->

<?php
// https://wordpress.stackexchange.com/questions/160422/add-custom-column-to-users-admin-panel - Add password in user column or in meta
// https://wordpress.stackexchange.com/questions/13535/check-the-password-of-a-user - get password of a user
// https://developer.wordpress.org/reference/functions/wp_authenticate_username_password/ - wordpress user authentication function

if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['registeration'] == 'Register Account') {
    if (wp_verify_nonce($_REQUEST['user_register'], 'saved_in_database_for_register')) {
        $error = null;
        if ($_POST['password'] == $_POST['confirm_password']) {
            $username = sanitize_text_field($_POST['full_name']);
            $email = sanitize_email($_POST['email']);
            $password = sanitize_text_field($_POST['password']);

            // Check if the username or email already exists
            if (username_exists($username) || email_exists($email)) {
                $error = 'Username or email already exists.';
                return;
            }

            // Create the new user
            $user_id = wp_insert_user(array(
                'user_login' => $username,
                'first_name' => $username,
                'user_email' => $email,
                'user_pass' => $password,
            ));

            print_r($user_id);


            // Check if user creation was successful
            if (@$user_id) {

                wp_setcookie($username, $password, true);
                wp_set_current_user($user_id, $username);
                do_action('wp_login', $username);

                // send the newly created user to the home page after logging them in
                wp_redirect(home_url());
                exit();
            } else {
                $error = 'User registration failed: ';
            }
        } else {
            $error = 'Passwords are different';
        }
    }
}
?>

<?php get_header(); ?>

<?php echo get_page_banner("Sign Up", site_url("/sign-up")); ?>

<div class="flex items-center justify-center py-20 bg-background">
    <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center text-primary">Create Your Account</h2>
        <form method="POST">
            <?php wp_nonce_field('saved_in_database_for_register', 'user_register'); ?>

            <?php
            if (@$error)
                echo '<p class="text-xl text-red-500 my-5 text-center">' . $error . '</p>';
            ?>

            <div>
                <label for="full_name" class="block text-sm font-medium text-muted mb-2 mt-4">Full Name</label>
                <input type="text" id="full_name" name="full_name" placeholder="Full Name" value="<?php if (@$_POST['full_name'])
                    echo $_POST['full_name']; ?>"
                    class="mt-1 block w-full p-3 border border-border rounded-md focus:outline-none focus:ring focus:ring-ring" />
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-muted mb-2 mt-4">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Email Address" value="<?php if (@$_POST['email'])
                    echo $_POST['email']; ?>"
                    class="mt-1 block w-full p-3 border border-border rounded-md focus:outline-none focus:ring focus:ring-ring" />
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-muted mb-2 mt-4">Password</label>
                <input type="password" id="password" name="password" placeholder="Password"
                    class="mt-1 block w-full p-3 border border-border rounded-md focus:outline-none focus:ring focus:ring-ring" />
            </div>
            <div>
                <label for="confirm_password" class="block text-sm font-medium text-muted mb-2 mt-4">Confirm
                    Password</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password"
                    class="mt-1 block w-full p-3 border border-border rounded-md focus:outline-none focus:ring focus:ring-ring" />
            </div>

            <input type="submit" name="registeration"
                class="w-full mt-4 bg-[#0984E3] text-white text-primary-foreground p-3 rounded-md hover:bg-primary/80"
                value="Register Account" />
        </form>
    </div>
</div>


<?php get_footer(); ?>