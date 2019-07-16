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

class SppagebuilderAddonAccordion extends SppagebuilderAddons {

	public function render() {

		$class = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';
		$style = (isset($this->addon->settings->style) && $this->addon->settings->style) ? $this->addon->settings->style : 'panel-flex';
		$title = (isset($this->addon->settings->title) && $this->addon->settings->title) ? $this->addon->settings->title : '';
		$show_collapse = (isset($this->addon->settings->show_collapse) && $this->addon->settings->show_collapse) ? $this->addon->settings->show_collapse : '';
		$heading_selector = (isset($this->addon->settings->heading_selector) && $this->addon->settings->heading_selector) ? $this->addon->settings->heading_selector : 'h3';

		$output   = '';
		$output  = '<div class="sppb-addon sppb-addon-accordion ' . $class . '">';

		if($title) {
			$output .= '<'.$heading_selector.' class="sppb-addon-title">' . $title . '</'.$heading_selector.'>';
		}

		$output .= '<div class="sppb-addon-content">';
		$output	.= '<div class="sppb-panel-group">';

		foreach ($this->addon->settings->sp_accordion_item as $key => $item) {
			
			$output  .= '<div class="sppb-panel sppb-'. $style .'">';
			
			if ($show_collapse != 1) {
				$output  .= '<div class="sppb-panel-heading'. (($key == 0) ? ' active' : '') .'">';
			} else {
				$output  .= '<div class="sppb-panel-heading">';
			}
			
			$output  .= '<span class="sppb-panel-title">';
			
			if ($item->peicon_name) {
				$output .= '<i class="pe ' . $item->peicon_name . '"></i>';
			} else {
				if($item->icon != '') {
				   $output .= '<i class="fa ' . $item->icon . '"></i>';
				}
			}
			
			$output  .= $item->title;
			$output  .= '</span>';
			//$output  .= '<span class="sppb-toggle-direction"></span>';
			$output  .= '</div>';
			//$output  .= '<div class="sppb-panel-collapse"' . (($key != 0) ? ' style="display: none;"' : '') . '>';
			if ($show_collapse != 1) {
				$output  .= '<div class="sppb-panel-collapse"' . (($key != 0) ? ' style="display: none;"' : '') . '>';
			} else {
				$output  .= '<div class="sppb-panel-collapse" style="display: none;">';
			}
			$output  .= '<div class="sppb-panel-body">';
			$output  .= $item->content;
			$output  .= '</div>';
			$output  .= '</div>';
			$output  .= '</div>';
		}

		$output  .= '</div>';
		$output  .= '</div>';
		$output  .= '</div>';

		return $output;
	}
}
