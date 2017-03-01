<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => '/Users/Marcel/Sites/hello/templates/vw_vweb/particles/news-pro-joomla.yaml',
    'modified' => 1474836038,
    'data' => [
        'name' => 'News PRO (Joomla)',
        'description' => 'Display Joomla articles in an awesome way.',
        'type' => 'particle',
        'form' => [
            'fields' => [
                'enabled' => [
                    'type' => 'input.checkbox',
                    'label' => 'Enabled',
                    'description' => 'Globally enable News PRO (Joomla) particles.',
                    'default' => true
                ],
                '_note' => [
                    'type' => 'separator.note',
                    'class' => 'alert alert-info',
                    'content' => '<strong>This Particle requires the "UIkit for Gantry5" Atom to be loaded.</strong>'
                ],
                '_tabs' => [
                    'type' => 'container.tabs',
                    'fields' => [
                        '_tab_main' => [
                            'label' => 'Main Settings',
                            'fields' => [
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
                                'pages' => [
                                    'type' => 'select.select',
                                    'label' => 'Number of Slides',
                                    'description' => 'Select the number of slides (pages with articles) you want.',
                                    'placeholder' => 'Select...',
                                    'default' => 3,
                                    'options' => [
                                        1 => 1,
                                        2 => 2,
                                        3 => 3,
                                        4 => 4,
                                        5 => 5,
                                        6 => 6,
                                        7 => 7,
                                        8 => 8,
                                        9 => 9,
                                        10 => 10
                                    ]
                                ],
                                'columns' => [
                                    'type' => 'select.select',
                                    'label' => 'Number of Columns',
                                    'description' => 'Select the number of columns visible on one slide/page with articles.',
                                    'placeholder' => 'Select...',
                                    'default' => 3,
                                    'options' => [
                                        1 => 1,
                                        2 => 2,
                                        3 => 3,
                                        4 => 4,
                                        5 => 5,
                                        6 => 6,
                                        10 => 10
                                    ]
                                ],
                                'rows' => [
                                    'type' => 'select.select',
                                    'label' => 'Number of Rows',
                                    'description' => 'Select the number of rows visible on one slide/page with articles.',
                                    'placeholder' => 'Select...',
                                    'default' => 1,
                                    'options' => [
                                        1 => 1,
                                        2 => 2,
                                        3 => 3,
                                        4 => 4,
                                        5 => 5,
                                        6 => 6,
                                        7 => 7,
                                        8 => 8,
                                        9 => 9,
                                        10 => 10
                                    ]
                                ],
                                'navigation' => [
                                    'type' => 'select.select',
                                    'label' => 'Navigation',
                                    'description' => 'Select the navigation type.',
                                    'placeholder' => 'Select...',
                                    'default' => 'arrows',
                                    'options' => [
                                        'arrows' => 'Arrows',
                                        'dots' => 'Dots',
                                        'both' => 'Both',
                                        'none' => 'None'
                                    ]
                                ],
                                'animation' => [
                                    'type' => 'select.select',
                                    'label' => 'Animation',
                                    'description' => 'Select the animation type.',
                                    'placeholder' => 'Select...',
                                    'default' => 'slide',
                                    'options' => [
                                        'fade' => 'Fade',
                                        'scale' => 'Scale',
                                        'slide-horizontal' => 'Slide-horizontal',
                                        'slide-vertical' => 'Slide-vertical',
                                        'slide-top' => 'Slide-top',
                                        'slide-bottom' => 'Slide-bottom',
                                        'none' => 'None'
                                    ]
                                ],
                                'duration' => [
                                    'type' => 'input.text',
                                    'label' => 'Animation Duration',
                                    'description' => 'Set the animation duration in miliseconds.',
                                    'default' => 200
                                ],
                                'autoplay' => [
                                    'type' => 'select.select',
                                    'label' => 'Autoplay',
                                    'description' => 'Select whether or not the slides/pages should switch automatically.',
                                    'placeholder' => 'Select...',
                                    'default' => 'disable',
                                    'options' => [
                                        'enable' => 'Enabled',
                                        'disable' => 'Disabled'
                                    ]
                                ],
                                'autoplayInterval' => [
                                    'type' => 'input.text',
                                    'label' => 'Autoplay Interval',
                                    'description' => 'Set the timespan in miliseconds between switching the slides/pages.',
                                    'default' => 7000
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
                                ]
                            ]
                        ],
                        '_tab_source' => [
                            'label' => 'Data Source',
                            'fields' => [
                                'article.filter.categories' => [
                                    'type' => 'joomla.categories',
                                    'label' => 'Categories',
                                    'description' => 'Select the categories the articles should be taken from.',
                                    'overridable' => false
                                ],
                                'article.filter.articles' => [
                                    'type' => 'input.text',
                                    'label' => 'Articles',
                                    'description' => 'Enter the Joomla articles that should be shown. It should be a list of article IDs separated with a comma (i.e. 1,2,3,4,5).',
                                    'overridable' => false
                                ],
                                'article.filter.featured' => [
                                    'type' => 'select.select',
                                    'label' => 'Featured Articles',
                                    'description' => 'Select how Featured articles should be filtered.',
                                    'default' => '',
                                    'options' => [
                                        'include' => 'Include Featured',
                                        'exclude' => 'Exclude Featured',
                                        'only' => 'Only Featured'
                                    ],
                                    'overridable' => false
                                ],
                                'article.limit.start' => [
                                    'type' => 'input.text',
                                    'label' => 'Start From',
                                    'description' => 'Enter offset specifying the first article to return. The default is \'0\' (the first article).',
                                    'default' => 0,
                                    'pattern' => '\\d{1,2}',
                                    'overridable' => false
                                ],
                                'article.sort.orderby' => [
                                    'type' => 'select.select',
                                    'label' => 'Order By',
                                    'description' => 'Select how the articles should be ordered by.',
                                    'default' => 'publish_up',
                                    'options' => [
                                        'publish_up' => 'Published Date',
                                        'created' => 'Created Date',
                                        'modified' => 'Last Modified Date',
                                        'title' => 'Title',
                                        'ordering' => 'Ordering',
                                        'hits' => 'Hits',
                                        'id' => 'ID',
                                        'alias' => 'Alias'
                                    ],
                                    'overridable' => false
                                ],
                                'article.sort.ordering' => [
                                    'type' => 'select.select',
                                    'label' => 'Ordering Direction',
                                    'description' => 'Select the direction the articles should be ordered by.',
                                    'default' => 'ASC',
                                    'options' => [
                                        'ASC' => 'Ascending',
                                        'DESC' => 'Descending'
                                    ],
                                    'overridable' => false
                                ]
                            ]
                        ],
                        '_tab_layout' => [
                            'label' => 'Article Layout',
                            'fields' => [
                                'layout' => [
                                    'type' => 'select.select',
                                    'label' => 'Layout',
                                    'description' => 'Select the article layout.',
                                    'default' => 'vertical',
                                    'options' => [
                                        'vertical' => 'Vertical',
                                        'horizontal' => 'Horizontal'
                                    ]
                                ],
                                'article.display.image.enabled' => [
                                    'type' => 'select.select',
                                    'label' => 'Image',
                                    'description' => 'Select if and what image of the article should be shown.',
                                    'default' => 'intro',
                                    'options' => [
                                        'intro' => 'Intro',
                                        'full' => 'Full',
                                        '' => 'None'
                                    ]
                                ],
                                'width' => [
                                    'type' => 'input.text',
                                    'label' => 'Image Width',
                                    'description' => 'Set the image width in pixels (do NOT type in \'px\', enter just the digits). Default is \'160\'.',
                                    'default' => 160,
                                    'pattern' => '\\d{1,4}'
                                ],
                                'fullwidth' => [
                                    'type' => 'enable.enable',
                                    'label' => 'Image Fullwidth',
                                    'description' => 'Set the image width to be 100% of the container width (should be used with \'Vertical\' layout ONLY).',
                                    'default' => 0
                                ],
                                'height' => [
                                    'type' => 'input.text',
                                    'label' => 'Image Height',
                                    'description' => 'Set the image height in pixels (do NOT type in \'px\', enter just the digits). Default is \'120\'.',
                                    'default' => 120,
                                    'pattern' => '\\d{1,4}'
                                ],
                                'lightbox' => [
                                    'type' => 'select.select',
                                    'label' => 'Lightbox',
                                    'description' => 'Enable or disable the image lightbox/popup.',
                                    'placeholder' => 'Select...',
                                    'default' => 'enable',
                                    'options' => [
                                        'enable' => 'Enabled',
                                        'disable' => 'Disabled',
                                        'disablelink' => 'Disabled (Article Link)'
                                    ]
                                ],
                                'article.display.title.enabled' => [
                                    'type' => 'select.select',
                                    'label' => 'Title',
                                    'description' => 'Select if the article title should be shown.',
                                    'default' => 'show',
                                    'options' => [
                                        'show' => 'Show',
                                        '' => 'Hide'
                                    ]
                                ],
                                'article.display.title.limit' => [
                                    'type' => 'input.text',
                                    'label' => 'Title Limit',
                                    'description' => 'Enter the maximum number of characters the article title should be limited to.',
                                    'pattern' => '\\d+(\\.\\d+){0,1}'
                                ],
                                'article.display.date.enabled' => [
                                    'type' => 'select.select',
                                    'label' => 'Date',
                                    'description' => 'Select if the article date should be shown.',
                                    'default' => 'published',
                                    'options' => [
                                        'created' => 'Show Created Date',
                                        'published' => 'Show Published Date',
                                        'modified' => 'Show Modified Date',
                                        '' => 'Hide'
                                    ]
                                ],
                                'article.display.date.format' => [
                                    'type' => 'select.date',
                                    'label' => 'Date Format',
                                    'description' => 'Select preferred date format.',
                                    'default' => 'l, F d, Y',
                                    'selectize' => [
                                        'allowEmptyOption' => true
                                    ],
                                    'options' => [
                                        'l, F d, Y' => 'Date1',
                                        'l, d F' => 'Date2',
                                        'D, d F' => 'Date3',
                                        'F d' => 'Date4',
                                        'd F' => 'Date5',
                                        'd M' => 'Date6',
                                        'D, M d, Y' => 'Date7',
                                        'D, M d, y' => 'Date8',
                                        'l' => 'Date9',
                                        'l j F Y' => 'Date10',
                                        'j F Y' => 'Date11'
                                    ]
                                ],
                                'article.display.author.enabled' => [
                                    'type' => 'select.select',
                                    'label' => 'Author',
                                    'description' => 'Select if the article author should be shown.',
                                    'default' => 'show',
                                    'options' => [
                                        'show' => 'Show',
                                        '' => 'Hide'
                                    ]
                                ],
                                'article.display.category.enabled' => [
                                    'type' => 'select.select',
                                    'label' => 'Category',
                                    'description' => 'Select if and how the article category should be shown.',
                                    'default' => 'link',
                                    'options' => [
                                        'show' => 'Show',
                                        'link' => 'Show with Link',
                                        '' => 'Hide'
                                    ]
                                ],
                                'article.display.hits.enabled' => [
                                    'type' => 'select.select',
                                    'label' => 'Hits',
                                    'description' => 'Select if the article hits should be shown.',
                                    'default' => 'show',
                                    'options' => [
                                        'show' => 'Show',
                                        '' => 'Hide'
                                    ]
                                ],
                                'article.display.text.type' => [
                                    'type' => 'select.select',
                                    'label' => 'Article Text',
                                    'description' => 'Select if and how the article text should be shown.',
                                    'default' => 'intro',
                                    'options' => [
                                        'intro' => 'Introduction',
                                        'full' => 'Full Article',
                                        '' => 'Hide'
                                    ]
                                ],
                                'article.display.text.limit' => [
                                    'type' => 'input.text',
                                    'label' => 'Text Limit',
                                    'description' => 'Type in the number of characters the article text should be limited to.',
                                    'default' => '',
                                    'pattern' => '\\d+'
                                ],
                                'article.display.text.formatting' => [
                                    'type' => 'select.select',
                                    'label' => 'Text Formatting',
                                    'description' => 'Select the formatting you want to use to display the article text.',
                                    'default' => 'text',
                                    'options' => [
                                        'text' => 'Plain Text',
                                        'html' => 'HTML'
                                    ]
                                ],
                                'article.display.read_more.enabled' => [
                                    'type' => 'select.select',
                                    'label' => 'Read More',
                                    'description' => 'Select if the article \'Read More\' button should be shown.',
                                    'default' => 'show',
                                    'options' => [
                                        'show' => 'Show',
                                        '' => 'Hide'
                                    ]
                                ],
                                'article.display.read_more.label' => [
                                    'type' => 'input.text',
                                    'label' => 'Read More Label',
                                    'description' => 'Type in the label for the \'Read More\' button.',
                                    'placeholder' => 'Read More...'
                                ]
                            ]
                        ],
                        '_tab_links' => [
                            'label' => 'Link Layout',
                            'fields' => [
                                'linksenabled' => [
                                    'type' => 'enable.enable',
                                    'label' => 'Enable Links',
                                    'description' => 'Enable this option if you want to show the Links block.',
                                    'default' => 0
                                ],
                                'linkcolumns' => [
                                    'type' => 'select.select',
                                    'label' => 'Number of Columns',
                                    'description' => 'Select the number of columns in the Links block.',
                                    'placeholder' => 'Select...',
                                    'default' => 1,
                                    'options' => [
                                        1 => 1,
                                        2 => 2,
                                        3 => 3,
                                        4 => 4,
                                        5 => 5,
                                        6 => 6,
                                        10 => 10
                                    ]
                                ],
                                'linkrows' => [
                                    'type' => 'select.select',
                                    'label' => 'Number of Rows',
                                    'description' => 'Select the number of rows in the Link block.',
                                    'placeholder' => 'Select...',
                                    'default' => 3,
                                    'options' => [
                                        1 => 1,
                                        2 => 2,
                                        3 => 3,
                                        4 => 4,
                                        5 => 5,
                                        6 => 6,
                                        7 => 7,
                                        8 => 8,
                                        9 => 9,
                                        10 => 10
                                    ]
                                ],
                                'linkposition' => [
                                    'type' => 'select.select',
                                    'label' => 'Position',
                                    'description' => 'Select the Links block position.',
                                    'placeholder' => 'Select...',
                                    'default' => 'right',
                                    'options' => [
                                        'right' => 'Right',
                                        'bottom' => 'Bottom',
                                        'left' => 'Left'
                                    ]
                                ],
                                'linklayout' => [
                                    'type' => 'select.select',
                                    'label' => 'Layout',
                                    'description' => 'Select the link layout.',
                                    'default' => 'horizontal',
                                    'options' => [
                                        'vertical' => 'Vertical',
                                        'horizontal' => 'Horizontal'
                                    ]
                                ],
                                'link.display.image.enabled' => [
                                    'type' => 'select.select',
                                    'label' => 'Image',
                                    'description' => 'Select if and what image of the article should be shown.',
                                    'default' => 'intro',
                                    'options' => [
                                        'intro' => 'Intro',
                                        'full' => 'Full',
                                        '' => 'None'
                                    ]
                                ],
                                'linkwidth' => [
                                    'type' => 'input.text',
                                    'label' => 'Image Width',
                                    'description' => 'Set the image width in pixels (do NOT type in \'px\', enter just the digits). Default is \'120\'.',
                                    'default' => 120,
                                    'pattern' => '\\d{1,4}'
                                ],
                                'linkfullwidth' => [
                                    'type' => 'enable.enable',
                                    'label' => 'Image Fullwidth',
                                    'description' => 'Set the image width to be 100% of the container width (should be used with \'Vertical\' layout ONLY).',
                                    'default' => 0
                                ],
                                'linkheight' => [
                                    'type' => 'input.text',
                                    'label' => 'Image Height',
                                    'description' => 'Set the image height in pixels (do NOT type in \'px\', enter just the digits). Default is \'75\'.',
                                    'default' => 75,
                                    'pattern' => '\\d{1,4}'
                                ],
                                'linklightbox' => [
                                    'type' => 'select.select',
                                    'label' => 'Lightbox',
                                    'description' => 'Enable or disable the image lightbox/popup.',
                                    'placeholder' => 'Select...',
                                    'default' => 'enable',
                                    'options' => [
                                        'enable' => 'Enabled',
                                        'disable' => 'Disabled',
                                        'disablelink' => 'Disabled (Article Link)'
                                    ]
                                ],
                                'link.display.title.enabled' => [
                                    'type' => 'select.select',
                                    'label' => 'Title',
                                    'description' => 'Select if the article title should be shown.',
                                    'default' => 'show',
                                    'options' => [
                                        'show' => 'Show',
                                        '' => 'Hide'
                                    ]
                                ],
                                'link.display.title.limit' => [
                                    'type' => 'input.text',
                                    'label' => 'Title Limit',
                                    'description' => 'Enter the maximum number of characters the article title should be limited to.',
                                    'pattern' => '\\d+(\\.\\d+){0,1}'
                                ],
                                'link.display.date.enabled' => [
                                    'type' => 'select.select',
                                    'label' => 'Date',
                                    'description' => 'Select if the article date should be shown.',
                                    'default' => 'published',
                                    'options' => [
                                        'created' => 'Show Created Date',
                                        'published' => 'Show Published Date',
                                        'modified' => 'Show Modified Date',
                                        '' => 'Hide'
                                    ]
                                ],
                                'link.display.date.format' => [
                                    'type' => 'select.date',
                                    'label' => 'Date Format',
                                    'description' => 'Select preferred date format.',
                                    'default' => 'l, F d, Y',
                                    'selectize' => [
                                        'allowEmptyOption' => true
                                    ],
                                    'options' => [
                                        'l, F d, Y' => 'Date1',
                                        'l, d F' => 'Date2',
                                        'D, d F' => 'Date3',
                                        'F d' => 'Date4',
                                        'd F' => 'Date5',
                                        'd M' => 'Date6',
                                        'D, M d, Y' => 'Date7',
                                        'D, M d, y' => 'Date8',
                                        'l' => 'Date9',
                                        'l j F Y' => 'Date10',
                                        'j F Y' => 'Date11'
                                    ]
                                ],
                                'link.display.author.enabled' => [
                                    'type' => 'select.select',
                                    'label' => 'Author',
                                    'description' => 'Select if the article author should be shown.',
                                    'default' => 'show',
                                    'options' => [
                                        'show' => 'Show',
                                        '' => 'Hide'
                                    ]
                                ],
                                'link.display.category.enabled' => [
                                    'type' => 'select.select',
                                    'label' => 'Category',
                                    'description' => 'Select if and how the article category should be shown.',
                                    'default' => 'link',
                                    'options' => [
                                        'show' => 'Show',
                                        'link' => 'Show with Link',
                                        '' => 'Hide'
                                    ]
                                ],
                                'link.display.hits.enabled' => [
                                    'type' => 'select.select',
                                    'label' => 'Hits',
                                    'description' => 'Select if the article hits should be shown.',
                                    'default' => 'show',
                                    'options' => [
                                        'show' => 'Show',
                                        '' => 'Hide'
                                    ]
                                ],
                                'link.display.text.type' => [
                                    'type' => 'select.select',
                                    'label' => 'Article Text',
                                    'description' => 'Select if and how the article text should be shown.',
                                    'default' => 'intro',
                                    'options' => [
                                        'intro' => 'Introduction',
                                        'full' => 'Full Article',
                                        '' => 'Hide'
                                    ]
                                ],
                                'link.display.text.limit' => [
                                    'type' => 'input.text',
                                    'label' => 'Text Limit',
                                    'description' => 'Type in the number of characters the article text should be limited to.',
                                    'default' => '',
                                    'pattern' => '\\d+'
                                ],
                                'link.display.text.formatting' => [
                                    'type' => 'select.select',
                                    'label' => 'Text Formatting',
                                    'description' => 'Select the formatting you want to use to display the article text.',
                                    'default' => 'text',
                                    'options' => [
                                        'text' => 'Plain Text',
                                        'html' => 'HTML'
                                    ]
                                ],
                                'link.display.read_more.enabled' => [
                                    'type' => 'select.select',
                                    'label' => 'Read More',
                                    'description' => 'Select if the article \'Read More\' button should be shown.',
                                    'default' => 'show',
                                    'options' => [
                                        'show' => 'Show',
                                        '' => 'Hide'
                                    ]
                                ],
                                'link.display.read_more.label' => [
                                    'type' => 'input.text',
                                    'label' => 'Read More Label',
                                    'description' => 'Type in the label for the \'Read More\' button.',
                                    'placeholder' => 'Read More...'
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ]
];
