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
<?php
var_dump ($options['custom_posts']);
    echo '<ul>';
    foreach($options['custom_posts'] as $post) {
        echo '<li>' . $post->name . '</li>';
    }
?>
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
        </div>
        <?php submit_button();  ?>
    </form>    

</div>