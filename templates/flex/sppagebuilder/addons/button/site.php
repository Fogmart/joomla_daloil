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

class SppagebuilderAddonButton extends SppagebuilderAddons {

	public function render() {
		$class = (isset($this->addon->settings->class) && $this->addon->settings->class) ? ' ' . $this->addon->settings->class : '';
		$class .= (isset($this->addon->settings->type) && $this->addon->settings->type) ? ' sppb-btn-' . $this->addon->settings->type : '';
		$class .= (isset($this->addon->settings->size) && $this->addon->settings->size) ? ' sppb-btn-' . $this->addon->settings->size : '';
		$class .= (isset($this->addon->settings->block) && $this->addon->settings->block) ? ' ' . $this->addon->settings->block : '';
		$class .= (isset($this->addon->settings->shape) && $this->addon->settings->shape) ? ' sppb-btn-' . $this->addon->settings->shape: ' sppb-btn-rounded';
		$class .= (isset($this->addon->settings->appearance) && $this->addon->settings->appearance) ? ' sppb-btn-' . $this->addon->settings->appearance : '';
		$attribs = (isset($this->addon->settings->target) && $this->addon->settings->target) ? ' target="' . $this->addon->settings->target . '"': '';
		$attribs .= (isset($this->addon->settings->url) && $this->addon->settings->url) ? ' href="' . $this->addon->settings->url . '"': '';
		$attribs .= ' id="btn-' . $this->addon->id . '"';
		$text = (isset($this->addon->settings->text) && $this->addon->settings->text) ? $this->addon->settings->text: '';
		
		$alignment = (isset($this->addon->settings->alignment) && $this->addon->settings->alignment) ? $this->addon->settings->alignment : 'sppb-text-left';
		
		//Pixeden Icons
		$button_peicon = (isset($this->addon->settings->button_peicon) && $this->addon->settings->button_peicon) ? $this->addon->settings->button_peicon : '';
		$icon = (isset($this->addon->settings->icon) && $this->addon->settings->icon) ? $this->addon->settings->icon: '';
		$icon_position = (isset($this->addon->settings->icon_position) && $this->addon->settings->icon_position) ? $this->addon->settings->icon_position: 'left';
		
		if($icon_position == 'left') {
			if ($button_peicon != '') {
				$text = ($button_peicon) ? '<i class="pe ' . $button_peicon . '"></i> ' . $text : $text;
			}else{
				$text = ($icon) ? '<i class="fa ' . $icon . '"></i> ' . $text : $text;
			}
		} else {
			if ($button_peicon != '') {
				$text = ($button_peicon) ? $text . ' <i style="margin-left:7px;margin-right:-1px;" class="pe ' . $button_peicon . '"></i>' : $text;
			}else{
				$text = ($icon) ? $text . ' <i style="margin-left:5px;margin-right:-1px;" class="fa ' . $icon . '"></i>' : $text;
			}
		}
		
		$centered = '';
		if ($alignment == 'sppb-text-center') {
			$centered = ' style="margin-left:auto;margin-right:auto;"';
		}
		
		$output = '<div class="' . $alignment . '">';
		$output .= '<a' . $attribs . ' class="sppb-btn ' . $class . '"'.$centered.'>' . $text . '</a>';
		$output .= '</div>';

		return $output;
	}

	public function css() {
		$addon_id = '#sppb-addon-' .$this->addon->id;
		$layout_path = JPATH_ROOT . '/components/com_sppagebuilder/layouts';

		$css_path = new JLayoutFile('addon.css.button', $layout_path);

		$options = new stdClass;
		
		$options->button_type = (isset($this->addon->settings->type) && $this->addon->settings->type) ? $this->addon->settings->type : '';
		$options->button_appearance = (isset($this->addon->settings->appearance) && $this->addon->settings->appearance) ? $this->addon->settings->appearance : '';
		$options->button_color = (isset($this->addon->settings->color) && $this->addon->settings->color) ? $this->addon->settings->color : '';
		$options->button_color_hover = (isset($this->addon->settings->color_hover) && $this->addon->settings->color_hover) ? $this->addon->settings->color_hover : '';
		$options->button_background_color = (isset($this->addon->settings->background_color) && $this->addon->settings->background_color) ? $this->addon->settings->background_color : '';
		$options->button_background_color_hover = (isset($this->addon->settings->background_color_hover) && $this->addon->settings->background_color_hover) ? $this->addon->settings->background_color_hover : '';
		$options->button_fontstyle = (isset($this->addon->settings->fontstyle) && $this->addon->settings->fontstyle) ? $this->addon->settings->fontstyle : '';
		$options->button_letterspace = (isset($this->addon->settings->letterspace) && $this->addon->settings->letterspace) ? $this->addon->settings->letterspace : '';

		return $css_path->render(array('addon_id' => $addon_id, 'options' => $options, 'id' => 'btn-' . $this->addon->id));
	}

}
