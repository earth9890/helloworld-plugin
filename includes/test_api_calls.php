<?php
function hwy_test_api_calls()
{
    $data = wp_remote_get("https://jsonplaceholder.typicode.com/posts");
    if (is_array($data)) {
        $posts = json_decode($data['body']);
        foreach ($posts as $post) {
            echo '<p>' . esc_html($post->title) . '</p>';
            echo '<p>' . esc_html($post->body) . '</p>';
        }
    }
    die();
}


// function hwy_test_api_calls()
// {
//     $data = wp_remote_get("https://jsonplaceholder.typicode.com/posts");
//     if (is_array($data)) {
//         $posts = json_decode($data['body']);
//         foreach ($posts as $post) {
//             wp_insert_post(
//                 array(
//                     'post _title' => $post->title,
//                     'post_content' => $post->body
//                 )
//             );
//             break;

//         }
//     }
// }
add_filter('the_content', 'hwy_test_api_calls');