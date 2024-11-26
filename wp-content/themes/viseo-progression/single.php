<?php
/**
 * The template for displaying all single posts.
 *
 * @package pro
 */

get_header(); ?>
	
	<?php while ( have_posts() ) : the_post(); ?>
	<?php get_template_part( 'template-parts/post-title/title', 'default' ); ?>
	
	<?php get_template_part( 'template-parts/social', 'sharing-single' ); ?>
	
	<div id="content-pro" class="site-content-blog-post <?php if(get_post_meta($post->ID, 'progression_studios_group_552033a9a46bc', true)): ?>disable-sidebar-post-progression<?php endif; ?>">

		<div class="width-container-pro <?php if ( get_theme_mod( 'progression_studios_blog_post_sidebar') == 'left') : ?> left-sidebar-pro<?php endif; ?>">
				
				<?php if ( get_theme_mod( 'progression_studios_blog_post_sidebar', 'right') == 'right' || get_theme_mod( 'progression_studios_blog_post_sidebar', 'right') == 'left') : ?><div id="main-container-pro"><?php endif; ?>
					
					
					
					
					<?php get_template_part( 'template-parts/content', 'single' ); ?>
					
					<?php endwhile; // end of the loop. ?>
					
				<?php if ( get_theme_mod( 'progression_studios_blog_post_sidebar', 'right') =='right' || get_theme_mod( 'progression_studios_blog_post_sidebar', 'right') =='left') : ?></div><!-- close #main-container-pro --><?php get_sidebar(); ?><?php endif; ?>

				
		<div class="clearfix-pro"></div>
		</div><!-- close .width-container-pro -->
		
		
	</div><!-- #content-pro -->
		

<?php get_footer(); ?>