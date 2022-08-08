<?php

add_action('wp_enqueue_scripts', 'register_scripts');
add_action('admin_enqueue_scripts', 'admin_scripts');
add_action('after_setup_theme', 'theme_setup_settings');
add_action('admin_menu', 'remove_default_post_types');
add_action('wp_footer', 'adv_check_users_data');

add_filter('upload_mimes', 'upload_allow_types');
add_filter('use_block_editor_for_post', '__return_false');
add_filter('show_admin_bar', '__return_false');

function register_scripts()
{
    theme_styles();
    theme_scripts();
}

function theme_styles()
{
    wp_enqueue_style('adv-parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('adv-child-style', get_stylesheet_directory_uri() . '/style.css');
    wp_enqueue_style('adv-app-style', get_stylesheet_directory_uri() . '/assets/css/app.css');
}

function theme_scripts()
{
    wp_enqueue_script('adv-main-script', get_stylesheet_directory_uri() . '/assets/js/app.js', ['jquery'], time(), true);

    wp_localize_script('adv-main-script', 'myajax', [
        'ajaxurl' => admin_url('admin-ajax.php'),
    ]);
}

function admin_scripts()
{
    wp_enqueue_script('adv-admin-scripts', get_stylesheet_directory_uri() . '/assets/js/admin.js', ['jquery', 'media-upload'], time(), true);
}

function upload_allow_types($types)
{
    $types['svg'] = 'image/svg+xml';
    $types['webp'] = 'image/webp';
    return $types;
}

function theme_setup_settings()
{
    register_nav_menus([
        'main_header' => 'Main Header',
        'main_footer' => 'Menu Footer',
    ]);

    add_theme_support('post-thumbnails', ['adv']);
    add_theme_support('custom-logo', [
        'unlink-homepage-logo' => true,
    ]);
}

function remove_default_post_types()
{
    remove_menu_page('edit.php');
    remove_menu_page('edit-comments.php');
}

function adv_check_users_data()
{
    $dataUsers = get_option(USERS_OPTION_NAME);

    if (empty($dataUsers)) {
        return;
    }

    foreach ($dataUsers as $id => $data) {
        if ((strtotime('now') - strtotime($data['time'])) < DELAY_OF_SEND_MAIL) { //comparison in seconds
            continue;
        }

        sendMail($id, $data['email'], 'Thank you for creating of post on Advertisement website.');

        unset($dataUsers[$id]);
    }

    update_option(USERS_OPTION_NAME, $dataUsers);
}