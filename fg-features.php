<?php

/**
 * @wordpress-plugin
 * Plugin Name:       FremeditiGuitars - Features
 * Description:       FremeditiGuitars - Features Post Type
 * Version:           1.0.0
 * Author:            Vasilis Koutsopoulos
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       fg-guitars
 * Domain Path:       /languages
 */

defined( 'ABSPATH' ) or die();

define( 'FG_FEATURES_VERSION', '1.0.0' );
define( 'FG_FEATURES_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'FG_FEATURES_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'FG_FEATURES_PLUGIN_DIR_NAME', basename( FG_FEATURES_PLUGIN_DIR_PATH ) );
define( 'FG_FEATURES_PLUGIN_URL', plugins_url( FG_FEATURES_PLUGIN_DIR_NAME ) );

include 'vendor/autoload.php';


