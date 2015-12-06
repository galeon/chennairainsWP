 jQuery(document).ready(function($) {


jQuery('.magee_shortcodes,.magee_shortcodes_textarea').magnificPopup({
  items: {
      src: '#magee_shortcodes_container',
      type: 'inline'
  }
});

jQuery('.magee_shortcodes_textarea').on("click",function(){
			var id = jQuery(this).next().find("textarea").attr("id");
			jQuery('#magee-shortcode-textarea').val(id);
		});																	   

jQuery('.magee_shortcodes_list li a.magee_shortcode_item').on("click",function(){
													  
  var obj       = jQuery(this);
  var shortcode = obj.data("shortcode");
  var form      = obj.parents("div#magee_shortcodes_container form");
 
   jQuery.ajax({
		type: "POST",
		url: magee_params.ajaxurl,
		dataType: "html",
		data: { shortcode: shortcode, action: "magee_shortcode_form" },
		success:function(data){
	
		   form.find(".magee_shortcodes_list").hide();
		   form.find("#magee-shortcodes-settings").show();
		   form.find("#magee-shortcodes-settings .current_shortcode").text(shortcode);
		   form.find("#magee-shortcodes-settings-inner").html(data);
		}
		});
	
});

jQuery(".magee-shortcodes-home").bind("click",function(){
            jQuery("#magee-shortcodes-settings").hide();
		    jQuery("#magee-shortcodes-settings-innter").html("");
		    jQuery(".magee_shortcodes_list").show();
		   
		});
		
// insert shortcode into editor
jQuery(".magee-shortcode-insert").bind("click",function(e){

    var obj       = jQuery(this);
	var form      = obj.parents("div#magee_shortcodes_container form");
	var shortcode = form.find("input#magee-curr-shortcode").val();

	jQuery.ajax({
		type: "POST",
		url: magee_params.ajaxurl,
		dataType: "html",
		data: { shortcode: shortcode, action: "magee_get_shortcode",attr:form.serializeArray()},
		
		success:function(data){
		
		jQuery.magnificPopup.close();
		form.find("#magee-shortcodes-settings").hide();
		form.find("#magee-shortcodes-settings-innter").html("");
		form.find(".magee_shortcodes_list").show();
        form.find(".magee-shortcode").val(data);
		if(jQuery('#magee-shortcode-textarea').val() !="" ){
			var textarea = jQuery('#magee-shortcode-textarea').val();
			if(textarea !== "undefined"){
		    var position = jQuery("#"+textarea).getCursorPosition();
			var content = jQuery("#"+textarea).val();
            var newContent = content.substr(0, position) + data + content.substr(position);
            jQuery("#"+textarea).val(newContent);
			
			}
			}else{
		window.magee_wpActiveEditor = window.wpActiveEditor;
		// Insert shortcode
		window.wp.media.editor.insert(data);
		// Restore previous editor
		window.wpActiveEditor = window.magee_wpActiveEditor;
		}
		},
		error:function(){
			jQuery.magnificPopup.close();
		// return false;
		}
		});
		// return false;
   });

 //preview shortcode

jQuery(".magee-shortcode-preview").bind("click",function(e){

    var obj       = jQuery(this);
	var form      = obj.parents("div#magee_shortcodes_container form");
	var shortcode = form.find("input#magee-curr-shortcode").val();

	jQuery.ajax({
		type: "POST",
		url: magee_params.ajaxurl,
		dataType: "html",
		data: { shortcode: shortcode, action: "magee_get_shortcode",attr:form.serializeArray()},
		
		success:function(data){
      
		jQuery.ajax({type: "POST",url: magee_params.ajaxurl,dataType: "html",data: { shortcode: data, action: "magee_shortcode_preview"},	
		success:function(content){
			jQuery("#magee-shortcode-preview").html(content);
	        tb_show(shortcode + " preview","#TB_inline?width=600&amp;inlineId=magee-shortcode-preview",null);
			}
		});
	
		},
		error:function(){
			
		// return false;
		}
		});
		// return false;
   });

/////

  jQuery("#setting_header_template").find(".option-tree-ui-radio-image-selected").after("<div id='magee_header_checked'></div>");
  jQuery("#setting_header_template").find(".option-tree-ui-radio-images").click(function(){
			jQuery("#magee_header_checked").remove();
			jQuery(this).append("<div id='magee_header_checked'></div>");
      });
  
  ////
 jQuery(".option-tree-ui-buttons .option-tree-ui-button,#option-tree-sub-header .option-tree-ui-button").addClass("disable");
 jQuery("#option-tree-settings-api input,#option-tree-settings-api select,#option-tree-settings-api textarea").on("change",function() {
 jQuery(".option-tree-ui-buttons .option-tree-ui-button,#option-tree-sub-header .option-tree-ui-button").removeClass("disable");							 													 
													 });														  
 jQuery(".ot-numeric-slider-wrap .ui-slider-handle").on("mouseup",function(){
 jQuery(".option-tree-ui-buttons .option-tree-ui-button,#option-tree-sub-header .option-tree-ui-button").removeClass("disable");
												   });									
 
 jQuery(document).on("click","#option-tree-settings-api .type-colorpicker",function(e) {								  
	 jQuery(".option-tree-ui-buttons .option-tree-ui-button,#option-tree-sub-header .option-tree-ui-button").removeClass("disable");											  
													  });
  
  jQuery("#setting_global_color").find(".format-setting-inner").append('<div style="float:left; margin-top: -5px;"><a class="custom-color" style="background-color: #ff6f6f;"></a><a class="custom-color" style="background-color: #f88d45;"></a><a class="custom-color" style="background-color: #ffd02d; "></a><a class="custom-color" style="background-color: #8de06c;"></a><a class="custom-color" style="background-color: #3bc779; "></a><a class="custom-color" style="background-color: #3cc5ca;"></a><a class="custom-color" style="background-color: #2f80d4; "></a><a class="custom-color" style="background-color: #3d48d7; "></a><a class="custom-color" style="background-color: #b54ce1; "></a><a class="custom-color" style="background-color: #e14c9d; "></a></div>');
  
  jQuery("#setting_global_color").on("click","a.custom-color",function(){
            var x = jQuery(this).css('backgroundColor');
             hexc(x);
			 
              jQuery(this).parents("#setting_global_color").find(".wp-color-result").css({"background-color":x});
			  jQuery(this).parents("#setting_global_color").find(".hide-color-picker").val(color);
   });
  
  ////
  var header_style = jQuery("#setting_header_template").find(".option-tree-ui-images:checked").val();
      jQuery("#setting_header_template").find("#setting_header_text,#setting_sns_list_item").show();
	  
  if(header_style != 2){
	  jQuery("#setting_header_text").hide();
	  }
	if(header_style == 1 || header_style == 4){
	  jQuery("#setting_sns_list_item").hide();
	  }
	  
  jQuery("#setting_header_template").on("click",".option-tree-ui-radio-images",function(){
	 var header_style = jQuery(this).find(".option-tree-ui-images").val();

	 jQuery("#setting_header_text").hide();
	 jQuery("#setting_sns_list_item").hide();
	 
     if(header_style == 2){
	  jQuery("#setting_header_text").show();
	  }
	  if(header_style != 1 && header_style != 4){
	  jQuery("#setting_sns_list_item").show();
	  }
	  
      });
  
  jQuery("#setting_breadcrumb_background").hide();
  if(jQuery("#breadcrumb_style").val() == 2){
	  jQuery("#setting_breadcrumb_background").show();
	  }
	jQuery("#setting_breadcrumb_style").on("change","#breadcrumb_style",function(){
		jQuery("#setting_breadcrumb_background").hide();	
		if(jQuery(this).val() == 2){
			jQuery("#setting_breadcrumb_background").show();
			}
        });
	
/* ------------------------------------------------------------------------ */
/* import demo tables										       		    */
/* ------------------------------------------------------------------------ */
jQuery(".magee-data-restore").click(function(){
	if(confirm("WARNING: Clicking this button will replace your current theme options, sliders and widgets. It can also take a minute to complete. Importing data is recommended on fresh installs only once. Importing on sites with content or importing twice will duplicate menus, pages and all posts.")){
	jQuery(this).parent().find(".loading").remove();								 
	jQuery(this).parent().append('<div class="loading"><img src="'+magee_params.themeurl+'/images/AjaxLoader.gif" /></div>');							 
	jQuery.ajax({type:"POST",dataType:"html",url:magee_params.ajaxurl,data:"action=magee_data_import",
	    success:function(data){
			jQuery(".magee-data-restore").parent().find(".loading").html(data);
			},error:function(){
				jQuery(".magee-data-restore").parent().find(".loading").html('Error.');
				} })
  }
  });

	
  });
 
function hexc(colorval) {
    var parts = colorval.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
    delete(parts[0]);
    for (var i = 1; i <= 3; ++i) {
        parts[i] = parseInt(parts[i]).toString(16);
        if (parts[i].length == 1) parts[i] = '0' + parts[i];
    }
    color = '#' + parts.join('');
}
 
 
 //get the position
 
 (function ($, undefined) {
    $.fn.getCursorPosition = function () {
        var el = $(this).get(0);
        var pos = 0;
        if ('selectionStart' in el) {
            pos = el.selectionStart;
        } else if ('selection' in document) {
            el.focus();
            var Sel = document.selection.createRange();
            var SelLength = document.selection.createRange().text.length;
            Sel.moveStart('character', -el.value.length);
            pos = Sel.text.length - SelLength;
        }
        return pos;
    }
})(jQuery);