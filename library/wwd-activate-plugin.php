<?php

function wwd_plugin_activate() {
  
    if ( !is_admin() ) {
        return;
    }

    //  need to build logic to push into existing options
    
    $default = array(
        'custom_carousel' => true,
        'custom_posts' => array(
            array(
                'name' => 'layout',
                'label' => 'Layout',
                'plural' => 'Layouts'
            ),
            array(
                'name' => 'apartment',
                'label' => 'Apartment',
                'plural' => 'Apartments'
            )
        ),
        'seo' => array(
            'meta_description' => '',
            'google_analytics_tracking_code' => ''
        ), 
        'social_media' => array(
            'facebook_url' => '',
            'twitter_url' => '',
            'linkedin_url' => '',
            'instagram_url' => '',
            'youtube_url' => ''
        )

    );
    update_option('wwd-plugin', $default);
    
    flush_rewrite_rules();
}

function wwd_plugin_deactivate() {
  
    // if ( !is_admin() || !get_option( 'wwd_plugin' ) ) {
    //     return;
    // }

    // delete_option('wwd_plugin');

    // flush_rewrite_rules();
}
