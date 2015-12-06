<?php
/**
 * The main template file.
 */

 get_header();
 ?>
<div class="blog-list">
			<div class="container">
				<div class="row">
					<div class="col-md-9">
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
					<div class="col-md-3">
						<aside class="blog-side text-left">
							<div class="widget-area">
							<?php magee_get_sidebar('default_sidebar');?>
							</div>
						</aside>
					</div>
				</div>
			</div>	
		</div>
<?php
   get_footer();