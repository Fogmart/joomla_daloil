<?php
/**
 * Flex @package SP Page Builder
 * Template Name - Flex
 * @author Aplikko http://www.aplikko.com
 * @copyright Copyright (c) 2016 Aplikko
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
// no direct access
defined ('_JEXEC') or die ('restricted access');

//Include Pixeden Icons
require_once dirname(dirname( __DIR__ )) . '/fields/peicon.php';

SpAddonsConfig::addonConfig(
array(
	'type'=>'repeatable',
	'addon_name'=>'accordion',
	'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ACCORDION'),
	'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ACCORDION_DESC'),
	'attr'=>array(
		'general' => array(
			'admin_label'=>array(
				'type'=>'text',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
				'std'=> ''
			),
			
			'show_collapse'=>array(
				'type'=>'checkbox', 
				'title'=>JText::_('FLEX_ADDON_COLLAPSE_ALL'),
				'desc'=>JText::_('FLEX_ADDON_COLLAPSE_ALL_DESC'),
				'values'=> array(
					'0'=>'No',
					'1'=>'Yes'
				),
				'std'=>'0'
			),

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

			'style'=>array(
				'type'=>'select',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ACCORDION_STYLE'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ACCORDION_STYLE_DESC'),
				'values'=> array(
					'panel-flex'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_FLEX'),
					'panel-default'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_DEFAULT'),
					'panel-primary'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_PRIMARY'),
					'panel-success'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_SUCCESS'),
					'panel-info'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_INFO'),
					'panel-warning'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_WARNING'),
					'panel-danger'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_DANGER'),
					'panel-faq'=>JText::_('COM_SPPAGEBUILDER_ADDON_ACCORDION_STYLE_FAQ'),
				),
				'std'=> ''
			),

			'class'=>array(
				'type'=>'text',
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS'),
				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS_DESC'),
				'std'=>''
			),

			// Repeatable Item
			'sp_accordion_item'=>array(
				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ACCORDION_ITEMS'),
				'attr'=>array(
					'title'=>array(
						'type'=>'text',
						'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ACCORDION_TITLE'),
						'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ACCORDION_TITLE_DESC'),
						'std'=>'Accordion Title',
					),
					'peicon_name'=>array( // Pixeden Icons
						'type'=>'peicon', 
						'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_PE_ICON_NAME'),
						'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_PE_ICON_NAME_DESC'),
						'std'=> ''
					),
					'icon'=>array(
						'type'=>'icon',
						'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ACCORDION_ICON'),
						'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ACCORDION_ICON_DESC'),
						'std'=> ''
					),
					'content'=>array(
						'type'=>'editor',
						'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ACCORDION_CONTENT'),
						'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ACCORDION_CONTENT_DESC'),
						'std'=>'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.'
					),
				),
			),
		),
	),
	)
);
