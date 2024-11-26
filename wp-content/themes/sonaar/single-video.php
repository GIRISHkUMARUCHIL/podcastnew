<?php get_header();
if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) {
	/**
	 * Setup Dynamic Sidebar
	 */

	list( $iron_sonaar_has_sidebar, $iron_sonaar_sidebar_position, $iron_sonaar_sidebar_area ) = Iron_sonaar::setupDynamicSidebar( $post->ID );

	?>
	<?php

	$banner_background_type = Iron_sonaar::getField('banner_background_type', $post->ID);
	$banner_typeCSS = ($banner_background_type)? '' : 'no-banner' ;
	$videoLocation = Iron_sonaar::getField( 'video_position', $post->ID );
	if ($banner_background_type !== 'null' && $banner_background_type !== '') {

		get_template_part('parts/page-banner');

	}

	?>
			<!-- container -->
			<div class="container">
			<div class="boxed">

			<?php
			$iron_sonaar_single_title = Iron_sonaar::getOption('single_video_page_title');
			if(!empty($iron_sonaar_single_title)):
			?>

				<div class="page-title <?php (Iron_sonaar::isPageTitleUppercase() == true) ? 'uppercase' : '';?>">
				<span class="heading-t"></span>
					<h1><?php echo esc_html($iron_sonaar_single_title); ?></h1>
				<?php Iron_sonaar::displayPageTitleDivider(); ?>
			</div>


			<?php endif; ?>

	<?php
			if ( $iron_sonaar_has_sidebar ) :
	?>
				<div id="twocolumns" class="content__wrapper<?php if ( 'left' === $iron_sonaar_sidebar_position ) echo ' content--rev'; ?>">
					<div id="content" class="content__main">
	<?php
			endif;

	if ( have_posts() ) :
		while ( have_posts() ) : the_post();
		$iron_sonaar_video_url = Iron_sonaar::getField( 'video_url', $post->ID );
		$sr_image_cover = ! empty( get_field('sr_video_cover_image') ) ? get_field('sr_video_cover_image') : '';
		?>
		<!-- single-post video-post -->
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php if ( ! post_password_required() ): ?>
				<?php if( $videoLocation == 'below' ):?>
				<div class="entry">
					<?php the_content(); ?>
				</div>
				<?php endif; ?>

				<div class="video-block">
					<?php if( ! empty( $sr_image_cover ) ): ?>

					<div class="sr-video-mask">
					<?php echo wp_oembed_get( esc_url( $iron_sonaar_video_url ) ); ?>
					</div>

					<!-- use image cover -->
					<div class="sr-video-image-cover" style="background-image: url(<?php echo esc_url( $sr_image_cover); ?>);">
						<div class="elementor-custom-embed-play" role="button">
							<i class="eicon-play" aria-hidden="true"></i>
							<span class="elementor-screen-only">Play Video</span>
						</div>
					</div>

					<?php elseif ( ! empty ( $iron_sonaar_video_url ) ): ?>
						<!-- video-embed -->
						<?php echo wp_oembed_get( esc_url( $iron_sonaar_video_url ) ); ?>
					<?php endif ?>
				</div>
			<?php endif // End post_password_required ?>
			
			<?php if( Iron_sonaar::getField( 'hide_page_title', $post->ID ) != '1' ):?>
				<h4><?php the_title(); ?></h4>
			<?php endif ?>

			<?php get_template_part('parts/video-infos'); ?>

			<div class="entry">
				<?php if( $videoLocation == 'above' || $videoLocation == '' ):?>
				<?php the_content(); ?>
				<?php endif; ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'sonaar' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
			</div>

		<?php get_template_part('parts/share'); ?>
		<?php comments_template(); ?>

		</div>
		<?php endwhile;
	endif;

	if ( $iron_sonaar_has_sidebar ) :
	?>
					</div>

					<aside id="sidebar" class="sr_it-content-side widget-area widget-area--<?php echo esc_attr( $iron_sonaar_sidebar_area ); ?>">
	<?php
		do_action('before_ironband_sidebar_dynamic_sidebar', 'single-video.php');

		dynamic_sidebar( $iron_sonaar_sidebar_area );

		do_action('after_ironband_sidebar_dynamic_sidebar', 'single-video.php');
	?>
					</aside>
				</div>
	<?php
	endif;
	?>
				</div>

			</div>
<?php
}
get_template_part('parts/prefooter'); 
get_footer(); ?>
