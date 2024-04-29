<?php
require_once (dirname(__FILE__) . "/news_location.php");

function hwy_add_news_location_to_content($content)
{
    //esc_url
    //esc_attr = eascape from input ">
    if (is_singular('news')) {
        $location = esc_html(get_post_meta(get_the_ID(), 'news_location', true));
        if ($location) {
            $content .= '<p class="news-location">Location: ' . $location . '</p>';
        }
        $lat_lon = hwy_get_news_location(get_the_ID());
        if ($lat_lon == NULL) {
            $lat_lon = new stdClass();
            $lat_lon->lat = 0;
            $lat_lon->lon = 0;
        }
        // die(var_dump($lat_lon->lat));
        $content .= '<p class="news-lat-lon"> ' . $lat_lon->lon . ' to ' . $lat_lon->lat . '</p>';
    }
    return $content;
}

add_filter('the_content', 'hwy_add_news_location_to_content');






function hw_add_posts_end_of_content($content)
{

    if (is_singular('news') && get_option('hwy_show_related', true)) {
        $args = array(
            'numberposts' => intval(get_option('hwy_related_news_amount', 3)),
            'post_type' => 'news',
            'exclude' => get_the_ID(),

            // 'post_not_in' => array(get_the_ID()),
            'meta_key' => 'news_location',
            'meta_value' => get_post_meta(get_the_ID(), 'news_location', true),
        );
        $latest_posts = get_posts($args);
        if (empty($latest_posts)) {
            $latest_posts = get_posts(
                array(
                    'numberposts' => 3,
                    'post_type' => 'news',
                )
            );
        }
        ob_start(); ?>
        <h3><?php echo esc_html(get_option('hwy_news_related_title', __('Related News', 'helloworld'))); ?></h3>

        <ul class="latest_posts">
            <?php foreach ($latest_posts as $post): ?>

                <li> <a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php
        $content .= ob_get_clean();
    }

    return $content;
}

add_filter("the_content", "hw_add_posts_end_of_content");

