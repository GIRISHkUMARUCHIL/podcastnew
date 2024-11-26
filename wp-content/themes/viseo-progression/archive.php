<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package pro
 */

get_header(); ?>
	

	<div id="page-title-pro">
		<div class="width-container-pro">
			<div id="progression-studios-page-title-container">
				<?php the_archive_title( '<h1 class="page-title">', '</h1>'  ); ?>
				<?php the_archive_description( '<h4 class="progression-sub-title">', '</h4>' ); ?>
			</div><!-- #progression-studios-page-title-container -->
			<div class="clearfix-pro"></div>
		</div><!-- close .width-container-pro -->
	</div><!-- #page-title-pro -->
	
		<div id="content-pro" class="site-content">
			<div class="width-container-pro <?php if ( get_theme_mod( 'progression_studios_blog_cat_sidebar' ) == 'left-sidebar' ) : ?> left-sidebar-pro<?php endif; ?>">
				
					<?php if(get_theme_mod( 'progression_studios_blog_cat_sidebar' ) == 'left-sidebar' || get_theme_mod( 'progression_studios_blog_cat_sidebar', 'right-sidebar' ) == 'right-sidebar' ) : ?><div id="main-container-pro"><?php endif; ?>
				
				
					<?php if ( have_posts() ) : ?>
						<div class="progression-studios-blog-index">
						
							<div class="progression-masonry-margins"  style="margin-top:-<?php echo esc_attr(get_theme_mod('progression_studios_blog_index_gap', '20')); ?>px; margin-left:-<?php echo esc_attr(get_theme_mod('progression_studios_blog_index_gap', '20')); ?>px; margin-right:-<?php echo esc_attr(get_theme_mod('progression_studios_blog_index_gap', '20')); ?>px;">
								<div class="progression-blog-index-masonry">
									<?php while ( have_posts() ) : the_post(); ?>
										<div class="progression-masonry-item progression-masonry-col-<?php echo esc_attr(get_theme_mod( 'progression_studios_blog_columns', '2')); ?>">
											<div class="progression-masonry-padding-blog" style="padding:<?php echo esc_attr(get_theme_mod('progression_studios_blog_index_gap', '20')); ?>px;">
												<div class="progression-studios-isotope-animation">
													<?php if (get_theme_mod( 'progression_studios_blog_index_layout', 'default') == 'default') : ?>
														<?php get_template_part( 'template-parts/content', get_post_format() ); ?>
													<?php else : ?>
														<?php get_template_part( 'template-parts/content', 'overlay' ); ?>
													<?php endif; ?>
												</div>
											
											</div>
										</div>
									<?php endwhile; ?>
									
									</div><!-- close .progression-blog-masonry -->
								</div><!-- close .progression-masonry-margins -->
							
						</div><!-- close .progression-studios-blog-index -->
					
					<div class="clearfix-pro"></div>
					
						<?php if (get_theme_mod( 'progression_studios_blog_pagination', 'default' ) == 'default') : ?>
							<?php progression_studios_show_pagination_links_pro(); ?>
						<?php endif; ?>
				
						<?php if (get_theme_mod( 'progression_studios_blog_pagination') == 'load-more') : ?>
							<div id="progression-load-more-manual"><?php progression_studios_infinite_content_nav_pro( 'nav-below' ); ?></div>
						<?php endif; ?>
				
						<?php if (get_theme_mod( 'progression_studios_blog_pagination') == 'infinite-scroll') : ?>
							<?php progression_studios_infinite_content_nav_pro( 'nav-below' ); ?>
						<?php endif; ?>
					
						<div class="clearfix-pro"></div>
					
					<?php else : ?>
					
						<div class="progression-studios-blog-index">
							<?php get_template_part( 'template-parts/content', 'none' ); ?>
						</div><!-- close .progression-masonry-margins -->
					
					<?php endif; ?>
			
				
					<?php if(get_theme_mod( 'progression_studios_blog_cat_sidebar' ) == 'left-sidebar' || get_theme_mod( 'progression_studios_blog_cat_sidebar', 'right-sidebar' ) == 'right-sidebar' ) : ?></div><!-- close #main-container-pro --><?php get_sidebar(); ?><?php endif; ?>
				
			<div class="clearfix-pro"></div>
			</div><!-- close .width-container-pro -->
		</div><!-- #content-pro -->
<?php get_footer(); ?>