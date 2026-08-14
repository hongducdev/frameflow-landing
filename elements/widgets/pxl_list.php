<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_list',
        'title' => esc_html__('Case List', 'frameflow'),
        'icon' => 'eicon-editor-list-ul icon-brand-elementor',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'lists',
                            'label' => esc_html__('Content', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                frameflow_widget_text_control(
                                    'label',
                                    esc_html__('Label', 'frameflow'),
                                    [
                                        'rows' => 10,
                                        'show_label' => false,
                                    ]
                                ),
                                frameflow_widget_wysiwyg_control(
                                    'content',
                                    esc_html__('Content', 'frameflow'),
                                ),
                            ),
                            'title_field' => '{{{ content }}}',
                        ),
                        frameflow_widget_icons_control(
                            'pxl_icon',
                            esc_html__('Icon', 'frameflow'),
                            [
                                'condition' => [
                                    'style!' => ['default', 'style-2'],
                                ],
                            ]
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style',
                    'label' => esc_html__('Style', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_select_control(
                            'style',
                            esc_html__('Style', 'frameflow'),
                            [
                                'default' => esc_html__('Default', 'frameflow'),
                                'style-2' => esc_html__('Style 2', 'frameflow'),
                                'style-3' => esc_html__('Style 3', 'frameflow'),
                                'style-4' => esc_html__('Style 4', 'frameflow'),
                                'style-5' => esc_html__('Style 5', 'frameflow'),
                                'style-6' => esc_html__('Style 6', 'frameflow'),
                                'style-7' => esc_html__('Style 7', 'frameflow'),
                            ],
                            ['default' => 'default']
                        ),
                        frameflow_widget_select_control(
                            'sub_style',
                            esc_html__('Sub Style', 'frameflow'),
                            [
                                'sub_style_1' => esc_html__('Sub Style 1', 'frameflow'),
                                'sub_style_2' => esc_html__('Sub Style 2', 'frameflow'),
                            ],
                            [
                                'default' => 'sub_style_1',
                                'condition' => [
                                    'style' => 'default',
                                ],
                            ]
                        ),
                        frameflow_widget_select_control(
                            'sub_style_3',
                            esc_html__('Sub Style', 'frameflow'),
                            [
                                'sub_style_3_1' => esc_html__('Sub Style 1', 'frameflow'),
                                'sub_style_3_2' => esc_html__('Sub Style 2', 'frameflow'),
                                'sub_style_3_3' => esc_html__('Sub Style 3', 'frameflow'),
                            ],
                            [
                                'default' => 'sub_style_3_1',
                                'condition' => [
                                    'style' => 'style-3',
                                ],
                            ]
                        ),
                        frameflow_widget_select_control(
                            'sub_style_6',
                            esc_html__('Sub Style', 'frameflow'),
                            [
                                'sub_style_6_1' => esc_html__('Sub Style 1', 'frameflow'),
                                'sub_style_6_2' => esc_html__('Sub Style 2', 'frameflow'),
                            ],
                            [
                                'default' => 'sub_style_6_1',
                                'condition' => [
                                    'style' => 'style-6',
                                ],
                            ]
                        ),
                        array(
                            'name' => 'max_width',
                            'label' => esc_html__('Max Width', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 3000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-list' => 'max-width: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'style' => ['style-4', 'style-6'],
                            ],
                        ),
                        array(
                            'name' => 'item_spacer',
                            'label' => esc_html__('Item Spacer', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 3000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-list' => 'gap: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'spacer',
                            'label' => esc_html__('Spacer', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 3000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-list .pxl-item' => 'gap: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        frameflow_widget_color_control(
                            'border_color',
                            esc_html__('Border Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-list .pxl-item + .pxl-item' => 'border-top-color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-list .pxl-item + .pxl-item:after' => 'background: {{VALUE}};',
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
                            'default' => 'center',
                            'selectors'         => [
                                '{{WRAPPER}} .pxl-list' => 'justify-content: {{VALUE}}',
                            ],
                        ),
                        array(
                            'name' => 'item_padding',
                            'label' => esc_html__('Item Padding', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => ['px'],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-list .pxl-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'border_radius_item',
                            'label' => esc_html__('Border Radius Item', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => ['px'],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-list .pxl-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'condition' => [
                                'style' => 'style-6',
                            ],
                        ),
                        array(
                            'name' => 'height_item',
                            'label' => esc_html__('Height Item', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 3000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-list .pxl-item' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'style' => 'style-6',
                            ],
                        ),
                        frameflow_widget_color_control(
                            'background_color_item',
                            esc_html__('Background Color Item', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-list .pxl-item' => 'background-color: {{VALUE}};',
                            ],
                            [
                                'condition' => [
                                    'style' => 'style-6',
                                ],
                            ]
                        ),
                        frameflow_widget_color_control(
                            'background_color_item_hover',
                            esc_html__('Background Color Item Hover', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-list .pxl-item:hover' => 'background-color: {{VALUE}};',
                            ]
                        ),
                        array(
                            'name' => 'label_margin',
                            'label' => esc_html__('Label Margin', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => ['px'],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-list .pxl-item label' => 'display: inline-block;margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                        frameflow_widget_color_control(
                            'label_color',
                            esc_html__('Label Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-list .pxl-item--label' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_typography_control(
                            'label_typography',
                            esc_html__('Label Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-list .pxl-item--label'
                        ),
                        frameflow_widget_color_control(
                            'content_color',
                            esc_html__('Content Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-list .pxl-item--content-text' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'content_color_hover',
                            esc_html__('Content Color Hover', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-list .pxl-item:hover .pxl-item--content-text' => 'color: {{VALUE}};',
                            ],
                            [
                                'condition' => [
                                    'style' => 'style-6',
                                ],
                            ]
                        ),
                        frameflow_widget_typography_control(
                            'content_typography',
                            esc_html__('Content Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-list .pxl-item--content-text'
                        ),
                        frameflow_widget_typography_control(
                            'content_typography_strong',
                            esc_html__('Content Typography Strong', 'frameflow'),
                            '{{WRAPPER}} .pxl-list .pxl-item--content-text strong'
                        ),
                        frameflow_widget_color_control(
                            'content_color_strong',
                            esc_html__('Content Color Strong', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-list .pxl-item--content-text strong' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'icon_color',
                            esc_html__('Icon Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-list .pxl-item--icon' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-list .pxl-item--icon svg path' => 'fill: {{VALUE}};',
                                '{{WRAPPER}} .pxl-list .pxl-item:before' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-list .pxl-item--dot:before' => 'background-color: {{VALUE}};',
                            ]
                        ),
                        array(
                            'name' => 'icon_margin',
                            'label' => esc_html__('Icon Margin', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => ['px'],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-list .pxl-item--icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                            'condition' => [
                                'style!' => ['default', 'style-2'],
                            ],
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
                                    'max' => 3000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-list .pxl-item--icon' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-list .pxl-item--icon svg ' => 'width: {{SIZE}}{{UNIT}} !important;',
                            ],
                            'condition' => [
                                'style!' => ['default', 'style-2'],
                            ],
                        ),
                        frameflow_widget_color_control(
                            'bg_color_box_icon',
                            esc_html__('Background Color Box Icon', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-list .pxl-item--icon' => 'background-color: {{VALUE}};',
                            ],
                            [
                                'condition' => [
                                    'style' => 'style-3',
                                ],
                            ]
                        ),
                        array(
                            'name' => 'width_box_icon',
                            'label' => esc_html__('Width Box Icon', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 3000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-list .pxl-item--icon' => '--width-box-icon: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-list .pxl-item--dot' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'style' => ['style-3', 'style-5'],
                            ],
                        )
                    ),
                ),
                frameflow_widget_animation_settings(),
            ),
        ),
    ),
    frameflow_get_class_widget_path()
);
