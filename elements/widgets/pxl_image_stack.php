<?php
pxl_add_custom_widget(
    [
        'name' => 'pxl_image_stack',
        'title' => esc_html__('Case Image Stack', 'frameflow'),
        'icon' => 'eicon-slider-vertical icon-brand-elementor',
        'categories' => ['pxltheme-core'],
        'scripts' => ['frameflow-image-stack'],
        'params' => [
            'sections' => [
                [
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => [
                        [
                            'name' => 'images',
                            'label' => esc_html__('Images', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'title_field' => '{{{ image.url }}}',
                            'controls' => [
                                frameflow_widget_media_control(
                                    'image',
                                    esc_html__('Image', 'frameflow'),
                                ),
                            ],
                        ],
                        [
                            'name' => 'visible_items',
                            'label' => esc_html__('Visible Items', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'min' => 1,
                            'max' => 8,
                            'default' => 3,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-image-stack' => '--pxl-stack-visible: {{VALUE}};',
                            ],
                        ],
                        [
                            'name' => 'stack_speed',
                            'label' => esc_html__('Speed', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 20,
                                    'max' => 200,
                                ],
                            ],
                            'default' => [
                                'size' => 70,
                                'unit' => 'px',
                            ],
                        ],
                        frameflow_widget_select_control(
                            'stack_direction',
                            esc_html__('Exit Direction', 'frameflow'),
                            [
                                'up' => esc_html__('Up', 'frameflow'),
                                'down' => esc_html__('Down', 'frameflow'),
                            ],
                            ['default' => 'down'],
                        ),
                        [
                            'name' => 'pause_on_hover',
                            'label' => esc_html__('Pause on Hover', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'yes',
                        ],
                    ],
                ],
                [
                    'name' => 'section_style',
                    'label' => esc_html__('Style', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => [
                        [
                            'name' => 'card_height',
                            'label' => esc_html__('Card Height', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 160,
                                    'max' => 800,
                                ],
                            ],
                            'default' => [
                                'size' => 420,
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-image-stack' =>
                                    '--pxl-stack-height: {{SIZE}}{{UNIT}};',
                            ],
                        ],
                        [
                            'name' => 'stack_gap',
                            'label' => esc_html__('Stack Gap', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 8,
                                    'max' => 80,
                                ],
                            ],
                            'default' => [
                                'size' => 30,
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-image-stack' =>
                                    '--pxl-stack-gap: {{SIZE}}{{UNIT}};',
                            ],
                        ],
                        frameflow_widget_dimensions_control(
                            'card_radius',
                            esc_html__('Border Radius', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-image-stack__card' =>
                                    'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-image-stack__media' =>
                                    'border-radius: calc({{TOP}}{{UNIT}} - 4px) calc({{RIGHT}}{{UNIT}} - 4px) calc({{BOTTOM}}{{UNIT}} - 4px) calc({{LEFT}}{{UNIT}} - 4px);',
                            ],
                            [
                                'default' => [
                                    'top' => '12',
                                    'right' => '12',
                                    'bottom' => '12',
                                    'left' => '12',
                                    'unit' => 'px',
                                    'isLinked' => true,
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
