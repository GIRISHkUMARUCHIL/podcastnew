<?php
get_header();

if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) {

	$iron_sonaar_podcast_meta = get_post_meta($post->ID);
	the_post();

	list( $iron_sonaar_has_sidebar, $iron_sonaar_sidebar_position, $iron_sonaar_sidebar_area ) = Iron_sonaar::setupDynamicSidebar( $post->ID );
	$iron_sonaar_hide_page_title = Iron_sonaar::getField('hide_page_title', $post->ID);
	$iron_sonaar_podcast_nav = Iron_sonaar::getOption('podcast_pagination_hide', null, false);
	$playerLocation = Iron_sonaar::getField( 'podcast_player_position', $post->ID );
	$atts = array(
		'albums' => $post->ID,
		'skin' => 'podcast',
	);
	if( Iron_sonaar::getField('banner_inherit_setting', $post->ID) ){
		$banner_background_type = get_field('banner_background_type', get_the_terms( $post->ID, 'podcast-category')[0] );
	}else{
		$banner_background_type = Iron_sonaar::getField('banner_background_type', $post->ID);
	}

	$displayPlayer = ( (Iron_sonaar::getField('FileOrStreamPodCast', $post->ID) == 'stream' &&  Iron_sonaar::getField('stream_link', $post->ID) != '') || (Iron_sonaar::getField('FileOrStreamPodCast', $post->ID)=='mp3'&&  Iron_sonaar::getField('track_mp3_podcast', $post->ID) != '') )?true: false;

	$articleClass = array( 
		($banner_background_type == 'null')? 'no-banner' : 'banner',
		($iron_sonaar_hide_page_title )? 'hide-title' : '',
		($displayPlayer)? 'has-player' : '',
		($playerLocation == 'above' || $playerLocation == '')? 'sr_player-above': ''
	);
	?>





	<?php
	if ($banner_background_type !== 'null' && $banner_background_type !== ''  && $banner_background_type !== false): ?>
	<div class="podcast-banner">
		
		<?php get_template_part('parts/page-banner'); ?>
	</div>
	<?php endif?>
	<!-- container -->
	<div class="container">
		<div class="boxed">
			<article id="post-<?php echo esc_attr( $post->ID ) ?>" <?php post_class( $articleClass ); ?>>
				<div class="entry">
					<?php if( empty( $iron_sonaar_hide_page_title ) ) : ?>
					<div class="page-title rellax <?php echo (Iron_sonaar::isPageTitleUppercase() == true) ? 'uppercase' : ''; ?>">
						<span class="heading-t"></span>
						<?php the_title('<h1>','</h1>');?>
						<?php Iron_sonaar::displayPageTitleDivider(); ?>
					</div>
					<?php endif ?>
					<?php if ( ! post_password_required() ): ?>
					<?php if( $displayPlayer ): ?>
						<?php if( $playerLocation == 'above' || $playerLocation == '' ):?>
						<?php echo the_widget('Iron_Widget_Radio', $atts, array('widget_id'=>'arbitrary-instance-'.uniqid(), 'before_widget'=>'<article class="srt_player-container widget iron_widget_radio iron_podcast_player " data-skin="podcast">', 'after_widget'=>'</article>'));?>
						<?php endif; ?>
					<?php endif ?>
					<?php endif // End post_password_required ?>
					<div class="sonaar-single-podcast entry <?php echo ($iron_sonaar_has_sidebar)?'has-sidebar sidebar-'. $iron_sonaar_sidebar_position .' ':''; ?>">
						<?php the_content(); ?>
						<?php if( $playerLocation == 'below' ):?>
						<?php echo the_widget('Iron_Widget_Radio', $atts, array('widget_id'=>'arbitrary-instance-'.uniqid(), 'before_widget'=>'<article class="srt_player-container widget iron_widget_radio iron_podcast_player " data-skin="podcast">', 'after_widget'=>'</article>'));?>
						<?php endif; ?>
						<?php comments_template(); ?>
					</div>
					<?php if ( $iron_sonaar_has_sidebar ) : ?>
					<aside id="sidebar" class="sr_it-content-side widget-area widget-area--<?php echo esc_attr( $iron_sonaar_sidebar_area ).' sidebar-'. $iron_sonaar_sidebar_position; ?>">
						<?php
						do_action('before_ironband_sidebar_dynamic_sidebar', 'page.php');
						dynamic_sidebar( $iron_sonaar_sidebar_area );
						do_action('after_ironband_sidebar_dynamic_sidebar', 'page.php');
						?>
					</aside>
					<?php endif ?>
				</div>
			</article>
				<?php
					get_template_part('parts/share');
				?>
		</div>
	</div>

	<!-- NAVIGATION -->
	<?php 
	if( !$iron_sonaar_podcast_nav ):
		$prev_post =  Iron_sonaar::get_adjacent_post(true, 'podcast-category');
		$next_post = Iron_sonaar::get_adjacent_post(false, 'podcast-category');
		?>

		<?php if($prev_post || $next_post): ?>
		<div class="sr_it-artist-nav sr_it-nav <?php echo ( Iron_sonaar::getOption('container_type', null, 'container_fullwidth') == 'container_boxed' )? 'container':'';?>">
			<div class="sr_it-prev-wrap">
			<?php if (!empty( $next_post )): ?>
				<a href="<?php echo esc_url(get_permalink($next_post->ID) ) ?>" class="sr_it-prev">
					<div class="sr_it-text"><?php echo translateString('tr_Previous_Podcast'); ?></div>
					<div class="sr_it-navTitle-text"><?php echo wp_kses_post( $next_post->post_title ) ?></div>
					<div class="clear"></div>

				</a>
			<?php endif; ?>
			</div>
			<div class="sr_it-next-wrap">
			<?php if (!empty( $prev_post )): ?>
				<a href="<?php echo esc_url( get_permalink($prev_post->ID) ) ?>" class="sr_it-next">
					<div class="sr_it-text"><?php echo translateString('tr_Next_Podcast'); ?></div>
					<div class="sr_it-navTitle-text"><?php echo wp_kses_post( $prev_post->post_title ) ?></div>
					<div class="clear"></div>

				</a>
			
			<?php endif; ?>
			</div>
			<div class="clear"></div>
		</div>
		<?php endif ?>
	<?php endif ?>


<?php 
}
get_template_part('parts/prefooter');
get_footer(); ?>