<?php

defined( 'ABSPATH' ) or die();

class FG_Features {

	private static $instance = null;

	public static function instance() {
		if ( self::$instance == null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * FG_Features constructor.
	 */
	private function __construct() {
		add_action( 'plugins_loaded', array( $this, 'on_plugins_loaded' ) );

		FG_Features_Dependencies::instance();
		FG_Features_Post_Type::instance();
		FG_Features_CMB2_Field_Dropdown::instance();
		FG_Features_Shortcodes::instance();
	}

	public function on_plugins_loaded() {
		load_plugin_textdomain( 'fg-features', false, FG_FEATURES_PLUGIN_DIR_NAME . '/languages/' );
	}

}