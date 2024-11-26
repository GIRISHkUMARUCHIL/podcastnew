<?php
/**
 * progression functions and definitions
 *
 * @package progression
 * @since progression 1.0
 */


if ( ! function_exists( 'progression_studios_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since progression 1.0
 */
	
function progression_studios_setup() {
	
	// Post Thumbnails
	add_theme_support( 'post-thumbnails' );
	
	add_image_size('progression-studios-blog-index', 800, 450, true);
	add_image_size('progression-studios-blog-background-cover', 800, 800, true);
	add_image_size('progression-studios-blog-post', 1400, 700, true);
	add_image_size('progression-studios-woocommerce-single', 600, 580, true);

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on pro, use a find and replace
	 * to change 'viseo-progression' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'viseo-progression', get_template_directory() . '/languages' );
	
	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio', 'quote', 'link', 'image' ) );

	
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	
	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'progression-studios-header-top-left' => esc_html__( 'Top Left Menu', 'viseo-progression' ),
		'progression-studios-header-top-right' => esc_html__( 'Top Right Menu', 'viseo-progression' ),
		'progression-studios-primary' => esc_html__( 'Primary Menu', 'viseo-progression' ),
		'progression-studios-primary-right-meu' => esc_html__( 'Primary Right Menu', 'viseo-progression' ),
		'progression-studios-mobile-menu' => esc_html__( 'Mobile Primary Menu', 'viseo-progression' ),
		'progression-studios-footer-menu' => esc_html__( 'Footer Menu', 'viseo-progression' ),
	) );
	
	

	

}
endif; // progression_studios_setup
add_action( 'after_setup_theme', 'progression_studios_setup' );






/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since pro 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = esc_attr( get_theme_mod('progression_studios_site_width', '1200') ); /* pixels */


/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since pro 1.0
 */
function progression_studios_widgets_init() {
	register_sidebar( array(
		'name' => esc_html__( 'Sidebar', 'viseo-progression' ),
		'description'   => esc_html__('Default sidebar', 'viseo-progression'),
		'id' => 'progression-studios-sidebar',
		'before_widget' => '<div id="%1$s" class="sidebar-item widget %2$s">',
		'after_widget' => '<div class="sidebar-divider-pro"></div></div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	
	register_sidebar( array(
		'name' => esc_html__( 'Shop Sidebar', 'viseo-progression' ),
		'description'   => esc_html__('Sidebar on shop pages', 'viseo-progression'),
		'id' => 'progression-studios-sidebar-shop',
		'before_widget' => '<div id="%1$s" class="sidebar-item widget %2$s">',
		'after_widget' => '<div class="sidebar-divider-pro"></div></div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	
	register_sidebar( array(
		'name' => esc_html__( 'Mobile/Tablet Sidebar', 'viseo-progression' ),
		'description'   => esc_html__('Mobile/Tablet sidebar', 'viseo-progression'),
		'id' => 'progression-studios-mobile-sidebar',
		'before_widget' => '<div id="%1$s" class="sidebar-item widget %2$s">',
		'after_widget' => '<div class="sidebar-divider-pro"></div></div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	
	register_sidebar( array(
		'name' => esc_html__( 'Header Top Left', 'viseo-progression' ),
		'description'   => esc_html__('Left widget area above the navigation', 'viseo-progression'),
		'id' => 'progression-studios-header-top-left',
		'before_widget' => '<div id="%1$s" class="header-top-item widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<span class="widget-title">',
		'after_title' => '</span>',
	) );
	
	register_sidebar( array(
		'name' => esc_html__( 'Header Top Right', 'viseo-progression' ),
		'description'   => esc_html__('Right widget area above the navigation', 'viseo-progression'),
		'id' => 'progression-studios-header-top-right',
		'before_widget' => '<div id="%1$s" class="header-top-item widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<span class="widget-title">',
		'after_title' => '</span>',
	) );
	
	register_sidebar( array(
		'name' => esc_html__( 'Post Widget Area Top', 'viseo-progression' ),
		'description' => esc_html__( 'Widget area at the top of posts', 'viseo-progression' ),
		'id' => 'progression-studios-post-widgets-top',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	
	register_sidebar( array(
		'name' => esc_html__( 'Post Widget Area Bottom', 'viseo-progression' ),
		'description' => esc_html__( 'Widget area at the bottom of posts', 'viseo-progression' ),
		'id' => 'progression-studios-post-widgets-bottom',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	
	register_sidebar( array(
		'name' => esc_html__( 'Footer Widgets Row 1', 'viseo-progression' ),
		'description' => esc_html__( 'First row of foooter widgets', 'viseo-progression' ),
		'id' => 'progression-studios-footer-widgets',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	
	register_sidebar( array(
		'name' => esc_html__( 'Footer Widgets Row 2', 'viseo-progression' ),
		'description' => esc_html__( 'Second row of footer widgets', 'viseo-progression' ),
		'id' => 'progression-studios-footer-widgets-second-row',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	
	
}
add_action( 'widgets_init', 'progression_studios_widgets_init' );




/**
 * Enqueue scripts and styles
 */
function progression_studios_scripts() {
	
	wp_enqueue_style( 'wp-mediaelement' );
	wp_enqueue_script( 'wp-mediaelement' );
	
	wp_enqueue_style( 'progression-style', get_stylesheet_uri());
	wp_enqueue_style( 'progression-google-fonts', progression_studios_fonts_url(), array( 'progression-style' ), '1.0.0' );
	wp_enqueue_script( 'progression-plugins', get_template_directory_uri() . '/js/plugins.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'progression-scripts', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), '20120206', true );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}
add_action( 'wp_enqueue_scripts', 'progression_studios_scripts' );



/**
 * Enqueue google fonts
 */
function progression_studios_fonts_url() {
    $progression_studios_font_url = '';

    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'viseo-progression' ) ) {
        $progression_studios_font_url = add_query_arg( 'family', urlencode( 'Fira Sans Condensed:300,400,500,700|Arimo:400,700|&subset=latin' ), "//fonts.googleapis.com/css" );
    }
	 
    return $progression_studios_font_url;
}


/* Demo Content Import */
function progression_studios_demo_import_files() {
  return array(
    array(
      'import_file_name'           => esc_html__( 'Demo Import', 'viseo-progression' ),
      'local_import_file'            => trailingslashit( get_template_directory() ) . '/demo/content.xml',
      'local_import_widget_file'     => trailingslashit( get_template_directory() ) . '/demo/widgets.json',
      'local_import_customizer_file' => trailingslashit( get_template_directory() ) . '/demo/theme_option.dat',
      'preview_url'                => 'https://viseo.progressionstudios.com',
    ),
  );
}
add_filter( 'pt-ocdi/import_files', 'progression_studios_demo_import_files' );

function progression_studios_demo_after_import_setup() {
	// Assign menus to their locations.
	$progession_studios_main_menu = get_term_by( 'name', 'Main Navigation', 'nav_menu' );
	$top_right_menu   = get_term_by('name', 'Main Right Navigation', 'nav_menu');
	$footer_menu   = get_term_by('name', 'Footer Navigation', 'nav_menu');

	set_theme_mod( 'nav_menu_locations', array(
			'progression-studios-primary' => $progession_studios_main_menu->term_id,
			'progression-studios-primary-right-meu' => $top_right_menu->term_id,
			'progression-studios-footer-menu' => $footer_menu->term_id,
		)
	);

	// Assign front page and posts page (blog page).
	$front_page_id = get_page_by_title( 'Home' );
	$blog_page_id  = get_page_by_title( 'Latest Posts' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
	update_option( 'page_for_posts', $blog_page_id->ID );

}
add_action( 'pt-ocdi/after_import', 'progression_studios_demo_after_import_setup' );

add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );



/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom Metabox Fields
 */
require get_template_directory() . '/inc/custom-meta.php';

/**
 * Theme Customizer
 */
require get_template_directory() . '/inc/default-customizer.php';

/**
 * JS Customizer Out
 */
require get_template_directory() . '/inc/js-customizer.php';

/**
 * Theme Customizer
 */
require get_template_directory() . '/inc/mega-menu/mega-menu-framework.php';


/**
 * Elementor Page Builder Functions
 */
require get_template_directory() . '/inc/elementor-functions.php';

/**
 * WooCommerce Functions
 */
if ( ! function_exists( 'woocommerce' ) ) require get_template_directory() . '/inc/woocommerce-functions.php';




/**
 * Load Plugin prohibitionation
 */
require get_template_directory() . '/inc/tgm-plugin-activation/plugin-activation.php';
