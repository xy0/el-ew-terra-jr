<?php /* Child Theme */

/* Define Constants Function - DO NOT MODIFY >~~~~~~~~~~> */
function ter_define_constants($constants){ foreach($constants as $key => $value) if(!defined($key)) define($key,$value); }
$ter_dir = get_bloginfo('stylesheet_directory');//Child theme is always 'stylesheet_directory'
/* <~~~~~~~~~~< END Define Constants Function */

/* Parent Theme Directories ~~> */
ter_define_constants(array(
	'TERRA_CHILD' => 		$ter_dir . '/',
	'TER_CHILD_CSS' => 		$ter_dir . '/css/',
	'TER_CHILD_GRAPHICS' => $ter_dir . '/graphics/',
	'TER_CHILD_INCLUDES' =>dirname(__FILE__) . '/includes/',
	'TER_CHILD_JS' => 		$ter_dir . '/js/'
));

/* Theme Options - See README.md for your release: https://github.com/hyptx/terra/ >~~~~~~~> */
ter_define_constants(array(
	/* System */
	'TER_ERROR_DISPLAY_ON' => 		false,
	'TER_CDN_URL' => 				'//cdnjs.cloudflare.com/ajax/libs/',
	'TER_JQUERY_VERSION' => 		'1.9.1',
	'TER_BOOTSTRAP_VERSION' => 		'3.3.0',
	'TER_BS_IMG_RESPONSIVE' => 		'article img,.widget img',
	'TER_GOOGLE_FONT' => 			'Open+Sans:400,400italic,600,600italic',	
	/* Layout */
	'TER_LOGO' => 					$ter_dir . '/graphics/logo.png',
	'TER_HEADER_HOME_LINK' => 		'title',
	'TER_FULL_WIDTH_CLASS' => 		'col-sm-12',
	'TER_PRIMARY_CLASS' => 			'col-sm-8',
	'TER_SECONDARY_CLASS' => 		'col-sm-4',
	'TER_SECONDARY' => 				'right',
	'TER_SIDEBARS' => 				'Blog Sidebar,Page Sidebar',
	/* Wordpress */
	'TER_ADD_HOME_LINK' => 			false,
	'TER_ADMIN_BAR' => 				'editor',
	'TER_ADMIN_BAR_LOGIN' => 		false,
	'TER_EXCERPT' => 				false,
	'TER_EXCERPT_LEN' => 			40,
	'TER_TITLE_FORMAT_DEFAULT' => 	false,
	'TER_MAX_IMAGE_SIZE_KB' => 		1024,
	'TER_WP_POST_FORMATS' => 		false,
	'TER_GF_BUTTON_CLASS' =>		'btn btn-info',
	'TER_COPYRIGHT' =>				'&copy; ' . date('Y ') . get_bloginfo('name'),
	/* Features */
	'TER_ACTIVATE_BACK_TO_TOP' => 	false,
	'TER_ACTIVATE_BRANDING' => 		false,
	'TER_ACTIVATE_FAVICONS' => 		false,
	'TER_ACTIVATE_SITE_MOVED' => 	false,
	'TER_ACTIVATE_SSL' => 			false,
	'TER_ACTIVATE_SLIDER' => 		false,
	'TER_ACTIVATE_WAYPOINTS' => 	false,	
	/* Experimental */
	'TER_ACTIVATE_SKROLLR' => 		false
));
/* END <~~~~~~~< Theme Options */

/* Setup ~~> */
function terra_setup(){
	if(TER_ERROR_DISPLAY){ error_reporting(E_ALL ^ E_NOTICE); ini_set('display_errors','1'); }
	add_theme_support('automatic-feed-links');
	add_theme_support('post-thumbnails');
	register_nav_menu('header',__('Header Menu','terra'));
	register_nav_menu('primary',__('Primary Menu','terra'));
	register_nav_menu('footer',__('Footer Menu','terra'));
	remove_action('wp_head','rsd_link');
	remove_action('wp_head','wp_generator');
	remove_action('wp_head','feed_links',2);
	remove_action('wp_head','index_rel_link');
	remove_action('wp_head','wlwmanifest_link');
	remove_action('wp_head','feed_links_extra',3);
	remove_action('wp_head','start_post_rel_link',10,0);
	remove_action('wp_head','parent_post_rel_link',10,0);
	remove_action('wp_head','adjacent_posts_rel_link',10,0);
	remove_filter('the_content','wptexturize');
	remove_filter('comment_text','wptexturize');
	remove_filter('the_excerpt','wptexturize');
	if(TER_WP_POST_FORMATS) add_theme_support('post-formats',explode(',',TER_WP_POST_FORMATS));	
}

/* Admin Favicon ~~> */
function ter_admin_favicon(){
	echo '<link rel="shortcut icon" href="' . TER_CHILD_GRAPHICS . 'favicon-32x32.png">';
}

/* Enqueue Styles ~~> */
function ter_enqueue_styles(){
	if(is_admin()) return;	
	wp_enqueue_style('ter_styles',TERRA . 'style.css');
	wp_enqueue_style('ter_child_styles',TERRA_CHILD . 'style.css',array('ter_styles'));
} 

/* Favicons ~~> */
function ter_favicons(){
	if(TER_ACTIVATE_FAVICONS) require('favicon.php');
	else echo '<link rel="shortcut icon" href="' . TER_CHILD_GRAPHICS .'favicon-32x32.png">';
}

/* Login Styles ~~> */
function ter_login_styles(){
	wp_enqueue_style('ter_login_css',TER_CHILD_CSS . 'login.css');
}

/* <~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~< Extras >~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~> */

/* Extra Includes - Uncomment to start including files ~~~~> */
/*
require(TER_CHILD_INCLUDES . 'functions-custom.php');
*/

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
?>