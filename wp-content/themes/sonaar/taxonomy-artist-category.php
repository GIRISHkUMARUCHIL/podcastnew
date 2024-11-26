<?php 
$term = get_queried_object();
$args = array(
	'post_type' => 'artist',
	'tax_query' => 	array(
		array(
			'taxonomy' => 'artist-category',
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


get_header();

if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'archive' ) ) {
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
			//'category-archive' => $term->name,
				$atts = array(
					'grip_post_type' => "artist",
					'albums' => '',
					'grid_filter_artists' => "yes",
					'artists_filter' => $my_post_array,
					'column' => "3",
					'parallax' => "",
					'parallax_speed' => "2,-2,1"
				);

				// echo do_shortcode('[iron_grid]');
				echo the_widget('Iron_Music_Widget_Grid', $atts, array('widget_id'=>'arbitrary-instance-'. uniqid(), 'before_widget'=>'<div class="widget iron_widget_grid ">', 'after_widget'=>'</div>'));

			?>
			
	    </div>
    </div>
<?php
}
get_footer() ?>