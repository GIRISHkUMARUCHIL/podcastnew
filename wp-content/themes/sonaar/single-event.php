<?php get_header();
if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) {

	$banner_background_type = Iron_sonaar::getField('banner_background_type', $post->ID);
	$banner_typeCSS = ($banner_background_type)? '' : 'no-banner' ;
	$iron_sonaar_event_meta = get_post_meta($post->ID);
	if ($banner_background_type !== 'null' && $banner_background_type !== '') {
		if ( $banner_background_type=='image-background' && Iron_sonaar::getField('banner_image', $post->ID) == '' ){
		} else {
			get_template_part('parts/page-banner');
		}
	}

	?>
			<div class="container">
			<div class="boxed">

			<?php
			if ( have_posts() ) :
				while ( have_posts() ) : the_post();
			?>

			<?php
			$iron_sonaar_single_title = Iron_sonaar::getOption('single_event_page_title');
			if(!empty($iron_sonaar_single_title)):
			?>
				<div class="page-title <?php (Iron_sonaar::isPageTitleUppercase() == true) ? 'uppercase' : '';?>">
				<span class="heading-t"></span>
					<h1><?php echo esc_html($iron_sonaar_single_title); ?></h1>
				<?php Iron_sonaar::displayPageTitleDivider(); ?>
			</div>

			<?php endif; ?>

			<?php
			list( $iron_sonaar_has_sidebar, $iron_sonaar_sidebar_position, $iron_sonaar_sidebar_area ) = Iron_sonaar::setupDynamicSidebar( $post->ID );

			if ( $iron_sonaar_has_sidebar ) :
	?>
				<div id="twocolumns" class="content__wrapper<?php if ( 'left' === $iron_sonaar_sidebar_position ) echo ' content--rev'; ?>">
					<div id="content" class="content__main">
	<?php
			endif;
	?>


				<!-- single-post -->
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry">
						<div class="event-wrapper">
						<?php
						if ( has_post_thumbnail() ) {
						?>
							<div class="lefthalf">
								<?php the_post_thumbnail('full'); ?>
							</div>
						<?php
						};
						?>
							<div class="righthalf">
								<?php if( Iron_sonaar::getField( 'hide_page_title', $post->ID ) != '1' ):?>
								<h1 class="event-boldtitle"><?php the_title(); ?><br></h1>
								<?php endif ?>
								<table>
									<?php if( function_exists('get_artists') ): ?>
									<?php if( get_artists($post->ID) ): ?>
									<tr>
										<td class="event-icon"><i class="fa-solid fa-user"></i></td>
										<td><?php echo wp_kses_post( get_artists($post->ID) )?></td>
									</tr>
									<?php endif ?>
									<?php endif ?>
									<tr>
										<td class="event-icon"><i class="fa-solid fa-calendar-days"></i></td>
										<td><?php echo get_the_date(); ?></td>
									</tr>

									<?php $iron_sonaar_event_show_time = Iron_sonaar::getField( 'event_show_time', $post->ID );
									if( !empty( $iron_sonaar_event_show_time ) ){ ?>
									<tr>
										<td class="event-icon"><i class="fa-regular fa-clock"></i></td>
										<td><?php echo esc_html( get_the_time() ) ?></td>
									</tr>
									<?php } ?>

									<?php
									$iron_sonaar_event_city = Iron_sonaar::getField( 'event_city', $post->ID );
									if ( !empty( $iron_sonaar_event_city ) ) {
									?>
									<tr>
										<td class="event-icon"><i class="fa-solid fa-globe"></i></td>
										<td><?php echo esc_html(Iron_sonaar::getField( 'event_city', $post->ID )); ?></td>
									</tr>
									<?php } ?>

									<?php
									$iron_sonaar_event_venue = Iron_sonaar::getField( 'event_venue', $post->ID );
									if(!empty( $iron_sonaar_event_venue )): ?>
									<tr>
										<td class="event-icon"><i class="fa-solid fa-arrow-down"></i></td>
										<td><?php echo esc_html( Iron_sonaar::getField( 'event_venue', $post->ID ) ); ?></td>
									</tr>
									<?php endif; ?>
									<?php
									$iron_sonaar_event_map = Iron_sonaar::getField( 'event_map', $post->ID );
									if(!empty( $iron_sonaar_event_map )): ?>
									<tr>
										<td class="event-icon"><i class="fa-solid fa-location-dot"></i></td>
										<td><a class="event-map-link" href="<?php echo esc_url( Iron_sonaar::getField( 'event_map', $post->ID )); ?>" target="_blank"><?php echo esc_html( Iron_sonaar::getField( 'event_map_label', $post->ID ) ) ?></a></td>
									</tr>
									<?php endif; ?>
								</table>


								<?php $iron_sonaar_multiIftickets = Iron_sonaar::getField( 'event_call_action', $post->ID , true); ?>
								<?php $iron_sonaar_iftickets = Iron_sonaar::getField( 'event_link', $post->ID );?>
								<?php if(!empty($iron_sonaar_iftickets) && empty($iron_sonaar_multiIftickets)): ?>

								<a class="button" target="_blank" href="<?php echo esc_url($iron_sonaar_iftickets); ?>"><?php echo esc_html( Iron_sonaar::getField( 'event_action_label', $post->ID) ) ?></a>
								<?php endif; ?>


								<?php if(!empty($iron_sonaar_multiIftickets)): ?>
								<?php for ($i = 0; $i < $iron_sonaar_multiIftickets; $i++) : ?>
									<a class="button" href="<?php echo esc_url( $iron_sonaar_event_meta['event_call_action_'.$i.'_event_link_rp'][0] ) ?>" target="_blank">
										<?php echo wp_kses_post( $iron_sonaar_event_meta['event_call_action_'.$i.'_event_action_label_rp'][0] ) ?>
									</a>
								<?php endfor ?>
								<?php endif ?>

								
								<?php the_content(); ?>
							</div>
							<div class="clear"></div>
						</div>

						<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'sonaar' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
					</div>
				</article>

				<?php	get_template_part('parts/share'); ?>
				<?php	comments_template(); ?>

	<?php
			if ( $iron_sonaar_has_sidebar ) :
	?>
					</div>

					<aside id="sidebar" class="sr_it-content-side widget-area widget-area--<?php echo esc_attr( $iron_sonaar_sidebar_area ); ?>">
	<?php
		do_action('before_ironband_sidebar_dynamic_sidebar', 'single-event.php');

		dynamic_sidebar( $iron_sonaar_sidebar_area );

		do_action('after_ironband_sidebar_dynamic_sidebar', 'single-event.php');
	?>
					</aside>
				</div>
	<?php
			endif;
	?>

	<?php
				endwhile;
			endif;
			?>

			</div>
			</div>

<?php
}
get_template_part('parts/prefooter'); 
get_footer(); ?>