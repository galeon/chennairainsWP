<?php
 	/*	
	*	mageewp Portfolio Options
	*	---------------------------------------------------------------------
	* 	@author		magee
	* 	@link		http://www.mageewp.com
	* 	@copyright	Copyright (c) mageewp.com
	*	---------------------------------------------------------------------
	*/
		
 add_action('init', 'magee_portfolio_register');
 function magee_portfolio_register() {

 $portfolio_slug = ot_get_option('portfolio_slug');
 $portfolio_slug = $portfolio_slug ? $portfolio_slug:"portfolio";
	$labels = array(
		'name' => 'Portfolios',
		'singular_name' => __('Portfolio', 'Portfolio Singular Name', 'magee'),
		'add_new_item' => 'Add New Portfolio',
		'edit_item' => __('Edit Portfolio', 'magee'),
		'new_item' => __('New Portfolio', 'magee'),
		'view_item' => 'View Portfolio',
		'all_items' => 'All Portfolios',
		'search_items' => __('Search Portfolio', 'magee'),
		'not_found' =>  __('Nothing found', 'magee'),
		'not_found_in_trash' => __('Nothing found in Trash', 'magee'),
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'show_ui' => true,
		'publicly_queryable' => true,
		'query_var' => true,
		'rewrite' => true,
		'menu_icon' => MAGEE_THEME_BASE_URL.'/images/admin-portfolio-icon.png',
		'can_export' => true,
		'exclude_from_search' => false,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 7,
		'rewrite' => array('slug' =>$portfolio_slug, 'with_front' => false),
		'supports' => array('title','editor','thumbnail','excerpt','page-attributes')
	  ); 
 	   
	register_post_type( 'portfolio' , $args );
   }
		register_taxonomy(
			"portfolio-category", array("portfolio"), array(
				"hierarchical" => true,
				"label" => __("Portfolio Categories",'magee'), 
				"singular_label" => __("Portfolio Categories",'magee'), 
				"rewrite" => true));
		register_taxonomy_for_object_type('portfolio-category', 'portfolio');
		register_taxonomy(
			"portfolio-tag", array("portfolio"), array(
				"hierarchical" => false, 
				"label" => __("Portfolio Tags","magee"), 
				"singular_label" => __("Portfolio Tags","magee"), 
				"rewrite" => true));
				
    register_taxonomy_for_object_type('portfolio-tag', 'portfolio');
		
	
	add_filter("manage_edit-portfolio_columns", "show_portfolio_column");	
	function show_portfolio_column($columns){
		$columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => __("Title",'magee'),
			"portfolio-tags" => __("Portfolio Tags","magee"),
			"portfolio-category" => __("Portfolio Categories",'magee'),
			"date" => "date");
		return $columns;
	}
	add_action("manage_posts_custom_column","portfolio_custom_columns");
	function portfolio_custom_columns($column){
		global $post;

		switch ($column) {
			case "portfolio-tags":
			echo get_the_term_list($post->ID, 'portfolio-tag', '', ', ','');
			break;
			case "portfolio-category":
			echo get_the_term_list($post->ID, 'portfolio-category', '', ', ','');
			break;
		}
	}	
	
				