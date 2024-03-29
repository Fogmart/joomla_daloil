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

SpAddonsConfig::addonConfig(
	array(
		'type'=>'general', 
		'addon_name'=>'sp_progress_bar',
		'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PROGRESS_BAR'),
		'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PROGRESS_BAR_DESC'),
		'attr'=>array(
			'admin_label'=>array(
				'type'=>'text', 
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
				'std'=> ''
				),
			'type'=>array(
				'type'=>'select', 
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PROGRESS_BAR_TYPE'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PROGRESS_BAR_TYPE_DESC'),
				'values'=>array(
					'sppb-progress-bar-default'=>JText::_('Default'),
				    'flex'=>JText::_('Flex'),
					'sppb-progress-bar-primary'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_PRIMARY'),
					'sppb-progress-bar-success'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_SUCCESS'),
					'sppb-progress-bar-info'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_INFO'),
					'sppb-progress-bar-warning'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_WARNING'),
					'sppb-progress-bar-danger'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_DANGER'),
					),
				'std'=>'sppb-progress-bar-default',
				),
			'custom_color'=>array(
				'type'=>'color',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PROGRESS_BAR_CUSTOM_COLOR'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PROGRESS_BAR_CUSTOM_COLOR_DESC'),
				),
			'custom_height'=>array(
				'type'=>'number',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PROGRESS_BAR_CUSTOM_HEIGHT'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PROGRESS_BAR_CUSTOM_HEIGHT_DESC'),
				'placeholder'=>20,
				'std'=>20,
				),
			'progress'=>array(
				'type'=>'text', 
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PROGRESS_BAR_PROGRESS'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PROGRESS_BAR_PROGRESS_DESC'),
				'std'=>'50',
				),
			'text'=>array(
				'type'=>'text', 
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PROGRESS_BAR_TEXT'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PROGRESS_BAR_TEXT_DESC'),
				'std'=>'',
				),
			'text_color'=>array(
				'type'=>'color', 
				'title'=>JText::_('HELIX_TEXT_COLOR'),
				'desc'=>JText::_('HELIX_TEXT_COLOR_DESC'),
				'std'=>'',
				),
			'stripped'=>array(
				'type'=>'select', 
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PROGRESS_BAR_STRIPPED'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PROGRESS_BAR_STRIPPED_DESC'),
				'values'=>array(
					''=>JText::_('JNO'),
					'sppb-progress-bar-striped'=>JText::_('JYES'),
					),
				),
			'active'=>array(
				'type'=>'select', 
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PROGRESS_BAR_ACTIVE'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PROGRESS_BAR_ACTIVE_DESC'),
				'values'=>array(
					''=>JText::_('JNO'),
					'active'=>JText::_('JYES'),
					),
				),
			'animation_duration'=>array(
				'type'=>'number',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PROGRESS_BAR_ANIMATION_DURATION'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PROGRESS_BAR_ANIMATION_DURATION_DESC'),
				'placeholder'=>2,
				'std'=>2,
				),
			'animation_delay'=>array(
				'type'=>'number',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PROGRESS_BAR_ANIMATION_DELAY'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PROGRESS_BAR_ANIMATION_DELAY_DESC'),
				'placeholder'=>0,
				'std'=>0,
				),
			'class'=>array(
				'type'=>'text', 
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS_DESC'),
				'std'=> ''
				),
			) 
		)
	);
