<?php
// Register Icon Box Widget
pxl_add_custom_widget(
    array(
        'name' => 'pxl_icon_box',
        'title' => esc_html__('Case Icon Box', 'frameflow'),
        'icon' => 'eicon-icon-box icon-brand-elementor',
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
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_icon_box/layout1.webp'
                                ],
                                '2' => [
                                    'label' => esc_html__('Layout 2', 'frameflow'),
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_icon_box/layout2.webp'
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
                            'title',
                            esc_html__('Title', 'frameflow')
                        ),
                        frameflow_widget_textarea_control(
                            'desc',
                            esc_html__('Description', 'frameflow'),
                            [
                                'rows' => 10,
                                'show_label' => false,
                            ]
                        ),
                        frameflow_widget_select_control(
                            'icon_type',
                            esc_html__('Icon Type', 'frameflow'),
                            [
                                'icon' => 'Icon',
                                'image' => 'Image',
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
                ),
                array(
                    'name' => 'section_style_general',
                    'label' => esc_html__('General', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_color_control(
                            'bg_color',
                            esc_html__('Box Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box' => 'background-color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'border_color',
                            esc_html__('Border Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box' => 'border-color: {{VALUE}};',
                            ],
                        ),
                        frameflow_widget_dimensions_control(
                            'border_radius',
                            esc_html__('Border Radius', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box, {{WRAPPER}} .pxl-icon-box2::before, {{WRAPPER}} .pxl-icon-box2::after, {{WRAPPER}} .pxl-icon-box10 .pxl-item--bottom' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                            ],
                        ),
                        frameflow_widget_dimensions_control(
                            'item_padding',
                            esc_html__('Box Padding', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_title',
                    'label' => esc_html__('Title', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_slider_control(
                            'max_width_title',
                            esc_html__('Max Width', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box .pxl-item--title' => 'max-width: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        frameflow_widget_title_tag_control('title_tag', esc_html__('HTML Tag', 'frameflow'), 'h5'),
                        frameflow_widget_color_control(
                            'title_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box .pxl-item--title' => 'color: {{VALUE}};',
                            ],
                        ),
                        frameflow_widget_typography_control(
                            'title_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-icon-box .pxl-item--title'
                        ),
                        frameflow_widget_dimensions_control(
                            'title_margin',
                            esc_html__('Margin', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box .pxl-item--title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_desc',
                    'label' => esc_html__('Description', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_slider_control(
                            'max_width_desc',
                            esc_html__('Max Width', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box .pxl-item--description' => 'max-width: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        frameflow_widget_color_control(
                            'desc_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box .pxl-item--description' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_typography_control(
                            'desc_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-icon-box .pxl-item--description'
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_icon',
                    'label' => esc_html__('Icon', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_slider_control(
                            'Size Icon',
                            esc_html__('Size Icon', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-item--icon' => '--size-box-icon: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        frameflow_widget_slider_control(
                            'Size Icon',
                            esc_html__('Size Icon', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-item--icon' => '--size-icon: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        frameflow_widget_dimensions_control(
                            'border_radius_icon',
                            esc_html__('Border Radius', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-item--icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                            ],
                        ),
                        array(
                            'name' => 'icon_style_tabs',
                            'control_type' => 'tab',
                            'tabs' => [
                                [
                                    'name' => 'tab_icon_normal',
                                    'label' => esc_html__('Normal', 'frameflow'),
                                    'controls' => [
                                        frameflow_widget_color_control(
                                            'icon_background_normal',
                                            esc_html__('Background', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-item--icon' => 'background-color: {{VALUE}};',
                                            ]
                                        ),
                                        frameflow_widget_color_control(
                                            'icon_color_normal',
                                            esc_html__('Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-item--icon svg path' => 'fill: {{VALUE}};',
                                                '{{WRAPPER}} .pxl-item--icon i' => 'color: {{VALUE}};',
                                            ]
                                        ),
                                        array(
                                            'name' => 'box_shadow_icon_normal',
                                            'label' => esc_html__('Box Shadow', 'frameflow'),
                                            'type' => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector' => '{{WRAPPER}} .pxl-icon-box .pxl-item--icon'
                                        ),
                                    ]
                                ],
                                [
                                    'name' => 'tab_icon_hover',
                                    'label' => esc_html__('Hover', 'frameflow'),
                                    'controls' => [
                                        frameflow_widget_color_control(
                                            'icon_background_hover',
                                            esc_html__('Background', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-icon-box:hover .pxl-item--icon' => 'background-color: {{VALUE}};',
                                            ]
                                        ),
                                        frameflow_widget_color_control(
                                            'icon_color_hover',
                                            esc_html__('Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-icon-box:hover .pxl-item--icon svg path' => 'fill: {{VALUE}};',
                                                '{{WRAPPER}} .pxl-icon-box:hover .pxl-item--icon i' => 'color: {{VALUE}};',
                                            ]
                                        ),
                                        array(
                                            'name' => 'box_shadow_icon_hover',
                                            'label' => esc_html__('Box Shadow', 'frameflow'),
                                            'type' => \Elementor\Group_Control_Box_Shadow::get_type(),
                                            'control_type' => 'group',
                                            'selector' => '{{WRAPPER}} .pxl-icon-box:hover .pxl-item--icon'
                                        ),
                                    ]
                                ]
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
