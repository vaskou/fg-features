<?php

defined( 'ABSPATH' ) or die();

class FG_Features_Post_Type {

	const POST_TYPE_NAME = 'fg_features';
	const TAXONOMY_NAME = 'fg_features_cat';
	const SLUG = 'features';

	private static $instance = null;

	private function __construct() {
		add_action( 'init', array( $this, 'register_post_type' ) );
//		add_action( 'init', array( $this, 'register_taxonomy' ) );
//		add_action( 'cmb2_admin_init', array( $this, 'add_metaboxes' ) );
		add_action( 'pre_get_posts', array( $this, 'custom_query' ) );
	}

	public static function instance() {
		if ( self::$instance == null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function register_post_type() {
		$labels = array(
			'name'                  => _x( 'FG Features', 'FG Features General Name', 'fg-features' ),
			'singular_name'         => _x( 'FG Feature', 'FG Feature Singular Name', 'fg-features' ),
			'menu_name'             => __( 'FG Features', 'fg-features' ),
			'name_admin_bar'        => __( 'FG Features', 'fg-features' ),
			'archives'              => __( 'FG Feature Archives', 'fg-features' ),
			'attributes'            => __( 'FG Feature Attributes', 'fg-features' ),
			'parent_item_colon'     => __( 'Parent FG Feature:', 'fg-features' ),
			'all_items'             => __( 'All FG Features', 'fg-features' ),
			'add_new_item'          => __( 'Add New FG Feature', 'fg-features' ),
			'add_new'               => __( 'Add New', 'fg-features' ),
			'new_item'              => __( 'New FG Feature', 'fg-features' ),
			'edit_item'             => __( 'Edit FG Feature', 'fg-features' ),
			'update_item'           => __( 'Update FG Feature', 'fg-features' ),
			'view_item'             => __( 'View FG Feature', 'fg-features' ),
			'view_items'            => __( 'View FG Features', 'fg-features' ),
			'search_items'          => __( 'Search FG Feature', 'fg-features' ),
			'not_found'             => __( 'Not found', 'fg-features' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'fg-features' ),
			'featured_image'        => __( 'Featured Image', 'fg-features' ),
			'set_featured_image'    => __( 'Set Featured Image', 'fg-features' ),
			'remove_featured_image' => __( 'Remove Featured Image', 'fg-features' ),
			'use_featured_image'    => __( 'Use as Featured Image', 'fg-features' ),
			'insert_into_item'      => __( 'Insert into FG Feature', 'fg-features' ),
			'uploaded_to_this_item' => __( 'Uploaded to this FG Feature', 'fg-features' ),
			'items_list'            => __( 'FG Features list', 'fg-features' ),
			'items_list_navigation' => __( 'FG Features list navigation', 'fg-features' ),
			'filter_items_list'     => __( 'Filter FG Features list', 'fg-features' ),
		);

		$rewrite = array(
			'slug'       => self::SLUG,
			'with_front' => true,
			'pages'      => true,
			'feeds'      => true,
		);

		$args = array(
			'label'         => __( 'FG Feature', 'fg-features' ),
			'description'   => __( 'FG Feature Description', 'fg-features' ),
			'labels'        => $labels,
			'supports'      => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
			'taxonomies'    => array( self::TAXONOMY_NAME ),
			'hierarchical'  => false,
			'public'        => true,
			'show_ui'       => true,
			'menu_icon'     => 'dashicons-admin-post',
			'menu_position' => 30,
			'can_export'    => true,
			'rewrite'       => $rewrite,
			'map_meta_cap'  => true,
			'show_in_rest'  => false,
//			'has_archive'   => true,
		);
		register_post_type( self::POST_TYPE_NAME, $args );
	}

	public function register_taxonomy() {

		$labels = array(
			'name'              => __( 'FG Feature Categories', 'fg-features' ),
			'singular_name'     => __( 'FG Feature Category', 'fg-features' ),
			'search_items'      => __( 'Search FG Feature Categories', 'fg-features' ),
			'all_items'         => __( 'All FG Feature Categories', 'fg-features' ),
			'parent_item'       => __( 'Parent FG Feature Category', 'fg-features' ),
			'parent_item_colon' => __( 'Parent FG Feature Category:', 'fg-features' ),
			'edit_item'         => __( 'Edit FG Feature Category', 'fg-features' ),
			'update_item'       => __( 'Update FG Feature Category', 'fg-features' ),
			'add_new_item'      => __( 'Add New FG Feature Category', 'fg-features' ),
			'new_item_name'     => __( 'New FG Feature Category Name', 'fg-features' ),
			'menu_name'         => __( 'FG Feature Categories', 'fg-features' ),
		);
		$args   = array(
			'hierarchical'       => true, // make it hierarchical (like categories)
			'labels'             => $labels,
			'public'             => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_admin_column'  => true,
			'show_in_rest'       => true,
			'show_in_quick_edit' => false,
			'query_var'          => true,
			'meta_box_cb'        => 'post_categories_meta_box',
			'rewrite'            => true,
		);

		register_taxonomy( self::TAXONOMY_NAME, array( self::POST_TYPE_NAME ), $args );
	}

	/**
	 * @param $query WP_Query
	 */
	public function custom_query( $query ) {
		$is_shortcode = $query->get( 'is_shortcode' );
		$is_post_in   = $query->get( 'post__in' );

		if ( ! is_admin() && ( $query->is_main_query() || $is_shortcode ) ) {
			if ( self::POST_TYPE_NAME == $query->get( 'post_type' ) ) {
				$query->set( 'orderby', 'menu_order title' );
				$query->set( 'order', 'ASC' );
//				$query->set( 'suppress_filters', 'true' ); //wpml incompatible

				if ( ! empty( $is_post_in ) ) {
					$query->set( 'orderby', 'post__in' );
				}
			}
		}
	}

	/**
	 * @param $atts array
	 *
	 * @return WP_Query
	 */
	public function get_query( $atts = array() ) {
		return $this->_get_query( $atts );
	}

	/**
	 * @return int[]|WP_Post[]
	 */
	public function get_items() {
		return $this->_get_items();
	}


	/**
	 * @param $atts array
	 *
	 * @return WP_Query
	 */
	private function _get_query( $atts = array() ) {
		$default = array(
			'post_type'      => self::POST_TYPE_NAME,
			'post_status'    => 'publish',
			'posts_per_page' => - 1,
		);

		$args = wp_parse_args( $atts, $default );

		return new WP_Query( $args );
	}

	/**
	 * @return int[]|WP_Post[]
	 */
	private function _get_items() {
		$query = $this->_get_query();

		return $query->get_posts();
	}
}