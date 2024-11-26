<?php if (get_theme_mod( 'progression_studios_blog_post_sharing', 'on') == 'on') : ?>
<div class="blog-single-social-sharing-container">
		<ul class="blog-single-social-sharing noselect">

			<?php if (get_theme_mod( 'progression_single_sharing_twitter', '1')) : ?><li><a href="https://twitter.com/share?text=<?php echo htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8'); ?>&url=<?php echo urlencode(the_permalink()); ?>" title="<?php esc_html_e( 'Twitter', 'viseo-progression' ); ?>" class="twitter-share" target="_blank"><i class="fa fa-twitter"></i><span class="progression-single-dash">&ndash;</span><span class="blog-single-sharing-text"><?php echo esc_html__( 'Share on Twitter', 'viseo-progression' ); ?></span></a></li>
			<?php endif; ?>
			
			<?php if (get_theme_mod( 'progression_single_sharing_facebook', '1')) : ?><li><a href="http://www.facebook.com/sharer.php?u=<?php echo urlencode(the_permalink()); ?>&t=<?php echo htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8'); ?>" title="<?php esc_html_e( 'Share on Facebook', 'viseo-progression' ); ?>" class="facebook-share" target="_blank"><i class="fa fa-facebook"></i><span class="progression-single-dash">&ndash;</span><span class="blog-single-sharing-text"><?php echo esc_html__( 'Share on Facebook', 'viseo-progression' ); ?></span></a></li>
			<?php endif; ?>
			
			
			<?php if (get_theme_mod( 'progression_single_sharing_pinterest')) : ?><li><a href="javascript:void((function()%7Bvar%20e=document.createElement(&apos;script&apos;);e.setAttribute(&apos;type&apos;,&apos;text/javascript&apos;);e.setAttribute(&apos;charset&apos;,&apos;UTF-8&apos;);e.setAttribute(&apos;src&apos;,&apos;//assets.pinterest.com/js/pinmarklet.js?r=&apos;+Math.random()*99999999);document.body.appendChild(e)%7D)());" title="<?php esc_html_e( 'Share on Pinterest', 'viseo-progression' ); ?>" class="pinterest-share"><i class="fa fa-pinterest-p"></i><span class="progression-single-dash">&ndash;</span><span class="blog-single-sharing-text"><?php echo esc_html__( 'Share on Pinterest', 'viseo-progression' ); ?></span></a></li>
			<?php endif; ?>
	
			<?php if (get_theme_mod( 'progression_single_sharing_vk')) : ?><li><a href="http://vkontakte.ru/share.php?url=<?php echo urlencode(the_permalink()); ?>" title="<?php esc_html_e( 'Share on VK', 'viseo-progression' ); ?>" class="vk-share" target="_blank"><i class="fa fa-vk"></i><span class="progression-single-dash">&ndash;</span><span class="blog-single-sharing-text"><?php echo esc_html__( 'Share on VK', 'viseo-progression' ); ?></span></a></li>
			<?php endif; ?>
	
			<?php if (get_theme_mod( 'progression_single_sharing_google')) : ?><li><a href="https://plus.google.com/share?url=<?php echo urlencode(the_permalink()); ?>" title="<?php esc_html_e( 'Share on Google+', 'viseo-progression' ); ?>" class="google-share" target="_blank"><i class="fa fa-google-plus"></i><span class="progression-single-dash">&ndash;</span><span class="blog-single-sharing-text"><?php echo esc_html__( 'Share on Google+', 'viseo-progression' ); ?></span></a></li>
			<?php endif; ?>

			<?php if (get_theme_mod( 'progression_single_sharing_reddit', '1')) : ?><li><a href="http://reddit.com/submit?url=<?php echo urlencode(the_permalink()); ?>&amp;title=<?php echo htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8'); ?>" title="<?php esc_html_e( 'Share on Reddit', 'viseo-progression' ); ?>" class="reddit-share" target="_blank"><i class="fa fa-reddit-alien"></i><span class="progression-single-dash">&ndash;</span><span class="blog-single-sharing-text"><?php echo esc_html__( 'Share on Reddit', 'viseo-progression' ); ?></span></a></li>
			<?php endif; ?>
	
			<?php if (get_theme_mod( 'progression_single_sharing_linkedin')) : ?><li><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo urlencode(the_permalink()); ?>" title="<?php esc_html_e( 'Share on LinkedIn', 'viseo-progression' ); ?>" class="linkedin-share" target="_blank"><i class="fa fa-linkedin-square"></i><span class="progression-single-dash">&ndash;</span><span class="blog-single-sharing-text"><?php echo esc_html__( 'Share on LinkedIn', 'viseo-progression' ); ?></span></a></li>
			<?php endif; ?>
	
			<?php if (get_theme_mod( 'progression_single_sharing_tumblr')) : ?><li><a href="http://www.tumblr.com/share/link?url=<?php echo urlencode(the_permalink()); ?>&amp;title=<?php echo htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8'); ?>" title="<?php esc_html_e( 'Share on Tumblr', 'viseo-progression' ); ?>" class="tumblr-share" target="_blank"><i class="fa fa-tumblr"></i><span class="progression-single-dash">&ndash;</span><span class="blog-single-sharing-text"><?php echo esc_html__( 'Share on Tumblr', 'viseo-progression' ); ?></span></a></li>
			<?php endif; ?>

			<?php if (get_theme_mod( 'progression_single_sharing_stumble')) : ?><li><a href="http://www.stumbleupon.com/submit?url=<?php echo urlencode(the_permalink()); ?>&amp;title=<?php echo htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8'); ?>" title="<?php esc_html_e( 'Share on StumbleUpon', 'viseo-progression' ); ?>" class="stumble-share" target="_blank"><i class="fa fa-stumbleupon"></i><span class="progression-single-dash">&ndash;</span><span class="blog-single-sharing-text"><?php echo esc_html__( 'Share on StumbleUpon', 'viseo-progression' ); ?></span></a></li>
			<?php endif; ?>
	
			<?php if (get_theme_mod( 'progression_single_sharing_mail', '1')) : ?><li><a href="mailto:?subject=<?php echo htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8'); ?>&amp;body=<?php echo urlencode(the_permalink()); ?>" title="<?php esc_html_e( 'Share on E-mail', 'viseo-progression' ); ?>" class="mail-share"><i class="fa fa-envelope-o"></i><span class="progression-single-dash">&ndash;</span><span class="blog-single-sharing-text"><?php echo esc_html__( 'Share via Email', 'viseo-progression' ); ?></span></a></li>
			<?php endif; ?>
	
		</ul>
	<div class="clearfix-pro"></div>
</div>
<?php endif; ?>