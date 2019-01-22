<?php
    // $options = get_option('wwd-plugin');
    add_settings_field('tracking_code', 'Google Analytics Tracking Code', 'display_tracking_code', 'wwd_plugin', 'wwd-seo-options');


function display_tracking_code() {
    $seoTrackingCode = $options['custom_posts'];
    echo '<textarea rows="20" cols="100" name="wwd-plugin[custom_posts]">' . $seoTrackingCode . '</textarea>';
}

?>