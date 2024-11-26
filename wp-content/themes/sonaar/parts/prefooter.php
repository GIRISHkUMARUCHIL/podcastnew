<?php

$postType = get_post_type();

switch ($postType) {
    case 'post':
        $iron_sonaar_block =  Iron_sonaar::getOption('block_post', NULL, NULL);	
        break;
    case 'album':
        $iron_sonaar_block =  Iron_sonaar::getOption('block_playlist', NULL, NULL);	
        break;
    case 'artist':
        $iron_sonaar_block =  Iron_sonaar::getOption('block_artist', NULL, NULL);	
		break;
	case 'podcast':
		$iron_sonaar_block =  Iron_sonaar::getOption('block_podcast', NULL, NULL);	
		break;
	case 'podcastshow':
		$iron_sonaar_block =  Iron_sonaar::getOption('block_podcastshow', NULL, NULL);	
		break;
	case 'event':
		$iron_sonaar_block =  Iron_sonaar::getOption('block_event', NULL, NULL);	
		break;
	case 'video':
		$iron_sonaar_block =  Iron_sonaar::getOption('block_video', NULL, NULL);	
		break;
}

if ( $iron_sonaar_block && $iron_sonaar_block != '' ) {
	$iron_sonaar_block = ( class_exists('Sonaar_Lang') && method_exists('Sonaar_Lang', 'get_current_lang_id') )? get_post( Sonaar_Lang::get_current_lang_id( $iron_sonaar_block, 'block') ): get_post( $iron_sonaar_block );

	if ( function_exists( 'addShortcodesCustomCss' ) )
		addShortcodesCustomCss( $iron_sonaar_block->ID );

	if ( function_exists( 'addPageCustomCss' ) )
		addPageCustomCss( $iron_sonaar_block->ID );

	if ( is_plugin_active( 'elementor/elementor.php' ) ) {
		$isElementor = \Elementor\Plugin::$instance->documents->get( $iron_sonaar_block->ID )->is_built_with_elementor();
	}
	if( is_plugin_active( 'elementor/elementor.php' ) && $isElementor){
		$content = \Elementor\Plugin::$instance->frontend->get_builder_content_for_display($iron_sonaar_block->ID, false);
		echo do_shortcode($content); 
	   
	}else{
		echo apply_filters('sonaar_content', $iron_sonaar_block->post_content );
	}
}
