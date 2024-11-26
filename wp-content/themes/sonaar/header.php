<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<?php wp_head(); ?>
</head>
<body <?php body_class() ?>>
	<div id="overlay"><div class="perspective"></div></div>
	
	<?php
	$post_id = (!is_null($post) )? $post->ID : NULL;
	$post_id = (  !is_archive() && is_object($wp_query->queried_object) && (int) get_option('page_for_posts') === $wp_query->queried_object->ID )? (int) get_option('page_for_posts') : $post_id;

	$iron_sonaar_fixed_header = Iron_sonaar::getOption('enable_fixed_header', null, '0');
	$iron_sonaar_menu_type = Iron_sonaar::getOption('menu_type', null, 'push-menu');
	$iron_sonaar_menu_position = Iron_sonaar::getOption('classic_menu_position', null, 'absolute absolute_before');
	$iron_sonaar_menu_is_over = Iron_sonaar::getField('classic_menu_over_content', $post_id );
	$iron_sonaar_menu_icon_toggle = (int)Iron_sonaar::getOption('header_menu_toggle_enabled', null, 1);

	$isElementorMenu =  ( function_exists( 'elementor_theme_do_location' ) ) ? elementor_theme_do_location( 'header' ) : false;

	if(!empty($iron_sonaar_menu_is_over)) {
		$iron_sonaar_menu_position = ($iron_sonaar_menu_position == 'absolute absolute_before') ? 'absolute' : 'fixed';
	}

	if ( $iron_sonaar_menu_type == "elementor-menu" && (! function_exists( 'elementor_theme_do_location' ) || !$isElementorMenu ) ) :

		/////////////  E L E M E N T O R   M E N U ///////////// 
		$iron_sonaar_block_header =  Iron_sonaar::getOption('block_header', NULL, NULL);
		
		$iron_sonaar_block_header_post = ( isset( $post ) )? Iron_sonaar::getField( 'block_header', $post_id ) : '';
		$iron_sonaar_block_header_post = ( isset( $iron_sonaar_archive ) )? Iron_sonaar::getField( 'block_header', $iron_sonaar_archive->getArchiveID() ) : $iron_sonaar_block_header_post;
		$iron_sonaar_block_header = ( $iron_sonaar_block_header_post !== 'null' && $iron_sonaar_block_header_post !== '' && !$iron_sonaar_block_header_post === false )? $iron_sonaar_block_header_post : $iron_sonaar_block_header;

		if(  get_post_type( get_the_ID() ) != 'block' ){
			if ( $iron_sonaar_block_header ){
					$iron_sonaar_block_header = ( class_exists('Sonaar_Lang') && method_exists('Sonaar_Lang', 'get_current_lang_id') )? get_post( Sonaar_Lang::get_current_lang_id( $iron_sonaar_block_header, 'block') ):get_post( $iron_sonaar_block_header );	
			}
		}

		$css_menu_position = ($iron_sonaar_menu_is_over) ? 'absolute' : 'relative';

		if ( $iron_sonaar_block_header && is_object($iron_sonaar_block_header)) : ?>

			<header class="sr-header" style="position:<?php echo $css_menu_position ?> ;z-index:99;" data-template="<?php echo $iron_sonaar_block_header->ID ?>"><?php
		
			if ( did_action( 'elementor/loaded' ) ) {
				$isElementor = \Elementor\Plugin::$instance->documents->get( $iron_sonaar_block_header->ID )->is_built_with_elementor();
			}
			if ( did_action( 'elementor/loaded' ) && $isElementor ){
				$content = \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $iron_sonaar_block_header->ID, true );
				//var_dump('test-a');
				//var_dump($iron_sonaar_block_header->ID);
				echo ( $content );
			} else {
				echo apply_filters( 'sonaar_content', $iron_sonaar_block_header->post_content );
			}
			
			?>
			</header><?php

		endif; ?>

		<div id="pusher-wrap" class="pusher-type-<?php echo esc_attr($iron_sonaar_menu_type);?>">
			<div id="pusher" class="menu-type-<?php echo esc_attr($iron_sonaar_menu_type);?>">
				<div class="pjax-container">
		<div id="wrapper" class="wrapper">
	<?php
	else:	
		//If a menu elementor pro is disable
		if ( (! function_exists( 'elementor_theme_do_location' ) || !$isElementorMenu ) && ( Iron_sonaar::getOption('classic_menu_position', null, 'absolute absolute_before') != 'absolute absolute_before' || Iron_sonaar::getOption('menu_type') == 'push-menu') ) : ?>
			<div class="sonaar-menu-box"><?php
		endif; 

		if ( ! function_exists( 'elementor_theme_do_location' ) || !$isElementorMenu ) :

			///////////// P U S H   M E N U /////////////////
			if($iron_sonaar_menu_type == 'push-menu') : 
				get_template_part('parts/push', 'menu'); 
				?>
				<header class="opacityzero"><?php

					if( $iron_sonaar_menu_icon_toggle !== 0) : ?>
						<div class="menu-toggle <?php echo ($iron_sonaar_menu_icon_toggle == 2)? 'hidden-on-desktop':'' ?>">
								<span class="svgfill"></span>
								<span class="svgfill"></span>
								<span class="svgfill"></span>
						</div><?php
					endif;

					get_template_part('parts/top-menu');

					if( Iron_sonaar::getOption('header_logo', null, get_template_directory_uri().'/images/sonaar-logo-black@1x.png') !== ''): ?>
						<a href="<?php echo esc_url( home_url('/'));?>" class="site-logo" title="<?php echo esc_attr( get_bloginfo('name') ); ?>"><?php
							$logoPageSelectVersion = ( !is_archive() && ( Iron_sonaar::getField('page_logo_select', $post_id ) !== 'null' && Iron_sonaar::getField('page_logo_select', $post_id ) !== '' ) )? Iron_sonaar::getField('page_logo_select', get_the_ID() ) : '';
							$logoSelectVersion = ( $logoPageSelectVersion )? $logoPageSelectVersion : Iron_sonaar::getOption('header_logo_select', null, 'dark');

							if( $logoSelectVersion == 'light' ){
								$iron_sonaar_logo1x = Iron_sonaar::getOption('header_alternative_logo', null, get_template_directory_uri().'/images/sonaar-logo-white@1x.png');
								$iron_sonaar_logo2x = Iron_sonaar::getOption('retina_header_alternative_logo', null, get_template_directory_uri().'/images/sonaar-logo-white@2x.png');
							}else{
								$iron_sonaar_logo1x = Iron_sonaar::getOption('header_logo', null, get_template_directory_uri().'/images/sonaar-logo-black@1x.png');
								$iron_sonaar_logo2x = Iron_sonaar::getOption('retina_header_logo', null, get_template_directory_uri().'/images/sonaar-logo-black@2x.png');

							} ?>
							<img id="menu-trigger" class="logo <?php echo ( Iron_sonaar::getOption( 'mobile_logo', null, false ) )? 'desktop ': '' ?>regular" src="<?php echo esc_url( $iron_sonaar_logo1x ); ?>" <?php echo ($iron_sonaar_logo2x)? 'srcset="' . esc_url( $iron_sonaar_logo1x ) . ' 1x,' . esc_url( $iron_sonaar_logo2x ) . ' 2x"' : ''?> alt="<?php echo esc_attr( get_bloginfo('name') ); ?>"><?php
							if ( Iron_sonaar::getOption( 'mobile_logo', null, false ) ):?>
								<img id="menu-trigger-mobile" class="logo mobile regular" src="<?php echo Iron_sonaar::getOption( 'mobile_logo', null, false ) ?>" alt="<?php echo esc_attr( get_bloginfo('name') ); ?>"><?php
							endif ?>
						</a><?php
					endif; ?>

				</header><?php

			endif;

			///////////// C L A S S I C   M E N U   N O T   O V E R   C O N T E N T /////////////////
			if($iron_sonaar_menu_type == 'classic-menu' && $iron_sonaar_menu_position != 'absolute' && $iron_sonaar_menu_position != 'absolute absolute_before') :
				get_template_part('parts/classic', 'menu'); //CLASSIC MENU
			endif;

		endif;
		?>

		<?php //End sonaar-menu-box (menu fixed)

		if ( (! function_exists( 'elementor_theme_do_location' ) || !$isElementorMenu ) && ( Iron_sonaar::getOption('classic_menu_position', null, 'absolute absolute_before') != 'absolute absolute_before' || Iron_sonaar::getOption('menu_type') == 'push-menu') ) : ?>
			</div><?php 
		endif ?>

		<div id="pusher-wrap" class="pusher-type-<?php echo esc_attr($iron_sonaar_menu_type);?>">
			<div id="pusher" class="menu-type-<?php echo esc_attr($iron_sonaar_menu_type);?>"><?php

				///////////// C L A S S I C   M E N U   +   O V E R   C O N T E N T /////////////////
				if($iron_sonaar_menu_type == 'classic-menu' && ($iron_sonaar_menu_position == 'absolute' || $iron_sonaar_menu_position == 'absolute absolute_before') ) :

					if ( ! function_exists( 'elementor_theme_do_location' ) || !$isElementorMenu ) : //If a menu elementor pro is disable?>
						<div class="sonaar-menu-box"><?php
						get_template_part('parts/classic', 'menu'); ?>
						</div><?php 
					endif;

				endif; //End Menu not fixed	?>

			<div class="pjax-container">
		<div id="wrapper" class="wrapper"> <?php

	endif;
