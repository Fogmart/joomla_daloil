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
		'type'=>'general',
		'addon_name'=>'sp_button_group',
		'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_BUTTON_GROUP'),
		'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_BUTTON_GROUP_DESC'),
		'attr'=>array(
			'general' => array(

				'admin_label'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
					'std'=> ''
				),

				'alignment'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_CONTENT_ALIGNMENT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_CONTENT_ALIGNMENT_DESC'),
					'values'=>array(
						'sppb-text-left'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LEFT'),
						'sppb-text-center'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_CENTER'),
						'sppb-text-right'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_RIGHT'),
					),
					'std'=>'sppb-text-center',
				),

				'margin'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_BUTTON_GROUP_GUTTER'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_BUTTON_GROUP_GUTTER_DESC'),
					'std'=>'5',
					'placeholder'=>'5',
				),

				'class'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS_DESC'),
					'std'=> '',
				),

				// Repeatable Items
				'sp_button_group_item'=>array(
					'title'=> JText::_('COM_SPPAGEBUILDER_ADDON_BUTTONS_ITEM'),
					'attr'=>  array(

						'title'=>array(
							'type'=>'text',
							'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_TEXT'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_TEXT_DESC'),
							'std'=>'Button',
						),

						'fontstyle'=>array(
							'type'=>'select',
							'title'=> JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_FONT_STYLE'),
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
							'std'=>''
						),

						'letterspace'=>array(
							'type'=>'select',
							'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_LETTER_SPACING'),
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
							'std'=>'0'
						),

						'url'=>array(
							'type'=>'media',
							'format'=>'attachment',
							'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_URL'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_URL_DESC'),
							'placeholder'=>'http://',
						),

						'type'=>array(
							'type'=>'select',
							'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_STYLE'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_STYLE_DESC'),
							'values'=>array(
								'default'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_DEFAULT'),
								'flex'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_FLEX'),
								'dark'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_DARK'),
								'light'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LIGHT'),
								'primary'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_PRIMARY'),
								'success'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_SUCCESS'),
								'info'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_INFO'),
								'warning'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_WARNING'),
								'danger'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_DANGER'),
								'link'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LINK'),
								'custom'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_CUSTOM'),
							),
							'std'=>'default',
						),

						'appearance'=>array(
							'type'=>'select',
							'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_APPEARANCE'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_APPEARANCE_DESC'),
							'values'=>array(
								''=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_APPEARANCE_FLAT'),
								'outline'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_APPEARANCE_OUTLINE'),
								'3d'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_APPEARANCE_3D'),
							),
							'std'=>'flat',
						),

						'background_color'=>array(
							'type'=>'color',
							'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BACKGROUND_COLOR'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BACKGROUND_COLOR_DESC'),
							'std' => '#444444',
							'depends'=>array('type'=>'custom'),
						),

						'color'=>array(
							'type'=>'color',
							'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_COLOR'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_COLOR_DESC'),
							'std' => '#fff',
							'depends'=>array('type'=>'custom'),
						),

						'background_color_hover'=>array(
							'type'=>'color',
							'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BACKGROUND_COLOR_HOVER'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BACKGROUND_COLOR_HOVER_DESC'),
							'std' => '#222',
							'depends'=>array('type'=>'custom'),
						),

						'color_hover'=>array(
							'type'=>'color',
							'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_COLOR_HOVER'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_COLOR_HOVER_DESC'),
							'std' => '#fff',
							'depends'=>array('type'=>'custom'),
						),

						'size'=>array(
							'type'=>'select',
							'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SIZE'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SIZE_DESC'),
							'values'=>array(
								''=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SIZE_DEFAULT'),
								'lg'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SIZE_LARGE'),
								'xlg'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SIZE_XLARGE'),
								'sm'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SIZE_SMALL'),
								'xs'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SIZE_EXTRA_SAMLL'),
							),
						),

						'shape'=>array(
							'type'=>'select',
							'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SHAPE'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SHAPE_DESC'),
							'values'=>array(
								'rounded'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SHAPE_ROUNDED'),
								'square'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SHAPE_SQUARE'),
								'round'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SHAPE_ROUND'),
							),
						),

						'block'=>array(
							'type'=>'select',
							'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BLOCK'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BLOCK_DESC'),
							'values'=>array(
								''=>JText::_('JNO'),
								'sppb-btn-block'=>JText::_('JYES'),
							),
						),
						
						'peicon_name'=>array( // Pixeden Icons
							'type'=>'peicon', 
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_PE_ICON_NAME'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_PE_ICON_NAME_DESC'),
							'std'=> ''
							),		

						'icon'=>array(
							'type'=>'icon',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_FONTAWESOME_ICON_NAME'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_FONTAWESOME_ICON_NAME_DESC'),
						),

						'icon_position'=>array(
							'type'=>'select',
							'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_ICON_POSITION'),
							'values'=>array(
								'left'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LEFT'),
								'right'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_RIGHT'),
							),
						),

						'target'=>array(
							'type'=>'select',
							'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LINK_NEWTAB'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LINK_NEWTAB_DESC'),
							'values'=>array(
								''=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_TARGET_SAME_WINDOW'),
								'_blank'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_TARGET_NEW_WINDOW'),
							),
						),
					),
				),
			),
		),
	)
);
