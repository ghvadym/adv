<?php

function createPostTypes()
{
    createPostType('adv', [
        'supports'  => ['title', 'editor'],
        'labels'    => [
            'name'          => __('Adv', 'adv'),
            'singular_name' => __('Adv', 'adv'),
            'add_new_item'  => __('Add New Adv', 'adv'),
            'view_item'     => __('View Adv', 'adv'),
            'search_items'  => __('Search Adv', 'adv'),
            'not_found'     => __('No News found', 'adv'),
            'menu_name'     => __('Adv', 'adv'),
        ],
    ]);
}

function createPostType($postType, $args = [])
{
    $args = array_merge([
        'public'        => true,
        'show_ui'       => true,
        'has_archive'   => true,
        'menu_position' => 20,
        'hierarchical'  => true,
        'supports'      => ['title', 'editor', 'thumbnail'],
    ], $args);

    register_post_type($postType, $args);
}

function createTaxonomy($taxonomy, $postType, $args = [])
{
    $args = array_merge([
        'description'  => '',
        'public'       => true,
        'hierarchical' => true,
        'has_archive'  => true,
    ], $args);

    register_taxonomy($taxonomy, $postType, $args);
}

add_action('init', 'createPostTypes');