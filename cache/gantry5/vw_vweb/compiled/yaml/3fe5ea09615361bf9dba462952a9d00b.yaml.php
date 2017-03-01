<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => '/Users/Marcel/Sites/hello/templates/vw_vweb/custom/config/default/particles/top-news-joomla.yaml',
    'modified' => 1488361828,
    'data' => [
        'enabled' => '1',
        'mainheading' => '',
        'introtext' => '',
        'height' => '450',
        'style' => 'style1',
        'layout' => 'layout1',
        'gutter' => 'disabled',
        'article' => [
            'filter' => [
                'featured' => 'include'
            ],
            'limit' => [
                'start' => '0'
            ],
            'sort' => [
                'orderby' => 'publish_up',
                'ordering' => 'ASC'
            ],
            'display' => [
                'image' => [
                    'enabled' => 'intro'
                ],
                'title' => [
                    'enabled' => 'show'
                ],
                'date' => [
                    'enabled' => 'published',
                    'format' => 'l, F d, Y'
                ],
                'category' => [
                    'enabled' => 'link'
                ],
                'author' => [
                    'enabled' => ''
                ],
                'hits' => [
                    'enabled' => ''
                ],
                'text' => [
                    'type' => 'intro',
                    'limit' => '',
                    'formatting' => 'text'
                ]
            ]
        ]
    ]
];
