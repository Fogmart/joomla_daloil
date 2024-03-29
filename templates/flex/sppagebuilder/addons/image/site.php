<?php
/**
 * Flex @package SP Page Builder
 * Template Name - Flex
 * @author Aplikko http://www.aplikko.com
 * @copyright Copyright (c) 2017 Aplikko
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
// no direct access
defined('_JEXEC') or die;

class SppagebuilderAddonImage extends SppagebuilderAddons{

	public function render() {

		$class = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';
		$title = (isset($this->addon->settings->title) && $this->addon->settings->title) ? $this->addon->settings->title : '';
		$heading_selector = (isset($this->addon->settings->heading_selector) && $this->addon->settings->heading_selector) ? $this->addon->settings->heading_selector : 'h3';

		//Options
		$image = (isset($this->addon->settings->image) && $this->addon->settings->image) ? $this->addon->settings->image : '';
		$alt_text = (isset($this->addon->settings->alt_text) && $this->addon->settings->alt_text) ? $this->addon->settings->alt_text : '';
		$position = (isset($this->addon->settings->position) && $this->addon->settings->position) ? $this->addon->settings->position : '';
		$link = (isset($this->addon->settings->link) && $this->addon->settings->link) ? $this->addon->settings->link : '';
		$target = (isset($this->addon->settings->target) && $this->addon->settings->target) ? 'target="' . $this->addon->settings->target . '"' : '';
		$link_overlay_icon = (isset($this->addon->settings->link_overlay_icon) && $this->addon->settings->link_overlay_icon) ? 1 : 0;
		$open_lightbox = (isset($this->addon->settings->open_lightbox) && $this->addon->settings->open_lightbox) ? $this->addon->settings->open_lightbox : 0;
		$image_overlay = (isset($this->addon->settings->overlay_color) && $this->addon->settings->overlay_color) ? 1 : 0;

		$output = '';
		$image_title = ($title) ? ' title="'.$title.'"' : '';

		if($image) {
			$output  .= '<div class="sppb-addon sppb-addon-single-image ' . $position . ' ' . $class . '">';
			$output .= ($title) ? '<'.$heading_selector.' class="sppb-addon-title">' . $title . '</'.$heading_selector.'>' : '';
			$output .= '<div class="sppb-addon-content">';
			$output .= '<div class="sppb-addon-single-image-container">';

			if (empty($alt_text)) {
				if (!empty($title)) {
					$alt_text = $title;
				} else {
					$alt_text = basename($image);
				}
			}

			if($image_overlay && $open_lightbox) {
				$output .= '<div class="sppb-addon-image-overlay">';
				$output .= '</div>';
			}

			if($open_lightbox) {
				$output .= '<a class="sppb-magnific-popup sppb-addon-image-overlay-icon" data-popup_type="image" data-mainclass="mfp-no-margins mfp-with-zoom" href="' . $image . '">+</a>';
			}
			
			if(!$open_lightbox) {
				if($link_overlay_icon) {
				   $output .= ($link) ? '<a ' . $target . ' href="' . $link . '"><div class="overlay"><i class="pe pe-7s-link"></i>' : '';
				} else {
				   $output .= ($link) ? '<a ' . $target . ' href="' . $link . '">' : '';
				}		
			}

			$output .= '<img class="sppb-img-responsive ' . $class . '" src="' . $image . '" alt="'. $alt_text .'"'. $image_title .' />';
			
			if(!$open_lightbox) {
				if($link_overlay_icon) {
				   $output .= ($link) ? '</div></a>' : '';
				} else {
				   $output .= ($link) ? '</a>' : '';
				}
			}

			$output  .= '</div>';
			$output  .= '</div>';
			$output  .= '</div>';
		}

		return $output;
	}

	public function scripts() {
		return array(JURI::base(true) . '/components/com_sppagebuilder/assets/js/jquery.magnific-popup.min.js');
	}

	public function stylesheets() {
		return array(JURI::base(true) . '/components/com_sppagebuilder/assets/css/magnific-popup.css');
	}

	public function css() {
		$addon_id = '#sppb-addon-' . $this->addon->id;
		$open_lightbox = (isset($this->addon->settings->open_lightbox) && $this->addon->settings->open_lightbox) ? $this->addon->settings->open_lightbox : 0;
		$style = (isset($this->addon->settings->overlay_color) && $this->addon->settings->overlay_color) ? 'background-color: ' . $this->addon->settings->overlay_color . ';' : '';

		$css = '';
		if($open_lightbox && $style) {
			$css .= $addon_id . ' .sppb-addon-image-overlay{' . $style . '}';
		}

		return $css;

	}

}
