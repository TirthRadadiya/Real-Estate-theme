<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div class="contact-info-header bg-[#10AC84] text-white">
        <div class="wrapper">
            <div class="px-4 py-2 flex justify-between">
                <div class="contact-left flex">
                    <p class="mx-2">mail.uremail.com</p>
                    <p>mail.uremail.com</p>
                </div>

                <?php if ( ! is_user_logged_in() ) : ?>
                    <div class="login-signup">
                        <a href="<?php echo esc_url( site_url( '/login' ) ); ?>"><?php esc_html_e( 'Login/Signup', 'your-textdomain' ); ?></a>
                    </div>
                <?php else : 
                    $user = wp_get_current_user();
                ?>
                    <div class="flex items-center">
                        <a href="<?php echo esc_url( site_url( '/liked-posts' ) ); ?>" class="flex mx-5 items-center">
                            <img class="h-[20px]" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/like.png' ) ); ?>" alt="<?php esc_attr_e( 'Liked Posts', 'your-textdomain' ); ?>" />
                            <span class="ms-[10px]"><?php esc_html_e( 'Liked Posts', 'your-textdomain' ); ?></span>
                        </a>
                        <a href="<?php echo esc_url( site_url( '/profile' ) ); ?>">
                            <?php printf( esc_html__( 'Hey!!! %s', 'your-textdomain' ), esc_html( $user->user_login ) ); ?>
                        </a>
                        <?php if ( array_intersect(['agent', 'administrator'], $user->roles) !== [] ) : ?>
                            <a href="<?php echo esc_url( site_url( '/register-property' ) ); ?>" style="margin: 0 10px">
                                <?php esc_html_e( 'Register Property', 'your-textdomain' ); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <header>
        <div class="wrapper">
            <div class="px-4 py-2 flex justify-between">
                <div class="logo flex items-center">
                    <a class="logo flex items-center" href="<?php echo esc_url( site_url() ); ?>">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.png' ); ?>" alt="<?php esc_attr_e( 'Site Logo', 'your-textdomain' ); ?>">
                        <span class="ms-3"><?php esc_html_e( 'Real Estate', 'your-textdomain' ); ?></span>
                    </a>
                </div>
                <div class="navigation">
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'main-nav',
                    ) );
                    ?>
                </div>
            </div>
        </div>
    </header>