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

require_once dirname(dirname( __DIR__ )) . '/fields/peicon.php';

SpAddonsConfig::addonConfig(
	array(
		'type'=>'content',
		'addon_name'=>'sp_icon',
		'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ICON'),
		'desc'=>JText::_('FLEX_GLOBAL_ICON_DESC'),
		'attr'=>array(

			'general' => array(
				'admin_label'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
					'std'=> ''
				),
				
				'peicon_name'=>array( // Pixeden Icons
					'type'=>'peicon', 
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_PE_ICON_NAME'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_PE_ICON_NAME_DESC'),
				),

				'icon_name'=>array(
					'type'=>'icon',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_FONTAWESOME_ICON_NAME'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_FONTAWESOME_ICON_NAME_DESC'),
					'std'=> ''
				),

				'size'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_ICON_SIZE'),
					'placeholder'=>36,
					'std'=>36,
				),

				'width'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_WIDTH'),
					'std'=>96,
					'placeholder'=>'96',
				),

				'height'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_HEIGHT'),
					'std'=>96,
					'placeholder'=>'96',
				),
				
				'padding'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_PADDING'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_PADDING_DESC'),
					'placeholder'=>'20',
				),

				'color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR'),
				),

				'background'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR'),
				),

				'border_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_COLOR'),
				),

				'border_width'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_WIDTH'),
					'placeholder'=>'3',
				),

				'border_radius'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_RADIUS'),
					'placeholder'=>'5',
				),

				'margin'=>array(
					'type'=>'margin',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN_DESC'),
					'placeholder'=>'10',
				),

				'separator'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MOUSE_HOVER_OPTIONS')
				),

				'use_hover'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ICON_USE_HOVER'),
					'std'=>0,
				),

				'hover_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR_HOVER'),
					'depends'=>array(
						array('use_hover', '=', 1)
					)
				),

				'hover_background'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR_HOVER'),
					'depends'=>array(
						array('use_hover', '=', 1)
					)
				),

				'hover_border_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_COLOR_HOVER'),
					'depends'=>array(
						array('use_hover', '=', 1)
					)
				),

				'hover_border_width'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_WIDTH'),
					'placeholder'=>'3',
					'depends'=>array(
						array('use_hover', '=', 1)
					)
				),

				'hover_border_radius'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_RADIUS'),
					'placeholder'=>'5',
					'depends'=>array(
						array('use_hover', '=', 1)
					)
				),

				'hover_effect'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ICON_HOVER_EFFECT'),
					'values'=>array(
						''=>JText::_('COM_SPPAGEBUILDER_ADDON_ICON_HOVER_EFFECT_NONE'),
						'zoom-in'=>JText::_('COM_SPPAGEBUILDER_ADDON_ICON_HOVER_EFFECT_ZOOM_IN'),
						'zoom-out'=>JText::_('COM_SPPAGEBUILDER_ADDON_ICON_HOVER_EFFECT_ZOOM_OUT'),
						'rotate'=>JText::_('COM_SPPAGEBUILDER_ADDON_ICON_HOVER_EFFECT_ROTATE'),
					),
					'std'=>'zoom-in',
				),

				'alignment'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ICON_ALIGNMENT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ICON_ALIGNMENT_DESC'),
					'values'=>array(
						'sppb-text-left'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LEFT'),
						'sppb-text-center'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_CENTER'),
						'sppb-text-right'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_RIGHT'),
					),
					'std'=>'sppb-text-center',
				),

				'class'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS_DESC'),
					'std'=>''
				),

			),
		),
	)
);
