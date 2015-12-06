<header class="style2">
			<div class="header-menu">
				<div class="container">
					<div class="header-contact">
						<?php echo ot_get_option('header_text'); ?>
					</div>
					<div class="header-sns">
                    <?php
			$sns_list_items = ot_get_option( 'sns_list_item' ); 
			 if(is_array($sns_list_items) && !empty($sns_list_items)):
             foreach($sns_list_items as $sns_list_item){
			?>
                <a target="_blank" data-placement="bottom" href="<?php echo esc_url($sns_list_item["link"]);?>" title="<?php echo $sns_list_item["title"];?>"><i class="fa fa-<?php echo $sns_list_item["sns"];?>"></i></a>
              <?php } endif;?>
					
					</div>
				</div>
			</div>
			<div class="header-main">
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
					<button class="site-nav-toggle">
						<span class="sr-only">Toggle navigation</span>
						<i class="fa fa-bars fa-2x"></i>
					</button>
					<nav class="site-nav" role="navigation">
						<?php wp_nav_menu(array('theme_location'=>'primary','depth'=>0,'fallback_cb' =>false,'container'=>'','container_class'=>'main-menu','menu_id'=>'menu-main','menu_class'=>'main-nav','items_wrap'=> '<ul id="%1$s" class="%2$s">%3$s</ul>'));
						?>
					</nav>
				</div>
			</div>
		</header>