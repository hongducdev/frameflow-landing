<?php
$templates = frameflow_get_templates_option('tab', []);
pxl_add_custom_widget(
    array(
        'name' => 'pxl_tabs',
        'title' => esc_html__('Case Tabs', 'frameflow'),
        'icon' => 'eicon-tabs',
        'categories' => array('pxltheme-core'),
        'scripts' => array(
            'frameflow-tabs'
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_layout',
                    'label' => esc_html__('Layout', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
                    'controls' => array(
                        array(
                            'name' => 'layout',
                            'label' => esc_html__('Templates', 'frameflow'),
                            'type' => 'layoutcontrol',
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__('Layout 1', 'frameflow'),
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_tabs/layout1.webp'
                                ],
                                '2' => [
                                    'label' => esc_html__('Layout 2', 'frameflow'),
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_tabs/layout2.webp'
                                ],
                                '3' => [
                                    'label' => esc_html__('Layout 3', 'frameflow'),
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_tabs/layout3.webp'
                                ],
                                '4' => [
                                    'label' => esc_html__('Layout 4', 'frameflow'),
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_tabs/layout4.webp'
                                ],
                                '5' => [
                                    'label' => esc_html__('Layout 5', 'frameflow'),
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_tabs/layout5.webp'
                                ],
                                '6' => [
                                    'label' => esc_html__('Layout 6', 'frameflow'),
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_tabs/layout6.webp'
                                ],
                                '7' => [
                                    'label' => esc_html__('Layout 7', 'frameflow'),
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_tabs/layout7.webp'
                                ],
                                '8' => [
                                    'label' => esc_html__('Layout 8', 'frameflow'),
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_tabs/layout8.webp'
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_content',
                    'label' => esc_html__('Tabs', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        frameflow_widget_number_control(
                            'tab_active',
                            esc_html__('Active Tab', 'frameflow'),
                            [
                                'default' => 1,
                                'separator' => 'after',
                                'condition' => [
                                    'layout' => ['1', '2', '3', '4', '5', '6', '7', '8'],
                                ],
                            ]
                        ),
                        array(
                            'name' => 'tabs',
                            'label' => esc_html__('Content', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'condition' => [
                                'layout' => '1',
                            ],
                            'controls' => array(
                                frameflow_widget_text_control(
                                    'title',
                                    esc_html__('Title', 'frameflow'),
                                    ['label_block' => true]
                                ),
                                frameflow_widget_text_control(
                                    'label',
                                    esc_html__('Label', 'frameflow'),
                                    ['label_block' => true]
                                ),
                                frameflow_widget_wysiwyg_control(
                                    'desc',
                                    esc_html__('Content', 'frameflow')
                                ),
                            ),
                            'title_field' => '{{{ title }}}',
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_layout_2',
                    'label' => esc_html__('Layout 2', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'condition' => [
                        'layout' => '2',
                    ],
                    'controls' => array(
                        frameflow_widget_select_control(
                            'mode_display_tabs_2',
                            esc_html__('Mode Display Tabs 2', 'frameflow'),
                            [
                                'navigation' => esc_html__('Navigation', 'frameflow'),
                                'content' => esc_html__('Content', 'frameflow'),
                            ],
                            [
                                'default' => 'navigation',
                                'condition' => [
                                    'layout' => '2',
                                ],
                            ]
                        ),
                        array(
                            'name' => 'tabs_2_navigation',
                            'label' => esc_html__('Navigation', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'condition' => [
                                'layout' => '2',
                            ],
                            'controls' => array(
                                frameflow_widget_text_control(
                                    'title',
                                    esc_html__('Title', 'frameflow'),
                                    ['label_block' => true]
                                ),
                                frameflow_widget_select_control(
                                    'content_template_id',
                                    esc_html__('Content Template ID', 'frameflow'),
                                    $templates,
                                    [
                                        'default' => 'df',
                                        'description' => 'Add new tab template: "<a href="' . esc_url(admin_url('edit.php?post_type=pxl-template')) . '" target="_blank">Click Here</a>" and Edit template "<a href="' . esc_url(admin_url('edit.php?s&post_status=all&post_type=pxl-template&action=-1&m=0&pxl_filter_template_type=tab&filter_action=Filter&paged=1&action2=-1')) . '" target="_blank">Here.</a>"',
                                    ]
                                )
                            ),
                            'title_field' => '{{{ title }}}',
                            'condition' => [
                                'layout' => '2',
                            ],
                        ),
                        array(
                            'name' => 'tabs_2_content',
                            'label' => esc_html__('Content', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                frameflow_widget_select_control(
                                    'content_template_2',
                                    esc_html__('Select Template', 'frameflow'),
                                    $templates,
                                    [
                                        'default' => 'df',
                                        'description' => 'Add new tab template: "<a href="' . esc_url(admin_url('edit.php?post_type=pxl-template')) . '" target="_blank">Click Here</a>" and Edit template "<a href="' . esc_url(admin_url('edit.php?s&post_status=all&post_type=pxl-template&action=-1&m=0&pxl_filter_template_type=tab&filter_action=Filter&paged=1&action2=-1')) . '" target="_blank">Here.</a>"',
                                    ]
                                ),
                            ),
                            'condition' => [
                                'layout' => '2',
                            ],
                        ),
                    )
                ),
                array(
                    'name' => 'tab_layout_3',
                    'label' => esc_html__('Layout 3', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'condition' => [
                        'layout' => '3',
                    ],
                    'controls' => array(
                        frameflow_widget_select_control(
                            'tabs_3_type',
                            esc_html__('Type', 'frameflow'),
                            [
                                'default' => esc_html__('Default', 'frameflow'),
                                'split' => esc_html__('Split', 'frameflow'),
                            ],
                            [
                                'default' => 'default',
                                'condition' => [
                                    'layout' => '3',
                                ],
                            ]
                        ),
                        frameflow_widget_select_control(
                            'mode_display_tabs_3',
                            esc_html__('Mode Display Tabs 3', 'frameflow'),
                            [
                                'navigation' => esc_html__('Navigation', 'frameflow'),
                                'content' => esc_html__('Content', 'frameflow'),
                            ],
                            [
                                'default' => 'navigation',
                                'condition' => [
                                    'layout' => '3',
                                    'tabs_3_type' => 'split',
                                ],
                            ]
                        ),
                        frameflow_widget_text_control(
                            'tabs_3_title_1',
                            esc_html__('Title 1', 'frameflow'),
                            [
                                'label_block' => true,
                                'condition' => [
                                    'layout' => '3',
                                ],
                            ]
                        ),
                        frameflow_widget_text_control(
                            'tabs_3_subtitle_1',
                            esc_html__('Subtitle 1', 'frameflow'),
                            [
                                'label_block' => true,
                                'condition' => [
                                    'layout' => '3',
                                ],
                            ]
                        ),
                        frameflow_widget_icons_control(
                            'tabs_3_icon_subtitle_1',
                            esc_html__('Icon Subtitle 1', 'frameflow'),
                            [
                                'label_block' => true,
                                'condition' => [
                                    'layout' => '3',
                                ],
                            ]
                        ),
                        frameflow_widget_text_control(
                            'tabs_3_title_2',
                            esc_html__('Title 2', 'frameflow'),
                            [
                                'label_block' => true,
                                'condition' => [
                                    'layout' => '3',
                                ],
                            ]
                        ),
                        frameflow_widget_text_control(
                            'tabs_3_subtitle_2',
                            esc_html__('Subtitle 2', 'frameflow'),
                            [
                                'label_block' => true,
                                'condition' => [
                                    'layout' => '3',
                                ],
                            ]
                        ),
                        frameflow_widget_icons_control(
                            'tabs_3_icon_subtitle_2',
                            esc_html__('Icon Subtitle 2', 'frameflow'),
                            [
                                'label_block' => true,
                                'condition' => [
                                    'layout' => '3',
                                ],
                            ]
                        ),
                        frameflow_widget_select_control(
                            'tabs_3_type_content',
                            esc_html__('Type Content', 'frameflow'),
                            [
                                'content' => esc_html__('Content', 'frameflow'),
                                'template' => esc_html__('Template', 'frameflow'),
                            ],
                            [
                                'default' => 'content',
                                'condition' => [
                                    'layout' => '3',
                                ],
                            ]
                        ),
                        frameflow_widget_wysiwyg_control(
                            'tabs_3_content_1',
                            esc_html__('Content', 'frameflow'),
                            [
                                'condition' => [
                                    'tabs_3_type_content' => 'content',
                                    'layout' => '3',
                                ],
                            ]
                        ),
                        frameflow_widget_wysiwyg_control(
                            'tabs_3_content_2',
                            esc_html__('Content 2', 'frameflow'),
                            [
                                'condition' => [
                                    'tabs_3_type_content' => 'content',
                                    'layout' => '3',
                                ],
                            ]
                        ),
                        frameflow_widget_select_control(
                            'tabs_3_template_1',
                            esc_html__('Template', 'frameflow'),
                            $templates,
                            [
                                'default' => 'df',
                                'condition' => [
                                    'tabs_3_type_content' => 'template',
                                ],
                            ]
                        ),
                        frameflow_widget_select_control(
                            'tabs_3_template_2',
                            esc_html__('Template 2', 'frameflow'),
                            $templates,
                            [
                                'default' => 'df',
                                'condition' => [
                                    'tabs_3_type_content' => 'template',
                                ],
                            ]
                        ),
                    )
                ),
                array(
                    'name' => 'tab_layout_4',
                    'label' => esc_html__('Layout 4', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'condition' => [
                        'layout' => '4',
                    ],
                    'controls' => array(
                        array(
                            'name' => 'tabs_4',
                            'label' => esc_html__('Content', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                frameflow_widget_text_control(
                                    'title_4',
                                    esc_html__('Title', 'frameflow'),
                                    ['label_block' => true]
                                ),
                                frameflow_widget_icons_control(
                                    'icon_4',
                                    esc_html__('Icon', 'frameflow'),
                                    ['label_block' => true]
                                ),
                                frameflow_widget_select_control(
                                    'content_template_id_4',
                                    esc_html__('Content Template ID', 'frameflow'),
                                    $templates,
                                    [
                                        'default' => 'df',
                                        'description' => 'Add new tab template: "<a href="' . esc_url(admin_url('edit.php?post_type=pxl-template')) . '" target="_blank">Click Here</a>" and Edit template "<a href="' . esc_url(admin_url('edit.php?s&post_status=all&post_type=pxl-template&action=-1&m=0&pxl_filter_template_type=tab&filter_action=Filter&paged=1&action2=-1')) . '" target="_blank">Here.</a>"',
                                    ]
                                )
                            ),
                            'title_field' => '{{{ title_4 }}}',
                        ),
                    )
                ),
                array(
                    'name' => 'tab_layout_5',
                    'label' => esc_html__('Layout 5', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'condition' => [
                        'layout' => ['5', '8'],
                    ],
                    'controls' => array(
                        array(
                            'name' => 'tabs_5',
                            'label' => esc_html__('Content', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                frameflow_widget_text_control(
                                    'title_5',
                                    esc_html__('Title', 'frameflow'),
                                    ['label_block' => true]
                                ),
                                frameflow_widget_select_control(
                                    'content_template_id_5',
                                    esc_html__('Content Template ID', 'frameflow'),
                                    $templates,
                                    [
                                        'default' => 'df',
                                        'description' => 'Add new tab template: "<a href="' . esc_url(admin_url('edit.php?post_type=pxl-template')) . '" target="_blank">Click Here</a>" and Edit template "<a href="' . esc_url(admin_url('edit.php?s&post_status=all&post_type=pxl-template&action=-1&m=0&pxl_filter_template_type=tab&filter_action=Filter&paged=1&action2=-1')) . '" target="_blank">Here.</a>"',
                                    ]
                                )
                            ),
                            'title_field' => '{{{ title_5 }}}',
                        ),
                    )
                ),
                array(
                    'name' => 'tab_layout_6',
                    'label' => esc_html__('Layout 6', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'condition' => [
                        'layout' => '6',
                    ],
                    'controls' => array(
                        array(
                            'name' => 'tabs_6',
                            'label' => esc_html__('Venues', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                frameflow_widget_text_control(
                                    'title_6',
                                    esc_html__('Nav Title', 'frameflow'),
                                    ['label_block' => true]
                                ),
                                frameflow_widget_media_control(
                                    'image_6',
                                    esc_html__('Background Image', 'frameflow')
                                ),
                                frameflow_widget_text_control(
                                    'label_6',
                                    esc_html__('Label', 'frameflow'),
                                    ['label_block' => true]
                                ),
                                frameflow_widget_text_control(
                                    'heading_6',
                                    esc_html__('Heading', 'frameflow'),
                                    ['label_block' => true]
                                ),
                                frameflow_widget_textarea_control(
                                    'desc_6',
                                    esc_html__('Description', 'frameflow'),
                                    ['label_block' => true]
                                ),
                                frameflow_widget_text_control(
                                    'btn_text_6',
                                    esc_html__('Button Text', 'frameflow'),
                                    ['label_block' => true]
                                ),
                                frameflow_widget_url_control(
                                    'btn_link_6',
                                    esc_html__('Button Link', 'frameflow'),
                                    ['label_block' => true]
                                ),
                            ),
                            'title_field' => '{{{ title_6 }}}',
                        ),
                    )
                ),
                array(
                    'name' => 'tab_layout_7',
                    'label' => esc_html__('Layout 7', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'condition' => [
                        'layout' => '7',
                    ],
                    'controls' => array(
                        frameflow_widget_select_control(
                            'mode_display_tabs_7',
                            esc_html__('Mode Display Tabs 7', 'frameflow'),
                            [
                                'navigation' => esc_html__('Navigation', 'frameflow'),
                                'content' => esc_html__('Content', 'frameflow'),
                            ],
                            [
                                'default' => 'navigation',
                                'condition' => [
                                    'layout' => '7',
                                ],
                            ]
                        ),
                        array(
                            'name' => 'tabs_7_navigation',
                            'label' => esc_html__('Navigation', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'condition' => [
                                'layout' => '7',
                                'mode_display_tabs_7' => 'navigation',
                            ],
                            'controls' => array(
                                frameflow_widget_text_control(
                                    'title',
                                    esc_html__('Title', 'frameflow'),
                                    ['label_block' => true]
                                ),
                                frameflow_widget_text_control(
                                    'tab_key',
                                    esc_html__('Tab Key', 'frameflow'),
                                    [
                                        'label_block' => true,
                                        'description' => esc_html__('Must match the Tab Key on the Content widget item.', 'frameflow'),
                                    ]
                                ),
                            ),
                            'title_field' => '{{{ title }}}',
                        ),
                        array(
                            'name' => 'tabs_7_content',
                            'label' => esc_html__('Content', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'condition' => [
                                'layout' => '7',
                                'mode_display_tabs_7' => 'content',
                            ],
                            'controls' => array(
                                frameflow_widget_text_control(
                                    'tab_key',
                                    esc_html__('Tab Key', 'frameflow'),
                                    [
                                        'label_block' => true,
                                        'description' => esc_html__('Must match the Tab Key on the Navigation widget item.', 'frameflow'),
                                    ]
                                ),
                                frameflow_widget_media_control(
                                    'image',
                                    esc_html__('Image', 'frameflow')
                                ),
                            ),
                            'title_field' => '{{{ tab_key }}}',
                        ),
                    )
                ),
                array(
                    'name' => 'section_style_general',
                    'label' => esc_html__('General', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_select_control(
                            'tab_effect',
                            esc_html__('Effect', 'frameflow'),
                            [
                                'tab-effect-slide' => 'Slide',
                                'tab-effect-fade' => 'Fade',
                            ],
                            [
                                'default' => 'tab-effect-slide',
                                'condition' => [
                                    'layout!' => ['6', '7'],
                                ],
                            ]
                        ),
                        array(
                            'name' => 'tabs_6_min_height',
                            'label' => esc_html__('Min Height', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['px', 'vh', 'custom'],
                            'range' => [
                                'px' => [
                                    'min' => 400,
                                    'max' => 1200,
                                ],
                                'vh' => [
                                    'min' => 40,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 780,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-tabs6' => 'min-height: {{SIZE}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                            'condition' => [
                                'layout' => '6',
                            ],
                        ),
                        array(
                            'name' => 'tabs_7_min_height',
                            'label' => esc_html__('Content Min Height', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['px', 'vh', 'custom'],
                            'range' => [
                                'px' => [
                                    'min' => 200,
                                    'max' => 1200,
                                ],
                                'vh' => [
                                    'min' => 20,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 500,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-tabs7--content' => 'min-height: {{SIZE}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                            'condition' => [
                                'layout' => '7',
                                'mode_display_tabs_7' => 'content',
                            ],
                        ),
                    )
                ),
                array(
                    'name' => 'section_style_navigation',
                    'label' => esc_html__('Navigation', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'layout!' => '7',
                    ],
                    'controls' => array(
                        array(
                            'name' => 'navigation_align',
                            'label' => esc_html__('Alignment', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::CHOOSE,
                            'control_type' => 'responsive',
                            'options' => [
                                'start' => [
                                    'title' => esc_html__('Left', 'frameflow'),
                                    'icon' => 'eicon-text-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__('Center', 'frameflow'),
                                    'icon' => 'eicon-text-align-center',
                                ],
                                'end' => [
                                    'title' => esc_html__('Right', 'frameflow'),
                                    'icon' => 'eicon-text-align-right',
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-tabs .pxl-item--navigation-wrap, {{WRAPPER}} .pxl-tabs4 .pxl-item--navigation' => 'justify-content: {{VALUE}};',
                            ],
                        ),
                        frameflow_widget_slider_control(
                            'navigation_gap',
                            esc_html__('Navigation Gap', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-tabs .pxl-item--navigation' => 'gap: {{SIZE}}{{UNIT}};',
                            ],
                            [
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 30,
                                        'step' => 1,
                                    ],
                                ],
                            ]
                        ),
                        frameflow_widget_dimensions_control(
                            'navigation_margin',
                            esc_html__('Margin', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-tabs .pxl-item--navigation-wrap, {{WRAPPER}} .pxl-tabs .pxl-item--navigation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                        frameflow_widget_dimensions_control(
                            'navigation_item_padding',
                            esc_html__('Item Padding', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-tabs .pxl-item--navigation-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                            ],
                            ['size_units' => ['px']]
                        ),
                        frameflow_widget_control_tabs(
                            'navigation_item_style_tabs',
                            [
                                [
                                    'name' => 'tab_navigation_normal',
                                    'label' => esc_html__('Normal', 'frameflow'),
                                    'controls' => [
                                        frameflow_widget_color_control(
                                            'navigation_item_background_color',
                                            esc_html__('Item Background Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-tabs .pxl-item--navigation-item' => 'background-color: {{VALUE}};',
                                            ]
                                        ),
                                        frameflow_widget_color_control(
                                            'navigation_item_color',
                                            esc_html__('Item Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-tabs .pxl-item--navigation-item-text' => 'color: {{VALUE}};',
                                            ]
                                        ),
                                        frameflow_widget_color_control(
                                            'navigation_item_border_color',
                                            esc_html__('Item Border Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-tabs .pxl-item--navigation-item' => 'border-color: {{VALUE}};',
                                            ]
                                        ),
                                        frameflow_widget_color_control(
                                            'navigation_item_border_color_4',
                                            esc_html__('Item Border Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-tabs4 .pxl-item--navigation-item' => 'border-color: {{VALUE}};',
                                            ],
                                            ['condition' => [
                                                'layout' => '4',
                                            ]]
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'tab_navigation_hover',
                                    'label' => esc_html__('Hover', 'frameflow'),
                                    'controls' => [
                                        frameflow_widget_color_control(
                                            'navigation_item_background_color_hover',
                                            esc_html__('Item Background Color Hover', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-tabs .pxl-item--navigation-item:hover' => 'background-color: {{VALUE}};',
                                            ]
                                        ),
                                        frameflow_widget_color_control(
                                            'navigation_item_color_hover',
                                            esc_html__('Item Color Hover', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-tabs .pxl-item--navigation-item:hover .pxl-item--navigation-item-text' => 'color: {{VALUE}};',
                                            ]
                                        ),
                                        frameflow_widget_color_control(
                                            'navigation_item_icon_color_hover',
                                            esc_html__('Icon Color Hover', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-tabs .pxl-item--navigation-item:hover .pxl-item--navigation-item-icon' => 'color: {{VALUE}};',
                                            ]
                                        ),
                                        frameflow_widget_color_control(
                                            'navigation_item_border_color_hover',
                                            esc_html__('Item Border Color Hover', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-tabs .pxl-item--navigation-item:hover' => 'border-color: {{VALUE}};',
                                            ]
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'tab_navigation_active',
                                    'label' => esc_html__('Active', 'frameflow'),
                                    'controls' => [
                                        frameflow_widget_color_control(
                                            'navigation_item_background_color_active',
                                            esc_html__('Item Background Color Active', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-tabs .pxl-item--navigation-item.active' => 'background-color: {{VALUE}};',
                                                '{{WRAPPER}} .pxl-tabs5 .pxl-item--navigation-item.active' => 'border-bottom-color: {{VALUE}};',
                                            ]
                                        ),
                                        frameflow_widget_color_control(
                                            'navigation_item_color_active',
                                            esc_html__('Item Color Active', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-tabs .pxl-item--navigation-item.active .pxl-item--navigation-item-text' => 'color: {{VALUE}};',
                                            ]
                                        ),
                                        frameflow_widget_color_control(
                                            'navigation_item_icon_color_active',
                                            esc_html__('Icon Color Active', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-tabs .pxl-item--navigation-item.active .pxl-item--navigation-item-icon' => 'color: {{VALUE}};',
                                            ]
                                        ),
                                        frameflow_widget_color_control(
                                            'navigation_item_border_color_active',
                                            esc_html__('Item Border Color Active', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-tabs .pxl-item--navigation-item.active' => 'border-color: {{VALUE}};',
                                            ]
                                        ),
                                        frameflow_widget_color_control(
                                            'navigation_item_border_color_active_4',
                                            esc_html__('Item Border Color Active', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-tabs4 .pxl-item--navigation-item.active, {{WRAPPER}} .pxl-tabs4 .pxl-item--navigation-item:hover' => 'border-color: {{VALUE}};',
                                            ],
                                            ['condition' => [
                                                'layout' => '4',
                                            ]]
                                        ),
                                    ],
                                ],
                            ]
                        ),
                        frameflow_widget_typography_control(
                            'navigation_item_text_typography',
                            esc_html__('Item Text Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-tabs .pxl-item--navigation-item-text'
                        ),
                        frameflow_widget_color_control(
                            'navigation_bg_color_switch',
                            esc_html__('Background Color Switch', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-tabs3 .pxl-item--navigation-switch' => 'background-color: {{VALUE}};',
                            ],
                            [
                                'condition' => [
                                    'layout' => '3',
                                ],
                            ]
                        ),
                        frameflow_widget_color_control(
                            'navigation_border_color',
                            esc_html__('Border Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-tabs .pxl-item--navigation' => 'border-color: {{VALUE}};',
                            ],
                            ['condition' => [
                                'layout' => ['3'],
                            ]]
                        ),
                        frameflow_widget_color_control(
                            'navigation_subtitle_color',
                            esc_html__('Subtitle Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-tabs3 .pxl-item--navigation-item-subtitle span' => 'color: {{VALUE}};',
                            ],
                            [
                                'condition' => [
                                    'layout' => '3',
                                ],
                            ]
                        ),
                        frameflow_widget_color_control(
                            'navigation_subtitle_bg_color',
                            esc_html__('Subtitle Background Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-tabs3 .pxl-item--navigation-item-subtitle' => 'background-color: {{VALUE}};',
                            ],
                            [
                                'condition' => [
                                    'layout' => '3',
                                ],
                            ]
                        ),
                        // layout 4
                        frameflow_widget_dimensions_control(
                            'navigation_item_border_radius_4',
                            esc_html__('Item Border Radius', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-tabs4 .pxl-item--navigation-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            [
                                'condition' => [
                                    'layout' => '4',
                                ],
                            ]
                        ),
                        // layout 6
                        frameflow_widget_slider_control(
                            'tabs_6_nav_offset_x',
                            esc_html__('Offset Left', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-tabs6 .pxl-item--navigation' => 'left: {{SIZE}}{{UNIT}};',
                            ],
                            [
                                'size_units' => ['px'],
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 200,
                                    ],
                                ],
                                'condition' => [
                                    'layout' => '6',
                                ],
                            ]
                        ),
                        frameflow_widget_slider_control(
                            'tabs_6_nav_offset_y',
                            esc_html__('Offset Bottom', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-tabs6 .pxl-item--navigation' => 'bottom: {{SIZE}}{{UNIT}};',
                            ],
                            [
                                'size_units' => ['px'],
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 200,
                                    ],
                                ],
                                'condition' => [
                                    'layout' => '6',
                                ],
                            ]
                        ),
                        frameflow_widget_color_control(
                            'tabs_6_nav_arrow_color',
                            esc_html__('Arrow Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-tabs6 .pxl-item--navigation-item-arrow' => 'color: {{VALUE}};',
                            ],
                            [
                                'condition' => [
                                    'layout' => '6',
                                ],
                            ]
                        ),
                    )
                ),
                array(
                    'name' => 'section_style_content',
                    'label' => esc_html__('Content', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'layout' => ['1', '5'],
                    ],
                    'controls' => array(
                        array(
                            'name' => 'spacer_top_content',
                            'label' => esc_html__('Spacer Top Content', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-tabs1 .pxl-item--content' => 'margin-top: {{SIZE}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                            'condition' => [
                                'layout' => '1',
                            ],
                        ),
                        frameflow_widget_color_control(
                            'content_background_color',
                            esc_html__('Background Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-tabs1 .pxl-item--content' => 'background-color: {{VALUE}};',
                            ],
                            [
                                'condition' => [
                                    'layout' => '1',
                                ],
                            ]
                        ),
                        array(
                            'name' => 'content_padding',
                            'label' => esc_html__('Padding', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => ['px'],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-tabs1 .pxl-item--content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                            ],
                            'control_type' => 'responsive',
                            'condition' => [
                                'layout' => '1',
                            ],
                        ),
                        frameflow_widget_color_control(
                            'content_title_color',
                            esc_html__('Title Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-tabs1 .pxl-item--content-title' => 'color: {{VALUE}};',
                            ],
                            [
                                'condition' => [
                                    'layout' => '1',
                                ],
                            ]
                        ),
                        frameflow_widget_color_control(
                            'content_title_bg_color',
                            esc_html__('Title Background Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-tabs1 .pxl-item--content-title' => 'background-color: {{VALUE}};',
                            ],
                            [
                                'condition' => [
                                    'layout' => '1',
                                ],
                            ]
                        ),
                        frameflow_widget_typography_control(
                            'content_title_typography',
                            esc_html__('Title Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-tabs1 .pxl-item--content-title',
                            [
                                'condition' => [
                                    'layout' => '1',
                                ],
                            ]
                        ),
                        frameflow_widget_color_control(
                            'content_label_color',
                            esc_html__('Label Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-tabs1 .pxl-item--content-label' => 'color: {{VALUE}};',
                            ],
                            [
                                'condition' => [
                                    'layout' => '1',
                                ],
                            ]
                        ),
                        frameflow_widget_typography_control(
                            'content_label_typography',
                            esc_html__('Label Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-tabs1 .pxl-item--content-label',
                            [
                                'condition' => [
                                    'layout' => '1',
                                ],
                            ]
                        ),
                        frameflow_widget_color_control(
                            'content_description_color',
                            esc_html__('Description Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-tabs1 .pxl-item--content-description' => 'color: {{VALUE}};',
                            ],
                            [
                                'condition' => [
                                    'layout' => '1',
                                ],
                            ]
                        ),
                        frameflow_widget_typography_control(
                            'content_description_typography',
                            esc_html__('Description Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-tabs1 .pxl-item--content-description',
                            [
                                'condition' => [
                                    'layout' => '1',
                                ],
                            ]
                        ),
                        frameflow_widget_color_control(
                            'content_border_color',
                            esc_html__('Border Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-tabs5 > .pxl-item--content' => 'border-color: {{VALUE}};',
                            ],
                            [
                                'condition' => [
                                    'layout' => '5',
                                ],
                            ]
                        ),
                    )
                ),
                array(
                    'name' => 'section_style_tabs_6_overlay',
                    'label' => esc_html__('Overlay', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'layout' => '6',
                    ],
                    'controls' => array(
                        frameflow_widget_color_control(
                            'tabs_6_overlay_color',
                            esc_html__('Overlay Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-tabs6 .pxl-item--image::after' => 'background: {{VALUE}};',
                            ]
                        ),
                    )
                ),
                array(
                    'name' => 'section_style_tabs_6_card',
                    'label' => esc_html__('Card', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'layout' => '6',
                    ],
                    'controls' => array(
                        frameflow_widget_slider_control(
                            'tabs_6_card_width',
                            esc_html__('Width', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-tabs6 .pxl-item--card' => 'width: {{SIZE}}{{UNIT}}; max-width: 100%;',
                            ],
                            [
                                'size_units' => ['px', '%'],
                                'range' => [
                                    'px' => [
                                        'min' => 240,
                                        'max' => 640,
                                    ],
                                    '%' => [
                                        'min' => 20,
                                        'max' => 100,
                                    ],
                                ],
                            ]
                        ),
                        frameflow_widget_slider_control(
                            'tabs_6_card_offset_x',
                            esc_html__('Offset Right', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-tabs6 .pxl-item--card' => 'right: {{SIZE}}{{UNIT}};',
                            ],
                            [
                                'size_units' => ['px'],
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 200,
                                    ],
                                ],
                            ]
                        ),
                        frameflow_widget_dimensions_control(
                            'tabs_6_card_padding',
                            esc_html__('Padding', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-tabs6 .pxl-item--card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ]
                        ),
                        frameflow_widget_dimensions_control(
                            'tabs_6_card_border_radius',
                            esc_html__('Border Radius', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-tabs6 .pxl-item--card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ]
                        ),
                        frameflow_widget_slider_control(
                            'tabs_6_card_gap',
                            esc_html__('Inner Gap', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-tabs6 .pxl-item--card' => 'gap: {{SIZE}}{{UNIT}};',
                            ],
                            [
                                'size_units' => ['px'],
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 60,
                                    ],
                                ],
                            ]
                        ),
                        frameflow_widget_slider_control(
                            'tabs_6_card_blur',
                            esc_html__('Backdrop Blur', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-tabs6 .pxl-item--card' => '-webkit-backdrop-filter: blur({{SIZE}}{{UNIT}}); backdrop-filter: blur({{SIZE}}{{UNIT}});',
                            ],
                            [
                                'size_units' => ['px'],
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 40,
                                    ],
                                ],
                            ]
                        ),
                        frameflow_widget_color_control(
                            'tabs_6_card_bg_color',
                            esc_html__('Background Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-tabs6 .pxl-item--card' => 'background-color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'tabs_6_card_border_color',
                            esc_html__('Border Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-tabs6 .pxl-item--card' => 'border-color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_dimensions_control(
                            'tabs_6_card_border_width',
                            esc_html__('Border Width', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-tabs6 .pxl-item--card' => 'border-style: solid; border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ]
                        ),
                    )
                ),
                array(
                    'name' => 'section_style_tabs_6_label',
                    'label' => esc_html__('Label', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'layout' => '6',
                    ],
                    'controls' => array(
                        frameflow_widget_color_control(
                            'tabs_6_label_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-tabs6 .pxl-item--label' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_typography_control(
                            'tabs_6_label_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-tabs6 .pxl-item--label'
                        ),
                        frameflow_widget_dimensions_control(
                            'tabs_6_label_margin',
                            esc_html__('Margin', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-tabs6 .pxl-item--label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ]
                        ),
                    )
                ),
                array(
                    'name' => 'section_style_tabs_6_heading',
                    'label' => esc_html__('Heading', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'layout' => '6',
                    ],
                    'controls' => array(
                        frameflow_widget_color_control(
                            'tabs_6_heading_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-tabs6 .pxl-item--title' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_typography_control(
                            'tabs_6_heading_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-tabs6 .pxl-item--title'
                        ),
                        frameflow_widget_dimensions_control(
                            'tabs_6_heading_margin',
                            esc_html__('Margin', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-tabs6 .pxl-item--title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ]
                        ),
                    )
                ),
                array(
                    'name' => 'section_style_tabs_6_description',
                    'label' => esc_html__('Description', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'layout' => '6',
                    ],
                    'controls' => array(
                        frameflow_widget_color_control(
                            'tabs_6_desc_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-tabs6 .pxl-item--description' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_typography_control(
                            'tabs_6_desc_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-tabs6 .pxl-item--description'
                        ),
                        frameflow_widget_dimensions_control(
                            'tabs_6_desc_margin',
                            esc_html__('Margin', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-tabs6 .pxl-item--description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ]
                        ),
                    )
                ),
                array(
                    'name' => 'section_style_tabs_6_button',
                    'label' => esc_html__('Button', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'layout' => '6',
                    ],
                    'controls' => array(
                        frameflow_widget_typography_control(
                            'tabs_6_btn_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-tabs6 .pxl-item--button'
                        ),
                        frameflow_widget_dimensions_control(
                            'tabs_6_btn_padding',
                            esc_html__('Padding', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-tabs6 .pxl-item--button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ]
                        ),
                        frameflow_widget_dimensions_control(
                            'tabs_6_btn_margin',
                            esc_html__('Margin', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-tabs6 .pxl-item--button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ]
                        ),
                        frameflow_widget_dimensions_control(
                            'tabs_6_btn_border_radius',
                            esc_html__('Border Radius', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-tabs6 .pxl-item--button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ]
                        ),
                        frameflow_widget_dimensions_control(
                            'tabs_6_btn_border_width',
                            esc_html__('Border Width', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-tabs6 .pxl-item--button' => 'border-style: solid; border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ]
                        ),
                        frameflow_widget_slider_control(
                            'tabs_6_btn_min_height',
                            esc_html__('Min Height', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-tabs6 .pxl-item--button' => 'min-height: {{SIZE}}{{UNIT}};',
                            ],
                            [
                                'size_units' => ['px'],
                                'range' => [
                                    'px' => [
                                        'min' => 30,
                                        'max' => 80,
                                    ],
                                ],
                            ]
                        ),
                        frameflow_widget_control_tabs(
                            'tabs_6_btn_style_tabs',
                            [
                                [
                                    'name' => 'tabs_6_btn_normal',
                                    'label' => esc_html__('Normal', 'frameflow'),
                                    'controls' => [
                                        frameflow_widget_color_control(
                                            'tabs_6_btn_color',
                                            esc_html__('Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-tabs6 .pxl-item--button' => 'color: {{VALUE}};',
                                            ]
                                        ),
                                        frameflow_widget_color_control(
                                            'tabs_6_btn_bg_color',
                                            esc_html__('Background Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-tabs6 .pxl-item--button' => 'background-color: {{VALUE}};',
                                            ]
                                        ),
                                        frameflow_widget_color_control(
                                            'tabs_6_btn_border_color',
                                            esc_html__('Border Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-tabs6 .pxl-item--button' => 'border-color: {{VALUE}};',
                                            ]
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'tabs_6_btn_hover',
                                    'label' => esc_html__('Hover', 'frameflow'),
                                    'controls' => [
                                        frameflow_widget_color_control(
                                            'tabs_6_btn_color_hover',
                                            esc_html__('Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-tabs6 .pxl-item--button:hover' => 'color: {{VALUE}};',
                                            ]
                                        ),
                                        frameflow_widget_color_control(
                                            'tabs_6_btn_bg_color_hover',
                                            esc_html__('Background Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-tabs6 .pxl-item--button:hover' => 'background-color: {{VALUE}};',
                                            ]
                                        ),
                                        frameflow_widget_color_control(
                                            'tabs_6_btn_border_color_hover',
                                            esc_html__('Border Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-tabs6 .pxl-item--button:hover' => 'border-color: {{VALUE}};',
                                            ]
                                        ),
                                    ],
                                ],
                            ]
                        ),
                    )
                ),
                array(
                    'name' => 'section_style_tabs_7_title',
                    'label' => esc_html__('Title', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'layout' => '7',
                        'mode_display_tabs_7' => 'navigation',
                    ],
                    'controls' => array(
                        frameflow_widget_color_control(
                            'tabs_7_title_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-tabs7 .pxl-item--navigation-item-text' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'tabs_7_title_color_active',
                            esc_html__('Active Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-tabs7 .pxl-item--navigation-item.active .pxl-item--navigation-item-text, {{WRAPPER}} .pxl-tabs7 .pxl-item--navigation-item:hover .pxl-item--navigation-item-text' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_typography_control(
                            'tabs_7_title_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-tabs7 .pxl-item--navigation-item-text'
                        ),
                        frameflow_widget_color_control(
                            'tabs_7_icon_color',
                            esc_html__('Icon Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-tabs7 .pxl-item--navigation-item-icon' => 'color: {{VALUE}};',
                            ]
                        ),
                    )
                ),
                frameflow_widget_animation_settings(),
            ),
        ),
    ),
    frameflow_get_class_widget_path()
);
