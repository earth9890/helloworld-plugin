<div class='wrap'>
    <div class="leftcol">
        <h1> News Category Settings </h1>
        <form action="<?php echo admin_url('edit.php?post_type=news&page=news-settings') ?>" method="post">
            <?php wp_nonce_field("news-settings-save", "news_settings_nonce"); ?>
            <table class="form-table">
                <tbody>
                    <tr>
                        <th><label
                                for="news_related_title"><?php echo esc_html(__('Related News Title', 'helloworld')); ?></label>
                        </th>
                        <td><input id="news_related_title" type="text" name="news_related_title"
                                value="<?php echo esc_attr(isset($_POST['news_related_title']) ? $_POST['news_related_title'] : get_option('news_related_title', 'Related News')) ?>"
                                required></td>
                    </tr>
                    <tr>
                        <th><label
                                for="show_related"><?php echo esc_html(__('Show Related News?', 'helloworld')); ?></label>
                        </th>
                        <td><input id="show_related" type="checkbox" name="show_related" value="1" <?php checked(get_option('hwy_show_related', true), true) ?>></td>
                    </tr>
                    <th>
                        <label for="related_news_amount"><?php echo esc_html(__('Number of Articles', 'helloworld')); ?></label>
                    </th>
                    <td>
                        <select id="related_news_amount" name="related_news_amount">
                            <?php for ($i = 1; $i <= 10; $i++): ?>
                                <option value="<?php echo $i; ?>" <?php selected((isset($_POST['related_news_amount']) ? $_POST['related_news_amount'] : get_option("hwy_related_news_amount", 3)), $i) ?>>
                                    <?php echo $i; ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                    </td>

                </tbody>
            </table>
            <p class="submit">
                <input type="submit" name="submit" id="submit" class="button button-primary"
                    value="<?php echo esc_attr(__('Save Changes', 'helloworld')); ?>">
            </p>

        </form>
    </div>
    <div class="rightcol">
        <h2>Instructions</h2>
        <p>Use this page to configure the settings for the News Category</p>
        <p><a href="https://www.example.com"><?php echo esc_html(__('Check our website', 'helloworld')); ?></a></p>
    </div>
</div>