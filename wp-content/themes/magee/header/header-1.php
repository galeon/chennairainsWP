<?php 
    $header_class = "no-head-menu";
if ( has_nav_menu( "top_menu" ) ) {
	$header_class = "";
	}?>
 <header class="style1 <?php echo $header_class;?>">
 <div style="width: 100%; height: 8px; background-color: #e5e5e5; position: absolute; bottom: 0; left: 0; "></div>
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
				
					<?php wp_nav_menu(array('theme_location'=>'top_menu','depth'=>1,'fallback_cb' =>false,'container'=>'','container_class'=>'','menu_id'=>'','menu_class'=>'main','items_wrap'=> '<nav class="header-menu"><ul id="%1$s" class="%2$s">%3$s</ul></nav>'));
						?>
				
				<button class="site-search-toggle">
					<span class="sr-only">Toggle search</span>
					<i class="fa fa-search fa-2x"></i>
				</button>			
				<button class="site-nav-toggle">
					<span class="sr-only">Toggle navigation</span>
					<i class="fa fa-bars fa-2x"></i>
				</button>	
				<form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="search-form">
					<div>
						<label class="sr-only"><?php _e("Search for","magee");?>:</label>
						<input type="text" value="" id="s"  name="s" placeholder="Search...">
						<input type="submit" value="">
					</div>
				</form>
				<nav class="site-nav" role="navigation">
					<?php wp_nav_menu(array('theme_location'=>'primary','depth'=>0,'fallback_cb' =>false,'container'=>'','container_class'=>'main-menu','menu_id'=>'menu-main','menu_class'=>'main-nav','items_wrap'=> '<ul id="%1$s" class="%2$s">%3$s</ul>'));
						?>
					</nav>
				</div>
                
		</header>