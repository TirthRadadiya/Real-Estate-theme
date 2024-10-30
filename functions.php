<?php
/**
 * Enqueue scripts and styles.
 */
function theme_enqueue_scripts_styles() {
    wp_enqueue_style(
        'theme-output',
        get_template_directory_uri() . '/dist/output.css',
        array(),
        null
    );
    wp_enqueue_style(
        'font-awesome',
        '//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/fontawesome.min.css',
        array(),
        null
    );
    wp_enqueue_script(
        'theme-slider-js',
        get_template_directory_uri() . '/assets/js/slider.js',
        array('jquery'),
        '1.0.0',
        true
    );
    wp_enqueue_script(
        'theme-property-registration-js',
        get_template_directory_uri() . '/assets/js/property-registration.js',
        array('jquery'),
        '1.0.0',
        true
    );
    wp_enqueue_script(
        'theme-like-js',
        get_template_directory_uri() . '/assets/js/like.js',
        array('jquery'),
        '1.0.0',
        true
    );
    wp_localize_script(
        'theme-like-js',
        'themePath',
        array(
            'path'   => get_theme_file_uri(),
            'nonce'  => wp_create_nonce('wp_rest'),
            'domain' => esc_url(site_url('/')),
        )
    );
}
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts_styles');

/**
 * Register theme functionalities.
 */
function theme_register_menus() {
    register_nav_menus(
        array(
            'main-nav' => __('Main Header Navigation', 'textdomain'),
        )
    );
}
add_action('after_setup_theme', 'theme_register_menus');

/**
 * Register custom post types.
 */
function theme_register_custom_posts() {
    add_theme_support('post-thumbnails');

    // Register Property post type
    register_post_type('property', array(
        'public'            => true,
        'show_ui'           => true,
        'has_archive'       => true,
        'show_in_rest'      => true,
        'menu_icon'         => 'dashicons-admin-home',
        'labels'            => array(
            'name' => __('Property', 'textdomain'),
        ),
        'map_meta_cap'      => true,
        'capability_type'   => 'post',
        'rewrite'           => array('slug' => 'properties'),
        'supports'          => array('title', 'editor', 'thumbnail', 'custom-fields'),
    ));

    // Register Agent post type
    register_post_type('agent', array(
        'public'            => true,
        'show_ui'           => true,
        'has_archive'       => true,
        'show_in_rest'      => true,
        'menu_icon'         => 'dashicons-businessman',
        'labels'            => array(
            'name' => __('Agent', 'textdomain'),
        ),
        'rewrite'           => array('slug' => 'agents'),
        'supports'          => array('title', 'editor', 'thumbnail', 'custom-fields'),
    ));
}
add_action('init', 'theme_register_custom_posts');

/**
 * Enqueue media uploader for image fields.
 */
function theme_image_uploader_enqueue() {
    wp_enqueue_media();
    wp_register_script(
        'theme-meta-image',
        get_template_directory_uri() . '/assets/js/media-uploader.js',
        array('jquery')
    );
    wp_localize_script(
        'theme-meta-image',
        'meta_image',
        array(
            'title'  => __('Upload an Image', 'textdomain'),
            'button' => __('Use this Image', 'textdomain'),
        )
    );
    wp_enqueue_script('theme-meta-image');
}
add_action('admin_enqueue_scripts', 'theme_image_uploader_enqueue');

/**
 * Hide the admin bar for non-administrator users.
 */
function theme_remove_admin_bar() {
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}
add_action('after_setup_theme', 'theme_remove_admin_bar');

/**
 * Add custom role for Agent.
 */
function theme_add_agent_role() {
    add_role(
        'agent',
        __('Agent', 'textdomain'),
        array(
            'read'          => true,
            'edit_posts'    => false,
            'delete_posts'  => false,
        )
    );
}
add_action('init', 'theme_add_agent_role');

/**
 * Add capabilities for the Agent role.
 */
function theme_add_property_capabilities_to_agent() {
    $role = get_role('agent');

    if ($role) {
        $capabilities = array(
            'edit_property',
            'read_property',
            'delete_property',
            'edit_properties',
            'publish_properties',
            'read_private_properties',
            'delete_properties',
            'delete_private_properties',
            'edit_private_properties',
        );
        foreach ($capabilities as $cap) {
            $role->add_cap($cap);
        }
    }

    $admin_role = get_role('administrator');
    if ($admin_role && !$admin_role->has_cap('agent')) {
        $admin_role->add_cap('agent');
    }
}
add_action('admin_init', 'theme_add_property_capabilities_to_agent');

// Include additional functionality files.
require get_template_directory() . '/inc/helper.php';
require get_template_directory() . '/inc/register-property.php';
require get_template_directory() . '/inc/rest-api-handler.php';
require get_template_directory() . '/inc/custom-taxonomy.php';

/* 
 *** disable block editor for a specific post type
 */

// add_filter( 'use_block_editor_for_post_type', 'disable_block_editor_for_page_post_type', 10, 2 );

// function disable_block_editor_for_page_post_type( $use_block_editor, $post_type ) {
//         return ( 'property' === $post_type ) ? false : $use_block_editor;
// }

/* 
 *** Override core gallery block render function
 */

// add_action('init', 'override_gallery_block_render_callback');

// function override_gallery_block_render_callback()
// {
//     // First, unregister the existing Gallery block
//     unregister_block_type('core/gallery');

//     // Re-register the Gallery block with a custom render callback
//     register_block_type('core/gallery', array(
//         'render_callback' => 'custom_render_gallery_block',
//     ));
// }


// function custom_render_gallery_block($attributes, $content)
// {
//     var_dump($attributes);

//     echo '<br />';

//     // print_r($content);
// }


