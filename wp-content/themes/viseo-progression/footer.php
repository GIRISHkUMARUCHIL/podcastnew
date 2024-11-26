<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package pro
 * @since pro 1.0
 */
?>
		<footer id="site-footer" class="<?php echo esc_attr( get_theme_mod('progression_studios_footer_width', 'progression-studios-footer-full-width') ); ?> <?php echo esc_attr( get_theme_mod('progression_studios_footer_image_location_align') ); ?> <?php echo esc_attr( get_theme_mod('progression_studios_footer_nav_align') ); ?> <?php echo esc_attr( get_theme_mod('progression_studios_footer_copyright_location', 'footer-copyright-align-left') ); ?>">
			
			<div id="widget-area-progression">
			<div class="width-container-pro <?php echo esc_attr(get_theme_mod('progression_studios_footer_widget_count', 'footer-3-pro')); ?>">
				
				
				<?php if ( get_theme_mod( 'progression_studios_footer_image_location') == 'top') : ?>
					<?php if ( get_theme_mod( 'progression_studios_footer_logo_image') ) : ?>
						<div id="progression-studios-footer-logo"><?php if ( get_theme_mod( 'progression_studios_footer_logo_link')) : ?><a href="<?php echo esc_url( get_theme_mod('progression_studios_footer_logo_link') ); ?>"><?php endif ?><img src="<?php echo esc_attr( get_theme_mod( 'progression_studios_footer_logo_image') ); ?>" alt="<?php bloginfo('name'); ?>"><?php if ( get_theme_mod( 'progression_studios_footer_logo_link')) : ?></a><?php endif ?></div>
					<?php endif; ?>
				<?php endif ?>
				
				<?php if ( get_theme_mod( 'progression_studios_footer_icon_location') == 'top') : ?><?php get_template_part( 'footer', 'icons' ); ?><?php endif ?>
				
				<?php if ( get_theme_mod( 'progression_studios_footer_nav_location') == 'top') : ?>
				<?php wp_nav_menu( array('theme_location' => 'progression-studios-footer-menu', 'menu_class' => 'progression-studios-footer-nav-container-class', 'fallback_cb' => false, 'depth' => '1', 'walker'  => new ProgressionFrontendWalker ) ); ?>
				<?php endif ?>
				
				<div class="clearfix-pro"></div>
				
				<?php if ( is_active_sidebar( 'progression-studios-footer-widgets' ) ) { ?>
					<?php dynamic_sidebar( 'progression-studios-footer-widgets' ); ?>					
				<?php } ?>

				<div class="clearfix-pro"></div>
				</div><!-- close .width-container-pro -->
			</div><!-- close #widget-area-pro -->
			
			
			<div id="progression-studios-lower-widget-container">
				<div class="width-container-pro <?php echo esc_attr(get_theme_mod('progression_studios_footer_widget_count_row_two', 'footer-3-pro')); ?>">
					
					<?php if ( get_theme_mod( 'progression_studios_footer_image_location') == 'middle') : ?>
						<?php if ( get_theme_mod( 'progression_studios_footer_logo_image') ) : ?>
							<div id="progression-studios-footer-logo"><?php if ( get_theme_mod( 'progression_studios_footer_logo_link')) : ?><a href="<?php echo esc_url( get_theme_mod('progression_studios_footer_logo_link') ); ?>"><?php endif ?><img src="<?php echo esc_attr( get_theme_mod( 'progression_studios_footer_logo_image') ); ?>" alt="<?php bloginfo('name'); ?>"><?php if ( get_theme_mod( 'progression_studios_footer_logo_link')) : ?></a><?php endif ?></div>
						<?php endif; ?>
					<?php endif ?>
					
					<?php if ( is_active_sidebar( 'progression-studios-footer-widgets-second-row' ) ) { ?>
						<?php dynamic_sidebar( 'progression-studios-footer-widgets-second-row' ); ?>
					<?php } ?>
					
					<?php if ( get_theme_mod( 'progression_studios_footer_icon_location', 'middle') == 'middle') : ?><?php get_template_part( 'footer', 'icons' ); ?><?php endif ?>
					
					<?php if ( get_theme_mod( 'progression_studios_footer_nav_location') == 'middle') : ?>
					<div class="clearfix-pro"></div>
					<?php wp_nav_menu( array('theme_location' => 'progression-studios-footer-menu', 'menu_class' => 'progression-studios-footer-nav-container-class', 'fallback_cb' => false, 'depth' => '1', 'walker'  => new ProgressionFrontendWalker ) ); ?>
					<?php endif ?>
					
				<div class="clearfix-pro"></div>
				</div><!-- close .width-container-pro -->
			</div><!-- close #progression-studios-navigation-middle-container -->

			
			<?php if ( get_theme_mod('progression_studios_footer_copyright', 'Copyright 2019. Developed by Progression Studios') ) : ?>
			
			<div id="progression-studios-copyright">
				<div class="width-container-pro">
					
					<?php if ( get_theme_mod( 'progression_studios_footer_image_location', 'bottom') == 'bottom') : ?>
						<?php if ( get_theme_mod( 'progression_studios_footer_logo_image' ) ) : ?>
							<div id="progression-studios-footer-logo"><?php if ( get_theme_mod( 'progression_studios_footer_logo_link')) : ?><a href="<?php echo esc_url( get_theme_mod('progression_studios_footer_logo_link') ); ?>"><?php endif ?><img src="<?php echo esc_attr( get_theme_mod( 'progression_studios_footer_logo_image' ) ); ?>" alt="<?php bloginfo('name'); ?>"><?php if ( get_theme_mod( 'progression_studios_footer_logo_link')) : ?></a><?php endif ?></div>
						<?php endif; ?>
					<?php endif ?>
					
				</div> <!-- close .width-container-pro -->	
				
				
					<div class="width-container-pro">
						<div id="copyright-divider-top"></div>
						<?php if ( get_theme_mod( 'progression_studios_footer_icon_location') == 'bottom') : ?><?php get_template_part( 'footer', 'icons' ); ?><?php endif ?>
						
					<?php if ( get_theme_mod( 'progression_studios_footer_nav_location', 'bottom') == 'bottom') : ?>
					<?php wp_nav_menu( array('theme_location' => 'progression-studios-footer-menu', 'menu_class' => 'progression-studios-footer-nav-container-class', 'fallback_cb' => false, 'depth' => '1', 'walker'  => new ProgressionFrontendWalker ) ); ?>
					<?php endif ?>
				
				
				<div id="copyright-text">
						<?php echo wp_kses(get_theme_mod( 'progression_studios_footer_copyright', 'Copyright 2017. Developed by Progression Studios' ), true); ?>
				</div>		
				
				</div> <!-- close .width-container-pro -->			
				<div class="clearfix-pro"></div>
					
				
			</div><!-- close #progression-studios-copyright -->
			<?php endif; ?>
			
		</footer>

	</div><!-- close #boxed-layout-pro -->
	<a href="#0" id="pro-scroll-top"><?php esc_html_e( 'Scroll to top', 'viseo-progression' ); ?></a>
	
<?php wp_footer(); ?>
</body>
</html>