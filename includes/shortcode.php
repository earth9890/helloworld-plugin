<?php
function hw_handle_test_shortcode1($atts, $content = '')
{
    global $post;
    $atts = shortcode_atts(
        array(

        ),
        $atts
    );

    return "<h1>{$content}" . "(" . get_the_ID() . ")</h1>";
}
add_shortcode('my-test-shortcode', 'hw_handle_test_shortcode1');
