<?php

/*
* @Author 		Woolston Web Design
* Copyright: 	2018 WWD Blank Slate
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


function register_my_menus() {
    register_nav_menus(
          array(
              'main-menu' => __( 'Main Menu', 'blankslate' )
          )
    );
  }
  add_action( 'init', 'register_my_menus' );
  