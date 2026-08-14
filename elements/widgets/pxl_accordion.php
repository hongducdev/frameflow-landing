<?php
$templates_df = ['0' => esc_html__('None', 'frameflow')];
$templates = $templates_df + frameflow_get_templates_option('tab');
pxl_add_custom_widget(
    array(
        'name' => 'pxl_accordion',
        'title' => esc_html__('Case Accordion', 'frameflow'),
        'icon' => 'eicon-accordion icon-brand-elementor',
        'categories' => array('pxltheme-core'),
        'scripts' => array(
            'frameflow-accordion'
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
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_accordion/layout1.webp',
                                ],
                                '2' => [
                                    'label' => esc_html__('Layout 2', 'frameflow'),
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_accordion/layout2.webp',
                                ],
                                '3' => [
                                    'label' => esc_html__('Layout 3', 'frameflow'),
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_accordion/layout3.webp',
                                ],
                                '4' => [
                                    'label' => esc_html__('Layout 4', 'frameflow'),
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_accordion/layout4.webp',
                                ],
                                '5' => [
                                    'label' => esc_html__('Layout 5', 'frameflow'),
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_accordion/layout5.webp',
                                ],
                                '6' => [
                                    'label' => esc_html__('Layout 6', 'frameflow'),
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_accordion/layout6.webp',
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
                            'name' => 'active',
                            'label' => esc_html__('Active', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'separator' => 'after', 
                            'default' => '1',
                            'condition' => [
                                'layout!' => '6',
                            ],
                        ),
                        frameflow_widget_icons_control(
                            'accordion_icon',
                            esc_html__('Accordion Icon', 'frameflow'),
                            [
                                'condition' => [
                                    'layout' => '2',
                                ],
                            ]
                        ),
                        array(
                            'name' => 'accordion',
                            'label' => esc_html__('Accordion', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                frameflow_widget_text_control(
                                    'title',
                                    esc_html__('Title', 'frameflow'),
                                    ['label_block' => true]
                                ),
                                frameflow_widget_textarea_control(
                                    'desc',
                                    esc_html__('Content', 'frameflow'),
                                    ['rows' => 10]
                                ),
                            ),
                            'title_field' => '{{{ title }}}',
                            'separator' => 'after',
                            'condition' => [
                                'layout!' => ['5', '6'],
                            ]
                        ),
                        array(
                            'name' => 'accordion_5',
                            'label' => esc_html__('Accordion', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                frameflow_widget_text_control(
                                    'title_5',
                                    esc_html__('Title', 'frameflow'),
                                    ['label_block' => true]
                                ),
                                frameflow_widget_textarea_control(
                                    'desc_5',
                                    esc_html__('Content', 'frameflow'),
                                    ['rows' => 10]
                                ),
                                frameflow_widget_wysiwyg_control(
                                    'skill_experience_5',
                                    esc_html__('Skill Experience', 'frameflow')
                                ),
                                frameflow_widget_text_control(
                                    'button_text_5',
                                    esc_html__('Button Text', 'frameflow'),
                                    ['label_block' => true]
                                ),
                                frameflow_widget_url_control(
                                    'button_url_5',
                                    esc_html__('Button URL', 'frameflow'),
                                    ['label_block' => true]
                                ),
                            ),
                            'title_field' => '{{{ title_5 }}}',
                            'separator' => 'after',
                            'condition' => [
                                'layout' => '5',
                            ]
                        ),

                    ),
                ),
                array(
                    'name' => 'section_source',
                    'label' => esc_html__('Source', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'condition' => [
                        'layout' => ['4', '6'],
                    ],
                    'controls' => array(
                        frameflow_widget_select_control(
                            'select_post_by',
                            esc_html__('Select posts by', 'frameflow'),
                            [
                                'term_selected' => esc_html__('Terms selected', 'frameflow'),
                                'post_selected' => esc_html__('Posts selected ', 'frameflow'),
                            ],
                            [
                                'multiple' => true,
                                'default'  => 'term_selected',
                            ]
                        ),
                        array(
                            'name'     => 'source_service',
                            'label'    => esc_html__('Select Term of Service', 'frameflow'),
                            'type'     => \Elementor\Controls_Manager::SELECT2,
                            'multiple' => true,
                            'options'  => pxl_get_grid_term_options('service', ['service-category']),
                            'condition' => [
                                'select_post_by' => 'term_selected',
                            ],
                        ),
                        array(
                            'name' => 'source_service_post_ids',
                            'label' => esc_html__('Select posts', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SELECT2,
                            'multiple' => true,
                            'options' => frameflow_list_post('service', false),
                            'label_block' => true,
                            'condition' => [
                                'select_post_by' => 'post_selected',
                            ],
                        ),
                        frameflow_widget_select_control(
                            'orderby',
                            esc_html__('Order By', 'frameflow'),
                            [
                                'date' => esc_html__('Date', 'frameflow'),
                                'ID' => esc_html__('ID', 'frameflow'),
                                'author' => esc_html__('Author', 'frameflow'),
                                'title' => esc_html__('Title', 'frameflow'),
                                'rand' => esc_html__('Random', 'frameflow'),
                            ],
                            ['default' => 'date']
                        ),
                        frameflow_widget_select_control(
                            'order',
                            esc_html__('Sort Order', 'frameflow'),
                            [
                                'desc' => esc_html__('Descending', 'frameflow'),
                                'asc' => esc_html__('Ascending', 'frameflow'),
                            ],
                            ['default' => 'desc']
                        ),
                        array(
                            'name' => 'limit',
                            'label' => esc_html__('Total items', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'default' => '6',
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_general',
                    'label' => esc_html__('General', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_select_control(
                            'style_layout_2',
                            esc_html__('Style Layout 2', 'frameflow'),
                            [
                                'style-layout-2-1' => 'Style Layout 2 1',
                                'style-layout-2-2' => 'Style Layout 2 2',
                                'style-layout-2-3' => 'Style Layout 2 3',
                            ],
                            [
                                'default' => 'style-layout-2-1',
                                'condition' => [
                                    'layout' => '2',
                                ],
                            ]
                        ),
                        frameflow_widget_dimensions_control(
                            'item_border_radius',
                            esc_html__('Item Border Radius', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-accordion .pxl-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ]
                        ),
                        frameflow_widget_select_control(
                            'border_type_item',
                            esc_html__('Border Type', 'frameflow'),
                            [
                                ''        => esc_html__('None', 'frameflow'),
                                'solid'   => esc_html__('Solid', 'frameflow'),
                                'double'  => esc_html__('Double', 'frameflow'),
                                'dotted'  => esc_html__('Dotted', 'frameflow'),
                                'dashed'  => esc_html__('Dashed', 'frameflow'),
                                'groove'  => esc_html__('Groove', 'frameflow'),
                            ],
                            [
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-accordion .pxl-item' => 'border-style: {{VALUE}};',
                                ],
                            ]
                        ),
                        array(
                            'name'      => 'border_width',
                            'label'     => esc_html__('Border Width', 'frameflow'),
                            'type'      => \Elementor\Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-accordion .pxl-item' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                            ],
                            'condition' => ['border_type_item!' => ''],
                            'responsive' => true,
                        ),
                        frameflow_widget_slider_control(
                            'item_space_top',
                            esc_html__('Item Space Top', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-accordion .pxl-item + .pxl-item' => 'margin-top: {{SIZE}}{{UNIT}};',
                            ],
                            [
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 300,
                                    ],
                                ],
                            ]
                        ),
                        array(
                            'name' => 'general_style_tabs',
                            'control_type' => 'tab',
                            'tabs' => [
                                [
                                    'name' => 'tab_general_normal',
                                    'label' => esc_html__('Normal', 'frameflow'),
                                    'controls' => [
                                        frameflow_widget_dimensions_control(
                                            'item_padding',
                                            esc_html__('Item Padding ', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-accordion .pxl-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                                            ],
                                            ['size_units' => ['px']]
                                        ),
                                        frameflow_widget_color_control(
                                            'item_background_color',
                                            esc_html__('Item Background Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-accordion .pxl-item' => 'background-color: {{VALUE}};',
                                            ]
                                        ),
                                        frameflow_widget_color_control(
                                            'border_color',
                                            esc_html__('Border Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-accordion .pxl-item' => 'border-color: {{VALUE}};',
                                            ],
                                            ['condition' => ['border_type_item!' => '']]
                                        ),
                                        frameflow_widget_color_control(
                                            'border_color_line',
                                            esc_html__('Border Color Line', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-accordion1:before' => 'background-color: {{VALUE}};',
                                            ],
                                            [
                                                'condition' => [
                                                    'layout' => '1',
                                                ],
                                            ]
                                        ),
                                        frameflow_widget_color_control(
                                            'gradient_from_3',
                                            esc_html__('Gradient From', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-accordion .pxl-item' => '--gradient-background-from: {{VALUE}};',
                                            ],
                                            [
                                                'condition' => [
                                                    'style_layout_2' => 'style-layout-2-3',
                                                ],
                                            ]
                                        ),
                                        frameflow_widget_color_control(
                                            'gradient_to_3',
                                            esc_html__('Gradient To', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-accordion .pxl-item' => '--gradient-background-to: {{VALUE}};',
                                            ],
                                            [
                                                'condition' => [
                                                    'style_layout_2' => 'style-layout-2-3',
                                                ],
                                            ]
                                        ),
                                        frameflow_widget_color_control(
                                            'border-color-3',
                                            esc_html__('Border Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-accordion .pxl-item' => 'border-color: {{VALUE}};',
                                            ],
                                            [
                                                'condition' => [
                                                    'style_layout_2' => 'style-layout-2-3',
                                                ],
                                            ]
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'tab_general_active',
                                    'label' => esc_html__('Active', 'frameflow'),
                                    'controls' => [
                                        frameflow_widget_color_control(
                                            'item_background_color_active',
                                            esc_html__('Item Background Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-accordion .pxl-item.active' => 'background-color: {{VALUE}};',
                                            ]
                                        ),
                                        frameflow_widget_dimensions_control(
                                            'item_padding_at',
                                            esc_html__('Item Padding', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-accordion .pxl-item.active' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                                            ],
                                            ['size_units' => ['px']]
                                        ),
                                        frameflow_widget_color_control(
                                            'border_color_hv',
                                            esc_html__('Border Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-accordion .pxl-item.active' => 'border-color: {{VALUE}};',
                                            ],
                                            ['condition' => ['border_type_item!' => '']]
                                        ),
                                        frameflow_widget_color_control(
                                            'border_color_line_a',
                                            esc_html__('Border Color Line', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-accordion1 .pxl-item.active:before' => 'background-color: {{VALUE}} !important;',
                                            ],
                                            [
                                                'condition' => [
                                                    'layout' => '1',
                                                ],
                                            ]
                                        ),
                                    ],
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_title',
                    'label' => esc_html__('Title', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_typography_control(
                            'title_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-accordion .pxl-item--title-text'
                        ),
                        frameflow_widget_title_tag_control('title_tag', esc_html__('HTML Tag', 'frameflow'), 'h5'),
                        frameflow_widget_dimensions_control(
                            'title_padding',
                            esc_html__('Title Padding', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-accordion .pxl-item--title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            ['size_units' => ['px']]
                        ),
                        array(
                            'name' => 'title_style_tabs',
                            'control_type' => 'tab',
                            'tabs' => [
                                [
                                    'name' => 'tab_title_normal',
                                    'label' => esc_html__('Normal', 'frameflow'),
                                    'controls' => [
                                        frameflow_widget_color_control(
                                            'title_color',
                                            esc_html__('Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-accordion .pxl-item--title-text' => 'color: {{VALUE}};',
                                            ]
                                        ),
                                        frameflow_widget_color_control(
                                            'title_bg_color',
                                            esc_html__('Background Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-accordion .pxl-item--title' => 'background-color: {{VALUE}};',
                                            ]
                                        ),
                                        frameflow_widget_color_control(
                                            'title-icon-bg',
                                            esc_html__('Title Icon Background', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-accordion .pxl-item--title-icon' => 'background-color: {{VALUE}};',
                                            ],
                                            ['condition' => ['layout' => '2']]
                                        ),
                                        frameflow_widget_color_control(
                                            'title_icon_color',
                                            esc_html__('Icon Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-accordion .pxl-item--title-icon span:before, {{WRAPPER}} .pxl-accordion .pxl-item--title-icon span:after' => 'background-color: {{VALUE}};',
                                                '{{WRAPPER}} .pxl-accordion .pxl-item--title-icon svg path' => 'fill: {{VALUE}};',
                                                '{{WRAPPER}} .pxl-accordion .pxl-item--title-icon i' => 'color: {{VALUE}};',
                                            ],
                                            ['condition' => ['layout' => '2']]
                                        ),
                                        frameflow_widget_color_control(
                                            'title_border',
                                            esc_html__('Border Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-accordion .pxl-item--title' => 'border-color: {{VALUE}};',
                                            ]
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'tab_title_active',
                                    'label' => esc_html__('Active', 'frameflow'),
                                    'controls' => [
                                        frameflow_widget_color_control(
                                            'title_color_a',
                                            esc_html__('Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-accordion .pxl-item.active .pxl-item--title-text' => 'color: {{VALUE}};',
                                            ]
                                        ),
                                        frameflow_widget_color_control(
                                            'title_bg_color_a',
                                            esc_html__('Background Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-accordion .pxl-item.active .pxl-item--title' => 'background-color: {{VALUE}};',
                                            ]
                                        ),
                                        frameflow_widget_color_control(
                                            'title-icon-bg-a',
                                            esc_html__('Title Icon Background', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-accordion .pxl-item.active .pxl-item--title-icon' => 'background-color: {{VALUE}}!important;',
                                            ],
                                            ['condition' => ['layout' => '2']]
                                        ),
                                        frameflow_widget_color_control(
                                            'title_icon_color_a',
                                            esc_html__('Icon Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-accordion .pxl-item.active .pxl-item--title-icon span:before, {{WRAPPER}} .pxl-accordion .pxl-item.active .pxl-item--title-icon span:after' => 'background-color: {{VALUE}}!important;',
                                                '{{WRAPPER}} .pxl-accordion .pxl-item.active .pxl-item--title-icon svg path' => 'fill: {{VALUE}} !important;',
                                                '{{WRAPPER}} .pxl-accordion .pxl-item.active .pxl-item--title-icon i' => 'color: {{VALUE}} !important;',
                                            ],
                                            ['condition' => ['layout' => '2']]
                                        ),
                                        frameflow_widget_color_control(
                                            'title_border_a',
                                            esc_html__('Border Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-accordion .pxl-item.active .pxl-item--title' => 'border-color: {{VALUE}};',
                                            ]
                                        ),
                                        frameflow_widget_dimensions_control(
                                            'title_padding_a',
                                            esc_html__('Padding', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-accordion .pxl-item.active .pxl-item--title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                            ['size_units' => ['px']]
                                        ),
                                    ],
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_icon',
                    'label' => esc_html__('Icon', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_slider_control(
                            'icon_box_size',
                            esc_html__('Icon Box Size', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-accordion .pxl-item--title-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                            ],
                            ['range' => ['px' => ['min' => 0, 'max' => 200]]]
                        ),
                        frameflow_widget_dimensions_control(
                            'icon_box_border_radius',
                            esc_html__('Icon Box Border Radius', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-accordion .pxl-item--title-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            ['size_units' => ['px']]
                        ),
                        frameflow_widget_slider_control(
                            'icon_size',
                            esc_html__('Icon Size', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-accordion .pxl-accordion--plus' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                            ],
                            ['range' => ['px' => ['min' => 0, 'max' => 200]]]
                        ),
                        array(
                            'name' => 'icon_style_tabs',
                            'control_type' => 'tab',
                            'tabs' => [
                                [
                                    'name' => 'tab_icon_normal',
                                    'label' => esc_html__('Normal', 'frameflow'),
                                    'controls' => [
                                        frameflow_widget_color_control('icon_bg_color', esc_html__('Background Color', 'frameflow'), [
                                            '{{WRAPPER}} .pxl-accordion .pxl-item--title-icon' => 'background-color: {{VALUE}};',
                                        ]),
                                        frameflow_widget_color_control('icon_border_color', esc_html__('Border Color', 'frameflow'), [
                                            '{{WRAPPER}} .pxl-accordion .pxl-item--title-icon' => 'border-color: {{VALUE}};',
                                        ]),
                                        frameflow_widget_color_control('icon_color', esc_html__('Color', 'frameflow'), [
                                            '{{WRAPPER}} .pxl-accordion .pxl-item--title-icon' => 'color: {{VALUE}};',
                                            '{{WRAPPER}} .pxl-accordion .pxl-item--title-icon svg path' => 'fill: {{VALUE}};',
                                        ]),
                                    ],
                                ],
                                [
                                    'name' => 'tab_icon_active',
                                    'label' => esc_html__('Active', 'frameflow'),
                                    'controls' => [
                                        frameflow_widget_color_control('icon_bg_color_a', esc_html__('Background Color', 'frameflow'), [
                                            '{{WRAPPER}} .pxl-accordion .pxl-item.active .pxl-item--title-icon' => 'background-color: {{VALUE}}!important;',
                                        ]),
                                        frameflow_widget_color_control('icon_border_color_a', esc_html__('Border Color', 'frameflow'), [
                                            '{{WRAPPER}} .pxl-accordion .pxl-item.active .pxl-item--title-icon' => 'border-color: {{VALUE}};',
                                        ]),
                                        frameflow_widget_color_control('icon_color_a', esc_html__('Color', 'frameflow'), [
                                            '{{WRAPPER}} .pxl-accordion .pxl-item.active .pxl-item--title-icon' => 'color: {{VALUE}};',
                                            '{{WRAPPER}} .pxl-accordion .pxl-item.active .pxl-item--title-icon span:before, {{WRAPPER}} .pxl-accordion .pxl-item.active .pxl-item--title-icon span:after' => 'background-color: {{VALUE}} !important;',
                                            '{{WRAPPER}} .pxl-accordion .pxl-item.active .pxl-item--title-icon svg path' => 'fill: {{VALUE}} !important;',
                                        ]),
                                    ],
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_content',
                    'label' => esc_html__('Content', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_slider_control(
                            'content_max_width',
                            esc_html__('Max Width', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-accordion .pxl-item--content-inner' => 'max-width: {{SIZE}}{{UNIT}};',
                            ],
                            [
                                'range' => ['px' => ['min' => 0, 'max' => 1000]],
                                'condition' => [
                                    'layout' => ['1', '2', '3', '4']
                                ]
                            ]
                        ),
                        frameflow_widget_slider_control(
                            'content_max_width_5',
                            esc_html__('Max Width', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-accordion .pxl-item--content-desc, {{WRAPPER}} .pxl-accordion .pxl-item--content ul' => 'max-width: {{SIZE}}{{UNIT}};',
                            ],
                            [
                                'range' => ['px' => ['min' => 0, 'max' => 1000]],
                                'condition' => [
                                    'layout' => ['5']
                                ]
                            ]
                        ),
                        frameflow_widget_slider_control(
                            'content_list_spacing',
                            esc_html__('List Spacing', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-accordion .pxl-item--content ul li' => 'padding-bottom: {{SIZE}}{{UNIT}};',
                            ],
                            [
                                'range' => ['px' => ['min' => 0, 'max' => 200]],
                                'condition' => [
                                    'layout' => ['5']
                                ]
                            ]
                        ),
                        frameflow_widget_typography_control(
                            'title_content_typography',
                            esc_html__('Title Content Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-accordion .pxl-item--content-title'
                        ),
                        frameflow_widget_typography_control(
                            'desc_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-accordion .pxl-item--content'
                        ),
                        frameflow_widget_slider_control(
                            'ct_space_top',
                            esc_html__('Space Top', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-accordion .pxl-item--content' => 'margin-top: {{SIZE}}{{UNIT}};',
                            ],
                            [
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 300,
                                    ],
                                ],
                            ]
                        ),
                        frameflow_widget_slider_control(
                            'ct_space_bottom',
                            esc_html__('Space Bottom', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-accordion .pxl-item--content' => 'padding-bottom: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-accordion .pxl-item--content-desc' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                            ],
                            [
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 300,
                                    ],
                                ],
                            ]
                        ),
                        frameflow_widget_dimensions_control(
                            'content_padding',
                            esc_html__('Padding', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-accordion .pxl-item--content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                        frameflow_widget_dimensions_control(
                            'content_border_radius',
                            esc_html__('Border Radius', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-accordion .pxl-item--content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'content_style_tabs',
                            'control_type' => 'tab',
                            'tabs' => [
                                [
                                    'name' => 'tab_content_normal',
                                    'label' => esc_html__('Normal', 'frameflow'),
                                    'controls' => [
                                        frameflow_widget_color_control('content_color', esc_html__('Color', 'frameflow'), [
                                            '{{WRAPPER}} .pxl-accordion .pxl-item--content' => 'color: {{VALUE}};',
                                        ]),
                                        frameflow_widget_color_control(
                                            'title_content_color',
                                            esc_html__('Title Content Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-accordion .pxl-item--content-title' => 'color: {{VALUE}};',
                                            ],
                                            [
                                                'condition' => [
                                                    'layout' => '5',
                                                ],
                                            ]
                                        ),
                                        frameflow_widget_color_control(
                                            'content_divider_color',
                                            esc_html__('Divider Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-accordion .pxl-item--content' => 'border-top-color: {{VALUE}};',
                                            ]
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'tab_content_active',
                                    'label' => esc_html__('Active', 'frameflow'),
                                    'controls' => [
                                        frameflow_widget_color_control('content_color_a', esc_html__('Color', 'frameflow'), [
                                            '{{WRAPPER}} .pxl-accordion .pxl-item.active .pxl-item--content' => 'color: {{VALUE}};',
                                        ]),
                                        frameflow_widget_color_control(
                                            'content_background_color',
                                            esc_html__('Background Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-accordion .pxl-item.active .pxl-item--content' => 'background-color: {{VALUE}};',
                                            ]
                                        ),
                                    ],
                                ],
                            ],
                        ),
                        frameflow_widget_typography_control(
                            'feature_item_typography_6',
                            esc_html__('Feature Item Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-accordion6 .pxl-item--feature-item',
                            [
                                'condition' => [
                                    'layout' => '6',
                                ],
                            ]
                        ),
                        frameflow_widget_color_control(
                            'feature_item_color_6',
                            esc_html__('Feature Item Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-accordion6 .pxl-item--feature-item' => 'color: {{VALUE}};',
                            ],
                            [
                                'condition' => [
                                    'layout' => '6',
                                ],
                            ]
                        ),
                        frameflow_widget_dimensions_control(
                            'feature_item_padding_6',
                            esc_html__('Feature Item Padding', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-accordion6 .pxl-item--feature-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            [
                                'size_units' => ['px'],
                                'condition' => [
                                    'layout' => '6',
                                ],
                            ]
                        )
                    ),
                ),
                array(
                    'name' => 'section_style_button',
                    'label' => esc_html__('Button', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_dimensions_control(
                            'button_margin',
                            esc_html__('Margin', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-accordion .pxl-item--content .btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                        frameflow_widget_dimensions_control(
                            'button_border_radius',
                            esc_html__('Border Radius', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-accordion .pxl-item--content .btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                        frameflow_widget_typography_control(
                            'button_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-accordion .pxl-item--content .btn'
                        ),
                        array(
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
                                                '{{WRAPPER}} .pxl-accordion .pxl-item--content .btn' => 'color: {{VALUE}};',
                                                '{{WRAPPER}} .pxl-accordion .pxl-item--content .btn svg path' => 'fill: {{VALUE}};',
                                            ]
                                        ),
                                        frameflow_widget_color_control(
                                            'button_border_color',
                                            esc_html__('Border Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-accordion .pxl-item--content .btn' => 'border-color: {{VALUE}};',
                                            ]
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'tab_button_hover',
                                    'label' => esc_html__('Hover', 'frameflow'),
                                    'controls' => [
                                        frameflow_widget_color_control(
                                            'button_color_hover',
                                            esc_html__('Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-accordion .pxl-item--content .btn:hover' => 'color: {{VALUE}};',
                                                '{{WRAPPER}} .pxl-accordion .pxl-item--content .btn:hover svg path' => 'fill: {{VALUE}};',
                                            ]
                                        ),
                                        frameflow_widget_color_control(
                                            'button_border_color_hover',
                                            esc_html__('Border Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-accordion .pxl-item--content .btn:hover' => 'border-color: {{VALUE}};',
                                            ]
                                        ),
                                    ],
                                ],
                            ],
                        ),
                    )
                ),
                frameflow_widget_animation_settings(),
            ),
        ),
    ),
    frameflow_get_class_widget_path()
);
