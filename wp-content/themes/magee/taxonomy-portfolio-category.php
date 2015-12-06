<?php
/**
* The portfolio category file.
*
*/
   get_header(); 

   $layout = magee_get_layout();
   $portfolio_category_columns = ot_get_option('portfolio_category_columns');
   
   switch($portfolio_category_columns){
	   case 2:
	   $portfolio_item_width = 6 ;
	   break;
	   case 3:
	   $portfolio_item_width = 4 ;
	   break;
	    case 4:
	   $portfolio_item_width = 3 ;
	   break;
	   default:
	   $portfolio_item_width = 4 ;
	   $portfolio_category_columns = 3;
	   break;
	   }
	   if(is_post_type_archive('portfolio' )){
		echo "bbbbbbbbbbbbbbbbbbbbbbb";
		}
?>
 <?php magee_load_breadcrumb();?>
<div class="portfolio-list">
			<div class="container">
            <div class="row">
			<div class="col-md-<?php echo $layout['content_width'];?> <?php echo $layout['content_class'];?>">
				<section class="portfolio-list-main" role="main">
					<?php if (have_posts()) : ?>
                     <?php
							$items  = "" ;
							$i      = 1 ;
							$result = "" ;
							while ( have_posts() ) : the_post(); 
							$portfolio_image = "";
							if (has_post_thumbnail( get_the_ID()) ): 
							$thumb = get_the_post_thumbnail( get_the_ID() , "portfolio-grid-thumb" ); 
							//$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );
							//$portfolio_image = $image[0];
							endif;
						$items .= '<div class="col-sm-'.$portfolio_item_width.'">
							<figure class="portfolio-list-box">
								'. $thumb.'
								<figcaption>
									<a href="'.get_permalink().'"><h3>'.get_the_title().'</h3></a>
									'.get_the_excerpt().'
								</figcaption>
							</figure></div>';
						if($i%$portfolio_category_columns == 0){
							$result .=  '<div class="row">'.$items."</div>";
							$items   = "";
							}
						$i++;
					  endwhile;
					  if($items != "")
					  $result = $result.'<div class="row">'.$items."</div>";
					  
					  echo  $result;
					  ?> 
					<div class="list-pagition text-center">
						<?php magee_native_pagenavi("echo",$wp_query);?>	
					</div>
                    <?php else:?>
                    <div style="width:100%; text-align:center; margin-bottom:30px;">
                    <?php _e("Nothing found.","magee");?>
                    </div>
                    <?php endif; ?>
				</section>
                </div>
                <?php if( $layout['sidebar'] == "left-sidebar" || $layout['sidebar'] == "right-sidebar" ):?>
                <div class="col-md-3 <?php echo $layout['sidebar_class'];?>">
						<aside class="blog-side text-left">
							<div class="widget-area">
                                <?php 
								
								magee_get_sidebar("portfolio-category");
								
								?>                     
                            </div>
						</aside>
					</div>
                    <?php endif;?>
                    
                    </div>
			</div>	
		</div>
<?php get_footer();?>