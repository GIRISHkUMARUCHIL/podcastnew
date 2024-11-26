<?php 
get_header(); 
if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'archive' ) ) {

	global $iron_sonaar_archive;

	if( !isset($iron_sonaar_archive) ){
		$iron_sonaar_archive = new Iron_sonaar_Archive();
		$iron_sonaar_archive->setPostType( get_post_type() );
		$iron_sonaar_archive->setItemTemplate( 'podcast_list' );
		$iron_sonaar_archive->compile();

	}
$term = get_queried_object();
$taxonomyDescription = category_description( $wp_query->queried_object->term_id );
$banner_background_type = get_field('banner_background_type', $term);
$atts = array(
	'category-archive' => $term->name,
	'slug' => $term->slug,
	'filter' => false
);
$iron_sonaar_has_sidebar = (bool)(sonaar_music_get_option('podcast_category_default_sidebar')!='')?true:false;
$iron_sonaar_sidebar_area = sonaar_music_get_option('podcast_category_default_sidebar');
$iron_sonaar_sidebar_position = sonaar_music_get_option('podcast_category_sidebar_position');
?>

<?php if ($banner_background_type): ?>
	<div class="podcast-banner">
		<?php get_template_part('parts/page-banner'); ?>
	</div>
<?php endif?>
<?php
// Template ajax
if( !empty($_POST["ajax"]) ){
	load_template( get_template_directory('archive-ajax.php'), true );
	return;
}
?>
<!-- container -->
<div class="container podcast-category-container">
	<div class="boxed">

		<?php if (!$banner_background_type): ?>
			<div class="page-title rellax <?php echo (Iron_sonaar::isPageTitleUppercase() == true) ? 'uppercase' : ''; ?>">
				<span class="heading-t"></span>
				<h1><?php echo $term->name ?></h1>
				<?php Iron_sonaar::displayPageTitleDivider(); ?>
			</div>
			<?php if( strlen($taxonomyDescription) ):?> 
				<div class="sonaar-taxonomy-description">
					<?php echo $taxonomyDescription; ?>
				</div>
			<?php endif ?>
		<?php endif?>
	</div>

	<div class="<?php echo ($iron_sonaar_has_sidebar)?'has-sidebar sidebar-'. $iron_sonaar_sidebar_position .' ':'';  echo ($banner_background_type)? 'banner ' : 'no-banner '; ?>">
		<div class="clearfix"><a href="/feed/podcast/?terms=<?php echo $term->slug ?>" target="_blank" class="bt_rss_subscribe"><i class="fa-solid fa-podcast"></i> <?php echo translateString('tr_RSS_Feed'); ?></a></div>
		<?php
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
					'tax_query' => 	array(
						array(
							'taxonomy' => 'podcast-category',
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

				echo do_shortcode( '[ess_grid alias="podcast-archives" posts='.implode(',', $my_post_array).']' );
			}
		?>		
	</div>
	<?php if ( $iron_sonaar_has_sidebar ) : ?>
	<aside id="sidebar" class="sr_it-content-side widget-area widget-area--<?php echo esc_attr( $iron_sonaar_sidebar_area ).' sidebar-'. $iron_sonaar_sidebar_position; ?>">
		<?php
		do_action('before_ironband_sidebar_dynamic_sidebar', 'page.php');
		dynamic_sidebar( $iron_sonaar_sidebar_area );
		do_action('after_ironband_sidebar_dynamic_sidebar', 'page.php');
		?>
	</aside>
<?php endif ?>

</div>

 
<?php 
}
get_footer();
?>
