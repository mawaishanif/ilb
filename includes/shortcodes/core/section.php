
<?php


class Section extends Inject_Layout_Builder_Shortcodes
{
	
	// public $shortcodes;

	function __construct()
	{
		$this->sc_properties();
		$this->register_shortcodes();
	}

public function sc_properties()
{
	$this->shortcodes['section'] = array(
			'hide_in_dnd' => true,
			'nesting' => '1',
			'child' => 'column',
			'child_title' => __('Section Column', 'dnd-shortcodes'),
			'child_button' => __('Add Column', 'dnd-shortcodes'),
			'attributes' => array(
				'section_title' => array(
					'description' => __('Section Title', 'dnd-shortcodes'),
				),
				'section_id' => array(
					'description' => __('Section ID', 'dnd-shortcodes'),
					'info' => __('ID can be used for menu navigation, e.g. #about-us', 'dnd-shortcodes'),
				),
				'section_intro' => array(
					'description' => __('Intro Text', 'dnd-shortcodes'),
				),
				'section_outro' => array(
					'description' => __('Outro Text', 'dnd-shortcodes'),
				),
				'class' => array(
					'description' => __('Class', 'dnd-shortcodes'),
					'info' => __('Additional custom classes for custom styling', 'dnd-shortcodes'),
				),
				'fullwidth' => array(
					'description' => __('Fullwidth Content', 'dnd-shortcodes'),
					'type' => 'checkbox',
					'default' => '0',
				),
				'bg_color' => array(
					'description' => __('Background Color', 'dnd-shortcodes'),
					'type' => 'color',
				),
				'bg_image' => array(
					'type' => 'image',
					'description' => __('Background Image', 'dnd-shortcodes'),
				),
				'parallax' => array(
					'description' => __('Parallax Amount', 'dnd-shortcodes'),
					'info' => __('Amout of parallax effect on background image, 0.1 means 10% of scroll amount, 2 means twice of scroll amount, leave blank for no parallax', 'dnd-shortcodes'),
				),
				'video_bg' => array(
					'description' => __('Video Background', 'dnd-shortcodes'),
					'type' => 'checkbox',
					'default' => '0',
					'info' => __('If checked video background will be enabled. Video files should have same name as Background Image, and same path, only different extensions (mp4,webm,ogv files required). You can use Miro Converter to convert files in required formats.', 'dnd-shortcodes'),
				),
			),
			'content' => array(
				'default' => 'Columns here',
				'description' => __('Content', 'dnd-shortcodes'),
			),
			'description' => __('Section With Columns', 'dnd-shortcodes'),
			'info' => __("Sum of all column's span attributes must be 12", 'dnd-shortcodes' )
		);
	return $this->shortcodes;
}

function ilb_section_sc( $attributes, $content = null ) {
	extract(shortcode_atts($this->extract_sc_attributes('section'), $attributes));

	$bg_color_output = ($bg_color!='')?'background-color:'.$bg_color.';' : '';
	$bg_image_output = ($bg_image!='')?' data-background_image="'.$bg_image.'"' : '';
	$parallax_output = ($parallax!='')?' data-parallax="'.$parallax.'"' : '';
	$background_output = ($bg_image!='')?'background-image:url('.$bg_image.');' : '';
	$class .= ($parallax!='') ?' dnd-parallax' : '';
	$class .= ($video_bg==1) ?' dnd-video-bg' : '';
	$class .= ($fullwidth==1) ?' section_body_fullwidth' : '';
	$class .= ($section_title!='' || $section_intro!='') ?' section_with_header' : '';

	$section_title = ($section_title!='') ? '<h3>'.$section_title.'</h3>' : '';
	$section_id = ($section_id!='') ? ' id="'.$section_id.'"' : '';
	$section_intro = ($section_intro!='') ? '<p>'.$section_intro.'</p>' : '';
	$section_header = ($section_title!='' || $section_intro!='') ? '<header><div class="dnd_container">'.$section_title.$section_intro.'</div></header>' : '';
	$section_footer = ($section_outro!='') ? '<footer><div class="dnd_container">'.$section_outro.'</div></footer>' : '';

	$video_pi = pathinfo($bg_image);
	$video_no_ext_path = dirname($bg_image).'/'.$video_pi['filename'];
	$video_out=($video_bg==1) ? '<div class="dnd_video_background">
		<div style="max-width: 100%;" class="wp-video">
		<video class="section_video_background" style="max-width:100%;" poster="'.$bg_image.'" loop="1" autoplay="1" preload="metadata" controls="controls">
			<source type="video/mp4" src="'.$video_no_ext_path.'.mp4" />
			<source type="video/webm" src="'.$video_no_ext_path.'.webm" />
			<source type="video/ogg" src="'.$video_no_ext_path.'.ogv" />
		</video>
		</div>
	</div>' : '';

	return '< section'.$section_id.' class="dnd_section_dd '.$class.'"'.$bg_image_output.$parallax_output.' style="'.$bg_color_output.$background_output.'">
		'.$section_header.'
		<div class="dnd_section_content"><div class="dnd_container">'.do_shortcode($content).'</div></div>
		'.$section_footer.'
		'.$video_out.'
	</section>';
}


}

new Section();