<?php

/*
* @Author 		Woolston Web Design
* Copyright: 	2018 WWD Blank Slate
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


function wwd_register_menus() {
    register_nav_menus(
          array(
              'main-menu' => __( 'Main Menu', 'wwd_blankslate' )
          )
    );
}
add_action( 'init', 'wwd_register_menus' );
  