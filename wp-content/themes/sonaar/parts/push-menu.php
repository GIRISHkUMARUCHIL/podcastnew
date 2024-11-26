<div class="side-menu">
	<div class="content-menu">
		<?php if( Iron_sonaar::getOption('menu_logo', null, get_template_directory_uri().'/images/sonaar-logo-white@1x.png') !== ''): ?>
		<a class="site-title" rel="home" href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ) ?>">
			<img class="logo-desktop regular" src="<?php echo esc_url( Iron_sonaar::getOption('menu_logo', null, get_template_directory_uri().'/images/sonaar-icon-black@1x.png') ); ?>" <?php echo (Iron_sonaar::getOption('retina_menu_logo'))? 'srcset="' . esc_url( Iron_sonaar::getOption('menu_logo', null, get_template_directory_uri().'/images/sonaar-icon-black@1x.png') ) . ' 1x,' . esc_url( Iron_sonaar::getOption('retina_menu_logo')) . ' 2x"':''?> alt="<?php echo esc_attr( get_bloginfo('name') ); ?>">
			<img class="logo-mobile regular" src="<?php echo esc_url( Iron_sonaar::getOption('menu_logo', null, get_template_directory_uri().'/images/sonaar-icon-black@1x.png') ); ?>" <?php echo (Iron_sonaar::getOption('retina_menu_logo'))? 'srcset="' . esc_url( Iron_sonaar::getOption('menu_logo', null, get_template_directory_uri().'/images/sonaar-icon-black@1x.png') ) . ' 1x,' . esc_url( Iron_sonaar::getOption('retina_menu_logo')) . ' 2x"':''?> alt="<?php echo esc_attr( get_bloginfo('name') ); ?>">
		</a>
		<?php endif ?>


		<!-- panel -->
		<div class="panel">
			<a class="opener" href="#"><i class="icon-reorder"></i> <?php esc_html_e("Menu", 'sonaar'); ?></a>

			<!-- nav-holder -->
			<div class="nav-holder">

				<!-- nav -->
				<nav id="nav">
					<?php if ( Iron_sonaar::getOption('header_menu_logo_icon') != '') : ?>
						<a class="logo-panel" href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ) ?>">
							<img src="<?php echo esc_url( Iron_sonaar::getOption('header_menu_logo_icon') ); ?>" alt="<?php echo esc_attr( get_bloginfo('name') ); ?>">
						</a>
					<?php endif; ?>
					<?php echo wp_nav_menu( array( 'menu_id' => 'menu-main-menu', 'theme_location' => 'main-menu', 'menu_class' => 'nav-menu', 'echo' => false, 'fallback_cb' => '__return_false', 'walker' => new iron_nav_walker() )); ?>

				</nav>
				<div class="clear"></div>

				<div class="panel-networks">
					<?php get_template_part('parts/networks'); ?>
					<div class="clear"></div>
				</div>

			</div>
		</div>
	</div>
</div>