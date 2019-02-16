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

    $default_options = array(
        'use_custom_header' => false,
        'bootstrap_carousel' => true,
        'carousel_speed' => 10,
        'use_custom_background' => false,
        'custom_posts' => array(
            array(
                'name' => 'layout',
                'label' => 'Layout',
                'plural' => 'Layouts',
                'icon' => 'dashicons-editor-table'
            )
        ),
        'seo' => array(
            'meta_description' => '',
            'google_analytics_tracking_code' => ''
        ), 
        'theme_options' => array(
            'post_formats' => array()
        ),
        'social_media' => array(
            'facebook_url' => '',
            'twitter_url' => '',
            'linkedin_url' => '',
            'instagram_url' => '',
            'youtube_url' => ''
        )
    
    );
    
    $wwd_options = get_option('wwd-plugin');
    $new_options = $default_options + (is_array($wwd_options) ? $wwd_options : array());
    update_option('wwd-plugin', $default_options);
    flush_rewrite_rules();
    
    // if (!get_option('wwd-plugin')) {
    //     update_option('wwd-plugin', $defaultOptions);
    // }
}

function wwd_plugin_deactivate() {
  
    if ( !is_admin() || !get_option( 'wwd-plugin' ) ) {
        return;
    }

    // delete_option('wwd-plugin');
    // flush_rewrite_rules();

}
