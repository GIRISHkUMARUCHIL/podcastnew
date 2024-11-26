<?php
/**
 * @package pro
 */
?>

<div class="progression-elements-slider-background" <?php if(has_post_thumbnail()): ?><?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'progression-studios-blog-post'); ?>style="background-image:url('<?php echo esc_attr($image[0]);?>')"<?php endif; ?>>
	<?php if (!get_post_meta($post->ID, 'progression_studios_video_embeding', true) ): ?><?php progression_studios_blog_link(); ?><?php endif; ?>
	<div class="slider-elements-display-table">
	
		<div class="slider-text-floating-container">
			<div class="slider-content-max-width">
				<div class="slider-content-margins">
					
					<?php if( get_post_meta($post->ID, 'progression_studios_video_embeding', true) ): ?>
						<div class="progression-studios-slider-video-embed">
							<?php echo apply_filters('progression_studios_video_content_filter', get_post_meta($post->ID, 'progression_studios_video_post', true)); ?>
						</div>
					<?php endif; ?>
					
					<?php if (get_post_meta($post->ID, 'progression_studios_video_embeding', true) ): ?><?php progression_studios_blog_link(); ?><?php endif; ?>
					<div class="slider-content-align-ment">
						
						<div class="slider-category-list"><?php foreach((get_the_category()) as $category) { echo '<span>' . $category->cat_name . '</span>'; } ?></div>
						<h2 class="progression-blog-slider-title"><?php the_title(); ?></h2>
						<?php if( get_post_meta($post->ID, 'progression_studios_sub_title', true) ): ?><h4 class="progression-blog-slider-sub-title"><?php echo esc_html(get_post_meta($post->ID, 'progression_studios_sub_title', true)); ?></h4><?php endif; ?>
						<?php if( get_post_meta($post->ID, 'progression_studios_additional_title', true) ): ?><h6 class="progression-blog-slider-smallest-title"><?php echo esc_html(get_post_meta($post->ID, 'progression_studios_additional_title', true)); ?></h6><?php endif; ?>
						
					</div>
					
					<?php if (get_post_meta($post->ID, 'progression_studios_video_embeding', true) ): ?></a><?php endif; ?>
					
				</div>
			</div><!-- close .slider-content-max-width -->
		</div><!-- close .slider-text-floating-container -->

	
	</div><!-- close .slider-elements-display-table -->
	
	
	<?php if (!get_post_meta($post->ID, 'progression_studios_video_embeding', true) ): ?>
	<?php if ( ! empty( $settings['progression_elements_slider_play_button'] )) : ?>
	<?php if (get_theme_mod( 'progression_studios_blog_video_play_display', 'true') == 'true' )  : ?>
	<?php if(has_post_format( 'video' ) || has_post_format( 'audio' ) ): ?>
		<div class="slider-play-icon"><i class="fa fa-play" aria-hidden="true"></i></div>
	<?php endif; ?>
	<?php endif; ?>
	<?php endif; ?>
	<?php endif; ?>
	
	
	<div class="slider-background-overlay-color"></div>

	<div class="clearfix-pro"></div>
	<?php if (!get_post_meta($post->ID, 'progression_studios_video_embeding', true) ): ?></a><?php endif; ?>
</div><!-- close .progression-elements-slider-background -->