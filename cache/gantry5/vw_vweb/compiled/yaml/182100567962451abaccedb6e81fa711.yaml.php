<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => '/Users/Marcel/Sites/hello/templates/vw_vweb/gantry/theme.yaml',
    'modified' => 1488361828,
    'data' => [
        'details' => [
            'name' => 'V-Web',
            'version' => '1.0.0',
            'icon' => 'joomla',
            'date' => 'September  16, 2016',
            'author' => [
                'name' => 'V-Web',
                'email' => 'info@v-web.nl',
                'link' => 'http://www.v-web.nl'
            ],
            'copyright' => '(C) 2010 - 2016 V-Web.nl. All rights reserved.',
            'license' => 'GPLv2',
            'description' => 'V-Web Custom Joomla Gantry5 Powered Theme',
            'images' => [
                'thumbnail' => 'admin/images/preset1.png',
                'preview' => 'admin/images/preset1.png'
            ]
        ],
        'configuration' => [
            'gantry' => [
                'platform' => 'joomla',
                'engine' => 'nucleus'
            ],
            'theme' => [
                'parent' => 'vw_vweb',
                'base' => 'gantry-theme://common',
                'file' => 'gantry-theme://includes/theme.php',
                'class' => '\\Gantry\\Framework\\Theme'
            ],
            'fonts' => NULL,
            'css' => [
                'compiler' => '\\Gantry\\Component\\Stylesheet\\ScssCompiler',
                'target' => 'gantry-theme://css-compiled',
                'paths' => [
                    0 => 'gantry-theme://scss',
                    1 => 'gantry-engine://scss'
                ],
                'files' => [
                    0 => 'vweb',
                    1 => 'vweb-joomla',
                    2 => 'custom'
                ],
                'persistent' => [
                    0 => 'vweb'
                ],
                'overrides' => [
                    0 => 'vweb-joomla',
                    1 => 'custom'
                ]
            ],
            'dependencies' => [
                'gantry' => '5.3.2'
            ],
            'block-variations' => [
                'Title Variations' => [
                    'title1' => 'Title 1',
                    'title2' => 'Title 2',
                    'title-gradient' => 'Title Gradient',
                    'title-outline' => 'Title Outline'
                ],
                'Box Variations' => [
                    'box1' => 'Box 1',
                    'box2' => 'Box 2',
                    'box-gradient' => 'Box Gradient',
                    'box-outline' => 'Box Outline'
                ],
                'Effects' => [
                    'spaced' => 'Spaced',
                    'shadow' => 'Shadow',
                    'rounded' => 'Rounded'
                ],
                'Utility' => [
                    'center' => 'Center',
                    'title-center' => 'Centered Title',
                    'equal-height' => 'Equal Height',
                    'disabled' => 'Disabled',
                    'align-right' => 'Align Right',
                    'align-left' => 'Align Left',
                    'nomarginall' => 'No Margin',
                    'nopaddingall' => 'No Padding'
                ]
            ]
        ],
        'admin' => [
            'styles' => [
                'core' => [
                    0 => 'base',
                    1 => 'accent',
                    2 => 'font'
                ],
                'section' => [
                    0 => 'navigation',
                    1 => 'header',
                    2 => 'intro',
                    3 => 'features',
                    4 => 'utility',
                    5 => 'above',
                    6 => 'testimonials',
                    7 => 'expanded',
                    8 => 'main',
                    9 => 'sidebar',
                    10 => 'footer',
                    11 => 'offcanvas'
                ],
                'configuration' => [
                    0 => 'breakpoints'
                ]
            ]
        ]
    ]
];
