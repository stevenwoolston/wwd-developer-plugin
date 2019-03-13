<?php
/*
@package Woolston Web Design Developer Plugin
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

$use_custom_gallery = get_option("wwd-plugin")['bootstrap_carousel'];
if ($use_custom_gallery == 1) {
    //  only set this up if the option is selected
    add_image_size('wwd-gallery-image', 600, 600);
    add_filter('post_gallery','wwd_gallery', 10, 2);
    add_action('init', 'custom_carousel_gallery_format', 4);
    add_filter('option_default_post_format', 'carousel_default_format');
    add_filter('image_size_names_choose', 'wwd_add_carousel_image_size');
}

function wwd_add_carousel_image_size($sizes) {
    $wwd_image_sizes = array(
        "wwd-gallery-image" => __( "Custom Carousel Size" )
    );
    return array_merge($sizes, $wwd_image_sizes);
}

function custom_carousel_gallery_format() {
    add_post_type_support('carousel', 'post-formats');
    register_taxonomy_for_object_type('post-format', 'carousel');
}

function carousel_default_format( $format ) {
    //  override the default post format for carousel post type
    global $post_type;

    switch($post_type) {
        case 'carousel':
            $format = 'gallery';
            break;
    }
    return $format;
}

function wwd_gallery($string, $attr) {
    
    if ($attr["size"] == "wwd-gallery-image") {
        return wwd_carousel($attr);
    }
    return wwd_thumbnail_grid($attr);
}

/*  Image gallery thumbnails    */
function wwd_thumbnail_grid($attr) {
    $posts_order_string = $attr['ids'];
    $posts_order = explode(',', $posts_order_string);

    $posts = get_posts(array(
        'include' => $posts_order,
        'post_type' => 'attachment', 
        'orderby' => 'post__in'
    ));

    $output = "<div class='gallery-thumbnail-grid'>";
    foreach($posts as $imagePost){
        $output .= "<div class='thumbnail-item'>";
        $output .= "    <a href=" . wp_get_attachment_image_src($imagePost->ID, 'large')[0] . " target='_blank'>";
        $output .= "        <img src=" . wp_get_attachment_image_src($imagePost->ID, 'thumbnail')[0] . " alt='' />";
        $output .= "    </a>";
        $output .= "    <div class='text-overlay'>" . $imagePost->post_excerpt . "</div>";
        $output .= "</div>";
    }
    $output .= "</div>";
    return $output;
}

/*  Image gallery Bootstrap carousel   */
function wwd_carousel($attr) {

    $posts_order_string = $attr['ids'];
    $posts_order = explode(',', $posts_order_string);

    $output = "<div class='col-xs-12 gallery-container'>";
    $output .= "<div id='carousel-example-generic' class='carousel slide' data-ride='carousel' data-interval='" . get_option( "carousel_speed" ) . "000'>";

    $posts = get_posts(array(
          'include' => $posts_order,
          'post_type' => 'attachment', 
          'orderby' => 'post__in'
    ));

    if($attr['orderby'] == 'rand') {
        shuffle($posts); 
    } 

    $count = 0;
    $output .= "<ol class=\"carousel-indicators\">";
    foreach($posts as $imagePost){
        $output .= "<li data-target='#carousel-example-generic' data-slide-to='" . $count . "' class='" . ($count == 0 ? "active" : "") . "'></li>";
        $count++;
    }
    $output .= "</ol>";

    $count = 0;
    $output .= "<div class='carousel-inner' role='listbox'>";
    foreach($posts as $imagePost){
        $output .= "<div class='item " . ($count == 0 ? "active" : "") . "'>";
        $output .= '<img src="' . wp_get_attachment_image_src($imagePost->ID, 'medium-large')[0] . '" alt="" />';
        $output .= "    <div class='carousel-caption'>";
        //$output .= "<div class='underlay'></div>";
        $output .= "        <div class='text-overlay'>" . $imagePost->post_excerpt . "</div>";
        $output .= "    </div>";
        $output .= "</div>";
        $count++;
    }

    $output .= "<a class='left carousel-control' href='#carousel-example-generic' role='button' data-slide='prev'>";
    $output .= "<span class='glyphicon glyphicon-chevron-left' aria-hidden='true'></span>";
    $output .= "<span class='sr-only'>Previous</span>";
    $output .= "</a>";
    $output .= "<a class='right carousel-control' href='#carousel-example-generic' role='button' data-slide='next'>";
    $output .= "<span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span>";
    $output .= "<span class='sr-only'>Next</span>";
    $output .= "</a>";

    $output .= "</div>";
	$output .= "</div>";
	$output .= "</div>";

    return $output;
}