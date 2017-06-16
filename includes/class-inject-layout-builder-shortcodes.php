<?php 
/**
 * Class Layout Builder short codes which deals with loading and adding assets for shortcodes and loading the essential shortcodes for the plugin.
 */

class Inject_Layout_Builder_Shortcodes	
{
	
	private $shortcodes;
	private $core_schortcodes;

	function __construct() {

		$this->shortcodes = array();
		$this->core_schortcodes = array();

		add_action('edit_form_after_title', array($this, 'register_shortcodes'));

	}
	
	public function load_core_scs()
	{
		$this->core_schortcodes = scandir(dirname( __FILE__ ) . '/shortcodes/core');
		foreach ($this->core_schortcodes as $sc) {
			if(is_file(dirname((__FILE__) ) . '/shortcodes/core/' . $sc)){
				include_once dirname((__FILE__) ) . '/shortcodes/core/' . $sc;
			}
		}
	}

	public function load_builder_scs()
	{
		$builder_shortcodes = scandir(dirname( __FILE__ ) . '/shortcodes');
		foreach ($builder_shortcodes as $sc) {
			if(is_file(dirname((__FILE__) ) . '/shortcodes/' . $sc)){
				include_once dirname((__FILE__) ) . '/shortcodes/' . $sc;
			}
		}
	}

	public function register_shortcodes()
	{	

		$all_scs = $this->shortcodes();

		foreach ($all_scs as $shortcode => $params) {

			if (empty($params['third_party']) || $params['third_party']!=1){

				add_shortcode( $shortcode, 'ilb_'.$shortcode.'_sc');

			}
			if (isset($params['nesting']) && $params['nesting']!=''){

				add_shortcode( $shortcode.'_child', 'ilb_'.$shortcode.'_sc');

			}
		}

	}

	


	public function shortcodes($data=false) {
		if ($data == 'names') {

			foreach($this->shortcodes as $shortcode => $att){

				// Preventing from adding core as shortcode name in the all shortcodes array.
				if ($shortcode == 'core') {
					continue;
				}

				$all_scs[$shortcode] = (isset($att['description'])) ? $att['description'] : '';
			}

			return $all_scs;
		}
		if ( $data == 'registered') {
				global $shortcode_tags;
				return global $shortcode_tags;
		}
		if ($data) {

			$r_sc = ($this->shortcodes[$data]) ? $this->shortcodes[$data] : false;
			return $r_sc;
		}

		// If we have reached this far, return the whole array of shortcodes.
		return $this->shortcodes;
	}

}