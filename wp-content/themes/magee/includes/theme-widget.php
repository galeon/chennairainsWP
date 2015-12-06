<?php
// global $wp_registered_sidebars;
#########################################
function magee_widgets_init() {
		register_sidebar(array(
		
			'name' => __('Default Sidebar','magee'),
			'id'   => 'default_sidebar',
			'before_widget' => '<div id="%1$s" class="widget widget-box %2$s">', 
			'after_widget' => '<span class="seperator extralight-border"></span></div>', 
			'before_title' => '<h1 class="widget-title">', 
			'after_title' => '</h1>', 
			));
		    register_sidebar(array(
			'name' => __('Sidebar Page','magee'),
			'id'   => 'page',
			'before_widget' => '<div id="%1$s" class="widget widget-box %2$s">', 
			'after_widget' => '<span class="seperator extralight-border"></span></div>', 
			'before_title' => '<h1 class="widget-title">', 
			'after_title' => '</h1>', 
			));
			register_sidebar(array(
			'name' => __('Sidebar Post List','magee'),
			'id'   => 'blog_list',
			'before_widget' => '<div id="%1$s" class="widget widget-box %2$s">', 
			'after_widget' => '<span class="seperator extralight-border"></span></div>', 
			'before_title' => '<h1 class="widget-title">', 
			'after_title' => '</h1>', 
			));
		
		    register_sidebar(array(
			'name' => __('Sidebar Post Single','magee'),
			'id'   => 'blog_post',
			'before_widget' => '<div id="%1$s" class="widget widget-box %2$s">', 
			'after_widget' => '<span class="seperator extralight-border"></span></div>', 
			'before_title' => '<h1 class="widget-title">', 
			'after_title' => '</h1>', 
			));
				
			
			register_sidebar(array(
			'name' => __('Sidebar Portfolio List','magee'),
			'id'   => 'portfolio-category',
			'before_widget' => '<div id="%1$s" class="widget widget-box %2$s">', 
			'after_widget' => '<span class="seperator extralight-border"></span></div>', 
			'before_title' => '<h1 class="widget-title">', 
			'after_title' => '</h1>', 
			));
			
			register_sidebar(array(
			'name' => __('Sidebar Portfolio Single','magee'),
			'id'   => 'portfolio',
			'before_widget' => '<div id="%1$s" class="widget widget-box %2$s">', 
			'after_widget' => '<span class="seperator extralight-border"></span></div>', 
			'before_title' => '<h1 class="widget-title">', 
			'after_title' => '</h1>', 
			));
						
			/*register_sidebar(array(
			'name' => 'Sidebar Archive',
			'id'   => 'archive',
			'before_widget' => '<div id="%1$s" class="widget widget-box %2$s">', 
			'after_widget' => '<span class="seperator extralight-border"></span></div>', 
			'before_title' => '<h1 class="widget-title">', 
			'after_title' => '</h1>', 
			));
		
			register_sidebar(array(
			'name' => 'Sidebar Search',
			'id'   => 'search',
			'before_widget' => '<div id="%1$s" class="widget widget-box %2$s">', 
			'after_widget' => '<span class="seperator extralight-border"></span></div>', 
			'before_title' => '<h1 class="widget-title">', 
			'after_title' => '</h1>', 
			));
			register_sidebar(array(
			'name' => 'Sidebar Tags',
			'id'   => 'tags',
			'before_widget' => '<div id="%1$s" class="widget widget-box %2$s">', 
			'after_widget' => '<span class="seperator extralight-border"></span></div>', 
			'before_title' => '<h1 class="widget-title">', 
			'after_title' => '</h1>', 
			));*/
			
			// footer
			register_sidebar(array(
			'name' => __('Footer Area One','magee'),
			'id'   => 'footer_area_one',
			'before_widget' => '<div id="%1$s" class="widget widget-box %2$s">', 
			'after_widget' => '<span class="seperator extralight-border"></span></div>', 
			'before_title' => '<h1 class="widget-title">', 
			'after_title' => '</h1>', 
			));
			register_sidebar(array(
			'name' => __('Footer Area Two','magee'),
			'id'   => 'footer_area_two',
			'before_widget' => '<div id="%1$s" class="widget widget-box %2$s">', 
			'after_widget' => '<span class="seperator extralight-border"></span></div>', 
			'before_title' => '<h1 class="widget-title">', 
			'after_title' => '</h1>', 
			));
			register_sidebar(array(
			'name' => __('Footer Area Three','magee'),
			'id'   => 'footer_area_three',
			'before_widget' => '<div id="%1$s" class="widget widget-box %2$s">', 
			'after_widget' => '<span class="seperator extralight-border"></span></div>', 
			'before_title' => '<h1 class="widget-title">', 
			'after_title' => '</h1>', 
			));
			register_sidebar(array(
			'name' => __('Footer Area Four','magee'),
			'id'   => 'footer_area_four',
			'before_widget' => '<div id="%1$s" class="widget widget-box %2$s">', 
			'after_widget' => '<span class="seperator extralight-border"></span></div>', 
			'before_title' => '<h1 class="widget-title">', 
			'after_title' => '</h1>', 
			));
			
			$sidebar_items = ot_get_option( 'sidebar_items' ); 
			 if(is_array($sidebar_items) && !empty($sidebar_items)):
             foreach($sidebar_items as $sidebar_item){
			
			register_sidebar(array(
			'name' => $sidebar_item['sidebar_name'],
			'id'   => sanitize_title($sidebar_item['sidebar_name']),
			'before_widget' => '<div id="%1$s" class="widget widget-box %2$s">', 
			'after_widget' => '<span class="seperator extralight-border"></span></div>', 
			'before_title' => '<h1 class="widget-title">', 
			'after_title' => '</h1>', 
			));
			 }
			 endif;
			register_widget('magee_recent_posts');
			register_widget('magee_popular_posts');
			register_widget('magee_contact');
			register_widget('magee_contact_info');
			register_widget('magee_portfolio');
						
}
add_action( 'widgets_init', 'magee_widgets_init' );


/**************************************************************************************/

/**
 * Home page contact form widget
 */
 class magee_contact extends WP_Widget {
 	function magee_contact() {
 		$widget_ops = array( 'classname' => 'widget_contact', 'description' => __( 'Contact form', 'magee' ) );
		$control_ops = array( 'width' => 350, 'height' =>250 ); 
		parent::WP_Widget( false, $name = __( 'Magee: Contact Form', 'magee' ), $widget_ops, $control_ops);
 	}

 	function form( $instance ) {
	$admin_email = get_option( 'admin_email' );
 	$defaults = array('contact_email' => $admin_email,'title'=>'Contact Us'); 		
	$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
         	
		  <p>
               <label for="<?php echo $this->get_field_id( 'title'  ); ?>">&nbsp;&nbsp;<?php _e('Title', 'magee'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'title'  ); ?>" name="<?php echo $this->get_field_name( 'title'  ); ?>" value="<?php echo $instance['title']; ?>" class="" /> 
            </p>
           
            <p>
            <label for="<?php echo $this->get_field_id( 'contact_email'  ); ?>"><?php _e('Email', 'magee'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'contact_email'  ); ?>" name="<?php echo $this->get_field_name( 'contact_email'  ); ?>" value="<?php echo $instance['contact_email']; ?>" class="" />
            
            
            </p>
            <p><?php _e("Your email address which use to receive email.","magee");?></p>

		<?php

	}

 function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
        $instance[ 'contact_email']  =  $new_instance['contact_email'] ;
	    $instance['title']           = strip_tags($new_instance['title'])  ;
	

		return $instance;
	}

	function widget( $args, $instance ) {
 		extract( $args );
 		extract( $instance );
		
		 $title = apply_filters('Contact Us', $title );
		echo $before_widget;
		if($title)
		echo $before_title . $title . $after_title;
		
		echo '<div class="contact">
									
									<form action="'.esc_url(home_url('/')).'" class="contact-form" method="post">
			                        	<fieldset>
											<section>
												<label for="contact-name" class="sr-only">'.__("Name","magee").'</label>
												<input type="text" name="contact-name" id="contact-name" placeholder="'.__("YOUR NAME","magee").'*" tabindex="1" required="" aria-required="true">
											</section>
											<section>
												<label for="contact-email" class="sr-only">'.__("Email","magee").'</label>
												<input type="email" name="contact-email" id="contact-email" placeholder="'.__("YOUR E-MAIL","magee").'*" tabindex="2" required="" aria-required="true">
											</section>
											<section>
												<label for="contact-msg" class="sr-only">'.__("Message","magee").'</label>
												<textarea name="contact-msg" id="contact-msg" cols="39" rows="5" tabindex="3" placeholder="'.__("YOUR MESSAGE","magee").'*"></textarea>
											</section>
										</fieldset>
										<section>
											<span><div id="loading"></div></span><input type="submit" class="btn-normal" value="'.__("SEND","magee").'">
										</section>
									</form>
								</div>';
		echo $after_widget;
 	}
 }
 
 /**************************************************************************************/

/**
 * Home page contact info widget
 */
 class magee_contact_info extends WP_Widget {
 	function magee_contact_info() {
 		$widget_ops = array( 'classname' => 'widget_contact_info', 'description' => __( 'Contact Info', 'magee' ) );
		$control_ops = array( 'width' => 350, 'height' =>250 ); 
		parent::WP_Widget( false, $name = __( 'Magee: Contact Info', 'magee' ), $widget_ops, $control_ops);
 	}

 	function form( $instance ) {
	
 	$defaults = array('address' => '','phone'=>'','email'=>'','title'=>'Contact Info'); 		
	$instance = wp_parse_args( (array) $instance, $defaults ); ?>


            <p>
               <label for="<?php echo $this->get_field_id( 'title'  ); ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php _e('Title', 'magee'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'title'  ); ?>" name="<?php echo $this->get_field_name( 'title'  ); ?>" value="<?php echo $instance['title']; ?>" class="" /> 
            </p>
            
            <p>
            <label for="<?php echo $this->get_field_id( 'address'  ); ?>"><?php _e('Address', 'magee'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'address'  ); ?>" name="<?php echo $this->get_field_name( 'address'  ); ?>" value="<?php echo $instance['address']; ?>" class="" />
            
            
            </p>
             
            <p>
            <label for="<?php echo $this->get_field_id( 'phone'  ); ?>">&nbsp;&nbsp;&nbsp;&nbsp;<?php _e('Phone', 'magee'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'phone'  ); ?>" name="<?php echo $this->get_field_name( 'phone'  ); ?>" value="<?php echo $instance['phone']; ?>" class="" />
            
            
            </p>
             
            <p>
            <label for="<?php echo $this->get_field_id( 'email'  ); ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php _e('Email', 'magee'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'email'  ); ?>" name="<?php echo $this->get_field_name( 'email'  ); ?>" value="<?php echo $instance['email']; ?>" class="" />
            
            
            </p>

		<?php

	}

 function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
       
	    $instance['title']           = strip_tags($new_instance['title'])  ;
		$instance['address']         = strip_tags($new_instance['address'])  ;
		$instance['phone']           = strip_tags($new_instance['phone'])  ;
		$instance['email']           = strip_tags($new_instance['email'])  ;
	
		

		return $instance;
	}

	function widget( $args, $instance ) {
 		extract( $args );
 		extract( $instance );
	
		 $title = apply_filters('Contact Us', $instance['title'] );
		echo $before_widget;
		if($title)
		echo $before_title . $title . $after_title;
		echo '<ul><li><i class="fa fa-home fa-fw"></i>'.$instance['address'].'</li>
									<li><i class="fa fa-phone fa-fw"></i>'.$instance['phone'].'</li>
									<li><i class="fa fa-envelope fa-fw"></i>'.$instance['email'].'</li>
								</ul>';
		echo $after_widget;
 	}
 }

 
 //**************************************************************************************/

/**
 * Recent Posts
 */
 
 class magee_recent_posts extends WP_Widget {
 	function magee_recent_posts() {
 		$widget_ops = array( 'classname' => 'widget_recent_posts', 'description' => '' );
		$control_ops = array( 'width' => 300, 'height' =>250 ); 
		parent::WP_Widget( false, $name = __( 'Magee: Recent Posts', 'magee' ), $widget_ops, $control_ops);
 	}

 	function form( $instance ) {
 	    $defaults = array("list_num"=>"4","title"=>"Recent Posts");
 		$instance = wp_parse_args( (array) $instance, $defaults );
 	
	?>
     <p>
               <label for="<?php echo $this->get_field_id( 'title'  ); ?>"><?php _e('Title', 'magee'); ?>:</label><br />
			<input id="<?php echo $this->get_field_id( 'title'  ); ?>" name="<?php echo $this->get_field_name( 'title'  ); ?>" value="<?php echo $instance['title']; ?>" class="" /> 
            </p>
            
		 <p>
               <label for="<?php echo $this->get_field_id( 'list_num'  ); ?>"><?php _e('Recent Posts List Num', 'magee'); ?>:</label><br />
			<input id="<?php echo $this->get_field_id( 'list_num'  ); ?>" name="<?php echo $this->get_field_name( 'list_num'  ); ?>" value="<?php echo $instance['list_num']; ?>" class="" /> 
            </p>
            
		<?php

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
			$instance['list_num']  = absint($new_instance['list_num'])  ;
			$instance['title']     = strip_tags($new_instance['title'])  ;

		return $instance;
	}

	function widget( $args, $instance ) {
 		extract( $args );
 	    $title = apply_filters('Recent Posts', $instance['title'] );
		echo $before_widget;
		if($title)
		echo $before_title . $title . $after_title;
		?>
        <ul>
        <?php 
	$my_query = new WP_Query( 'showposts='.$instance['list_num'].'&ignore_sticky_posts=1');
	while ($my_query->have_posts() ) : $my_query->the_post();
?>
   <li>
<?php 
   if ( has_post_thumbnail() ) {
         $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'blog-thumb');
		 $source = get_site_url();
		 if($featured_image[0] !=""){
			$thumb = $featured_image[0]; 
			echo '<a href="'.get_permalink().'" class="widget-img"><img src="'.$thumb.'" alt="" /></a>';
			 }
												} 
			?>
										
   <a href="<?php the_permalink();?>"><?php the_title();?></a><br />
										<?php echo get_the_date("M D, Y");?>
									</li>
                                    <?php endwhile;wp_reset_postdata();?>	
                                    </ul>
		<?php 
		echo $after_widget;
 	}
 }
 
 
 //**************************************************************************************/

/**
 * Popular Posts
 */
 
 class magee_popular_posts extends WP_Widget {
 	function magee_popular_posts() {
 		$widget_ops = array( 'classname' => 'widget_popular_posts', 'description' => '' );
		$control_ops = array( 'width' => 300, 'height' =>250 ); 
		parent::WP_Widget( false, $name = __( 'Magee: Popular Posts', 'magee' ), $widget_ops, $control_ops);
 	}

 	function form( $instance ) {
 	    $defaults = array("list_num"=>"4","title"=>"Popular Posts");
 		$instance = wp_parse_args( (array) $instance, $defaults );
 	
	?>
     <p>
               <label for="<?php echo $this->get_field_id( 'title'  ); ?>"><?php _e('Title', 'magee'); ?>:</label><br />
			<input id="<?php echo $this->get_field_id( 'title'  ); ?>" name="<?php echo $this->get_field_name( 'title'  ); ?>" value="<?php echo $instance['title']; ?>" class="" /> 
            </p>
            
		 <p>
               <label for="<?php echo $this->get_field_id( 'list_num'  ); ?>"><?php _e('Popular Posts List Num', 'magee'); ?>:</label><br />
			<input id="<?php echo $this->get_field_id( 'list_num'  ); ?>" name="<?php echo $this->get_field_name( 'list_num'  ); ?>" value="<?php echo $instance['list_num']; ?>" class="" /> 
            </p>
            
		<?php

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
			$instance['list_num']  = absint($new_instance['list_num'])  ;
			$instance['title']     = strip_tags($new_instance['title'])  ;

		return $instance;
	}

	function widget( $args, $instance ) {
 		extract( $args );
 	    $title = apply_filters('Popular Posts', $instance['title'] );
		echo $before_widget;
		if($title)
		echo $before_title . $title . $after_title;
		?>
        <ul>
        <?php 
	$my_query = new WP_Query( 'showposts='.$instance['list_num'].'&ignore_sticky_posts=1&orderby=comment_count');
	while ( $my_query->have_posts() ) : $my_query->the_post();
?>
   <li>
<?php 
   if ( has_post_thumbnail() ) {
         $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'blog-thumb');
		 $source = get_site_url();
		 if($featured_image[0] !=""){
			$thumb = $featured_image[0]; 
			echo '<a href="'.get_permalink().'" class="widget-img"><img src="'.$thumb.'" alt="" /></a>';
			 }
												} 
			?>
										
   <a href="<?php the_permalink();?>"><?php the_title();?></a><br />
										<?php echo get_the_date("M D, Y");?>
									</li>
                                    <?php endwhile;wp_reset_postdata();?>	
                                    </ul>
		<?php 
		echo $after_widget;
 	}
 }
 
 
 /**************************************************************************************/

/**
 * Home page contact form widget
 */
 class magee_portfolio extends WP_Widget {
 	function magee_portfolio() {
 		$widget_ops = array( 'classname' => 'widget_portfolio', 'description' => __( 'Latest portfolio list.', 'magee' ) );
		$control_ops = array( 'width' => 350, 'height' =>250 ); 
		parent::WP_Widget( false, $name = __( 'Magee: Portfolio Grid', 'magee' ), $widget_ops, $control_ops);
 	}

 	function form( $instance ) {

 	$defaults = array('column' => 4,'list_num'=>8,'title'=>'Latest Projects'); 		
	$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
         	
		  <p>
               <label for="<?php echo $this->get_field_id( 'title'  ); ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php _e('Title', 'magee'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'title'  ); ?>" name="<?php echo $this->get_field_name( 'title'  ); ?>" value="<?php echo $instance['title']; ?>" class="" /> 
            </p>
           
           <p>
            <label for="<?php echo $this->get_field_id( 'column'  ); ?>">&nbsp;&nbsp;<?php _e('Column', 'magee'); ?>:</label>
           <select id="<?php echo $this->get_field_id( 'column'  ); ?>" name="<?php echo $this->get_field_name( 'column'  ); ?>">
           <?php
		   for($i=2;$i<=4;$i++){
			   $select = "";
			   if($instance['column'] == $i) $select = ' selected = "selected" ';
			   echo '<option '.$select.' value="'.$i.'">'.$i.' columns</option>';
			   }
		   ?>
          
           </select>
           </p>
           
            <p>
            <label for="<?php echo $this->get_field_id( 'list_num'  ); ?>"><?php _e('List Num', 'magee'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'list_num'  ); ?>" name="<?php echo $this->get_field_name( 'list_num'  ); ?>" value="<?php echo $instance['list_num']; ?>" class="" />
            
            
            </p>
 

		<?php

	}

 function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
   
	    $instance['title']           = strip_tags($new_instance['title'])  ;
	    $instance['column']          = absint($new_instance['column'])  ;
		$instance['list_num']        = absint($new_instance['list_num'])  ;

		return $instance;
	}

	function widget( $args, $instance ) {
 		extract( $args );
 		extract( $instance );
		
		 $title = apply_filters('Latest Projects', $title );
		echo $before_widget;
		if($title)
		echo $before_title . $title . $after_title;
		 $j      = 1;
		 $item   = "";
		 $result = "";
		 if(is_numeric($column) && $column>0 )
		 $col   = 12/$column;
		 else
		 $col   = 3;
		 
		echo '<div class="widget-project">';
		  $query = new WP_Query('post_type=portfolio&orderby=menu_order&post_status=publish&posts_per_page='.$list_num);
		  
	if($query->have_posts() ):
	while ($query->have_posts() ) :
    $query->the_post();

if (has_post_thumbnail( get_the_ID()) ): 
	//$thumb = get_the_post_thumbnail(  get_the_ID() , "portfolio-widget" ); 
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID()), 'portfolio-widget' );

    $item  .=  '<div class="col-xs-'.$col.'"><a href="'.get_permalink().'"><img src="'.$image[0].'" alt="'.get_the_title().'" title="'.get_the_title().'" /></a></div>';
	
		if($j%$column == 0){
			$result .= '<div class="row">'.$item.'</div>';
			$item    = '';
			}						
	$j++;			
			endif;					
	endwhile;
	endif;
	wp_reset_postdata();
	if($item   != '') $result .= '<div class="row">'.$item.'</div>';
	echo $result;
	echo '</div>';
	echo $after_widget;
	
		
 	}
 }