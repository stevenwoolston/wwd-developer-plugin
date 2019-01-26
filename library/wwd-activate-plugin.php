<?php

/*
* @Author 		Woolston Web Design
* Copyright: 	2018 WWD Blank Slate
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

function wwd_plugin_activate() {
  
    if ( !is_admin() ) {
        return;
    }

    $defaultOptions = array(
        'bootstrap_carousel' => true,
        'custom_posts' => array(
            array(
                'name' => 'layout',
                'label' => 'Layout',
                'plural' => 'Layouts'
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

    if (!get_option('wwd-plugin')) {
        update_option('wwd-plugin', $defaultOptions);
        flush_rewrite_rules();
    } else {

        $existingOptions = get_option('wwd-plugin');

    }
}

function wwd_plugin_deactivate() {
  
    if ( !is_admin() || !get_option( 'wwd-plugin' ) ) {
        return;
    }

    // delete_option('wwd-plugin');
    // flush_rewrite_rules();

}
