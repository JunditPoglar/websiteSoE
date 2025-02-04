<?php
/**
 * @package SP Page Builder
 * @author JoomShaper https://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2023 JoomShaper
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
//no direct access
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Language\Text;

SpAddonsConfig::addonConfig([
    'type'       => 'content',
    'addon_name' => 'tweet',
    'title'      => Text::_('COM_SPPAGEBUILDER_ADDON_TWEET'),
    'desc'       => Text::_('COM_SPPAGEBUILDER_ADDON_TWEET_DESC'),
    'category'   => 'Media',
    'icon'       => '<svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><path d="M.47 26.367a18.766 18.766 0 0010.075 2.904c5.268 0 10.096-2.024 13.595-5.698 3.348-3.517 5.19-8.242 5.098-13.037C30.508 9.45 32 7.376 32 5.356c0-.775-.84-1.267-1.523-.872-1.192.7-2.28.884-3.398.57-2.283-2.226-5.683-2.695-8.547-1.15-2.503 1.347-3.895 3.812-3.77 6.507a16.744 16.744 0 01-10.86-5.932 1.012 1.012 0 00-1.652.134C.937 6.861.95 9.465 2.092 11.568a1.052 1.052 0 00-.879 1.047c0 2.114.952 4.057 2.484 5.383-.286.275-.38.683-.26 1.047a7.254 7.254 0 004.106 4.397c-2.073.99-4.367 1.32-6.408 1.07C.08 24.37-.442 25.79.47 26.367zM10.82 23.79c.756-.581.355-1.791-.594-1.811a5.27 5.27 0 01-4.139-2.153c.457-.03.93-.1 1.38-.221 1.025-.278.977-1.757-.065-1.966a5.187 5.187 0 01-3.93-3.53 6.972 6.972 0 001.541.205c1.023.005 1.41-1.306.576-1.854-1.88-1.238-2.682-3.425-2.15-5.481a18.787 18.787 0 0012.444 5.555c.675.042 1.182-.593 1.034-1.236-.64-2.774.91-4.718 2.573-5.614 1.647-.89 4.29-1.167 6.317.96.602.634 2.634.658 3.667.417-.463.873-1.176 1.702-1.843 2.168-.284.2-.447.53-.43.877.217 4.426-1.432 8.826-4.524 12.072-3.115 3.27-7.423 5.072-12.132 5.072-1.872 0-3.709-.305-5.444-.892a13.646 13.646 0 005.72-2.568z" fill="currentColor"/></svg>',
    'settings' => [
        'content' => [
            'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_CONTENT'),
            'fields' => [
                'username' => [
                    'type'  => 'text',
                    'title' => Text::_('COM_SPPAGEBUILDER_ADDON_TWEET_USERNAME'),
                    'desc'  => Text::_('COM_SPPAGEBUILDER_ADDON_TWEET_USERNAME_DESC'),
                    'std'   => 'joomshaper',
                    'inline' => true,
                ],

                'consumerkey' => [
                    'type'  => 'text',
                    'title' => Text::_('COM_SPPAGEBUILDER_ADDON_TWEET_COUNSUMER_KEY'),
                    'desc'  => Text::_('COM_SPPAGEBUILDER_ADDON_TWEET_COUNSUMER_KEY_DESC'),
                    'inline' => true,
                ],

                'consumersecret' => [
                    'type'  => 'text',
                    'title' => Text::_('COM_SPPAGEBUILDER_ADDON_TWEET_COUNSUMER_SECRETE'),
                    'desc'  => Text::_('COM_SPPAGEBUILDER_ADDON_TWEET_COUNSUMER_SECRETE_DESC'),
                    'inline' => true,
                ],

                'accesstoken' => [
                    'type'  => 'text',
                    'title' => Text::_('COM_SPPAGEBUILDER_ADDON_TWEET_ACCESS_TOKEN'),
                    'desc'  => Text::_('COM_SPPAGEBUILDER_ADDON_TWEET_ACCESS_TOKEN_DESC'),
                    'inline' => true,
                ],

                'accesstokensecret' => [
                    'type'  => 'text',
                    'title' => Text::_('COM_SPPAGEBUILDER_ADDON_TWEET_ACCESS_TOKEN_SECRETE'),
                    'desc'  => Text::_('COM_SPPAGEBUILDER_ADDON_TWEET_ACCESS_TOKEN_SECRETE_DESC'),
                    'inline' => true,
                ],
            ],
        ],
        
        'options' => [
            'title' => Text::_('COM_SPPAGEBUILDER_ADDON_TWEET_OPTIONS'),
            'fields' => [
                'count' => [
                    'type'  => 'slider',
                    'title' => Text::_('COM_SPPAGEBUILDER_ADDON_TWEET_COUNT'),
                    'desc'  => Text::_('COM_SPPAGEBUILDER_ADDON_TWEET_COUNT_DESC'),
                    'std'   => 5,
                ],

                'include_rts' => [
                    'type'   => 'radio',
                    'title'  => Text::_('COM_SPPAGEBUILDER_ADDON_TWEET_INCLUDE_RTS'),
                    'desc'   => Text::_('COM_SPPAGEBUILDER_ADDON_TWEET_INCLUDE_RTS_DESC'),
                    'values' => [
                        'true'  => Text::_('JYES'),
                        'false' => Text::_('JNO'),
                    ],
                    'std' => 'false',
                ],

                'ignore_replies' => [
                    'type'   => 'radio',
                    'title'  => Text::_('COM_SPPAGEBUILDER_ADDON_TWEET_IGNORE_REPLIES'),
                    'desc'   => Text::_('COM_SPPAGEBUILDER_ADDON_TWEET_IGNORE_REPLIES_DESC'),
                    'values' => [
                        'true'  => Text::_('JYES'),
                        'false' => Text::_('JNO'),
                    ],
                    'std' => 'false',
                ],

                'show_image' => [
                    'type'  => 'checkbox',
                    'title' => Text::_('COM_SPPAGEBUILDER_ADDON_TWEET_SHOW_IMAGE'),
                    'desc'  => Text::_('COM_SPPAGEBUILDER_ADDON_TWEET_SHOW_IMAGE_DESC'),
                    'std'   => 1,
                ],

                'show_username' => [
                    'type'  => 'checkbox',
                    'title' => Text::_('COM_SPPAGEBUILDER_ADDON_TWEET_SHOW_USERNAME'),
                    'desc'  => Text::_('COM_SPPAGEBUILDER_ADDON_TWEET_SHOW_USERNAME_DESC'),
                    'std'   => 0,
                ],

                'show_avatar' => [
                    'type'  => 'checkbox',
                    'title' => Text::_('COM_SPPAGEBUILDER_ADDON_TWEET_SHOW_AVATAR'),
                    'desc'  => Text::_('COM_SPPAGEBUILDER_ADDON_TWEET_SHOW_AVATAR_DESC'),
                    'std'   => 1,
                ],

                'autoplay' => [
                    'type'  => 'checkbox',
                    'title' => Text::_('COM_SPPAGEBUILDER_ADDON_TWEET_AUTOPLAY'),
                    'desc'  => Text::_('COM_SPPAGEBUILDER_ADDON_TWEET_AUTOPLAY_DESC'),
                    'std'   => 1,
                ],
            ]
        ],

        'title' => [
            'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_TITLE'),
            'fields' => [
                'title' => [
                    'type'  => 'text',
                    'title' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE'),
                    'desc'  => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE_DESC'),
                ],
    
                'heading_selector' => [
                    'type'   => 'headings',
                    'title'  => Text::_('COM_SPPAGEBUILDER_ADDON_HEADINGS'),
                    'desc'   => Text::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_DESC'),
                    'std'   => 'h3',
                ],

                'title_typography' => [
                    'type'   => 'typography',
                    'title'  => Text::_('COM_SPPAGEBUILDER_GLOBAL_TYPOGRAPHY'),
                    'fallbacks'   => [
                        'font' => 'title_font_family',
                        'size' => 'title_fontsize',
                        'line_height' => 'title_lineheight',
                        'letter_spacing' => 'title_letterspace',
                        'uppercase' => 'title_font_style.uppercase',
                        'italic' => 'title_font_style.italic',
                        'underline' => 'title_font_style.underline',
                        'weight' => 'title_font_style.weight',
                    ],
                ],

                'title_text_color' => [
                    'type'   => 'color',
                    'title'  => Text::_('COM_SPPAGEBUILDER_GLOBAL_COLOR'),
                ],

                'title_margin_top' => [
                    'type'       => 'slider',
                    'title'      => Text::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN_TOP'),
                    'max'        => 400,
                    'responsive' => true,
                ],
            
                'title_margin_bottom' => [
                    'type'       => 'slider',
                    'title'      => Text::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN_BOTTOM'),
                    'max'        => 400,
                    'responsive' => true,
                ],
            ],
        ],
    ],
]);
