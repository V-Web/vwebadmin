<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => '/Users/Marcel/Sites/hello/templates/vw_vweb/blueprints/styles/accent.yaml',
    'modified' => 1488361828,
    'data' => [
        'name' => 'Accent Colors',
        'description' => 'Accent colors for the Helium theme',
        'type' => 'core',
        'form' => [
            'fields' => [
                'color-1' => [
                    'type' => 'input.colorpicker',
                    'label' => 'V-Web Brand Color Red',
                    'default' => '#C50C16'
                ],
                'color-2' => [
                    'type' => 'input.colorpicker',
                    'label' => 'V-Web Brand Color Purple',
                    'default' => '#4E5AA7'
                ]
            ]
        ]
    ]
];
