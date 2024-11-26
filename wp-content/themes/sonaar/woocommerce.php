<?php get_header();


add_filter( 'woocommerce_show_page_title' , 'woo_hide_page_title' );
/**
 * woo_hide_page_title
 *
 * Removes the "shop" title on the main shop page
 *
 * @access      public
 * @since       1.0 
 * @return      void
*/
function woo_hide_page_title() {
	return false;
}


if( function_exists('is_shop') && is_shop() ){
	$post_id = wc_get_page_id('shop');
}else{
	$post_id = $post->ID;
}
/**
 * Setup Dynamic Sidebar
 */

list( $iron_sonaar_has_sidebar, $iron_sonaar_sidebar_position, $iron_sonaar_sidebar_area ) = Iron_sonaar::setupDynamicSidebar( $post_id );
?>
		<!-- container -->
<?php

$banner_background_type = Iron_sonaar::getField('banner_background_type', $post_id);
$banner_typeCSS = ($banner_background_type)? '' : 'no-banner' ;
if ($banner_background_type !== 'null' && $banner_background_type !== '') {
	if ( $banner_background_type=='image-background' && Iron_sonaar::getField('banner_image', $post_id) == '' ){
	} else {
		get_template_part( 'parts/page-banner', $post_id);
	}
}

?>


		<div class="container">
		<?php
		$iron_sonaar_boxed = true;
		/*$iron_sonaar_boxed = false;
		if(strpos( get_the_content($post_id) ,'vc_row') == false){
			$iron_sonaar_boxed = true;
		}*/

		if($iron_sonaar_has_sidebar || $iron_sonaar_boxed){ ?>
			<div class="boxed">
		<?php }
			$iron_sonaar_hide_page_title = Iron_sonaar::getField('hide_page_title', $post_id);
			if( empty( $iron_sonaar_hide_page_title ) ) { ?>
				<div class="page-title rellax <?php echo (Iron_sonaar::isPageTitleUppercase() == true) ? 'uppercase' : ''; ?>">
					<span class="heading-t"></span>
					<?php if(is_product_category()){ ?>
					<h1><?php woocommerce_page_title(); ?></h1>
					<?php } else{
					echo '<h1>' . get_the_title($post_id) . '</h1>';
					}
					Iron_sonaar::displayPageTitleDivider(); ?>
				</div>
			<?php }
			if ( $iron_sonaar_has_sidebar ) : ?>
				<div class="content__wrapper<?php if ( 'left' === $iron_sonaar_sidebar_position ) echo ' content--rev'; ?>">
					<article id="post-<?php the_ID(); ?>" <?php post_class('content__main sr_it-single-post' . $banner_typeCSS ); ?>>
			<?php else: ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class('sr_it-single-post'); ?>>
			<?php endif;?>

			<div class="entry">
				<?php 
				woocommerce_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'sonaar' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
			</div>

			<?php 

			if ( $iron_sonaar_has_sidebar ) : ?>
				</article>

				<aside id="sidebar" class="sr_it-content-side widget-area widget-area--<?php echo esc_attr( $iron_sonaar_sidebar_area ); ?>">
			<?php
				do_action('before_ironband_sidebar_dynamic_sidebar', 'page.php');

				dynamic_sidebar( $iron_sonaar_sidebar_area );

				do_action('after_ironband_sidebar_dynamic_sidebar', 'page.php');
?>
				</aside>
			</div>
<?php
		else:
?>
			</article>
<?php
		endif;
?>
	<?php
		if($iron_sonaar_has_sidebar || $iron_sonaar_boxed){
			?>
			</div>
			<?php
		}
		?>
		</div>

<?php

get_footer();

