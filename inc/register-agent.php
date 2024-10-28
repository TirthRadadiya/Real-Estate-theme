<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission
    if (in_array('subscriber', $current_user->roles)) {
        if (empty($_FILES['profile_image']['name']))
            wp_send_json_error(['message' => 'Please add thumbnail']);

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


                // Save social media links and description
                if (!empty($_POST['facebook'])) {
                    update_user_meta($user_id, 'facebook', sanitize_text_field($_POST['facebook']));
                }
                if (!empty($_POST['twitter'])) {
                    update_user_meta($user_id, 'twitter', sanitize_text_field($_POST['twitter']));
                }
                if (!empty($_POST['linkedin'])) {
                    update_user_meta($user_id, 'linkedin', sanitize_text_field($_POST['linkedin']));
                }
                if (!empty($_POST['description'])) {
                    update_user_meta($user_id, 'description', sanitize_textarea_field($_POST['description']));
                }

                // Update user role to 'agent'
                $current_user->set_role('agent');

                wp_safe_redirect(site_url("/profile"));
            }
        }
    }
}