<div 
    class="absolute rounded-full bg-white w-[36px] h-[36px] top-[20px] right-[20px] flex justify-center items-center z-10 cursor-pointer property-like" 
    data-post="<?php the_ID(); ?>" 
    id="liked"
>
    <?php
    $current_user_id = get_current_user_id();
    $is_liked = get_post_meta(get_the_ID(), 'liked_by_user_' . $current_user_id, true);
    $icon_file = empty($is_liked) ? 'heart' : 'like';
    ?>
    <img src="<?php echo esc_url(get_template_directory_uri() . "/assets/images/{$icon_file}.png"); ?>" alt="like-icon" />
</div>