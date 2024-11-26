<?php
/**
 * @package pro
 */

?>




<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
	<div class="progression-studios-default-blog-index <?php echo esc_attr( $settings['progression_elements_post_image_transition'] ); ?>">

		<?php if(has_post_thumbnail()): ?>
			<div class="progression-studios-feaured-image">
				<?php progression_studios_blog_link(); ?>
					<?php the_post_thumbnail('progression-studios-blog-index'); ?>
					
					<?php if (get_theme_mod( 'progression_studios_blog_video_play_display', 'true') == 'true') : ?>
					<?php if(has_post_format( 'video' ) || has_post_format( 'audio' ) ): ?>
						<div class="blog-play-icon"><i class="fa fa-play" aria-hidden="true"></i></div>
					<?php endif; ?>
					<?php endif; ?>
					
					<div class="blog-floating-comments-viewcount">
						<?php if (get_theme_mod( 'progression_studios_blog_meta_comment_display', 'true') == 'true') : ?><?php if ( comments_open() ) : ?><span class="blog-meta-comments"><i class="fa fa-comments" aria-hidden="true"></i> <?php comments_number( '0', '1', '%' ); ?></span><?php endif; ?><?php endif; ?>
						<?php if (get_theme_mod( 'progression_studios_blog_meta_view_count_display', 'true') == 'true') : ?><?php if ( function_exists('Post_Views_Counter') ) : ?><div class="blog-meta-views"><i class="fa fa-eye" aria-hidden="true"></i><?php echo do_shortcode( '[post-views]' ); ?></div><?php endif; ?><?php endif; ?>
					</div><!-- close .blog-floating-comments-viewcount -->
					
				</a>
			</div><!-- close .progression-studios-feaured-image -->
		<?php else: ?>
	
		<?php if(has_post_format( 'video' ) && get_post_meta($post->ID, 'progression_studios_video_post', true) || has_post_format( 'audio' ) && get_post_meta($post->ID, 'progression_studios_video_post', true)  ): ?>
		
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
									<?php if(get_post_meta($post->ID, 'progression_studios_blog_featured_image_link', true) == 'progression_link_lightbox'): ?>
									<a href="<?php echo esc_attr($lightbox_pro[0]);?>" data-rel="prettyPhoto[gallery-<?php the_ID(); ?>]" <?php $get_description = get_post($attachment_id)->post_excerpt; if(!empty($get_description)){ echo 'title="' . $get_description . '"'; } ?>>
									<?php else: ?>
									<a <?php echo progression_studios_blog_index_gallery(); ?> <?php $get_description = get_post($attachment_id)->post_excerpt; if(!empty($get_description)){ echo 'title="' . $get_description . '"'; } ?>>
									<?php endif; ?> 
									<?php echo wp_get_attachment_image( $attachment_id, 'progression-studios-blog-index' ); ?>
									
									<div class="blog-floating-comments-viewcount">
										<?php if (get_theme_mod( 'progression_studios_blog_meta_comment_display', 'true') == 'true') : ?><?php if ( comments_open() ) : ?><span class="blog-meta-comments"><i class="fa fa-comments" aria-hidden="true"></i><?php comments_number( '0', '1', '%' ); ?></span><?php endif; ?><?php endif; ?>
										<?php if (get_theme_mod( 'progression_studios_blog_meta_view_count_display', 'true') == 'true') : ?><?php if ( function_exists('Post_Views_Counter') ) : ?><div class="blog-meta-views"><i class="fa fa-eye" aria-hidden="true"></i><?php echo do_shortcode( '[post-views]' ); ?></div><?php endif; ?><?php endif; ?>
									</div><!-- close .blog-floating-comments-viewcount -->
									
									</a></li>
								<?php endforeach;  ?>
							</ul>
						</div><!-- close .flexslider -->
		
					</div><!-- close .progression-studios-feaured-image -->

					<?php endif; ?><!-- close featured thumbnail -->
				
				<?php endif; ?><!-- close gallery -->
			
		<?php endif; ?><!-- close video -->
		
		<div class="progression-blog-content">
			<?php if ( 'post' == get_post_type() ) : ?>
				<?php if (get_theme_mod( 'progression_studios_blog_meta_category_display', 'true') == 'true') : ?><div class="blog-meta-category-list"><?php the_category(' '); ?></div><?php endif; ?>
			<?php endif; ?>
			
			<h2 class="progression-blog-title"><?php progression_studios_blog_post_title(); ?><?php the_title(); ?></a></h2>

			<?php if ( 'post' == get_post_type() ) : ?>
				<div class="progression-post-meta">
					<?php if (get_theme_mod( 'progression_studios_blog_meta_author_display', 'true') == 'true') : ?><span class="blog-meta-author-display"><?php echo esc_html__( 'By ', 'viseo-progression' )?> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a></span><?php endif; ?>
					
					<?php if (get_theme_mod( 'progression_studios_blog_meta_date_display', 'true') == 'true') : ?><span class="progression-meta-mdash">&mdash;</span> <span class="blog-meta-date-display"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) ; ?> <?php esc_html_e('ago','viseo-progression'); ?></span><?php endif; ?>
		
				</div>
			<?php endif; ?>
			
			<div class="progression-studios-blog-excerpt">
				<?php if(has_excerpt() ): ?><?php the_excerpt(); ?><?php else: ?>
					<?php if ( 'post' == get_post_type() ) : ?>
				<?php the_content( sprintf( wp_kses( __( 'Read More', 'viseo-progression' ), array(  'i' => array( 'id' => array(),  'class' => array(),  'style' => array(),  ), 'span' => array( 'class' => array() ) ) ), the_title( '<span class="screen-reader-text">"', '"</span>', false ) ) ); ?>
				<?php endif; ?>
				<?php endif; ?>
			
			
			<?php wp_link_pages( array(
				'before' => '<div class="progression-page-nav">' . esc_html__( 'Pages:', 'viseo-progression' ),
				'after'  => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				) );
			?>
			</div>
			
			
			
		</div><!-- close .progression-blog-content -->
	
		<?php if ( is_sticky() && is_home() && ! is_paged() ) { printf( '<div class="progression-studios-sticky-post">%s</div>', esc_html__( 'FEATURED', 'viseo-progression' ) ); } ?>
	
	<div class="clearfix-pro"></div>
	</div><!-- close .progression-studios-default-blog-index -->
</div><!-- #post-## -->