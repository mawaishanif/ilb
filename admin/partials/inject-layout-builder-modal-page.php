<?php 


$editor=(isset($_GET['editor']) && $_GET['editor']!='') ? $_GET['editor'] : 'text';



$data = '<div id="dnd_shortcode_selector">
	<input type="text" id="dnd_shortcode_selector_filter" placeholder="'. __("Search Here", "inject-builder") .'"><span class="clear_field"></span>
	<ul id="dnd_shortcodes_list">';


		foreach ( $this->shortcodes->shortcodes() as $name => $shortcode ) {
			if ( (!isset($shortcode['hidden']) || (isset($shortcode['hidden']) && $shortcode['hidden'] != '1' )) && !($editor=='dnd' && (isset($shortcode['hide_in_dnd']) && $shortcode['hide_in_dnd']))){
				$child_name = (!empty($shortcode['child'])) ? ' &rarr; ['.$shortcode['child'].']' : '';
				$description = (isset($shortcode['description'])) ? $shortcode['description'] : 'ddd';
				$data .= '<li class="dnd_select_shortcode" data-shortcode="'.$name.'"><span class="item-title">' . $description . '</span><span class="item-info">[' . $name . ']'.$child_name.'</span></li>';
			}
		}
$data .='</ul>
</div>
<div id="dnd_shortcode_attributes">
	<p id="dnd_initial_message">'. __( "Search or pick a shortcode from the list.<br><br>To edit shortcode highlight shortcode in editor before clicking (Add/Edit Shortcode) button.", "inject-builder") .'</p>
</div>';

