<?php get_header(); ?>

<div class="hero h-[700px] bdr relative"
    style="background-image: url('<?php echo get_template_directory_uri() . "/assets/images/hero.png" ?>');">
    <div class="content-box absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-white">
        <h1 class="text-4xl mb-7 text-center">Find Your Dream Properties</h1>
        <!-- <div class="form-wrapper w-[920px] bg-white h-[202px]"> -->
        <div class="mx-auto p-6 bg-white text-black rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-4 text-card-foreground">Search Your Properties</h2>
            <form class="flex space-x-4 items-end" method="POST" action="<?php echo home_url('/properties'); ?>">
                <input type="hidden" value="from-home" name="getpage">
                <div class="flex-1">
                    <label for="property_type" class="block mb-2 text-sm font-medium text-muted-foreground">Looking
                        For</label>
                    <select id="property_type" name="property_type"
                        class="mt-1 block w-fit px-3 py-2 border border-border rounded-md shadow-sm focus:ring focus:ring-primary focus:border-primary bg-input text-foreground">
                        <option value="">Property Type</option>
                        <?php
                        $terms = get_terms(array(
                            'taxonomy' => 'apartment-types',
                            'hide_empty' => false,  // Set to true to hide terms with no posts
                        ));

                        if (!empty($terms) && !is_wp_error($terms)) {
                            foreach ($terms as $term) { ?>
                                <option value="<?php echo $term->slug ?>" <?php selected($term->slug, $_POST['property_type'] ?? ''); ?>><?php echo $term->name; ?></option>
                            <?php }
                        }
                        ?>
                    </select>
                </div>
                <div class="flex-1">
                    <label for="property_size" class="block mb-2 text-sm font-medium text-muted-foreground">Property
                        Size</label>
                    <select id="property_size" name="property_size"
                        class="mt-1 block w-fit px-3 py-2 border border-border rounded-md shadow-sm focus:ring focus:ring-primary focus:border-primary bg-input text-foreground">
                        <option value="">Property size</option>
                        <option value="small">Small</option>
                        <option value="medium">Medium</option>
                        <option value="large">Large</option>
                    </select>
                </div>
                <div class="flex-1">
                    <label for="property_location" class="block mb-2 text-sm font-medium text-muted-foreground">Property
                        Location</label>
                    <select id="property_location" name="property_location"
                        class="mt-1 block w-fit px-3 py-2 border border-border rounded-md shadow-sm focus:ring focus:ring-primary focus:border-primary bg-input text-foreground">
                        <option value="">Select location</option>
                        <?php
                        $terms = get_terms(array(
                            'taxonomy' => 'cities',
                            'hide_empty' => false,  // Set to true to hide terms with no posts
                        ));

                        if (!empty($terms) && !is_wp_error($terms)) {
                            foreach ($terms as $term) { ?>
                                <option value="<?php echo $term->slug ?>" <?php selected($term->slug, $_POST['property_location'] ?? ''); ?>><?php echo $term->name; ?></option>
                            <?php }
                        }
                        ?>

                    </select>
                </div>
                <div class="flex-shrink-0">
                    <input type="submit" value="Find Home"
                        class="bg-accent border border-[#10AC84] text-accent-foreground px-4 py-2 rounded-md hover:bg-accent/80" />
                </div>
            </form>
        </div>
        <!-- </div> -->
    </div>
</div>

<div class="wrapper">
    <div class="property-section p-10">
        <div class="info w-[646px] mx-auto text-center">
            <p class="text-[38px] font-700 mb-5">Our Feature Property</p>
            <p class="text-center text-[18px]">There are many variations of passages of Lorem Ipsum available
                but the this in majority have suffered
                alteration in some</p>
        </div>
        <div class="w-[1110px] my-10 mx-auto">
            <?php get_template_part('templates/content', "cards", array(
                "posts" => 4,
                'args' => array(
                    'post_type' => 'property',
                    'posts_per_page' => 4,
                    'orderby' => 'date',
                )
            )); ?>
        </div>
        <div class="flex justify-center m-10"><a href="<?php echo get_post_type_archive_link('property'); ?>"><button
                    class="btn btn-primary">See More Property</button></a></div>
    </div>
</div>



<div class="relative bg-cover bg-center h-64"
    style="background-image: url('<?php echo get_template_directory_uri() ?>/assets/images/mask.png');">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="relative flex flex-col items-center justify-center h-full text-white p-4">
        <div class="flex flex-col md:flex-row items-center w-full max-w-md">
            <div class="text-center md:text-left md:mr-4 mb-4 md:mb-0 w-[540px]">
                <p class="text-2xl font-bold">Subscribe Our Email Address
                    For Future Latest News & Updates</p>
            </div>
            <div class="flex w-full max-w-md">
                <input type="email" placeholder="Type your email address"
                    class="flex-grow p-2 rounded-l-lg border border-border focus:outline-none focus:ring focus:ring-primary bg-input text-foreground" />
                <button class="bg-primary text-primary-foreground p-2 rounded-r-lg hover:bg-primary/80">
                    ➔
                </button>
            </div>
        </div>
    </div>
</div>

<div class="wrapper mx-auto mt-10 p-10">
    <div class="flex items-center">
        <div class="px-10 py-5">
            <h2 class="text-2xl font-bold">Recommended For You</h2>
            <p class="text-muted-foreground mb-4">There are many variations of passages of Lorem Ipsum available but the
                majority have suffered alteration in some</p>
        </div>
        <button class="btn btn-primary">See More
            Property</button>
    </div>
    <div class="bg-card flex property-slider">

        <?php

        $sliderProperty = new WP_Query(array(
            'offset' => 1,
            'posts_per_page' => 3,
            'post_type' => 'property',
            'order' => 'ASC'
        ));

        if ($sliderProperty->have_posts()) {
            while ($sliderProperty->have_posts()) {
                $sliderProperty->the_post(); ?>
                <a href="<?php the_permalink(); ?>" class="property-slide">
                    <div class="flex my-5">
                        <div class="p-6 bg-[#25517A] text-white rounded-lg rounded-tr-[0] rounded-br-[0] flex-1">
                            <span class="text-sm bg-white text-black px-3 py-2 mb-3 rounded-md">05/01</span>
                            <h3 class="text-lg font-semibold mt-5"><?php the_title(); ?></h3>
                            <p class="text-xl font-bold mt-2">$3200</p>
                            <p class="mt-2"><?php the_excerpt() ?></p>
                            <address class="mt-4">
                                <span>🏠 <?php echo $post->address ?></span>
                            </address>
                            <div class="mt-4 flex space-x-4">
                                <span>🛏️ 4 Bed</span>
                                <span>🛁 3 Bath</span>
                                <span>📏 1574 sq</span>
                                <span>🏢 8 Rooms</span>
                            </div>
                        </div>
                        <div class="flex-none md:w-1/3">
                            <img aria-hidden="true" alt="Interior of Bravo Apollo Apartments"
                                src="<?php echo get_template_directory_uri() . '/assets/images/slider.png' ?>"
                                class="rounded-lg rounded-tl-[0] rounded-bl-[0] object-cover w-full h-full" />
                        </div>
                    </div>
                </a>
            <?php }
            wp_reset_postdata();
        }

        ?>


    </div>
    <div class="flex justify-between items-center">

        <div class="flex items-center space-x-2">
            <button class="bg-muted text-muted-foreground shadow-xl rounded-full p-2 hover:bg-muted/80"
                id="prev">←</button>
            <button class="bg-muted text-muted-foreground shadow-xl rounded-full p-2 hover:bg-muted/80"
                id="next">→</button>
        </div>
    </div>
</div>


<div class="bg-[#FAF8FB]">
    <div class="container wrapper mx-auto py-10 px-4">
        <h1 class="text-3xl font-bold text-center mb-4 text-foreground">Find Properties In These Cities</h1>
        <p class="text-center text-muted-foreground mb-10">There are many variations of passages of Lorem Ipsum
            available
            but the this in majority have suffered alteration in some</p>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <?php
            $taxonomy = 'cities';  // The id of custom taxonomy
            $terms = get_terms(array(
                'taxonomy' => $taxonomy,
                'hide_empty' => false,  // Set to true to hide terms with no posts
                'number' => 6,
            ));

            if (!empty($terms) && !is_wp_error($terms)) {
                foreach ($terms as $term) {
                    $upload_image = get_term_meta($term->term_id, 'term_image', true);
                    $src = !empty($upload_image) ? $upload_image : get_template_directory_uri() . '/assets/images/card.png';
                    ?>

                    <a href="<?php echo get_term_link($term) ?>">
                        <div class="relative overflow-hidden rounded-lg shadow-lg card">
                            <img src="<?php echo $src ?>" alt="Las Vegas" class="w-full h-full object-cover" />
                            <div class="absolute bottom-0 left-0 p-4 z-10 text-white items-center">
                                <img aria-hidden="true" alt="location-pin"
                                    src="<?php echo get_theme_file_uri("/assets/images/location-pin-white.png") ?>"
                                    class="inline-block mr-2" /><?php echo $term->name ?><br />
                                <?php if ($term->count > 0)
                                    echo '<span class="text-sm">(We have ' . $term->count . ' properties)</span>'; ?>
                            </div>
                        </div>
                    </a>

                    <?php
                    // echo '<p>' . esc_html($term->name) . '</p>';  // Display the term name
                    // print_r($term);
                }
            }

            ?>
        </div>
        <div class="text-center mt-10">
            <a href="<?php echo get_theme_file_uri("/taxonomy-city.php"); ?>">
                <button class="btn btn-primary">See All Cities</button>
            </a>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-10">
    <div class="wrapper">
        <h2 class="text-3xl font-bold text-center text-zinc-800 mt-10">Meet Our Popular Agents</h2>
        <p class="text-center text-zinc-600 mt-2">There are many variations of passages of Lorem Ipsum available but the
            this in majority have suffered alteration in some</p>
        <br /><br />


        <?php
        $args = array(
            'post_type' => "agent",
            'orderby' => 'date',
            'order' => 'ASC',
        );

        get_template_part("templates/content", "cards", array('posts' => 3, 'args' => $args));

        ?>


        <div class="text-center my-14">
            <a href="<?php echo esc_url(site_url("/agents")); ?>" class="btn btn-primary">See All Agents</a>
        </div>
    </div>
</div>


<div class="bg-green-500 text-white p-8 flex flex-col md:flex-row items-center">
    <div class="wrapper grid grid-cols-2">
        <div class="flex flex-col justify-center">
            <h1 class="text-3xl font-bold mb-4">Buy or sell property anytime from anywhere</h1>
            <p class="text-lg mb-6">
                There are many variations of passages of Lorem Ipsum available but the majority have suffered alteration
                in
                some form by injected humour in the east randomised words slightly believable.
            </p>
            <div class="flex space-x-4">
                <a href="#" class="bg-white text-green-500 py-2 px-4 rounded-lg shadow hover:bg-zinc-100 transition">
                    <img src="https://openui.fly.dev/openui/google-play.svg?text=Google+Play" alt="Google Play"
                        class="inline-block mr-2" />
                    Google Play
                </a>
                <a href="#" class="bg-white text-green-500 py-2 px-4 rounded-lg shadow hover:bg-zinc-100 transition">
                    <img src="https://openui.fly.dev/openui/apple-store.svg?text=Apple+Store" alt="Apple Store"
                        class="inline-block mr-2" />
                    Apple Store
                </a>
            </div>
        </div>
        <div class="flex justify-center mt-8 md:mt-0">
            <img src="https://placehold.co/400x600" alt="Mobile App Preview" class="rounded-lg shadow-lg" />
        </div>
    </div>
</div>

<div class="container mx-auto px-4">
    <div class="wrapper py-20">
        <h1 class="text-3xl mt-10 font-bold text-center mb-4">Our Latest Property News</h1>
        <p class="text-center text-muted-foreground mb-8">There are many variations of passages of Lorem Ipsum available
            but
            this in majority have suffered alteration in some</p>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <?php
            $posts = new WP_Query(array(
                'posts_per_page' => 3,
                'post_type' => 'post',
                'orderby' => 'date',
                'order' => 'ASC'
            ));

            if ($posts->have_posts()) {
                while ($posts->have_posts()) {
                    $posts->the_post(); ?>
                    <div class="relative bg-card rounded-lg shadow-lg overflow-hidden">
                        <img src="<?php echo get_the_post_thumbnail_url() ?>" alt="Property 1"
                            class="w-full h-40 object-cover" />
                        <div
                            class="absolute top-2 left-2 bg-[#10AC84] text-white text-accent-foreground inline-block px-2 py-1 rounded-full">
                            <?php the_date('d M'); ?>
                        </div>
                        <div class="p-4 mt-5">
                            <h2 class="font-semibold"><?php the_title(); ?></h2>
                            <p class="text-muted-foreground"><?php the_excerpt(); ?></p>
                        </div>
                    </div>
                <?php }
            }
            ?>
        </div>
    </div>
</div>


<?php get_footer(); ?>