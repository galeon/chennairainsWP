<?php

    /*	
	*	get portfolio item info
	*	---------------------------------------------------------------------
	*/

	function magee_get_portfolio_content()
	{
	   $postid = $_POST['postid'];
	   $post   = get_post($postid,ARRAY_A);
	   
	   $portfolio_gallery = get_post_meta( $postid ,'portfolio_gallery');
						     if($portfolio_gallery && is_array($portfolio_gallery)){
	
							 $gallery = '<div id="portfolio-gallery" class="portfolio-gallery portfolio-gallery-preview owl-theme">';
							 foreach($portfolio_gallery as $attachment){
							 $attachment_id_arr = explode(",",$attachment);
							 if($attachment_id_arr && is_array($attachment_id_arr)){
							 foreach($attachment_id_arr as $attachment_id){
							  $image_attributes = wp_get_attachment_image_src( $attachment_id, "portfolio-gallery" );
							   $gallery .=  '<div class="item"><img src="'.$image_attributes[0].'" width="'.$image_attributes[1].'" height="'.$image_attributes[2].'" alt=""/></div>';
							   }
							   }
							  }
							  $gallery .= '</div>';
		 $post['gallery'] =  $gallery;
          }
							 
	   
	   
	   echo json_encode($post);
	   exit(0);
	}
   add_action('wp_ajax_magee_get_portfolio_content', 'magee_get_portfolio_content');
   add_action('wp_ajax_nopriv_magee_get_portfolio_content', 'magee_get_portfolio_content');
   
   /*	
	*	send email
	*	---------------------------------------------------------------------
	*/
  function magee_contact(){
	if(trim($_POST['name']) === '') {
		$Error = __('Please enter your name.','magee');
		$hasError = true;
	} else {
		$name = trim($_POST['name']);
	}

	if(trim($_POST['email']) === '')  {
		$Error = __('Please enter your email address.','magee');
		$hasError = true;
	} else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
		$Error = __('You entered an invalid email address.','magee');
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}

	if(trim($_POST['message']) === '') {
		$Error =  __('Please enter a message.','magee');
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$message = stripslashes(trim($_POST['message']));
		} else {
			$message = trim($_POST['message']);
		}
	}

	if(!isset($hasError)) {

	    $options = get_option("widget_magee_contact");
		$sendto  = $options[2]['contact_email'];
	   if (isset($sendto) && preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($sendto))) {
	     $emailTo = $sendto;
	   }
	   else{
	 	 $emailTo = get_option('admin_email');
		}
		 if($emailTo !=""){
		$subject = 'From '.$name;
		$body = "Name: $name \n\nEmail: $email \n\nMessage: $message";
		$headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		wp_mail($emailTo, $subject, $body, $headers);
		$emailSent = true;
		}
		echo json_encode(array("msg"=>__("Your message has been successfully sent!",'magee'),"error"=>0));
		
	}
	else
	{
	echo json_encode(array("msg"=>$Error,"error"=>1));
	}
	die() ;
	}
	add_action('wp_ajax_magee_contact', 'magee_contact');
	add_action('wp_ajax_nopriv_magee_contact', 'magee_contact');
	

   /*	
	*	get blog list
	*	---------------------------------------------------------------------
	*/
	 function magee_get_timeline_blog_list($cat="",$num="6",$paged="1",$ajax=true,$length=0,$style=1){
        
		if(isset($_POST["cat"])){$cat=$_POST["cat"];}
		if(isset($_POST["num"])){$num=$_POST["num"];}
		if(isset($_POST["paged"])){$paged=$_POST["paged"];}
		
		$left_list  = "";
		$right_list = "";
		$order = "";
		if($style==2){
		$order = "&orderby=data&order=asc";
		}
		
		wp_reset_query();
      	$wp_query = new WP_Query();
		$wp_query -> query('posts_per_page='.$num.'&cat='.$cat.'&paged='.$paged.'&post_status=publish&post_type=post'.$order); 
		$i = 0 ;
		if ($wp_query -> have_posts()) :
		while ( $wp_query -> have_posts() ) : $wp_query -> the_post();
		
		if($length >0){
		$the_excerpt = magee_get_the_content_limit(get_the_excerpt(),$length);
		}
		else{
		$the_excerpt = get_the_excerpt();
		}
		if($i%2==0){
		$left_list .= '<div class="project-box">
                        		<div class="project">
                            		<h3><a href="'.get_permalink().'">'.get_the_date("Y. m").'-'.get_the_title().'</a></h3>
                                	'.$the_excerpt.'
                            	</div>
                                <div class="timeline-dot"></div>
                            </div>';
			}else{
		$right_list .= '<div class="project-box">
                        		<div class="project">
                            		<h3><a href="'.get_permalink().'">'.get_the_date("Y. m").'-'.get_the_title().'</a></h3>
                                	'.$the_excerpt.'
                            	</div>
                                <div class="timeline-dot"></div>
                            </div>';
			}
		$i++;
		endwhile;
		endif;
		wp_reset_postdata();
		$return = array();
		$return["paged"]      = $paged; 
		$return["left_list"]  = $left_list;
		$return["right_list"] = $right_list;
		if($ajax == false){
		return $return;
		}
		else{
		echo json_encode($return);
		die();
		}
	  
   }
   	add_action('wp_ajax_magee_get_timeline_blog_list', 'magee_get_timeline_blog_list');
	add_action('wp_ajax_nopriv_magee_get_timeline_blog_list', 'magee_get_timeline_blog_list');
	
	/*	
	*	substr
	*	---------------------------------------------------------------------
	*/
	
	function magee_get_the_content_limit($content,$max_char, $stripteaser = 0, $more_file = '') {
	   
		$content = strip_tags($content);
	
	 if ((strlen($content)>$max_char) && ($espacio = strpos($content, " ", $max_char ))) {
			$content = substr($content, 0, $espacio);
		   $str  =  $content;
		   $str .=  " [...]";
		
		  return $str;
	   }
	   else {
	 
		  return $content;
	   
	   }
	}	
	/*	
	*	get portfolio list
	*	---------------------------------------------------------------------
	*/
	 function magee_get_timeline_portfolio_list($cat="",$num="6",$paged="1",$ajax=true,$length=0,$style=1){
        
		if(isset($_POST["cat"])){$cat=$_POST["cat"];}
		if(isset($_POST["num"])){$num=$_POST["num"];}
		if(isset($_POST["paged"])){$paged=$_POST["paged"];}
		
		$left_list  = "";
		$right_list = "";
		$term_id    = "";
		$order = "";
		if($style==2){
		$order = "&orderby=data&order=asc";
		}
		$taxonomy   = "portfolio-category";
		wp_reset_query();
		
		if(!is_numeric($cat)){
		$term      = get_term_by('name', $cat, 'portfolio-category');
		}else{
		$term      = get_term_by('id', $cat, 'portfolio-category');
		}
        $term_slug = isset($term->slug)?$term->slug:"";
	  
      	$wp_query = new WP_Query();
		$wp_query -> query('posts_per_page='.$num.'&portfolio-category='.$term_slug.'&paged='.$paged.'&post_status=publish&post_type=portfolio'.$order); 
		$i = 0 ;
		if ($wp_query -> have_posts()) :
		while ( $wp_query -> have_posts() ) : $wp_query -> the_post();
		
		if($length >0){
		$the_excerpt = magee_get_the_content_limit(get_the_excerpt(),$length);
		}
		else{
		$the_excerpt = get_the_excerpt();
		}
		
		if($i%2==0){
		$left_list .= '<div class="project-box">
                        		<div class="project">
                            		<h3><a href="'.get_permalink().'">'.get_the_date("Y. m").'-'.get_the_title().'</a></h3>
                                	'.$the_excerpt.'
                            	</div>
                                <div class="timeline-dot"></div>
                            </div>';
			}else{
		$right_list .= '<div class="project-box">
                        		<div class="project">
                            		<h3><a href="'.get_permalink().'">'.get_the_date("Y. m").'-'.get_the_title().'</a></h3>
                                	'.$the_excerpt.'
                            	</div>
                                <div class="timeline-dot"></div>
                            </div>';
			}
		$i++;
		endwhile;
		endif;
		wp_reset_postdata();
		$return = array();
		$return["paged"]      = $paged; 
		$return["left_list"]  = $left_list;
		$return["right_list"] = $right_list;
		if($ajax == false){
		return $return;
		}
		else{
		echo json_encode($return);
		die();
		}
	  
   }
   	add_action('wp_ajax_magee_get_timeline_portfolio_list', 'magee_get_timeline_portfolio_list');
	add_action('wp_ajax_nopriv_magee_get_timeline_portfolio_list', 'magee_get_timeline_portfolio_list');
	
	
/**
 * Helper function to format the options return value.
 *
 * @param     string    $option ID of the option to retrieve
 * @param     boolean   $css Whether the option type is CSS, deafult false.
 * @return    string
 *
 */
function magee_get_option( $option, $css = false ) {
  
  $default = '';
  $return = function_exists( 'ot_get_option' ) ? ot_get_option( $option, $default ) : $default;
  
  if ( $return !== $default ) {
    
    if ( true == $css ) {
      $parse = magee_parse_css( $option, $return );
      $return = str_replace( 'no value', '<span class="note note-danger">' . __( 'no value', 'option-tree-theme' ) . '</span>', $parse );
    }
    
    echo '<pre>';
      print_r( $return );
    echo '</pre>';
    
  } else {
  
    echo '<span class="note note-danger">' . $return . '</span>';
    
  }
  
}

/**
 * Helper function to parse and return properly formated CSS.
 *
 * @param     string    $field_id ID of the option to retrieve.
 * @param     string    $insertion The string to parse into CSS.
 * @param     boolean   $meta Whether the ID is of a meta option or regular theme option.
 * @return    string
 *
 */
function magee_parse_css( $field_id = '', $insertion = '', $meta = false ) {
  
  /* missing $field_id or $insertion exit early */
  if ( '' == $field_id || '' == $insertion )
    return;
  
  $insertion   = magee_normalize_css( $insertion );
  $regex       = "/{{([a-zA-Z0-9\_\-\#\|\=]+)}}/";
  
  /* Match custom CSS */
  preg_match_all( $regex, $insertion, $matches );
  
  /* Loop through CSS */
  foreach( $matches[0] as $option ) {

    $value        = '';
    $option_id    = str_replace( array( '{{', '}}' ), '', $option );
    $option_array = explode( '|', $option_id );

    /* get the array value */
    if ( $meta ) {
      global $post;
      
      $value = get_post_meta( $post->ID, $option_array[0], true );
      
    } else {
    
      $options = get_option( 'magee_option_tree' );
      
      if ( isset( $options[$option_array[0]] ) ) {
        
        $value = $options[$option_array[0]];

      }
      
    }
    
    if ( is_array( $value ) ) {
      
      if ( ! isset( $option_array[1] ) ) {
      
        /* Measurement */
        if ( isset( $value[0] ) && isset( $value[1] ) ) {
          
          /* set $value with measurement properties */
          $value = $value[0].$value[1];
          
        /* typography */
        } else if ( magee_array_keys_exists( $value, array( 'font-color', 'font-family', 'font-size', 'font-style', 'font-variant', 'font-weight', 'letter-spacing', 'line-height', 'text-decoration', 'text-transform' ) ) ) {
          $font = array();
          
          if ( ! empty( $value['font-color'] ) )
            $font[] = "color: " . $value['font-color'] . ";";
          
          if ( ! empty( $value['font-family'] ) ) {
            foreach ( magee_recognized_font_families( $field_id ) as $key => $v ) {
              if ( $key == $value['font-family'] ) {
                $font[] = "font-family: " . $v . ";";
              }
            }
          }
          
          if ( ! empty( $value['font-size'] ) )
            $font[] = "font-size: " . $value['font-size'] . ";";
          
          if ( ! empty( $value['font-style'] ) )
            $font[] = "font-style: " . $value['font-style'] . ";";
          
          if ( ! empty( $value['font-variant'] ) )
            $font[] = "font-variant: " . $value['font-variant'] . ";";
          
          if ( ! empty( $value['font-weight'] ) )
            $font[] = "font-weight: " . $value['font-weight'] . ";";
            
          if ( ! empty( $value['letter-spacing'] ) )
            $font[] = "letter-spacing: " . $value['letter-spacing'] . ";";
          
          if ( ! empty( $value['line-height'] ) )
            $font[] = "line-height: " . $value['line-height'] . ";";
          
          if ( ! empty( $value['text-decoration'] ) )
            $font[] = "text-decoration: " . $value['text-decoration'] . ";";
          
          if ( ! empty( $value['text-transform'] ) )
            $font[] = "text-transform: " . $value['text-transform'] . ";";
          
          /* set $value with font properties or empty string */
          $value = ! empty( $font ) ? implode( "\n", $font ) : '';
          
        /* background */
        } else if ( magee_array_keys_exists( $value, array( 'background-color', 'background-image', 'background-repeat', 'background-attachment', 'background-position', 'background-size' ) ) ) {
          $bg = array();
          
          if ( ! empty( $value['background-color'] ) )
            $bg[] = $value['background-color'];
            
          if ( ! empty( $value['background-image'] ) )
            $bg[] = 'url("' . $value['background-image'] . '")';
            
          if ( ! empty( $value['background-repeat'] ) )
            $bg[] = $value['background-repeat'];
            
          if ( ! empty( $value['background-attachment'] ) )
            $bg[] = $value['background-attachment'];
            
          if ( ! empty( $value['background-position'] ) )
            $bg[] = $value['background-position'];
          
          if ( ! empty( $value['background-size'] ) )
            $size = $value['background-size'];
          
          /* set $value with background properties or empty string */
          $value = ! empty( $bg ) ? 'background: ' . implode( " ", $bg ) . ';' : '';
           
          if ( isset( $size ) ) {
            if ( ! empty( $bg ) ) {
              $value.= apply_filters( 'ot_magee_insert_css_with_markers_bg_size_white_space', "\n\x20\x20", $option_id );
            }
            $value.= "background-size: $size;";
          }
            
        }
      
      } else {
      
        $value = $value[$option_array[1]];
        
      }
     
    }
    
    // Filter the CSS
    $value = apply_filters( 'ot_magee_insert_css_with_markers_value', $value, $option_id );
         
    /* insert CSS, even if the value is empty */
     $insertion = stripslashes( str_replace( $option, $value, $insertion ) );
     
  }
  
  return $insertion;
      
}

/**
 * Helper function to change the value if empty.
 *
 * @param     string    $value The options return value.
 * @param     string    $option ID of the option.
 * @return    string

 */
function magee_filter_css( $value, $option ) {
  
  if ( empty( $value ) )
    $value = 'no value'; 
  
  return $value;
  
}
add_filter( 'ot_magee_insert_css_with_markers_value', 'magee_filter_css', 10, 2 );

/**
 * Helper function to normalize the CSS.
 *
 * @param     string    $css The return value to normalize.
 * @return    string

 */
function magee_normalize_css( $css ) {
  
  /* Normalize & Convert */
  $css = str_replace( "\r\n", "\n", $css );
  $css = str_replace( "\r", "\n", $css );
  
  /* Don't allow out-of-control blank lines */
  $css = preg_replace( "/\n{2,}/", "\n\n", $css );
  
  return $css;
  
}

/**
 * Helper function to test if an array key exists.
 *
 * @param     array     $array The array to test against.
 * @param     array     $keys An array of keys to look for.
 * @return    bool
 *
 * @since     2.3.0
 */
function magee_array_keys_exists( $array, $keys ) {
  
  foreach( $keys as $k )
    if ( isset( $array[$k] ) )
      return true;
  
  return false;
  
}

/**
 * Recognized font families
 *
 * @return    array
 *
 * @access    public
 */
function magee_recognized_font_families( $field_id = '' ) {

  return apply_filters( 'ot_magee_recognized_font_families', array(
    'arial'     => 'Arial',
    'georgia'   => 'Georgia',
    'helvetica' => 'Helvetica',
    'palatino'  => 'Palatino',
    'tahoma'    => 'Tahoma',
    'times'     => '"Times New Roman", sans-serif',
    'trebuchet' => 'Trebuchet',
    'verdana'   => 'Verdana'
  ), $field_id );
  
}

 	/*	
	*	get background 
	*	---------------------------------------------------------------------
	*/
function magee_get_background($args){
$result = "";
if(isset($args) && !is_array($args)){
	$args = unserialize($args);
	}
if(isset($args) && is_array($args))
{
if(isset($args['background-color'])&& $args['background-color']!="")
$result .= 'background-color: '. $args['background-color'] .';' ;
if(isset($args['background-repeat']))
$result .= 'background-repeat:'.$args['background-repeat'] .';';
if(isset($args['background-attachment']))
$result .= 'background-attachment:'. $args['background-attachment'].';';
if(isset($args['background-position']))
$result .= 'background-position:'.$args['background-position'].';';
if(isset($args['background-image']))
$result .= 'background-image:url('.$args['background-image'] .'); ';
}
return $result;
}


/*	
	*	Form generator
	*	---------------------------------------------------------------------
	*/
	

function magee_form_generator($value){
	
		if(!isset($value['id'])){exit;}
		$value['std'] = isset($value['std'])?$value['std']:"";
			$value['std'] = str_replace("\r\n",' ', $value['std']);
	?>
		<div class="magee-shortcode-attr-container">
			<label for="magee-<?php echo $value['id']; ?>"><h5><?php  echo $value['title']; ?></h5></label>
		<?php
		switch ( $value['type'] ) {
		
			case 'text': ?>
				<input  name="<?php echo $value['id']; ?>" id="magee-<?php  echo $value['id']; ?>" type="text" value="<?php echo $value['std']; ?>" />
			<?php 
			break;
	
			case 'checkbox':
				if($value['id']){$checked = "checked=\"checked\"";  $checkbox_switch = "on";} else{$checked = "";$checkbox_switch = "off";} ?>
				
					<input class="on-of" type="checkbox" name="magee-<?php echo $value['id'] ?>" id="<?php echo $value['id'] ?>" value="true" <?php echo $checked; ?> />
			<?php	
			break;
			case 'radio':
			?>
				<div style="float:left; width: 295px;">
					<?php foreach ($value['options'] as $key => $option) { ?>
					<label style="display:block; margin-bottom:8px;"><input name="<?php echo $value['id']; ?>" id="magee-<?php echo $value['id']; ?>" type="radio" value="<?php echo $key ?>" <?php if ( $value['id'] == $key) { echo ' checked="checked"' ; } ?>> <?php echo $option; ?></label>
					<?php } ?>
				</div>
			<?php
			break;
			
			case 'select':
			?>
				<select name="<?php echo $value['id']; ?>" id="magee-<?php echo $value['id']; ?>">
					<?php foreach ($value['options'] as $key => $option) { ?>
					<option value="<?php echo $key ?>" <?php if (  $value['std'] == $key) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
					<?php } ?>
				</select>
			<?php
			break;
			
			case 'textarea':
			?>
				<textarea name="<?php echo $value['id']; ?>" id="magee-<?php echo $value['id']; ?>" type="textarea" cols="100%" rows="8" tabindex="4"><?php echo $value['std'];  ?></textarea>
			<?php
			break;
	
			case 'upload':
			?>
		
			<input id="<?php echo $value['id']; ?>" class="img-path upload_box" type="text" size="56" style="direction:ltr; text-laign:left" name="<?php echo $value['id']; ?>" value="<?php echo $value['std']; ?>" />
					<input id="upload_<?php echo $value['id']; ?>_button" type="button" class="upload_image_button" value="Upload" />
					<?php
					if(isset($value['std']) && $value['std'] != ""){
					$img_preview = '<div id="'.$value['id'].'-preview" class="img-preview"><img src="'.$value['std'].'" alt="" /><a class="del-img" title="Delete"></a></div>';}
					?>
		
			<?php
			break;
			case 'color':
			?>
			<input type="text" value="<?php echo $value['std'] ; ?>" class="minicolors" data-theme="bootstrap" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" />					
			<?php
			break;
			}
			?>
			<?php if( isset( $value['desc'] ) ) : ?><div class="magee-shortcode-attr-desc"><?php echo $value['desc'] ?></div><?php endif; ?>
		
			<div class="clear"></div>
		</div>
<?php
	}
	
/*	
	*	Shortcode  generator Form
	*	---------------------------------------------------------------------
	*/
	
 function magee_shortcode_form(){
   global $magee_shortcodes ;
   $shortcode = $_POST['shortcode'];
  if(isset($magee_shortcodes[$shortcode]) && is_array($magee_shortcodes[$shortcode])){
	foreach($magee_shortcodes[$shortcode] as $key=>$value){
		if(is_array($value)){
		  array_push($value,array("id"=>$key));
		  magee_form_generator($value);
		  }
	 }

 echo '<input type="hidden" id="magee-curr-shortcode" value="'.$shortcode.'" />';
 echo '<div class="clear"></div>';

	}

	exit();
	}
	add_action('wp_ajax_magee_shortcode_form', 'magee_shortcode_form');
	add_action('wp_ajax_nopriv_magee_shortcode_form', 'magee_shortcode_form');

	/*	
	*	Shortcode Generator
	*	---------------------------------------------------------------------
	*/
	
 function magee_get_shortcode(){
	global $magee_shortcodes ;
	$attr      = isset($_POST['attr'])?$_POST['attr']:"";
	$shortcode = isset($_POST['shortcode'])?$_POST['shortcode']:"";
	$content   = "";
	$result    = "";
	$shortcodes_attr = array();

	if(is_array($attr) && $attr != null && array_key_exists( $shortcode,$magee_shortcodes))
	{
	foreach($magee_shortcodes[$shortcode] as $key=>$value){
	$shortcodes_attr[] = $value['id'];
	}
	$result = '['.$shortcode.' ';
	  foreach($attr as $k=>$v){
	  if($v["name"] != "content" && $v["name"] != "text_content"){
	      if($v["value"] !="" && in_array($v["name"],$shortcodes_attr)){
	       $result .= $v["name"].'=\''.$v["value"].'\' ';
		   }
	    }
		else{
		   $content = $v["value"] . '[/'.$shortcode.']';
		}
	  }
	  $result .= ']';
	  $result .= $content ;
	}
	$result = stripslashes($result);
//	$result = str_replace("\r\n",' ', $result);
	echo $result; 
	exit();
	}
	
	add_action('wp_ajax_magee_get_shortcode', 'magee_get_shortcode');
	add_action('wp_ajax_nopriv_magee_get_shortcode', 'magee_get_shortcode');
	
	/*	
	*	Shortcode Preview
	*	---------------------------------------------------------------------
	*/
	
 function magee_shortcode_preview(){
	   $shortcode = isset($_POST['shortcode'])?$_POST['shortcode']:"";
	   $shortcode = stripslashes($shortcode);
	   $result    = do_shortcode($shortcode);
	   echo $result; 
	   exit();
	}
	add_action('wp_ajax_magee_shortcode_preview', 'magee_shortcode_preview');
	add_action('wp_ajax_nopriv_magee_shortcode_preview', 'magee_shortcode_preview');
	
	
/*	add_filter('image_send_to_editor', 'magee_image_send_to_editor', 10, 2); 
	function magee_image_send_to_editor($html, $id) 
	{ 
		$description = str_replace("\r\n",' ', $description); 
	}*/
	
	/*	
	*	action before simple textarea
	*	---------------------------------------------------------------------
	*/
	
 function magee_before_textarea_simple(){
	
	 $img = get_template_directory_uri() .'/images/shortcode_button.png';
	echo '<a title="'.__("Magee Shortcodes","magee").'" class="magee_shortcodes_textarea"><img src="'.$img.'"></a>';

	}
	add_action("before_textarea_simple","magee_before_textarea_simple");
	
		/*
*  page navigation
*
*/
 function magee_native_pagenavi($echo,$wp_query){
    if(!$wp_query){global $wp_query;}
    global $wp_rewrite;      
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
    $pagination = array(
    'base' => @add_query_arg('paged','%#%'),
    'format' => '',
    'total' => $wp_query->max_num_pages,
    'current' => $current,
    'prev_text' => ' <i class="fa fa-backward"></i> ',
    'next_text' => ' <i class="fa fa-forward"></i> ',
	'type'      => 'a'
    );
 
    if( $wp_rewrite->using_permalinks() )
        $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg('s',get_pagenum_link(1) ) ) . 'page/%#%/', 'paged');
 
    if( !empty($wp_query->query_vars['s']) )
        $pagination['add_args'] = array('s'=>get_query_var('s'));
    if($echo == "echo"){
	echo str_replace( "<ul class='page-numbers'>", '<ul class="pagination page-numbers">', paginate_links($pagination) );
	}else
	{
	
	return str_replace("<ul class='page-numbers'>", '<ul class="pagination page-numbers">', paginate_links($pagination) );
	}
}

	// get breadcrumbs
 function magee_get_breadcrumb(){
   global $post;
   $show_breadcrumb = "";
   
	 new magee_breadcrumb;
	}
	
	function magee_load_breadcrumb(){
		$breadcrumb_style = ot_get_option('breadcrumb_style'); 
		if($breadcrumb_style >= 0 && is_numeric($breadcrumb_style)){
		 get_template_part("breadcrumb",$breadcrumb_style);
		}
	}
	// get sidebar
	
 function magee_get_sidebar($sidebar,$default = true){
 echo '<aside class="widget-area">';
 if($default){
 if ( is_active_sidebar($sidebar) ){
 dynamic_sidebar($sidebar);

 }
 else{
 dynamic_sidebar('default_sidebar');

 }
 }else{
 if ( is_active_sidebar($sidebar) ){
 dynamic_sidebar($sidebar);

 }
 }
 echo '</aside>';
 }
		// fix shortcode

 function magee_fix_shortcodes($content){   
			$replace_tags_from_to = array (
				'<p>[' => '[', 
				']</p>' => ']', 
				']<br />' => ']',
				']<br>' => ']',
				']\r\n' => ']',
				']\n' => ']',
				']\r' => ']',
				'\r\n[' => '[',
			);

			return strtr( $content, $replace_tags_from_to );
		}

 function magee_the_content_filter($content) {
	  $content = magee_fix_shortcodes($content);
	  return $content;
	}
	
	add_filter( 'the_content', 'magee_the_content_filter' );
	
	 //// Custom comments list
   
   function magee_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   
   <li  <?php comment_class("comment"); ?> id="comment-<?php comment_ID() ;?>">
                                	<article class="comment-body">
                                    	<div class="comment-avatar"><?php echo get_avatar($comment,'52','' ); ?></div>
                                        <div class="comment-box">
                                            <div class="comment-info"><?php printf(__('%s <span class="says">says:</span>','onetone'), get_comment_author_link()) ;?> <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ;?>">
<?php printf(__('%1$s at %2$s','onetone'), get_comment_date(), get_comment_time()) ;?></a>  <?php edit_comment_link(__('(Edit)','onetone'),'  ','') ;?></div>

 <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Your comment is awaiting moderation.','onetone') ;?></em>
         <br />
      <?php endif; ?>
     <div class="comment-content"><?php comment_text() ;?>
      <div class="reply-quote">
             <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ;?>
			</div>
       </div>
    </div></article>

<?php
        }
			
 function magee_wp_title( $title, $sep ) {
	global $paged, $page;
	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( ' Page %s ', 'magee' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'magee_wp_title', 10, 2 );

 function magee_title( $title ) {
	if ( $title == '' ) {
	return 'Untitled';
	} else {
	return $title;
	}
	}
	add_filter( 'the_title', 'magee_title' );


// filter search nav menu items & add one page menu

 function magee_nav_menu_items( $nav, $args ) {
    if( $args->theme_location == 'home_menu' )
	{
	    $query = new WP_Query('post_type=section&post_status=publish&orderby=menu_order');
   $onepage_menu = "";
  if($query->have_posts() ):
	while ($query->have_posts() ) :
    $query->the_post();
	$sanitize_title = sanitize_title(get_the_title());
	$onepage_menu .= '<li class="magee-menuitem" id="magee-'.$sanitize_title.'"><a href="#'.$sanitize_title.'"><span>'.get_the_title().'</span></a></li>';
	endwhile;
	endif;
	 wp_reset_postdata() ;
        return $onepage_menu.$nav;
		}
else{
    return $nav;
	}
}
//add_filter('wp_nav_menu_items','magee_nav_menu_items', 10, 2);



// filter search form
 function magee_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" class="searchform widget-search" action="' . home_url( '/' ) . '" >
	
    <div><label class="screen-reader-text" for="s" style=" display:none">' . __( 'Search for:' ,'magee') . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" />
    <input type="submit" id="searchsubmit" value="'. esc_attr__( 'Search' ,'magee') .'" />
    </div>
    </form>';

    return $form;
}

add_filter( 'get_search_form', 'magee_search_form' );

// get  typography


 function magee_get_typography($value){
 $return = "";
if ( is_array($value) && magee_array_keys_exists( $value, array( 'font-color', 'font-family', 'font-size', 'font-style', 'font-variant', 'font-weight', 'letter-spacing', 'line-height', 'text-decoration', 'text-transform' ) ) ) {
          $font = array();
          
          if ( ! empty( $value['font-color'] ) )
            $font[] = "color: " . $value['font-color'] . ";";
          
          if ( ! empty( $value['font-family'] ) ) {
                $font[] = "font-family: " . $value['font-family'] . ";";
          }
          
          if ( ! empty( $value['font-size'] ) )
            $font[] = "font-size: " . $value['font-size'] . ";";
          
          if ( ! empty( $value['font-style'] ) )
            $font[] = "font-style: " . $value['font-style'] . ";";
          
          if ( ! empty( $value['font-variant'] ) )
            $font[] = "font-variant: " . $value['font-variant'] . ";";
          
          if ( ! empty( $value['font-weight'] ) )
            $font[] = "font-weight: " . $value['font-weight'] . ";";
            
          if ( ! empty( $value['letter-spacing'] ) )
            $font[] = "letter-spacing: " . $value['letter-spacing'] . ";";
          
          if ( ! empty( $value['line-height'] ) )
            $font[] = "line-height: " . $value['line-height'] . ";";
          
          if ( ! empty( $value['text-decoration'] ) )
            $font[] = "text-decoration: " . $value['text-decoration'] . ";";
          
          if ( ! empty( $value['text-transform'] ) )
            $font[] = "text-transform: " . $value['text-transform'] . ";";
          
          /* set $value with font properties or empty string */
          $return = ! empty( $font ) ? implode( " ", $font ) : '';

        } 
		return $return;
		}

add_action( 'wp_head', 'magee_favicon' );

 function magee_favicon()
	{
	    $url =  ot_get_option('favicon');
		$icon_link = "";
		if($url)
		{
			$type = "image/x-icon";
			if(strpos($url,'.png' )) $type = "image/png";
			if(strpos($url,'.gif' )) $type = "image/gif";
		
			$icon_link = '<link rel="icon" href="'.esc_url($url).'" type="'.$type.'">';
		}
		
		echo $icon_link;
	}

//  get related posts
 function magee_get_related_posts($postid,$num = 5){
	  
    $tags = wp_get_post_tags($postid);  
    if ($tags) {  
    $tag_ids = array();  
    foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;  
    $args=array(  
    'tag__in' => $tag_ids,  
    'post__not_in' => array($postid),  
    'posts_per_page'=> $num,
    'ignore_sticky_posts'=>1  
    );  
      
    $my_query = new wp_query( $args );  
    $result = "";
	$return = "";
    $i      = 1;
	if($my_query->have_posts()){
    while( $my_query->have_posts() ) {  
    $my_query->the_post();  
    $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'blog-thumb');
		 $thumb = "";
		 if($featured_image[0] !=""){
			$thumb = '<img src="'.$featured_image[0].'"  width="'.$featured_image[1].'" height="'.$featured_image[2].'" alt="" />'; 
			 }
			 
     $result .= '<div class="col-sm-2"><a href="'.get_permalink().'">'.$thumb.'</a><a href="'.get_permalink().'"><h3>'.get_the_title().'</h3></a></div>';
	 if($i % 5 == 0){
	      $return .= '<div class="row">'.$result.'</div>';
		  $result  = "";
		 }
		 $i++;
  }
        wp_reset_postdata();
		 if($result != "")
        return $return.'<div class="row">'.$result.'</div>' ;
		else
		return $return;
	}else{
		return __('No related article found',"magee");
		}
    }  
	else{
		return __('No related article found',"magee");
		} 
}

// get related portfolios
 function magee_get_related_portfolios($postid,$num = 5){
	
	
	if ( 'portfolio' == get_post_type() ) {
	$taxs = wp_get_post_terms( $postid, 'portfolio-tag' );

	if ( $taxs ) {
		$tax_ids = array();
		foreach( $taxs as $individual_tax ) $tax_ids[] = $individual_tax->term_id;
	$args = array(
	'tax_query' => array(
		array(
			'taxonomy'  => 'portfolio-tag',
			'terms' 	=> $tax_ids,
			'operator'  => 'IN'
		)
	),
	'post__not_in' 			=> array( $postid ),
	'posts_per_page' 		=> $num,
	'ignore_sticky_posts' 	=> 1
     );
		
		$my_query = new wp_query( $args );
		$result = "";
	    $return = "";
        $i      = 1;
		if( $my_query->have_posts() ) {
			while ( $my_query->have_posts() ) :
				  
         $my_query->the_post();  
         $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'portfolio-list-thumb');
		 $thumb = "";
		 if($featured_image[0] !=""){
			$thumb = '<img  width="'.$featured_image[1].'" height="'.$featured_image[2].'" src="'.$featured_image[0].'" alt="" />'; 
			$result .= '<div class="col-sm-2"><a href="'.get_permalink().'">'.$thumb.'</a></div>';
	 if($i % 5 == 0){
	      $return .= '<div class="row">'.$result.'</div>';
		  $result  = "";
		 }
		 $i++;
			 }
			endwhile; 
            wp_reset_postdata();
			 return $return.'<div class="row">'.$result.'</div>' ;
		}
		else{
			 
			return __('No related project found',"magee");
			wp_reset_postdata();
			}
		}
	else{
		return __('No related project found',"magee");
		}
}

}
// filter radio image
 function magee_filter_radio_images( $array, $field_id ) {

 if ( in_array($field_id ,array('page_layout' ,'default_page_layout','default_page_layout','default_post_layout' , 'default_layout','default_portfolio_layout')) ) {
    $array = array(
      array(
        'value'   => 'left-sidebar',
        'label'   => __( 'Left Sidebar', 'magee' ),
        'src'     => get_template_directory_uri() . '/images/sidebar_left.png'
      ),
      array(
        'value'   => 'right-sidebar',
        'label'   => __( 'Right Sidebar', 'magee' ),
        'src'     => get_template_directory_uri() . '/images/sidebar_right.png'
      ),
	  array(
        'value'   => 'full-width',
        'label'   => __( 'Full Width', 'magee' ),
        'src'     => get_template_directory_uri() . '/images/sidebar_without.png'
      )
    );
  }
  if($field_id == "header_template"){
	  
	   $array = array(
      array(
        'value'   => '1',
        'label'   => __( 'Header Style 1', 'magee' ),
        'src'     => get_template_directory_uri() . '/images/header_template_1.jpg'
      ),
      array(
        'value'   => '2',
        'label'   => __( 'Header Style 2', 'magee' ),
        'src'     => get_template_directory_uri() . '/images/header_template_2.jpg'
      ),
	  array(
        'value'   => '3',
        'label'   => __( 'Header Style 3', 'magee' ),
        'src'     => get_template_directory_uri() . '/images/header_template_3.jpg'
      ),
	  array(
        'value'   => '4',
        'label'   => __( 'Header Style 4', 'magee' ),
        'src'     => get_template_directory_uri() . '/images/header_template_4.jpg'
      )
    );
	  }
  
    if($field_id == "portfolio_sidebar"){
	  
	   $array = array(
      array(
        'value'   => 'left-sidebar',
        'label'   => __( 'left sidebar', 'magee' ),
        'src'     => get_template_directory_uri() . '/images/sidebar_left.png'
      ),
      array(
        'value'   => 'right-sidebar',
        'label'   => __( 'right sidebar', 'magee' ),
        'src'     => get_template_directory_uri() . '/images/sidebar_right.png'
      )
    );
	  }

  return $array;

}
add_filter( 'ot_radio_images', 'magee_filter_radio_images', 10, 2 );

// cover excerpt length
 function magee_get_excerpt($count,$postid){
  $permalink = get_permalink($postid);
  $excerpt = get_the_content();
  $excerpt = strip_tags($excerpt);
  $excerpt = substr($excerpt, 0, $count);
  $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
  $excerpt = $excerpt.'[...]';
  return $excerpt;
}
// get custom slider
 function magee_get_sliders()
	{
	$sliders = array();
	$magee_custom_slider = new WP_Query( array( 'post_type' => 'magee_slider', 'posts_per_page' => -1 ) );
	while ( $magee_custom_slider->have_posts() ) {
		$magee_custom_slider->the_post();
		$sliders[get_the_ID()] = get_the_title();
	}
	wp_reset_postdata();
	return $sliders;
	}
	
//get page top slider

 function magee_get_page_slider($slider_type,$css_class=""){
	  global  $page_meta;
	
	  $return       = "";
	  switch($slider_type){
		  case "layer":
		  if(isset($page_meta['layer_slider'][0]) && is_numeric($page_meta['layer_slider'][0]) && $page_meta['layer_slider'][0]>0 )
		  $return        = do_shortcode('[layerslider id="'.$page_meta['layer_slider'][0].'"]');
		  break;
		  case "rev":
		 
		   if(isset($page_meta['rev_slider'][0]) && $page_meta['rev_slider'][0] !="" )
		  $return        = do_shortcode('[rev_slider '.$page_meta['rev_slider'][0].']');
		  break;
		   case "magee":
		  if(isset($page_meta['magee_slider'][0]) && is_numeric($page_meta['magee_slider'][0]) && $page_meta['magee_slider'][0]>0 )
		  $return        = do_shortcode('[slider id="'.$page_meta['magee_slider'][0].'"]');	  
		  break;
		  default:
		  return;
		  break;
		  }
	 echo  '<div class="page-top-slider '.$css_class.'">'.$return.'</div>';
	 }
	
// get page layout	
 function magee_get_layout($postid='',$layoutid='page_layout',$default_layoutid='default_layout'){
	 
	 
	     $layout_array      = array(); 
		 $layout_array['sidebar_class'] = "";
		 $layout_array['content_class'] = "";
		 $layout_array['content_width'] = "12";
		 $layout_array['sidebar']       = "";
		 if(isset($postid) && is_numeric($postid)){
	     $layout_array['sidebar'] = get_post_meta( $postid,$layoutid ,true);
		 }
		 if($layout_array['sidebar'] == ""){
			 $layout_array['sidebar'] = ot_get_option($default_layoutid);
		 }
		 
		 switch($layout_array['sidebar'] ){
			 case "left-sidebar":
			   $layout_array['sidebar_class'] = "left";
			   $layout_array['content_class'] = "right";
			   $layout_array['content_width'] = "9";
			 break;
		    case "right-sidebar":
			   $layout_array['sidebar_class'] = "right";
			   $layout_array['content_class'] = "left";
			   $layout_array['content_width'] = "9";
			   
			 break;
		 }
	 return  $layout_array;
	 }
	 
// Add code before the </head> tag.	 
 function magee_space_head(){
	 
  $space_head = ot_get_option('space_head');
  echo $space_head;
  
	 }
 add_action('wp_head', 'magee_space_head',20);
 

// Add code before the </body> tag.
function magee_space_body(){ 
  $space_body = ot_get_option('space_body');
  echo $space_body;
 } 
 add_action('wp_footer', 'magee_space_body',20);
 
 // Add tracking code before the </body> tag.
 function magee_wp_footer_script(){ 
  $footer_script = ot_get_option('tracking_code');
  echo $footer_script;
 } 
 add_action('wp_footer', 'magee_wp_footer_script');
 
 
 // set blog excerpt length
 function magee_excerpt_length( $length ) {
	$blog_excerpt_length = ot_get_option('blog_excerpt_length');
	return $blog_excerpt_length ;
}
add_filter( 'excerpt_length', 'magee_excerpt_length', 999 );

// set number of portfolio items per page
function magee_set_post_filters( $query ) {
	global $portfolio_items;
	$portfolio_items = is_numeric($portfolio_items)?$portfolio_items:10;

	if( ( is_tax( 'portfolio-category' ) ||  is_tax( 'portfolio-tag') ) && $query->is_main_query() ) {
		$query->set( 'posts_per_page', $portfolio_items );
	}

	return $query;
}

add_filter('pre_get_posts', 'magee_set_post_filters');