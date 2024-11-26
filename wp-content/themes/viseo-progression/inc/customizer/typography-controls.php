<?php
/**
 * progression Theme Customizer
 *
 * @package progression
 */

function adding_progression_google_fonts_customizer( $wp_customize ) {
    
    $wp_customize->add_section( 'progression-studios-navigation-font', array(
    	'title'          => esc_html__( 'Navigation', 'viseo-progression' ),
    	'panel'          => 'progression_studios_header_panel', // Not typically needed.
        'priority'       => 50,
    	) 
    );
    
    $wp_customize->add_section( 'progression-studios-sub-navigation-font', array(
    	'title'          => esc_html__( 'Sub-Navigation', 'viseo-progression' ),
    	'panel'          => 'progression_studios_header_panel', // Not typically needed.
        'priority'       => 50,
    	) 
    );
    
    $wp_customize->add_section( 'progression-studios-nav-btn-font', array(
        'title'       => esc_html__('Button in Navigation', 'viseo-progression'),
    	'panel'          => 'progression_studios_header_panel', // Not typically needed.
        'priority'       => 50,
    	) 
    );

    
    $wp_customize->add_section( 'progression-studios-top-header-font', array(
    	'title'          => esc_html__( 'Top Header Options', 'viseo-progression' ),
    	'panel'          => 'progression_studios_header_panel', // Not typically needed.
        'priority'       => 50,
    	) 
    );
    
    $wp_customize->add_section( 'progression-studios-body-font', array(
    	'title'          => esc_html__( 'Body Main', 'viseo-progression' ),
    	'panel'          => 'progression_studios_body_panel', // Not typically needed.
        'priority'       => 50,
    	) 
    );
    
    
    $wp_customize->add_section( 'progression-studios-page-title', array(
    	'title'          => esc_html__( 'Page Title', 'viseo-progression' ),
    	'panel'          => 'progression_studios_body_panel', // Not typically needed.
        'priority'       => 50,
    	) 
    );
    
    $wp_customize->add_section( 'progression-studios-widgets-font', array(
    	'title'          => esc_html__( 'Footer Main', 'viseo-progression' ),
    	'panel'          => 'progression_studios_footer_panel', // Not typically needed.
        'priority'       => 50,
    	) 
    );
	
    $wp_customize->add_section( 'progression-studios-copyright-font', array(
    	'title'          => esc_html__( 'Footer Copyright', 'viseo-progression' ),
    	'panel'          => 'progression_studios_footer_panel', // Not typically needed.
        'priority'       => 50,
    	) 
    );

    
    
    $wp_customize->add_section( 'progression-studios-footer-nav-font', array(
    	'title'          => esc_html__( 'Footer Navigation', 'viseo-progression' ),
    	'panel'          => 'progression_studios_footer_panel', // Not typically needed.
        'priority'       => 50,
    	) 
    );
    
    $wp_customize->add_section( 'progression-studios-default-headings', array(
    	'title'          => esc_html__( 'H1-H6 Headings', 'viseo-progression' ),
    	'panel'          => 'progression_studios_body_panel', // Not typically needed.
        'priority'       => 50,
    	) 
    );
    
    $wp_customize->add_section( 'progression-studios-sidebar-headings', array(
    	'title'          => esc_html__( 'Sidebar Options', 'viseo-progression' ),
    	'panel'          => 'progression_studios_body_panel', // Not typically needed.
        'priority'       => 50,
    	) 
    );
    

    
    $wp_customize->add_section( 'progression-studios-button-typography', array(
    	'title'          => esc_html__( 'Button Styles', 'viseo-progression' ),
    	'panel'          => 'progression_studios_body_panel', // Not typically needed.
        'priority'       => 50,
    	) 
    );
    
    
    $wp_customize->add_section( 'progression-studios-blog-headings', array(
    	'title'          => esc_html__( 'Default Layout Styles', 'viseo-progression' ),
    	'panel'          => 'progression_studios_blog_panel', // Not typically needed.
        'priority'       => 50,
    	) 
    );
    
    
    $wp_customize->add_section( 'progression-studios-blog-post-title', array(
    	'title'          => esc_html__( 'Blog Post Page Title', 'viseo-progression' ),
    	'panel'          => 'progression_studios_blog_panel', // Not typically needed.
        'priority'       => 50,
    	) 
    );
    
    
    $wp_customize->add_section( 'progression-studios-blog-post-options', array(
    	'title'          => esc_html__( 'Blog Post Options', 'viseo-progression' ),
    	'panel'          => 'progression_studios_blog_panel', // Not typically needed.
        'priority'       => 50,
    	) 
    );
    
    
    
    
    $wp_customize->add_section( 'progression-studios-blog-post-styles', array(
    	'title'          => esc_html__( 'Blog Post Styles', 'viseo-progression' ),
    	'panel'          => 'progression_studios_blog_panel', // Not typically needed.
        'priority'       => 50,
    	) 
    );
    

    $wp_customize->add_section( 'progression-studios-shop-index-styles', array(
    	'title'          => esc_html__( 'Shop Index Styles', 'viseo-progression' ),
    	'panel'          => 'woocommerce', // Not typically needed.
        'priority'       => 50,
    	) 
    );
    
    
    $wp_customize->add_section( 'progression-studios-shop-headings', array(
    	'title'          => esc_html__( 'Shop Post Styles', 'viseo-progression' ),
    	'panel'          => 'progression_studios_shop_panel', // Not typically needed.
        'priority'       => 50,
    	) 
    );

}
add_action( 'customize_register', 'adding_progression_google_fonts_customizer' );

/**
 * How to add a font control to your tab
 *
 * @see  parse_font_control_array() - in class EGF_Register_Options
 *       in includes/class-egf-register-options.php to see the full
 *       properties you can add for each font control.
 *
 *
 * @param   array $controls - Existing Controls.
 * @return  array $controls - Controls with controls added/removed.
 *
 * @since 1.0
 * @version 1.0
 *
 */
function progression_studios_add_control_to_tab( $controls ) {

    /**
     * 1. Removing default styles because we add-in our own
     */
    unset( $controls['tt_default_body'] );
    unset( $controls['tt_default_heading_1'] );
    unset( $controls['tt_default_heading_2'] );
    unset( $controls['tt_default_heading_3'] );
    unset( $controls['tt_default_heading_4'] );
    unset( $controls['tt_default_heading_5'] );
    unset( $controls['tt_default_heading_6'] );
	 
	 
    /**
     * 2. Now custom examples that are theme specific
     */
	 
	 
	 
    $controls['progression_studios_body_font_family'] = array(
        'name'       => 'progression_studios_body_font_family',
 		 'type'        => 'font',
        'title'      =>  esc_html__('Body Font', 'viseo-progression'),
        'tab'        => 'progression-studios-body-font',
        'properties' => array( 'selector'   => 'body,  body input, body textarea, select' ),
 		 
    );
	 
    $controls['progression_studios_top_header_default'] = array(
        'name'       => 'progression_studios_top_header_default',
 		 'type'        => 'font',
        'title'      =>  esc_html__('Top Header Font', 'viseo-progression'),
        'tab'        => 'progression-studios-top-header-font',
        'properties' => array( 'selector'   => '#viseo-progression-header-top' ),
 		 
    );
	 
	 
    $controls['progression_studios_nav_font_family'] = array(
        'name'       => 'progression_studios_nav_font_family',
 		 'type'        => 'font',
        'title'      =>  esc_html__('Navigation Font Family', 'viseo-progression'),
        'tab'        => 'progression-studios-navigation-font',
        'properties' => array( 'selector'   => 'nav#site-navigation, nav#progression-studios-right-navigation' ),

    );
	 
	 
    $controls['progression_studios_sub_nav_font_family'] = array(
        'name'       => 'progression_studios_sub_nav_font_family',
 	'type'        => 'font',
        'title'      =>  esc_html__('Sub-Navigation Font Family', 'viseo-progression'),
        'tab'        => 'progression-studios-sub-navigation-font',
        'properties' => array( 'selector'   => '.sf-menu ul, #main-nav-mobile' ),
 	
    );
	 
	 
    $controls['progression_studios_sub_nav_megamenu'] = array(
        'name'       => 'progression_studios_sub_nav_megamenu',
 	'type'        => 'font',
        'title'      =>  esc_html__('Mega Menu Heading', 'viseo-progression'),
        'tab'        => 'progression-studios-sub-navigation-font',
        'properties' => array( 'selector'   => 'ul.mobile-menu-pro .sf-mega h2.mega-menu-heading a, ul.mobile-menu-pro .sf-mega h2.mega-menu-heading, .sf-mega h2.mega-menu-heading, body #progression-sticky-header header .sf-mega h2.mega-menu-heading a, body header .sf-mega h2.mega-menu-heading a' ),

    );
	 
	 
    $controls['progression_studios_page_title_font_family'] = array(
        'name'       => 'progression_studios_page_title_font_family',
 		 'type'        => 'font',
        'title'      =>  esc_html__('Page Title Font', 'viseo-progression'),
        'tab'        => 'progression-studios-page-title',
        'properties' => array( 'selector'   => '#page-title-pro h1' ),
 		 
    );
	 
	 
    $controls['progression_studios_page_sub_title_font_family'] = array(
        'name'       => 'progression_studios_page_sub_title_font_family',
 		 'type'        => 'font',
        'title'      =>  esc_html__('Page Sub-Title Font', 'viseo-progression'),
        'tab'        => 'progression-studios-page-title',
        'properties' => array( 'selector'   => '#page-title-pro h4' ),
 		 
    );
	 
	 
	 
    $controls['progression_studios_heading_h1'] = array(
        'name'       => 'progression_studios_heading_h1',
 		 'type'        => 'font',
        'title'      =>  esc_html__('Heading 1', 'viseo-progression'),
        'tab'        => 'progression-studios-default-headings',
        'properties' => array( 'selector'   => 'h1' ),
 		 
    );
	
    $controls['progression_studios_heading_h2'] = array(
        'name'       => 'progression_studios_heading_h2',
 		 'type'        => 'font',
        'title'      =>  esc_html__('Heading 2', 'viseo-progression'),
        'tab'        => 'progression-studios-default-headings',
        'properties' => array( 'selector'   => 'h2' ),
 		 
    );
	
    $controls['progression_studios_heading_h3'] = array(
        'name'       => 'progression_studios_heading_h3',
 		 'type'        => 'font',
        'title'      =>  esc_html__('Heading 3', 'viseo-progression'),
        'tab'        => 'progression-studios-default-headings',
        'properties' => array( 'selector'   => 'h3' ),
 		 
    );
	
    $controls['progression_studios_heading_h4'] = array(
        'name'       => 'progression_studios_heading_h4',
 		 'type'        => 'font',
        'title'      =>  esc_html__('Heading 4', 'viseo-progression'),
        'tab'        => 'progression-studios-default-headings',
        'properties' => array( 'selector'   => 'h4' ),
 		 
    );
	 
    $controls['progression_studios_heading_h5'] = array(
        'name'       => 'progression_studios_heading_h5',
 		 'type'        => 'font',
        'title'      =>  esc_html__('Heading 5', 'viseo-progression'),
        'tab'        => 'progression-studios-default-headings',
        'properties' => array( 'selector'   => 'h5' ),
 		 
    );
	 
    $controls['progression_studios_heading_h6'] = array(
        'name'       => 'progression_studios_heading_h6',
 		 'type'        => 'font',
        'title'      =>  esc_html__('Heading 6', 'viseo-progression'),
        'tab'        => 'progression-studios-default-headings',
        'properties' => array( 'selector'   => 'h6' ),
 		 
    );
	 
	 
	 
    $controls['progression_studios_widget_font_family'] = array(
        'name'       => 'progression_studios_widget_font_family',
 		 'type'        => 'font',
        'title'      =>  esc_html__('Footer Main Font', 'viseo-progression'),
        'tab'        => 'progression-studios-widgets-font',
        'properties' => array( 'selector'   => 'footer#site-footer' ),
 		 
    );
	 
    $controls['progression_studios_widget_font_link'] = array(
        'name'       => 'progression_studios_widget_font_link',
 		 'type'        => 'font',
        'title'      =>  esc_html__('Footer Link', 'viseo-progression'),
        'tab'        => 'progression-studios-widgets-font',
        'properties' => array( 'selector'   => 'footer#site-footer a' ),
 		 
    );
	 
	 
    $controls['progression_studios_widget_font_link_hover'] = array(
        'name'       => 'progression_studios_widget_font_link_hover',
 		 'type'        => 'font',
        'title'      =>  esc_html__('Footer Link Hover', 'viseo-progression'),
        'tab'        => 'progression-studios-widgets-font',
        'properties' => array( 'selector'   => 'footer#site-footer a:hover' ),
 		 
    );
	 
	 
    $controls['progression_studios_copyright_font_family'] = array(
        'name'       => 'progression_studios_copyright_font_family',
 		 'type'        => 'font',
        'title'      =>  esc_html__('Copyright Font', 'viseo-progression'),
        'tab'        => 'progression-studios-copyright-font',
        'properties' => array( 'selector'   => '#copyright-text' ),
 		 
    );
	 
	 
    $controls['progression_studios_footer_nav_link'] = array(
        'name'       => 'progression_studios_footer_nav_link',
 		 'type'        => 'font',
        'title'      =>  esc_html__('Footer Navigation', 'viseo-progression'),
        'tab'        => 'progression-studios-footer-nav-font',
        'properties' => array( 'selector'   => 'footer#site-footer #progression-studios-copyright ul.progression-studios-footer-nav-container-class a, footer#site-footer ul.progression-studios-footer-nav-container-class a' ),
 		 
    );
	 
    $controls['progression_studios_footer_nav_link_hover'] = array(
        'name'       => 'progression_studios_footer_nav_link_hover',
 		 'type'        => 'font',
        'title'      =>  esc_html__('Footer Navigation Hover', 'viseo-progression'),
        'tab'        => 'progression-studios-footer-nav-font',
        'properties' => array( 'selector'   => 'footer#site-footer #progression-studios-copyright ul.progression-studios-footer-nav-container-class li.current-menu-item a, footer#site-footer  #progression-studios-copyright ul.progression-studios-footer-nav-container-class a:hover, footer#site-footer ul.progression-studios-footer-nav-container-class li.current-menu-item a, footer#site-footer ul.progression-studios-footer-nav-container-class a:hover' ),
 		 
    );
	 
	 
    $controls['progression_studios_widget_font_heading'] = array(
        'name'       => 'progression_studios_widget_font_heading',
 		 'type'        => 'font',
        'title'      =>  esc_html__('Footer Widget Heading', 'viseo-progression'),
        'tab'        => 'progression-studios-widgets-font',
        'properties' => array( 'selector'   => 'footer#site-footer h4.widget-title' ),
 		 
    );
	 

	 
    $controls['progression_studios_button_font_family'] = array(
        'name'       => 'progression_studios_button_font_family',
 	'type'        => 'font',
        'title'      =>  esc_html__('Button Font Family', 'viseo-progression'),
        'tab'        => 'progression-studios-button-typography',
        'properties' => array( 'selector'   => '#boxed-layout-pro .woocommerce-checkout-payment input.button, #boxed-layout-pro button.button, #boxed-layout-pro a.button, #infinite-nav-pro a, .post-password-form input[type=submit], #respond input#submit, .wpcf7-form input.wpcf7-submit' ),
 	
    );
	 
	 
    $controls['progression_studios_blog_category_font'] = array(
        'name'       => 'progression_studios_blog_category_font',
 		 'type'        => 'font',
        'title'      =>  esc_html__('Category', 'viseo-progression'),
        'tab'        => 'progression-studios-blog-headings',
        'properties' => array( 'selector'   => '.overlay-blog-meta-category-list span, .blog-meta-category-list a, .blog-meta-category-list a:hover' ),
 		 
    );
	 
	 
    $controls['progression_studios_blog_title_font'] = array(
        'name'       => 'progression_studios_blog_title_font',
 		 'type'        => 'font',
        'title'      =>  esc_html__('Title', 'viseo-progression'),
        'tab'        => 'progression-studios-blog-headings',
        'properties' => array( 'selector'   => 'h2.overlay-progression-blog-title, h2.progression-blog-title' ),
 		 
    );
	 
	 
    $controls['progression_studios_blog_byline_font'] = array(
        'name'       => 'progression_studios_blog_byline_font',
 		 'type'        => 'font',
        'title'      =>  esc_html__('Byline and Date', 'viseo-progression'),
        'tab'        => 'progression-studios-blog-headings',
        'properties' => array( 'selector'   => '.progression-post-meta' ),
 		 
    );
	 
    $controls['progression_studios_blog_byline_link_font'] = array(
        'name'       => 'progression_studios_blog_byline_link_font',
 		 'type'        => 'font',
        'title'      =>  esc_html__('Byline Link', 'viseo-progression'),
        'tab'        => 'progression-studios-blog-headings',
        'properties' => array( 'selector'   => '.progression-post-meta a:hover, .progression-post-meta a' ),
 		 
    );
	 
	 
	 
	 
    $controls['progression_studios_blog_post_category'] = array(
        'name'       => 'progression_studios_blog_post_category',
 		 'type'        => 'font',
        'title'      =>  esc_html__('Post Category', 'viseo-progression'),
        'tab'        => 'progression-studios-blog-post-styles',
        'properties' => array( 'selector'   => '.single-blog-meta-category-list a, .single-blog-meta-category-list a:hover' ),
 		 
    );
	 
    $controls['progression_studios_blog_post_title'] = array(
        'name'       => 'progression_studios_blog_post_title',
 		 'type'        => 'font',
        'title'      =>  esc_html__('Post Title', 'viseo-progression'),
        'tab'        => 'progression-studios-blog-post-styles',
        'properties' => array( 'selector'   => 'h1.blog-page-title' ),
 		 
    );
	 
    $controls['progression_studios_blog_post_meta'] = array(
        'name'       => 'progression_studios_blog_post_meta',
 		 'type'        => 'font',
        'title'      =>  esc_html__('Post Meta', 'viseo-progression'),
        'tab'        => 'progression-studios-blog-post-styles',
        'properties' => array( 'selector'   => '.single-progression-post-meta, .single-progression-post-meta a, .single-progression-post-meta a:hover' ),
 		 
    );
	 
	 
    $controls['progression_studios_blog_post_view_count'] = array(
        'name'       => 'progression_studios_blog_post_view_count',
 		 'type'        => 'font',
        'title'      =>  esc_html__('Post View/Comment Count', 'viseo-progression'),
        'tab'        => 'progression-studios-blog-post-styles',
        'properties' => array( 'selector'   => '.blog-single-comments-viewcount, .blog-single-comments-viewcount a, .blog-single-comments-viewcount a:hover' ),
 		 
    );
	 
	 
	 
    $controls['progression_studios_shop_index_heading'] = array(
        'name'       => 'progression_studios_shop_index_heading',
 		 'type'        => 'font',
        'title'      =>  esc_html__('Shop Index Heading', 'viseo-progression'),
        'tab'        => 'progression-studios-shop-headings',
        'properties' => array( 'selector'   => 'ul.products li.product .progression-studios-shop-index-content h2.woocommerce-loop-product__title,  ul.products li.product .progression-studios-shop-index-content h2.woocommerce-loop-category__title' ),
 		 
    );
 
 	
    $controls['progression_studios_shop_index_price'] = array(
        'name'       => 'progression_studios_shop_index_price',
 		 'type'        => 'font',
        'title'      =>  esc_html__('Shop Index Price', 'viseo-progression'),
        'tab'        => 'progression-studios-shop-headings',
        'properties' => array( 'selector'   => 'ul.products li.product .progression-studios-shop-index-content span.price del span.woocommerce-Price-amount, ul.products li.product .progression-studios-shop-index-content span.price ins span.woocommerce-Price-amount, ul.products li.product .progression-studios-shop-index-content span.price span.woocommerce-Price-amount' ),
 		 
    );
	 
    $controls['progression_studios_shop_post_heading'] = array(
        'name'       => 'progression_studios_shop_post_heading',
 		 'type'        => 'font',
        'title'      =>  esc_html__('Shop Post Heading', 'viseo-progression'),
        'tab'        => 'progression-studios-shop-headings',
        'properties' => array( 'selector'   => '.woocommerce-shop-single h1' ),
 		 
    );
	 
    $controls['progression_studios_shop_post_price'] = array(
        'name'       => 'progression_studios_shop_post_price',
 		 'type'        => 'font',
        'title'      =>  esc_html__('Shop Post Price', 'viseo-progression'),
        'tab'        => 'progression-studios-shop-headings',
        'properties' => array( 'selector'   => '.woocommerce-shop-single p.price span.woocommerce-Price-amount' ),
 		 
    );
	 
	 
	 
    $controls['progression_studios_sidebar_default'] = array(
        'name'       => 'progression_studios_sidebar_default',
 		 'type'        => 'font',
        'title'      =>  esc_html__('Sidebar Default Text', 'viseo-progression'),
        'tab'        => 'progression-studios-sidebar-headings',
        'properties' => array( 'selector'   => '.sidebar' ),
 		 
    );
	 
	 
    $controls['progression_studios_sidebar_heading'] = array(
        'name'       => 'progression_studios_sidebar_heading',
 		 'type'        => 'font',
        'title'      =>  esc_html__('Sidebar Heading', 'viseo-progression'),
        'tab'        => 'progression-studios-sidebar-headings',
        'properties' => array( 'selector'   => '.sidebar h4.widget-title' ),
 		 
    );
	 
    $controls['progression_studios_sidebar_link'] = array(
        'name'       => 'progression_studios_sidebar_link',
 		 'type'        => 'font',
        'title'      =>  esc_html__('Sidebar Default Link', 'viseo-progression'),
        'tab'        => 'progression-studios-sidebar-headings',
        'properties' => array( 'selector'   => '.sidebar a' ),
 		 
    );
	 
    $controls['progression_studios_sidebar_link_hover'] = array(
        'name'       => 'progression_studios_sidebar_link_hover',
 		 'type'        => 'font',
        'title'      =>  esc_html__('Sidebar Link Hover', 'viseo-progression'),
        'tab'        => 'progression-studios-sidebar-headings',
        'properties' => array( 'selector'   => '.sidebar ul li.current-cat, .sidebar ul li.current-cat a, .sidebar a:hover' ),
 		 
    );
	 
	 
	// Return the controls.
    return $controls;
}
add_filter( 'tt_font_get_option_parameters', 'progression_studios_add_control_to_tab' );