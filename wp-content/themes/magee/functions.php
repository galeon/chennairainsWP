<?php
/**
 * OptionTree Theme version
 */
define( 'MAGEE_THEME_VERSION', '2.1 ( Lite )' );

/**
 * Optional: set 'ot_show_pages' filter to false.
 * This will hide the settings & documentation pages.
 */
add_filter( 'ot_show_pages', '__return_false' );
/**
 * Optional: set 'ot_show_new_layout' filter to false.
 * This will hide the "New Layout" section on the Theme Options page.
 */
add_filter( 'ot_show_new_layout', '__return_false' );
/**
 * Required: set 'ot_theme_mode' filter to true.
 */
add_filter( 'ot_theme_mode', '__return_true' );

/**
 * Child Theme Mode
 */
 if(is_child_theme()){
add_filter( 'ot_child_theme_mode', '__return_true' );
}
else{
add_filter( 'ot_child_theme_mode', '__return_false' );
}

/**
 * Filters the Theme Options ID
 */
function filter_magee_theme_options_menu_slug() {
  return 'magee-theme-options';
}
add_filter( 'ot_theme_options_menu_slug', 'filter_magee_theme_options_menu_slug' );


/**
 * Filters the Theme Options ID
 */
function filter_magee_options_id() {
  return 'magee_option';
}
add_filter( 'ot_options_id', 'filter_magee_options_id' );

/**
 * Filters the Settings ID
 */
function filter_magee_settings_id() {
  return 'magee_option_settings';
}
add_filter( 'ot_settings_id', 'filter_magee_settings_id' );

/**
 * Filters the Layouts ID
 */
function filter_magee_layouts_id() {
  return 'magee_option_layouts';
}
add_filter( 'ot_layouts_id', 'filter_magee_layouts_id' );

function filter_magee_header_logo_link() {
  return '<a href="'.esc_url("http://www.mageewp.com").'" target="_blank"></a>';
}
add_filter( 'ot_header_logo_link', 'filter_magee_header_logo_link' );

function filter_magee_header_version_text() {
  return 'Magee '.MAGEE_THEME_VERSION;
}
add_filter( 'ot_header_version_text', 'filter_magee_header_version_text' );

/**
 * Filters the Theme Option header list.
 */
function filter_magee_header_list() {
  echo '<li style="float:right; padding-top: 5px;">
  <ul style="float:left; margin-right:10px;"><li class="top-menu-item"><a target="_blank" href="'.esc_url("http://www.mageewp.com/").'"><span>MageeWP Themes</span></a></li>
  	<li class="top-menu-item"><a target="_blank" href="'.esc_url("http://www.mageewp.com/documents/tutorials/").'"><span>Tutorials</span></a></li>
  	<li class="top-menu-item"><a target="_blank" href="'.esc_url("http://www.mageewp.com/documents/faq/").'"><span>FAQ</span></a></li>
  	<li class="top-menu-item"><a target="_blank" href="'.esc_url("http://www.mageewp.com/documents/").'"><span>Supports</span></a></li>
  	<li class="top-menu-item"><a target="_blank" href="'.esc_url("http://www.mageewp.com/forums/").'"><span>Forum</span></a></li></li></ul>';
}
add_action( 'ot_header_list', 'filter_magee_header_list' );

/**
 * Meta Boxes
 */
add_filter( 'ot_meta_boxes', '__return_true' );
/**
 * Theme Setup
 */

load_template( trailingslashit( get_template_directory() ) . 'includes/theme-setup.php' );

/**
 * Required: include OptionTree.
 */
 
load_template( trailingslashit( get_template_directory() ) . 'options/ot-loader.php' );

/**
 * Theme Functions
 */
 
load_template( trailingslashit( get_template_directory() ) . 'includes/theme-functions.php' );

/**
 * Theme options
 */
 
load_template( trailingslashit( get_template_directory() ) . 'includes/theme-options.php' );

/**
 * Theme breadcrumb
 */
load_template( trailingslashit( get_template_directory() ) . 'includes/class-breadcrumb.php');
/**
 * Theme widget
 */
 
load_template( trailingslashit( get_template_directory() ) . 'includes/theme-widget.php' );
/**
 * Meta Boxes
 */
load_template( trailingslashit( get_template_directory() ) . 'includes/meta-boxes.php' );

/**
 * Post Type Portfolio
 */
load_template( trailingslashit( get_template_directory() ) . 'includes/postType-portfolio.php' );

/**
 * Post Type Slider
 */
load_template( trailingslashit( get_template_directory() ) . 'includes/postType-slider.php' );


/**
 * Load shortcodes
 */
load_template( trailingslashit( get_template_directory() ) . 'includes/magee-shortcodes.php' );
/**
 * Load shortcode media buttons
 */
 
load_template( trailingslashit( get_template_directory() ) . 'includes/shortcode-media-button.php' );


 /**
 * Load demo data importer
 */
 
 load_template( trailingslashit( get_template_directory() ) . 'importer/importer.php' );
 