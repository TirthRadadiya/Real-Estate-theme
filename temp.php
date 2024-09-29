<?php
// Parse blocks from the content
$blocks = parse_blocks(get_the_content());

// print_r($blocks);

// Loop through blocks to find gallery block
foreach ($blocks as $block) {
    if ($block['blockName'] === 'core/gallery') {
        // Gallery block found
        echo "<br /><br />";

        // Get the image IDs from the gallery
        $image_ids = isset($block['attrs']['ids']) ? $block['attrs']['ids'] : array();

        // Loop through each image ID and get its URL
        foreach ($image_ids as $image_id) {
            $image_url = wp_get_attachment_url($image_id);
            echo '<img src="' . esc_url($image_url) . '" alt="" />';
        }
    }
}

?>

<?php
// Assuming you're already in the post loop and have access to $post_id
// Set up the WP_Query arguments to fetch the attachments (images) for the post
$args = array(
    'post_type' => 'attachment',
    'posts_per_page' => -1, // Retrieve all attachments
    'post_status' => 'inherit',
    'post_parent' => get_the_ID(), // The current post ID
    'post_mime_type' => 'image',  // Only fetch images
    'orderby' => 'menu_order',
    'order' => 'ASC',    // You can change to 'DESC' if needed
);

// The Query
$images_query = new WP_Query($args);

// The Loop
if ($images_query->have_posts()) {
    while ($images_query->have_posts()) {
        $images_query->the_post();

        // Get the image URL
        $image_url = wp_get_attachment_url(get_the_ID());

        // Output the image
        echo '<img src="' . esc_url($image_url) . '" alt="" />';
    }
    wp_reset_postdata();
} else {
    // No images found
    echo 'No images attached to this post.';
}
?>


<?php

$args = array(
    'post_type' => 'attachment',
    'posts_per_page' => -1, // Retrieve all attachments
    'post_parent' => get_the_ID(), // The current post ID
);

// The Query
$images_query = get_posts($args);

print_r($images_query);


if ($images_query) {
    foreach ($images_query as $image) {
        $output = wp_get_attachment_url($image->ID);
        echo $output;
    }
}

?>