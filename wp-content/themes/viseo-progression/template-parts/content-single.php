<?php
/**
 * @package pro
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="progression-single-container">

		<div class="progression-blog-single-content">
			
			<?php if(!get_post_meta($post->ID, 'progression_studios_disable_advertisement_post', true)): ?>
			<?php if ( is_active_sidebar( 'progression-studios-post-widgets-top') ) { ?>
				<div class="widget-area-top-of-posts"><?php dynamic_sidebar( 'progression-studios-post-widgets-top' ); ?></div>			
			<?php } ?>
			<?php endif; ?>
			
			<div class="progression-studios-blog-single-excerpt">
				<?php the_content(); ?>
			
				<?php wp_link_pages( array(
					'before' => '<div class="progression-page-nav">' . esc_html__( 'Pages:', 'viseo-progression' ),
					'after'  => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					) );
				?>
			</div>
			
			<?php if(!get_post_meta($post->ID, 'progression_studios_disable_advertisement_post', true)): ?>
			<?php if ( is_active_sidebar( 'progression-studios-post-widgets-bottom' ) ) { ?>
				<div class="widget-area-bottom-of-posts"><?php dynamic_sidebar( 'progression-studios-post-widgets-bottom' ); ?></div>	
			<?php } ?>
			<?php endif; ?>
			
			<?php the_tags(  '<div class="tags-progression"><i class="fa fa-tags"></i>', ' ', '</div><div class="clearfix-pro"></div>' ); ?> 
			
			<?php if(get_the_author_meta('description')) : ?>
				<?php get_template_part( 'template-parts/author', 'info' ); ?>
			<?php endif; ?>
			
			<?php get_template_part( 'template-parts/related', 'posts' ); ?>
			
			<div class="clearfix-pro"></div>
			
			<?php if ( comments_open() || get_comments_number() ) : comments_template(); endif; ?>
			
		</div><!-- close .progression-blog-content -->

	<div class="clearfix-pro"></div>
	
	
	</div><!-- close .progression-single-container -->
</div><!-- #post-## -->