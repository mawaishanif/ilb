<?php 


$editor=(isset($_GET['editor']) && $_GET['editor']!='') ? $_GET['editor'] : 'dnd';



$data = '<div id="dnd_shortcode_selector">
	<input type="text" id="dnd_shortcode_selector_filter" placeholder="'. __("Search Here", "inject-builder") .'"><span class="clear_field"></span>
	<ul id="dnd_shortcodes_list">';


		foreach ( $this->shortcodes->shortcodes('registered') as $name => $shortcode ) {
			$index_name = str_replace('_child', '', $name);
			// $shortcode[0]->sc_properties()[$name]['child']
			if ( (!isset($shortcode[0]->sc_properties()[$index_name]['hidden']) || (isset($shortcode[0]->sc_properties()[$index_name]['hidden']) && $shortcode[0]->sc_properties()[$index_name]['hidden'] != '1' )) && !($editor=='dnd' && (isset($shortcode[0]->sc_properties()[$index_name]['hide_in_dnd']) && $shortcode[0]->sc_properties()[$index_name]['hide_in_dnd'])))

			{
				$child_name = (!empty($shortcode['child'])) ? ' &rarr; ['.$shortcode['child'].']' : '';
				$prettifed_name = ucFirst(str_replace('_', ' ', $name));

				$description = (isset($shortcode['description'])) ? $shortcode['description'] : $prettifed_name;

				// $test = (isset($shortcode[0]->sc_properties()[$index_name]['hidden'])) ? $shortcode[0]->sc_properties()[$index_name]['hidden'] : 'nothing found';

				$data .= '<li class="dnd_select_shortcode" data-shortcode="'.$name.'"><span class="item-title-1">' . $description . '</span><span class="item-info">[' . $name . ']'.$child_name.'</span></li>';
			}
		}

$data .='</ul>
</div>
<div id="dnd_shortcode_attributes">
	<p id="dnd_initial_message">'. __( "Search or pick a shortcode from the list.<br><br>To edit shortcode highlight shortcode in editor before clicking (Add/Edit Shortcode) button.", "inject-builder") .'</p>
</div>';

