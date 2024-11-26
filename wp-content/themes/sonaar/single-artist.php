<?php

get_header();
if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) {
	$iron_sonaar_artist_meta = get_post_meta($post->ID);
	the_post();

	$iron_sonaar_artist_featured_album = get_field('artist_hero_playlist');
	$iron_sonaar_artist_featured_album = ( $iron_sonaar_artist_featured_album == null )? false : $iron_sonaar_artist_featured_album->ID ;
	$iron_sonaar_artist_desc = get_field('artist_desc');
	$iron_sonaar_artist_social = get_field('artist_social');
	$iron_sonaar_artist_link = get_field('artist_link');
	$iron_sonaar_artist_contact = get_field('artist_contact');
	$iron_sonaar_artist_download = get_field('artist_download');
	$iron_sonaar_artist_nav = Iron_sonaar::getOption('artist_pagination_hide', null, false);

	?>
	<div class="artist-header">

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

	</div>

	<!-- container -->
	<div class="container">
		<div class="boxed">
			<article id="post-<?php echo esc_attr( $post->ID ) ?>" <?php post_class( $banner_typeCSS ); ?>>
			<div class="entry">
				<?php if ( ! post_password_required() ): ?>
				<?php if($iron_sonaar_artist_featured_album):?>

				<?php   
				$iron_sonaar_atts = array(
					'albums' => $iron_sonaar_artist_featured_album,
					'show_playlist' => false,
					'skin' => 'artist',
				);
				the_widget('Iron_Widget_Radio', $iron_sonaar_atts, array( 'before_widget'=>'<article class="srt_player-container widget iron_widget_radio sonaar_artist_player" data-skin="artist">', 'after_widget'=>'</article>'));?>
				
				<?php endif ?>
				<?php endif // End post_password_required ?>
				<div class="artist_content padding">
					<?php the_content(); ?>
					<?php //comments_template(); ?>
				</div>
				<?php if ( ! post_password_required() ): ?>
				<div class="artist_sidebar padding">
					<?php if( $iron_sonaar_artist_desc ):?>
						<div class="artist_desc sr_it-meta">
							<h1><?php the_title()?></h1>
							<?php echo wp_kses_post( apply_filters( 'sonaar_content', $iron_sonaar_artist_desc ) )?>
						</div>
					<?php endif ?>
					<?php if( $iron_sonaar_artist_social ):?>
						<div class="artist_social sr_it-meta">
							<h4><?php esc_html_e('Follow','sonaar')?></h4>
							<?php 
							$len_social = sizeof($iron_sonaar_artist_social);
							for ($i = 0; $i < $len_social; $i++) : ?>
								<div class="social_icon">

									<a href="<?php echo esc_url( $iron_sonaar_artist_meta['artist_social_'.$i.'_artist_social_link'][0] ) ?>" target="_blank">
										<i class="fa fa-2x <?php echo esc_attr( $iron_sonaar_artist_meta['artist_social_'.$i.'_artist_social_icon'][0] )?>"></i>
										<?php echo wp_kses_post( $iron_sonaar_artist_meta['artist_social_'.$i.'_artist_social_label'][0] ) ?>
									</a>
								</div>
							<?php endfor ?>

						</div>
					<?php endif ?>

					<?php if( $iron_sonaar_artist_link ):?>
						<div class="artist_link sr_it-meta">
							<h4><?php echo translateString('tr_Website')?></h4>
							<?php
							$len_link = sizeof($iron_sonaar_artist_link);
							for ($i = 0; $i < $len_link; $i++) : ?>

								<a href="<?php echo esc_url($iron_sonaar_artist_meta['artist_link_'.$i.'_artist_link_link'][0] ) ?>" target="_blank">
									<?php echo wp_kses_post( $iron_sonaar_artist_meta['artist_link_'.$i.'_artist_link_label'][0] )?>
								</a></br>

							<?php endfor ?>

						</div>
					<?php endif ?>

					<?php if( $iron_sonaar_artist_contact ):?>
						<div class="artist_contact sr_it-meta">
							<h4><?php echo translateString('tr_Contact_and_booking'); ?></h4>
							<?php echo wp_kses_post( apply_filters( 'sonaar_content', $iron_sonaar_artist_contact ) ) ?>
						</div>
					<?php endif ?>

					<?php if( $iron_sonaar_artist_download ):?>
						<div class="artist_download sr_it-meta">
							<h4><?php echo translateString('tr_Downloads'); ?></h4>
							<?php
							$len_download = sizeof($iron_sonaar_artist_download);
							for ($i = 0; $i < $len_download; $i++) : ?>

								<a href="<?php echo esc_url(wp_get_attachment_url($iron_sonaar_artist_meta['artist_download_'.$i.'_artist_download_link'][0]) ) ?>" target="_blank">
									<?php echo wp_kses_post( $iron_sonaar_artist_meta['artist_download_'.$i.'_artist_download_label'][0] ) ?>
								</a></br>

							<?php endfor ?>

						</div>
					<?php endif ?>
				</div>
				<?php endif // End post_password_required ?>
			</div>
			</article>
		</div>
		
	</div>

	<?php  get_template_part('parts/prefooter'); ?>

	<!-- NAVIGATION -->
	<?php 
	if( !$iron_sonaar_artist_nav ):
	?>
	<div class="sr_it-artist-nav sr_it-nav <?php echo ( Iron_sonaar::getOption('container_type', null, 'container_fullwidth') == 'container_boxed' )? 'container':'';?>">
		<div class="sr_it-prev-wrap">
		<?php $prev_post =  get_previous_post();
		if (!empty( $prev_post )): ?>
			<a href="<?php echo esc_url( get_permalink($prev_post->ID) ) ?>" class="sr_it-prev">
				<div class="sr_it-text"><?php echo translateString('tr_Previous_Artist'); ?></div>
				<div class="sr_it-navTitle-text"><?php echo wp_kses_post( $prev_post->post_title ) ?></div>
				<div class="clear"></div>

			</a>
		<?php endif; ?>
		</div>
		<div class="sr_it-next-wrap">
		<?php
		$next_post = get_next_post();
		if (!empty( $next_post )): ?>
			<a href="<?php echo esc_url(get_permalink($next_post->ID) ) ?>" class="sr_it-next">
				<div class="sr_it-text"><?php echo translateString('tr_Next_Artist'); ?></div>
				<div class="sr_it-navTitle-text"><?php echo wp_kses_post( $next_post->post_title ) ?></div>
				<div class="clear"></div>

			</a>
		<?php endif; ?>
		</div>
		<div class="clear"></div>
	</div>

	<?php endif ?>


<?php
}

get_footer(); ?>