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

class SppagebuilderAddonIcon extends SppagebuilderAddons {

	public function render() {

		$class = (isset($this->addon->settings->alignment) && $this->addon->settings->alignment) ? ' ' . $this->addon->settings->alignment : '';
		$class .= (isset($this->addon->settings->hover_effect) && $this->addon->settings->hover_effect) ? ' sppb-icon-hover-effect-' . $this->addon->settings->hover_effect : '';
		$peicon_name = (isset($this->addon->settings->peicon_name) && $this->addon->settings->peicon_name) ? $this->addon->settings->peicon_name : '';
		$icon_name = (isset($this->addon->settings->icon_name) && $this->addon->settings->icon_name) ? $this->addon->settings->icon_name : '';
		$css_class = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';

		if($icon_name || $peicon_name) {
			$output   = '<div class="sppb-icon ' . $class . '">';
			$output  .= '<span class="sppb-icon-inner ' . $css_class . '">';
			
			if ($peicon_name != '') {
				$output  .= '<i class="pe ' . $peicon_name . '"></i>';
			}else{
				$output  .= '<i class="fa ' . $icon_name . '"></i>';
			}
			$output  .= '</span>';
			$output  .= '</div>';
			return $output;
		}
		
	}

	public function css() {
		$addon_id = '#sppb-addon-' . $this->addon->id;

		// Normal
		$icon_style  = (isset($this->addon->settings->margin) && $this->addon->settings->margin) ? 'margin: ' . $this->addon->settings->margin . ';' : '';
		$icon_style .= (isset($this->addon->settings->height) && $this->addon->settings->height) ? 'height: ' . (int) $this->addon->settings->height . 'px;' : '';
		$icon_style .= (isset($this->addon->settings->width) && $this->addon->settings->width) ? 'width: ' . (int) $this->addon->settings->width . 'px;' : '';
		$icon_style .= (isset($this->addon->settings->color) && $this->addon->settings->color) ? 'color: ' . $this->addon->settings->color . ';' : '';
		$icon_style .= (isset($this->addon->settings->background) && $this->addon->settings->background) ? 'background-color: ' . $this->addon->settings->background . ';' : '';
		$icon_style .= (isset($this->addon->settings->border_color) && $this->addon->settings->border_color) ? 'border-style: solid; border-color: ' . $this->addon->settings->border_color . ';' : '';
		$icon_style .= (isset($this->addon->settings->border_width) && $this->addon->settings->border_width) ? 'border-width: ' . (int) $this->addon->settings->border_width . 'px;' : '';
		$icon_style .= (isset($this->addon->settings->border_radius) && $this->addon->settings->border_radius) ? 'border-radius: ' . (int) $this->addon->settings->border_radius . 'px;' : '';
		
		// Padding
		$icon_style .= (isset($this->addon->settings->padding) && $this->addon->settings->padding) ? 'padding: ' . (int) $this->addon->settings->padding . 'px;' : '';
		
		$font_size = (isset($this->addon->settings->size) && $this->addon->settings->size) ? 'font-size: ' . (int) $this->addon->settings->size . 'px;' : '';
		$font_size .= (isset($this->addon->settings->height) && $this->addon->settings->height) ? 'line-height: ' . (int) $this->addon->settings->height . 'px;' : '';
		
		

		// Mouse Hover
		$icon_style_hover  = (isset($this->addon->settings->hover_color) && $this->addon->settings->hover_color) ? 'color: ' . $this->addon->settings->hover_color . ';' : '';
		$icon_style_hover .= (isset($this->addon->settings->hover_background) && $this->addon->settings->hover_background) ? 'background-color: ' . $this->addon->settings->hover_background . ';' : '';
		$icon_style_hover .= (isset($this->addon->settings->hover_border_color) && $this->addon->settings->hover_border_color) ? 'border-color: ' . $this->addon->settings->hover_border_color . ';' : '';
		$icon_style_hover .= (isset($this->addon->settings->hover_border_width) && $this->addon->settings->hover_border_width) ? 'border-width: ' . (int) $this->addon->settings->hover_border_width . 'px;' : '';
		$icon_style_hover .= (isset($this->addon->settings->hover_border_radius) && $this->addon->settings->hover_border_radius) ? 'border-radius: ' . (int) $this->addon->settings->hover_border_radius . 'px;' : '';

		$css = '';
		if($icon_style) {
			$css .= $addon_id . ' .sppb-icon-inner {';
			$css .= $icon_style;
			$css .= '}' . "\n"	;
		}

		if($font_size) {
			$css .= $addon_id . ' .sppb-icon-inner i {';
			$css .= $font_size;
			$css .= '}' . "\n"	;
		}

		// Hover
		if($icon_style_hover) {
			$css .= $addon_id . ' .sppb-icon-inner:hover {';
			$css .= $icon_style_hover;
			$css .= "\n" . '}' . "\n"	;
		}

		return $css;
	}
}
