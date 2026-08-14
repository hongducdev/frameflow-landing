<?php
$templates_df = ['0' => esc_html__('None', 'frameflow')];
$templates_lv1 = ['1' => esc_html__('Hidden Panel Mobile', 'frameflow')];
$templates = $templates_df + $templates_lv1 + frameflow_get_templates_option('hidden-panel');
pxl_add_custom_widget(
    array(
        'name' => 'pxl_anchor',
        'title' => esc_html__('Case Anchor', 'frameflow'),
        'icon' => 'eicon-anchor icon-brand-elementor',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        frameflow_widget_select_control(
                            'content_template',
                            esc_html__('Select Template', 'frameflow'),
                            $templates,
                            [
                                'default' => 'df',
                                'description' => 'Add new tab template: "<a href="' . esc_url(admin_url('edit.php?post_type=pxl-template')) . '" target="_blank">Click Here</a>"',
                            ]
                        ),
                        frameflow_widget_select_control(
                            'icon_type',
                            esc_html__('Icon Type', 'frameflow'),
                            [
                                'default' => 'Default',
                                'icon' => 'Icon',
                            ],
                            ['default' => 'default']
                        ),
                        frameflow_widget_icons_control(
                            'pxl_icon',
                            esc_html__('Select Icon', 'frameflow'),
                            [
                                'condition' => [
                                    'icon_type' => ['icon'],
                                ],
                            ]
                        ),
                        frameflow_widget_color_control(
                            'icon_color',
                            esc_html__('Icon Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-anchor-button .pxl-icon-line' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-anchor-button' => 'color: {{VALUE}};',
                            ],
                            ['condition' => ['icon_type' => ['icon']]]
                        ),
                        frameflow_widget_color_control(
                            'color_dot_1_default',
                            esc_html__('Color Dot 1', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-anchor-button .pxl-anchor-dots .pxl-icon-dot.pxl-icon-dot1' => 'background-color: {{VALUE}};',
                            ],
                            ['condition' => ['icon_type' => ['default']]]
                        ),
                        frameflow_widget_color_control(
                            'color_dot_2_default',
                            esc_html__('Color Dot 2', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-anchor-button .pxl-anchor-dots .pxl-icon-dot.pxl-icon-dot2' => 'background-color: {{VALUE}};',
                            ],
                            ['condition' => ['icon_type' => ['default']]]
                        ),
                        frameflow_widget_color_control(
                            'color_dot_3_default',
                            esc_html__('Color Dot 3', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-anchor-button .pxl-anchor-dots .pxl-icon-dot.pxl-icon-dot3' => 'background-color: {{VALUE}};',
                            ],
                            ['condition' => ['icon_type' => ['default']]]
                        ),
                        frameflow_widget_color_control('bd_icon_color', esc_html__('Border Color', 'frameflow'), [
                            '{{WRAPPER}} .pxl-anchor-button' => 'border-color: {{VALUE}};',
                        ]),
                        frameflow_widget_color_control('bg_icon_color', esc_html__('Background Color', 'frameflow'), [
                            '{{WRAPPER}} .pxl-anchor-button' => 'background-color: {{VALUE}};',
                        ]),
                        frameflow_widget_slider_control(
                            'icon_font_size',
                            esc_html__('Icon Font Size', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-anchor-button' => 'font-size: {{SIZE}}{{UNIT}};',
                            ],
                            [
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 300,
                                    ],
                                ],
                                'condition' => [
                                    'icon_type' => ['icon'],
                                ],
                            ]
                        ),
                        frameflow_widget_text_control(
                            'pxl_close_animate_delay',
                            esc_html__('Close Popup - Animation Delay', 'frameflow'),
                            [
                                'default' => '0',
                                'description' => 'Enter number. Default 0ms',
                            ]
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style',
                    'label' => esc_html__('Style', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_slider_control(
                            'box_width',
                            esc_html__('Box Width', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-anchor-button' => 'width: {{SIZE}}{{UNIT}}; align-items: center; justify-content: center; display: inline-flex;',
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
                        frameflow_widget_slider_control(
                            'box_height',
                            esc_html__('Box Height', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-anchor-button' => 'height: {{SIZE}}{{UNIT}};',
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
                        frameflow_widget_dimensions_control(
                            'box_border_radius',
                            esc_html__('Border Radius', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-anchor-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            ['size_units' => ['px']]
                        ),
                        frameflow_widget_color_control(
                            'box_color',
                            esc_html__('Box Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-anchor-button' => 'background-color: {{VALUE}};',
                            ],
                            ['default' => '']
                        ),
                        frameflow_widget_select_control(
                            'box_border_type',
                            esc_html__('Border Type', 'frameflow'),
                            [
                                ''        => esc_html__('None', 'frameflow'),
                                'solid'   => esc_html__('Solid', 'frameflow'),
                                'double'  => esc_html__('Double', 'frameflow'),
                                'dotted'  => esc_html__('Dotted', 'frameflow'),
                                'dashed'  => esc_html__('Dashed', 'frameflow'),
                                'groove'  => esc_html__('Groove', 'frameflow'),
                            ],
                            [
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-anchor-button' => 'border-style: {{VALUE}} !important;',
                                ],
                            ]
                        ),
                        frameflow_widget_dimensions_control(
                            'box_border_width',
                            esc_html__('Border Width', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-anchor-button' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                            ],
                            ['condition' => ['box_border_type!' => '']]
                        ),
                        frameflow_widget_color_control(
                            'box_border_color',
                            esc_html__('Border Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-anchor-button' => 'border-color: {{VALUE}};',
                            ],
                            ['condition' => ['box_border_type!' => '']]
                        ),
                        frameflow_widget_color_control(
                            'box_hover_border_color',
                            esc_html__('Hover Border Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-anchor-button:hover' => 'border-color: {{VALUE}};',
                            ],
                            ['condition' => ['box_border_type!' => '']]
                        ),
                    ),
                ),
                frameflow_widget_animation_settings(),
            ),
        ),
    ),
    frameflow_get_class_widget_path()
);
