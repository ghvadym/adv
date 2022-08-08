<?php

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('styles', get_stylesheet_uri());
    wp_enqueue_script('jquery');
});