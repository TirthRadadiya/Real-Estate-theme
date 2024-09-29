<div class="absolute rounded-full bg-white w-[36px] h-[36px] top-[20px] right-[20px] flex justify-center items-center z-10 cursor-pointer property-like"
    data-post="<?php the_ID(); ?>" id="liked">
    <?php
    $like = get_post_meta(get_the_ID(), 'liked_by_user_' . get_current_user_id(), true);
    $file_name = empty($like) ? 'heart' : 'like';
    ?>
    <img src="<?php echo get_template_directory_uri() . "/assets/images/{$file_name}.png"; ?>" />
</div>