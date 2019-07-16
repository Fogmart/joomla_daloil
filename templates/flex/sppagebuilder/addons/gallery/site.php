<?php
/**
 * Flex @package SP Page Builder
 * Template Name - Flex
 * @author Aplikko http://www.aplikko.com
 * @copyright Copyright (c) 2016 Aplikko
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
// no direct access
defined ('_JEXEC') or die ('restricted access');

class SppagebuilderAddonGallery extends SppagebuilderAddons{

	public function render() {

		$class = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';
		$title = (isset($this->addon->settings->title) && $this->addon->settings->title) ? $this->addon->settings->title : '';
		$heading_selector = (isset($this->addon->settings->heading_selector) && $this->addon->settings->heading_selector) ? $this->addon->settings->heading_selector : 'h3';

		//Options
		$width = (isset($this->addon->settings->width) && $this->addon->settings->width) ? $this->addon->settings->width : 200;
		$height = (isset($this->addon->settings->height) && $this->addon->settings->height) ? $this->addon->settings->height : 200;
		
		$thumbs_gap = (isset($this->addon->settings->thumbs_gap) && $this->addon->settings->thumbs_gap) ? $this->addon->settings->thumbs_gap : '';


		if ($thumbs_gap < 1) {
			$thumbs_margin = '';
		} else {
			$thumbs_gap != '' ? $thumbs_margin = ' style="margin:-' . $thumbs_gap . 'px;"' : $thumbs_margin = '';
		}
		$output  = '<div class="sppb-addon sppb-addon-gallery ' . $class . '">';
		$output .= ($title) ? '<'.$heading_selector.' class="sppb-addon-title">' . $title . '</'.$heading_selector.'>' : '';
		$output .= '<div class="sppb-addon-content">';
		$output .= '<ul' . $thumbs_margin . ' class="sppb-gallery clearfix">';
		
		if ( $thumbs_gap < '1' ) {
			$thumbs_padding = '';
		} else {
			$thumbs_gap != '' ? $thumbs_padding = ' style="padding:' .$thumbs_gap. 'px;"' : $thumbs_padding = '';
		}

		foreach ($this->addon->settings->sp_gallery_item as $key => $value) {
			if($value->thumb) {
				$output .= '<li'.$thumbs_padding.'>';
				$output .= ($value->full) ? '<a href="' . $value->full . '" class="sppb-gallery-btn">' : '';
				$output .= '<img class="sppb-img-responsive" src="' . $value->thumb . '" width="' . $width . '" height="' . $height . '" alt="' . $value->title . '">';
				$output .= ($value->full) ? '</a>' : '';
				$output .= '</li>';
			}
		}

		$output .= '</ul>';
		$output	.= '</div>';
		$output .= '</div>';

		return $output;
	}

	public function stylesheets() {
		return array(JURI::base(true) . '/components/com_sppagebuilder/assets/css/magnific-popup.css');
	}

	public function scripts() {
		return array(JURI::base(true) . '/components/com_sppagebuilder/assets/js/jquery.magnific-popup.min.js');
	}

	public function js() {

		$js ='jQuery(function($){
			$(document).magnificPopup({
				delegate: ".sppb-gallery-btn",
				type: "image",
				mainClass: "mfp-no-margins mfp-with-zoom",
				gallery:{
					enabled:true
				},
				image: {
					verticalFit: true
				},
				zoom: {
					enabled: true,
					duration: 300
				}
			});
		})';
		$js = preg_replace('/[\n\t]+/m', '', $js); // Remove whitespace
		return $js;
	}

}
