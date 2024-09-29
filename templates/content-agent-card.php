<?php if (has_post_thumbnail()) {
    $thumbnail = get_the_post_thumbnail_url();
} ?>

<div class="bg-white shadow-md rounded-lg p-6 text-center hover:border-2 hover:border-green-500
                        transition-all">
    <a href="<?php the_permalink(); ?>">
        <img class="w-24 h-24 rounded-full mx-auto" src="<?php echo $thumbnail; ?>" alt="Grant Marshall" />
        <h3 class="text-xl font-semibold mt-4"><?php the_title(); ?></h3>
        <p class="text-zinc-500">Agents</p>
        <div class="flex justify-center mt-4">
            <a href="<?php echo $post->instagram ?>" class="text-blue-500 mx-2">
                <img src="<?php echo get_template_directory_uri() . "/assets/images/instagram.png"; ?>" />
            </a>
            <a href="<?php echo $post->facebook ?>" class="text-blue-500 mx-2">
                <img src="<?php echo get_template_directory_uri() . "/assets/images/linkedin.png"; ?>" />
            </a>
            <a href="<?php echo $post->pininterest ?>" class="text-blue-500 mx-2">
                <img src="<?php echo get_template_directory_uri() . "/assets/images/pin.png"; ?>" />
            </a>
        </div>
    </a>
</div>