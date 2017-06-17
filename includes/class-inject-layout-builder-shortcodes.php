<?php 
/**
 * Class Layout Builder short codes which deals with loading and adding assets for shortcodes and loading the essential shortcodes for the plugin.
 */

class Inject_Layout_Builder_Shortcodes	
{
	
	protected $shortcodes;

	function __construct() {

		$this->shortcodes = array();

		// add_action( 'edit_form_after_title', array( $this, 'debug_panel' ), 999 );

	}
	

	public function register_shortcodes()
	{	

		$all_scs = $this->shortcodes();

		foreach ($all_scs as $shortcode => $params) {

			if (empty($params['third_party']) || $params['third_party']!=1){

				add_shortcode( $shortcode, array( $this, 'ilb_' . $shortcode .'_sc' ) );

			}
			if (isset($params['nesting']) && $params['nesting']!=''){

				add_shortcode( $shortcode.'_child', array( $this, 'ilb_' . $shortcode . '_sc' ));

			}
		}

	}

	public function extract_sc_attributes ( $shortcode ) {

		foreach($this->shortcodes()[$shortcode]['attributes'] as $att => $val){

			$defaults[$att] = (isset($val['default'])) ? $val['default'] : '';

		}

		return $defaults;
	}


	public function shortcodes( $data=false ) {
		if ($data == 'names') {
			$all_scs = array();
			foreach($this->shortcodes as $shortcode => $att){

				$all_scs[$shortcode] = (isset($att['description'])) ? $att['description'] : '';
			}

			return $all_scs;
		}
		if ( $data == 'registered') {
				global $shortcode_tags;
				// Unset the wordpress shortcodes from the array.
				  $array_to_remove = array(
				  	"wp_caption" => "img_caption_shortcode",
				  	"caption" => "img_caption_shortcode",
				  	"gallery" => "gallery_shortcode",
				  	"playlist" => "wp_playlist_shortcode",
				  	"audio" => "wp_audio_shortcode",
				  	"video" => "wp_video_shortcode",
				  	"embed" => "__return_false");

				$ilb_registered_shortcodes = array_diff( $shortcode_tags , $array_to_remove);
				
				return $ilb_registered_shortcodes;
		}
		if ($data) {

			$r_sc = ($this->shortcodes[$data]) ? $this->shortcodes[$data] : false;
			return $r_sc;
		}

		// If we have reached this far, return the whole array of shortcodes.
		return $this->shortcodes;
	}

	function debug_panel( $post ) {
		global $shortcode_tags;
		echo '<pre>', print_r($shortcode_tags) ,'</pre>';
	}

}