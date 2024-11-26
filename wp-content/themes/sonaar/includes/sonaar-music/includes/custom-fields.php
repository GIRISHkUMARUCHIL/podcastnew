<?php
/***
 *  Install Add-ons
 *
 *  The following code will include all 4 premium Add-Ons in your theme.
 *  Please do not attempt to include a file which does not exist. This will produce an error.
 *
 *  All fields must be included during the 'acf/register_fields' action.
 *  Other types of Add-ons (like the options page) can be included outside of this action.
 *
 *  The following code assumes you have a folder 'add-ons' inside your theme.
 *
 *  IMPORTANT
 *  Add-ons may be included in a premium theme as outlined in the terms and conditions.
 *  However, they are NOT to be included in a premium / free plugin.
 *  For more information, please read http://www.advancedcustomfields.com/terms-conditions/
 */

// Fields

function iron_feature_register_acf_fields(){
	if( is_admin() ){
		// RENAME FileOrStream CF to FileOrStreamPodCast CF. Does not affect album FileOrStream because the metakey is named field_51b8c4facc846
		global $wpdb;
		$table_name = $wpdb->prefix . "postmeta";
		$check_FileOrstream = $wpdb->get_results( "SELECT meta_key FROM " . $table_name . " where meta_key='FileOrStream'" );
		
		if (($wpdb->num_rows)>0) {
			$querystr = $wpdb->prepare( "UPDATE $wpdb->postmeta SET meta_key = '%s' WHERE meta_key = '%s'",'FileOrStreamPodCast','FileOrStream');
			$result = $wpdb->get_results ( $querystr );
		}
	}

	if ( ! class_exists('acf_field_widget_area') )
		include_once( IRON_MUSIC_DIR_PATH .'includes/acf-addons/acf-widget-area/widget-area-v5.php');

	iron_feature_check_acf_lite_switch();

}
iron_feature_register_acf_fields();

//add_action('acf/register_fields', 'iron_feature_register_acf_fields');
add_filter('acf/fields/post_object/query/key=footer_podcast', 'change_posts_order');
add_filter('acf/fields/post_object/query/key=footer_playlist', 'change_posts_order');
add_filter('acf/fields/post_object/result/key=footer_podcast', 'add_post_object_date', 10, 4);

function change_posts_order( $args ) {
	$args['orderby'] = 'date';
	$args['order'] = 'DESC';
	return $args;
}

function add_post_object_date( $title, $post, $field, $post_id ) {
	$post_date = get_the_date( 'Y/m/d - ',$post->ID);
	$date_title = "$post_date $title";
	return $date_title;
}


/**
* If ACF_LITE is on, update all acf group fields in DB to draft
*/

function iron_feature_check_acf_lite_switch(){

	if(isset($_GET["settings-updated"])) {

		global $wpdb;

		if(ACF_LITE)
			$status = "draft";
		else
			$status = "publish";

		$wpdb->update( $wpdb->posts, array( 'post_status' => $status ), array( 'post_type' => "acf" ), '%s' );
	}

}


/**
 *  Register Field Groups
 *
 *  The register_field_group function accepts 1 array which holds the relevant data to register a field group
 *  You may edit the array as you see fit. However, this may result in errors if the array is not compatible with ACF
 */

if(function_exists("register_field_group") ){

	$default_sidebar = null;
	$sidebar_position = 'disabled';
	//$single_post_featured_image = null;

	$current_path = parse_url( wp_basename( $_SERVER["REQUEST_URI"] ) );

	if(is_admin() && !empty($current_path["path"]) && $current_path["path"] == 'post-new.php') {

		$post_type = !empty($_GET["post_type"]) ? $_GET["post_type"] : 'post';

		if($post_type == 'post') {

			$default_sidebar = sonaar_music_get_option('single_post_default_sidebar');
			$sidebar_position = "right";
			//$single_post_featured_image = sonaar_music_get_option('single_post_featured_image');

		}else if($post_type == 'video') {

			$default_sidebar = sonaar_music_get_option('single_video_default_sidebar');
			$sidebar_position = "right";

		}else if($post_type == 'album') {

			$default_sidebar = sonaar_music_get_option('single_discography_default_sidebar');
			$sidebar_position = "right";

		}else if($post_type == 'event') {

			$default_sidebar = sonaar_music_get_option('single_event_default_sidebar');
			$sidebar_position = "right";

		}else if($post_type == 'podcast') {

			$default_sidebar = sonaar_music_get_option('single_podcast_default_sidebar');
			$sidebar_position = "right";
		}else if($post_type == 'podcastshow') {

			$default_sidebar = sonaar_music_get_option('single_podcast_default_sidebar');
			$sidebar_position = "right";
		}

	}

// manage hide class depending the menu type
$cf_elementor_wrap_class ='';
$cf_classic_wrap_class ='';

if( Iron_sonaar::getOption('menu_type') != 'elementor-menu' ){ // hide CF if not needed
	$cf_elementor_wrap_class = 'sr-hide-cf-option ';
}
if( Iron_sonaar::getOption('menu_type') != 'classic-menu' && Iron_sonaar::getOption('menu_type') != 'push-menu'){ // hide CF if not needed
	$cf_classic_wrap_class = 'sr-hide-cf-option ';
}
	
	register_field_group(array (
		'id' => 'acf_sidebar-options',
		'title' => 'Sidebar Options',
		'fields' => array (
			array (
				'key' => 'field_526d6ec715ee9',
				'label' => 'Sidebar Position',
				'name' => 'sidebar-position',
				'type' => 'radio',
				'choices' => array (
					'disabled' => 'Disabled',
					'left' => 'Left',
					'right' => 'Right'
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => $sidebar_position,
				'layout' => 'vertical',
			),
			array (
				'key' => 'field_526d6c0da8219',
				'label' => 'Widget Area',
				'name' => 'sidebar-area_id',
				'type' => 'widget_area',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_526d6ec715ee9',
							'operator' => '!=',
							'value' => 'disabled',
						),
					),
					'allorany' => 'all',
				),
				'allow_null' => 1,
				'default_value' => $default_sidebar,
			),
		),
		'location' => array (

			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 1,
				)
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'product',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'podcast',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'podcastshow',
					'order_no' => 0,
					'group_no' => 0,
				),
			)
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));

	register_field_group(array (
		'id' => 'acf_news-template-settings',
		'title' => 'Template Settings',
		'fields' => array (
			array (
				'key' => 'field_523382c925a72',
				'label' => 'Enable Excerpts',
				'name' => 'enable_excerpts',
				'type' => 'true_false',
				'default_value' => 0,
				'placeholder' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'index.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'archive-posts-grid.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'archive-posts-grid3.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'archive-posts-grid4.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'archive-posts-classic.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),

		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));



	register_field_group(array (
		'id' => 'acf_videos_query',
		'title' => 'Videos Query',
		'fields' => array (
			array (
				'key' => 'field_51b7bff2193fe',
				'label' => 'Filter By Artists',
				'name' => 'artists_filter',
				'type' => 'post_object',
				'post_type' => array(
					0 => 'artist'
				),
				'allow_null' => 1,
				'multiple' => 1,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'archive-video.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (),
		),
		'menu_order' => 0,
	));

	register_field_group(array (
		'id' => 'acf_page-settings',
		'title' => 'Page Settings',
		'fields' => array (
			array (
				'key' => 'field_523384ce55a99',
				'label' => 'Select Logo Version',
				'name' => 'page_logo_select',
				'type' => 'select',
				'choices' => array (
					'dark' => 'Dark',
					'light' => 'Light',
				),
				'wrapper' => array(
					'width' => '',
					'class' => $cf_classic_wrap_class,
					'id' => '',
				),
				'default_value' => '',
				'allow_null' => 1,
				'multiple' => 0,
				),
			array (
				'key' => 'elementor_logo_version',
				'label' => 'Select Logo Version in the Header',
				'name' => 'page_logo_select_elementor',
				'type' => 'select',
				'choices' => array (
					'primary' => 'Primary',
					'secondary' => 'Secondary',
				),
				'wrapper' => array(
					'width' => '',
					'class' => $cf_elementor_wrap_class,
					'id' => '',
				),
				'default_value' => '',
				'allow_null' => 1,
				'multiple' => 0,
				),
			array (
				'key' => 'field_523382c955a73',
				'label' => 'Hide Page Title',
				'name' => 'hide_page_title',
				'type' => 'true_false',
				'ui' => 1,
				'default_value' => 0,
				'placeholder' => 0,
			),
			array (
				'key' => 'field_523384ce34a85',
				'label' => 'Hide Header and Menu',
				'name' => 'hide_header_and_menu',
				'type' => 'true_false',
				'default_value' => 0,
				'ui' => 1,
				'placeholder' => 0,
			),
			array (
				'key' => 'field_523384ce55a85',
				'label' => 'Show Header Over Content',
				'name' => 'classic_menu_over_content',
				'type' => 'true_false',
				'ui' => 1,
				'default_value' => 0,
				'placeholder' => 0,
			),
			array (
				'key' => 'field_523384ce55a87',
				'label' => 'Header Main Item Text Color',
				'instructions' => esc_html__('This will override global settings', 'sonaar'),
				'name' => 'classic_menu_main_item_color',
				'type' => 'color_picker',
				'default_value' => '',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_523384ce55a85',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
			),
			array (
				'key' => 'field_523384ce55a84',
				'label' => 'Header Background Color',
				'instructions' => esc_html__('This will override global settings.', 'sonaar'),
				'name' => 'classic_menu_background',
				'type' => 'color_picker',
				'default_value' => '',
			),
			array (
				'key' => 'field_523384ce55a86',
				'label' => 'Header Background Opacity',
				'name' => 'classic_menu_background_alpha',
				'instructions' => esc_html__('Set the menu opacity between 0 and 1.', 'sonaar'),
				'type' => 'number',
				'min' => 0,
				'max' => 1,
				'step' => 0.1,
				'default_value' => 1,
			),

			array (
				'key' => 'field_523384ce55a23',
				'label' => 'Hamburger Icon color',
				'instructions' => esc_html__('This will override global settings. For push menu only', 'sonaar'),
				'name' => 'hamburger_icon_color',
				'type' => 'color_picker',
				'default_value' => '',
			),
			array (
				'key' => 'field_523382c955a74',
				'label' => 'Image Background',
				'name' => 'background',
				'type' => 'image',
				'save_format' => 'id',
				'preview_size' => 'medium',
				'library' => 'all',
			),
			array (
				'key' => 'field_523382f555a75',
				'label' => 'Background Repeat',
				'name' => 'background_repeat',
				'type' => 'select',
				'choices' => array (
					'repeat' => 'Repeat',
					'no-repeat' => 'No Repeat',
					'repeat-x' => 'Repeat X',
					'repeat-y' => 'Repeat Y',
					'inherit' => 'Inherit',
				),
				'default_value' => '',
				'allow_null' => 1,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5233837455a76',
				'label' => 'Background Size',
				'name' => 'background_size',
				'type' => 'select',
				'choices' => array (
					'cover' => 'Cover',
					'contain' => 'Contain',
					'inherit' => 'Inherit',
				),
				'default_value' => 'Cover',
				'allow_null' => 1,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5233842d55a78',
				'label' => 'Background Position',
				'name' => 'background_position',
				'type' => 'select',
				'choices' => array (
					'left top' => 'left top',
					'left center' => 'left center',
					'left bottom' => 'left bottom',
					'right top' => 'right top',
					'right center' => 'right center',
					'right bottom' => 'right bottom',
					'center top' => 'center top',
					'center center' => 'center center',
					'center bottom' => 'center bottom',
					'inherit' => 'Inherit',
				),
				'default_value' => '',
				'allow_null' => 1,
				'multiple' => 0,
			),
			array (
				'key' => 'field_523384ce55a80',
				'label' => 'Background Color',
				'name' => 'content_background_color',
				'type' => 'color_picker',
				'default_value' => '',
			),
			array (
				'key' => 'field_523384ce55a81',
				'label' => 'Background Transparency',
				'name' => 'content_background_transparency',
				'instructions' => wp_kses( __('0 for transparent and 1 for 100% solid.', 'sonaar'), iron_get_allowed_html() ),
				'type' => 'number',
				'min' => 0,
				'max' => 1,
				'step' => 0.1,
				'default_value' => 1,
			),
			array (
				'key' => 'field_523384ce55a79',
				'label' => '3D Push Menu Background Color',
				'name' => 'background_color',
				'instructions' => 'This is the background color when the menu is pushed. For Push menu only',
				'type' => 'color_picker',
				'default_value' => '',
			),
			array (
				'key' => 'block_header',
				'label' => 'Page Header',
				'name' => 'block_header',
				'instructions' => 'Select a template that will override your current page header?',
				'type' => 'post_object',
				'default_value' => '',
				'post_type' => array('block'),
				'allow_null' => 1,
				'wrapper' => array(
					'width' => '',
					'class' => $cf_elementor_wrap_class,
					'id' => '',
				),
			),
			array (
				'key' => 'block_footer',
				'label' => 'Page Footer',
				'name' => 'block_footer',
				'instructions' => 'Select a template that will override your current page footer?',
				'type' => 'post_object',
				'default_value' => '',
				'post_type' => array('block'),
				'allow_null' => 1,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'event',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'video',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'album',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'artist',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'product',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'podcast',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'podcastshow',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));


	register_field_group(array (
		'id' => 'acf_video-infos',
		'title' => 'Video Infos',
		'fields' => array (
			array (
				'key' => 'field_51b8d3ffdfe47',
				'label' => 'Embed a video',
				'name' => 'video_url',
				'type' => 'text',
				'instructions' => 'See <a target="_blank" href="http://codex.wordpress.org/Embeds">Supported Sites</a>',
				'default_value' => 'http://www.youtube.com/watch?v=aHjpOzsQ9YI',
				'placeholder' => '',
				'maxlength' => '',
				'formatting' => 'html',
			),
			array(
				'key' => 'field_5f076f5d6626d',
				'label' => 'Optional Image Overlay',
				'name' => 'sr_video_cover_image',
				'type' => 'image',
				'instructions' => 'If present, we will show this image overlay on the video embed. When clicked, video will be displayed',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
				'min_width' => 150,
				'min_height' => 150,
				'min_size' => '',
				'max_width' => 2850,
				'max_height' => '',
				'max_size' => 3,
				'mime_types' => 'jpg,png',
			),
			array (
				'key' => '',
				'label' => 'Informations about this project',
				'name' => 'video_informations',
				'type' => 'repeater',
				'instructions' => 'Add info about this project ex: Credits, Copyrights, Links, etc..',
				'sub_fields' => array (
					array (
						'key' => '',
						'label' => 'Label',
						'name' => 'video_info_label',
						'type' => 'text',
						'instructions' => 'Eg: Producer',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array (
						'key' => '',
						'label' => 'Text',
						'name' => 'video_info_text',
						'type' => 'text',
						'instructions' => 'Eg: Quentin Tarantino',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array (
						'key' => '',
						'label' => 'Link',
						'name' => 'video_info_link',
						'type' => 'link',
						'instructions' => 'Eg: https://imdb.com',
						'required' => 0,
						'conditional_logic' => 0,
						'return_format' => 'array',
					),
					
				),
				'row_min' => 0,
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => '+ Add New',
			),
			array(
				'key' => 'video_position',
				'label'  => __('Player position', 'sonaar'),
				'name' => 'video_position',
				'type'=>'select',
				'choices' => array (
					'above' => __('Above the content', 'sonaar'),
					'below' => __('Below the content', 'sonaar'),
				)
			),
			array (
				'key' => 'field_548d3d6711e41',
				'label' => 'Artist',
				'name' => 'artist_of_video',
				'type' => 'relationship',
				'return_format' => 'id',
				'post_type' => array (
					0 => 'artist'
				),
				'taxonomy' => array (
					0 => 'all',
				),
				'filters' => array (
					0 => 'search'
				),
				'result_elements' => array (
					0 => 'featured_image'
				),
				'max' => 100,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'video',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'excerpt',
				1 => 'custom_fields',
				2 => 'discussion',
				3 => 'comments',
				4 => 'revisions',
			),
		),
		'menu_order' => 0,
	));


	register_field_group(array (
		'id' => 'acf_albums_query',
		'title' => 'Albums Query',
		'fields' => array (
			array (
				'key' => 'field_5135bff2193fe',
				'label' => 'Filter By Artists',
				'name' => 'artists_filter',
				'type' => 'post_object',
				'post_type' => array(
					0 => 'artist'
				),
				'allow_null' => 1,
				'multiple' => 1,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'archive-album.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (),
		),
		'menu_order' => 0,
	));


	register_field_group(array (
		'id' => 'acf_albums_page_header',
		'title' => 'Album Page Header',
		'fields' => array (
			array (
				'key'		=> 'album_background_type',
				'label' 	=> 'Album Page Header Background Type',
				'name'		=> 'album_background_type',
				'type'		=> 'radio',
				'choices'	=> array (
					'default'	=> 'No Page Header',
					'blurry'	=> 'Use blurry image of my featured image',
					'image' 	=> 'Use a different background image',
					'color' 	=> 'Use a background color'
				),
				'other_choice'		=> 0,
				'save_other_choice' => 0,
				'default_value' 	=> 'default',
				'layout'			=> 'horizontal',
			),
			array (
				'key' => 'album_background_image',
				'label' => 'Background Image Upload',
				'name' => 'album_background_image',
				'type' => 'image',
				'column_width' => '',
				'save_format' => 'object',
				'preview_size' => 'medium',
				'library' => 'all',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'album_background_type',
							'operator' => '==',
							'value' => 'image',
						),
					),
					'allorany' => 'all',
				)
			),
			array(
				'key' => 'album_background_color',
				'label' => 'Background Color',
				'name' => 'album_background_color',
				'type' => 'color_picker',
				'default_value' => '',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'album_background_type',
							'operator' => '==',
							'value' => 'color',
						),
					),
					'allorany' => 'all',
				)
				),
			array(
				'key' => 'hide_featured_image',
				'label' => __('Hide Featured Image', 'sonaar'),
				'name' => 'hide_featured_image',
				'type' => 'true_false', 
				'ui' => 1,
				'default_value' => 0, 
				'placeholder' => 0, 
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'album_background_type',
							'operator' => '!=',
							'value' => 'default',
						),
					),
					'allorany' => 'all',
				)
			)
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'album',
					'order_no' => 1,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'excerpt',
				1 => 'custom_fields',
				2 => 'discussion',
				3 => 'comments',
				4 => 'categories',
				5 => 'tags',
				6 => 'send-trackbacks',
			),
		),
		'menu_order' => 1,
	));



	register_field_group(array (
		'id' => 'acf_album-infos',
		'title' => 'Audio Player',
		'fields' => array (
			array (
				'key' => 'field_51b8db2cd11c5',
				'label' => 'Hide album within the Albums Posts template',
				'instructions' => '<br style="clear:both">Could be useful for solo / remix albums<br><br>',
				'name' => 'hide_album',
				'type' => 'true_false',
				'ui' => 1,
				'placeholder' => 0,
			),
			array (
				'key' => 'field_51b8db2cd11c4',
				'label' => 'Release Date',
				'name' => 'alb_release_date',
				'type' => 'text',
			),
			array(
				'key' => 'no_track_skip',
				'label'  => __('Do not skip to the next track', 'sonaar'),
				'instructions' => __('<br style="clear:both">When the current track ends, do not play the second track automatically.<br><br>'),
				'name' => 'no_track_skip',
				'type' => 'true_false',
				'ui' => 1
			),
			array(
				'key' => 'reverse_tracklist',
				'label'  => __('Display tracklist in reverse order on the front-end', 'sonaar'),
				'name' => 'reverse_tracklist',
				'type' => 'true_false',
				'ui' => 1
			),
			array(
				'key' => 'player_position',
				'label'  => __('Player position', 'sonaar'),
				'name' => 'player_position',
				'type'=>'select',
				'choices' => array (
					'default' => __('Default', 'sonaar'),
					'above' => __('Above the content', 'sonaar'),
					'below' => __('Below the content', 'sonaar'),
				)
			),
			array (
				'key' => 'field_51b8c4facc846',
				'label' => 'Tracklist',
				'name' => 'alb_tracklist',
				'type' => 'repeater',
				'sub_fields' => array (
					array(
						'key' => 'FileOrStream',
						'label' => 'File or Stream',
						'name' => 'FileOrStream',
						'type' => 'radio',
						'instructions' => 'Please select which type of audio source you want for this track',
						'choices' => array(
							'mp3' => 'Local MP3',
							'stream' => 'Stream'
						),
						'layout' => 'horizontal'

					),
					 array (
						'key' => 'field_51b8c637cc849',
						'label' => 'MP3 File',
						'name' => 'track_mp3',
						'type' => 'file',
						'instructions' => 'Only .MP3 file accepted. We recommend encoding at 320kbps @ 44.1kHz to avoid any glitch',
						'column_width' => '',
						'library' => 'all',
						'mime_types' => 'mp3, m4a, flac, opus, wav',
						'conditional_logic' => array(
							array(
								array(
									'field' => 'FileOrStream',
									'operator' => '==',
									'value' => 'mp3',
								),
							),
						)
					),
					array (
						'key' => 'stream_link_music',
						'label' => 'External Audio link',
						'name' => 'stream_link',
						'type' => 'text',
						'instructions' => 'Add link to your external audio file.<br>See <a href="https://sonaar.io/docs/which-streaming-platforms-do-you-support/" target="_blank">this article</a> for supported external links',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'FileOrStream',
									'operator' => '==',
									'value' => 'stream',
								),
							),
							'allorany' => 'all',
						)
					),
					array (
						'key' => 'stream_title',
						'label' => 'Track title',
						'name' => 'stream_title',
						'type' => 'text',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'FileOrStream',
									'operator' => '==',
									'value' => 'stream',
								),
							),
							'allorany' => 'all',
						)
					),
					array (
						'key' => 'stream_artist',
						'label' => 'Track Artist(s)',
						'name' => 'stream_artist',
						'type' => 'text',
						'instructions' => "Leave blank if it's the same as the playlist",
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'FileOrStream',
									'operator' => '==',
									'value' => 'stream',
								),
							),
							'allorany' => 'all',
						)
					),
					array (
						'key' => 'stream_album',
						'label' => 'Track Album',
						'name' => 'stream_album',
						'type' => 'text',
						'instructions' => "Leave blank if it's the same as the playlist",
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'FileOrStream',
									'operator' => '==',
									'value' => 'stream',
								),
							),
							'allorany' => 'all',
						)
					),

					 array (
						'key' => 'song_store_list',
						'label' => 'Track Link(s)',
						'name' => 'song_store_list',
						'type' => 'repeater',
						'instructions' => 'Add call-to-action button(s) to display beside this track',
						'sub_fields' => array (
							array(
								'key'=>'song_store_icon',
								'name'=>'song_store_icon',
								'type'=>'select',
								'label'=>'Icons',
								'choices' => array (
									''=>'none',
									'fas fa-shopping-cart' => '&#xf07a; Buy',
									'fab fa-amazon' => '&#xf270; Amazon',
									'fab fa-apple' => '&#xf179; iTunes',
									'fab fa-bandcamp' => '&#xf2d5; BandCamp',
									'fab fa-mixcloud' => '&#xf289; MixCloud',
									'fab fa-google-play' => '&#xf3ab; Google Play',
									'fab fa-soundcloud' => '&#xf1be; SoundCloud',
									'fab fa-spotify' => '&#xf1bc; Spotify',
									'fab fa-youtube' => '&#xf167; Youtube',
									'fas fa-patreon' => '&#xf3d9; Patreon',
									'fas fa-download' => '&#xf019; Download',
									'fab fa-file-pdf' => '&#xf1c1; PDF File', 
									'fab fa-file-alt' => '&#xf15c; Lyrics', 
									'fas fa-file-music' => '&#xf8b6; Music Sheet', 
									'fas fa-music' => '&#xf001; Music',
									'custom-icon' => 'Custom SVG',

								),
								'default_value' => '',
								'allow_null' => 0,
								'multiple' => 0,
								'column_width' => '20%',
							),
							array (
								'key' => 'sr_icon_file',
								'label' => 'Custom SVG File',
								'name' => 'sr_icon_file',
								'type' => 'image',
								'instructions' => '.svg file only',
								'column_width' => '',
								'return_format' => 'url',
								'library' => 'all',
								'mime_types' => 'svg',
								'conditional_logic' => array (
									'status' => 1,
									'rules' => array (
										array (
											'field' => 'song_store_icon',
											'operator' => '==',
											'value' => 'custom-icon',
										),
									),
									'allorany' => 'all',
								)
							),
							array (
								'key' => 'song_store_name',
								'label' => 'Link Label',
								'name' => 'song_store_name',
								'type' => 'text',
								'instructions' => 'Examples : iTunes, Bandcamp, Soundcloud, etc.',
								'column_width' => '',
								'default_value' => '',
								'formatting' => 'html',
								'maxlength' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
							),
							array (
								'key' => 'song_store_link',
								'label' => 'Link URL',
								'name' => 'store_link',
								'type' => 'text',
								'instructions' => 'Example: https://www.youtube.com',
								'column_width' => '',
								'default_value' => '',
								'formatting' => 'html',
								'maxlength' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
							),
							array (
								'key' => 'song_store_link_target',
								'name' => 'store_link_target',
								'label' => 'Open in New Window?',
								'type'=>'select',
								'choices' => array (
									'_blank'=>'Yes',
									'_self' => 'No',
								),
								'default_value' => '_blank',
							),
						),
						'row_min' => 0,
						'row_limit' => '',
						'layout' => 'row',
						'button_label' => '+ Add Link',
					),
				),
				'row_min' => 0,
				'row_limit' => '',
				'layout' => 'row',
				'button_label' => '+ Add Track',
			),
			array (
				'key' => 'alb_store_list',
				'label' => 'Store list',
				'name' => 'alb_store_list',
				'type' => 'repeater',
				'instructions' => 'Links to the online stores to buy album',
				'sub_fields' => array (
					array(
						'key'=>'album_store_icon',
						'name'=>'album_store_icon',
						'type'=>'select',
						'label'=>'Icons',
						'choices' => array (
							''=>'none',
							'fas fa-shopping-cart' => '&#xf07a; Buy',
							'fab fa-amazon' => '&#xf270; Amazon',
							'fab fa-apple' => '&#xf179; iTunes',
							'fab fa-bandcamp' => '&#xf2d5; BandCamp',
							'fab fa-mixcloud' => '&#xf289; MixCloud',
							'fab fa-google-play' => '&#xf3ab; Google Play',
							'fab fa-soundcloud' => '&#xf1be; SoundCloud',
							'fab fa-spotify' => '&#xf1bc; Spotify',
							'fas fa-patreon' => '&#xf3d9; Patreon',
							'fas fa-download' => '&#xf019; Download',
							'fab fa-file-pdf' => '&#xf1c1; PDF File', 
							'fab fa-file-alt' => '&#xf15c; Lyrics', 
							'fab fa-indent' => '&#xf03c; Music Sheet', 
							'fas fa-music' => '&#xf001; Music',
							'custom-icon' => 'Custom SVG',
						),
						'default_value' => '',
						'allow_null' => 0,
						'multiple' => 0,
						'column_width' => '20%',
					),
					array (
							'key' => 'sr_album_icon_file',
							'label' => 'Custom SVG File',
							'name' => 'sr_album_icon_file',
							'type' => 'image',
							'instructions' => '.svg file only',
							'column_width' => '',
							'return_format' => 'url',
							'library' => 'all',
							'mime_types' => 'svg',
							'conditional_logic' => array (
								'status' => 1,
								'rules' => array (
									array (
										'field' => 'album_store_icon',
										'operator' => '==',
										'value' => 'custom-icon',
									),
								),
								'allorany' => 'all',
							)
						),
					array (
						'key' => 'field_51b8c6fdcc84b',
						'label' => 'Store Name',
						'name' => 'store_name',
						'type' => 'text',
						'instructions' => 'Examples : iTunes, Bandcamp, Soundcloud, etc.',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array (
						'key' => 'field_51b8c718cc84c',
						'label' => 'Store Link',
						'name' => 'store_link',
						'type' => 'text',
						'instructions' => 'Link to the online store',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array (
						'key' => 'playlist_store_link_target',
						'name' => 'playlist_store_link_target',
						'label' => 'Open in New Window?',
						'type'=>'select',
						'choices' => array (
							'_blank'=>'Yes',
							'_self' => 'No',
						),
						'wrapper' => array (
							'width' => 6,
						),
						'default_value' => '_blank',
					),
				),
				'row_min' => 0,
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => '+ Add Store',
			),
			array (
				'key' => 'field_51b8c792cc84d',
				'label' => 'Review',
				'name' => 'alb_review',
				'type' => 'textarea',
				'default_value' => '',
				'formatting' => 'br',
				'maxlength' => '',
				'placeholder' => '',
			),
			array (
				'key' => 'field_51b8c88fcc84e',
				'label' => 'Review Author',
				'name' => 'alb_review_author',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'field_548d3d6715e41',
				'label' => 'Artist',
				'name' => 'artist_of_album',
				'type' => 'relationship',
				'return_format' => 'id',
				'post_type' => array (
					0 => 'artist'
				),
				'taxonomy' => array (
					0 => 'all',
				),
				'filters' => array (
					0 => 'search'
				),
				'result_elements' => array (
					0 => 'featured_image'
				),
				'max' => 100,
			),
			array (
				'key' => 'field_523b66d6f2382',
				'label' => 'External Link',
				'name' => 'alb_link_external',
				'type' => 'text',
				'instructions' => esc_html__("If you want to redirect the user to an external link instead of this page, enter the URL below (eg: https://www.your-url.com).", 'sonaar'),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'album',
					'order_no' => 2,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'excerpt',
				1 => 'custom_fields',
				2 => 'discussion',
				3 => 'comments',
				4 => 'categories',
				5 => 'tags',
				6 => 'send-trackbacks',
			),
		),
		'menu_order' => 2,
	));

	register_field_group(
		array (
		'id' => 'acf_podcast-infos',
		'title' => 'Episode Infos',
		'fields' => array (
			array(
				'key' => 'podcast_player_position',
				'label'  => __('Player position', 'sonaar'),
				'name' => 'podcast_player_position',
				'type'=>'select',
				'choices' => array (
					'above' => __('Above the content', 'sonaar'),
					'below' => __('Below the content', 'sonaar'),
				)
			),
			array(
				'key' => 'FileOrStreamPodCast',
				'label' => 'File',
				'name' => 'FileOrStreamPodCast',
				'type' => 'radio',
				'instructions' => 'Please select which type of podcast source you want for this track',
				'choices' => array(
					'mp3' => 'Local MP3',
					'stream' => 'External File'
				),
				'layout' => 'horizontal'
			),
			 array (
				'key' => 'track_mp3_podcast',
				'label' => 'MP3 File',
				'name' => 'track_mp3_podcast',
				'type' => 'file',
				'instructions' => 'Only .MP3 file accepted. We recommend encoding at 320kbps @ 44.1kHz to avoid any glitch',
				'column_width' => '',
				'library' => 'all',
				'mime_types' => 'mp3, m4a, flac, opus, wav',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'FileOrStreamPodCast',
							'operator' => '==',
							'value' => 'mp3',
						),
					),
					'allorany' => 'all',
				)
			),
			array (
				'key' => 'stream_link_podcast',
				'label' => 'External Audio link',
				'name' => 'stream_link',
				'type' => 'text',
				'instructions' => 'Add link to your external podcast file. See <a href="https://sonaar.io/docs/which-streaming-platforms-do-you-support/" target="_blank">this article</a> for supported external links',
				'column_width' => '',
				'default_value' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'FileOrStreamPodCast',
							'operator' => '==',
							'value' => 'stream',
						),
					),
					'allorany' => 'all',
				)
			),
			array (
				'key' => 'podcast_track_length',
				'label' => 'Duration',
				'name' => 'podcast_track_length',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'FileOrStreamPodCast',
							'operator' => '==',
							'value' => 'stream',
						),
					),
					'allorany' => 'all',
				)
			),
			array (
				'key' => 'field_51b8c6d6cc84b',
				'label' => 'Buttons and call-to-action',
				'name' => 'podcast_calltoaction',
				'type' => 'repeater',
				'instructions' => 'Add button(s) into the podcast player.',
				'sub_fields' => array (
					array (
						'key' => 'podcast_button_name',
						'label' => 'Button Name',
						'name' => 'podcast_button_name',
						'type' => 'text',
						'instructions' => 'Examples : Subscribe, Download, etc.',
						'column_width' => '40',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array (
						'key' => 'podcast_button_link',
						'label' => 'Button Link',
						'name' => 'podcast_button_link',
						'type' => 'text',
						'instructions' => '',
						'column_width' => '40',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array (
						'key' => 'podcast_button_target',
						'label' => 'Open link in a new tab',
						'name' => 'podcast_button_target',
						'type' => 'true_false',
						'ui' => 1,
						'column_width' => '20',
						'default_value' => 0,
						'placeholder' => 0,
					),
					
				),
				'row_min' => 0,
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => '+ Add Button',
			),
			array (
				'key' => 'podcast_explicit_episode',
				'label' => 'Mark this episode as explicit.',
				'name' => 'podcast_explicit_episode',
				'type' => 'true_false',
				'ui' => 1,
				'default_value' => 0,
				'placeholder' => 0,
			),
			array (
				'key' => 'podcast_itunes_notshow',
				'label' => 'Block this episode from appearing in iTunes and Google Play',
				'name' => 'podcast_itunes_notshow',
				'type' => 'true_false',
				'ui' => 1,
				'default_value' => 0,
				'placeholder' => 0,
			),
			array(
				'key' => 'no_track_skip',
				'label'  => __('Do not skip to the next episode', 'sonaar'),
				'instructions' => __('<br style="clear:both">When the current episode ends, do not play the second episode automatically.<br><br>'),
				'name' => 'no_track_skip',
				'type' => 'true_false',
				'ui' => 1
			),
			array (
				'key' => 'podcast_itunes_episode_title',
				'label' => 'iTunes Episode Title (exclude series or show number)',
				'name' => 'podcast_itunes_episode_title',
				'type' => 'text',
				'instructions' => 'You dont have to specify your podcast title, episode number, or season number in this tag.',
				'column_width' => '',
				'default_value' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'podcast_itunes_episode_number',
				'label' => 'iTunes Episode Number',
				'name' => 'podcast_itunes_episode_number',
				'type' => 'number',
				'instructions' => 'The iTunes Episode Number. Leave Blank If None.',
				'column_width' => '',
				'default_value' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'podcast_itunes_season_number',
				'label' => 'iTunes Season Number',
				'name' => 'podcast_itunes_season_number',
				'type' => 'number',
				'instructions' => 'Leave Blank If None.',
				'column_width' => '',
				'default_value' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'podcast_itunes_episode_type',
				'label' => 'iTunes Episode Type',
				'name' => 'podcast_itunes_episode_type',
				'type' => 'select',
				'choices' => array (
					'full' => 'Full',
					'trailer' => 'Trailer',
					'bonus' => 'Bonus',
				),
				'default_value' => '',
				'allow_null' => 1,
				'multiple' => 0,
				),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'podcast',
					'order_no' => 2,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'custom_fields',
				1 => 'discussion',
				2 => 'comments',
				3 => 'send-trackbacks',
			),
		),
		'menu_order' => 2,
		)
	);


	register_field_group(
		array (
		'id' => 'acf_podcastshow-infos',
		'title' => 'Show Infos',
		'fields' => array (
			array(
				'key' => 'podcast-category-in-show',
				'label' => 'Which Episode Category would you like to display for this show?',
				'name' => 'podcast-category-in-show',
				'type' => 'taxonomy',
				'taxonomy' => 'podcast-category',
				'allow_null' => 0,
				'multiple' => 1,
				),
			array (
				'key' => 'podcastshow-host',
				'name' => 'podcastshow-host',
				'label' => 'Hosted by',
				'type' => 'text',
				'default_value' => '',
				'maxlength' => '',
				'placeholder' => 'Who host this show?',
				),
			),
			
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'podcastshow',
					'order_no' => 2,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'custom_fields',
				1 => 'discussion',
				2 => 'comments',
				3 => 'send-trackbacks',
			),
		),
		'menu_order' => 1,
		)
	);

	$default_event_show_time = get_ironMusic_option('default_event_show_time', '_iron_music_event_options');

	if ( is_null($default_event_show_time) )
		$default_event_show_time = true;

	$events_show_countdown_rollover = get_ironMusic_option('events_show_countdown_rollover', '_iron_music_event_options');

	if ( is_null($events_show_countdown_rollover) )
		$events_show_countdown_rollover = true;

	
	register_field_group(array (
		'id' => 'acf_page-podcast-template',
		'title' => esc_html__('Podcasts Setting', 'sonaar'),
		'fields' => array (
			array (
				'key' => 'podcasts_columns',
				'label' => esc_html__('Column number', 'sonaar'),
				'name' => 'podcasts_columns',
				'type' => 'select',
				'choices' => array (
					1 => esc_html__('1 column', 'sonaar'),
					2 => esc_html__('2 columns', 'sonaar'),
					3 => esc_html__('3 columns', 'sonaar'),
					4 => esc_html__('4 columns', 'sonaar')
				),
				'default_value' => 3,
				'allow_null' => 0,
				'multiple' => 0,
			),
			array(
				"type" => "select",
				"class" => "",
				"label" => esc_html_x("Display Grid for:", 'VC', 'sonaar'),
				"key" => "grid_filter_podcast",
				"name" => "grid_filter_podcast",
				"choices" => array(
						'' => esc_html_x("All podcasts category", 'VC', 'sonaar'),
						'yes' => esc_html_x("One or multiple categories...", 'VC', 'sonaar')
					),
			 ),
			array(
			'type' => 'taxonomy',
			'taxonomy' => 'podcast-category',
			'field_type' => 'select',
			'multiple' => '1',
			"label" => esc_html_x("Select one or multiple categories", 'VC', 'sonaar'),
			"key" => "podcast_category",
			"name" => "podcast_category",
			'conditional_logic' => array (
				'status' => 1,
				'rules' => array (
					array (
						'field' => 'grid_filter_podcast',
						'operator' => '==',
						'value' => 'yes',
					),
				),
				'allorany' => 'all',
			)
			),
			

		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'archive-podcast.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (),
		),
		'menu_order' => 0,
	));

	register_field_group(array (
		'id' => 'acf_event-infos',
		'title' => 'Event Infos',
		'fields' => array (
			array (
				'key' => 'field_523b46ebe355f',
				'type' => 'message',
				'label' => esc_html__('Event Date / Time', 'sonaar'),
				'message' => 'Please use the post publish date to set your event date',
			),
			array (
				'key' => 'field_523b46ebe35ef',
				'label' => esc_html__('Show the time', 'sonaar'),
				'name' => 'event_show_time',
				'type' => 'true_false',
				'ui' => 1,
				//'message' => 'Show the time',
				'default_value' => (bool) $default_event_show_time,
			),
			array (
				'key' => 'field_523b46ebe35f0',
				'label' => esc_html__('Enable Rollover Countdown', 'sonaar'),
				'name' => 'event_enable_countdown',
				'type' => 'true_false',
				'ui' => 1,
				//'message' => 'Enable Rollover Countdown',
				'default_value' => (bool) $events_show_countdown_rollover,
			),
			array (
				'key' => 'field_51b8bf97193f8',
				'label' => 'City',
				'name' => 'event_city',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'field_51b8bfa8193f9',
				'label' => 'Venue',
				'name' => 'event_venue',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'field_51b8bfbf193fb',
				'label' => 'Map Link Label',
				'name' => 'event_map_label',
				'type' => 'text',
				'default_value' => 'Google Map',
				'formatting' => 'html',
				'maxlength' => '',
				'placeholder' => 'Google Map',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'field_51b8bfbf193fa',
				'label' => 'Map Link',
				'name' => 'event_map',
				'type' => 'text',
				'instructions' => 'Add the link to Google Maps pointing to the Venue',
				'default_value' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'event_call_action',
				'label' => 'Event Call to Action',
				'name' => 'event_call_action',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'event_action_label_rp',
						'label' => 'Call to Action Label',
						'name' => 'event_action_label_rp',
						'type' => 'text',
						'default_value' => 'Tickets',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => 'Tickets',
						'prepend' => '',
						'append' => '',
					),
					array (
						'key' => 'event_link_rp',
						'label' => 'Call to Action Link',
						'name' => 'event_link_rp',
						'type' => 'text',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
				)
			),
			array (
				'key' => 'field_548d3d5415e41',
				'label' => 'Artist at Event',
				'name' => 'artist_at_event',
				'type' => 'relationship',
				'return_format' => 'id',
				'post_type' => array (
					0 => 'artist'
				),
				'taxonomy' => array (
					0 => 'all',
				),
				'filters' => array (
					0 => 'search'
				),
				'result_elements' => array (
					0 => 'featured_image'
				),
				'max' => 100,
			),
			array (
				'key' => 'field_523b66d6f2382',
				'label' => 'External Link',
				'name' => 'alb_link_external',
				'type' => 'text',
				'instructions' => esc_html__("If you want to redirect the user to an external link instead of this page, enter the URL below (eg: https://www.your-url.com).", 'sonaar'),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'event',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'excerpt',
				1 => 'format',
				2 => 'categories',
				3 => 'tags',
				4 => 'send-trackbacks',
			),
		),
		'menu_order' => 0,
	));

	// $photo_sizes_options = get_iron_option('photo_sizes');
	$photo_sizes = array('random' => 'Random');

	if(!empty($photo_sizes_options) && is_array($photo_sizes_options)) {
		foreach($photo_sizes_options as $key => $size) {
			$photo_sizes["size_".$key] = $size["size_name"]." (".$size["size_width"]."x".$size["size_height"].")";
		}
	}



	register_field_group(array (
		'id' => 'acf_page-event-template',
		'title' => 'Events Query',
		'fields' => array (
			array (
				'key' => 'field_51b8bff2193fc',
				'label' => 'Filter By Date',
				'name' => 'events_filter',
				'type' => 'select',
				'choices' => array (
					'upcoming' => 'Upcoming Events',
					'past' => 'Past Events'
				),
				'default_value' => 'upcoming',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_51b8bff2193fe',
				'label' => 'Filter By Artists',
				'name' => 'artists_filter',
				'type' => 'post_object',
				'post_type' => array(
					0 => 'artist'
				),
				'allow_null' => 1,
				'multiple' => 1,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'archive-event.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (),
		),
		'menu_order' => 0,
	));

	register_field_group(array(
		'id' => 'cf_artists',
		'title' => 'Artist options',
		'menu_order' => 2,
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'excerpt',
				1 => 'custom_fields'
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'artist',
				),
			),
		),
		'fields' => array(
			array(
				'key' => 'artist_hero_playlist',
				'label' => 'Featured playlist',
				'name' => 'artist_hero_playlist',
				'instructions' => 'Only playlists that contain MP3 files are accepted.',
				'type' => 'post_object',
				'post_type'=> array('album'),
				'allow_null' => 1,
				'multiple' => 0,
			),
			array (
				'key' => 'artist_desc',
				'label' => 'Description',
				'name' => 'artist_desc',
				'type' => 'wysiwyg',
			),
			array (
				'key' => 'artist_social',
				'label' => 'Social',
				'name' => 'artist_social',
				'type' => 'repeater',
				'button_label'=> 'Add a social link',
				'sub_fields' => array (
					array(
						'key'=>'artist_social_icon',
						'name'=>'artist_social_icon',
						'type'=>'select',
						'label'=>'Icons',
						'choices' => array (
							''=>'none',
							'fab fa-facebook' => '&#xf09a; Facebook',
							'fab fa-twitter' => '&#xf099; Twitter',
							'fab fa-instagram' => '&#xf16d; Instagram',
							'fab fa-bandcamp' => '&#xf2d5; BandCamp',
							'fab fa-flickr' => '&#xf16e; Flickr',
							'fab fa-google-plus' => '&#xf0d5; Google+',
							'fab fa-linkedin' => '&#xf0e1; LinkedIn',
							'fab fa-lastfm' => '&#xf202; Lastfm',
							'fab fa-pinterest' => '&#xf0d2; Pinterest',
							'fa fa-podcast' => '&#xf2ce; Podcast',
							'fab fa-spotify' => '&#xf1bc; Spotify',
							'fab fa-soundcloud' => '&#xf1be; SoundCloud',
							'fab fa-vimeo' => '&#xf27d; Vimeo',
							'fab fa-youtube' => '&#xf167; Youtube',
							'fab fa-tiktok' => '&#xe07b; TikTok',
						),
						'default_value' => '',
						'allow_null' => 0,
						'multiple' => 0,
						'column_width' => '20%',
					),
					array(
						'key'=> 'artist_social_label',
						'name'=> 'artist_social_label',
						'label'=>'label',
						'column_width' => '40%',
						'type'=>'text',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
					),
					array(
						'key'=> 'artist_social_link',
						'name'=> 'artist_social_link',
						'label'=>'link',
						'instructions' => 'Your link should starts with http:// or https://',
						'column_width' => '40%',
						'type'=>'text',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
					),
				)
			),
			array (
				'key' => 'artist_link',
				'label' => 'link',
				'name' => 'artist_link',
				'type' => 'repeater',
				'button_label'=> 'Add a link',
				'sub_fields' => array (
					array(
						'key'=> 'artist_link_label',
						'name'=> 'artist_link_label',
						'label'=>'label',
						'column_width' => '50%',
						'type'=>'text',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
					),
					array(
						'key'=> 'artist_link_link',
						'name'=> 'artist_link_link',
						'label'=>'link',
						'instructions' => 'Your link should starts with http:// or https://',
						'column_width' => '50%',
						'type'=>'text',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
					)
				)
			),
			array (
				'key' => 'artist_contact',
				'label' => 'Contact and Booking',
				'name' => 'artist_contact',
				'type' => 'wysiwyg'
			),
			array (
				'key' => 'artist_download',
				'label' => 'Download link',
				'name' => 'artist_download',
				'type' => 'repeater',
				'layout'=>'row',
				'button_label'=> 'Add a download link',
				'sub_fields' => array (
					array(
						'key'=> 'artist_download_label',
						'name'=> 'artist_download_label',
						'label'=>'label',
						'column_width' => '',
						'type'=>'text',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
					),
					array(
						'key'=> 'artist_download_link',
						'name'=> 'artist_download_link',
						'label'=>'file',
						'type'=>'file',
						'column_width' => '',
						'save_format' => 'url',
						'library' => 'all',
					)
				)
				),
				array (
					'key' => 'field_523b66d6f2382',
					'label' => 'External Link',
					'name' => 'alb_link_external',
					'type' => 'text',
					'instructions' => esc_html__("If you want to redirect the user to an external link instead of this page, enter the URL below (eg: https://www.your-url.com).", 'sonaar'),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'formatting' => 'none',
					'maxlength' => '',
				)

		)
	));

// dont register this option if playlist is disable from redux option
$enable_playlist_cpt = Iron_sonaar::getOption('enable-playlist-cpt');
if( !function_exists( 'run_sonaar_music_pro' ) && ($enable_playlist_cpt || $enable_playlist_cpt === NULL) ){
  	register_field_group(array(
		'id' => 'cf_footerPlayer',
		'title' => 'Music player',
		'menu_order' => 2,
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'event',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'video',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'album',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'artist',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'product',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'fields' => array( 
			array( 
				'key' => 'footer_playlist', 
				'label' => 'Display Music Player in the Footer', 
				'name' => 'footer_playlist', 
				'type' => 'post_object', 
				'instructions' => 'This will display the sticky music player in the footer. Choose a playlist below:', 
				'post_type'=> array('album'), 
				'allow_null' => 1, 
				'multiple' => 0, 
			), 
			array ( 
				'key' => 'footer_playlist_autoplay', 
				'label' => 'Auto-Play', 
				'instructions' => '<p style="display: inline-block;">User must have interacted with website before the player loads. <a href=https://sonaar.io/blog/>Read More</a></p>', 
				'name' => 'footer_playlist_autoplay', 
				'type' => 'true_false', 
				'ui' => 1,
				'default_value' => 0, 
				'placeholder' => 0, 
			), 
		) 
		)

	);

}
// dont register this option if playlist is disable from redux option
$enable_podcast_cpt = Iron_sonaar::getOption('enable-podcast-cpt');
if(  !function_exists( 'run_sonaar_music_pro' ) && ( $enable_podcast_cpt || $enable_podcast_cpt === NULL ) ){
    register_field_group(array(
		'id' => 'cf_footerPodcastPlayer',
		'title' => 'Podcast player',
		'menu_order' => 3,
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'event',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'video',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'artist',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'podcast',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'podcastshow',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'product',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'fields' => array( 
			array( 
				'key' => 'footer_podcast', 
				'label' => 'Display Podcast Player in the Footer', 
				'name' => 'footer_podcast', 
				'instructions' => 'This will display the sticky podcast player in the footer. Select an episode:', 
				'type' => 'post_object', 
				'post_type'=> array('podcast'), 
				'allow_null' => 1, 
				'multiple' => 0, 
			), 
			array ( 
				'key' => 'footer_podcast_autoplay', 
				'label' => 'Auto-Play after User Gesture', 
				'instructions' => '<p style="display: inline-block;">User must have interacted with website before the player loads. <a href=https://sonaar.io/blog/>Read More</a></p>', 
				'name' => 'footer_podcast_autoplay', 
				'type' => 'true_false',
				'ui' => 1,
				'default_value' => 0, 
				'placeholder' => 0, 
			), 
		) 
		)
	);
}

	register_field_group(array (
		'id' => 'acf_page-banner',
		'title' => 'Page Banner',
		'fields' => array (

			array (
				'key' => 'banner_inherit_setting',
				'label' => 'Inherit setting from the podcast category',
				'name' => 'banner_inherit_setting',
				'type' => 'true_false',
				'ui' => 1,
				'default_value' => 0,
				'placeholder' => 0,
				'instructions' => 'Use the banner setting from the podcast category.',
			),

			array (
				'key' => 'field_54ce55f555a01',
				'label' => 'Background Type',
				'name' => 'banner_background_type',
				'type' => 'select',
				'choices' => array (
					'image-background' => 'Image Background',
					'color-background' => 'Color Background',
				),
				'default_value' => '',
				'allow_null' => 1,
				'multiple' => 0,
			),

			array (
				'key' => 'field_54ce55f555a02',
				'label' => 'Banner Background Color',
				'name' => 'banner_background_color',
				'instructions' => 'Set your desired banner background color if not using an image',
				'type' => 'color_picker',
				'default_value' => '',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_54ce55f555a01',
							'operator' => '==',
							'value' => 'color-background',
						),
					),
					'allorany' => 'all',
				),
			),

			array (
				'key' => 'field_54ce55f555a03',
				'label' => 'Parallax Effect ?',
				'name' => 'banner_parallax',
				'type' => 'true_false',
				'default_value' => 0,
				'placeholder' => 0,
				'ui' => 1,
				'instructions' => 'This will cause your banner to have a parallax scroll effect.',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_54ce55f555a01',
							'operator' => '==',
							'value' => 'image-background',
						),
						array (
							'field' => 'banner_inherit_setting',
							'operator' => '!=',
							'value' => 1,
						),

					),
					'allorany' => 'all',
				),
			),

			array (
				'key' => 'field_54ce55f555a04',
				'label' => 'Banner Image',
				'name' => 'banner_image',
				'instructions' => 'The image should be between 1600px - 2000px wide and have a minimum height of 475px for best results. Click "Browse" to upload and then "Insert into Post"',
				'type' => 'image',
				'save_format' => 'id',
				'preview_size' => 'medium',
				'library' => 'all',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_54ce55f555a01',
							'operator' => '==',
							'value' => 'image-background',
						),
					),
					'allorany' => 'all',
				),
			),	
			array (
				'key' => 'field_54ce55f555a05',
				'label' => 'Height Options',
				'name' => 'banner_fullscreen',//Weird Name for retro compatibility
				'type' => 'select',
				'choices' => array (
					true => 'Fullscreen', //Weird Value for retro compatibility
					'custom-height' => 'Custom Height',
					'keep-image-ratio' => 'Keep Image Aspect Ratio',
				),
				'default_value' => 0,
				'allow_null' => 1,
				'multiple' => 0,
			),
			array (
				'key' => 'field_54ce55f555a06',
				'label' => 'Banner Height',
				'name' => 'banner_height',
				'type' => 'text',
				'default_value' => 0,
				'placeholder' => 0,
				'instructions' => 'How tall do you want your banner? Don\'t include "px" in the string. e.g. 350',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_54ce55f555a05',
							'operator' => '==',
							'value' => 'custom-height',
						),
						array (
							'field' => 'banner_inherit_setting',
							'operator' => '!=',
							'value' => 1,
						),
					),
					'allorany' => 'all',
				),
			),


			array (
				'key' => 'field_54ce55f555a13',
				'label' => 'Content Type',
				'name' => 'banner_content_type',
				'type' => 'select',
				'choices' => array (
					'default-content' => 'Default Content (Title & Subtitle)',
					'advanced-content' => 'Advanced Content (HTML)',
				),
				'default_value' => 'default-content',
				'allow_null' => 0,
				'multiple' => 0,
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'banner_inherit_setting',
							'operator' => '!=',
							'value' => 1,
						),
					),
					'allorany' => 'all',
				),
			),

			array (
				'key' => 'field_54ce55f555a14',
				'label' => 'HTML Content',
				'name' => 'banner_texteditor_content',
				'type' => 'textarea',
				'toolbar' => 'full',
				'media_upload' => false,
				'default_value' => '',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_54ce55f555a13',
							'operator' => '==',
							'value' => 'advanced-content',
						),
						array (
							'field' => 'banner_inherit_setting',
							'operator' => '!=',
							'value' => 1,
						),
					),
					'allorany' => 'all',
				),
			),
			array (
				'key' => 'sr_banner_display_post_title',
				'label' => 'Display Post Title as Heading',
				'name' => 'sr_banner_display_post_title',
				'type' => 'true_false',
				'ui' => 1,
				'default_value' => '',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_54ce55f555a13',
							'operator' => '==',
							'value' => 'default-content',
						),
						array (
							'field' => 'banner_inherit_setting',
							'operator' => '==',
							'value' => 1,
						),
					),
					'allorany' => 'any',
				),
			),

			array (
				'key' => 'field_54ce55f555a07',
				'label' => 'Banner Title',
				'name' => 'banner_title',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						/*array (
							'field' => 'field_54ce55f555a13',
							'operator' => '==',
							'value' => 'default-content',
						),*/
						array (
							'field' => 'sr_banner_display_post_title',
							'operator' => '!=',
							'value' => 1,
						),
						/*array (
							'field' => 'banner_inherit_setting',
							'operator' => '!=',
							'value' => 1,
						),*/
					),
					'allorany' => 'all',
				),
			),

			array (
				'key' => 'field_54ce55f555a08',
				'label' => 'Banner Subtitle',
				'name' => 'banner_subtitle',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_54ce55f555a13',
							'operator' => '==',
							'value' => 'default-content',
						),
						array (
							'field' => 'banner_inherit_setting',
							'operator' => '==',
							'value' => 1,
						),
					),
					'allorany' => 'any',
				),
			),



			array (
				'key' => 'field_54ce55f555a09',
				'label' => 'Banner Horizontal Content Alignment',
				'name' => 'banner_horizontal_content_alignment',
				'instructions' => 'Configure the position for your slides content',
				'type' => 'radio',
				'choices' => array (
					'left' => 'Left',
					'centered' => 'Centered',
					'right' => 'Right',
				),

				'default_value' => 'centered',
				'layout' => 'horizontal',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_54ce55f555a13',
							'operator' => '==',
							'value' => 'default-content',
						),
						array (
							'field' => 'banner_inherit_setting',
							'operator' => '!=',
							'value' => 1,
						),
					),
					'allorany' => 'all',
				),
			),

			array (
				'key' => 'field_54ce55f555a11',
				'label' => 'Background Alignement',
				'name' => 'banner_background_alignement',
				'type' => 'select',
				'choices' => array (
					'top' => 'Top',
					'center' => 'Center',
					'bottom' => 'Bottom',
				),
				'default_value' => 'center',
				'allow_null' => 0,
				'multiple' => 0,
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_54ce55f555a01',
							'operator' => '==',
							'value' => 'image-background',
						),
					),
					'allorany' => 'all',
				),
			),

			array (
				'key' => 'field_54ce55f555a12',
				'label' => esc_html_x('Banner Title Font Color', 'VC', 'sonaar'),
				'name' => 'banner_font_color',
				'instructions' => 'Set your desired banner title font color',
				'type' => 'color_picker',
				'default_value' => '',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_54ce55f555a13',
							'operator' => '==',
							'value' => 'default-content',
						),
					),
					'allorany' => 'all',
				),
			),
			array (
				'key' => 'page_banner_subtitle_font_color',
				'label' => esc_html_x('Banner Subtitle Font Color', 'VC', 'sonaar'),
				'name' => 'page_banner_subtitle_font_color',
				'instructions' => 'Set your desired banner sub-title font color',
				'type' => 'color_picker',
				'ui' => 1,
				'default_value' => '',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_54ce55f555a13',
							'operator' => '==',
							'value' => 'default-content',
						),
					),
					'allorany' => 'all',
				),
			),
			array (
				'key' => 'field_54ce55f555a02311',
				'label' => 'Push your content up to overlap the banner',
				'name' => 'content_banner_overlap',
				'instructions' => 'This option will move your content above and overlap the banner',
				'type' => 'true_false',
				'ui' => 1,
				'default_value' => 0,
				'placeholder' => 0,
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'banner_inherit_setting',
							'operator' => '!=',
							'value' => 1,
						),
					),
					'allorany' => 'all',
				),

			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'artist',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'event',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'video',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'product',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'podcast',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'podcastshow',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'ef_taxonomy',
					'operator' => '==',
					'value' => 'podcast-category',
					'order_no' => 2,
					'group_no' => 0,
				),
			),
			
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 1,
	));

	register_field_group(
		array(
			'id' => 'taxonomy_options',
			'title' => 'Taxonomy Options',
			'menu_order' => 0,
			'options' => array (
				'position' => 'normal',
				'layout' => 'default',
			),
			'location' => array (
				array (
					array (
						'param' => 'ef_taxonomy',
						'operator' => '==',
						'value' => 'podcast-category',
						'order_no' => 1,
						'group_no' => 0,
					),
				),
			),
			'fields' => array( 
				array (
					'key' => 'page_logo_select_taxonomy',
					'label' => 'Select Logo Version',
					'name' => 'page_logo_select_taxonomy',
					'type' => 'select',
					'choices' => array (
						'dark' => 'Dark',
						'light' => 'Light',
					),
					'default_value' => '',
					'allow_null' => 1,
					'multiple' => 0,
				),
				array (
					'key' => 'classic_menu_main_item_text_color_taxonomy',
					'label' => 'Classic Menu Main Item Text Color',
					'instructions' => esc_html__('This will override global settings', 'sonaar'),
					'name' => 'classic_menu_main_item_color_taxonomy',
					'type' => 'color_picker',
					'default_value' => '',
				),
				array (
					'key' => 'classic_menu_background_taxonomy',
					'label' => 'Menu Background Color',
					'instructions' => esc_html__('This will override global settings. For classic menu only', 'sonaar'),
					'name' => 'classic_menu_background_taxonomy',
					'type' => 'color_picker',
					'default_value' => '',
				),
			) 
		)
	);
}
?>