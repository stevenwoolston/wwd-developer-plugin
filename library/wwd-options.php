<?php
/*  Custom Options Page 
**  https://gist.githubusercontent.com/tommcfarlin/04782209b0822ce2bf1f/raw/4249877ae35665e1a4776de420b7df34d36102aa/display-acme-options-final.php
**  https://wordpress.stackexchange.com/questions/154478/passing-array-in-add-option
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

function wwd_add_admin_page() {
    add_menu_page( 'WWD Theme Options', 'WWD', 'manage_options', 'wwd_plugin', 'wwd_theme_create_settings_page', 'dashicons-admin-customizer', 110 );
    add_submenu_page( 'wwd_plugin',  'WWD Theme Options',  'Settings',  'manage_options',  'wwd_plugin',  'wwd_theme_create_settings_page' );

    register_setting('wwd-plugin-options', 'wwd-plugin');
}
add_action('admin_menu', 'wwd_add_admin_page');

function wwd_theme_create_settings_page() {
    $options = get_option('wwd-plugin');
    require_once WWD_PLUGIN_PATH . "/templates/admin.php";
}

function wwd_get_attachment($num = 1) {
	$output = '';
	if (has_post_thumbnail() && $num == 1):
		//	get the featured image
		$output = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
	else:
		//	get the attached images from the post
		$attachments = get_posts(array(
			'post_type' => 'attachment',
			'posts_per_page' => $num,
			'post_parent' => get_the_ID()
		));

		if ($attachments && $num == 1):
			foreach($attachments as $attachment):
				$output = wp_get_attachment_url( $attachment->ID );
			endforeach;
		elseif ($attachments && $num > 1):
			$output = $attachments;
		endif;

		wp_reset_postdata();
	endif;

	return $output;
}
/*
add_action( 'admin_menu', 'wwd_add_options_page' );
function wwd_add_options_page() {

	add_options_page(
		'WWD Options',
		'WWD Options',
		'manage_options',
		'wwd-options-page',
		'display_options_page'
	);

}

function display_options_page() {

	echo '<h1>WWD Options Panel</h1><hr />';

	echo '<form method="post" action="options.php">';

	do_settings_sections( 'wwd-options-page' );
	settings_fields( 'wwd-settings' );

	submit_button();

	echo '</form>';

}

add_action( 'admin_init', 'admin_init_one' );
function admin_init_one() {

	add_settings_section(
		'wwd-settings-section-one',      
		'General Options',         
		'display_general_settings_message',  
		'wwd-options-page'               
	);

	add_settings_field(
		'frontpage_carousel',        
		'Enable Front Page Carousel?',        
		'display_frontpage_carousel',  
		'wwd-options-page',        
		'wwd-settings-section-one' 
	);

	add_settings_field(
		'carousel_category',
		'Category For Carousel',
		'display_carousel_category',
		'wwd-options-page',
		'wwd-settings-section-one'
	);
    
	add_settings_field(
		'carousel_speed',
		'Carousel Transition Speed (in seconds)',
		'display_carousel_speed',
		'wwd-options-page',
		'wwd-settings-section-one'
	);
    
	add_settings_field(
		'carousel_transition',
		'Carousel Transition',
		'display_carousel_transition',
		'wwd-options-page',
		'wwd-settings-section-one'
	);
    
	add_settings_field(
		'home_content_category',
		'Full Width Home Content Category',
		'display_home_content_category',
		'wwd-options-page',
		'wwd-settings-section-one'
	);
    
	register_setting(
		'wwd-settings',    
		'frontpage_carousel'    
	);
    
	register_setting(
		'wwd-settings',    
		'carousel_category'    
	);
    
	register_setting(
		'wwd-settings',    
		'carousel_speed'    
	);
    
	register_setting(
		'wwd-settings',    
		'carousel_transition'    
	);

	register_setting(
		'wwd-settings',    
		'home_content_category'    
	);
    
}

function display_general_settings_message() {
	echo "<p>General settings that are used in the WWD Theme.</p>";
}

add_action( 'admin_init', 'admin_init_two' );
function admin_init_two() {

	add_settings_section(
		'wwd-settings-section-two',
		'<hr />SEO Options',
		'display_seo_settings_message',
		'wwd-options-page'
	);

	add_settings_field(
		'facebookurl',
		'Facebook URL',
		'display_facebook_url',
		'wwd-options-page',
		'wwd-settings-section-two'
	);

	add_settings_field(
		'twitter_url',
		'Twitter URL',
		'display_twitter_url',
		'wwd-options-page',
		'wwd-settings-section-two'
	);
    
	add_settings_field(
		'googleurl',
		'Google Plus URL',
		'display_google_url',
		'wwd-options-page',
		'wwd-settings-section-two'
	);

	add_settings_field(
		'youtube_url',
		'Youtube Channel URL',
		'display_youtube_url',
		'wwd-options-page',
		'wwd-settings-section-two'
	);
    
	add_settings_field(
		'tracking_code',
		'Google Analytics Tracking Code',
		'display_tracking_code',
		'wwd-options-page',
		'wwd-settings-section-two'
	);
    
	add_settings_field(
		'meta_description',
		'Meta Description (155 chars)',
		'display_meta_description',
		'wwd-options-page',
		'wwd-settings-section-two'
	);

	register_setting(
		'wwd-settings',
		'facebook_url'
	);

	register_setting(
		'wwd-settings',
		'twitter_url'
	); 

	register_setting(
		'wwd-settings',
		'google_url'
	);

	register_setting(
		'wwd-settings',
		'youtube_url'
	); 
    
	register_setting(
		'wwd-settings',
		'tracking_code'
	); 
    
	register_setting(
		'wwd-settings',
		'meta_description'
	);     
}

function display_seo_settings_message() {
    echo '<p>Please be aware that these settings can take many days or even weeks to appear in search engine results.</p>';
}

function display_frontpage_carousel()
{
	$input = get_option( 'frontpage_carousel' );
    ?>
        <input type="radio" name="frontpage_carousel" id="frontpage_carousel_true" value="true" <?php if ($input == 'true') echo 'checked'; ?> />Yes
        <input type="radio" name="frontpage_carousel" id="frontpage_carousel_true" value="false" <?php if ($input == 'false') echo 'checked'; ?> />No
    <?php
}

function display_facebook_url()
{
	$input = get_option( 'facebook_url' );
    echo '<input type="text" size="50" name="facebook_url" id="facebook_url" value="' . $input . '" />';
}
function display_twitter_url()
{
	$input = get_option( 'twitter_url' );
    echo '<input type="text" size="50" name="twitter_url" id="twitter_url" value="' . $input . '" />';
}
function display_google_url()
{
	$input = get_option( 'google_url' );
    echo '<input type="text" size="50" name="google_url" id="google_url" value="' . $input . '" />';
}
function display_youtube_url()
{
	$input = get_option( 'youtube_url' );
    echo '<input type="text" size="50" name="youtube_url" id="youtube_url" value="' . $input . '" />';
}

function display_tracking_code()
{
	$input = get_option( 'tracking_code' );
    echo '<input type="text" size="50" name="tracking_code" id="tracking_code" value="' . $input . '" />';
}

function display_meta_description()
{
	$input = get_option( 'meta_description' );
    echo '<textarea name="meta_description" rows="3" style="width: 80%" id="meta_description">' . $input . '</textarea>';
}

function display_carousel_speed()
{
	$input = get_option( 'carousel_speed' );
    echo '<input type="text" size="50" name="carousel_speed" id="carousel_speed" value="' . $input . '" />';
}

function display_carousel_transition()
{
	$input = get_option( 'carousel_transition' );
?>
    <select name='carousel_transition'>
        <option value="carousel-fade" <?php echo ($input == "carousel-fade") ? 'selected' : ''; ?>>Fade</option>
        <option value="" <?php echo ($input == "") ? 'selected' : ''; ?>>Slide Horizontally</option>
        <option value="carousel-height" <?php echo ($input == "carousel-height") ? 'selected' : ''; ?>>Slide In Vertically</option>
    </select>
<?php
}

function display_carousel_category()
{
	$input = get_option( 'carousel_category' );
?>
    <select name="carousel_category">
<?php
    if ( $input == '') {
?>
        <option value=""><?php echo esc_attr(__('Select Category')); ?></option> 
<?php }

        $categories = get_categories(); 
        foreach ($categories as $category) {
            if ( $category->slug == $input )
                echo '<option selected value="'.$category->slug.'">' . $category->cat_name . '</option>';
            else
                echo '<option value="'.$category->slug.'">' . $category->cat_name . '</option>';                    
        }
        ?>
    </select>
<?php
}

function display_home_content_category()
{
	$input = get_option( 'home_content_category' );
?>
    <select name="home_content_category">
<?php
    if ( $input == '') {
?>
        <option selected value=""><?php echo esc_attr(__('Section Is Hidden')); ?></option> 
<?php 
    } else {
?>
        <option value=""><?php echo esc_attr(__('Section Is Hidden')); ?></option>    
<?php
    }
        $categories = get_categories(); 
        foreach ($categories as $category) {
            if ( $category->slug == $input )
                echo '<option selected value="'.$category->slug.'">' . $category->cat_name . '</option>';
            else
                echo '<option value="'.$category->slug.'">' . $category->cat_name . '</option>';                    
        }
        ?>
    </select>
<?php
}
*/