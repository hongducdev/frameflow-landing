<?php
pxl_add_custom_widget(
    [
        'name' => 'pxl_image_fan',
        'title' => esc_html__('Case Image Fan', 'frameflow'),
        'icon' => 'eicon-gallery-group icon-brand-elementor',
        'categories' => ['pxltheme-core'],
        'scripts' => ['gsap', 'pxl-scroll-trigger', 'frameflow-image-fan'],
        'params' => [
            'sections' => [
                [
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => [
                        frameflow_widget_media_control(
                            'image_left',
                            esc_html__('Left Image', 'frameflow')
                        ),
                        frameflow_widget_media_control(
                            'image_center',
                            esc_html__('Center Image', 'frameflow')
                        ),
                        frameflow_widget_media_control(
                            'image_right',
                            esc_html__('Right Image', 'frameflow')
                        ),
                        [
                            'name' => 'hold_duration',
                            'label' => esc_html__('Hold Duration (s)', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['s'],
                            'range' => [
                                's' => [
                                    'min' => 0.5,
                                    'max' => 8,
                                    'step' => 0.1,
                                ],
                            ],
                            'default' => [
                                'unit' => 's',
                                'size' => 2,
                            ],
                        ],
                    ],
                ],
                [
                    'name' => 'section_style_frame',
                    'label' => esc_html__('Frame', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => [
                        frameflow_widget_slider_control(
                            'frame_width',
                            esc_html__('Frame Width', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-image-fan' => '--fan-frame-w: {{SIZE}}{{UNIT}};',
                            ],
                            [
                                'size_units' => ['px'],
                                'range' => [
                                    'px' => [
                                        'min' => 120,
                                        'max' => 420,
                                    ],
                                ],
                                'default' => [
                                    'unit' => 'px',
                                    'size' => 220,
                                ],
                            ]
                        ),
                        frameflow_widget_slider_control(
                            'frame_height',
                            esc_html__('Frame Height', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-image-fan' => '--fan-frame-h: {{SIZE}}{{UNIT}};',
                            ],
                            [
                                'size_units' => ['px'],
                                'range' => [
                                    'px' => [
                                        'min' => 160,
                                        'max' => 560,
                                    ],
                                ],
                                'default' => [
                                    'unit' => 'px',
                                    'size' => 312,
                                ],
                            ]
                        ),
                        frameflow_widget_slider_control(
                            'frame_radius',
                            esc_html__('Border Radius', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-image-fan' => '--fan-radius: {{SIZE}}{{UNIT}};',
                            ],
                            [
                                'size_units' => ['px'],
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 40,
                                    ],
                                ],
                                'default' => [
                                    'unit' => 'px',
                                    'size' => 10,
                                ],
                            ]
                        ),
                        [
                            'name' => 'fan_angle',
                            'label' => esc_html__('Side Angle (deg)', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 5,
                                    'max' => 35,
                                    'step' => 0.1,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 19.8,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-image-fan' => '--fan-angle: {{SIZE}}deg;',
                            ],
                        ],
                        frameflow_widget_slider_control(
                            'fan_offset',
                            esc_html__('Side Offset', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-image-fan' => '--fan-offset-x: {{SIZE}}{{UNIT}};',
                            ],
                            [
                                'size_units' => ['px'],
                                'range' => [
                                    'px' => [
                                        'min' => 20,
                                        'max' => 160,
                                    ],
                                ],
                                'default' => [
                                    'unit' => 'px',
                                    'size' => 72,
                                ],
                            ]
                        ),
                        frameflow_widget_slider_control(
                            'center_offset_y',
                            esc_html__('Center Vertical Offset', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-image-fan' => '--fan-center-y: {{SIZE}}{{UNIT}};',
                            ],
                            [
                                'description' => esc_html__(
                                    'Negative moves the center card higher.',
                                    'frameflow'
                                ),
                                'size_units' => ['px'],
                                'range' => [
                                    'px' => [
                                        'min' => -80,
                                        'max' => 40,
                                    ],
                                ],
                                'default' => [
                                    'unit' => 'px',
                                    'size' => -28,
                                ],
                            ]
                        ),
                        frameflow_widget_color_control(
                            'frame_border_color',
                            esc_html__('Border Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-image-fan' => '--fan-border: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'frame_glass_color',
                            esc_html__('Glass Background', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-image-fan' => '--fan-glass: {{VALUE}};',
                            ]
                        ),
                    ],
                ],
            ],
        ],
    ],
    frameflow_get_class_widget_path()
);
