<?php
/**
 * @package Helix3 Framework
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2014 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
*/
//no direct access
defined ('_JEXEC') or die('resticted aceess');

class Helix3FeatureContact {

	private $helix3;

	public function __construct($helix3){
		$this->helix3 = $helix3;
		$this->position = $this->helix3->getParam('contact_position');
	}
	
	public function renderFeature() {
		
		$this->helix3->getParam('contact_phone_icon') != '' ? $contact_phone_icon = '<i class="'.$this->helix3->getParam('contact_phone_icon').'"></i> ' : $contact_phone_icon = '<i class="pe pe-7s-headphones"></i> ';
		$this->helix3->getParam('contact_mobile_icon') != '' ? $contact_mobile_icon = '<i class="'.$this->helix3->getParam('contact_mobile_icon').'"></i> ' : $contact_mobile_icon = '<i class="pe pe-7s-phone"></i> ';
		$this->helix3->getParam('contact_email_icon') != '' ? $contact_email_icon = '<i class="'.$this->helix3->getParam('contact_email_icon').'"></i> ' : $contact_email_icon = '<i class="pe pe-7s-mail"></i> ';
		$this->helix3->getParam('contact_time_icon') != '' ? $contact_time_icon = '<i class="'.$this->helix3->getParam('contact_time_icon').'"></i> ' : $contact_time_icon = '<i class="pe pe-7s-timer"></i> ';
	   

		if($this->helix3->getParam('enable_contactinfo')) {

			$output = '<ul class="sp-contact-info">';
			if($this->helix3->getParam('contact_phone')) $output .= '<li class="sp-contact-phone">'. $contact_phone_icon .'<a href="tel:' . str_replace(' ', '', $this->helix3->getParam('contact_phone')) . '">' . $this->helix3->getParam('contact_phone') . '</a></li>';
			if($this->helix3->getParam('contact_mobile')) $output .= '<li class="sp-contact-mobile">'. $contact_mobile_icon .'<a href="tel:'. str_replace(' ', '', $this->helix3->getParam('contact_mobile')) .'">' . $this->helix3->getParam('contact_mobile') . '</a></li>';
			// Email + Email cloaking:
			if($this->helix3->getParam('enable_emailcloaking') == 1) {
				if($this->helix3->getParam('contact_email')) 
				$output .= '<li class="sp-contact-email">'. $contact_email_icon . JHtml::_('email.cloak', $this->helix3->getParam('contact_email')).'</li>';
			} else {
				if($this->helix3->getParam('contact_email')) 
				$output .= '<li class="sp-contact-email">'. $contact_email_icon .'<a href="mailto:'. $this->helix3->getParam('contact_email') .'">' . $this->helix3->getParam('contact_email') . '</a></li>';
				
			}	
			if($this->helix3->getParam('contact_time')) $output .= '<li class="sp-contact-time">'. $contact_time_icon . $this->helix3->getParam('contact_time') . '</li>';
			$output .= '</ul>';

			return $output;
		}
		
	}    
}