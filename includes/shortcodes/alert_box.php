<?php


/**
* CLass which deails with alert box shortcode and its a child clas of inject layout builder shortocdes
*/
class Alert_Box extends Inject_Layout_Builder_Shortcodes
{
	
	// public $shortcodes;

	function __construct()
	{
		$this->sc_properties();
		$this->register_shortcodes();
	}

public function sc_properties()
{
	$this->shortcodes['alert_box'] = array(
			'attributes' => array(
				'style' => array(
					'default' => 'info',
					'type' => 'select',
					'values' => array( 
						'info' => 'Info',
						'warning' => 'Warning',
						'error' => 'Error',
						'success' => 'Success',
					),
					'description' => __('Style', 'dnd-shortcodes'),
				),
				'no_icon' => array(
					'default' => '0',
					'type' => 'checkbox',
					'description' => __('No Icon', 'dnd-shortcodes'),
				),
				'no_close' => array(
					'default' => '0',
					'type' => 'checkbox',
					'description' => __('No Close Button', 'dnd-shortcodes'),
				),
			),
			'content' => array(
				'description' => __('Message', 'dnd-shortcodes'),
			),
			'description' => __('Alert Box', 'dnd-shortcodes' )
		);
	return $this->shortcodes;
}
function ilb_alert_box_sc( $attributes, $content = null ) {
	extract(shortcode_atts($this->extract_sc_attributes('alert_box'), $attributes));
	$allowed_styles = array('warning','error','info','success');
	$style = (in_array($style, $allowed_styles)) ? $style : 'info';
	$style_out = 'dnd_alert_' . $style;
	$icons = array(
		'warning' => 'warning-sign',
		'error' => 'remove',
		'info' => 'comment',
		'success' => 'ok',
	);
	$icon_out = ($no_icon != '1') ? '<i class="ABdev_icon-' . $icons[$style] . '"></i> ' : '';
	$close_button = ( $no_close != 1 ) ? '<a class="dnd_alert_box_close" title="' . __('Close', 'dnd-shortcodes' ) . '">&#10005;</a>' : '';
	return '<div class="'. $style_out . '">
		' . $icon_out . $content . $close_button . '
	</div>';
}


}

new Alert_Box();