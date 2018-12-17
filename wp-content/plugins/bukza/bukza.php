<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://bukza.com
 * @since             2.0.0
 * @package           Bukza
 *
 * @wordpress-plugin
 * Plugin Name:       Bukza
 * Plugin URI:        https://bukza.com/blog/wordpress
 * Description:       Reservation plugin for the bukza.com service
 * Version:           2.0.0
 * Author:            Bukza
 * Author URI:        https://bukza.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       bukza
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 2.00 and use SemVer - https://semver.org
 */
define( 'BUKZA_VERSION', '2.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-bukza-activator.php
 */
function activate_bukza() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-bukza-activator.php';
	Bukza_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-bukza-deactivator.php
 */
function deactivate_bukza() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-bukza-deactivator.php';
	Bukza_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_bukza' );
register_deactivation_hook( __FILE__, 'deactivate_bukza' );


/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-bukza.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    2.0.0
 */
function run_bukza() {

	$bukza = new Bukza();
	$bukza->run();

}
run_bukza();
