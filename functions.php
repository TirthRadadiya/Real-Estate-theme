<?php

/**
 * Enqueue scripts and styles.
 */
function cg_your_theme_scripts()
{
    wp_enqueue_style('output', get_template_directory_uri() . '/dist/output.css', array());
    wp_enqueue_style("font-awesome", "//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/fontawesome.min.css");
    wp_enqueue_script('sliderJS', get_template_directory_uri() . "/assets/js/slider.js", array('jquery'), '1.0.0', true);
    wp_enqueue_script('propertyRegistrationJS', get_template_directory_uri() . "/assets/js/property-registration.js", array('jquery'), '1.0.0', true);
    wp_enqueue_script('likeJS', get_template_directory_uri() . "/assets/js/like.js", array('jquery'), '1.0.0', true);
    wp_localize_script('likeJS', 'themePath', array('path' => get_theme_file_uri(), 'nonce' => wp_create_nonce('wp_rest'), 'domain' => esc_url(site_url("/"))));
}
add_action('wp_enqueue_scripts', 'cg_your_theme_scripts');

function load_functionalities()
{
    register_nav_menus(array(
        'main-nav' => 'Main Header Navigtion'
    ));
}

add_action('after_setup_theme', 'load_functionalities');

function register_custom_post()
{
    add_theme_support('post-thumbnails');

    // Property Post type
    register_post_type('property', array(
        'public' => true,
        'show_ui' => true,
        'has_archive' => true,
        'show_in_rest' => true,
        'menu_icon' => "dashicons-admin-home",
        'labels' => array(
            'name' => "Property",
        ),
        'capabilities' => array(
            'edit_post' => 'edit_property',             // Allows editing their own property
            'read_post' => 'read_property',             // Allows reading their own property
            'delete_post' => 'delete_property',           // Allows deleting their own property
            'edit_posts' => 'edit_properties',           // Allows editing multiple of their own properties
            'publish_posts' => 'publish_properties',        // Allows publishing their own properties
            'read_private_posts' => 'read_private_properties',   // Allows reading private properties (if needed)
            'delete_posts' => 'delete_properties',         // Allows deleting their own properties
            'edit_private_posts' => 'edit_private_properties',   // Allows editing private properties (if needed)
            'delete_private_posts' => 'delete_private_properties' // Allows deleting private properties (if needed)
        ),
        // as pointed out by iEmanuele, adding map_meta_cap will map the meta correctly 
        'map_meta_cap' => true,
        "rewrite" => array('slug' => "properties"),
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields')
    ));


    // Agets Post type
    register_post_type('agent', array(
        'public' => true,
        'show_ui' => true,
        'has_archive' => true,
        'show_in_rest' => true,
        'menu_icon' => "dashicons-businessman",
        'labels' => array(
            'name' => "Agent",
        ),
        "rewrite" => array('slug' => "agents"),
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields')
    ));


}

add_action('init', 'register_custom_post');

require get_template_directory() . "/inc/custom-taxonomy.php";

function image_uploader_enqueue()
{

    wp_enqueue_media();

    wp_register_script('meta-image', get_template_directory_uri() . '/assets/js/media-uploader.js', array('jquery'));
    wp_localize_script(
        'meta-image',
        'meta_image',
        array(
            'title' => 'Upload an Image',
            'button' => 'Use this Image',
        )
    );
    wp_enqueue_script('meta-image');

}
add_action('admin_enqueue_scripts', 'image_uploader_enqueue');
add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar()
{
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}

function add_agent_role()
{
    add_role(
        'agent',
        'Agent',
        array(
            'read' => true,
            'edit_posts' => false,
            'delete_posts' => false,
        )
    );
}
add_action('init', 'add_agent_role');

function add_property_capabilities_to_agent()
{
    // Get the agent role
    $role = get_role('agent');

    // Add property capabilities to the agent role
    $role->add_cap('edit_property');
    $role->add_cap('read_property');
    $role->add_cap('delete_property');
    $role->add_cap('edit_properties');
    $role->add_cap('publish_properties');
    $role->add_cap('read_private_properties');
    $role->add_cap('delete_properties');
    $role->add_cap('delete_private_properties');
    $role->add_cap('edit_private_properties');
}
add_action('admin_init', 'add_property_capabilities_to_agent');


require get_template_directory() . "/inc/helper.php";
require get_template_directory() . "/inc/register-property.php";
require get_template_directory() . "/inc/rest-api-handler.php";





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


