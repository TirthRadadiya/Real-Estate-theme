<?php
if ( ! is_user_logged_in() ) {
    wp_safe_redirect( esc_url( site_url( '/login' ) ) );
    exit;
}
?>

<?php get_header(); ?>

<?php
// Get the current user's ID
$current_user_id = get_current_user_id();
$meta_key = "liked_by_user_{$current_user_id}";

// Arguments for WP_Query to fetch liked properties
$property_args = array(
    'post_type'  => 'property',
    'meta_query' => array(
        array(
            'key'     => $meta_key,
            'value'   => $current_user_id,
            'compare' => '='
        )
    )
);
?>

<div class="w-[75%] gap-20 mx-auto mt-20">
    <h1 class="text-2xl text-blue-700 my-10 font-semibold"><?php esc_html_e( 'Liked Properties', 'textdomain' ); ?></h1>
    <?php get_template_part( 'templates/content', 'cards', array( 'args' => $property_args ) ); ?>
</div>

<?php
// Arguments for WP_Query to fetch liked agents
$agent_args = array(
    'post_type'  => 'agent',
    'meta_query' => array(
        array(
            'key'     => $meta_key,
            'value'   => $current_user_id,
            'compare' => '='
        )
    )
);
?>

<div class="w-[75%] gap-20 mx-auto mt-20">
    <h1 class="text-2xl text-blue-700 my-10 font-semibold"><?php esc_html_e( 'Liked Agents', 'textdomain' ); ?></h1>
    <?php get_template_part( 'templates/content', 'cards', array( 'args' => $agent_args ) ); ?>
</div>

<?php get_footer(); ?>