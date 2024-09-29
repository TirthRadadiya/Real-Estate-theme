<?php get_header(); ?>

<?php
while (have_posts()) {
    the_post(); ?>
    <div class="relative bg-cover bg-center h-64"
        style="background-image: url('<?php echo get_template_directory_uri() ?>/assets/images/banner.png');">
        <div class="absolute inset-0 bg-black opacity-80"></div>
        <div class="relative flex flex-col items-center justify-center h-full text-white p-4">
            <div class="text-center md:text-left md:mr-4 mb-4 md:mb-0 w-[540px]">
                <p class="text-2xl font-bold text-center mb-3">Property Details</p>
            </div>
            <div class="flex flex-col md:flex-row justify-center items-center w-full max-w-md">
                <span><a href="<?php echo esc_url(site_url()); ?>">Home</a></span>&nbsp; / &nbsp;<span
                    class="text-blue-600 hover:text-blue-800"><a
                        href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
            </div>
        </div>
    </div>

    <div class="w-[1110px] mx-auto mt-10">
        <div class="w-full">
            <img src="<?php echo get_the_post_thumbnail_url(); ?>" class="w-full mx-auto " />
        </div>
        <div class="flex justify-between py-10 items-center">
            <p class="text-4xl font-bold"><?php the_title(); ?></p>
            <p class="text-[#0984E3] text-xl font-semibold">$2000.00</p>
        </div>
        <hr class="h-px bg-[#D3DEE8] border-0 dark:bg-[#D3DEE8]">
        <div class="h-[288px] mt-10 single-proprty-detail">
            <h1 class="text-xl font-semibold">Property Overview</h1>
            <?php
            $paragraph_blocks = find_blocks_of_post(
                parse_blocks(get_the_content()),
                'core/paragraph'
            );

            if (!empty($paragraph_blocks)) {
                foreach ($paragraph_blocks as $block) {
                    echo $block['innerHTML'];
                }
            } else {
                echo get_the_content();
            }

            ?>
        </div>
        <div class="mt-10">
            <p class="text-xl font-semibold my-5">Property Features</p>
            <div class="flex space-x-4">
                <div class="flex items-center p-4 border border-zinc-300 rounded-lg bg-white dark:bg-card">
                    <img aria-hidden="true" alt="bed-icon"
                        src="<?php echo get_theme_file_uri("/assets/images/bed-blue.png") ?>" class="mr-2" />
                    <span class="text-black">4 Bed</span>
                </div>
                <div class="flex items-center p-4 border border-zinc-300 rounded-lg bg-white dark:bg-card">
                    <img aria-hidden="true" alt="bath-icon"
                        src="<?php echo get_theme_file_uri("/assets/images/bath-icon-blue.png") ?>" class="mr-2" />
                    <span class="text-black">3 Bath</span>
                </div>
                <div class="flex items-center p-4 border border-zinc-300 rounded-lg bg-white dark:bg-card">
                    <img aria-hidden="true" alt="rooms-icon"
                        src="<?php echo get_theme_file_uri("/assets/images/room-icon-blue.png") ?>" class="mr-2" />
                    <span class="text-black">8 Rooms</span>
                </div>
                <div class="flex items-center p-4 border border-zinc-300 rounded-lg bg-white dark:bg-card">
                    <img aria-hidden="true" alt="square-footage-icon"
                        src="<?php echo get_theme_file_uri("/assets/images/area-icon-blue.png") ?>" class="mr-2" />
                    <span class="text-black">1574 sq</span>
                </div>
            </div>
        </div>
        <div class="my-10 py-5">
            <p class="text-xl font-semibold my-5">Property Gallery</p>
            <div class="grid grid-cols-2">
                <?php
                /***
                 * get data of specified blocks
                 */
                // $blocks = find_blocks_of_post(
                //     parse_blocks(get_the_content()),
                //     'core/image'
                // );
            
                // foreach ($blocks as $block) {
                //     echo '<div class="m-3">' . $block['innerHTML'] . '</div>';
                // }
            
                $images = new WP_Query(array(
                    'post_type' => 'attachment',
                    'posts_per_page' => -1, // Retrieve all attachments
                    'post_status' => 'inherit',
                    'post__not_in' => array(get_post_thumbnail_id()),
                    'post_parent' => get_the_ID(), // The current post ID
                    'post_mime_type' => 'image',  // Only fetch images
                    'orderby' => 'menu_order',
                    'order' => 'ASC',    // You can change to 'DESC' if needed
                ));

                if ($images->have_posts()) {
                    while ($images->have_posts()) {
                        $images->the_post();

                        // Get the image URL
                        $image_url = wp_get_attachment_url(get_the_ID());

                        // Output the image
                        echo '<img src="' . esc_url($image_url) . '" alt="" />';
                    }
                    wp_reset_postdata();
                }

                // print_r($images);
            
                ?>
            </div>
        </div>
    </div>

<?php }
?>

<?php get_footer(); ?>