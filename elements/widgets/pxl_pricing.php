<?php
// Register Pricing Widget
pxl_add_custom_widget(
    array(
        'name' => 'pxl_pricing',
        'title' => esc_html__('Case Pricing', 'frameflow'),
        'icon' => 'eicon-price-table icon-brand-elementor',
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
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_pricing/layout1.webp',
                                ],
                                '2' => [
                                    'label' => esc_html__('Layout 2', 'frameflow'),
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_pricing/layout2.webp',
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
                        frameflow_widget_select_control(
                            'style_layout_1',
                            esc_html__('Style', 'frameflow'),
                            [
                                'style-1-1' => esc_html__('Style 1', 'frameflow'),
                                'style-1-2' => esc_html__('Style 2', 'frameflow'),
                            ],
                            [
                                'default' => 'style-1-1',
                                'condition' => [
                                    'layout' => '1',
                                ],
                            ]
                        ),
                        array(
                            'name' => 'featured',
                            'label' => esc_html__('Featured', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'label_on' => esc_html__('Yes', 'frameflow'),
                            'label_off' => esc_html__('No', 'frameflow'),
                            'return_value' => 'yes',
                            'default' => '',
                        ),
                        array(
                            'name' => 'is_popular',
                            'label' => esc_html__('Popular / Active', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'label_on' => esc_html__('Yes', 'frameflow'),
                            'label_off' => esc_html__('No', 'frameflow'),
                            'return_value' => 'yes',
                            'default' => '',
                        ),
                        frameflow_widget_text_control(
                            'badge_text',
                            esc_html__('Badge Text', 'frameflow'),
                            [
                                'default' => esc_html__('Popular', 'frameflow'),
                                'separator' => 'before',
                            ]
                        ),
                        frameflow_widget_icons_control(
                            'pxl_icon',
                            esc_html__('Icon', 'frameflow'),
                            [
                                'condition' => [
                                    'layout' => '1',
                                ],
                            ]
                        ),
                        frameflow_widget_text_control(
                            'title',
                            esc_html__('Plan Name', 'frameflow'),
                            [
                                'default' => esc_html__('Starter', 'frameflow'),
                                'label_block' => true,
                            ]
                        ),
                        frameflow_widget_textarea_control(
                            'description',
                            esc_html__('Description', 'frameflow'),
                            [
                                'rows' => 4,
                                'default' => '',
                                'separator' => 'after',
                            ]
                        ),
                        frameflow_widget_text_control(
                            'price',
                            esc_html__('Price', 'frameflow'),
                            ['default' => '$49']
                        ),
                        frameflow_widget_text_control(
                            'period',
                            esc_html__('Period', 'frameflow'),
                            [
                                'default' => esc_html__('/month', 'frameflow'),
                                'separator' => 'after',
                            ]
                        ),
                        array(
                            'name' => 'features',
                            'label' => esc_html__('Features', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                frameflow_widget_icons_control(
                                    'feature_icon',
                                    esc_html__('Icon', 'frameflow')
                                ),
                                frameflow_widget_text_control(
                                    'feature_text',
                                    esc_html__('Feature Text', 'frameflow'),
                                    [
                                        'default' => esc_html__('Feature item', 'frameflow'),
                                        'label_block' => true,
                                    ]
                                ),
                                array(
                                    'name' => 'feature_active',
                                    'label' => esc_html__('Included', 'frameflow'),
                                    'type' => \Elementor\Controls_Manager::SWITCHER,
                                    'label_on' => esc_html__('Yes', 'frameflow'),
                                    'label_off' => esc_html__('No', 'frameflow'),
                                    'return_value' => 'yes',
                                    'default' => 'yes',
                                ),
                            ),
                            'title_field' => '{{{ feature_text }}}',
                        ),
                        frameflow_widget_text_control(
                            'btn_text',
                            esc_html__('Button Text', 'frameflow'),
                            [
                                'default' => esc_html__('Get Started', 'frameflow'),
                                'separator' => 'before',
                            ]
                        ),
                        frameflow_widget_url_control(
                            'btn_link',
                            esc_html__('Button Link', 'frameflow'),
                            [
                                'placeholder' => esc_html__('https://your-link.com', 'frameflow'),
                            ]
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_general',
                    'label' => esc_html__('General', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_color_control(
                            'pricing_gradient_from',
                            esc_html__('Gradient From', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-pricing' => '--pricing-gradient-from: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'pricing_gradient_to',
                            esc_html__('Gradient To', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-pricing' => '--pricing-gradient-to: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'box_border_color',
                            esc_html__('Border Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-pricing' => 'border-color: {{VALUE}};',
                            ]
                        ),
                        array(
                            'name' => 'box_padding',
                            'label' => esc_html__('Padding', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => ['px'],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-pricing' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                        ),
                        array(
                            'name' => 'box_border_radius',
                            'label' => esc_html__('Border Radius', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => ['px'],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-pricing' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                            ],
                            'control_type' => 'responsive',
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_icon',
                    'label' => esc_html__('Icon', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_color_control(
                            'icon_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-pricing .pxl-item--icon i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-pricing .pxl-item--icon svg path' => 'fill: {{VALUE}};',
                            ]
                        ),
                        array(
                            'name' => 'icon_box_size',
                            'label' => esc_html__('Icon Box Size', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => ['px' => ['min' => 0, 'max' => 200]],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-pricing .pxl-item--icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'icon_box_border_radius',
                            'label' => esc_html__('Icon Box Border Radius', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => ['px'],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-pricing .pxl-item--icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                        ),
                        frameflow_widget_color_control(
                            'icon_box_background_color',
                            esc_html__('Icon Box Background Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-pricing .pxl-item--icon' => 'background-color: {{VALUE}};',
                            ]
                        ),
                        array(
                            'name' => 'icon_box_shadow',
                            'label' => esc_html__('Icon Box Shadow', 'frameflow'),
                            'type' => \Elementor\Group_Control_Box_Shadow::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-pricing .pxl-item--icon',
                        ),
                        array(
                            'name' => 'icon_box_border',
                            'label' => esc_html__('Icon Box Border', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => ['px'],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-pricing .pxl-item--icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                        ),
                        frameflow_widget_color_control(
                            'icon_box_border_color',
                            esc_html__('Icon Box Border Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-pricing .pxl-item--icon' => 'border-color: {{VALUE}};',
                            ]
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_badge',
                    'label' => esc_html__('Badge', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_control_tabs('badge_background_tabs', [
                            [
                                'name' => 'tab_badge_background_normal',
                                'label' => esc_html__('Normal', 'frameflow'),
                                'controls' => [
                                    array(
                                        'name'         => 'select_badge_background',
                                        'label'        => esc_html__('Background', 'frameflow'),
                                        'type'         => \Elementor\Group_Control_Background::get_type(),
                                        'control_type' => 'group',
                                        'types'        => ['classic', 'gradient'],
                                        'selector'     => '{{WRAPPER}} .pxl-pricing .pxl-item--badge',
                                    ),
                                ],
                            ],
                            [
                                'name' => 'tab_badge_background_hover',
                                'label' => esc_html__('Hover', 'frameflow'),
                                'controls' => [
                                    array(
                                        'name'         => 'select_badge_background_hover',
                                        'label'        => esc_html__('Background', 'frameflow'),
                                        'type'         => \Elementor\Group_Control_Background::get_type(),
                                        'control_type' => 'group',
                                        'types'        => ['classic', 'gradient'],
                                        'selector'     => '{{WRAPPER}} .pxl-pricing .pxl-item--badge',
                                    ),
                                ],
                            ],
                        ]),
                        frameflow_widget_color_control(
                            'badge_after_background',
                            esc_html__('After Background Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-pricing .pxl-item--badge:after' => 'border-bottom-color: {{VALUE}};',
                            ],
                            [
                                'condition' => [
                                    'layout' => '1',
                                    'style_layout_1' => 'style-1-2',
                                ],
                            ]
                        ),
                        frameflow_widget_dimensions_control(
                            'badge_border_radius',
                            esc_html__('Border Radius', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-pricing .pxl-item--badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'badge_shadow_color',
                            esc_html__('Shadow Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-pricing .pxl-item--badge' => '--badge-shadow-color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'badge_text_color',
                            esc_html__('Text Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-pricing .pxl-item--badge' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_typography_control(
                            'badge_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-pricing .pxl-item--badge'
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_price',
                    'label' => esc_html__('Price', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_color_control(
                            'price_color',
                            esc_html__('Price Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-pricing .pxl-item--price' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_typography_control(
                            'price_typography',
                            esc_html__('Price Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-pricing .pxl-item--price'
                        ),
                        frameflow_widget_color_control(
                            'period_color',
                            esc_html__('Period Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-pricing .pxl-item--period' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_typography_control(
                            'period_typography',
                            esc_html__('Period Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-pricing .pxl-item--period'
                        ),
                        array(
                            'name' => 'price_top_spacer',
                            'label' => esc_html__('Top Spacer', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => ['px' => ['min' => 0, 'max' => 200]],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-pricing .pxl-item--price-wrap' => 'margin-top: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'price_bottom_spacer',
                            'label' => esc_html__('Bottom Spacer', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => ['px' => ['min' => 0, 'max' => 200]],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-pricing .pxl-item--price-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_title',
                    'label' => esc_html__('Title', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_title_tag_control('title_tag', esc_html__('HTML Tag', 'frameflow'), 'h5'),
                        frameflow_widget_color_control(
                            'title_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-pricing .pxl-item--title' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_typography_control(
                            'title_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-pricing .pxl-item--title'
                        ),
                        array(
                            'name' => 'title_top_spacer',
                            'label' => esc_html__('Top Spacer', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => ['px' => ['min' => 0, 'max' => 300]],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-pricing .pxl-item--title' => 'margin-top: {{SIZE}}{{UNIT}} !important;',
                            ],
                        ),
                        array(
                            'name' => 'title_bottom_spacer',
                            'label' => esc_html__('Bottom Spacer', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => ['px' => ['min' => 0, 'max' => 300]],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-pricing .pxl-item--title' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_desc',
                    'label' => esc_html__('Description', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_color_control(
                            'desc_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-pricing .pxl-item--description' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_typography_control(
                            'desc_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-pricing .pxl-item--description'
                        ),
                        array(
                            'name' => 'desc_bottom_spacer',
                            'label' => esc_html__('Bottom Spacer', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => ['px' => ['min' => 0, 'max' => 200]],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-pricing .pxl-item--description' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_features',
                    'label' => esc_html__('Features', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_color_control(
                            'feature_color',
                            esc_html__('Text Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-pricing .pxl-item--features li,{{WRAPPER}} .pxl-pricing .pxl-item--features li span' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'feature_inactive_color',
                            esc_html__('Inactive Text Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-pricing .pxl-item--features li.is-inactive' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'feature_icon_color',
                            esc_html__('Icon Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-pricing .pxl-item--features li .pxl-feature--icon i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-pricing .pxl-item--features li .pxl-feature--icon svg path' => 'fill: {{VALUE}};',
                            ]
                        ),
                        array(
                            'name' => 'feature_icon_size',
                            'label' => esc_html__('Icon Size', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => ['px' => ['min' => 8, 'max' => 60]],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-pricing .pxl-item--features li .pxl-feature--icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-pricing .pxl-item--features li .pxl-feature--icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        frameflow_widget_typography_control(
                            'feature_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-pricing .pxl-item--features li'
                        ),
                        array(
                            'name' => 'feature_gap',
                            'label' => esc_html__('Item Gap', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => ['px' => ['min' => 0, 'max' => 60]],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-pricing .pxl-item--features' => 'gap: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        frameflow_widget_color_control(
                            'feature_divider_color',
                            esc_html__('Divider Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-pricing .pxl-item--features li + li' => 'border-top-color: {{VALUE}};',
                            ]
                        ),
                        array(
                            'name' => 'feature_top_spacer',
                            'label' => esc_html__('Top Spacer', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => ['px' => ['min' => 0, 'max' => 200]],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-pricing .pxl-item--features' => 'margin-top: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'feature_bottom_spacer',
                            'label' => esc_html__('Bottom Spacer', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => ['px' => ['min' => 0, 'max' => 200]],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-pricing .pxl-item--features' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_btn',
                    'label' => esc_html__('Button', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_control_tabs('btn_style_tabs', [
                            [
                                'name' => 'tab_btn_normal',
                                'label' => esc_html__('Normal', 'frameflow'),
                                'controls' => [
                                    frameflow_widget_color_control(
                                        'btn_text_color',
                                        esc_html__('Text Color', 'frameflow'),
                                        [
                                            '{{WRAPPER}} .pxl-pricing .pxl-item--btn' => 'color: {{VALUE}};',
                                        ]
                                    ),
                                    frameflow_widget_color_control(
                                        'btn_bg_color',
                                        esc_html__('Background', 'frameflow'),
                                        [
                                            '{{WRAPPER}} .pxl-pricing .pxl-item--btn' => 'background-color: {{VALUE}};',
                                            '{{WRAPPER}} .pxl-pricing .pxl-item--btn:after' => 'background: linear-gradient(to right, {{VALUE}}, {{VALUE}});',
                                        ]
                                    ),
                                    frameflow_widget_color_control(
                                        'btn_border_color',
                                        esc_html__('Border Color', 'frameflow'),
                                        [
                                            '{{WRAPPER}} .pxl-pricing .pxl-item--btn' => 'border-color: {{VALUE}};',
                                        ]
                                    ),
                                ],
                            ],
                            [
                                'name' => 'tab_btn_hover',
                                'label' => esc_html__('Hover', 'frameflow'),
                                'controls' => [
                                    frameflow_widget_color_control(
                                        'btn_text_color_hover',
                                        esc_html__('Text Color', 'frameflow'),
                                        [
                                            '{{WRAPPER}} .pxl-pricing .pxl-item--btn:hover' => 'color: {{VALUE}};',
                                        ]
                                    ),
                                    frameflow_widget_color_control(
                                        'btn_bg_color_hover',
                                        esc_html__('Background', 'frameflow'),
                                        [
                                            '{{WRAPPER}} .pxl-pricing .pxl-item--btn:hover' => 'background-color: {{VALUE}};',
                                            '{{WRAPPER}} .pxl-pricing .pxl-item--btn:hover.pxl-item--btn:after' => 'background: linear-gradient(to right, {{VALUE}}, {{VALUE}});',
                                        ]
                                    ),
                                    frameflow_widget_color_control(
                                        'btn_border_color_hover',
                                        esc_html__('Border Color', 'frameflow'),
                                        [
                                            '{{WRAPPER}} .pxl-pricing .pxl-item--btn:hover' => 'border-color: {{VALUE}};',
                                        ]
                                    ),
                                ],
                            ],
                        ]),
                        frameflow_widget_typography_control(
                            'btn_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-pricing .pxl-item--btn'
                        ),
                        array(
                            'name' => 'btn_padding',
                            'label' => esc_html__('Padding', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => ['px'],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-pricing .pxl-item--btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                        ),
                        array(
                            'name' => 'btn_border_radius',
                            'label' => esc_html__('Border Radius', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => ['px'],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-pricing .pxl-item--btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                            ],
                            'control_type' => 'responsive',
                        ),
                        array(
                            'name' => 'btn_box_shadow',
                            'label' => esc_html__('Box Shadow', 'frameflow'),
                            'type' => \Elementor\Group_Control_Box_Shadow::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-pricing .pxl-item--btn',
                        ),
                        array(
                            'name' => 'btn_height',
                            'label' => esc_html__('Height', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => ['px' => ['min' => 0, 'max' => 200]],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-pricing .pxl-item--btn' => 'height: {{SIZE}}{{UNIT}} !important;',
                            ],
                        ),
                        array(
                            'name' => 'btn_top_spacer',
                            'label' => esc_html__('Top Spacer', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => ['px' => ['min' => 0, 'max' => 200]],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-pricing .pxl-item--btn' => 'margin-top: {{SIZE}}{{UNIT}} !important;',
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
