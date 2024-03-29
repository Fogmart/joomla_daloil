<?php
/**
 * Flex @package SP Page Builder
 * Template Name - Flex
 * @author Aplikko http://www.aplikko.com
 * @copyright Copyright (c) 2017 Aplikko
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
// no direct access
defined ('_JEXEC') or die ('restricted access');

//Include Pixeden Icons
require_once dirname(dirname( __DIR__ )) . '/fields/peicon.php';

SpAddonsConfig::addonConfig(
	array(
		'type'=>'content',
		'addon_name'=>'sp_prettyphoto_modal',
		'category'=>'Flex',
		'title'=>JText::_('FLEX_ADDON_PRETTYPHOTO_MODAL'),
		'desc'=>JText::_('FLEX_ADDON_PRETTYPHOTO_MODAL_DESC'),
		'attr'=>array(
			'general' => array(

				'admin_label'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
					'std'=> ''
				),

				'modal_selector'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_MODAL_SELECTOR'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_MODAL_SELECTOR_DESC'),
					'values'=>array(
						'button'=>JText::_('COM_SPPAGEBUILDER_ADDON_MODAL_SELECTOR_BUTTON'),
						'image'=>JText::_('COM_SPPAGEBUILDER_ADDON_MODAL_SELECTOR_IMAGE'),
						'icon'=>JText::_('COM_SPPAGEBUILDER_ADDON_MODAL_SELECTOR_TYPE_ICON'),
					),
					'std'=>'button',
				),

				// Button
				'button_text'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_TEXT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_TEXT_DESC'),
					'std'=>'Button Text',
					'depends'=>array(
						array('modal_selector', '=', 'button')
					),
				),

				'button_fontstyle'=>array(
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
					'std'=>'',
					'depends'=>array('use_custom_button'=>1)
				),

				'button_letterspace'=>array(
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
					'std'=>'0',
					'depends'=>array('use_custom_button'=>1)
				),

				'button_type'=>array(
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
					'depends'=>array(
						array('modal_selector', '=', 'button')
					),
				),

				'button_appearance'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_APPEARANCE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_APPEARANCE_DESC'),
					'values'=>array(
						''=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_APPEARANCE_FLAT'),
						'outline'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_APPEARANCE_OUTLINE'),
						'3d'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_APPEARANCE_3D'),
					),
					'std'=>'flat',
					'depends'=>array(
						array('modal_selector', '=', 'button')
					),
				),

				'button_background_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BACKGROUND_COLOR'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BACKGROUND_COLOR_DESC'),
					'std' => '#444444',
					'depends'=>array(
						array('modal_selector', '=', 'button'),
						array('button_type', '=', 'button_type')
					),
				),

				'button_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_COLOR'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_COLOR_DESC'),
					'std' => '#fff',
					'depends'=>array(
						array('modal_selector', '=', 'button'),
						array('button_type', '=', 'button_type')
					),
				),

				'button_background_color_hover'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BACKGROUND_COLOR_HOVER'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BACKGROUND_COLOR_HOVER_DESC'),
					'std' => '#222',
					'depends'=>array(
						array('modal_selector', '=', 'button'),
						array('button_type', '=', 'button_type')
					),
				),

				'button_color_hover'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_COLOR_HOVER'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_COLOR_HOVER_DESC'),
					'std' => '#fff',
					'depends'=>array(
						array('modal_selector', '=', 'button'),
						array('button_type', '=', 'button_type')
					),
				),

				'button_size'=>array(
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
					'depends'=>array(
						array('modal_selector', '=', 'button')
					),
				),

				'button_shape'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SHAPE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SHAPE_DESC'),
					'values'=>array(
						'rounded'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SHAPE_ROUNDED'),
						'square'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SHAPE_SQUARE'),
						'round'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SHAPE_ROUND'),
					),
					'depends'=>array(
						array('modal_selector', '=', 'button')
					),
				),

				'button_block'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BLOCK'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BLOCK_DESC'),
					'values'=>array(
						''=>JText::_('JNO'),
						'sppb-btn-block'=>JText::_('JYES'),
					),
					'depends'=>array(
						array('modal_selector', '=', 'button')
					),
				),
				// Pixeden Icons
				'button_peicon'=>array(
					'type'=>'peicon', 
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_BUTTON_PIXEDEN_ICON'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_BUTTON_PIXEDEN_ICON_DESC'),
					'depends'=>array(
						array('modal_selector', '=', 'button')
					),
				),

				'button_icon'=>array(
					'type'=>'icon',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_BUTTON_FONTAWESOME_ICON'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_BUTTON_FONTAWESOME_ICON_DESC'),
					'depends'=>array(
						array('modal_selector', '=', 'button')
					),
				),

				'button_icon_position'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_ICON_POSITION'),
					'values'=>array(
						'left'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LEFT'),
						'right'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_RIGHT'),
					),
					'depends'=>array(
						array('modal_selector', '=', 'button')
					),
				),

				// Image
				'selector_image'=>array(
					'type'=>'media',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_MODAL_SELECTOR_IMAGE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_SELECT_DESC'),
					'depends'=>array('modal_selector'=>'image')
				),
				// Pixeden Icons
				'peicon_name'=>array( // Pixeden Icons
					'type'=>'peicon', 
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PIXEDEN_ICON'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PIXEDEN_ICON_DESC'),
					'std'=> '',
					'depends'=>array('modal_selector'=>'icon')
				),

				// Icon
				'selector_icon_name'=>array(
					'type'=>'icon',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_FONTAWESOME_ICON'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_FONTAWESOME_ICON_DESC'),
					'std'=> '',
					'depends'=>array('modal_selector'=>'icon')
				),

				'selector_icon_size'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_MODAL_SELECTOR_ICON_SIZE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_MODAL_SELECTOR_ICON_SIZE_DESC'),
					'placeholder'=>36,
					'std'=>36,
					'depends'=>array('modal_selector'=>'icon')
				),

				'selector_icon_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_MODAL_SELECTOR_ICON_COLOR'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_MODAL_SELECTOR_ICON_COLOR_DESC'),
					'depends'=>array('modal_selector'=>'icon')
				),

				'selector_icon_background'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_MODAL_SELECTOR_ICON_BG_COLOR'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_MODAL_SELECTOR_ICON_BG_COLOR_DESC'),
					'depends'=>array('modal_selector'=>'icon')
				),

				'selector_icon_border_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_MODAL_SELECTOR_ICON_BORDER_COLOR'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_MODAL_SELECTOR_ICON_BORDER_COLOR_DESC'),
					'depends'=>array('modal_selector'=>'icon')
				),

				'selector_icon_border_width'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_MODAL_SELECTOR_ICON_BORDER_WIDTH_SIZE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_MODAL_SELECTOR_ICON_BORDER_WIDTH_SIZE_DESC'),
					'placeholder'=>'3',
					'depends'=>array('modal_selector'=>'icon')
				),

				'selector_icon_border_radius'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_MODAL_SELECTOR_ICON_BORDER_RADIUS'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_MODAL_SELECTOR_ICON_BORDER_RADIUS_DESC'),
					'placeholder'=>'5',
					'depends'=>array('modal_selector'=>'icon')
				),

				'selector_icon_padding'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_MODAL_SELECTOR_ICON_PADDING'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_MODAL_SELECTOR_ICON_PADDING_DESC'),
					'placeholder'=>'20',
					'depends'=>array('modal_selector'=>'icon')
				),

				//Admin Only
				'separator'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_MODAL_CONTENT'),
				),

				'modal_content_type'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_MODAL_CONTENT_TYPE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_MODAL_CONTENT_TYPE_DESC'),
					'values'=>array(
						'text'=>JText::_('COM_SPPAGEBUILDER_ADDON_MODAL_CONTENT_TYPE_TEXT'),
						'image'=>JText::_('COM_SPPAGEBUILDER_ADDON_MODAL_CONTENT_TYPE_IMAGE'),
						'video'=>JText::_('COM_SPPAGEBUILDER_ADDON_MODAL_CONTENT_TYPE_VIDEO'),
					),
					'std'=>'text',
				),

				'modal_content_text'=>array(
					'type'=>'editor',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_MODAL_TEXT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_MODAL_TEXT_DESC'),
					'std'=>'Collaboratively administrate empowered markets via plug-and-play networks. Efficiently unleash cross-media information without cross-media value. Quickly maximize timely deliverables for real-time schemas. Dramatically maintain clicks-and-mortar solutions without functional solutions. Completely synergize resource taxing relationships via premier niche markets. Professionally cultivate one-to-one customer service with robust ideas. Dynamically innovate resource-leveling customer service for state of the art customer service.&lt;br&gt;&lt;br&gt;Objectively innovate empowered manufactured products whereas parallel platforms. Holisticly predominate extensible testing procedures. Dramatically engage top-line web services vis-a-vis cutting-edge deliverables. Envisioned multimedia based expertise and cross-media growth strategies. Seamlessly visualize quality intellectual capital without superior collaboration and idea-sharing. Installed base portals after maintainable products. Phosfluorescently engage worldwide methodologies with web-enabled technology. Interactively coordinate proactive e-commerce via process-centric "outside the box" thinking. Completely pursue scalable customer service through sustainable potentialities.',
					'depends'=>array('modal_content_type'=>'text')
				),

				'modal_content_image'=>array(
					'type'=>'media',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_MODAL_IMAGE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_MODAL_IMAGE_DESC'),
					'depends'=>array('modal_content_type'=>'image')
				),

				'modal_content_video_url'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_MODAL_VIDEO'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_MODAL_VIDEO_DESC'),
					'depends'=>array('modal_content_type'=>'video')
				),

				'modal_popup_width'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_MODAL_POPUP_WIDTH'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_MODAL_POPUP_WIDTH_DESC'),
					'std'=>'760'
				),

				'modal_popup_height'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_MODAL_POPUP_HEIGHT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_MODAL_POPUP_HEIGHT_DESC'),
					'std'=>'440'
				),

				'alignment'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_MODAL_SELECTOR_ALIGNMENT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_MODAL_SELECTOR_ALIGNMENT_DESC'),
					'values'=>array(
						'sppb-text-left'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LEFT'),
						'sppb-text-center'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_CENTER'),
						'sppb-text-right'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_RIGHT'),
					),
					'std'=>'sppb-text-left',
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
