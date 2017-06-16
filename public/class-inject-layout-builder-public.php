<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Inject_Layout_Builder
 * @subpackage Inject-Layout-Builder/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Inject_Layout_Builder
 * @subpackage Inject-Layout-Builder/public
 * @author     Inject Themes <inject-themes.com>
 */
class Inject_Layout_Builder_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_action( 'wp_enqueue_scripts', array( $this , 'load_assets' ) );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function load_assets() {

			wp_enqueue_style('wp-mediaelement');
	
			wp_enqueue_style('dnd_icons_default', ILB_DIR_URL. 'public/assets/'.'css/icons-default.css', array(), $this->version);

			$options = get_option( 'dnd_settings' );
			if(isset($options['dnd_enable_fa']) && $options['dnd_enable_fa']==1){
				wp_enqueue_style('dnd_icons_fa', ILB_DIR_URL. 'public/assets/'.'css/icons-fa.css', array(), $this->version);
			}
			if(isset($options['dnd_enable_whhg']) && $options['dnd_enable_whhg']==1){
				wp_enqueue_style('dnd_icons_whhg', ILB_DIR_URL. 'public/assets/'.'css/icons-whhg.css', array(), $this->version);
			}
			
			wp_enqueue_style('ABdev_animo-animate', ILB_DIR_URL. 'public/assets/'.'css/animo-animate.css', array(), $this->version);
			wp_enqueue_style('ABdev_prettify', ILB_DIR_URL. 'public/assets/'.'css/prettify.css', array(), $this->version);
			if(is_file(get_stylesheet_directory().'/css/dnd-shortcodes.css')){
				wp_enqueue_style('ABdev_shortcodes', get_stylesheet_directory_uri().'/css/dnd-shortcodes.css', array('ABdev_animo-animate', 'ABdev_prettify'), $this->version);
			}
			else{
				wp_enqueue_style('ABdev_shortcodes', ILB_DIR_URL. 'public/assets/'.'css/shortcodes-default.css', array('ABdev_animo-animate', 'ABdev_prettify'), $this->version);
			}
			wp_enqueue_style('ABdev_shortcodes_responsive', ILB_DIR_URL. 'public/assets/'.'css/responsive.css', array('ABdev_shortcodes'), $this->version);
			wp_enqueue_script('wp-mediaelement');
			wp_enqueue_script('prettify', ILB_DIR_URL. 'public/assets/'.'js/prettify.js', $this->version, true);
			wp_enqueue_script('google_maps_api', 'http://maps.google.com/maps/api/js?sensor=false','','', true);
			wp_enqueue_script('google_maps_jquery', ILB_DIR_URL. 'public/assets/'.'js/jquery.gmap.min.js', array('jquery', 'google_maps_api'), $this->version, true);
			wp_enqueue_script('animo', ILB_DIR_URL. 'public/assets/'.'js/animo.js', array('jquery'), $this->version, true);
			wp_enqueue_script('inview', ILB_DIR_URL. 'public/assets/'.'js/jquery.inview.js', array('jquery'), $this->version, true);
			wp_enqueue_script('parallax', ILB_DIR_URL. 'public/assets/'.'js/jquery.parallax-1.1.3.js', array('jquery'), $this->version, true);
			wp_enqueue_script('tipsy', ILB_DIR_URL. 'public/assets/'.'js/jquery.tipsy.js', array('jquery'), $this->version, true);
			wp_enqueue_script('knob', ILB_DIR_URL. 'public/assets/'.'js/jquery.knob-custom.js', array('jquery'), $this->version, true);

			// $options = get_option( 'dnd_settings' );
			// $dnd_tipsy_opacity = (isset($options['dnd_tipsy_opacity'])) ? $options['dnd_tipsy_opacity'] : '0.8';

			wp_enqueue_script('dnd-shortcodes', ILB_DIR_URL. 'public/assets/'.'js/init.js', array('jquery', 'jquery-ui-accordion', 'jquery-ui-tabs', 'jquery-effects-slide', 'animo', 'google_maps_jquery', 'parallax', 'inview' , 'tipsy' , 'knob' , 'prettify'), $this->version, true);
			wp_localize_script( 'dnd-shortcodes', 'dnd_options', array( 
				'dnd_tipsy_opacity' => $dnd_tipsy_opacity, 
			) );

	}

}
