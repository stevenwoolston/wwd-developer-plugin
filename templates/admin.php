<div class="wrap">
    <h1>Woolston Web Design Options</h1>
    <?php settings_errors(); ?>


    <form action="options.php" method="post">
    <?php settings_fields('wwd-plugin-options'); ?>

        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#tab-1">Manage Settings</a>
            </li>
            <li>
                <a href="#tab-2">SEO</a>
            </li>
            <li>
                <a href="#tab-4">Social Media</a>
            </li>
            <li>
                <a href="#tab-3">About</a>
            </li>
        </ul>

        <div class="tab-content">
            <div id="tab-1" class="tab-pane active">
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">
                            <label for="custom_carousel">Use Custom Carousel:</label>
                        </th>
                        <td>
                            <select name="wwd-plugin[custom_carousel]">
                                <option value="0" <?php echo ($options['custom_carousel'] == 0 ? "selected" : ""); ?>>No</option>
                                <option value="1" <?php echo ($options['custom_carousel'] == 1 ? "selected" : ""); ?>>Yes</option>
                            </select>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">
                            <label for="custom_carousel">Custom Posts:</label>
                        </th>
                        <td>

                            <table class="wwd-admin" cellpadding="0" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Post Id</th>
                                        <th>Post Label</th>
                                        <th>Post Plural</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php
    $i = 0;
    $array_options = $options['custom_posts'];
    foreach($array_options as $post) {
?>
                                    <tr>
                                        <td>
                                            <?php echo $post["name"]; ?>
                                            <input type="hidden" size="30" name='wwd-plugin[custom_posts][<?php echo $i; ?>][name]' value='<?php echo $post["name"]; ?>' />
                                        </td>
                                        <td>
                                            <input type="text" size="30" name='wwd-plugin[custom_posts][<?php echo $i; ?>][label]' value='<?php echo $post["label"]; ?>' />
                                        </td>
                                        <td>
                                            <input type="text" size="30" name='wwd-plugin[custom_posts][<?php echo $i; ?>][plural]' value='<?php echo $post["plural"]; ?>' />
                                        </td>
                                    </tr>          
<?php
    $i++;
    }
?>
                                </tbody>
                            </table>
                        </td>
                    </tr>                    
                </table>
            </div>

            <div id="tab-2" class="tab-pane">

                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">
                            <label for="meta_description">Meta Description <small>(155 chars)</small>:</label>
                        </th>
                        <td>
                            <input type="text" size="155" name="wwd-plugin[seo][meta_description]" maxlength="155" 
                                style="width: 100%;"
                                value="<?php echo $options['seo']['meta_description']; ?>" />
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">
                            <label for="meta_description">Google Analytics Tracking Code:</label>
                        </th>
                        <td>
                            <input type="text" id="google_analytics_tracking_code" size="50" 
                                name="wwd-plugin[seo][google_analytics_tracking_code]" 
                                value="<?php echo $options['seo']['google_analytics_tracking_code']; ?>" />
                        </td>
                    </tr>
                </table>
            </div>

            <div id="tab-3" class="tab-pane">
                <h2>About</h2>
                Steven Woolston<br />
                Woolston Web Design<br />
                Contact: 0407 077 508<br />
                Email: <a href="mailto:design@woolston.comm.au">design@woolston.comm.au</a>
            </div>

            <div id="tab-4" class="tab-pane">

                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">
                            <label for="custom_carousel">Facebook URL:</label>
                        </th>
                        <td>
                            <input type="text" id="facebook_url" size="50" name="wwd-plugin[social_media][facebook_url]" 
                            value="<?php echo $options['social_media']['facebook_url']; ?>" />
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">
                            <label for="twitter_url">Twitter URL:</label>
                        </th>
                        <td>
                            <input type="text" id="twitter_url" size="50" name="wwd-plugin[social_media][twitter_url]" 
                            value="<?php echo $options['social_media']['twitter_url']; ?>" />
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">
                            <label for="linkedin_url">Linkedin URL:</label>
                        </th>
                        <td>
                            <input type="text" id="linkedin_url" size="50" name="wwd-plugin[social_media][linkedin_url]" 
                            value="<?php echo $options['social_media']['linkedin_url']; ?>" />
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">
                            <label for="instagram_url">Instagram URL:</label>
                        </th>
                        <td>
                            <input type="text" id="instagram_url" size="50" name="wwd-plugin[social_media][instagram_url]" 
                            value="<?php echo $options['social_media']['instagram_url']; ?>" />
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">
                            <label for="youtube_url">Youtube URL:</label>
                        </th>
                        <td>
                            <input type="text" id="youtube_url" size="50" name="wwd-plugin[social_media][youtube_url]" 
                            value="<?php echo $options['social_media']['youtube_url']; ?>" />
                        </td>
                    </tr>
                </table>
            </div>

            <?php submit_button();  ?>
        </div>
    </form>    

</div>