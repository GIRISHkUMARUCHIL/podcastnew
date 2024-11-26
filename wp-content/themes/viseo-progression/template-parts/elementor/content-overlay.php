<?php
/**
 * @package pro
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
	<div class="progression-studios-default-blog-overlay <?php echo esc_attr( $settings['progression_elements_post_image_transition'] ); ?>">
		
		<?php if(has_post_format( 'video' ) && get_post_meta($post->ID, 'progression_studios_video_post', true) && !has_post_thumbnail()   ): ?><?php else: ?><?php progression_studios_blog_link(); ?><?php endif; ?>

		<?php if(has_post_thumbnail()): ?>
			<div class="progression-studios-feaured-image">
					<?php the_post_thumbnail('progression-studios-blog-background-cover'); ?>
					
					<?php if (get_theme_mod( 'progression_studios_blog_video_play_display', 'true') == 'true') : ?>
					<?php if(has_post_format( 'video' ) || has_post_format( 'audio' ) ): ?>
						<div class="blog-play-icon"><i class="fa fa-play" aria-hidden="true"></i></div>
					<?php endif; ?>
					<?php endif; ?>
			</div><!-- close .progression-studios-feaured-image -->
		<?php else: ?>
	
		<?php if(has_post_format( 'video' ) && get_post_meta($post->ID, 'progression_studios_video_post', true)   ): ?>
		
			<div class="progression-studios-feaured-image video-progression-studios-format">
				<?php echo apply_filters('progression_studios_video_content_filter', get_post_meta($post->ID, 'progression_studios_video_post', true)); ?>
			</div>
		
			<?php else: ?>
			
				<?php if( has_post_format( 'gallery' ) && get_post_meta($post->ID, 'progression_studios_gallery', true)  ): ?>
					<div class="progression-studios-feaured-image">
						<div class="flexslider progression-studios-gallery">
					      <ul class="slides">
								<?php $files = get_post_meta( get_the_ID(),'progression_studios_gallery', 1 ); ?>
								<?php foreach ( (array) $files as $attachment_id => $attachment_url ) : ?>
								<?php $lightbox_pro = wp_get_attachment_image_src($attachment_id, 'large'); ?>
								<li>
									<?php echo wp_get_attachment_image( $attachment_id, 'progression-studios-blog-background-cover' ); ?>
								</li>
								<?php endforeach;  ?>
							</ul>
						</div><!-- close .flexslider -->
		
					</div><!-- close .progression-studios-feaured-image -->

					<?php endif; ?><!-- close featured thumbnail -->
				
				<?php endif; ?><!-- close gallery -->
			
		<?php endif; ?><!-- close video -->
		
		<div class="overlay-progression-blog-content">
			<div class="overlay-progression-blog-content-padding">
				<?php if ( 'post' == get_post_type() ) : ?>
					<?php if (get_theme_mod( 'progression_studios_blog_meta_category_display', 'true') == 'true') : ?><div class="overlay-blog-meta-category-list"><?php foreach((get_the_category()) as $category) { echo '<span>' . $category->cat_name . '</span>'; } ?></div><?php endif; ?>
				<?php endif; ?>
			
				<h2 class="overlay-progression-blog-title"><?php the_title(); ?></h2>

				<?php if ( 'post' == get_post_type() ) : ?>
					<div class="progression-post-meta">
						<?php if (get_theme_mod( 'progression_studios_blog_meta_author_display', 'true') == 'true') : ?><span class="blog-meta-author-display"><?php echo esc_html__( 'By ', 'viseo-progression' )?> <?php the_author(); ?></span><?php endif; ?>
					
						<?php if (get_theme_mod( 'progression_studios_blog_meta_date_display', 'true') == 'true') : ?><span class="progression-meta-mdash">&mdash;</span> <span class="blog-meta-date-display"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) ; ?> <?php esc_html_e('ago','viseo-progression'); ?></span><?php endif; ?>
		
					</div>
				<?php endif; ?>
			
				<div class="overlay-blog-floating-comments-viewcount">
					<?php if (get_theme_mod( 'progression_studios_blog_meta_comment_display', 'true') == 'true') : ?><?php if ( comments_open() ) : ?><span class="blog-meta-comments"><i class="fa fa-comments" aria-hidden="true"></i> <?php comments_number( '0', '1', '%' ); ?></span><?php endif; ?><?php endif; ?>
					<?php if (get_theme_mod( 'progression_studios_blog_meta_view_count_display', 'true') == 'true') : ?><?php if ( function_exists('Post_Views_Counter') ) : ?><div class="blog-meta-views"><i class="fa fa-eye" aria-hidden="true"></i><?php echo do_shortcode( '[post-views]' ); ?></div><?php endif; ?><?php endif; ?>
				</div><!-- close .blog-floating-comments-viewcount -->
				
				
				
			</div><!-- close .overlay-progression-blog-content-padding -->
			
			
		</div><!-- close .overlay-progression-blog-content -->
		
		
		<div class="overlay-blog-gradient"></div>
		
		<?php if(has_post_format( 'video' ) && get_post_meta($post->ID, 'progression_studios_video_post', true) && !has_post_thumbnail()   ): ?><?php else: ?></a><?php endif; ?>
		
		
	<div class="clearfix-pro"></div>
	</div><!-- close .progression-studios-default-blog-overlay -->
</div><!-- #post-## -->