<?php
//Register Counter Widget
pxl_add_custom_widget(
    array(
        'name' => 'pxl_counter',
        'title' => esc_html__('Case Counter', 'frameflow'),
        'icon' => 'eicon-counter-circle icon-brand-elementor',
        'categories' => array('pxltheme-core'),
        'scripts' => array(
            'elementor-waypoints',
            'jquery-numerator',
            'pxl-counter',
            'pxl-counter-slide',
            'frameflow-counter',
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
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_counter/layout1.webp'
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
                            esc_html__('Title', 'frameflow'),
                            ['label_block' => true]
                        ),
                        frameflow_widget_number_control(
                            'starting_number',
                            esc_html__('Starting Number', 'frameflow'),
                            ['default' => 1]
                        ),
                        frameflow_widget_number_control(
                            'ending_number',
                            esc_html__('Ending Number', 'frameflow'),
                            ['default' => 100]
                        ),
                        frameflow_widget_text_control('end_char_number', esc_html__('End Character Number', 'frameflow')),
                        frameflow_widget_text_control('prefix', esc_html__('Number Prefix', 'frameflow'), ['default' => '']),
                        frameflow_widget_text_control('suffix', esc_html__('Number Suffix', 'frameflow'), ['default' => '']),
                        frameflow_widget_text_control('unit_text', esc_html__('Unit Text', 'frameflow')),
                        frameflow_widget_select_control(
                            'thousand_separator_char',
                            esc_html__('Number Separator', 'frameflow'),
                            [
                                '' => 'Default',
                                '.' => 'Dot',
                                ',' => 'Comma',
                                ' ' => 'Space',
                            ],
                            ['default' => '']
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_general',
                    'label' => esc_html__('General', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_select_control(
                            'effect',
                            esc_html__('Effect', 'frameflow'),
                            [
                                'effect-default' => 'Default',
                                'effect-slide' => 'Slide',
                            ],
                            ['default' => 'effect-default']
                        ),
                        array(
                            'name' => 'align',
                            'label' => esc_html__('Alignment', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::CHOOSE,
                            'control_type' => 'responsive',
                            'options' => [
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
                            'selectors_dictionary' => [
                                'left' => 'flex-start',
                                'center' => 'center',
                                'right' => 'flex-end',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-counter .pxl-counter--number' => 'justify-content: {{VALUE}};',
                                '{{WRAPPER}} .pxl-counter .pxl-counter--inner .pxl-counter--title,{{WRAPPER}} .pxl-counter' => 'text-align: {{VALUE}};',
                            ],
                        ),
                        frameflow_widget_slider_control(
                            'gap',
                            esc_html__('Gap', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-counter' => 'gap: {{SIZE}}{{UNIT}};',
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
                            'padding',
                            esc_html__('Padding', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-counter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'background_color',
                            esc_html__('Background Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-counter' => 'background-color: {{VALUE}};',
                            ]
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_title',
                    'label' => esc_html__('Title', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_select_control(
                            'title_style_1',
                            esc_html__('Style', 'frameflow'),
                            [
                                'style-1-1' => 'Style 1',
                                'style-1-2' => 'Style 2',
                            ],
                            [
                                'default' => 'style-1-1',
                                'condition' => [
                                    'layout' => ['1'],
                                ],
                            ]
                        ),
                        frameflow_widget_color_control(
                            'title_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-counter .pxl-counter--title' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'title_bg_color',
                            esc_html__('Background Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-counter .pxl-counter--title' => 'background-color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_typography_control(
                            'title_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-counter .pxl-counter--title'
                        ),
                        frameflow_widget_select_control(
                            'title_w',
                            esc_html__('Width', 'frameflow'),
                            [
                                'title-full-w' => 'Full',
                                'title-inline-w' => 'Inline',
                            ],
                            ['default' => 'title-inline-w']
                        ),
                        array(
                            'name' => 'title_max_width',
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
                                '{{WRAPPER}} .pxl-counter .pxl-counter--title' => 'max-width: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'title_w' => ['title-full-w'],
                            ],
                        ),
                        frameflow_widget_dimensions_control(
                            'title_padding',
                            esc_html__('Padding', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-counter .pxl-counter--title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ]
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_description',
                    'label' => esc_html__('Description', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'layout' => ['1', '4'],
                    ],
                    'controls' => array(
                        frameflow_widget_color_control(
                            'description_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-counter .pxl-counter--description' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_typography_control(
                            'description_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-counter .pxl-counter--description'
                        ),
                        array(
                            'name' => 'description_max_width',
                            'label' => esc_html__('Max Width', 'frameflow'),
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
                                '{{WRAPPER}} .pxl-counter .pxl-counter--description' => 'max-width: {{SIZE}}{{UNIT}};',
                            ],
                        )
                    ),
                ),
                array(
                    'name' => 'section_style_icon',
                    'label' => esc_html__('Icon', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'icon_type' => 'icon',
                        'layout!' => ['1'],
                    ],
                    'controls' => array(
                        frameflow_widget_slider_control(
                            'box_size',
                            esc_html__('Box Icon Size', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-counter .pxl-counter--icon' => 'width: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                            ],
                            [
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 300,
                                    ],
                                ],
                                'condition' => [
                                    'icon_type' => 'icon',
                                ],
                            ]
                        ),
                        frameflow_widget_color_control(
                            'icon_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-counter .pxl-counter--icon i' => 'color: {{VALUE}};text-fill-color: {{VALUE}};-webkit-text-fill-color: {{VALUE}};background-image: none;',
                                '{{WRAPPER}} .pxl-counter .pxl-counter--icon svg path' => 'fill: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'bg_icon_color',
                            esc_html__('Background Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-counter .pxl-counter--icon' => 'background-color: {{VALUE}};',
                            ]
                        ),
                        array(
                            'name' => 'icon_font_size',
                            'label' => esc_html__('Icon Font Size', 'frameflow'),
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
                                '{{WRAPPER}} .pxl-counter .pxl-counter--icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-counter .pxl-counter--icon svg' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'icon_type' => 'icon',
                            ],
                        ),
                        array(
                            'name' => 'icon_space_top',
                            'label' => esc_html__('Top Spacer', 'frameflow'),
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
                                '{{WRAPPER}} .pxl-counter .pxl-counter--icon' => 'padding-top: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'icon_space_bottom',
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
                                '{{WRAPPER}} .pxl-counter .pxl-counter--icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                            ],
                            'separator' => 'after',
                        ),
                    ),
                ),
                array(
                    'name' => 'section_number',
                    'label' => esc_html__('Number', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_select_control(
                            'style',
                            esc_html__('Style', 'frameflow'),
                            [
                                'style-default' => 'Default',
                                'style-gradient' => 'Gradient',
                            ],
                            ['default' => 'style-default']
                        ),
                        array(
                            'name' => 'number_align',
                            'label' => esc_html__('Alignment', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::CHOOSE,
                            'control_type' => 'responsive',
                            'options' => [
                                'start' => [
                                    'title' => esc_html__('Left', 'frameflow'),
                                    'icon' => 'eicon-text-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__('Center', 'frameflow'),
                                    'icon' => 'eicon-text-align-center',
                                ],
                                'end' => [
                                    'title' => esc_html__('Right', 'frameflow'),
                                    'icon' => 'eicon-text-align-right',
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-counter .pxl-counter--number' => 'justify-content: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name'         => 'btn_gradient',
                            'label' => esc_html__('Background Type', 'frameflow'),
                            'type'         => \Elementor\Group_Control_Background::get_type(),
                            'control_type' => 'group',
                            'types' => ['gradient'],
                            'condition' => [
                                'style' => ['style-gradient'],
                            ],
                            'selector'     => '{{WRAPPER}} .pxl-counter .pxl-counter--number.style-gradient span',
                        ),
                        frameflow_widget_color_control(
                            'number_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-counter .pxl-counter--number,{{WRAPPER}} .pxl-counter .pxl-counter--number .pxl-counter--value' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'number_color_outline',
                            esc_html__('Color Outline', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-counter .pxl-counter--number,{{WRAPPER}} .pxl-counter .pxl-counter--number .pxl-counter--value' => '-webkit-text-stroke-color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_typography_control(
                            'number_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-counter .pxl-counter--number .pxl-counter--value'
                        ),
                        frameflow_widget_color_control(
                            'prefix_suffix_color',
                            esc_html__('Prefix/Suffix Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-counter .pxl-counter--number .pxl-counter--suffix, {{WRAPPER}} .pxl-counter .pxl-counter--number .pxl-counter--prefix' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_number_control(
                            'duration',
                            esc_html__('Animation Duration', 'frameflow'),
                            [
                                'default' => 2000,
                                'min' => 100,
                                'step' => 100,
                            ]
                        ),
                        array(
                            'name' => 'number_space_top',
                            'label' => esc_html__('Top Spacer', 'frameflow'),
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
                                '{{WRAPPER}} .pxl-counter .pxl-counter--number' => 'margin-top: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'number_space_l',
                            'label' => esc_html__('Left Spacer', 'frameflow'),
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
                                '{{WRAPPER}} .pxl-counter .pxl-counter--number' => 'margin-left: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'number_space_r',
                            'label' => esc_html__('Right Spacer', 'frameflow'),
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
                                '{{WRAPPER}} .pxl-counter .pxl-counter--number' => 'margin-right: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'number_space_bottom',
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
                                '{{WRAPPER}} .pxl-counter .pxl-counter--number' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_end_char_number',
                    'label' => esc_html__('End Char Number', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_color_control(
                            'end_char_number_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-counter .pxl-counter--number .pxl-counter--end-char-number' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_typography_control(
                            'end_char_number_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-counter .pxl-counter--number .pxl-counter--end-char-number'
                        ),
                    ),
                ),
                array(
                    'name' => 'section_unit_text',
                    'label' => esc_html__('Unit Text', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_color_control(
                            'unit_text_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-counter .pxl-counter--unit' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_typography_control(
                            'unit_text_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-counter .pxl-counter--unit'
                        ),
                        array(
                            'name' => 'unit_text_margin',
                            'label' => esc_html__('Margin', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-counter .pxl-counter--unit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_number_suf',
                    'label' => esc_html__('Suffix', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_color_control(
                            'suf_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-counter .pxl-counter--number .pxl-counter--suffix' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_typography_control(
                            'suf_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-counter .pxl-counter--number .pxl-counter--suffix'
                        ),
                        array(
                            'name' => 'suf_space_tb',
                            'label' => esc_html__('Transform Y', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => -300,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-counter .pxl-counter--number .pxl-counter--suffix' => 'transform: translateY({{SIZE}}{{UNIT}});',
                            ],
                        ),
                        array(
                            'name' => 'suf_space_lr',
                            'label' => esc_html__('Left Margin', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => -300,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-counter .pxl-counter--number .pxl-counter--suffix' => 'margin-left:{{SIZE}}{{UNIT}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_number_prefix',
                    'label' => esc_html__('Prefix', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_color_control(
                            'pre_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-counter .pxl-counter--number .pxl-counter--prefix' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_typography_control(
                            'pre_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-counter .pxl-counter--number .pxl-counter--prefix'
                        ),
                        array(
                            'name' => 'pre_space_tb',
                            'label' => esc_html__('Transform Y', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => -300,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-counter .pxl-counter--number .pxl-counter--prefix' => 'transform: translateY({{SIZE}}{{UNIT}});',
                            ],
                        ),
                        array(
                            'name' => 'pre_space_lr',
                            'label' => esc_html__('Right Margin', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => -300,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-counter .pxl-counter--number .pxl-counter--prefix' => 'margin-right:{{SIZE}}{{UNIT}};',
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
