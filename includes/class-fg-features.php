<?php

defined( 'ABSPATH' ) or die();

class FG_Features {

	private static $instance = null;

	/**
	 * FG_Features constructor.
	 */
	private function __construct() {
		FG_Features_Dependencies::instance();
		FG_Features_Post_Type::instance();
		FG_Features_CMB2_Field_Dropdown::instance();
		FG_Features_Shortcodes::instance();
	}

	public static function instance() {
		if ( self::$instance == null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

}