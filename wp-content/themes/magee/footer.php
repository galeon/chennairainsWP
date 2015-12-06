<footer>
<?php 
   $footer_area_active = ot_get_option("footer_area_active");
if( $footer_area_active != "off" ): ?>
			<div class="footer-widget-area">
				<div class="container">
					<div class="row">
      <?php 
	  $footer_widgets_columns = ot_get_option("footer_widgets_columns");
	  switch( $footer_widgets_columns ){
		  
		  case "1":
		  ?>
          <div class="col-md-12 col-sm-12">
							<?php dynamic_sidebar("footer_area_one");?>
						</div>
          <?php
		  
		  break;
		   case "2":
		  ?>
          <div class="col-md-6 col-sm-12">
							<?php dynamic_sidebar("footer_area_one");?>
						</div>
						<div class="col-md-6 col-sm-12">
							<?php dynamic_sidebar("footer_area_two");?>
						</div>
          <?php
		  break;
		   case "3":
		    ?>
		  <div class="col-md-4 col-sm-12">
							<?php dynamic_sidebar("footer_area_one");?>
						</div>
						<div class="col-md-4 col-sm-6">
							<?php dynamic_sidebar("footer_area_two");?>
						</div>
						<div class="col-md-4 col-sm-6">
							<?php dynamic_sidebar("footer_area_three");?>
						</div>
          <?php
		  break;
		   case "4":
		   default:
		   ?>
           <div class="col-md-3 col-sm-6">
							<?php dynamic_sidebar("footer_area_one");?>
						</div>
						<div class="col-md-3 col-sm-6">
							<?php dynamic_sidebar("footer_area_two");?>
						</div>
						<div class="col-md-3 col-sm-6">
							<?php dynamic_sidebar("footer_area_three");?>
						</div>
						<div class="col-md-3 col-sm-6">
							<?php dynamic_sidebar("footer_area_four");?>
						</div>
		   <?php
		  break;
		  }
	  
	  ?>
      
					</div>
				</div>
			</div>
            <?php endif;?>
            <?php 
   $footer_copyright_active = ot_get_option("footer_copyright_active");
if( $footer_copyright_active != "off" ): ?>
			<div class="container text-center copyright-area">
            
            <div class="site-info">
					<?php echo ot_get_option('copyright'); ?>
				</div>
                 <?php 
   $display_footer_social_icons = ot_get_option("display_footer_social_icons");
if( $display_footer_social_icons != "off" ): ?>
				<div class="site-sns">
					<?php
			$sns_list_items = ot_get_option( 'footer_sns_list' ); 
			 if(is_array($sns_list_items) && !empty($sns_list_items)):
             foreach($sns_list_items as $sns_list_item){
			?>
                <a target="_blank" href="<?php echo esc_url($sns_list_item["link"]);?>" title="<?php echo $sns_list_item["title"];?>"><i class="fa fa-<?php echo $sns_list_item["sns"];?>"></i></a>
              <?php } endif;?>
				</div>	
                <?php endif;?>	
			</div>
            <?php endif;?>
            
		</footer>
	</div>
    <?php wp_footer();?>
</body>
</html>