<?php
/**
 * WooCommerce Functions
 *
 */

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {  add_theme_support( 'woocommerce' ); }

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

// Display 24 products per page. Goes in functions.php
add_filter( 'loop_shop_per_page', 'progression_studios_loop_shop_per_page', 20 );
function progression_studios_loop_shop_per_page( $cols ) {
	$progression_studios_shop_count = esc_attr( get_theme_mod('progression_studios_shop_posts_Page', '9') );
	
  // $cols contains the current number of products per page based on the value stored on Options -> Reading
  // Return the number of products you wanna show per page.
  $cols = $progression_studios_shop_count;
  return $cols;
}


// Change number or products per row to 3
add_filter('loop_shop_columns', 'progression_studios_loop_columns');
if (!function_exists('progression_studios_loop_columns')) {
	
	function progression_studios_loop_columns() {
		$col_count_progression = esc_attr( get_theme_mod('progression_studios_shop_columns', '3') );
		return $col_count_progression; // 3 products per row
	}
}


add_filter( 'woocommerce_output_related_products_args', 'progression_studios_related_products_args' );
  function progression_studios_related_products_args( $args ) {
	  $col_count_progression = esc_attr( get_theme_mod('progression_studios_shop_related_columns', '4') );
	$args['posts_per_page'] = $col_count_progression; // 4 related products
	$args['columns'] = $col_count_progression; // arranged in 2 columns
	return $args;
}


add_theme_support( 'wc-product-gallery-slider' );


/* Adjust order on WooCommerce Post Page (Summary and Rating) */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 8 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 6 );

