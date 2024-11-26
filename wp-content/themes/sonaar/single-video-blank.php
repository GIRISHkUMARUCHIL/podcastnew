<?php
// Template Name: Custom Video layout
// Template Post Type: video

get_header();
if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) {

global $post;


$iron_sonaar_single_post_featured_image = Iron_sonaar::getField('single_post_featured_image', $post->ID);
$iron_sonaar_show_post_date = (bool)Iron_sonaar::getOption('show_post_date', null, true);
$iron_sonaar_show_post_author = (bool)Iron_sonaar::getOption('show_post_author', null, true);
$iron_sonaar_show_post_categories = (bool)Iron_sonaar::getOption('show_post_categories', null, true);
$iron_sonaar_show_post_tags = (bool)Iron_sonaar::getOption('show_post_tags', null, true);


/**
 * Setup Dynamic Sidebar
 */

list( $iron_sonaar_has_sidebar, $iron_sonaar_sidebar_position, $iron_sonaar_sidebar_area ) = Iron_sonaar::setupDynamicSidebar( $post->ID ); ?>

<?php

$banner_background_type = Iron_sonaar::getField('banner_background_type', $post->ID);
$banner_typeCSS = ($banner_background_type)? '' : 'no-banner' ;
if ($banner_background_type !== 'null' && $banner_background_type !== '') {
	if ( $banner_background_type=='image-background' && Iron_sonaar::getField('banner_image', $post->ID) == '' ){
	} else {
		get_template_part('parts/page-banner');
	}
}

?>

		<!-- container -->
		<div class="container">
		<div class="boxed">

<?php if ( have_posts() ) :
	while ( have_posts() ) : the_post();
		$iron_sonaar_single_title = Iron_sonaar::getOption('single_video_page_title');
		if(!empty($iron_sonaar_single_title)): ?>
			<div class="page-title <?php (Iron_sonaar::isPageTitleUppercase() == true) ? 'uppercase' : '';?>">
				<span class="heading-t"></span>
				<h1><?php echo esc_html($iron_sonaar_single_title); ?></h1>
				<?php Iron_sonaar::displayPageTitleDivider(); ?>
			</div>
		<?php endif;

		if ( $iron_sonaar_has_sidebar ) : ?>
			<div id="twocolumns" class="content__wrapper<?php if ( 'left' === $iron_sonaar_sidebar_position ) echo ' content--rev'; ?>">
				<div id="content" class="content__main">
		<?php endif; ?>

		<!-- single-post -->
		<article id="post-<?php the_ID(); ?>" <?php post_class( $banner_typeCSS ); ?>>
			<?php
			if(!empty($iron_sonaar_single_title)):
				$headerSize = 'h2';
			else:
				$headerSize = 'h1';
			endif;


			if( Iron_sonaar::getField( 'hide_page_title', $post->ID ) != '1' ){
				the_title('<' . $headerSize . ' class="sr_it-singlepost-title">','</' . $headerSize . '>');
			}
			if (!$banner_background_type) {

				if($iron_sonaar_single_post_featured_image == 'original') {
					the_post_thumbnail( 'large' , array( 'class' => 'wp-featured-image original' ) );
				}else{
					the_post_thumbnail( 'large' , array( 'class' => 'wp-featured-image fullwidth' ) );
				}
			}?>


			<div class="entry">
				<?php the_content(); ?>
				<?php //comments_template(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'sonaar' ), 'after' => '</span></div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
			</div>
		</article>
		

		<?php

		if ( $iron_sonaar_has_sidebar ) : ?>
		</div>
			<aside id="sidebar" class="sr_it-content-side widget-area widget-area--<?php echo esc_attr( $iron_sonaar_sidebar_area ); ?>">
			<?php
				do_action('before_ironband_sidebar_dynamic_sidebar', 'single-video-blank.php');

				dynamic_sidebar( $iron_sonaar_sidebar_area );

				do_action('after_ironband_sidebar_dynamic_sidebar', 'single-video-blank.php');
			?>
			</aside>
			</div>
<?php 	endif;

	endwhile;
endif;
?>

		</div>
		</div>
<?php 
}
get_template_part('parts/prefooter'); 
get_footer(); 
?>