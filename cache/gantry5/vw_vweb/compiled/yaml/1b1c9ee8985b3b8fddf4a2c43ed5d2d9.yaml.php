<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => '/Users/Marcel/Sites/hello/templates/vw_vweb/custom/config/default/page/head.yaml',
    'modified' => 1488361828,
    'data' => [
        'meta' => [
            
        ],
        'head_bottom' => '',
        'atoms' => [
            0 => [
                'type' => 'frameworks',
                'title' => 'JavaScript Frameworks',
                'attributes' => [
                    'enabled' => '1',
                    'jquery' => [
                        'enabled' => '1',
                        'ui_core' => '0',
                        'ui_sortable' => '0'
                    ],
                    'bootstrap' => [
                        'enabled' => '0'
                    ],
                    'mootools' => [
                        'enabled' => '0',
                        'more' => '0'
                    ]
                ],
                'id' => 'frameworks-9745'
            ],
            1 => [
                'id' => 'uikit-1035',
                'type' => 'uikit',
                'title' => 'UIkit for Gantry5',
                'attributes' => [
                    'enabled' => '1',
                    'jslocation' => 'head'
                ]
            ],
            2 => [
                'id' => 'headroom-6974',
                'type' => 'headroom',
                'title' => 'Headroom.js',
                'attributes' => [
                    'enabled' => '1',
                    'cssselector' => '#g-navigation',
                    'offset' => '133',
                    'animation' => 'slide',
                    'mobile' => 'disable'
                ]
            ],
            3 => [
                'id' => 'scrollreveal-js-5102',
                'type' => 'scrollreveal-js',
                'title' => 'ScrollReveal.js',
                'attributes' => [
                    'enabled' => '1',
                    'mobile' => 'false'
                ]
            ],
            4 => [
                'id' => 'assets-7392',
                'type' => 'assets',
                'title' => 'Custom CSS / JS',
                'attributes' => [
                    'enabled' => '1',
                    'css' => [
                        
                    ],
                    'javascript' => [
                        0 => [
                            'location' => '',
                            'inline' => '
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="//v2.zopim.com/?4MpCGtoSN28LRPwfkpTsYPZykZPPu0D1";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");',
                            'in_footer' => '0',
                            'extra' => [
                                
                            ],
                            'priority' => '0',
                            'name' => 'Zopim Chat'
                        ]
                    ]
                ]
            ]
        ]
    ]
];
