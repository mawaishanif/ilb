<?php 


$editor=(isset($_GET['editor']) && $_GET['editor']!='') ? $_GET['editor'] : 'dnd';


$data = '
<div class="il_shortcode_info col-lg-8">
	<p>'. __( "Search or pick a shortcode from the list. To edit shortcode highlight shortcode in editor before clicking (Add/Edit Shortcode) button.", "inject-builder") .'</p>
</div>
<div class="col-lg-4 ilb_search_shortcode">
<div class="form-item">
          <input type="search" name="shortcode_search" placeholder="'. __("Search for element", "inject-builder") .'" id="shortcode_search">
     </div>
</div>
<div class="col-lg-12 ilb_shortcode_display">
	<ul id="ilb_element_list" class="row">';


		foreach ( $this->shortcodes->shortcodes('registered') as $name => $shortcode ) {
			$index_name = str_replace('_child', '', $name);

			if ( (!isset($shortcode[0]->sc_properties()[$index_name]['hidden']) || (isset($shortcode[0]->sc_properties()[$index_name]['hidden']) && $shortcode[0]->sc_properties()[$index_name]['hidden'] != '1' )) && !($editor=='dnd' && (isset($shortcode[0]->sc_properties()[$index_name]['hide_in_dnd']) && $shortcode[0]->sc_properties()[$index_name]['hide_in_dnd'])))

			{
				$child_name = (!empty($shortcode['child'])) ? ' &rarr; ['.$shortcode['child'].']' : '';
				$prettifed_name = ucFirst(str_replace('_', ' ', $name));

				$description = (isset($shortcode['description'])) ? $shortcode['description'] : $prettifed_name;

				$data .= '<li class="ilb_shortcode_element col-lg-2" data-shortcode="'.$name.'"><div class="shortcode-single-element">
						<div class="shortcode-image">
							<img src="http://localhost/wordpress/wp-content/plugins/ilb/admin/assets/placeholder.jpg" alt="">
						</div>
						<div class="ilb_element_meta">
						<h3 class="item-title">' . $description . '</h3>
						<h4 class="item-info">This is a description of shortcode element</h4>
						</div></div></li><li class="ilb_shortcode_element col-lg-2" data-shortcode="'.$name.'"><div class="shortcode-single-element">
						<div class="shortcode-image">
							<img src="http://localhost/wordpress/wp-content/plugins/ilb/admin/assets/placeholder.jpg" alt="">
						</div>
						<div class="ilb_element_meta">
						<h3 class="item-title">' . $description . '</h3>
						<h4 class="item-info">This is a description of shortcode element</h4>
						</div></div></li><li class="ilb_shortcode_element col-lg-2" data-shortcode="'.$name.'"><div class="shortcode-single-element">
						<div class="shortcode-image">
							<img src="http://localhost/wordpress/wp-content/plugins/ilb/admin/assets/placeholder.jpg" alt="">
						</div>
						<div class="ilb_element_meta">
						<h3 class="item-title">' . $description . '</h3>
						<h4 class="item-info">This is a description of shortcode element</h4>
						</div></div></li>';
			}
		}

$data .='</ul></div>';

