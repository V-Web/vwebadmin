<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => '/Users/Marcel/Sites/hello/templates/vw_vweb/blueprints/styles/base.yaml',
    'modified' => 1488361828,
    'data' => [
        'name' => 'Base Styles',
        'description' => 'Base styles for the Helium theme',
        'type' => 'core',
        'form' => [
            'fields' => [
                'background' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Base Background',
                    'default' => '#ffffff'
                ],
                'text-color' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Base Text Color',
                    'default' => '#424753'
                ],
                'favicon' => [
                    'type' => 'input.imagepicker',
                    'label' => 'Favicon',
                    'filter' => '.(jpe?g|gif|png|svg|ico)$'
                ]
            ]
        ]
    ]
];
