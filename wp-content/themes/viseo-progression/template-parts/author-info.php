<div class="progression-author-container">
	
	<div class="progression-author-image-title">
		<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_avatar( get_the_author_meta('user_email'), $size = '150'); ?></a>
		<h5 class="author-heading"><?php the_author_posts_link(); ?></h5>
		<?php if(get_the_author_meta('progression_user_sub_headline')) : ?><h6 class="sub-author-heading"><?php echo get_the_author_meta('progression_user_sub_headline'); ?></h6><?php endif; ?>
		
		
		<?php 
		$current_user = wp_get_current_user();
		if ($post->post_author == $current_user->ID )  {  ?><a href="<?php echo get_edit_user_link(); ?>" id="edit-profile"><?php esc_html_e( 'Edit Profile', 'viseo-progression' ); ?></a><?php } ?>
	</div>

	
	<div class="progression-author-main">
		
		
		<div class="progression-author-main-padding">
			
			<h5 class="progression-about-the-author"><?php echo esc_html__( 'About the Author', 'viseo-progression' )?></h5>
		
			<?php echo the_author_meta('description'); ?>		
		
			<div class="progression-author-icons">
				<?php if(get_the_author_meta('progression_authorurl')) : ?><a href="<?php echo get_the_author_meta('progression_authorurl'); ?>" target="_blank" class="author-pro"><i class="fa fa-wpforms"></i></a><?php endif; ?>
				<?php if(get_the_author_meta('progression_facebookurl')) : ?><a href="<?php echo get_the_author_meta('progression_facebookurl'); ?>" target="_blank" class="facebook-pro"><i class="fa fa-facebook"></i></a><?php endif; ?>
				<?php if(get_the_author_meta('progression_twitterurl')) : ?><a href="<?php echo get_the_author_meta('progression_twitterurl'); ?>" target="_blank" class="twitter-pro"><i class="fa fa-twitter"></i></a><?php endif; ?>
				<?php if(get_the_author_meta('progression_dribbbleurleurl')) : ?><a href="<?php echo get_the_author_meta('progression_dribbbleurleurl'); ?>" target="_blank" class="dribbble-pro"><i class="fa fa-dribbble"></i></a><?php endif; ?>
				<?php if(get_the_author_meta('progression_linkedinurl')) : ?><a href="<?php echo get_the_author_meta('progression_linkedinurl'); ?>" target="_blank" class="linkedin-pro"><i class="fa fa-linkedin"></i></a><?php endif; ?>
				<?php if(get_the_author_meta('progression_pinteresturl')) : ?><a href="<?php echo get_the_author_meta('progression_pinteresturl'); ?>" target="_blank" class="pinterest-pro"><i class="fa fa-pinterest"></i></a><?php endif; ?>
				<?php if(get_the_author_meta('progression_googleplusurl')) : ?><a href="<?php echo get_the_author_meta('progression_googleplusurl'); ?>" target="_blank" class="google-pro"><i class="fa fa-google-plus"></i></a><?php endif; ?>
				<?php if(get_the_author_meta('progression_instagramurl')) : ?><a href="<?php echo get_the_author_meta('progression_instagramurl'); ?>" target="_blank" class="instagram-pro"><i class="fa fa-instagram"></i></a><?php endif; ?>
				<?php if(get_the_author_meta('progression_youtubeurl')) : ?><a href="<?php echo get_the_author_meta('progression_youtubeurl'); ?>" target="_blank" class="youtube-pro"><i class="fa fa-youtube"></i></a><?php endif; ?>
				<?php if(get_the_author_meta('progression_vimeourl')) : ?><a href="<?php echo get_the_author_meta('progression_vimeourl'); ?>" target="_blank" class="vimeo-pro"><i class="fa fa-vimeo"></i></a><?php endif; ?>
				<?php if(get_the_author_meta('progression_soundcloudurl')) : ?><a href="<?php echo get_the_author_meta('progression_soundcloudurl'); ?>" target="_blank" class="soundcloud-pro"><i class="fa fa-soundcloud"></i></a><?php endif; ?>
				<?php if(get_the_author_meta('progression_houzzurl')) : ?><a href="<?php echo get_the_author_meta('progression_houzzurl'); ?>" target="_blank" class="houzz-pro"><i class="fa fa-houzz"></i></a><?php endif; ?>
				<?php if(get_the_author_meta('progression_emailmailto')) : ?><a href="mailto:<?php echo get_the_author_meta('progression_emailmailto'); ?>" class="mail-pro"><i class="fa fa-envelope"></i></a><?php endif; ?>
			</div>
			
			
		</div>
	</div>
	
	<div class="clearfix-pro"></div>
</div>