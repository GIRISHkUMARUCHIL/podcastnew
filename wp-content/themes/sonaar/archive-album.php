<?php 
$playlist_cat = (!class_exists('Sonaar_Music')) ? 'playlist-category' : 'playlist_cat';

if ( is_tax( $playlist_cat) ) {
	load_template( get_template_directory() . '/taxonomy-album-category.php', true );
	return;
}

get_header();
if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'archive' ) ) {
?>
	<!-- container -->
	<div class="container">
		<div class="boxed">

		    <div class="page-title <?php echo esc_attr( (Iron_sonaar::isPageTitleUppercase() == true) ? 'uppercase': '' ) ?>">
				<span class="heading-t"></span>

				<h1><?php echo post_type_archive_title() ?></h1>
				<?php Iron_sonaar::displayPageTitleDivider(); ?>

			</div>

			<?php
				$atts = array(
					'grip_post_type' => "album",
					'grid_filter_artists' => "",
					'column' => "3",
					'parallax' => "",
					'parallax_speed' => "2,-2,1"
				);

				echo the_widget('Iron_Music_Widget_Grid', $atts, array('widget_id'=>'arbitrary-instance-'. uniqid(), 'before_widget'=>'<div class="widget iron_widget_grid ">', 'after_widget'=>'</div>'));

			?>
	    </div>
    </div>
<?php 
}
get_footer() ?>
