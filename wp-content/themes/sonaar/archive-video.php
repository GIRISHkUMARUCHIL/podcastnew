<?php get_header();

global $post;
/**
 * Template Name: Video Posts (List)
 */


list( $iron_sonaar_has_sidebar, $iron_sonaar_sidebar_position, $iron_sonaar_sidebar_area ) = Iron_sonaar::setupDynamicSidebar( $post->ID );
$iron_sonaar_hide_page_title = Iron_sonaar::getField('hide_page_title', $post->ID);
$loop = new WP_Query(array(
    'post_type' => 'video',
    'post_status' => 'publish',
    'posts_per_page' => -1
    ));

$iron_sonaar_video_args = array(
    'title' => ( empty( $iron_sonaar_hide_page_title ) )? get_the_title() : ''
    )
?>

<div class="container">
    <div class="boxed" id="sr_it-videolist-box">
	    <div class="entry">
            <?php if ( $iron_sonaar_has_sidebar ) : ?>
				<div class="content__wrapper <?php if ( 'left' === $iron_sonaar_sidebar_position ) echo ' content--rev'; ?>">
                    <div class="vc_row wpb_row vc_row-fluid in_container content__main">
            <?php else: ?>
                    <div class="vc_row wpb_row vc_row-fluid in_container">
            <?php endif; ?>


                    <?php the_widget('Iron_Widget_Videos', $iron_sonaar_video_args ) ?>


            </div>

            <?php  if ( $iron_sonaar_has_sidebar ) : ?>
				<aside id="sidebar" class="sr_it-content-side widget-area widget-area--<?php echo esc_attr( $iron_sonaar_sidebar_area ); ?>">
			    <?php
				    do_action('before_ironband_sidebar_dynamic_sidebar', 'page.php');
				    dynamic_sidebar( $iron_sonaar_sidebar_area );
				    do_action('after_ironband_sidebar_dynamic_sidebar', 'page.php');
                ?>
				</aside>
                </div>
            <?php endif; ?>


        </div>
    </div>
</div>

<?php
get_footer();
