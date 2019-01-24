<?php
/*
@package WWD_Developer

Plugin Name: WWD Developer
Plugin URI: https://www.woolston.com.au/wp-content/uploads/2018/03/wwd-developer.zip
Description: Woolston Web Design Developer Plugin
Version: 2.0.0
Author: Steven Woolston
Author URI: https://www.woolston.com.au
Text Domain: social_share_button
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( !defined( 'ABSPATH' ) ) {
    exit;
}

define("WWD_PLUGIN_PATH", plugin_dir_path(__FILE__));
define("WWD_PLUGIN_BASENAME", plugin_basename(__FILE__));

require_once(plugin_dir_path(__FILE__) . '/inc/wwd-config.php');

require_once(plugin_dir_path(__FILE__) . '/library/wwd-custom-layout-type.php');

require_once(plugin_dir_path(__FILE__) . '/library/wwd-sitemap.php');

require_once(plugin_dir_path(__FILE__) . '/library/wwd-options.php');

require_once(plugin_dir_path(__FILE__) . '/library/wwd-gallery.php');

require_once(plugin_dir_path(__FILE__) . '/library/wwd-activate-plugin.php');

require_once(plugin_dir_path(__FILE__) . '/inc/updater.php');

/*  Do some maintenance */
require_once(plugin_dir_path(__FILE__) . '/library/wwd-optimisation.php');

/*** BootStrap Walker Extension code **/
require_once(plugin_dir_path(__FILE__) . '/library/wp-bootstrap-navwalker.php');
/*** Full width Bootstrap mega menu */
require_once(plugin_dir_path(__FILE__) . '/library/yamm-nav-walker.php');

wwd_init();
function wwd_init() {
    add_action('admin_enqueue_scripts', 'wwd_enqueue_assets');
    register_activation_hook(__FILE__, 'wwd_plugin_activate');
    register_deactivation_hook(__FILE__, 'wwd_plugin_deactivate');
    check_for_update();
}


function wwd_enqueue_assets() {
    wp_enqueue_style('wwd-style', plugins_url('/css/wwd-global.css', __FILE__));
    wp_enqueue_script('wwd-script', plugins_url('/js/wwd-global.js', __FILE__));
}

function check_for_update() {

	if (is_admin()) { // note the use of is_admin() to double check that this is happening in the admin
		$config = array(
			'slug' => plugin_basename(__FILE__), // this is the slug of your plugin
			'proper_folder_name' => 'wwd-developer', // this is the name of the folder your plugin lives in
			'api_url' => 'https://api.github.com/repos/woolstonwebdesign/wwd-developer-plugin', // the GitHub API url of your GitHub repo
			'raw_url' => 'https://raw.github.com/woolstonwebdesign/wwd-developer-plugin/dev', // the GitHub raw url of your GitHub repo
			'github_url' => 'https://github.com/woolstonwebdesign/wwd-developer-plugin', // the GitHub url of your GitHub repo
			'zip_url' => 'https://github.com/woolstonwebdesign/wwd-developer-plugin/zipball/dev', // the zip url of the GitHub repo
			'sslverify' => true, // whether WP should check the validity of the SSL cert when getting an update, see https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/2 and https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/4 for details
			'requires' => '3.0', // which version of WordPress does your plugin require?
			'tested' => '3.3', // which version of WordPress is your plugin tested up to?
			'readme' => 'README.md', // which file to use as the readme for the version number
			'access_token' => '', // Access private repositories by authorizing under Appearance > GitHub Updates when this example plugin is installed
		);
		new WP_GitHub_Updater($config);
	}    
}
/*	functions.php
**	
	add_action( 'init', 'wwd_custom_layout_type', 0 );

	add_action( 'init', 'wwd_custom_carousel', 0 );
	add_post_type_support( 'layout', 'carousel', 'thumbnail' );

**
*/