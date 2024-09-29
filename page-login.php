<?php
// https://www.youtube.com/watch?v=zSvNH_3v584 - custom user role for custom post type

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (wp_verify_nonce($_REQUEST['user_login'], 'saved_in_database')) {
        $message = null;


        $user = get_user_by('email', $_POST['email']);

        if (!empty($user) && wp_check_password($_POST['password'], $user->user_pass, $user->ID)) {
            wp_set_current_user($user->ID, $user->user_login);
            wp_set_auth_cookie($user->ID);
            do_action('wp_login', $user->user_login);

            wp_redirect(site_url("/"));
        }

    }
}
?>

<?php if (is_user_logged_in())
    wp_redirect(site_url("/profile")) ?>

<?php get_header();
echo get_page_banner("Login", site_url("/login"));
?>

<div class="wrapper">
    <div class="flex flex-col items-center justify-center pt-5 mb-20 bg-background">
        <h1 class="text-2xl font-bold text-foreground">Login Your Account</h1>

        <form class="w-full max-w-sm mt-6 space-y-4" method="POST" action="">
            <?php wp_nonce_field('saved_in_database', 'user_login'); ?>
            <div>
                <label class="block text-sm text-muted-foreground mb-3" for="email">User Email</label>
                <input class="w-full p-2 border border-border rounded-md focus:outline-none focus:ring focus:ring-ring"
                    type="email" id="email" name="email" placeholder="Email" required />
            </div>

            <div>
                <label class="block text-sm text-muted-foreground mb-3" for="password">Password</label>
                <input class="w-full p-2 border border-border rounded-md focus:outline-none focus:ring focus:ring-ring"
                    type="password" id="password" name="password" placeholder="Password" required />
            </div>

            <input class="w-full p-2 bg-[#0984E3] text-white rounded-md hover:bg-primary/80" type="submit"
                value="Login Account"></input>


            <!-- <p class="text-sm text-muted-foreground">You can also login with social network</p> -->
            <!-- <div class="flex justify-between mt-2">
                <button class="flex-1 p-2 mr-2 text-white bg-red-500 rounded-md hover:bg-red-400">Google</button>
                <button class="flex-1 p-2 mx-2 text-white bg-blue-600 rounded-md hover:bg-blue-500">Facebook</button>
                <button class="flex-1 p-2 ml-2 text-white bg-blue-400 rounded-md hover:bg-blue-300">Twitter</button>
            </div> -->

        </form>
        <p class="mt-4 text-sm text-muted-foreground">Don't have an account? <a
                href="<?php echo esc_url(site_url("/sign-up")) ?>" class="text-primary text-blue-900 underline">Sign
                in</a>
        </p>
    </div>
</div>



<?php get_footer(); ?>