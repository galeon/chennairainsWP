<?php

//add a button to the content editor, next to the media button
//this button will show a popup that contains inline content
add_action('media_buttons_context', 'add_my_custom_button');

//add some content to the bottom of the page 
//This will be shown in the inline modal
if(is_admin()){
add_action('admin_footer', 'add_inline_popup_content');
}
//action to add a custom button to the content editor
function add_my_custom_button($context) {
  
  //path to my icon
  $img = get_template_directory_uri() .'/images/shortcode_button.png';
  
 
  //our popup's title
  $title = __('Magee Shortcodes','magee');

  //append the icon
  $context .= "<a class='magee_shortcodes' title='{$title}'><img src='{$img}' /></a>";
  
  return $context;
}

function add_inline_popup_content() {
global $magee_shortcodes ;

?>


<div class="white-popup magee_shortcodes_container mfp-with-anim mfp-hide" id="magee_shortcodes_container" style="" >
 <form>
  <h4><?php _e("MageeWP Shortcodes Generator",'magee');?></h4>
  <ul class="magee_shortcodes_list">
  <?php if(is_array($magee_shortcodes )):foreach($magee_shortcodes as $key => $val){ 	
         if(in_array($key ,array("testimonial_item","pricing_item","testimonial",'tab','accordion'))){continue;}
  ?>
  
  <li><a class='magee_shortcode_item <?php echo $key;?>' title='<?php echo ucwords(str_replace("_"," ",$key));?>' data-shortcode="<?php echo $key;?>" href="javascript:;"><?php echo ucwords(str_replace("_"," ",$key));?></a></li>
  <?php } ?>
  <?php endif;?>
	  </ul>
	  <div id="magee-shortcodes-settings">
	  
	 
  <div id="magee-generator-breadcrumbs">
  <a title="Click to return to the shortcodes list" class="magee-shortcodes-home" href="javascript:void(0);"><?php  _e("All shortcodes",'magee');?></a>  &rarr; <span class="current_shortcode"></span>
    <div class="clear"></div>
  </div>
	        <div id="magee-shortcodes-settings-inner"></div>
			<input name="magee-shortcode" type="hidden" id="magee-shortcode" value="" />
			<input name="magee-shortcode-textarea" type="hidden" id="magee-shortcode-textarea" value="" />
			<div class="magee-shortcode-actions magee-shortcode-clearfix">
			<!--<a class="button button-secondary button-large magee-shortcode-preview "  href="javascript:void(0);"><?php _e("Preview shortcode",'magee');?></a>-->
			<a class="button button-primary button-large magee-shortcode-insert "  href="javascript:void(0);"><?php _e("Insert shortcode",'magee');?></a>
			
	  </div>
	  <div class="clear"></div>
	  </div></form>
	  <div class="clear"></div>
</div>
<div id="magee-shortcode-preview" style="display:none;">

</div>
<?php } ?>