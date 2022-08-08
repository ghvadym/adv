<?php

add_action('wp_ajax_submit_form', 'submitForm');
add_action('wp_ajax_nopriv_submit_form', 'submitForm');

function submitForm()
{
    $title = $_POST['title'] ?? null;
    $email = $_POST['email'] ?? null;
    $image = $_FILES['image'] ?? null;

    if (!$title || !$email) {
        return;
    }

    if (!empty($image)) {
        $imageId = saveImage($image);
    }

    $postId = insertPost($title);

    if ($postId && !empty($imageId)) {
        update_post_meta($postId, 'adv_attachment_id', $imageId);
    }

    if ($postId) {
        sendMail($postId);
        updateOptionUsers($postId, $email);
    }

    ob_start();

    if (!empty($postId)) {
        get_template_part('pages/parts/card', '', get_post($postId));
    } else {
        echo '<p>' . __('Post haven\'t been inserted.') . '</p>';
    }

    $html = ob_get_contents();
    ob_end_clean();

    wp_send_json([
        'result' => $html,
    ]);
}