<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_heading',
        'title' => esc_html__('Case Heading', 'frameflow'),
        'icon' => 'eicon-e-heading',
        'categories' => array('pxltheme-core'),
        'scripts'    => array(
            'gsap',
            'pxl-scroll-trigger',
            'pxl-splitText',
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        frameflow_widget_text_control(
                            'sub_title',
                            esc_html__('Sub Title', 'frameflow'),
                            ['label_block' => true]
                        ),
                        frameflow_widget_textarea_control(
                            'title',
                            esc_html__('Title', 'frameflow'),
                            [
                                'label_block' => true,
                                'description' => 'Create Typewriter text width shortcode: [typewriter text="Text1, Text2"] and Highlight text with shortcode: [highlight text="Text"] and Image with shortcode: [pxl_image src="URL" size="full" class="class-name"]',
                                'rows' => 10,
                            ]
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
                                'justify' => [
                                    'title' => esc_html__('Justified', 'frameflow'),
                                    'icon' => 'eicon-text-align-justify',
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-heading' => 'text-align: {{VALUE}};',
                            ],
                        ),
                        frameflow_widget_slider_control(
                            'h_width',
                            esc_html__('Max Width', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-heading .pxl-heading--inner' => 'max-width: {{SIZE}}{{UNIT}};',
                            ],
                            [
                                'size_units' => ['px', '%'],
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 3000,
                                    ],
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
                        frameflow_widget_title_tag_control('title_tag', esc_html__('HTML Tag', 'frameflow'), 'h3'),

                        frameflow_widget_color_control(
                            'title_color',
                            esc_html__('Title Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-heading .pxl-item--title' => 'color: {{VALUE}};-webkit-text-stroke-color:{{VALUE}};',
                                '{{WRAPPER}} .pxl-heading .pxl-item--title.style-outline .pxl-text-line-backdrop svg' => 'stroke:{{VALUE}};',
                            ]
                        ),
                        frameflow_widget_typography_control(
                            'title_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-heading .pxl-item--title'
                        ),
                        array(
                            'name'         => 'title_box_shadow',
                            'label' => esc_html__('Title Shadow', 'frameflow'),
                            'type'         => \Elementor\Group_Control_Text_Shadow::get_type(),
                            'control_type' => 'group',
                            'selector'     => '{{WRAPPER}} .pxl-heading .pxl-item--title'
                        ),
                        frameflow_widget_slider_control(
                            'title_space_bottom',
                            esc_html__('Bottom Spacer', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-heading .pxl-item--title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                            ],
                            [
                                'default' => [
                                    'size' => 0,
                                ],
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 300,
                                    ],
                                ],
                                'separator' => 'after',
                            ]
                        ),
                        frameflow_widget_select_control(
                            'h_title_style',
                            esc_html__('Style', 'frameflow'),
                            [
                                'style-default' => 'Default',
                                'style-outline' => 'Outline',
                            ],
                            ['default' => 'style-default']
                        ),
                        frameflow_widget_color_control(
                            'outline_color',
                            esc_html__('Outline Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-heading .pxl-item--title.style-outline .pxl-text-line-backdrop svg text' => 'stroke:{{VALUE}} !important;',
                            ],
                            [
                                'default' => '#fff',
                                'condition' => [
                                    'h_title_style' => 'style-outline',
                                ],
                            ]
                        ),
                        frameflow_widget_select_control(
                            'pxl_animate',
                            esc_html__('Case  Animate', 'frameflow'),
                            frameflow_widget_animate_v2(),
                            ['default' => '']
                        ),
                        frameflow_widget_text_control(
                            'pxl_animate_delay',
                            esc_html__('Animate Delay', 'frameflow'),
                            [
                                'default' => '0',
                                'description' => esc_html__('Delay before animation starts (ms). Works with WOW, split text, and outline effects.', 'frameflow'),
                                'separator' => 'after',
                            ]
                        ),

                        // Gsap Animation
                        frameflow_widget_select_control(
                            'pxl_heading_text_effect',
                            esc_html__('Text Effect', 'frameflow'),
                            [
                                'none' => 'None',
                                'text-scroll-reveal' => 'Text Scroll Reveal',
                            ],
                            ['default' => 'none']
                        ),
                        array(
                            'name' => 'pxl_sr_opacity_from',
                            'label' => esc_html__('Scroll Reveal Opacity (From)', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'range' => [
                                '' => [
                                    'min' => 0,
                                    'max' => 1,
                                    'step' => 0.01,
                                ],
                            ],
                            'default' => [
                                'size' => 0.4,
                            ],
                            'condition' => [
                                'pxl_heading_text_effect' => 'text-scroll-reveal',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-heading.text-scroll-reveal' => '--pxl-sr-opacity-from: {{SIZE}};',
                            ],
                        ),
                        array(
                            'name' => 'pxl_sr_opacity_to',
                            'label' => esc_html__('Scroll Reveal Opacity (To)', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'range' => [
                                '' => [
                                    'min' => 0,
                                    'max' => 1,
                                    'step' => 0.01,
                                ],
                            ],
                            'default' => [
                                'size' => 1,
                            ],
                            'condition' => [
                                'pxl_heading_text_effect' => 'text-scroll-reveal',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-heading.text-scroll-reveal' => '--pxl-sr-opacity-to: {{SIZE}};',
                            ],
                        ),
                        frameflow_widget_color_control(
                            'pxl_sr_color_from',
                            esc_html__('Scroll Reveal Color (From)', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-heading.text-scroll-reveal' => '--pxl-sr-color-from: {{VALUE}};',
                            ],
                            [
                                'condition' => [
                                    'pxl_heading_text_effect' => 'text-scroll-reveal',
                                ],
                            ]
                        ),
                        frameflow_widget_color_control(
                            'pxl_sr_color_to',
                            esc_html__('Scroll Reveal Color (To)', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-heading.text-scroll-reveal' => '--pxl-sr-color-to: {{VALUE}};',
                            ],
                            [
                                'condition' => [
                                    'pxl_heading_text_effect' => 'text-scroll-reveal',
                                ],
                            ]
                        ),
                        frameflow_widget_color_control(
                            'pxl_sr_color_to_gradient_a',
                            esc_html__('Scroll Reveal Color To (Gradient A)', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-heading.text-scroll-reveal' => '--pxl-sr-color-to-a: {{VALUE}};',
                            ],
                            [
                                'condition' => [
                                    'pxl_heading_text_effect' => 'text-scroll-reveal',
                                ],
                            ]
                        ),
                        frameflow_widget_color_control(
                            'pxl_sr_color_to_gradient_b',
                            esc_html__('Scroll Reveal Color To (Gradient B)', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-heading.text-scroll-reveal' => '--pxl-sr-color-to-b: {{VALUE}};',
                            ],
                            [
                                'condition' => [
                                    'pxl_heading_text_effect' => 'text-scroll-reveal',
                                ],
                            ]
                        ),
                        frameflow_widget_select_control(
                            'pxl_sr_mode',
                            esc_html__('Scroll Reveal Mode', 'frameflow'),
                            [
                                'scroll' => esc_html__('Scroll Sync', 'frameflow'),
                                'auto' => esc_html__('Auto Play', 'frameflow'),
                            ],
                            [
                                'default' => 'scroll',
                                'condition' => [
                                    'pxl_heading_text_effect' => 'text-scroll-reveal',
                                ],
                            ]
                        ),
                        array(
                            'name' => 'pxl_sr_speed',
                            'label' => esc_html__('Scroll Sync Speed (s)', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'range' => [
                                '' => [
                                    'min' => 0.05,
                                    'max' => 2,
                                    'step' => 0.05,
                                ],
                            ],
                            'default' => [
                                'size' => 0.3,
                            ],
                            'condition' => [
                                'pxl_heading_text_effect' => 'text-scroll-reveal',
                                'pxl_sr_mode' => 'scroll',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-heading.text-scroll-reveal' => '--pxl-sr-speed: {{SIZE}};',
                            ],
                        ),
                        array(
                            'name' => 'pxl_sr_auto_speed',
                            'label' => esc_html__('Auto Play Speed (s)', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'range' => [
                                '' => [
                                    'min' => 0.4,
                                    'max' => 8,
                                    'step' => 0.1,
                                ],
                            ],
                            'default' => [
                                'size' => 2,
                            ],
                            'condition' => [
                                'pxl_heading_text_effect' => 'text-scroll-reveal',
                                'pxl_sr_mode' => 'auto',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-heading.text-scroll-reveal' => '--pxl-sr-auto-speed: {{SIZE}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_title_sub',
                    'label' => esc_html__('Sub Title', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array_merge(
                        array(
                            frameflow_widget_slider_control(
                                'sub_title_box_height',
                                esc_html__('Box Height', 'frameflow'),
                                [
                                    '{{WRAPPER}} .pxl-heading .pxl-item--subtitle.pxl-sub-title-default' => 'min-height: {{SIZE}}{{UNIT}};',
                                ],
                                [
                                    'size_units' => ['px'],
                                    'range' => [
                                        'px' => [
                                            'min' => 0,
                                            'max' => 300,
                                        ],
                                    ],
                                    'default' => [
                                        'size' => 33,
                                    ],
                                ]
                            ),
                            array(
                                'name'         => 'select_sub_title_background',
                                'label'        => esc_html__('Sub Title Background', 'frameflow'),
                                'type'         => \Elementor\Group_Control_Background::get_type(),
                                'control_type' => 'group',
                                'types'        => ['classic', 'gradient'],
                                'selector'     => '{{WRAPPER}} .pxl-heading .pxl-item--subtitle.pxl-sub-title-default',
                            ),
                            frameflow_widget_dimensions_control(
                                'sub_title_padding',
                                esc_html__('Padding', 'frameflow'),
                                [
                                    '{{WRAPPER}} .pxl-heading .pxl-item--subtitle.pxl-sub-title-default' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                                ['size_units' => ['px']]
                            ),
                            frameflow_widget_color_control(
                                'sub_title_color',
                                esc_html__('Color', 'frameflow'),
                                [
                                    '{{WRAPPER}} .pxl-heading .pxl-item--subtitle .pxl-item--subtext' => 'color: {{VALUE}};-webkit-text-fill-color: unset;',
                                ]
                            ),
                            frameflow_widget_typography_control(
                                'sub_title_typography',
                                esc_html__('Typography', 'frameflow'),
                                '{{WRAPPER}} .pxl-heading .pxl-item--subtitle, {{WRAPPER}} .pxl-heading .pxl-item--subtitle span'
                            ),
                            frameflow_widget_dimensions_control(
                                'sub_title_box_border_width',
                                esc_html__('Border Width', 'frameflow'),
                                [
                                    '{{WRAPPER}} .pxl-heading .pxl-item--subtitle.pxl-sub-title-default' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                                [
                                    'size_units' => ['px'],
                                ]
                            ),
                            frameflow_widget_color_control(
                                'sub_title_box_border_color',
                                esc_html__('Border Color', 'frameflow'),
                                [
                                    '{{WRAPPER}} .pxl-heading .pxl-item--subtitle.pxl-sub-title-default' => 'border-color: {{VALUE}};',
                                ]
                            ),
                            frameflow_widget_dimensions_control(
                                'sub_title_box_border_radius',
                                esc_html__('Border Radius', 'frameflow'),
                                [
                                    '{{WRAPPER}} .pxl-heading .pxl-item--subtitle.pxl-sub-title-default' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                                [
                                    'size_units' => ['px'],
                                ]
                            ),
                            array(
                                'name'         => 'sub_title_box_shadow',
                                'label' => esc_html__('Box Shadow', 'frameflow'),
                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                'control_type' => 'group',
                                'selector' => '{{WRAPPER}} .pxl-heading .pxl-item--subtitle.pxl-sub-title-default',
                            ),
                            frameflow_widget_select_control(
                                'pxl_animate_sub',
                                esc_html__('Case  Animate', 'frameflow'),
                                frameflow_widget_animate_v2(),
                                ['default' => '']
                            ),
                            frameflow_widget_text_control(
                                'pxl_animate_delay_sub',
                                esc_html__('Animate Delay', 'frameflow'),
                                [
                                    'default' => '0',
                                    'description' => esc_html__('Delay before animation starts (ms). Works with WOW, split text, and outline effects.', 'frameflow'),
                                ]
                            ),
                        )
                    ),
                ),
                array(
                    'name' => 'section_style_highlight',
                    'label' => esc_html__('Highlight', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array_merge(
                        array(
                            frameflow_widget_select_control(
                                'highlight_style',
                                esc_html__('Style', 'frameflow'),
                                [
                                    'highlight-default' => 'Default',
                                    'highlight-text-gradient' => 'Text Gradient',
                                ],
                                ['default' => 'highlight-default']
                            ),
                            frameflow_widget_color_control(
                                'highlight_color',
                                esc_html__('Color', 'frameflow'),
                                [
                                    '{{WRAPPER}} .pxl-heading .pxl-title--highlight' => 'color: {{VALUE}};',
                                ],
                                [
                                    'condition' => [
                                        'highlight_style' => ['highlight-default'],
                                    ],
                                ]
                            ),
                            frameflow_widget_color_control(
                                'highlight_color_from',
                                esc_html__('Color From', 'frameflow'),
                                [
                                    '{{WRAPPER}} .pxl-heading .pxl-title--highlight' => '--gradient-color-from: {{VALUE}};',
                                ],
                                [
                                    'condition' => [
                                        'highlight_style' => ['highlight-text-gradient'],
                                    ],
                                ]
                            ),
                            frameflow_widget_color_control(
                                'highlight_color_to',
                                esc_html__('Color To', 'frameflow'),
                                [
                                    '{{WRAPPER}} .pxl-heading .pxl-title--highlight' => '--gradient-color-to: {{VALUE}};',
                                ],
                                [
                                    'condition' => [
                                        'highlight_style' => ['highlight-text-gradient'],
                                    ],
                                ]
                            ),
                            frameflow_widget_typography_control(
                                'highlight_typography',
                                esc_html__('Typography', 'frameflow'),
                                '{{WRAPPER}} .pxl-heading .pxl-title--highlight'
                            ),
                            frameflow_widget_media_control(
                                'highlight_text_image',
                                esc_html__('Text Image', 'frameflow'),
                                [
                                    'default' => '',
                                    'selectors' => [
                                        '{{WRAPPER}} .pxl-heading .pxl-title--highlight' => 'background-image: url( {{URL}} );',
                                    ],
                                ]
                            ),
                            frameflow_widget_select_control(
                                'highlight_image_position',
                                esc_html__('Text Image Position', 'frameflow'),
                                [
                                    ''              => esc_html__('Default', 'frameflow'),
                                    'center center' => esc_html__('Center Center', 'frameflow'),
                                    'center left'   => esc_html__('Center Left', 'frameflow'),
                                    'center right'  => esc_html__('Center Right', 'frameflow'),
                                    'top center'    => esc_html__('Top Center', 'frameflow'),
                                    'top left'      => esc_html__('Top Left', 'frameflow'),
                                    'top right'     => esc_html__('Top Right', 'frameflow'),
                                    'bottom center' => esc_html__('Bottom Center', 'frameflow'),
                                    'bottom left'   => esc_html__('Bottom Left', 'frameflow'),
                                    'bottom right'  => esc_html__('Bottom Right', 'frameflow'),
                                    'initial'       =>  esc_html__('Custom', 'frameflow'),
                                ],
                                [
                                    'default' => '',
                                    'selectors' => [
                                        '{{WRAPPER}} .pxl-heading .pxl-title--highlight' => 'background-position: {{VALUE}};',
                                    ],
                                    'condition' => [
                                        'highlight_text_image[url]!' => ''
                                    ],
                                ]
                            ),
                            frameflow_widget_select_control(
                                'highlight_image_size',
                                esc_html__('Text Image Size', 'frameflow'),
                                [
                                    ''              => esc_html__('Default', 'frameflow'),
                                    'auto' => esc_html__('Auto', 'frameflow'),
                                    'cover'   => esc_html__('Cover', 'frameflow'),
                                    'contain'  => esc_html__('Contain', 'frameflow'),
                                    'initial'    => esc_html__('Custom', 'frameflow'),
                                ],
                                [
                                    'hide_in_inner' => true,
                                    'default'      => '',
                                    'selectors' => [
                                        '{{WRAPPER}} .pxl-heading .pxl-title--highlight' => 'background-size: {{VALUE}};',
                                    ],
                                    'condition' => [
                                        'highlight_text_image[url]!' => ''
                                    ],
                                ]
                            ),
                            frameflow_widget_select_control(
                                'pxl_animate_highlight',
                                esc_html__('Case  Animate', 'frameflow'),
                                frameflow_widget_animate_v2(),
                                ['default' => '']
                            ),
                            frameflow_widget_text_control(
                                'pxl_animate_delay_highlight',
                                esc_html__('Animate Delay', 'frameflow'),
                                [
                                    'default' => '0',
                                    'description' => esc_html__('Delay before highlight animation starts (ms). Works with WOW, split text, and outline effects.', 'frameflow'),
                                ]
                            ),
                        )
                    ),
                ),

                array(
                    'name' => 'section_style_typewriter',
                    'label' => esc_html__('Typewriter', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array_merge(
                        array(
                            frameflow_widget_color_control(
                                'typewriter_color',
                                esc_html__('Color', 'frameflow'),
                                [
                                    '{{WRAPPER}} .pxl-heading .pxl-title--typewriter' => 'color: {{VALUE}};',
                                ]
                            ),
                            frameflow_widget_typography_control(
                                'typewriter_typography',
                                esc_html__('Typography', 'frameflow'),
                                '{{WRAPPER}} .pxl-heading .pxl-title--typewriter'
                            ),
                        )
                    ),
                ),
            ),
        ),
    ),
    frameflow_get_class_widget_path()
);
