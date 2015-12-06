<?php
defined( 'ABSPATH' ) or die( 'You cannot access this script directly' );

load_template( trailingslashit( get_template_directory() ) . 'importer/widgets-import.php' );

load_template( trailingslashit( get_template_directory() ) . 'importer/options-import.php' );

function magee_data_import(){
	global $wpdb ;
	set_time_limit(900);
	  if ( !defined('WP_LOAD_IMPORTERS') ) {
        define('WP_LOAD_IMPORTERS', true);
    }
	 if ( current_user_can( 'manage_options' ) ) {
  

    if ( ! class_exists( 'WP_Importer' ) ) { // if main importer class doesn't exist
            $wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
            include $wp_importer;
		
        }

        if ( ! class_exists('WP_Import') ) { // if WP importer doesn't exist
            $wp_import = get_template_directory() . '/importer/wordpress-importer.php';
            include $wp_import;
		
        }
	
		if ( class_exists( 'WP_Importer' ) && class_exists( 'WP_Import' ) ) {
			
			$importer = new WP_Import();
                /* Import Posts, Pages, Portfolio Content, FAQ, Images, Menus */
                $theme_xml = get_template_directory() . '/importer/data/magee.xml';
				
                $importer->fetch_attachments = true;
                ob_start();
                 $importer->import($theme_xml);
                ob_end_clean();
				
				
		}
		
	
			//import options
			 WP_Options_Importer::instance();
			 // import widgets
			 magee_upload_import_file();
			 
			     // Set reading options
            $homepage = get_page_by_title( 'Home' );
            $posts_page = get_page_by_title( 'Blog' );
            if(isset( $homepage ) && $homepage->ID && isset( $posts_page ) && $posts_page->ID) {
				update_option('page_on_front', $homepage->ID); // Front Page
                update_option('show_on_front', 'page');
                update_option('page_for_posts', $posts_page->ID); // Blog Page
            }
			
				   // Set imported menus to registered theme locations
            $locations = get_theme_mod( 'nav_menu_locations' ); // registered menu locations in theme
            $menus = wp_get_nav_menus(); // registered menus

            if($menus) {
       
                foreach($menus as $menu) { // assign menus to theme locations
                    if( $menu->name == 'Short' ) {
                        $locations['primary'] = $menu->term_id;
                    } else if( $menu->name == 'Top Menu' ) {
                        $locations['top_menu'] = $menu->term_id;
                    } 

                   
                }
            }

            set_theme_mod( 'nav_menu_locations', $locations ); // set menus to locations
			
			
	
         
			
	 }
		echo "<p>Done!</p>";
		exit(0);
}

   add_action('wp_ajax_magee_data_import', 'magee_data_import');
   add_action('wp_ajax_nopriv_magee_data_import', 'magee_data_import');