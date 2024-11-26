<?php
$term = get_queried_object();
$iron_sonaar_banner_background_type = get_field('banner_background_type', $term);
if($iron_sonaar_banner_background_type === 'image-background') {
	echo '.page-banner-bg{
		background:url(' . wp_get_attachment_url( get_field('banner_image', $term) ) . ');
		background-position:center ' . get_field('banner_background_alignement', $term) . ';}
		';
} else if ($iron_sonaar_banner_background_type === 'color-background' ) {
	echo '.page-banner-bg{background:' . get_field('banner_background_color', $term) . ';}';
}
if( intval( get_field('banner_height', $term ) ) > 0 && !get_field('banner_fullscreen', $term ) ){
	echo '#page-banner{height:' . intval( get_field( 'banner_height', $term ) ) . 'px;}';
}else{
	echo '#page-banner{height:350px;}';
}
$iron_sonaar_banner_font_color = get_field('banner_font_color', $term);
if(!empty($iron_sonaar_banner_font_color)) {
	echo '
	#page-banner .page-banner-content .inner .page-title, #page-banner .page-banner-content .inner .page-subtitle{
		color:'.$iron_sonaar_banner_font_color.';
	}';
}
$iron_sonaar_banner_subtitle_font_color = get_field('page_banner_subtitle_font_color', $term);
if(!empty($iron_sonaar_banner_subtitle_font_color)) {
	echo '
	#page-banner .page-banner-content .inner .page-subtitle{
		color:'.$iron_sonaar_banner_subtitle_font_color.';
	}';
}
$iron_sonaar_classic_menu_main_item_color = get_field('classic_menu_main_item_color_taxonomy', $term);
if(!empty($iron_sonaar_classic_menu_main_item_color)) {
	echo '
	.classic-menu:not(.responsive):not(.mini) #menu-main-menu li a, .classic-menu:not(.responsive):not(.mini) > ul > li.languages-selector > ul > li a, .classic-menu:not(.responsive):not(.mini) .classic-menu-hot-links > li a{
		color:'.$iron_sonaar_classic_menu_main_item_color.';
	}';
}
$iron_sonaar_classic_menu_background_taxonomy = get_field('classic_menu_background_taxonomy', $term);
if(!empty($iron_sonaar_classic_menu_background_taxonomy)) {
	echo '
	.classic-menu{
		background:'.$iron_sonaar_classic_menu_background_taxonomy.';
	}';
}

?>