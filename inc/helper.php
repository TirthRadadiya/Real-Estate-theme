<?php

function get_page_banner($title, $link)
{
    ob_start(); ?>
    <div class="relative bg-cover bg-center h-64"
        style="background-image: url('<?php echo get_template_directory_uri() ?>/assets/images/banner.png');">
        <div class="absolute inset-0 bg-black opacity-80"></div>
        <div class="relative flex flex-col items-center justify-center h-full text-white p-4">
            <div class="text-center md:text-left md:mr-4 mb-4 md:mb-0 w-[540px]">
                <p class="text-2xl font-bold text-center mb-3">Property Details</p>
            </div>
            <div class="flex flex-col md:flex-row justify-center items-center w-full max-w-md">
                <span><a href="<?php echo esc_url(site_url()); ?>">Home</a></span>&nbsp; / &nbsp;<span class="text-blue-600 hover:text-blue-800"><a
                        href="<?php echo $link ?>"><?php echo str_replace('Archives:', '', $title); ?></a></span>
            </div>
        </div>
    </div>
    <?php return ob_get_clean();
}

function find_blocks_of_post($blocks, $type)
{
    $matches = [];

    foreach ($blocks as $block) {
        if ($block['blockName'] === $type) {
            $matches[] = $block;
        }


        if (count($block['innerBlocks'])) {
            $matches = array_merge(
                $matches,
                find_blocks_of_post($block['innerBlocks'], $type)
            );
        }
    }

    return $matches;
}


/**
 * Handle single file upload and attachment creation.
 *
 * @param array $file The file array from $_FILES.
 * @param int   $post_id The ID of the post to attach the file to.
 * @return int|bool Attachment ID on success, false on failure.
 */
function handle_file_upload($file, $post_id = 0) {
    $allowed_file_types = array('image/png', 'image/jpeg', 'image/jpg', 'image/gif');

    if (!in_array($file['type'], $allowed_file_types)) {
        return new WP_Error('invalid_file_type', 'File type not allowed.');
    }

    $upload = wp_upload_bits($file["name"], null, file_get_contents($file["tmp_name"]));

    if ($upload['error']) {
        return new WP_Error('upload_error', $upload['error']);
    }

    $filename = $upload['file'];
    $wp_filetype = wp_check_filetype($filename, null);
    $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title'     => sanitize_file_name($filename),
        'post_content'   => '',
        'post_status'    => 'inherit',
        'guid'           => $upload['url']
    );

    $attachment_id = wp_insert_attachment($attachment, $filename, $post_id);

    if (is_wp_error($attachment_id)) {
        return $attachment_id;
    }

    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $attachment_data = wp_generate_attachment_metadata($attachment_id, $filename);
    wp_update_attachment_metadata($attachment_id, $attachment_data);

    return $attachment_id;
}