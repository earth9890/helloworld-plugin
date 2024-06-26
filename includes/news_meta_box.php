<?php
function hw_add_news_metabox()
{
    add_meta_box('new_meta_box', 'News Location', 'hwy_render_news_location_meta_box', 'news', 'normal', 'low');
}
add_action("add_meta_boxes_news", "hw_add_news_metabox");


function hwy_render_news_location_meta_box($post)
{
    wp_nonce_field("news_meta_box_saving", "news_meta_box_nonce"); //not working  // not able to post from other area

    $location = hwy_get_news_location($post->ID);

    ?>

    <div class="inside">
        <p>
            <label class="screen-reader-text"
                for="news_location"><?php echo esc_html(__('Location', 'helloworld')); ?></label>
            <input id="news_location" type="text" name="news_location"
                value="<?php echo esc_attr(get_post_meta($post->ID, 'news_location', true)); ?>">

        </p>
        <p>
            <label for="news_location_lat"><?php echo esc_html(__('Location Latitue', 'helloworld')); ?></label>
            <input id="news_location_lat" type="text" name="news_location_lat"
                value="<?php echo esc_attr($location->lat); ?>">

        </p>
        <p>
            <label for="news_location_lon"><?php echo esc_html(__('Location Longitude', 'helloworld')); ?></label>
            <input id="news_location_lon" type="text" name="news_location_lon"
                value="<?php echo esc_attr($location->lon); ?>">

        </p>
    </div>
    <?php
}
add_action('add_meta_boxes_news', 'hwy_render_news_location_meta_box');


function hw_save_news_meta_data($post_id)
{
    // if (isset($_POST['news_meta_box_nonce']) || !wp_verify_nonce($_POST['news_meta_box_nonce'], 'news_meta_box_saving')) {
    //     return;
    // }
    // if (!current_user_can('manage_users', $post_id)) {
    //     return;
    // }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;
    if (isset($_POST['news_location'])) {
        update_post_meta($post_id, 'news_location', sanitize_text_field($_POST['news_location']));
    }
    if (isset($_POST['news_location_lat']) && isset($_POST['news_location_lon'])) {

        hwy_save_news_location($post_id, floatval(sanitize_text_field($_POST['news_location_lat'])), floatval(sanitize_text_field($_POST['news_location_lon'])));
    }
}

add_action('save_post_news', 'hw_save_news_meta_data');