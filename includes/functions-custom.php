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

/* <~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~< A-Train Admin Branding >~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~> */

/* Dashboard Feed ~~~~~~~~~~> */
function ter_add_dashboard_meta(){ add_meta_box('atrain_feed','A-Train Marketing News','ter_add_dashboard_feed_html','dashboard','side','high'); }
add_action('wp_dashboard_setup','ter_add_dashboard_meta');

function ter_add_dashboard_feed_html($post,$callback_args){
	$rss = fetch_feed('http://atrainmarketing.com/category/marketing-2/feed/');
	if(!is_wp_error($rss)){
   		$maxitems = $rss->get_item_quantity(5);
		$rss_items = $rss->get_items(0,$maxitems);
	}
	?>
	<ul>
    <?php if($maxitems == 0): ?><li><?php _e('No Feed Items','terra') ?></li>
	<?php else: ?>
	<?php foreach($rss_items as $item): ?><li><a href="<?php echo esc_url($item->get_permalink()) ?>" title="<?php printf(__('Posted %s','terra'),$item->get_date('j F Y')) ?>" target="_blank"><?php echo esc_html($item->get_title()) ?></a></li><?php endforeach; ?>
    <?php endif ?>
	</ul>
	<hr style="margin-bottom:10px">
	<div style="text-align:center"><a href="http://atrainmarketing.com/category/marketing-2/" target="_blank">More Marketing News</a> | <a href="http://atrainmarketing.com/category/marketing-2/feed/" target="_blank">Subscribe to Feed</a></div>
	<?php
}
/* <~~~~~~~~~~< END Dashboard Feed */

/* Admin Footer ~~> */
function ter_admin_footer(){ echo '<strong>ExpressLine Theme by <a href="http://atrainmarketing.com" target="_blank"><img src="' . TER_CHILD_GRAPHICS . 'icon-atrain.gif" alt="A-Train" style="vertical-align:text-bottom; margin:0 6px">A-Train Marketing</a></strong>'; }
?>