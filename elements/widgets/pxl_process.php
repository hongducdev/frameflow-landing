<?php
// Register Process Widget
pxl_add_custom_widget(
    [
        'name' => 'pxl_process',
        'title' => esc_html__('Case Process', 'frameflow'),
        'icon' => 'eicon-flow icon-brand-elementor',
        'categories' => ['pxltheme-core'],
        'scripts' => ['gsap', 'pxl-scroll-trigger', 'frameflow-process'],
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
                                    'image' =>
                                        get_template_directory_uri() .
                                        '/elements/widgets/img-layout/pxl_process/layout1.webp',
                                ],
                                '2' => [
                                    'label' => esc_html__('Layout 2', 'frameflow'),
                                    'image' =>
                                        get_template_directory_uri() .
                                        '/elements/widgets/img-layout/pxl_process/layout2.webp',
                                ],
                                '3' => [
                                    'label' => esc_html__('Layout 3', 'frameflow'),
                                    'image' =>
                                        get_template_directory_uri() .
                                        '/elements/widgets/img-layout/pxl_process/layout3.webp',
                                ],
                                '4' => [
                                    'label' => esc_html__('Layout 4', 'frameflow'),
                                    'image' =>
                                        get_template_directory_uri() .
                                        '/elements/widgets/img-layout/pxl_process/layout4.webp',
                                ],
                                '5' => [
                                    'label' => esc_html__('Layout 5', 'frameflow'),
                                    'image' =>
                                        get_template_directory_uri() .
                                        '/elements/widgets/img-layout/pxl_process/layout5.webp',
                                ],
                                '6' => [
                                    'label' => esc_html__('Layout 6', 'frameflow'),
                                    'image' =>
                                        get_template_directory_uri() .
                                        '/elements/widgets/img-layout/pxl_process/layout6.webp',
                                ],
                                '7' => [
                                    'label' => esc_html__('Layout 7', 'frameflow'),
                                    'image' =>
                                        get_template_directory_uri() .
                                        '/elements/widgets/img-layout/pxl_process/layout7.webp',
                                ],
                                '8' => [
                                    'label' => esc_html__('Layout 8', 'frameflow'),
                                    'image' =>
                                        get_template_directory_uri() .
                                        '/elements/widgets/img-layout/pxl_process/layout8.webp',
                                ],
                                '9' => [
                                    'label' => esc_html__('Layout 9', 'frameflow'),
                                    'image' =>
                                        get_template_directory_uri() .
                                        '/elements/widgets/img-layout/pxl_process/layout9.webp',
                                ],
                                '10' => [
                                    'label' => esc_html__('Layout 10', 'frameflow'),
                                    'image' =>
                                        get_template_directory_uri() .
                                        '/elements/widgets/img-layout/pxl_process/layout10.webp',
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'condition' => [
                        'layout' => ['1', '4', '5', '6', '7', '8', '10'],
                    ],
                    'controls' => [
                        [
                            'name' => 'step',
                            'label' => esc_html__('Step', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                        ],
                        frameflow_widget_text_control('title', esc_html__('Title', 'frameflow')),
                        frameflow_widget_textarea_control(
                            'description',
                            esc_html__('Description', 'frameflow'),
                            ['separator' => 'after'],
                        ),
                        [
                            'name' => 'show_divider_left',
                            'label' => esc_html__('Show Divider Left', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'condition' => [
                                'layout' => '1',
                            ],
                        ],
                        [
                            'name' => 'show_divider_right',
                            'label' => esc_html__('Show Divider Right', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'condition' => [
                                'layout' => '1',
                            ],
                        ],
                        [
                            'name' => 'show_divider_top',
                            'label' => esc_html__('Show Divider Top', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'condition' => [
                                'layout' => '6',
                            ],
                        ],
                        [
                            'name' => 'show_divider_bottom',
                            'label' => esc_html__('Show Divider Bottom', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'condition' => [
                                'layout' => '6',
                            ],
                        ],
                        frameflow_widget_yes_no_select_control(
                            'pxl_arrow',
                            esc_html__('Show Arrow', 'frameflow'),
                            [
                                'condition' => [
                                    'layout' => ['7'],
                                ],
                            ],
                        ),
                    ],
                ],
                [
                    'name' => 'section_content_2',
                    'label' => esc_html__('Content 2', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'condition' => [
                        'layout' => '2',
                    ],
                    'controls' => [
                        [
                            'name' => 'process_list',
                            'label' => esc_html__('Process List', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => [
                                frameflow_widget_text_control(
                                    'title_2',
                                    esc_html__('Title', 'frameflow'),
                                ),
                                frameflow_widget_textarea_control(
                                    'description_2',
                                    esc_html__('Description', 'frameflow'),
                                ),
                            ],
                            'title_field' => '{{{ title_2 }}}',
                        ],
                    ],
                ],
                [
                    'name' => 'section_content_3',
                    'label' => esc_html__('Content 3', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'condition' => [
                        'layout' => '3',
                    ],
                    'controls' => [
                        [
                            'name' => 'process_list_3',
                            'label' => esc_html__('Process List', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => [
                                [
                                    'name' => 'step_3',
                                    'label' => esc_html__('Step', 'frameflow'),
                                    'type' => \Elementor\Controls_Manager::NUMBER,
                                    'label_block' => true,
                                ],
                                frameflow_widget_text_control(
                                    'title_3',
                                    esc_html__('Title', 'frameflow'),
                                    ['label_block' => true],
                                ),
                                frameflow_widget_textarea_control(
                                    'description_3',
                                    esc_html__('Description', 'frameflow'),
                                    ['label_block' => true],
                                ),
                            ],
                            'title_field' => '{{{ title_3 }}}',
                        ],
                    ],
                ],
                [
                    'name' => 'section_content_9',
                    'label' => esc_html__('Content 9', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'condition' => [
                        'layout' => '9',
                    ],
                    'controls' => [
                        [
                            'name' => 'process_list_9',
                            'label' => esc_html__('Process List', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => [
                                [
                                    'name' => 'step_9',
                                    'label' => esc_html__('Step', 'frameflow'),
                                    'type' => \Elementor\Controls_Manager::NUMBER,
                                    'label_block' => true,
                                ],
                                frameflow_widget_media_control(
                                    'image_9',
                                    esc_html__('Image', 'frameflow'),
                                    ['label_block' => true],
                                ),
                                frameflow_widget_text_control(
                                    'title_9',
                                    esc_html__('Title', 'frameflow'),
                                    ['label_block' => true],
                                ),
                                frameflow_widget_textarea_control(
                                    'description_9',
                                    esc_html__('Description', 'frameflow'),
                                    ['label_block' => true],
                                ),
                            ],
                            'title_field' => '{{{ title_9 }}}',
                        ],
                        frameflow_widget_text_control(
                            'img_size_9',
                            esc_html__('Image Size', 'frameflow'),
                            [
                                'default' => '570x380',
                                'description' => esc_html__(
                                    "Enter image size (Example: \"thumbnail\", \"medium\", \"large\", \"full\" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).",
                                    'frameflow',
                                ),
                            ],
                        ),
                    ],
                ],
                [
                    'name' => 'section_style_general',
                    'label' => esc_html__('General', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => [
                        frameflow_widget_color_control(
                            'divider_color',
                            esc_html__('Divider Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-process1 .pxl-item--header:before, {{WRAPPER}} .pxl-process1 .pxl-item--header:after' =>
                                    'background-color: {{VALUE}};',
                            ],
                            [
                                'default' => '#E8E8E8',
                                'condition' => [
                                    'layout' => '1',
                                ],
                            ],
                        ),
                        frameflow_widget_color_control(
                            'divider_gradient_color_from',
                            esc_html__('Gradient Color From', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-process2 .pxl-item--list:before' =>
                                    '--gradient-color-from: {{VALUE}};',
                            ],
                            [
                                'condition' => [
                                    'layout' => '2',
                                ],
                            ],
                        ),
                        frameflow_widget_color_control(
                            'divider_gradient_color_to',
                            esc_html__('Gradient Color To', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-process2 .pxl-item--list:before' =>
                                    '--gradient-color-to: {{VALUE}};',
                            ],
                            [
                                'condition' => [
                                    'layout' => '2',
                                ],
                            ],
                        ),
                        [
                            'name' => 'spacing_divivder',
                            'label' => esc_html__('Spacing Divider', 'frameflow'),
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
                                '{{WRAPPER}} .pxl-process2 .pxl-item--list' =>
                                    '--spacing: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'layout' => '2',
                            ],
                        ],
                        [
                            'name' => 'spacing_dot',
                            'label' => esc_html__('Spacing Dot', 'frameflow'),
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
                                '{{WRAPPER}} .pxl-process2 .pxl-item:before' =>
                                    '--spacing-dot: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'layout' => '2',
                            ],
                        ],
                        [
                            'name' => 'process3_row_stagger',
                            'label' => esc_html__('Row Step Offset', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 200,
                                ],
                            ],
                            'default' => [
                                'size' => 86,
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-process3' =>
                                    '--pxl-process3-stagger: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'layout' => '3',
                            ],
                        ],
                        [
                            'name' => 'process3_pin_start',
                            'label' => esc_html__('Pin Start Offset', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 240,
                                ],
                            ],
                            'default' => [
                                'size' => 120,
                                'unit' => 'px',
                            ],
                            'description' => esc_html__(
                                'Distance from viewport top when scroll pin begins (header / less “high” sticky).',
                                'frameflow',
                            ),
                            'selectors' => [
                                '{{WRAPPER}} .pxl-process3' =>
                                    '--pxl-process3-pin-start: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'layout' => '3',
                            ],
                        ],
                        [
                            'name' => 'process3_scroll_extra',
                            'label' => esc_html__('Pin Scroll Extra', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 400,
                                ],
                            ],
                            'default' => [
                                'size' => 0,
                                'unit' => 'px',
                            ],
                            'description' => esc_html__(
                                'Adds to pin scroll length after stagger total. Leave 0 for tight height.',
                                'frameflow',
                            ),
                            'selectors' => [
                                '{{WRAPPER}} .pxl-process3' =>
                                    '--pxl-process3-scroll-extra: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'layout' => '3',
                            ],
                        ],
                        [
                            'name' => 'padding_item',
                            'label' => esc_html__('Padding', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', 'em', '%'],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-process .pxl-item' =>
                                    'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                            'condition' => [
                                'layout' => ['3', '8'],
                            ],
                        ],
                        [
                            'name' => 'padding_item_content',
                            'label' => esc_html__('Padding Content', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', 'em', '%'],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-process .pxl-item--content' =>
                                    'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                            'condition' => [
                                'layout' => '3',
                            ],
                        ],
                        frameflow_widget_color_control(
                            'process9_line_color',
                            esc_html__('Timeline Line Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-process9' => '--pxl-process9-line: {{VALUE}};',
                            ],
                            [
                                'default' => '#E8E8E8',
                                'condition' => [
                                    'layout' => '9',
                                ],
                            ],
                        ),
                        frameflow_widget_color_control(
                            'process9_line_active_color',
                            esc_html__('Timeline Active Line Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-process9' =>
                                    '--pxl-process9-line-active: {{VALUE}};',
                            ],
                            [
                                'default' => '#111111',
                                'condition' => [
                                    'layout' => '9',
                                ],
                            ],
                        ),
                        [
                            'name' => 'process9_step_gap',
                            'label' => esc_html__('Spacing Between Steps', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'default' => [
                                'size' => 80,
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-process9' =>
                                    '--pxl-process9-step-gap: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'layout' => '9',
                            ],
                        ],
                        [
                            'name' => 'process9_line_inset',
                            'label' => esc_html__('Line to Image/Content Spacing', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'default' => [
                                'size' => 140,
                                'unit' => 'px',
                            ],
                            'description' => esc_html__(
                                'Distance from center timeline to image and content.',
                                'frameflow',
                            ),
                            'selectors' => [
                                '{{WRAPPER}} .pxl-process9' =>
                                    '--pxl-process9-line-inset: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'layout' => '9',
                            ],
                        ],
                        frameflow_widget_color_control(
                            'bg_color_item',
                            esc_html__('Background Color Item', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-process .pxl-item' =>
                                    'background-color: {{VALUE}};',
                            ],
                            [
                                'condition' => [
                                    'layout' => '3',
                                ],
                            ],
                        ),
                        frameflow_widget_dimensions_control(
                            'border_radius',
                            esc_html__('Border Radius', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-process' =>
                                    'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            [
                                'condition' => [
                                    'layout' => ['4', '5'],
                                ],
                            ],
                        ),
                        frameflow_widget_dimensions_control(
                            'padding',
                            esc_html__('Padding', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-process' =>
                                    'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            [
                                'condition' => [
                                    'layout' => ['4', '5', '6', '7', '10'],
                                ],
                            ],
                        ),
                        frameflow_widget_color_control(
                            'bg_color',
                            esc_html__('Background Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-process' => 'background-color: {{VALUE}};',
                            ],
                            [
                                'condition' => [
                                    'layout' => ['4', '5', '10'],
                                ],
                            ],
                        ),
                        frameflow_widget_color_control(
                            'bg_color_hover',
                            esc_html__('Background Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-process:hover' => 'background-color: {{VALUE}};',
                            ],
                            [
                                'condition' => [
                                    'layout' => ['10'],
                                ],
                            ],
                        ),
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
                                    '{{WRAPPER}} .pxl-process' => 'border-style: {{VALUE}};',
                                ],
                            ],
                        ),
                        frameflow_widget_dimensions_control(
                            'border_width',
                            esc_html__('Border Width', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-process' =>
                                    'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                            ],
                            [
                                'condition' => ['border_type!' => ''],
                            ],
                        ),
                        frameflow_widget_color_control(
                            'border_color',
                            esc_html__('Border Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-process' => 'border-color: {{VALUE}};',
                            ],
                            [
                                'condition' => [
                                    'layout' => ['4', '7', '8', '10'],
                                ],
                            ],
                        ),
                    ],
                ],
                [
                    'name' => 'section_style_step',
                    'label' => esc_html__('Step', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => [
                        frameflow_widget_color_control(
                            'step_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-process .pxl-item--step, {{WRAPPER}} .pxl-process .pxl-item--step span' =>
                                    'color: {{VALUE}};',
                            ],
                        ),
                        frameflow_widget_color_control(
                            'step_color_hover',
                            esc_html__('Color Hover', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-process:hover .pxl-item--step, {{WRAPPER}} .pxl-process:hover .pxl-item--step span' =>
                                    'color: {{VALUE}};',
                            ],
                        ),
                        frameflow_widget_slider_control(
                            'step_size',
                            esc_html__('Size', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-process .pxl-item--step' =>
                                    'width: {{SIZE}}px; height: {{SIZE}}px;',
                            ],
                        ),
                        frameflow_widget_color_control(
                            'step_svg_color',
                            esc_html__('SVG Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-process .pxl-item--step svg path' =>
                                    'fill: {{VALUE}};',
                            ],
                            [
                                'condition' => [
                                    'layout' => '4',
                                ],
                            ],
                        ),
                        frameflow_widget_color_control(
                            'step_background_color',
                            esc_html__('Background Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-process .pxl-item--step' =>
                                    'background-color: {{VALUE}};',
                            ],
                        ),
                        frameflow_widget_color_control(
                            'step_background_color_hover',
                            esc_html__('Background Color Hover', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-process:hover .pxl-item--step' =>
                                    'background-color: {{VALUE}};',
                            ],
                        ),
                        frameflow_widget_color_control(
                            'step_border_color',
                            esc_html__('Border Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-process .pxl-item--step' =>
                                    'border-color: {{VALUE}};',
                            ],
                        ),
                        frameflow_widget_typography_control(
                            'step_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-process .pxl-item--step',
                        ),
                        [
                            'name' => 'step_box_shadow',
                            'label' => esc_html__('Box Shadow', 'frameflow'),
                            'type' => \Elementor\Group_Control_Box_Shadow::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-process .pxl-item--step',
                            'condition' => [
                                'layout' => '2',
                            ],
                        ],
                        frameflow_widget_dimensions_control(
                            'step_margin',
                            esc_html__('Margin', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-process .pxl-item--step' =>
                                    'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                        frameflow_widget_text_control(
                            'pxl_animate_item_delay',
                            esc_html__('Animate Item Delay', 'frameflow'),
                            [
                                'default' => '0',
                                'description' => 'Enter number. Default 0ms',
                                'condition' => [
                                    'layout' => '2',
                                ],
                            ],
                        ),
                    ],
                ],
                [
                    'name' => 'section_style_title',
                    'label' => esc_html__('Title', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => [
                        frameflow_widget_title_tag_control(
                            'title_tag',
                            esc_html__('Title HTML Tag', 'frameflow'),
                            'h6',
                        ),
                        frameflow_widget_color_control(
                            'title_color',
                            esc_html__('Title Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-process .pxl-item--title' => 'color: {{VALUE}};',
                            ],
                        ),
                        frameflow_widget_color_control(
                            'title_color_hover',
                            esc_html__('Title Color Hover', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-process:hover .pxl-item--title' => 'color: {{VALUE}};',
                            ],
                        ),
                        frameflow_widget_typography_control(
                            'title_typography',
                            esc_html__('Title Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-process .pxl-item--title',
                        ),
                        [
                            'name' => 'title_top_spacer',
                            'label' => esc_html__('Top Spacer', 'frameflow'),
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
                                '{{WRAPPER}} .pxl-process .pxl-item--title' =>
                                    'margin-top: {{SIZE}}{{UNIT}} !important;',
                            ],
                        ],
                        [
                            'name' => 'title_bottom_spacer',
                            'label' => esc_html__('Bottom Spacer', 'frameflow'),
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
                                '{{WRAPPER}} .pxl-process .pxl-item--title' =>
                                    'margin-bottom: {{SIZE}}{{UNIT}} !important;',
                            ],
                        ],
                    ],
                ],
                [
                    'name' => 'section_style_description',
                    'label' => esc_html__('Description', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => [
                        [
                            'name' => 'description_max_width',
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
                                '{{WRAPPER}} .pxl-process .pxl-item--description' =>
                                    'max-width: {{SIZE}}{{UNIT}} !important;',
                            ],
                        ],
                        frameflow_widget_color_control(
                            'description_color',
                            esc_html__('Description Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-process .pxl-item--description' =>
                                    'color: {{VALUE}};',
                            ],
                        ),
                        frameflow_widget_color_control(
                            'description_color_hover',
                            esc_html__('Description Color Hover', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-process:hover .pxl-item--description' => 'color: {{VALUE}};',
                            ],
                        ),
                        frameflow_widget_typography_control(
                            'description_typography',
                            esc_html__('Description Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-process .pxl-item--description',
                        ),
                        frameflow_widget_dimensions_control(
                            'description_margin',
                            esc_html__('Margin', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-process .pxl-item--description' =>
                                    'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
