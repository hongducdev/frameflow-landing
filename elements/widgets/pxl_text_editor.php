<?php
use \Elementor\Controls_Manager;

pxl_add_custom_widget(
    array(
        'name' => 'pxl_text_editor',
        'title' => esc_html__('Case Text Editor', 'frameflow'),
        'icon' => 'eicon-atomic-text-area',
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
                    'label' => esc_html__('Text Editor', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        frameflow_widget_wysiwyg_control(
                            'text_ed',
                            '',
                            [
                                'default' => esc_html__('Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'frameflow'),
                                'description' => 'Create Highlight text width shortcode: [pxl_highlight text="Text Demo"]',
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
                                '{{WRAPPER}} .pxl-text-editor' => 'text-align: {{VALUE}};',
                            ],
                        ),
                        frameflow_widget_slider_control(
                            't_width',
                            esc_html__('Max Width', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-editor .pxl-item--inner' => 'max-width: {{SIZE}}{{UNIT}};',
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
                    'name' => 'section_style_text',
                    'label' => esc_html__('Text', 'frameflow'),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_color_control(
                            'text_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-editor , {{WRAPPER}} .pxl-text-editor p' => 'color: {{VALUE}};',
                            ],
                            ['default' => '']
                        ),
                        frameflow_widget_typography_control(
                            'text_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-text-editor , {{WRAPPER}} .pxl-text-editor p'
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_quote',
                    'label' => esc_html__('Block Quote', 'frameflow'),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_color_control(
                            'textb_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-editor blockquote, {{WRAPPER}} .pxl-text-editor blockquote p' => 'color: {{VALUE}} !important;',
                            ],
                            ['default' => '']
                        ),
                        frameflow_widget_typography_control(
                            'textb_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-text-editor blockquote, {{WRAPPER}} .pxl-text-editor blockquote p'
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_link',
                    'label' => esc_html__('Link', 'frameflow'),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_select_control(
                            'style_hv',
                            esc_html__('Style Hover', 'frameflow'),
                            [
                                'default' => esc_html__('Default', 'frameflow'),
                                'underline' => esc_html__('Underline', 'frameflow'),
                            ],
                            ['default' => 'default']
                        ),
                        frameflow_widget_color_control(
                            'link_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-editor a' => 'color: {{VALUE}};',
                            ],
                            ['default' => '']
                        ),
                        frameflow_widget_color_control(
                            'link_color_hover',
                            esc_html__('Color Hover', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-editor a:hover' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-text-editor.underline a:hover' => 'text-decoration: underline {{VALUE}} !important;',
                            ],
                            ['default' => '']
                        ),
                        frameflow_widget_typography_control(
                            'link_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-text-editor a'
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_title_highlight',
                    'label' => esc_html__('Highlight', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array_merge(
                        array(
                            frameflow_widget_color_control(
                                'highlight_color',
                                esc_html__('Color', 'frameflow'),
                                [
                                    '{{WRAPPER}} .pxl-text-editor .pxl-text--highlight' => 'color: {{VALUE}};',
                                ]
                            ),
                            frameflow_widget_color_control(
                                'highlight_box_color',
                                esc_html__('Box Color', 'frameflow'),
                                [
                                    '{{WRAPPER}} .pxl-text-editor .pxl-text--highlight' => 'background-color: {{VALUE}};',
                                ]
                            ),
                            frameflow_widget_typography_control(
                                'highlight_typography',
                                esc_html__('Typography', 'frameflow'),
                                '{{WRAPPER}} .pxl-text-editor .pxl-text--highlight'
                            ),
                        ),
                        frameflow_widget_highlight_animation_controls(),
                    ),
                ),
                frameflow_widget_animation_settings(),
            ),
        ),
    ),
    frameflow_get_class_widget_path()
);
