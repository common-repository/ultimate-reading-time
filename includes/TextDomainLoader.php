<?php
/**
 * Class TextDomainLoader
 *
 * This class is responsible for loading the text domain for internationalization.
 *
 * @package UltimateReadingTime
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class URTBENZ_TextDomainLoader {

	/**
	 * Constructor
	 *
	 * Hooks the load_textdomain method into the plugins_loaded action.
	 */
	public function __construct() {
		add_action( 'plugins_loaded', [ $this, 'load_textdomain' ] );
	}

	/**
	 * Load Text Domain
	 *
	 * Loads the plugin's translated strings.
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 'ultimate-reading-time', false, plugin_dir_path( __FILE__ ) . 'languages' );
	}
}