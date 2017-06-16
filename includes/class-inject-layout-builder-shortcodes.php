<?php 
/**
 * Class Layout Builder short codes which deals with loading and adding assets for shortcodes and loading the essential shortcodes for the plugin.
 */

class Inject_Layout_Builder_Shortcodes	
{
	
	private $shortcodes;

	function __construct() {

		$this->shortcodes = array();

		add_action('edit_form_after_title', array($this, 'register_shortcodes'));

	}
	
	public function load_core_scs()
	{
		$core_schortcodes = scandir(dirname( __FILE__ ) . '/shortcodes/core');
		foreach ($core_schortcodes as $sc) {
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

		foreach ($this->shortcodes() as $name => $properties) {
			if (isset($properties['nesting']) && $properties['nesting']!=''){
				add_shortcode( $name.'_child', 'ABdevDND_'.$name.'_shortcode');
				add_shortcode( str_replace('_dd', '_DD', $name).'_child', 'ABdevDND_'.str_replace('_dd', '_DD', $name).'_shortcode'); 
			}
		}

	}

	public function ABdevDND_extract_attributes ($shortcode) {
		foreach($GLOBALS['ABdevDND_shortcodes'][$shortcode]['attributes'] as $att => $val){
			$defaults[$att] = (isset($val['default'])) ? $val['default'] : '';
		}
		return $defaults;
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
		if ($data) {

			$r_sc = ($this->shortcodes[$data]) ? $this->shortcodes[$data] : false;
			return $r_sc;
		}

		// If we have reached this far, return the whole array of shortcodes.
		return $this->shortcodes;
	}

}