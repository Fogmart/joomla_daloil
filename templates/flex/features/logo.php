<?php
/**
 * @package Helix3 Framework
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2015 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
*/
//no direct accees
defined ('_JEXEC') or die('resticted aceess');
 
class Helix3FeatureLogo {

	private $helix3;
	public $position;

	public function __construct( $helix3 ){
		$this->helix3 = $helix3;
		$this->position = $this->helix3->getParam('logo_position', 'logo');
		$this->load_pos = $this->helix3->getParam('logo_load_pos');
	}

	public function renderFeature() {


		$extention = '';
		//Retina Image
		if( $this->helix3->getParam('logo_type') == 'image' ) {
			jimport('joomla.image.image');

			if( $this->helix3->getParam('logo_image') ) {
				$path = JPATH_ROOT . '/' . $this->helix3->getParam('logo_image');
			} else {
				$path = JPATH_ROOT . '/templates/' . $this->helix3->getTemplate() . '/images/presets/' . $this->helix3->Preset() . '/logo.png';
			}

			// Detecting SVG 
			$extention = explode('.', $this->helix3->getParam('logo_image'));
 			$extention = end($extention);
			
			// Fix for SVG image for logo
			if ($extention != 'svg') {
			
				// Other images (jpg, png, gif)
				if(file_exists($path)) {
					$image = new JImage( $path );
					$width 	= $image->getWidth();
					$height = $image->getHeight();
				} else {
					$width 	= '';
					$height = '';
				}	
				
			}
			
		}

		$html  = '';
		$custom_logo_class = '';
		$sitename = JFactory::getApplication()->get('sitename');

		if( $this->helix3->getParam('mobile_logo') ) {
			$custom_logo_class = ' hidden-xs';
		}



		if( $this->helix3->getParam('logo_type') == 'image' ) {
			if( $this->helix3->getParam('logo_image') ) {
				$html .= '<a class="logo" href="' . JURI::base(true) . '/">';
				
			if ($extention != 'svg') {
			  $html .= '<img class="sp-default-logo'. $custom_logo_class .'" src="' . $this->helix3->getParam('logo_image') . '" alt="'. $sitename .'">';
			} else {
				$html .= '<img style="width:100%;height:100%;" src="' . $this->helix3->getParam('logo_image') . '" alt="'. $sitename .'">';
			}
				
			
			// Detecting SVG for retina
			$extention_2x = explode('.', $this->helix3->getParam('logo_image_2x'));
 			$extention_2x = end($extention_2x);
			
				if ($extention_2x != 'svg') {
					if( $this->helix3->getParam('logo_image_2x') ) {
						$html .= '<img class="sp-retina-logo'. $custom_logo_class .'" src="' . $this->helix3->getParam('logo_image_2x') . '" alt="'. $sitename .'" width="' . $width . '" height="' . $height . '" />';
					}
				} else {
					$html .= '<img style="width:' . $width . 'px;height:' . $height . 'px;" src="' . $this->helix3->getParam('logo_image_2x') . '" alt="'. $sitename .'" />';
				}
				

				if( $this->helix3->getParam('mobile_logo') ) {
					$html .= '<img class="sp-default-logo visible-xs-block" src="' . $this->helix3->getParam('mobile_logo') . '" alt="'. $sitename .'">';
				}

				$html .= '</a>';
			} else {
				$html .= '<a class="logo" href="' . JURI::base(true) . '/">';
				$html .= '<img class="sp-default-logo'. $custom_logo_class .'" src="' . $this->helix3->getTemplateUri() . '/images/presets/' . $this->helix3->Preset() . '/logo.png" alt="'. $sitename .'">';
				$html .= '<img class="sp-retina-logo'. $custom_logo_class .'" src="' . $this->helix3->getTemplateUri() . '/images/presets/' . $this->helix3->Preset() . '/logo@2x.png" alt="'. $sitename .'" width="' . $width . '" height="' . $height . '">';

				if( $this->helix3->getParam('mobile_logo') ) {
					$html .= '<img class="sp-default-logo visible-xs-block" src="' . $this->helix3->getParam('mobile_logo') . '" alt="'. $sitename .'">';
				}

				$html .= '</a>';
			}
			
		} else {
			if( $this->helix3->getParam('logo_text') ) {
				$html .= '<h1 class="logo"> <a href="' . JURI::base(true) . '/">' . $this->helix3->getParam('logo_text') . '</a></h1>';
			} else {
				$html .= '<h1 class="logo"> <a href="' . JURI::base(true) . '/">' . $sitename . '</a></h1>';
			}

			if( $this->helix3->getParam('logo_slogan') ) {
				$html .= '<p class="logo-slogan">' . $this->helix3->getParam('logo_slogan') . '</p>';
			}
		}
		
		return $html;
	}

}