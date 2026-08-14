<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_button',
        'title' => esc_html__('Case Button', 'frameflow'),
        'icon' => 'eicon-e-button',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        frameflow_widget_select_control(
                            'btn_style',
                            esc_html__('Type', 'frameflow'),
                            [
                                'btn-default' => esc_html__('Default', 'frameflow'),
                            ],
                            ['default' => 'btn-default']
                        ),
                        frameflow_widget_text_control(
                            'text',
                            esc_html__('Text', 'frameflow'),
                            ['default' => esc_html__('Click Here', 'frameflow')]
                        ),
                        frameflow_widget_url_control(
                            'link',
                            esc_html__('Link', 'frameflow'),
                            [
                                'default' => [
                                    'url' => '#',
                                ],
                            ]
                        ),

                        array(
                            'name' => 'align',
                            'label' => esc_html__('Alignment', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::CHOOSE,
                            'control_type' => 'responsive',
                            'options' => [
                                'left'    => [
                                    'title' => esc_html__('Left', 'frameflow'),
                                    'icon' => 'fa fa-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__('Center', 'frameflow'),
                                    'icon' => 'fa fa-align-center',
                                ],
                                'right' => [
                                    'title' => esc_html__('Right', 'frameflow'),
                                    'icon' => 'fa fa-align-right',
                                ],
                                'justify' => [
                                    'title' => esc_html__('Justified', 'frameflow'),
                                    'icon' => 'fa fa-align-justify',
                                ],
                            ],
                            'prefix_class' => 'elementor-align-',
                            'default' => '',
                            'selectors'         => [
                                '{{WRAPPER}} .pxl-button' => 'text-align: {{VALUE}}',
                            ],
                        ),
                        frameflow_widget_icons_control(
                            'btn_icon',
                            esc_html__('Icon', 'frameflow'),
                            [
                                'label_block' => true,
                                'condition' => [
                                    'btn_style!' => ['custom_icon_1'],
                                ],
                            ]
                        ),
                        frameflow_widget_select_control(
                            'icon_align',
                            esc_html__('Icon Position', 'frameflow'),
                            [
                                'left' => esc_html__('Before', 'frameflow'),
                                'right' => esc_html__('After', 'frameflow'),
                            ],
                            [
                                'default' => 'left',
                                'condition' => [
                                    'btn_style!' => ['btn-square-card'],
                                ],
                            ]
                        ),
                    ),
                ),

                array(
                    'name' => 'section_style_button',
                    'label' => esc_html__('Button', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array_merge(
                        array(
                            frameflow_widget_slider_control(
                                'btn_height',
                                esc_html__('Button Height', 'frameflow'),
                                [
                                    '{{WRAPPER}} .pxl-button .btn' => 'height: {{SIZE}}{{UNIT}};',
                                ],
                            ),
                            frameflow_widget_slider_control(
                                'btn_gap',
                                esc_html__('Gap', 'frameflow'),
                                [
                                    '{{WRAPPER}} .pxl-button .btn' => 'gap: {{SIZE}}{{UNIT}};',
                                ],
                                [
                                    'size_units' => ['px', '%', 'em', 'rem'],
                                ]
                            ),
                            frameflow_widget_typography_control(
                                'btn_typography',
                                esc_html__('Typography', 'frameflow'),
                                '{{WRAPPER}} .pxl-button .btn'
                            ),
                            frameflow_widget_control_tabs(
                                'button_style_tabs',
                                [
                                    [
                                        'name' => 'tab_button_normal',
                                        'label' => esc_html__('Normal', 'frameflow'),
                                        'controls' => [
                                            frameflow_widget_color_control(
                                                'color',
                                                esc_html__('Color', 'frameflow'),
                                                [
                                                    '{{WRAPPER}} .pxl-button .btn' => 'color: {{VALUE}};',
                                                ]
                                            ),
                                            array(
                                                'name'         => 'select_background',
                                                'label'        => esc_html__('Background', 'frameflow'),
                                                'type'         => \Elementor\Group_Control_Background::get_type(),
                                                'control_type' => 'group',
                                                'types'        => ['classic', 'gradient'],
                                                'selector'     => '{{WRAPPER}} .pxl-button .btn',
                                            ),
                                            frameflow_widget_slider_control(
                                                'backdrop_blur',
                                                esc_html__('Blur', 'frameflow'),
                                                [
                                                    '{{WRAPPER}} .pxl-button .btn' => 'backdrop-filter: blur({{SIZE}}{{UNIT}});',
                                                ],
                                                [
                                                    'size_units' => ['px'],
                                                ]
                                            ),
                                            array(
                                                'name'         => 'btn_box_shadow',
                                                'label' => esc_html__('Box Shadow', 'frameflow'),
                                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                                'control_type' => 'group',
                                                'selector'     => '{{WRAPPER}} .pxl-button .btn',
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
                                                        '{{WRAPPER}} .pxl-button .btn' => 'border-style: {{VALUE}} !important;',
                                                    ],
                                                ]
                                            ),
                                            frameflow_widget_dimensions_control(
                                                'border_width',
                                                esc_html__('Border Width', 'frameflow'),
                                                [
                                                    '{{WRAPPER}} .pxl-button .btn' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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
                                                    '{{WRAPPER}} .pxl-button .btn' => 'border-color: {{VALUE}} !important;',
                                                ],
                                                [
                                                    'default' => '',
                                                    'condition' => [
                                                        'border_type!' => '',
                                                    ],
                                                ]
                                            ),
                                        ],
                                    ],
                                    [
                                        'name' => 'tab_button_hover',
                                        'label' => esc_html__('Hover', 'frameflow'),
                                        'controls' => [
                                            frameflow_widget_select_control(
                                                'btn_text_effect',
                                                esc_html__('Text Effect', 'frameflow'),
                                                [
                                                    '' => esc_html__('Default', 'frameflow'),
                                                    'no-ef' => esc_html__('No Effect', 'frameflow'),
                                                    'btn-text-nina' => esc_html__('Nina', 'frameflow'),
                                                    'btn-text-nanuk' => esc_html__('Nanuk', 'frameflow'),
                                                    'btn-text-smoke' => esc_html__('Smoke', 'frameflow'),
                                                    'btn-text-reverse' => esc_html__('Reverse', 'frameflow'),
                                                    'btn-text-parallax' => esc_html__('Text Parallax', 'frameflow'),
                                                    'btn-hide-icon' => esc_html__('Hide Icon', 'frameflow'),
                                                    'btn-glossy' => esc_html__('Glossy', 'frameflow'),
                                                    'btn-underline' => esc_html__('Underline', 'frameflow'),
                                                    'btn-text-applied' => esc_html__('Applied', 'frameflow'),
                                                ],
                                                ['default' => '']
                                            ),
                                            array(
                                                'name' => 'transition_duration',
                                                'label' => esc_html__('Transition Duration', 'frameflow'),
                                                'type' => \Elementor\Controls_Manager::SLIDER,
                                                'size_units' => ['px'],
                                                'range' => [
                                                    'px' => [
                                                        'min' => 0,
                                                        'max' => 100000,
                                                    ],
                                                ],
                                                'selectors' => [
                                                    '{{WRAPPER}} .btn.btn-text-reverse .pxl-text--inner span' => 'transition-duration: {{SIZE}}ms;',
                                                ],
                                                'condition' => [
                                                    'btn_text_effect' => ['btn-text-reverse'],
                                                ],
                                                'description' => 'Enter number, unit is ms.',
                                            ),
                                            frameflow_widget_color_control(
                                                'color_hover',
                                                esc_html__('Color Hover', 'frameflow'),
                                                [
                                                    '{{WRAPPER}} .pxl-button .btn:hover' => 'color: {{VALUE}};',
                                                    '{{WRAPPER}} .pxl-button .btn-hide-icon .pxl--btn-text:before' => 'background-color: {{VALUE}} !important;',
                                                ]
                                            ),
                                            frameflow_widget_color_control(
                                                'bd_color_hover',
                                                esc_html__('Border Color Hover', 'frameflow'),
                                                [
                                                    '{{WRAPPER}} .pxl-button .btn:hover' => ' border-color: {{VALUE}} !important;',
                                                ]
                                            ),
                                            frameflow_widget_color_control(
                                                'btn_bg_color_hover',
                                                esc_html__('Background Color', 'frameflow'),
                                                [
                                                    '{{WRAPPER}} .pxl-button .btn:hover' => 'background-color: {{VALUE}};',
                                                    '{{WRAPPER}} .pxl-button .btn.btn-svg:hover .btn-svg-bg svg path' => 'fill: {{VALUE}};',
                                                ],
                                                [
                                                    'condition' => [
                                                        'btn_style!' => [''],
                                                    ],
                                                ]
                                            ),
                                            array(
                                                'name'         => 'btn_box_shadow_hover',
                                                'label' => esc_html__('Box Shadow', 'frameflow'),
                                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                                'control_type' => 'group',
                                                'selector'     => '{{WRAPPER}} .pxl-button .btn:hover',
                                            ),
                                        ],
                                    ],
                                ]
                            ),
                        ),

                        array(
                            frameflow_widget_dimensions_control(
                                'btn_border_radius',
                                esc_html__('Border Radius', 'frameflow'),
                                [
                                    '{{WRAPPER}} .pxl-button .btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                                ['size_units' => ['px']]
                            ),
                            frameflow_widget_dimensions_control(
                                'btn_padding',
                                esc_html__('Padding', 'frameflow'),
                                [
                                    '{{WRAPPER}} .pxl-button .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                                [
                                    'size_units' => ['px', 'vw'],
                                    'condition' => [
                                        'btn_style!' => ['btn-arrow-1'],
                                    ],
                                ]
                            ),
                            frameflow_widget_dimensions_control(
                                'btn_span_padding',
                                esc_html__('Padding', 'frameflow'),
                                [
                                    '{{WRAPPER}} .pxl-button .btn.btn-arrow-1 span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                                [
                                    'size_units' => ['px', 'vw'],
                                    'condition' => [
                                        'btn_style' => ['btn-arrow-1'],
                                    ],
                                ]
                            ),
                        )
                    ),
                ),

                array(
                    'name' => 'section_style_icon',
                    'label' => esc_html__('Icon', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_control_tabs(
                            'icon_style_tabs',
                            [
                                [
                                    'name' => 'tab_icon_normal',
                                    'label' => esc_html__('Normal', 'frameflow'),
                                    'controls' => [
                                        frameflow_widget_color_control(
                                            'icon_color',
                                            esc_html__('Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-button .btn i' => 'color: {{VALUE}};',
                                                '{{WRAPPER}} .pxl-button .btn svg path' => 'fill: {{VALUE}};',
                                            ]
                                        ),
                                        frameflow_widget_color_control(
                                            'box_color',
                                            esc_html__('Box Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-button .btn i,{{WRAPPER}} .pxl-button .btn .btn-icon-left,{{WRAPPER}} .pxl-button .btn .pxl--btn-icon' => 'background-color: {{VALUE}};',
                                            ]
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'tab_icon_hover',
                                    'label' => esc_html__('Hover', 'frameflow'),
                                    'controls' => [
                                        frameflow_widget_color_control(
                                            'icon_hv_color',
                                            esc_html__('Color Hover', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-button .btn:hover i' => 'color: {{VALUE}};',
                                                '{{WRAPPER}} .pxl-button .btn:hover svg path' => 'fill: {{VALUE}};',
                                            ]
                                        ),
                                        frameflow_widget_color_control(
                                            'box_color_hv',
                                            esc_html__('Box Color Hover', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-button .btn:hover i,{{WRAPPER}} .pxl-button .btn:hover .btn-icon-left,{{WRAPPER}} .pxl-button .btn:hover .pxl--btn-icon' => 'background-color: {{VALUE}};',
                                            ]
                                        ),
                                    ],
                                ],
                            ]
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
                                '{{WRAPPER}} .pxl-button .btn i' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-button .btn svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
                                '{{WRAPPER}} .pxl-button .btn-svg:hover svg' => 'width: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-button .btn.btn-svg .btn-svg-bg svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-button .btn.btn-square-card .pxl--btn-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-button .btn.btn-square-card .pxl--btn-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                            ],
                        ),

                        array(
                            'name' => 'width_box_icon',
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
                                '{{WRAPPER}} .pxl-button .btn i' => 'width: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-button .btn .pxl--btn-icon' => 'width: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-button .btn.btn-svg .btn-svg-bg' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'height_box_icon',
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
                                '{{WRAPPER}} .pxl-button .btn i' => 'height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-button .btn .pxl--btn-icon' => 'height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-button .btn.btn-svg .btn-svg-bg' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        frameflow_widget_dimensions_control(
                            'border_radius_box_icon',
                            esc_html__('Border Radius', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-button .btn i,{{WRAPPER}} .pxl-button .btn .btn-icon-left,{{WRAPPER}} .pxl-button .btn .pxl--btn-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            ['size_units' => ['px']]
                        ),
                        array(
                            'name' => 'icon_space_left',
                            'label' => esc_html__('Icon Spacer', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'default' => [
                                'size' => 10,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-button .btn.pxl-icon--left:not(.btn-svg) i, {{WRAPPER}} .pxl-button .btn.pxl-icon--left:not(.btn-svg) svg' => 'margin-right: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-button .btn-svg.pxl-icon--left:hover  svg' => 'margin-right: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'icon_align' => ['left'],
                                'btn_style!' => ['btn-svg', 'btn-square-card'],
                            ],
                        ),
                        array(
                            'name' => 'icon_space_right',
                            'label' => esc_html__('Icon Spacer', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'default' => [
                                'size' => 10,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-button .btn.pxl-icon--right:not(.btn-svg) i, {{WRAPPER}} .pxl-button .btn.pxl-icon--right:not(.btn-svg) svg' => 'margin-left: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-button .btn-svg.pxl-icon--right:hover svg' => 'margin-left: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'icon_align' => ['right'],
                                'btn_style!' => ['btn-svg', 'btn-square-card'],
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
