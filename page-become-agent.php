<?php
if (is_user_logged_in()) {
    $current_user = wp_get_current_user();
    $user_id = $current_user->ID;

    // Check if the user is already an 'agent'
    if (in_array('agent', $current_user->roles)) {
        wp_redirect(site_url("/profile"));
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission
    if (in_array('subscriber', $current_user->roles)) {

        // Handle image upload
        if (!empty($_FILES['profile_image']['name'])) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
            $uploadedfile = $_FILES['profile_image'];
            $movefile = wp_handle_upload($uploadedfile, array('test_form' => false));

            // if ($movefile && !isset($movefile['error'])) {
            //     update_user_meta($user_id, 'profile_image', $movefile['url']);
            // } else {
            //     echo '<div class="text-red-500">Image upload failed.</div>';
            //     return;
            // }
        }

        if (!empty($_POST['description'])) {
            update_user_meta($user_id, 'profile_image', $movefile['url']);
            $args = array(
                'post_title' => $current_user->user_nicename,
                'post_type' => 'agent',
                'post_content' => $_POST['description'],
                'post_status' => 'publish'
            );

            $agentId = wp_insert_post($args);

            if (!empty($agentId)) {
                $argsForThumbnail = array(
                    'post_type' => 'attachment',
                    'post_status' => 'inherit',
                    'guid' => $movefile['url'],
                    'post_parent' => $agentId
                );
                $thumbnailId = wp_insert_post($argsForThumbnail);
                set_post_thumbnail($agentId, $thumbnailId);
                $current_user->set_role('agent');
                echo '<div class="text-green-500">You have successfully become an agent!</div>';
                wp_safe_redirect(site_url("/profile"));
            }
        }
        // // Save social media links and description
        // if (!empty($_POST['facebook'])) {
        //     update_user_meta($user_id, 'facebook', sanitize_text_field($_POST['facebook']));
        // }
        // if (!empty($_POST['twitter'])) {
        //     update_user_meta($user_id, 'twitter', sanitize_text_field($_POST['twitter']));
        // }
        // if (!empty($_POST['linkedin'])) {
        //     update_user_meta($user_id, 'linkedin', sanitize_text_field($_POST['linkedin']));
        // }
        // if (!empty($_POST['description'])) {
        //     update_user_meta($user_id, 'description', sanitize_textarea_field($_POST['description']));
        // }

        // // Update user role to 'agent'
        // $current_user->set_role('agent');

        // // Success message
        // echo '<div class="text-green-500">You have successfully become an agent!</div>';
    }
}
?>

<?php get_header(); ?>

<form id="agentForm" action="" method="POST" enctype="multipart/form-data"
    class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
    <div class="mb-4">
        <label for="profile_image" class="block text-gray-700 font-bold mb-2">Profile Image:</label>
        <input type="file" id="profile_image" name="profile_image" accept="image/*"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <div class="mb-4">
        <label for="facebook" class="block text-gray-700 font-bold mb-2">Facebook:</label>
        <input type="text" id="facebook" name="facebook" placeholder="https://facebook.com/yourprofile"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <div class="mb-4">
        <label for="twitter" class="block text-gray-700 font-bold mb-2">Twitter:</label>
        <input type="text" id="twitter" name="twitter" placeholder="https://twitter.com/yourprofile"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <div class="mb-4">
        <label for="linkedin" class="block text-gray-700 font-bold mb-2">LinkedIn:</label>
        <input type="text" id="linkedin" name="linkedin" placeholder="https://linkedin.com/in/yourprofile"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <div class="mb-4">
        <label for="description" class="block text-gray-700 font-bold mb-2">Description:</label>
        <textarea id="description" name="description" rows="5"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
    </div>

    <div class="text-center">
        <button type="submit" id="submit_form"
            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-700">
            Submit
        </button>
    </div>

    <div id="response_message" class="mt-4 text-center text-red-500"></div>
</form>



<?php get_footer(); ?>