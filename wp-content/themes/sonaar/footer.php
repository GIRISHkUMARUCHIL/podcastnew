<?php
global $iron_sonaar_archive;
if( function_exists('is_shop') && is_shop() ){
	$post_id = wc_get_page_id('shop');
}else if( isset($post) ){
	$post_id = $post->ID;
}


	$iron_sonaar_fixed_header = Iron_sonaar::getOption('enable_fixed_header', null, '0');
	$iron_sonaar_menu_type = Iron_sonaar::getOption('menu_type', null, 'push-menu');
	$iron_sonaar_menu_position = Iron_sonaar::getOption('classic_menu_position', null, 'absolute absolute_before');

	$iron_sonaar_block_footer =  Iron_sonaar::getOption('block_footer', NULL, NULL);
	$iron_sonaar_block_footer_post = ( isset( $post ) )? Iron_sonaar::getField( 'block_footer', $post_id ) : '';
	$iron_sonaar_block_footer_post = ( isset( $iron_sonaar_archive ) )? Iron_sonaar::getField( 'block_footer', $iron_sonaar_archive->getArchiveID() ) : $iron_sonaar_block_footer_post;
	$iron_sonaar_block_footer = ( $iron_sonaar_block_footer_post !== 'null' && $iron_sonaar_block_footer_post !== '' && !$iron_sonaar_block_footer_post === false )? $iron_sonaar_block_footer_post : $iron_sonaar_block_footer;

	if(  get_post_type( get_the_ID() ) != 'block' ){
		if ( $iron_sonaar_block_footer ){
				$iron_sonaar_block_footer = ( class_exists('Sonaar_Lang') && method_exists('Sonaar_Lang', 'get_current_lang_id') )? get_post( Sonaar_Lang::get_current_lang_id( $iron_sonaar_block_footer, 'block') ):get_post( $iron_sonaar_block_footer );	
		}
	}

?>
	</div>


	<?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) : ?>
	<!-- footer -->
	<footer id="footer">
		<div class="container">
		<?php
			if ( $iron_sonaar_block_footer && is_object($iron_sonaar_block_footer)) {
				if ( function_exists( 'addShortcodesCustomCss' ) )
					addShortcodesCustomCss( $iron_sonaar_block_footer->ID );

				if ( function_exists( 'addPageCustomCss' ) )
					addPageCustomCss( $iron_sonaar_block_footer->ID );

				if ( did_action( 'elementor/loaded' ) ) {
						$isElementor = \Elementor\Plugin::$instance->documents->get( $iron_sonaar_block_footer->ID )->is_built_with_elementor();
				}
				if( did_action( 'elementor/loaded' ) && $isElementor){
					$content = \Elementor\Plugin::$instance->frontend->get_builder_content_for_display($iron_sonaar_block_footer->ID, false);
					echo do_shortcode($content); 
				   
				}else{
					echo apply_filters('sonaar_content', $iron_sonaar_block_footer->post_content );
				}
			}

		?>

		<?php $iron_sonaar_footer_area = Iron_sonaar::getOption('footer-area_id', null, 'sonaar_sidebar_2');
		if ( is_active_sidebar( $iron_sonaar_footer_area ) ) :
			$iron_sonaar_widget_area = Iron_sonaar::getOption('widget_areas', $iron_sonaar_footer_area, array(
				'sidebar_name' => esc_html_x('Default Footer', 'Theme Options', 'sonaar'),
				'sidebar_desc' => esc_html_x('Site footer widget area.', 'Theme Options', 'sonaar'),
				'sidebar_grid' => 1,
				'order_no'     => 3
			)); ?>
			<div class="footer__widgets widget-area widget-area--<?php echo esc_attr( $iron_sonaar_footer_area ); if ( array_key_exists('sidebar_grid', $iron_sonaar_widget_area) && $iron_sonaar_widget_area['sidebar_grid'] > 1 ) echo ' grid-cols grid-cols--' . esc_attr($iron_sonaar_widget_area['sidebar_grid']); ?>">
				<?php
					do_action('before_ironband_footer_dynamic_sidebar');

					dynamic_sidebar( $iron_sonaar_footer_area );

					do_action('after_ironband_footer_dynamic_sidebar');
				?>
			</div>
		<?php endif;?>
		</div>
	</footer>
	<!--- end if elementor footer location -->
	<?php endif;?>
 </div>
<?php

		if(($iron_sonaar_menu_type == 'elementor-menu') || ($iron_sonaar_menu_type == 'push-menu' && empty($iron_sonaar_fixed_header)) || ($iron_sonaar_menu_type == 'classic-menu' && ($iron_sonaar_menu_position == 'fixed' || $iron_sonaar_menu_position == 'fixed_before'))) : ?>
		</div>
	<?php endif;

	if(($iron_sonaar_menu_type == 'elementor-menu') ||($iron_sonaar_menu_type == 'push-menu' && !empty($iron_sonaar_fixed_header)) || ($iron_sonaar_menu_type == 'classic-menu' && ($iron_sonaar_menu_position != 'fixed' || $iron_sonaar_menu_position == 'fixed_before'))) : ?>
		</div>
	<?php endif;?>
	</div>
</div>
<?php wp_footer(); ?>
</body>
</html>