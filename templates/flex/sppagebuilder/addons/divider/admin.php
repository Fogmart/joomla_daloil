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

SpAddonsConfig::addonConfig(
	array( 
		'type'=>'content', 
		'addon_name'=>'sp_divider',
		'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_DIVIDER'),
		'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_DIVIDER_DESC'),
		'attr'=>array(
		
			'admin_label'=>array(
				'type'=>'text', 
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
				'std'=> ''
				),
				
			'divider_type'=>array(
				'type'=>'select',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_DIVIDER_TYPE'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_DIVIDER_TYPE_DESC'),
				'values'=> array(
					'border'=>JText::_('COM_SPPAGEBUILDER_ADDON_DIVIDER_TYPE_BORDER'),
					'image'=>JText::_('COM_SPPAGEBUILDER_ADDON_DIVIDER_TYPE_IMAGE'),
					),
				),

			'divider_image'=>array(
				'type' => 'media',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_DIVIDER_IMAGE'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_DIVIDER_IMAGE_DESC'),
				'std'=>'',
				'depends'=>array('divider_type'=>'image')
				),

			'background_repeat'=>array(
				'type'=>'select', 
				'title'=>JText::_('COM_SPPAGEBUILDER_BG_REPEAT'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_BG_REPEAT_DESC'),
				'values'=>array(
					'no-repeat'=>JText::_('COM_SPPAGEBUILDER_BG_REPEAT_NO'),
					'repeat'=>JText::_('COM_SPPAGEBUILDER_BG_REPEAT_ALL'),
					'repeat-x'=>JText::_('COM_SPPAGEBUILDER_BG_REPEAT_HORIZ'),
					'repeat-y'=>JText::_('COM_SPPAGEBUILDER_BG_REPEAT_VERTI'),
					'inherit'=>JText::_('COM_SPPAGEBUILDER_BG_REPEAT_INHERIT'),
					),
				'std'=>'no-repeat',
				'depends'=>array('divider_type'=>'image')
				),

			'divider_height'=>array(
				'type' => 'number',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_DIVIDER_HEIGHT'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_DIVIDER_HEIGHT_DESC'),
				'std' => '10',
				'placeholder' => '10',
				),	

			'border_color'=>array(
				'type' => 'color',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_DIVIDER_BORDER_COLOR'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_DIVIDER_BORDER_COLOR_DESC'),
				'std'=>'#eeeeee',
				'depends'=>array('divider_type'=>'border')
				),

			'border_style'=>array(
				'type'=>'select',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_DIVIDER_BORDER_STYLE'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_DIVIDER_BORDER_STYLE_DESC'),
				'values'=>array(
					'solid'=>JText::_('COM_SPPAGEBUILDER_ADDON_DIVIDER_BORDER_STYLE_SOLID'),
					'dashed'=>JText::_('COM_SPPAGEBUILDER_ADDON_DIVIDER_BORDER_STYLE_DASHED'),
					'dotted'=>JText::_('COM_SPPAGEBUILDER_ADDON_DIVIDER_BORDER_STYLE_DOTTED'),
					),
				'depends'=>array('divider_type'=>'border')
				),

			'border_width'=>array(
				'type'=>'number',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_DIVIDER_BORDER_WIDTH'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_DIVIDER_BORDER_WIDTH_DESC'),
				'std'=>'1',
				'depends'=>array('divider_type'=>'border')
				),
													

			'margin_top'=>array(
				'type' => 'number',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_DIVIDER_MARGIN_TOP'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_DIVIDER_MARGIN_TOP_DESC'),
				'placeholder' => '30',
				'std' => '30',
				),			

			'margin_bottom'=>array(
				'type' => 'number',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_DIVIDER_MARGIN_BOTTOM'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_DIVIDER_MARGIN_BOTTOM_DESC'),
				'placeholder' => '30',
				'std' => '30',
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