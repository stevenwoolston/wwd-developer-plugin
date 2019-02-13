<?php

/*
* @Author 		Woolston Web Design
* Copyright: 	2018 WWD Blank Slate
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

$options = get_option('wwd-plugin');
if (!empty($options)) {
    $formats = array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat');
    $output = array();

    foreach($formats as $format) {
        $output[] = (@$options['theme_options']['post_formats'][$format] == 1 ? $format : '');
    }

    add_theme_support('post-formats', $output);
}

$custom_header = $options['use_custom_header'];
if ($custom_header == 1) {
    add_theme_support('custom-header');
}

$custom_background = $options['use_custom_background'];
if ($custom_background == 1) {
    add_theme_support('custom-background');
}

function wwd_register_menus() {
    register_nav_menu('nav-menu', 'Navigation Main Menu');
}
add_action( 'after_setup_theme', 'wwd_register_menus' );
