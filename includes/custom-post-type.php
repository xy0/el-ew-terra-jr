<?php /* <~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~< TerCustomPostType - Do not edit >~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~> */

/* Basic Usage Example - Subclass >~~~~> */
/*
$skeleton = new Skeleton('skeleton',array('post_type' => 'skeleton','name_singular' => 'Skeleton','name_plural' => 'Skeletons','icon' => TER_CHILD_GRAPHICS . 'favicon-16x16.png'));

class Skeleton extends TerCustomPostType{
	public function __construct($namespace,$config){
		 parent::__construct($namespace,$config);
		 $this->register_taxonomy(); //Optional, creates namespaced taxonomy. Pass argument true to make hierarchal
		 $this->setup_meta_boxes(); //Optional, creates meta boxes, overwrite methods in your subclass
	}
	//Subclass Methods and Overwrites
	//Overwriting the init function is helpful if you need to change setup options.
}
*/

class TerCustomPostType{
	protected $_hyp_ns,$_config,$_post_type,$_singular,$_singular_lower,$_plural,$_plural_lower;
	public function __construct($hyp_ns,$config){
		$this->_hyp_ns = $hyp_ns;	
		$this->_config = $config;
		$this->_post_type = $config['post_type'];
		$this->_singular = $config['name_singular'];
		$this->_singular_lower = strtolower($this->_singular);
		$this->_plural = $config['name_plural'];
		$this->_plural_lower = strtolower($this->_plural);
		add_action('init',array(&$this,'init'));
		add_filter('post_updated_messages',array(&$this,'updated_messages'));		
	}
	
	public function init(){		
		$labels = array(
			'name' => 				_x($this->_plural,'post type general name','terra'),
			'singular_name' => 		_x($this->_singular,'post type singular name','terra'),
			'add_new' => 			_x('Add New',$this->_singular_lower,'terra'),
			'add_new_item' => 		__('Add New ' . $this->_singular,'terra'),
			'edit_item' => 			__('Edit ' . $this->_singular,'terra'),
			'new_item' => 			__('New ' . $this->_singular,'terra'),
			'all_items' => 			__('All ' . $this->_plural,'terra'),
			'view_item' => 			__('View ' . $this->_singular,'terra'),
			'search_items' => 		__('Search ' . $this->_plural,'terra'),
			'not_found' =>  		__('No ' . $this->_plural_lower . ' found','terra'),
			'not_found_in_trash' => __('No ' . $this->_plural_lower . ' found in Trash','terra'),
			'parent_item_colon' => 	'',
			'menu_name' => 			__( $this->_plural,'terra')
		);
		$args = array(
			'labels' => 			$labels,
			'public' => 			true,
			'publicly_queryable' => true,
			'show_ui' => 			true,
			'show_in_menu' => 		true,
			'query_var' => 			true,
			'capability_type' => 	'post',
			'has_archive' => 		true,
			'hierarchical' => 		true,
			'menu_position' => 		null,
			'menu_icon' => 			$this->_config['icon'],
			'supports' => 			array('title','editor','author','thumbnail','excerpt','comments','custom-fields','revisions','page-attributes')
		);
		register_post_type($this->_post_type,$args);
	}
	
	public function register_taxonomy($hierarchical = false){		
		$labels = array(
			'name'              => _x($this->_singular . ' Tags', 'taxonomy general name'),
			'singular_name'     => _x($this->_singular . ' Tag', 'taxonomy singular name'),
			'search_items'      => __('Search ' . $this->_singular . ' Tags'),
			'all_items'         => __('All ' . $this->_singular . ' Tags'),
			'parent_item'       => __('Parent ' . $this->_singular . ' Tag'),
			'parent_item_colon' => __('Parent ' . $this->_singular . ' Tag:'),
			'edit_item'         => __('Edit ' . $this->_singular . ' Tag'),
			'update_item'       => __('Update ' . $this->_singular . ' Tag'),
			'add_new_item'      => __('Add New ' . $this->_singular . ' Tag'),
			'new_item_name'     => __('New ' . $this->_singular . ' Tag Name'),
			'menu_name'         => __($this->_singular . ' Tags')
		);
		$args = array(
			'hierarchical'      => $hierarchical,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true
		);
		register_taxonomy($this->_post_type . '_tags',$this->_post_type,$args);
	}
	
	public function updated_messages($messages){
		global $post, $post_ID;
		$messages[$this->_post_type] = array(
			0 => '',
			1 => sprintf( __($this->_singular . ' updated. <a href="%s">View ' . $this->_singular_lower . '</a>'), esc_url( get_permalink($post_ID) ) ),
			2 => __('Custom field updated.'),
			3 => __('Custom field deleted.'),
			4 => __($this->_singular . ' updated.'),
			5 => isset($_GET['revision']) ? sprintf( __($this->_singular . ' restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6 => sprintf( __($this->_singular . ' published. <a href="%s">View ' . $this->_singular_lower . '</a>'), esc_url( get_permalink($post_ID) ) ),
			7 => __($this->_singular . ' saved.'),
			8 => sprintf( __($this->_singular . ' submitted. <a target="_blank" href="%s">Preview ' . $this->_singular_lower . '</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
			9 => sprintf( __($this->_singular . ' scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview ' . $this->_singular_lower . '</a>'),
			  date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
			10 => sprintf( __($this->_singular . ' draft updated. <a target="_blank" href="%s">Preview ' . $this->_singular_lower . '</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		);
		return $messages;
	}
	
	public function setup_meta_boxes(){	
		add_action('add_meta_boxes',array(&$this,'add_meta_boxes'));
		add_action('save_post',array(&$this,'save_post'));
		$this->meta_box_1_key = '_generic_meta_key';
		$this->meta_box_2_key = '_generic_tinymce_meta_key';
	}
	
	public function add_meta_boxes(){
		add_meta_box(
			'generic_meta_box_slug',
			'Generic Meta Box',
			array(&$this,'meta_box_1'),
			$this->_post_type,
			'advanced',
			'high'
		);
		add_meta_box(
			'generic_tinymce_meta_box_slug',
			'Generic TinyMce Meta Box',
			array(&$this,'meta_box_2'),
			$this->_post_type,
			'advanced',
			'high'
		);
    }

    public function meta_box_1($post){
		$value = get_post_meta($post->ID,$this->meta_box_1_key, true);
		wp_nonce_field(plugin_basename(__FILE__),'hyp_noncename');
		echo '<label>Generic Label</label><br>';
		echo '<input type="text" name="' . $this->meta_box_1_key . '" value="' . esc_attr( $value ) . '" style="width:70%" />';
    }
	
	public function meta_box_2($post){
		wp_nonce_field(plugin_basename(__FILE__),'hyp_noncename');
		$this->print_mce($post->ID,$this->meta_box_2_key);
    }
	
	public function save_post($post_id){
		if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
		if($_POST['post_type'] != $this->_post_type) return $post_id;
		if(!wp_verify_nonce($_POST['hyp_noncename'],plugin_basename(__FILE__))) return $post_id;
		if(!current_user_can('edit_post',$post_id)) return $post_id;
		update_post_meta($post_id,$this->meta_box_1_key,$_POST[$this->meta_box_1_key]);
		update_post_meta($post_id,$this->meta_box_2_key,$_POST[$this->meta_box_2_key . '_html']);
	} 
	
	private function print_mce($post_id,$metaname){
		$content = get_post_meta($post_id,$metaname,1);
		$wp_editor_args = array(
			'teeny' => 1,
			'textarea_rows' => 4,
			'media_buttons' => true,
			'dfw' => false,
			'tinymce' => array(
				'theme_advanced_buttons1' => 'formatselect,fontsizeselect,forecolor,backcolor|,bold,italic,underline,|,justifyleft,justifycenter,justifyright,|,undo,redo,|,spellchecker',
				'theme_advanced_buttons2' => 'cut,copy,paste,pastetext,pasteword,|,bullist,numlist,|,outdent,indent,|,fullscreen',
				'theme_advanced_buttons3' => '',
				'theme_advanced_buttons4' => ''
				),
			'quicktags' => true
		);
		wp_editor($content,$metaname . '_html',$wp_editor_args);
	}
	public function get_aux_nav(){
		global $post;
		$parent = $post->post_parent;
		$ancestor_count = count(get_post_ancestors($post->ID));
		if($parent == 0){		
			$children = wp_list_pages('title_li=&child_of=' . $post->ID . '&echo=0&depth=1&post_type=' . $this->_post_type);
			$title = $post->post_title;
		}
		elseif($ancestor_count == 2){		
			$children = wp_list_pages('title_li=&child_of=' . $post->post_parent . '&echo=0&exclude=' . $post->ID . '&post_type=' . $this->_post_type);
			$title = get_the_title($parent);
		}
		else{
			$children = wp_list_pages('title_li=&child_of=' . $post->ID . '&echo=0&post_type=' . $this->_post_type);
			if($children) $title = $post->post_title;
			else $title = get_the_title($parent);
			if(!$children) $children = wp_list_pages('title_li=&child_of=' . $post->post_parent . '&echo=0&depth=1&exclude=' . $post->ID . '&post_type=' . $this->_post_type);
		}			
		if($children){
			echo '<div class="post-children pad shadow">';
			echo '<h3>Other ' . $title . ' Pages</h3>';
			echo '<ul>' . $children . '</ul>';
			echo '</div>';
		}
	}	
}//END TerCustomPostType
?>