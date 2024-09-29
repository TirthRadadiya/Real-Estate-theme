<?php get_header();

$filters = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // if (@$_POST['Find Property'])

    if (@$_POST['search_property'] || isset($_POST['property_type']) || isset($_POST['property_size']) || isset($_POST['property_location']) || isset($_POST['property_price']) || isset($_POST['total_bed']) || isset($_POST['total_bath'])) {
        // Sanitize input values
        $property_type = isset($_POST['property_type']) ? sanitize_text_field($_POST['property_type']) : '';
        $property_size = isset($_POST['property_size']) ? sanitize_text_field($_POST['property_size']) : '';
        $property_location = isset($_POST['property_location']) ? sanitize_text_field($_POST['property_location']) : '';
        $property_price = isset($_POST['property_price']) ? sanitize_text_field($_POST['property_price']) : '';
        $total_bed = isset($_POST['total_bed']) ? sanitize_text_field($_POST['total_bed']) : '';
        $total_bath = isset($_POST['total_bath']) ? sanitize_text_field($_POST['total_bath']) : '';

        // Build the query
        $meta_query = array('relation' => 'OR');

        if (!empty($property_type)) {
            $meta_query[] = array(
                'key' => 'type',
                'value' => $property_type,
                'compare' => 'LIKE',
            );
        }

        if (!empty($property_size)) {
            $meta_query[] = array(
                'key' => 'area',
                'value' => $property_size,
                'terms' => 'LIKE',
            );
        }

        if (!empty($property_location)) {
            $location = array(
                array(
                    'taxonomy' => 'cities',
                    'field' => 'slug',
                    'terms' => $property_location,
                )
            );
        }

        if (!empty($property_price)) {
            $meta_query[] = array(
                'key' => 'property_price',
                'value' => $property_price,
                'compare' => 'LIKE',
            );
        }

        if (!empty($total_bed)) {
            $meta_query[] = array(
                'key' => 'bed',
                'value' => $total_bed,
                'compare' => 'LIKE',
            );
        }

        if (!empty($total_bath)) {
            $meta_query[] = array(
                'key' => 'bath',
                'value' => $total_bath,
                'compare' => 'LIKE',
            );
        }

        // WP_Query for the 'property' custom post type
        if (!empty($location))
            $filters = array(
                'post_type' => 'property',
                'meta_query' => $meta_query,
                'tax_query' => $location
            );
        else
            $filters = array(
                'post_type' => 'property',
                'meta_query' => $meta_query,
            );


    }
}

?>


<div class="relative bg-cover bg-center h-64"
    style="background-image: url('<?php echo get_template_directory_uri() ?>/assets/images/banner.png');">
    <div class="absolute inset-0 bg-black opacity-80"></div>
    <div class="relative flex flex-col items-center justify-center h-full text-white p-4">
        <div class="text-center md:text-left md:mr-4 mb-4 md:mb-0 w-[540px]">
            <p class="text-2xl font-bold text-center mb-3">Property Details</p>
        </div>
        <div class="flex flex-col md:flex-row justify-center items-center w-full max-w-md">
            <span><a href="<?php echo esc_url(site_url()); ?>">Home</a></span>&nbsp; / &nbsp;<span
                class="text-blue-600 hover:text-blue-800"><a
                    href="<?php get_post_type_archive_link('property'); ?>"><?php echo str_replace('Archives:', '', get_the_archive_title()); ?></a></span>
        </div>
    </div>
</div>

<div class="max-w-4xl mx-auto mt-10 mb-20 p-5 border shadow-lg rounded-lg">
    <h2 class="text-xl font-bold mb-4">Search Your Properties</h2>
    <form method="POST" action="">
        <?php wp_nonce_field('property_nonce_in_database', 'property_nonce_submitted'); ?>
        <div class="grid grid-cols-3 gap-4">
            <div>
                <label for="property_type" class="block mb-2 text-sm font-medium text-zinc-700">Property Type</label>
                <select name="property_type" class="lock w-full p-2 border border-zinc-300 rounded" id="property_type">
                    <option value="">Select Type</option>
                    <option value="apartment" <?php selected('apartment', $_POST['property_type'] ?? ''); ?>>Apartment
                    </option>
                    <option value="house" <?php selected('house', $_POST['property_type'] ?? ''); ?>>House</option>
                    <option value="condo" <?php selected('condo', $_POST['property_type'] ?? ''); ?>>Condo</option>
                </select>
            </div>
            <div>
                <label for="property_size" class="block mb-2 text-sm font-medium text-zinc-700">Property Size</label>
                <select name="property_size" class="lock w-full p-2 border border-zinc-300 rounded" id="property_size">
                    <option value="">Select Size</option>
                    <option value="small" <?php selected('small', $_POST['property_size'] ?? ''); ?>>Small</option>
                    <option value="medium" <?php selected('medium', $_POST['property_size'] ?? ''); ?>>Medium</option>
                    <option value="large" <?php selected('large', $_POST['property_size'] ?? ''); ?>>Large</option>
                </select>
            </div>
            <div>
                <label for="property_price" class="block mb-2 text-sm font-medium text-zinc-700">Property Price</label>
                <select name="property_price" class="lock w-full p-2 border border-zinc-300 rounded"
                    id="property_price">
                    <option value="">Select Size</option>
                    <option value="small" <?php selected('small', $_POST['property_price'] ?? ''); ?>>Small</option>
                    <option value="medium" <?php selected('medium', $_POST['property_price'] ?? ''); ?>>Medium</option>
                    <option value="large" <?php selected('large', $_POST['property_price'] ?? ''); ?>>Large</option>
                </select>
            </div>
            <div>
                <label for="property_location" class="block mb-2 text-sm font-medium text-zinc-700">Property
                    Location</label>
                <select name="property_location" class="lock w-full p-2 border border-zinc-300 rounded"
                    id="property_location">
                    <option value="">Select Location</option>
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
            <div>
                <label for="total_bed" class="block mb-2 text-sm font-medium text-zinc-700">Total Beds</label>
                <select name="total_bed" class="lock w-full p-2 border border-zinc-300 rounded" id="total_bed">
                    <option value="">Select Beds</option>
                    <option value="1" <?php selected('1', $_POST['total_bed'] ?? ''); ?>>1</option>
                    <option value="2" <?php selected('2', $_POST['total_bed'] ?? ''); ?>>2</option>
                    <option value="3" <?php selected('3', $_POST['total_bed'] ?? ''); ?>>3</option>
                </select>
                </select>
            </div>
            <div>
                <label for="total_bath" class="block mb-2 text-sm font-medium text-zinc-700">Total Baths</label>
                <select name="total_bath" class="lock w-full p-2 border border-zinc-300 rounded" id="total_bath">
                    <option value="">Select Baths</option>
                    <option value="1" <?php selected('1', $_POST['total_bath'] ?? ''); ?>>1</option>
                    <option value="2" <?php selected('2', $_POST['total_bath'] ?? ''); ?>>2</option>
                    <option value="3" <?php selected('3', $_POST['total_bath'] ?? ''); ?>>3</option>
                </select>
            </div>
        </div>
        <input class="mt-4 bg-blue-500 text-white p-2 rounded hover:bg-blue-600" type="submit" value="Find Property" />
    </form>
</div>

<div class="w-[75%] my-10 mx-auto">
    <?php get_template_part('templates/content', "cards", array(
        'filters' => $filters,
        'args' => array(
            'post_type' => "property",
            'order' => 'ASC'
        )
    )); ?>
</div>

<?php get_footer(); ?>