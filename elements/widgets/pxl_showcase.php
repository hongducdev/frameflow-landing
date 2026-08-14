<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_showcase',
        'title' => esc_html__('Case Showcase', 'frameflow'),
        'icon' => 'eicon-parallax icon-brand-elementor',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        frameflow_widget_select_control(
                            'layout',
                            esc_html__('Icon Type', 'frameflow'),
                            [
                                '1' => 'Layout 1',
                                '2' => 'Layout 2',
                            ],
                            ['default' => '1']
                        ),
                        array(
                            'name' => 'box_padding',
                            'label' => esc_html__('Box Input', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => ['px'],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-showcase .pxl-item--inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};width:auto !important;height:auto !important;',
                            ],
                            'control_type' => 'responsive',
                        ),
                        frameflow_widget_media_control(
                            'image',
                            esc_html__('Image', 'frameflow')
                        ),
                        frameflow_widget_text_control(
                            'title',
                            esc_html__('Title', 'frameflow')
                        ),
                        frameflow_widget_typography_control(
                            'title_typography',
                            esc_html__('Title Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-showcase .pxl-item--title a',
                            [
                                'condition' => [
                                    'layout' => '1',
                                ],
                            ]
                        ),
                        array(
                            'name' => 'title_padding',
                            'label' => esc_html__('Padding Input', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => ['px'],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-showcase .pxl-item--title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};width:auto !important;height:auto !important;',
                            ],
                            'control_type' => 'responsive',
                        ),
                        frameflow_widget_typography_control(
                            'btn_typography',
                            esc_html__('Button Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-showcase .pxl-item--readmore a'
                        ),
                        array(
                            'name' => 'btn_padding',
                            'label' => esc_html__('Padding Input', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => ['px'],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-showcase .pxl-item--readmore a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};width:auto !important;height:auto !important;',
                            ],
                            'control_type' => 'responsive',
                        ),
                        frameflow_widget_text_control(
                            'btn_text',
                            esc_html__('Button Text', 'frameflow')
                        ),
                        frameflow_widget_url_control(
                            'btn_link',
                            esc_html__('Button Link', 'frameflow'),
                            ['label_block' => true]
                        ),
                        frameflow_widget_text_control(
                            'btn_text2',
                            esc_html__('Button Text 2', 'frameflow')
                        ),
                        frameflow_widget_url_control(
                            'btn_link2',
                            esc_html__('Button Link 2', 'frameflow'),
                            ['label_block' => true]
                        ),
                        array(
                            'name' => 'hot',
                            'label' => esc_html__('Show Hot', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                        ),
                        array(
                            'name' => 'new',
                            'label' => esc_html__('Show New', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                        ),
                        frameflow_widget_select_control(
                            'active',
                            esc_html__('Active', 'frameflow'),
                            [
                                '' => 'No',
                                'yes' => 'Yes',
                            ],
                            ['default' => '']
                        ),
                        frameflow_widget_text_control(
                            'active_label',
                            esc_html__('Active Label', 'frameflow'),
                            [
                                'condition' => [
                                    'active' => 'yes',
                                ],
                            ]
                        ),
                        frameflow_widget_typography_control(
                            'label_typography',
                            esc_html__('Label Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-showcase .pxl-item--label'
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style',
                    'label' => esc_html__('Style', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array_merge(
                        array(
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
                                        '{{WRAPPER}} .pxl-showcase1 .pxl-item--inner' => 'border-style: {{VALUE}} !important;',
                                    ],
                                ]
                            ),
                            array(
                                'name' => 'border_width',
                                'label' => esc_html__('Border Width', 'frameflow'),
                                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-showcase1 .pxl-item--inner' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                                ],
                                'condition' => [
                                    'border_type!' => '',
                                ],
                                'responsive' => true,
                            ),
                            frameflow_widget_color_control(
                                'border_color',
                                esc_html__('Border Color', 'frameflow'),
                                [
                                    '{{WRAPPER}} .pxl-showcase1 .pxl-item--inner' => 'border-color: {{VALUE}} !important;',
                                ],
                                [
                                    'default' => '',
                                    'condition' => [
                                        'border_type!' => '',
                                    ],
                                ]
                            ),

                            array(
                                'name' => 'image_max_height',
                                'label' => esc_html__('Image Max Height', 'frameflow'),
                                'type' => \Elementor\Controls_Manager::SLIDER,
                                'description' => esc_html__('Enter number.', 'frameflow'),
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 3000,
                                    ],
                                ],
                                'control_type' => 'responsive',
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-showcase1 .pxl-item--image img' => 'height: {{SIZE}}{{UNIT}};',
                                ],
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    frameflow_get_class_widget_path()
);
