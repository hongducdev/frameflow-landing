<?php
// Register Contact Widget
use \Elementor\Controls_Manager;

pxl_add_custom_widget(
    array(
        'name' => 'pxl_contact',
        'title' => esc_html__('Case Contact', 'frameflow'),
        'icon' => 'eicon-envelope icon-brand-elementor',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name'     => 'section_content',
                    'label'    => esc_html__('Content', 'frameflow'),
                    'tab'      => Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        frameflow_widget_icons_control(
                            'pxl_icon',
                            esc_html__('Icon', 'frameflow'),
                            [
                                'default' => [
                                    'value'   => 'fas fa-envelope',
                                    'library' => 'fa-solid',
                                ],
                            ]
                        ),
                        frameflow_widget_text_control(
                            'title',
                            esc_html__('Title', 'frameflow'),
                            [
                                'label_block' => true,
                                'default'     => esc_html__('Contact Title', 'frameflow'),
                            ]
                        ),
                        frameflow_widget_wysiwyg_control(
                            'description',
                            esc_html__('Description', 'frameflow'),
                            [
                                'default' => esc_html__('Enter your description here. Click to edit.', 'frameflow'),
                            ]
                        ),
                        frameflow_widget_url_control(
                            'link',
                            esc_html__('Link', 'frameflow'),
                            [
                                'condition' => [
                                    'style' => 'style-3',
                                ],
                            ]
                        ),
                    ),
                ),

                array(
                    'name'     => 'section_style_general',
                    'label'    => esc_html__('General', 'frameflow'),
                    'tab'      => Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_select_control(
                            'style',
                            esc_html__('Style', 'frameflow'),
                            [
                                'style-1' => esc_html__('Style 1', 'frameflow'),
                                'style-2' => esc_html__('Style 2', 'frameflow'),
                                'style-3' => esc_html__('Style 3', 'frameflow'),
                                'style-4' => esc_html__('Style 4', 'frameflow'),
                            ],
                            [
                                'default'       => 'style-1',
                                'prefix_class'  => 'pxl-contact-',
                            ]
                        ),
                        frameflow_widget_select_control(
                            'direction',
                            esc_html__('Direction', 'frameflow'),
                            [
                                'column' => esc_html__('Column', 'frameflow'),
                                'row' => esc_html__('Row', 'frameflow'),
                            ],
                            [
                                'default' => 'column',
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-contact' => 'flex-direction: {{VALUE}};',
                                ],
                                'control_type' => 'responsive',
                            ]
                        ),
                        frameflow_widget_choose_control(
                            'align',
                            esc_html__('Alignment', 'frameflow'),
                            [
                                'start' => [
                                    'title' => esc_html__('Left', 'frameflow'),
                                    'icon' => 'fa fa-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__('Center', 'frameflow'),
                                    'icon' => 'fa fa-align-center',
                                ],
                                'end' => [
                                    'title' => esc_html__('Right', 'frameflow'),
                                    'icon' => 'fa fa-align-right',
                                ],
                            ],
                            [
                                'default' => 'start',
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-contact' => 'justify-content: {{VALUE}};',
                                ],
                                'control_type' => 'responsive',
                            ]
                        ),
                        frameflow_widget_choose_control(
                            'align_items',
                            esc_html__('Items Alignment', 'frameflow'),
                            [
                                'flex-start' => [
                                    'title' => esc_html__('Left', 'frameflow'),
                                    'icon' => 'fa fa-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__('Center', 'frameflow'),
                                    'icon' => 'fa fa-align-center',
                                ],
                                'flex-end' => [
                                    'title' => esc_html__('Right', 'frameflow'),
                                    'icon' => 'fa fa-align-right',
                                ],
                            ],
                            [
                                'default' => 'center',
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-contact' => 'align-items: {{VALUE}};',
                                ],
                                'control_type' => 'responsive',
                            ]
                        ),
                        frameflow_widget_choose_control(
                            'justify_content',
                            esc_html__('Justify Content', 'frameflow'),
                            [
                                'flex-start' => [
                                    'title' => esc_html__('Left', 'frameflow'),
                                    'icon' => 'fa fa-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__('Center', 'frameflow'),
                                    'icon' => 'fa fa-align-center',
                                ],
                                'flex-end' => [
                                    'title' => esc_html__('Right', 'frameflow'),
                                    'icon' => 'fa fa-align-right',
                                ],
                            ],
                            [
                                'default' => 'center',
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-contact' => 'justify-content: {{VALUE}};',
                                ],
                                'control_type' => 'responsive',
                            ]
                        ),
                        array(
                            'name' => 'gap',
                            'label' => esc_html__('Gap', 'frameflow'),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'size' => 10,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-contact' => 'gap: {{SIZE}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                        ),
                        frameflow_widget_dimensions_control(
                            'padding',
                            esc_html__('Padding', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-contact' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'background_color',
                            esc_html__('Background Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-contact' => 'background-color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_select_control(
                            'border_style',
                            esc_html__('Border Style', 'frameflow'),
                            [
                                'none' => esc_html__('None', 'frameflow'),
                                'solid' => esc_html__('Solid', 'frameflow'),
                                'dashed' => esc_html__('Dashed', 'frameflow'),
                                'dotted' => esc_html__('Dotted', 'frameflow'),
                            ],
                            [
                                'default' => 'none',
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-contact' => 'border-style: {{VALUE}};',
                                ],
                            ]
                        ),
                        frameflow_widget_dimensions_control(
                            'border_width',
                            esc_html__('Border Width', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-contact' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'border_color',
                            esc_html__('Border Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-contact' => 'border-color: {{VALUE}};',
                            ]
                        ),
                    ),
                ),

                array(
                    'name'     => 'section_style_icon',
                    'label'    => esc_html__('Icon', 'frameflow'),
                    'tab'      => Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_color_control(
                            'icon_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-contact .pxl-item--icon i'   => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-contact .pxl-item--icon svg path' => 'fill: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'icon_color_hover',
                            esc_html__('Color Hover', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-contact:hover .pxl-item--icon i'   => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-contact:hover .pxl-item--icon svg' => 'fill: {{VALUE}};',
                            ]
                        ),
                        array(
                            'name'         => 'icon_font_size',
                            'label'        => esc_html__('Size', 'frameflow'),
                            'type'         => Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units'   => ['px'],
                            'range'        => [
                                'px' => ['min' => 0, 'max' => 200],
                            ],
                            'selectors'    => [
                                '{{WRAPPER}} .pxl-contact .pxl-item--icon i'   => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-contact .pxl-item--icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name'         => 'icon_bottom_spacer',
                            'label'        => esc_html__('Bottom Spacer', 'frameflow'),
                            'type'         => Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units'   => ['px'],
                            'range'        => [
                                'px' => ['min' => 0, 'max' => 200],
                            ],
                            'selectors'    => [
                                '{{WRAPPER}} .pxl-contact .pxl-item--icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name'         => 'icon_box_size',
                            'label'        => esc_html__('Box Size', 'frameflow'),
                            'type'         => Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units'   => ['px'],
                            'range'        => [
                                'px' => ['min' => 0, 'max' => 200],
                            ],
                            'selectors'    => [
                                '{{WRAPPER}} .pxl-contact .pxl-item--icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-contact .pxl-item--icon' => '--size-box-icon: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name'     => 'icon_border_radius',
                            'label'    => esc_html__('Border Radius', 'frameflow'),
                            'type'     => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%'],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-contact .pxl-item--icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                        frameflow_widget_color_control(
                            'icon_box_background_color',
                            esc_html__('Box Background Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-contact .pxl-item--icon' => 'background-color: {{VALUE}};',
                            ]
                        ),
                        array(
                            'name'         => 'icon_box_shadow',
                            'label' => esc_html__('Box Shadow', 'frameflow'),
                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-contact .pxl-item--icon',
                        ),
                        frameflow_widget_select_control(
                            'icon_border_style',
                            esc_html__('Border Style', 'frameflow'),
                            [
                                'none' => esc_html__('None', 'frameflow'),
                                'solid' => esc_html__('Solid', 'frameflow'),
                                'dashed' => esc_html__('Dashed', 'frameflow'),
                                'dotted' => esc_html__('Dotted', 'frameflow'),
                            ],
                            [
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-contact .pxl-item--icon' => 'border-style: {{VALUE}};',
                                ],
                            ]
                        ),
                        frameflow_widget_dimensions_control(
                            'icon_border_width',
                            esc_html__('Border Width', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-contact .pxl-item--icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            [
                                'condition' => [
                                    'icon_border_style!' => 'none',
                                ],
                            ]
                        ),
                        frameflow_widget_color_control(
                            'icon_border_color',
                            esc_html__('Border Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-contact .pxl-item--icon' => 'border-color: {{VALUE}};',
                            ],
                            [
                                'condition' => [
                                    'icon_border_style!' => 'none',
                                ],
                            ]
                        ),
                    ),
                ),

                array(
                    'name'     => 'section_style_link',
                    'label'    => esc_html__('Link', 'frameflow'),
                    'tab'      => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'style' => 'style-3',
                    ],
                    'controls' => array(
                        frameflow_widget_color_control(
                            'link_icon_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-contact .pxl-item--link svg path' => 'fill: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'link_icon_color_hover',
                            esc_html__('Color Hover', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-contact .pxl-item--link:hover svg path' => 'fill: {{VALUE}};',
                            ]
                        ),
                        array(
                            'name'         => 'link_icon_size',
                            'label'        => esc_html__('Size', 'frameflow'),
                            'type'         => Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units'   => ['px'],
                            'range'        => [
                                'px' => ['min' => 0, 'max' => 200],
                            ],
                            'selectors'    => [
                                '{{WRAPPER}} .pxl-contact .pxl-item--link svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name'         => 'link_box_size',
                            'label'        => esc_html__('Box Size', 'frameflow'),
                            'type'         => Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units'   => ['px'],
                            'range'        => [
                                'px' => ['min' => 0, 'max' => 200],
                            ],
                            'selectors'    => [
                                '{{WRAPPER}} .pxl-contact .pxl-item--link' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        frameflow_widget_color_control(
                            'link_box_background_color',
                            esc_html__('Box Background Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-contact .pxl-item--link' => 'background-color: {{VALUE}};',
                            ]
                        ),
                        array(
                            'name'       => 'link_border_radius',
                            'label'      => esc_html__('Border Radius', 'frameflow'),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%'],
                            'selectors'  => [
                                '{{WRAPPER}} .pxl-contact .pxl-item--link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                        frameflow_widget_select_control(
                            'link_border_style',
                            esc_html__('Border Style', 'frameflow'),
                            [
                                'none' => esc_html__('None', 'frameflow'),
                                'solid' => esc_html__('Solid', 'frameflow'),
                                'dashed' => esc_html__('Dashed', 'frameflow'),
                                'dotted' => esc_html__('Dotted', 'frameflow'),
                            ],
                            [
                                'default' => 'none',
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-contact .pxl-item--link' => 'border-style: {{VALUE}};',
                                ],
                            ]
                        ),
                        frameflow_widget_dimensions_control(
                            'link_border_width',
                            esc_html__('Border Width', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-contact .pxl-item--link' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            [
                                'condition' => [
                                    'link_border_style!' => 'none',
                                ],
                            ]
                        ),
                        frameflow_widget_color_control(
                            'link_border_color',
                            esc_html__('Border Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-contact .pxl-item--link' => 'border-color: {{VALUE}};',
                            ],
                            [
                                'condition' => [
                                    'link_border_style!' => 'none',
                                ],
                            ]
                        ),
                    ),
                ),

                array(
                    'name'     => 'section_style_title',
                    'label'    => esc_html__('Title', 'frameflow'),
                    'tab'      => Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_title_tag_control('title_tag', esc_html__('HTML Tag', 'frameflow'), 'h5'),
                        frameflow_widget_color_control(
                            'title_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-contact .pxl-item--title' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_typography_control(
                            'title_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-contact .pxl-item--title'
                        ),
                        array(
                            'name'         => 'title_bottom_spacer',
                            'label'        => esc_html__('Bottom Spacer', 'frameflow'),
                            'type'         => Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units'   => ['px'],
                            'range'        => [
                                'px' => ['min' => 0, 'max' => 200],
                            ],
                            'selectors'    => [
                                '{{WRAPPER}} .pxl-contact .pxl-item--title' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
                            ],
                        ),
                    ),
                ),

                array(
                    'name'     => 'section_style_description',
                    'label'    => esc_html__('Description', 'frameflow'),
                    'tab'      => Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_color_control(
                            'desc_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-contact .pxl-item--description,{{WRAPPER}} .pxl-contact .pxl-item--description p' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'desc_link_color',
                            esc_html__('Link Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-contact .pxl-item--description p a' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_typography_control(
                            'desc_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-contact .pxl-item--description,{{WRAPPER}} .pxl-contact .pxl-item--description p'
                        ),
                        frameflow_widget_typography_control(
                            'desc_link_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-contact .pxl-item--description p a'
                        ),
                        array(
                            'name'         => 'desc_max_width',
                            'label'        => esc_html__('Max Width', 'frameflow'),
                            'type'         => Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units'   => ['px', '%'],
                            'range'        => [
                                'px' => ['min' => 0, 'max' => 3000],
                                '%'  => ['min' => 0, 'max' => 100],
                            ],
                            'selectors'    => [
                                '{{WRAPPER}} .pxl-contact .pxl-item--description' => 'max-width: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name'         => 'desc_top_spacer',
                            'label'        => esc_html__('Top Spacer', 'frameflow'),
                            'type'         => Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units'   => ['px'],
                            'range'        => [
                                'px' => ['min' => 0, 'max' => 200],
                            ],
                            'selectors'    => [
                                '{{WRAPPER}} .pxl-contact .pxl-item--description' => 'margin-top: {{SIZE}}{{UNIT}} !important;',
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
