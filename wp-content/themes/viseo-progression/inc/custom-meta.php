<?php

add_action( 'cmb2_admin_init', 'progression_studios_page_meta_box' );
function progression_studios_page_meta_box() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'progression_studios_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$progression_studios_cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'metabox_page_settings',
		'title'         => esc_html__('Page Settings', 'viseo-progression'),
		'object_types'  => array( 'page' ), // Post type,
	) );
	
	
	$progression_studios_cmb_demo->add_field( array(
		'name'       => esc_html__('Sub-title', 'viseo-progression'),
		'id'         => $prefix . 'sub_title',
		'type'       => 'text',
	) );

	$progression_studios_cmb_demo->add_field( array(
		'name'       => esc_html__('Sidebar Display', 'viseo-progression'),
		'id'         => $prefix . 'page_sidebar',
		'type'       => 'select',
		'options'     => array(
			'hidden-sidebar'   => esc_html__( 'Hide Sidebar', 'viseo-progression' ),
			'right-sidebar'    => esc_html__( 'Right Sidebar', 'viseo-progression' ),
			'left-sidebar'    => esc_html__( 'Left Sidebar', 'viseo-progression' ),
		),
	) );
	
	$progression_studios_cmb_demo->add_field( array(
		'name' => esc_html__('Page Title Background Image', 'viseo-progression'),
		'id'         => $prefix . 'header_image',
		'type'         => 'file',
		'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
	) );
	
	$progression_studios_cmb_demo->add_field( array(
		'name'       => esc_html__('Disable Page Title', 'viseo-progression'),
		'id'         => $prefix . 'disable_page_title',
		'type'       => 'checkbox',
	) );
	
}



add_action( 'cmb2_admin_init', 'progression_studios_page_header_meta_box' );
function progression_studios_page_header_meta_box() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'progression_studios_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$progression_studios_cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'metabox_page_header',
		'title'         => esc_html__('Header Settings', 'viseo-progression'),
		'object_types'  => array( 'page' ), // Post type,
	) );
	
	$progression_studios_cmb_demo->add_field( array(
		'name'       => esc_html__('Navigation Text Color', 'viseo-progression'),
		'id'         => $prefix . 'custom_page_nav_color',
		'type'       => 'select',
		'options'     => array(
			'progression_studios_default_navigation_color'    => esc_html__( 'Default Color', 'viseo-progression' ),
			'progression_studios_force_dark_navigation_color'    => esc_html__( 'Force Text Black', 'viseo-progression' ),
			'progression_studios_force_light_navigation_color'   => esc_html__( 'Force Text White', 'viseo-progression' ), 
		),
	) );
	
	$progression_studios_cmb_demo->add_field( array(
		'name'       => esc_html__('Force Transparent Header', 'viseo-progression'),
		'id'         => $prefix . 'header_transparent_float',
		'type'       => 'checkbox',
	) );
	
	$progression_studios_cmb_demo->add_field( array(
		'name' => esc_html__('Custom logo for page', 'viseo-progression'),
		'desc' => esc_html__('Must be same size as the main logo.', 'viseo-progression'),
		'id'         => $prefix . 'custom_page_logo',
		'type'         => 'file',
		'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
	) );
	
	
	$progression_studios_cmb_demo->add_field( array(
		'name'       => esc_html__('Disable Header', 'viseo-progression'),
		'id'         => $prefix . 'header_disabled',
		'type'       => 'checkbox',
	) );
	
	$progression_studios_cmb_demo->add_field( array(
		'name'       => esc_html__('Disable Footer', 'viseo-progression'),
		'id'         => $prefix . 'disable_footer_per_page',
		'type'       => 'checkbox',
	) );


	
}



add_action( 'cmb2_admin_init', 'progression_studios_index_post_meta_box' );
function progression_studios_index_post_meta_box() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'progression_studios_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$progression_studios_cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'metabox_post',
		'title'         => esc_html__('Index Settings', 'viseo-progression'),
		'object_types'  => array( 'post' ), // Post type
	) );
	
	$progression_studios_cmb_demo->add_field( array(
		'name' => esc_html__('Image Gallery', 'viseo-progression'),
		'desc' => esc_html__('Add-in images to display a gallery.', 'viseo-progression'),
		'id'         => $prefix . 'gallery',
		'type'         => 'file_list',
		'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
	) );
	

	$progression_studios_cmb_demo->add_field( array(
		'name'       => esc_html__('Featured Image Link', 'viseo-progression'),
		'id'         => $prefix . 'blog_featured_image_link',
		'type'       => 'select',
		'options'     => array(
			'progression_link_default'   => esc_html__( 'Default link to post', 'viseo-progression' ), // {#} gets replaced by row number
			'progression_link_lightbox'    => esc_html__( 'Link to image in lightbox pop-up', 'viseo-progression' ),
			'progression_link_url'    => esc_html__( 'Link to URL', 'viseo-progression' ),
			'progression_link_url_new_window'    => esc_html__( 'Link to URL (New Window)', 'viseo-progression' ),
			'progression_lightbox_video'    => esc_html__( 'Link to video (Youtube/Vimeo/.MP4)', 'viseo-progression' ),
		),

	) );
	

	$progression_studios_cmb_demo->add_field( array(
		'name' => esc_html__('Optional Link', 'viseo-progression'),
		'desc' => esc_html__('Make your post link to another page or video pop-up.', 'viseo-progression'),
		'id'         => $prefix . 'external_link',
		'type'       => 'text',
	) );
	

	
	
}




add_action( 'cmb2_admin_init', 'progression_studios_post_meta_box' );
function progression_studios_post_meta_box() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'progression_studios_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$progression_studios_cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'metabox_post_settings',
		'title'         => esc_html__('Post Settings', 'viseo-progression'),
		'object_types'  => array( 'post' ), // Post type
	) );
	
	
	$progression_studios_cmb_demo->add_field( array(
		'name'       => esc_html__('Short Page Title Layout', 'viseo-progression'),
		'id'         => $prefix . 'small_page_title_option',
		'type'       => 'checkbox',
	) );
	
	$progression_studios_cmb_demo->add_field( array(
		'name'       => esc_html__('Video/Audio', 'viseo-progression'),
		'desc'       => esc_html__('Paste in your video url or embed code', 'viseo-progression'),
		'id'         => $prefix . 'video_post',
		'type'       => 'textarea_code',
		'options' => array( 'disable_codemirror' => true )
	) );
	
	$progression_studios_cmb_demo->add_field( array(
		'name'       => esc_html__('Video/Audio Display', 'viseo-progression'),
		'id'         => $prefix . 'blog_post_embed_option',
		'type'       => 'select',
		'options'     => array(
			'progression_link_embed'    => esc_html__( 'Embed video directly onto page', 'viseo-progression' ),
			'progression_link_default'   => esc_html__( 'Link to video in Lightbox (Youtube/Vimeo/.MP4)', 'viseo-progression' ), // {#} gets replaced by row number
		),

	) );
	
	
	$progression_studios_cmb_demo->add_field( array(
		'name'       => esc_html__('Disable Advertisements on Post', 'viseo-progression'),
		'id'         => $prefix . 'disable_advertisement_post',
		'type'       => 'checkbox',
	) );
	
	$progression_studios_cmb_demo->add_field( array(
		'name'       => esc_html__('Disable Sidebar on Post', 'viseo-progression'),
		'id'         => $prefix . 'group_552033a9a46bc',
		'type'       => 'checkbox',
	) );
	
	
	

}



add_action( 'cmb2_admin_init', 'progression_studios_slider_meta_box' );
function progression_studios_slider_meta_box() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'progression_studios_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$progression_studios_cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'metabox_slider_settings',
		'title'         => esc_html__('Slider Settings', 'viseo-progression'),
		'object_types'  => array( 'post' ), // Post type
	) );
	
	$progression_studios_cmb_demo->add_field( array(
		'name' => esc_html__('Video Embed in Slider', 'viseo-progression'),
		'desc' => esc_html__('Check box to force embeded video in slider', 'viseo-progression'),
		'id'         => $prefix . 'video_embeding',
		'type'       => 'checkbox',
	) );
	
	$progression_studios_cmb_demo->add_field( array(
		'name'       => esc_html__('Sub-title', 'viseo-progression'),
		'id'         => $prefix . 'sub_title',
		'type'       => 'text',
	) );
	
	
	$progression_studios_cmb_demo->add_field( array(
		'name'       => esc_html__('Additional Title', 'viseo-progression'),
		'id'         => $prefix . 'additional_title',
		'type'       => 'text',
	) );
	

}



add_action( 'cmb2_admin_init', 'progression_studios_rss_meta_box' );
function progression_studios_rss_meta_box() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'progression_studios_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$progression_studios_cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'metabox_rss_settings',
		'title'         => esc_html__('RSS Feed Settings', 'viseo-progression'),
		'object_types'  => array( 'post' ), // Post type
	) );
	
	$progression_studios_cmb_demo->add_field( array(
		'name'       => esc_html__('RSS Sub-title', 'viseo-progression'),
		'id'         => $prefix . 'rss_sub_title',
		'type'       => 'text',
	) );
	

	$progression_studios_cmb_demo->add_field( array(
		'name'       => esc_html__('RSS Short Description', 'viseo-progression'),
		'id'         => $prefix . 'short_description',
		'type'       => 'text',
	) );
	
	$progression_studios_cmb_demo->add_field( array(
		'name'       => esc_html__('External audio file URL for the RSS feed', 'viseo-progression'),
		'description'       => esc_html__('If you have an audio file hosted externally (For example: Libsyn, Bulbrry, SoundCloud etc.), fill-in the direct link to the file here', 'viseo-progression'),
		'id'         => $prefix . 'external_rss_file_link',
		'type'       => 'text',
	) );
	
	$progression_studios_cmb_demo->add_field( array(
		'name'       => esc_html__('Duration (numbers only)', 'viseo-progression'),
		'description'       => esc_html__('Example: 34:18', 'viseo-progression'),
		'id'         => $prefix . 'duration_int',
		'type'       => 'text',
	) );
	
	$progression_studios_cmb_demo->add_field( array(
		'name'       => esc_html__('File Size', 'viseo-progression'),
		'description'       => esc_html__('Fill in file size in bytes (If not computed automatically)', 'viseo-progression'),
		'id'         => $prefix . 'filesize',
		'type'       => 'text',
	) );
	
	


}


add_action( 'cmb2_admin_init', 'progression_user_meta_box' );
/**
 * Hook in and add a metabox to demonstrate repeatable grouped fields
 */
function progression_user_meta_box() {
	
	// Start with an underscore to hide fields from custom fields list
	$prefix = 'progression_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$progression_cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'user_author_info',
		'title'         => esc_html__('Author Settings', 'viseo-progression'),
		'object_types'     => array( 'user' ), // Tells CMB2 to use user_meta vs post_meta

	) );
	
	$progression_cmb_demo->add_field( array(
		'name'     => esc_html__( 'Author Information', 'viseo-progression' ),
		'id'       => $prefix . 'extra_info',
		'type'     => 'title',
		'on_front' => false,
	) );
	

	$progression_cmb_demo->add_field( array(
		'name' => esc_html__( 'Author Sub-headline', 'viseo-progression' ),
		'desc' => esc_html__( 'Leave blank to hide this field', 'viseo-progression' ),
		'id'   => $prefix . 'user_sub_headline',
		'type' => 'text',
	) );
	
	$progression_cmb_demo->add_field( array(
		'name' => esc_html__( 'Author Website URL', 'viseo-progression' ),
		'desc' => esc_html__( 'Leave blank to hide this field', 'viseo-progression' ),
		'id'   => $prefix . 'authorurl',
		'type' => 'text_url',
	) );

	$progression_cmb_demo->add_field( array(
		'name' => esc_html__( 'Facebook URL', 'viseo-progression' ),
		'desc' => esc_html__( 'Leave blank to hide this field', 'viseo-progression' ),
		'id'   => $prefix . 'facebookurl',
		'type' => 'text_url',
	) );

	$progression_cmb_demo->add_field( array(
		'name' => esc_html__( 'Twitter URL', 'viseo-progression' ),
		'desc' => esc_html__( 'Leave blank to hide this field', 'viseo-progression' ),
		'id'   => $prefix . 'twitterurl',
		'type' => 'text_url',
	) );
	
	$progression_cmb_demo->add_field( array(
		'name' => esc_html__( 'Dribbble URL', 'viseo-progression' ),
		'desc' => esc_html__( 'Leave blank to hide this field', 'viseo-progression' ),
		'id'   => $prefix . 'dribbbleurlurl',
		'type' => 'text_url',
	) );


	$progression_cmb_demo->add_field( array(
		'name' => esc_html__( 'Linkedin URL', 'viseo-progression' ),
		'desc' => esc_html__( 'Leave blank to hide this field', 'viseo-progression' ),
		'id'   => $prefix . 'linkedinurl',
		'type' => 'text_url',
	) );
	
	$progression_cmb_demo->add_field( array(
		'name' => esc_html__( 'Pinterest URL', 'viseo-progression' ),
		'desc' => esc_html__( 'Leave blank to hide this field', 'viseo-progression' ),
		'id'   => $prefix . 'pinteresturl',
		'type' => 'text_url',
	) );
	
	$progression_cmb_demo->add_field( array(
		'name' => esc_html__( 'Houzz URL', 'viseo-progression' ),
		'desc' => esc_html__( 'Leave blank to hide this field', 'viseo-progression' ),
		'id'   => $prefix . 'houzzurl',
		'type' => 'text_url',
	) );
	
	
	$progression_cmb_demo->add_field( array(
		'name' => esc_html__( 'Google+ URL', 'viseo-progression' ),
		'desc' => esc_html__( 'Leave blank to hide this field', 'viseo-progression' ),
		'id'   => $prefix . 'googleplusurl',
		'type' => 'text_url',
	) );
	
	$progression_cmb_demo->add_field( array(
		'name' => esc_html__( 'Instagram URL', 'viseo-progression' ),
		'desc' => esc_html__( 'Leave blank to hide this field', 'viseo-progression' ),
		'id'   => $prefix . 'instagramurl',
		'type' => 'text_url',
	) );
	
	

	
	$progression_cmb_demo->add_field( array(
		'name' => esc_html__( 'Youtube URL', 'viseo-progression' ),
		'desc' => esc_html__( 'Leave blank to hide this field', 'viseo-progression' ),
		'id'   => $prefix . 'youtubeurl',
		'type' => 'text_url',
	) );
	


	$progression_cmb_demo->add_field( array(
		'name' => esc_html__( 'Vimeo URL', 'viseo-progression' ),
		'desc' => esc_html__( 'Leave blank to hide this field', 'viseo-progression' ),
		'id'   => $prefix . 'vimeourl',
		'type' => 'text_url',
	) );
	
	$progression_cmb_demo->add_field( array(
		'name' => esc_html__( 'Soundcloud URL', 'viseo-progression' ),
		'desc' => esc_html__( 'Leave blank to hide this field', 'viseo-progression' ),
		'id'   => $prefix . 'soundcloudurl',
		'type' => 'text_url',
	) );
	
	
	$progression_cmb_demo->add_field( array(
		'name' => esc_html__( 'Houzz URL', 'viseo-progression' ),
		'desc' => esc_html__( 'Leave blank to hide this field', 'viseo-progression' ),
		'id'   => $prefix . 'houzzurl',
		'type' => 'text_url',
	) );

	
	
	
	$progression_cmb_demo->add_field( array(
		'name' => esc_html__( 'E-mail Address', 'viseo-progression' ),
		'desc' => esc_html__( 'Leave blank to hide this field', 'viseo-progression' ),
		'id'   => $prefix . 'emailmailto',
		'type' => 'text',
	) );
	

}




