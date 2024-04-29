<?php

define('HY_PLUGIN_FILE', __FILE__);
require_once dirname(__FILE__) . "/includes/news_meta_box.php";
require_once dirname(__FILE__) . "/includes/shortcode.php";
// require_once dirname(__FILE__) . "/includes/custom_post_type.php";







// The code below is for the filters

// function hw_changeMyArray($value)
// {
//     $value["thrird"] = "Hello World";
//     return $value;

// }
// add_filter("hw_array", "hw_changeMyArray", 10, 1);
// $myArray = apply_filters("hw_array", array('first' => "Hello", "second" => "World"));

// var_dump($myArray);


// The code below is for the Actions

/*

function hw_addContent()
{
    echo "<p>Additional World</p>";
}
add_action("hw_action","hw_addContent");
?>
<div id="temp">
    <h1>Hello World</h1>
    <?php do_action("hw_action"); ?>
</div>
<?php die(); ?>

*/



// function hw_add_venue_disclaimer()
// {
//     echo "<div > Note : This Venue if changed will be updated in the future</div>";
// }

// add_action("tribe_events_single_meta_venue_section_start", "hw_add_venue_disclaimer");





// Using the class to create the plugin and accessing the methods
/* class HY_Plugin
{

    function __construct()
    {
        add_filter("tribe_get_full_address", array($this, 'hw_change_address'), 10, 3);
        add_action("tribe_events_single_meta_venue_section_start", array($this, "hw_add_venue_disclaimer"));
    }
    function hw_change_address($address, $venue_id, $includeVenueName)
    {
        return '****' . $address . "****";
    }

    function hw_add_venue_disclaimer()
    {
        echo "<div > Note : This Venue if changed will be updated in the future</div>";
    }
}
$myPlugin = new HY_Plugin();


 */

// Passing as a parameter to the function
// function hw_handle_test_shortcode($atts)
// {
//    $atts = shortcode_atts(array(
//       "title" => "Deafult title",

//    ), $atts);
//     return "<h1>{$atts['title']}</h1>";
// }
// function hw_handle_test_shortcode($atts, $content = '')
// {
//     global $post;
//     $atts = shortcode_atts(
//         array(

//         ),
//         $atts
//     );

//     return "<h1>{$content}" . "(" . get_the_ID() . ")</h1>";
// }

// // Passing in between to the function
// add_shortcode('my-test-shortcode', 'hw_handle_test_shortcode');


// function hw_add_content($content)
// {
//     return $content . "<p>Additional Content</p>";
// }

// add_filter("the_content", "hw_add_content");

// function display_all_post_titles_on_homepage()
// {
//     // Define arguments for the query
//     $args = array(
//         'post_type' => 'post',        // Fetch only posts
//         'posts_per_page' => -1,            // Fetch all posts
//     );

//     // Query the posts
//     $query = new WP_Query($args);

//     // Check if there are posts
//     if ($query->have_posts()) {
//         // Start the loop
//         while ($query->have_posts()) {
//             $query->the_post();
//             // Display the post title
//             echo '<h2>' . get_the_title() . '</h2>';
//         }
//         // Reset post data
//         wp_reset_postdata();
//     }
// }

// // Hook the function to the 'homepage' action
// add_action('homepage', 'display_all_post_titles_on_homepage');


// display_all_post_titles_on_homepage(); */








// *************************************************************************************************
// The code below is for the filters

// function hw_changeMyArray($value)
// {
//     $value["thrird"] = "Hello World";
//     return $value;
// }
// // add_filter("hw_array", "hw_changeMyArray", 10, 1);
// // $myArray = apply_filters("hw_array", array('first' => "Hello", "second" => "World"));
// // var_dump($myArray);

// // The code below is for the Actions

// function hw_addContent()
// {
//     echo "<p>Additional World</p>";
// }
// add_action("hw_action", "hw_addContent");
// ?>
// <div id="temp">
    // <h1>Hello World</h1>
    // <?php do_action("hw_action"); ?>
    // </div>
// <?php
// function hw_add_venue_disclaimer()
// {
//     echo "<div> Note : This Venue if changed will be updated in the future</div>";
// }
// // add_action("tribe_events_single_meta_venue_section_start", "hw_add_venue_disclaimer");

// // Using the class to create the plugin and accessing the methods
// class HY_Plugin
// {
//     function __construct()
//     {
//         add_filter("tribe_get_full_address", array($this, 'hw_change_address'), 10, 3);
//         add_action("tribe_events_single_meta_venue_section_start", array($this, "hw_add_venue_disclaimer"));
//     }
//     function hw_change_address($address, $venue_id, $includeVenueName)
//     {
//         return '****' . $address . "****";
//     }

//     function hw_add_venue_disclaimer()
//     {
//         echo "<div> Note : This Venue if changed will be updated in the future</div>";
//     }
// }
// // $myPlugin = new HY_Plugin();

// // Shortcodes



// // Content Filter

// function hw_add_content($content)
// {
//     return $content . "<p>Additional Content</p>";
// }
// add_filter("the_content", "hw_add_content");

// Custom Query and Display Function


// $args = array(
//     'post_type' => 'post',
//     'posts_per_page' => 1,
//     'post_title' => 'Its a temp post'
// );

// $query = new WP_Query($args);

// if ($query->have_posts()) {
//     while ($query->have_posts()) {
//         $query->the_post();
//         // Display the post content
//         the_content();
//     }
//     wp_reset_postdata();
// }



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









function hw_add_posts_end_of_content($content)
{

    if (is_singular('news')) {
        $args = array(
            'numberposts' => 3,
            'post_type' => 'news',
            // 'exclude' => 'get_the_ID()'

            'post_not_in' => array(get_the_ID()),
            'meta_key' => 'news_location',
            'meta_value' => get_post_meta(get_the_ID(), 'news_location', true),

        );
        $wp_query = new WP_Query($args);
        //    $latest_posts = get_posts($args);
        if ($wp_query->have_posts()) {
            ob_start(); ?>
                        <h3>Latest News</h3>
                        <ul class="latest_posts">
                            <?php while ($wp_query->have_posts()):
                                $wp_query->the_post(); ?>


                                    <li> <a href="<?php echo get_permalink(); ?>"><?php echo the_title(); ?></a>
                                    </li>
                            <?php endwhile; ?>
                        </ul>
                        <?php
                        $content .= ob_get_clean();
                        wp_reset_postdata();
        }
    }

    return $content;
}

add_filter("the_content", "hw_add_posts_end_of_content");

