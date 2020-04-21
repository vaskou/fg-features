<?php

defined( 'ABSPATH' ) or die();

class FG_Features {

	private static $instance = null;

	public static function getInstance() {
		if ( self::$instance == null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function init() {
		FG_Features_Dependencies::getInstance()->init();
		FG_Features_Post_Type::getInstance()->init();
		FG_Features_CMB2_Field_Dropdown::get_instance();
	}
}