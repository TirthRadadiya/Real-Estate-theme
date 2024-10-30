<?php
$thumbnail = has_post_thumbnail() 
    ? get_the_post_thumbnail_url() 
    : get_template_directory_uri() . '/assets/images/default-avatar.png'; // Fallback image
?>

<div class="bg-white shadow-md rounded-lg p-6 text-center hover:border-2 hover:border-green-500 transition-all">
    <a href="<?php the_permalink(); ?>">
        <img class="w-24 h-24 rounded-full mx-auto" src="<?php echo esc_url( $thumbnail ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" />

        <h3 class="text-xl font-semibold mt-4"><?php the_title(); ?></h3>
        <p class="text-zinc-500">Agents</p>

        <div class="flex justify-center mt-4">
            <?php
            // Define social links with their respective icon filenames
            $social_links = [
                'instagram'  => 'instagram.png',
                'facebook'   => 'linkedin.png',
                'pinterest'  => 'pin.png'
            ];

            foreach ( $social_links as $social => $icon ) :
                $link = get_post_meta( get_the_ID(), $social, true ); // Retrieve the link from post meta

                if ( ! empty( $link ) ) : ?>
                    <a href="<?php echo esc_url( $link ); ?>" class="text-blue-500 mx-2" target="_blank" rel="noopener noreferrer">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/' . $icon ); ?>" alt="<?php echo esc_attr( ucfirst( $social ) ); ?> icon" />
                    </a>
                <?php endif;
            endforeach;
            ?>
        </div>
    </a>
</div>