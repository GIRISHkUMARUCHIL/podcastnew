<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product
?>


<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
	
	<div id="single-product-info-background">
		<div class="width-container-pro  <?php if ( get_theme_mod( 'progression_studios_shop_post_sidebar') == 'left') : ?> left-sidebar-pro<?php endif; ?>">
			<?php if ( get_theme_mod( 'progression_studios_shop_post_sidebar') == 'right' || get_theme_mod( 'progression_studios_shop_post_sidebar') == 'left') : ?><div id="main-container-pro"><?php endif; ?>
				
				
				<?php do_action( 'woocommerce_before_single_product' ); if ( post_password_required() ) { echo get_the_password_form(); return; } ?>

				<div class="woocommerce woocommerce-shop-single">
				
					<?php do_action( 'woocommerce_before_single_product_summary' ); ?>
					<div class="summary entry-summary"><?php do_action( 'woocommerce_single_product_summary' ); ?></div><!-- .summary -->
					<meta itemprop="url" content="<?php the_permalink(); ?>" />
				
				</div><!-- close .woocommerce .woocommerce-shop-single -->
				
				<?php if ( get_theme_mod( 'progression_studios_shop_post_sidebar') =='right' || get_theme_mod( 'progression_studios_shop_post_sidebar') =='left') : ?></div><!-- close #main-container-pro --><?php do_action( 'woocommerce_sidebar' ); ?><?php endif; ?>
			<div class="clearfix-pro"></div>
			</div><!-- close .width-container-pro -->
		</div><!-- close #single-product-info-background -->
		
		
		<div id="single-product-tabs-background">
	
			<div class="width-container-pro">
				<div class="woocommerce woocommerce-shop-single">

					<div id="woocomerce-tabs-container-progression-studios">
						<?php do_action( 'woocommerce_after_single_product_summary' ); ?>
					</div>
				</div><!-- close .woocommerce -->
			<div class="clearfix-pro"></div>
			</div><!-- close .width-container-pro -->
	
		</div><!-- close #single-product-tabs-background -->
</div><!-- #product-<?php the_ID(); ?> -->

<div class="width-container-pro">
<?php do_action( 'woocommerce_after_single_product' ); ?>
</div><!-- close .width-container-pro -->