<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_icon_search',
        'title' => esc_html__('Case Search', 'frameflow'),
        'icon' => 'eicon-search icon-brand-elementor',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        frameflow_widget_select_control(
                            'search_type',
                            esc_html__('Search Type', 'frameflow'),
                            [
                                'popup' => 'Popup',
                                'form' => 'Form',
                            ],
                            ['default' => 'popup']
                        ),
                        frameflow_widget_text_control(
                            'email_placefolder',
                            esc_html__('Email Placefolder', 'frameflow'),
                            [
                                'label_block' => true,
                                'condition' => [
                                    'search_type' => ['form'],
                                ],
                            ]
                        ),
                        frameflow_widget_select_control(
                            'icon_image_type',
                            esc_html__('Icon Image Type', 'frameflow'),
                            [
                                'img' => 'Image',
                                'ic' => 'Icon',
                            ],
                            ['default' => 'img']
                        ),
                        frameflow_widget_icons_control(
                            'pxl_icon',
                            esc_html__('Icon', 'frameflow'),
                            [
                                'condition' => [
                                    'search_type' => ['popup'],
                                    'icon_image_type' => ['ic'],
                                ],
                            ]
                        ),
                        frameflow_widget_media_control(
                            'image',
                            esc_html__('Icon Image', 'frameflow'),
                            [
                                'condition' => [
                                    'search_type' => ['popup'],
                                    'icon_image_type' => ['img'],
                                ],
                            ]
                        ),
                        array_merge(
                            frameflow_widget_control_tabs('icon_style_tabs', [
                                [
                                    'name' => 'tab_icon_normal',
                                    'label' => esc_html__('Normal', 'frameflow'),
                                    'controls' => [
                                        frameflow_widget_color_control(
                                            'icon_color',
                                            esc_html__('Icon Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-search-popup-button i' => 'color: {{VALUE}} !important;',
                                                '{{WRAPPER}} .pxl-search-popup-button svg path' => 'stroke: {{VALUE}} !important;',
                                                '{{WRAPPER}} .pxl-search-popup-button svg ' => 'fill: {{VALUE}} !important;',
                                            ]
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'tab_icon_hover',
                                    'label' => esc_html__('Hover', 'frameflow'),
                                    'controls' => [
                                        frameflow_widget_color_control(
                                            'icon_color_hover',
                                            esc_html__('Icon Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-search-popup-button:hover i' => 'color: {{VALUE}} !important;',
                                                '{{WRAPPER}} .pxl-search-popup-button:hover svg path' => 'stroke: {{VALUE}} !important;',
                                                '{{WRAPPER}} .pxl-search-popup-button:hover svg ' => 'fill: {{VALUE}} !important;',
                                            ]
                                        ),
                                    ],
                                ],
                            ]),
                            [
                                'condition' => [
                                    'search_type' => ['popup'],
                                ],
                            ]
                        ),
                        frameflow_widget_color_control(
                            'bd_icon_color',
                            esc_html__('Border Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-search-popup-button ' => 'border-color: {{VALUE}} !important;',
                            ],
                            [
                                'condition' => [
                                    'search_type' => ['popup'],
                                ],
                            ]
                        ),
                        array(
                            'name' => 'icon_font_size',
                            'label' => esc_html__('Icon Font Size', 'frameflow'),
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
                                '{{WRAPPER}} .pxl-search-popup-button' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-search-popup-button svg' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'search_type' => ['popup'],
                            ],
                        ),
                        frameflow_widget_select_control(
                            'style',
                            esc_html__('Style', 'frameflow'),
                            [
                                'style-default' => 'Default',
                                'style-box' => 'Box',
                                'style-box-bd' => 'Box Border',
                            ],
                            [
                                'default' => 'style-default',
                                'condition' => [
                                    'search_type' => ['popup'],
                                ],
                            ]
                        ),
                        array_merge(
                            frameflow_widget_control_tabs('box_style_tabs', [
                                [
                                    'name' => 'tab_box_normal',
                                    'label' => esc_html__('Normal', 'frameflow'),
                                    'controls' => [
                                        frameflow_widget_color_control(
                                            'box_color',
                                            esc_html__('Box Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-search-popup-button.style-box' => 'background-color: {{VALUE}};',
                                                '{{WRAPPER}} .pxl-search-popup-button.style-box-bd' => 'background-color: {{VALUE}};',
                                            ]
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'tab_box_hover',
                                    'label' => esc_html__('Hover', 'frameflow'),
                                    'controls' => [
                                        frameflow_widget_color_control(
                                            'box_color_hv',
                                            esc_html__('Box Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-search-popup-button.style-box:hover' => 'background-color: {{VALUE}};border-color: {{VALUE}} !important;',
                                                '{{WRAPPER}} .pxl-search-popup-button.style-box-bd:hover' => 'background-color: {{VALUE}};border-color: {{VALUE}} !important;',
                                            ]
                                        ),
                                    ],
                                ],
                            ]),
                            [
                                'condition' => [
                                    'style' => ['style-box', 'style-box-bd'],
                                    'search_type' => ['popup'],
                                ],
                            ]
                        ),
                        array(
                            'name' => 'box_height',
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
                                '{{WRAPPER}} .pxl-search-popup-button.style-box' => 'height: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-search-popup-button.style-box-bd' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'style' => ['style-box', 'style-box-bd'],
                                'search_type' => ['popup'],
                            ],
                        ),
                        array(
                            'name' => 'box_width',
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
                                '{{WRAPPER}} .pxl-search-popup-button.style-box' => 'width: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-search-popup-button.style-box-bd' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'style' => ['style-box', 'style-box-bd'],
                                'search_type' => ['popup'],
                            ],
                        ),
                        array(
                            'name' => 'border_radius',
                            'label' => esc_html__('Border Radius', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => ['px'],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-search-popup-button.style-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-search-popup-button.style-box-bd' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'condition' => [
                                'style' => ['style-box', 'style-box-bd'],
                                'search_type' => ['popup'],
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    frameflow_get_class_widget_path()
);
