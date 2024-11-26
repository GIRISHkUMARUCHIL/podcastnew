		<?php if ( 'post' == get_post_type() ) : ?>
		<?php // You might need to use wp_reset_postdata(); 
		global $post;
		$categories = get_the_category($post->ID);
		$category_ids = array();
		foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
		$args=array(
		'category__in' => $category_ids,
		'post__not_in' => array($post->ID),
		'posts_per_page'=> 3, // Number of related posts that will be displayed.
		'orderby'=>'rand' // Randomize the posts
		);
		$rel_query = new WP_Query( $args ); if( $rel_query->have_posts() ) : 
		?>
		<div id="progression-related-posts">
				<div class="progression-related-outline"><h4 class="progression-related-heading"><?php esc_html_e( 'You Might also like', 'viseo-progression' ); ?></h4></div>
				<div class="progression-realted-heading-border"></div>
				<ul class="progression-related-list">
				<?php  while ( $rel_query->have_posts() ) : $rel_query->the_post(); ?>
				<li class="progression-related-list-item">
					
					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php if (get_theme_mod( 'progression_studios_blog_index_layout', 'default') == 'default') : ?>
							<?php get_template_part( 'template-parts/content', get_post_format() ); ?>
						<?php else : ?>
							<?php get_template_part( 'template-parts/content', 'overlay' ); ?>
						<?php endif; ?>
					</div><!-- #post-## -->
					
				</li>
				<?php endwhile; ?>
			</ul>
		  <div class="clearfix-pro"></div>
		</div><!-- #progression-related-posts -->
		<?php endif;			wp_reset_postdata();  ?>
		<?php endif; ?>