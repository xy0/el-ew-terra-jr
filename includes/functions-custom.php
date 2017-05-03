<?php
/* <~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~< Extras >~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~> */

/* Custom Post Types - Uncomment to start creating easy CTP's ~~~~> */
/*
require(TER_CHILD_INCLUDES . 'custom-post-type.php');//Load Parent Class
require(TER_CHILD_INCLUDES . 'custom-post-type-skeleton.php');//Load a starter skeleton CPT
*/

/* Enqueue Scripts - Uncomment to load js/scripts.js ~~~~> */
/*
function ter_enqueue_child_scripts(){
	wp_enqueue_script('ter_child_scripts',TER_CHILD_JS . 'scripts.js',array('ter_scripts'));
}
add_action('wp_print_scripts','ter_enqueue_child_scripts',101);
*/

/* Child Shortcode System - Uncomment to add custom shortcodes ~~~~> */
/*
//Shortcode callback
function ter_gray_box( $atts, $content = null ){ return '<div class="gray-box">' . do_shortcode($content) . '</div>'; }
add_shortcode('gray-box','ter_gray_box');

//Prevent autop from breaking nested shortcodes by adding it to this array
$ter_child_shortcodes_for_filter = array('gray-box');
*/

/* Child Help - Uncomment to add custom theme help ~~~~> */
/*
//Custom Shortcode section
$ter_child_shortcodes = array('[gray-box]' => 'A gray box with rounded corners');

//Main section
$ter_child_help = array('Help Section Title' => '<p>This is a paragraph of help text</p>','Help Section Title 2' => '<p>This is a paragraph of help text 2</p>');
*/

 // Remove autoP
//
#remove_filter('the_content', 'wpautop');

 // Add enqueue script action
//
add_action( 'ew_counter', 'ew_enqueue_script' );

 // Add Font-Awesome icon CSS
//
wp_enqueue_style( 'font-awesome', '/wp-content/themes/terra-jr/lib/font-awesome-4.7.0/css/font-awesome.min.css');

wp_enqueue_script( 'ew_counter', '/wp-content/themes/terra-jr/js/jquery.counterup.js', array('ter_waypoints') );
?>