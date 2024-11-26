<?php
if( function_exists('is_shop') && is_shop() ){
	$postID = wc_get_page_id('shop');
}else{
	$postID = $post->ID;
}
if(isset($term)){
	$postID = get_queried_object();
	$taxonomyDescription=category_description( $wp_query->queried_object->term_id );
}
$iron_sonaar_banner_category_inherit = get_field('banner_inherit_setting', $postID);
if( $iron_sonaar_banner_category_inherit  ){
	$source = get_the_terms( $postID, 'podcast-category')[0];
}else{
	$source = $postID;
}

$iron_sonaar_banner_classes = array();
$iron_sonaar_banner_parallax = get_field('banner_parallax', $source);
$iron_sonaar_banner_fullscreen = (get_field('banner_fullscreen', $source ) == true && strlen(get_field('banner_fullscreen', $source )) < 2)?true: false;
$iron_sonaar_banner_texteditor_content = get_field('banner_texteditor_content', $source, false);
$iron_sonaar_banner_content_type = get_field('banner_content_type', $postID);
$iron_sonaar_banner_horizontal_content_alignment = get_field('banner_horizontal_content_alignment', $source);
$iron_sonaar_banner_vertical_content_alignment = get_field('banner_vertical_content_alignment', $source);
$iron_sonnar_banner_container = Iron_sonaar::getOption('container_type', null, 'container_fullwidth');
//$iron_sonaar_show_category_in_banner = (is_singular( 'video' )) ? (bool)Iron_sonaar::getOption('single_video_show_category_in_banner', null, true) : false;
$iron_sonaar_show_category_in_banner = false;
if (is_singular( 'video' ) ){
	$iron_sonaar_show_category_in_banner = (Iron_sonaar::getOption('single_video_show_category_in_banner') ==1 ) ? true : false;
} else if (is_singular( 'artist' ) ) {
	$iron_sonaar_show_category_in_banner = (Iron_sonaar::getOption('single_artist_show_category_in_banner') ==1 ) ? true : false;
} else if (is_singular( 'podcast' ) ) {
	$iron_sonaar_show_category_in_banner = (Iron_sonaar::getOption('single_episode_show_category_in_banner') ==1 ) ? true : false;
} else if (is_singular( 'event' ) ) {
	$iron_sonaar_show_category_in_banner = (Iron_sonaar::getOption('single_event_show_category_in_banner') ==1 ) ? true : false;
}
if( ( ($iron_sonaar_banner_category_inherit && get_field('banner_title', $postID) == '') || isset($term)) && isset($source) ){
	if( get_field('sr_banner_display_post_title', $source) == 1 || get_field('sr_banner_display_post_title', $postID) == 1){
		$iron_sonaar_banner_title = get_the_title();
	}else{
		$iron_sonaar_banner_title = $source->name;
	}

}else{
	if( get_field('sr_banner_display_post_title', $postID) == 1){
		$iron_sonaar_banner_title = get_the_title();
	}else{
		$iron_sonaar_banner_title = get_field('banner_title', $postID);
	}
}

if( ($iron_sonaar_banner_category_inherit && get_field('banner_subtitle', $postID) == '') && isset($source) ){
	$iron_sonaar_banner_subtitle = category_description( $source->term_id );
}else{
	$iron_sonaar_banner_subtitle = get_field('banner_subtitle', $postID);
}


if( $iron_sonnar_banner_container == 'container_boxed' ) array_push($iron_sonaar_banner_classes, 'container');
if( $iron_sonaar_banner_fullscreen ) array_push($iron_sonaar_banner_classes, 'fullscreen-banner');
if( $iron_sonaar_banner_parallax ) array_push( $iron_sonaar_banner_classes, 'parallax-banner' );

function getCategoryNames($post, $alignment ){
	if (is_singular( 'event' ) ){
		$categories = get_the_terms( $post->ID, 'events-category' );
	}else{
		$categories = get_the_terms( $post->ID, $post->post_type . '-category' );
	}
	$separator = ' | ';
	$output = '';
	if ( ! empty( $categories ) ) {
	    foreach( $categories as $category ) {
	        $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
	    }
	   //return trim( $output, $separator );
	   return '<div class="sr-banner-catnames ' . esc_attr( $alignment )  . '">' . wp_kses_post(trim( $output, $separator )) . '</div>';
	}
}

?>

<div id="page-banner" class="<?php echo esc_attr( implode( ' ',$iron_sonaar_banner_classes ) ); ?>">
	<div class="page-banner-bg"></div>
	<div class="page-banner-content">
		<div class="inner <?php echo esc_attr( $iron_sonaar_banner_vertical_content_alignment ) ?>">
			<div class="page-banner-row">
				<?php if($iron_sonaar_banner_content_type === 'advanced-content') : ?>
				<?php echo wp_kses_post( apply_filters( 'sonaar_content', $iron_sonaar_banner_texteditor_content ) );?>
				<?php else : ?>
				<?php
					if ($iron_sonaar_show_category_in_banner == true) {
						echo getCategoryNames($post, $iron_sonaar_banner_horizontal_content_alignment );
						//echo '<div class="sr-banner-catnames">' . wp_kses_post(getCategoryNames($post)) . '</div>';
					}
				?>
				<?php if($iron_sonaar_banner_title !== '') : ?>
				<h1 class="page-title <?php echo esc_attr( $iron_sonaar_banner_horizontal_content_alignment ) ?>">
					<?php echo wp_kses_post( $iron_sonaar_banner_title ) ?>
				</h1>
				<?php endif; ?>
				<span class="page-subtitle <?php echo esc_attr( $iron_sonaar_banner_horizontal_content_alignment ) ?>">
					<?php echo wp_kses_post( (isset($term))? $taxonomyDescription: $iron_sonaar_banner_subtitle ) ?>
				</span>
			<?php endif; ?>
			</div>
		</div>
	</div>
</div>