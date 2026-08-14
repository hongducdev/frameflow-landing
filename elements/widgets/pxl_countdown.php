<?php
/**
 * Case Countdown — days/hours/minutes/seconds timer.
 * Layout: elements/templates/pxl_countdown/layout-1.php
 * Styles: assets/scss/elements/pxl_countdown.scss
 * Script: elements/widgets/js/countdown.js (frameflow-countdown)
 */
pxl_add_custom_widget(
    [
        'name' => 'pxl_countdown',
        'title' => esc_html__('Case Countdown', 'frameflow'),
        'icon' => 'eicon-countdown icon-brand-elementor',
        'categories' => ['pxltheme-core'],
        'scripts' => [
            'frameflow-countdown',
        ],
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
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_countdown/layout1.webp',
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
                            'name' => 'date',
                            'label' => esc_html__('Due Date', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::DATE_TIME,
                            'picker_options' => [
                                'enableTime' => true,
                                'enableSeconds' => false,
                            ],
                            'default' => gmdate('Y-m-d H:i', strtotime('+30 days')),
                        ],
                        frameflow_widget_text_control(
                            'day',
                            esc_html__('Day (singular)', 'frameflow'),
                            ['default' => esc_html__('Day', 'frameflow')]
                        ),
                        frameflow_widget_text_control(
                            'days',
                            esc_html__('Days (plural)', 'frameflow'),
                            ['default' => esc_html__('Days', 'frameflow')]
                        ),
                        frameflow_widget_text_control(
                            'hour',
                            esc_html__('Hour (singular)', 'frameflow'),
                            ['default' => esc_html__('Hour', 'frameflow')]
                        ),
                        frameflow_widget_text_control(
                            'hours',
                            esc_html__('Hours (plural)', 'frameflow'),
                            ['default' => esc_html__('Hours', 'frameflow')]
                        ),
                        frameflow_widget_text_control(
                            'minute',
                            esc_html__('Minute (singular)', 'frameflow'),
                            ['default' => esc_html__('Minute', 'frameflow')]
                        ),
                        frameflow_widget_text_control(
                            'minutes',
                            esc_html__('Minutes (plural)', 'frameflow'),
                            ['default' => esc_html__('Minutes', 'frameflow')]
                        ),
                        frameflow_widget_text_control(
                            'second',
                            esc_html__('Second (singular)', 'frameflow'),
                            ['default' => esc_html__('Second', 'frameflow')]
                        ),
                        frameflow_widget_text_control(
                            'seconds',
                            esc_html__('Seconds (plural)', 'frameflow'),
                            ['default' => esc_html__('Seconds', 'frameflow')]
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
                                'flex-start' => [
                                    'title' => esc_html__('Left', 'frameflow'),
                                    'icon' => 'eicon-text-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__('Center', 'frameflow'),
                                    'icon' => 'eicon-text-align-center',
                                ],
                                'flex-end' => [
                                    'title' => esc_html__('Right', 'frameflow'),
                                    'icon' => 'eicon-text-align-right',
                                ],
                                'space-between' => [
                                    'title' => esc_html__('Justified', 'frameflow'),
                                    'icon' => 'eicon-text-align-justify',
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-countdown' => 'justify-content: {{VALUE}};',
                            ],
                        ],
                        frameflow_widget_slider_control(
                            'item_gap',
                            esc_html__('Gap', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-countdown' => 'gap: {{SIZE}}{{UNIT}};',
                            ],
                            [
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 200,
                                    ],
                                ],
                                'default' => [
                                    'unit' => 'px',
                                    'size' => 60,
                                ],
                            ]
                        ),
                    ],
                ],
                [
                    'name' => 'section_style_amount',
                    'label' => esc_html__('Number', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => [
                        frameflow_widget_typography_control(
                            'amount_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-countdown .countdown-amount'
                        ),
                        frameflow_widget_color_control(
                            'amount_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-countdown .countdown-amount' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_dimensions_control(
                            'amount_margin',
                            esc_html__('Margin', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-countdown .countdown-amount' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ]
                        ),
                    ],
                ],
                [
                    'name' => 'section_style_period',
                    'label' => esc_html__('Label', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => [
                        frameflow_widget_typography_control(
                            'period_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-countdown .countdown-period'
                        ),
                        frameflow_widget_color_control(
                            'period_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-countdown .countdown-period' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_dimensions_control(
                            'period_margin',
                            esc_html__('Margin', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-countdown .countdown-period' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ]
                        ),
                    ],
                ],
                frameflow_widget_animation_settings(),
            ],
        ],
    ],
    frameflow_get_class_widget_path()
);
