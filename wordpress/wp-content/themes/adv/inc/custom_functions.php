<?php

if (!function_exists('dd')) {
    function dd()
    {
        echo '<pre>';
        array_map(function ($x) {
            var_dump($x);
        }, func_get_args());
        die;
    }
}

function getImageThumbnail($id = 0, $size = 'large'): string
{
    if (!$id) {
        return '';
    }

    $imgId = get_post_meta($id, 'adv_attachment_id', true) ?? '';

    return wp_get_attachment_image($imgId, $size) ?: defaultImage();
}

function defaultImage(): string
{
    $path = get_template_directory_uri() . '/assets/img/default-image.png';
    return sprintf('<img src="%s" alt="Default image">', $path);
}

function sendMail($postId, $sendTo = '', $text = ''): bool
{
    $adminEmail = get_bloginfo('admin_email');
    $siteName = get_option('blogname') ?: __('Advertisement Website', 'adv');
    $to = $sendTo ?: $adminEmail;
    $subject = 'Adv site - New post';
    $message = $text ?: sprintf('Post %s has been created. See there: %s', get_the_title($postId), get_the_permalink($postId));
    $headers = [
        'content-type: text/html',
        sprintf('From: %s <%s>', $siteName, $adminEmail),
        sprintf('Reply-To: %s', $adminEmail),
    ];

    return wp_mail($to, $subject, $message, $headers);
}

function updateOptionUsers($postId, $email): void
{
    if (!$postId || !$email) {
        return;
    }

    $currentDate = date("Y-m-d h:i:s");
    $dataUsers = get_option(USERS_OPTION_NAME) ?: [];

    $dataUsers[$postId] = [
        'email' => $email,
        'time'  => $currentDate,
    ];

    update_option(USERS_OPTION_NAME, $dataUsers);
}

function insertPost($title): int
{
    if (!$title) {
        return 0;
    }

    return wp_insert_post([
        'post_title'   => $title,
        'post_content' => '',
        'post_type'    => 'adv',
        'post_status'  => 'publish',
    ]);
}

function saveImage($image): int
{
    if (!$image) {
        return 0;
    }

    $uploadDir = wp_upload_dir();

    $path = $uploadDir['path'] . '/' . basename($image['name']);

    if (!move_uploaded_file($image['tmp_name'], $path)) {
        return 0;
    }

    return uploadImage($path);
}

function uploadImage($path): int
{
    if (!$path) {
        return 0;
    }

    $uploadDir = wp_upload_dir();
    $filetype = wp_check_filetype(basename($path), null);

    $attachment = [
        'guid'           => $uploadDir['url'] . '/' . basename($path),
        'post_mime_type' => $filetype['type'],
        'post_title'     => preg_replace('/\.[^.]+$/', '', basename($path)),
        'post_content'   => '',
        'post_status'    => 'inherit',
    ];

    if (!$attachmentId = wp_insert_attachment($attachment, $path)) {
        return 0;
    }

    require_once(ABSPATH . 'wp-admin/includes/image.php');

    $attach_data = wp_generate_attachment_metadata($attachmentId, $path);
    wp_update_attachment_metadata($attachmentId, $attach_data);

    return $attachmentId;
}