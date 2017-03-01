<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => '/Users/Marcel/Sites/hello/templates/vw_vweb/particles/onepage-menu.yaml',
    'modified' => 1488361828,
    'data' => [
        'name' => 'OnePage Menu',
        'description' => 'Display OnePage Menu.',
        'type' => 'particle',
        'form' => [
            'fields' => [
                'enabled' => [
                    'type' => 'input.checkbox',
                    'label' => 'Enabled',
                    'description' => 'Globally enable OnePage Menu particles.',
                    'default' => true
                ],
                '_note' => [
                    'type' => 'separator.note',
                    'class' => 'alert alert-info',
                    'content' => '<strong>This Particle requires the "UIkit for Gantry5" Atom to be loaded.</strong>'
                ],
                'stickyoffset' => [
                    'type' => 'input.text',
                    'label' => 'Sticky Offset',
                    'description' => 'Set the sticky offset in pixels (when the OnePage Menu should get fixed/sticky).',
                    'default' => 130
                ],
                'smoothscrolloffset' => [
                    'type' => 'input.text',
                    'label' => 'Smooth Scroll Offset',
                    'description' => 'Set the smooth scroll offset in pixels (the element top offset).',
                    'default' => 120
                ],
                'boundary' => [
                    'type' => 'input.text',
                    'label' => 'Boundary',
                    'description' => 'Type in the boundary element, for example `#g-footer`. This keeps the sticky element within the dimensions of the boundary element.',
                    'default' => '#g-footer'
                ],
                'css.class' => [
                    'type' => 'input.selectize',
                    'label' => 'CSS Classes',
                    'description' => 'CSS class name for the particle.',
                    'default' => NULL
                ],
                'extra' => [
                    'type' => 'collection.keyvalue',
                    'label' => 'Tag Attributes',
                    'description' => 'Extra Tag attributes.',
                    'key_placeholder' => 'Key (data-*, style, ...)',
                    'value_placeholder' => 'Value',
                    'exclude' => [
                        0 => 'id',
                        1 => 'class'
                    ]
                ],
                'items' => [
                    'type' => 'collection.list',
                    'array' => true,
                    'label' => 'Menu Items',
                    'description' => 'Create each menu item to display.',
                    'value' => 'name',
                    'ajax' => true,
                    'fields' => [
                        '.title' => [
                            'type' => 'input.text',
                            'label' => 'Menu Title',
                            'description' => 'Type in the Menu Title.'
                        ],
                        '.link' => [
                            'type' => 'input.text',
                            'label' => 'ID',
                            'description' => 'Type in the ID of the corresponding part of the site (without \'#\').'
                        ],
                        '.subtitle1' => [
                            'type' => 'input.text',
                            'label' => 'Submenu 1 Title',
                            'description' => 'Type in the Submenu 1 Title.'
                        ],
                        '.sublink1' => [
                            'type' => 'input.text',
                            'label' => 'ID (Submenu 1)',
                            'description' => 'Type in the ID of the corresponding part of the site (without \'#\').'
                        ],
                        '.subtitle2' => [
                            'type' => 'input.text',
                            'label' => 'Submenu 2 Title',
                            'description' => 'Type in the Submenu 2 Title.'
                        ],
                        '.sublink2' => [
                            'type' => 'input.text',
                            'label' => 'ID (Submenu 2)',
                            'description' => 'Type in the ID of the corresponding part of the site (without \'#\').'
                        ],
                        '.subtitle3' => [
                            'type' => 'input.text',
                            'label' => 'Submenu 3 Title',
                            'description' => 'Type in the Submenu 3 Title.'
                        ],
                        '.sublink3' => [
                            'type' => 'input.text',
                            'label' => 'ID (Submenu 3)',
                            'description' => 'Type in the ID of the corresponding part of the site (without \'#\').'
                        ],
                        '.subtitle4' => [
                            'type' => 'input.text',
                            'label' => 'Submenu 4 Title',
                            'description' => 'Type in the Submenu 4 Title.'
                        ],
                        '.sublink4' => [
                            'type' => 'input.text',
                            'label' => 'ID (Submenu 4)',
                            'description' => 'Type in the ID of the corresponding part of the site (without \'#\').'
                        ],
                        '.subtitle5' => [
                            'type' => 'input.text',
                            'label' => 'Submenu 5 Title',
                            'description' => 'Type in the Submenu 5 Title.'
                        ],
                        '.sublink5' => [
                            'type' => 'input.text',
                            'label' => 'ID (Submenu 5)',
                            'description' => 'Type in the ID of the corresponding part of the site (without \'#\').'
                        ],
                        '.class' => [
                            'type' => 'input.selectize',
                            'label' => 'CSS Class'
                        ],
                        '.extra' => [
                            'type' => 'collection.keyvalue',
                            'label' => 'Tag Attributes',
                            'description' => 'Extra Tag attributes.',
                            'key_placeholder' => 'Key (data-*, style, ...)',
                            'value_placeholder' => 'Value',
                            'exclude' => [
                                0 => 'id',
                                1 => 'class'
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ]
];
