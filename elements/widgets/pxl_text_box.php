<?php
// Register Text Box Widget
pxl_add_custom_widget(
    array(
        'name' => 'pxl_text_box',
        'title' => esc_html__('Case Text Box', 'frameflow'),
        'icon' => 'eicon-text-area icon-brand-elementor',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_layout',
                    'label' => esc_html__('Layout', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
                    'controls' => array(
                        array(
                            'name' => 'layout',
                            'label' => esc_html__('Templates', 'frameflow'),
                            'type' => 'layoutcontrol',
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__('Layout 1', 'frameflow'),
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_text_box/layout1.webp',
                                ],
                                '2' => [
                                    'label' => esc_html__('Layout 2', 'frameflow'),
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_text_box/layout2.webp',
                                ],
                                '3' => [
                                    'label' => esc_html__('Layout 3', 'frameflow'),
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_text_box/layout3.webp',
                                ],
                                '4' => [
                                    'label' => esc_html__('Layout 4', 'frameflow'),
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_text_box/layout4.webp',
                                ],
                                '5' => [
                                    'label' => esc_html__('Layout 5', 'frameflow'),
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_text_box/layout5.webp',
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        frameflow_widget_text_control(
                            'sub_title',
                            esc_html__('Sub Title', 'frameflow'),
                            ['label_block' => true]
                        ),
                        frameflow_widget_text_control(
                            'title',
                            esc_html__('Title', 'frameflow'),
                            ['label_block' => true]
                        ),
                        frameflow_widget_textarea_control(
                            'description',
                            esc_html__('Description', 'frameflow'),
                            ['label_block' => true],
                            ['condition' => [
                                'layout' => '4',
                            ]]
                        ),
                        array(
                            'name' => 'list_items',
                            'label' => esc_html__('List Items', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => [
                                frameflow_widget_text_control(
                                    'item_title',
                                    esc_html__('Title', 'frameflow'),
                                    ['label_block' => true]
                                ),
                            ],
                            
                            'condition' => [
                                'layout' => '4',
                            ]
                        ),
                        frameflow_widget_text_control(
                            'button_text',
                            esc_html__('Button Text', 'frameflow'),
                            [
                                'label_block' => true,
                                'condition' => [
                                    'layout' => '1',
                                ],
                            ]
                        ),
                        frameflow_widget_url_control(
                            'link',
                            esc_html__('Link', 'frameflow'),
                            [
                                'condition' => [
                                    'layout!' => '3',
                                ],
                            ]
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_general',
                    'label' => esc_html__('General', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'padding_item',
                            'label' => esc_html__('Padding', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%', 'em'],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-text-box .pxl-item--content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                        ),
                        array(
                            'name' => 'border_radius_item',
                            'label' => esc_html__('Border Radius', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%', 'em'],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-text-box .pxl-item--content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                        ),
                        array(
                            'name' => 'box_shadow_item',
                            'label' => esc_html__('Box Shadow', 'frameflow'),
                            'type' => \Elementor\Group_Control_Box_Shadow::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-text-box .pxl-item--content',
                            'condition' => [
                                'layout' => '2',
                            ],
                        ),
                        frameflow_widget_color_control(
                            'border_color',
                            esc_html__('Border Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-box .pxl-item--content:before' => 'border-color: {{VALUE}};',
                            ],
                            [
                                'condition' => [
                                    'layout' => '2',
                                ],
                            ]
                        ),
                        frameflow_widget_color_control(
                            'gradient_color_from_2',
                            esc_html__('Gradient Color From', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-box .pxl-item--content:before' => '--gradient-color-from: {{VALUE}};',
                            ],
                            [
                                'condition' => [
                                    'layout' => '2',
                                ],
                            ]
                        ),
                        frameflow_widget_color_control(
                            'gradient_color_to_2',
                            esc_html__('Gradient Color To', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-box .pxl-item--content:before' => '--gradient-color-to: {{VALUE}};',
                            ]
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_subtitle',
                    'label' => esc_html__('Sub Title', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_color_control(
                            'sub_title_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-box .pxl-item--sub-title' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_typography_control(
                            'sub_title_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-text-box .pxl-item--sub-title'
                        ),
                        frameflow_widget_dimensions_control(
                            'sub_title_margin',
                            esc_html__('Margin', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-box .pxl-item--sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ]
                        )
                    ),
                ),
                array(
                    'name' => 'section_style_title',
                    'label' => esc_html__('Title', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_title_tag_control('title_tag', esc_html__('HTML Tag', 'frameflow'), 'h3'),
                        frameflow_widget_color_control(
                            'title_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-box .pxl-item--title' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_typography_control(
                            'title_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-text-box .pxl-item--title'
                        ),
                        frameflow_widget_dimensions_control(
                            'title_margin',
                            esc_html__('Margin', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-box .pxl-item--title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ]
                        ),
                        frameflow_widget_dimensions_control(
                            'title_padding',
                            esc_html__('Padding', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-box .pxl-item--title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ]
                        ),
                        frameflow_widget_slider_control(
                            'title_max_width',
                            esc_html__('Max Width', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-box .pxl-item--title' => 'max-width: {{SIZE}}{{UNIT}};',
                            ]
                        )
                    ),
                ),
                array(
                    'name' => 'section_style_divider',
                    'label' => esc_html__('Divider', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'layout' => '3',
                    ],
                    'controls' => array(
                        frameflow_widget_color_control(
                            'divider_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-box .pxl-item--divider' => 'background-color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'divider_color_hover',
                            esc_html__('Color Hover', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-box:hover .pxl-item--divider:before' => 'background-color: {{VALUE}};',
                            ]
                        )
                    ),
                ),
                array(
                    'name' => 'section_style_description',
                    'label' => esc_html__('Description', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'layout' => ['4', '5'],
                    ],
                    'controls' => array(
                        frameflow_widget_color_control(
                            'description_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-box .pxl-item--description' => 'color: {{VALUE}};',
                            ],
                        ),
                        frameflow_widget_typography_control(
                            'description_typography', 
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-text-box .pxl-item--description'
                        ),
                        frameflow_widget_dimensions_control(
                            'description_margin',
                            esc_html__('Margin', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-box .pxl-item--description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ]
                        ),
                        frameflow_widget_slider_control(
                            'description_max_width',
                            esc_html__('Max Width', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-box .pxl-item--description' => 'max-width: {{SIZE}}{{UNIT}};',
                            ]
                        )
                    )
                ),
                array(
                    'name' => 'section_style_list',
                    'label' => esc_html__('List', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'layout' => '4',
                    ],
                    'controls' => array(
                        frameflow_widget_color_control(
                            'list_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-box .pxl-item--list-item' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_typography_control(
                            'list_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-text-box .pxl-item--list-item'
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_button',
                    'label' => esc_html__('Button', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_typography_control(
                            'button_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-text-box .pxl-item--button',
                            [
                                'condition' => [
                                    'layout' => '1',
                                ],
                            ]
                        ),
                        array(
                            'name' => 'button_border_radius',
                            'label' => esc_html__('Border Radius', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%', 'em'],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-text-box .pxl-item--button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'button_style_tabs',
                            'control_type' => 'tab',
                            'tabs' => [
                                [
                                    'name' => 'tab_button_normal',
                                    'label' => esc_html__('Normal', 'frameflow'),
                                    'controls' => [
                                        frameflow_widget_color_control(
                                            'button_color',
                                            esc_html__('Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-text-box .pxl-item--button' => 'color: {{VALUE}};',
                                            ],
                                            [
                                                'condition' => [
                                                    'layout' => '1',
                                                ],
                                            ]
                                        ),
                                        frameflow_widget_color_control(
                                            'button_bg_color',
                                            esc_html__('Background Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-text-box .pxl-item--button' => 'background-color: {{VALUE}};',
                                            ]
                                        ),
                                        frameflow_widget_color_control(
                                            'button_plus_color',
                                            esc_html__('Plus Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-text-box .pxl-item--button span:before, {{WRAPPER}} .pxl-text-box .pxl-item--button span:after' => 'background-color: {{VALUE}};',
                                            ]
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'tab_button_hover',
                                    'label' => esc_html__('Hover', 'frameflow'),
                                    'controls' => [
                                        frameflow_widget_color_control(
                                            'button_hover_color',
                                            esc_html__('Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-text-box .pxl-item--button:hover' => 'color: {{VALUE}};',
                                            ],
                                            [
                                                'condition' => [
                                                    'layout' => '1',
                                                ],
                                            ]
                                        ),
                                    ],
                                ],
                            ],
                        ),
                    ),
                ),
                frameflow_widget_animation_settings(),
            ),
        ),
    ),
    frameflow_get_class_widget_path()
);
