	
/**
*/
jQuery(document).ready(function() {
								
     jQuery("a[rel^='portfolio-image']").prettyPhoto();	   
	 
 			jQuery(".site-nav-toggle").click(function(){
				jQuery(".site-nav").toggle();
			});
     jQuery(".site-search-toggle").click(function(){
				jQuery(".search-form").toggle();
			});
			
/* ------------------------------------------------------------------------ */
/* testimonial															    */
/* ------------------------------------------------------------------------ */

jQuery(".testimonial-box").owlCarousel({
items : 1,singleItem : true,pagination:false,slideSpeed:200, navigation : false,beforeInit : function(el){
this.options.autoPlay = el.data("autoplay");

}});
	jQuery(".testimonial-control .fa-angle-left").click(function(){jQuery(this).parents(".testimonials-wrapper").find(".testimonial-box").trigger('owl.next');});
	jQuery(".testimonial-control .fa-angle-right").click(function(){jQuery(this).parents(".testimonials-wrapper").find(".testimonial-box").trigger('owl.prev');})
	
/* ------------------------------------------------------------------------ */
/* accordion															    */
/* ------------------------------------------------------------------------ */

 jQuery('.accordion-style-1 .accordion-title').click(function(){
				jQuery(this).parents('.accordion-style-1').find('div.accordion-content').hide("slow");
				jQuery(this).parents('.accordion-style-1').find('.accordion-title i').removeClass("fa-minus").addClass("fa-plus");
				
				var detailObj = jQuery(this).parent('.accordion').find('div.accordion-content');
                  	detailObj.toggle();
					if( detailObj.is(':visible') ) {
					jQuery(this).find("i").removeClass("fa-plus").addClass("fa-minus");
					}else{
					jQuery(this).find("i").removeClass("fa-minus").addClass("fa-plus");
					jQuery(this).parent('.accordion').removeClass("active");
					}
              	});
  jQuery('.accordion-style-2 .accordion-title').click(function(){
				jQuery(this).parents('.accordion-style-2').find('div.accordion-content').hide("slow");
				jQuery(this).parents('.accordion-style-2').find('.accordion-title i').removeClass("fa-caret-down").addClass("fa-caret-right");
				
				var detailObj = jQuery(this).parent('.accordion').find('div.accordion-content');
                  	detailObj.toggle();
					if( detailObj.is(':visible') ) {
					jQuery(this).find("i").removeClass("fa-caret-right").addClass("fa-caret-down");
					}else{
					jQuery(this).find("i").removeClass("fa-caret-down").addClass("fa-caret-right");
					jQuery(this).parent('.accordion').removeClass("active");
					}
              	});
/* ------------------------------------------------------------------------ */
/*  contact form															*/
/* ------------------------------------------------------------------------ */
	 
	jQuery(".contact-submit").click(function(){
         jQuery(".contact-form").submit(function(e){
										   
	var obj = jQuery(this);	
	var notify = obj.find(".noticefailed");
	notify.html("").hide();
	notify.append("<img alt='loading' class='loading' src='"+magee_params.themeurl+"/images/AjaxLoader.gif' />");
	
	 var name    = obj.find("#contact-name").val();
	 var email   = obj.find("#contact-email").val();
	 var sendto  = obj.find("#sendto").val();
	 var message = obj.find("#contact-msg").val();
	  jQuery.ajax({type:"POST",dataType:"json",url:magee_params.ajaxurl,data:"name="+name+"&email="+email+"&sendto="+sendto+"&message="+message+"&action=magee_contact",
	    success:function(data){
			    obj.find('.loading').remove();
				if(data.error==0){
				 notify.addClass("noticesuccess").removeClass("noticefailed");
				 notify.html(data.msg);
				 obj.find("#contact-name").val("");
	             obj.find("#contact-email").val("");
	             obj.find("#contact-msg").val("");
				}else{
				 notify.html(data.msg);
				}
		notify.show();
		return false;
				},
		error:function(){
		obj.find('.loading').remove();
		notify.html("Error.");
		notify.show();
		return false;
       }});
	  return false;
	  });
 });
/* ------------------------------------------------------------------------ */
/*  SNS TIP															*/
/* ------------------------------------------------------------------------ */
	 
 jQuery('.header-sns a').tooltip('hide');
  
/* ------------------------------------------------------------------------ */
/*  background video														*/
/* ------------------------------------------------------------------------ */
	 
  if(typeof magee_bigvideo !== 'undefined' && magee_bigvideo!=null){
for(var i=0;i<magee_bigvideo.length;i++){
jQuery(magee_bigvideo[i].video_item).tubular(magee_bigvideo[i].options);
   }
  }


	
/* ------------------------------------------------------------------------ */
/*  Section Heading Color														*/
/* ------------------------------------------------------------------------ */
	 
 jQuery('section').each(function(){
					var headingcolor = jQuery(this).data("headingcolor");
					if(headingcolor != ""){
						jQuery(this).find("h1,h2,h3,h4,h5,h6").css("color",headingcolor);
						}
				});

////////////////////

  
});

(function ($){
  if($('.blog-style-three-container').length > 0){
      var handler = $('#tiles li');
      handler.wookmark({
          // Prepare layout options.
          autoResize: true, // This will auto-update the layout when the browser window is resized.
          container: $('.blog-style-three-container'), // Optional, used for some extra CSS styling
          offset: 15, // Optional, the distance between grid items
         // outerOffset: 10, // Optional, the distance to the containers border
          itemWidth: '48%' // Optional, the width of a grid item
      });
  }
    })(jQuery);

(function ($){

	 var $container = $('.portfolio-list-main');
      $container.mixItUp();

})(jQuery);

	
  if(typeof magee_js_var !== 'undefined' && typeof magee_js_var.global_color !== 'undefined'){
 less.modifyVars({
        '@color-main': magee_js_var.global_color
    });
   }


