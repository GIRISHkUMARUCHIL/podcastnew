<?php get_header(); 
if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) {
?>
		<!-- container -->
		<div class="container">
		<div class="boxed">

			<!-- single-post -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="page-title elementor-editor-hide <?php (Iron_sonaar::isPageTitleUppercase() == true) ? 'uppercase' : '';?>">
					<span class="heading-t"></span>
					<?php the_title('<h1>','</h1>'); ?>
					<?php Iron_sonaar::displayPageTitleDivider(); ?>
				</div>
				<div class="entry">

				<?php the_content();
				/*
				This code is deprecated now. MJ
				if (  function_exists( 'elementor_theme_do_location') && (get_post_type( get_the_ID() ) !== 'block' )   )  {
					 elementor_theme_do_location( 'single' );
					 the_content();
				}else{
					 the_content();
				}*/
				?>
					<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'sonaar' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
				</div>
			</article>
		</div>
		</div>
<?php 
}
get_footer(); ?>