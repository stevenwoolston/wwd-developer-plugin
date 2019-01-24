<?php

/*
* @Author 		Woolston Web Design
* Copyright: 	2018 WWD Blank Slate
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

function wwd_options_custom_post_type() {

    $options = get_option('wwd-plugin');
    $custom_post_types = $options['custom_posts'];

    if (empty($custom_post_types)){
        var_dump("There are no options");
        return;
    }
    
    for ($i = 0; $i < count($custom_post_types); $i++) {
        $name = $custom_post_types[$i]["name"];
        $label = $custom_post_types[$i]["label"];
        $plural = $custom_post_types[$i]["plural"];

        $labels = array(
            'name' => _x( $label, $name ),
            'singular_name' => _x( $label, $name ),
            'add_new' => _x( 'Add New', $name ),
            'add_new_item' => _x( 'Add New ' . $label, $name ),
            'edit_item' => _x( 'Edit ' . $label, $name ),
            'new_item' => _x( 'New ' . $label, $name ),
            'view_item' => _x( 'View ' . $label, $name ),
            'search_items' => _x( 'Search ' . $label, $name ),
            'not_found' => _x( 'No Layout found', $name ),
            'not_found_in_trash' => _x( 'No Layout found in Trash', $name ),
            'menu_name' => _x( $plural, $name )
        );
        $args = array(
            'labels' => $labels,
            'hierarchical' => false,
            'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'page-attributes' ),
            'taxonomies' => array('category'),
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_icon' => 'dashicons-editor-table',
            'show_in_nav_menus' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'has_archive' => true,
            'query_var' => true,
            'can_export' => true,
            'rewrite' => array('slug' => $name),
            'capability_type' => 'post'
        );

        register_post_type( $name, $args );

    }
    
}
add_action( 'init', 'wwd_options_custom_post_type' );

function wwd_generic_custom_layout_type($name, $label, $plural) {

    $labels = array(
        'name' => _x( $label, $name ),
        'singular_name' => _x( $label, $name ),
        'add_new' => _x( 'Add New', $name ),
        'add_new_item' => _x( 'Add New ' . $label, $name ),
        'edit_item' => _x( 'Edit ' . $label, $name ),
        'new_item' => _x( 'New ' . $label, $name ),
        'view_item' => _x( 'View ' . $label, $name ),
        'search_items' => _x( 'Search ' . $label, $name ),
        'not_found' => _x( 'No Layout found', $name ),
        'not_found_in_trash' => _x( 'No Layout found in Trash', $name ),
        'menu_name' => _x( $plural, $name )
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
        'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'page-attributes' ),
        'taxonomies' => array('category'),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-editor-table',
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        // 'rewrite' => array('slug' => $name),
        'capability_type' => 'post'
    );

    register_post_type( $name, $args );

}

function wwd_custom_layout_type() {

    $labels = array(
        'name' => _x( 'Layout', 'layout' ),
        'singular_name' => _x( 'Layout', 'layout' ),
        'add_new' => _x( 'Add New', 'layout' ),
        'add_new_item' => _x( 'Add New Layout', 'layout' ),
        'edit_item' => _x( 'Edit Layout', 'layout' ),
        'new_item' => _x( 'New Layout', 'layout' ),
        'view_item' => _x( 'View Layout', 'layout' ),
        'search_items' => _x( 'Search Layout', 'layout' ),
        'not_found' => _x( 'No Layout found', 'layout' ),
        'not_found_in_trash' => _x( 'No Layout found in Trash', 'layout' ),
        'menu_name' => _x( 'Layouts', 'layout' )
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
        'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'page-attributes' ),
        'taxonomies' => array('category'),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-editor-table',
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => array('slug' => 'layout'),
        'capability_type' => 'post'
    );

    register_post_type( 'layout', $args );

}

function wwd_custom_carousel() {

    $labels = array(
        'name' => _x( 'Carousel', 'carousel' ),
        'singular_name' => _x( 'Carousel', 'carousel' ),
        'add_new' => _x( 'Add New', 'carousel' ),
        'add_new_item' => _x( 'Add New Carousel', 'carousel' ),
        'edit_item' => _x( 'Edit Carousel', 'carousel' ),
        'new_item' => _x( 'New Carousel', 'carousel' ),
        'view_item' => _x( 'View Carousel', 'carousel' ),
        'search_items' => _x( 'Search Carousel', 'carousel' ),
        'not_found' => _x( 'No Carousel found', 'carousel' ),
        'not_found_in_trash' => _x( 'No Carousel found in Trash', 'carousel' ),
        'menu_name' => _x( 'Carousels', 'carousel' )
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
        'supports' => array( 'title', 'editor', 'author' ),
        'taxonomies' => array('category'),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-images-alt2',
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => array('slug' => 'carousel'),
        'capability_type' => 'post'
    );

    register_post_type( 'carousel', $args );

}