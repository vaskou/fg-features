<?php

defined( 'ABSPATH' ) or die();

class FG_Features_CMB2_Field_Dropdown {

	private $field_type;

	private static $instance;

	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct() {
		$this->field_type = 'fg_features_cmb2_field_dropdown';
		add_action( "cmb2_render_{$this->field_type}", array( $this, 'render' ), 10, 5 );
//		add_action( "cmb2_sanitize_{$this->field_type}", array( $this, 'sanitize' ), 10, 2 );
//		add_action( "cmb2_types_esc_{$this->field_type}", array( $this, 'escape_value' ), 10, 2 );
	}

	/**
	 * @param $field         CMB2_Field
	 * @param $escaped_value mixed
	 * @param $object_id     int
	 * @param $object_type   string
	 * @param $field_type    CMB2_Types
	 */
	public function render( $field, $escaped_value, $object_id, $object_type, $field_type ) {

		$features = FG_Features_Post_Type::instance()->get_items();
		
		$options = array( __( 'None', 'fg-features' ) );

		foreach ( $features as $feature ) {
			$options[ $feature->ID ] = $feature->post_title;
		}

		$field->args['options'] = $options;

		$args = array(
			'class'   => 'cmb2_select',
			'name'    => $field_type->_name(),
			'id'      => $field_type->_id(),
			'desc'    => $field_type->_desc( true ),
			'options' => $field_type->concat_items(),
		);

		echo $field_type->select( $args );

	}

}