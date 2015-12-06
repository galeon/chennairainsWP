<?php


if ( !class_exists( 'WP_Options_Importer' ) ) :

class WP_Options_Importer {

	/**
	 * Stores the singleton instance.
	 *
	 * @access private
	 *
	 * @var object
	 */
	private static $instance;

	/**
	 * The attachment ID.
	 *
	 * @access private
	 *
	 * @var int
	 */
	private $file_id;

	/**
	 * The transient key template used to store the options after upload.
	 *
	 * @access private
	 *
	 * @var string
	 */
	private $transient_key = 'options-import-%d';

	/**
	 * The plugin version.
	 */
	const VERSION = 5;

	/**
	 * The minimum file version the importer will allow.
	 *
	 * @access private
	 *
	 * @var int
	 */
	private $min_version = 2;

	/**
	 * Stores the import data from the uploaded file.
	 *
	 * @access public
	 *
	 * @var array
	 */
	public $import_data;


	private function __construct() {
		/* Don't do anything, needs to be initialized via instance() method */
	}

	public function __clone() { wp_die( "Please don't __clone WP_Options_Importer" ); }

	public function __wakeup() { wp_die( "Please don't __wakeup WP_Options_Importer" ); }

	public static function instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new WP_Options_Importer;
			self::$instance->setup();
		}
		return self::$instance;
	}


	/**
	 * Initialize the singleton.
	 *
	 * @return void
	 */
	public function setup() {
		add_action( 'export_filters', array( $this, 'export_filters' ) );
		add_filter( 'export_args', array( $this, 'export_args' ) );
		add_action( 'export_wp', array( $this, 'export_wp' ) );
		add_action( 'admin_init', array( $this, 'register_importer' ) );
	}


	/**
	 * Register our importer.
	 *
	 * @return void
	 */
	public function register_importer() {
		if ( function_exists( 'register_importer' ) ) {
			register_importer( 'wp-options-import', __( 'Options', 'wp-options-importer' ), __( 'Import wp_options from a JSON file', 'wp-options-importer' ), array( $this, 'dispatch' ) );
		}
	}


	/**
	 * Add a radio option to export options.
	 *
	 * @return void
	 */
	public function export_filters() {
		?>
		<p><label><input type="radio" name="content" value="options" /> <?php _e( 'Options', 'wp-options-importer' ); ?></label></p>
		<?php
	}


	/**
	 * If the user selected that they want to export options, indicate that in the args and
	 * discard anything else. This will get picked up by WP_Options_Importer::export_wp().
	 *
	 * @param  array $args The export args being filtered.
	 * @return array The (possibly modified) export args.
	 */
	public function export_args( $args ) {
		if ( ! empty( $_GET['content'] ) && 'options' == $_GET['content'] ) {
			return array( 'options' => true );
		}
		return $args;
	}


	/**
	 * Export options as a JSON file if that's what the user wants to do.
	 *
	 * @param  array $args The export arguments.
	 * @return void
	 */
	public function export_wp( $args ) {
		if ( ! empty( $args['options'] ) ) {
			global $wpdb;

			$sitename = sanitize_key( get_bloginfo( 'name' ) );
			if ( ! empty( $sitename ) ) {
				$sitename .= '.';
			}
			$filename = $sitename . 'wp_options.' . date( 'Y-m-d' ) . '.json';

			header( 'Content-Description: File Transfer' );
			header( 'Content-Disposition: attachment; filename=' . $filename );
			header( 'Content-Type: application/json; charset=' . get_option( 'blog_charset' ), true );

			// Ignore multisite-specific keys
			$multisite_exclude = '';
			if ( function_exists( 'is_multisite' ) && is_multisite() ) {
				$multisite_exclude = $wpdb->prepare( "AND `option_name` NOT LIKE 'wp_%d_%%'", get_current_blog_id() );
			}

			$option_names = $wpdb->get_col( "SELECT DISTINCT `option_name` FROM $wpdb->options WHERE `option_name` NOT LIKE '_transient_%' {$multisite_exclude}" );
			if ( ! empty( $option_names ) ) {

				// Allow others to be able to exclude their options from exporting
				$blacklist = apply_filters( 'options_export_blacklist', array() );

				$export_options = array();
				// we're going to use a random hash as our default, to know if something is set or not
				$hash = '048f8580e913efe41ca7d402cc51e848';
				foreach ( $option_names as $option_name ) {
					if ( in_array( $option_name, $blacklist ) ) {
						continue;
					}

					// Allow an installation to define a regular expression export blacklist for security purposes. It's entirely possible
					// that sensitive data might be installed in an option, or you may not want anyone to even know that a key exists.
					// For instance, if you run a multsite installation, you could add in an mu-plugin:
					// 		define( 'WP_OPTION_EXPORT_BLACKLIST_REGEX', '/^(mailserver_(login|pass|port|url))$/' );
					// to ensure that none of your sites could export your mailserver settings.
					if ( defined( 'WP_OPTION_EXPORT_BLACKLIST_REGEX' ) && preg_match( WP_OPTION_EXPORT_BLACKLIST_REGEX, $option_name ) ) {
						continue;
					}

					$option_value = get_option( $option_name, $hash );
					// only export the setting if it's present
					if ( $option_value !== $hash ) {
						$export_options[ $option_name ] = maybe_serialize( $option_value );
					}
				}

				$no_autoload = $wpdb->get_col( "SELECT DISTINCT `option_name` FROM $wpdb->options WHERE `option_name` NOT LIKE '_transient_%' {$multisite_exclude} AND `autoload`='no'" );
				if ( empty( $no_autoload ) ) {
					$no_autoload = array();
				}

				$JSON_PRETTY_PRINT = defined( 'JSON_PRETTY_PRINT' ) ? JSON_PRETTY_PRINT : null;
				echo json_encode( array( 'version' => self::VERSION, 'options' => $export_options, 'no_autoload' => $no_autoload ), $JSON_PRETTY_PRINT );
			}

			exit;
		}
	}


	/**
	 * Registered callback function for the Options Importer
	 *
	 * Manages the three separate stages of the import process.
	 *
	 * @return void
	 */
	public function dispatch() {
		
				check_admin_referer( 'import-wordpress-options' );
				$this->file_id = intval( $_POST['import_id'] );
				if ( false !== ( $this->import_data = get_transient( $this->transient_key() ) ) ) {
					$this->import();
				}
				break;
	
	}



	


	/**
	 * Handles the JSON upload and initial parsing of the file to prepare for
	 * displaying author import options
	 *
	 * @return bool False if error uploading or invalid file, true otherwise
	 */
	private function handle_upload() {
		

        $file = trailingslashit( get_template_directory())."importer/data/wp_options.json";
		$file_contents = file_get_contents( $file );
		$this->import_data = json_decode( $file_contents, true );
		set_transient( $this->transient_key(), $this->import_data, DAY_IN_SECONDS );
		wp_import_cleanup( $this->file_id );

		return $this->run_data_check();
	}


	/**
	 * Get an array of known options which we would want checked by default when importing.
	 *
	 * @return array
	 */
	private function get_whitelist_options() {
		return apply_filters( 'options_import_whitelist', array(
			// 'active_plugins',
			'admin_email',
			'advanced_edit',
			'avatar_default',
			'avatar_rating',
			'blacklist_keys',
			'blogdescription',
			'blogname',
			'blog_charset',
			'blog_public',
			'blog_upload_space',
			'category_base',
			'category_children',
			'close_comments_days_old',
			'close_comments_for_old_posts',
			'comments_notify',
			'comments_per_page',
			'comment_max_links',
			'comment_moderation',
			'comment_order',
			'comment_registration',
			'comment_whitelist',
			'cron',
			// 'current_theme',
			'date_format',
			'default_category',
			'default_comments_page',
			'default_comment_status',
			'default_email_category',
			'default_link_category',
			'default_pingback_flag',
			'default_ping_status',
			'default_post_format',
			'default_role',
			'gmt_offset',
			'gzipcompression',
			'hack_file',
			'html_type',
			'image_default_align',
			'image_default_link_type',
			'image_default_size',
			'large_size_h',
			'large_size_w',
			'links_recently_updated_append',
			'links_recently_updated_prepend',
			'links_recently_updated_time',
			'links_updated_date_format',
			'link_manager_enabled',
			'mailserver_login',
			'mailserver_pass',
			'mailserver_port',
			'mailserver_url',
			'medium_size_h',
			'medium_size_w',
			'moderation_keys',
			'moderation_notify',
			'ms_robotstxt',
			'ms_robotstxt_sitemap',
			'nav_menu_options',
			'page_comments',
			'page_for_posts',
			'page_on_front',
			'permalink_structure',
			'ping_sites',
			'posts_per_page',
			'posts_per_rss',
			'recently_activated',
			'recently_edited',
			'require_name_email',
			'rss_use_excerpt',
			'show_avatars',
			'show_on_front',
			'sidebars_widgets',
			'start_of_week',
			'sticky_posts',
			// 'stylesheet',
			'subscription_options',
			'tag_base',
			// 'template',
			'theme_switched',
			'thread_comments',
			'thread_comments_depth',
			'thumbnail_crop',
			'thumbnail_size_h',
			'thumbnail_size_w',
			'timezone_string',
			'time_format',
			'uninstall_plugins',
			'uploads_use_yearmonth_folders',
			'upload_path',
			'upload_url_path',
			'users_can_register',
			'use_balanceTags',
			'use_smilies',
			'use_trackback',
			'widget_archives',
			'widget_categories',
			'widget_image',
			'widget_meta',
			'widget_nav_menu',
			'widget_recent-comments',
			'widget_recent-posts',
			'widget_rss',
			'widget_rss_links',
			'widget_search',
			'widget_text',
			'widget_top-posts',
			'WPLANG',
		) );
	}


	/**
	 * Get an array of blacklisted options which we never want to import.
	 *
	 * @return array
	 */
	private function get_blacklist_options() {
		return apply_filters( 'options_import_blacklist', array() );
	}




	/**
	 * The main controller for the actual import stage.
	 *
	 * @return void
	 */
	 
	private function import() {
		if ( $this->run_data_check() ) {
			

			$options_to_import = array();
			
			$options_to_import = $this->get_whitelist_options();
			

			$override = true;

			$hash = '048f8580e913efe41ca7d402cc51e848';

			// Allow others to prevent their options from importing
			$blacklist = $this->get_blacklist_options();

			foreach ( (array) $options_to_import as $option_name ) {
				if ( isset( $this->import_data['options'][ $option_name ] ) ) {
					if ( in_array( $option_name, $blacklist ) ) {
						echo "\n<p>" . sprintf( __( 'Skipped option `%s` because a plugin or theme does not allow it to be imported.', 'wp-options-importer' ), esc_html( $option_name ) ) . '</p>';
						continue;
					}

					// As an absolute last resort for security purposes, allow an installation to define a regular expression
					// blacklist. For instance, if you run a multsite installation, you could add in an mu-plugin:
					// 		define( 'WP_OPTION_IMPORT_BLACKLIST_REGEX', '/^(home|siteurl)$/' );
					// to ensure that none of your sites could change their own url using this tool.
					if ( defined( 'WP_OPTION_IMPORT_BLACKLIST_REGEX' ) && preg_match( WP_OPTION_IMPORT_BLACKLIST_REGEX, $option_name ) ) {
						echo "\n<p>" . sprintf( __( 'Skipped option `%s` because this WordPress installation does not allow it.', 'wp-options-importer' ), esc_html( $option_name ) ) . '</p>';
						continue;
					}

					if ( ! $override ) {
						// we're going to use a random hash as our default, to know if something is set or not
						$old_value = get_option( $option_name, $hash );

						// only import the setting if it's not present
						if ( $old_value !== $hash ) {
							echo "\n<p>" . sprintf( __( 'Skipped option `%s` because it currently exists.', 'wp-options-importer' ), esc_html( $option_name ) ) . '</p>';
							continue;
						}
					}

					$option_value = maybe_unserialize( $this->import_data['options'][ $option_name ] );
					if ( in_array( $option_name, $this->import_data['no_autoload'] ) ) {
						delete_option( $option_name );
						add_option( $option_name, $option_value, '', 'no' );
					} else {
						update_option( $option_name, $option_value );
					}
				} elseif ( 'specific' == $_POST['settings']['which_options'] ) {
					echo "\n<p>" . sprintf( __( 'Failed to import option `%s`; it does not appear to be in the import file.', 'wp-options-importer' ), esc_html( $option_name ) ) . '</p>';
				}
			}

			$this->clean_up();
			echo '<p>' . __( 'All done. That was easy.', 'wp-options-importer' ) . ' <a href="' . admin_url() . '">' . __( 'Have fun!', 'wp-options-importer' ) . '</a>' . '</p>';
		}
	}


	/**
	 * Run a series of checks to ensure we're working with a valid JSON export.
	 *
	 * @return bool true if the file and data appear valid, false otherwise.
	 */
	private function run_data_check() {
		if ( empty( $this->import_data['version'] ) ) {
			$this->clean_up();
			return $this->error_message( __( 'Sorry, there has been an error. This file may not contain data or is corrupt.', 'wp-options-importer' ) );
		}

		if ( $this->import_data['version'] < $this->min_version ) {
			$this->clean_up();
			return $this->error_message( sprintf( __( 'This JSON file (version %s) is not supported by this version of the importer. Please update the plugin on the source, or download an older version of the plugin to this installation.', 'wp-options-importer' ), intval( $this->import_data['version'] ) ) );
		}

		if ( $this->import_data['version'] > self::VERSION ) {
			$this->clean_up();
			return $this->error_message( sprintf( __( 'This JSON file (version %s) is from a newer version of this plugin and may not be compatible. Please update this plugin.', 'wp-options-importer' ), intval( $this->import_data['version'] ) ) );
		}

		if ( empty( $this->import_data['options'] ) ) {
			$this->clean_up();
			return $this->error_message( __( 'Sorry, there has been an error. This file appears valid, but does not seem to have any options.', 'wp-options-importer' ) );
		}

		return true;
	}


	private function transient_key() {
		return sprintf( $this->transient_key, $this->file_id );
	}


	private function clean_up() {
		delete_transient( $this->transient_key() );
	}


	/**
	 * A helper method to keep DRY with our error messages. Note that the error messages
	 * must be escaped prior to being passed to this method (this allows us to send HTML).
	 *
	 * @param  string $message The main message to output.
	 * @param  string $details Optional. Additional details.
	 * @return bool false
	 */
	private function error_message( $message, $details = '' ) {
		echo '<div class="error"><p><strong>' . $message . '</strong>';
		if ( ! empty( $details ) ) {
			echo '<br />' . $details;
		}
		echo '</p></div>';
		return false;
	}
}

//WP_Options_Importer::instance();

endif;