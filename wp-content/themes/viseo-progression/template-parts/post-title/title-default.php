<?php
/**
 * @package pro
 */
?>

<?php if( !has_post_thumbnail() && !get_post_meta($post->ID, 'progression_studios_video_post', true) && !get_post_meta($post->ID, 'progression_studios_small_page_title_option', true) && !get_post_meta($post->ID, 'progression_studios_blog_post_embed_option', true)  ): ?>
	
	<div id="page-title-pro-post-page" class="progression-studios-embedded-video-single progression-page-title-shorter <?php if(has_post_thumbnail() ||  has_post_format( 'gallery' ) ): ?> remove-page-title-image<?php endif; ?>">

				<div id="progression-page-title-shorter-spacer"></div>
				
				<div id="blog-post-title-meta-container">
					<div class="width-container-pro">
						
						<div class="blog-single-comments-viewcount">
							<?php if (get_theme_mod( 'progression_studios_blog_single_meta_comment_display', 'true') == 'true') : ?><?php if ( comments_open() ) : ?><span class="blog-meta-comments"><i class="fa fa-comments" aria-hidden="true"></i> <?php comments_number( '0', '1', '%' ); ?></span><?php endif; ?><?php endif; ?>
							<?php if (get_theme_mod( 'progression_studios_blog_single_meta_view_count_display', 'true') == 'true') : ?><?php if ( function_exists('Post_Views_Counter') ) : ?><div class="blog-meta-views"><i class="fa fa-eye" aria-hidden="true"></i><?php echo do_shortcode( '[post-views]' ); ?></div><?php endif; ?><?php endif; ?>
						</div><!-- close .blog-floating-comments-viewcount -->
						
					<?php if (get_theme_mod( 'progression_studios_blog_meta_category_display', 'true') == 'true') : ?><div class="single-blog-meta-category-list"><?php the_category(' '); ?></div><?php endif; ?>
					<h1 class="blog-page-title"><?php the_title(); ?></h1>
				
					<div class="single-progression-post-meta">
						<?php if (get_theme_mod( 'progression_studios_blog_single_meta_author_display', 'true') == 'true') : ?><span class="blog-meta-author-display"><?php echo esc_html__( 'By ', 'viseo-progression' )?> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a></span><?php endif; ?>
				
							
							<?php if (get_theme_mod( 'progression_studios_blog_single_meta_author_display', 'true') == 'true' && get_theme_mod( 'progression_studios_blog_single_meta_date_display', 'true') == 'true') : ?><span class="progression-meta-mdash">&mdash;</span><?php endif; ?>
							
						<?php if (get_theme_mod( 'progression_studios_blog_single_meta_date_display', 'true') == 'true') : ?><span class="blog-meta-date-display"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) ; ?> <?php esc_html_e('ago','viseo-progression'); ?></span><?php endif; ?>
	
					</div>
					<div class="clearfix-pro"></div>
					</div><!-- close .width-container-pro -->
				</div><!-- close #blog-post-title-meta-container -->					
	</div><!-- #page-title-pro -->
	
<?php else: ?>
	


<?php if( has_post_format( 'audio' ) || get_post_meta($post->ID, 'progression_studios_video_post', true) && get_post_meta($post->ID, 'progression_studios_blog_post_embed_option', true) == 'progression_link_embed' || get_post_meta($post->ID, 'progression_studios_small_page_title_option', true)  ): ?>
	
	<div id="page-title-pro-post-page" class="progression-studios-embedded-video-single <?php if( get_post_meta($post->ID, 'progression_studios_small_page_title_option', true)    ): ?>progression-page-title-shorter<?php endif; ?> <?php if(has_post_thumbnail() ||  has_post_format( 'gallery' ) ): ?> remove-page-title-image<?php endif; ?>">
		<?php if(has_post_thumbnail()): ?><div id="blog-post-overlay-image" <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'progression-studios-blog-post'); ?>style="background-image:url('<?php echo esc_attr($image[0]);?>')"></div><?php endif; ?>
				
				
				<?php if( get_post_meta($post->ID, 'progression_studios_small_page_title_option', true)    ): ?><div id="progression-page-title-shorter-spacer"></div><?php endif; ?>

				
				<?php if( get_post_meta($post->ID, 'progression_studios_video_post', true)): ?>
					<div class="clearfix-pro"></div>
					<div class="blog-post-video-manual-embed">						
						<?php
								$videoURL = esc_url( get_post_meta($post->ID, 'progression_studios_video_post', true) );
								$oEmbed = wp_oembed_get( $videoURL );
								if ( $oEmbed != false ) {
									echo $oEmbed;
								} else {
									echo apply_filters('progression_studios_video_content_filter', get_post_meta($post->ID, 'progression_studios_video_post', true));
								}
							 ?>
					</div>
				<?php endif; ?>
						
				<div id="blog-post-title-meta-container">
					<div class="width-container-pro">
						
						<div class="blog-single-comments-viewcount">
							<?php if (get_theme_mod( 'progression_studios_blog_single_meta_comment_display', 'true') == 'true') : ?><?php if ( comments_open() ) : ?><span class="blog-meta-comments"><i class="fa fa-comments" aria-hidden="true"></i> <?php comments_number( '0', '1', '%' ); ?></span><?php endif; ?><?php endif; ?>
							<?php if (get_theme_mod( 'progression_studios_blog_single_meta_view_count_display', 'true') == 'true') : ?><?php if ( function_exists('Post_Views_Counter') ) : ?><div class="blog-meta-views"><i class="fa fa-eye" aria-hidden="true"></i><?php echo do_shortcode( '[post-views]' ); ?></div><?php endif; ?><?php endif; ?>
						</div><!-- close .blog-floating-comments-viewcount -->
						
					<?php if (get_theme_mod( 'progression_studios_blog_meta_category_display', 'true') == 'true') : ?><div class="single-blog-meta-category-list"><?php the_category(' '); ?></div><?php endif; ?>
					<h1 class="blog-page-title"><?php the_title(); ?></h1>
				
					<div class="single-progression-post-meta">
						<?php if (get_theme_mod( 'progression_studios_blog_single_meta_author_display', 'true') == 'true') : ?><span class="blog-meta-author-display"><?php echo esc_html__( 'By ', 'viseo-progression' )?> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a></span><?php endif; ?>
				
						<?php if (get_theme_mod( 'progression_studios_blog_single_meta_date_display', 'true') == 'true') : ?><span class="progression-meta-mdash">&mdash;</span> <span class="blog-meta-date-display"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) ; ?> <?php esc_html_e('ago','viseo-progression'); ?></span><?php endif; ?>
	
					</div>
					<div class="clearfix-pro"></div>
					</div><!-- close .width-container-pro -->
				</div><!-- close #blog-post-title-meta-container -->					
	</div><!-- #page-title-pro -->
	

	
<?php else: ?>
	


		<div id="page-title-pro-post-page" <?php if(has_post_thumbnail() ||  has_post_format( 'gallery' ) ): ?>class="remove-page-title-image"<?php endif; ?>>
			<?php if(has_post_thumbnail() && !has_post_format( 'gallery' ) ): ?><div id="blog-post-overlay-image" <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'progression-studios-blog-post'); ?>style="background-image:url('<?php echo esc_attr($image[0]);?>')"></div><?php endif; ?>
				
					<?php if( has_post_format( 'gallery' ) && get_post_meta($post->ID, 'progression_studios_gallery', true)  ): ?>
						
						<div class="flexslider progression-studios-gallery">
					      <ul class="slides">
								<?php $files = get_post_meta( get_the_ID(),'progression_studios_gallery', 1 ); ?>
								<?php foreach ( (array) $files as $attachment_id => $attachment_url ) : ?>
								<li>
									<div class="blog-single-gallery-post-format" style="background-image:url(<?php echo wp_get_attachment_image_url( $attachment_id, 'progression-studios-blog-post' ); ?>);"></div>
								</li>
								<?php endforeach;  ?>
							</ul>
						</div><!-- close .flexslider -->
						
					
				<?php else: ?>
					<?php if( get_post_meta($post->ID, 'progression_studios_video_post', true) && get_post_meta($post->ID, 'progression_studios_blog_post_embed_option', true) == 'progression_link_default'  ): ?>
					<a href="<?php echo esc_url( get_post_meta($post->ID, 'progression_studios_video_post', true) );?>" id="blog-link-page-title" data-rel="prettyPhoto"><div class="single-blog-play-icon"><i class="fa fa-play" aria-hidden="true"></i></div></a>
					<?php endif; ?>
					<?php endif; ?>
					
					<div id="blog-post-title-meta-container">
						<div class="width-container-pro">
							
							<div class="blog-single-comments-viewcount">
								<?php if (get_theme_mod( 'progression_studios_blog_single_meta_comment_display', 'true') == 'true') : ?><?php if ( comments_open() ) : ?><span class="blog-meta-comments"><i class="fa fa-comments" aria-hidden="true"></i> <?php comments_number( '0', '1', '%' ); ?></span><?php endif; ?><?php endif; ?>
								<?php if (get_theme_mod( 'progression_studios_blog_single_meta_view_count_display', 'true') == 'true') : ?><?php if ( function_exists('Post_Views_Counter') ) : ?><div class="blog-meta-views"><i class="fa fa-eye" aria-hidden="true"></i><?php echo do_shortcode( '[post-views]' ); ?></div><?php endif; ?><?php endif; ?>
							</div><!-- close .blog-floating-comments-viewcount -->
							
						<?php if (get_theme_mod( 'progression_studios_blog_meta_category_display', 'true') == 'true') : ?><div class="single-blog-meta-category-list"><?php the_category(' '); ?></div><?php endif; ?>
						<h1 class="blog-page-title"><?php the_title(); ?></h1>
					
						<div class="single-progression-post-meta">
							<?php if (get_theme_mod( 'progression_studios_blog_single_meta_author_display', 'true') == 'true') : ?><span class="blog-meta-author-display"><?php echo esc_html__( 'By ', 'viseo-progression' )?> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a></span><?php endif; ?>
					
							<?php if (get_theme_mod( 'progression_studios_blog_single_meta_date_display', 'true') == 'true') : ?><span class="progression-meta-mdash">&mdash;</span> <span class="blog-meta-date-display"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) ; ?> <?php esc_html_e('ago','viseo-progression'); ?></span><?php endif; ?>
		
						</div>
						<div class="clearfix-pro"></div>
						</div><!-- close .width-container-pro -->
					</div><!-- close #blog-post-title-meta-container -->					
		</div><!-- #page-title-pro -->
	

<?php endif; ?>


<?php endif; ?>