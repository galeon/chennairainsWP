<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php wp_title('|', true, 'right'); ?></title>
<?php wp_head();?>
</head>
<?php
  global  $page_meta;
  $container        =  "";
  $site_layout      =  ot_get_option('site_layout');
  $page_meta        = get_post_meta( get_the_ID() );
  $slider_position  = isset($page_meta['slider_position'][0])?$page_meta['slider_position'][0]:"";
  $slider_type      = isset($page_meta['slider_type'][0])?$page_meta['slider_type'][0]:"";

  if($site_layout == "boxed"){	  $container  = "container";	  }
?>
<body <?php body_class(); ?>>
<div class="main-container <?php echo $container ;?>">
<?php
	$header_template   =  ot_get_option('header_template');
	if(!is_numeric($header_template) || $header_template <= 0){
		$header_template = 1;
		}
	if($slider_position == 'above' && $slider_type !="" ){
		magee_get_page_slider($slider_type ,"slider-above-header");
		}
	get_template_part("header/header",$header_template);
     if($slider_position == 'below' && $slider_type !=""){
		magee_get_page_slider($slider_type,"slider-below-header" );
		}  

   
  
 global $post_meta_author,$post_meta_date,$post_meta_cats,$post_meta_comments,$post_meta_read,$content_length,$strip_html_excerpt,$strip_html_excerpt,$featured_images;
 
  $post_meta_author    =  ot_get_option('post_meta_author');
  $post_meta_date      =  ot_get_option('post_meta_date');
  $post_meta_cats      =  ot_get_option('post_meta_cats');
  $post_meta_comments  =  ot_get_option('post_meta_comments');
  $post_meta_read      =  ot_get_option('post_meta_read');
  $content_length      =  ot_get_option('content_length');
  $strip_html_excerpt  =  ot_get_option('strip_html_excerpt');
  $featured_images     =  ot_get_option('featured_images');
  $date_format         =  ot_get_option('date_format');
  $date_format         =  $date_format == ""? "M d, Y":$date_format;