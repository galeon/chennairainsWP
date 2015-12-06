<?php
/**
Template Name: Blog Style Three
* The blog template style three.
 */
 function magee_blog_three_script(){ 
  wp_enqueue_script( 'magee-wookmark', get_template_directory_uri().'/js/jquery.wookmark.min.js', array( 'jquery' ), '', false );
 	 }

 add_action( 'wp_enqueue_scripts', 'magee_blog_three_script' );
 get_header();
 ?>
 <?php if (have_posts()) :
		  while ( have_posts() ) : the_post();
		 $postid    = get_the_ID();
		 $page_meta = get_post_meta(  $postid );
		 
		 $page_background = isset($page_meta["page_background"][0])?$page_meta["page_background"][0]:"";
		 $background      = magee_get_background($page_background);
		 $show_breadcrumb = isset($page_meta["show_breadcrumb"][0])?$page_meta["show_breadcrumb"][0]:"on";
		 $wrapper_width   = isset($page_meta["wrapper_width"][0])?$page_meta["wrapper_width"][0]:"boxed";

		 $layout = magee_get_layout($postid ,'page_layout','default_page_layout');
		 
		 if($wrapper_width == "boxed")
		 $container = "container";
		 else
		 $container = "full-width";
	    endwhile;
        endif;
		wp_reset_postdata();
		  ?>
<div id="post-<?php echo  $postid; ?>" <?php post_class(); ?>  style=" <?php echo $background; ?>">
<?php if($show_breadcrumb == "on"):?>
 <?php magee_load_breadcrumb();?>
<?php endif;?>
<div class="blog-list style3">
			<div class="<?php echo $container;?>">
				<div class="row">
					<div class="col-md-<?php echo $layout['content_width'];?> <?php echo $layout['content_class'];?>">
                    
<?php 
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					$args=array(
					'paged'=>$paged,
					'post_type' => 'post',
					);
					
					$blog_query = new WP_Query($args); 
?>
                    
                    <?php if ($blog_query->have_posts()) : ?>
						<section class="blog-main text-center " role="main">
                        <div class="blog-style-three-container">
                        <ul id="tiles">						
						<?php
                          while ($blog_query-> have_posts() ) : $blog_query->the_post(); 
					        get_template_part("article","loop3");
                          endwhile;
					?>
                    </ul>
                    </div>
							<div class="list-pagition text-center">
								<?php magee_native_pagenavi("echo",$blog_query);?>	
							</div>
                            
						</section>
                    <?php endif ; ?>
                    <?php wp_reset_postdata();?>
					</div>
                    <?php if( $layout['sidebar'] == "left-sidebar" || $layout['sidebar'] == "right-sidebar" ):?>
					<div class="col-md-3 <?php echo $layout['sidebar_class'];?>">
						<aside class="blog-side text-left">
							<div class="widget-area">
							<?php magee_get_sidebar('blog_post');?>
							</div>
						</aside>
					</div>
                    <?php endif;?>
				</div>
			</div>	
		</div>
      </div>
     
<?php
   get_footer();