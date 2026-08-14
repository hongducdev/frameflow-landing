<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_icon',
        'title' => esc_html__('Case Icons', 'frameflow'),
        'icon' => 'eicon-svg',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'icons',
                            'label' => esc_html__('Icons', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                frameflow_widget_icons_control(
                                    'pxl_icon',
                                    esc_html__('Icon', 'frameflow')
                                ),
                                frameflow_widget_url_control(
                                    'icon_link',
                                    esc_html__('Link', 'frameflow'),
                                    ['label_block' => true]
                                ),
                                frameflow_widget_text_control(
                                    'label',
                                    esc_html__('Label', 'frameflow'),
                                    ['label_block' => true]
                                ),
                                frameflow_widget_text_control(
                                    'link_text',
                                    esc_html__('Label Link', 'frameflow'),
                                    ['label_block' => true]
                                ),
                                frameflow_widget_color_control(
                                    'color_item',
                                    esc_html__('Color', 'frameflow'),
                                    [
                                        '{{WRAPPER}} .pxl-icon1 {{CURRENT_ITEM}}' => 'color: {{VALUE}};',
                                    ],
                                    ['default' => '']
                                ),
                                frameflow_widget_color_control(
                                    'color_item_hover',
                                    esc_html__('Color Hover', 'frameflow'),
                                    [
                                        '{{WRAPPER}} .pxl-icon1 {{CURRENT_ITEM}}:hover' => 'color: {{VALUE}};',
                                    ],
                                    ['default' => '']
                                ),
                            ),
                            'title_field' => '{{{ label }}}',
                        ),
                        array(
                            'name' => 'align',
                            'label' => esc_html__('Alignment', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::CHOOSE,
                            'control_type' => 'responsive',
                            'options' => [
                                'left' => [
                                    'title' => esc_html__('Left', 'frameflow'),
                                    'icon' => 'eicon-text-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__('Center', 'frameflow'),
                                    'icon' => 'eicon-text-align-center',
                                ],
                                'right' => [
                                    'title' => esc_html__('Right', 'frameflow'),
                                    'icon' => 'eicon-text-align-right',
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-icon1' => 'text-align: {{VALUE}};justify-content: {{VALUE}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style',
                    'label' => esc_html__('Style', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_select_control(
                            'style',
                            esc_html__('Style', 'frameflow'),
                            [
                                'style-1' => 'Default',
                                'style-2' => 'Style Box',
                            ],
                            ['default' => 'style-1']
                        ),
                        frameflow_widget_select_control(
                            'animate_hover',
                            esc_html__('Animation Hover', 'frameflow'),
                            [
                                '' => esc_html__('Style 1', 'frameflow'),
                                'ani1' => esc_html__('Style 2', 'frameflow'),
                                'ani2' => esc_html__('Style 3', 'frameflow'),
                                'ani3' => esc_html__('Style 4', 'frameflow'),
                                'loading' => esc_html__('Loading', 'frameflow'),
                            ],
                            ['default' => '']
                        ),
                        frameflow_widget_slider_control(
                            'gap_icon',
                            esc_html__('Gap Icon', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-list a, {{WRAPPER}} .pxl-icon1' => 'gap: {{SIZE}}{{UNIT}};',
                            ],
                            [
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 300,
                                    ],
                                ],
                            ]
                        ),
                        frameflow_widget_color_control(
                            'color_icon',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon1 a' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-icon1 a i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-icon1 a svg path' => 'fill: {{VALUE}};',
                            ],
                            ['default' => '#fff']
                        ),
                        frameflow_widget_color_control(
                            'color_icon_hover',
                            esc_html__('Icon Color Hover', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon1 a:hover,{{WRAPPER}} .pxl-icon1 a:hover i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-icon1 a:hover svg path' => 'fill: {{VALUE}};',
                            ],
                            ['default' => '']
                        ),
                        frameflow_widget_color_control(
                            'box_color',
                            esc_html__('Box Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon1.style-2 a' => 'background-color: {{VALUE}};',
                            ],
                            ['default' => '']
                        ),
                        frameflow_widget_color_control(
                            'box_color_hover',
                            esc_html__('Box Color Hover', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon1.style-2 a:hover' => 'background-color: {{VALUE}};',
                            ],
                            ['default' => '']
                        ),
                        array(
                            'name'         => 'box_shadow',
                            'label' => esc_html__('Box Shadow', 'frameflow'),
                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                            'control_type' => 'group',
                            'selector'     => '{{WRAPPER}} .pxl-icon1 a',
                        ),
                        frameflow_widget_dimensions_control(
                            'box_border_radius',
                            esc_html__('Box Border Radius', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon1.style-2 a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            [
                                'condition' => [
                                    'style' => ['style-2'],
                                ],
                            ]
                        ),
                        frameflow_widget_slider_control(
                            'box_width',
                            esc_html__('Box Width', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon1.style-2 a' => '--width-box-icon: {{SIZE}}{{UNIT}};',
                            ],
                            [
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 300,
                                    ],
                                ],
                                'condition' => [
                                    'style' => ['style-2'],
                                ],
                            ]
                        ),
                        frameflow_widget_slider_control(
                            'icon_font_size',
                            esc_html__('Font Size', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon1 a i' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-icon1 a svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                            ],
                            [
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 300,
                                    ],
                                ],
                            ]
                        ),
                        frameflow_widget_select_control(
                            'border_type',
                            esc_html__('Border Type', 'frameflow'),
                            [
                                '' => esc_html__('None', 'frameflow'),
                                'solid' => esc_html__('Solid', 'frameflow'),
                                'double' => esc_html__('Double', 'frameflow'),
                                'dotted' => esc_html__('Dotted', 'frameflow'),
                                'dashed' => esc_html__('Dashed', 'frameflow'),
                                'groove' => esc_html__('Groove', 'frameflow'),
                            ],
                            [
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-icon1 a' => 'border-style: {{VALUE}} !important;',
                                ],
                            ]
                        ),
                        frameflow_widget_dimensions_control(
                            'border_width',
                            esc_html__('Border Width', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon1 a' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                            ],
                            [
                                'condition' => [
                                    'border_type!' => '',
                                ],
                                'responsive' => true,
                            ]
                        ),
                        frameflow_widget_color_control(
                            'border_color',
                            esc_html__('Border Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon1 a' => 'border-color: {{VALUE}};',
                            ],
                            [
                                'default' => '',
                                'condition' => [
                                    'border_type!' => '',
                                ],
                            ]
                        ),

                        frameflow_widget_color_control(
                            'border_color_hover',
                            esc_html__('Border Color Hover', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon1 a:hover' => 'border-color: {{VALUE}};',
                            ],
                            [
                                'default' => '',
                                'condition' => [
                                    'border_type!' => '',
                                ],
                            ]
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_t',
                    'label' => esc_html__('Title', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_select_control(
                            'style_t',
                            esc_html__('Style', 'frameflow'),
                            [
                                'style-1' => 'Default',
                                'style-2' => 'Style Gradient',
                            ],
                            ['default' => 'style-1']
                        ),
                        frameflow_widget_color_control(
                            'title_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-list span' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'title_color_hover',
                            esc_html__('Color Hover', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-list:hover span' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_typography_control(
                            't_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-icon-list span'
                        ),
                    ),
                ),
                frameflow_widget_animation_settings(),
            ),
        ),
    ),
    frameflow_get_class_widget_path()
);
