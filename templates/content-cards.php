<?php
$num_cols = ( isset( $args['args']['post_type'] ) && 'agent' === $args['args']['post_type'] ) ? 3 : 2;
?>

<div class="grid grid-cols-<?php echo esc_attr( $num_cols ); ?> gap-5">
    <?php
    $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

    $posts_num = isset( $args['posts'] ) ? $args['posts'] : get_option( 'posts_per_page' );

    $values = isset( $args['filters'] ) ? $args['filters'] : $args['args'];

    $values['posts_per_page'] = $posts_num;
    $values['paged'] = $paged;

    // Uncomment to use liked posts.
    // if ( isset( $args['liked_posts'] ) ) {
    //     $values = $args['liked_posts'];
    // }

    $searched_posts = new WP_Query( $values );

    if ( $searched_posts->have_posts() ) {
        while ( $searched_posts->have_posts() ) {
            $searched_posts->the_post();

            if ( 'property' === get_post_type( get_the_ID() ) ) {
                get_template_part( 'templates/content', 'property-card' );
            } else {
                get_template_part( 'templates/content', 'agent-card' );
            }
        }

        $total_pages = $searched_posts->max_num_pages;
    } else {
        echo '<h1 class="text-center text-xl w-full">' . esc_html__( 'Whoa!! You have a very specific choice. Let\'s connect to serve you better.', 'your-textdomain' ) . '</h1>';
    }
    ?>
</div>

<div class="w-fit mx-auto my-5">
    <?php
    if ( ! $searched_posts->have_posts() ) {
        return;
    }

    if ( $total_pages > 1 && ! is_home() ) {
        $current_page = max( 1, get_query_var( 'paged' ) );

        echo paginate_links(
            array(
                'base'      => esc_url( get_pagenum_link( 1 ) ) . '%_%',
                'format'    => '/page/%#%',
                'current'   => $current_page,
                'total'     => $total_pages,
                'prev_text' => __( '« prev', 'your-textdomain' ),
                'next_text' => __( 'next »', 'your-textdomain' ),
            )
        );
    }

    wp_reset_postdata();
    ?>
</div>