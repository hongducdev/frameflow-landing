<?php
/**
 * Case Collection Slip — hover-expand collection panels.
 * Layout: elements/templates/pxl_collection_slip/layout-1.php
 * Styles: assets/scss/elements/pxl_collection_slip.scss
 * Flex hover: elements/widgets/js/elementor.js (frameflow_collection_slip_flex_hover)
 */
pxl_add_custom_widget(
    [
        'name' => 'pxl_collection_slip',
        'title' => esc_html__('Case Collection Slip', 'frameflow'),
        'icon' => 'eicon-gallery-grid icon-brand-elementor',
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
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_collection_slip/layout1.webp',
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
                        [
                            'name' => 'items',
                            'label' => esc_html__('Collections', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'default' => [
                                [
                                    'item_subtitle' => esc_html__('New Collection', 'frameflow'),
                                    'item_title' => esc_html__('Crafted Essentials', 'frameflow'),
                                    'item_description' => esc_html__('Discover our latest minimalist, high-quality everyday collection, meticulously tailored to bring effortless style and ultimate comfort to your modern wardrobe.', 'frameflow'),
                                    'item_button_text' => esc_html__('Explore Collection', 'frameflow'),
                                ],
                                [
                                    'item_subtitle' => esc_html__('New Collection', 'frameflow'),
                                    'item_title' => esc_html__('Modern Classics', 'frameflow'),
                                    'item_description' => esc_html__('Discover our latest minimalist, high-quality everyday collection, meticulously tailored to bring effortless style and ultimate comfort to your modern wardrobe.', 'frameflow'),
                                    'item_button_text' => esc_html__('Explore Collection', 'frameflow'),
                                ],
                                [
                                    'item_subtitle' => esc_html__('New Collection', 'frameflow'),
                                    'item_title' => esc_html__('Seasonal Edit', 'frameflow'),
                                    'item_description' => esc_html__('Discover our latest minimalist, high-quality everyday collection, meticulously tailored to bring effortless style and ultimate comfort to your modernwardrobe.', 'frameflow'),
                                    'item_button_text' => esc_html__('Explore Collection', 'frameflow'),
                                ],
                            ],
                            'controls' => [
                                frameflow_widget_media_control(
                                    'item_image',
                                    esc_html__('Image', 'frameflow')
                                ),
                                frameflow_widget_text_control(
                                    'item_subtitle',
                                    esc_html__('Subtitle', 'frameflow'),
                                    ['label_block' => true]
                                ),
                                frameflow_widget_text_control(
                                    'item_title',
                                    esc_html__('Title', 'frameflow'),
                                    ['label_block' => true]
                                ),
                                frameflow_widget_textarea_control(
                                    'item_description',
                                    esc_html__('Description', 'frameflow'),
                                    [
                                        'rows' => 4,
                                        'label_block' => true,
                                    ]
                                ),
                                frameflow_widget_text_control(
                                    'item_button_text',
                                    esc_html__('Button Text', 'frameflow'),
                                    [
                                        'label_block' => true,
                                        'default' => esc_html__('Explore Collection', 'frameflow'),
                                    ]
                                ),
                                frameflow_widget_url_control(
                                    'item_button_link',
                                    esc_html__('Button Link', 'frameflow')
                                ),
                            ],
                            'title_field' => '{{{ item_title }}}',
                        ],
                    ],
                ],
                [
                    'name' => 'section_settings',
                    'label' => esc_html__('Settings', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'controls' => [
                        [
                            'name' => 'slip_flex_active',
                            'label' => esc_html__('Active item width (%)', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'default' => 67,
                            'min' => 10,
                            'max' => 90,
                            'description' => esc_html__('Expanded panel width. With 3 items and ~16.5% inactive, use ~67% so columns total 100%.', 'frameflow'),
                        ],
                        [
                            'name' => 'slip_flex_inactive',
                            'label' => esc_html__('Inactive item width (%)', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'default' => 16.5,
                            'min' => 5,
                            'max' => 90,
                            'description' => esc_html__('Collapsed panel width. Values are normalized to 100%.', 'frameflow'),
                        ],
                        [
                            'name' => 'default_active',
                            'label' => esc_html__('Default Active Index', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'default' => 0,
                            'min' => 0,
                            'description' => esc_html__('0-based index of the panel open by default (Figma uses the first).', 'frameflow'),
                        ],
                        [
                            'name' => 'slip_height',
                            'label' => esc_html__('Height', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['px', 'vh'],
                            'range' => [
                                'px' => [
                                    'min' => 300,
                                    'max' => 1200,
                                ],
                                'vh' => [
                                    'min' => 30,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 815,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-collection-slip .pxl-collection-slip--track' => 'height: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-collection-slip .pxl-collection-slip--image' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                        ],
                        frameflow_widget_title_tag_control(
                            'title_tag',
                            esc_html__('Title HTML Tag', 'frameflow'),
                            'h3'
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
                            '{{WRAPPER}} .pxl-collection-slip .pxl-collection-slip--subtitle'
                        ),
                        frameflow_widget_color_control(
                            'subtitle_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-collection-slip .pxl-collection-slip--subtitle' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_dimensions_control(
                            'subtitle_margin',
                            esc_html__('Margin', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-collection-slip .pxl-collection-slip--subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                            '{{WRAPPER}} .pxl-collection-slip .pxl-collection-slip--title'
                        ),
                        frameflow_widget_color_control(
                            'title_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-collection-slip .pxl-collection-slip--title' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_dimensions_control(
                            'title_margin',
                            esc_html__('Margin', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-collection-slip .pxl-collection-slip--title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ]
                        ),
                    ],
                ],
                [
                    'name' => 'section_style_description',
                    'label' => esc_html__('Description', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => [
                        frameflow_widget_typography_control(
                            'description_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-collection-slip .pxl-collection-slip--description'
                        ),
                        frameflow_widget_color_control(
                            'description_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-collection-slip .pxl-collection-slip--description' => 'color: {{VALUE}};',
                            ]
                        ),
                        [
                            'name' => 'description_max_width',
                            'label' => esc_html__('Max Width', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 200,
                                    'max' => 800,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 405,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-collection-slip .pxl-collection-slip--description' => 'max-width: {{SIZE}}{{UNIT}};',
                            ],
                        ],
                        frameflow_widget_dimensions_control(
                            'description_margin',
                            esc_html__('Margin', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-collection-slip .pxl-collection-slip--description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                            '{{WRAPPER}} .pxl-collection-slip .pxl-collection-slip--button'
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
                                                '{{WRAPPER}} .pxl-collection-slip .pxl-collection-slip--button' => 'color: {{VALUE}};',
                                            ]
                                        ),
                                        frameflow_widget_color_control(
                                            'button_bg_color',
                                            esc_html__('Background Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-collection-slip .pxl-collection-slip--button' => 'background-color: {{VALUE}};',
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
                                                '{{WRAPPER}} .pxl-collection-slip .pxl-collection-slip--button:hover' => 'color: {{VALUE}};',
                                            ]
                                        ),
                                        frameflow_widget_color_control(
                                            'button_bg_color_hv',
                                            esc_html__('Background Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-collection-slip .pxl-collection-slip--button:hover' => 'background-color: {{VALUE}};',
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
                                '{{WRAPPER}} .pxl-collection-slip .pxl-collection-slip--button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ]
                        ),
                        frameflow_widget_dimensions_control(
                            'button_margin',
                            esc_html__('Margin', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-collection-slip .pxl-collection-slip--button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ]
                        ),
                    ],
                ],
                [
                    'name' => 'section_style_overlay',
                    'label' => esc_html__('Overlay', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => [
                        frameflow_widget_color_control(
                            'overlay_color',
                            esc_html__('Overlay Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-collection-slip .pxl-collection-slip--overlay' => 'background-color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_dimensions_control(
                            'content_padding',
                            esc_html__('Content Padding', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-collection-slip .pxl-collection-slip--content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ]
                        ),
                    ],
                ],
            ],
        ],
    ],
    frameflow_get_class_widget_path()
);
