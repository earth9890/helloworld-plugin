<?php


class HY_ADMIN
{
    function __construct()
    {
        add_action('admin_menu', array($this, 'register_settings_menu_page'));
        add_action('admin_enqueue_scripts', array($this, 'add_styles'));
    }

    function validate_settings()
    {
        $valid = true;

        if (!isset($_POST['news_related_title']) || empty($_POST['news_related_title'])) {
            $this->show_error_message('Related News Title is required');
            $valid = false;
        }
        array('news_related_title' => 'required');
        if (!isset($_POST['related_news_amount']) && $_POST['related_news_amount'] <= 0 && $_POST['related_news_amount'] > 10) {
            $this->show_error_message('Select valid no of articles');
            $valid = false;
        }
        return $valid;
    }
    function add_styles($hook)
    {
        if ('news_page_news-settings' !== $hook) {
            return;
        }
        wp_enqueue_style(
            'news-settings-style',
            plugins_url('includes/css/settings.css', HY_PLUGIN_FILE),
            array(),
            HY_PLUGIN_VERSION
        );
        wp_enqueue_script(
            'news-settings-js',
            plugins_url('includes/js/settings.js', HY_PLUGIN_FILE),
            array(),
            HY_PLUGIN_VERSION,
            true
        );
    }

    function register_settings_menu_page()
    {
        add_submenu_page('edit.php?post_type=news', 'News Settings', 'Settings', 'manage_options', 'news-settings', array($this, 'render_settings_page'));
    }

    function render_settings_page()
    {
        if (isset($_POST['news_settings_nonce'])) {
            $this->save_settings();
        }
        include dirname(__FILE__) . "/templates/admin_settings.php";
    }

    function save_settings()
    {
        // Check if the nonce is set and valid
        if (!isset($_POST['news_settings_nonce']) || !wp_verify_nonce($_POST['news_settings_nonce'], 'news-settings-save')) {
            // If the nonce is not valid, display an error message and stop processing
            wp_die('Security Token Invalid');
        }

        if (!current_user_can('manage_options')) {
            wp_die('No permission');
        }


        update_option('hwy_news_related_title', sanitize_text_field($_POST['news_related_title']));

        update_option('hwy_show_related', (isset($_POST['show_related']) ? true : false));
        // if (isset($_POST['show_related'])) {
        //     update_option('hwy_show_related', true);
        // } else {
        //     update_option('hwy_show_related', false);
        // }

        update_option('hwy_related_news_amount', sanitize_text_field($_POST['related_news_amount']));

        $this->show_success_message();

    }

    function show_success_message()
    {
        echo '<div class="notice notice-success">
            Settings Saved
          </div>';
    }
    function show_error_message($message)
    {
        echo '<div class="notice notice-error"> <p> ';
        echo (esc_html($message)) . "</p> </div> ";


    }

}

$hw_admin = new HY_ADMIN();
