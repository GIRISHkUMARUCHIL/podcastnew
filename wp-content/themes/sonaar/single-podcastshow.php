<?php
get_header();
if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) {
	$iron_sonaar_podcast_meta = get_post_meta($post->ID);
	the_post();
		
		$post_list = FALSE;
		if( Iron_sonaar::getField('podcast-category-in-show', $post->ID) ){
			$getcategories =	Iron_sonaar::getField('podcast-category-in-show', $post->ID);
			$args =  array(
					'post_status'=> 'publish',
					'order' => 'DESC',
					'orderby' => 'date',
					'post_type'=> 'podcast',
					'posts_per_page'=> -1,
					'tax_query' => 	array(
										array(
											'taxonomy' => 'podcast-category',
											'field'    => 'id',
											'terms'    => $getcategories,
										)
									)
			);
			$post_list = get_posts($args);
		}


	list( $iron_sonaar_has_sidebar, $iron_sonaar_sidebar_position, $iron_sonaar_sidebar_area ) = Iron_sonaar::setupDynamicSidebar( $post->ID );

	$iron_sonaar_hide_page_title = Iron_sonaar::getField('hide_page_title', $post->ID);
	$atts = array(
		'podcastshow' => $post->ID,
		'skin' => 'podcast',
	);
	if( Iron_sonaar::getField('banner_inherit_setting', $post->ID) ){
		$banner_background_type = get_field('banner_background_type', get_the_terms( $post->ID, 'podcast-category')[0] );
	}else{
		$banner_background_type = Iron_sonaar::getField('banner_background_type', $post->ID);
	}
	$articleClass = array( 
		($banner_background_type == 'null')? 'no-banner' : 'banner',
		($iron_sonaar_hide_page_title )? 'hide-title' : '',
	);
	?>

	<?php

	if ($banner_background_type !== 'null' && $banner_background_type !== ''  && $banner_background_type !== false): ?>
	<div class="podcast-banner">
		<?php get_template_part('parts/page-banner'); ?>
	</div>
	<?php endif?>




	<!-- container -->
	<div class="container <?php echo ( $iron_sonaar_has_sidebar )? 'sr_it-sidebar-enable':''; ?> <?php echo $iron_sonaar_sidebar_position ?>">
		<div class="boxed">
			<article id="post-<?php echo esc_attr( $post->ID ) ?>" <?php post_class( $articleClass ); ?>>
				<?php if( empty( $iron_sonaar_hide_page_title ) ) : ?>
					<div class="page-title rellax <?php echo (Iron_sonaar::isPageTitleUppercase() == true) ? 'uppercase' : ''; ?>">
						<span class="heading-t"></span>
						<?php the_title('<h1>','</h1>');?>
						<?php Iron_sonaar::displayPageTitleDivider(); ?>
					</div>
				<?php endif ?>

				<div class="sonaar-single-podcastshow entry <?php echo ($iron_sonaar_has_sidebar)?'has-sidebar sidebar-'. $iron_sonaar_sidebar_position .' ':''; ?>">
					<section class="content-box">
							<?php the_content(); ?>
							<div class="podcastshow-episodes">
							<?php if( Iron_sonaar::getOption( 'podcast_archive_default_template' ) == 'archive-podcast-list'):
								echo do_shortcode('[iron_podcast_archive category="' . $getcategories[0] .'" ]');
							else:
							$my_post_array = array();
							if ($post_list) {
								foreach ($post_list as $value) {
									$my_post_array[] = $value->ID;
								}
								echo do_shortcode( '[ess_grid alias="podcast-archives" posts='.implode(',', $my_post_array).']' );
							}		
							endif;
							?>
							</div>
					</section>

					<?php comments_template(); ?>
				</div>
				<?php if ( $iron_sonaar_has_sidebar ) : ?>
					<aside id="sidebar" class="sr_it-content-side widget-area widget-area--<?php echo esc_attr( $iron_sonaar_sidebar_area ).' sidebar-'. $iron_sonaar_sidebar_position; ?>">
						<?php
						do_action('before_ironband_sidebar_dynamic_sidebar', 'single-podcastshow.php');
						dynamic_sidebar( $iron_sonaar_sidebar_area );
						do_action('after_ironband_sidebar_dynamic_sidebar', 'single-podcastshow.php');
						?>
					</aside>
				<?php endif ?>
			</article>
				<?php get_template_part('parts/share');	?>
		</div>
	</div>

<?php
}
get_template_part('parts/prefooter');
get_footer(); ?>