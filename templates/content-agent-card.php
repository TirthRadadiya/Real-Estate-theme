<?php if (has_post_thumbnail()) : 
    $thumbnail = get_the_post_thumbnail_url(); 
else : 
    $thumbnail = get_template_directory_uri() . '/assets/images/default-avatar.png'; // Fallback image
endif;
?>

<div class="bg-white shadow-md rounded-lg p-6 text-center hover:border-2 hover:border-green-500 transition-all">
    <a href="<?php the_permalink(); ?>">
        <img class="w-24 h-24 rounded-full mx-auto" src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
        
        <h3 class="text-xl font-semibold mt-4"><?php the_title(); ?></h3>
        <p class="text-zinc-500">Agents</p>

        <div class="flex justify-center mt-4">
            <?php 
            $social_links = [
                'instagram' => 'instagram.png',
                'facebook' => 'linkedin.png',
                'pininterest' => 'pin.png'
            ];
            
            foreach ($social_links as $social => $icon) :
                $link = esc_url($post->$social);
                if (!empty($link)) : ?>
                    <a href="<?php echo $link; ?>" class="text-blue-500 mx-2">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/' . $icon); ?>" alt="<?php echo ucfirst($social); ?> icon" />
                    </a>
                <?php endif;
            endforeach; 
            ?>
        </div>
    </a>
</div>