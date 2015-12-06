<?php

 if( ! defined('MAGEE_THEME_BASE_URL' ) ) 	 { 	define( 'MAGEE_THEME_BASE_URL', get_template_directory_uri()); }

 function magee_setup(){
	global $content_width,$portfolio_items;
	if ( ! isset( $content_width ) ) $content_width = 1170;
	$lang = get_template_directory(). '/languages';
	load_theme_textdomain('magee', $lang);
	add_theme_support( 'post-thumbnails' ); 
	$args = array();
	$portfolio_items = ot_get_option('portfolio_items');
	$header_args = array( 
	    'default-image'          => '',
		 'default-repeat' => 'repeat',
        'default-text-color'     => '',
        'width'                  => 1170,
        'height'                 => 108,
        'flex-height'            => true
     );
	//add_theme_support( 'custom-background', $args );
	//add_theme_support( 'custom-header', $header_args );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support('nav_menus');
	register_nav_menus( array('primary' => __( 'Primary Menu', 'magee' )));
	register_nav_menus( array('top_menu' => __( 'Top Menu (Header style 1 & Header style 3 )', 'magee' )));
	add_editor_style("editor-style.css");
	add_image_size( 'blog', 335, 251, true ); //(cropped)
	add_image_size( 'blog-thumb', 116, 87, true ); //(cropped)
	add_image_size( 'blog-shortcode-thumb', 120, 90, true ); //(cropped)
	add_image_size( 'portfolio-grid-thumb', 377, 283, true ); //(cropped)
	add_image_size( 'portfolio-list-thumb', 165, 124, true ); //(cropped)
	add_image_size( 'portfolio', 555, 416, true ); //(cropped)
	add_image_size( 'portfolio-widget', 126, 126, true ); //(cropped)
	
	//set_prefix("magee_");
}

add_action( 'after_setup_theme', 'magee_setup' );
   

 function magee_custom_scripts(){
    //enqueue css
	global $wp_styles,$is_IE;
	wp_enqueue_style('magee-font-awesome', get_template_directory_uri() .'/css/font-awesome.min.css', false, '4.0.3', false);
    wp_enqueue_style('magee-bootstrap', get_template_directory_uri() .'/css/bootstrap.css', false, '3.0.3', false);
	wp_enqueue_style('magee-prettyPhoto', get_template_directory_uri() .'/css/prettyPhoto.css', false, '3.1.5', false);
	wp_enqueue_style('magee-Open-Sans', esc_url('//fonts.googleapis.com/css?family=Open+Sans:300,400,700'), false, '', false);
	wp_enqueue_style( 'magee-main', get_stylesheet_uri(), array(), '2.0' );
	wp_enqueue_style('magee-scheme',  get_template_directory_uri() .'/css/scheme.less', false, '2.0', false);
	
	$header_background_array      = ot_get_option("header_background");
    $header_background            = magee_get_background($header_background_array);
	$header_transparent           = ot_get_option("header_transparent");
	$header_bg_full               = ot_get_option("header_bg_full");
	$margin_header_top            = ot_get_option("margin_header_top");
	$margin_header_bottom         = ot_get_option("margin_header_bottom");
	$dropdown_menu_width          = ot_get_option("dropdown_menu_width");
	$sticky_header_opacity        = ot_get_option("sticky_header_opacity");
	
	$breadcrumb_background_array  = ot_get_option("breadcrumb_background");
    $breadcrumb_background        = magee_get_background($breadcrumb_background_array);
	
	$page_background_array        = ot_get_option("page_background");
    $page_background              = magee_get_background($page_background_array);
	$content_background_array     = ot_get_option("main_content_area_background");
    $main_content_area_background = magee_get_background($content_background_array);
	
	$footer_background_array      = ot_get_option("footer_area_background");
    $footer_area_background       = magee_get_background($footer_background_array);
	$footerw_bg_full              = ot_get_option("footerw_bg_full");
	$footer_area_top_padding      = ot_get_option("footer_area_top_padding");
	$footer_area_bottom_padding   = ot_get_option("footer_area_bottom_padding");
	$footer_social_icon_color     = ot_get_option("footer_social_icon_color");
	
	$copyright_top_padding        = ot_get_option("copyright_top_padding");
	$copyright_bottom_padding     = ot_get_option("copyright_bottom_padding");
	
	$body_font_family_array       =  ot_get_option("body_font_family");
	$body_font_family             = magee_get_typography($body_font_family_array);
	
	$tagline_typography_array     =  ot_get_option("tagline_typography");
	$tagline_typography           = magee_get_typography($tagline_typography_array);
	
	$main_menu_font_array         =  ot_get_option("main_menu_font");
	$main_menu_font               = magee_get_typography($main_menu_font_array);
	
	$main_sub_menu_font_array     =  ot_get_option("main_menu_dropdown_font");
	$main_menu_dropdown_font      = magee_get_typography($main_sub_menu_font_array);
	
	$sticky_header_nav_font_array =  ot_get_option("sticky_header_nav_font");
	$sticky_header_nav_font       = magee_get_typography($sticky_header_nav_font_array);
	
	
	$sticky_menu_item_margin     = ot_get_option("sticky_menu_item_margin");
	
	$headings_font_array          =  ot_get_option("headings_font");
	$headings_font                = magee_get_typography($headings_font_array);
	
	$content_typography_array     =  ot_get_option("content_typography");
	$content_typography           = magee_get_typography($content_typography_array);
	
	$footer_headings_font_array   =  ot_get_option("footer_headings_font");
	$footer_headings_font         =  magee_get_typography($footer_headings_font_array);
	
	$copyright_font_array         =  ot_get_option("copyright_font");
	$copyright_font               =  magee_get_typography($copyright_font_array);
	
	$h1_font_array                =  ot_get_option("h1_font");
	$h1_font                      =  magee_get_typography($h1_font_array);
	$h2_font_array                =  ot_get_option("h2_font");
	$h2_font                      =  magee_get_typography($h2_font_array);
	$h3_font_array                =  ot_get_option("h3_font");
	$h3_font                      =  magee_get_typography($h3_font_array);
	$h4_font_array                =  ot_get_option("h4_font");
	$h4_font                      =  magee_get_typography($h4_font_array);
	$h5_font_array                =  ot_get_option("h5_font");
	$h5_font                      =  magee_get_typography($h5_font_array);
	$h6_font_array                =  ot_get_option("h6_font");
	$h6_font                      =  magee_get_typography($h6_font_array);
	
	

	//navbar-brand-tagline
	
    $magee_custom_css   =  "";
	$custom_css         =  ot_get_option("custom_css");
	$magee_custom_css  .=  'body{'.$page_background.'}';
	$magee_custom_css  .=  'body{'.$body_font_family.'}';
	$magee_custom_css  .=  'header,.style3 .header-top{'.$header_background.'}';
	$magee_custom_css  .=  '.breadcrumb-box.style2{'.$breadcrumb_background.'}';
	$magee_custom_css  .=  'body .site-tagline{'.$tagline_typography.'}';
	$magee_custom_css  .=  'body .entry-content{'.$content_typography.'}';
	$magee_custom_css  .=  '.main-container.container .blog-list, .main-container.container .post.hentry,.main-container.container .page.hentry{'.$main_content_area_background.'}';
	
	if( $header_transparent == "on" )
	$magee_custom_css  .=  'body header{background: transparent;}';
	
	 if( $header_bg_full == "on" )
	$magee_custom_css  .=  'body header{background-attachment:scroll;
			background-position:center center;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;}';
			
	if( is_numeric( $margin_header_top ) && $margin_header_top >0 )
	$magee_custom_css  .=  'body header{padding-top: '.$margin_header_top.'px;}';
	if( is_numeric( $margin_header_bottom ) && $margin_header_bottom >0 )
	$magee_custom_css  .=  'body header{padding-bottom: '.$margin_header_bottom.'px;}';
	if( is_numeric( $sticky_header_opacity ) )
	$magee_custom_css  .=  'body header.sticky-header{opacity: '.$sticky_header_opacity.';}';
	if( is_numeric( $sticky_menu_item_margin ) )
	$magee_custom_css  .=  'body header.sticky-header .sticky-header-menu > li {margin-left: '.$sticky_menu_item_margin.'px;}';
	$magee_custom_css  .=  'body header.sticky-header .sticky-header-menu > li > a{'.$sticky_header_nav_font.'}';

	$magee_custom_css  .=  'h1{'.$h1_font.'}';
	$magee_custom_css  .=  'h2{'.$h2_font.'}';
	$magee_custom_css  .=  'h3{'.$h3_font.'}';
	$magee_custom_css  .=  'h4{'.$h4_font.'}';
	$magee_custom_css  .=  'h5{'.$h5_font.'}';
	$magee_custom_css  .=  'h6{'.$h6_font.'}';
	
	if(is_numeric( $dropdown_menu_width ) && $dropdown_menu_width >0 )
	$magee_custom_css  .=  '.site-nav li ul{width: '.$dropdown_menu_width.'px;}';
    $magee_custom_css  .=  'ul.main-nav > li > a{'.$main_menu_font.'}';
	$magee_custom_css  .=  'ul.main-nav li ul li a{'.$main_menu_dropdown_font.'}';
	$magee_custom_css  .=  '.title h3{'.$headings_font.'}';
	$magee_custom_css  .=  '.footer-widget-area .widget-title{'.$footer_headings_font.'}';
	
	$magee_custom_css  .=  'footer .footer-widget-area{'.$footer_area_background.'}';
	
	if($footerw_bg_full == "on"): 
	$magee_custom_css  .=  'footer .footer-widget-area{background-attachment:scroll;
		background-position:center center;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;}';
		
		 endif; 
	if(is_numeric( $footer_area_top_padding ) && $footer_area_top_padding >0 )
	$magee_custom_css  .=  'footer .footer-widget-area{padding-top: '.$footer_area_top_padding.'px;}';
	if(is_numeric( $footer_area_bottom_padding ) && $footer_area_bottom_padding >0 )
	$magee_custom_css  .=  'footer .footer-widget-area{padding-bottom: '.$footer_area_bottom_padding.'px;}';	 
	
	if(is_numeric( $copyright_top_padding ) && $copyright_top_padding >0 )
	$magee_custom_css  .=  'footer .copyright-area{padding-top: '.$copyright_top_padding.'px;}';
	if(is_numeric( $copyright_bottom_padding ) && $copyright_bottom_padding >0 )
	$magee_custom_css  .=  'footer .copyright-area{padding-bottom: '.$copyright_bottom_padding.'px;}';	
	if( $footer_social_icon_color )
	$magee_custom_css  .=  'footer .site-sns a{color:'.$footer_social_icon_color.';}';
	
	$magee_custom_css  .=  '.copyright-area .site-info{'.$copyright_font.'}';
	
	$magee_custom_css  .=  $custom_css;
	wp_add_inline_style( 'magee-main', $magee_custom_css );
	
    //enqueue js
	$global_color      =  ot_get_option("global_color");
	

 	wp_enqueue_script( 'magee-bootstrap', get_template_directory_uri().'/js/bootstrap.min.js', array( 'jquery' ), '', false );
	wp_enqueue_script( 'magee-carousel', get_template_directory_uri().'/js/owl.carousel.min.js', array( 'jquery' ), '', false );
	wp_enqueue_script( 'magee-prettyPhoto', get_template_directory_uri().'/js/jquery.prettyPhoto.js', array( 'jquery' ), '3.1.5', true );   
	wp_enqueue_script( 'magee-less', get_template_directory_uri().'/js/less.min.js', array( 'jquery' ), '', false );
	wp_enqueue_script( 'magee-respond', get_template_directory_uri().'/js/respond.min.js', array( 'jquery' ), '', false );
	wp_enqueue_script( 'magee-easing', get_template_directory_uri().'/js/jquery.easing.min.js', array( 'jquery' ), '', false );
	wp_enqueue_script( 'magee-mixitup', get_template_directory_uri().'/js/jquery.mixitup.min.js', array( 'jquery' ), '', false );
	wp_enqueue_script( 'magee-tubular', get_template_directory_uri().'/js/jquery.tubular.1.0.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'magee-main', get_template_directory_uri().'/js/magee.js', array( 'jquery' ), '', true );
	
	wp_localize_script( 'magee-main', 'magee_params', array(
			'ajaxurl'        => admin_url('admin-ajax.php'),
			'themeurl' => get_template_directory_uri(),
		)  );
	
	if(isset($global_color) && $global_color != ""){
	 wp_localize_script( 'magee-less', 'magee_js_var', array("global_color"=>$global_color));
	}
	if( $is_IE ) {
	wp_enqueue_script( 'magee-html5', get_template_directory_uri().'/js/html5.js', array( 'jquery' ), '', false );
	}
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ){
	wp_enqueue_script( 'comment-reply' );
	}
	
	}
 
 function magee_admin_scripts(){
	 global $pagenow ;
	 wp_enqueue_script('media-upload');
	 wp_enqueue_script('thickbox');
	 wp_enqueue_style('magee-admin',  get_template_directory_uri() .'/css/admin.css', false, '', false);
	 if( $pagenow == "post.php" || $pagenow == "post-new.php" || (isset($_GET['page']) && $_GET['page'] == "magee-theme-options")){
	 wp_enqueue_style('magee-media',  get_template_directory_uri() .'/css/magnific-popup.css', false, '', false);
	 wp_enqueue_script( 'magee-magee', get_template_directory_uri().'/js/jquery.magnific-popup.min.js', array( 'jquery' ), '', true );
	 wp_enqueue_script( 'magee-admin', get_template_directory_uri().'/js/admin.js', array( 'jquery' ), '', true );
	 wp_enqueue_style('thickbox');
	 wp_localize_script( 'magee-admin', 'magee_params', array(
			'ajaxurl'        => admin_url('admin-ajax.php'),
			'themeurl' => get_template_directory_uri(),
		)  );
	 
	 }
	 
	 }
   if (!is_admin()) {
  add_action( 'wp_enqueue_scripts', 'magee_custom_scripts' );
  }
  else{
  add_action( 'admin_enqueue_scripts', 'magee_admin_scripts' );
  }

 function magee_enqueue_less_styles($tag, $handle) {
		global $wp_styles;
		$match_pattern = '/\.less$/U';
		if ( preg_match( $match_pattern, $wp_styles->registered[$handle]->src ) ) {
			$handle = $wp_styles->registered[$handle]->handle;
			$media = $wp_styles->registered[$handle]->args;
			$href = $wp_styles->registered[$handle]->src . '?ver=' . $wp_styles->registered[$handle]->ver;
			$rel = isset($wp_styles->registered[$handle]->extra['alt']) && $wp_styles->registered[$handle]->extra['alt'] ? 'alternate stylesheet' : 'stylesheet';
			$title = isset($wp_styles->registered[$handle]->extra['title']) ? "title='" . esc_attr( $wp_styles->registered[$handle]->extra['title'] ) . "'" : '';
	
			$tag = "<link rel='stylesheet' id='$handle' $title href='$href' type='text/less' media='$media' />\n";
		}
		return $tag;
	}
	add_filter( 'style_loader_tag', 'magee_enqueue_less_styles', 5, 2);
