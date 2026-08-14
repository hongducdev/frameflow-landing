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
                                '3' => [
                                    'label' => esc_html__('Layout 3', 'frameflow'),
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_icon_box/layout3.webp'
                                ],
                                '4' => [
                                    'label' => esc_html__('Layout 4', 'frameflow'),
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_icon_box/layout4.webp'
                                ],
                                '5' => [
                                    'label' => esc_html__('Layout 5', 'frameflow'),
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_icon_box/layout5.webp'
                                ],
                                '6' => [
                                    'label' => esc_html__('Layout 6', 'frameflow'),
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_icon_box/layout6.webp'
                                ],
                                '7' => [
                                    'label' => esc_html__('Layout 7', 'frameflow'),
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_icon_box/layout7.webp'
                                ],
                                '8' => [
                                    'label' => esc_html__('Layout 8', 'frameflow'),
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_icon_box/layout8.webp'
                                ],
                                '9' => [
                                    'label' => esc_html__('Layout 9', 'frameflow'),
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_icon_box/layout9.webp'
                                ],
                                '10' => [
                                    'label' => esc_html__('Layout 10', 'frameflow'),
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_icon_box/layout10.webp'
                                ],
                                '11' => [   
                                    'label' => esc_html__('Layout 11', 'frameflow'),
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_icon_box/layout11.webp'
                                ],
                                '12' => [
                                    'label' => esc_html__('Layout 12', 'frameflow'),
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_icon_box/layout12.webp'
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
                            'sub_title',
                            esc_html__('Sub Title', 'frameflow'),
                            [
                                'label_block' => true,
                                'condition' => [
                                    'layout' => ['8'],
                                ],
                            ]
                        ),
                        frameflow_widget_text_control(
                            'title',
                            esc_html__('Title', 'frameflow'),
                            [
                                'label_block' => true,
                                'condition' => [
                                    'layout' => ['1', '2', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
                                ],
                            ]
                        ),
                        frameflow_widget_textarea_control(
                            'desc',
                            esc_html__('Description', 'frameflow'),
                            [
                                'rows' => 10,
                                'show_label' => false,
                                'condition' => [
                                    'layout' => ['1', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
                                ],
                            ]
                        ),
                        frameflow_widget_wysiwyg_control(
                            'desc_2',
                            esc_html__('Description 2', 'frameflow'),
                            [
                                'rows' => 10,
                                'show_label' => false,
                                'condition' => [
                                    'layout' => ['2', '3'],
                                ],
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
                        frameflow_widget_text_control(
                            'link_text',
                            esc_html__('Link Text', 'frameflow'),
                            [
                                'condition' => [
                                    'layout' => ['6', '7', '8', '9'],
                                ],
                            ]
                        ),
                        frameflow_widget_url_control(
                            'link',
                            esc_html__('Link', 'frameflow'),
                            [
                                'condition' => [
                                    'layout' => ['2', '3', '6', '7', '8', '9'],
                                ],
                            ]
                        ),
                        frameflow_widget_media_control(
                            'image',
                            esc_html__('Image', 'frameflow'),
                            [
                                'condition' => [
                                    'layout' => ['9'],
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
                        frameflow_widget_select_control(
                            'style_layout_7',
                            esc_html__('Style Layout 7', 'frameflow'),
                            [
                                'style-layout-7-1' => 'Style Layout 7 1',
                                'style-layout-7-2' => 'Style Layout 7 2',
                                'style-layout-7-3' => 'Style Layout 7 3',
                                'style-layout-7-4' => 'Style Layout 7 4',
                            ],
                            [
                                'default' => 'style-layout-7-1',
                                'condition' => [
                                    'layout' => '7',
                                ],
                            ]
                        ),
                        frameflow_widget_color_control(
                            'bg_color',
                            esc_html__('Box Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box' => 'background-color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'bg_color_gradient_from_7',
                            esc_html__('Box Color Gradient From', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box' => '--gradient-background-from: {{VALUE}};',
                            ],
                            [
                                'condition' => [
                                    'style_layout_7' => 'style-layout-7-2',
                                ],
                            ]
                        ),
                        frameflow_widget_color_control(
                            'bg_color_gradient_to_7',
                            esc_html__('Box Color Gradient To', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box' => '--gradient-background-to: {{VALUE}};',
                            ],
                            [
                                'condition' => [
                                    'style_layout_7' => 'style-layout-7-2',
                                ],
                            ]
                        ),
                        frameflow_widget_color_control(
                            'border_color',
                            esc_html__('Border Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box' => 'border-color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-icon-box2::after' => 'border-color: {{VALUE}};', 
                            ],
                            [
                                'condition' => [
                                    'layout' => ['1', '2', '6', '7', '10'],
                                ],
                            ]
                        ),
                        frameflow_widget_color_control(
                            'border_color_active_2',
                            esc_html__('Border Color Active', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box2::before' => 'border-color: {{VALUE}};', 
                            ],
                            [
                                'condition' => [
                                    'layout' => ['2'],
                                ],
                            ]
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
                        frameflow_widget_slider_control(
                            'gap',
                            esc_html__('Gap', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box' => 'gap: {{SIZE}}{{UNIT}} !important;',
                            ],
                        ),
                        array(
                            'name' => 'max_width',
                            'label' => esc_html__('Max Width', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px','%'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 3000,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-icon-box' => 'max-width: {{SIZE}}{{UNIT}} !important;',
                            ],
                            'condition' => [
                                'layout' => ['4'],
                            ],
                            'control_type' => 'responsive',
                        )
                    ),
                ),
                array(
                    'name' => 'section_style_sub_title',
                    'label' => esc_html__('Sub Title', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'layout' => ['8'],
                    ],
                    'controls' => array(
                        frameflow_widget_color_control(
                            'sub_title_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box8 .pxl-item--sub-title' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_typography_control(
                            'sub_title_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-icon-box8 .pxl-item--sub-title'
                        ),
                        frameflow_widget_color_control(
                            'sub_title_background_color',
                            esc_html__('Background Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box8 .pxl-item--sub-title' => 'background-color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_dimensions_control(
                            'sub_title_padding',
                            esc_html__('Padding', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box8 .pxl-item--sub-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            ['size_units' => ['px']]
                        ),
                        frameflow_widget_dimensions_control(
                            'sub_title_margin',
                            esc_html__('Margin', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box8 .pxl-item--sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            ['size_units' => ['px']]
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
                                '{{WRAPPER}} .pxl-icon-box .pxl-item--title,{{WRAPPER}} .pxl-icon-box .pxl-item--title a' => 'color: {{VALUE}};',
                            ],
                        ),
                        frameflow_widget_color_control(
                            'title_color_bottom',
                            esc_html__('Color Bottom', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box .pxl-item--bottom .pxl-item--title' => 'color: {{VALUE}};',
                            ],
                            [
                                'condition' => [
                                    'layout' => ['10'],
                                ],
                            ]
                        ),
                        frameflow_widget_typography_control(
                            'title_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-icon-box .pxl-item--title,{{WRAPPER}} .pxl-icon-box .pxl-item--title a'
                        ),
                        array(
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
                                '{{WRAPPER}} .pxl-icon-box .pxl-item--title' => 'margin-top: {{SIZE}}{{UNIT}} !important;',
                            ],
                        ),
                        array(
                            'name' => 'title_bottom_spacer',
                            'label' => esc_html__('Bottom Spacer', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-icon-box .pxl-item--title' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_desc',
                    'label' => esc_html__('Description', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'max_width_desc',
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
                                '{{WRAPPER}} .pxl-icon-box .pxl-item--description,{{WRAPPER}} .pxl-icon-box .pxl-item--desc' => 'max-width: {{SIZE}}{{UNIT}} !important;',
                            ],
                            'control_type' => 'responsive',
                        ),
                        frameflow_widget_color_control(
                            'desc_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box .pxl-item--description,{{WRAPPER}} .pxl-icon-box .pxl-item--desc' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_typography_control(
                            'desc_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-icon-box .pxl-item--description,{{WRAPPER}} .pxl-icon-box .pxl-item--desc'
                        ),
                        frameflow_widget_color_control(
                            'link_color',
                            esc_html__('Link Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box .pxl-item--description a,{{WRAPPER}} .pxl-icon-box .pxl-item--desc a' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'link_hover_color',
                            esc_html__('Link Hover Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box .pxl-item--description a:hover,{{WRAPPER}} .pxl-icon-box .pxl-item--desc a:hover' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_typography_control(
                            'link_typography',
                            esc_html__('Link Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-icon-box .pxl-item--description a,{{WRAPPER}} .pxl-icon-box .pxl-item--desc a'
                        ),
                        array(
                            'name' => 'desc_max_width',
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
                                '{{WRAPPER}} .pxl-icon-box .pxl-item--description,{{WRAPPER}} .pxl-icon-box .pxl-item--desc' => 'max-width: {{SIZE}}{{UNIT}} !important;',
                            ],
                            'condition' => [
                                'layout' => ['2', '3', '6'],
                            ],
                        )
                    ),
                ),
                array(
                    'name' => 'section_style_icon',
                    'label' => esc_html__('Icon', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_select_control(
                            'animate_hover',
                            esc_html__('Animation Icon', 'frameflow'),
                            [
                                'ani1' => esc_html__('Style 1', 'frameflow'),
                                'ani2' => esc_html__('Style 2', 'frameflow'),
                                'ani3' => esc_html__('Off', 'frameflow'),
                            ],
                            [
                                'default' => 'ani1',
                                'condition' => [
                                    'layout' => '1',
                                ],
                            ]
                        ),
                        array(
                            'name' => 'rdspace_pd',
                            'label' => esc_html__('Border Radius', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => ['px'],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-item--icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                            ],
                            'control_type' => 'responsive',
                        ),
                        frameflow_widget_select_control(
                            'border_type_icon',
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
                                    '{{WRAPPER}} .pxl-item--icon' => 'border-style: {{VALUE}} !important;',
                                ],
                                'condition' => [
                                    'layout' => ['6', '7'],
                                ],
                            ]
                        ),
                        array(
                            'name' => 'border_width',
                            'label' => esc_html__('Border Width', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-item--icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                            ],
                            'condition' => [
                                'border_type_icon!' => '',
                                'layout' => ['6', '7'],
                            ],
                            'control_type' => 'responsive',
                        ),
                        frameflow_widget_color_control(
                            'border_color_box',
                            esc_html__('Border Color Box', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box .pxl-item--icon' => 'border-color: {{VALUE}};',
                            ],
                            [
                                'condition' => [
                                    'layout' => ['6', '7'],
                                ],
                                'control_type' => 'responsive',
                            ]
                        ),
                        array(
                            'name' => 'box_shadow_box_icon',
                            'label' => esc_html__('Box Shadow', 'frameflow'),
                            'type' => \Elementor\Group_Control_Box_Shadow::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-icon-box .pxl-item--icon'
                        ),
                        frameflow_widget_select_control(
                            'style_icon_cl',
                            esc_html__('Style Icon', 'frameflow'),
                            [
                                'ic' => 'Icon',
                                'svg' => 'Svg',
                            ],
                            ['default' => 'ic']
                        ),
                        frameflow_widget_select_control(
                            'style_svg_cl',
                            esc_html__('Style SVG', 'frameflow'),
                            [
                                'fill' => 'Fill',
                                'stroke' => 'Stroke',
                            ],
                            [
                                'condition' => [
                                    'style_icon_cl' => 'svg',
                                ],
                            ]
                        ),
                        frameflow_widget_color_control(
                            'bgicolor',
                            esc_html__('Background Icon Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box .pxl-item--icon' => 'background-color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'bgicolor_hover',
                            esc_html__('Background Icon Color Hover', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box:hover .pxl-item--icon' => 'background-color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'box_color_gradient_from_7',
                            esc_html__('Box Color Gradient From', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box7 .pxl-item--icon' => '--gradient-box-icon-from: {{VALUE}};',
                            ],
                            [
                                'condition' => [
                                    'layout' => '7',
                                ],
                            ]
                        ),
                        frameflow_widget_color_control(
                            'box_color_gradient_to_7',
                            esc_html__('Box Color Gradient To', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box7 .pxl-item--icon' => '--gradient-box-icon-to: {{VALUE}};',
                            ],
                            [
                                'condition' => [
                                    'layout' => '7',
                                ],
                            ]
                        ),
                        frameflow_widget_color_control(
                            'color_drop_shadow_7',
                            esc_html__('Color Drop Shadow', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box7 .pxl-item--icon' => '--color-drop-shadow: {{VALUE}};',
                            ],
                            [
                                'condition' => [
                                    'layout' => '7',
                                ],
                            ]
                        ),
                        frameflow_widget_color_control(
                            'bgicolor_hv',
                            esc_html__('Background Icon Color (Hover)', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box:hover .pxl-item--icon' => 'background-color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'icon_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box .pxl-item--icon i' => 'color: {{VALUE}};text-fill-color: {{VALUE}};-webkit-text-fill-color: {{VALUE}};background-image: none;',
                            ],
                            [
                                'condition' => [
                                    'icon_type' => 'icon',
                                    'style_icon_cl' => 'ic',
                                ],
                            ]
                        ),
                        frameflow_widget_color_control(
                            'icon_color_hover',
                            esc_html__('Color Hover', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box:hover .pxl-item--icon i' => 'color: {{VALUE}};text-fill-color: {{VALUE}};-webkit-text-fill-color: {{VALUE}};background-image: none;',
                            ],
                            [
                                'condition' => [
                                    'icon_type' => 'icon',
                                    'style_icon_cl' => 'ic',
                                ],
                            ]
                        ),
                        frameflow_widget_color_control(
                            'icon_fill_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box .pxl-item--icon svg path' => 'fill: {{VALUE}} ;',
                                '{{WRAPPER}} .pxl-icon-box .pxl-item--icon svg polygon' => 'fill: {{VALUE}} ;',
                            ],
                            [
                                'condition' => [
                                    'style_svg_cl' => 'fill',
                                    'style_icon_cl' => 'svg',
                                ],
                            ]
                        ),
                        frameflow_widget_color_control(
                            'icon_fill_color_hv',
                            esc_html__('Color Hover', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box:hover .pxl-item--icon svg path' => 'fill: {{VALUE}} ;',
                                '{{WRAPPER}} .pxl-icon-box:hover .pxl-item--icon svg polygon' => 'fill: {{VALUE}} ;',
                            ],
                            [
                                'condition' => [
                                    'style_svg_cl' => 'fill',
                                    'style_icon_cl' => 'svg',
                                ],
                            ]
                        ),
                        frameflow_widget_color_control(
                            'icon_stroke_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box .pxl-item--icon svg' => 'stroke: {{VALUE}} ;',
                            ],
                            [
                                'condition' => [
                                    'style_svg_cl' => 'stroke',
                                    'style_icon_cl' => 'svg',
                                ],
                            ]
                        ),
                        frameflow_widget_color_control(
                            'icon_stroke_color_hv',
                            esc_html__('Color Hover', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box:hover .pxl-item--icon svg' => 'stroke: {{VALUE}} ;',
                            ],
                            [
                                'condition' => [
                                    'style_svg_cl' => 'stroke',
                                    'style_icon_cl' => 'svg',
                                ],
                            ]
                        ),
                        array(
                            'name' => 'icon_font_ww_h',
                            'label' => esc_html__('Icon Width/Height', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-icon-box .pxl-item--icon' => '--width-box-icon: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'icon_font_size',
                            'label' => esc_html__('Size', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-icon-box .pxl-item--icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-icon-box .pxl-item--icon svg' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'icon_type' => 'icon',
                            ],
                        ),

                        array(
                            'name' => 'space_r',
                            'label' => esc_html__('Space Right ', 'frameflow'),
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
                                '{{WRAPPER}} .pxl-icon-box .pxl-item--inner' => 'column-gap: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'layout' => ['1'],
                                'style' => ['style-2'],
                            ],
                        ),

                        array(
                            'name' => 'space_t',
                            'label' => esc_html__('Space Top ', 'frameflow'),
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
                                '{{WRAPPER}} .pxl-icon-box .pxl-item--inner .pxl-item--icon i,{{WRAPPER}} .pxl-icon-box .pxl-item--inner .pxl-item--icon svg,{{WRAPPER}} .pxl-icon-box .pxl-item--inner .pxl-item--icon img' => 'margin-top: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'layout' => ['1'],
                                'style' => ['style-2'],
                            ],
                        ),
                        array(
                            'name' => 'box_wh',
                            'label' => esc_html__('Box Width/Height', 'frameflow'),
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
                                '{{WRAPPER}} .pxl-icon-box .pxl-item--icon' => 'width: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}',
                            ],
                            'condition' => [
                                'layout' => ['1', '5'],
                                'style' => ['style-2'],
                            ],
                        ),
                        frameflow_widget_color_control(
                            'icon_box_color',
                            esc_html__('Box Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box .pxl-item--icon' => 'background-color: {{VALUE}};',
                            ],
                            [
                                'condition' => [
                                    'layout' => '1',
                                ],
                            ]
                        ),
                        array(
                            'name' => 'icon_box_min_width',
                            'label' => esc_html__('Box Min Width', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-icon-box .pxl-item--icon' => 'min-width: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'icon_type' => 'image',
                            ],
                        ),
                        array(
                            'name' => 'icon_img_max_height',
                            'label' => esc_html__('Image Max Height', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-icon-box .pxl-item--icon img' => 'max-height: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'icon_type' => 'image',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_link',
                    'label' => esc_html__('Link', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'layout' => ['2', '6', '8', '9'],
                    ],
                    'controls' => array(
                        frameflow_widget_color_control(
                            'link_color_box',
                            esc_html__('Box Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box .pxl-item--link' => 'background-color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'link_border_color_box',
                            esc_html__('Border Color Box', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box .pxl-item--link' => 'border-color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'link_color_text',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box .pxl-item--link' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'link_color_hover',
                            esc_html__('Color Hover', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box .pxl-item--link:hover' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_typography_control(
                            'link_text_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-icon-box .pxl-item--link'
                        ),
                        frameflow_widget_color_control(
                            'link_text_icon_color',
                            esc_html__('Icon Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-icon-box .pxl-item--link svg' => 'color: {{VALUE}};',
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
