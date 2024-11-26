<?php

	$iron_sonaar_post_id = get_the_ID();

	if(is_home() && get_option('page_for_posts') != '') {

		$iron_sonaar_post_id = get_option('page_for_posts');

	}else if(is_front_page() && get_option('page_on_front') != '') {

		$iron_sonaar_post_id = get_option('page_on_front');

	}else if(function_exists('is_shop') && is_shop() && get_option('woocommerce_shop_page_id') != '') {

		$iron_sonaar_post_id = get_option('woocommerce_shop_page_id');

	}elseif($wp_query && !empty($wp_query->queried_object) && !empty($wp_query->queried_object->ID)) {

		$iron_sonaar_post_id = $wp_query->queried_object->ID;
	}


	$iron_sonaar_menu_position = Iron_sonaar::getOption('classic_menu_position', null, 'absolute absolute_before');
	$iron_sonaar_menu_logo_align = Iron_sonaar::getOption('classic_menu_logo_align', null, 'pull-left');
	$iron_sonaar_classic_menu_over_content = Iron_sonaar::getField('classic_menu_over_content', $iron_sonaar_post_id );
	if(!empty( $iron_sonaar_classic_menu_over_content )) {
		if($iron_sonaar_menu_position == 'absolute absolute_before') {
			$iron_sonaar_menu_position = 'absolute';
		}else{
			$iron_sonaar_menu_position = 'fixed';
		}
	}

	$iron_sonaar_container_classes = array();
	$iron_sonaar_container_classes[] = 'classic-menu';
	$iron_sonaar_container_classes[] = Iron_sonaar::getOption('classic_menu_effect', null, 'reset');
	$iron_sonaar_container_classes[] = ( Iron_sonaar::getOption('hide_menu_onscroll') && ( $iron_sonaar_menu_position == 'fixed' || $iron_sonaar_menu_position == 'fixed fixed_before' )&& Iron_sonaar::getOption('classic_menu_effect') != 'reset' )?'sr_hideOnScroll':''; 
	$iron_sonaar_container_classes[] = Iron_sonaar::getOption('classic_menu_mini_shadow')?'mini-shadow':'';
	$iron_sonaar_container_classes[] = $iron_sonaar_menu_position;
	$iron_sonaar_container_classes[] = 'classic_menu_width ' . Iron_sonaar::getOption('classic_menu_width', null, 'fullwidth');

	
	$iron_sonaar_menu_classes = array();
	$iron_sonaar_menu_classes[] = 'menu-level-0';
	$iron_sonaar_container_classes[] = 'classic_menu_align-' . Iron_sonaar::getOption('classic_menu_align', null, 'pull-center');

	$iron_sonaar_container_classes[] = 'classic_menu_logo_align-' . Iron_sonaar::getOption('classic_menu_logo_align', null, 'pull-left');

 	$iron_sonaar_alternative_logo = Iron_sonaar::getField('alternative_logo', $iron_sonaar_post_id );
 	$iron_alternative_logo = $iron_alternative_logo_retina = $iron_use_alternative_logo = '';
	if(!empty( $iron_sonaar_alternative_logo )) {
		$iron_use_alternative_logo = 1;
		$iron_alternative_logo = Iron_sonaar::getOption('header_alternative_logo');
		$iron_alternative_logo_retina = Iron_sonaar::getOption('retina_header_alternative_logo');
	}

	$iron_use_alternative_logo_on_mobile = Iron_sonaar::getOption('use_alternative_logo_on_mobile');

	if($iron_use_alternative_logo_on_mobile==1){
		$iron_alternative_logo = Iron_sonaar::getOption('header_alternative_logo');
		$iron_alternative_logo_retina = Iron_sonaar::getOption('retina_header_alternative_logo');
	}



	if($iron_sonaar_menu_logo_align == 'pull-top')
		$iron_sonaar_menu_classes[] = 'logo-pull-top';

?>

<div class="<?php echo esc_attr( implode(" ", $iron_sonaar_container_classes) ); ?>">

<div class="menu-container <?php echo (has_nav_menu( 'responsive-menu' ))?'has-responsive-menu':''; ?>">

	<?php if( Iron_sonaar::getOption('classic_menu_logo_align', null, 'pull-left') == "pull-top" || Iron_sonaar::getOption('classic_menu_logo_align', null, 'pull-left') == "pull-center" ) : ?>
	<div class="spacer"></div>
	<?php endif;?>
	<div class="menu-responsive-bg"></div>


	<?php

	echo wp_nav_menu( array(
		'menu_id' => 'menu-main-menu',
		'container' => false,
		'theme_location' => 'main-menu',
		'menu_class' => implode(" ", $iron_sonaar_menu_classes),
		'echo' => false,
		'fallback_cb' => '__return_false'
	));
	
	if( has_nav_menu( 'responsive-menu' ) ){
		echo wp_nav_menu( array(
			'menu_id' => 'menu-responsive-menu',
			'container' => false,
			'theme_location' => 'responsive-menu',
			'menu_class' => implode(" ", $iron_sonaar_menu_classes),
			'echo' => false,
			'fallback_cb' => '__return_false'
		));
	}

	$iron_sonaar_menu_items = Iron_sonaar::getOption('header_top_menu', null, array(
					0 => array(
						'menu_page_name' => '',
						'menu_page_is_menu' => '',
						'menu_page_url' => '',
						'pages_select' => '',
						'menu_page_external_url' => '',
						'menu_page_icon' => '',
						'order_no'     => 1
					),
				));
	?>

	<ul class="classic-menu-hot-links <?php echo esc_attr( (!empty($_GET["mpos"]) ? $_GET["mpos"] : Iron_sonaar::getOption('menu_position', null, 'righttype') ) ) ?> <?php echo esc_attr( ( (bool)Iron_sonaar::getOption('header_top_menu_enabled', null, false) || is_active_sidebar( 'sonaar_sidebar_lang' ) )? 'hotlinkDesktopEnable':'') ?> <?php echo esc_attr( ( (bool)Iron_sonaar::getOption('hotlink-mobile', null, false) || is_active_sidebar( 'sonaar_sidebar_lang' ) )? 'hotlinkMobileEnable':'') ?>">

		<?php if(  ((bool)Iron_sonaar::getOption('header_top_menu_enabled', null, false) && !empty($iron_sonaar_menu_items)) || ((bool)Iron_sonaar::getOption('hotlink-mobile')) ):
			foreach($iron_sonaar_menu_items as $item):
				if(!empty($item["menu_page_external_url"])) {
					$iron_sonaar_url = $item["menu_page_external_url"];
				}elseif( $item["menu_page_url"]!= "" ){
					$iron_sonaar_url = get_permalink($item["menu_page_url"]);
				}else{
					$iron_sonaar_url = false;
				}
				?>
				<?php if( $iron_sonaar_url ):?>
				<?php 
				$iron_sonaar_target = $item["menu_page_url_target"];
				$iron_sonaar_hide_page_name = !empty($item["menu_hide_page_title"]) ? (bool)$item["menu_hide_page_title"] : false;
				?>

				 
				<li class="hotlink pull-right">
					<a target="<?php echo esc_attr($iron_sonaar_target);?>" href="<?php echo esc_url($iron_sonaar_url); ?>">
						<?php if(!empty($item["menu_page_icon"])): ?>

						<?php 	if( substr($item["menu_page_icon"],0,4) != 'fab ' && substr($item["menu_page_icon"],0,4) != 'far ' && substr($item["menu_page_icon"],0,4) != 'fas ' && substr($item["menu_page_icon"],0,3) != 'fa ' && substr($item["menu_page_icon"],0,10) != 'fa-brands ' && substr($item["menu_page_icon"],0,11) != 'fa-regular ' && substr($item["menu_page_icon"],0,9) != 'fa-solid '){   
							$item["menu_page_icon"] = 'fa  fa-'.$item["menu_page_icon"];   
						}?>  
						
						<i class="<?php echo esc_attr($item["menu_page_icon"]); ?>" title="<?php echo esc_attr($item["menu_page_name"]); ?>"></i>
						<?php endif;?>

						<?php if(!$iron_sonaar_hide_page_name): ?>
							<?php echo esc_html($item["menu_page_name"]); ?>
						<?php endif; ?>

						<?php if(function_exists('is_shop')): ?>

							<?php global $woocommerce; ?>


							<?php if (!empty($item["menu_page_url"]) && (get_option('woocommerce_cart_page_id') == $item["menu_page_url"]) && $woocommerce->cart->cart_contents_count > 0): ?>

								<span class="sonaar_itemshop"><?php echo esc_html($woocommerce->cart->cart_contents_count);?></span>

							<?php endif; ?>

						<?php endif; ?>
					</a>

				</li>
				<?php endif ?>
			<?php endforeach; ?>
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'sonaar_sidebar_lang' ) ):?>
		<li class="languages-selector hotlink pull-right">
			<?php dynamic_sidebar( 'sonaar_sidebar_lang' ) ?>
		</li>
		<?php endif ?>
	</ul>


	</div>

</div>