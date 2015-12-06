<?php
/**
 * Initialize the custom Meta Boxes. 
 */
add_action( 'admin_init', 'custom_meta_boxes' );

 function magee_sliders_meta(){
	 $magee_sliders[] = array(
            'label'       => 'Select a slider',
            'value'       => ''
          );
	$magee_custom_slider = new WP_Query( array( 'post_type' => 'magee_slider', 'posts_per_page' => -1 ) );
	while ( $magee_custom_slider->have_posts() ) {
		$magee_custom_slider->the_post();

		$magee_sliders[] = array(
            'label'       => get_the_title(),
            'value'       => get_the_ID()
          );
	}
	wp_reset_postdata();
	return $magee_sliders;
	 }
/**
 * Meta Boxes demo code.
 *
 * You can find all the available option types in demo-theme-options.php.
 *
 * @return    void
 * @since     2.0
 */
function custom_meta_boxes() {
	
global $wpdb;


/************ Magee Sliders*************/

 $magee_sliders = magee_sliders_meta();

/*************************/	
	

  /**
   * Create a custom meta boxes array that we pass to 
   */
  $page_meta_box = array(
    'id'          => 'page_meta_box',
    'title'       => __( 'Page Meta Box', 'magee' ),
    'desc'        => '',
    'pages'       => array( 'page' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'label'       => __( 'General Options', 'magee' ),
        'id'          => 'general_options',
        'type'        => 'tab'
      ),
	  array(
        'id'          => 'show_breadcrumb',
        'label'       => __( 'Display Breadcrumb', 'magee' ),
        'std'         => 'on',
        'type'        => 'on-off',
		'section'     => 'general_options'
      ),
	   array(
        'id'          => 'wrapper_width',
        'label'       => __( 'Content Width', 'magee' ),
        'desc'        => '',
        'std'         => 'boxed',
        'type'        => 'select',
        'section'     => 'general_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          
          array(
            'value'       => 'boxed',
            'label'       => __( 'boxed', 'magee' ),
            'src'         => ''
          ),
          array(
            'value'       => 'full',
            'label'       => __( 'full', 'magee' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'page_layout',
        'label'       => __( 'Layout', 'magee' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'radio-image',
        'section'     => '',
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
        'label'       => __( 'Background', 'magee' ),
        'std'         => '',
        'type'        => 'background',
		'section'     => ''
      )
	   , array(
        'label'       => __( 'Slider Options', 'magee' ),
        'id'          => 'slider_options',
        'type'        => 'tab'
      ),
	   array(
        'label'       => __( 'Slider Position', 'magee' ),
        'id'          => 'slider_position',
        'type'        => 'select',
        'desc'        => __('Select if the slider shows below or above the header. This only works for the slider assigned in page options, not with shortcodes.','magee'),
        'choices'     => array(
							   
		array(
            'label'       => 'Below',
            'value'       => 'below'
          ),
          array(
            'label'       => 'Above',
            'value'       => 'above'
          )
        ),
        'std'         => 'below',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'slider_options'
      ),
	   array(
        'label'       => __( 'Slider Type', 'magee' ),
        'id'          => 'slider_type',
        'type'        => 'select',
        'desc'        =>'',
        'choices'     => array(
							   
		array(
            'label'       => 'No Slider',
            'value'       => ''
          ),
         
          array(
            'label'       => 'Magee Slider',
            'value'       => 'magee'
          )
        ),
        'std'         => 'no',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'slider_options'
      )
	   ,
	  
	   array(
        'label'       => __( 'Select Magee Slider', 'magee' ),
        'id'          => 'magee_slider',
        'type'        => 'select',
        'desc'        =>'',
        'choices'     => $magee_sliders,
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'slider_options'
      )
	   
    )
  );
  
    $post_meta_box = array(
    'id'          => 'page_meta_box',
    'title'       => __( 'Post Meta Box', 'magee' ),
    'desc'        => '',
    'pages'       => array( 'post' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'label'       => __( 'General Options', 'magee' ),
        'id'          => 'general_options',
        'type'        => 'tab'
      ),
	   
      array(
        'id'          => 'page_layout',
        'label'       => __( 'Layout', 'magee' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'radio-image',
        'section'     => 'general_options',
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
  

  
    $portfolio_meta_box = array(
    'id'          => 'portfolio_meta_box',
    'title'       => __( 'Portfolio Meta Box', 'magee' ),
    'desc'        => '',
    'pages'       => array( 'portfolio' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
						   
	  array(
        'label'       => __( 'General Options', 'magee' ),
        'id'          => 'general_options',
        'type'        => 'tab',
		'section'     => ''
		
      ),
	   array(
        'id'          => 'page_layout',
        'label'       => __( 'Layout', 'magee' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'radio-image',
        'section'     => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),

	   array(
        'id'          => 'show_related_portfolios',
        'label'       => __( 'Display Related Portfolios', 'magee' ),
        'std'         => 'on',
        'type'        => 'on-off',
		'section'     => 'general_options'
      ),
      array(
        'label'       => __( 'Gallery', 'magee' ),
        'id'          => 'gallery',
        'type'        => 'tab'
      ),
	  
      array(
        'id'          => 'portfolio_gallery',
        'label'       => __( 'Gallery', 'magee' ),
        'std'         => '',
        'type'        => 'gallery',
        'section'     => 'gallery',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'label'       => __( 'Attributes', 'magee' ),
        'id'          => 'attributes',
        'type'        => 'tab'
      ),
	   array(
        'id'          => 'show_attributes',
        'label'       => __( 'Display Attributes', 'magee' ),
        'std'         => 'off',
        'type'        => 'on-off',
		'section'     => ''
      ),
	  array(
        'id'          => 'attributes_group_title',
        'label'       => __('Attributes Group Title', 'magee' ),
        'std'         => 'Details',
        'type'        => 'text',
		'section'     => ''
      ),
	   array(
        'id' => 'project_date',
        'label' => __( 'Project Date', 'magee' ),
        'desc' => '',
        'std' => '',
        'type' => 'date-picker',
        'section' => '',
        'rows' => '',
        'post_type' => '',
        'taxonomy' => '',
        'min_max_step'=> '',
        'class' => '',
        'condition' => '',
        'operator' => 'and'
      ),
	   array(
        'id'          => 'project_budget',
        'label'       => __( 'Project Budget', 'magee' ),
        'std'         => '',
        'type'        => 'text',
		'section'     => ''
      ),
	   array(
        'id'          => 'technologies',
        'label'       => __( 'Technologies', 'magee' ),
        'std'         => '',
        'type'        => 'text',
		'section'     => ''
      )
	   
    )
  );
  

  /**
   * Register our meta boxes using the 
   * ot_register_meta_box() function.
   */
  if ( function_exists( 'ot_register_meta_box' ) ){
    ot_register_meta_box( $page_meta_box );
	ot_register_meta_box( $post_meta_box );
	ot_register_meta_box( $portfolio_meta_box );
	}

}