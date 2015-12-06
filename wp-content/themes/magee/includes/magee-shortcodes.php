<?php

/**
	 * Shortcode: Columns
	 *
	 * @param string $content
	 * @param array $atts Shortcode attributes
	 * @return string Output html
	 * author: quan
	 */
 global $magee_shortcodes, $portfolio_categories,$post_type_array,$post_categories;
 //
 
 $portfolio_categories = array();
 $post_type_array      = array();
 $args = array( 'hide_empty=0' );
 $terms = get_terms('portfolio-category', $args);
 $portfolio_categories[""] = "All";
 $count = count($terms); $i=0;
	if ($count > 0) {
		foreach ($terms as $term) {
			$i++;
			if(isset($term->slug) && isset($term->name)){
			$portfolio_categories[$term->slug] = $term->name;
			}
		}
	}

 $post_categories = array();
 $post_type_array      = array();
 $args = array( 'hide_empty=0' );
 $terms = get_terms('category', $args);
 $post_categories[""] = "All";
 $count = count($terms); $i=0;
	if ($count > 0) {
		foreach ($terms as $term) {
			$i++;
			if(isset($term->slug) && isset($term->name)){
			$post_categories[$term->slug] = $term->name;
			}
		}
	}

 //
/*	 $args = array(
	   'public'   => true,
	   '_builtin' => false
	);
	$output = 'names'; // names or objects, note names is the default
	$operator = 'and'; // 'and' or 'or'
	$post_types = get_post_types( $args, $output, $operator ); 
	foreach ( $post_types  as $post_type ) {
	  $post_type_array[$post_type] = $post_type;
	}*/


 $magee_shortcodes = array(
							   
	'accordions'  => array(
	array("type"=>"select","std"=>"1","id"=>"style","title"=>__("Style",'magee') ,"options"=>array("1"=>"1","2"=>"2")),
	array("type"=>"text","std"=>"1","id"=>"active","title"=>__("Active Item",'magee') ,"desc"=>''),
	array("type"=>"textarea","std"=>"\n[accordion title='Accordion title one']\nLorem ipsum dolor sit amet, consectetur adipiscingelit. Integer sed magna vel velit dignissim luctus eu n urna. Dapibus ege-stas turpis. Praesent faucibus nisl sit amet nulla sollicitudin.\n[/accordion]\n\n[accordion title='Accordion title two']\nStopping in my tracks I moved my sword so that it made the dead head appear to turn inquiring eyes upon the gorilla-man. For a long moment I stood perfectly still, eyeing the fellow with those.\n[/accordion]\n","id"=>"text_content","title"=>__("Accordion Items",'magee') ,"desc"=>''),
	array("type"=>"text","std"=>"","id"=>"css_class","title"=>__("Css Class",'magee') ,"desc"=>__('Extra CSS class','magee'))
	 
  ),
  'accordion'  => array(
	array("type"=>"select","std"=>"","id"=>"title","title"=>__("Title",'magee') ,"desc"=>""),
	array("type"=>"textarea","std"=>"","id"=>"text_content","title"=>__("Content",'magee') ,"desc"=>''),
	array("type"=>"text","std"=>"","id"=>"css_class","title"=>__("Css Class",'magee') ,"desc"=>__('Extra CSS class','magee'))
	 
  ) ,
  'align' => array(
  array("type"=>"select","std"=>"left","id"=>"align","title"=>__("Align",'magee') ,"desc"=>'',"options"=>array("left"=>"left","right"=>"right","center"=>"center")), 
  array("type"=>"text","std"=>"","id"=>"css_class","title"=>__("Css Class",'magee') ,"desc"=>__('Extra CSS class','magee')),
  array("type"=>"textarea","std"=>" Your Content ","id"=>"text_content","title"=>__("Content",'magee') ,"desc"=>'')
  )
  ,

  'blog'  => array(
	array("type"=>"text","std"=>"3","id"=>"num","title"=>__("List Num",'magee') ,"desc"=>''),
	array("type"=>"select","std"=>"","id"=>"category","title"=>__("Category",'magee') ,"options"=>$post_categories),
	array("type"=>"text","std"=>"","id"=>"css_class","title"=>__("Css Class",'magee') ,"desc"=>__('Extra CSS class','magee'))
	 
  ),
   'box'  => array(
	 array("type"=>"text","std"=>"#fff","id"=>"color","title"=>__("Font Color",'magee') ,"desc"=>''),
     array("type"=>"text","std"=>"rgba(0, 0, 0, 0.5)","id"=>"background_color","title"=>__("Background Color",'magee') ,"desc"=>''),
	 array("type"=>"text","std"=>"10px","id"=>"padding","title"=>__("Box Padding",'magee') ,"desc"=>''),
	 array("type"=>"text","std"=>"100%","id"=>"width","title"=>__("Box Width",'magee') ,"desc"=>''),
	 array("type"=>"textarea","std"=>" Your Content ","id"=>"text_content","title"=>__("Content",'magee') ,"desc"=>''),
	 array("type"=>"text","std"=>"","id"=>"css_class","title"=>__("Css Class",'magee') ,"desc"=>__('Extra CSS class','magee'))
  ),
   
 'boxed'  => array(
	// array("type"=>"text","std"=>"","id"=>"width","title"=>__("Box Width",'magee') ,"desc"=>__('Default 1170','magee')),
     array("type"=>"textarea","std"=>" Your Content ","id"=>"text_content","title"=>__("Content",'magee') ,"desc"=>''),
	 array("type"=>"text","std"=>"","id"=>"css_class","title"=>__("Css Class",'magee') ,"desc"=>__('Extra CSS class','magee'))
  ),				   
 'button'  => array(
	 array("type"=>"select","std"=>"1","id"=>"style","title"=>__("Style",'magee') ,"options"=>array("1"=>"1","2"=>"2","3"=>"3")),
	 array("type"=>"select","std"=>"","id"=>"type","title"=>__("Type",'magee') ,"options"=>array(""=>"default","primary"=>"primary","success"=>"success","info"=>"info","warning"=>"warning","danger"=>"danger")),
	 array("type"=>"text","std"=>"","id"=>"icon","title"=>__("Button Icon",'magee') ,"desc"=>__('Font Awesome Icon.','magee')),
     array("type"=>"textarea","std"=>" Button ","id"=>"text_content","title"=>__("Button Text",'magee') ,"desc"=>''),
	 array("type"=>"text","std"=>"","id"=>"css_class","title"=>__("Css Class",'magee') ,"desc"=>__('Extra CSS class','magee'))
  )
  ,					   
  'center'  => array(
	 array("type"=>"textarea","std"=>" Your Content ","id"=>"text_content","title"=>__("Content",'magee') ,"desc"=>''),
	 array("type"=>"text","std"=>"","id"=>"css_class","title"=>__("Css Class",'magee') ,"desc"=>__('Extra CSS class','magee'))
  )
   ,			

  'client'  => array(
	array("type"=>"text","std"=>"","id"=>"image","title"=>__("Image Url",'magee') ,"desc"=>''),
	array("type"=>"text","std"=>"","id"=>"title","title"=>__("Title",'magee') ,"desc"=>''),
	array("type"=>"text","std"=>"","id"=>"css_class","title"=>__("Css Class",'magee') ,"desc"=>__('Extra CSS class','magee'))
	 )
  ,
  
  'contact'  => array(
	array("type"=>"select","std"=>"1","id"=>"style","title"=>__("Style",'magee') ,"options"=>array("1"=>"1","2"=>"2")),
	array("type"=>"text","std"=>get_option( 'admin_email' ),"id"=>"email","title"=>__("Contact Email",'magee') ,"desc"=>''),
	array("type"=>"text","std"=>"","id"=>"css_class","title"=>__("Css Class",'magee') ,"desc"=>__('Extra CSS class','magee'))
	 
  )  , 
  'column' => array(
  
   array("type"=>"select","std"=>"","id"=>"col_xs","title"=>__("Extra small grid( &lt; 768px)",'magee') ,"desc"=>__("Select column width. This width will be calculated depend page width.",'magee'),"options"=>array(""=>"default","1"=>"1/12","2"=>"2/12","3"=>"3/12","4"=>"4/12","5"=>"5/12","6"=>"6/12","7"=>"7/12","8"=>"8/12","9"=>"9/12","10"=>"10/12","11"=>"11/12","12"=>"12/12")),
  array("type"=>"select","std"=>"6","id"=>"col_sm","title"=>__("Small grid(&ge;  768px)",'magee')  ,"desc"=>'',"options"=>array("1"=>"1/12","2"=>"2/12","3"=>"3/12","4"=>"4/12","5"=>"5/12","6"=>"6/12","7"=>"7/12","8"=>"8/12","9"=>"9/12","10"=>"10/12","11"=>"11/12","12"=>"12/12")),
    array("type"=>"select","std"=>"3","id"=>"col_md","title"=>__("Medium grid( &ge;  992px)",'magee'),"desc"=>'',"options"=>array("1"=>"1/12","2"=>"2/12","3"=>"3/12","4"=>"4/12","5"=>"5/12","6"=>"6/12","7"=>"7/12","8"=>"8/12","9"=>"9/12","10"=>"10/12","11"=>"11/12","12"=>"12/12")),
    array("type"=>"select","std"=>"","id"=>"col_lg","title"=>__("Large grid( &ge;  1200px)",'magee') ,"desc"=>'',"options"=>array(""=>"default","1"=>"1/12","2"=>"2/12","3"=>"3/12","4"=>"4/12","5"=>"5/12","6"=>"6/12","7"=>"7/12","8"=>"8/12","9"=>"9/12","10"=>"10/12","11"=>"11/12","12"=>"12/12")),
	array("type"=>"text","std"=>"","id"=>"css_class","title"=>__("Css Class",'magee') ,"desc"=>__('Extra CSS class','magee')),
	array("type"=>"textarea","std"=>" Your Content ","id"=>"text_content","title"=>__("Content",'magee') ,"desc"=>'')
	),
  'divider'  => array(
	 array("type"=>"select","std"=>"","id"=>"style","title"=>__("Style",'magee') ,"options"=>array(""=>"blank","1"=>"1","2"=>"2","3"=>"3","4"=>"4")),
	 array("type"=>"text","std"=>"","id"=>"height","title"=>__("Divider Height",'magee') ,"desc"=>'px'),
	 array("type"=>"text","std"=>"","id"=>"css_class","title"=>__("Css Class",'magee') ,"desc"=>__('Extra CSS class','magee'))
  )
   , 
   'gmap' => array(
   array("type"=>"text","std"=>"100%","id"=>"width","title"=>__("Width",'magee') ),
   array("type"=>"text","std"=>"New York","id"=>"address","title"=>__("Address",'magee') ),
   array("type"=>"select","std"=>"yes","id"=>"marker","title"=>__("Marker",'magee'),"options"=>array("yes"=>"yes",""=>"no") ),
   array("type"=>"text","std"=>"15","id"=>"zoom","title"=>__("Zoom",'magee') ),
   array("type"=>"text","std"=>"","id"=>"css_class","title"=>__("Css Class",'magee') ,"desc"=>'Extra CSS class'),
   array("type"=>"textarea","std"=>'<strong>Hello World</strong><br> New York is the most populous city in the United States, <br>and the center of the New York metropolitan area, which is one of the most populous <br>metropolitan areas in the world.',"id"=>"infowindow","title"=>__("Content",'magee') ,"desc"=>'')
     
  ),
  'image'  => array(
	array("type"=>"select","std"=>"","id"=>"align","title"=>__("Align",'magee') ,"options"=>array(""=>"default","left"=>"left","right"=>"right")),
	array("type"=>"text","std"=>'',"id"=>"width","title"=>__("Width",'magee') ,"desc"=>''),
	array("type"=>"text","std"=>'',"id"=>"src","title"=>__("Image Url",'magee') ,"desc"=>''),
	array("type"=>"text","std"=>"","id"=>"css_class","title"=>__("Css Class",'magee') ,"desc"=>__('Extra CSS class','magee'))
	 
  )   , 
  
   'list'  => array(
	 array("type"=>"text","std"=>"fa-circle","id"=>"icon","title"=>__("Icon",'magee') ,"desc"=>__('Font Awesome Icon.','magee')),
	 array("type"=>"textarea","std"=>"\nList item one.\nList item two.\nList item three\n","id"=>"text_content","title"=>__("Content",'magee') ,"desc"=>__('List per row.','magee')),
	 array("type"=>"text","std"=>"","id"=>"css_class","title"=>__("Css Class",'magee') ,"desc"=>__('Extra CSS class','magee'))
  )
	 ,
	 
	 'portfolio'  => array(
	array("type"=>"text","std"=>"4","id"=>"num","title"=>__("List Num",'magee') ,"desc"=>''),
	array("type"=>"select","std"=>"4","id"=>"columns","title"=>__("Columns",'magee') ,"options"=>array("2"=>"2","3"=>"3","4"=>"4")),
	array("type"=>"select","std"=>"","id"=>"category","title"=>__("Category",'magee') ,"options"=>$portfolio_categories),
	array("type"=>"select","std"=>"0","id"=>"pagenav","title"=>__("Display Pagenav",'magee') ,"options"=>array("0"=>"no","1"=>"yes")),
	array("type"=>"text","std"=>"","id"=>"css_class","title"=>__("Css Class",'magee') ,"desc"=>__('Extra CSS class','magee'))
	 
  ),
	 
	 
	  'portfolio_filter'  => array(
	array("type"=>"text","std"=>"9","id"=>"num","title"=>__("List Num",'magee') ,"desc"=>''),
	array("type"=>"select","std"=>"3","id"=>"columns","title"=>__("Columns",'magee') ,"options"=>array("2"=>"2","3"=>"3","4"=>"4")),
	array("type"=>"select","std"=>"1","id"=>"filter","title"=>__("Display Filter",'magee') ,"options"=>array("1"=>"yes","0"=>"no")),
	array("type"=>"select","std"=>"1","id"=>"pagenav","title"=>__("Display Pagenav",'magee') ,"options"=>array("1"=>"yes","0"=>"no")),
	array("type"=>"text","std"=>"","id"=>"css_class","title"=>__("Css Class",'magee') ,"desc"=>__('Extra CSS class','magee'))
	 
  ),

  'pricing'  => array(
	 array("type"=>"select","std"=>"1","id"=>"style","title"=>__("Style",'magee') ,"options"=>array("1"=>"1","2"=>"2")),  
	 array("type"=>"text","std"=>"$","id"=>"currency","title"=>__("Currency",'magee') ,"desc"=>''),
	 array("type"=>"text","std"=>"29","id"=>"price","title"=>__("Price",'magee') ,"desc"=>''),
	 array("type"=>"text","std"=>"","id"=>"title","title"=>__("Title",'magee') ,"desc"=>''),
	 array("type"=>"text","std"=>"","id"=>"sub_title","title"=>__("Sub-title",'magee') ,"desc"=>''),
	 array("type"=>"select","std"=>"0","id"=>"featured","title"=>__("Featured",'magee') ,"options"=>array("0"=>"no","1"=>"yes")),
	 array("type"=>"text","std"=>"","id"=>"btn_text","title"=>__("Button Text",'magee') ,"desc"=>''),
	 array("type"=>"text","std"=>"#","id"=>"btn_link","title"=>__("Button Link",'magee') ,"desc"=>''),
	 array("type"=>"text","std"=>"fa-shopping-cart","id"=>"btn_icon","title"=>__("Button Icon",'magee') ,"desc"=>__('Font Awesome Icon.','magee')),
	 array("type"=>"textarea","std"=>"[pricing_item]5 GB Bandwidth[/pricing_item]\n[pricing_item]1 GB[/pricing_item]\n[pricing_item]8 GB Storage[/pricing_item]\n[pricing_item]Limited[/pricing_item]\n[pricing_item]2 Projects[/pricing_item]\n","id"=>"text_content","title"=>__("List Items",'magee') ,"desc"=>''),
	 array("type"=>"text","std"=>"","id"=>"css_class","title"=>__("Css Class",'magee') ,"desc"=>__('Extra CSS class','magee'))
  )
	 ,
	 
  'row'  => array(
	 array("type"=>"textarea","std"=>" Your Content ","id"=>"text_content","title"=>__("Content",'magee') ,"desc"=>''),
	 array("type"=>"text","std"=>"","id"=>"css_class","title"=>__("Css Class",'magee') ,"desc"=>__('Extra CSS class','magee'))
  )
  ,
  
   'section'  => array(
	 array("type"=>"text","std"=>"#ffffff","id"=>"background_color","title"=>__("Section Background Color",'magee') ,"desc"=>''),
	 array("type"=>"text","std"=>"","id"=>"background_image","title"=>__("Section Background Image",'magee') ,"desc"=>''),
	 array("type"=>"select","std"=>"","id"=>"background_repeat","title"=>__("Background Repeat",'magee') ,"options"=>array("repeat"=>"repeat all","no-repeat"=>"no-repeat","repeat-x"=>"repeat-x","repeat-y"=>"repeat-y")),
	 array("type"=>"select","std"=>"off","id"=>"background_size","title"=>__("100% Background Image",'magee') ,"options"=>array("off"=>"off","on"=>"on")),
	 

	 array("type"=>"text","std"=>"","id"=>"heading_color","title"=>__("Heading Font Color",'magee') ,"desc"=>__('h1-h6 color, e.g. #ffffff','magee')),
	 array("type"=>"text","std"=>"","id"=>"color","title"=>__("Font Color",'magee') ,"desc"=>'e.g. #ffffff'),
	 array("type"=>"text","std"=>"","id"=>"padding","title"=>__("Section Padding",'magee') ,"desc"=>__('e.g. 60px 0','magee')),
     array("type"=>"textarea","std"=>" Your Content ","id"=>"text_content","title"=>__("Content",'magee') ,"desc"=>''),
	 array("type"=>"text","std"=>"","id"=>"css_class","title"=>__("Css Class",'magee') ,"desc"=>__('Extra CSS class','magee'))
  )
  ,
  'service'  => array(
	 array("type"=>"select","std"=>"","id"=>"style","title"=>__("Style",'magee') ,"options"=>array("1"=>"1","2"=>"2","3"=>"3","4"=>"4")),
     array("type"=>"text","std"=>"Our Service","id"=>"title","title"=>__("Title",'magee') ,"desc"=>''),
	 array("type"=>"text","std"=>"fa-gift","id"=>"icon","title"=>__("Icon",'magee') ,"desc"=>__('Font Awesome Icon.','magee')),
	 //array("type"=>"text","std"=>"","id"=>"icon_color","title"=>__("Icon Color",'magee') ,"desc"=>'e.g. #00b7ee'),
	 array("type"=>"text","std"=>"#","id"=>"link","title"=>__("Link",'magee') ,"desc"=>__('Read more link.','magee')),
	 array("type"=>"textarea","std"=>" Your Content ","id"=>"text_content","title"=>__("Content",'magee') ,"desc"=>''),
	 array("type"=>"text","std"=>"","id"=>"css_class","title"=>__("Css Class",'magee') ,"desc"=>__('Extra CSS class','magee'))
  ),
   
  'slogan'  => array(
     array("type"=>"text","std"=>"BUY ME","id"=>"btn_text","title"=>__("Button Text",'magee') ,"desc"=>''),
	 array("type"=>"text","std"=>"#","id"=>"btn_link","title"=>__("Button Link",'magee') ,"desc"=>''),
	 array("type"=>"textarea","std"=>" Your Content ","id"=>"text_content","title"=>__("Content",'magee') ,"desc"=>''),
	 array("type"=>"text","std"=>"","id"=>"css_class","title"=>__("Css Class",'magee') ,"desc"=>__('Extra CSS class','magee'))
  )
   ,
    'slider'  => array(
	array("type"=>"select","std"=>"","id"=>"id","title"=>__("Align",'magee') ,"options"=>magee_get_sliders()),
	array("type"=>"text","std"=>"","id"=>"css_class","title"=>__("Css Class",'magee') ,"desc"=>__('Extra CSS class','magee'))
	 
  )  ,
  'tabs'  => array(
	array("type"=>"select","std"=>"1","id"=>"style","title"=>__("Style",'magee') ,"options"=>array("1"=>"1","2"=>"2")),
	array("type"=>"text","std"=>"1","id"=>"active","title"=>__("Active Item",'magee') ,"desc"=>''),
	array("type"=>"textarea","std"=>"\n[tab title='Tab One']\nLorem ipsum dolor sit amet, consectetur adipiscingelit. Integer sed magna vel velit dignissim luctus eu n urna. Dapibus ege-stas turpis. Praesent faucibus nisl sit amet nulla sollicitudin.\n[/tab]\n\n[tab title='Tab Two']\nStopping in my tracks I moved my sword so that it made the dead head appear to turn inquiring eyes upon the gorilla-man. For a long moment I stood perfectly still, eyeing the fellow with those.\n[/tab]\n","id"=>"text_content","title"=>__("Tab Items",'magee') ,"desc"=>''),
	array("type"=>"text","std"=>"","id"=>"css_class","title"=>__("Css Class",'magee') ,"desc"=>__('Extra CSS class','magee'))
	 
  ),
  'tab'  => array(
	array("type"=>"select","std"=>"","id"=>"title","title"=>__("Title",'magee') ,"desc"=>""),
	array("type"=>"textarea","std"=>"","id"=>"text_content","title"=>__("Content",'magee') ,"desc"=>''),
	array("type"=>"text","std"=>"","id"=>"css_class","title"=>__("Css Class",'magee') ,"desc"=>__('Extra CSS class','magee'))
	 
  ),
 
  'title'  => array(
	 array("type"=>"select","std"=>"1","id"=>"style","title"=>__("Style",'magee') ,"options"=>array("1"=>"1","2"=>"2","3"=>"3","4"=>"4")),
	 array("type"=>"textarea","std"=>"Layout Title","id"=>"text_content","title"=>__("Content",'magee') ,"desc"=>''),
	 array("type"=>"text","std"=>"","id"=>"css_class","title"=>__("Css Class",'magee') ,"desc"=>__('Extra CSS class','magee'))
  ),

  
  'pricing_item'  => array(
	array("type"=>"textarea","std"=>"","id"=>"text_content","title"=>__("Content",'magee') ,"desc"=>'')
	 
  ),

    'team'  => array(
	 array("type"=>"select","std"=>"1","id"=>"style","title"=>__("Style",'magee') ,"options"=>array("1"=>"1","2"=>"2","3"=>"3")),  
	 array("type"=>"text","std"=>"","id"=>"name","title"=>__("Member Name",'magee') ,"desc"=>''),
	 array("type"=>"text","std"=>"","id"=>"byline","title"=>__("Byline",'magee') ,"desc"=>''),
	 array("type"=>"text","std"=>"","id"=>"avatar","title"=>__("Avatar",'magee') ,"desc"=>__('Size 238 x 271 px for 3/12 column','magee')),
	 array("type"=>"select","std"=>"","id"=>"social_icon_1","title"=>__("Social Icon 1",'magee') ,"options"=>array("skype"=>"skype","facebook"=>"facebook","twitter"=>"twitter","google-plus"=>"google+","youtube"=>"youtube","linkedin"=>"linkedin","pinterest"=>"pinterest")),
	 array("type"=>"text","std"=>"","id"=>"social_link_1","title"=>__("Social Link 1",'magee') ,"desc"=>''),
	 array("type"=>"select","std"=>"","id"=>"social_icon_2","title"=>__("Social Icon 2",'magee') ,"options"=>array("skype"=>"skype","facebook"=>"facebook","twitter"=>"twitter","google-plus"=>"google+","youtube"=>"youtube","linkedin"=>"linkedin","pinterest"=>"pinterest")),
	 array("type"=>"text","std"=>"","id"=>"social_link_2","title"=>__("Social Link 2",'magee') ,"desc"=>''),
	 array("type"=>"select","std"=>"","id"=>"social_icon_3","title"=>__("Social Icon 3",'magee') ,"options"=>array("skype"=>"skype","facebook"=>"facebook","twitter"=>"twitter","google-plus"=>"google+","youtube"=>"youtube","linkedin"=>"linkedin","pinterest"=>"pinterest")),
	 array("type"=>"text","std"=>"","id"=>"social_link_3","title"=>__("Social Link 3",'magee') ,"desc"=>''),
	 array("type"=>"select","std"=>"","id"=>"social_icon_4","title"=>__("Social Icon 4",'magee') ,"options"=>array("skype"=>"skype","facebook"=>"facebook","twitter"=>"twitter","google-plus"=>"google+","youtube"=>"youtube","linkedin"=>"linkedin","pinterest"=>"pinterest")),
	 array("type"=>"text","std"=>"","id"=>"social_link_4","title"=>__("Social Link 4",'magee') ,"desc"=>''),
	 array("type"=>"textarea","std"=>" Your Content ","id"=>"text_content","title"=>__("Description",'magee') ,"desc"=>''),
	 array("type"=>"text","std"=>"","id"=>"css_class","title"=>__("Css Class",'magee') ,"desc"=>__('Extra CSS class','magee'))
  )
   ,
  
  'testimonials'  => array(
	 array("type"=>"select","std"=>"1","id"=>"style","title"=>__("Style",'magee') ,"options"=>array("1"=>"1","2"=>"2","3"=>"3","4"=>"4")),
	 array("type"=>"select","std"=>"yes","id"=>"navigation","title"=>__("Navigation",'magee') ,"options"=>array("yes"=>"yes","no"=>"no")),
	 array("type"=>"select","std"=>"yes","id"=>"autoplay","title"=>__("autoPlay",'magee') ,"options"=>array("yes"=>"yes","no"=>"no")),
	 array("type"=>"textarea","std"=>"\n[testimonial avatar='".MAGEE_THEME_BASE_URL."/images/avatar1.jpg' author='Jane Miller, Company Inc.' byline='CEO - Media Wiki']\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur.\n[/testimonial]\n\n[testimonial avatar='".MAGEE_THEME_BASE_URL."/images/avatar2.jpg' author='Adam Messer' byline='CEO - Media Wiki']\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur.\n[/testimonial]\n","id"=>"text_content","title"=>__("Testimonial Items",'magee') ,"desc"=>''),
	 array("type"=>"text","std"=>"","id"=>"css_class","title"=>__("Css Class",'magee') ,"desc"=>__('Extra CSS class','magee'))
	 ),
  'testimonial'  => array(
	 array("type"=>"text","std"=>"","id"=>"avatar","title"=>__("Avatar",'magee') ,"desc"=>''),
	 array("type"=>"text","std"=>"","id"=>"author","title"=>__("Author",'magee') ,"desc"=>''),
	 array("type"=>"text","std"=>"","id"=>"byline","title"=>__("Byline",'magee') ,"desc"=>''),
	 array("type"=>"textarea","std"=>"","id"=>"text_content","title"=>__("Content",'magee') ,"desc"=>''),
	 array("type"=>"text","std"=>"","id"=>"css_class","title"=>__("Css Class",'magee') ,"desc"=>__('Extra CSS class','magee'))
       )



);

foreach($magee_shortcodes as $magee_shortcode=>$std){
  add_shortcode($magee_shortcode,'magee_'.$magee_shortcode.'_shortcode');
}
 function magee_column_shortcode($atts,$content=NULL){
   extract( shortcode_atts( array(
  'col_xs' => '',
  'col_sm' => '',
  'col_md' => '',
  'col_lg' => '',
  
  'col_sm_offset' =>'', 
  'col_md_offset' =>'', 
  'col_lg_offset' =>'', 
  
  'col_sm_push' =>'', 
  'col_md_push' =>'', 
  'col_lg_push' =>'', 
  
  'col_sm_pull' =>'', 
  'col_md_pull' =>'', 
  'col_lg_pull' =>'',
  'css_class'   =>''

  ), $atts ) );
  
  $col_class = "";
  if(trim($col_xs) != "" && is_numeric($col_xs)){  $col_class .= "col-xs-".$col_xs." ";}
  if(trim($col_sm) != "" && is_numeric($col_sm)){  $col_class .= "col-sm-".$col_sm." ";}
  if(trim($col_md) != "" && is_numeric($col_md)){  $col_class .= "col-md-".$col_md." ";}
  if(trim($col_lg) != "" && is_numeric($col_lg)){  $col_class .= "col-lg-".$col_lg." ";}
  
  if(trim($col_sm_offset) != "" && is_numeric($col_sm_offset)){  $col_class .= "col-sm-offset-".$col_sm_offset." ";}
  if(trim($col_md_offset) != "" && is_numeric($col_md_offset)){  $col_class .= "col-md-offset-".$col_md_offset." ";}
  if(trim($col_lg_offset) != "" && is_numeric($col_lg_offset)){  $col_class .= "col-lg-offset-".$col_lg_offset." ";}
  
  if(trim($col_sm_push) != "" && is_numeric($col_sm_push)){  $col_class .= "col-sm-push-".$col_sm_push." ";}
  if(trim($col_md_push) != "" && is_numeric($col_md_push)){  $col_class .= "col-md-push-".$col_md_push." ";}
  if(trim($col_lg_push) != "" && is_numeric($col_lg_push)){  $col_class .= "col-lg-push-".$col_lg_push." ";}
  
  if(trim($col_sm_pull) != "" && is_numeric($col_sm_pull)){  $col_class .= "col-sm-pull-".$col_sm_pull." ";}
  if(trim($col_md_pull) != "" && is_numeric($col_md_pull)){  $col_class .= "col-md-pull-".$col_md_pull." ";}
  if(trim($col_lg_pull) != "" && is_numeric($col_lg_pull)){  $col_class .= "col-lg-pull-".$col_lg_pull." ";}
  
  if(trim($css_class) != ""){  $col_class .= $css_class;}
  
  $return  = '<div class="magee-shortcode '.$col_class.'">';
  $return .= do_shortcode(magee_fix_shortcodes( $content) );
  $return .= '<div class="clear"></div>';
  $return .= '</div>';
  return $return ;
 }


/**
	 * Shortcode: row
	 *
	 * @param string $content
	 * @param array $atts Shortcode attributes
	 * @return string Output html
	 * author: quan
	 */
  function magee_row_shortcode($atts,$content=NULL)
  {
  
  extract( shortcode_atts( array(
  'css_class'   => '' 
  ), $atts ) );
  
  $return   = '<div class="magee-shortcode row '.$css_class.'">';
  $return  .=  do_shortcode(magee_fix_shortcodes( $content) );
  $return  .= '</div>'; 
  return $return ;
  }

/**
	 * Shortcode: slogan
	 *
	 * @param string $content
	 * @param array $atts Shortcode attributes
	 * @return string Output html
	 * author: quan
	 */
  function magee_slogan_shortcode($atts,$content=NULL){
	  extract( shortcode_atts( array(
  'css_class'   => '',
  'btn_text' => '',
  'btn_link'=>"#"
  ), $atts ) );
	  $return   = '<div class="magee-shortcode  slogan-box '.$css_class.'">
						<div class="slogan-text">';
	  $return  .=  do_shortcode(magee_fix_shortcodes( $content) );
	  $return  .= '</div><a href="'.$btn_link.'">
						<button class="btn-normal">
							'.$btn_text.'
						</button>
						</a>
					</div>';
	return $return ;			
	  
	  }
  
/**
	 * Shortcode: service
	 *
	 * @param string $content
	 * @param array $atts Shortcode attributes
	 * @return string Output html
	 * author: quan
	 */
 function magee_service_shortcode($atts,$content=NULL){
   extract( shortcode_atts( array(
  'css_class'   => '',
  'title' => '',
  'icon' => '',
  'link' => '',
  'icon_color'=>'',
  'style' => '1'
  ), $atts ) );
   if($icon_color != "")
   $icon_color = 'style="color:'.$icon_color.'"';
   $css_class .= ' style'.$style; 
   $more_link  = '';
   
	
   switch($style){
	   case "2":
	   case "4":
	   if($link != "")
      $more_link  = '<div class="text-right"><a href="'.esc_url($link).'" class="text-right">'.__("Read More","magee").'&gt;&gt;</a></div>';
	  $return     = '<div class="magee-shortcode  service-box '.$css_class.' text-left">
                                                <h3><i class="fa '.$icon.' '.$icon_color.'"></i>'.$title.'</h3>
                                                <p>'.do_shortcode(magee_fix_shortcodes( $content) ).'</p>'.$more_link.'</div>';
	   break;
	   
	  case "1":
	  case "3":
	  default:
   $return   = '<div class="magee-shortcode  service-box text-center '.$css_class.'">';
   if($icon != "")
   $return  .= '<i class="fa '.$icon.'" '.$icon_color.'></i>';
   if($title != "")
   $return  .= '<h3>'.$title.'</h3>';
   $return  .= '<p>'.do_shortcode(magee_fix_shortcodes( $content) ).'</p>';
   if($link != "")
   $return  .= '<a href="'.esc_url($link).'">'.__("Read More","magee").'&gt;&gt;</a>';
   $return  .= '</div>';
   break;
    }
   
   
   return $return ;	  
 }
 
 /**
	 * Shortcode: center
	 *
	 * @param string $content
	 * @param array $atts Shortcode attributes
	 * @return string Output html
	 * author: quan
	 */
 function magee_center_shortcode($atts,$content=NULL){
   extract( shortcode_atts( array(
  'css_class'   => ''
  ), $atts ) );
   
   $return   = '<div class="magee-shortcode text-center '.$css_class.'">';
   $return  .= do_shortcode(magee_fix_shortcodes( $content) );
   $return  .= '</div>';
   return $return ;	  
 }
 
  /**
	 * Shortcode: list
	 *
	 * @param string $content
	 * @param array $atts Shortcode attributes
	 * @return string Output html
	 * author: quan
	 */
 function magee_list_shortcode($atts,$content=NULL){
   extract( shortcode_atts( array(
  'css_class'   => '',
  'icon'   => '',
  'style'  => '1'
  ), $atts ) );
   $content   = str_replace(array("<p>","</p>","<br>","<br />","<br/>"),"",$content);
   $return    = '<ul style="" class="magee-shortcode list-style-'.$style.' '.$css_class.'">';
   $listArray = explode("\n",$content);
	if(isset($listArray) && is_array($listArray)){
		foreach($listArray as $list){
		if($list != ""){
		$space = 0;
		for($i=0;$i<=strlen($list);$i++){
		if($list[$i]==' '){$space = $space+10; }else{ break;}
		}
		if(trim($list) != ""){
		$return .= '<li style="margin-left:'.$space.'px"><i class="fa '.$icon.'"></i>'.do_shortcode( magee_fix_shortcodes($list) ).'</li>';
		}
		
		}}}
    $return .= '</ul>';

   return $return ;	  
 }
  
  /**
	 * Shortcode: title
	 *
	 * @param string $content
	 * @param array $atts Shortcode attributes
	 * @return string Output html
	 * author: quan
	 */
 function magee_title_shortcode($atts,$content=NULL){
   extract( shortcode_atts( array(
  'css_class'   => '',
  'style'  => '1'
  ), $atts ) );
    $return  = "";
 switch($style){
	 case 1:
	 case 4:
	 $return = '<div class="magee-shortcode  title style'.$style.' '.$css_class.'">
								<h3>'.do_shortcode(magee_fix_shortcodes( $content) ).'</h3>
								<div class="title-decoration"></div>
							</div>';
	 break;
	 case 2:
	 case 3:
	 $return = '<div class="magee-shortcode  title style'.$style.'"><h3>'.do_shortcode(magee_fix_shortcodes( $content) ).'</h3></div>';
	 break;
	 
	 }
	 return $return ;	
							
 }
 
 /**
	 * Shortcode: boxed
	 *
	 * @param string $content
	 * @param array $atts Shortcode attributes
	 * @return string Output html
	 * author: quan
	 */
 function magee_boxed_shortcode($atts,$content=NULL){
   extract( shortcode_atts( array(
  'css_class'   => '',
  'width'=> ''
  ), $atts ) );
 if($width != ""){
	 if(is_numeric($width))
	 $width = $width."px";
	 
	 $width = "width:".$width.";";
	 }
 $return = '<div class="magee-shortcode  container '.$css_class.'" style="'.$width.'">'.do_shortcode( magee_fix_shortcodes($content) ).'</div>';
							
	 return $return ;	
							
 }
 
  /**
	 * Shortcode: section
	 *
	 * @param string $content
	 * @param array $atts Shortcode attributes
	 * @return string Output html
	 * author: quan
	 */
 function magee_section_shortcode($atts,$content=NULL){
   extract( shortcode_atts( array(
  'css_class'   => '',
  'background_color' => '',
  'background_image' => '',
  'background_repeat' => '',
  'background_size' => 'off',
  'padding' =>'',
  'color' =>'',
  'heading_color'=>''
  
  ), $atts ) );
 $style   = "";
 $bg_pos  = "";

 if($background_color != "")
 $style .= 'background-color:'.$background_color.';';
  if($background_image != "")
  {
	  if( $parallax == "on" )
    $style .= 'background:url('.$background_image.')  50% 0 no-repeat fixed;';
      else
    $style .= 'background-image:url('.$background_image.');';
  }
 if( $background_repeat != "" && $parallax != "on" )
 $style .= 'background-repeat:'.$background_repeat.' ;';
 if( $color != "" )
 $style .= 'color:'.$color.' ;';
 if( $background_size == "on" )
 $style .= '-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;';
 
 if($padding != ""){
	  if(is_numeric($padding))
	 $padding = $padding."px";
	 
	 $style .= "padding:".$padding.";";
	 }
	 
	 
 
 $return = '<section data-headingcolor="'.$heading_color.'" class="magee-shortcode '.$css_class.'" style="'.$style.'">'.do_shortcode( magee_fix_shortcodes($content) ).'<div class="clear"></div></section>';
							
	 return $return ;	
							
 }
 
 
 /**
	 * Shortcode: divider
	 *
	 * @param string $content
	 * @param array $atts Shortcode attributes
	 * @return string Output html
	 * author: quan
	 */
 function magee_divider_shortcode($atts,$content=NULL){
   extract( shortcode_atts( array(
  'css_class'   => '',
  'height'=> '10',
  'style' => ''
  ), $atts ) );
 if($height != ""){
	 if(is_numeric($height))
	 $height = $height."px";
	 $height = "margin-bottom:".$height.";";
	 }
 $return = '<div class="magee-shortcode divider style'.$style.' '.$css_class.'" style='.$height.'></div>';
							
	 return $return ;	
							
 }
 
 /**
	 * Shortcode: team
	 *
	 * @param string $content
	 * @param array $atts Shortcode attributes
	 * @return string Output html
	 * author: quan
	 */
 function magee_team_shortcode($atts,$content=NULL){
   extract( shortcode_atts( array(
  'css_class'   => '',
   'name' => '',
   'avatar' => '',
   'byline'   => '',
   'social_icon_1'   => '',
   'social_link_1'   => '',
   'social_icon_2'   => '',
   'social_link_2'   => '',
   'social_icon_3'   => '',
   'social_link_3'   => '',
   'social_icon_4'   => '',
   'social_link_4'   => '',
   'style' => '1'
   
  ), $atts ) );

 $css_class .= " style".$style; 
 switch($style){
 case "2":
 $return = '<div class="magee-shortcode team-box '.$css_class.'">
                                                <div class="team-img-box">
                                                    <img src="'.esc_url($avatar).'">
                                                </div>
                                                <div class="team-info">
                                                    <h4>'.$name.'</h4>
                                                    <h5>'.$byline.'</h5>
                                                    <p>'.do_shortcode( magee_fix_shortcodes($content) ).'</p>
                                                    <div>
                                                        <div class="team-sns">';
                                                     	for($i = 1; $i<=4 ; $i++){
												if(${"social_icon_$i"} != "" && ${"social_link_$i"} != ""){
												$return .= '<a href="'.${"social_link_$i"}.'"><i class="fa fa-'.${"social_icon_$i"}.'"></i></a>';
												}
											}
      $return .= ' </div></div></div></div>';
 break;
 case "3":
 $return = '<div class="magee-shortcode team-box '.$css_class.'">
                                                <div class="team-img-box">
                                                    <img src="'.esc_url($avatar).'">
                                                </div>
                                                <div class="team-info">
                                                    <h4>'.$name.'</h4>
                                                    <h5>'.$byline.'</h5>
                                                    <p>'.do_shortcode( magee_fix_shortcodes($content) ).'</p>
                                                    <div>
                                                        <div class="team-sns">';
                                                         for($i = 1; $i<=4 ; $i++){
												if(${"social_icon_$i"} != "" && ${"social_link_$i"} != ""){
												$return .= '<a href="'.${"social_link_$i"}.'"><i class="fa fa-'.${"social_icon_$i"}.'"></i></a>';
												}
											}
  $return .= '</div>
                                                    </div>
                                                </div>                                                
                                            </div>';
 break ; 
 case "1":
 default:
 $return = '<div class="magee-shortcode team-box '.$css_class.'">
								<div class="team-img-box">
									<img src="'.esc_url($avatar).'">
									<div class="team-info">
										<h4>'.$name.'</h4>
										<h5>'.$byline.'</h5>
										<img src="'.esc_url($avatar).'">
										<div>
											<div class="team-sns">';
											for($i = 1; $i<=4 ; $i++){
												if(${"social_icon_$i"} != "" && ${"social_link_$i"} != ""){
												$return .= '<a href="'.${"social_link_$i"}.'"><i class="fa fa-'.${"social_icon_$i"}.'"></i></a>';
												}
											}
												
	$return .= '</div>
         </div>  </div>
 </div><p>'.do_shortcode( magee_fix_shortcodes($content) ).'</p></div>';
   break;
 }
							
	 return $return ;	
							
 }
 
 /**
	 * Shortcode: pricing
	 *
	 * @param string $content
	 * @param array $atts Shortcode attributes
	 * @return string Output html
	 * author: quan
	 */
 function magee_pricing_shortcode($atts,$content=NULL){
   extract( shortcode_atts( array(
  'css_class' => '',
  'currency' =>'$',
  'price' => '',
  'title' => '',
  'sub_title' => '',
  'color' => '',
  'btn_text' => 'BUY',
  'btn_link' => '#',
  'btn_icon' => 'fa-shopping-cart',
  'style'    => '1',
  'featured' => '0'
  ), $atts ) );
   $css_style = '';
  if($color !=""){
	  $css_style = 'background-color: '.$color.';color: #fff;border-color: '.$color.';';
  }
 $is_featured = "" ;
 if($featured == '1' || $featured == 'yes') $is_featured = " featured";
 $css_class  .= " style".$style;
 $css_class  .= $is_featured;
 switch($style){
	 
	 case "2":
	 $return = '<div class="magee-shortcode price-box '.$css_class.'">
                                                <ul>
                                                    <li class="price-title">
                                                        <h3>'.$title.'</h3>
                                                        <div class="price-tag">
                                                            <sup>'.$currency.'</sup>'.$price.'
                                                        </div>
                                                        <h4>'.$sub_title.'</h4>
                                                    </li>
                                                    '.do_shortcode( magee_fix_shortcodes($content) ).'
                                                    <li><button class="btn"><i class="fa '.$btn_icon.'"></i> '.$btn_text.'</button></li>
                                                </ul>
                                            </div>';
	 break;
	 case "1":
	 default:
 $return = '<div class="magee-shortcode price-box '.$css_class.'">
								<div class="price-tag" style="'.$css_style.'">
									<sup>'.$currency.'</sup>'.$price.'
								</div>
								<ul>
									<li class="price-title">
										<h3>'.$title.'</h3>
										<h4>'.$sub_title.'</h4>
									</li>
									'.do_shortcode( magee_fix_shortcodes($content) ).'
									<li><button class="btn" style="'.$css_style.'"><i class="fa '.$btn_icon.'"></i> '.$btn_text.'</button></li>
								</ul>
							</div>';
			break;				
     }
	 return $return ;	
							
 }
 
  function magee_pricing_item_shortcode($atts,$content=NULL){
   extract( shortcode_atts( array(
  'css_class' => ''
  ), $atts ) );
   $return = '<li>'.do_shortcode( magee_fix_shortcodes($content) ).'</li>';
   return $return ;
  }
  
   /**
	 * Shortcode: portfolio
	 *
	 * @param string $content
	 * @param array $atts Shortcode attributes
	 * @return string Output html
	 * author: quan
	 */
 function magee_portfolio_shortcode($atts,$content=NULL){
   extract( shortcode_atts( array(
  'css_class'   => '',
  'columns'=> '4',
  'num' => '4',
  'category' => '',
  'pagenav' =>''
  ), $atts ) );
   global $paged;
   
   if(!is_numeric($category)){
		$term      = get_term_by('name', $category, 'portfolio-category');
		}else{
		$term      = get_term_by('id', $category, 'portfolio-category');
		}
  $return = '<div class="magee-shortcode portfolio-wrapper">';
  $items  = '';
  $term_slug = isset($term->slug)?$term->slug:"";
  if(!is_numeric($columns) || $columns<2 || $columns>4)
  $columns  = 4;
  $i        = 1;
  $col      = 12/$columns ;
  if(!$paged){$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;}
 
  $query = new WP_Query('post_type=portfolio&paged='.$paged.'&orderby=menu_order&post_status=publish&portfolio-category='.$term_slug.'&posts_per_page='.$num);
  
    if($query->have_posts() ):
	while ($query->have_posts() ) :
    $query->the_post();
	
	$postid            = get_the_ID();
	$permalink         = get_permalink();
	$title             = get_the_title();
	$image             = "";
	$thumb             = "";
	 if (has_post_thumbnail( $postid) ): 
	$thumb = get_the_post_thumbnail( $postid , "portfolio-grid-thumb" ); 
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $postid ), 'large' );
	$image = $image[0];
	endif;
	
 $items  .= '<div class="col-md-'.$col.' col-sm-6 '.$css_class.'"><figure class="portfolio-box">
								<div class="portfolio-img-box">
									'.$thumb.'
									<div class="portfolio-info-box">
										<div class="portfolio-icon-box">
											<a href="'.$image.'" rel="portfolio-image"><i class="fa fa-search"></i></a>
											<a href="'.$permalink.'"><i class="fa fa-link"></i></a>
										</div>
									</div>
								</div>
								<figcaption>
									<h3>'.$title.'</h3>
								</figcaption>
							</figure></div>';
	  if($i%$columns == 0) 
	  {  
	      $return .= '<div class="row">'. $items.'</div>';
		  $items  = '';
		  }
     $i++ ;
		endwhile;
		endif;
		if($items  != '') $return .= '<div class="row">'. $items.'</div>';
		
		if($pagenav == "yes" || $pagenav == "1"){	
		$return .= '<div class="list-pagition text-center">'.magee_native_pagenavi("return",$query).'</div>';
		}
		$return .= '</div>';
		wp_reset_postdata();
	 return $return ;	
							
 }
 
 
 /**
	 * Shortcode: blog
	 *
	 * @param string $content
	 * @param array $atts Shortcode attributes
	 * @return string Output html
	 * author: quan
	 */
 function magee_blog_shortcode($atts,$content=NULL){
   extract( shortcode_atts( array(
  'css_class'   => '',
  'num' => '3',
  'category' => ''
  ), $atts ) );
   global $paged;
   $return = '<div class="magee-shortcode blog-list-box '.$css_class.'"><ul>';
    $paged =(get_query_var('paged'))? get_query_var('paged'): 1;
    $wp_query = new WP_Query();
	$wp_query -> query('showposts='.$num.'&cat='.$category.'&paged='.$paged."&post_status=publish&ignore_sticky_posts=1"); 
	$i = 1 ;
	if ($wp_query -> have_posts()) :
    while ( $wp_query -> have_posts() ) : $wp_query -> the_post();
	$thumb = "";
	$content_style = "";
	if(has_post_thumbnail()){
	$thumb = get_the_post_thumbnail( get_the_ID() , "blog-shortcode-thumb" ); 
	$thumb = '<a href="'.get_permalink().'" class="blog-list-img">'.$thumb.'</a>';
	
	}
	else{
	$content_style = "margin-left:0";	
		}
    $return .= '<li>'.$thumb.'<div class="blog-list-content" style="'.$content_style.'">
											<div class="entry-header">
												<a href="'.get_permalink().'"><h1 class="entry-title">'.get_the_title().'</h1></a>
												<div class="entry-meta">
													<span class="entry-date"><a href="'.get_day_link('', '', '').'"><i class="fa fa-calendar"></i>'.get_the_date("M d, Y").'</a></span>
													<span class="entry-author"><i class="fa fa-user"></i>'.get_the_author_link().'</span> 
												</div>
											</div>
											<div class="entry-summary">
											'.magee_get_excerpt(120,get_the_ID()).'
											</div>
										</div>
									</li>';
									   
	endwhile;
	endif;
	 $return .= '</ul></div>';
		wp_reset_postdata();
	 return $return ;	
							
 }
 
 
 /**
	 * Shortcode: testimonials
	 *
	 * @param string $content
	 * @param array $atts Shortcode attributes
	 * @return string Output html
	 * author: quan
	 */
 function magee_testimonials_shortcode($atts,$content=NULL){
   extract( shortcode_atts( array(
  'css_class'   => '',
  'style' => '1',
  'navigation' => 'yes',
  'autoplay'=> 'yes'
  ), $atts ) );
 $GLOBALS['testimonial_style']  = $style;
 $GLOBALS['testimonial_num']  = 0;
 $testimonial = do_shortcode( magee_fix_shortcodes($content) );	
  if( $autoplay == 'yes' || $autoplay == '1' || $autoplay == 'true')
 $autoplay = 'true' ;
 else
 $autoplay = 'false' ;
 
 $return = '<div class="magee-shortcode testimonials-wrapper style'.$style.'  '.$css_class.'">';
 if($GLOBALS['testimonial_num'] > 1 && ($navigation == "1" || $navigation == "yes" || $navigation == "1")){
 $return .= '<div class="testimonial-control">
								<a href="javascript:;">
									<i class="fa fa-angle-left"></i>
								</a>
								<a href="javascript:;">
									<i class="fa fa-angle-right"></i>
								</a>
							</div>';
 }
							
 $return .= '<div class="testimonial-box style'.$style.'" data-autoplay="'.$autoplay.'">';
 $return .=  $testimonial ;					
 $return .= '</div></div>';
unset($GLOBALS['testimonial_style']);
unset($GLOBALS['testimonial_num']);	
	 return $return ;	
							
 }
 
  function magee_testimonial_shortcode($atts,$content=NULL){
   extract( shortcode_atts( array(
  'css_class'   => '',
  'avatar' => '',
  'author' => '',
  'byline' => ''
  ), $atts ) );
  $avatar_str = "";
  $quote      = "";
  if($avatar != "")
  $avatar_str = '<img src="'.esc_url($avatar).'">';
  $style = isset($GLOBALS['testimonial_style'])?$GLOBALS['testimonial_style']:1;
  $num   = isset($GLOBALS['testimonial_num'])?$GLOBALS['testimonial_num']:0;
   $GLOBALS['testimonial_num'] = $num  + 1;
  switch($style)
  {
	  case "2";
	    $return = '<div class="item"><div class="testimonial-content '.$css_class.'">'.do_shortcode( magee_fix_shortcodes($content) ).'</div><div class="testimonial-author">'.$avatar_str.'<p>'.$author.'</p><p>'.$byline.'</p></div></div>';
	  break;
	  case "3":
	   $return = '<div class="item"><div class="testimonial-content '.$css_class.'">'.do_shortcode( magee_fix_shortcodes($content) ).'</div><div class="testimonial-author"> '.$avatar_str.'<p>'.$author.'</p><p>'.$byline.'</p></div></div>';
	  break;
	  case "4":
      $return = '<div class="item"><div class="testimonial-content '.$css_class.'">'.do_shortcode( magee_fix_shortcodes($content) ).'</div><div class="testimonial-author"><p>'.$author.'</p><p>'.$byline.'</p></div></div>';
	  break;
	  case "2":
	  default:
	  $return = '<div class="item"><div class="testimonial-content '.$css_class.'">'.do_shortcode( magee_fix_shortcodes($content) ).'<i class="fa fa-quote-left"></i><i class="fa fa-quote-right"></i></div><div class="testimonial-author">'.$avatar_str.'<p>'.$author.'</p><p>'.$byline.'</p></div></div>';
	  break;
	  }								
		 return $return ;	
  }
  
   /**
	 * Shortcode: client
	 *
	 * @param string $content
	 * @param array $atts Shortcode attributes
	 * @return string Output html
	 * author: quan
	 */
 function magee_client_shortcode($atts,$content=NULL){
   extract( shortcode_atts( array(
  'css_class'   => '',
  'image'=> '',
  'title' => ''
  ), $atts ) );
 
 $return = '<figure class="magee-shortcode client-box '.$css_class.'">
								<img src="'.esc_url($image).'">
								<figcaption>'.$title.'</figcaption>
							</figure>';
							
	 return $return ;	
							
 }
 
    /**
	 * Shortcode: Accordion
	 *
	 * @param string $content
	 * @param array $atts Shortcode attributes
	 * @return string Output html
	 * author: quan
	 */
 function magee_accordions_shortcode($atts,$content=NULL){
   extract( shortcode_atts( array(
  'css_class'   => '',
  'style' => '1',
  'active' => ''
  ), $atts ) );
 $GLOBALS['accordion_style']   = $style;
 $GLOBALS['accordion_active']  = $active;
 $GLOBALS['accordion_num']     = 0;
  $return = '<div class="magee-shortcode accordion-wrapper '.$css_class.' accordion-style-'.$style.'">'.do_shortcode( magee_fix_shortcodes($content) ).'</div>';
 unset($GLOBALS['accordion_style']);
 unset($GLOBALS['accordion_active']);
 unset($GLOBALS['accordion_num']);
	 return $return ;	
							
 }
 function magee_accordion_shortcode($atts,$content=NULL){
   extract( shortcode_atts( array(
  'css_class'   => '',
  'title' => '',
  'active'=>''
  ), $atts ) );
  $is_active    =  $GLOBALS['accordion_active'];
  $style        =  $GLOBALS['accordion_style'];
  $num          =  $GLOBALS['accordion_num'] + 1;
  $active_class = "";
  $GLOBALS['accordion_num'] = $num ;
  if($style == "" || !is_numeric($style))
  $style = 1;
  if($style == 1){
  if($active == "1" || $is_active == $num )
  {
  $icon = "fa-minus";
  $active_class = "active" ;
  }
  else
  $icon = "fa-plus";
  }
  if($style == 2){
  if($active == "1" || $is_active == $num )
  {
  $icon = "fa-caret-down";
  $active_class = "active" ;
  }
  else
  $icon = "fa-caret-right";
  }
  $return = '<div class="magee-shortcode accordion style'.$style.' '.$css_class.' '.$active_class.'">
                          <h4 class="accordion-title">'.$title.'<i class="fa '.$icon.'"></i></h4>
                                                <div class="accordion-content">'.do_shortcode( magee_fix_shortcodes($content) ).'</div>
                                            </div>';
							
	 return $return ;	
							
 }
 
    /**
	 * Shortcode: Contact Form
	 *
	 * @param string $content
	 * @param array $atts Shortcode attributes
	 * @return string Output html
	 * author: quan
	 */
 function magee_contact_shortcode($atts,$content=NULL){
   extract( shortcode_atts( array(
  'css_class'   => '',
  'email'=> get_option( 'admin_email' ),
  'style' => '1'
  ), $atts ) );
   $return = "";
 
  switch($style){
	  case "1":
 $return = '<form action="'.esc_url(home_url('/')).'" class="magee-shortcode contact-form style1 '.$css_class.'" method="post">
                                                <fieldset>
                                                    <section>
                                                        <label for="contact-name" class="sr-only">'.__("Name","magee").'</label>
                                                        <input type="text" name="contact-name" id="contact-name" placeholder="'.__("YOUR NAME","magee").'*" tabindex="1" required="required" aria-required="true">
                                                    </section>
                                                    <section>
                                                        <label for="contact-email" class="sr-only">'.__("Email","magee").'</label>
                                                        <input type="email" name="contact-email" id="contact-email" placeholder="'.__("YOUR E-MAIL","magee").'*" tabindex="2" required="required" aria-required="true">
                                                    </section>
                                                    <section>
                                                        <label for="contact-msg" class="sr-only">'.__("Message","magee").'</label>
                                                        <textarea name="contact-msg" id="contact-msg" cols="39" rows="5" tabindex="3" placeholder="'.__("YOUR MESSAGE","magee").'*"></textarea>
                                                    </section>
                                                </fieldset>
                                                <section>
												<span class="noticefailed"></span>
												    <input type="hidden" name="sendto" id="sendto" value="'.$email.'">
                                                    <input type="submit" value="'.__("SEND","magee").'" class="contact-submit btn-normal">
                                                </section>
                                            </form>';
 break;
 case "2":
 default:

 $return = '<form action="'.esc_url(home_url('/')).'" class="magee-shortcode contact-form style2 '.$css_class.'" method="post">
                                                <fieldset>
                                                    <section>
                                                        <label for="contact-name" class="sr-only">'.__("Name","magee").'</label>
                                                        <i class="fa fa-user fa-fw"></i>
                                                        <input type="text" name="contact-name" id="contact-name" placeholder="'.__("Your Name","magee").'" tabindex="1" required="required" aria-required="true">
                                                    </section>
                                                    <section>
                                                        <label for="contact-email" class="sr-only">'.__("Email","magee").'</label>
                                                        <i class="fa fa-envelope fa-fw"></i>
                                                        <input type="email" name="contact-email" id="contact-email" placeholder="'.__("Your Email","magee").'" tabindex="2" required="required" aria-required="true">
                                                    </section>
                                                    <section>
                                                        <label for="contact-msg" class="sr-only">'.__("Message","magee").'</label>
                                                        <textarea name="contact-msg" id="contact-msg" cols="39" rows="5" tabindex="3" placeholder="'.__("Message","magee").'"></textarea>
                                                    </section>
                                                </fieldset>
                                                <section>
												<span class="noticefailed"></span>
												    <input type="hidden" name="sendto" id="sendto" value="'.$email.'">
                                                    <input type="submit" value="'.__("SEND","magee").'" class="contact-submit btn-normal">
                                                </section>
                                            </form>';
											break;
  }

	 return $return ;	
							
 }
 
 
    /**
	 * Shortcode: image
	 *
	 * @param string $content
	 * @param array $atts Shortcode attributes
	 * @return string Output html
	 * author: quan
	 */
 function magee_image_shortcode($atts,$content=NULL){
   extract( shortcode_atts( array(
  'css_class' => '',
  'align' => '',
  'src' => '',
  'width' => '',
  'height' => ''
  ), $atts ) );
 $width  = str_replace("px","",$width);
 $height = str_replace("px","",$height);
 $css_style = "";
 if( is_numeric($width) ){
	 $css_style .= "width:".$width."px;";
	 }
  if( is_numeric($height) ){
	 $css_style .= "height:".$height."px;";
	 }
 
 $return = '<div class="magee-shortcode portfolio-img-box '.$align.' '.$css_class.'" style="'.$css_style.'">
                            <img src="'.esc_url($src).'">
                                                <div class="portfolio-info-box">
                                                    <div class="portfolio-icon-box">
                                                        <a href="'.esc_url($src).'" rel="portfolio-image"><i class="fa fa-search"></i></a>
                                                    </div>
                                                </div>
                                            </div>';
							
	 return $return ;	
							
 }
 
 /**
	 * Shortcode: slider
	 *
	 * @param string $content
	 * @param array $atts Shortcode attributes
	 * @return string Output html
	 * author: quan
	 */
 function magee_slider_shortcode($atts,$content=NULL){
   extract( shortcode_atts( array(
  'css_class' => '',
  'id' => ''
  ), $atts ) );
	
		$sliderContent = array();
		if(isset($id) && is_numeric($id)){
		$custom = get_post_custom($id);
	
		if(isset($custom["magee_custom_slider"][0]) && $custom["magee_custom_slider"][0] !="")
	    $sliderContent = unserialize( base64_decode($custom["magee_custom_slider"][0]) );
		}
       $slider_id  = uniqid( 'magee-slider-' );
	   $return     = "";
	   $indicators = "";
	   $items      = "";
		
		if ( is_array($sliderContent) && count($sliderContent) > 0 ) {
		$return .= '<div id="'.$slider_id.'" class="magee-shortcode carousel slide magee-slider '.$css_class.'" data-ride="carousel">';
		$i       = 0;
				foreach ( $sliderContent as $slide ) {
					$active = "";
					if($i == 0) $active = "active";
					$image       = wp_get_attachment_image_src( $slide['id'] , "full");
					$indicators .= '<li data-target="#'.$slider_id.'" data-slide-to="'.$i.'" class="'.$active.'"></li>';
					
					$items      .= '<div class="item '.$active.'"><img src="'.$image[0].'" alt="'.$slide['title'].'" /><div class="carousel-caption">'.do_shortcode( magee_fix_shortcodes(stripslashes($slide['caption'])) ).'</div></div>';
					
					$i++;
				}

		$return .= '<ol class="carousel-indicators">'.$indicators.'</ol>';
		$return .= '<div class="carousel-inner">'.$items.'</div>';
		$return .= '<a class="left carousel-control" href="#'.$slider_id.'" data-slide="prev">';
		$return .= '<span class="fa fa-angle-left"></span>';
		$return .= '</a>';
		$return .= '<a class="right carousel-control" href="#'.$slider_id.'" data-slide="next">';
		$return .= '<span class="fa fa-angle-right"></span>';
		$return .= '</a>';
		$return .= '</div>';
		}
							
	 return $return ;	
							
 }
 
 /**
	 * Shortcode: tabs
	 *
	 * @param string $content
	 * @param array $atts Shortcode attributes
	 * @return string Output html
	 * author: quan
	 */
 function magee_tabs_shortcode($atts,$content=NULL){
   extract( shortcode_atts( array(
  'css_class'   => '',
  'style' => '1',
  'active'=> '1'
  ), $atts ) );
 $GLOBALS['tab_active']   = $active;
 $GLOBALS['tab_num']      = 0;
 $GLOBALS['tablist']      = '';
 $GLOBALS['pane']         = '';
 do_shortcode( magee_fix_shortcodes($content) );
 $css_class .= " style".$style;
 $return  = '<div class="magee-shortcode tab-box '.$css_class.'">';
 $return .= '<ul class="nav nav-tabs" role="tablist">';
 $return .= $GLOBALS['tablist'];
 $return .= '</ul>';
 $return .= '<div class="tab-content">';
 $return .= $GLOBALS['pane'];
 $return .= '</div>';
 $return .= '</div>';
 unset($GLOBALS['tab_active']);	
 unset($GLOBALS['tab_num']);	
 unset($GLOBALS['tablist']);	
 unset($GLOBALS['pane']);	

	 return $return ;	
							
 }
 function magee_tab_shortcode($atts,$content=NULL){
   extract( shortcode_atts( array(
  'css_class'   => '',
  'title' => '',
  'active' => ''
  ), $atts ) );
  $is_active = "" ;
  $is_active  = $GLOBALS['tab_active'];
  $num        = $GLOBALS['tab_num']+1;
  $GLOBALS['tab_num'] = $num ;
  
  if($active == "1" || $is_active == $num)
  {
  $is_active = "active" ;
  }
  $tab_id  = sanitize_title($title);
  $GLOBALS['tablist'] .= '<li class="'.$is_active.'"><a href="#'.$tab_id.'" role="tab" data-toggle="tab">'.$title.'</a></li>';
  $GLOBALS['pane']    .= '<div class="tab-pane '.$is_active.'" id="'.$tab_id.'">'.do_shortcode( magee_fix_shortcodes($content) ).'</div>';
				
 }
 
 
 /**
	 * Shortcode: buttons
	 *
	 * @param string $content
	 * @param array $atts Shortcode attributes
	 * @return string Output html
	 * author: quan
	 */
 function magee_button_shortcode($atts,$content=NULL){
   extract( shortcode_atts( array(
  'css_class'   => '',
  'icon' => '',
  'style'=>1,
  'type' =>''
  ), $atts ) );
 if(!$content) $content = "Button";
 if($icon !="") $icon = '<i class="fa '.$icon.'"></i>';
 if($type == "") 
 $btn_style  = 'btn-normal';
 else
 $btn_style  = 'btn btn-'.$type;
 
 $btn_style .= ' style'.$style.' '.$css_class;
 
 $return = '<button class="magee-shortcode '.$btn_style.'">'.$icon.$content.'</button>';
							
	 return $return ;	
							
 }
 
 /**
	 * Shortcode: portfolio filter
	 *
	 * @param string $content
	 * @param array $atts Shortcode attributes
	 * @return string Output html
	 * author: quan
	 */
 function magee_portfolio_filter_shortcode($atts,$content=NULL){
   extract( shortcode_atts( array(
  'css_class'   => '',
  'num'=>'9',
  'columns'=>'3',
  'filter'=>'1',
  'pagenav' => '0'
  ), $atts ) );
  global $paged;
   
  $return = '<div class="magee-shortcode portfolio-grid-wrapper">';
  $items  = '';
 $portfolio_terms = get_terms("portfolio-category");
 $count = count($portfolio_terms);
 if ( $count > 0 && $filter == '1'){ 
	$return .= '<nav id="filters" class="portfolio-filter text-center controls"><ul>'	;
	$return .= '<li class="filter active all" data-filter = "all"><a  href="javascript:;" title="">'.__("All","magee").'</a></li>';
foreach ( $portfolio_terms as $portfolio_term ) {
	$termname = $portfolio_term->slug;
    $return  .= '<li class="filter" data-filter = ".portfolio-'.$termname .'"><a href="javascript:;" >'.$portfolio_term->name.'</a></li>';
						}
	$return .= '</ul></nav>';
 }
  $return .= '<section class="portfolio-list-main" role="main">';
  $term_slug = isset($term->slug)?$term->slug:"";
  if(!is_numeric($columns) || $columns<2 || $columns>4)
  $columns  = 4;
  $i        = 1;
  $col      = 12/$columns ;
  if(!$paged){$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;}
 
  $query = new WP_Query('post_type=portfolio&paged='.$paged.'&orderby=menu_order&post_status=publish&posts_per_page='.$num);
  
    if($query->have_posts() ):
	while ($query->have_posts() ) :
    $query->the_post();
	
	$postid            = get_the_ID();
	$permalink         = get_permalink();
	$title             = get_the_title();
	$image             = "";
	$term_list = wp_get_post_terms($postid, 'portfolio-category', array("fields" => "all"));
	
	 if (has_post_thumbnail( $postid) ): 
	$thumb = get_the_post_thumbnail( $postid , "portfolio-grid-thumb" ); 
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $postid ), 'large' );
	endif;
	
 $items  .= '<div class="mix  col-md-'.$col.' col-sm-6 '.$css_class.' portfolio-'.$term_list[0]->slug.'" data-category="portfolio-'.$term_list[0]->slug.'">
 
 <figure class="portfolio-list-box">
								'.$thumb.'
								<figcaption>
									<a href="'.$permalink.'"><h3>'.$title.'</h3></a>
									'.get_the_excerpt().'
								</figcaption>
							</figure>
</div>';
	 
     $i++ ;
		endwhile;
		endif;
		$return .=  $items.'<div class="clear"></div></section>';
		if($pagenav == "yes" || $pagenav == "1"){	
		$return .= '<div class="list-pagition text-center">'.magee_native_pagenavi("return",$query).'</div>';
		}
		$return .= '</div>';
		wp_reset_postdata();
	 return $return ;	
							
 }
 
 /**
	 * Shortcode: menu
	 *
	 * @param string $content
	 * @param array $atts Shortcode attributes
	 * @return string Output html
	 * author: quan
	 */
 function magee_menu_shortcode($atts,$content=NULL){
   extract( shortcode_atts( array(
  'css_class'   => '',
  'icon' => '',
  'style'=>1
  ), $atts ) );

	$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );

foreach ( $menus as $menu ) {
// this echoes a list of all the menus with a comma behind them...
echo $menu->name . ', ';
}

// Get the nav menu based on $menu_name (same as 'theme_location' or 'menu' arg to wp_nav_menu)
    // This code based on wp_nav_menu's code to get Menu ID from menu slug

    $menu_name = 'custom_menu_slug';

    if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
	$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );

	$menu_items = wp_get_nav_menu_items($menu->term_id);

	$menu_list = '<ul class="magee-shortcode" id="menu-' . $menu_name . '">';

	foreach ( (array) $menu_items as $key => $menu_item ) {
	    $title = $menu_item->title;
	    $url = $menu_item->url;
	    $menu_list .= '<li><a href="' . $url . '">' . $title . '</a></li>';
	}
	$menu_list .= '</ul>';
    } else {
	$menu_list = '<ul class="magee-shortcode "><li>Menu "' . $menu_name . '" not defined.</li></ul>';
    }
    // $menu_list now ready to output
	 return $return ;	
							
 }
 
 /**
	 * Shortcode: google gmap
	 *
	 * @param array $atts Shortcode attributes
	 * @return string Output html
	 * author: quan
	 */
	  
	 add_action( 'wp_enqueue_scripts', 'magee_gmap_scripts' );
       function magee_gmap_scripts() {
       wp_enqueue_script( 'magee-google-map', '//maps.google.com/maps/api/js?sensor=false', null, '' );   
    }

	function magee_gmap_shortcode($atts) {
 
	extract(shortcode_atts(array(
									'lat'   => '0', 
									'lon'    => '0',
									'id' => 'map',
									'zoom' => '1',
									'width' => '400',
									'height' => '300',
									'maptype' => 'ROADMAP',
									'address' => '',
									'kml' => '',
									'kmlautofit' => 'yes',
									'marker' => '',
									'markerimage' => '',
									'traffic' => 'no',
									'bike' => 'no',
									'fusion' => '',
									'start' => '',
									'end' => '',
									'infowindow' => '',
									'infowindowdefault' => 'yes',
									'directions' => '',
									'hidecontrols' => 'false',
									'scale' => 'false',
									'scrollwheel' => 'true',
									'radius' => ''
									
									), $atts));
									
    if(is_numeric($width)){ $container_width = $width."px";}else{ $container_width = $width;}
	if(is_numeric($radius)){$radius = "border-radius:".$radius."px;";}
	 
	 
	$return = '<div class="magee-shortcode " id="' .$id . '" style="width:' . $container_width  . ';height:' . $height . 'px;'.$radius.'"></div>';
	
	//directions panel
	if($start != '' && $end != '') 
	{
		//$panelwidth = $width-20;
		$return .= '
		<div id="directionsPanel" style="width:' . $container_width . ';height:' . $height . 'px;border:1px solid gray;padding:10px;overflow:auto;"></div><br>
		';
	}

	$return .= '
       <script type="text/javascript">

		var latlng = new google.maps.LatLng(' . $lat . ', ' . $lon . ');
		var myOptions = {
			zoom: ' . $zoom . ',
			center: latlng,
			scrollwheel: ' . $scrollwheel .',
			scaleControl: ' . $scale .',
			disableDefaultUI: ' . $hidecontrols .',
			mapTypeId: google.maps.MapTypeId.' . $maptype . '
		};
		var ' . $id . ' = new google.maps.Map(document.getElementById("' . $id . '"),
		myOptions);
		';
				
		//kml
		if($kml != '') 
		{
			if($kmlautofit == 'no') 
			{
				$return .= '
				var kmlLayerOptions = {preserveViewport:true};
				';
			}
			else
			{
				$return .= '
				var kmlLayerOptions = {preserveViewport:false};
				';
			}
			$return .= '
			var kmllayer = new google.maps.KmlLayer(\'' . html_entity_decode($kml) . '\',kmlLayerOptions);
			kmllayer.setMap(' . $id . ');
			';
		}

		//directions
		if($start != '' && $end != '') 
		{
			$return .= '
			var directionDisplay;
			var directionsService = new google.maps.DirectionsService();
		    directionsDisplay = new google.maps.DirectionsRenderer();
		    directionsDisplay.setMap(' . $id . ');
    		directionsDisplay.setPanel(document.getElementById("directionsPanel"));

				var start = \'' . $start . '\';
				var end = \'' . $end . '\';
				var request = {
					origin:start, 
					destination:end,
					travelMode: google.maps.DirectionsTravelMode.DRIVING
				};
				directionsService.route(request, function(response, status) {
					if (status == google.maps.DirectionsStatus.OK) {
						directionsDisplay.setDirections(response);
					}
				});
			';
		}
		
		//traffic
		if($traffic == 'yes')
		{
			$return .= '
			var trafficLayer = new google.maps.TrafficLayer();
			trafficLayer.setMap(' . $id . ');
			';
		}
	
		//bike
		if($bike == 'yes')
		{
			$return .= '			
			var bikeLayer = new google.maps.BicyclingLayer();
			bikeLayer.setMap(' . $id . ');
			';
		}
		
		//fusion tables
		if($fusion != '')
		{
			$return .= '			
			var fusionLayer = new google.maps.FusionTablesLayer(' . $fusion. ');
			fusionLayer.setMap(' . $id . ');
			';
		}
	
		//address
		if($address != '')
		{
			$return .= '
		    var geocoder_' . $id . ' = new google.maps.Geocoder();
			var address = \'' . $address . '\';
			geocoder_' . $id . '.geocode( { \'address\': address}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					' . $id . '.setCenter(results[0].geometry.location);
					';
					
					if ($marker !='')
					{
						//add custom image
						if ($markerimage !='')
						{
							$return .= 'var image = "'. $markerimage .'";';
						}
						$return .= '
						var marker = new google.maps.Marker({
							map: ' . $id . ', 
							';
							if ($markerimage !='')
							{
								$return .= 'icon: image,';
							}
						$return .= '
							position: ' . $id . '.getCenter()
						});
						';

						//infowindow
						if($infowindow != '') 
						{
							//first convert and decode html chars
							$thiscontent = htmlspecialchars_decode($infowindow);
							$return .= '
							var contentString = \'' . $thiscontent . '\';
							var infowindow = new google.maps.InfoWindow({
								content: contentString
							});
										
							google.maps.event.addListener(marker, \'click\', function() {
							  infowindow.open(' . $id . ',marker);
							});
							';

							//infowindow default
							if ($infowindowdefault == 'yes')
							{
								$return .= '
									infowindow.open(' . $id . ',marker);
								';
							}
						}
					}
			$return .= '
				} else {
				alert("Geocode was not successful for the following reason: " + status);
			}
			});
			';
		}

		//marker: show if address is not specified
		if ($marker != '' && $marker != 'no' && $marker != '0' && $address == '')
		{
			//add custom image
			if ($markerimage !='')
			{
				$return .= 'var image = "'. $markerimage .'";';
			}

			$return .= '
				var marker = new google.maps.Marker({
				map: ' . $id . ', 
				';
				if ($markerimage !='')
				{
					$return .= 'icon: image,';
				}
			$return .= '
				position: ' . $id . '.getCenter()
			});
			';

			//infowindow
			if($infowindow != '') 
			{
				$return .= '
				var contentString = \'' . $infowindow . '\';
				var infowindow = new google.maps.InfoWindow({
					content: contentString
				});
							
				google.maps.event.addListener(marker, \'click\', function() {
				  infowindow.open(' . $id. ',marker);
				});
				';
				//infowindow default
				if ($infowindowdefault == 'yes')
				{
					$return .= '
						infowindow.open(' . $id . ',marker);
					';
				}				
			}
		}

		$return .= '</script>';
		
		return $return;
  }
  
   /**
	 * Shortcode: background video
	 *
	 * @param array $atts Shortcode attributes
	 * @return string Output html
	 * author: quan
	 */ 
  
  function magee_background_video_shortcode($atts,$content=NULL){
	  extract( shortcode_atts( array(  'css_class' => '',  'video_id' => ''  ), $atts ) );
	  $wrapperId = "video-wrapper-".substr(md5(uniqid ("video-wrapper-", true)),0,5);
	  $playerid  = "video-playerid-".substr(md5(uniqid ("video-playerid-", true)),0,5);
	  $return = '<div id="'.$wrapperId.'" class="magee-shortcode magee-background-video">'.do_shortcode( magee_fix_shortcodes($content) ).'</div>';
	  
	  $background_video  = array("videoId"=>$video_id, "start"=>3,"width"=>"100%" ,"container" =>"div#".$wrapperId,"playerid"=>$playerid);	
	  $video_array[]  =  array("options"=>$background_video,  "video_item"=>"div#".$wrapperId );
	  
	  if($video_id !="" ){
         wp_localize_script( 'magee-tubular', 'magee_bigvideo',$video_array);
  
		}
	  return $return;
	  }
	
	 /**
	 * Shortcode: box
	 *
	 * @param array $atts Shortcode attributes
	 * @return string Output html
	 * author: quan
	 */ 
	  
  function magee_box_shortcode($atts,$content=NULL){
	 extract( shortcode_atts( array(  'css_class' => '',  'color' => '#fff','background_color'=>'rgba(0, 0, 0, 0.5)' ,'padding'=>'10px','width'=>'100%' ), $atts ) );
	 $css_style = 'color:'.$color.';background-color:'.$background_color.';padding:'.$padding.';width:'.$width.';';
		  return '<div class="magee-shortcode magee-box '.$css_class.'" style="'.$css_style.'">'.do_shortcode( magee_fix_shortcodes($content) ).'</div>';
		  }
		  
		  
    /**
	 * Shortcode: align
	 *
	 * @param array $atts Shortcode attributes
	 * @return string Output html
	 * author: quan
	 */ 
	 function magee_align_shortcode($atts,$content=NULL){
	 extract( shortcode_atts( array(
	  'align' =>'left',
	  'css_class'   => ''
	  ), $atts ) );
	  $return = '<div class="magee-shortcode align-'.$align.' '.$css_class.'" style="width:100%;">'.do_shortcode(magee_fix_shortcodes( $content) ).'</div>';
	 
	 return $return;
	 }
	 