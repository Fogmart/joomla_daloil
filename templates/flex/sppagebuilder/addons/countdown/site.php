<?php
/**
 * Flex @package SP Page Builder
 * Template Name - Flex
 * @author Aplikko http://www.aplikko.com
 * @copyright Copyright (c) 2017 Aplikko
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
// no direct access
defined ('_JEXEC') or die ('restricted aceess');

class SppagebuilderAddonCountdown extends SppagebuilderAddons{

	public function render() {

		// Options
		$class = (isset($this->addon->settings->class) && $this->addon->settings->class) ? ' ' . $this->addon->settings->class : '';
		$title = (isset($this->addon->settings->title) && $this->addon->settings->title) ? $this->addon->settings->title : '';
		$heading_selector = (isset($this->addon->settings->heading_selector) && $this->addon->settings->heading_selector) ? $this->addon->settings->heading_selector : 'h3';

		$countdown_data = array(
			'date' 		  	=> JHtml::_('date', $this->addon->settings->date, 'Y/m/d'),
			'time' 		  	=> $this->addon->settings->time,
			'finish_text' 	=> $this->addon->settings->finish_text,
			'text_sec' 	  	=> JTEXT::_('FLEX_SECOND'),
			'text_secs' 		=> JTEXT::_('FLEX_SECONDS'),
			'text_min' 	  	=> JTEXT::_('FLEX_MINUTE'),
			'text_mins' 		=> JTEXT::_('FLEX_MINUTES'),
			'text_hour'   	=> JTEXT::_('FLEX_HOUR'),
			'text_hours'   	=> JTEXT::_('FLEX_HOURS'),
			'text_day'   	=> JTEXT::_('FLEX_DAY'),
			'text_days'   	=> JTEXT::_('FLEX_DAYS'),
		);

		$output  = '<div class="sppb-addon sppb-addon-countdown' . $class . '">';
		$output .= '<div class="countdown-text-wrap">';
		$output .= ($title) ? '<'.$heading_selector.' class="sppb-addon-title">' . $title . '</'.$heading_selector.'>' : '';
		$output .= '</div>';
		$output .= "<div class=\"sppb-countdown-timer sppb-row\" data-countdown='" . json_encode($countdown_data) . " '></div>";
		$output .= '</div>';

		return $output;
	}

	public function scripts() {
		return array(JURI::base(true) . '/components/com_sppagebuilder/assets/js/jquery.countdown.min.js');
	}

	public function js() {
		$js ="jQuery(function($){
			$('.sppb-countdown-timer[data-countdown]').each(function () {
					var cdData = $(this).data('countdown');
					var cdData = $.parseJSON(cdData);
					var cdDate = cdData.date.split('/');
					var cdDateFormate = cdDate[0] + '/' + cdDate[1] + '/' + cdDate[2] + ' ' + cdData.time;
					var finalDate = cdDateFormate;
					$(this).countdown(finalDate, function (event) {
							$(this).html(event.strftime('<div class=\"sppb-countdown-days sppb-col-xs-3 sppb-col-sm-3 sppb-text-center\"><span class=\"sppb-countdown-number\">%-D</span><span class=\"sppb-countdown-text\">%!D: ' + cdData.text_day + ',' + cdData.text_days + ';</span></div><div class=\"sppb-countdown-hours sppb-col-xs-3 sppb-col-sm-3 sppb-text-center\"><span class=\"sppb-countdown-number\">%H</span><span class=\"sppb-countdown-text\">%!H: ' + cdData.text_hour + ',' + cdData.text_hours + ';</span></div><div class=\"sppb-countdown-minutes sppb-col-xs-3 sppb-col-sm-3 sppb-text-center\"><span class=\"sppb-countdown-number\">%M</span><span class=\"sppb-countdown-text\">%!M:' + cdData.text_min + ',' + cdData.text_mins + ';</span></div><div class=\"sppb-countdown-seconds sppb-col-xs-3 sppb-col-sm-3 sppb-text-center\"><span class=\"sppb-countdown-number\">%S</span><span class=\"sppb-countdown-text\">%!S:' + cdData.text_sec + ',' + cdData.text_secs + ';</span></div>'))
							.on('finish.countdown', function () {
									$(this).html('<div class=\"sppb-finish_text sppb-text-center\">' + cdData.finish_text + '</div>');
							});
					});
			});
		})";
		$js = preg_replace('/[\n\t]+/m', '', $js); // Remove whitespace
		return $js;
	}

	public function css() {
		$addon_id = '#sppb-addon-' . $this->addon->id;

		// Counter
		$counter_style   = (isset($this->addon->settings->counter_height) && $this->addon->settings->counter_height) ? "height: " . (int) $this->addon->settings->counter_height  . "px; line-height: " . (int) $this->addon->settings->counter_height  . "px;" : '';
		$counter_style  .= (isset($this->addon->settings->counter_width) && $this->addon->settings->counter_width) ? "width: " . (int) $this->addon->settings->counter_width  . "px;" : '';
		$counter_style  .= (isset($this->addon->settings->counter_font_size) && $this->addon->settings->counter_font_size) ? "font-size: " . (int) $this->addon->settings->counter_font_size  . "px;" : '';
		
		$counter_fontstyle = (isset($this->addon->settings->counter_fontstyle) && $this->addon->settings->counter_fontstyle) ? $this->addon->settings->counter_fontstyle : '';

		
		
		if(is_array($counter_fontstyle) && count($counter_fontstyle)) {
		  if(in_array('underline', $counter_fontstyle)) {
			$counter_style .= 'text-decoration: underline;';
		  }
	
		  if(in_array('uppercase', $counter_fontstyle)) {
			$counter_style .= 'text-transform: uppercase;';
		  }
	
		  if(in_array('italic', $counter_fontstyle)) {
			$counter_style .= 'font-style: italic;';
		  }
	
		  if(in_array('lighter', $counter_fontstyle)) {
			$counter_style .= 'font-weight: lighter;';
		  } else if(in_array('normal', $counter_fontstyle)) {
			$counter_style .= 'font-weight: normal;';
		  } else if(in_array('bold', $counter_fontstyle)) {
			$counter_style .= 'font-weight: bold;';
		  } else if(in_array('bolder', $counter_fontstyle)) {
			$counter_style .= 'font-weight: bolder;';
		  }
		}
		
		
		$counter_style .= (isset($this->addon->settings->counter_text_color) && $this->addon->settings->counter_text_color) ? "color: " . $this->addon->settings->counter_text_color . ";" : '';
		$counter_style .= (isset($this->addon->settings->counter_background_color) && $this->addon->settings->counter_background_color) ? "background-color: " . $this->addon->settings->counter_background_color . ";" : '';
		$counter_style  .= (isset($this->addon->settings->counter_border_radius) && $this->addon->settings->counter_border_radius) ? "border-radius: " . $this->addon->settings->counter_border_radius . "px;" : '';
		$use_border = (isset($this->addon->settings->counter_user_border) && $this->addon->settings->counter_user_border) ? 1 : 0;
		if($use_border) {
			$counter_style .= (isset($this->addon->settings->counter_border_width) && $this->addon->settings->counter_border_width) ? "border-width: " . $this->addon->settings->counter_border_width . "px;" : '';
			$counter_style  .= (isset($this->addon->settings->counter_border_style) && $this->addon->settings->counter_border_style) ? "border-style: " . $this->addon->settings->counter_border_style . ";" : '';
			$counter_style  .= (isset($this->addon->settings->counter_border_color) && $this->addon->settings->counter_border_color) ? "border-color: " . $this->addon->settings->counter_border_color . ";" : '';
		}

		// Label
		$label_style  = (isset($this->addon->settings->label_font_size) && $this->addon->settings->label_font_size) ? "font-size: " . (int) $this->addon->settings->label_font_size . "px;" : '';
		$label_style .= (isset($this->addon->settings->label_color) && $this->addon->settings->label_color) ? "color: " . $this->addon->settings->label_color . ";" : '';
		$label_style .= (isset($this->addon->settings->counter_width) && $this->addon->settings->counter_width) ? "width: " . (int) $this->addon->settings->counter_width . "px;" : '';
		
		// Finished text
		$finish_text_style  = (isset($this->addon->settings->finish_text_fontsize) && $this->addon->settings->finish_text_fontsize) ? "font-size: " . (int) $this->addon->settings->finish_text_fontsize  . "px;line-height:1.3;" : '';
		$use_finish_text_border = (isset($this->addon->settings->counter_user_border) && $this->addon->settings->counter_user_border) ? 1 : 0;
		if($use_finish_text_border) {
			$finish_text_style .= (isset($this->addon->settings->finish_text_fontsize) && $this->addon->settings->finish_text_fontsize) ? "padding: " . (int) $this->addon->settings->finish_text_fontsize / 1.5  . "px " . (int) $this->addon->settings->finish_text_fontsize / 2  . "px " . (int) $this->addon->settings->finish_text_fontsize / 1.2  . "px;" : '';
			$finish_text_style .= (isset($this->addon->settings->counter_border_width) && $this->addon->settings->counter_border_width) ? "border-width: " . $this->addon->settings->counter_border_width  . "px;" : '';
			$finish_text_style .= (isset($this->addon->settings->counter_border_style) && $this->addon->settings->counter_border_style) ? "border-style: " . $this->addon->settings->counter_border_style  . ";" : '';
			$finish_text_style .= (isset($this->addon->settings->counter_border_color) && $this->addon->settings->counter_border_color) ? "border-color: " . $this->addon->settings->counter_border_color  . ";" : '';
			$finish_text_style .= (isset($this->addon->settings->counter_border_radius) && $this->addon->settings->counter_border_radius) ? "border-radius: " . $this->addon->settings->counter_border_radius  . "px;" : '';
		}

		$css = '';
		if($counter_style) {
			$css .= $addon_id . ' .sppb-countdown-number {';
			$css .= $counter_style;
			$css .= '}';
		}

		if($label_style) {
			$css .= $addon_id . ' .sppb-countdown-text {';
			$css .= $label_style;
			$css .= '}';
		}
		
		if($finish_text_style) {
			$css .= $addon_id . ' .sppb-finish_text {';
			$css .= $finish_text_style;
			$css .= '}';
		}

		return $css;
	}

}
