<?php 
if ( is_tax( 'podcast-category') ) {
	load_template( get_template_directory() . '/taxonomy-podcast-category.php', true );
	return;
}

get_header();
// Elementor `archive` location
if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'archive' ) ) {

	global $iron_sonaar_archive;
	$archive_title = Iron_sonaar::getOption('podcast_archive_page_title');
	$sidebar = Iron_sonaar::getOption('podcast_category_default_sidebar', null);
	$sidebarPosition = Iron_sonaar::getOption('podcast_category_sidebar_position');

	if( !isset($iron_sonaar_archive) ){
		$iron_sonaar_archive = new Iron_sonaar_Archive();
		$iron_sonaar_archive->setPostType( get_post_type() );
		$iron_sonaar_archive->setItemTemplate( 'podcast_list' );
		$iron_sonaar_archive->compile();
	}

	// Template ajax
	if( !empty($_POST["ajax"]) ){
		load_template( get_template_directory('archive-ajax.php'), true );
		return;
	}
	?>
		<!-- container -->
		<div class="container">
			<div class="boxed">

				<?php if(!empty($archive_title)): ?>
				<div class="page-title <?php (Iron_sonaar::isPageTitleUppercase() == true) ? 'uppercase' : '';?>">
					<span class="heading-t"></span>
					<h1><?php echo esc_html($archive_title); ?></h1>
					<?php Iron_sonaar::displayPageTitleDivider(); ?>
				</div>

				<?php endif; ?>
			

				<?php
					if ( strlen($sidebar) ) { ?>
						<div id="twocolumns" class="content__wrapper<?php if ( 'left' === $sidebarPosition ) echo ' content--rev'; ?>">
						<div id="content" class="content__main">
				<?php
					}

					if( Iron_sonaar::getOption( 'podcast_archive_default_template' ) == 'archive-podcast-list'){

						if ( !is_null( $post ) ) {
							$iron_sonaar_archive->changeQuery();
						}

						echo '<'.esc_attr($iron_sonaar_archive->getTag()).' id="post-list" class="'.esc_attr($iron_sonaar_archive->getClass()).'">';
						if ( $iron_sonaar_archive->getPaginateMethod() != 'paginate_more' ){
							if ( have_posts() ){
								while ( have_posts() ){
									the_post();
										Iron_sonaar::getTemplatePart( $iron_sonaar_archive->getItemTemplate()  );
								}
							}else{
								$iron_sonaar_archive->get404Message();
							}
						}

						echo '</'.esc_attr($iron_sonaar_archive->getTag()).'>';
						if( $iron_sonaar_archive->getPaginateMethod() == 'paginate_links' ){ ?>

							<div class="pages full clear">
								<?php Iron_sonaar::displayFullPagination(); ?>
							</div>

						<?php }else{ ?>
							<div class="pages clear">
								<div class="alignleft button-next-prev"><?php previous_posts_link('&laquo; '.$iron_sonaar_archive->getPrev(), ''); ?></div>
								<div class="alignright button-next-prev"><?php next_posts_link($iron_sonaar_archive->getNext().' &raquo;',''); ?></div>
							</div>

						<?php }
					}else{
						$args = array(
							'post_type' => 'podcast',
							'post_status' => 'publish',
							'orderby' => 'modified',
							'order' => 'DESC',
							'posts_per_page'=>-1
						);
						$wp_query = new WP_Query($args);
						while ($wp_query->have_posts()): the_post();
							$my_post_array[] = $post->ID;
						endwhile;
						echo do_shortcode( '[ess_grid alias="podcast-archives" posts='.implode(',', $my_post_array).']' );
					}
					

					if ( strlen($sidebar)  ){
						echo '</div><aside id="sidebar" class="sr_it-content-side widget-area widget-area--'.esc_attr( $sidebar ).'">';
						do_action('before_ironband_sidebar_dynamic_sidebar', 'archive.php');
						dynamic_sidebar( $sidebar );
						do_action('after_ironband_sidebar_dynamic_sidebar', 'archive.php');
						echo '</aside></div>';
					}
				echo '</div></div>';
}
get_footer();
