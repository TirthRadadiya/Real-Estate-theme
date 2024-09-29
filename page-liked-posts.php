<?php
if (!is_user_logged_in())
    wp_safe_redirect(esc_url(site_url("/login")));
?>

<?php get_header(); ?>

<?php
// Get the current user's ID
$current_user_id = get_current_user_id();

$meta_key = "liked_by_user_{$current_user_id}";

// Arguments for WP_Query to fetch posts where 'user_id' meta matches the current user
$args = array(
    'post_type' => 'property',  // Replace 'property' with your custom post type
    'meta_query' => array(
        array(
            'key' => $meta_key,   // This is the meta key where the user ID is stored
            'value' => $current_user_id,
            'compare' => '='
        )
    )
);
?>

<div class="w-[75%] gap-20 mx-auto mt-20">
    <h1 class="text-2xl text-blue-700 my-10 font-semibold">Liked Properties</h1>
    <?php get_template_part('templates/content', "cards", array('args' => $args)); ?>
</div>

<?php

$args = array(
    'post_type' => 'agent',  // Replace 'property' with your custom post type
    'meta_query' => array(
        array(
            'key' => $meta_key,   // This is the meta key where the user ID is stored
            'value' => $current_user_id,
            'compare' => '='
        )
    )
);
?>

<div class="w-[75%] gap-20 mx-auto mt-20">
    <h1 class="text-2xl text-blue-700 my-10 font-semibold">Liked Agents</h1>
    <?php get_template_part('templates/content', "cards", array('args' => $args)); ?>
</div>



<?php get_footer(); ?>