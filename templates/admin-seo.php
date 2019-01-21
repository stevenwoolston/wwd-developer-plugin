<?php

add_settings_field('tracking_code', 'Google Analytics Tracking Code', 'display_tracking_code', 'wwd_plugin', 'wwd-seo-options');


function display_tracking_code() {
    $seoTrackingCode = get_option('wwd-plugin');
    echo '<textarea rows="20" cols="100" name="options_object">' . json_encode($seoTrackingCode) . '</textarea>';
}

?>