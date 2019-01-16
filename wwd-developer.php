<?php
/*
@package WWD_Developer

Plugin Name: WWD Developer
Plugin URI: https://www.woolston.com.au/wp-content/uploads/2018/03/wwd-developer.zip
Description: Woolston Web Design Developer Plugin
Version: 1.0.0
Author: Steven Woolston
Author URI: https://www.woolston.com.au
Text Domain: social_share_button
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( !defined( 'ABSPATH' ) ) {
    exit;
}

function wwd_add_assets() {
    //wp_enqueue_style('wwd-style', plugins_url() . '/wwd-developer/css/wwd-global.css');
    //wp_enqueue_script('wwd-script', plugins_url() . '/wwd-developer/js/wwd-global.js');
}
add_action('wp_enqueue_scripts', 'wwd_add_assets');


require_once(plugin_dir_path(__FILE__) . '/library/wwd-custom-layout-type.php');

require_once(plugin_dir_path(__FILE__) . '/library/wwd-sitemap.php');

require_once(plugin_dir_path(__FILE__) . '/library/wwd-options.php');

require_once(plugin_dir_path(__FILE__) . '/library/wwd-gallery.php');

/*  Do some maintenance */
require_once(plugin_dir_path(__FILE__) . '/library/wwd-optimisation.php');
register_activation_hook(__FILE__,'simple_optimization_cron_on');
register_deactivation_hook(__FILE__,'simple_optimization_cron_off');

/*** BootStrap Walker Extension code **/
require_once(plugin_dir_path(__FILE__) . '/library/wp-bootstrap-navwalker.php');
/*** Full width Bootstrap mega menu */
require_once(plugin_dir_path(__FILE__) . '/library/yamm-nav-walker.php');

/*	functions.php
**	
	add_action( 'init', 'wwd_custom_layout_type', 0 );

	add_action( 'init', 'wwd_custom_carousel', 0 );
	add_post_type_support( 'layout', 'carousel', 'thumbnail' );

**
*/