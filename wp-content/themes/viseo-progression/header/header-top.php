<div id="viseo-progression-header-top" class="<?php echo esc_attr(get_theme_mod('progression_studios_mobile_top_bar_left', 'progression_studios_hide_top_left_bar')); ?> <?php echo esc_attr(get_theme_mod('progression_studios_mobile_top_bar_right', 'progression_studios_hide_top_left_right')); ?>">
	<div class="width-container-pro">
		
		<div class="progression-studios-header-left">
			<?php wp_nav_menu( array('theme_location' => 'progression-studios-header-top-left', 'container_id' => 'progression-header-top-left-container', 'menu_class' => 'sf-menu', 'fallback_cb' => false, 'walker'  => new ProgressionFrontendWalker ) ); ?>
			<?php dynamic_sidebar( 'progression-studios-header-top-left' ); ?>
			<?php if ( get_theme_mod( 'progression_studios_header_icon_location' ) == 'icon-left-pro' ) : ?><div class="prohibition-header-icons-left"><?php get_template_part( 'header/header', 'icons' ); ?></div><?php endif; ?>
			<div class="clearfix-pro"></div>
		</div>

		<div class="progression-studios-header-right">
			<?php dynamic_sidebar( 'progression-studios-header-top-right' ); ?>
			<?php if ( get_theme_mod( 'progression_studios_header_icon_location' ) == 'icon-right-pro' ) : ?><div class="prohibition-header-icons-right"><?php get_template_part( 'header/header', 'icons' ); ?></div><?php endif; ?>
			<?php wp_nav_menu( array('theme_location' => 'progression-studios-header-top-right', 'container_id' => 'progression-header-top-right-container', 'menu_class' => 'sf-menu', 'fallback_cb' => false, 'walker'  => new ProgressionFrontendWalker ) ); ?>
			<div class="clearfix-pro"></div>
		</div>
		
		<div class="clearfix-pro"></div>
	</div>
</div><!-- close #header-top -->