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