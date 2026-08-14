<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_link',
        'title' => esc_html__('Case Links', 'frameflow'),
        'icon' => 'eicon-editor-link icon-brand-elementor',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'link',
                            'label' => esc_html__('Link', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                frameflow_widget_text_control(
                                    'text',
                                    esc_html__('Text', 'frameflow'),
                                    ['label_block' => true]
                                ),
                                frameflow_widget_url_control(
                                    'link',
                                    esc_html__('Link', 'frameflow'),
                                    ['label_block' => true]
                                ),
                                frameflow_widget_icons_control(
                                    'pxl_icon',
                                    esc_html__('Icon', 'frameflow')
                                ),
                            ),
                            'title_field' => '{{{ text }}}',
                        ),
                        frameflow_widget_slider_control(
                            'l_width',
                            esc_html__('Max Width', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-link' => 'max-width: {{SIZE}}{{UNIT}};',
                            ],
                            [
                                'size_units' => ['px', '%'],
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 3000,
                                    ],
                                ],
                            ]
                        ),
                        frameflow_widget_text_control(
                            'wg_title',
                            esc_html__('Widget Title', 'frameflow'),
                            ['label_block' => true]
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_link',
                    'label' => esc_html__('Link', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_select_control(
                            'type',
                            esc_html__('Type', 'frameflow'),
                            [
                                'type-vertical' => 'Vertical',
                                'type-horizontal' => 'Horizontal',
                            ],
                            ['default' => 'type-vertical']
                        ),
                        frameflow_widget_select_control(
                            'style_vertical',
                            esc_html__('Style', 'frameflow'),
                            [
                                'style-default-vertical' => 'Default',
                                'style-2-vertical' => 'Style 2',
                                'style-3-vertical' => 'Style 3',
                                'style-4-vertical' => 'Style 4'
                            ],
                            [
                                'default' => 'style-default-vertical',
                                'condition' => [
                                    'type' => ['type-vertical'],
                                ],
                            ]
                        ),
                        frameflow_widget_select_control(
                            'sub_style_vertical_2',
                            esc_html__('Sub Style', 'frameflow'),
                            [
                                'sub-style-2-1' => 'Sub Style 1',
                                'sub-style-2-2' => 'Sub Style 2',
                                'sub-style-2-3' => 'Sub Style 3',
                            ],
                            [
                                'default' => 'sub-style-2-1',
                                'condition' => [
                                    'style_vertical' => ['style-2-vertical'],
                                ],
                            ]
                        ),
                        frameflow_widget_select_control(
                            'style_horizontal',
                            esc_html__('Style', 'frameflow'),
                            [
                                'style-default-horizontal' => 'Default',
                                'style-2-horizontal' => 'Style 2',
                            ],
                            [
                                'default' => 'style-default-horizontal',
                                'condition' => [
                                    'type' => ['type-horizontal'],
                                ],
                            ]
                        ),
                        frameflow_widget_color_control(
                            'link_color_box',
                            esc_html__('Box Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-link.style-box a' => 'background-color: {{VALUE}};',
                            ],
                            [
                                'condition' => [
                                    'style' => ['style-box'],
                                ],
                            ]
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
                                'space-between' => [
                                    'title' => esc_html__('Justified', 'frameflow'),
                                    'icon' => 'eicon-text-align-justify',
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-link' => 'text-align: {{VALUE}}; justify-content: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'link_style_tabs',
                            'control_type' => 'tab',
                            'tabs' => [
                                [
                                    'name' => 'tab_link_normal',
                                    'label' => esc_html__('Normal', 'frameflow'),
                                    'controls' => [
                                        frameflow_widget_color_control(
                                            'link_color',
                                            esc_html__('Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-link a:not(:hover)' => 'color: {{VALUE}};',
                                            ]
                                        ),
                                        frameflow_widget_color_control(
                                            'link_bg_color',
                                            esc_html__('Background Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-link a' => 'background-color: {{VALUE}};',
                                            ]
                                        ),
                                        frameflow_widget_typography_control(
                                            'link_typography',
                                            esc_html__('Typography', 'frameflow'),
                                            '{{WRAPPER}} .pxl-link a'
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'tab_link_hover',
                                    'label' => esc_html__('Hover', 'frameflow'),
                                    'controls' => [
                                        frameflow_widget_color_control(
                                            'link_color_hover',
                                            esc_html__('Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-link a:hover' => 'color: {{VALUE}};',
                                            ]
                                        ),
                                        frameflow_widget_color_control(
                                            'link_bg_color_hover',
                                            esc_html__('Background Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-link a:hover' => 'background-color: {{VALUE}};',
                                            ]
                                        ),
                                        frameflow_widget_typography_control(
                                            'link_typography_hover',
                                            esc_html__('Typography', 'frameflow'),
                                            '{{WRAPPER}} .pxl-link a:hover'
                                        ),
                                    ],
                                ],
                            ],
                        ),
                        frameflow_widget_color_control(
                            'link_color_active',
                            esc_html__('Color Active', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-link .pxl-item--link.active a' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'link_bg_color_active',
                            esc_html__('Background Color Active', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-link .pxl-item--link.active a' => 'background-color: {{VALUE}};',
                            ]
                        ),
                        array(
                            'name' => 'bottom_spacer',
                            'label' => esc_html__('Vertical Spacer', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-link.type-vertical li + li' => 'margin-top: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'type' => ['type-vertical'],
                            ],
                        ),
                        array(
                            'name' => 'left_spacer',
                            'label' => esc_html__('Horizontal Spacer Left', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-link.type-horizontal li' => 'margin-left: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'type' => ['type-horizontal'],
                            ],
                        ),
                        array(
                            'name' => 'right_spacer',
                            'label' => esc_html__('Horizontal Spacer Right', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-link.type-horizontal li' => 'margin-right: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'type' => ['type-horizontal'],
                            ],
                        ),
                        array(
                            'name' => 'align_items',
                            'label' => esc_html__('Align Items', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::CHOOSE,
                            'control_type' => 'responsive',
                            'options' => [
                                'flex-start' => [
                                    'title' => esc_html__('Flex Start', 'frameflow'),
                                    'icon' => 'eicon-align-start-h',
                                ],
                                'center' => [
                                    'title' => esc_html__('Center', 'frameflow'),
                                    'icon' => 'eicon-align-center-h',
                                ],
                                'flex-end' => [
                                    'title' => esc_html__('Flex End', 'frameflow'),
                                    'icon' => 'eicon-align-end-h',
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-link li a' => 'align-items: {{VALUE}};',
                            ],
                        ),
                        frameflow_widget_dimensions_control(
                            'link_padding',
                            esc_html__('Padding', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-link a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            ['size_units' => ['px', 'vw']]
                        ),
                        frameflow_widget_dimensions_control(
                            'link_border_radius',
                            esc_html__('Border Radius', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-link a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            ['size_units' => ['px', 'vw']]
                        ),
                        frameflow_widget_color_control(
                            'bg_color_before_1',
                            esc_html__('Background Color Before', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-link.style-default-vertical a::before' => 'background-color: {{VALUE}};',
                            ],
                        )
                    ),
                ),
                array(
                    'name' => 'section_style_icon',
                    'label' => esc_html__('Icon', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_control_tabs('icon_style_tabs', [
                            [
                                'name' => 'tab_icon_normal',
                                'label' => esc_html__('Normal', 'frameflow'),
                                'controls' => frameflow_widget_color_type([
                                    'prefix' => 'icon',
                                    'selectors_class' => '.pxl-link a i, {{WRAPPER}} .pxl-link a svg',
                                ]),
                            ],
                            [
                                'name' => 'tab_icon_hover',
                                'label' => esc_html__('Hover', 'frameflow'),
                                'controls' => [
                                    frameflow_widget_color_control(
                                        'icon_color_hv',
                                        esc_html__('Color', 'frameflow'),
                                        [
                                            '{{WRAPPER}} .pxl-link a:hover i, {{WRAPPER}} .pxl-link a:hover svg' => 'color: {{VALUE}};',
                                        ],
                                        ['default' => '']
                                    ),
                                ],
                            ],
                        ]),
                        frameflow_widget_color_control(
                                'icon_color_active',
                                esc_html__('Color Active', 'frameflow'),
                                [
                                    '{{WRAPPER}} .pxl-link .pxl-item--link.active a i, {{WRAPPER}} .pxl-link .pxl-item--link.active a svg' => 'color: {{VALUE}};',
                                ],
                                ['default' => '']
                            ),
                            frameflow_widget_color_control(
                                'box_color',
                                esc_html__('Box Color', 'frameflow'),
                                [
                                    '{{WRAPPER}} .pxl-link a i, {{WRAPPER}} .pxl-link a svg' => 'background-color: {{VALUE}};',
                                ],
                                ['default' => '']
                            ),
                            array(
                                'name' => 'icon_space_top',
                                'label' => esc_html__('Top Spacer', 'frameflow'),
                                'type' => \Elementor\Controls_Manager::SLIDER,
                                'control_type' => 'responsive',
                                'size_units' => ['px'],
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 300,
                                    ],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-link a i' => 'margin-top: {{SIZE}}{{UNIT}};',
                                ],
                            ),
                            array(
                                'name' => 'icon_space_left',
                                'label' => esc_html__('Left Spacer', 'frameflow'),
                                'type' => \Elementor\Controls_Manager::SLIDER,
                                'control_type' => 'responsive',
                                'size_units' => ['px'],
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 300,
                                    ],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-link a i, {{WRAPPER}} .pxl-link a svg' => 'margin-left: {{SIZE}}{{UNIT}};',
                                ],
                            ),
                            array(
                                'name' => 'icon_space_right',
                                'label' => esc_html__('Right Spacer', 'frameflow'),
                                'type' => \Elementor\Controls_Manager::SLIDER,
                                'control_type' => 'responsive',
                                'size_units' => ['px'],
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 300,
                                    ],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-link a i, {{WRAPPER}} .pxl-link a svg' => 'margin-right: {{SIZE}}{{UNIT}};',
                                ],
                            ),
                            array(
                                'name' => 'icon_font_size',
                                'label' => esc_html__('Font Size', 'frameflow'),
                                'type' => \Elementor\Controls_Manager::SLIDER,
                                'control_type' => 'responsive',
                                'size_units' => ['px'],
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 300,
                                    ],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-link a i' => 'font-size: {{SIZE}}{{UNIT}};',
                                    '{{WRAPPER}} .pxl-link a svg' => 'height: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};',
                                    '{{WRAPPER}} .pxl-link.style-3 a:hover i' => 'font-size: {{SIZE}}{{UNIT}} !important;',
                                ],
                            ),
                            array(
                                'name' => 'icon_width',
                                'label' => esc_html__('Box Width', 'frameflow'),
                                'type' => \Elementor\Controls_Manager::SLIDER,
                                'control_type' => 'responsive',
                                'size_units' => ['px'],
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 300,
                                    ],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-link a i, {{WRAPPER}} .pxl-link.style-4-vertical .pxl-item--link-icon' => 'min-width: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};',
                                ],
                            ),
                            array(
                                'name' => 'icon_box_width',
                                'label' => esc_html__('Box Height', 'frameflow'),
                                'type' => \Elementor\Controls_Manager::SLIDER,
                                'control_type' => 'responsive',
                                'size_units' => ['px'],
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 300,
                                    ],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-link a i, {{WRAPPER}} .pxl-link.style-4-vertical .pxl-item--link-icon' => 'height: {{SIZE}}{{UNIT}};justify-content: center; align-items: center;',
                                ],
                            ),
                            array(
                                'name' => 'icon_border_radius',
                                'label' => esc_html__('Box Border Radius', 'frameflow'),
                                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                                'size_units' => ['px'],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-link a i, {{WRAPPER}} .pxl-link.style-4-vertical .pxl-item--link-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                            ),
                    ),
                ),
                frameflow_widget_animation_settings(),
            ),
        ),
    ),
    frameflow_get_class_widget_path()
);
