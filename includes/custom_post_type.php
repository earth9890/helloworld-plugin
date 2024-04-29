<?php
function hw_create_custom_post_type_news()
{
    $labels = array(
        'name' => 'News',
        'singular_name' => 'News',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New News',
        'edit_item' => 'Edit News',
        'new_item' => 'New News',
        'view_item' => 'View News',
        'search_items' => 'Search News',
        'not_found' => 'No News found',
        'not_found_in_trash' => 'No News found in Trash',
        'parent_item_colon' => '',
        'menu_name' => 'News'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'publicly_queryable' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'news'),
        'capability_type' => 'post',
        'hierarchical' => false,
        'supports' => array(
            'title',
            'editor',
            'author',
            'thumbnail',
            'excerpt',
            'comments'
        ),
        'menu_position' => 5,
        'menu_icon' => 'dashicons-megaphone'
    );

    register_post_type('news', $args);
    register_taxonomy(
        'news_category',
        'news',
        array(
            'label' => 'News Category',
            'hierarchical' => true,

        )
    );
    flush_rewrite_rules();
}

add_action('init', 'hw_create_custom_post_type_news');

function hwy_activate()
{
    hw_create_custom_post_type_news();
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'hwy_activate');
