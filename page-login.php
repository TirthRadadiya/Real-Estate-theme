<?php
// Redirect if the user is already logged in
if ( is_user_logged_in() ) {
    wp_safe_redirect( esc_url( site_url( '/profile' ) ) );
    exit;
}

// Handle login form submission
if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
    if ( isset( $_POST['user_login'] ) && wp_verify_nonce( $_POST['user_login'], 'saved_in_database' ) ) {
        
        $user = get_user_by( 'email', sanitize_email( $_POST['email'] ) );

        if ( $user && wp_check_password( $_POST['password'], $user->user_pass, $user->ID ) ) {
            wp_set_current_user( $user->ID, $user->user_login );
            wp_set_auth_cookie( $user->ID );
            do_action( 'wp_login', $user->user_login );

            wp_safe_redirect( esc_url( site_url( '/' ) ) );
            exit;
        } else {
            $message = __( 'Invalid email or password.', 'textdomain' );
        }
    }
}
?>

<?php get_header(); ?>

<?php echo get_page_banner( __( 'Login', 'textdomain' ), esc_url( site_url( '/login' ) ) ); ?>

<div class="wrapper">
    <div class="flex flex-col items-center justify-center pt-5 mb-20 bg-background">
        <h1 class="text-2xl font-bold text-foreground"><?php esc_html_e( 'Login to Your Account', 'textdomain' ); ?></h1>

        <form class="w-full max-w-sm mt-6 space-y-4" method="POST" action="">
            <?php wp_nonce_field( 'saved_in_database', 'user_login' ); ?>
            <div>
                <label class="block text-sm text-muted-foreground mb-3" for="email"><?php esc_html_e( 'User Email', 'textdomain' ); ?></label>
                <input class="w-full p-2 border border-border rounded-md focus:outline-none focus:ring focus:ring-ring"
                    type="email" id="email" name="email" placeholder="<?php esc_attr_e( 'Email', 'textdomain' ); ?>" required />
            </div>

            <div>
                <label class="block text-sm text-muted-foreground mb-3" for="password"><?php esc_html_e( 'Password', 'textdomain' ); ?></label>
                <input class="w-full p-2 border border-border rounded-md focus:outline-none focus:ring focus:ring-ring"
                    type="password" id="password" name="password" placeholder="<?php esc_attr_e( 'Password', 'textdomain' ); ?>" required />
            </div>

            <input class="w-full p-2 bg-[#0984E3] text-white rounded-md hover:bg-primary/80" type="submit"
                value="<?php esc_attr_e( 'Login Account', 'textdomain' ); ?>" />
        </form>

        <p class="mt-4 text-sm text-muted-foreground">
            <?php esc_html_e( "Don't have an account?", 'textdomain' ); ?>
            <a href="<?php echo esc_url( site_url( '/sign-up' ) ); ?>" class="text-primary text-blue-900 underline">
                <?php esc_html_e( 'Sign up', 'textdomain' ); ?>
            </a>
        </p>
    </div>
</div>

<?php get_footer(); ?>