<?php
$showcase_inner = '{{WRAPPER}} .pxl-showcase1 .pxl-item--inner';
$showcase_inner_hv = '{{WRAPPER}} .pxl-showcase1 .pxl-item--inner:hover';
$showcase_title = '{{WRAPPER}} .pxl-showcase1 .pxl-item--title';
$showcase_title_hv =
    '{{WRAPPER}} .pxl-showcase1 .pxl-item--inner:hover .pxl-item--title, {{WRAPPER}} .pxl-showcase1 .pxl-item--title a:hover';
$showcase_category = '{{WRAPPER}} .pxl-showcase1 .pxl-item--category';
$showcase_category_hv = '{{WRAPPER}} .pxl-showcase1 .pxl-item--inner:hover .pxl-item--category';
$showcase_btn = '{{WRAPPER}} .pxl-showcase1 .pxl-item--readmore .btn';
$showcase_btn_hv = '{{WRAPPER}} .pxl-showcase1 .pxl-item--readmore .btn:hover';
$showcase_icon = '{{WRAPPER}} .pxl-showcase1 .pxl-item--readmore .pxl--btn-icon';
$showcase_icon_hv = '{{WRAPPER}} .pxl-showcase1 .pxl-item--readmore .btn:hover .pxl--btn-icon';

$showcase_border_types = [
    '' => esc_html__('None', 'frameflow'),
    'solid' => esc_html__('Solid', 'frameflow'),
    'double' => esc_html__('Double', 'frameflow'),
    'dotted' => esc_html__('Dotted', 'frameflow'),
    'dashed' => esc_html__('Dashed', 'frameflow'),
    'groove' => esc_html__('Groove', 'frameflow'),
];

pxl_add_custom_widget(
    [
        'name' => 'pxl_showcase',
        'title' => esc_html__('Case Showcase', 'frameflow'),
        'icon' => 'eicon-parallax icon-brand-elementor',
        'categories' => ['pxltheme-core'],
        'params' => [
            'sections' => [
                [
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => [
                        frameflow_widget_switcher_control(
                            'coming_soon',
                            esc_html__('Coming Soon', 'frameflow'),
                            null,
                            '',
                        ),
                        frameflow_widget_media_control('image', esc_html__('Image', 'frameflow'), [
                            'condition' => ['coming_soon!' => 'true'],
                        ]),
                        [
                            'name' => 'select_background',
                            'label' => esc_html__('Background', 'frameflow'),
                            'type' => \Elementor\Group_Control_Background::get_type(),
                            'control_type' => 'group',
                            'types' => ['classic', 'gradient', 'video'],
                            'selector' => '{{WRAPPER}} .pxl-showcase1 .pxl-item--image',
                            'condition' => ['coming_soon' => 'true'],
                        ],
                        frameflow_widget_text_control(
                            'img_size',
                            esc_html__('Image Size', 'frameflow'),
                            [
                                'condition' => ['coming_soon!' => 'true'],
                                'description' => esc_html__(
                                    'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height).',
                                    'frameflow',
                                ),
                            ],
                        ),
                        frameflow_widget_text_control('title', esc_html__('Title', 'frameflow'), [
                            'label_block' => true,
                            'placeholder' => esc_html__('Coming Soon', 'frameflow'),
                        ]),
                        frameflow_widget_text_control(
                            'category',
                            esc_html__('Category', 'frameflow'),
                            [
                                'label_block' => true,
                                'placeholder' => esc_html__('Stay tuned!', 'frameflow'),
                            ],
                        ),
                        frameflow_widget_text_control(
                            'button_text',
                            esc_html__('Button Text', 'frameflow'),
                            [
                                'label_block' => true,
                                'condition' => ['coming_soon!' => 'true'],
                            ],
                        ),
                        frameflow_widget_url_control(
                            'button_url',
                            esc_html__('Button URL', 'frameflow'),
                            ['condition' => ['coming_soon!' => 'true']],
                        ),
                        frameflow_widget_title_tag_control(
                            'title_tag',
                            esc_html__('Title HTML Tag', 'frameflow'),
                            'h5',
                        ),
                    ],
                ],
                [
                    'name' => 'section_style_general',
                    'label' => esc_html__('General', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => [
                        frameflow_widget_control_tabs('box_style_tabs', [
                            [
                                'name' => 'tab_box_normal',
                                'label' => esc_html__('Normal', 'frameflow'),
                                'controls' => [
                                    [
                                        'name' => 'box_background',
                                        'label' => esc_html__('Background', 'frameflow'),
                                        'type' => \Elementor\Group_Control_Background::get_type(),
                                        'control_type' => 'group',
                                        'types' => ['classic', 'gradient'],
                                        'selector' => $showcase_inner,
                                    ],
                                    frameflow_widget_select_control(
                                        'box_border_type',
                                        esc_html__('Border Type', 'frameflow'),
                                        $showcase_border_types,
                                        [
                                            'selectors' => [
                                                $showcase_inner => 'border-style: {{VALUE}};',
                                            ],
                                        ],
                                    ),
                                    frameflow_widget_dimensions_control(
                                        'box_border_width',
                                        esc_html__('Border Width', 'frameflow'),
                                        [
                                            $showcase_inner =>
                                                'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                        ],
                                        ['condition' => ['box_border_type!' => '']],
                                    ),
                                    frameflow_widget_color_control(
                                        'box_border_color',
                                        esc_html__('Border Color', 'frameflow'),
                                        [
                                            $showcase_inner => 'border-color: {{VALUE}};',
                                        ],
                                        ['condition' => ['box_border_type!' => '']],
                                    ),
                                    [
                                        'name' => 'box_shadow',
                                        'label' => esc_html__('Box Shadow', 'frameflow'),
                                        'type' => \Elementor\Group_Control_Box_Shadow::get_type(),
                                        'control_type' => 'group',
                                        'selector' => $showcase_inner,
                                    ],
                                ],
                            ],
                            [
                                'name' => 'tab_box_hover',
                                'label' => esc_html__('Hover', 'frameflow'),
                                'controls' => [
                                    [
                                        'name' => 'box_background_hv',
                                        'label' => esc_html__('Background', 'frameflow'),
                                        'type' => \Elementor\Group_Control_Background::get_type(),
                                        'control_type' => 'group',
                                        'types' => ['classic', 'gradient'],
                                        'selector' => $showcase_inner_hv,
                                    ],
                                    frameflow_widget_select_control(
                                        'box_border_type_hv',
                                        esc_html__('Border Type', 'frameflow'),
                                        $showcase_border_types,
                                        [
                                            'selectors' => [
                                                $showcase_inner_hv => 'border-style: {{VALUE}};',
                                            ],
                                        ],
                                    ),
                                    frameflow_widget_dimensions_control(
                                        'box_border_width_hv',
                                        esc_html__('Border Width', 'frameflow'),
                                        [
                                            $showcase_inner_hv =>
                                                'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                        ],
                                        ['condition' => ['box_border_type_hv!' => '']],
                                    ),
                                    frameflow_widget_color_control(
                                        'box_border_color_hv',
                                        esc_html__('Border Color', 'frameflow'),
                                        [
                                            $showcase_inner_hv => 'border-color: {{VALUE}};',
                                        ],
                                        ['condition' => ['box_border_type_hv!' => '']],
                                    ),
                                    [
                                        'name' => 'box_shadow_hv',
                                        'label' => esc_html__('Box Shadow', 'frameflow'),
                                        'type' => \Elementor\Group_Control_Box_Shadow::get_type(),
                                        'control_type' => 'group',
                                        'selector' => $showcase_inner_hv,
                                    ],
                                ],
                            ],
                        ]),
                        frameflow_widget_dimensions_control(
                            'box_radius',
                            esc_html__('Border Radius', 'frameflow'),
                            [
                                $showcase_inner =>
                                    'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                        frameflow_widget_slider_control(
                            'image_height',
                            esc_html__('Image Height', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-showcase1 .pxl-item--image' =>
                                    'height: {{SIZE}}{{UNIT}}; aspect-ratio: auto;',
                            ],
                            [
                                'size_units' => ['px'],
                                'range' => [
                                    'px' => [
                                        'min' => 160,
                                        'max' => 800,
                                    ],
                                ],
                            ],
                        ),
                        frameflow_widget_dimensions_control(
                            'image_radius',
                            esc_html__('Image Border Radius', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-showcase1 .pxl-item--image' =>
                                    'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                        frameflow_widget_dimensions_control(
                            'image_margin',
                            esc_html__('Image Margin', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-showcase1 .pxl-item--image' =>
                                    'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                        frameflow_widget_dimensions_control(
                            'content_padding',
                            esc_html__('Content Padding', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-showcase1 .pxl-item--container' =>
                                    'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                    ],
                ],
                [
                    'name' => 'section_style_title',
                    'label' => esc_html__('Title', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => [
                        frameflow_widget_typography_control(
                            'title_typography',
                            esc_html__('Typography', 'frameflow'),
                            $showcase_title,
                        ),
                        frameflow_widget_control_tabs('title_style_tabs', [
                            [
                                'name' => 'tab_title_normal',
                                'label' => esc_html__('Normal', 'frameflow'),
                                'controls' => [
                                    frameflow_widget_color_control(
                                        'title_color',
                                        esc_html__('Color', 'frameflow'),
                                        [
                                            $showcase_title => 'color: {{VALUE}};',
                                        ],
                                    ),
                                ],
                            ],
                            [
                                'name' => 'tab_title_hover',
                                'label' => esc_html__('Hover', 'frameflow'),
                                'controls' => [
                                    frameflow_widget_color_control(
                                        'title_color_hv',
                                        esc_html__('Color', 'frameflow'),
                                        [
                                            $showcase_title_hv => 'color: {{VALUE}};',
                                        ],
                                    ),
                                ],
                            ],
                        ]),
                        frameflow_widget_dimensions_control(
                            'title_margin',
                            esc_html__('Margin', 'frameflow'),
                            [
                                $showcase_title =>
                                    'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                    ],
                ],
                [
                    'name' => 'section_style_category',
                    'label' => esc_html__('Category', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => [
                        frameflow_widget_typography_control(
                            'category_typography',
                            esc_html__('Typography', 'frameflow'),
                            $showcase_category,
                        ),
                        frameflow_widget_control_tabs('category_style_tabs', [
                            [
                                'name' => 'tab_category_normal',
                                'label' => esc_html__('Normal', 'frameflow'),
                                'controls' => [
                                    frameflow_widget_color_control(
                                        'category_color',
                                        esc_html__('Color', 'frameflow'),
                                        [
                                            $showcase_category => 'color: {{VALUE}};',
                                        ],
                                    ),
                                ],
                            ],
                            [
                                'name' => 'tab_category_hover',
                                'label' => esc_html__('Hover', 'frameflow'),
                                'controls' => [
                                    frameflow_widget_color_control(
                                        'category_color_hv',
                                        esc_html__('Color', 'frameflow'),
                                        [
                                            $showcase_category_hv => 'color: {{VALUE}};',
                                        ],
                                    ),
                                ],
                            ],
                        ]),
                        frameflow_widget_dimensions_control(
                            'category_margin',
                            esc_html__('Margin', 'frameflow'),
                            [
                                $showcase_category =>
                                    'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                    ],
                ],
                [
                    'name' => 'section_style_button',
                    'label' => esc_html__('Button', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'condition' => ['coming_soon!' => 'true'],
                    'controls' => [
                        frameflow_widget_typography_control(
                            'button_typography',
                            esc_html__('Typography', 'frameflow'),
                            $showcase_btn,
                        ),
                        frameflow_widget_control_tabs('button_style_tabs', [
                            [
                                'name' => 'tab_button_normal',
                                'label' => esc_html__('Normal', 'frameflow'),
                                'controls' => [
                                    frameflow_widget_color_control(
                                        'button_color',
                                        esc_html__('Color', 'frameflow'),
                                        [
                                            $showcase_btn => 'color: {{VALUE}};',
                                        ],
                                    ),
                                    [
                                        'name' => 'button_background',
                                        'label' => esc_html__('Background', 'frameflow'),
                                        'type' => \Elementor\Group_Control_Background::get_type(),
                                        'control_type' => 'group',
                                        'types' => ['classic', 'gradient'],
                                        'selector' => $showcase_btn,
                                    ],
                                    frameflow_widget_select_control(
                                        'button_border_type',
                                        esc_html__('Border Type', 'frameflow'),
                                        $showcase_border_types,
                                        [
                                            'selectors' => [
                                                $showcase_btn => 'border-style: {{VALUE}};',
                                            ],
                                        ],
                                    ),
                                    frameflow_widget_dimensions_control(
                                        'button_border_width',
                                        esc_html__('Border Width', 'frameflow'),
                                        [
                                            $showcase_btn =>
                                                'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                        ],
                                        ['condition' => ['button_border_type!' => '']],
                                    ),
                                    frameflow_widget_color_control(
                                        'button_border_color',
                                        esc_html__('Border Color', 'frameflow'),
                                        [
                                            $showcase_btn => 'border-color: {{VALUE}};',
                                        ],
                                        ['condition' => ['button_border_type!' => '']],
                                    ),
                                    [
                                        'name' => 'button_box_shadow',
                                        'label' => esc_html__('Box Shadow', 'frameflow'),
                                        'type' => \Elementor\Group_Control_Box_Shadow::get_type(),
                                        'control_type' => 'group',
                                        'selector' => $showcase_btn,
                                    ],
                                    frameflow_widget_color_control(
                                        'button_icon_bg_color',
                                        esc_html__('Icon Background Color', 'frameflow'),
                                        [
                                            $showcase_icon => 'background-color: {{VALUE}};',
                                        ],
                                    ),
                                    frameflow_widget_color_control(
                                        'button_icon_color',
                                        esc_html__('Icon Color', 'frameflow'),
                                        [
                                            $showcase_icon => 'color: {{VALUE}};',
                                        ],
                                    ),
                                ],
                            ],
                            [
                                'name' => 'tab_button_hover',
                                'label' => esc_html__('Hover', 'frameflow'),
                                'controls' => [
                                    frameflow_widget_color_control(
                                        'button_color_hv',
                                        esc_html__('Color', 'frameflow'),
                                        [
                                            $showcase_btn_hv => 'color: {{VALUE}};',
                                        ],
                                    ),
                                    [
                                        'name' => 'button_background_hv',
                                        'label' => esc_html__('Background', 'frameflow'),
                                        'type' => \Elementor\Group_Control_Background::get_type(),
                                        'control_type' => 'group',
                                        'types' => ['classic', 'gradient'],
                                        'selector' => $showcase_btn_hv,
                                    ],
                                    frameflow_widget_select_control(
                                        'button_border_type_hv',
                                        esc_html__('Border Type', 'frameflow'),
                                        $showcase_border_types,
                                        [
                                            'selectors' => [
                                                $showcase_btn_hv => 'border-style: {{VALUE}};',
                                            ],
                                        ],
                                    ),
                                    frameflow_widget_dimensions_control(
                                        'button_border_width_hv',
                                        esc_html__('Border Width', 'frameflow'),
                                        [
                                            $showcase_btn_hv =>
                                                'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                        ],
                                        ['condition' => ['button_border_type_hv!' => '']],
                                    ),
                                    frameflow_widget_color_control(
                                        'button_border_color_hv',
                                        esc_html__('Border Color', 'frameflow'),
                                        [
                                            $showcase_btn_hv => 'border-color: {{VALUE}};',
                                        ],
                                        ['condition' => ['button_border_type_hv!' => '']],
                                    ),
                                    [
                                        'name' => 'button_box_shadow_hv',
                                        'label' => esc_html__('Box Shadow', 'frameflow'),
                                        'type' => \Elementor\Group_Control_Box_Shadow::get_type(),
                                        'control_type' => 'group',
                                        'selector' => $showcase_btn_hv,
                                    ],
                                    frameflow_widget_color_control(
                                        'button_icon_bg_color_hv',
                                        esc_html__('Icon Background Color', 'frameflow'),
                                        [
                                            $showcase_icon_hv => 'background-color: {{VALUE}};',
                                        ],
                                    ),
                                    frameflow_widget_color_control(
                                        'button_icon_color_hv',
                                        esc_html__('Icon Color', 'frameflow'),
                                        [
                                            $showcase_icon_hv => 'color: {{VALUE}};',
                                        ],
                                    ),
                                ],
                            ],
                        ]),
                        frameflow_widget_slider_control(
                            'button_icon_size',
                            esc_html__('Icon Box Size', 'frameflow'),
                            [
                                $showcase_icon =>
                                    'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                            ],
                            [
                                'size_units' => ['px'],
                                'range' => [
                                    'px' => [
                                        'min' => 24,
                                        'max' => 80,
                                    ],
                                ],
                            ],
                        ),
                        frameflow_widget_dimensions_control(
                            'button_padding',
                            esc_html__('Padding', 'frameflow'),
                            [
                                $showcase_btn =>
                                    'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                        frameflow_widget_dimensions_control(
                            'button_radius',
                            esc_html__('Border Radius', 'frameflow'),
                            [
                                $showcase_btn =>
                                    'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
