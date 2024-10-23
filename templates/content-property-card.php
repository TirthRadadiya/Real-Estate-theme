<div class="w-[540px] shadow-lg hover:shadow-xl transition-shadow relative">

    <?php
    include get_template_directory() . "/inc/like-post.php"; ?>
    <a href="<?php the_permalink(); ?>" class="relative">
        <div class="relative">
            <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id($post->ID), 'thumbnail'); ?>"
                class="h-[225px] w-full" alt="">
            <div class="w-[114px] h-[48px] bdr absolute bottom-[20px] left-[20px]"></div>
        </div>

        <div class="card-content pt-10 pb-5 px-5">
            <h3 class="text-xl font-500"><?php the_title(); ?></h3>
            <p class="my-5"><?php the_excerpt(); ?></p>
            <div class="flex items-center">
                <span><img src="<?php echo get_theme_file_uri("/assets/images/location-pin.png") ?>" alt=""></span>
                <p class="m-3"><?php echo $post->address; ?></p>
            </div>
        </div>
        <hr class="w-[492px] mx-auto bg-[#D3DEE8]">
        <?php require get_template_directory() . "/inc/card-icon.php"; ?>
    </a>
</div>