<?php

defined( 'ABSPATH' ) or die();

class FG_Features_Shortcodes {

	const FEATURES_SHORTCODE_NAME = 'fg-features';

	private static $instance = null;

	public static function getInstance() {
		if ( self::$instance == null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function init() {
		add_action( 'init', array( $this, 'register_shortcodes' ) );
	}

	public function register_shortcodes() {
		add_shortcode( self::FEATURES_SHORTCODE_NAME, array( $this, 'features_shortcode' ) );
	}

	public function features_shortcode( $atts ) {

		$default = array(
			'is_shortcode' => true,
			'post__in'     => '',
		);

		$args = shortcode_atts( $default, $atts );

		$args['post__in'] = ! empty( $args['post__in'] ) ? explode( ',', $args['post__in'] ) : array();

		$query = FG_Features_Post_Type::getInstance()->get_query( $args );

		ob_start();

		if ( $query->have_posts() ) :
			while ( $query->have_posts() ) :
				$query->the_post();

				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;
		endif;
		wp_reset_postdata();

		$html = ob_get_clean();

		return $html;

	}
}