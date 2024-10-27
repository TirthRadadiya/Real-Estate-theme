<?php
/**
 * Property form handling for registered users.
 * Users can enter data, upload thumbnail and images for a property.
 * The property will be visible on the properties page.
 * Adjustments needed in submission logic and front-end rendering.
 */

if (is_user_logged_in()) {
    $current_user = wp_get_current_user();
    if ( ! (array_intersect(['agent', 'administrator'], $current_user->roles) !== []) ) {
        wp_redirect(esc_url(site_url('/become-agent')));
        exit;
    }
} else {
    wp_redirect(esc_url(site_url('/login')));
    exit;
}
?>

<?php get_header(); ?>

<form id="property-form" method="POST" class="w-[60vw] my-20 mx-auto p-6 bg-white shadow-md rounded-md" enctype="multipart/form-data" data-url="<?php echo esc_url(admin_url('admin-ajax.php')); ?>">
    <h2 class="text-2xl font-semibold mb-6"><?php esc_html_e('Property Registration', 'your-text-domain'); ?></h2>

    <div class="grid grid-cols-2">
        <div class="m-4">
            <label for="name" class="block text-sm font-medium text-gray-700"><?php esc_html_e('Name', 'your-text-domain'); ?></label>
            <input required type="text" id="name" name="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div class="m-4">
            <label for="address" class="block text-sm font-medium text-gray-700"><?php esc_html_e('Address', 'your-text-domain'); ?></label>
            <input required type="text" id="address" name="address" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="<?php esc_attr_e('779 6th Ave New York, NY 120400', 'your-text-domain'); ?>">
        </div>

        <div class="m-4">
            <label for="rooms" class="block text-sm font-medium text-gray-700"><?php esc_html_e('Number of Rooms', 'your-text-domain'); ?></label>
            <input required type="number" id="rooms" name="rooms" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div class="m-4">
            <label for="beds" class="block text-sm font-medium text-gray-700"><?php esc_html_e('Number of Beds', 'your-text-domain'); ?></label>
            <input required type="number" id="beds" name="beds" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div class="m-4">
            <label for="area" class="block text-sm font-medium text-gray-700"><?php esc_html_e('Area (in sq ft)', 'your-text-domain'); ?></label>
            <input required type="number" id="area" name="area" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div class="m-4">
            <label for="bath" class="block text-sm font-medium text-gray-700"><?php esc_html_e('Baths', 'your-text-domain'); ?></label>
            <input required type="number" id="bath" name="bath" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
    </div>

    <div class="m-4">
        <label for="description" class="block text-sm font-medium text-gray-700"><?php esc_html_e('Property Description', 'your-text-domain'); ?></label>
        <textarea id="description" name="description" rows="4" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
    </div>

    <div class="mb-6">
        <label for="thumbnail" class="block text-sm font-medium text-gray-700"><?php esc_html_e('Upload Thumbnail', 'your-text-domain'); ?></label>
        <input required type="file" id="thumbnail" name="thumbnail" accept="image/*">
    </div>

    <div class="mb-6">
        <label for="files" class="block text-sm font-medium text-gray-700"><?php esc_html_e('Upload Images', 'your-text-domain'); ?></label>
        <input type="file" id="files" name="files[]" accept="image/*" multiple>
    </div>

    <div class="flex justify-end">
        <button type="submit" id="my-button" class="px-6 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            <?php esc_html_e('Submit', 'your-text-domain'); ?>
        </button>
    </div>
</form>

<?php get_footer(); ?>