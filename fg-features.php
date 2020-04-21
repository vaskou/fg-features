<?php

/**
 * @wordpress-plugin
 * Plugin Name:       FremeditiGuitars - Features
 * Description:       FremeditiGuitars - Features Post Type
 * Version:           1.0.0
 * Author:            Vasilis Koutsopoulos
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       fg-features
 * Domain Path:       /languages
 */

defined( 'ABSPATH' ) or die();

define( 'FG_FEATURES_VERSION', '1.0.0' );
define( 'FG_FEATURES_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'FG_FEATURES_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'FG_FEATURES_PLUGIN_DIR_NAME', basename( FG_FEATURES_PLUGIN_DIR_PATH ) );
define( 'FG_FEATURES_PLUGIN_URL', plugins_url( FG_FEATURES_PLUGIN_DIR_NAME ) );

include 'includes/class-fg-features.php';
include 'includes/class-fg-features-dependencies.php';
include 'includes/class-fg-features-post-type.php';

include 'includes/features-post-type-fields/abstract-class-fg-features-post-type-fields.php';

include 'includes/cmb2-custom-fields/class-fg-features-cmb2-field-dropdown.php';

FG_Features::getInstance()->init();

