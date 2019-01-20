<?php
/*  Custom Options Page 
**  https://gist.githubusercontent.com/tommcfarlin/04782209b0822ce2bf1f/raw/4249877ae35665e1a4776de420b7df34d36102aa/display-acme-options-final.php
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 
$admin_pages = array();

function wwd_add_admin_pages() {
    add_menu_page("WWD Admin", "WWD", "manage_options", "wwd_plugin", "wwd_admin_index", 'dashicons-store', 110);
}
add_action("admin_menu", "wwd_add_admin_pages");

$admin_pages = [
    [
        'page_title' => 'WWD Admin', 
        'menu_title' => 'WWD', 
        'capability' => 'manage_options', 
        'menu_slug' => 'wwd_plugin', 
        'callback' => 'wwd_admin_index', 
        'icon_url' => 'dashicons-store', 
        'position' => 110
    ]    
];

wwd_add_pages($admin_pages);

//  callback for wwd_add_admin_pages
function wwd_admin_index() {
    require_once WWD_PLUGIN_PATH . "/templates/admin.php";
}

function wwd_add_pages(array $pages) {
    $admin_pages = $pages;
    wwd_register_admin_pages($admin_pages);
}

function wwd_register_admin_pages() {
    if (!empty($admin_pages)) {
        add_action('admin_menu', 'wwd_add_admin_menu');
    }
}

function wwd_add_admin_menu() {
    foreach($admin_pages as $page) {
        add_menu_page(
            $page['page_title'], 
            $page['menu_title'], 
            $page['capability'], 
            $page['menu_slug'], 
            $page['callback'], 
            $page['icon_url'], 
            $page['position'] 
        );
    }
}


/*
    Creating field related content
*/
$wwd_settings = array();
$wwd_sections = array();
$wwd_fields = array();

function wwd_options_group($input) {
    return $input;
}

$wwd_settings = [
    [
        'option_group' => 'wwd_options_group',
        'option_name' => 'text_example',
        'callback' => array('wwd_options_group')
    ]
];

$wwd_sections = [
    [
        'id' => 'wwd_admin_index',
        'title' => 'Settings',
        'callback' => function() { echo 'Section'; },
        'page' => 'wwd_plugin'
    ]
];

$wwd_fields = [
    [
        'id' => 'text_example',
        'title' => 'Text Example',
        'callback' => function() { echo '<input type="text" class="regular-text" name="text-example" value="123" />'; },
        'page' => 'wwd_plugin',
        'section' => 'wwd_admin_index',
        'args' => array(
            'label_for' => 'text_example',
            'class' => 'example-class'
        )
    ]
];

function wwd_register_custom_fields() {
    // var_dump($wwd_settings);
    // var_dump($wwd_sections);
    // var_dump($wwd_fields);

    foreach($wwd_settings as $setting) {
        register_setting(
            $setting["option_group"], 
            $setting["option_name"], 
            (isset($setting["callback"]) ? $setting["callback"] : "" )
        );
    };

    foreach($wwd_sections as $section) {
        add_settings_section(
            $section["id"],
            $section["title"],
            (isset($section["callback"]) ? $section["callback"] : "" ),
            $section["page"]
        );
    };

    foreach($wwd_fields as $field) {
        add_settings_field(
            $field["id"],
            $field["title"],
            (isset($field["callback"]) ? $field["callback"] : "" ),
            $field["page"],
            $field["section"],
            (isset($field["args"]) ? $field["args"] : "" )
        );
    }
}
add_action('admin_menu', 'wwd_register_custom_fields');





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