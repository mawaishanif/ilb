<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           Plugin_Name
 *
 * @wordpress-plugin
 * Plugin Name:       Inject Layout Builder
 * Plugin URI:        http://inject-themes.net/layout-builder
 * Description:       Visual drag and drop page builder containing great collection of animated shortcodes with paralax effects and video backgrounds
 * Version:           1.0.0
 * Author:            Inject Themes
 * Author URI:        http://injectThemes.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       Grime_Core
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define('ILB_DIR_URL', plugin_dir_url( __FILE__ ));

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-name-activator.php
 */
function activate_grime_core() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-grime-core-activator.php';
	// Required the activator file but done nothing with it maybe I can use in future. Lete see.
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function deactivate_plugin_name() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-grime-core-deactivator.php';
	// Required the de-activator file but done nothing with it maybe I can use in future. Lete see.
}

// Hooks for registering activate and deactivate funtion when activating the plugin.
// register_activation_hook( __FILE__, 'activate_grime_core' );
// register_deactivation_hook( __FILE__, 'deactivate_plugin_name' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-inject-layout-builder-core.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_plugin_name() {

	$plugin = new Inject_Layout_Builder_Core();
	$plugin->load_plugin_admin();
	$plugin->load_public();
}
run_plugin_name();

function play_button()
{
	echo '<p id="heyn">ha!</p><a id="play_button" href="#" class="button button-primary button-large">Play Button </a>';
}
add_action( 'edit_form_after_title','play_button',999 );