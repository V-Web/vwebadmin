<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => '/Users/Marcel/Sites/hello/templates/vw_vweb/blueprints/styles/services.yaml',
    'modified' => 1474232915,
    'data' => [
        'name' => 'Services Styles',
        'description' => 'Services section styles for the Helium theme',
        'type' => 'section',
        'form' => [
            'fields' => [
                'background' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Background',
                    'default' => '#222222'
                ],
                'text-color' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Text',
                    'default' => '#ffffff'
                ],
                'heading-link-color' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Heading Color',
                    'default' => '#222222'
                ],
                'heading-hover-color' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Heading Hover',
                    'default' => '#222222'
                ],
                'background-image' => [
                    'type' => 'input.imagepicker',
                    'label' => 'Background Image',
                    'default' => 'gantry-media://header/img01.jpg'
                ]
            ]
        ]
    ]
];
