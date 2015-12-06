<?php
/**
* The sigle template file.
*
*/
   get_header(); 

?>
<?php if (have_posts()) :
		  while ( have_posts() ) : the_post();
		$page_meta = get_post_meta( get_the_ID() );
		$page_sidebar    = isset($page_meta["page_sidebar"][0])?$page_meta["page_sidebar"][0]:"";
		$layout = magee_get_layout(get_the_ID(),'page_layout','default_page_layout');
		  ?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
 <?php magee_load_breadcrumb();?>
        
		<div class="portfolio-detail">
			<div class="container">
            <div class="col-md-<?php echo $layout['content_width'];?> <?php echo $layout['content_class'];?>">
				<section class="portfolio-detail-main" role="main">
					<div class="row">
						<div class="col-md-6">
							<div class="portfolio-img-slider">
								<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
									<!-- Indicators -->
                            <?php 
							 $post_meta =  get_post_meta( get_the_ID() );
							// $portfolio_gallery = get_post_meta( get_the_ID() ,'portfolio_gallery');
							 $portfolio_gallery = $post_meta['portfolio_gallery'];
						
						     if( isset($portfolio_gallery[0])  && $portfolio_gallery[0] != NULL){
	
							 $i          = 0;
							 $indicators = "";
							 $inner      = "";
						
							 foreach($portfolio_gallery as $attachment){
							 
							 $attachment_id_arr = explode(",",$attachment);
							 if($attachment_id_arr && is_array($attachment_id_arr)){
							 foreach($attachment_id_arr as $attachment_id){
							 $active = "";
							 if($i == 0) $active = "active";
							  $image_attributes = wp_get_attachment_image_src( $attachment_id, "portfolio" );
							  
							   $indicators .= '<li data-target="#carousel-example-generic" data-slide-to="'.$i.'" class="'.$active.'"></li>';
							   $inner      .= '<div class="item '.$active.'"><img src="'.$image_attributes[0].'" width="'.$image_attributes[1].'" height="'.$image_attributes[2].'" alt=""/></div>';
							   
							    $i++;
							   }
							   }
							  
							  }
				
							 }else{
							 $feat_image = wp_get_attachment_image( get_post_thumbnail_id(get_the_ID()), 'portfolio');
				            if($feat_image ){ 
				              echo $feat_image;
				            }
							 }
						 ?> 
                                    
									<ol class="carousel-indicators">
									<?php echo $indicators;?>	
									</ol>
									<!-- Wrapper for slides -->
									<div class="carousel-inner">
                                    <?php echo $inner;?>										
									</div>
								</div>
							</div>							
						</div>
						<div class="col-md-6">
							<div class="portfolio-detail-content">
                            <?php if(isset($post_meta["show_attributes"][0]) && $post_meta["show_attributes"][0] == "on"){?>
								<h2 style="margin-top: 0;"><?php echo $post_meta["attributes_group_title"][0];?></h2>
								<ul class="fa-ul">
									<li><i class="fa-li fa fa-calendar"></i><?php _e("Project Date: ","magee");echo $post_meta["project_date"][0];?></li>
									<li><i class="fa-li fa fa-money"></i><?php _e("Project Budget: ","magee");echo $post_meta["project_budget"][0];?></li>
									<li><i class="fa-li fa fa-wrench"></i><?php _e("Technologies: ","magee");echo $post_meta["technologies"][0];?></li>
								</ul>
                                <?php }?>
								<h1><?php the_title();?></h1>
								<div class="portfolio-content"><?php the_content();?></div>
							</div>
						</div>
					</div>
				</section>
         <?php if(isset($post_meta["show_related_portfolios"][0]) && $post_meta["show_related_portfolios"][0] == "on"){?>
				<section class="portfolio-related">
					<h2><?php _e("More Related Projects","magee");?></h2>
					<?php echo magee_get_related_portfolios($post->ID,5)?>
				</section>
                <?php }?>
			</div>
            
           <?php if( $layout['sidebar'] == "left-sidebar" || $layout['sidebar'] == "right-sidebar" ):?>
					<div class="col-md-3 <?php echo $layout['sidebar_class'];?>">
						<aside class="blog-side text-left">
							<div class="widget-area">
                                <?php 
								if($page_sidebar == "") $page_sidebar = "portfolio";
								magee_get_sidebar($page_sidebar);
								
								?>                     
                            </div>
						</aside>
					</div>
                     <?php endif;?>	
		</div>
        
        </div>
        
		  	
</div>
<?php endwhile;?>
<?php endif;?>
<?php get_footer(); ?>