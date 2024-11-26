<?php
	global $podcastArchive;
	$grid_post_thumbnail = wp_get_attachment_image_url(get_post_thumbnail_id( $post->ID ), 'medium');
	
	$track = wp_get_attachment_metadata( Iron_sonaar::getField('track_mp3_podcast', $post->ID));

	// MJ: the track lenght should use the shortcode in shortcodes.php
	if(  Iron_sonaar::getField('FileOrStreamPodCast', $post->ID) == 'mp3' && !empty($track) && (isset($track['length_formatted'])) ){
		$trackLenght = $track['length_formatted'];
	}else{
		$trackLenght =  get_field('podcast_track_length', $post->ID );;
	}

	$iron_sonaar_term = get_the_terms( $post->ID, 'podcast-category');
	$hide_date= get_ironMusic_option('podcast_label_date', '_iron_music_podcast_player_options');
	$hide_duration= get_ironMusic_option('podcast_label_duration', '_iron_music_podcast_player_options');
	$displayPlay = ( (Iron_sonaar::getField('FileOrStreamPodCast', $post->ID) == 'stream' &&  Iron_sonaar::getField('stream_link', $post->ID) != '') || (Iron_sonaar::getField('FileOrStreamPodCast', $post->ID)=='mp3'&&  Iron_sonaar::getField('track_mp3_podcast', $post->ID) != '') )?true: false;
	$listClass = 'sonaar-podcast-list-item ';

	
	if( isset($podcastArchive) ){ //$podcastArchive is set when we are podcast_list.php is called from widget.php
		$hide_artwork = !$grid_post_thumbnail || $podcastArchive['hide-artwork'];
		$hide_duration = $podcastArchive['hide-duration'];
		$hide_date = $podcastArchive['hide-date'];
		$hide_category = $podcastArchive['hide-category'];
		$hide_excerpt = $podcastArchive['hide-excerpt'];
		$play_button_position = $podcastArchive['play-location'];
		$length = ( $podcastArchive['excerpt-lenght'] == '')?intval(Iron_sonaar::getOption('podcast_excerpt_lenght', null, '40')):$podcastArchive['excerpt-lenght'];
		$strip_html_excerpt = ( isset( $podcastArchive['strip-html-excerpt'] ) )?$podcastArchive['strip-html-excerpt']: intval(Iron_sonaar::getOption('strip-html-excerpt', null, '0'));
		$disable_single_page_link = $podcastArchive['disable-post-link'];
	}else{
		$hide_artwork = ( !$grid_post_thumbnail || Iron_sonaar::getOption('podcast_archive_hide_artwork')=='1' )?true:false ;
		$hide_duration = false;
		$hide_date = false;
		$hide_category = false;
		$hide_excerpt = false;
		$play_button_position = Iron_sonaar::getOption('podcast_archive_play_location');
		$length = intval(Iron_sonaar::getOption('podcast_excerpt_lenght', null, '40'));
		$strip_html_excerpt = intval(Iron_sonaar::getOption('podcast_strip_html', null, '0'));
		$disable_single_page_link = get_ironMusic_option('disable_single_page_link', '_iron_music_podcast_player_options' );
	}
	
	if( $hide_artwork ){
		$listClass .= 'no-image ';
	}
	if($play_button_position == 'left'){
		$listClass .= 'sr-button-left ';
	}else{
		$listClass .= 'sr-button-right ';
	}
	if(!$displayPlay){
		$listClass .= 'no-audio';
	}
	$callToAction = get_field('podcast_calltoaction', $post->ID);
	?>




<article id="post-<?php the_ID(); ?>" <?php post_class($listClass); ?>>
	<div class="sonaar-podcast-list-img">
		<?php if(!$hide_artwork):?>
			<?php if(!$disable_single_page_link): ?>
			<a href="<?php echo get_the_permalink( $post->ID ) ?> ">
			<?php endif ?>
				<img src="<?php echo $grid_post_thumbnail ?>" >
			<?php if(!$disable_single_page_link): ?>
			</a>
			<?php endif ?>
		<?php endif ?>
		<?php if( $displayPlay ):?>
		<button class="sonaar-play-button" href="javascript:IRON.sonaar.player.setPlayer({ id: <?php echo $post->ID; ?>, title:'<?php echo get_the_title( $post->ID )?>' })">
			<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18" height="18" x="0px" y="0px" viewBox="0 0 17.5 21.2" xml:space="preserve" class="sonaar-play-icon">
				<path d="M0,0l17.5,10.9L0,21.2V0z"></path> 
				<rect width="6" height="21.2"></rect>
				<rect x="11.5" width="6" height="21.2"></rect>
			</svg>
			<svg xmlns="http://www.w3.org/2000/svg" class="sonaar-play-circle" width="79.19" height="79.19">
			<circle r="50%" fill="none" stroke="black" stroke-width="6" cx="50%" cy="50%"></circle>
			</svg>
		</button>
		<?php endif ?>
	</div>

	<div class="sonaar-podcast-list-content">
		<?php if(!$disable_single_page_link): ?>
		<a title="<?php echo get_the_title( $post->ID )?>" href="<?php echo get_the_permalink( $post->ID ) ?> " class="sonaar-podcast-list-title">
		<?php endif ?>
			<?php the_title( '<h2 class="sr_it-item-title">', '</h2>' ); ?> 
		<?php if(!$disable_single_page_link): ?>
		</a>
		<?php endif; 
		if($length != 0 && !$hide_excerpt):?>
		<div class="sonaar-podcast-list-description">
			<?php 
			if( has_excerpt() ){ 
				$podcastDescription =  strip_shortcodes( get_the_excerpt() ); 
			}else{
				$podcastDescription =  strip_shortcodes( get_the_content() );		
			}
			if( $strip_html_excerpt ){
				$podcastDescription =  force_balance_tags( wp_trim_words( $podcastDescription, $length, '[...]' ) );
			}else{
				$podcastDescription =  force_balance_tags( html_entity_decode( wp_trim_words( htmlentities( $podcastDescription  ), $length, '[...]' ) ));
			}
			echo ( $podcastDescription );
			?>
		</div>
		<?php endif; ?>
		<?php if(!$hide_duration || !$hide_date || ( $iron_sonaar_term != NULL && !$hide_category ) ):?>
		<div class="meta-podcast">

			<?php if(!$hide_duration):?>
			<?php echo( !empty($trackLenght) )?'<div class="sonaar-duration">'. $trackLenght . '</div>':'';?>
			<?php endif ?>

			<?php if(!$hide_date):?>
			<time class="sonaar-date" datetime="<?php the_time('c'); ?>">
				<?php the_time( get_option('date_format') ); ?>
			</time>
			<?php endif ?>


			<?php if( $iron_sonaar_term != NULL && !$hide_category ):?>
			<div class="sonaar-category">
				<?php foreach ($iron_sonaar_term as $key => $value): ?>
				<a href="<?php echo get_term_link( $value->term_id, 'podcast-category') ?>">
					<?php echo wp_kses_post( (  $key + 1 == count( $iron_sonaar_term) )? $value->name  : $value->name . ', ' ); ?> 
				</a>
				<?php endforeach ?>
			</div>
			<?php endif ?>
		</div>
		<?php endif; ?>

		<div class="sonaar-callToAction-box">
			<?php if($callToAction && is_array($callToAction)): ?>
			<?php foreach($callToAction as $button): ?>
			<a href="<?php echo $button['podcast_button_link'] ?>" class="sonaar-callToAction" <?php echo esc_html($button['podcast_button_target'])?'target="_blank"':''?> ><?php echo $button['podcast_button_name'] ?></a>
			<?php endforeach ?>
			<?php endif ?>
		</div>
	</div>

	<?php if($play_button_position != 'left' && $displayPlay):?>
	<div class="sonaar-play-button-box">
		<button class="sonaar-play-button" href="javascript:IRON.sonaar.player.setPlayer({ id: <?php echo $post->ID; ?>, title:'<?php echo get_the_title( $post->ID )?>' })">
			<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18" height="18" x="0px" y="0px" viewBox="0 0 17.5 21.2" xml:space="preserve" class="sonaar-play-icon">
				<path d="M0,0l17.5,10.9L0,21.2V0z"></path> 
				<rect width="6" height="21.2"></rect>
				<rect x="11.5" width="6" height="21.2"></rect>
			</svg>
			<svg xmlns="http://www.w3.org/2000/svg" class="sonaar-play-circle" width="79.19" height="79.19">
				<circle r="50%" fill="none" stroke="black" stroke-width="6" cx="50%" cy="50%"></circle>
			</svg>
		</button>
	</div>
	<?php endif ?>
</article>