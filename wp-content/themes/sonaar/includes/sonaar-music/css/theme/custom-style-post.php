<?php

if( function_exists('is_shop') && is_shop() ){
	$post_id = wc_get_page_id('shop');
}else{
	$post_id = (!is_null($post) )? $post->ID : NULL;
	if(is_object($wp_query->queried_object)){
		$post_id = ( (int) get_option('page_for_posts') === $wp_query->queried_object->ID )? (int) get_option('page_for_posts') : $post_id;
	}
}

$backup_id = $post_id;
$iron_styles = new Dynamic_Styles('sonaar_single');



	$parents = get_post_ancestors($post_id);

	$background_id = ( Iron_sonaar::getField('background', $post_id ) )? Iron_sonaar::getField('background', $post_id ) : false ;
	$content_background_color = ( get_post_meta($post_id, 'content_background_color', true) )? get_post_meta($post_id, 'content_background_color', true) : false ;


	while( $background_id && $content_background_color && !empty($parents)) {

		$post_id = array_pop($parents);
		$background_id = Iron_sonaar::getField('background', $post_id);
		$content_background_color = get_post_meta($post_id, 'content_background_color', true);
	}

	if( $background_id ) {

		if( $background_id ) {
			$background_url = wp_get_attachment_image_src( $background_id, 'full' );
			$background_url = $background_url[0];
		}else{
			$background_url = 'none';
		}

		$background_repeat = Iron_sonaar::getField('background_repeat', $post_id);
		$background_size = Iron_sonaar::getField('background_size', $post_id);
		$background_position = Iron_sonaar::getField('background_position', $post_id);
		$background_attachment = 'initial';

		$iron_styles->useOptions(false);


		$background = array(
			'background-image' => $background_url,
			'background-repeat' => $background_repeat,
			'background-size' => $background_size,
			'background-position' => ( $background_position != 'null' )? $background_position : '0% 0%',
			'background-attachment' => $background_attachment,
		);

		$iron_styles->setBackground('#overlay .perspective', $background );

	}

	$content_background_color = ( get_post_meta($post_id, 'content_background_color', true) )? get_post_meta($post_id, 'content_background_color', true) : false ;
	$content_background_transparency = Iron_sonaar::getField('content_background_transparency', $post_id);
	$iron_styles->useOptions(false);

	if( $content_background_color && isset( $content_background_transparency ) ) {
		$rgb = $iron_styles->hex2rgb( $content_background_color );
		$rgba = "rgba(".($rgb[0].",".$rgb[1].",".$rgb[2].",".$content_background_transparency).")";
		$iron_styles->set('#overlay .perspective, .single-album .sr_it-single-post.featured, .single-album .sr_it-singlealbum-sidecover-wrapper, .single-album .content-box', 'background-color', $rgba);

	}else{

		if( $content_background_color )
			$iron_styles->set('#overlay .perspective', 'background-color', $content_background_color);

		if( isset( $content_background_transparency ) )
			$iron_styles->set('#overlay .perspective', 'opacity', $content_background_transparency);
	}


	$background_color = ( get_post_meta($post_id, 'background_color', true) )? get_post_meta($post_id, 'background_color', true) : false ;

	if ( $background_color )
		$iron_styles->set('#overlay', 'background-color', $background_color);

	$iron_styles->useOptions(true);

// FEATURED COLOR


$post_id = $backup_id;

if($post_id) {

	$menu_background = Iron_sonaar::getField('classic_menu_background', $post_id);

	if(!empty($menu_background)) {

		$menu_background_alpha = Iron_sonaar::getField('classic_menu_background_alpha', $post_id);

		if(isset($menu_background_alpha)) {

			$rgb = $iron_styles->hex2rgb($menu_background);
			$menu_background = "rgba(".($rgb[0].",".$rgb[1].",".$rgb[2].",".$menu_background_alpha).")";
		}
		$iron_styles->useOptions(false);
		if( Iron_sonaar::getOption('menu_type') == "elementor-menu" ){
			echo 'header section:not(.sr_sticky_showup){
					background-color:'. $menu_background . '!important;
					background-image: initial!important;
					box-shadow: none!important;
				}
				header section:not(.sr_sticky_showup) .elementor-column-wrap{
					background:none!important;
					box-shadow: none!important;
				}
			';
			//$iron_styles->setBackgroundColor('header section', $menu_background, true);
		}else{
			$iron_styles->setBackgroundColor('.classic-menu', $menu_background);
		}
		$iron_styles->useOptions(true);

	}else{
		if( Iron_sonaar::getOption('menu_type') == "classic-menu" ){
			$iron_styles->setBackgroundColor('.classic-menu', 'classic_menu_background');
			$iron_styles->setBackgroundColor('.classic-menu > ul', 'classic_menu_inner_background');
		}
	}

	$iron_styles->useOptions(false);
	$menu_is_over = Iron_sonaar::getField('classic_menu_over_content', $post_id);
	$menu_main_item_color = Iron_sonaar::getField('classic_menu_main_item_color', $post_id);
	
	// check if menu background color has an opacity
	$mobile_menu_header_color = $iron_styles->parseRGBa(Iron_sonaar::getOption('classic_mobile_header_background'));
	if( Iron_sonaar::getOption('menu_type') == "classic-menu" && !empty($menu_is_over) && $mobile_menu_header_color["a"]<1 ){
		echo '@media only screen and (max-width: 1159px){
				#pusher.menu-type-classic-menu {
					padding-top: 0px!important;
				}}';
	}
	if(!empty($menu_is_over)){
		if( Iron_sonaar::getOption('menu_type') == "elementor-menu" ){
			echo 'header section:not(.sr_sticky_showup){
				box-shadow: none!important;
			}
			header section:not(.sr_sticky_showup) .elementor-column-wrap{
				box-shadow: none!important;
			}
			';
			if( Iron_sonaar::getOption('over_content_transparent') ){
				echo '
				.sr-over-content header section:not(.sr_sticky_showup), .sr-over-content header section:not(.sr_sticky_showup) .elementor-motion-effects-layer​{
					background-color: rgba(0,0,0,0)!important;
					background-image: initial!important;
				}
				';
			}
		}

		echo '@media only screen and (max-width: 1159px){
				.boxed {
					margin-top: 0px!important;
				}}';
	}
	if(!empty($menu_is_over) && !empty($menu_main_item_color)) {
		if( Iron_sonaar::getOption('menu_type') == "elementor-menu" ){
			echo 'header section:not(.sr_sticky_showup), header section:not(.sr_sticky_showup) .sr-e-desktop > ul > li > a, header section:not(.sr_sticky_showup) .elementor-heading-title, header section:not(.sr_sticky_showup) .elementor-social-icon i{
				color:'. $menu_main_item_color . '!important;
			}';
		}else{
			$iron_styles->set('.classic-menu:not(.fixed_before):not(.mini):not(.responsive) #menu-main-menu>li>a, .classic-menu:not(.fixed_before):not(.mini):not(.responsive) #menu-main-menu>li>a, .classic-menu:not(.fixed_before):not(.mini):not(.responsive) .languages-selector a, .classic-menu:not(.responsive):not(.mini) .classic-menu-hot-links > li a', 'color', $menu_main_item_color);
			$iron_styles->set('.classic-menu:not(.absolute_before):not(.mini):not(.responsive) #menu-main-menu>li>a, .classic-menu:not(.absolute_before):not(.mini):not(.responsive) #menu-main-menu>li>a, .classic-menu:not(.absolute_before):not(.mini):not(.responsive) .languages-selector a', 'color', $menu_main_item_color);
		}
	}
	$iron_styles->useOptions(true);

}else{
	if( Iron_sonaar::getOption('menu_type') == "classic-menu" ){
		$iron_styles->setBackgroundColor('.classic-menu', 'classic_menu_background');
		$iron_styles->setBackgroundColor('.classic-menu > ul', 'classic_menu_inner_background');
	}
}
// News title font color on hover
$global_custom_css = $iron_styles->get_option('custom_css');
$iron_styles->setCustomCss($global_custom_css);


if(Iron_sonaar::getField('hamburger_icon_color', $post_id)){
	$iron_hamburger_color = Iron_sonaar::getField('hamburger_icon_color', $post_id);
	if( Iron_sonaar::getOption('menu_type') == "elementor-menu" ){
		echo 'header section:not(.sr_sticky_showup) .sr-offcanvas-toggle, header section:not(.sr_sticky_showup) .sr-e-menu-toggle{
			color:'. $iron_hamburger_color . '!important;
		}';
		echo 'header section:not(.sr_sticky_showup) .sr-offcanvas-toggle svg, header section:not(.sr_sticky_showup) .sr-e-menu-toggle svg{
			fill:'. $iron_hamburger_color . '!important;
		}';
	}
}else{
	$iron_hamburger_color = Iron_sonaar::getOption('menu_open_icon_color', null, '#000000');
}
$iron_styles->render();

echo '.menu-toggle span, .menu-toggle.toggled span{ background-color: '. $iron_hamburger_color .'; }';

echo '.menu-toggle rect{
	fill:' . $iron_hamburger_color . ';

}';
echo 'ul.header-top-menu li a{color:' . $iron_hamburger_color . ';}';
echo '.menu-toggle-off polygon{
	fill:' . Iron_sonaar::getOption('menu_close_icon_color', null, '#ffffff') . ';
}';

$iron_sonaar_banner_category_inherit = Iron_sonaar::getField('banner_inherit_setting', $post_id);

if( $iron_sonaar_banner_category_inherit ){
	$source = get_the_terms( $post_id, 'podcast-category')[0];
}else{
	$source = $post_id;
}	
$iron_sonaar_content_banner_overlap = get_field('content_banner_overlap', $source);

if( $iron_sonaar_banner_category_inherit && (  get_field('banner_background_type', $post_id) == false || get_field('banner_background_type', $post_id) == '' || get_field('banner_background_type', $post_id) == 'null') ){
	$iron_sonaar_banner_background_type = get_field('banner_background_type', $source);
}else{
	$iron_sonaar_banner_background_type = get_field('banner_background_type', $post_id);
}

if($iron_sonaar_banner_category_inherit && ((get_field('banner_background_type', $post_id) === 'image-background' && get_field('banner_image', $post_id) == '') || get_field('banner_background_type', $post_id) === false  || get_field('banner_background_type', $post_id) == '' || get_field('banner_background_type', $post_id) == 'null')){
	$backgroundImageId = get_field('banner_image', $source);
	$backgroundImageAlignement = get_field('banner_background_alignement', $source);
}else{
	$backgroundImageId = get_field('banner_image', $post_id);
	$backgroundImageAlignement = get_field('banner_background_alignement', $post_id);
}

if($iron_sonaar_banner_category_inherit && ((get_field('banner_background_type', $post_id) === 'color-background' && get_field('banner_background_color', $post_id) == '')|| get_field('banner_background_type', $post_id) === false || get_field('banner_background_type', $post_id) === 'null' )){
	$backgroundColor = get_field('banner_background_color', get_the_terms($post_id, 'podcast-category')[0]);

}else{
	$backgroundColor = get_field('banner_background_color', $post_id);
}

if($iron_sonaar_banner_background_type === 'image-background') {
	echo '.page-banner-bg{
		background:url(' . wp_get_attachment_url( $backgroundImageId ) . ');
		background-position:center ' . $backgroundImageAlignement . ';}
		';
		if(!empty($iron_sonaar_content_banner_overlap)) {
			echo '
			#wrapper .container{
				margin-top:-120px;
			}';
		}
} else if ($iron_sonaar_banner_background_type === 'color-background' ) {
	echo '.page-banner-bg{background:' . $backgroundColor . ';}';
		if(!empty($iron_sonaar_content_banner_overlap)) {
			echo '
			#wrapper .container{
				margin-top:-120px;
			}';
		}
}
if( get_field('banner_fullscreen', $source) == 'keep-image-ratio' && $iron_sonaar_banner_background_type === 'image-background' && ( isset($backgroundImageId) || $backgroundImageId != '' )){
	$img = wp_get_attachment_image($backgroundImageId, 'full');
	$xmlEl = simplexml_load_string($img);
	$imageWidth = $xmlEl->attributes()->{'width'};
	$imageHeight = $xmlEl->attributes()->{'height'};
	$fixedRatioHeight = ($imageHeight / $imageWidth * 100).'vw';
	echo '#page-banner{height:'. $fixedRatioHeight .';}';
}else if( intval( get_field('banner_height', $source ) ) > 0 && ( get_field('banner_fullscreen', $source) == 'custom-height' || get_field('banner_fullscreen', $source) == 0 )){//This condition "get_field('banner_fullscreen', $source) == 0 )" is about retro compatibility
	echo '#page-banner{height:' . intval( get_field( 'banner_height', $source ) ) . 'px;}';
}else{
	echo '#page-banner{height:350px;}';
}

if($iron_sonaar_banner_category_inherit && get_field('banner_font_color', $post_id) == ''){
	$iron_sonaar_banner_font_color = get_field('banner_font_color', $source);
}else{
	$iron_sonaar_banner_font_color = get_field('banner_font_color', $post_id);
}

if(!empty($iron_sonaar_banner_font_color)) {
	echo '
	#page-banner .page-banner-content .inner .page-title, #page-banner .page-banner-content .page-subtitle, #page-banner .sr-banner-catnames, #page-banner .sr-banner-catnames a{
		color:'.$iron_sonaar_banner_font_color.';
	}';
}

if($iron_sonaar_banner_category_inherit && get_field('page_banner_subtitle_font_color', $post_id) == ''){
	$iron_sonaar_banner_subtitle_font_color = get_field('page_banner_subtitle_font_color', $source);
}else{
	$iron_sonaar_banner_subtitle_font_color = get_field('page_banner_subtitle_font_color', $post_id);
}

if(!empty($iron_sonaar_banner_subtitle_font_color)) {
	echo '
	#page-banner .page-banner-content .inner .page-subtitle{
		color:'.$iron_sonaar_banner_subtitle_font_color.';
	}';
}


switch ( Iron_sonaar::getField('album_background_type', $post_id ) ) {
	case 'image':
		$iron_sonaar_background_image = wp_get_attachment_image_src( Iron_sonaar::getField('album_background_image', $post_id), 'full' );

		echo '.album-header .backCover{
			background: url(' . $iron_sonaar_background_image[0] . ') center center no-repeat;
			background-size: cover;
		}';
		break;

	case 'color':
		$iron_sonaar_background_color =  Iron_sonaar::getField('album_background_color', $post_id);
		echo '.album-header .backCover{ background-color:' . $iron_sonaar_background_color . '}';
		break;

	case 'blurry':
		if ( get_post_thumbnail_id( $post_id ) !== "" ) {
			$attachment_id = get_post_thumbnail_id( $post_id );
			$iron_sonaar_imageFileURL = wp_get_attachment_url( $attachment_id );

			echo '
			.album-header .backCover{
				background: url(' . $iron_sonaar_imageFileURL . ') center center no-repeat;
				background-size: cover;
				filter: blur(30px);
			}';
		}

		break;
	default:
		break;

}
$divider_image = Iron_sonaar::getOption('page_title_divider_image');
$divider_color = Iron_sonaar::getOption('page_title_divider_color', null, '#000000');
$divider_margin_top = Iron_sonaar::getOption('page_title_divider_margin_top');
$divider_margin_bottom = Iron_sonaar::getOption('page_title_divider_margin_bottom');

if(empty($divider_image)){
	echo 'span.heading-b3{
		margin-top:'.esc_attr($divider_margin_top).'px;
		margin-bottom:'.esc_attr($divider_margin_bottom).'px;
		background-color:'.esc_attr($divider_color).';
	}';
} else {
	echo 'span.custom-header-img{
		margin-top:'.esc_attr($divider_margin_top).'px;
		margin-bottom:'.esc_attr($divider_margin_bottom).'px;

	}';
}


$iron_sonaar_menu_icon_toggle = (int)Iron_sonaar::getOption('header_menu_toggle_enabled', null, 1);
if($iron_sonaar_menu_icon_toggle == 0 || $iron_sonaar_menu_icon_toggle == 2){
	echo '.header-top-menu{
		padding-right:10px;
		padding-left:10px;
	}';
}