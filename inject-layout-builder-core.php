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
 * @package           Inject Layout Builder
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
 * Text Domain:       inject_layout_builder
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
function activate_inject_layout_builder() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-grime-core-activator.php';
	// Required the activator file but done nothing with it maybe I can use in future. Lete see.
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function deactivate_inject_layout_builder() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-grime-core-deactivator.php';
	// Required the de-activator file but done nothing with it maybe I can use in future. Lete see.
}

// Hooks for registering activate and deactivate funtion when activating the plugin.
// register_activation_hook( __FILE__, 'activate_inject_layout_builder' );
// register_deactivation_hook( __FILE__, 'deactivate_inject_layout_builder' );

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
function run_inject_layout_builder() {

	$plugin = new Inject_Layout_Builder_Core();
	$plugin->load_plugin_admin();
	$plugin->load_public();
}
run_inject_layout_builder();

// load_plugin_textdomain('dnd-shortcodes', false, dirname(plugin_basename( __FILE__ )).'/languages/');

/**
 * Inject Layout Builder Button
 *
 * @access public
 * @since 1.0
 * @param object $post The post.
 */
function button_before_main_editor( $post ) {
	echo '<div class="hummer" style="text-align: right;"><a href="#" id="il_builder-trigger" class="button button-primary button-large">Inject Layout Builder</a></div>';

}
add_action( 'edit_form_after_title', 'button_before_main_editor', 999 );