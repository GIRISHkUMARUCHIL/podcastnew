<?php
/**
 * The Header for our theme.
 *
 * @package pro
 * @since pro 1.0
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php get_template_part( 'header/social', 'sharing' ); ?>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php get_template_part( 'header/page', 'loader' ); ?>
	<div id="boxed-layout-pro" <?php progression_studios_page_title(); ?>>
		
		<div id="progression-studios-header-position">
		<?php get_template_part( 'header/header', 'top' ); ?>
		
		<?php if (get_theme_mod( 'progression_studios_header_sticky', 'sticky-pro' ) == 'sticky-pro' && get_theme_mod( 'progression_studios_logo_position', 'progression-studios-logo-position-left' ) != 'progression-studios-logo-position-center'  ) : ?><div id="progression-sticky-header"><?php endif; ?>
			<header id="masthead-pro" class="progression-studios-site-header <?php echo esc_attr( get_theme_mod('progression_studios_nav_align', 'progression-studios-nav-left') ); ?>">
				<?php if (get_theme_mod( 'progression_studios_header_sticky', 'sticky-pro' ) == 'sticky-pro') : ?><div id="progression-studios-sidebar-sticky-header"><?php endif; ?>
					
					<div id="logo-nav-pro">
						
						<div class="width-container-pro progression-studios-logo-container">
							<h1 id="logo-pro" class="logo-inside-nav-pro noselect"><?php progression_studios_logo(); ?></h1>
						</div><!-- close .width-container-pro -->
						
						<?php progression_studios_navigation(); ?>
						
					</div><!-- close #logo-nav-pro -->
					<?php get_template_part( 'header/mobile', 'navigation' ); ?>
				
				<?php if (get_theme_mod( 'progression_studios_header_sticky', 'sticky-pro' ) == 'sticky-pro' ) : ?></div><!-- close #progression-studios-sidebar-sticky-header --><?php endif; ?>
			</header>
		<?php if (get_theme_mod( 'progression_studios_header_sticky', 'sticky-pro' ) == 'sticky-pro' && get_theme_mod( 'progression_studios_logo_position', 'progression-studios-logo-position-left' ) != 'progression-studios-logo-position-center') : ?></div><!-- close #progression-sticky-header --><?php endif; ?>
		</div><!-- close #progression-studios-header-position -->
