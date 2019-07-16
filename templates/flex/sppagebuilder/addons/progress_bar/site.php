<?php
/**
 * Flex 1.0 @package SP Page Builder
 * Template Name - Flex
 * @author Aplikko http://www.aplikko.com
 * @copyright Copyright (c) 2015 Aplikko
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
// no direct access
defined('_JEXEC') or die;

AddonParser::addAddon('sp_progress_bar','sp_progress_bar_addon');

function sp_progress_bar_addon($atts, $content){
	
	$doc = JFactory::getDocument();
	$app = JFactory::getApplication();
	
	extract(spAddonAtts(array(
		"type" => '',
		"custom_color" => '',
		"custom_height" => '',
		"progress" => '',
		"text" => '',
		"text_color" => '',
		"stripped" => '',
		"active" => '',
		"animation_duration" => '',
		"animation_delay" => '',
		"class" => ''
		), $atts));
	
	$randomid = rand(1,100);
	$animation_duration != '' ? $animation_duration : $animation_duration = '2';
	$animation_delay != '' ? $animation_delay = ' '.$animation_delay . 's' : $animation_delay = '';
	
	// Add style for animation
	$style = '.sppb-progress-'.$randomid.' .sppb-progress-bar{'
			. '-webkit-transition:' . $animation_duration . 's ease'.$animation_delay.';'
			. 'transition:' . $animation_duration . 's ease'.$animation_delay.';'
			. '}';
	$doc->addStyleDeclaration($style);
	
	
	if($type == 'flex') {
		$output  = '<div style="color:'.$text_color.';" class="flex-text-wrapper"><div class="flex-text">' . $text . '</div><div class="flex-progress-text">' . $progress . '%</div></div><div';
		$output .= ($custom_height !='') ? ' style="height:'.$custom_height.'px;line-height:'.$custom_height.'px;"' : '';
		$output .= ' class="sppb-progress sppb-progress-'.$randomid.' ' . $class . '">';
		$output .= '<div';
		$output .= ($custom_color !='') ? ' style="background-color:'.$custom_color.';line-height:'.$custom_height.'px;"' : '';
		$output .= ' class="sppb-progress-bar ' . $type . ' ' . $stripped . ' ' . $active . '" role="progressbar" aria-valuenow="' . (int) $progress . '" aria-valuemin="0" aria-valuemax="100" data-width="' . (int) $progress . '%">';
	
	} else {
		
		$output  = '<div';
		$output .= ($custom_height !='') ? ' style="height:'.$custom_height.'px;line-height:'.$custom_height.'px;"' : '';
		$output .= ' class="sppb-progress sppb-progress-'.$randomid.' ' . $class . '">';
		$output .= '<div';
		$output .= ($custom_color !='') ? ' style="background-color:'.$custom_color.';line-height:'.$custom_height.'px;"' : '';
		$output .= ' class="sppb-progress-bar ' . $type . ' ' . $stripped . ' ' . $active . '" role="progressbar" aria-valuenow="' . (int) $progress . '" aria-valuemin="0" aria-valuemax="100" data-width="' . (int) $progress . '%">';
	}
	
	
	if($text && $type != 'flex') {
		$output .= $text;
	}
	
	$output .= '</div>';
	$output .= '</div>';

	return $output;
	
}