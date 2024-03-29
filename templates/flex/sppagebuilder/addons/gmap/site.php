<?php
/**
 * Flex @package SP Page Builder
 * Template Name - Flex
 * @author Aplikko http://www.aplikko.com
 * @copyright Copyright (c) 2017 Aplikko
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
// no direct access
defined ('_JEXEC') or die ('restricted access');

class SppagebuilderAddonGmap extends SppagebuilderAddons {

		public function render() {
	
		$app = JFactory::getApplication();
		$doc = JFactory::getDocument();
		$tmpl_url = JURI::base(true) . '/templates/' . $app->getTemplate() . '/images/';
		
		$class = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';
		$title = (isset($this->addon->settings->title) && $this->addon->settings->title) ? $this->addon->settings->title : '';
		$heading_selector = (isset($this->addon->settings->heading_selector) && $this->addon->settings->heading_selector) ? $this->addon->settings->heading_selector : 'h3';

		//Options
		$map = (isset($this->addon->settings->map) && $this->addon->settings->map) ? $this->addon->settings->map : '';
		$api_key = (isset($this->addon->settings->api_key) && $this->addon->settings->api_key) ? $this->addon->settings->api_key : '';
		$gmap_api = (isset($this->addon->settings->gmap_api) && $this->addon->settings->gmap_api) ? $this->addon->settings->gmap_api : '';
		
		$infowindow = (isset($this->addon->settings->infowindow) && $this->addon->settings->infowindow) ? $this->addon->settings->infowindow : '';
		
		$type = (isset($this->addon->settings->type) && $this->addon->settings->type) ? $this->addon->settings->type : '';
		$zoom = (isset($this->addon->settings->zoom) && $this->addon->settings->zoom) ? $this->addon->settings->zoom : '';
		$mousescroll = (isset($this->addon->settings->mousescroll) && $this->addon->settings->mousescroll) ? $this->addon->settings->mousescroll : '';
		
		$fullscreen_control = (isset($this->addon->settings->fullscreen_control) && $this->addon->settings->fullscreen_control) ? $this->addon->settings->fullscreen_control : '';
		$street_view_control = (isset($this->addon->settings->street_view_control) && $this->addon->settings->street_view_control) ? $this->addon->settings->street_view_control : '';
		$map_type_control = (isset($this->addon->settings->map_type_control) && $this->addon->settings->map_type_control) ? $this->addon->settings->map_type_control : '';
		
		$fullscreen_control != 'true' ? $data_fullscreen_control = ' data-fullscreen_control="' . $fullscreen_control . '"' : $data_fullscreen_control = '';
		$street_view_control != 'true' ? $data_street_view_control = ' data-street_view_control="' . $street_view_control . '"' : $data_street_view_control = '';
		$map_type_control != 'true' ? $data_map_type_control = ' data-map_type_control="' . $map_type_control . '"' : $data_map_type_control = '';

		$water_color = (isset($this->addon->settings->water_color) && $this->addon->settings->water_color) ? $this->addon->settings->water_color : '';
		$highway_stroke_color = (isset($this->addon->settings->highway_stroke_color) && $this->addon->settings->highway_stroke_color) ? $this->addon->settings->highway_stroke_color : '';
		$highway_fill_color = (isset($this->addon->settings->highway_fill_color) && $this->addon->settings->highway_fill_color) ? $this->addon->settings->highway_fill_color : '';
		$local_stroke_color = (isset($this->addon->settings->local_stroke_color) && $this->addon->settings->local_stroke_color) ? $this->addon->settings->local_stroke_color : '';
		$local_fill_color = (isset($this->addon->settings->local_fill_color) && $this->addon->settings->local_fill_color) ? $this->addon->settings->local_fill_color : '';
		$poi_fill_color = (isset($this->addon->settings->poi_fill_color) && $this->addon->settings->poi_fill_color) ? $this->addon->settings->poi_fill_color : '';
		$administrative_color = (isset($this->addon->settings->administrative_color) && $this->addon->settings->administrative_color) ? $this->addon->settings->administrative_color : '';
		$landscape_color = (isset($this->addon->settings->landscape_color) && $this->addon->settings->landscape_color) ? $this->addon->settings->landscape_color : '';
		$road_text_color = (isset($this->addon->settings->road_text_color) && $this->addon->settings->road_text_color) ? $this->addon->settings->road_text_color : '';
		$road_arterial_fill_color = (isset($this->addon->settings->road_arterial_fill_color) && $this->addon->settings->road_arterial_fill_color) ? $this->addon->settings->road_arterial_fill_color : '';
		$road_arterial_stroke_color = (isset($this->addon->settings->road_arterial_stroke_color) && $this->addon->settings->road_arterial_stroke_color) ? $this->addon->settings->road_arterial_stroke_color : '';
		
		$map_type_control != 'true' ? $data_map_type_control = ' data-map_type_control="' . $map_type_control . '"' : $data_map_type_control = '';
		$street_view_control != 'true' ? $data_street_view_control = ' data-street_view_control="' . $street_view_control . '"' : $data_street_view_control = '';
		$water_color != '' ? $data_water_color = ' data-water_color="' . $water_color . '"' : $data_water_color = '';
		$highway_stroke_color != '' ? $data_highway_stroke_color = ' data-highway_stroke_color="' . $highway_stroke_color . '"' : $data_highway_stroke_color = '';
		$highway_fill_color != '' ? $data_highway_fill_color = ' data-highway_fill_color="' . $highway_fill_color . '"' : $data_highway_fill_color = '';
		$local_stroke_color != '' ? $data_local_stroke_color = ' data-local_stroke_color="' . $local_stroke_color . '"' : $data_local_stroke_color = '';
		$local_fill_color != '' ? $data_local_fill_color = ' data-local_fill_color="' . $local_fill_color . '"' : $data_local_fill_color = '';
		$poi_fill_color != '' ? $data_poi_fill_color = ' data-poi_fill_color="' . $poi_fill_color . '"' : $data_poi_fill_color = '';
		$administrative_color != '' ? $data_administrative_color = ' data-administrative_color="' . $administrative_color . '"' : $data_administrative_color = '';
		$landscape_color != '' ? $data_landscape_color = ' data-landscape_color="' . $landscape_color . '"' : $data_landscape_color = '';
		$road_text_color != '' ? $data_road_text_color = ' data-road_text_color="' . $road_text_color . '"' : $data_road_text_color = '';
		$road_arterial_fill_color != '' ? $data_road_arterial_fill_color = ' data-road_arterial_fill_color="' . $road_arterial_fill_color . '"' : $data_road_arterial_fill_color = '';
		$road_arterial_stroke_color != '' ? $data_road_arterial_stroke_color = ' data-road_arterial_stroke_color="' . $road_arterial_stroke_color . '"' : $data_road_arterial_stroke_color = '';
	
		if($map) {
			$map = explode(',', $map);
			$output  = '<div id="sppb-addon-map-'. $this->addon->id .'" class="sppb-addon sppb-addon-gmap ' . $class . '">';
			$output .= ($title) ? '<'.$heading_selector.' class="sppb-addon-title">' . $title . '</'.$heading_selector.'>' : '';
			$output .= '<div class="sppb-addon-content">';
			$output .= '<div id="sppb-addon-gmap-'. $this->addon->id .'" class="sppb-addon-gmap-canvas" data-lat="' . trim($map[0]) . '" data-lng="' . trim($map[1]) . '" data-tmpl_url="' . $tmpl_url . '" data-maptype="' . $type . '" data-mapzoom="' . $zoom . '"'. $data_map_type_control . $data_street_view_control . $data_fullscreen_control .' data-infowindow="' . base64_encode($infowindow) . '" data-mousescroll="' . $mousescroll . '"'. $data_water_color . $data_highway_stroke_color . $data_highway_fill_color . $data_local_stroke_color . $data_local_fill_color . $data_poi_fill_color . $data_administrative_color . $data_landscape_color . $data_road_text_color . $data_road_arterial_fill_color . $data_road_arterial_stroke_color;
			$output .= '></div>';
			$output .= '</div>';
			$output .= '</div>';
			return $output;
		}

		return;
	}

	public function scripts() {

		$app = JFactory::getApplication();
		$doc = JFactory::getDocument();
		
		jimport('joomla.application.component.helper');
		$params = JComponentHelper::getParams('com_sppagebuilder');
		$gmap_api = $params->get('gmap_api', '');
		$api_key = (isset($this->addon->settings->api_key) && $this->addon->settings->api_key) ? $this->addon->settings->api_key : '';
		$api_key = (isset($this->addon->settings->api_key) && $this->addon->settings->api_key) ? $this->addon->settings->api_key : '';
	
		if($gmap_api != '') {
			return array(
				'//maps.googleapis.com/maps/api/js?key='. $gmap_api,
				JURI::base(true) . '/templates/' . $app->getTemplate() . '/js/gmap.js'
			);
		} 
		else {
			return array(
				'//maps.googleapis.com/maps/api/js?key='. $api_key,
				JURI::base(true) . '/templates/' . $app->getTemplate() . '/js/gmap.js'
			);
		}	
	}

	public function css() {
		$addon_id = '#sppb-addon-' . $this->addon->id;
		$height = (isset($this->addon->settings->height) && $this->addon->settings->height) ? $this->addon->settings->height : 0;

		$css = '';
		if($height) {
			$css .= $addon_id . ' .sppb-addon-gmap-canvas {';
			$css .= 'height:' . (int) $height . 'px;';
			$css .= '}';
		}

		return $css;
	}
}
