<?php
/**
 * Initialize the custom Theme Options.
 */
add_action( 'admin_init', 'custom_theme_options' );

/**
 * Build the custom settings & update OptionTree.
 *
 * @return    void
 * @since     2.0
 */
function custom_theme_options() {
 global $wpdb ;
 /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( ot_settings_id(), array() );
  
  /**
   * Custom settings array that will eventually be 
   * passes to the OptionTree Settings API Class.
   */
     
  $custom_settings = array( 


    'sections'        => array( 
      array(
        'id'          => 'general_options',
        'title'       => '<i class="ot-icon-dashboard"></i>'. __( 'General', 'magee' )
      ),
	  array(
        'id'          => 'header',
        'title'       => '<i class="ot-icon-h-sign"></i>' .__( 'Header', 'magee' )
      )
	
	  
	  ,
	   array(
        'id'          => 'logo',
        'title'       => '<i class="ot-icon-star"></i>' .__( 'Logo', 'magee' )
      )
	  ,
	    array(
        'id'          => 'menu',
        'title'       => '<i class="ot-icon-sitemap"></i>' .__( 'Menu Options', 'magee' )
      )
	  ,
	  
	 array(
        'id'          => 'typography',
        'title'       => '<i class="ot-icon-font"></i>' .__( 'Typography', 'magee' )
      )
	  ,
	  array(
        'id'          => 'blog',
        'title'       => '<i class="ot-icon-bold"></i>' . __( 'Blog', 'magee' )
      )
	  ,
	   array(
        'id'          => 'portfolio',
        'title'       => '<i class="ot-icon-briefcase"></i>' . __( 'Portfolio', 'magee' )
      )
	  ,
	  array(
        'id'          => 'footer',
        'title'       => '<i class="ot-icon-hand-down"></i>' .__( 'Footer', 'magee' )
      )
	  ,
	
	  array(
        'id'          => 'not_found',
        'title'       => '<i class="ot-icon-frown"></i>' .__( '404 Page', 'magee' )
      ),
	  array(
        'id'          => 'page_layout',
        'title'       => '<i class="ot-icon-columns"></i>' .__( 'Page Layout', 'magee' )
      )
	  
    ),
    'settings'        => array( 
		array(
        'id'          => 'existing_prefix',
        'label'       => __( 'Existing Prefix', 'magee' ),
        'std'         =>  '',
		'desc'        => '<div class="button-primary magee-data-restore ">Import Demo Data</div><p style="padding:20px 0;">WARNING: Clicking this button will replace your current theme options, sliders and widgets.  It can also take a minute to complete. Importing data is recommended on fresh installs only once. Importing on sites with content or importing twice will duplicate menus, pages and all posts.</p>',
        'type'        => 'textblock',
		'section'     => 'general_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
		
	   array(
        'id'          => 'global_color',
        'label'       => __( 'Theme Primary Color', 'magee' ),
        'std'         => '#00b7ee',
		'desc'        => __( 'Select the primary color, it defines serveral items like link hovers, highlights, and more.', 'magee' ),
        'type'        => 'colorpicker',
        'section'     => 'general_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
		
 
	   array(
        'id'          => 'page_background',
        'label'       => __( 'Page Background', 'magee' ),
		'desc'        => __( 'Select color or an image to use for the backgroud.', 'magee' ),
        'type'        => 'background',
		'section'     => 'general_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	   array(
        'id'          => 'main_content_area_background',
        'label'       => __( 'Background For Main Content Area In Boxed Mode', 'magee' ),
		'desc'        => __( 'Select color or an image to use for the main content area backgroud in boxed mode.', 'magee' ),
        'type'        => 'background',
		'section'     => 'general_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
		  
	   array(
        'label'       => __( 'Breadcrumb Styles', 'magee' ),
        'id'          => 'breadcrumb_style',
        'type'        => 'select',
        'desc'        => __( 'Select the style to show the breadcrumb. This is a global option for every page or post.', 'magee' ),
        'choices'     => array(
							   
		array(
            'label'       => 'No Breadcrumb',
            'value'       => '0'
          ),
          array(
            'label'       => 'Breadcrumb without background',
            'value'       => '1'
          ),
          array(
            'label'       => 'Breadcrumb with background',
            'value'       => '2'
          )
        ),
        'std'         => '1',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general_options'
      )
	   ,
	   array(
        'label'       => __( 'Breadcrumb Styles', 'magee' ),
        'id'          => 'breadcrumb_style',
        'type'        => 'select',
        'desc'        => '',
        'choices'     => array(
							   
		array(
            'label'       => 'No Breadcrumb',
            'value'       => '0'
          ),
          array(
            'label'       => 'Breadcrumb without background',
            'value'       => '1'
          ),
          array(
            'label'       => 'Breadcrumb with background',
            'value'       => '2'
          )
        ),
        'std'         => '1',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general_options'
      ),
	   array(
        'id'          => 'breadcrumb_background',
        'label'       => __( 'Breadcrumb Background', 'magee' ),
		'desc'        => __( 'Select color or an image to use for the breadcrumb background.', 'magee' ),
        'type'        => 'background',
		'section'     => 'general_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      )
	   
	    ,
	   array(
        'label'       => __( 'Layout', 'magee' ),
        'id'          => 'site_layout',
        'type'        => 'select',
        'desc'        => __( 'Select boxed or wide layout.', 'magee' ),
        'choices'     => array(
							   
		array(
            'label'       => 'Wide',
            'value'       => 'wide'
          ),
          array(
            'label'       => 'Boxed',
            'value'       => 'boxed'
          )
        ),
        'std'         => 'wide',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general_options'
      )
	   ,

	    array(
        'id'          => 'tracking_code',
        'label'       => __( 'Tracking Code', 'magee' ),
        'type'        => 'textarea-simple',
        'section'     => 'general_options',
		'desc'        => 'The Tracking Code initiates the recording process for every page on your site on which it is placed, although not every visitor will actually be recorded. That is determined by your recording ration, quota, visitor type, browser and other parameters. (e.g. google analytics tracking code)',
        'rows'        => '5',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
		  array(
        'id'          => 'space_head',
        'label'       => __( 'Space before &lt;/head&gt;', 'magee' ),
        'type'        => 'textarea-simple',
        'section'     => 'general_options',
		'desc'        => 'Add code before the &lt;/head&gt; tag.',
        'rows'        => '5',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
		array(
        'id'          => 'space_body',
        'label'       => __( 'Space before &lt;/body&gt;', 'magee' ),
        'type'        => 'textarea-simple',
        'section'     => 'general_options',
		'desc'        => 'Add code before the &lt;/body&gt; tag.',
        'rows'        => '5',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  
	   array(
        'id'          => 'custom_css',
        'label'       => __( 'Custom CSS', 'magee' ),
		'desc'        => __( 'Paste your CSS code here, do not include any script or HTML in thie field. What you enter here will override the theme CSS. ', 'magee' ),
        'std'         => '#custom {
  margin:0;
}',
        'type'        => 'css',
        'section'     => 'general_options',
        'rows'        => '20',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),

	  
 //header options
  array(
        'id'          => 'header_template',
        'label'       => __( 'Header Styles', 'magee' ),
        'desc'        => '',
        'std'         => '3',
        'type'        => 'radio-image',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
		
	 array(
        'id'          => 'header_transparent',
        'label'       => __( 'Transparent Header', 'magee' ),
		'desc'        => __('Enable/Disable a transparent header that will display your slider behind it.','magee'),
        'std'         => 'off',
        'type'        => 'on-off',
		'section'     => 'header',
      ),
	 
	  array(
        'id'          => 'header_text',
        'label'       => __( 'Header Text', 'magee' ),
        'std'         => '<span><i class="fa fa-phone"></i>01-23456789</span>
<span><i class="fa fa-envelope-o"></i>info@example.com</span>',
        'type'        => 'textarea-simple',
        'section'     => 'header',
        'rows'        => '4',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  
 
  array(
        'id'          => 'sns_list_item',
        'label'       => __( 'Header SNS Icon', 'magee' ),
        'desc'        => '',
        'std'         => array(
						
    array('title'=>'Facebook','sns' => 'facebook', 'link'=>'#'),
	array('title'=>'Twitter','sns' => 'twitter', 'link'=>'#'), 
	array('title'=>'LinkedIn','sns' => 'linkedin', 'link'=>'#'),
	array('title'=>'YouTube','sns' => 'youtube', 'link'=>'#'),
	array('title'=>'Skype','sns' => 'skype', 'link'=>'#'),
	array('title'=>'Pinterest','sns' => 'pinterest', 'link'=>'#'),
	array('title'=>'Google+','sns' => 'google-plus', 'link'=>'#'),
    array('title'=>'Email','sns' => 'envelope', 'link'=>'#'),
	array('title'=>'RSS','sns' => 'rss', 'link'=>'#')
        ),
        'type'        => 'list-item',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
		 'desc'        => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'settings'    => array( 

		array(
        'id'          => 'sns',
        'label'       => __( 'SNS', 'magee' ),
        'std'         => '',
        'type'        => 'select',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
		'choices'     => array( 
          array(
            'value'       => '',
            'label'       => __( '-- Choose One --', 'magee' ),
            'src'         => ''
          ),
          array(
            'value'       => 'facebook',
            'label'       => __( 'facebook', 'magee' ),
            'src'         => ''
          ),
          array(
            'value'       => 'twitter',
            'label'       => __( 'twitter', 'magee' ),
            'src'         => ''
          ),
          array(
            'value'       => 'linkedin',
            'label'       => __( 'linkedin', 'magee' ),
            'src'         => ''
          )
		  ,
		   array(
            'value'       => 'youtube',
            'label'       => __( 'youtube', 'magee' ),
            'src'         => ''
          )
		  ,
		   array(
            'value'       => 'skype',
            'label'       => __( 'skype', 'magee' ),
            'src'         => ''
          )
		  ,
          array(
            'value'       => 'pinterest',
            'label'       => __( 'pinterest', 'magee' ),
            'src'         => ''
          )
		  ,
          array(
            'value'       => 'google-plus',
            'label'       => __( 'google plus', 'magee' ),
            'src'         => ''
          )
		  ,
          array(
            'value'       => 'envelope',
            'label'       => __( 'email', 'magee' ),
            'src'         => ''
          )
		  ,
          array(
            'value'       => 'rss',
            'label'       => __( 'rss', 'magee' ),
            'src'         => ''
          )
        )
      ),
		array(
        'id'          => 'link',
        'label'       => __( 'SNS Link', 'magee' ),
        'std'         => '',
        'type'        => 'text',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      )
        )
      )
	  ,
 array(
        'id'          => 'header_background',
        'label'       => __( 'Header Background', 'magee' ),
		'desc'        => __( 'Select color or an image to use for the header background.', 'magee' ),
        'type'        => 'background',
		'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
 
 array(
        'id'          => 'header_bg_full',
        'label'       => __( '100% Background Image', 'magee' ),
		'desc'        => __('Check this box to have the header background image display at 100% in width and height and scale according to the browser size.','magee'),
        'std'         => 'off',
        'type'        => 'on-off',
		'section'     => 'header',
      ),
	  
	  array(
        'id'          => 'margin_header_top',
        'label'       => __( 'Header Top Padding', 'magee' ),
        'desc'        => __( 'In pixels.', 'magee' ),
        'std'         => '0',
        'type'        => 'numeric-slider',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '0,100,1',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	    array(
        'id'          => 'margin_header_bottom',
        'label'       => __( 'Header Bottom Padding', 'magee' ),
        'desc'        => __( 'In pixels.', 'magee' ),
        'std'         => '0',
        'type'        => 'numeric-slider',
        'section'     => 'header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '0,100,1',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	
 


//logo
  array(
        'id'          => 'logo',
        'label'       => __( 'Upload Logo', 'magee' ),
        'desc'        => __( 'Select an image file for your logo.', 'magee' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'logo',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),

  
  array(
        'id'          => 'favicon',
        'label'       => __( 'Upload Favicon', 'magee' ),
         'desc'        => __( 'An icon associated with a URL that is variously displayed, as in a browser\'s address bar or next to the site name in a bookmark list. Learn more about <a href="'.esc_url("http://en.wikipedia.org/wiki/Favicon").'" target="_blank">Favicon</a>', 'magee' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'logo',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ), 
     // menu
	 
	  array(
        'id'          => 'dropdown_menu_width',
        'label'       => __( 'Main Menu Dropdown Width', 'magee' ),
        'desc'        => __( 'In pixels.', 'magee' ),
        'std'         => '180',
        'type'        => 'numeric-slider',
        'section'     => 'menu',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '180,350,1',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
  
    //Typography
  
  
	 array(
        'id'          => 'body_font_family',
        'label'       => __( 'Body Font Family', 'magee' ),
		'desc'        => __( 'Select the font style for body text.', 'magee' ),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'tagline_typography',
        'label'       => __( 'Tagline Typography', 'magee' ),
		'desc'        => __( 'Select the font style for tagline.', 'magee' ),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	 array(
        'id'          => 'main_menu_font',
        'label'       => __( 'Main Menu Font', 'magee' ),
		'desc'        => __( 'Select the font style for main menu.', 'magee' ),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	 array(
        'id'          => 'main_menu_dropdown_font',
        'label'       => __( 'Main Menu Dropdown Font', 'magee' ),
		'desc'        => __( 'Select the font style for main menu dropdown.', 'magee' ),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	 array(
        'id'          => 'headings_font',
        'label'       => __( 'Headings Font', 'magee' ),
		'desc'        => __( 'Select the font style for content headings.', 'magee' ),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'content_typography',
        'label'       => __( 'Post Content Typography', 'magee' ),
		'desc'        => __( 'Select the font style for post content.', 'magee' ),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	 array(
        'id'          => 'footer_headings_font',
        'label'       => __( 'Footer Headings Font', 'magee' ),
		'desc'        => __( 'Select the font style for footer headings.', 'magee' ),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	 array(
        'id'          => 'copyright_font',
        'label'       => __( 'Copyright Font', 'magee' ),
		'desc'        => __( 'Select the font style for copyright.', 'magee' ),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	 array(
        'id'          => 'h1_font',
        'label'       => __( 'H1 Font', 'magee' ),
		'desc'        => __( 'Select the font style for &lt;h1&gt; tag.', 'magee' ),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	array(
        'id'          => 'h2_font',
        'label'       => __( 'H2 Font', 'magee' ),
		'desc'        => __( 'Select the font style for &lt;h2&gt; tag.', 'magee' ),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	array(
        'id'          => 'h3_font',
        'label'       => __( 'H3 Font', 'magee' ),
		'desc'        => __( 'Select the font style for &lt;h3&gt; tag.', 'magee' ),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	array(
        'id'          => 'h4_font',
        'label'       => __( 'H4 Font', 'magee' ),
		'desc'        => __( 'Select the font style for &lt;h4&gt; tag.', 'magee' ),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	array(
        'id'          => 'h5_font',
        'label'       => __( 'H5 Font', 'magee' ),
		'desc'        => __( 'Select the font style for &lt;h5&gt; tag.', 'magee' ),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	array(
        'id'          => 'h6_font',
        'label'       => __( 'H6 Font', 'magee' ),
		'desc'        => __( 'Select the font style for &lt;h6&gt; tag.', 'magee' ),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  
	// blog
	
	array(
        'id'          => 'general_blog_options',
        'label'       => __( 'General Blog Options', 'magee' ),
        'std'         =>  '',
		'desc'        => '<h2 style="background-color: #999;padding:5px">'.__( 'General Blog Options', 'magee' ).'</h2>',
        'type'        => 'textblock',
		'section'     => 'blog',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	 array(
        'label'       => __( 'Excerpt or Full Blog Content', 'magee' ),
        'id'          => 'content_length',
        'type'        => 'select',
        'desc'        => __( 'Choose to display an excerpt or full content on blog pages.', 'magee' ),
        'choices'     => array(
							   
		array(
            'label'       => 'Excerpt',
            'value'       => 'excerpt'
          ),
          array(
            'label'       => 'Full Content',
            'value'       => 'full_content'
          )
        ),
        'std'         => 'excerpt',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'blog'
      ),
	
	 array(
        'id'          => 'blog_excerpt_length',
        'label'       => __( 'Excerpt Length', 'magee' ),
        'desc'        => __( 'The number of words you want to show in the post excerpts.', 'magee' ),
        'std'         => '55',
        'type'        => 'numeric-slider',
        'section'     => 'blog',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '5,200,1',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	 
	 array(
        'id'          => 'strip_html_excerpt',
        'label'       => __( 'Strip HTML from Excerpt', 'magee' ),
		'desc'        => __( 'Choose to display footer widgets or not.', 'magee' ),
        'std'         => 'on',
        'type'        => 'on-off',
		'section'     => 'blog',
      ),
	  array(
        'id'          => 'single_post_full_width',
        'label'       => __( 'Set All Post Items Full Width', 'magee' ),
		'desc'        => __( 'Turn all single post items to full width with no sidebar.', 'magee' ),
        'std'         => 'off',
        'type'        => 'on-off',
		'section'     => 'blog',
      ),
	 array(
        'id'          => 'featured_images',
        'label'       => __( 'Featured Image on Blog Archive Page', 'magee' ),
		'desc'        => __( 'Ddisplay featured images on blog archive page or not.', 'magee' ),
        'std'         => 'on',
        'type'        => 'on-off',
		'section'     => 'blog',
      ),
	// blog single
	
	array(
        'id'          => 'blog_single',
        'label'       => __( 'Blog Single', 'magee' ),
        'std'         =>  '',
		'desc'        => '<h2 style="background-color: #999;padding:5px">'.__( 'Blog Single Post Page Options', 'magee' ).'</h2>',
        'type'        => 'textblock',
		'section'     => 'blog',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	
	 array(
        'id'          => 'featured_images_single',
        'label'       => __( 'Featured Image on Single Post Page', 'magee' ),
		'desc'        => __( 'Display featured images on single post page.', 'magee' ),
        'std'         => 'off',
        'type'        => 'on-off',
		'section'     => 'blog',
      ),
	 array(
        'id'          => 'social_sharing_box',
        'label'       => __( 'Social Sharing Box', 'magee' ),
		'desc'        => __( 'Display the social sharing box.', 'magee' ),
        'std'         => 'on',
        'type'        => 'on-off',
		'section'     => 'blog',
      ),
	array(
        'id'          => 'related_posts',
        'label'       => __( 'Related Posts', 'magee' ),
		'desc'        => __( 'Display related posts.', 'magee' ),
        'std'         => 'on',
        'type'        => 'on-off',
		'section'     => 'blog',
      ),
	
	array(
        'id'          => 'blog_meta_options',
        'label'       => __( 'blog meta options', 'magee' ),
        'std'         =>  '',
		'desc'        => '<h2 style="background-color: #999;padding:5px">'.__( 'Blog Meta Options', 'magee' ).'</h2>',
        'type'        => 'textblock',
		'section'     => 'blog',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	
	array(
        'id'          => 'post_meta_author',
        'label'       => __( 'Display Post Meta Author', 'magee' ),
		'desc'        => __( 'Display the author name from post meta.', 'magee' ),
        'std'         => 'on',
        'type'        => 'on-off',
		'section'     => 'blog',
      ),
	array(
        'id'          => 'post_meta_date',
        'label'       => __( 'Display Post Meta Date', 'magee' ),
		'desc'        => __( 'Display the date from post meta.', 'magee' ),
        'std'         => 'on',
        'type'        => 'on-off',
		'section'     => 'blog',
      ),
	array(
        'id'          => 'post_meta_cats',
        'label'       => __( 'Display Post Meta Categories', 'magee' ),
		'desc'        => __( 'Display the categories from post meta.', 'magee' ),
        'std'         => 'on',
        'type'        => 'on-off',
		'section'     => 'blog',
      ),
	array(
        'id'          => 'post_meta_comments',
        'label'       => __( 'Display Post Meta Comments', 'magee' ),
		'desc'        => __( 'Display the comments from post meta.', 'magee' ),
        'std'         => 'on',
        'type'        => 'on-off',
		'section'     => 'blog',
      ),
	array(
        'id'          => 'post_meta_read',
        'label'       => __( 'Display Post Meta Read More Link', 'magee' ),
		'desc'        => __( 'Display the read more link from post meta.', 'magee' ),
        'std'         => 'on',
        'type'        => 'on-off',
		'section'     => 'blog',
      ),
	array(
        'id'          => 'date_format',
        'label'       => __( 'Date Format', 'magee' ),
		'desc'        => __( '<a target="_blank" href="http://codex.wordpress.org/Formatting_Date_and_Time">Formatting Date and Time</a>', 'magee' ),
        'std'         => 'M d, Y',
        'type'        => 'text',
		'section'     => 'blog',
      ),
	
	//portfolio
	
	array(
        'id'          => 'general_portfolio_options',
        'label'       => __( 'Blog Single', 'magee' ),
        'std'         =>  '',
		'desc'        => '<h2 style="background-color: #999;padding:5px">'.__( 'General Portfolio Options', 'magee' ).'</h2>',
        'type'        => 'textblock',
		'section'     => 'portfolio',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	
		 array(
        'id'          => 'portfolio_items',
        'label'       => __( 'Number of Portfolio Items Per Page', 'magee' ),
        'desc'        => __( 'The number of posts to display per page for portfolio category.', 'magee' ),
        'std'         => '10',
        'type'        => 'numeric-slider',
        'section'     => 'portfolio',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '2,40,1',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
		
	
	  array(
        'label'       => __( 'Portfolio Category Columns', 'magee' ),
        'id'          => 'portfolio_category_columns',
        'type'        => 'select',
        'desc'        => __('Select the number of columns for portfolio category.','magee'),
        'choices'     => array(
							   
          array(
            'label'       => '2',
            'value'       => '2'
          )
		  ,
          array(
            'label'       => '3',
            'value'       => '3'
          )
		  ,
          array(
            'label'       => '4',
            'value'       => '4'
          )
        ),
        'std'         => '3',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'portfolio'
      ),
	
	 array(
        'id'          => 'portfolio_slug',
        'label'       => __( 'Portfolio Slug', 'magee' ),
		'desc'        => __( 'Change/Rewrite the permalink when you use the permalink type as %postname%. Make sure to regenerate permalinks.', 'magee' ),
        'std'         => 'portfolio',
        'type'        => 'text',
		'section'     => 'portfolio',
      ),
	 
	 
	  array(
        'id'          => 'portfolio_social_sharing_box',
        'label'       => __( 'Social Sharing Box', 'magee' ),
		'desc'        => __( 'Choose to display the social sharing box.', 'magee' ),
        'std'         => 'on',
        'type'        => 'on-off',
		'section'     => 'footer',
      ),
	
	  
	 //== FOOTER
	// Footer Widget Area
	  
	   array(
        'id'          => 'footer_area_active',
        'label'       => __( 'Footer Widget Area On/Off', 'magee' ),
		'desc'        => __( 'Choose to display footer widgets or not.', 'magee' ),
        'std'         => 'on',
        'type'        => 'on-off',
		'section'     => 'footer',
      ),
	  array(
        'label'       => __( 'Number of Footer Columns', 'magee' ),
        'id'          => 'footer_widgets_columns',
        'type'        => 'select',
        'desc'        => __('Select the number of columns to display in the footer.','magee'),
        'choices'     => array(
							   
		array(
            'label'       => '1',
            'value'       => '1'
          ),
          array(
            'label'       => '2',
            'value'       => '2'
          )
		  ,
          array(
            'label'       => '3',
            'value'       => '3'
          )
		  ,
          array(
            'label'       => '4',
            'value'       => '4'
          )
        ),
        'std'         => '4',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'footer_widget_area'
      ),
	   array(
        'id'          => 'footer_area_background',
        'label'       => __( 'Footer Widget Area Background', 'magee' ),
		'desc'        => __( 'Select color or an image to use for the footer widget area backgroud.', 'magee' ),
        'type'        => 'background',
		'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	   array(
        'id'          => 'footerw_bg_full',
        'label'       => __( '100% Background Image', 'magee' ),
		'desc'        => __('Check this box to have the footer widgets area background image display at 100% in width and height and scale according to the browser size.','magee'),
        'std'         => 'off',
        'type'        => 'on-off',
		'section'     => 'footer',
      ),
	   
	     array(
        'id'          => 'footer_area_top_padding',
        'label'       => __( 'Footer Top Padding', 'magee' ),
        'desc'        => __( 'In pixels.', 'magee' ),
        'std'         => '40',
        'type'        => 'numeric-slider',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '0,100,1',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	    array(
        'id'          => 'footer_area_bottom_padding',
        'label'       => __( 'Footer Bottom Padding', 'magee' ),
        'desc'        => __( 'In pixels.', 'magee' ),
        'std'         => '0',
        'type'        => 'numeric-slider',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '0,100,1',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
		
	 // Copyright Area
	 
	  array(
        'id'          => 'footer_copyright_active',
        'label'       => __( 'Copyright Bar On/Off', 'magee' ),
		'desc'        => __( 'Choose to display footer copyright bar or not.', 'magee' ),
        'std'         => 'on',
        'type'        => 'on-off',
		'section'     => 'footer',
      ),
	  
	
        array(
        'id'          => 'copyright',
        'label'       => __( 'Copyright Text', 'magee' ),
        'std'         => 'Copyright &copy; '.date("Y"),
		'desc'        => __( 'Enter the text that displays in the copyright bar. HTML markup can be used.', 'magee' ),
        'type'        => 'textarea-simple',
        'section'     => 'footer',
        'rows'        => '5',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
		
		 array(
        'id'          => 'copyright_top_padding',
        'label'       => __( 'Copyright Top Padding', 'magee' ),
        'desc'        => __( 'In pixels.', 'magee' ),
        'std'         => '0',
        'type'        => 'numeric-slider',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '0,100,1',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	    array(
        'id'          => 'copyright_bottom_padding',
        'label'       => __( 'Copyright Bottom Padding', 'magee' ),
        'desc'        => __( 'In pixels.', 'magee' ),
        'std'         => '0',
        'type'        => 'numeric-slider',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '0,100,1',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
		
	  // social icon
	  
	   array(
        'id'          => 'display_footer_social_icons',
        'label'       => __( 'Display Social Icons on Footer of the Page', 'magee' ),
		'desc'        => __( 'Choose to display footer social icons or not.', 'magee' ),
        'std'         => 'on',
        'type'        => 'on-off',
		'section'     => 'footer',
      ),
	   
	     array(
        'id'          => 'footer_social_icon_color',
        'label'       => __( 'Footer Social Icons Custom Color', 'magee' ),
		'desc'        => __( 'Select the color of the social icons in the footer.', 'magee' ),
        'std'         => '#aaaaaa',
        'type'        => 'colorpicker',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ), 
	   
	     array(
        'id'          => 'footer_sns_list',
        'label'       => __( 'Footer SNS', 'magee' ),
        'desc'        => '',
        'std'         => array(
						
    array('title'=>'Facebook','sns' => 'facebook', 'link'=>'#'),
	array('title'=>'Twitter','sns' => 'twitter', 'link'=>'#'), 
	array('title'=>'LinkedIn','sns' => 'linkedin', 'link'=>'#'),
	array('title'=>'YouTube','sns' => 'youtube', 'link'=>'#'),
	array('title'=>'Skype','sns' => 'skype', 'link'=>'#'),
	array('title'=>'Pinterest','sns' => 'pinterest', 'link'=>'#'),
	array('title'=>'Google+','sns' => 'google-plus', 'link'=>'#'),
    array('title'=>'Email','sns' => 'envelope', 'link'=>'#'),
	array('title'=>'RSS','sns' => 'rss', 'link'=>'#')
        ),
        'type'        => 'list-item',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
		 'desc'        => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'settings'    => array( 

		array(
        'id'          => 'sns',
        'label'       => __( 'SNS', 'magee' ),
        'std'         => '',
        'type'        => 'select',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
		'choices'     => array( 
          array(
            'value'       => '',
            'label'       => __( '-- Choose One --', 'magee' ),
            'src'         => ''
          ),
          array(
            'value'       => 'facebook',
            'label'       => __( 'facebook', 'magee' ),
            'src'         => ''
          ),
          array(
            'value'       => 'twitter',
            'label'       => __( 'twitter', 'magee' ),
            'src'         => ''
          ),
          array(
            'value'       => 'linkedin',
            'label'       => __( 'linkedin', 'magee' ),
            'src'         => ''
          )
		  ,
		   array(
            'value'       => 'youtube',
            'label'       => __( 'youtube', 'magee' ),
            'src'         => ''
          )
		  ,
		   array(
            'value'       => 'skype',
            'label'       => __( 'skype', 'magee' ),
            'src'         => ''
          )
		  ,
          array(
            'value'       => 'pinterest',
            'label'       => __( 'pinterest', 'magee' ),
            'src'         => ''
          )
		  ,
          array(
            'value'       => 'google-plus',
            'label'       => __( 'google plus', 'magee' ),
            'src'         => ''
          )
		  ,
          array(
            'value'       => 'envelope',
            'label'       => __( 'email', 'magee' ),
            'src'         => ''
          )
		  ,
          array(
            'value'       => 'rss',
            'label'       => __( 'rss', 'magee' ),
            'src'         => ''
          )
        )
      ),
		array(
        'id'          => 'link',
        'label'       => __( 'SNS Link', 'magee' ),
        'std'         => '',
        'type'        => 'text',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      )
        )
      ),
	  
	  //// 404 page

		array(
        'id'          => 'not_found_title',
        'label'       => __( 'Title', 'magee' ),
        'std'         => 'WHOOPS!',
        'type'        => 'text',
		'section'     => 'not_found',
        'rows'        => '10',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
        array(
        'id'          => 'not_found_content',
        'label'       => __( 'Content', 'magee' ),
        'std'         => 'THERE IS NOTHING HERE.<br />PERHAPS YOU WERE GIVEN THE WRONG URL?',
        'type'        => 'textarea',
        'section'     => 'not_found',
        'rows'        => '5',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      )
	,
	   
	    array(
        'id'          => 'default_layout',
        'label'       => __( 'Default Layout', 'magee' ),
        'desc'        => '',
        'std'         => 'left-sidebar',
        'type'        => 'radio-image',
        'section'     => 'page_layout',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
		 array(
        'id'          => 'default_page_layout',
        'label'       => __( 'Default Page Layout', 'magee' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'radio-image',
        'section'     => 'page_layout',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
		  array(
        'id'          => 'default_post_layout',
        'label'       => __( 'Default Single Post Layout', 'magee' ),
        'desc'        => '',
        'std'         => 'left-sidebar',
        'type'        => 'radio-image',
        'section'     => 'page_layout',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
		array(
        'id'          => 'default_portfolio_layout',
        'label'       => __( 'Default Single Portfolio Layout', 'magee' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'radio-image',
        'section'     => 'page_layout',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      )
		
	  
	  )
	  );
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( ot_settings_id() . '_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( ot_settings_id(), $custom_settings ); 
  }
  
	  }