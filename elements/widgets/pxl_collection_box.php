<?php
/**
 * Case Collection Box — image card with progressive gradient blur + CTA.
 * Layout: elements/templates/pxl_collection_box/layout-1.php
 * Styles: assets/scss/elements/pxl_collection_box.scss
 * Figma: 3385:457
 */
pxl_add_custom_widget(
    [
        'name' => 'pxl_collection_box',
        'title' => esc_html__('Case Collection Box', 'frameflow'),
        'icon' => 'eicon-image-box icon-brand-elementor',
        'categories' => ['pxltheme-core'],
        'scripts' => [],
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
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_collection_box/layout1.webp',
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
                        frameflow_widget_media_control(
                            'image',
                            esc_html__('Image', 'frameflow')
                        ),
                        frameflow_widget_text_control(
                            'img_size',
                            esc_html__('Image Size', 'frameflow'),
                            [
                                'description' => esc_html__(
                                    'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height).',
                                    'frameflow'
                                ),
                            ]
                        ),
                        frameflow_widget_text_control(
                            'title',
                            esc_html__('Title', 'frameflow'),
                            [
                                'label_block' => true,
                                'default' => esc_html__('Workday Edit', 'frameflow'),
                            ]
                        ),
                        frameflow_widget_text_control(
                            'subtitle',
                            esc_html__('Subtitle', 'frameflow'),
                            [
                                'label_block' => true,
                                'default' => esc_html__('Sharp Tailoring  /  Office Staples', 'frameflow'),
                            ]
                        ),
                        frameflow_widget_text_control(
                            'button_text',
                            esc_html__('Button Text', 'frameflow'),
                            [
                                'label_block' => true,
                                'default' => esc_html__('Discover Now', 'frameflow'),
                            ]
                        ),
                        frameflow_widget_url_control(
                            'button_link',
                            esc_html__('Button Link', 'frameflow')
                        ),
                        frameflow_widget_title_tag_control(
                            'title_tag',
                            esc_html__('Title HTML Tag', 'frameflow'),
                            'h3'
                        ),
                    ],
                ],
                [
                    'name' => 'section_style_general',
                    'label' => esc_html__('General', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => [
                        [
                            'name' => 'image_height',
                            'label' => esc_html__('Image Height', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 200,
                                    'max' => 1000,
                                ],
                            ],
                            'default' => [
                                'size' => 438,
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-collection-box .pxl-item--image' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ],
                        [
                            'name' => 'front_height',
                            'label' => esc_html__('Blur Height', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px', '%'],
                            'range' => [
                                'px' => [
                                    'min' => 60,
                                    'max' => 400,
                                ],
                                '%' => [
                                    'min' => 10,
                                    'max' => 80,
                                ],
                            ],
                            'default' => [
                                'size' => 37,
                                'unit' => '%',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-collection-box .pxl-item--front' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ],
                        frameflow_widget_color_control(
                            'gradient_color',
                            esc_html__('Gradient Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-collection-box' => '--gradient-color: {{VALUE}};',
                            ],
                            [
                                'default' => '#ffffff',
                            ]
                        ),
                        frameflow_widget_dimensions_control(
                            'content_padding',
                            esc_html__('Content Padding', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-collection-box .pxl-item--content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ]
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
                            '{{WRAPPER}} .pxl-collection-box .pxl-item--title'
                        ),
                        frameflow_widget_color_control(
                            'title_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-collection-box .pxl-item--title' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_dimensions_control(
                            'title_margin',
                            esc_html__('Margin', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-collection-box .pxl-item--title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ]
                        ),
                    ],
                ],
                [
                    'name' => 'section_style_subtitle',
                    'label' => esc_html__('Subtitle', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => [
                        frameflow_widget_typography_control(
                            'subtitle_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-collection-box .pxl-item--subtitle'
                        ),
                        frameflow_widget_color_control(
                            'subtitle_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-collection-box .pxl-item--subtitle' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_dimensions_control(
                            'subtitle_margin',
                            esc_html__('Margin', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-collection-box .pxl-item--subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ]
                        ),
                    ],
                ],
                [
                    'name' => 'section_style_button',
                    'label' => esc_html__('Button', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => [
                        frameflow_widget_typography_control(
                            'button_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-collection-box .pxl-item--button'
                        ),
                        [
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
                                                '{{WRAPPER}} .pxl-collection-box .pxl-item--button' => 'color: {{VALUE}};',
                                            ]
                                        ),
                                        frameflow_widget_color_control(
                                            'button_bg_color',
                                            esc_html__('Background Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-collection-box .pxl-item--button' => 'background-color: {{VALUE}};',
                                            ]
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
                                                '{{WRAPPER}} .pxl-collection-box .pxl-item--button:hover' => 'color: {{VALUE}};',
                                            ]
                                        ),
                                        frameflow_widget_color_control(
                                            'button_bg_color_hv',
                                            esc_html__('Background Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-collection-box .pxl-item--button:hover' => 'background-color: {{VALUE}};',
                                            ]
                                        ),
                                    ],
                                ],
                            ],
                        ],
                        frameflow_widget_dimensions_control(
                            'button_padding',
                            esc_html__('Padding', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-collection-box .pxl-item--button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ]
                        ),
                        frameflow_widget_dimensions_control(
                            'button_margin',
                            esc_html__('Margin', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-collection-box .pxl-item--button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
