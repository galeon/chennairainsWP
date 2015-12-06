<?php
/**
* The 404 template file.
*
*/
   get_header(); 

?>
<div id="post-404">
 <?php magee_load_breadcrumb();?>

		<div class="blog-detail">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<section class="blog-main text-center" role="main">
							<article class="post-entry text-left">
                                <div class="page-404 text-center">
									<h1><strong><?php echo ot_get_option("not_found_title");?></strong></h1>
                                    <p><?php echo ot_get_option("not_found_content");?></p>
								</div>
                                </div>
                            </article>
						</section>
					</div>
				</div>
            </div>	
            <div class="clear"></div>
		</div>
		  	
</div>
</div>
<?php get_footer(); ?>