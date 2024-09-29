<?php
/**
*** Property form is wokring and user can now enter data and thumbail and images of property, it will be visible on properties page,
    there are some changes that needs to be done in submission logic as well and front end rendering.
*/

if (is_user_logged_in()) {

    $current_user = wp_get_current_user();
    if (!in_array('agent', $current_user->roles)) {
        wp_redirect(esc_url(site_url("/become-agent")));
    }
} else {
    wp_redirect(esc_url(site_url("/login")));
}
?>

<?php get_header(); ?>


<form id="property-form" class="max-w-lg my-20 mx-auto p-6 bg-white shadow-md rounded-md" enctype="multipart/form-data"
    data-url="<?php echo admin_url("admin-ajax.php"); ?>">
    <h2 class="text-2xl font-semibold mb-6">Property Registration</h2>

    <div class="grid grid-cols-2">
        <div class="m-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" id="name" name="name"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div class="m-4">
            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
            <input type="text" id="address" name="address"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div class="m-4">
            <label for="rooms" class="block text-sm font-medium text-gray-700">Number of Rooms</label>
            <input type="number" id="rooms" name="rooms"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div class="m-4">
            <label for="beds" class="block text-sm font-medium text-gray-700">Number of Beds</label>
            <input type="number" id="beds" name="beds"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div class="m-4">
            <label for="area" class="block text-sm font-medium text-gray-700">Area (in sq ft)</label>
            <input type="number" id="area" name="area"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div class="m-4">
            <label for="bath" class="block text-sm font-medium text-gray-700">Baths</label>
            <input type="number" id="bath" name="bath"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

    </div>
    <div class="m-4">
        <label for="description" class="block text-sm font-medium text-gray-700">Property Description</label>
        <textarea id="description" name="description" rows="4"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
    </div>

    <div class="mb-6">
        <label for="thumbnail" class="block text-sm font-medium text-gray-700">Upload Thumbnail</label>
        <!-- <input type="file" id="images" name="images[]" multiple
            class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md cursor-pointer focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"> -->

        <input type="file" id="thumbnail" name="thumbnail" accept="image/*" />
    </div>

    <div class="mb-6">
        <label for="files" class="block text-sm font-medium text-gray-700">Upload Images</label>
        <!-- <input type="file" id="images" name="images[]" multiple
            class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md cursor-pointer focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"> -->

        <input type="file" id="files" name="files" accept="image/*" multiple />
    </div>

    <div class="flex justify-end">
        <button type="submit" id="my-button"
            class="px-6 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Submit</button>
    </div>
</form>


<?php get_footer(); ?>