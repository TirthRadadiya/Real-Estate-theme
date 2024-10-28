<?php get_header(); ?>

<div class="hero h-[700px] bdr relative"
    style="background-image: url('<?php echo esc_url( get_template_directory_uri() . "/assets/images/hero.png" ); ?>');">
    <div class="content-box absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-white">
        <h1 class="text-4xl mb-7 text-center"><?php esc_html_e( 'Find Your Dream Properties', 'your-textdomain' ); ?></h1>
        <div class="mx-auto p-6 bg-white text-black rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-4 text-card-foreground"><?php esc_html_e( 'Search Your Properties', 'your-textdomain' ); ?></h2>
            <form class="flex space-x-4 items-end" method="POST" action="<?php echo esc_url( home_url( '/properties' ) ); ?>">
                <input type="hidden" value="from-home" name="getpage">
                <div class="flex-1">
                    <label for="property_type" class="block mb-2 text-sm font-medium text-muted-foreground">
                        <?php esc_html_e( 'Looking For', 'your-textdomain' ); ?>
                    </label>
                    <select id="property_type" name="property_type"
                        class="mt-1 block w-fit px-3 py-2 border border-border rounded-md shadow-sm focus:ring focus:ring-primary focus:border-primary bg-input text-foreground">
                        <option value=""><?php esc_html_e( 'Property Type', 'your-textdomain' ); ?></option>
                        <?php
                        $terms = get_terms( array(
                            'taxonomy'   => 'apartment-types',
                            'hide_empty' => false,
                        ) );

                        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                            foreach ( $terms as $term ) {
                                ?>
                                <option value="<?php echo esc_attr( $term->slug ); ?>" 
                                    <?php selected( $term->slug, isset( $_POST['property_type'] ) ? sanitize_text_field( wp_unslash( $_POST['property_type'] ) ) : '' ); ?>>
                                    <?php echo esc_html( $term->name ); ?>
                                </option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="flex-1">
                    <label for="property_size" class="block mb-2 text-sm font-medium text-muted-foreground">
                        <?php esc_html_e( 'Property Size', 'your-textdomain' ); ?>
                    </label>
                    <select id="property_size" name="property_size"
                        class="mt-1 block w-fit px-3 py-2 border border-border rounded-md shadow-sm focus:ring focus:ring-primary focus:border-primary bg-input text-foreground">
                        <option value=""><?php esc_html_e( 'Property size', 'your-textdomain' ); ?></option>
                        <option value="small" <?php selected( 'small', isset( $_POST['property_size'] ) ? sanitize_text_field( wp_unslash( $_POST['property_size'] ) ) : '' ); ?>>
                            <?php esc_html_e( 'Small', 'your-textdomain' ); ?>
                        </option>
                        <option value="medium" <?php selected( 'medium', isset( $_POST['property_size'] ) ? sanitize_text_field( wp_unslash( $_POST['property_size'] ) ) : '' ); ?>>
                            <?php esc_html_e( 'Medium', 'your-textdomain' ); ?>
                        </option>
                        <option value="large" <?php selected( 'large', isset( $_POST['property_size'] ) ? sanitize_text_field( wp_unslash( $_POST['property_size'] ) ) : '' ); ?>>
                            <?php esc_html_e( 'Large', 'your-textdomain' ); ?>
                        </option>
                    </select>
                </div>

                <div class="flex-1">
                    <label for="property_location" class="block mb-2 text-sm font-medium text-muted-foreground">
                        <?php esc_html_e( 'Property Location', 'your-textdomain' ); ?>
                    </label>
                    <select id="property_location" name="property_location"
                        class="mt-1 block w-fit px-3 py-2 border border-border rounded-md shadow-sm focus:ring focus:ring-primary focus:border-primary bg-input text-foreground">
                        <option value=""><?php esc_html_e( 'Select location', 'your-textdomain' ); ?></option>
                        <?php
                        $terms = get_terms( array(
                            'taxonomy'   => 'cities',
                            'hide_empty' => false,
                        ) );

                        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                            foreach ( $terms as $term ) {
                                ?>
                                <option value="<?php echo esc_attr( $term->slug ); ?>"
                                    <?php selected( $term->slug, isset( $_POST['property_location'] ) ? sanitize_text_field( wp_unslash( $_POST['property_location'] ) ) : '' ); ?>>
                                    <?php echo esc_html( $term->name ); ?>
                                </option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="flex-shrink-0 cursor-pointer">
                    <input type="submit" value="<?php esc_attr_e( 'Find Home', 'your-textdomain' ); ?>"
                        class="bg-accent border border-[#10AC84] text-accent-foreground px-4 py-2 rounded-md hover:bg-accent/80" />
                </div>
            </form>
        </div>
    </div>
</div>

<div class="wrapper" id="featured-property">
    <div class="property-section p-10">
        <div class="info w-[646px] mx-auto text-center">
            <p class="text-[38px] font-700 mb-5"><?php esc_html_e( 'Our Feature Property', 'your-textdomain' ); ?></p>
            <p class="text-center text-[18px]">
                <?php esc_html_e( 'There are many variations of passages of Lorem Ipsum available but the this in majority have suffered alteration in some', 'your-textdomain' ); ?>
            </p>
        </div>
        <div class="w-[1110px] my-10 mx-auto">
            <?php 
            get_template_part( 'templates/content', 'cards', array(
                'posts' => 4,
                'args'  => array(
                    'post_type'      => 'property',
                    'posts_per_page' => 4,
                    'orderby'        => 'date',
                ),
            ) ); 
            ?>
        </div>
        <div class="flex justify-center m-10">
            <a href="<?php echo esc_url( get_post_type_archive_link( 'property' ) ); ?>">
                <button class="btn btn-primary">
                    <?php esc_html_e( 'See More Property', 'your-textdomain' ); ?>
                </button>
            </a>
        </div>
    </div>
</div>

<div class="relative bg-cover bg-center h-64"
    style="background-image: url('<?php echo esc_url( get_template_directory_uri() . '/assets/images/mask.png' ); ?>');">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="relative flex flex-col items-center justify-center h-full text-white p-4">
        <div class="flex flex-col md:flex-row items-center w-full max-w-md">
            <div class="text-center md:text-left md:mr-4 mb-4 md:mb-0 w-[540px]">
                <p class="text-2xl font-bold">
                    <?php esc_html_e( 'Subscribe Our Email Address For Future Latest News & Updates', 'your-textdomain' ); ?>
                </p>
            </div>
            <div class="flex w-full max-w-md">
                <input type="email" placeholder="<?php esc_attr_e( 'Type your email address', 'your-textdomain' ); ?>"
                    class="flex-grow p-2 rounded-l-lg border border-border focus:outline-none focus:ring focus:ring-primary bg-input text-foreground" />
                <button class="bg-[#10AC84] text-primary-foreground p-2 rounded-r-lg hover:bg-primary/80">
                    ➔
                </button>
            </div>
        </div>
    </div>
</div>

<div class="wrapper mx-auto mt-10 p-10">
    <div class="flex items-center">
        <div class="px-10 py-5">
            <h2 class="text-2xl font-bold">
                <?php esc_html_e( 'Recommended For You', 'your-textdomain' ); ?>
            </h2>
            <p class="text-muted-foreground mb-4">
                <?php esc_html_e( 'There are many variations of passages of Lorem Ipsum available but the majority have suffered alteration in some', 'your-textdomain' ); ?>
            </p>
        </div>
        <a href="<?php echo esc_url( get_post_type_archive_link( 'property' ) ); ?>">
            <button class="btn btn-primary">
                <?php esc_html_e( 'See More Property', 'your-textdomain' ); ?>
            </button>
        </a>
    </div>

    <div class="bg-card flex property-slider" id="property-slider">
        <?php
        $slider_property = new WP_Query( array(
            'offset'         => 1,
            'posts_per_page' => 3,
            'post_type'      => 'property',
            'order'          => 'ASC',
        ) );

        if ( $slider_property->have_posts() ) :
            while ( $slider_property->have_posts() ) :
                $slider_property->the_post();
                ?>
                <a href="<?php the_permalink(); ?>" class="property-slide">
                    <div class="flex my-5">
                        <div class="p-6 bg-[#25517A] text-white rounded-lg rounded-tr-[0] rounded-br-[0] flex-1">
                            <span class="text-sm bg-white text-black px-3 py-2 mb-3 rounded-md">
                                <?php echo esc_html( get_the_date( 'm/d' ) ); ?>
                            </span>
                            <h3 class="text-lg font-semibold mt-5"><?php the_title(); ?></h3>
                            <p class="text-xl font-bold mt-2">$3200</p>
                            <p class="mt-2"><?php the_excerpt(); ?></p>
                            <address class="mt-4">
                                <span><?php esc_html_e( '🏠 ' . get_post_meta( get_the_ID(), 'address', true ), 'your-textdomain' ); ?></span>
                            </address>
                            <div class="mt-4 flex space-x-4">
                                <span><?php esc_html_e( '🛏️ 4 Bed', 'your-textdomain' ); ?></span>
                                <span><?php esc_html_e( '🛁 3 Bath', 'your-textdomain' ); ?></span>
                                <span><?php esc_html_e( '📏 1574 sq', 'your-textdomain' ); ?></span>
                                <span><?php esc_html_e( '🏢 8 Rooms', 'your-textdomain' ); ?></span>
                            </div>
                        </div>
                        <div class="flex-none md:w-1/3">
                            <img aria-hidden="true" alt="<?php esc_attr_e( 'Interior of Bravo Apollo Apartments', 'your-textdomain' ); ?>"
                                src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/slider.png' ); ?>"
                                class="rounded-lg rounded-tl-[0] rounded-bl-[0] object-cover w-full h-full" />
                        </div>
                    </div>
                </a>
                <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>

    </div>

    <div class="flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <button class="bg-muted text-muted-foreground shadow-xl rounded-full p-2 hover:bg-muted/80" id="prev">
                <?php esc_html_e( '←', 'your-textdomain' ); ?>
            </button>
            <button class="bg-muted text-muted-foreground shadow-xl rounded-full p-2 hover:bg-muted/80" id="next">
                <?php esc_html_e( '→', 'your-textdomain' ); ?>
            </button>
        </div>
    </div>
</div>

<div class="bg-[#FAF8FB]">
    <div class="container wrapper mx-auto py-10 px-4">
        <h1 class="text-3xl font-bold text-center mb-4 text-foreground">Find Properties In These Cities</h1>
        <p class="text-center text-muted-foreground mb-10">There are many variations of passages of Lorem Ipsum available but the this in majority have suffered alteration in some</p>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <?php
            $taxonomy = 'cities';  // The id of custom taxonomy
            $terms = get_terms( array(
                'taxonomy'   => $taxonomy,
                'hide_empty' => false,  // Set to true to hide terms with no posts
                'number'     => 6,
            ) );

            if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                foreach ( $terms as $term ) {
                    $upload_image = get_term_meta( $term->term_id, 'term_image', true );
                    $src = ! empty( $upload_image ) ? esc_url( $upload_image ) : esc_url( get_template_directory_uri() . '/assets/images/card.png' );
                    ?>
                    <a href="<?php echo esc_url( get_term_link( $term ) ); ?>">
                        <div class="relative overflow-hidden rounded-lg shadow-lg card">
                            <img src="<?php echo $src; ?>" alt="<?php echo esc_attr( $term->name ); ?>" class="w-full h-full object-cover" />
                            <div class="absolute bottom-0 left-0 p-4 z-10 text-white items-center">
                                <img aria-hidden="true" alt="location-pin" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/location-pin-white.png' ) ); ?>" class="inline-block mr-2" />
                                <?php echo esc_html( $term->name ); ?><br />
                                <?php if ( $term->count > 0 ) : ?>
                                    <span class="text-sm">(We have <?php echo esc_html( $term->count ); ?> properties)</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </a>
                    <?php
                }
            }
            ?>
        </div>
        <div class="text-center mt-10">
            <a href="<?php echo esc_url( home_url("/cities") ); ?>">
                <button class="btn btn-primary">See All Cities</button>
            </a>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-10">
    <div class="wrapper">
        <h2 class="text-3xl font-bold text-center text-zinc-800 mt-10">Meet Our Popular Agents</h2>
        <p class="text-center text-zinc-600 mt-2">There are many variations of passages of Lorem Ipsum available but the this in majority have suffered alteration in some</p>
        <br /><br />

        <?php
        $args = array(
            'post_type' => 'agent',
            'orderby'   => 'date',
            'order'     => 'ASC',
        );

        get_template_part( 'templates/content', 'cards', array( 'posts' => 3, 'args' => $args ) );
        ?>

        <div class="text-center my-14">
            <a href="<?php echo esc_url( site_url( '/agents' ) ); ?>" class="btn btn-primary">See All Agents</a>
        </div>
    </div>
</div>

<div class="bg-green-500 text-white p-8 flex flex-col md:flex-row items-center">
    <div class="wrapper grid grid-cols-2">
        <div class="flex flex-col justify-center">
            <h1 class="text-3xl font-bold mb-4">Buy or sell property anytime from anywhere</h1>
            <p class="text-lg mb-6">
                There are many variations of passages of Lorem Ipsum available but the majority have suffered alteration in some form by injected humour in the east randomised words slightly believable.
            </p>
            <div class="flex space-x-4">
                <a href="#" class="bg-white text-green-500 py-2 px-4 rounded-lg shadow hover:bg-zinc-100 transition">
                    <img src="<?php echo esc_url( 'https://openui.fly.dev/openui/google-play.svg?text=Google+Play' ); ?>" alt="<?php esc_attr_e( 'Google Play', 'your-textdomain' ); ?>" class="inline-block mr-2" />
                    Google Play
                </a>
                <a href="#" class="bg-white text-green-500 py-2 px-4 rounded-lg shadow hover:bg-zinc-100 transition">
                    <img src="<?php echo esc_url( 'https://openui.fly.dev/openui/apple-store.svg?text=Apple+Store' ); ?>" alt="<?php esc_attr_e( 'Apple Store', 'your-textdomain' ); ?>" class="inline-block mr-2" />
                    Apple Store
                </a>
            </div>
        </div>
        <div class="flex justify-center mt-8 md:mt-0">
            <img src="<?php echo esc_url( 'https://placehold.co/400x600' ); ?>" alt="<?php esc_attr_e( 'Mobile App Preview', 'your-textdomain' ); ?>" class="rounded-lg shadow-lg" />
        </div>
    </div>
</div>

<div class="container mx-auto px-4">
    <div class="wrapper py-20">
        <h1 class="text-3xl mt-10 font-bold text-center mb-4">Our Latest Property News</h1>
        <p class="text-center text-muted-foreground mb-8">There are many variations of passages of Lorem Ipsum available but this in majority have suffered alteration in some</p>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php
            $posts = new WP_Query( array(
                'posts_per_page' => 3,
                'post_type'      => 'post',
                'orderby'        => 'date',
                'order'          => 'ASC',
            ) );

            if ( $posts->have_posts() ) {
                while ( $posts->have_posts() ) {
                    $posts->the_post(); ?>
                    <div class="relative bg-card rounded-lg shadow-lg overflow-hidden">
                        <img src="<?php echo esc_url( get_the_post_thumbnail_url() ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" class="w-full h-40 object-cover" />
                        <div class="absolute top-2 left-2 bg-[#10AC84] text-white text-accent-foreground inline-block px-2 py-1 rounded-full">
                            <?php echo esc_html( get_the_date( 'd M' ) ); ?>
                        </div>
                        <div class="p-4 mt-5">
                            <h2 class="font-semibold"><?php the_title(); ?></h2>
                            <p class="text-muted-foreground"><?php the_excerpt(); ?></p>
                        </div>
                    </div>
                <?php }
                wp_reset_postdata();  // Always reset the query after custom WP_Query
            }
            ?>
        </div>
    </div>
</div>


<?php get_footer(); ?>