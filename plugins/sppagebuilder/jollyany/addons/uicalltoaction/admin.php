<?php

/**
 * @package Jollyany Addons SP Page Builder
 * @author TemPlaza https://templaza.com
 * @copyright Copyright (c) 2011 - 2021 TemPlaza
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
//no direct accees
defined('_JEXEC') or die('Restricted access');

SpAddonsConfig::addonConfig(
	array(
		'type' => 'content',
		'addon_name' => 'uicalltoaction',
		'title' => JText::_('UI Call To Action'),
		'desc' => JText::_('Create Beautiful Call To Action That Drive Engagement'),
		'icon'=>JURI::root() . 'plugins/sppagebuilder/jollyany/addons/uicalltoaction/assets/images/icon.png',
		'category' => 'Jollyany',
		'attr' => array(
			'general' => array(
				'admin_label' => array(
					'type' => 'text',
					'title' => JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
					'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
					'std' => '',
				),
				// Title
				'title' => array(
					'type' => 'text',
					'title' => JText::_('Title'),
					'std' =>  'Are you looking for something individual?',
				),
				// Content
				'content' => array(
					'type' => 'editor',
					'title' => JText::_('Content'),
					'std' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.',
				),
				'title_link' => array(
					'type' => 'media',
					'format' => 'attachment',
					'title' => JText::_('Link'),
					'desc' => JText::_('Enter or pick a link, an image or a video file.'),
					'placeholder' => 'http://',
					'std' => '#',
					'hide_preview' => true,
				),
				'button_title' => array(
					'type' => 'text',
					'title' => JText::_('Link Text'),
					'std' => 'Read more',
					'placeholder' => 'Read more',
					'depends' => array(
						array('title_link', '!=', ''),
					),
				),
				'separator_layout_options' => array(
					'type' => 'separator',
					'title' => JText::_('Layout'),
				),
				'button_alignment' => array(
					'type' => 'select',
					'title' => JText::_('Button Alignment'),
					'desc' => JText::_('Align the button to the top,left,right or place it between the title and the content'),
					'values' => array(
						'top' => JText::_('Top'),
						'bottom' => JText::_('Bottom'),
						'left' => JText::_('Left'),
						'right' => JText::_('Right'),
					),
					'std' => 'right',
				),
				'grid_width' => array(
					'type' => 'select',
					'title' => JText::_('Grid Width'),
					'desc' => JText::_('Define the width of the button within the grid. Choose between percent and fixed widths or expand columns to the width of their content.'),
					'values' => array(
						'auto' => JText::_('Auto'),
						'4-5' => JText::_('80%'),
						'3-4' => JText::_('75%'),
						'2-3' => JText::_('66%'),
						'3-5' => JText::_('60%'),
						'1-2' => JText::_('50%'),
						'2-5' => JText::_('40%'),
						'1-3' => JText::_('33%'),
						'1-4' => JText::_('25%'),
						'1-5' => JText::_('20%'),
						'small' => JText::_('Small'),
						'medium' => JText::_('Medium'),
						'large' => JText::_('Large'),
						'xlarge' => JText::_('X-Large'),
						'2xlarge' => JText::_('2X-Large'),
					),
					'std' => '1-5',
					'depends' => array(
						array('button_alignment', '!=', 'top'),
						array('button_alignment', '!=', 'bottom'),
					),
				),
				'grid_gutter' => array(
					'type' => 'select',
					'title' => JText::_('Grid Gutter'),
					'desc' => JText::_('Select the gutter width between the button and content items.'),
					'values' => array(
						'small' => JText::_('Small'),
						'medium' => JText::_('Medium'),
						'' => JText::_('Default'),
						'large' => JText::_('Large'),
						'collapse' => JText::_('None'),
					),
					'std' => '',
					'depends' => array(
						array('button_alignment', '!=', 'top'),
						array('button_alignment', '!=', 'bottom'),
					),
				),
				'grid_breakpoint' => array(
					'type' => 'select',
					'title' => JText::_('Grid Breakpoint'),
					'desc' => JText::_('Set the breakpoint from which grid cells will stack.'),
					'values' => array(
						'' => JText::_('Always'),
						's' => JText::_('Small (Phone Landscape)'),
						'm' => JText::_('Medium (Tablet Landscape)'),
						'l' => JText::_('Large (Desktop)'),
						'xl' => JText::_('X-Large (Large Screens)'),
					),
					'std' => 'm',
					'depends' => array(
						array('button_alignment', '!=', 'top'),
						array('button_alignment', '!=', 'bottom'),
					),
				),
				'grid_divider' => array(
					'type' => 'checkbox',
					'title' => JText::_('Show dividers'),
					'desc' => JText::_('Select this option to separate grid cells with lines.'),
					'values' => array(
						1 => JText::_('JYES'),
						0 => JText::_('JNO'),
					),
					'std' => 0,
					'depends' => array(
						array('grid_gutter', '!=', 'collapse'),
					),
				),
				'vertical_alignment' => array(
					'type' => 'checkbox',
					'title' => JText::_('Vertical Alignment'),
					'desc' => JText::_('Vertically center grid cells.'),
					'values' => array(
						1 => JText::_('JYES'),
						0 => JText::_('JNO'),
					),
					'std' => 0,
					'depends' => array(
						array('button_alignment', '!=', 'top'),
						array('button_alignment', '!=', 'bottom'),
					),
				),
				'separator_title_style_options' => array(
					'type' => 'separator',
					'title' => JText::_('Title'),
				),
				'title_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('Font Family'),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.ui-title { font-family: {{ VALUE }}; }',
					)
				),
				'font_weight' => array(
					'type' => 'select',
					'title' => JText::_('Font weight'),
					'desc' => JText::_('Add one of the following classes to modify the font weight of your text.'),
					'values' => array(
					  '' => JText::_('Default'),
					  'light' => JText::_('Light'),
					  'normal' => JText::_('Normal'),
					  'bold' => JText::_('Bold'),
					  'lighter' => JText::_('Lighter'),
					  'bolder' => JText::_('Bolder'),
					),
				),
				'heading_style' => array(
					'type' => 'select',
					'title' => JText::_('Style'),
					'desc' => JText::_('Heading styles differ in font-size but may also come with a predefined color, size and font'),
					'values' => array(
						'' => JText::_('None'),
						'heading-2xlarge' => JText::_('2XLarge'),
						'heading-xlarge' => JText::_('XLarge'),
						'heading-large' => JText::_('Large'),
						'heading-medium' => JText::_('Medium'),
						'heading-small' => JText::_('Small'),
						'h1' => JText::_('H1'),
						'h2' => JText::_('H2'),
						'h3' => JText::_('H3'),
						'h4' => JText::_('H4'),
						'h5' => JText::_('H5'),
						'h6' => JText::_('H6'),
					),
					'std' => '',
				),
				'decoration' => array(
					'type' => 'select',
					'title' => JText::_('Heading Decoration'),
					'desc' => JText::_('Decorate the heading with a divider, bullet or a line that is vertically centered to the heading'),
					'values' => array(
						'' => 'None',
						'divider' => 'Divider',
						'bullet' => 'Bullet',
						'line' => 'Line',
					),
					'std' => ''
				),
				'title_color' => array(
					'type' => 'select',
					'title' => JText::_('Predefined Color'),
					'desc' => JText::_('Select the predefined title text color.'),
					'values' => array(
						'' => JText::_('None'),
						'text-muted' => JText::_('Muted'),
						'text-primary' => JText::_('Primary'),
						'text-secondary' => JText::_('Secondary'),
						'text-success' => JText::_('Success'),
						'text-warning' => JText::_('Warning'),
						'text-danger' => JText::_('Danger'),
						'text-background' => JText::_('Background'),
					),
					'std' => '',
				),
				'custom_title_color'=>array(
					'type'=>'color',
					'title'=>JText::_('Custom Color'),
					'depends' => array(
						array('title_color', '=', '')
					),
				),
				'title_text_transform' => array(
					'type' => 'select',
					'title' => JText::_('Transform'),
					'desc' => JText::_('The following options will transform text into uppercased, capitalized or lowercased characters.'),
					'values' => array(
						'' => JText::_('Inherit'),
						'uppercase' => JText::_('Uppercase'),
						'capitalize' => JText::_('Capitalize'),
						'lowercase' => JText::_('Lowercase'),
					),
					'std' => '',
				),
				'heading_selector' => array(
					'type' => 'select',
					'title' => JText::_('HTML Element'),
					'desc' => JText::_('Choose one of the six heading elements to fit your semantic structure.'),
					'values' => array(
						'h1' => JText::_('h1'),
						'h2' => JText::_('h2'),
						'h3' => JText::_('h3'),
						'h4' => JText::_('h4'),
						'h5' => JText::_('h5'),
						'h6' => JText::_('h6'),
						'div' => JText::_('div'),
					),
					'std' => 'h3',
				),
				'title_margin_top' => array(
					'type' => 'select',
					'title' => JText::_('Margin Top'),
					'desc' => JText::_('Set the top margin.'),
					'values' => array(
						'' => JText::_('Default'),
						'small' => JText::_('Small'),
						'medium' => JText::_('Medium'),
						'large' => JText::_('Large'),
						'xlarge' => JText::_('X-Large'),
						'remove' => JText::_('None'),
					),
					'std' => 'remove',
				),

				'separator_content_options' => array(
					'type' => 'separator',
					'title' => JText::_('Content'),
				),
				'content_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('Font Family'),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.ui-content { font-family: {{ VALUE }}; }',
					)
				),
				'content_colors' => array(
					'type' => 'select',
					'title' => JText::_('Predefined Color'),
					'desc' => JText::_('Select the predefined content text color.'),
					'values' => array(
						'' => JText::_('None'),
						'text-muted' => JText::_('Muted'),
						'text-emphasis' => JText::_('Emphasis'),
						'text-primary' => JText::_('Primary'),
						'text-secondary' => JText::_('Secondary'),
						'text-success' => JText::_('Success'),
						'text-warning' => JText::_('Warning'),
						'text-danger' => JText::_('Danger'),
					),
					'std' => '',
				),
				'custom_content_color'=>array(
					'type'=>'color',
					'title'=>JText::_('Color'),
					'depends' => array(
						array('content_colors', '=', '')
					),
				),
				'content_dropcap' => array(
					'type' => 'checkbox',
					'title' => JText::_('Drop Cap'),
					'desc' => JText::_('Display the first letter of the paragraph as a large initial.'),
					'values' => array(
						1 => JText::_('JYES'),
						0 => JText::_('JNO'),
					),
					'std' => 0,
				),
				'content_column' => array(
					'type' => 'select',
					'title' => JText::_('Columns'),
					'desc' => JText::_('Set the number of text columns.'),
					'values' => array(
						'' => JText::_('None'),
						'1-2' => JText::_('Halves'),
						'1-3' => JText::_('Thirds'),
						'1-4' => JText::_('Quarters'),
						'1-5' => JText::_('Fifths'),
						'1-6' => JText::_('Sixths'),
					),
					'std' => '',
				),
				'content_column_divider' => array(
					'type' => 'checkbox',
					'title' => JText::_('Show dividers'),
					'desc' => JText::_('Show a divider between text columns.'),
					'values' => array(
						1 => JText::_('JYES'),
						0 => JText::_('JNO'),
					),
					'std' => 0,
					'depends' => array(array('content_column', '!=', '')),
				),
				'content_column_breakpoint' => array(
					'type' => 'select',
					'title' => JText::_('Columns Breakpoint'),
					'desc' => JText::_('Set the device width from which the text columns should apply'),
					'values' => array(
						'' => JText::_('Always'),
						's' => JText::_('Small (Phone Landscape)'),
						'm' => JText::_('Medium (Tablet Landscape)'),
						'l' => JText::_('Large (Desktop)'),
						'xl' => JText::_('X-Large (Large Screens)'),
					),
					'std' => 'm',
					'depends' => array(array('content_column', '!=', '')),
				),
				'content_style' => array(
					'type' => 'select',
					'title' => JText::_('Style'),
					'desc' => JText::_('Select a predefined meta text style, including color, size and font-family'),
					'values' => array(
						'' => JText::_('None'),
						'text-lead' => JText::_('Lead'),
						'text-meta' => JText::_('Meta'),
					),
					'std' => '',
				),
				'content_text_transform' => array(
					'type' => 'select',
					'title' => JText::_('Transform'),
					'desc' => JText::_('The following options will transform text into uppercased, capitalized or lowercased characters.'),
					'values' => array(
						'' => JText::_('Inherit'),
						'uppercase' => JText::_('Uppercase'),
						'capitalize' => JText::_('Capitalize'),
						'lowercase' => JText::_('Lowercase'),
					),
					'std' => '',
				),
				'content_margin_top' => array(
					'type' => 'select',
					'title' => JText::_('Margin Top'),
					'desc' => JText::_('Set the top margin.'),
					'values' => array(
						'' => JText::_('Default'),
						'small' => JText::_('Small'),
						'medium' => JText::_('Medium'),
						'large' => JText::_('Large'),
						'xlarge' => JText::_('X-Large'),
						'remove' => JText::_('None'),
					),
					'std' => '',
				),
				'separator_button_style_options' => array(
					'type' => 'separator',
					'title' => JText::_('Link'),
				),
				'link_new_tab' => array(
					'type' => 'select',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_LINK_NEWTAB'),
					'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_LINK_NEWTAB_DESC'),
					'values' => array(
						'' => JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_TARGET_SAME_WINDOW'),
						'_blank' => JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_TARGET_NEW_WINDOW'),
					),
					'std' => '',
					'depends' => array(
						array('button_title', '!=', ''),
					),
				),
				'link_button_style' => array(
					'type' => 'select',
					'title' => JText::_('Style'),
					'desc' => JText::_('Set the button style.'),
					'values' => array(
						'' => JText::_('Button Default'),
						'primary' => JText::_('Button Primary'),
						'secondary' => JText::_('Button Secondary'),
						'danger' => JText::_('Button Danger'),
						'text' => JText::_('Button Text'),
						'link' => JText::_('Link'),
						'link-muted' => JText::_('Link Muted'),
						'link-text' => JText::_('Link Text'),
						'custom' => JText::_('Custom'),
					),
					'std' => '',
				),
				'separator_button_custom_options' => array(
					'type' => 'separator',
					'title' => JText::_('Custom Button Style'),
					'depends' => array(
						array('link_button_style', '=', 'custom'),
					)
				),
				'button_font_family' => array(
					'type' => 'fonts',
					'title' => JText::_('Font Family'),
					'depends' => array(
						array('link_button_style', '=', 'custom'),
					),
					'selector' => array(
						'type' => 'font',
						'font' => '{{ VALUE }}',
						'css' => '.uk-button-custom { font-family: {{ VALUE }}; }',
					)
				),
				'button_background' => array(
					'type' => 'color',
					'title' => JText::_('Background Color'),
					'std' => '#1e87f0',
					'depends' => array(
						array('link_button_style', '=', 'custom'),
					)
				),
				'button_color'=>array(
					'type'=>'color',
					'title'=>JText::_('Button Color'),
					'depends' => array(
						array('link_button_style', '=', 'custom'),
					)
				),
				'button_background_hover' => array(
					'type' => 'color',
					'title' => JText::_('Hover Background Color'),
					'std' => '#1e87f0',
					'depends' => array(
						array('link_button_style', '=', 'custom'),
					)
				),
				'button_hover_color'=>array(
					'type'=>'color',
					'title'=>JText::_('Hover Button Color'),
					'depends' => array(
						array('link_button_style', '=', 'custom'),
					)
				),
				'link_button_size' => array(
					'type' => 'select',
					'title' => JText::_('Button Size'),
					'values' => array(
						'' => JText::_('Default'),
						'uk-button-small' => JText::_('Small'),
						'uk-button-large' => JText::_('Large'),
					),
					'std' => '',
				),
				'button_width' => array(
					'type' => 'checkbox',
					'title' => JText::_('Full Width'),
					'std' => 0,
				),
				'link_margin_top' => array(
					'type' => 'select',
					'title' => JText::_('Margin Top'),
					'desc' => JText::_('Set the top margin.'),
					'values' => array(
						'' => JText::_('Default'),
						'small' => JText::_('Small'),
						'medium' => JText::_('Medium'),
						'large' => JText::_('Large'),
						'xlarge' => JText::_('X-Large'),
						'remove' => JText::_('None'),
					),
					'std' => '',
				),
				'separator_general_options' => array(
					'type' => 'separator',
					'title' => JText::_('General'),
				),
				'addon_margin' => array(
					'type' => 'select',
					'title' => JText::_('Margin'),
					'desc' => JText::_('Set the vertical margin. Note: The first element\'s top margin and the last element\'s bottom margin are always removed. Define those in the grid settings instead.'),
					'values' => array(
						'' => JText::_('Keep existing'),
						'small' => JText::_('Small'),
						'default' => JText::_('Default'),
						'medium' => JText::_('Medium'),
						'large' => JText::_('Large'),
						'xlarge' => JText::_('X-Large'),
						'remove-vertical' => JText::_('None'),
					),
					'std' => '',
				),				
				'addon_max_width' => array(
					'type' => 'select',
					'title' => JText::_('Max Width'),
					'desc' => JText::_('Set the maximum content width.'),
					'values' => array(
						'' => JText::_('None'),
						'small' => JText::_('Small'),
						'medium' => JText::_('Medium'),
						'large' => JText::_('Large'),
						'xlarge' => JText::_('X-Large'),
						'2xlarge' => JText::_('2X-Large'),
					),
					'std' => '',
				),
				'addon_max_width_breakpoint' => array(
					'type' => 'select',
					'title' => JText::_('Max Width Breakpoint'),
					'desc' => JText::_('Define the device width from which the element\'s max-width will apply.'),
					'values' => array(
						'' => JText::_('Always'),
						's' => JText::_('Small (Phone Landscape)'),
						'm' => JText::_('Medium (Tablet Landscape)'),
						'l' => JText::_('Large (Desktop)'),
						'xl' => JText::_('X-Large (Large Screens)'),
					),
					'std' => '',
					'depends' => array(array('addon_max_width', '!=', '')),
				),
				'block_align'=>array(
					'type'=>'select',
					'title'=>JText::_('Block Alignment'),
					'desc'=>JText::_('Define the alignment in case the container exceeds the element\'s max-width.'),
					'values'=>array(
						''=>JText::_('Left'),
						'center'=>JText::_('Center'),
						'right'=>JText::_('Right'),
					),
					'std'=>'',
					'depends'=>array(array('addon_max_width', '!=', '')),
				),
				'block_align_breakpoint'=>array(
					'type'=>'select',
					'title'=>JText::_('Block Alignment Breakpoint'),
					'desc'=>JText::_('Define the device width from which the alignment will apply.'),
					'values'=>array(
						''=>JText::_('Always'),
						's'=>JText::_('Small (Phone Landscape)'),
						'm'=>JText::_('Medium (Tablet Landscape)'),
						'l'=>JText::_('Large (Desktop)'),
						'xl'=>JText::_('X-Large (Large Screens)'),
					),
					'std'=>'',
					'depends'=>array(array('addon_max_width', '!=', '')),
				),
				'block_align_fallback'=>array(
					'type'=>'select',
					'title'=>JText::_('Block Alignment Fallback'),
					'desc'=>JText::_('Define the alignment in case the container exceeds the element\'s max-width.'),
					'values'=>array(
						''=>JText::_('Left'),
						'center'=>JText::_('Center'),
						'right'=>JText::_('Right'),
					),
					'std'=>'',
					'depends'=>array(
					  array('addon_max_width', '!=', ''),
					  array('block_align_breakpoint', '!=', '')
					),
				),
				'alignment' => array(
					'type' => 'select',
					'title' => JText::_('Text Alignment'),
					'desc' => JText::_('Center, left and right alignment.'),
					'values' => array(
						'' => JText::_('Inherit'),
						'uk-text-left' => JText::_('Left'),
						'uk-text-center' => JText::_('Center'),
						'uk-text-right' => JText::_('Right'),
						'uk-text-justify' => JText::_('Justify'),
					),
					'std' => '',
				),
				'text_breakpoint' => array(
					'type' => 'select',
					'title' => JText::_('Text Alignment Breakpoint'),
					'desc' => JText::_('Display the text alignment only on this device width and larger'),
					'values' => array(
						'' => JText::_('Always'),
						's' => JText::_('Small (Phone Landscape)'),
						'm' => JText::_('Medium (Tablet Landscape)'),
						'l' => JText::_('Large (Desktop)'),
						'xl' => JText::_('X-Large (Large Screens)'),
					),
					'std' => '',
					'depends' => array(array('alignment', '!=', '')),
				),
				'text_alignment_fallback' => array(
					'type' => 'select',
					'title' => JText::_('Text Alignment Fallback'),
					'desc' => JText::_('Define an alignment fallback for device widths below the breakpoint'),
					'values' => array(
						'' => JText::_('Inherit'),
						'left' => JText::_('Left'),
						'center' => JText::_('Center'),
						'right' => JText::_('Right'),
						'justify' => JText::_('Justify'),
					),
					'std' => '',
					'depends' => array(
						array('text_breakpoint', '!=', ''),
						array('alignment', '!=', '')
					),
				),
				'animation' => array(
					'type' => 'select',
					'title' => JText::_('Animation'),
					'desc' => JText::_('A collection of smooth animations to use within your page.'),
					'values' => array(
						'' => JText::_('Inherit'),
						'fade' => JText::_('Fade'),
						'scale-up' => JText::_('Scale Up'),
						'scale-down' => JText::_('Scale Down'),
						'slide-top-small' => JText::_('Slide Top Small'),
						'slide-bottom-small' => JText::_('Slide Bottom Small'),
						'slide-left-small' => JText::_('Slide Left Small'),
						'slide-right-small' => JText::_('Slide Right Small'),
						'slide-top-medium' => JText::_('Slide Top Medium'),
						'slide-bottom-medium' => JText::_('Slide Bottom Medium'),
						'slide-left-medium' => JText::_('Slide Left Medium'),
						'slide-right-medium' => JText::_('Slide Right Medium'),
						'slide-top' => JText::_('Slide Top 100%'),
						'slide-bottom' => JText::_('Slide Bottom 100%'),
						'slide-left' => JText::_('Slide Left 100%'),
						'slide-right' => JText::_('Slide Right 100%'),
						'parallax' => JText::_('Parallax'),
					),
					'std' => '',
				),
				'animation_repeat' => array(
					'type' => 'checkbox',
					'title' => JText::_('Repeat Animation'),
					'desc' => JText::_('Applies the animation class every time the element is in view'),
					'std' => 0,
					'depends' => array(
						array('animation', '!=', ''),
						array('animation', '!=', 'parallax')
					),
				),

				'separator_parallax_options' => array(
					'type' => 'separator',
					'title' => JText::_('Parallax Animation Settings'),
					'depends' => array(array('animation', '=', 'parallax')),
				),
				'horizontal_start' => array(
					'type' => 'slider',
					'title' => JText::_('Horizontal Start'),
					'min' => -600,
					'max' => 600,
					'desc' => JText::_('Animate the horizontal position (translateX) in pixels.'),
					'depends' => array(array('animation', '=', 'parallax')),
				),
				'horizontal_end' => array(
					'type' => 'slider',
					'title' => JText::_('Horizontal End'),
					'min' => -600,
					'max' => 600,
					'desc' => JText::_('Animate the horizontal position (translateX) in pixels.'),
					'depends' => array(array('animation', '=', 'parallax')),
				),
				'vertical_start' => array(
					'type' => 'slider',
					'title' => JText::_('Vertical Start'),
					'min' => -600,
					'max' => 600,
					'desc' => JText::_('Animate the vertical position (translateY) in pixels.'),
					'depends' => array(array('animation', '=', 'parallax')),
				),
				'vertical_end' => array(
					'type' => 'slider',
					'title' => JText::_('Vertical End'),
					'min' => -600,
					'max' => 600,
					'desc' => JText::_('Animate the vertical position (translateY) in pixels.'),
					'depends' => array(array('animation', '=', 'parallax')),
				),
				'scale_start' => array(
					'type' => 'slider',
					'title' => JText::_('Scale Start'),
					'min' => 50,
					'max' => 200,
					'desc' => JText::_('Animate the scaling. Min: 50, Max: 200 =>  100 means 100% scale, 200 means 200% scale, and 50 means 50% scale.'),
					'depends' => array(array('animation', '=', 'parallax')),
				),
				'scale_end' => array(
					'type' => 'slider',
					'title' => JText::_('Scale End'),
					'min' => 50,
					'max' => 200,
					'desc' => JText::_('Animate the scaling. Min: 50, Max: 200 =>  100 means 100% scale, 200 means 200% scale, and 50 means 50% scale.'),
					'depends' => array(array('animation', '=', 'parallax')),
				),
				'rotate_start' => array(
					'type' => 'slider',
					'title' => JText::_('Rotate Start'),
					'min' => 0,
					'max' => 360,
					'desc' => JText::_('Animate the rotation clockwise in degrees.'),
					'depends' => array(array('animation', '=', 'parallax')),
				),
				'rotate_end' => array(
					'type' => 'slider',
					'title' => JText::_('Rotate End'),
					'min' => 0,
					'max' => 360,
					'desc' => JText::_('Animate the rotation clockwise in degrees.'),
					'depends' => array(array('animation', '=', 'parallax')),
				),
				'opacity_start' => array(
					'type' => 'slider',
					'title' => JText::_('Opacity Start'),
					'min' => 0,
					'max' => 100,
					'desc' => JText::_('Animate the opacity. 100 means 100% opacity, and 0 means 0% opacity.'),
					'depends' => array(array('animation', '=', 'parallax')),
				),
				'opacity_end' => array(
					'type' => 'slider',
					'title' => JText::_('Opacity End'),
					'min' => 0,
					'max' => 100,
					'desc' => JText::_('Animate the opacity. 100 means 100% opacity, and 0 means 0% opacity.'),
					'depends' => array(array('animation', '=', 'parallax')),
				),
				'easing' => array(
					'type' => 'slider',
					'title' => JText::_('Easing'),
					'min' => -200,
					'max' => 200,
					'desc' => JText::_('Set the animation easing. A value below 100 is faster in the beginning and slower towards the end while a value above 100 behaves inversely.'),
					'depends' => array(array('animation', '=', 'parallax')),
				),
				'viewport' => array(
					'type' => 'slider',
					'title' => JText::_('Viewport'),
					'min' => 10,
					'max' => 100,
					'desc' => JText::_('Set the animation end point relative to viewport height, e.g. 50 for 50% of the viewport'),
					'depends' => array(array('animation', '=', 'parallax')),
				),
				'parallax_target' => array(
					'type' => 'checkbox',
					'title' => JText::_('Target'),
					'desc' => JText::_('Animate the element as long as the section is visible.'),
					'std' => 0,
					'depends' => array(array('animation', '=', 'parallax')),
				),
				'parallax_zindex' => array(
					'type' => 'checkbox',
					'title' => JText::_('Z Index'),
					'desc' => JText::_('Set a higher stacking order.'),
					'std' => 0,
					'depends' => array(array('animation', '=', 'parallax')),
				),
				'breakpoint' => array(
					'type' => 'select',
					'title' => JText::_('Breakpoint'),
					'desc' => JText::_('Display the parallax effect only on this device width and larger. It is useful to disable the parallax animation on small viewports.'),
					'values' => array(
						'' => JText::_('Always'),
						's' => JText::_('Small (Phone)'),
						'm' => JText::_('Medium (Tablet)'),
						'l' => JText::_('Large (Desktop)'),
						'xl' => JText::_('X-Large (Large Screens)'),
					),
					'std' => '',
					'depends' => array(array('animation', '=', 'parallax')),
				),
				'visibility' => array(
					'type' => 'select',
					'title' => JText::_('Visibility'),
					'desc' => JText::_('Display the element only on this device width and larger.'),
					'values' => array(
						'' => JText::_('Always'),
						'uk-visible@s' => JText::_('Small (Phone Landscape)'),
						'uk-visible@m' => JText::_('Medium (Tablet Landscape)'),
						'uk-visible@l' => JText::_('Large (Desktop)'),
						'uk-visible@xl' => JText::_('X-Large (Large Screens)'),
						'uk-hidden@s' => JText::_('Hidden Small (Phone Landscape)'),
						'uk-hidden@m' => JText::_('Hidden Medium (Tablet Landscape)'),
						'uk-hidden@l' => JText::_('Hidden Large (Desktop)'),
						'uk-hidden@xl' => JText::_('Hidden X-Large (Large Screens)'),
					),
					'std' => '',
				  ),
				'class' => array(
					'type' => 'text',
					'title' => JText::_('COM_SPPAGEBUILDER_ADDON_CLASS'),
					'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_CLASS_DESC'),
					'std' => '',
				),
			),
		),
	)
);
