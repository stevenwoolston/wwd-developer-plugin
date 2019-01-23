<div class="wrap">
    <h1>Woolston Web Design Options</h1>
    <?php settings_errors(); ?>


    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#tab-1">Manage Settings</a>
        </li>
        <li>
            <a href="#tab-2">Updates</a>
        </li>
        <li>
            <a href="#tab-4">Social Media and SEO</a>
        </li>
        <li>
            <a href="#tab-3">About</a>
        </li>
    </ul>

    <form action="options.php" method="post">
    <?php settings_fields('wwd-plugin-options'); ?>
        <div class="tab-content">
            <div id="tab-1" class="tab-pane active">
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">
                            <label for="custom_carousel">Carousel:</label>
                        </th>
                        <td>
                            <input type="text" id="custom_carousel" size="50" name="wwd-plugin[custom_carousel]" value="<?php echo $options['custom_carousel']; ?>" />
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
                                            <input type="text" size="30" name='wwd-plugin[custom_posts][<?php echo $i; ?>][name]' value='<?php echo $post["name"]; ?>' />
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
                <h2>Updates</h2>
            </div>

            <div id="tab-3" class="tab-pane">
                <h2>About</h2>
            </div>

            <div id="tab-4" class="tab-pane">
                <h2>Social Media and SEO</h2>
            </div>

            <?php submit_button();  ?>
        </div>
    </form>    

</div>