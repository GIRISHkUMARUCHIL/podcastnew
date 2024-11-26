<?php

class Iron_sonaar_Setup{

	public static function execute(){
		global $content_width;
		define('SR_MASTER_VERSION', '4.27');
		$content_width = ( ! isset( $content_width ) ) ? 1144 : $content_width;
		add_action( 'sonaar_rssimport', array('iron_sonaar_setup', 'sr_rsscron'));
		add_action(	'delete_post', array('iron_sonaar_setup', 'deletePost'));
		add_action(	'tgmpa_register', array('iron_sonaar_setup', 'registerRequiredPlugins'));
		add_action(	'after_setup_theme', array('iron_sonaar_setup', 'theme'));
		add_action(	'after_switch_theme', array('iron_sonaar_setup', 'activation'));
		add_action(	'widgets_init', array('iron_sonaar_setup', 'widgets'));
		add_action(	'wp_enqueue_scripts', array('iron_sonaar_setup', 'enqueueStyles'));
		add_action(	'wp_enqueue_scripts', array('iron_sonaar_setup', 'sr_loadFonts'));
		add_action(	'wp_enqueue_scripts', array('iron_sonaar_setup', 'enqueueScripts'));
		add_action(	'wp_head', array('iron_sonaar_setup', 'metadataIcons'), 100);
		add_action(	'wp_head', array('iron_sonaar_setup', 'sr_vertical_lines'), 100);
		add_action( 'admin_notices', array('iron_sonaar_setup', 'checkMemory'));
		add_action( 'save_post', array('iron_sonaar_setup', 'savePost'));
		add_action( 'template_redirect', array('iron_sonaar_setup', 'redirectPostUrl'));
		add_action( 'admin_bar_menu', array('iron_sonaar_setup', 'adminBar'), 999);
		add_action( 'wp_footer', array('iron_sonaar_setup', 'footer'), 20 );
		add_action( 'vc_before_init', array('iron_sonaar_setup', 'vcRemoveAllPointers') );
		add_action(	'woocommerce_before_main_content', array('iron_sonaar_setup', 'themeWrapperStart'), 10);
		add_action(	'woocommerce_after_main_content', array('iron_sonaar_setup', 'themeWrapperEnd'), 10);
		add_action( "wp_ajax_fetch_Oembed", array( 'iron_sonaar_setup', 'fetch_Oembed') );
		add_action( "wp_ajax_nopriv_fetch_Oembed", array( 'iron_sonaar_setup', 'fetch_Oembed') );
		add_action( 'registered_post_type', array('iron_sonaar_setup', 'remove_revslider_metabox'), 999, 2);
		if( Iron_sonaar::getOption('menu_type') == "elementor-menu" ){
			add_action( 'customize_register', array('iron_sonaar_setup', 'sr_customize_register'));
		}
		if (iron_music_is_active_plugin( 'js_composer/js_composer.php' )) {
			add_action(	'admin_enqueue_scripts', array('iron_sonaar_setup', 'enqueueAdminScripts'));
		}

		/*if ( did_action( 'elementor/loaded' ) ) {
			add_action( 'elementor/frontend/after_register_styles',function() { // Unregister FA from Elementor since we load it twice. Load Font Awesome 4 Support options must be turned off in Elementor tho.
				foreach( [ 'solid', 'regular', 'brands'] as $style ) {
					wp_deregister_style( 'elementor-icons-fa-' . $style );
				}
			}, 20 );
		}*/

		
		add_action( 'elementor/init', function () {
			$elementsManager = Elementor\Plugin::instance()->elements_manager;
			$elementsManager->add_category(
				'elementor-sonaar',
				array(
					'title' => 'Sonaar Blocks',
					'icon'  => 'fonts',
				)
			);
		} );

		function sr_register_elementor_locations( $elementor_theme_manager ) {
			$elementor_theme_manager->register_all_core_location();
		}
		add_action( 'elementor/theme/register_locations', 'sr_register_elementor_locations' );

		add_filter(	'body_class', array('iron_sonaar_setup', 'bodyClass') );
		add_filter(	'post_class', array('iron_sonaar_setup', 'postClass') );
		add_filter(	'dynamic_sidebar_params', array('iron_sonaar_setup', 'adjustWidgetAreas') );
		add_filter(	'upload_mimes', array('iron_sonaar_setup', 'uploadMimes') );
		add_filter(	'use_default_gallery_style', '__return_false'); //Disable inline CSS injected by WordPress.
		add_filter(	'wp_title', array('iron_sonaar_setup', 'wpTitle') , 5, 3);
		add_filter(	'taxonomy_template', array('iron_sonaar_setup', 'archiveTemplateInclude'));
		add_filter( 'excerpt_length', array('iron_sonaar_setup', 'customExcerptLength'), 999 );
		add_filter('get_next_post_sort',   array('iron_sonaar_setup', 'filter_next_post_sort'), 999, 2);
		add_filter('get_next_post_where',  array('iron_sonaar_setup', 'filter_next_post_where'), 999);
		add_filter('get_previous_post_sort',  array('iron_sonaar_setup', 'filter_previous_post_sort'), 999, 2);
		add_filter('get_previous_post_where', array('iron_sonaar_setup', 'filter_previous_post_where'), 999);
		add_filter('pre_set_site_transient_update_themes',array('iron_sonaar_setup', 'check_for_update') );
		add_filter('fw_ext_backups_db_restore_keep_options', array('iron_sonaar_setup','_filter_fw_ext_backups_db_restore_keep_options'), 10, 2);
		add_filter ('wp_nav_menu_items', array('iron_sonaar_setup','setAllMenusItemsID'), 10, 2);

		/* fix to make sure footer doesnt break with other page builder with duplicated content*/
		add_filter( 'sonaar_content', 'wptexturize'        );
		add_filter( 'sonaar_content', 'convert_smilies'    );
		add_filter( 'sonaar_content', 'convert_chars'      );
		add_filter( 'sonaar_content', 'wpautop'            );
		add_filter( 'sonaar_content', 'shortcode_unautop'  );
		add_filter( 'sonaar_content', 'prepend_attachment' );
		add_filter( 'sonaar_content', 'do_shortcode', 11 );

		if (is_admin())
			$current = get_transient('update_themes');
		
		/*-----------------------------------------------------------------------------------*/
		/* WOOCOMMERCE
		/*-----------------------------------------------------------------------------------*/

		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
		remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
		remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

		// check if Podcast feed is used then remove the alternate feed to avoid confusion in Google Podcast 
		$srpodcast_title = get_ironMusic_option('srpodcast_data_title', '_iron_music_podcast_feed_options');
        if ($srpodcast_title) {
            add_action( 'wp_head', 'srpodcast_add_rss_feed_meta', 3 );
            remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
            remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
        }
        function srpodcast_add_rss_feed_meta() {
			$srpodcast_title = get_ironMusic_option('srpodcast_data_title', '_iron_music_podcast_feed_options');
			$podcastrss = esc_url(trailingslashit( home_url() ) );
			echo '<link rel="alternate" type="application/rss+xml"  title="' . $srpodcast_title . '" href="'. $podcastrss .'feed/podcast"/>' . "\n";
        }

		// WPML
		define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true);
	}

	public static function sr_rsscron($arg){
		/*
		// for debugging purpose
		$file = 'somefile.txt';
		file_put_contents($file, $arg['cat_id']);*/

		// Set up the environment
		if ( ! defined('ABSPATH') ) {
		    require_once( dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) . '/wp-load.php' );
		}
		require_once( ABSPATH . 'wp-admin/includes/admin.php' );
		define( 'WP_LOAD_IMPORTERS', true );
		require_once IRON_MUSIC_DIR_PATH . 'includes/rss-importer/class-podcast-rss-import.php';
		// run function
		Sonaar_RSS_Import::run_import( $arg['feed_url'], $import_category = $arg['cat_id'], $import_attachments = true, $import_settings = false );
	}

	public static function wpdocs_styles_method(){
		$custom_css = "
			*{
				background: red!important;
			}";
		wp_add_inline_style( 'iron-master', $custom_css );
	}
	public static function vcRemoveAllPointers() {
   		remove_action( 'admin_enqueue_scripts', 'vc_pointer_load' );
	}

	public static function themeWrapperStart() {
	  echo '<div class="container">
			<div class="boxed">';
	}

	public static function themeWrapperEnd() {
	  echo '</div></div></div>';
	}
	public static function sr_vertical_lines(){
		if( Iron_sonaar::getOption( 'display_vertical_lines' ) == '3_vertical_lines' || Iron_sonaar::getOption( 'display_vertical_lines' ) == '5_vertical_lines') {
			$html = '';
			$html .= '<div class="sr-vertical-line-holder">';
				$html .= '<div class="sr-vertical-line sr-vertical--left"></div>';
				if( Iron_sonaar::getOption( 'display_vertical_lines' ) == '5_vertical_lines' ){
					$html .= '<div class="sr-vertical-line sr-vertical--left-2"></div>';
				}
				$html .= '<div class="sr-vertical-line sr-vertical--center"></div>';
				if( Iron_sonaar::getOption( 'display_vertical_lines' ) == '5_vertical_lines' ){
					$html .= '<div class="sr-vertical-line sr-vertical--right-2"></div>';
				}
				$html .= '<div class="sr-vertical-line sr-vertical--right"></div>';
			$html .= '</div>';
			echo $html;
		}

	}
	public static function footer(){
		if( Iron_sonaar::getOption( 'footer_back_to_top_enabled', null, true ) ){
		echo '<a href="#" id="back-to-top-mobile" class="footer-wrapper-backtotop-mobile">
			<i class="fa-solid fa-chevron-up"></i>
		</a>
		<a href="#" id="back-to-top" class="footer-wrapper-backtotop">
			<i class="fa-solid fa-chevron-up"></i>
		</a>';
		}
	}

	/**
	 * Helper for removing the Revslider Metabox from being on every CPT edit screen
	 *
	 * @param $post_type
	 */
	public static function remove_revslider_metabox($post_type){
	    add_action('do_meta_boxes', function () use ($post_type) {
	        remove_meta_box('mymetabox_revslider_0', $post_type, 'normal');
	    });
	}

	public static function filter_next_post_sort($order, $post) {
		if($post->post_type == 'artist' ){
			return "ORDER BY p.post_title ASC LIMIT 1";
    	}else{
        	return "ORDER BY p.post_date ASC LIMIT 1";
    	}
		return $order;
	}
	public static function filter_next_post_where($where) {
    	global $post, $wpdb;
		if($post->post_type == 'artist' ){
			return $wpdb->prepare("WHERE p.post_title > '%s' AND p.post_type = '%s' AND p.post_status = 'publish'",$post->post_title, get_post_type($post) );
	    }else{
	        return $wpdb->prepare( "WHERE p.post_date > '%s' AND p.post_type = '%s' AND p.post_status = 'publish'", $post->post_date, get_post_type($post) );
	    }
	}
	public static function filter_previous_post_sort($order, $post) {
		if($post->post_type == 'artist' ){
    		return "ORDER BY p.post_title DESC LIMIT 1";
    	}else{
        	return "ORDER BY p.post_date DESC LIMIT 1";
   		}
		return $order;
	}
	public static function filter_previous_post_where($where) {
    	global $post, $wpdb;
		if($post->post_type == 'artist' ){
    		return $wpdb->prepare("WHERE p.post_title < '%s' AND p.post_type = '%s' AND p.post_status = 'publish'",$post->post_title, get_post_type($post) );
		}else{
      	  return $wpdb->prepare( "WHERE p.post_date < '%s' AND p.post_type = '%s' AND p.post_status = 'publish'", $post->post_date, get_post_type($post) );
   		}
	}

	/**
	 *  Modify excerpts length
	 *
	 */

	public static function customExcerptLength( $length ) {
		return 20;
	}


	/**
	 *  Add menu-item ID on all Menus (wordpress only set ID on the main menu)
	 *
	 */

	 public static function setAllMenusItemsID($menu) {
		$dom = new DOMDocument;
		$dom->loadHTML('<?xml encoding="utf-8" ?><div>' . $menu . '</div>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
		$container = $dom->getElementsByTagName('div')->item(0);
		foreach ($container->getElementsByTagName('li') as $element) {
			$classes = $element->getAttribute("class");
			preg_match("/menu-item-\d+/", $classes, $output_array);
			if ($output_array != null) {
				$element->setAttribute("data-id", $output_array[0]);
			}
		}
		$menu = '';
		foreach ($container->childNodes as $child) {
			$menu .= $dom->saveHTML($child);
		}
		return $menu;
	}


	/**
	 * Add Theme Options to WordPress Toolbar
	 */

	public static function adminBar ( $wp_toolbar ){
		global $redux_args;

		$wp_toolbar->add_node( array(
			  'parent' => 'appearance'
			, 'id'     => 'iron-options'
			, 'title'  => $redux_args['menu_title']
			, 'href'   => admin_url('/admin.php?page=' . $redux_args['page_slug'])
		) );
	}


	/**
	 * Trashes custom settings related to Theme Options
	 *
	 * When the post and page is permanently deleted, everything that is tied to it is deleted also.
	 * This includes theme settings.
	 *
	 * @see wp_delete_post()
	 *
	 * @param int $post_id Post ID.
	 */
	public static function deletePost ( $post_id ) {
		global $wpdb;

		if ( $post = $wpdb->get_row($wpdb->prepare("SELECT * FROM $wpdb->posts WHERE ID = %d", $post_id)) )
		{
			if ( 'page' == $post->post_type) {
				// if the page is defined in option page_on_front or post_for_posts,
				// adjust the corresponding options
				if ( Iron_sonaar::getOption('page_for_albums') == $post_id ) {
					iron_sonaar_reset_option('page_for_albums');
				}
				if ( Iron_sonaar::getOption('page_for_events') == $post_id ) {
					iron_sonaar_reset_option('page_for_events');
				}
				if ( Iron_sonaar::getOption('page_for_videos') == $post_id ) {
					iron_sonaar_reset_option('page_for_videos');
				}
				if ( Iron_sonaar::getOption('page_for_photos') == $post_id ) {
					iron_sonaar_reset_option('page_for_photos');
				}
			}
		}
	}

	public static function redirectPostUrl () {
		if ( ('album' == get_post_type() && is_single()) || ('event' == get_post_type() && is_single()) || ('artist' == get_post_type() && is_single()) ) {
			global $post;

			$url = get_post_meta($post->ID, 'alb_link_external', true);
			$url = esc_url($url);

			if ( ! empty($url) ) {
				wp_redirect($url, 302);
				exit;
			}
		}
	}



	/*
 	* Register recommended plugins for this theme.
 	*/

	public static function registerRequiredPlugins (){
		$plugins = array(
			array(
				'name'					=> 'Iron Demo Importer',
				'slug'					=> 'iron-demo-importer',
	            'file_path'				=> 'iron-demo-importer/iron-importer.php',
				'source'				=> 'http://assets.sonaar.io/plugins/iron-demo-importer.zip',
	            'required'              => false, // If false, the plugin is only 'recommended' instead of required
	            'version'               => '1.8', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
	            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
	            'force_deactivation'	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			),
			array(
	            'name'                  => 'Elementor Sonaar Addons', // The plugin name
	            'slug'                  => 'elementor-for-sonaar', // The plugin slug (typically the folder name)
	            'file_path'				=> 'elementor-for-sonaar/elementor-for-sonaar.php',
	            'source'                => 'http://assets.sonaar.io/plugins/elementor-for-sonaar.zip', // The plugin source
	            'required'              => true, // If false, the plugin is only 'recommended' instead of required
	            'version'               => '2.4.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
	            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
	            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
	        ),
			array(
				'name'  				=> 'Contact Form 7',
				'slug'  				=> 'contact-form-7',
				'required'				=> false
			),
			array(
				'name'  				=> 'Elementor',
				'slug'  				=> 'elementor',
				'required'				=> false
			),
			array(
				'name'  				=> 'Duplicate Post',
				'slug'  				=> 'duplicate-post',
				'required'				=> false
			),
			array(
	            'name'                  => 'Slider Revolution', // The plugin name
	            'slug'                  => 'revslider', // The plugin slug (typically the folder name)
	            'file_path'				=> 'revslider/revslider.php',
	            'source'                => get_template_directory() . '/includes/plugins/revslider.zip', // The plugin source
	            'required'              => true, // If false, the plugin is only 'recommended' instead of required
	            'version'               => '6.6.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
	            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
	            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
	        ),
	        array(
	            'name'                  => 'Essential Grid', // The plugin name
	            'slug'                  => 'essential-grid', // The plugin slug (typically the folder name)
	            'file_path'				=> 'essential-grid/essential-grid.php',
	            'source'                => get_template_directory() . '/includes/plugins/essential-grid.zip', // The plugin source
	            'required'              => true, // If false, the plugin is only 'recommended' instead of required
	            'version'               => '3.0.10', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
	            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
	            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
	        ),
		);

		$srmp3 = array(
			'name'  				=> 'MP3 Audio Player',
			'slug'  				=> 'mp3-music-player-by-sonaar',
			'required'				=> true
		);
		$wpbakery = array(
	            'name'                  => 'WPBakery Page Builder', // The plugin name
	            'slug'                  => 'js_composer', // The plugin slug (typically the folder name)
	            'file_path'				=> 'js_composer/js_composer.php',
	            'source'                => get_template_directory() . '/includes/plugins/js_composer.zip', // The plugin source
	            'required'              => false, // If false, the plugin is only 'recommended' instead of required
	            'version'               => '6.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
	            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
	            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
	    );
		if(Iron_sonaar::isKitDemoContent()){
			array_push($plugins,$srmp3);   
		}
	    if (iron_music_is_active_plugin( 'js_composer/js_composer.php' )) {
  			set_site_transient( 'sr_wpbakery_exist', true,  14 * DAY_IN_SECONDS );	
		}
		if ( get_site_transient( 'sr_wpbakery_exist' )) {
		   array_push($plugins,$wpbakery);   
		}


		/*if(is_admin() && function_exists('get_plugin_data')) {

			foreach($plugins as $plugin) {
				if(!empty($plugin['file_path']) && is_plugin_active($plugin['file_path']) && !empty($plugin["version"])) {
					$version = $plugin["version"];
					$plugin_path = WP_PLUGIN_DIR.'/'.$plugin['slug'];
					$plugin_file = WP_PLUGIN_DIR.'/'.$plugin['file_path'];
					$plugin_source = $plugin['source'];
					$data = get_plugin_data($plugin_file);
					if(!empty($data["Version"]) && ($data["Version"] < $version) && empty($_GET["tgmpa-install"])) {
						//deactivate_plugins($plugin_file);
					}
				}
			}
		}*/

		tgmpa($plugins, array(
			'domain'       => 'sonaar',
			'has_notices'  => true, // Show admin notices or not
			'is_automatic' => true // Automatically activate plugins after installation or not
		));

	}

	/*
	 * After Theme Setup
	 */
	public static function theme() {
		register_nav_menu('main-menu', 'Main Menu sonaar');
		register_nav_menu('responsive-menu', 'Responsive Menu sonaar');


		if ( function_exists('add_theme_support') ) {
			add_theme_support('automatic-feed-links');
			add_theme_support('post-thumbnails');
			add_theme_support('html5', array('comment-form', 'comment-list', 'search-form') );
			add_theme_support('favicon');
			add_theme_support('woocommerce');
			add_theme_support( 'wc-product-gallery-lightbox' );
			add_theme_support( 'wc-product-gallery-slider' );
			add_theme_support('title-tag');
			add_theme_support('custom-logo');
		}

		if ( function_exists('add_image_size') ) {
			add_image_size('iron-image-thumb', 300, 230, true);
		}

		// Load theme textdomain
		load_theme_textdomain( 'sonaar', get_template_directory() . '/languages/sonaar' );
	}


	public static function sr_customize_register( $wp_customize ) {

		$wp_customize->add_setting('secondary_header_logo');
		$wp_customize->add_setting('sticky_header_logo');
		$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'secondary_header_logo',array(
			'label' => __( 'Secondary Header Logo', 'sonaar' ),
			'section' => 'title_tagline', 
			'settings' => 'secondary_header_logo',
			'priority' => 8 
		)));
		$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'sticky_header_logo',array(
			'label' => __( 'Sticky Header Logo', 'sonaar' ),
			'section' => 'title_tagline', 
			'settings' => 'sticky_header_logo',
			'priority' => 8 
		)));
	}

	/*
	 * Redirect to options after activation
	 */
	public static function activation() {
		flush_rewrite_rules();

		if ( ! empty($_GET['activated']) && $_GET['activated'] == 'true' ){
			update_option('medium_size_w', 559);
			update_option('medium_size_h', 559);
		}
	}

	public static function bodyClass( $classes ) {

		global $post, $wp_query;

		$classes[] = 'lang-'.get_bloginfo('language');

		$classes[] = 'layout-wide';

		if( function_exists('is_shop') && is_shop() ){
			$postID = wc_get_page_id('shop');
		}else{
			if( is_404() ) {
			    $postID = Iron_sonaar::getOption('404_page_selection');
			}else{
				$postID = ( isset($post) ) ? $post->ID : '';
				$postID = (  !is_archive() && is_object($wp_query->queried_object) && (int) get_option('page_for_posts') === $wp_query->queried_object->ID )? (int) get_option('page_for_posts') : $postID;
			}
		}
		if((bool)Iron_sonaar::getField('hide_header_and_menu', $postID)) {
			$classes[] = 'hide-header';
		}
		if((bool)Iron_sonaar::getField('classic_menu_over_content', $postID)) {
			$classes[] = 'sr-over-content';
		}
		if((bool)Iron_sonaar::getOption('enable_fixed_header', null, false)) {
			$classes[] = 'fixed_header';
		}

		if(Iron_sonaar::getOption('theme_name_body_class') != '' || Iron_sonaar::getOption('theme_name_body_class') != NULL) {
			$classes[] = Iron_sonaar::getOption('theme_name_body_class');
		}

		return $classes;
	}

	public static function postClass( $classes ){

		if ( is_singular('event') ) {
			$classes[] = 'sr_it-single-post';
		}
		if ( is_singular('album') ) {
			$classes[] = 'info-section';
		}
		if ( is_singular('artist') ) {
			$classes[] = 'sr_it-single-post artist-post';
		}
		if ( is_singular('video') ) {
			$classes[] = 'sr_it-single-post video-post';
		}
		if (is_single()) {
			$classes[] = 'sr_it-single-post';
		}
		if (is_page()) {
			$classes[] = 'sr_it-single-post';
		}
		if (is_post_type_archive('post')) {
			$classes[] = 'media-block';
		}

		return $classes;
	}

	/*
	 * Register Widgetized Areas
	 */

	public static function widgets() {
		$widget_areas = Iron_sonaar::getOption( 'widget_areas', null, array(
					'sonaar_sidebar_0' => array(
						'sidebar_name' => esc_html_x('Default Blog Sidebar', 'Theme Options', 'sonaar'),
						'sidebar_desc' => esc_html_x('Sidebar widget area found on Blog post-related page templates.', 'Theme Options', 'sonaar'),
						'sidebar_grid' => 1,
						'order_no'     => 1
					),
					'sonaar_sidebar_1' => array(
						'sidebar_name' => esc_html_x('Default Video Sidebar', 'Theme Options', 'sonaar'),
						'sidebar_desc' => esc_html_x('Sidebar widget area found on Video-related page templates.', 'Theme Options', 'sonaar'),
						'sidebar_grid' => 1,
						'order_no'     => 2
					),
					'sonaar_sidebar_2' => array(
						'sidebar_name' => esc_html_x('Default Footer', 'Theme Options', 'sonaar'),
						'sidebar_desc' => esc_html_x('Site footer widget area.', 'Theme Options', 'sonaar'),
						'sidebar_grid' => 1,
						'order_no'     => 4
					),
					'sonaar_sidebar_3' => array(
						'sidebar_name' => esc_html_x('Default Podcast Sidebar', 'Theme Options', 'sonaar'),
						'sidebar_desc' => esc_html_x('Sidebar widget area found on Podcast-related page templates.', 'Theme Options', 'sonaar'),
						'sidebar_grid' => 1,
						'order_no'     => 3
					)

				) );
		if ( ! empty($widget_areas) && is_array($widget_areas) ){
			ksort( $widget_areas );

			foreach ( $widget_areas as $w_id => $w_area ){
				register_sidebar( array(
					'id'            => $w_id,
					'name'          => empty( $w_area['sidebar_name'] ) ? '' : $w_area['sidebar_name'],
					'description'   => empty( $w_area['sidebar_desc'] ) ? '' : $w_area['sidebar_desc'],
					'before_widget' => '<aside id="%1$s" class="widget atoll %2$s">',
					'after_widget'  => '</aside>',
					'before_title'  => '<div class="panel__heading"><h3 class="widget-title">',
					'after_title'   => '</h3></div>'
				));
			}
		}
		register_sidebar( array(
			'id'            => 'sonaar_sidebar_lang',
			'name'          => esc_html_x('Default Languages Area', 'Theme Options', 'sonaar'),
			'description'   => esc_html_x('Site Languages widget area.', 'Theme Options', 'sonaar'),
			'class'			=> 'sidebar-lang',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<div class="panel__heading"><h3 class="widget-title">',
			'after_title'   => '</h3></div>'
		));
	}

	/*
	 * Swap Widget Semantics
	 */

	public static function adjustWidgetAreas ($params) {
		$params[0]['before_title'] = str_replace('%1$s', '', $params[0]['before_title']);

		if ( ( is_front_page() || is_page_template('page-home.php') ) && did_action('get_footer') === 0 )
		{
			$params[0]['before_widget'] = str_replace('<aside', '<section', $params[0]['before_widget']);
			$params[0]['after_widget']  = str_replace('aside>', 'section>', $params[0]['after_widget']);
		} else {
			$params[0]['before_widget'] = str_replace(' atoll', '', $params[0]['before_widget']);
		}

		return $params;
	}




	/*
	 * Enqueue Theme Styles
	 */

	public static function enqueueStyles() {
		if ( is_admin() || Iron_sonaar::isLoginPage() ) return;

		global $wp_query;
		$uploadDir = wp_upload_dir();

		// Styled by the theme
		wp_dequeue_style('contact-form-7');

		wp_enqueue_style('sr-font-awesome', get_template_directory_uri() . '/includes/sonaar-music/fontawesome/css/fontawesome.min.css', false, '5.12.0', 'all');
		wp_enqueue_style('sr-font-awesome-brand', get_template_directory_uri() . '/includes/sonaar-music/fontawesome/css/brands.min.css', false, '5.12.0', 'all');
		wp_enqueue_style('sr-font-awesome-solid', get_template_directory_uri() . '/includes/sonaar-music/fontawesome/css/solid.min.css', false, '5.12.0', 'all');
		wp_enqueue_style('sr-font-awesome-regular', get_template_directory_uri() . '/includes/sonaar-music/fontawesome/css/regular.min.css', false, '5.12.0', 'all');
		//wp_enqueue_style('font-awesome2', get_template_directory_uri() . '/includes/sonaar-music/fontawesome/css/all.min.css', false, '5.12.0', 'all');

    	wp_enqueue_style( 'js_composer_front' );
    	wp_enqueue_style( 'js_composer_custom_css' );
		if(Iron_sonaar::getOption('menu_type', null, 'push-menu') == 'classic-menu'){
			wp_enqueue_style('iron-classic-menu', get_template_directory_uri().'/classic-menu/css/classic.css', false, SR_MASTER_VERSION, 'all' );
		}
		wp_enqueue_style('iron-master', get_template_directory_uri().'/dist/css/main.min.css', false, SR_MASTER_VERSION, 'all');

		if (!empty($_SERVER['HTTP_USER_AGENT']) && preg_match('/(?i)msie [6-8]/',$_SERVER['HTTP_USER_AGENT']) ){
			wp_enqueue_style('iron-msie', get_template_directory_uri().'/css/ie.css', array('iron-master'), SR_MASTER_VERSION, 'all');
		}


		if ( !get_option( 'sonaar' )  ) {
			wp_enqueue_style( 'iron-default-style', get_template_directory_uri().'/css/default.css', array('iron-master') );
		}

	}

	public static function sr_loadFonts() {
		$iron_fonts = [];
		$iron_fonts = (is_array(get_option('sonaar')))? array_merge( $iron_fonts, get_option('sonaar') ) : $iron_fonts;
		$iron_fonts = (is_array(get_option('_iron_music_event_options')))? array_merge( $iron_fonts, get_option('_iron_music_event_options') ) : $iron_fonts;
		$iron_fonts = (is_array(get_option('_iron_music_music_player_options')))? array_merge( $iron_fonts, get_option('_iron_music_music_player_options') ) : $iron_fonts;
		$iron_fonts = (is_array(get_option('_iron_music_podcast_player_options')))? array_merge( $iron_fonts, get_option('_iron_music_podcast_player_options') ) : $iron_fonts;

		$iron_fonts = array_column($iron_fonts, 'font');
		$iron_fonts = array_filter($iron_fonts);
		$fonts = [];
		foreach($iron_fonts as $font) {
			if ( strpos($font, '_safe_') == false && strpos($font, 'Select a font') == false ) { //if not a system font
				$font  = explode( ':', $font ) ;
				if( ! isset( $fonts[$font[0]] ) ){
					$fonts[$font[0]] = [];
				}
				if( isset( $font[1] ) ){
					array_push( $fonts[$font[0]], $font[1]);
					sort($fonts[$font[0]]);
				}
			}
		}
		$fonts = array_map(function($key, $value){
			$value = array_unique($value);
			$weights = implode(',', $value);
			if( $weights != '' ){
				$weights = ':' . $weights ;
				$weights = str_replace('regular', '400', $weights);
				$weights = str_replace('italic', 'i', $weights);
				$weights = str_replace(':i', ':400i', $weights);
				$weights = str_replace(',i', ',400i', $weights);
			}
			return $key . $weights;
		}, array_keys($fonts), $fonts);
		$googleFontApiUrl = '//fonts.googleapis.com/css?family=' . implode('|', $fonts);
		wp_enqueue_style( 'sr-google-font', esc_url($googleFontApiUrl), false, null );
	}

	/*
	 * Enqueue Theme Scripts
	 */

	public static function enqueueScripts() {
		global $post, $wp_query;

		if ( is_admin() || Iron_sonaar::isLoginPage() ) return;

		if ( is_singular() && comments_open() && get_option('thread_comments') ){
			wp_enqueue_script('comment-reply');
		}

		if( function_exists('is_shop') && is_shop() ){
			$post_id = wc_get_page_id('shop');
		}else{
			if( is_404() ) {
			    $post_id = Iron_sonaar::getOption('404_page_selection');
			}else{
				$post_id = ( isset($post) ) ? $post->ID : '';
				$post_id = ( !is_archive() && is_object($wp_query->queried_object) && (int) get_option('page_for_posts') === $wp_query->queried_object->ID )? (int) get_option('page_for_posts') : $post_id;
			}
		}

		// VENDORS
		if ( iron_music_is_active_plugin( 'js_composer/js_composer.php' ) ) {
			if(self::getLanguageCode() != 'en') {
				wp_enqueue_script('iron-countdown-l10n', get_template_directory_uri().'/js/countdown-l10n/jquery.countdown-'.self::getLanguageCode().'.js', array('jquery'), null, true);
			}
		}

		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		$ironMainDeps = array('jquery','underscore','jquery-ui-slider','mediaelement');
		if ( Iron_sonaar::getOption('enable_ajax', NULL, false ) ) {
			if ( iron_music_is_active_plugin( 'js_composer/js_composer.php' ) ) {
			 	array_push( $ironMainDeps, 'wpb_composer_front_js' );
			}
		}
		
		$jsver = (!defined('SONAAR_DEBUG') || SONAAR_DEBUG == false )? '.min':'';
		$theme_data = wp_get_theme();

		if (!function_exists('logoHeight')) {
			function logoHeight($logo) {//Used to applied padding top on #wrapper
				if( Iron_sonaar::getOption('use_logo') == 1){
					$logoImageheight = 0;
					if( Iron_sonaar::getOption('menu_logo_height') == '' ){
						if( $logo != '' ){
							$logoId =  attachment_url_to_postid($logo);
							$logoImage = wp_get_attachment_image_src($logoId);
							if( $logoImage ){
								$logoImageheight = $logoImage[2];
							}
						}
					}else{
						$logoImageheight = intval(Iron_sonaar::getOption('menu_logo_height'));
					}
					$menuPadding = 2 * intval(str_replace('px', '', Iron_sonaar::getOption('classic_menu_vpadding')));

					return $logoImageheight + $menuPadding;
				}else{
					return 0;
				}		
			}
		}

		if (!function_exists('selectPageLogo')) {
			function selectPageLogo($id){
				if(Iron_sonaar::getOption('menu_type') == "elementor-menu"){
					return false;
				}
				if( is_object ( $id ) ){
					if( property_exists( $id, 'term_taxonomy_id') ){ //if this is a category page
						if( get_field( 'page_logo_select_taxonomy', get_queried_object()) == 'light' || get_field( 'page_logo_select_taxonomy', get_queried_object()) == 'dark'){
							return get_field( 'page_logo_select_taxonomy', get_queried_object() );
						}else{
							return false;
						}
					}
				}

				if( Iron_sonaar::getField('page_logo_select', $id ) !== 'null' && Iron_sonaar::getField('page_logo_select', $id ) !== ''){ 
					return get_field('page_logo_select', $id );
				}else{ 
					return false;
				}
			}
		}
		wp_enqueue_script('vue', '//cdn.jsdelivr.net/npm/vue@2/dist/vue' . $jsver . '.js', array(), NULL);
		wp_enqueue_script('d3', '//cdn.jsdelivr.net/npm/d3@5/dist/d3.min.js', array(), NULL);
		wp_enqueue_script('iron-main', get_template_directory_uri() . '/dist/js/sonaar.scripts' . $jsver . '.js', $ironMainDeps, SR_MASTER_VERSION, true);
		
		if( class_exists('Sonaar_Music') ){
			wp_enqueue_script( 'sonaar-music-mp3player' );
		}

		wp_localize_script('iron-main', 'iron_vars', array(
				'sonaar_debug' => (bool) (!defined('SONAAR_DEBUG') || SONAAR_DEBUG == false )? false : true,
				'enable_ajax' => (bool) Iron_sonaar::getOption('enable_ajax', null, '1'),
				'enable_spectrum' => (bool) Iron_sonaar::getOption('enable_spectrum', null, ''),
				'theme_url' => get_template_directory_uri(),
				'plugins_folder_url' =>plugins_url(),
				'ajaxurl' => admin_url('admin-ajax.php').'?lang='.self::getLanguageCode(),
				'enable_fixed_header' => Iron_sonaar::getOption('enable_fixed_header', null, '0') == "0" ? false : true,
				'header_top_menu_hide_on_scroll' => Iron_sonaar::getOption('header_top_menu_hide_on_scroll', null, '1'),
				'menu' => array(
					'top_menu_position' => !empty($_GET["mpos"]) ? $_GET["mpos"] : Iron_sonaar::getOption('menu_position', null, 'righttype'),
					'menu_transition' => !empty($_GET["mtype"]) ? $_GET["mtype"] : Iron_sonaar::getOption('menu_transition', null, 'type1'),
					'classic_menu_over_content' => (bool) ( (!is_archive() || ( function_exists('is_shop') && is_shop() ) ) && ( Iron_sonaar::getField('classic_menu_over_content', $post_id  )  == '1' || ( ( function_exists('is_shop') && is_shop() ) && Iron_sonaar::getField('classic_menu_over_content', wc_get_page_id('shop') )  == '1') || ( get_post_type( $post_id  ) == 'album' ) && Iron_sonaar::getField('album_background_type', $post_id ) != 'default' ) )? true: false,
					'classic_menu_position' => Iron_sonaar::getOption('classic_menu_position', null, 'absolute absolute_before'),
					'menu_type' => Iron_sonaar::getOption('menu_type', null, 'push-menu'),
					'classic_menu_hmargin' => Iron_sonaar::getOption('classic_menu_hmargin', null, '0'),
					'classic_menu_logo_align' => Iron_sonaar::getOption('classic_menu_logo_align'),
					'unveil_all_mobile_items' => Iron_sonaar::getOption('unveil_all_mobile_items'),
				),
				'lang' => self::getLanguageCode(),
				'custom_js' => Iron_sonaar::getOption('custom_js'),
				'plugins_url' => (defined('IRON_MUSIC_DIR_URL')? IRON_MUSIC_DIR_URL : ''),
				'slug' => array(
					'events' => ( function_exists('get_ironMusic_option') )? get_ironMusic_option( 'events_slug_name', '_iron_music_event_options' ) : '',
					'discography' => ( function_exists('get_ironMusic_option') )? get_ironMusic_option( 'discography_slug_name', '_iron_music_discography_options' ) : '',
					'artist' => 'artist',
					'videos' => 'videos'
				),
				'sonaar_music' => array(
					'color_base' => ( function_exists('get_ironMusic_option') )? get_ironMusic_option('music_player_timeline_color', '_iron_music_music_player_options') : '',
					'color_progress' => ( function_exists('get_ironMusic_option') )? get_ironMusic_option('music_player_progress_color', '_iron_music_music_player_options') : '',
					'continuous_background' => ( function_exists('get_ironMusic_option') )? get_ironMusic_option('continuous_music_player_background', '_iron_music_music_player_options') : 'rgb(0,0,0)',
					'continuous_timeline_background' => ( function_exists('get_ironMusic_option') )? get_ironMusic_option('continuous_music_player_timeline_bar', '_iron_music_music_player_options') : 'rgb(255,255,255)',
					'continuous_progress_bar' => ( function_exists('get_ironMusic_option') )? get_ironMusic_option('continuous_music_player_progress_bar', '_iron_music_music_player_options') : 'rgb(155,155,155)',
					'continuous_control_color' => ( function_exists('get_ironMusic_option') )? get_ironMusic_option('continuous_music_player_control_color', '_iron_music_music_player_options') : 'rgb(255,255,255)',
					'continuous_artist_name' => ( function_exists('get_ironMusic_option') )? get_ironMusic_option('continuous_music_player_label_artist', '_iron_music_music_player_options') : '',
					'continuous_playlist_icon' => ( function_exists('get_ironMusic_option') )? get_ironMusic_option('continuous_music_player_playlist_icon', '_iron_music_music_player_options') : '',
					'footer_playlist' =>  ( Iron_sonaar::getField('footer_playlist', get_queried_object_id()) == "" || Iron_sonaar::getField('footer_playlist',get_queried_object_id() ) == "null" || function_exists('is_shop') && is_shop() && Iron_sonaar::getField('footer_playlist', get_option( 'woocommerce_shop_page_id' )) == '')? (bool) false : (int) Iron_sonaar::getField('footer_playlist', get_queried_object_id()),
					'footer_podcast' =>  ( Iron_sonaar::getField('footer_podcast',get_queried_object_id()) == "" || Iron_sonaar::getField('footer_podcast',get_queried_object_id()) == "null"  || function_exists('is_shop') && is_shop() && Iron_sonaar::getField('footer_playlist', get_option( 'woocommerce_shop_page_id' )) == '')? (bool) false : (int) Iron_sonaar::getField('footer_podcast', get_queried_object_id()),
					'footer_playlist_autoplay' =>  ( Iron_sonaar::getField('footer_playlist_autoplay', get_queried_object_id()) == "" || Iron_sonaar::getField('footer_playlist_autoplay',get_queried_object_id()) == "null" )? (bool) false : (int) Iron_sonaar::getField('footer_playlist_autoplay',get_queried_object_id()),
					'footer_podcast_autoplay' =>  ( Iron_sonaar::getField('footer_podcast_autoplay', get_queried_object_id()) == "" || Iron_sonaar::getField('footer_podcast_autoplay', get_queried_object_id()) == "null" )? (bool) false : (int) Iron_sonaar::getField('footer_podcast_autoplay', get_queried_object_id()),
					'podcast_color_base' => ( function_exists('get_ironMusic_option') )? get_ironMusic_option('podcast_player_timeline_color', '_iron_music_podcast_player_options') : '',
					'podcast_color_progress' => ( function_exists('get_ironMusic_option') )? get_ironMusic_option('podcast_player_progress_color', '_iron_music_podcast_player_options') : '',
					'podcast_hide_duration' => (bool)( function_exists('get_ironMusic_option') )? get_ironMusic_option('podcast_label_duration', '_iron_music_podcast_player_options') : '',
					'podcast_hide_category' => (bool)( function_exists('get_ironMusic_option') )? get_ironMusic_option('podcast_label_category', '_iron_music_podcast_player_options') : '',
					'podcast_skip_button' => (bool) ( function_exists('get_ironMusic_option') )? get_ironMusic_option('podcast_skip_button', '_iron_music_podcast_player_options') : false,
					'podcast_speed_rate_button' => (bool) ( function_exists('get_ironMusic_option') )? get_ironMusic_option('podcast_speed_rate_button', '_iron_music_podcast_player_options') : false,
					'artist_prefix' => translateString('tr_by')
				),
				'wp_admin_bar' => ( is_admin_bar_showing() )? true : false,
				'site_url'=> esc_url( home_url('/') ),
				'site_name'=> esc_attr( get_bloginfo('name') ),
				'logo' => array(
					'enable'=> (bool) Iron_sonaar::getOption('use_logo', null , 1),
					'dark'=> array(
						'url' => Iron_sonaar::getOption('header_logo', null, get_template_directory_uri().'/images/sonaar-logo-black@1x.png'),
						'url_retina' => Iron_sonaar::getOption('retina_header_logo', null, get_template_directory_uri().'/images/sonaar-logo-black@2x.png'),
					),
					'light' => array(
						'url' => Iron_sonaar::getOption('header_alternative_logo'),
						'url_retina' => Iron_sonaar::getOption('retina_header_alternative_logo'),
					),
					'responsive' => array(
						'url' => Iron_sonaar::getOption('logo-responsive-menu'),
					),
					'logo_select' => Iron_sonaar::getOption('header_logo_select', null, 'dark'),
					'light_responsive'=> (bool) Iron_sonaar::getOption('use_alternative_logo_on_mobile'),
					'page_logo_select'=> selectPageLogo( (!is_archive() || ( function_exists('is_shop') && is_shop() ) )?$post_id : get_queried_object() ),
					'page_logo_select_elementor'=> ( Iron_sonaar::getField('page_logo_select_elementor', $post_id ) !== 'null' && Iron_sonaar::getField('page_logo_select_elementor', $post_id ) !== '') ? Iron_sonaar::getField('page_logo_select_elementor', $post_id ) : false,
					'logo_mini_url'=> Iron_sonaar::getOption('classic_menu_header_logo_mini'),
					'logo_align'=> Iron_sonaar::getOption('classic_menu_logo_align', null, 'pull-left'),
					'logo_height'=> array(//Used to applied padding top on #wrapper
						'light' => logoHeight(Iron_sonaar::getOption('header_alternative_logo')),
						'dark' => logoHeight(Iron_sonaar::getOption('header_logo')),
					),
				),
				'social' => Iron_sonaar::getOption('custom_social_actions_checkbox', null, null),
				'social_enabled' => Iron_sonaar::getOption('enable_share_icons', null, null),
				'look_and_feel' => array(
					'color_1' => Iron_sonaar::getOption('featured_color'),
					'color_2' => Iron_sonaar::getOption('primary_color_light'),
					'color_3' => Iron_sonaar::getOption('primary_color_dark'),
					'color_4' => Iron_sonaar::getOption('secondary_color_light'),
					'text_color_1' => Iron_sonaar::getOption('text_color_light'),
					'text_color_2' => Iron_sonaar::getOption('text_color_dark'),
					'body_background' => Iron_sonaar::getOption('body_background'),
					'classic_menu_typography' => Iron_sonaar::getOption('classic_menu_typography'),
				),
				'taxonomy' => array(
					'banner' => (bool)( is_archive() && get_field('banner_background_type', get_queried_object()) )?true:false,
				),
				'i18n' => array(
					'events' => array(
						'pagination' => array(
							'next' => esc_html__('Next Events','sonaar'),
							'prev' => esc_html__('Previous Events','sonaar')
						)
						),
					'no_events' => esc_html__("No events scheduled yet. Stay tuned!", 'sonaar')
				)
			)
		);
		if(Iron_sonaar::getOption('menu_type', null, 'push-menu') == 'classic-menu'){
			wp_enqueue_script('iron-classic-menu', get_template_directory_uri().'/classic-menu/js/classic.min.js', array('iron-main'), SR_MASTER_VERSION, true );
		}
		

		if ( Iron_sonaar::getOption('facebook_appid') != '' ) {
			wp_add_inline_script('iron-main', 'window.fbAsyncInit = function() {
		    FB.init({
			      appId      : "' . Iron_sonaar::getOption('facebook_appid') . '",
			      xfbml      : true,
			      version    :"v2.5"
			    });
			  };

			  (function(d, s, id){
			     var js, fjs = d.getElementsByTagName(s)[0];
			     if (d.getElementById(id)) {return;}
			     js = d.createElement(s); js.id = id;
			     js.src = "//connect.facebook.net/en_US/sdk.js";
			     fjs.parentNode.insertBefore(js, fjs);
			   }(document, "script", "facebook-jssdk"));'
	   		);
		}
	}

	/*
	 * Enqueue Theme Admin Scripts
	 */

	public static function enqueueAdminScripts() {
			wp_enqueue_script( 'rome-datepicker', get_template_directory_uri() . '/js/rome-datepicker/dist/rome.min.js', array('jquery'), '1.0.0', true );
			wp_enqueue_style( 'rome-datepicker', get_template_directory_uri() . '/js/rome-datepicker/dist/rome.min.css' );
	}


	public static function metadataIcons () {
		if ( function_exists( 'wp_site_icon' ) && has_site_icon() ) {
			wp_site_icon();
		}else{
			$output = array();


			$output[] = '<link rel="shortcut icon" type="image/x-icon" href="' . esc_url( Iron_sonaar::getOption('meta_favicon', null, get_template_directory_uri().'/images/icons/favicon.ico') ) . '">';
			$output[] = '<link rel="apple-touch-icon-precomposed" href="' . esc_url( Iron_sonaar::getOption('meta_apple_touch_icon', null, get_template_directory_uri().'/images/icons/apple-touch-icon-57x57-precomposed.png') ) . '">';
			$output[] = '<link rel="apple-touch-icon-precomposed" sizes="72x72" href="' . esc_url( Iron_sonaar::getOption('meta_apple_touch_icon_72x72', null, get_template_directory_uri().'/images/icons/apple-touch-icon-72x72-precomposed.png') ) . '">';
			$output[] = '<link rel="apple-touch-icon-precomposed" sizes="114x114" href="' . esc_url( Iron_sonaar::getOption('meta_apple_touch_icon_114x114', null, get_template_directory_uri().'/images/icons/apple-touch-icon-114x114-precomposed.png') ) . '">';
			$output[] = '<link rel="apple-touch-icon-precomposed" sizes="144x144" href="' . esc_url( Iron_sonaar::getOption('meta_apple_touch_icon_144x144', null, get_template_directory_uri().'/images/icons/apple-touch-icon-144x144-precomposed.png') ) . '">';

			if ( ! empty($output) )
				echo wp_kses_post( ( "\n\t" . implode("\n\t", $output) ) );
		}
	}

	public static function uploadMimes ( $existing_mimes=array() ) {
	    // add the file extension to the array
	    $existing_mimes['ico'] = 'image/x-icon';
	    return $existing_mimes;
	}

	public static function checkMemory() {
		$memory_limit = Iron_sonaar_Setup::return_bytes(ini_get('memory_limit'));
		if ($memory_limit < (32 * 1024 * 1024)) {
			get_template_part('parts/notices/requirements');   
		}
	}

	/**
	* Converts shorthand memory notation value to bytes
	* From http://php.net/manual/en/function.ini-get.php
	*
	* @param $val Memory size shorthand notation string
	*/
	private static function return_bytes($val) {
		$val = trim($val);
		$last = strtolower($val[strlen($val)-1]);
		$val = substr($val, 0, -1);
		switch($last) {
			// The 'G' modifier is available since PHP 5.1.0
			case 'g':
				$val *= 1024;
			case 'm':
				$val *= 1024;
			case 'k':
				$val *= 1024;
		}
		return $val;
	}

	/**
	 * Save custom settings related to Theme Options
	 *
	 * When the post and page is updated, everything that is tied to it is saved also.
	 * This includes theme settings.
	 *
	 * @see wp_update_post()
	 *
	 * @param int $post_id Post ID.
	 */
	public static function savePost ( $post_id ) {
		global $wpdb;

		if ( $post = $wpdb->get_row($wpdb->prepare("SELECT p.*, pm.meta_value AS page_template FROM $wpdb->posts AS p INNER JOIN $wpdb->postmeta AS pm ON p.ID = pm.post_id WHERE p.ID = %d AND pm.meta_key = '_wp_page_template'", $post_id)) )
		{
			if ( 'page' == $post->post_type)
			{
				switch ( $post->page_template ) {
					case 'front-page.php':
					case 'page-front.php':
					case 'page-home.php':
						update_option('show_on_front', 'page');
						update_option('page_on_front', absint($post_id));
						break;

					case 'home.php':
					case 'index.php':
					case 'page-blog.php':
					case 'archive-post.php':
						update_option('show_on_front', 'page');
						update_option('page_for_posts', absint($post_id));
						break;

					case 'archive-album.php':
						iron_sonaar_set_option('page_for_albums', absint($post_id));
						break;

					case 'archive-event.php':
						iron_sonaar_set_option('page_for_events', absint($post_id));
						break;

					case 'archive-video.php':
						iron_sonaar_set_option('page_for_videos', absint($post_id));
						break;

					case 'archive-photo.php':
						iron_sonaar_set_option('page_for_photos', absint($post_id));
						break;

					default:

						if($post->post_name == 'home') {
							update_option('show_on_front', 'page');
							update_option('page_on_front', absint($post_id));
						}else{

							if ( Iron_sonaar::getOption('page_for_albums') == $post_id ) {
								iron_sonaar_reset_option('page_for_albums');
							}
							if ( Iron_sonaar::getOption('page_for_events') == $post_id ) {
								iron_sonaar_reset_option('page_for_events');
							}
							if ( Iron_sonaar::getOption('page_for_videos') == $post_id ) {
								iron_sonaar_reset_option('page_for_videos');
							}
							if ( Iron_sonaar::getOption('page_for_photos') == $post_id ) {
								iron_sonaar_reset_option('page_for_photos');
							}

							if ( get_option('page_on_front') === 0 && get_option('page_for_posts') === 0 ) {
								update_option('show_on_front', 'posts');
							}
						}
						break;
				}
			}
		}
	}


	/**
	 * Creates a nicely formatted and more specific title element text for output
	 * in head of document, based on current view.
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep Optional separator.
	 * @return string The filtered title.
	 */
	public static function wpTitle ( $title, $sep, $seplocation ) {
		global $paged, $page;

		if ( is_feed() )
			return $title;

		if ( is_post_type_archive() )
		{
			$post_type_obj = get_queried_object();

			$title = $post_type_obj->labels->name;

			$prefix = '';
			if ( !empty($title) )
				$prefix = " $sep ";

			$t_sep = '%WP_TITILE_SEP%'; // Temporary separator, for accurate flipping, if necessary

			// Determines position of the separator and direction of the breadcrumb
			if ( 'right' == $seplocation ) { // sep on right, so reverse the order
				$title_array = explode( $t_sep, $title );
				$title_array = array_reverse( $title_array );
				$title = implode( " $sep ", $title_array ) . $prefix;
			} else {
				$title_array = explode( $t_sep, $title );
				$title = $prefix . implode( " $sep ", $title_array );
			}
		}


		// Add a page number if necessary.
		if ( $paged >= 2 || $page >= 2 )
			$title = "$title $sep " . sprintf( esc_html__('Page %s', 'sonaar'), max($paged, $page) );

		return $title;
	}



	/**
	 * Append archive template to stack of taxonomy templates.
	 *
	 * If no taxonomy templates can be located, WordPress
	 * falls back to archive.php, though it should try
	 * archive-{$post_type}.php before.
	 *
	 * @see get_taxonomy_template(), get_archive_template()
	 */
	public static function archiveTemplateInclude ( $templates ) {
		$term = get_queried_object();
		$post_types = array_filter( (array) get_query_var( 'post_type' ) );

		if ( empty($post_types) ) {
			$taxonomy = get_taxonomy( $term->taxonomy );

			$post_types = $taxonomy->object_type;

			$templates = array();

			if ( count( $post_types ) == 1 ) {
				$post_type = reset( $post_types );
				$templates[] = "archive-{$post_type}.php";
			}
		}

		return locate_template( $templates );
	}



	private static function getLanguageCode(){
		return substr(get_bloginfo('language'), 0, 2);
	}

	/*
	 * GoogleFont
	*/
	private static function slugFontsUrl() {
		$fonts_url = '';

		/* Translators: If there are characters in your language that are not
		* supported, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$josefin = _x( 'on', 'Josefin font: on or off', 'sonaar' );
		$open_sans = _x( 'on', 'Open Sans font: on or off', 'sonaar' );
		if ( 'off' !== $josefin || 'off' !== $open_sans || 'off' !== $karla ) {
			$font_families = array();

			if ( 'off' !== $josefin ) {
				$font_families[] = 'Josefin Sans:400,600,700';
			}

			if ( 'off' !== $open_sans ) {
				$font_families[] = 'Open Sans:300,300italic,400,600,600italic,700';
			}

			$query_args = array(
				'family' => urlencode( implode( '|', $font_families ) ),
				'subset' => urlencode( 'latin,latin-ext' ),
			);

			$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
		}

		return esc_url_raw( $fonts_url );
	}

	public static function fetch_Oembed( $oembedURL ){
		$oembedURL = $_POST['oembedURL'];
		wp_die( wp_oembed_get( $oembedURL ));
	}



	public static function check_for_update($checked_data) {
		global $wp_version;

		if ( empty( $checked_data->checked ))
			return $checked_data;
		
		$sonaar_licence = get_option('sonaar_licence');
		if ( $sonaar_licence == 'noLicense' || $sonaar_licence == '') {
			return $checked_data;
		}
		
		//$api_url = 'https://sonaar.io/api/';
		$api_url = 'https://sonaar.io/wp-json/wp/v2/sonaar-api/version-check/';
		$theme_base = 'sonaar';

		$request = array(
			'slug' => $theme_base,
			'version' => @$checked_data->checked[$theme_base]
		);

		$send_for_check = array(
								'body' => array(
												'update_action' => 'theme_update',
												'request' 		=> $request,
												'licence' 		=>  $sonaar_licence,
												'siteurl' 		=> $_SERVER['SERVER_NAME']
											),
								'user-agent' => 'SonaarTheme/' . SR_MASTER_VERSION . ' WordPress/' . $wp_version . '; ' . get_bloginfo('url')
							);

		$raw_response = wp_remote_post($api_url, $send_for_check);


		if (!is_wp_error($raw_response) && ($raw_response['response']['code'] == 200))
			$response = json_decode( $raw_response['body'], true);

		// Feed the update data into WP updater
		if (!empty($response))
			$checked_data->response[$theme_base] = $response;

		return $checked_data;
	}


	public static function _filter_fw_ext_backups_db_restore_keep_options($options, $is_full) {
		if (!$is_full) {
	        $options[ 'sonaar_licence' ] = true;
	    }

	    return $options;
	}


}