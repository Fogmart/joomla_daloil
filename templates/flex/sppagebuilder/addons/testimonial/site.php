<?php
/**
 * Flex @package SP Page Builder
 * Template Name - Flex
 * @author Aplikko http://www.aplikko.com
 * @copyright Copyright (c) 2016 Aplikko
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
// no direct access
defined ('_JEXEC') or die ('restricted aceess');

class SppagebuilderAddonTestimonial extends SppagebuilderAddons {

	public function render() {

		$class = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';
		$style = (isset($this->addon->settings->style) && $this->addon->settings->style) ? $this->addon->settings->style : '';
		$title = (isset($this->addon->settings->title) && $this->addon->settings->title) ? $this->addon->settings->title : '';
		$heading_selector = (isset($this->addon->settings->heading_selector) && $this->addon->settings->heading_selector) ? $this->addon->settings->heading_selector : 'h3';

		//Options
		$review = (isset($this->addon->settings->review) && $this->addon->settings->review) ? $this->addon->settings->review : '';
		$name = (isset($this->addon->settings->name) && $this->addon->settings->name) ? $this->addon->settings->name : '';
		$company = (isset($this->addon->settings->company) && $this->addon->settings->company) ? $this->addon->settings->company : '';
		$avatar = (isset($this->addon->settings->avatar) && $this->addon->settings->avatar) ? $this->addon->settings->avatar : '';
		$avatar_width = (isset($this->addon->settings->avatar_width) && $this->addon->settings->avatar_width) ? $this->addon->settings->avatar_width : '';
		$avatar_position = (isset($this->addon->settings->avatar_position) && $this->addon->settings->avatar_position) ? $this->addon->settings->avatar_position : 'left';
		$link = (isset($this->addon->settings->link) && $this->addon->settings->link) ? $this->addon->settings->link : '';
		$link_target = (isset($this->addon->settings->link_target) && $this->addon->settings->link_target) ? ' target="' . $this->addon->settings->link_target . '"' : '';
		
		$link != '' ? $link = $link : '';
		$link_strip = preg_replace("/^(http:\/\/|https:\/\/)/", "", $link);

		//Output
		$output  = '<div class="sppb-addon sppb-addon-testimonial ' . $class . '">';
		$output .= ($title) ? '<'.$heading_selector.' class="sppb-addon-title">' . $title . '</'.$heading_selector.'>' : '';
		$output .= '<div class="sppb-addon-content">';

		if($style == 'flex') {
		$output .= '<div class="sppb-media flex">';
		
		if ($avatar) {
			if ($link != '') {
				$output .= '<a target="' . $link_target . '" class="pull-'.$avatar_position.'" href="'.$link.'" data-toggle="tooltip" data-placement="top" title="'.$link_strip.'">';
				$output .= '<img class="sppb-media-object" src="'.$avatar.'" width="' . $avatar_width . '" alt="'.$name.'">';
				$output .= '</a>';
			} else {
				$output .= '<img class="sppb-media-object pull-'.$avatar_position.'" src="'.$avatar.'" width="' . $avatar_width . '" alt="'.$name.'">';
			}
		} else {
			if ($link != '') {
			$output .= '<a target="' . $link_target . '" class="pull-'.$avatar_position.'" href="'.$link.'" data-toggle="tooltip" data-placement="top" title="'.$link_strip.'">';
			$output .= '<i style="width:' . $avatar_width . 'px;height:' . ( $avatar_width + 5 ) . 'px;line-height:' . ( $avatar_width + 3 ) . 'px;font-size:' . ( $avatar_width / 1.8 ) . 'px;" class="fa fa-user"></i>';
			$output .= '</a>';	
			} else {
				$output .= '<i style="width:' . $avatar_width . 'px;height:' . ( $avatar_width + 5 ) . 'px;line-height:' . ( $avatar_width + 3 ) . 'px;font-size:' . ( $avatar_width / 1.8 ) . 'px;" class="fa fa-user pull-'.$avatar_position.'"></i>';
			}
		}
		
		$output .= '<div style="text-align:'.$avatar_position.'" class="sppb-media-body">';
		$output .= '<i class="fa fa-quote-left"></i>';
		$output .= $review;
		$output .= '<i class="fa fa-quote-right"></i>';
		$output .= '<footer class="pull-'.$avatar_position.'"><strong><em>'.$name.'</em></strong> <cite>'.$company.'</cite></footer>';
		$output .= '</div>';
		
		$output .= '</div>';
	
		} else {
	
		$output .= '<div class="sppb-media default">';
		
		if ($avatar) {
			if ($link != '') {
				$output .= '<a target="' . $link_target . '" class="pull-'.$avatar_position.'" href="'.$link.'">';
				$output .= '<img class="sppb-media-object" src="'.$avatar.'" width="' . $avatar_width . '" alt="'.$name.'">';
				$output .= '</a>';
			} else {
				$output .= '<img class="sppb-media-object pull-'.$avatar_position.'" src="'.$avatar.'" width="' . $avatar_width . '" alt="'.$name.'">';
			}
		} else {
			if ($link != '') {
			$output .= '<a target="' . $link_target . '" class="pull-'.$avatar_position.'" href="'.$link.'">';
			$output .= '<i style="width:' . $avatar_width . 'px;height:' . ( $avatar_width + 1 ) . 'px;line-height:' . ( $avatar_width - 2 ) . 'px;font-size:' . ( $avatar_width / 1.8 ) . 'px;" class="fa fa-user"></i>';
			$output .= '</a>';	
			} else {
				$output .= '<i style="width:' . $avatar_width . 'px;height:' . ( $avatar_width + 1 ) . 'px;line-height:' . ( $avatar_width - 2 ) . 'px;font-size:' . ( $avatar_width / 1.8 ) . 'px;" class="fa fa-user pull-'.$avatar_position.'"></i>';
			}
		}
	
		$output .= '<div class="sppb-media-body">';
		$output .= '<div>';
		$output .= $review;
		$output .= '<footer><strong>'.$name.'</strong> <cite>'.$company.'</cite></footer>';
		$output .= '</div>';
		$output .= '</div>';
			
		
		$output .= '</div>';
	
	}
	
		$output .= '</div>';
	
		$output .= '</div>';
	
		return $output;

	}
}
