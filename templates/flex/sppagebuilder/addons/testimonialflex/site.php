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

AddonParser::addAddon('sp_testimonialflex','sp_testimonialflex_addon');
AddonParser::addAddon('sp_testimonialflex_item','sp_testimonialflex_item_addon');

function sp_testimonialflex_addon($atts, $content){
	
	global $sppbtestimonialflexParam;
	
	$doc = JFactory::getDocument();

	extract(spAddonAtts(array(
		"autoplay"=>'',
		"autoplay_interval"=>'',
		"arrows"=>'',
		"class"=>'',
		), $atts));

	$sppbtestimonialflexParam['class'] = $class;

	$carousel_autoplay = ($autoplay) ? 'data-sppb-ride="sppb-carousel"' : '';
	$carousel_autoplay_interval = ($autoplay) ? ' data-interval="'.$autoplay_interval.'"' : '';

	$output  = '<div class="sppb-carousel sppb-testimonial-flex sppb-slide ' . $class . ' sppb-text-center" ' . $carousel_autoplay . $carousel_autoplay_interval .'>';

	$output .= '<div class="sppb-carousel-inner">';
	$output .= AddonParser::spDoAddon($content);
	$output	.= '</div>';

	if($arrows) {
		$output	.= '<a class="left sppb-carousel-control" role="button" data-slide="prev"><i class="fa fa-angle-left"></i></a>';
		$output	.= '<a class="right sppb-carousel-control" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a>';
	}
	
	$output .= '</div>';

	return $output;

}

function sp_testimonialflex_item_addon( $atts ){
	
	global $sppbtestimonialflexParam;

	extract(spAddonAtts(array(
		"title" => '',
		"avatar" => '',
		"avatar_position" => 'center',
		"avatar_style" => '',
		'message' => '',
		"url" => '',
		"link_target" => '',
		), $atts));
		
	$class = $sppbtestimonialflexParam['class'];
	
	$output   = '<div class="sppb-item">';
	
	$title = '<h4 class="pro-client-name">'. $title .'</h4>';

	if($url) $title .= '<a target="' . $link_target . '" href="'.$url.'"><em class="pro-client-url">'. $url .'</em></a>';
	
	
	$output .= '<div class="sppb-media flex">';
	$output .= '<div class="pull-'.$avatar_position.'">';
	if($avatar) $output .= '<img class="sppb-img-responsive sppb-avatar '. $avatar_style .'" src="'. $avatar .'" alt="">';

	$output .= '</div>';
	
	$output .= '<div style="text-align:'.$avatar_position.'" class="sppb-media-body">';
	if($class == 'flex') $output .= '<i class="fa fa-quote-left"></i>';
	$output .= $message;
	if($class == 'flex') $output .= '<i class="fa fa-quote-right"></i>';
	if($title) $output .= '<div class="sppb-testimonial-client">' . $title . '</div>';
	$output .= '</div>';
	$output .= '</div>';
	
	
	$output  .= '</div>';

	return $output;

}