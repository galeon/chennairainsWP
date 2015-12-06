<?php
/*
Template Name: Portfolio  Grid
*/
get_header();

if (have_posts()) :
		  while ( have_posts() ) : the_post();
		  $page_meta = get_post_meta( get_the_ID() );

		 $page_background = isset($page_meta["page_background"][0])?$page_meta["page_background"][0]:"";
		 $background      = magee_get_background($page_background);
		 $show_breadcrumb = isset($page_meta["show_breadcrumb"][0])?$page_meta["show_breadcrumb"][0]:"on";
		 $wrapper_width   = isset($page_meta["wrapper_width"][0])?$page_meta["wrapper_width"][0]:"boxed";
		 $page_sidebar    = isset($page_meta["page_sidebar"][0])?$page_meta["page_sidebar"][0]:"";

		 $layout = magee_get_layout(get_the_ID(),'page_layout','default_portfolio_layout');
		 if($wrapper_width == "boxed")
		 $container = "container";
		 else
		 $container = "full-width";
	
		  ?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>  style=" <?php echo $background; ?>">
<?php if($show_breadcrumb == "on"):?>
 <?php magee_load_breadcrumb();?>
<?php endif;?>
		<div class="portfolio-list">
			<div class="<?php echo $container;?>">
				
					<div class="<?php echo $layout['content_width'];?> <?php echo $layout['content_class'];?>">
						<section class="blog-main text-center" role="main">
							<article class="post-entry text-left">
                                     <div class="entry-content">
                                   <div class="portfolio-list-wrap">
			<?php echo do_shortcode("[portfolio num='6']");?>	
		</div>
                                     <div class="clear"></div>
                                    </div>
                                
                            </article>
                            <?php if(comments_open() ):?>
							<div class="comments-area text-left">
	                        	 <?php  
										echo '<div class="comment-wrapper"><div class="container">';
										comments_template(); 
										echo '</div></div>';

                                     ?>      
	                        </div>
                            <?php endif;?>
						</section>
					</div>
                     <?php if( $layout['sidebar'] == "left-sidebar" || $layout['sidebar'] == "right-sidebar" ):?>
					<div class="col-md-3 <?php echo $layout['sidebar_class'];?>">
						<aside class="blog-side text-left">
							<div class="widget-area">
                                <?php 
								if($page_sidebar == "") $page_sidebar = "page";
								magee_get_sidebar($page_sidebar);
								
								?>                     
                            </div>
						</aside>
					</div>
                     <?php endif;?>
				
			</div>	
            <div class="clear"></div>
		</div>
		  	
</div>
<?php endwhile;?>
<?php endif;?>
<?php get_footer(); ?>