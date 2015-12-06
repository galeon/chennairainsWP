<?php
/**
* The sigle template file.
*
*/
   get_header(); 

?>
<?php if (have_posts()) :
		  while ( have_posts() ) : the_post();
		$layout = magee_get_layout(get_the_ID(),'page_layout','default_post_layout');
		$single_post_full_width      =  ot_get_option('single_post_full_width');
		if( $single_post_full_width == "on" )
		{
			 $layout_array['sidebar_class'] = "";
		     $layout_array['content_class'] = "";
		     $layout_array['content_width'] = "12";
		     $layout_array['sidebar']       = "";
			
			}
		  ?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
 <?php magee_load_breadcrumb();?>
		<div class="blog-detail">
			<div class="container">
				<div class="row">
                
					<div class="col-md-<?php echo $layout['content_width'];?> <?php echo $layout['content_class'];?>" >
						<section class="blog-main text-center" role="main">
							<article class="post-entry text-left">
                                <div class="entry-main">
                                    <div class="entry-header">
                                        <h1 class="entry-title"><?php the_title(); ?></h1>
                                        <div class="entry-meta">
                                            <span class="entry-date"><a href="<?php echo get_day_link('', '', ''); ?>"><i class="fa fa-calendar"></i><?php echo get_the_date("M d, Y");?></a></span>
                                            <span class="entry-author"><i class="fa fa-user"></i><?php echo get_the_author_link();?></span> 
                                            <span class="entry-category"><i class="fa fa-file-o"></i><?php the_category(', '); ?></span>
                                           <?php edit_post_link('<span class="entry-edit"><i class="fa fa-pencil"></i>'.__("Edit","magee").'</span>', '', ''); ?>
                                        </div>
                                    </div>
                                    <div class="entry-content">
                                     <?php 
									 $featured_images_single = ot_get_option('featured_images_single');
									  if (  has_post_thumbnail() && $featured_images_single == "on" ) {
                                             the_post_thumbnail();
										  }
								         	 the_content(); 
									 
									 ?>
                                    </div>
                                    <div class="entry-footer">
                                    <?php 
									
									    $social_sharing_box = ot_get_option('social_sharing_box');
									  if (  $social_sharing_box == "on" ) {
									?>
                                        <div class="entry-share">
                                            <div class="entry-share-title"><?php _e("Share This Story","magee");?>:</div>
                                            <div class="entry-share-icons">
                                                <a onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>&title=<?php the_title(); ?>"><i class="fa fa-facebook"></i></a>
                                                <a onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="http://twitter.com/home?status=<?php the_title(); ?>+<?php the_permalink(); ?>"><i class="fa fa-twitter"></i></a>
                                                <a  href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-google-plus"></i></a>
                                                <a onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>&source=<?php echo $source; ?>"><i class="fa fa-linkedin"></i></a>
                                                <a onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&media=<?php echo $featured_image[0]; ?>&description=<?php echo get_the_excerpt(); ?>"><i class="fa fa-pinterest"></i></a>
                                                <a target="_blank" href="<?php bloginfo('rss2_url'); ?>"><i class="fa fa-rss"></i></a>
                                            </div>
                                        </div>
                                        <?php
									  }//end social sharing box
										?>
                                    </div>
                                </div>
                            </article>
                            <?php 
							$related_posts = ot_get_option('related_posts');
							if( $related_posts == "on" ){
							?>
                            <section class="blog-related text-left">
                                <h2><?php _e("Related Articles","magee");?></h2>
                                
                              <?php echo magee_get_related_posts($post->ID,5);?>
                                
                            </section>
                            <?php } //end related posts?>
                            <?php if(comments_open() ):?>
							<div class="comments-area text-left">
	                        	 <?php  
										echo '<div class="comment-wrapper">';
										comments_template(); 
										echo '</div>';

                                     ?>      
	                        </div>
                             <?php endif;?>
						</section>
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
<?php endwhile;?>
<?php endif;?>
<?php get_footer(); ?>