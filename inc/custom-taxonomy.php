<?php

function create_custom_taxonomy()
{
    // Labels for the taxonomy
    $labels = array(
        'name' => _x('Cities', 'taxonomy general name', 'textdomain'),
        'singular_name' => _x('City', 'taxonomy singular name', 'textdomain'),
        'search_items' => __('Search Cities', 'textdomain'),
        'all_items' => __('All Cities', 'textdomain'),
        'parent_item' => __('Parent City', 'textdomain'),
        'parent_item_colon' => __('Parent City:', 'textdomain'),
        'edit_item' => __('Edit City', 'textdomain'),
        'update_item' => __('Update City', 'textdomain'),
        'add_new_item' => __('Add New City', 'textdomain'),
        'new_item_name' => __('New City Name', 'textdomain'),
        'menu_name' => __('City', 'textdomain'),
    );

    // Settings for the taxonomy
    $args = array(
        'hierarchical' => false,  // If true, it behaves like categories; false makes it behave like tags
        'labels' => $labels,
        'show_ui' => true,
        'has_archive' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'city'),  // The slug for the taxonomy URL
    );

    // Register the taxonomy and associate it with your custom post type
    register_taxonomy('cities', 'property', $args);
}

add_action('init', 'create_custom_taxonomy');

add_action('cities_add_form_fields', 'add_term_image', 10, 2);
function add_term_image($taxonomy){
    ?>
    <div class="form-field term-group">
        <label for="">Upload and Image</label>
        <input type="text" name="txt_upload_image" id="txt_upload_image" value="" style="width: 77%">
        <input type="button" id="upload_image_btn" class="button" value="Upload an Image" />
    </div>
    <?php
}


add_action('created_cities', 'save_term_image', 10, 2);
function save_term_image($term_id) {
    if (isset($_POST['txt_upload_image']) && '' !== $_POST['txt_upload_image']){
        $group = $_POST['txt_upload_image'];
        add_term_meta($term_id, 'term_image', $group, true);
    }
}

add_action('cities_edit_form_fields', 'edit_image_upload', 10, 2);
function edit_image_upload($term, $taxonomy) {
    // get current group
    $txt_upload_image = get_term_meta($term->term_id, 'term_image', true);
?>
    <div class="form-field term-group">
        <label for="">Upload and Image</label>
        <input type="text" name="txt_upload_image" id="txt_upload_image" value="<?php echo $txt_upload_image ?>" style="width: 77%">
        <input type="button" id="upload_image_btn" class="button" value="Upload an Image" />
    </div>
<?php
}

add_action('edited_cities', 'update_image_upload', 10, 2);
function update_image_upload($term_id, $tt_id) {
    if (isset($_POST['txt_upload_image']) && '' !== $_POST['txt_upload_image']){
        $group = $_POST['txt_upload_image'];
        update_term_meta($term_id, 'term_image', $group);
    }
}