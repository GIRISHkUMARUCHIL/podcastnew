<?php get_header();

if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) {

	if ( have_posts() ) : the_post();
	$nobanner = ( Iron_sonaar::getField('album_background_type', $post->ID ) == 'default' )? 'no-banner':'';
	$playerLocation = Iron_sonaar::getField( 'player_position', $post->ID );


			if ( Iron_sonaar::getField('album_background_type', $post->ID ) !== 'default' ): ?>
				<div class="album-header <?php echo ( Iron_sonaar::getOption('container_type', null, 'container_fullwidth') == 'container_boxed' )? 'container':'';?>">
					<div class="backCover"></div>

					<?php if( ! Iron_sonaar::getField('hide_featured_image', $post->ID)): ?>
					<div class="albumCover">
						<?php $iron_sonaar_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' ); ?>
						<img src="<?php echo esc_url($iron_sonaar_image[0]) ?>">
					</div>
					<?php endif ?>

				</div>
			<?php endif ?>
			<!-- container -->
			<div class="container">


			<div class="boxed">



		<?php list( $iron_sonaar_has_sidebar, $iron_sonaar_sidebar_position, $iron_sonaar_sidebar_area ) = Iron_sonaar::setupDynamicSidebar( $post->ID );
		if ( $iron_sonaar_has_sidebar ) : ?>
			<div id="twocolumns" class="content__wrapper<?php if ( 'left' === $iron_sonaar_sidebar_position ) echo ' content--rev'; ?>">
				<div id="content" class="content__main">
		<?php endif; ?>


		<!-- info-section -->
		<div id="post-<?php the_ID(); ?>" <?php post_class( 'featured ' . $nobanner ); ?>>

		<?php
		$iron_sonaar_hide_page_title = Iron_sonaar::getField('hide_page_title', $post->ID);
				if( empty( $iron_sonaar_hide_page_title ) ) { ?>
					<div class="page-title rellax <?php echo (Iron_sonaar::isPageTitleUppercase() == true) ? 'uppercase' : ''; ?>">
						<span class="heading-t"></span>
						<?php the_title('<h2>','</h2>');?>
					
					<?php if( function_exists('get_artists') ): ?>
						<?php if( get_artists($post->ID) && ! get_ironMusic_option('continuous_music_player_label_artist', '_iron_music_music_player_options')  ): ?>
							<h3 class="meta-artist_of_album"><span><?php echo translateString('tr_by') ?></span> <?php echo wp_kses_post( get_artists($post->ID) )?></h3>
						<?php endif ?>
					<?php endif ?>
					<?php Iron_sonaar::displayPageTitleDivider(); ?>
					</div>
				<?php }?>


		<div class="sr_it-singlealbum-content-wrapper">
		<?php
		if ( ! post_password_required() ): 
			$iron_sonaar_atts = array(
				'albums' => array($post->ID),
				'show_playlist' => true
			);
			if( $playerLocation == 'below' ):
				the_content(); 
			endif;
			if ( Iron_sonaar::getField( 'alb_tracklist', $post->ID ) !== '0' && Iron_sonaar::getField( 'alb_tracklist', $post->ID ) !== '' ) : //Since ACF 5.9.5 -> Iron_soundrise::getField( 'alb_tracklist', $post->ID ) == '' when playlist doesnt have track rather than '0'
				the_widget('Iron_Widget_Radio', $iron_sonaar_atts, array( 'before_widget'=>'<article class="srt_player-container iron_widget_radio">', 'after_widget'=>'</article>', 'widget_id'=>'single_album'));
			endif;
		endif;
		?>


				<section class="content-box">
					<div class="entry">
						<?php if( $playerLocation == 'default' || $playerLocation == '' ):
						the_content(); 
						endif; 
						wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'sonaar' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
					</div>
				</section>
				

	 <?php	if ( get_the_content() ) : ?> 
				<!-- content-box -->
	<?php	endif; ?>

	<?php
	if ( ! post_password_required() ): 
	if ( Iron_sonaar::getField('alb_store_list', $post->ID) ) : ?>
		<div class="buttons-block">
			<div class="ctnButton-block">
				<div class="available-now"><?php echo translateString('tr_Available_now_on'); ?></div>
				<ul class="store-list">
					<?php while(has_sub_field('alb_store_list')): ?>
					<li><a class="button" href="<?php echo esc_url( get_sub_field('store_link') ); ?>" target="<?php echo get_sub_field('playlist_store_link_target'); ?>">
					<?php 
					if(get_sub_field('sr_album_icon_file') && get_sub_field('sr_album_icon_file') != ''){
						$imageelement = '<span class="sr_svg-box">' . file_get_contents( get_sub_field('sr_album_icon_file') ) . '</span>';
					}else{
						$imageelement = ( get_sub_field('album_store_icon') )? '<i class="fa ' . get_sub_field('album_store_icon') . '"></i>': '';
					}
					echo $imageelement; ?>
					<?php the_sub_field('store_name'); ?></a></li>
					<?php endwhile; ?>
				</ul>
			</div>
		</div>
	<?php endif; ?>


	<?php		if ( Iron_sonaar::getField('alb_review', $post->ID) ) : ?>
				<!-- content-box -->
				<section class="content-box">
				<?php Iron_sonaar::displayPageTitleDivider(); ?>
	<?php		if ( Iron_sonaar::getField('alb_review', $post->ID ) || Iron_sonaar::getField('alb_review_author', $post->ID ) ) : ?>
				<!-- blockquote-box -->
					<figure class="blockquote-block">
	<?php			if ( Iron_sonaar::getField('alb_review', $post->ID ) ) : ?>
						<blockquote><?php echo wp_kses_post( Iron_sonaar::getField('alb_review', $post->ID) ); ?></blockquote>
	<?php
					endif;

					if ( Iron_sonaar::getField('alb_review_author', $post->ID ) ) : ?>
						<figcaption>- <?php echo wp_kses_post( Iron_sonaar::getField('alb_review_author', $post->ID ) ); ?></figcaption>
	<?php 			endif; ?>
					</figure>
	<?php		endif; ?>
				</section>
	<?php	endif; ?>
	<?php 	if( $playerLocation == 'above' ):
			the_content(); 
			endif; ?> 				

	<?php	get_template_part('parts/share'); ?>

	<?php	comments_template(); ?>
	<?php endif; //post_password_required ?>
	</div> <?php //End sr_it-singlealbum-content-wrapper ?>
	<?php
			if ( $iron_sonaar_has_sidebar ) :
	?>
					</div>

					<aside id="sidebar" class="sr_it-content-side widget-area widget-area--<?php echo esc_attr( $iron_sonaar_sidebar_area ); ?>">
	<?php
		do_action('before_ironband_sidebar_dynamic_sidebar', 'single-album.php');

		dynamic_sidebar( $iron_sonaar_sidebar_area );

		do_action('after_ironband_sidebar_dynamic_sidebar', 'single-album.php');
	?>
					</aside>
				</div> <?php //End #post ?>
	<?php
			endif;
	?>

	<?php endif; ?>

			</div>	<?php //End boxed ?>
			</div> <?php //End container ?>

<?php
}

get_template_part('parts/prefooter');

get_footer(); ?>