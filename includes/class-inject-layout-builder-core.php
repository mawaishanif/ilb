<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       inject-themes.com
 * @since      1.0.0
 *
 * @package    Inject_Layout_Builder
 * @subpackage inject-layout-builder/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Inject_Layout_Builder
 * @subpackage Inject-Layout-Builder/includes
 * @author     Inject Themes <Inject-themes.com>
 */
class Inject_Layout_Builder_Core {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Plugin_Name_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * The slug for theme admin panels.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_slug    Slug of the theme admin menus.
	 */
	protected $plugin_slug;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'inject-layout-builder';
		$this->version = '1.0.0';
		$this->load_dependencies();
		// $this->set_locale();
		// $this->define_admin_hooks();
		// $this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Plugin_Name_Loader. Orchestrates the hooks of the plugin.
	 * - Plugin_Name_i18n. Defines internationalization functionality.
	 * - Plugin_Name_Admin. Defines all hooks for the admin area.
	 * - Plugin_Name_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		// Loading ShortCodes dependencies:
		
		$this->shortcode_dependenices();

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		// require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-grime-core-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-inject-layout-builder-admin.php';
		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-inject-layout-builder-public.php';

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Grime_Core_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Grime_Core_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Plugin_Name_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	public function load_plugin_admin(){

		$shortcodes = new Inject_Layout_Builder_Shortcodes;
		
		// echo '<pre>',var_dump($shortcodes->shortcodes('registered')['column'][0]->sc_properties()),'</pre>';
		// foreach ($shortcodes->shortcodes('registered') as $name => $properties) {
			
			// echo '<pre>', $name, '</pre>';
			// echo '<pre>', var_dump($properties[0]->sc_properties()[$name]['child']), '</pre>';	
		// }

		new Inject_Layout_Builder_Admin( $this->plugin_name, $this->version, $shortcodes);
	}

	public function load_public()
	{
		new Inject_Layout_Builder_Public($this->plugin_name, $this->version);
	}


	private function shortcode_dependenices()
	{
		// Load Main class for Shortcodes
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-inject-layout-builder-shortcodes.php';

		// Loading Core Shortcode Classes First.
		$core_schortcodes = scandir(dirname( __FILE__ ) . '/shortcodes/core');

		foreach ($core_schortcodes as $sc) {

			if(is_file(dirname((__FILE__) ) . '/shortcodes/core/' . $sc)){

				include_once dirname((__FILE__) ) . '/shortcodes/core/' . $sc;
			}
		}

		// Loading Builder Shortcode classes
		$builder_shortcodes = scandir(dirname( __FILE__ ) . '/shortcodes');

		foreach ($builder_shortcodes as $sc) {

			if(is_file(dirname((__FILE__) ) . '/shortcodes/' . $sc)){

				require_once dirname((__FILE__) ) . '/shortcodes/' . $sc;
			}
		}
	}

}
