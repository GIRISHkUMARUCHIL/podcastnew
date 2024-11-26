<?php global $iron_sonaar_archive; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('media-block'); ?>>
		<div class="holder">
			<?php if(has_post_thumbnail()): ?>
				<a href="<?php the_permalink(); ?>" class="image"><?php the_post_thumbnail( 'large' ); ?></a>
			<?php else :?>
				<div class="image empty"></div>
			<?php endif; ?>
			<div class="text-box<?php if(!has_post_thumbnail()){ echo " empty"; }?>">

				<a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>

				<div class="classic-meta">
				<?php if((bool)Iron_sonaar::getOption('show_post_date', null, true)): ?>
					<a href="<?php the_permalink() ?>">
						<time class="sr_it-datetime" datetime="<?php the_time('c'); ?>"><?php the_time( get_option('date_format') ); ?> </time>
					</a>
				<?php endif; ?>

				<?php if ((bool)Iron_sonaar::getOption('show_post_author', null, true)  &&  get_the_author() != '' ): ?>
					<?php echo translateString('tr_by'); ?> <a class="sr_it-meta-author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta('ID') ) ); ?>"><?php the_author(); ?></a>
				<?php endif ?>
				<?php
					$iron_sonaar_categories_list = get_the_category_list( ', ',get_the_ID() );
					if(!empty($iron_sonaar_categories_list) && (bool)Iron_sonaar::getOption('show_post_categories', null, true))
					echo wp_kses_post('<div class="post-categories"><i class="fa-regular fa-folder-open"></i>'.$iron_sonaar_categories_list.'</div>' );

					$iron_sonaar_tag_list = get_the_tag_list('',', ');
					if(!empty($iron_sonaar_tag_list) && (bool)Iron_sonaar::getOption('show_post_tags', null, true) )
					echo wp_kses_post( '<div class="post-tags"><i class="fa-solid fa-tag"></i>'.$iron_sonaar_tag_list.'</div>' );

				?>
				 </div>

				<?php if( !$iron_sonaar_archive->enableExcerpts() ){
					the_content( translateString('tr_Read_More') );
					wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'sonaar' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );
                }else{
                    the_excerpt();
                } ?>
				<div class="stickypost">
					<i class="fa-solid fa-star"></i>
				</div>
			</div>
		</div>
</article>