<?php get_header(); ?>

<div class="relative h-64 bg-cover bg-center" 
    style="background-image: url('<?php echo get_template_directory_uri() ?>/assets/images/banner.png');">
    <div class="absolute inset-0 bg-black opacity-80"></div>
    <div class="relative flex flex-col items-center justify-center h-full text-white p-4">
        <div class="w-[540px] text-center md:text-left mb-4 md:mb-0">
            <p class="text-2xl font-bold text-center mb-3">Property Details</p>
        </div>
        <div class="flex flex-col md:flex-row justify-center items-center w-full max-w-md">
            <a href="<?php echo esc_url(site_url()); ?>">Home</a>&nbsp; / &nbsp;
            <a href="<?php echo esc_url(site_url("/city")); ?>">City</a>&nbsp; / &nbsp;
            <a href="<?php echo esc_url(get_post_type_archive_link('property')); ?>" 
               class="text-blue-600 hover:text-blue-800">
               <?php echo str_replace('City:', '', get_the_archive_title()); ?>
            </a>
        </div>
    </div>
</div>

<div class="w-[1110px] my-10 mx-auto">
    <div class="grid grid-cols-2 gap-5">
        <?php 
        while (have_posts()) {
            the_post(); 
            get_template_part('templates/content', 'property-card');                
        }
        ?>
    </div>
</div>

<?php get_footer(); ?>