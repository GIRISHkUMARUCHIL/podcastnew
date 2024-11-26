<?php

// you can modify this template by creating a file in your current theme : {THEMENAME}/items/event.php

global $wp_query, $post, $eventListArg;
$iron_sonaar_event_meta = get_post_meta($post->ID);
$expanded = ( isset($_GET['id']) && $_GET['id'] == get_the_ID() ? 'expanded' : false );

$upcomingEvents = true;
if((!empty($post->filter) && $post->filter == 'past') || (!empty($wp_query->query_vars['filter']) && $wp_query->query_vars['filter'] == 'past')) {
	$upcomingEvents = false;
}



$artist_at_event = get_field('artist_at_event', get_the_ID());
$artist_at_event_filter = $artist_at_event;
if (!empty($artist_at_event_filter)) {
	foreach($artist_at_event_filter as &$artist) {
		$artist = 'artist-'.$artist;
	}
	$expanded .= implode(' ', $artist_at_event_filter);
}
?>

	<?php 
		$showtime = (bool)get_field('event_show_time');
		$city = get_field('event_city');
		$venue = get_field('event_venue');
		$show_countdown = (bool)get_ironMusic_option('events_show_countdown_rollover', '_iron_music_event_options');
		$item_show_countdown = (bool)get_field('event_enable_countdown');
	?>

		<article id="post-<?php the_ID(); ?>" <?php post_class($expanded); ?> data-countdown="<?php echo ( ($show_countdown || $item_show_countdown) && $upcomingEvents )?'true':'false';?>">

	<a href="<?php the_permalink(); ?>" class="event-link"  data-countdown-bg-transparency="<?php echo ( substr(get_ironMusic_option('events_countdown_bg_color', '_iron_music_event_options'), 16) == ', 0)')?'true':'false'; ?>" <?php echo ( get_post_meta($post->ID, 'alb_link_external', true) != '' )?'target="_blank"':''; ?>>
		<?php
		
			if(  ($show_countdown || $item_show_countdown) && $upcomingEvents ){
			?>
			<div class="event-list-countdown">
				<div class="event-line-countdown-wrap">
					<script type="text/javascript">
						jQuery(function(){
							function CountCall(Row,Day){
								jQuery('.'+Row+' .countdown-block').countdown({until: Day, padZeroes: true, format:'DHMS', layout: '<b>{dnn}<?php echo translateString('tr_D'); ?></b>-{hnn}<?php echo translateString('tr_H'); ?>-{mnn}<?php echo translateString('tr_M'); ?>:{snn}<?php echo translateString('tr_S'); ?>'});
								var totalcount = jQuery('.'+Row+' .countdown-block').countdown('getTimes');
								if(totalcount[3] == 0 && totalcount[4] == 0 && totalcount[5] == 0 && totalcount[6] == 0){
									jQuery('.'+Row+' .event-line-countdown-wrap').addClass('finished');
								}
							};
							var event_y = '<?php echo get_the_time("Y"); ?>';
							var event_m = '<?php echo get_the_time("m"); ?>';
							var event_d = '<?php echo get_the_time("d"); ?>';
							var event_g = '<?php echo get_the_time("H"); ?>';
							var event_i = '<?php echo get_the_time("i"); ?>';
							var targetRow = 'post-<?php the_ID(); ?>';
							var targetDay = new Date(event_y,event_m-1,event_d,event_g,event_i);
							CountCall(targetRow,targetDay);
							//Remove the following line's comment to stop the timers
							//jQuery('.countdown-block').countdown('pause');
						});
					</script>
					<div class="countdown-block"></div>
				</div>
			</div>
			<?php
			}
		?>

		<div class="sr-it-event-date">
			<div class="sr-it-date-day"><?php echo get_the_date( 'd' ); ?></div>
			<div class="sr-it-date-years"><?php echo get_the_date( 'M Y' ); ?></div>
		</div>
		<div class="sr_it-event-main">
			<div class="sr_it-event-title">
				<?php if( ! $eventListArg['hide_time']): ?>
				<span class="sr_it-event-hour">
					<?php echo get_the_time(); ?>
				</span>
				<?php endif ?>
				<<?php echo $eventListArg['title_tag'] ?>> <?php echo get_the_title($post->ID) ?> </<?php echo $eventListArg['title_tag'] ?>> 
			</div>
			<div class="sr_it-event-info">

				<?php if( function_exists('get_artists')): ?>
					<?php if( get_artists($post->ID) && ! $eventListArg['hide_artist']): ?>
					<span class="eventlist-artists">
					<?php echo translateString('tr_With')?>
						<span class="artistsList"><?php echo wp_kses_post( get_artists($post->ID) )?></span>
					</span>
					<?php endif ?>
				<?php endif ?>

				<?php if($venue != "" && ! $eventListArg['hide_venue']): ?>
				<span class="eventlist-venue">
				<?php echo translateString('tr_at') . ' ';?>
				<?php esc_html_e($venue . ' ');?>
				</span>
				<?php endif ?>


				<?php if($city != "" && ! $eventListArg['hide_city']): ?>
				<span class="eventlist-city">
				<?php if( function_exists('get_artists') ): ?>
				<?php if( ($venue != "" &&  $eventListArg['hide_venue']== false )|| ( get_artists($post->ID) && get_ironMusic_option('events_show_artists', '_iron_music_event_options') &&  $eventListArg['hide_artist'] == false ) && $city != ""){echo translateString('tr_event_separator') . ' ';} ?>
				<?php endif ?>
				<?php esc_html_e( $city . ' ' );?>
				</span>
				<?php endif ?>

				



			</div>
		</div>
	</a>

	<div class="sr_it-event-buttons sr_it-vertical-align">

		<?php $iron_sonaar_multiIftickets = Iron_sonaar::getField( 'event_call_action', $post->ID , true); ?>
		<?php $iron_sonaar_iftickets = Iron_sonaar::getField( 'event_link', $post->ID );?>

		<?php if(!empty($iron_sonaar_iftickets) && empty($iron_sonaar_multiIftickets)): ?>
		<a class="button" target="_blank" href="<?php echo esc_url($iron_sonaar_iftickets); ?>"><?php echo esc_html( Iron_sonaar::getField( 'event_action_label', $post->ID) ) ?></a>
		<?php endif; ?>


		<?php if(!empty($iron_sonaar_multiIftickets)): ?>
		<?php for ($i = 0; $i < $iron_sonaar_multiIftickets; $i++) : ?>
		<?php $eventUrl = esc_url($iron_sonaar_event_meta['event_call_action_'.$i.'_event_link_rp'][0]); ?>
		<a class="button" <?php echo ( $eventUrl != '' )?'href="'. $eventUrl . '" target="_blank"':''; ?> >
			<?php echo wp_kses_post( $iron_sonaar_event_meta['event_call_action_'.$i.'_event_action_label_rp'][0] ) ?>
		</a>
		<?php endfor ?>
		<?php endif ?>
		<?php if ( get_ironMusic_option('events_button_more_info', '_iron_music_event_options') == 1): ?>
		<a class="button sr_it-event-info-button" href="<?php the_permalink(); ?>" <?php echo ( get_post_meta($post->ID, 'alb_link_external', true) != '' )?'target="_blank"':''; ?> >
			<?php echo translateString('tr_More_Info'); ?>
			</i><i class="fa-solid fa-angle-right"></i>
		</a>
		<?php endif ?>
	</div>
</article>