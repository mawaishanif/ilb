<?php


class Column extends Inject_Layout_Builder_Shortcodes
{
	
	// public $shortcodes;

	function __construct()
	{
		$this->sc_properties();
		$this->register_shortcodes();
	}

public function sc_properties()
{
	$this->shortcodes['column'] = array(
			'nesting' => '1',
			'hidden' => '1',
			'hide_in_dnd' => true,
			'attributes' => array(
				'span' => array(
					'default' => '1',
					'description' => __('Span 1-12 Columns', 'dnd-shortcodes'),
				),
				'animation' => array(
					'default' => '',
					'description' => __('Entrance Animation', 'dnd-shortcodes'),
					'type' => 'select',
					'values' => array(
						'' => __('None', 'dnd-shortcodes'),
						'flip' => __('Flip', 'dnd-shortcodes'),
						'flipInX' => __('Flip In X', 'dnd-shortcodes'),
						'flipInY' => __('Flip In Y', 'dnd-shortcodes'),
						'fadeIn' => __('Fade In', 'dnd-shortcodes'),
						'fadeInUp' => __('Fade In Up', 'dnd-shortcodes'),
						'fadeInDown' => __('Fade In Down', 'dnd-shortcodes'),
						'fadeInLeft' => __('Fade In Left', 'dnd-shortcodes'),
						'fadeInRight' => __('Fade In Right', 'dnd-shortcodes'),
						'fadeInUpBig' => __('Fade In Up Big', 'dnd-shortcodes'),
						'fadeInDownBig' => __('Fade In Down Big', 'dnd-shortcodes'),
						'fadeInLeftBig' => __('Fade In Left Big', 'dnd-shortcodes'),
						'fadeInRightBig' => __('Fade In Right Big', 'dnd-shortcodes'),
						'slideInLeft' => __('Slide In Left', 'dnd-shortcodes'),
						'slideInRight' => __('Slide In Right', 'dnd-shortcodes'),
						'bounceIn' => __('Bounce In', 'dnd-shortcodes'),
						'bounceInDown' => __('Bounce In Down', 'dnd-shortcodes'),
						'bounceInUp' => __('Bounce In Up', 'dnd-shortcodes'),
						'bounceInLeft' => __('Bounce In Left', 'dnd-shortcodes'),
						'bounceInRight' => __('Bounce In Right', 'dnd-shortcodes'),
						'rotateIn' => __('Rotate In', 'dnd-shortcodes'),
						'rotateInDownLeft' => __('Rotate In Down Left', 'dnd-shortcodes'),
						'rotateInDownRight' => __('Rotate In Down Right', 'dnd-shortcodes'),
						'rotateInUpLeft' => __('Rotate In Up Left', 'dnd-shortcodes'),
						'rotateInUpRight' => __('Rotate In Up Right', 'dnd-shortcodes'),
						'lightSpeedIn' => __('Light Speed In', 'dnd-shortcodes'),
						'rollIn' => __('Roll In', 'dnd-shortcodes'),
						'flash' => __('Flash', 'dnd-shortcodes'),
						'bounce' => __('Bounce', 'dnd-shortcodes'),
						'shake' => __('Shake', 'dnd-shortcodes'),
						'tada' => __('Tada', 'dnd-shortcodes'),
						'swing' => __('Swing', 'dnd-shortcodes'),
						'wobble' => __('Wobble', 'dnd-shortcodes'),
						'pulse' => __('Pulse', 'dnd-shortcodes'),
					),
				),
				'duration' => array(
					'description' => __('Animation Duration (in ms)', 'dnd-shortcodes'),
					'default' => '1000',
				),		
				'delay' => array(
					'description' => __('Animation Delay (in ms)', 'dnd-shortcodes'),
					'default' => '0',
				),		
				'class' => array(
					'description' => __('Class', 'dnd-shortcodes'),
					'info' => __('Additional custom classes for custom styling', 'dnd-shortcodes'),
				),
			),
			'content' => array(
				'description' => __('Column Content', 'dnd-shortcodes'),
			),
			'description' => __('Column', 'dnd-shortcodes' )
		);
	return $this->shortcodes;
}

public function ilb_column_sc( $attributes, $content = null ) {
	
	extract(shortcode_atts($this->extract_sc_attributes('column'), $attributes));
	$parametars_out='';
	if($animation!=''){
		$class.= ' dnd-animo';
		$parametars_out = ' data-animation="'.$animation.'" data-duration="'.$duration.'" data-delay="'.$delay.'"';
	}
    return '<div class="dnd_column_dd_span'.$span.' '.$class.'"'.$parametars_out.'>'.do_shortcode($content).'</div>';
}


}

new Column();