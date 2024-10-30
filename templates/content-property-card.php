<div class="w-[540px] shadow-lg hover:shadow-xl transition-shadow relative">

    <?php get_template_part('inc/like-post'); ?>

    <a href="<?php the_permalink(); ?>" class="relative">
        <div class="relative">
            <?php if (has_post_thumbnail()) : ?>
                <img src="<?php echo esc_url( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ), 'thumbnail' ) ); ?>"
                     class="h-[225px] w-full"
                     alt="<?php echo esc_attr( 'Image for ' . get_the_title() ); ?>">
            <?php endif; ?>
            
            <div class="w-[114px] h-[48px] bdr absolute bottom-[20px] left-[20px]"></div>
        </div>

        <div class="card-content pt-10 pb-5 px-5">
            <h3 class="text-xl font-medium"><?php the_title(); ?></h3>
            <p class="my-5"><?php the_excerpt(); ?></p>
            
            <div class="flex items-center">
                <img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/location-pin.png' ) ); ?>"
                     alt="<?php esc_attr_e( 'Location pin', 'your-text-domain' ); ?>"
                     class="mr-3">
                <p><?php echo esc_html( get_post_meta( get_the_ID(), 'address', true ) ); ?></p>
            </div>
        </div>

        <hr class="w-[492px] mx-auto bg-[#D3DEE8]">
        
        <?php get_template_part('inc/card-icon'); ?>
    </a>
</div>