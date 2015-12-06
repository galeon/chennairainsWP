<li class="item col-sm-6"><article class="entry-box text-left">
<?php  
 global $post_meta_author,$post_meta_date,$post_meta_cats,$post_meta_comments,$post_meta_read,$content_length,$strip_html_excerpt,$strip_html_excerpt,$featured_images,$date_format;
		if (  has_post_thumbnail() && $featured_images == "on" ) {
		the_post_thumbnail();
		}
                      ?>
										<div class="entry-main">
											<div class="entry-header">
												<a href="<?php the_permalink();?>"><h1 class="entry-title"><?php the_title();?></h1></a>
												<div class="entry-meta">
                                                <?php if($post_meta_date != "off"){?>
													<span class="entry-date"><i class="fa fa-calendar"></i><a href="<?php echo get_month_link('', ''); ?>"><?php echo get_the_date( $date_format );?></a></span>
                                                      <?php }?>
                                                       <?php if($post_meta_author != "off"){?>
													<span class="entry-author"><i class="fa fa-user"></i><?php echo get_the_author_link();?></span> <?php }?>
                                                    <?php if($post_meta_cats != "off"){?>
													<span class="entry-category"><i class="fa fa-file-o"></i><?php the_category(', '); ?></span>
													<?php }?>
													<?php edit_post_link('<span class="entry-edit"><i class="fa fa-pencil"></i>Edit</span>', '', ''); ?>
												</div>
											</div>
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
												<div class="entry-more"><a href="<?php the_permalink();?>"><?php _e("Read More &raquo;","magee");?></a></div><?php }?>
                                                 <?php if($post_meta_comments != "off"){?>
												<?php  comments_popup_link( '<div class="entry-comments"><div> No comments yet</div><i class="fa fa-comment"></i></div>', '<div class="entry-comments"><div> 1 comment</div><i class="fa fa-comment"></i></div>', '<div class="entry-comments"><div> % comments</div><i class="fa fa-comment"></i></div>', 'comments-link', '');?>
                                                <?php }?>
											</div>
										</div>
									</article></li>
           