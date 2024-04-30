<?php
/*

/*
Plugin Name: Hello World 
Plugin URI:
Description: 
Version: 1.0
Requires PHP: 5.6.20
Author: Harish Sugandhi
Author URI: https://www.wierd.fun/
License: GPLv2 or later
Text Domain: hello-world
*/
if (!defined('ABSPATH')) {
    die('No script kitties please!');
}

define('HY_PLUGIN_FILE', __FILE__);
define('HY_PLUGIN_VERSION', '1.0');
require_once dirname(__FILE__) . '/wp-requirements.php';

$plugin_checks = new WP_Requirements(
    "Hello World",
    HY_PLUGIN_FILE,
    array(
        "PHP" => "5",
    )
);

if ($plugin_checks->pass() === false) {
    $plugin_checks->halt();
    return;
}



require_once dirname(__FILE__) . "/includes/news_meta_box.php";
require_once dirname(__FILE__) . "/includes/shortcode.php";
require_once dirname(__FILE__) . "/includes/admin_settings.php";
require_once dirname(__FILE__) . "/includes/news_content.php";
require_once dirname(__FILE__) . "/includes/custom_post_type.php";
require_once dirname(__FILE__) . "/includes/add_content.php";
require_once dirname(__FILE__) . "/includes/news_location.php";
// require_once dirname(__FILE__) . "/includes/test_api_calls.php";
require_once dirname(__FILE__) . "/includes/welcome_screen.php";






// require_once dirname(__FILE__) . "/includes/custom_post_type.php";

// function hwy_add_content_on_activation()
// {

//     $query = new WP_Query(array('pagename' => 'Hello World Confirmation'));
//     if ($query->have_posts()) {
//         return;
//     }
//     wp_insert_post(

//         array(
//             'post_title' => 'Hello World Confirmation',
//             'post_status' => 'publish',
//             'post_type' => 'page',
//             'post_content' => '[my-test-shortcode]'
//         )
//     );
// }



function hwy_add_styles()
{
    wp_enqueue_style("", plugins_url("includes/css/frontend.css", HY_PLUGIN_FILE), array(), HY_PLUGIN_VERSION);
}



function custom_plugin_views_filter($views)
{
   
    $views['bsf-plugin'] = "<a href='https://brainstormforce.com/' target='_blank'>BSF PLUGIN</a>";
    return $views;
}


add_action('current_screen', function ($current_screen) {
    if ($current_screen->id === 'plugins') {
        add_filter('views_plugins', 'custom_plugin_views_filter');
    }
});


// Define your callback function

// function add_bsf_view($views)
// {
//     // Define the count for the "bsf" view (replace 0 with the actual count)
//     $bsf_count = 1;

//     // Define the label for the "bsf" view
//     $bsf_label = _n(
//         'BSF <span class="count">(%s)</span>',
//         'BSF <span class="count">(%s)</span>',
//         $bsf_count
//     );

//     // Define the URL for the "bsf" view
//     $bsf_url = add_query_arg('plugin_status', 'bsf', 'plugins.php');

//     // Create the "bsf" view link
//     $bsf_link = sprintf('<a href="%s">%s</a>', esc_url($bsf_url), $bsf_label);

//     // Add the "bsf" view link to the views array
//     $views['bsf'] = $bsf_link;

//     return $views;
// }




