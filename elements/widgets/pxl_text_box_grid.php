<?php
// Register Text Box Grid Widget
pxl_add_custom_widget(
    array(
        'name' => 'pxl_text_box_grid',
        'title' => esc_html__('Case Text Box Grid', 'frameflow'),
        'icon' => 'eicon-posts-grid icon-brand-elementor',
        'categories' => array('pxltheme-core'),
        'scripts' => array(
            'frameflow-text-box-grid',
        ),
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
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'items',
                            'label' => esc_html__('Items', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'default' => array(
                                array(
                                    'item_title' => esc_html__('Low Activation and Onboarding Drop', 'frameflow'),
                                    'item_description' => esc_html__('Users sign up, but struggle to reach real value from onboarding.', 'frameflow'),
                                ),
                                array(
                                    'item_title' => esc_html__('High Churn and Weak Retention', 'frameflow'),
                                    'item_description' => esc_html__('Users try the product but do not stay engaged, leading to inconsistent retention.', 'frameflow'),
                                ),
                                array(
                                    'item_title' => esc_html__('Rising CAC and Unscalable Channels', 'frameflow'),
                                    'item_description' => esc_html__('Acquisition costs increase while growth channels fail to deliver consistent results.', 'frameflow'),
                                ),
                                array(
                                    'item_title' => esc_html__('Unclear Positioning and Slow GTM', 'frameflow'),
                                    'item_description' => esc_html__('Your messaging lacks clarity, making it harder to stand out and scale effectively.', 'frameflow'),
                                ),
                            ),
                            'controls' => array(
                                frameflow_widget_text_control(
                                    'item_title',
                                    esc_html__('Title', 'frameflow'),
                                    ['label_block' => true]
                                ),
                                frameflow_widget_textarea_control(
                                    'item_description',
                                    esc_html__('Description', 'frameflow'),
                                    [
                                        'rows' => 5,
                                        'label_block' => true,
                                    ]
                                ),
                            ),
                            'title_field' => '{{{ item_title }}}',
                        ),
                    ),
                ),
                array(
                    'name' => 'section_settings',
                    'label' => esc_html__('Settings', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'controls' => array_merge(
                        [
                            frameflow_widget_title_tag_control('title_tag', esc_html__('Title HTML Tag', 'frameflow'), 'h3'),
                        ],
                        frameflow_widget_responsive_columns_controls(
                            [
                                'xs'  => '1',
                                'sm'  => '2',
                                'md'  => '2',
                                'lg'  => '3',
                                'xl'  => '4',
                                'xxl' => '4',
                            ],
                            [
                                'control_args' => [
                                    'options' => [
                                        '1' => '1',
                                        '2' => '2',
                                        '3' => '3',
                                        '4' => '4',
                                    ],
                                ],
                            ]
                        )
                    ),
                ),
                array(
                    'name' => 'section_style_general',
                    'label' => esc_html__('General', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'grid_gap',
                            'label' => esc_html__('Grid Gap', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'control_type' => 'responsive',
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 120,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-text-box-grid' => '--pxl-grid-gap: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        frameflow_widget_choose_control(
                            'text_align',
                            esc_html__('Alignment', 'frameflow'),
                            [
                                'left' => [
                                    'title' => esc_html__('Left', 'frameflow'),
                                    'icon' => 'eicon-text-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__('Center', 'frameflow'),
                                    'icon' => 'eicon-text-align-center',
                                ],
                                'right' => [
                                    'title' => esc_html__('Right', 'frameflow'),
                                    'icon' => 'eicon-text-align-right',
                                ],
                            ],
                            [
                                'default' => 'center',
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-text-box-grid .pxl-item--inner' => 'text-align: {{VALUE}};',
                                ],
                            ]
                        ),
                        array(
                            'name' => 'item_padding',
                            'label' => esc_html__('Item Padding', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%', 'em'],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-text-box-grid .pxl-item--inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                        ),
                        array(
                            'name' => 'item_border_radius',
                            'label' => esc_html__('Item Border Radius', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%', 'em'],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-text-box-grid .pxl-item--inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                        ),
                        frameflow_widget_color_control(
                            'item_bg_color',
                            esc_html__('Item Background Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-box-grid .pxl-item--inner' => 'background-color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'item_bg_color_hover',
                            esc_html__('Item Background Hover', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-box-grid .pxl-item--inner:hover' => 'background-color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'item_border_color_hover',
                            esc_html__('Item Border Hover', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-box-grid .pxl-item--inner:hover' => 'border-color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'item_border_color',
                            esc_html__('Item Border Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-box-grid .pxl-item--inner' => 'border-color: {{VALUE}};',
                            ]
                        ),
                        array(
                            'name' => 'item_box_shadow',
                            'label' => esc_html__('Item Box Shadow', 'frameflow'),
                            'type' => \Elementor\Group_Control_Box_Shadow::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-text-box-grid .pxl-item--inner',
                        ),
                        frameflow_widget_color_control(
                            'connector_color',
                            esc_html__('Connector Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-box-grid' => '--pxl-connector-color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'particle_color',
                            esc_html__('Particle Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-box-grid' => '--pxl-particle-color: {{VALUE}};',
                            ]
                        ),
                        array(
                            'name' => 'line_first_vertical',
                            'label' => esc_html__('Line Vertical Top', 'frameflow'),
                            'description' => esc_html__('Length of the first vertical segment from each dot (px).', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'default' => [
                                'size' => 28,
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-text-box-grid' => '--pxl-line-first-vertical: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'line_curve_depth',
                            'label' => esc_html__('Line Curve Depth', 'frameflow'),
                            'description' => esc_html__('How deep the branch drops before going horizontal (px). Should be greater than "Line Vertical Top".', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 400,
                                ],
                            ],
                            'default' => [
                                'size' => 52,
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-text-box-grid' => '--pxl-line-curve-depth: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'line_outer_offset',
                            'label' => esc_html__('Line Horizontal Start', 'frameflow'),
                            'description' => esc_html__('Horizontal offset after leaving the dot, before the long horizontal segment (px).', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 200,
                                ],
                            ],
                            'default' => [
                                'size' => 22,
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-text-box-grid' => '--pxl-line-outer-offset: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'line_inner_offset',
                            'label' => esc_html__('Line Horizontal End', 'frameflow'),
                            'description' => esc_html__('Inset before connecting into the center trunk (px).', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 200,
                                ],
                            ],
                            'default' => [
                                'size' => 26,
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-text-box-grid' => '--pxl-line-inner-offset: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'line_trunk_bottom',
                            'label' => esc_html__('Line Vertical Bottom', 'frameflow'),
                            'description' => esc_html__('Distance from the bottom of the widget to end the center trunk (px). Larger value = shorter trunk.', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 400,
                                ],
                            ],
                            'default' => [
                                'size' => 20,
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-text-box-grid' => '--pxl-line-trunk-inset: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'canvas_space',
                            'label' => esc_html__('Canvas Space Bottom', 'frameflow'),
                            'description' => esc_html__('Extra bottom space reserved for drawing lines (px). Increase if lines get clipped.', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 400,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-text-box-grid' => '--pxl-canvas-space: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_title',
                    'label' => esc_html__('Title', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_color_control(
                            'title_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-box-grid .pxl-item--title' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_typography_control(
                            'title_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-text-box-grid .pxl-item--title'
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_description',
                    'label' => esc_html__('Description', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_color_control(
                            'description_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-box-grid .pxl-item--description' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_typography_control(
                            'description_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-text-box-grid .pxl-item--description'
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_dot',
                    'label' => esc_html__('Dot', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_color_control(
                            'dot_bg_color',
                            esc_html__('Background Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-box-grid .pxl-item--dot' => 'background-color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'dot_border_color',
                            esc_html__('Border Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-box-grid .pxl-item--dot' => 'border-color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'dot_span_color',
                            esc_html__('Dot Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-box-grid .pxl-item--dot span' => 'background-color: {{VALUE}};',
                            ]
                        ),
                    ),
                ),
                frameflow_widget_animation_settings(),
            ),
        ),
    ),
    frameflow_get_class_widget_path()
);
