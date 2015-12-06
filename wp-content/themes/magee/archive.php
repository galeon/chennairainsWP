<?php
/**
 * The archive template file.
 */

 get_header();
 $layout = magee_get_layout();
 ?>
<div class="blog-list">
			<div class="container">
				<div class="row">
					<div class="col-md-<?php echo $layout['content_width'];?> <?php echo $layout['content_class'];?>">
                    <?php if (have_posts()) : ?>
						<section class="blog-main text-center" role="main">							
						<?php
                          while ( have_posts() ) : the_post(); 
					        get_template_part("article","loop");
                          endwhile;
					?>
							<div class="list-pagition text-center">
								<?php magee_native_pagenavi("echo",$wp_query);?>	
							</div>
						</section>
                    <?php endif ; ?>
					</div>
					 <?php if( $layout['sidebar'] == "left-sidebar" || $layout['sidebar'] == "right-sidebar" ):?>
					<div class="col-md-3 <?php echo $layout['sidebar_class'];?>">
						<aside class="blog-side text-left">
							<div class="widget-area">
							<?php magee_get_sidebar('blog_list');?>
							</div>
						</aside>
					</div>
                     <?php endif;?>
				</div>
			</div>	
		</div>
<?php
   get_footer();