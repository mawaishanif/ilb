<?php 


$editor=(isset($_GET['editor']) && $_GET['editor']!='') ? $_GET['editor'] : 'dnd';


$data = '
	<ul id="elements_list" class="row with-gutter">';


		foreach ( $this->shortcodes->shortcodes('registered') as $name => $shortcode ) {
			$index_name = str_replace('_child', '', $name);

			if ( (!isset($shortcode[0]->sc_properties()[$index_name]['hidden']) || (isset($shortcode[0]->sc_properties()[$index_name]['hidden']) && $shortcode[0]->sc_properties()[$index_name]['hidden'] != '1' )) && !($editor=='dnd' && (isset($shortcode[0]->sc_properties()[$index_name]['hide_in_dnd']) && $shortcode[0]->sc_properties()[$index_name]['hide_in_dnd'])))

			{
				$child_name = (!empty($shortcode['child'])) ? ' &rarr; ['.$shortcode['child'].']' : '';
				$prettifed_name = ucFirst(str_replace('_', ' ', $name));

				$description = (isset($shortcode['description'])) ? $shortcode['description'] : $prettifed_name;

				$data .= '	<li class="shortcode_element cat-social col-lg-4"  data-shortcode="'.$name.'">
							<a class="shortcode-single-element" href="#0" data-component="settings-modal" data-modal-target="#selected_element_modal">
								<div class="shortcode-icon"><span class="icon ti-layout-tab"></span></div>
								<h3 class="item-title">' . $description . '</h3>
								<h4 class="item-info">This is another a man of shortcode element</h4>
							</a>
						</li>
						<li class="shortcode_element cat-social cat-wordpress col-lg-4"  data-shortcode="'.$name.'" data-component="settings-modal" data-modal-target="#selected_element_modal">
							<a class="shortcode-single-element" href="#0">
								<div class="shortcode-icon"><span class="icon ti-bar-chart-alt"></span></div>
								<h3 class="item-title">' . $description . '</h3>
								<h4 class="item-info">This is a dadday of shortcode element</h4>
							</a>
						</li>
						<li class="shortcode_element cat-woocommerce col-lg-4"  data-shortcode="'.$name.'" data-component="settings-modal" data-modal-target="#selected_element_modal">
							<a class="shortcode-single-element" href="#0">
								<div class="shortcode-icon"><span class="icon ti-announcement"></span></div>
								<h3 class="item-title">' . $description . '</h3>
								<h4 class="item-info">This is a perfect of shortcode element</h4>
							</a>
						</li>
						<li class="shortcode_element cat-other col-lg-4"  data-shortcode="'.$name.'">
							<a class="shortcode-single-element" href="#0" data-component="settings-modal" data-modal-target="#selected_element_modal">
								<div class="shortcode-icon"><span class="icon ti-layout-tab"></span></div>
								<h3 class="item-title">' . $description . '</h3>
								<h4 class="item-info">This is a woocommerc of shortcode element</h4>
							</a>
						</li>
						<li class="shortcode_element cat-woocommerce col-lg-4"  data-shortcode="'.$name.'" data-component="settings-modal" data-modal-target="#selected_element_modal">
							<a class="shortcode-single-element" href="#0">
								<div class="shortcode-icon"><span class="icon ti-bar-chart-alt"></span></div>
								<h3 class="item-title">' . $description . '</h3>
								<h4 class="item-info">This is a brah of shortcode element</h4>
							</a>
						</li>
						<li class="shortcode_element cat-basic col-lg-4"  data-shortcode="'.$name.'">
							<a class="shortcode-single-element" href="#0" data-component="settings-modal" data-modal-target="#selected_element_modal">
								<div class="shortcode-icon"><span class="icon ti-announcement"></span></div>
								<h3 class="item-title">' . $description . '</h3>
								<h4 class="item-info">This is a fuck of shortcode element</h4>
							</a>
						</li>
						<li class="shortcode_element cat-wordpress col-lg-4"  data-shortcode="'.$name.'">
							<a class="shortcode-single-element" href="#0" data-component="settings-modal" data-modal-target="#selected_element_modal">
								<div class="shortcode-icon"><span class="icon ti-layout-tab"></span></div>
								<h3 class="item-title">' . $description . '</h3>
								<h4 class="item-info">This is a oh of damn element</h4>
							</a>
						</li>
						<li class="shortcode_element cat-social col-lg-4"  data-shortcode="'.$name.'">
							<a class="shortcode-single-element" href="#0" data-component="settings-modal" data-modal-target="#selected_element_modal">
								<div class="shortcode-icon"><span class="icon ti-bar-chart-alt"></span></div>
								<h3 class="item-title">' . $description . '</h3>
								<h4 class="item-info">This is a good of shortcode element</h4>
							</a>
						</li>
						<li class="shortcode_element cat-other col-lg-4"  data-shortcode="'.$name.'">
							<a class="shortcode-single-element" href="#0" data-component="settings-modal" data-modal-target="#selected_element_modal">
								<div class="shortcode-icon"><span class="icon ti-announcement"></span></div>
								<h3 class="item-title">' . $description . '</h3>
								<h4 class="item-info">This is a amazing of shortcode element</h4>
							</a>
						</li>';
			}
		}

$data .='</ul><script>modal(\'[data-component="settings-modal"]\');</script>';

