<?php
/**
 * Case Feature Grid — icon feature cards with connector lines.
 * Templates: elements/templates/pxl_feature_grid/layout-1.php
 * Styles: assets/scss/elements/pxl_feature_grid.scss
 * Figma: 3817:280
 */
pxl_add_custom_widget(
    [
        'name' => 'pxl_feature_grid',
        'title' => esc_html__('Case Feature Grid', 'frameflow'),
        'icon' => 'eicon-posts-grid icon-brand-elementor',
        'categories' => ['pxltheme-core'],
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
                                        '/elements/widgets/img-layout/pxl_icon_box/layout1.webp',
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
                            'label' => esc_html__('Items', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'default' => [
                                [
                                    'item_title' => esc_html__(
                                        'Recreate an Exact Copy of any of Our Demos',
                                        'frameflow',
                                    ),
                                    'item_description' => esc_html__(
                                        'Make your website look exactly as our demo in a few clicks, no extra setup is required.',
                                        'frameflow',
                                    ),
                                    'pxl_icon' => [
                                        'value' => 'far fa-copy',
                                        'library' => 'fa-regular',
                                    ],
                                ],
                                [
                                    'item_title' => esc_html__(
                                        'Take Full Control of What is Being Imported',
                                        'frameflow',
                                    ),
                                    'item_description' => esc_html__(
                                        'Eliminate clutter by importing only what you need—individual pages, layouts, or settings.',
                                        'frameflow',
                                    ),
                                    'pxl_icon' => [
                                        'value' => 'fas fa-toggle-on',
                                        'library' => 'fa-solid',
                                    ],
                                ],
                                [
                                    'item_title' => esc_html__(
                                        'Get New Demos as Soon as We Release Them',
                                        'frameflow',
                                    ),
                                    'item_description' => esc_html__(
                                        'New demos appear in your dashboard instantly upon release, without needing a theme update.',
                                        'frameflow',
                                    ),
                                    'pxl_icon' => [
                                        'value' => 'far fa-comment-alt',
                                        'library' => 'fa-regular',
                                    ],
                                ],
                            ],
                            'controls' => [
                                frameflow_widget_text_control(
                                    'item_title',
                                    esc_html__('Title', 'frameflow'),
                                    ['label_block' => true],
                                ),
                                frameflow_widget_textarea_control(
                                    'item_description',
                                    esc_html__('Description', 'frameflow'),
                                    [
                                        'rows' => 4,
                                        'label_block' => true,
                                    ],
                                ),
                                frameflow_widget_icons_control(
                                    'pxl_icon',
                                    esc_html__('Icon', 'frameflow'),
                                ),
                            ],
                            'title_field' => '{{{ item_title }}}',
                        ],
                        [
                            'name' => 'show_connector',
                            'label' => esc_html__('Show Connector Lines', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'yes',
                            'return_value' => 'yes',
                        ],
                    ],
                ],
                [
                    'name' => 'section_settings',
                    'label' => esc_html__('Settings', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'controls' => array_merge(
                        [
                            frameflow_widget_title_tag_control(
                                'title_tag',
                                esc_html__('Title HTML Tag', 'frameflow'),
                                'h5',
                            ),
                        ],
                        frameflow_widget_responsive_columns_controls(
                            [
                                'xs' => '1',
                                'sm' => '1',
                                'md' => '2',
                                'lg' => '3',
                                'xl' => '3',
                                'xxl' => '3',
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
                            ],
                        ),
                    ),
                ],
                [
                    'name' => 'section_style_general',
                    'label' => esc_html__('General', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => [
                        [
                            'name' => 'grid_gap',
                            'label' => esc_html__('Grid Gap', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'control_type' => 'responsive',
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 200,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-feature-grid' => '--pxl-grid-gap: {{SIZE}}{{UNIT}};',
                            ],
                        ],
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
                                    '{{WRAPPER}} .pxl-feature-grid .pxl-item--inner' =>
                                        'text-align: {{VALUE}}; align-items: {{VALUE}};',
                                ],
                            ],
                        ),
                        frameflow_widget_color_control(
                            'connector_color',
                            esc_html__('Connector Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-feature-grid' => '--pxl-connector-color: {{VALUE}};',
                            ],
                            ['condition' => ['show_connector' => 'yes']],
                        ),
                    ],
                ],
                [
                    'name' => 'section_style_icon',
                    'label' => esc_html__('Icon', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => [
                        [
                            'name' => 'icon_box_size',
                            'label' => esc_html__('Icon Box Size', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 40,
                                    'max' => 200,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-feature-grid .pxl-item--icon' =>
                                    '--size-icon-box: {{SIZE}}{{UNIT}};',
                            ],
                        ],
                        [
                            'name' => 'icon_size',
                            'label' => esc_html__('Icon Size', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 12,
                                    'max' => 120,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-feature-grid .pxl-item--icon' =>
                                    '--size-icon: {{SIZE}}{{UNIT}};',
                            ],
                        ],
                        frameflow_widget_color_control(
                            'icon_bg_color',
                            esc_html__('Icon Background', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-feature-grid .pxl-item--icon' =>
                                    'background-color: {{VALUE}};',
                            ],
                        ),
                        frameflow_widget_color_control(
                            'icon_color',
                            esc_html__('Icon Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-feature-grid .pxl-item--icon' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-feature-grid .pxl-item--icon svg path' =>
                                    'fill: {{VALUE}};',
                            ],
                        ),
                        [
                            'name' => 'icon_spacing',
                            'label' => esc_html__('Icon Bottom Spacing', 'frameflow'),
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
                                '{{WRAPPER}} .pxl-feature-grid .pxl-item--header' =>
                                    'margin-bottom: {{SIZE}}{{UNIT}};',
                            ],
                        ],
                    ],
                ],
                [
                    'name' => 'section_style_title',
                    'label' => esc_html__('Title', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => [
                        frameflow_widget_slider_control(
                            'title_max_width',
                            esc_html__('Max Width', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-feature-grid .pxl-item--title' =>
                                    'max-width: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        frameflow_widget_color_control(
                            'title_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-feature-grid .pxl-item--title' =>
                                    'color: {{VALUE}};',
                            ],
                        ),
                        frameflow_widget_typography_control(
                            'title_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-feature-grid .pxl-item--title',
                        ),
                        [
                            'name' => 'title_spacing',
                            'label' => esc_html__('Bottom Spacing', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'control_type' => 'responsive',
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 80,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-feature-grid .pxl-item--title' =>
                                    'margin-bottom: {{SIZE}}{{UNIT}};',
                            ],
                        ],
                    ],
                ],
                [
                    'name' => 'section_style_description',
                    'label' => esc_html__('Description', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => [
                        frameflow_widget_slider_control(
                            'desc_max_width',
                            esc_html__('Max Width', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-feature-grid .pxl-item--description' =>
                                    'max-width: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        frameflow_widget_color_control(
                            'description_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-feature-grid .pxl-item--description' =>
                                    'color: {{VALUE}};',
                            ],
                        ),
                        frameflow_widget_typography_control(
                            'description_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-feature-grid .pxl-item--description',
                        ),
                    ],
                ],
                frameflow_widget_animation_settings(),
            ],
        ],
    ],
    frameflow_get_class_widget_path(),
);
