<?php

function hwy_add_content_on_activation()
{

    if (get_option('hwy_page_id', false)) {
        return;
    }
    $post_id = wp_insert_post(

        array(
            'post_title' => __( 'Hello World Confirmation','helloworld'),
            'post_status' => 'publish',
            'post_type' => 'page',
            'post_content' => '[my-test-shortcode]'
        )
    );
    update_option('hwy_page_id', $post_id);
}

register_activation_hook(HY_PLUGIN_FILE, 'hwy_add_content_on_activation');

function hwy_replace_content_on_confirm_page($content)
{
    if (get_the_ID() === intval(get_option('hwy_page_id', false))) {
        return 'My test shortcode';
    }
    return $content;
}
add_filter('the_content', 'hwy_replace_content_on_confirm_page');

