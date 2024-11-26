<?php 
get_header();
if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'archive' ) ) {
	$term = get_queried_object();
?>
	<!-- container -->
	<div class="container">
		<div class="boxed">

		    <div class="page-title <?php echo esc_attr( (Iron_sonaar::isPageTitleUppercase() == true) ? 'uppercase': '' ) ?>">
				<span class="heading-t"></span>

				<h1><?php echo $term->name ?></h1>
				<?php Iron_sonaar::displayPageTitleDivider(); ?>

			</div>

			<?php
			$playlist_cat = (!class_exists('Sonaar_Music')) ? 'playlist-category' : 'playlist_cat';
			$args = array(
				'post_type' => 'album',
				'tax_query' => 	array(
					array(
						'taxonomy' => $playlist_cat,
						'terms'    => $term->term_id,
					)
				),
				'post_status' => 'publish',
				'orderby' => 'modified',
				'order' => 'DESC',
				'posts_per_page'=>-1
			);
			$wp_query = new WP_Query($args);
			while ($wp_query->have_posts()): the_post();
				$my_post_array[] = $post->ID;
			endwhile;
			$atts = array(
				'grip_post_type' => "album",
				'grid_filter_artists' => "",
				'column' => "3",
				'parallax' => "",
				'parallax_speed' => "2,-2,1",
				'albums' => $my_post_array
			); 

			echo the_widget('Iron_Music_Widget_Grid', $atts, array('widget_id'=>'arbitrary-instance-'. uniqid(), 'before_widget'=>'<div class="widget iron_widget_grid ">', 'after_widget'=>'</div>'));
			?>
	    </div>
    </div>
<?php 
}
get_footer() ?>
