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

require_once dirname(dirname( __DIR__ )) . '/fields/peicon.php';

SpAddonsConfig::addonConfig(
	array( 
		'type'=>'content', 
		'addon_name'=>'sp_pie_progress',
		'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PIE_PROGRESS'),
		'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PIE_PROGRESS_DESC'),
		'attr'=>array(
			'admin_label'=>array(
				'type'=>'text', 
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
				'std'=> ''
				),
			'percentage'=>array(
				'type'=>'number',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PIE_PROGRESS_PERCENTAGE'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PIE_PROGRESS_PERCENTAGE_DESC'),
				'placeholder'=>'75',
				'std'=>'75',
				),
			'size'=>array(
				'type'=>'number',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PIE_PROGRESS_SIZE'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PIE_PROGRESS_SIZE_DESC'),
				'placeholder'=>110,
				'std'=>110,
				),
			'duration'=>array(
				'type'=>'number',
				'title'=>JText::_('Animation Effect Duration'),
				'desc'=>JText::_('Time in seconds for an animation of the bar growing. Default is 2 (seconds)'),
				'placeholder'=>2,
				'std'=>2,
				),
			'border_color'=>array(
				'type'=>'color',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PIE_PROGRESS_BORDER_COLOR'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PIE_PROGRESS_BORDER_COLOR_DESC'),
				'std'=>'#f5f5f5',
				),
			'border_active_color'=>array(
				'type'=>'color',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PIE_PROGRESS_BORDER_COLOR_ACTIVE'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PIE_PROGRESS_BORDER_COLOR_ACTIVE_DESC'),
				'std'=>'#04c6f7',
				),
			'border_width'=>array(
				'type'=>'number',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PIE_PROGRESS_BORDER_WIDTH'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PIE_PROGRESS_BORDER_WIDTH_DESC'),
				'placeholder'=>'5',
				'std'=>5,
				),

			'separator1'=>array(
				'type'=>'separator', 
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PIE_PROGRESS_ICON_OPTIONS'),
				),
			'peicon_name'=>array( // Pixeden Icons
				'type'=>'peicon', 
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_PE_ICON_NAME'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_PE_ICON_NAME_DESC'),
				'std'=> ''
				),
			'icon_name'=>array(
				'type'=>'icon', 
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_FONTAWESOME_ICON_NAME'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_FONTAWESOME_ICON_NAME_DESC'),
				'std'=> ''
				),
			'icon_color'=>array(
				'type'=>'color',
				'title'=>JText::_('FLEX_ADDON_ICON_TXT_COLOR'),
				'desc'=>JText::_('FLEX_ADDON_ICON_TXT_COLOR_DESC'),
				'std'=>'',
				),
			'icon_size'=>array(
				'type'=>'number',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_ICON_SIZE'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_ICON_SIZE_DESC'),
				'placeholder'=>32,
				'std'=>32,
				),
			'separator1'=>array(
				'type'=>'separator', 
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PIE_PROGRESS_CONTENT'),
				),
				/*
			'title'=>array(
				'type'=>'text', 
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_DESC'),
				'std'=>  'Pie Progress'
				),
				*/
			'title'=>array(
				'type'=>'text',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_DESC'),
				'std'=>  ''
			),

			'heading_selector'=>array(
				'type'=>'select',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_DESC'),
				'values'=>array(
					'h1'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H1'),
					'h2'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H2'),
					'h3'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H3'),
					'h4'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H4'),
					'h5'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H5'),
					'h6'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H6'),
				),
				'std'=>'h3',
				'depends'=>array(array('title', '!=', '')),
			),

			'title_fontsize'=>array(
				'type'=>'number',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_SIZE'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_SIZE_DESC'),
				'std'=>'',
				'depends'=>array(array('title', '!=', '')),
			),

			'title_lineheight'=>array(
				'type'=>'text',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_LINE_HEIGHT'),
				'std'=>'',
				'depends'=>array(array('title', '!=', '')),
			),

			'title_fontstyle'=>array(
				'type'=>'select',
				'title'=> JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_STYLE'),
				'values'=>array(
					'underline'=> JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_STYLE_UNDERLINE'),
					'uppercase'=> JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_STYLE_UPPERCASE'),
					'italic'=> JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_STYLE_ITALIC'),
					'lighter'=> JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_STYLE_LIGHTER'),
					'normal'=> JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_STYLE_NORMAL'),
					'bold'=> JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_STYLE_BOLD'),
					'bolder'=> JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_STYLE_BOLDER'),
				),
				'multiple'=>true,
				'std'=>'',
				'depends'=>array(array('title', '!=', '')),
			),

			'title_letterspace'=>array(
				'type'=>'select',
				'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LETTER_SPACING'),
				'values'=>array(
					'0'=> 'Default',
					'1px'=> '1px',
					'2px'=> '2px',
					'3px'=> '3px',
					'4px'=> '4px',
					'5px'=> '5px',
					'6px'=>	'6px',
					'7px'=>	'7px',
					'8px'=>	'8px',
					'9px'=>	'9px',
					'10px'=> '10px'
				),
				'std'=>'0',
				'depends'=>array(array('title', '!=', '')),
			),

			'title_fontweight'=>array(
				'type'=>'text',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_WEIGHT'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_WEIGHT_DESC'),
				'std'=>'',
				'depends'=>array(array('title', '!=', '')),
			),

			'title_text_color'=>array(
				'type'=>'color',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_TEXT_COLOR'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_TEXT_COLOR_DESC'),
				'depends'=>array(array('title', '!=', '')),
			),

			'title_margin_top'=>array(
				'type'=>'number',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_MARGIN_TOP'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_MARGIN_TOP_DESC'),
				'placeholder'=>'10',
				'depends'=>array(array('title', '!=', '')),
			),

			'title_margin_bottom'=>array(
				'type'=>'number',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_MARGIN_BOTTOM'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_MARGIN_BOTTOM_DESC'),
				'placeholder'=>'10',
				'depends'=>array(array('title', '!=', '')),
			),
			'text'=>array(
				'type'=>'editor', 
				'title'=>JText::_('FLEX_CONTENT_LABEL'),

				'std'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer adipiscing erat eget risus sollicitudin pellentesque et non erat.'
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