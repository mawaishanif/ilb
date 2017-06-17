<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Inject Layout Builder
 * @subpackage inject-layout-builder/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Inject_Layout_Builder
 * @subpackage inject-layout-builder/admin
 * @author     Inject Themes <inject-themes.com>
 */
class Inject_Layout_Builder_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $inject_layout_builder    The ID of this plugin.
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
	 * @param string $plugin_name 	The name of this plugin.
	 * @param string $version 		The version of this plugin.
	 */
	
	private $shortcodes;

	public function __construct( $plugin_name, $version, $scs ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->shortcodes = $scs;

		// Registers admin theme options for the plugin.
		add_action( 'admin_menu', array( $this, 'inject_layout_builder_admin_menu' ) );

		add_action( 'admin_enqueue_scripts', array( $this, 'load_assets') );

		add_action( 'wp_ajax_builder_admin_layout', array( $this, 'builder_admin_layout') );

	}

	public function load_assets($hook) {

		if ($hook == 'toplevel_page_inject-layout-builder-options') {

			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/js/inject-layout-builder-admin-script.js', array( 'jquery' ), $this->version, true );

		}

		if(($hook != 'post.php' && $hook != 'post-new.php')){
			
			return;

		}

		wp_enqueue_style('thickbox');

		wp_enqueue_style('wp-color-picker');

		wp_enqueue_style('dnd-shortcodes-fancybox', ILB_DIR_URL. 'admin/assets/' .'css/jquery.fancybox-1.3.4.css', array(), $this->version);

		wp_enqueue_style('dnd-cleditor', ILB_DIR_URL. 'admin/assets/' .'cleditor/jquery.cleditor.css', array(), $this->version);

		wp_enqueue_style('dnd-shortcodes-mCustomScrollbar', ILB_DIR_URL. 'admin/assets/' .'css/jquery.mCustomScrollbar.css', array(), $this->version);

		wp_enqueue_style('dnd-shortcodes-ddtab', ILB_DIR_URL. 'admin/assets/' .'css/ddtab.css', array(), $this->version);

		wp_enqueue_media();

		wp_enqueue_script('thickbox');

		wp_enqueue_script('dnd-shortcodes-fancybox', ILB_DIR_URL. 'admin/assets/' .'js/jquery.fancybox-1.3.4.js', array('jquery'), $this->version);

		wp_enqueue_script('my-custom-script', ILB_DIR_URL. 'admin/assets/' .'js/myScript.js', array('jquery'), $this->version);

		wp_enqueue_script('dnd-cleditor', ILB_DIR_URL. 'admin/assets/' .'cleditor/jquery.cleditor.min.js', array('jquery'), $this->version);

		wp_enqueue_script('dnd-shortcodes-mousewheel', ILB_DIR_URL. 'admin/assets/' .'js/jquery.mousewheel.js', array('jquery'), $this->version);

		wp_enqueue_script('dnd-shortcodes-mCustomScrollbar', ILB_DIR_URL. 'admin/assets/' .'js/jquery.mCustomScrollbar.js', array('jquery','dnd-shortcodes-mousewheel'), $this->version);

		wp_enqueue_script('dnd-shortcodes-cookie', ILB_DIR_URL. 'admin/assets/' .'js/jquery.cookie.js', array('jquery'), $this->version);

		wp_enqueue_script('dnd-shortcodes-ddtab', ILB_DIR_URL. 'admin/assets/' .'js/ddtab.js', array('dnd-shortcodes-mCustomScrollbar', 'dnd-cleditor', 'wp-color-picker','jquery-ui-sortable','jquery-ui-resizable','dnd-shortcodes-fancybox'), $this->version,true);

		wp_localize_script('dnd-shortcodes-ddtab', 'dnd_from_WP', array(
			'plugins_url' => plugins_url('inject-layout-builder'),
			'ABdevDND_shortcode_names' => $this->shortcodes->shortcodes('registered'),
			'save' => __('Save', 'dnd-shortcodes'),
			'error_to_editor' => __('<b>Content cannot be parsed</b><br>Please use Text tab instead or Revisions option to undo recently made changes.<br><br>Check the syntax:<br>- Use double quotes for attributes<br>- Every shortcode must be closed. e.g. [gallery ids="1,20"] should be [gallery ids="1,20"][/gallery]', 'dnd-shortcodes'),
			'delete_section' => __('Delete Section', 'dnd-shortcodes'),
			'duplicate_section' => __('Duplicate Section', 'dnd-shortcodes'),
			'edit_section' => __('Edit Section', 'dnd-shortcodes'),
			'remove_column' => __('Remove Column', 'dnd-shortcodes'),
			'add_column' => __('Add Column', 'dnd-shortcodes'),
			'add_element' => __('Add Element', 'dnd-shortcodes'),
			'edit_column' => __('Edit Column', 'dnd-shortcodes'),
			'text' => __('Text', 'dnd-shortcodes'),
			'delete_element' => __('Delete Element', 'dnd-shortcodes'),
			'duplicate_element' => __('Duplicate Element', 'dnd-shortcodes'),
			'edit_element' => __('Edit Element', 'dnd-shortcodes'),
			'drag_and_drop' => __('Drag & Drop', 'dnd-shortcodes'),
			'add_edit_shortcode' => __('Add / Edit Shortcode', 'dnd-shortcodes'),
			'add_section' => __('Add Section', 'dnd-shortcodes'),
			'layout_save' => __('Save Layout', 'dnd-shortcodes'),
			'layout_delete' => __('Delete Layout', 'dnd-shortcodes'),
			'layout_name' => __('Enter layout name', 'dnd-shortcodes'),
			'layout_name_delete' => __('Layout name to delete', 'dnd-shortcodes'),
			'layout_saved' => __('Layout successfully saved', 'dnd-shortcodes'),
			'layout_select_saved_first' => __('Select saved layout to load', 'dnd-shortcodes'),
			'layout_select_saved_second' => __('or', 'dnd-shortcodes'),
			'rearange_sections' => __('Rearange Sections', 'dnd-shortcodes'),
			'are_you_sure' => __('Are you sure?', 'dnd-shortcodes'),
			'custom_column_class' => __('Custom Column Class', 'dnd-shortcodes'),
			'animation' => __('Animation', 'dnd-shortcodes'),
			'none' => __('None', 'dnd-shortcodes'),
			'animation_duration' => __('Animation Duration ms', 'dnd-shortcodes'),
			'animation_delay' => __('Animation Delay ms', 'dnd-shortcodes'),
			'custom_section_class' => __('Custom Section Class', 'dnd-shortcodes'),
			'fullwidth' => __('Fullwidth Content', 'dnd-shortcodes'),
			'video_bg' => __('Video Background', 'dnd-shortcodes'),
			'video_bg_info' => __('If checked video background will be enabled. Video files should have same name as Background Image, and same path, only different extensions (mp4,webm,ogv files required). You can use Miro Converter to convert files in required formats.', 'dnd-shortcodes'),
			'background_color' => __('Background Color', 'dnd-shortcodes'),
			'background_image' => __('Background Image URL', 'dnd-shortcodes'),
			'parallax' => __('Background Parallax Factor', 'dnd-shortcodes'),
			'parallax_info' => __('0.1 means 10% of scroll, 2 means twice of scroll', 'dnd-shortcodes'),
			'flip' => __( 'Flip', 'dnd-shortcodes' ),
			'flipInX' => __( 'Flip In X', 'dnd-shortcodes' ),
			'flipInY' => __( 'Flip In Y', 'dnd-shortcodes' ),
			'fadeIn' => __( 'Fade In', 'dnd-shortcodes' ),
			'fadeInUp' => __( 'Fade In Up', 'dnd-shortcodes' ),
			'fadeInDown' => __( 'Fade In Down', 'dnd-shortcodes' ),
			'fadeInLeft' => __( 'Fade In Left', 'dnd-shortcodes' ),
			'fadeInRight' => __( 'Fade In Right', 'dnd-shortcodes' ),
			'fadeInUpBig' => __( 'Fade In Up Big', 'dnd-shortcodes' ),
			'fadeInDownBig' => __( 'Fade In Down Big', 'dnd-shortcodes' ),
			'fadeInLeftBig' => __( 'Fade In Left Big', 'dnd-shortcodes' ),
			'fadeInRightBig' => __( 'Fade In Right Big', 'dnd-shortcodes' ),
			'slideInLeft' => __( 'Slide In Left', 'dnd-shortcodes' ),
			'slideInRight' => __( 'Slide In Right', 'dnd-shortcodes' ),
			'bounceIn' => __( 'Bounce In', 'dnd-shortcodes' ),
			'bounceInDown' => __( 'Bounce In Down', 'dnd-shortcodes' ),
			'bounceInUp' => __( 'Bounce In Up', 'dnd-shortcodes' ),
			'bounceInLeft' => __( 'Bounce In Left', 'dnd-shortcodes' ),
			'bounceInRight' => __( 'Bounce In Right', 'dnd-shortcodes' ),
			'rotateIn' => __( 'Rotate In', 'dnd-shortcodes' ),
			'rotateInDownLeft' => __( 'Rotate In Down Left', 'dnd-shortcodes' ),
			'rotateInDownRight' => __( 'Rotate In Down Right', 'dnd-shortcodes' ),
			'rotateInUpLeft' => __( 'Rotate In Up Left', 'dnd-shortcodes' ),
			'rotateInUpRight' => __( 'Rotate In Up Right', 'dnd-shortcodes' ),
			'lightSpeedIn' => __( 'Light Speed In', 'dnd-shortcodes' ),
			'rollIn' => __( 'Roll In', 'dnd-shortcodes' ),
			'flash' => __( 'Flash', 'dnd-shortcodes' ),
			'bounce' => __( 'Bounce', 'dnd-shortcodes' ),
			'shake' => __( 'Shake', 'dnd-shortcodes' ),
			'tada' => __( 'Tada', 'dnd-shortcodes' ),
			'swing' => __( 'Swing', 'dnd-shortcodes' ),
			'wobble' => __( 'Wobble', 'dnd-shortcodes' ),
			'pulse' => __( 'Pulse', 'dnd-shortcodes' ),
			'upload_image' => __( 'Upload Image', 'dnd-shortcodes' ),
			'choose_image' => __( 'Choose Image', 'dnd-shortcodes' ),
			'use_image' => __( 'Use Image', 'dnd-shortcodes' ),
			'section_title' => __( 'Section Title', 'dnd-shortcodes' ),
			'section_id' => __( 'Section ID', 'dnd-shortcodes' ),
			'section_intro' => __( 'Section Intro', 'dnd-shortcodes' ),
			'section_outro' => __( 'Section Outro', 'dnd-shortcodes' ),
		));

	}

	public function inject_layout_builder_admin_menu() {
		add_menu_page(
		              __( 'Inject Layout Builder', 'inject-themes' ), 
		              'Inject Layout', 
		              'manage_options', 
		              'inject-layout-builder-options', 
		              array( $this, 'inject_layout_builder_admin_page' ), 
		              'dashicons-chart-pie', 75 
		              );	
	}


	public function inject_layout_builder_admin_page(){
		require 'partials/inject-layout-builder-admin-page.php';
	}

    public function builder_admin_layout()
    {
    	ob_clean();
    	require 'partials/inject-layout-builder-modal-page.php';
   		wp_send_json_success($data);
   		
    }

    public function shortcode_form_layout()
    {
    	require 'partials/inject-layout-builder-form-page.php';
    }

}
