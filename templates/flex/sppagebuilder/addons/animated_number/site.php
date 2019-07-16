<?php
/**
 * Flex @package SP Page Builder
 * Template Name - Flex
 * @author Aplikko http://www.aplikko.com
 * @copyright Copyright (c) 2016 Aplikko
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
// no direct access
defined('_JEXEC') or die;

AddonParser::addAddon('sp_animated_number','sp_animated_number_addon');

function sp_animated_number_addon($atts){

	extract(spAddonAtts(array(
		'number'				=> '',
		'number_addtext'    => '',
		'duration'			=> '',
		'font_size'			=> '',
		'border_color' 		=> '',
		'border_width' 		=> '',
		'border_radius' 		=> '',
		'color' 				=> '',
		'background' 		=> '',
		'counter_title' 		=> '',
		'title_font_size'	=> '',
		'counter_color' 		=> '',
		'alignment'			=> '',
		'class'				=>'',
		), $atts));

	$style 			= '';
	$number_style 	= '';
	$text_style 	= '';

	if($background) $class .= $class . ' sppb-hasbg';

	if($background) $style .= 'background-color:' . $background  . ';';
	if($border_color) $style .= 'border-style:solid;border-color:' . $border_color  . ';';
	
	$border_width != '' ? $padding = 'padding:20px;' : $padding = '';
	$class == 'shadow' ? $shadow = 'box-shadow:0 0 15px rgba(0,0,0,0.2);text-shadow: 1px 2px 2px rgba(0,0,0,0.2);padding:20px;' : $shadow = '';
	$class == 'padding' ? $paddingbox = 'padding:20px;' : $paddingbox = '';
	
	if($border_width) $style .= 'border-width:' . (int) $border_width  . 'px;';
	if($border_radius) $style .= 'border-radius:' . (int) $border_radius  . 'px;';
	if($color) $number_style .= 'color:' . $color  . ';';
	if($font_size) $number_style .= 'font-size:' . (int) $font_size . 'px;line-height:1.2;';

	if($counter_color) $text_style .= 'color:' . $counter_color  . ';';
	if($title_font_size) $text_style .= 'font-size:' . (int) $title_font_size . 'px;line-height:1.5;';
	
	$number_addtext != '' ? $number_addtext = '<span style="'. $number_style .'" class="number_addtext">'. $number_addtext .'</span>' : $number_addtext = '';

	$output  = '<div class="sppb-addon sppb-addon-animated-number '. $alignment . ' ' . $class .'">';

	$output .= '<div class="sppb-addon-content" style="' . $paddingbox . $padding . $style . $shadow . '">';
	$output .= '<span class="sppb-animated-number" data-digit="'. $number .'" data-duration="' . $duration . '" style="'. $number_style .'">0</span>'. $number_addtext .'';
	if($counter_title) $output .= '<div class="sppb-animated-number-title" style="' . $text_style . '">' . $counter_title . '</div>';
	$output .= '</div>';

	$output .= '</div>';

	return $output;
	
}