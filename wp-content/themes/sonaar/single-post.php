<?php

get_header();

if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) {

	global $post;

	$iron_sonaar_single_post_featured_image = Iron_sonaar::getOption('single_post_featured_image', null, false);
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
			<div class="container <?php echo ( $iron_sonaar_has_sidebar )? 'sr_it-sidebar-enable':''; ?> <?php echo $iron_sonaar_sidebar_position ?>">
			<div class="boxed">

	<?php if ( have_posts() ) :
		while ( have_posts() ) : the_post();
			$iron_sonaar_single_title = ( Iron_sonaar::getOption('single_post_page_title') );
			if(!empty($iron_sonaar_single_title)): ?>
				<div class="page-title <?php (Iron_sonaar::isPageTitleUppercase() == true) ? 'uppercase' : '';?>">
					<span class="heading-t"></span>
					<h1><?php echo esc_html($iron_sonaar_single_title); ?></h1>
					<?php Iron_sonaar::displayPageTitleDivider(); ?>
				</div>

			<?php endif;

			if(!empty($iron_sonaar_single_title)):
				$headerSize = 'h2';
			else:
				$headerSize = 'h1';
			endif;

			if( Iron_sonaar::getField( 'hide_page_title', $post->ID ) != '1' ){
				the_title('<' . $headerSize . ' class="sr_it-singlepost-title">','</' . $headerSize . '>');
			}

			if ( $iron_sonaar_has_sidebar ) : ?>
				<div id="twocolumns" class="content__wrapper<?php if ( 'left' === $iron_sonaar_sidebar_position ) echo ' content--rev'; ?>">
					<div id="content" class="content__main">
			<?php endif; ?>

			<!-- single-post -->
			<article id="post-<?php the_ID(); ?>" <?php post_class( $banner_typeCSS ); ?>>

				<?php
				if ( $banner_background_type == 'null' || $banner_background_type == '') {

					switch ( $iron_sonaar_single_post_featured_image ) {
						case 'original':
							the_post_thumbnail( 'large' , array( 'class' => 'wp-featured-image original' ) );
							break;

						case 'fullwidth':
							the_post_thumbnail( 'large' , array( 'class' => 'wp-featured-image fullwidth' ) );
							break;

						case 'none':
							break;

						default:
							the_post_thumbnail( 'large' , array( 'class' => 'wp-featured-image fullwidth' ) );
							break;
					}
				}?>

				<!-- meta -->
				<div class="sr_it-meta">
					<?php //if( $iron_sonaar_show_post_date ): ?>
						<time class="sr_it-datetime" datetime="<?php the_time('c'); ?>"><?php the_time( get_option('date_format') ); ?></time>
					<?php //endif; ?>

					<?php if ( $iron_sonaar_show_post_author && get_the_author() != NULL): ?>
							<?php echo translateString('tr_by'); ?> <a class="sr_it-meta-author-link" href="<?php echo esc_url( get_author_posts_url(get_the_author_meta('ID') ) ) ?>"><?php the_author(); ?></a>
					<?php endif;

					$iron_sonaar_categories_list = get_the_category_list( ', ',get_the_ID() );
					if(!empty($iron_sonaar_categories_list) && $iron_sonaar_show_post_categories)
						echo wp_kses_post( '<span class="post-categories"><i class="fa-regular fa-folder-open"></i> '.$iron_sonaar_categories_list.'</span>');

					$iron_sonaar_tag_list = get_the_tag_list('',', ');
					if(!empty($iron_sonaar_tag_list) && $iron_sonaar_show_post_tags)
						echo wp_kses_post('<span class="post-tags"><i class="fa-solid fa-tag"></i> '.$iron_sonaar_tag_list.'</span>');
					?>
				</div>


				<div class="entry">
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'sonaar' ), 'after' => '</span></div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
				</div>
			</article>

			<?php

			get_template_part('parts/share');
			comments_template();

			if ( $iron_sonaar_has_sidebar ) : ?>
			</div>
				<aside id="sidebar" class="sr_it-content-side widget-area widget-area--<?php echo esc_attr( $iron_sonaar_sidebar_area ); ?>">
				<?php
					do_action('before_ironband_sidebar_dynamic_sidebar', 'single-post.php');

					dynamic_sidebar( $iron_sonaar_sidebar_area );

					do_action('after_ironband_sidebar_dynamic_sidebar', 'single-post.php');
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

get_footer(); ?>