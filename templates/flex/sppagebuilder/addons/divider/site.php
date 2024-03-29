<?php
/**
 * Flex @package SP Page Builder
 * Template Name - Flex
 * @author Aplikko http://www.aplikko.com
 * @copyright Copyright (c) 2016 Aplikko
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct access
defined ('_JEXEC') or die ('resticted aceess');

AddonParser::addAddon('sp_divider','sp_divider_addon');

function sp_divider_addon($atts, $content){

	extract(spAddonAtts(array(
		'divider_type'			=> '',
		'margin_top'				=> '',
		'margin_bottom'			=> '',
		'border_color'			=> '',
		'border_style'			=> '',
		'border_width'			=> '',
		'divider_image'			=> '',
		'background_repeat'		=> '',
		'background_position'	=> '',
		'divider_height'		=> '',
		'class'					=> '',
		), $atts));

	$style 					= '';
	$style1 					= '';
	$style2 					= '';
	$class != '' ? $divider_class = ' '.$class : $divider_class = '';

	if($margin_top) $style .= 'margin-top:' . (int) $margin_top  . 'px;';

	if($margin_bottom) $style .= 'margin-bottom:' . (int) $margin_bottom  . 'px;';

	if($border_color) $style1 .= 'border-bottom-color:' . $border_color  . ';';

	if($border_style) $style1 .= 'border-bottom-style:' . $border_style  . ';';

	if($border_width) $style1 .= 'border-bottom-width:' . (int) $border_width  . 'px;';

	if($divider_height) $style2 .= 'height:' . (int) $divider_height  . 'px;';

	if($divider_image) $style2 .= 'background-image: url(' . JURI::base(true) . '/' . $divider_image  . ');background-repeat:' . $background_repeat . ';background-position:50% 50%;';
	
	if($divider_type == 'image') {
		$output = '<div class="sppb-divider sppb-divider-'.$divider_type.''.$divider_class.'" style="'.$style.' '. $style2 .'"></div>';
	} else {
		$output = '<div class="sppb-divider sppb-divider-'.$divider_type.''.$divider_class.'" style="'.$style.' '. $style1 .'"></div>';
	}

	return $output;
}