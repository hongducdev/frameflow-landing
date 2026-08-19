<?php
/**
 * Case Physics — throwable pill items (Matter.js).
 * Templates: elements/templates/pxl_physics/layout-1.php
 * Styles: assets/scss/elements/pxl_physics.scss
 * Figma: 3769:488
 */
pxl_add_custom_widget(
    [
        'name' => 'pxl_physics',
        'title' => esc_html__('Case Physics', 'frameflow'),
        'icon' => 'eicon-icon',
        'categories' => ['pxltheme-core'],
        'scripts' => ['pxl-matter', 'frameflow-physics'],
        'params' => [
            'sections' => [
                [
                    'name' => 'source_section',
                    'label' => esc_html__('Source Settings', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => [
                        [
                            'name' => 'texts',
                            'label' => esc_html__('List', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => [
                                frameflow_widget_text_control(
                                    'text',
                                    esc_html__('Text', 'frameflow'),
                                    [
                                        'label_block' => true,
                                    ],
                                ),
                                frameflow_widget_icons_control(
                                    'pxl_icon',
                                    esc_html__('Icon', 'frameflow'),
                                ),
                                frameflow_widget_select_control(
                                    'background_type',
                                    esc_html__('Background', 'frameflow'),
                                    [
                                        'gradient' => esc_html__('Gradient', 'frameflow'),
                                        'theme' => esc_html__('Theme Color', 'frameflow'),
                                    ],
                                    [
                                        'label_block' => true,
                                        'default' => 'gradient',
                                    ],
                                ),
                                frameflow_widget_color_control(
                                    'gradient_from',
                                    esc_html__('Gradient From', 'frameflow'),
                                    [],
                                    [
                                        'condition' => [
                                            'background_type' => 'gradient',
                                        ],
                                    ],
                                ),
                                frameflow_widget_color_control(
                                    'gradient_to',
                                    esc_html__('Gradient To', 'frameflow'),
                                    [],
                                    [
                                        'condition' => [
                                            'background_type' => 'gradient',
                                        ],
                                    ],
                                ),
                                frameflow_widget_select_control(
                                    'background_color',
                                    esc_html__('Theme Color', 'frameflow'),
                                    [
                                        'primary' => esc_html__('Primary', 'frameflow'),
                                        'secondary' => esc_html__('Secondary', 'frameflow'),
                                    ],
                                    [
                                        'label_block' => true,
                                        'default' => 'primary',
                                        'condition' => [
                                            'background_type' => 'theme',
                                        ],
                                    ],
                                ),
                            ],
                            'title_field' => '{{{ text }}}',
                            'default' => [
                                [
                                    'text' => esc_html__('Animated Borders', 'frameflow'),
                                    'background_type' => 'gradient',
                                    'gradient_from' => '#EC008C',
                                    'gradient_to' => '#FC6767',
                                ],
                                [
                                    'text' => esc_html__('Custom Cursor', 'frameflow'),
                                    'background_type' => 'gradient',
                                    'gradient_from' => '#59CDE9',
                                    'gradient_to' => '#0A2A88',
                                ],
                                [
                                    'text' => esc_html__('Mask Slider', 'frameflow'),
                                    'background_type' => 'gradient',
                                    'gradient_from' => '#A8C0FF',
                                    'gradient_to' => '#3F2B96',
                                ],
                                [
                                    'text' => esc_html__('Parallax', 'frameflow'),
                                    'background_type' => 'gradient',
                                    'gradient_from' => '#4776E6',
                                    'gradient_to' => '#8E54E9',
                                ],
                                [
                                    'text' => esc_html__('Sticky Row', 'frameflow'),
                                    'background_type' => 'gradient',
                                    'gradient_from' => '#9FA0A8',
                                    'gradient_to' => '#5C7852',
                                ],
                                [
                                    'text' => esc_html__('Page Block', 'frameflow'),
                                    'background_type' => 'gradient',
                                    'gradient_from' => '#11998E',
                                    'gradient_to' => '#38EF7D',
                                ],
                                [
                                    'text' => esc_html__('Adaptive Colors', 'frameflow'),
                                    'background_type' => 'gradient',
                                    'gradient_from' => '#F12711',
                                    'gradient_to' => '#FDCF58',
                                ],
                                [
                                    'text' => esc_html__('Section Scroll', 'frameflow'),
                                    'background_type' => 'gradient',
                                    'gradient_from' => '#616161',
                                    'gradient_to' => '#9BC5C3',
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'name' => 'style_section',
                    'label' => esc_html__('Style Settings', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => [
                        [
                            'name' => 'height',
                            'label' => esc_html__('Height', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'default' => [
                                'size' => 495,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-physics-item' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ],
                        frameflow_widget_color_control(
                            'text_color',
                            esc_html__('Text Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-throwable-label' => 'color: {{VALUE}};',
                            ],
                        ),
                        frameflow_widget_typography_control(
                            'text_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-throwable-label',
                        ),
                    ],
                ],
            ],
        ],
    ],
    frameflow_get_class_widget_path(),
);
