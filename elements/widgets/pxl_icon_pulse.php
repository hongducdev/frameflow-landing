<?php
pxl_add_custom_widget(
    [
        'name' => 'pxl_icon_pulse',
        'title' => esc_html__('Case Icon Pulse', 'frameflow'),
        'icon' => 'eicon-circle-o icon-brand-elementor',
        'categories' => ['pxltheme-core'],
        'params' => [
            'sections' => [
                [
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => [
                        frameflow_widget_select_control(
                            'icon_type',
                            esc_html__('Icon Type', 'frameflow'),
                            [
                                'icon' => esc_html__('Icon', 'frameflow'),
                                'image' => esc_html__('Image', 'frameflow'),
                            ],
                            ['default' => 'icon']
                        ),
                        frameflow_widget_icons_control(
                            'pxl_icon',
                            esc_html__('Icon', 'frameflow'),
                            [
                                'condition' => [
                                    'icon_type' => 'icon',
                                ],
                            ]
                        ),
                        frameflow_widget_media_control(
                            'icon_image',
                            esc_html__('Image', 'frameflow'),
                            [
                                'condition' => [
                                    'icon_type' => 'image',
                                ],
                            ]
                        ),
                    ],
                ],
                [
                    'name' => 'section_style_general',
                    'label' => esc_html__('General', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => [
                        [
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
                                '{{WRAPPER}} .pxl-icon-pulse' => 'text-align: {{VALUE}};',
                            ],
                        ],
                        frameflow_widget_slider_control(
                            'box_size',
                            esc_html__('Box Size', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-pulse' => '--pulse-size: {{SIZE}}{{UNIT}};',
                            ],
                            [
                                'size_units' => ['px'],
                                'range' => [
                                    'px' => [
                                        'min' => 40,
                                        'max' => 320,
                                    ],
                                ],
                                'default' => [
                                    'unit' => 'px',
                                    'size' => 88,
                                ],
                            ]
                        ),
                        frameflow_widget_color_control(
                            'box_bg_color',
                            esc_html__('Box Background', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-pulse .pxl-icon-pulse--inner' => 'background-color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'box_border_color',
                            esc_html__('Box Border Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-pulse .pxl-icon-pulse--inner' => 'border-color: {{VALUE}};',
                            ]
                        ),
                    ],
                ],
                [
                    'name' => 'section_style_icon',
                    'label' => esc_html__('Icon', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => [
                        frameflow_widget_slider_control(
                            'icon_size',
                            esc_html__('Icon Size', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-pulse .pxl-icon-pulse--icon' => '--pulse-icon-size: {{SIZE}}{{UNIT}};',
                            ],
                            [
                                'size_units' => ['px'],
                                'range' => [
                                    'px' => [
                                        'min' => 8,
                                        'max' => 160,
                                    ],
                                ],
                                'default' => [
                                    'unit' => 'px',
                                    'size' => 28,
                                ],
                            ]
                        ),
                        frameflow_widget_color_control(
                            'icon_color',
                            esc_html__('Icon Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-pulse .pxl-icon-pulse--icon' => 'color: {{VALUE}};',
                            ]
                        ),
                    ],
                ],
                [
                    'name' => 'section_style_arc',
                    'label' => esc_html__('Progress Arc', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => [
                        frameflow_widget_color_control(
                            'arc_color_1',
                            esc_html__('Gradient Start', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-pulse' => '--pulse-arc-color-1: {{VALUE}};',
                            ],
                            ['default' => '#1FAF5A']
                        ),
                        frameflow_widget_color_control(
                            'arc_color_2',
                            esc_html__('Gradient End', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-pulse' => '--pulse-arc-color-2: {{VALUE}};',
                            ],
                            ['default' => '#7CFF4A']
                        ),
                        frameflow_widget_color_control(
                            'arc_track_color',
                            esc_html__('Track Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-pulse' => '--pulse-arc-track: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_slider_control(
                            'arc_width',
                            esc_html__('Arc Width', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-pulse' => '--pulse-arc-width: {{SIZE}};',
                            ],
                            [
                                'description' => esc_html__(
                                    'Stroke thickness of the progress arc (SVG units).',
                                    'frameflow'
                                ),
                                'size_units' => [''],
                                'range' => [
                                    '' => [
                                        'min' => 1,
                                        'max' => 16,
                                        'step' => 0.1,
                                    ],
                                ],
                                'default' => [
                                    'unit' => '',
                                    'size' => 3.5,
                                ],
                            ]
                        ),
                        frameflow_widget_slider_control(
                            'arc_offset',
                            esc_html__('Arc Offset', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-pulse' => '--pulse-arc-offset: {{SIZE}}{{UNIT}};',
                            ],
                            [
                                'description' => esc_html__(
                                    'Distance from box border to progress arc. Larger = more gap.',
                                    'frameflow'
                                ),
                                'size_units' => ['px'],
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 40,
                                    ],
                                ],
                                'default' => [
                                    'unit' => 'px',
                                    'size' => 6,
                                ],
                            ]
                        ),
                        [
                            'name' => 'arc_duration',
                            'label' => esc_html__('Arc Duration (s)', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['s'],
                            'range' => [
                                's' => [
                                    'min' => 0.5,
                                    'max' => 12,
                                    'step' => 0.1,
                                ],
                            ],
                            'default' => [
                                'unit' => 's',
                                'size' => 2.4,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-icon-pulse' => '--pulse-arc-duration: {{SIZE}}s;',
                            ],
                        ],
                    ],
                ],
                [
                    'name' => 'section_style_rings',
                    'label' => esc_html__('Pulse Rings', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => [
                        frameflow_widget_color_control(
                            'ring_1_color',
                            esc_html__('Ring 1 Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-pulse' => '--pulse-ring-1: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'ring_2_color',
                            esc_html__('Ring 2 Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-pulse' => '--pulse-ring-2: {{VALUE}};',
                            ]
                        ),
                        [
                            'name' => 'ring_duration',
                            'label' => esc_html__('Ring Duration (s)', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['s'],
                            'range' => [
                                's' => [
                                    'min' => 0.5,
                                    'max' => 12,
                                    'step' => 0.1,
                                ],
                            ],
                            'default' => [
                                'unit' => 's',
                                'size' => 2.4,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-icon-pulse' => '--pulse-ring-duration: {{SIZE}}s;',
                            ],
                        ],
                    ],
                ],
                frameflow_widget_animation_settings(),
            ],
        ],
    ],
    frameflow_get_class_widget_path()
);
