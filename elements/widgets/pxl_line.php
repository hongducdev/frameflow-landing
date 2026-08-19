<?php
/**
 * Case Line — vertical decorative line with a traveling marker.
 * Layout 1: dot. Layout 2: light beam.
 * Templates: elements/templates/pxl_line/layout-1.php, layout-2.php
 * Styles: assets/scss/elements/pxl_line.scss
 * Figma: 3740:1050, 3859:889
 */
pxl_add_custom_widget(
    [
        'name' => 'pxl_line',
        'title' => esc_html__('Case Line', 'frameflow'),
        'icon' => 'eicon-slider-vertical icon-brand-elementor',
        'categories' => ['pxltheme-core'],
        'scripts' => [],
        'params' => [
            'sections' => [
                [
                    'name' => 'section_layout',
                    'label' => esc_html__('Layout', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
                    'controls' => [
                        [
                            'name' => 'layout',
                            'label' => esc_html__('Templates', 'frameflow'),
                            'type' => 'layoutcontrol',
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__('Layout 1', 'frameflow'),
                                    'image' =>
                                        get_template_directory_uri() .
                                        '/elements/widgets/img-layout/pxl_line/layout1.webp',
                                ],
                                '2' => [
                                    'label' => esc_html__('Layout 2', 'frameflow'),
                                    'image' =>
                                        get_template_directory_uri() .
                                        '/elements/widgets/img-layout/pxl_line/layout2.webp',
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => [
                        [
                            'name' => 'fill_height',
                            'label' => esc_html__('Fill Parent Height', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'yes',
                            'return_value' => 'yes',
                            'label_on' => esc_html__('Yes', 'frameflow'),
                            'label_off' => esc_html__('No', 'frameflow'),
                            'prefix_class' => 'pxl-line-fill-height-',
                            'description' => esc_html__(
                                'Stretch the line to the parent column/container height.',
                                'frameflow',
                            ),
                        ],
                        [
                            'name' => 'line_height',
                            'label' => esc_html__('Height', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px', '%', 'vh'],
                            'range' => [
                                'px' => [
                                    'min' => 40,
                                    'max' => 2000,
                                ],
                                '%' => [
                                    'min' => 10,
                                    'max' => 100,
                                ],
                                'vh' => [
                                    'min' => 10,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => '%',
                                'size' => 100,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-line' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ],
                        [
                            'name' => 'duration',
                            'label' => esc_html__('Loop Duration (s)', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['s'],
                            'range' => [
                                's' => [
                                    'min' => 1,
                                    'max' => 20,
                                    'step' => 0.1,
                                ],
                            ],
                            'default' => [
                                'unit' => 's',
                                'size' => 4,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-line' => '--line-duration: {{SIZE}}s;',
                            ],
                        ],
                        frameflow_widget_select_control(
                            'travel_direction',
                            esc_html__('Direction', 'frameflow'),
                            [
                                'down' => esc_html__('Top to Bottom', 'frameflow'),
                                'up' => esc_html__('Bottom to Top', 'frameflow'),
                            ],
                            [
                                'default' => 'down',
                                'prefix_class' => 'pxl-line-dir-',
                            ],
                        ),
                        [
                            'name' => 'dot_fade',
                            'label' => esc_html__('Dot Fade In/Out', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'yes',
                            'return_value' => 'yes',
                            'label_on' => esc_html__('Yes', 'frameflow'),
                            'label_off' => esc_html__('No', 'frameflow'),
                            'prefix_class' => 'pxl-line-dot-fade-',
                            'condition' => [
                                'layout' => '1',
                            ],
                        ],
                        [
                            'name' => 'dot_fade_range',
                            'label' => esc_html__('Dot Fade Range', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['%'],
                            'range' => [
                                '%' => [
                                    'min' => 5,
                                    'max' => 45,
                                    'step' => 1,
                                ],
                            ],
                            'default' => [
                                'unit' => '%',
                                'size' => 15,
                            ],
                            'condition' => [
                                'layout' => '1',
                                'dot_fade' => 'yes',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-line' => '--line-marker-fade-range: {{SIZE}}%;',
                            ],
                        ],
                    ],
                ],
                [
                    'name' => 'section_style_line',
                    'label' => esc_html__('Line', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => [
                        frameflow_widget_color_control(
                            'line_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-line' => '--line-color: {{VALUE}};',
                            ],
                        ),
                        frameflow_widget_slider_control(
                            'line_thickness',
                            esc_html__('Thickness', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-line' => '--line-thickness: {{SIZE}}{{UNIT}};',
                            ],
                            [
                                'size_units' => ['px'],
                                'range' => [
                                    'px' => [
                                        'min' => 1,
                                        'max' => 8,
                                    ],
                                ],
                                'default' => [
                                    'unit' => 'px',
                                    'size' => 1,
                                ],
                            ],
                        ),
                    ],
                ],
                [
                    'name' => 'section_style_marker',
                    'label' => esc_html__('Marker', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => [
                        frameflow_widget_color_control(
                            'marker_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-line' => '--line-marker-color: {{VALUE}};',
                            ],
                        ),
                        frameflow_widget_slider_control(
                            'dot_size',
                            esc_html__('Dot Size', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-line' => '--line-marker-size: {{SIZE}}{{UNIT}};',
                            ],
                            [
                                'size_units' => ['px'],
                                'range' => [
                                    'px' => [
                                        'min' => 3,
                                        'max' => 24,
                                    ],
                                ],
                                'default' => [
                                    'unit' => 'px',
                                    'size' => 5,
                                ],
                                'condition' => [
                                    'layout' => '1',
                                ],
                            ],
                        ),
                        frameflow_widget_slider_control(
                            'dot_opacity',
                            esc_html__('Dot Opacity', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-line__marker' => 'opacity: {{SIZE}};',
                            ],
                            [
                                'size_units' => ['custom'],
                                'range' => [
                                    'custom' => [
                                        'min' => 0,
                                        'max' => 1,
                                        'step' => 0.01,
                                    ],
                                ],
                                'default' => [
                                    'unit' => 'custom',
                                    'size' => 1,
                                ],
                                'condition' => [
                                    'layout' => '1',
                                ],
                            ],
                        ),
                        frameflow_widget_slider_control(
                            'beam_length',
                            esc_html__('Beam Length', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-line' =>
                                    '--line-marker-length: {{SIZE}}{{UNIT}};',
                            ],
                            [
                                'size_units' => ['px'],
                                'range' => [
                                    'px' => [
                                        'min' => 24,
                                        'max' => 240,
                                    ],
                                ],
                                'default' => [
                                    'unit' => 'px',
                                    'size' => 77,
                                ],
                                'condition' => [
                                    'layout' => '2',
                                ],
                            ],
                        ),
                    ],
                ],
                frameflow_widget_animation_settings(),
            ],
        ],
    ],
    frameflow_get_class_widget_path(),
);
