<?php


function hwy_get_news_location_table_name()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'hwy_news_location';
    return $table_name;
}

function hwy_create_news_location()
{
    global $wpdb;
    $table_name = hwy_get_news_location_table_name();
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
        id int(11) NOT NULL AUTO_INCREMENT,
        post_id int(11) NOT NULL,
        lat decimal(9,6) NOT NULL,
        lon decimal(9,6) NOT NULL,
        PRIMARY KEY (id),
        KEY post_id (post_id)
    )$charset_collate;";
    require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
    // die(var_dump(dbDelta($sql)));
}

register_activation_hook(HY_PLUGIN_FILE, "hwy_create_news_location");



function hwy_get_news_location($post_id)
{
    global $wpdb;
    $table_name = hwy_get_news_location_table_name();
    $news_location = get_transient('hwy_news_location' . $post_id);
    if ($news_location) {
        return $news_location;
    }

    $news_location = $wpdb->get_row(

        "SELECT * FROM $table_name WHERE post_id = " . intval($post_id)
    );

    set_transient('hwy_news_location' . $post_id, $news_location);

    return $news_location;
}


function hwy_save_news_location($post_id, $lat, $lon)
{
    global $wpdb;
    if (hwy_get_news_location($post_id)) {
        $wpdb->update(
            hwy_get_news_location_table_name(),
            array(
                'lat' => $lat,
                'lon' => $lon
            ),
            array(
                'post_id' => $post_id
            ),
            array(
                '%f',
                '%f'
            ),
            array(
                '%d'
            )
        );
    } else {
        $wpdb->insert(
            hwy_get_news_location_table_name(),
            array(
                'post_id' => $post_id,
                'lat' => $lat,
                'lon' => $lon
            ),
            array(
                '%d',
                '%f',
                '%f'
            )
        );
    }
    delete_transient('hwy_news_location'. $post_id);
}

