<?php $numCols = @$args['args']['post_type'] === 'agent' ? 3 : 2; ?>

<div class="grid grid-cols-<?php echo $numCols; ?> gap-5">
    <?php

    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    $posts_num = @$args['posts'] ? $args['posts'] : get_option('posts_per_page');

    $values = isset($args['filters']) ? $args['filters'] : $args['args'];

    $values['posts_per_page'] = $posts_num;

    $values['paged'] = $paged;

    // if (@$args['liked_posts']) {
    //     $values = $args['liked_posts'];
    // }
    
    $searched_posts = new WP_Query($values);

    if ($searched_posts->have_posts()) {
        while ($searched_posts->have_posts()) {
            $searched_posts->the_post();
            get_post_type(get_the_ID()) == 'property' ? get_template_part('templates/content', "property-card") : get_template_part('templates/content', "agent-card");
        }

        $total_pages = $searched_posts->max_num_pages;

    } else {
        echo '<h1 class="text-center text-xl w-full">Whoaa!! You got very specific choice. Let\'s Connect to serve you better.</h1>';
    }

    ?>
</div>

<div class="w-fit mx-auto my-5">
    <?php
    if(!$searched_posts->have_posts()) return;
    if ($total_pages > 1 && !is_home()) {

        $current_page = max(1, get_query_var('paged'));

        echo paginate_links(array(
            'base' => get_pagenum_link(1) . '%_%',
            'format' => '/page/%#%',
            'current' => $current_page,
            'total' => $total_pages,
            'prev_text' => __('« prev'),
            'next_text' => __('next »'),
        ));
    }

    wp_reset_postdata();
    ?>
</div>