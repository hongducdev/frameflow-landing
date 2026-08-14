<?php
/**
 * Case Icon Box Carousel widget: multiple icon boxes in a Swiper carousel.
 */
pxl_add_custom_widget(
    array(
        'name' => 'pxl_icon_box_carousel',
        'title' => esc_html__('Case Icon Box Carousel', 'frameflow'),
        'icon' => 'eicon-icon-box icon-brand-elementor',
        'categories' => array('pxltheme-core'),
        'scripts' => array(
            'swiper',
            'pxl-swiper',
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
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_icon_box_carousel/layout1.webp',
                                ],
                                '2' => [
                                    'label' => esc_html__('Layout 2', 'frameflow'),
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_icon_box_carousel/layout2.webp',
                                ],
                                '3' => [
                                    'label' => esc_html__('Layout 3', 'frameflow'),
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_icon_box_carousel/layout3.webp',
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
                            'name' => 'icon_boxes',
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                frameflow_widget_text_control(
                                    'title',
                                    esc_html__('Title', 'frameflow'),
                                    ['label_block' => true]
                                ),
                                frameflow_widget_textarea_control(
                                    'desc',
                                    esc_html__('Description', 'frameflow'),
                                    ['rows' => 4]
                                ),
                                frameflow_widget_select_control(
                                    'icon_type',
                                    esc_html__('Icon Type', 'frameflow'),
                                    [
                                        'icon' => esc_html__('Icon', 'frameflow'),
                                        'image' => esc_html__('Image', 'frameflow'),
                                    ],
                                    ['default' => 'icon']
                                ),
                                frameflow_widget_icons_control(
                                    'pxl_icon',
                                    esc_html__('Icon', 'frameflow'),
                                    [
                                        'condition' => [
                                            'icon_type' => 'icon',
                                        ],
                                    ]
                                ),
                                frameflow_widget_media_control(
                                    'icon_image',
                                    esc_html__('Icon Image', 'frameflow'),
                                    [
                                        'condition' => [
                                            'icon_type' => 'image',
                                        ],
                                    ]
                                ),
                            ),
                            'title_field' => '{{{ title }}}',
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_general',
                    'label' => esc_html__('General', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'align',
                            'label' => esc_html__('Alignment', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::CHOOSE,
                            'control_type' => 'responsive',
                            'options' => [
                                'left' => [
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
                            ],
                            'prefix_class' => 'elementor-align-',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-icon-box-carousel .pxl-item--inner' => 'text-align: {{VALUE}};',
                            ],
                        ),
                        frameflow_widget_color_control(
                            'bg_color',
                            esc_html__('Box Background', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box-carousel .pxl-item--inner' => 'background-color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_dimensions_control(
                            'item_padding',
                            esc_html__('Padding', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box-carousel .pxl-item--inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ]
                        ),
                        frameflow_widget_dimensions_control(
                            'item_border_radius',
                            esc_html__('Border Radius', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box-carousel .pxl-item--inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ]
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
                                    '{{WRAPPER}} .pxl-icon-box-carousel .pxl-item--inner' => 'border-style: {{VALUE}};',
                                ],
                            ]
                        ),
                        frameflow_widget_dimensions_control(
                            'border_width',
                            esc_html__('Border Width', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box-carousel .pxl-item--inner' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            [
                                'condition' => [
                                    'border_type!' => '',
                                ],
                                'responsive' => true,
                            ]
                        ),
                        frameflow_widget_color_control(
                            'border_color',
                            esc_html__('Border Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box-carousel .pxl-item--inner' => 'border-color: {{VALUE}};',
                            ],
                            [
                                'default' => '',
                                'condition' => [
                                    'border_type!' => '',
                                ],
                            ]
                        ),
                        frameflow_widget_color_control(
                            'border_color_hover',
                            esc_html__('Border Color Hover', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box-carousel .pxl-item--inner:hover' => 'border-color: {{VALUE}};',
                            ],
                            [
                                'default' => '',
                                'condition' => [
                                    'border_type!' => '',
                                ],
                            ]
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
                                '{{WRAPPER}} .pxl-icon-box-carousel .pxl-item--title, {{WRAPPER}} .pxl-icon-box-carousel .pxl-item--title a' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_typography_control(
                            'title_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-icon-box-carousel .pxl-item--title, {{WRAPPER}} .pxl-icon-box-carousel .pxl-item--title a'
                        ),
                        frameflow_widget_dimensions_control(
                            'title_margin',
                            esc_html__('Margin', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box-carousel .pxl-item--title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ]
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
                                '{{WRAPPER}} .pxl-icon-box-carousel .pxl-item--description' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_typography_control(
                            'desc_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-icon-box-carousel .pxl-item--description'
                        ),
                        frameflow_widget_dimensions_control(
                            'desc_margin',
                            esc_html__('Margin', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box-carousel .pxl-item--description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ]
                        ),
                        frameflow_widget_slider_control(
                            'desc_max_width',
                            esc_html__('Max Width', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box-carousel .pxl-item--description' => 'max-width: {{SIZE}}{{UNIT}};',
                            ]
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
                                '{{WRAPPER}} .pxl-icon-box-carousel .pxl-item--icon i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-icon-box-carousel .pxl-item--icon svg path' => 'fill: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'icon_color_hover',
                            esc_html__('Color (Hover)', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box-carousel .pxl-item--inner:hover .pxl-item--icon i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-icon-box-carousel .pxl-item--inner:hover .pxl-item--icon svg path' => 'fill: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'icon_bg_color',
                            esc_html__('Background', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box-carousel .pxl-item--icon' => 'background-color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'icon_bg_color_hover',
                            esc_html__('Background (Hover)', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box-carousel .pxl-item--inner:hover .pxl-item--icon' => 'background-color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_dimensions_control(
                            'icon_border_radius',
                            esc_html__('Border Radius', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box-carousel .pxl-item--icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ]
                        ),
                        array(
                            'name' => 'icon_size',
                            'label' => esc_html__('Size', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => [
                                'px' => ['min' => 0, 'max' => 120],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-icon-box-carousel .pxl-item--icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-icon-box-carousel .pxl-item--icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'icon_spacing',
                            'label' => esc_html__('Spacing', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => [
                                'px' => ['min' => 0, 'max' => 100],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-icon-box-carousel .pxl-item--icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_settings_carousel',
                    'label' => esc_html__('Carousel Settings', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'controls' => array(
                        array(
                            'name' => 'item_padding_r',
                            'label' => esc_html__('Item Padding', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => ['px'],
                            'default' => [
                                'top' => '15',
                                'right' => '15',
                                'bottom' => '15',
                                'left' => '15',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-swiper-container' => 'margin: -{{TOP}}{{UNIT}} -{{RIGHT}}{{UNIT}} -{{BOTTOM}}{{UNIT}} -{{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-swiper-container .pxl-swiper-slide' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                        ),
                        ...frameflow_widget_responsive_select_controls([
                            'xs' => ['label' => esc_html__('Columns XS', 'frameflow'), 'options' => ['1' => '1', '2' => '2', '3' => '3'], 'default' => '1'],
                            'sm' => ['label' => esc_html__('Columns SM', 'frameflow'), 'options' => ['1' => '1', '2' => '2', '3' => '3', '4' => '4'], 'default' => '2'],
                            'md' => ['label' => esc_html__('Columns MD', 'frameflow'), 'options' => ['1' => '1', '2' => '2', '3' => '3', '4' => '4'], 'default' => '3'],
                            'lg' => ['label' => esc_html__('Columns LG', 'frameflow'), 'options' => ['1' => '1', '2' => '2', '3' => '3', '4' => '4'], 'default' => '3'],
                            'xl' => ['label' => esc_html__('Columns XL', 'frameflow'), 'options' => ['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6'], 'default' => '3'],
                            'xxl' => ['label' => esc_html__('Columns XXL', 'frameflow'), 'options' => ['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6'], 'default' => '3'],
                        ]),
                        frameflow_widget_select_control(
                            'slides_to_scroll',
                            esc_html__('Slides to scroll', 'frameflow'),
                            [
                                '1' => '1',
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                            ],
                            ['default' => '1']
                        ),
                        array(
                            'name' => 'arrows',
                            'label' => esc_html__('Show Arrows', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                        ),
                        frameflow_widget_carousel_arrows_type_control(),
                        array(
                            'name' => 'pagination',
                            'label' => esc_html__('Show Pagination', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                        ),
                        frameflow_widget_select_control(
                            'pagination_type',
                            esc_html__('Pagination Type', 'frameflow'),
                            [
                                'bullets' => esc_html__('Bullets', 'frameflow'),
                                'fraction' => esc_html__('Fraction', 'frameflow'),
                                'progressbar' => esc_html__('Progressbar', 'frameflow'),
                            ],
                            [
                                'default' => 'bullets',
                                'condition' => ['pagination' => 'yes'],
                            ]
                        ),
                        array(
                            'name' => 'autoplay',
                            'label' => esc_html__('Autoplay', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                        ),
                        array(
                            'name' => 'autoplay_speed',
                            'label' => esc_html__('Autoplay Delay (ms)', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'default' => 5000,
                            'condition' => ['autoplay' => 'yes'],
                        ),
                        array(
                            'name' => 'pause_on_hover',
                            'label' => esc_html__('Pause on Hover', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                        ),
                        array(
                            'name' => 'infinite',
                            'label' => esc_html__('Infinite Loop', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                        ),
                        array(
                            'name' => 'speed',
                            'label' => esc_html__('Animation Speed (ms)', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'default' => 500,
                        ),
                        array(
                            'name' => 'drap',
                            'label' => esc_html__('Show Scroll Drag', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                        ),
                    ),
                ),
                frameflow_widget_carousel_pagination_style_section(),
                frameflow_widget_carousel_pagination_bullet_style_section(),
                frameflow_widget_animation_settings(),
            ),
        ),
    ),
    frameflow_get_class_widget_path()
);
