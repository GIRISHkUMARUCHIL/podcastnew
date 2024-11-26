<?php
$iron_sonaar_page_id = Iron_sonaar::getOption('404_page_selection');
get_header();
if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) {
?>
	<!-- container -->
	<div class="container">
		<div class="content__wrapper <?php echo esc_attr( ( $iron_sonaar_page_id ) ? '': 'boxed' ) ?>">
			<!-- single-post -->
			<article class="sr_it-single-post">
				<div class="entry">
					<div class="<?php echo esc_attr( ( Iron_sonaar::isPageTitleUppercase() ) ? 'uppercase' : '' ) ?>">
						<span class="heading-t"></span>
						<h1><?php esc_html( Iron_sonaar::displayPageTitle( $iron_sonaar_page_id, translateString('tr_Page_not_found') ) ); ?></h1>
						<?php Iron_sonaar::displayPageTitleDivider(); ?>
					</div>
					<?php if( $iron_sonaar_page_id ){
						echo wp_kses_post( apply_filters( 'sonaar_content', get_post_field( 'post_content', $iron_sonaar_page_id) ) );
					}else{ // Default content ?>
						<p><?php echo translateString('tr_Are_you_lost'); ?></p>
						<p>
							<a href="<?php echo esc_url( get_home_url( null, '/' ) ) ?>">
								<?php echo translateString('tr_Return_to_home_page'); ?>
							</a>
						</p>
					<?php } ?>
				</div>
			</article>
		</div>
	</div>

<?php
}
get_footer(); ?>