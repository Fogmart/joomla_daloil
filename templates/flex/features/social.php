<?php
/**
 * @package Helix3 Framework
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2015 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
*/
//no direct accees
defined ('_JEXEC') or die('resticted aceess');

class Helix3FeatureSocial {

	private $helix3;
	public $position;

	public function __construct( $helix3 ){
		$this->helix3 = $helix3;
		$this->position = $this->helix3->getParam('social_position');
		$this->load_pos = $this->helix3->getParam('social_load_pos');
	}

	public function renderFeature() {

		$facebook 	= $this->helix3->getParam('facebook');
		$twitter  	= $this->helix3->getParam('twitter');
		$googleplus = $this->helix3->getParam('googleplus');
		$instagram  = $this->helix3->getParam('instagram');
		$pinterest 	= $this->helix3->getParam('pinterest');
		$youtube 	= $this->helix3->getParam('youtube');
		$linkedin 	= $this->helix3->getParam('linkedin');
		$dribbble 	= $this->helix3->getParam('dribbble');
		$behance 	= $this->helix3->getParam('behance');
		$skype 		= $this->helix3->getParam('skype');
		$whatsapp 	= $this->helix3->getParam('whatsapp');
		$flickr 		= $this->helix3->getParam('flickr');
		$vk 			= $this->helix3->getParam('vk');
		$custom 		= $this->helix3->getParam('custom');

		if( $this->helix3->getParam('show_social_icons') && ( $facebook || $twitter || $googleplus || $instagram || $pinterest || $youtube || $linkedin || $dribbble || $behance || $skype || $whatsapp || $flickr || $vk ) ) {
			$html  = '<ul class="social-icons">';

			if( $facebook ) {
				$html .= '<li><a target="_blank" href="'. $facebook .'"><i class="fa fa-facebook"></i></a></li>';
			}
			if( $twitter ) {
				$html .= '<li><a target="_blank" href="'. $twitter .'"><i class="fa fa-twitter"></i></a></li>';
			}
			if( $googleplus ) {
				$html .= '<li><a target="_blank" href="'. $googleplus .'"><i class="fa fa-google-plus"></i></a></li>';
			}
          	if( $instagram ) {
				$html .= '<li ><a target="_blank" href="'. $instagram .'"><i class="fa fa-instagram"></i></a></li>';
			}
			if( $pinterest ) {
				$html .= '<li><a target="_blank" href="'. $pinterest .'"><i class="fa fa-pinterest"></i></a></li>';
			}
			if( $youtube ) {
				$html .= '<li><a target="_blank" href="'. $youtube .'"><i class="fa fa-youtube"></i></a></li>';
			}
			if( $linkedin ) {
				$html .= '<li><a target="_blank" href="'. $linkedin .'"><i class="fa fa-linkedin"></i></a></li>';
			}
			if( $dribbble ) {
				$html .= '<li><a target="_blank" href="'. $dribbble .'"><i class="fa fa-dribbble"></i></a></li>';
			}
			if( $behance ) {
				$html .= '<li><a target="_blank" href="'. $behance .'"><i class="fa fa-behance"></i></a></li>';
			}
			if( $flickr ) {
				$html .= '<li><a target="_blank" href="'. $flickr .'"><i class="fa fa-flickr"></i></a></li>';
			}
			if( $vk ) {
				$html .= '<li><a target="_blank" href="'. $vk .'"><i class="fa fa-vk"></i></a></li>';
			}
			if( $skype ) {
				$html .= '<li><a href="skype:'. $skype .'?chat"><i class="fa fa-skype"></i></a></li>';
			}
			if( $whatsapp ) {
				$html .= '<li><a href="whatsapp://send?abid='. $whatsapp .'&text=Hi"><i class="fa fa-whatsapp"></i></a></li>';
			}

			if( $custom ) {
				$explt_custom = explode(' ', $custom);
				//$html .= '<li><a href="'. $explt_custom[1] .'"><i class="fa '. $explt_custom[0] .'"></i></a></li>';
				$html .= '<li><a target="_blank" href="'. $explt_custom[1] .'"><i class="fa '. $explt_custom[0] .'"></i></a></li>';
			}

			$html .= '</ul>';

			return $html;
		}

	}
}