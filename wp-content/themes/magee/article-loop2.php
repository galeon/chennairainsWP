<?php  
 global $post_meta_author,$post_meta_date,$post_meta_cats,$post_meta_comments,$post_meta_read,$content_length,$strip_html_excerpt,$strip_html_excerpt,$featured_images,$date_format;
				
                      ?>
<article class="entry-box text-left">
								<div class="entry-aside">
									<ul class="entry-meta">
                                    <?php if($post_meta_author != "off"){?>
										<li class="entry-author">
											<div><?php _e("POSTED BY","magee");?> <?php echo get_the_author_link();?></div>
											<i class="fa fa-user"></i>
										</li>
                                         <?php }?>
                                          <?php if($post_meta_date != "off"){?>
										<li class="entry-date">
											<div><i class="fa fa-calendar"></i><a href="<?php echo get_month_link('', ''); ?>"><?php echo get_the_date( $date_format );?></a></div>
											<i class="fa fa-calendar"></i>
										</li>
                                         <?php }?>
                                          <?php if($post_meta_cats != "off"){?>
										<li class="entry-category">
											<div><?php the_category(', '); ?></div>
											<i class="fa fa-file-o"></i>
										</li>
                                         <?php }?>
                                          <?php if($post_meta_comments != "off"){?>
										<?php  comments_popup_link( '<li class="entry-comments"><div>0 comment</div><i class="fa fa-comment"></i></li>', '<li class="entry-comments"><div> 1 comment</div><i class="fa fa-comment"></i></li>', '<li class="entry-comments"><div> % comments</div><i class="fa fa-comment"></i></li>', 'comments-link', '');?>
                                        <?php }?>
                                         
									</ul>
								</div>
								<div class="entry-main">
									<div class="entry-header">
										<a href="<?php the_permalink();?>"><h1 class="entry-title"><?php the_title();?></h1></a>
									</div>
									    <?php  

                              
                              if (  has_post_thumbnail() && $featured_images == "on" ) {
                              the_post_thumbnail();
							  }
                      ?>
									<div class="entry-summary">
                                    
                              <?php 
							 
							  if( $content_length == "full_content" ){
								       the_content();
								  }
								  else{
									  $excerpt = get_the_excerpt();
									  if( $strip_html_excerpt == "on" ){
										    $excerpt = strip_tags( $excerpt );
										  }
							           echo $excerpt;
								  }
								  
								  ?>
                                    </div>
									<div class="entry-footer">
                                    <?php if($post_meta_read != "off"){?>
										<div class="entry-more"><a href="<?php the_permalink();?>"><?php _e("Read More &raquo;","magee");?></a></div> <?php }?>
									</div>
								</div>								
							</article>
