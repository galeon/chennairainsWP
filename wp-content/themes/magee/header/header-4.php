<header class="style4">
			<div class="container">
				<div class="logo-box text-left">
					<?php if ( ot_get_option('logo')!="") { ?>
        <a href="<?php echo esc_url(home_url('/')); ?>">
        <img src="<?php echo ot_get_option('logo'); ?>"  class="site-logo"  alt="<?php bloginfo('name'); ?>" />
        </a>
        <?php } ?>
					<div class="name-box">
						<a href="<?php echo esc_url(home_url('/')); ?>"><h1 class="site-name"><?php bloginfo('name'); ?></h1></a>
						<span class="site-tagline"><?php echo  get_bloginfo( 'description' );?></span>
					</div>
				</div>
				<button class="site-search-toggle">
					<span class="sr-only">Toggle search</span>
					<i class="fa fa-search fa-2x"></i>
				</button>			
				<button class="site-nav-toggle">
					<span class="sr-only">Toggle navigation</span>
					<i class="fa fa-bars fa-2x"></i>
				</button>	
				<form role="search" action="<?php echo esc_url(home_url('/')); ?>" method="get" class="search-form">
					<div>
						<label class="sr-only"><?php _e("Search for","magee");?>:</label>
						<input type="text" id="s" name="s" value="" placeholder="Search...">
						<input type="submit" value="">
					</div>
				</form>
				<nav class="site-nav" role="navigation">
					<?php wp_nav_menu(array('theme_location'=>'primary','depth'=>0,'fallback_cb' =>false,'container'=>'','container_class'=>'main-menu','menu_id'=>'menu-main','menu_class'=>'main-nav','items_wrap'=> '<ul id="%1$s" class="%2$s">%3$s</ul>'));
						?>
					</nav>
				</div>
		</header>