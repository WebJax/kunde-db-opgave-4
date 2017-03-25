<?php

/**
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           kdtof
 *
 * @wordpress-plugin
 * Plugin Name:       Kunde DB til Opgave 4
 * Plugin URI:        https://github.com/WebJax/kunde-db-opgave-4
 * Description:       Oprettelse og anvendelse af en ekstern kunde database i Wordpress
 * Version:           1.0.0
 * Author:            Jacob Thygesen
 * Author URI:        http://jaxweb.dk/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       kdtof
 * Domain Path:       /languages
 */

// Hvis filen kaldes direkte stoppes der her
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Når plugin'et aktiveres
 */
function activate_kdtof() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-kdtof-activator.php';
	kdtof_Activator::activate();
}

/**
 * Når plugin'et deaktiveres og IKKE afinstalleres.
 */
function deactivate_kdtof() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-kdtof-deactivator.php';
	kdtof_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_kdtof' );
register_deactivation_hook( __FILE__, 'deactivate_kdtof' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-kdtof.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_kdtof() {

	$plugin = new kdtof();
	$plugin->run();

}
run_kdtof();
