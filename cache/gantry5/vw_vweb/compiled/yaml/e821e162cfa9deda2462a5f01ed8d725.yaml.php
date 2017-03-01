<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => '/Users/Marcel/Sites/hello/templates/vw_vweb/particles/owlcarousel.yaml',
    'modified' => 1488361828,
    'data' => [
        'name' => 'Owl Carousel',
        'description' => 'Display Owl Carousel.',
        'type' => 'particle',
        'icon' => 'fa-sliders',
        'form' => [
            'fields' => [
                'enabled' => [
                    'type' => 'input.checkbox',
                    'label' => 'Enabled',
                    'description' => 'Globally enable icon menu particles.',
                    'default' => true
                ],
                'class' => [
                    'type' => 'input.selectize',
                    'label' => 'CSS Classes',
                    'description' => 'CSS class name for the particle.'
                ],
                'title' => [
                    'type' => 'input.text',
                    'label' => 'Title',
                    'description' => 'Customize the title text.',
                    'placeholder' => 'Enter title'
                ],
                'layout' => [
                    'type' => 'select.select',
                    'label' => 'Layout',
                    'description' => 'Choose the layout.',
                    'default' => 'standard',
                    'options' => [
                        'standard' => 'Standard',
                        'testimonial' => 'Testimonial',
                        'showcase' => 'Showcase'
                    ]
                ],
                'width' => [
                    'type' => 'select.select',
                    'label' => 'Width',
                    'description' => 'Choose the width.',
                    'default' => 'g-owlcarousel-fullwidth',
                    'options' => [
                        'g-owlcarousel-fullwidth' => 'Full Width',
                        'g-owlcarousel-compact' => 'Compact'
                    ]
                ],
                'animateOut' => [
                    'type' => 'select.select',
                    'label' => 'Out Animation',
                    'description' => 'Customize the Out Animation from animate css class.',
                    'default' => 'fadeOut',
                    'options' => [
                        'default' => 'default',
                        'bounce' => 'bounce',
                        'flash' => 'flash',
                        'pulse' => 'pulse',
                        'rubberBand' => 'rubberBand',
                        'shake' => 'shake',
                        'swing' => 'swing',
                        'tada' => 'tada',
                        'wobble' => 'wobble',
                        'jello' => 'jello',
                        'bounceIn' => 'bounceIn',
                        'bounceInDown' => 'bounceInDown',
                        'bounceInLeft' => 'bounceInLeft',
                        'bounceInRight' => 'bounceInRight',
                        'bounceInUp' => 'bounceInUp',
                        'bounceOut' => 'bounceOut',
                        'bounceOutDown' => 'bounceOutDown',
                        'bounceOutLeft' => 'bounceOutLeft',
                        'bounceOutRight' => 'bounceOutRight',
                        'bounceOutUp' => 'bounceOutUp',
                        'fadeIn' => 'fadeIn',
                        'fadeInDown' => 'fadeInDown',
                        'fadeInDownBig' => 'fadeInDownBig',
                        'fadeInLeft' => 'fadeInLeft',
                        'fadeInLeftBig' => 'fadeInLeftBig',
                        'fadeInRight' => 'fadeInRight',
                        'fadeInRightBig' => 'fadeInRightBig',
                        'fadeInUp' => 'fadeInUp',
                        'fadeInUpBig' => 'fadeInUpBig',
                        'fadeOut' => 'fadeOut',
                        'fadeOutDown' => 'fadeOutDown',
                        'fadeOutDownBig' => 'fadeOutDownBig',
                        'fadeOutLeft' => 'fadeOutLeft',
                        'fadeOutLeftBig' => 'fadeOutLeftBig',
                        'fadeOutRight' => 'fadeOutRight',
                        'fadeOutRightBig' => 'fadeOutRightBig',
                        'fadeOutUp' => 'fadeOutUp',
                        'fadeOutUpBig' => 'fadeOutUpBig',
                        'flip' => 'flip',
                        'flipInX' => 'flipInX',
                        'flipInY' => 'flipInY',
                        'flipOutX' => 'flipOutX',
                        'flipOutY' => 'flipOutY',
                        'lightSpeedIn' => 'lightSpeedIn',
                        'lightSpeedOut' => 'lightSpeedOut',
                        'rotateIn' => 'rotateIn',
                        'rotateInDownLeft' => 'rotateInDownLeft',
                        'rotateInDownRight' => 'rotateInDownRight',
                        'rotateInUpLeft' => 'rotateInUpLeft',
                        'rotateInUpRight' => 'rotateInUpRight',
                        'rotateOut' => 'rotateOut',
                        'rotateOutDownLeft' => 'rotateOutDownLeft',
                        'rotateOutDownRight' => 'rotateOutDownRight',
                        'rotateOutUpLeft' => 'rotateOutUpLeft',
                        'rotateOutUpRight' => 'rotateOutUpRight',
                        'slideInUp' => 'slideInUp',
                        'slideInDown' => 'slideInDown',
                        'slideInLeft' => 'slideInLeft',
                        'slideInRight' => 'slideInRight',
                        'slideOutUp' => 'slideOutUp',
                        'slideOutDown' => 'slideOutDown',
                        'slideOutLeft' => 'slideOutLeft',
                        'slideOutRight' => 'slideOutRight',
                        'zoomIn' => 'zoomIn',
                        'zoomInDown' => 'zoomInDown',
                        'zoomInLeft' => 'zoomInLeft',
                        'zoomInRight' => 'zoomInRight',
                        'zoomInUp' => 'zoomInUp',
                        'zoomOut' => 'zoomOut',
                        'zoomOutDown' => 'zoomOutDown',
                        'zoomOutLeft' => 'zoomOutLeft',
                        'zoomOutRight' => 'zoomOutRight',
                        'zoomOutUp' => 'zoomOutUp',
                        'hinge' => 'hinge',
                        'rollIn' => 'rollIn',
                        'rollOut' => 'rollOut'
                    ]
                ],
                'animateIn' => [
                    'type' => 'select.select',
                    'label' => 'In Animation',
                    'description' => 'Customize the In Animation from animate css class.',
                    'default' => 'fadeIn',
                    'options' => [
                        'default' => 'default',
                        'bounce' => 'bounce',
                        'flash' => 'flash',
                        'pulse' => 'pulse',
                        'rubberBand' => 'rubberBand',
                        'shake' => 'shake',
                        'swing' => 'swing',
                        'tada' => 'tada',
                        'wobble' => 'wobble',
                        'jello' => 'jello',
                        'bounceIn' => 'bounceIn',
                        'bounceInDown' => 'bounceInDown',
                        'bounceInLeft' => 'bounceInLeft',
                        'bounceInRight' => 'bounceInRight',
                        'bounceInUp' => 'bounceInUp',
                        'bounceOut' => 'bounceOut',
                        'bounceOutDown' => 'bounceOutDown',
                        'bounceOutLeft' => 'bounceOutLeft',
                        'bounceOutRight' => 'bounceOutRight',
                        'bounceOutUp' => 'bounceOutUp',
                        'fadeIn' => 'fadeIn',
                        'fadeInDown' => 'fadeInDown',
                        'fadeInDownBig' => 'fadeInDownBig',
                        'fadeInLeft' => 'fadeInLeft',
                        'fadeInLeftBig' => 'fadeInLeftBig',
                        'fadeInRight' => 'fadeInRight',
                        'fadeInRightBig' => 'fadeInRightBig',
                        'fadeInUp' => 'fadeInUp',
                        'fadeInUpBig' => 'fadeInUpBig',
                        'fadeOut' => 'fadeOut',
                        'fadeOutDown' => 'fadeOutDown',
                        'fadeOutDownBig' => 'fadeOutDownBig',
                        'fadeOutLeft' => 'fadeOutLeft',
                        'fadeOutLeftBig' => 'fadeOutLeftBig',
                        'fadeOutRight' => 'fadeOutRight',
                        'fadeOutRightBig' => 'fadeOutRightBig',
                        'fadeOutUp' => 'fadeOutUp',
                        'fadeOutUpBig' => 'fadeOutUpBig',
                        'flip' => 'flip',
                        'flipInX' => 'flipInX',
                        'flipInY' => 'flipInY',
                        'flipOutX' => 'flipOutX',
                        'flipOutY' => 'flipOutY',
                        'lightSpeedIn' => 'lightSpeedIn',
                        'lightSpeedOut' => 'lightSpeedOut',
                        'rotateIn' => 'rotateIn',
                        'rotateInDownLeft' => 'rotateInDownLeft',
                        'rotateInDownRight' => 'rotateInDownRight',
                        'rotateInUpLeft' => 'rotateInUpLeft',
                        'rotateInUpRight' => 'rotateInUpRight',
                        'rotateOut' => 'rotateOut',
                        'rotateOutDownLeft' => 'rotateOutDownLeft',
                        'rotateOutDownRight' => 'rotateOutDownRight',
                        'rotateOutUpLeft' => 'rotateOutUpLeft',
                        'rotateOutUpRight' => 'rotateOutUpRight',
                        'slideInUp' => 'slideInUp',
                        'slideInDown' => 'slideInDown',
                        'slideInLeft' => 'slideInLeft',
                        'slideInRight' => 'slideInRight',
                        'slideOutUp' => 'slideOutUp',
                        'slideOutDown' => 'slideOutDown',
                        'slideOutLeft' => 'slideOutLeft',
                        'slideOutRight' => 'slideOutRight',
                        'zoomIn' => 'zoomIn',
                        'zoomInDown' => 'zoomInDown',
                        'zoomInLeft' => 'zoomInLeft',
                        'zoomInRight' => 'zoomInRight',
                        'zoomInUp' => 'zoomInUp',
                        'zoomOut' => 'zoomOut',
                        'zoomOutDown' => 'zoomOutDown',
                        'zoomOutLeft' => 'zoomOutLeft',
                        'zoomOutRight' => 'zoomOutRight',
                        'zoomOutUp' => 'zoomOutUp',
                        'hinge' => 'hinge',
                        'rollIn' => 'rollIn',
                        'rollOut' => 'rollOut'
                    ]
                ],
                'nav' => [
                    'type' => 'select.select',
                    'label' => 'Prev / Next',
                    'description' => 'Enable or disable the Prev / Next navigation.',
                    'default' => 'enabled',
                    'options' => [
                        'enabled' => 'Enable',
                        'disabled' => 'Disable'
                    ]
                ],
                'prevText' => [
                    'type' => 'input.text',
                    'label' => 'Prev Text',
                    'description' => 'Customize the Prev text if Prev / Next navigation is enabled.',
                    'placeholder' => NULL
                ],
                'nextText' => [
                    'type' => 'input.text',
                    'label' => 'Next Text',
                    'description' => 'Customize the Nav text if Prev / Next navigation is enabled.',
                    'placeholder' => NULL
                ],
                'dots' => [
                    'type' => 'select.select',
                    'label' => 'Dots',
                    'description' => 'Enable or disable the Dots navigation.',
                    'default' => 'disabled',
                    'options' => [
                        'enabled' => 'Enable',
                        'disabled' => 'Disable'
                    ]
                ],
                'loop' => [
                    'type' => 'select.select',
                    'label' => 'Loop',
                    'description' => 'Enable or disable the Inifnity loop. Duplicate last and first items to get loop illusion.',
                    'default' => 'enabled',
                    'options' => [
                        'enabled' => 'Enable',
                        'disabled' => 'Disable'
                    ]
                ],
                'autoplay' => [
                    'type' => 'select.select',
                    'label' => 'Autoplay',
                    'description' => 'Enable or disable the Autoplay.',
                    'default' => 'disabled',
                    'options' => [
                        'enabled' => 'Enable',
                        'disabled' => 'Disable'
                    ]
                ],
                'autoplaySpeed' => [
                    'type' => 'input.text',
                    'label' => 'Autoplay Speed',
                    'description' => 'Set the speed of the Autoplay, in milliseconds.',
                    'placeholder' => 5000
                ],
                'pauseOnHover' => [
                    'type' => 'select.select',
                    'label' => 'Pause on Hover',
                    'description' => 'Pause the slideshow when hovering over slider, then resume when no longer hovering.',
                    'default' => 'enabled',
                    'options' => [
                        'enabled' => 'Enable',
                        'disabled' => 'Disable'
                    ]
                ],
                'items' => [
                    'type' => 'collection.list',
                    'array' => true,
                    'label' => 'Owl Carousel Items',
                    'description' => 'Create each Owl Carousel item to display.',
                    'value' => 'name',
                    'ajax' => true,
                    'fields' => [
                        '.image' => [
                            'type' => 'input.imagepicker',
                            'label' => 'Image',
                            'description' => 'Select desired image.'
                        ],
                        '.icon' => [
                            'type' => 'input.icon',
                            'label' => 'Icon'
                        ],
                        '.icon2' => [
                            'type' => 'input.icon',
                            'label' => 'Icon 2'
                        ],
                        '.title' => [
                            'type' => 'input.text',
                            'label' => 'Title',
                            'description' => 'Enter the title'
                        ],
                        '.subtitle' => [
                            'type' => 'input.text',
                            'label' => 'Subtitle',
                            'description' => 'Enter the subtitle'
                        ],
                        '.desc' => [
                            'type' => 'textarea.textarea',
                            'label' => 'Description',
                            'description' => 'Customize the description.',
                            'placeholder' => 'Enter short description'
                        ],
                        '.link' => [
                            'type' => 'input.text',
                            'label' => 'Link',
                            'description' => 'Input the item link.'
                        ],
                        '.linktext' => [
                            'type' => 'input.text',
                            'label' => 'Link Text',
                            'description' => 'Input the text for the item link.'
                        ],
                        '.buttontarget' => [
                            'type' => 'select.selectize',
                            'label' => 'Target',
                            'description' => 'Target browser window when item is clicked.',
                            'placeholder' => 'Select...',
                            'default' => '_self',
                            'options' => [
                                '_self' => 'Self',
                                '_blank' => 'New Window'
                            ]
                        ],
                        '.buttonclass' => [
                            'type' => 'input.text',
                            'label' => 'Button Class',
                            'description' => 'Input the button class.'
                        ]
                    ]
                ]
            ]
        ]
    ]
];
