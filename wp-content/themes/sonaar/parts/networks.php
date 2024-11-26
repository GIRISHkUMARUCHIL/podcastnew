<?php

$iron_sonaar_social_icons = Iron_sonaar::getOption('social_icons', null, array());
if(!empty($iron_sonaar_social_icons)): ?>
	<!-- social-networks -->
	<ul class="social-networks">
	<?php foreach($iron_sonaar_social_icons as $icon): ?>
		<?php if( isset($icon["social_media_icon_class"]) ): ?>
			<?php if( substr($icon["social_media_icon_class"],0,4) != 'fab ' && substr($icon["social_media_icon_class"],0,4) != 'far ' && substr($icon["social_media_icon_class"],0,4) != 'fas ' && substr($icon["social_media_icon_class"],0,3) != 'fa ' && substr($icon["social_media_icon_class"],0,10) != 'fa-brands ' && substr($icon["social_media_icon_class"],0,11) != 'fa-regular ' && substr($icon["social_media_icon_class"],0,9) != 'fa-solid '){ 
				$icon["social_media_icon_class"] = 'fa  fa-'.$icon["social_media_icon_class"];   
			} ?>  
			<li>
				<a target="_blank" href="<?php echo esc_url($icon["social_media_url"]); ?>">
					<?php if(!empty($icon["social_media_icon_url"])): ?>
						<img src="<?php echo esc_url($icon["social_media_icon_url"]); ?>">
					<?php else: ?>
						<i class="<?php echo esc_attr($icon["social_media_icon_class"]); ?>" title="<?php echo esc_attr($icon["social_media_name"]); ?>"></i>
					<?php endif; ?>
				</a>
			</li>
		<?php endif; ?>
	<?php endforeach; ?>

	</ul>
<?php endif; ?>
