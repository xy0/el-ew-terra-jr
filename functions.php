<?php /* <~~~~~~~~~~< Child Theme >~~~~~~~~~~> */

/*
Securing Terra Jr:
If your site is behid a load balancer, or reverse proxy you need to secure the wordpress admin area.
Paste these two lines near the top of wp-config.php

define('FORCE_SSL_ADMIN',true);
if($_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') $_SERVER['HTTPS'] = 'on';
*/

/* Define Constants Function - DO NOT MODIFY >~~~~~~~~~~> */
function ter_define_constants($constants){ foreach($constants as $key => $value) if(!defined($key)) define($key,$value); }
$ter_dir = get_bloginfo('stylesheet_directory');//Child theme is always 'stylesheet_directory'
/* <~~~~~~~~~~< END Define Constants Function */

/* Directory Constants */
ter_define_constants(array(
	'TERRA_CHILD' => 			$ter_dir . '/',
	'TER_CHILD_CSS' => 			$ter_dir . '/css/',
	'TER_CHILD_CUSTOM_PT' => 	dirname(__FILE__) . '/custom-post-types/',
	'TER_CHILD_GRAPHICS' => 	$ter_dir . '/graphics/',
	'TER_CHILD_ICONS' => 		$ter_dir . '/icons/',
	'TER_CHILD_JS' => 			$ter_dir . '/js/'
));

/* Theme Option Constants - Change theme settings here */
ter_define_constants(array(
	'TER_ACTIVATE_BACK_TO_TOP' =>	false,             						//Boolean 	= Activate back to top button
	'TER_ACTIVATE_BRANDING' => 		false,									//Boolean	= Activate Terra's default branding
	'TER_ACTIVATE_SLIDER' => 		false,									//Boolean	= Activate Terra's default slider
	'TER_ACTIVATE_SKROLLR' => 		false,									//Boolean	= Activate Terra's default parallax skrollr
	'TER_ACTIVATE_WAYPOINTS' => 	false,									//Boolean	= Activate Waypoints JS, needed for CTA Sidebar
	'TER_ADMIN_BAR' => 				'editor',								//Options 	= 'all','admin','editor','none' - Show adminbar when user is logged in
	'TER_ADMIN_BAR_LOGIN' => 		false,              					//Boolean 	= true,false - Show adminbar when logged out
	'TER_APPLE_TOUCH' => 			false,              					//Value 	= Prefix: 'apple-touch-icon' -144.png,-iphone4.png(114),-ipad.png(72),-iphone.png(57)
	'TER_BOOTSTRAP_VER' =>			'3.3.0',								//Value 	= Which version of Bootstrap you wish to use. 3.3.0 and up do not support IE8
	'TER_CDN_URL' => 				'//cdnjs.cloudflare.com/ajax/libs/',	//URL		= If you change this, make sure the path to package is the same where enqueued below
	'TER_ERROR_DISPLAY' => 			false,									//Boolean 	= Turn PHP error display on
	'TER_EXCERPT' => 				false,                    				//Boolean 	= Show the_excerpt on archive pages not the_content
	'TER_EXCERPT_LEN' => 			40,                    					//Integer	= Number of words in the_excerpt
	'TER_GOOGLE_FONT' =>			'Open+Sans:400,400italic,600,600italic',//Value	 	= Google Font API Family - Value after "?family=" in the URL 'Open+Sans:400',false for none
	'TER_FULL_WIDTH_CLASS' =>		'col-sm-12',         					//CSS	 	= Full width container class
	'TER_HEADER_HOME_LINK' =>		'title',								//Options	= 'logo','title','title-desc',''
	'TER_MAX_IMAGE_SIZE_KB' =>		1024,									//Integer	= This will prevent uploads to media library greater than this value
	'TER_JQUERY' => 				'1.9.1',								//Value 	= '1.7.2' Which version of jQuery to load from CDN, blank for default WP
	'TER_LOGO' => 					$ter_dir . '/graphics/logo.png',			//URL 		= Location of logo image
	'TER_POST_FORMATS' => 			'gallery,image,video',					//CSL 		= Enter a comma separated list of post formats to register
	'TER_PRIMARY_CLASS' => 			'col-sm-8',         					//CSS 		= Primary container class
	'TER_SECONDARY' => 				'right',                   	 			//Options 	= 'left','right','none' - Sidebar Layout
	'TER_SECONDARY_CLASS' => 		'col-sm-4',         					//CSS		= Secondary container class
	'TER_SIDEBARS' => 				'Blog Sidebar,Page Sidebar',			//CSL 		= Comma separated list of sidebars - Add ',CTA Sidebar' for CTA Sidebar
	'TER_SITE_MOVED' => 			false,									//CSL 		= Value, enter a post ID for the site moved page
	'TER_SSL' => 					false,									//Value		= 'https' or 'http' - Value represents if the site will be mostly secure or not
	'TER_TITLE_FORMAT' => 			'standard',								//Options 	= 'standard','yoast'. Wordpress SEO plugin needs yoast setting
));

/* Includes */
require(TER_CHILD_CUSTOM_PT . 'custom-post-type.php'); //Add files to the /custom-post-types/ directory to use for creating subclasses of TerCustomPostType

/* Action & Filter Callbacks ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

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
	remove_filter('the_content', 'wptexturize');
	remove_filter('comment_text', 'wptexturize');
	remove_filter('the_excerpt', 'wptexturize');
	//add_theme_support('post-formats',explode(',',TER_POST_FORMATS)); //Uncomment to create post formats
	//remove_filter('wp_list_pages','ter_add_home_link'); //Uncomment to remove home link from sitemap
}

function ter_admin_favicon(){ echo '<link rel="shortcut icon" href="' . TER_CHILD_ICONS . 'favicon-32x32.png">'; }

function ter_enqueue_parent_theme_styles(){
	if(is_admin()) return;	
	wp_enqueue_style('terra_parent',TERRA . 'style.css');
	wp_enqueue_style('terra',TERRA_CHILD . 'style.css',array('terra_parent'));
}

function ter_custom_login_styles(){ wp_enqueue_style('ter_login_css',TER_CHILD_CSS . 'login.css'); }

/* Child Shortcodes - Uncomment to add custom shortcodes ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
/*
function ter_gray_box( $atts, $content = null ){ return '<div class="gray-box">' . do_shortcode($content) . '</div>'; }
add_shortcode('gray-box','ter_gray_box');

$ter_child_shortcodes_for_filter = array('gray-box');//Apply shortcode filter by adding items to this array
$ter_child_shortcodes = array('[gray-box]' => 'A gray box with rounded corners');
*/

/* Child Help - Uncomment to add custom theme help ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
/*
$ter_child_help = array('Help Section Title' => '<p>This is a paragraph of help text</p>','Help Section Title 2' => '<p>This is a paragraph of help text 2</p>');
*/
?>