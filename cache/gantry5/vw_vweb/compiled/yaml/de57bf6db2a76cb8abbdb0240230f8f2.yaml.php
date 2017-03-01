<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => '/Users/Marcel/Sites/hello/templates/vw_vweb/particles/pricing.yaml',
    'modified' => 1488361828,
    'data' => [
        'name' => 'Pricing Tables',
        'description' => 'Display pricing tables.',
        'type' => 'particle',
        'form' => [
            'fields' => [
                'enabled' => [
                    'type' => 'input.checkbox',
                    'label' => 'Enabled',
                    'description' => 'Globally enable Pricing Tables particles.',
                    'default' => true
                ],
                'mainheading' => [
                    'type' => 'input.text',
                    'label' => 'Title',
                    'description' => 'Type in the title.',
                    'placeholder' => 'Enter Title',
                    'default' => ''
                ],
                'introtext' => [
                    'type' => 'textarea.textarea',
                    'label' => 'Intro Text',
                    'description' => 'Type in the intro text.',
                    'placeholder' => 'Enter Intro Text',
                    'default' => ''
                ],
                'style' => [
                    'type' => 'select.select',
                    'label' => 'Style',
                    'description' => 'Select the style which defines the particle layout on the frontend.',
                    'placeholder' => 'Select...',
                    'default' => 'style1',
                    'options' => [
                        'style1' => 'Style 1',
                        'style2' => 'Style 2'
                    ]
                ],
                'gutter' => [
                    'type' => 'select.select',
                    'label' => 'Gutter',
                    'description' => 'Enable or disable the Pricing Tables gutter (to have space between the items or not).',
                    'placeholder' => 'Select...',
                    'default' => 'enabled',
                    'options' => [
                        'enabled' => 'Enabled',
                        'disabled' => 'Disabled'
                    ]
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
                    'label' => 'Pricing Tables',
                    'description' => 'Create each pricing table to display.',
                    'value' => 'name',
                    'ajax' => true,
                    'fields' => [
                        '.title' => [
                            'type' => 'input.text',
                            'label' => 'Title',
                            'description' => 'Type in the table title.'
                        ],
                        '.price' => [
                            'type' => 'input.text',
                            'label' => 'Price',
                            'description' => 'Type in the table price.'
                        ],
                        '.period' => [
                            'type' => 'input.text',
                            'label' => 'Period',
                            'description' => 'Type in the table period (for example, \'per month\').'
                        ],
                        '.buttontext' => [
                            'type' => 'input.text',
                            'label' => 'Button Text',
                            'description' => 'Type in the button text.'
                        ],
                        '.buttonicon' => [
                            'type' => 'input.icon',
                            'label' => 'Button Icon',
                            'description' => 'Select an icon for the button.'
                        ],
                        '.link' => [
                            'type' => 'input.text',
                            'label' => 'Button Link',
                            'description' => 'Type in the button link.'
                        ],
                        '.target' => [
                            'type' => 'select.select',
                            'label' => 'Target',
                            'description' => 'Target browser window when item is clicked.',
                            'placeholder' => 'Select...',
                            'default' => '_parent',
                            'options' => [
                                '_parent' => 'Self',
                                '_blank' => 'New Window'
                            ]
                        ],
                        '.featured' => [
                            'type' => 'input.checkbox',
                            'label' => 'Featured Table',
                            'description' => 'Make this table featured.',
                            'default' => 0
                        ],
                        '.item1' => [
                            'type' => 'input.text',
                            'label' => 'Item 1'
                        ],
                        '.item1icon' => [
                            'type' => 'input.icon',
                            'label' => 'Item Icon',
                            'description' => 'Select an icon for the item.'
                        ],
                        '.item2' => [
                            'type' => 'input.text',
                            'label' => 'Item 2'
                        ],
                        '.item2icon' => [
                            'type' => 'input.icon',
                            'label' => 'Item Icon',
                            'description' => 'Select an icon for the item.'
                        ],
                        '.item3' => [
                            'type' => 'input.text',
                            'label' => 'Item 3'
                        ],
                        '.item3icon' => [
                            'type' => 'input.icon',
                            'label' => 'Item Icon',
                            'description' => 'Select an icon for the item.'
                        ],
                        '.item4' => [
                            'type' => 'input.text',
                            'label' => 'Item 4'
                        ],
                        '.item4icon' => [
                            'type' => 'input.icon',
                            'label' => 'Item Icon',
                            'description' => 'Select an icon for the item.'
                        ],
                        '.item5' => [
                            'type' => 'input.text',
                            'label' => 'Item 5'
                        ],
                        '.item5icon' => [
                            'type' => 'input.icon',
                            'label' => 'Item Icon',
                            'description' => 'Select an icon for the item.'
                        ],
                        '.item6' => [
                            'type' => 'input.text',
                            'label' => 'Item 6'
                        ],
                        '.item6icon' => [
                            'type' => 'input.icon',
                            'label' => 'Item Icon',
                            'description' => 'Select an icon for the item.'
                        ],
                        '.item7' => [
                            'type' => 'input.text',
                            'label' => 'Item 7'
                        ],
                        '.item7icon' => [
                            'type' => 'input.icon',
                            'label' => 'Item Icon',
                            'description' => 'Select an icon for the item.'
                        ],
                        '.item8' => [
                            'type' => 'input.text',
                            'label' => 'Item 8'
                        ],
                        '.item8icon' => [
                            'type' => 'input.icon',
                            'label' => 'Item Icon',
                            'description' => 'Select an icon for the item.'
                        ],
                        '.item9' => [
                            'type' => 'input.text',
                            'label' => 'Item 9'
                        ],
                        '.item9icon' => [
                            'type' => 'input.text',
                            'label' => 'Item 9 after'
                        ],
                        '.item10' => [
                            'type' => 'input.text',
                            'label' => 'Item 10'
                        ],
                        '.item10icon' => [
                            'type' => 'input.text',
                            'label' => 'Item 10 after'
                        ],
                        '.class' => [
                            'type' => 'input.selectize',
                            'label' => 'CSS Class',
                            'description' => 'CSS class name for this table.'
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
