<?php 
get_header(); 

// Define the background image URL with escaping
$banner_image_url = esc_url(get_template_directory_uri() . '/assets/images/banner.png');
?>

<div class="relative bg-cover bg-center h-64" style="background-image: url('<?php echo $banner_image_url; ?>');">
    <div class="absolute inset-0 bg-black opacity-80"></div>
    <div class="relative flex flex-col items-center justify-center h-full text-white p-4">
        <div class="text-center md:text-left mb-4 md:mb-0 w-[540px]">
            <p class="text-2xl font-bold mb-3 text-center"><?php esc_html_e( 'Our Talented Agents', 'your-text-domain' ); ?></p>
        </div>
        <div class="flex flex-col md:flex-row justify-center items-center w-full max-w-md">
            <span><a href="<?php echo esc_url( home_url() ); ?>"><?php esc_html_e( 'Home', 'your-text-domain' ); ?></a></span>
            &nbsp; / &nbsp;
            <span class="text-blue-600 hover:text-blue-800">
                <a href="<?php echo esc_url( get_post_type_archive_link( 'property' ) ); ?>">
                    <?php echo str_replace('Archives:', '', get_the_archive_title() ); ?>
                </a>
            </span>
        </div>
    </div>
</div>

<div class="wrapper pt-10">
    <?php
    // Query arguments for displaying agent posts
    $args = array(
        'post_type'  => 'agent',
        'orderby'    => 'date',
        'order'      => 'ASC',
    );

    // Load the content template part for agent cards
    get_template_part( 'templates/content', 'cards', array( 'args' => $args ) );
    ?>
</div>

<?php get_footer(); ?>