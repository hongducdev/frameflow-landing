<?php
/**
 * Case Range — gradient bar that fills once to a set percent.
 * Templates: elements/templates/pxl_range/layout-1.php
 * Styles: assets/scss/elements/pxl_range.scss
 * Script: elements/widgets/js/range.js
 * Figma: 6003:224
 */
pxl_add_custom_widget(
    [
        'name' => 'pxl_range',
        'title' => esc_html__('Case Range', 'frameflow'),
        'icon' => 'eicon-skill-bar icon-brand-elementor',
        'categories' => ['pxltheme-core'],
        'scripts' => ['elementor-waypoints', 'frameflow-range'],
        'params' => [
            'sections' => [
                [
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => [
                        [
                            'name' => 'percent',
                            'label' => esc_html__('Percent', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['%'],
                            'range' => [
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                    'step' => 1,
                                ],
                            ],
                            'default' => [
                                'unit' => '%',
                                'size' => 88,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-range' => '--pxl-range-percent: {{SIZE}}%;',
                            ],
                        ],
                        frameflow_widget_text_control(
                            'tooltip_text',
                            esc_html__('Tooltip', 'frameflow'),
                            [
                                'label_block' => true,
                                'default' => esc_html__('Fast & Stable', 'frameflow'),
                            ],
                        ),
                        [
                            'name' => 'duration',
                            'label' => esc_html__('Duration (s)', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['s'],
                            'range' => [
                                's' => [
                                    'min' => 0.2,
                                    'max' => 8,
                                    'step' => 0.1,
                                ],
                            ],
                            'default' => [
                                'unit' => 's',
                                'size' => 1.2,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-range' => '--pxl-range-duration: {{SIZE}}s;',
                            ],
                        ],
                    ],
                ],
                [
                    'name' => 'section_style_bar',
                    'label' => esc_html__('Bar', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => [
                        frameflow_widget_color_control(
                            'track_color',
                            esc_html__('Track Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-range' => '--pxl-range-track: {{VALUE}};',
                            ],
                        ),
                        frameflow_widget_color_control(
                            'track_border_color',
                            esc_html__('Track Border', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-range' => '--pxl-range-track-border: {{VALUE}};',
                            ],
                        ),
                        frameflow_widget_color_control(
                            'gradient_from',
                            esc_html__('Gradient From', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-range' => '--pxl-range-from: {{VALUE}};',
                            ],
                        ),
                        frameflow_widget_color_control(
                            'gradient_to',
                            esc_html__('Gradient To', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-range' => '--pxl-range-to: {{VALUE}};',
                            ],
                        ),
                        frameflow_widget_slider_control(
                            'bar_height',
                            esc_html__('Height', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-range' => '--pxl-range-height: {{SIZE}}{{UNIT}};',
                            ],
                            [
                                'size_units' => ['px'],
                                'range' => [
                                    'px' => [
                                        'min' => 8,
                                        'max' => 48,
                                    ],
                                ],
                                'default' => [
                                    'unit' => 'px',
                                    'size' => 21,
                                ],
                            ],
                        ),
                    ],
                ],
                [
                    'name' => 'section_style_thumb',
                    'label' => esc_html__('Thumb', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => [
                        frameflow_widget_color_control(
                            'thumb_color',
                            esc_html__('Thumb Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-range' => '--pxl-range-thumb: {{VALUE}};',
                            ],
                        ),
                        frameflow_widget_color_control(
                            'thumb_dot_color',
                            esc_html__('Dot Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-range' => '--pxl-range-thumb-dot: {{VALUE}};',
                            ],
                        ),
                        frameflow_widget_slider_control(
                            'thumb_size',
                            esc_html__('Size', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-range' =>
                                    '--pxl-range-thumb-size: {{SIZE}}{{UNIT}};',
                            ],
                            [
                                'size_units' => ['px'],
                                'range' => [
                                    'px' => [
                                        'min' => 8,
                                        'max' => 40,
                                    ],
                                ],
                                'default' => [
                                    'unit' => 'px',
                                    'size' => 15,
                                ],
                            ],
                        ),
                    ],
                ],
                [
                    'name' => 'section_style_tooltip',
                    'label' => esc_html__('Tooltip', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => [
                        frameflow_widget_color_control(
                            'tooltip_bg_color',
                            esc_html__('Background', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-range' => '--pxl-range-tooltip-bg: {{VALUE}};',
                            ],
                        ),
                        frameflow_widget_color_control(
                            'tooltip_text_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-range__label' => 'color: {{VALUE}};',
                            ],
                        ),
                        frameflow_widget_typography_control(
                            'tooltip_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-range__label',
                        ),
                    ],
                ],
                frameflow_widget_animation_settings(),
            ],
        ],
    ],
    frameflow_get_class_widget_path(),
);
