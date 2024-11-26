
<?php

$video_info_items = get_field('video_informations');

if( ! empty ( $video_info_items )  ){
		$video_info_inline = ( Iron_sonaar::getOption('sr_video_info_inline', null) == 1 ? 'sr-video-info--inlined' : '' );
		?>
		<div class="sr-video-items <?php echo $video_info_inline ?>">
		<?php
	foreach ( $video_info_items as $item ) {
		$link = '';
		$label  = '';
		$value  = '';
		$link_title = '';
		$link_url = '';
		$link_target = '';
		$label  = $item['video_info_label'];
		$value  = $item['video_info_text'];
		$link = ! empty( $item['video_info_link'] ) ? $item['video_info_link'] : '';
		if($link != ''){
			$link_url = $link['url'];
			$link_title = $link['title'];
			$link_target = $link['target'] ? $link['target'] : '_self';
		}
		?>
			<div class="sr-video-info-item">
				<?php if ( ! empty ( $label ) ) { ?>
					<?php if ( empty ( $link_title ) && empty ( $value ) && ! empty ( $link )) { ?>
					<a class="sr-video-info-item-link" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><span class="sr-video-info-item-title"><?php echo ( $label ); if ( ! empty ( $value ) || ! empty ( $link ) ){ }?></span></a>
					<?php } else { ?>
					<span class="sr-video-info-item-title"><?php echo ( $label ); if ( ! empty ( $value ) || ! empty ( $link ) ){ ?>: <?php }?></span>	
					<?php } ?>
					
				<?php } ?>
				<?php if ( ! empty ( $link ) ) { ?>
					<a class="sr-video-info-item-link" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
				<?php } else { ?>
					<span class="sr-video-info-item-value">
				<?php } ?>
				<?php if ( ! empty ( $value ) ) { ?>
					<?php echo wp_kses_post( $value ); ?>
				<?php } else if ( ! empty ( $link_title ) ) { ?>
					<?php echo wp_kses_post( $link_title ); ?>
				<?php } ?>
				<?php if ( empty ( $link ) ) { ?>
					</span	>
				<?php } else { ?>
					</a>
				<?php } ?>
			</div>
	<?php } ?>
	</div>
<?php } ?>