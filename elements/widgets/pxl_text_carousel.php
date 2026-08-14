<?php
$slides_to_show = range(1, 10);
$slides_to_show = array_combine($slides_to_show, $slides_to_show);

pxl_add_custom_widget(
    array(
        'name' => 'pxl_text_carousel',
        'title' => esc_html__('Case Text Carousel', 'frameflow'),
        'icon' => 'eicon-slider-album',
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
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_text_carousel/layout1.webp',
                                ],
                                '2' => [
                                    'label' => esc_html__('Layout 2', 'frameflow'),
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_text_carousel/layout2.webp',
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
                            'name' => 'text_items',
                            'label' => esc_html__('Text Items', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                frameflow_widget_text_control(
                                    'item_title',
                                    esc_html__('Title', 'frameflow'),
                                    [
                                        'label_block' => true,
                                    ]
                                ),
                                frameflow_widget_textarea_control(
                                    'item_text',
                                    esc_html__('Text', 'frameflow'),
                                    [
                                        'label_block' => true,
                                    ]
                                ),
                            ),
                            'title_field' => '{{{ item_title }}}',
                        ),
                        array(
                            'name' => 'layout_2_icon',
                            'label' => esc_html__('Icon', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::ICONS,
                            'condition' => [
                                'layout' => '2',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_general',
                    'label' => esc_html__('General', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_color_control(
                            'box_bg_color',
                            esc_html__('Box Background Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-carousel .pxl-item--inner' => 'background-color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_select_control(
                            'border_item_type',
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
                                    '{{WRAPPER}} .pxl-text-carousel .pxl-item--inner' => 'border-style: {{VALUE}} !important;',
                                ],
                            ]
                        ),
                        frameflow_widget_dimensions_control(
                            'border_item_width',
                            esc_html__('Border Width', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-carousel .pxl-item--inner' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                            ],
                            [
                                'condition' => [
                                    'border_item_type!' => '',
                                ],
                            ]
                        ),
                        frameflow_widget_color_control(
                            'border_item_color',
                            esc_html__('Border Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-carousel .pxl-item--inner' => 'border-color: {{VALUE}} !important;',
                            ],
                            [
                                'default' => '',
                                'condition' => [
                                    'border_item_type!' => '',
                                ],
                            ]
                        ),
                        frameflow_widget_dimensions_control(
                            'border_item_radius',
                            esc_html__('Border Radius', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-carousel .pxl-item--inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                            ],
                        ),
                        frameflow_widget_dimensions_control(
                            'padding_item',
                            esc_html__('Padding', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-carousel .pxl-item--inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                            ],
                        ),
                    )
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
                                '{{WRAPPER}} .pxl-text-carousel .pxl-item--icon i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-text-carousel .pxl-item--icon svg path' => 'fill: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'icon_bg_color',
                            esc_html__('Background Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-carousel .pxl-item--icon' => 'background-color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'icon_bg_color_hover',
                            esc_html__('Background Hover Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-carousel .pxl-item--inner:hover .pxl-item--icon' => 'background-color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_slider_control(
                            'icon_box_size',
                            esc_html__('Box Size', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-carousel .pxl-item--icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        frameflow_widget_dimensions_control(
                            'icon_box_margin',
                            esc_html__('Margin', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-carousel .pxl-item--icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                    )
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
                                '{{WRAPPER}} .pxl-text-carousel .pxl-item--title' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_typography_control(
                            'title_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-text-carousel .pxl-item--title'
                        ),
                        frameflow_widget_dimensions_control(
                            'title_margin',
                            esc_html__('Margin', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-carousel .pxl-item--title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ]
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_text',
                    'label' => esc_html__('Text', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_color_control(
                            'text_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-carousel .pxl-item--text' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'text_color_hover',
                            esc_html__('Hover Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-carousel .pxl-item--text:hover' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-text-carousel .pxl-item--link:hover .pxl-item--text' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_typography_control(
                            'text_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-text-carousel .pxl-item--text'
                        ),
                        frameflow_widget_choose_control(
                            'text_alignment',
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
                                'default' => 'left',
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-text-carousel .pxl-item--inner' => 'text-align: {{VALUE}};',
                                ],
                            ]
                        ),
                    ),
                ),
                array(
                    'name' => 'section_carousel_settings',
                    'label' => esc_html__('Carousel Settings', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'controls' => array(
                        ...frameflow_widget_responsive_select_controls([
                            'xs' => ['label' => esc_html__('Columns XS Devices', 'frameflow'), 'options' => ['1' => '1', '2' => '2', '3' => '3'], 'default' => '1'],
                            'sm' => ['label' => esc_html__('Columns SM Devices', 'frameflow'), 'options' => ['1' => '1', '2' => '2', '3' => '3'], 'default' => '1'],
                            'md' => ['label' => esc_html__('Columns MD Devices', 'frameflow'), 'options' => ['1' => '1', '2' => '2', '3' => '3', '4' => '4'], 'default' => '1'],
                            'lg' => ['label' => esc_html__('Columns LG Devices', 'frameflow'), 'options' => ['1' => '1', '2' => '2', '3' => '3', '4' => '4'], 'default' => '1'],
                            'xl' => ['label' => esc_html__('Columns XL Devices', 'frameflow'), 'options' => ['1' => '1', '2' => '2', '3' => '3', '4' => '4'], 'default' => '1'],
                            'xxl' => ['label' => esc_html__('Columns XXL Devices', 'frameflow'), 'options' => ['1' => '1', '2' => '2', '3' => '3', '4' => '4'], 'default' => '1'],
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
                            'default' => false,
                        ),
                        array(
                            'name' => 'pagination',
                            'label' => esc_html__('Show Pagination', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => false,
                        ),
                        frameflow_widget_select_control(
                            'pagination_type',
                            esc_html__('Pagination Type', 'frameflow'),
                            [
                                'bullets' => 'Bullets',
                                'fraction' => 'Fraction',
                                'progressbar' => 'Progressbar',
                            ],
                            [
                                'default' => 'bullets',
                                'condition' => [
                                    'pagination' => 'true',
                                ],
                            ]
                        ),
                        frameflow_widget_carousel_arrows_type_control(),
                        array(
                            'name' => 'pause_on_hover',
                            'label' => esc_html__('Pause on Hover', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => false,
                        ),
                        array(
                            'name' => 'autoplay',
                            'label' => esc_html__('Autoplay', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => false,
                        ),
                        array(
                            'name' => 'autoplay_speed',
                            'label' => esc_html__('Autoplay Delay', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'default' => 5000,
                            'condition' => [
                                'autoplay' => 'true',
                            ],
                        ),
                        array(
                            'name' => 'infinite',
                            'label' => esc_html__('Infinite Loop', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => false,
                        ),
                        array(
                            'name' => 'speed',
                            'label' => esc_html__('Animation Speed', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'default' => 500,
                        ),
                        array(
                            'name' => 'drap',
                            'label' => esc_html__('Show Scroll Drap', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => false,
                        ),
                        array(
                            'name' => 'item_padding_r',
                            'label' => esc_html__('Item Padding', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => ['px'],
                            'default' => [
                                'top' => '15',
                                'right' => '15',
                                'bottom' => '15',
                                'left' => '15'
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-swiper-container' => 'margin-top: -{{TOP}}{{UNIT}}; margin-right: -{{RIGHT}}{{UNIT}}; margin-bottom: -{{BOTTOM}}{{UNIT}}; margin-left: -{{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-swiper-container .pxl-swiper-slide' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
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
