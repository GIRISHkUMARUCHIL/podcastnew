<?php get_header();
if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ):
	global $post;

	/**
	 * Setup Dynamic Sidebar
	 */

	list( $iron_sonaar_has_sidebar, $iron_sonaar_sidebar_position, $iron_sonaar_sidebar_area ) = Iron_sonaar::setupDynamicSidebar( $post->ID );

	if ( have_posts() ) :
		while ( have_posts() ) : the_post(); ?>
			<!-- container -->
	<?php

	$banner_background_type = Iron_sonaar::getField('banner_background_type', $post->ID);
	$banner_typeCSS = ($banner_background_type)? '' : 'no-banner' ;
	if ($banner_background_type !== 'null' && $banner_background_type !== '') {
		if ( $banner_background_type=='image-background' && Iron_sonaar::getField('banner_image', $post->ID) == '' ){
		} else {
			get_template_part('parts/page-banner');
		}
	}

	?>


			<div class="container">
			<?php
			$iron_sonaar_boxed = false;
			if(strpos( get_the_content($post->ID) ,'vc_row') == false){
				$iron_sonaar_boxed = true;
			}

			if($iron_sonaar_has_sidebar || $iron_sonaar_boxed){ ?>
				<div class="boxed">
			<?php }
				$iron_sonaar_hide_page_title = Iron_sonaar::getField('hide_page_title', $post->ID);
				if( empty( $iron_sonaar_hide_page_title ) ) { ?>
					<div class="page-title rellax <?php echo (Iron_sonaar::isPageTitleUppercase() == true) ? 'uppercase' : ''; ?>">
						<span class="heading-t"></span>
						<?php the_title('<h1>','</h1>');
						Iron_sonaar::displayPageTitleDivider(); ?>
					</div>
				<?php }
				if ( $iron_sonaar_has_sidebar ) : ?>
					<div class="content__wrapper<?php if ( 'left' === $iron_sonaar_sidebar_position ) echo ' content--rev'; ?>">
						<article id="post-<?php the_ID(); ?>" <?php post_class('content__main sr_it-single-post' . $banner_typeCSS ); ?>>
				<?php else: ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class('sr_it-single-post'); ?>>
				<?php endif;

				the_post_thumbnail( array(696, 353), array( 'class' => 'wp-featured-image' ) ); ?>

				<div class="entry">
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'sonaar' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
				</div>

				<?php comments_template();

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
		endwhile;
	endif;
endif;	
get_footer();