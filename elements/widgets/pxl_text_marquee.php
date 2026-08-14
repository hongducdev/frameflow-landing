<?php
pxl_add_custom_widget(
    array(
        'name'       => 'pxl_text_marquee',
        'title'      => esc_html__('Case Text Marquee', 'frameflow'),
        'icon'       => 'eicon-animation-text',
        'categories' => array('pxltheme-core'),
        'scripts'    => array(
            'frameflow-text-marquee',
        ),
        'params'     => array(
            'sections' => array(
                array(
                    'name'     => 'section_content',
                    'label'    => esc_html__('Content', 'frameflow'),
                    'tab'      => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        frameflow_widget_select_control(
                            'style',
                            esc_html__('Style', 'frameflow'),
                            array(
                                'style-1' => esc_html__('Style 1', 'frameflow'),
                                'style-2' => esc_html__('Style 2', 'frameflow'),
                            ),
                            ['default' => 'style-1']
                        ),
                        array(
                            'name'       => 'marquee_speed',
                            'label'      => esc_html__('Speed (px/s)', 'frameflow'),
                            'type'       => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range'      => [
                                'px' => [
                                    'min' => 10,
                                    'max' => 400,
                                ],
                            ],
                            'default'    => [
                                'size' => 80,
                                'unit' => 'px',
                            ],
                        ),
                        frameflow_widget_select_control(
                            'marquee_direction',
                            esc_html__('Direction', 'frameflow'),
                            [
                                'left'  => esc_html__('Left', 'frameflow'),
                                'right' => esc_html__('Right', 'frameflow'),
                            ],
                            ['default' => 'left']
                        ),
                        frameflow_widget_icons_control(
                            'marquee_icon',
                            esc_html__('Marquee Icon', 'frameflow'),
                            
                        ),
                        array(
                            'name'        => 'items',
                            'label'       => esc_html__('Text Items', 'frameflow'),
                            'type'        => \Elementor\Controls_Manager::REPEATER,
                            'title_field' => '{{{ item_text }}}',
                            'controls'    => array(
                                frameflow_widget_wysiwyg_control(
                                    'item_text',
                                    esc_html__('Text', 'frameflow'),
                                    [
                                        'default'     => esc_html__('Frameflow Studio', 'frameflow'),
                                        'label_block' => true,
                                    ]
                                ),
                            ),
                            'default' => array(
                                array('item_text' => esc_html__('Creative Direction', 'frameflow')),
                                array('item_text' => esc_html__('Visual Identity', 'frameflow')),
                                array('item_text' => esc_html__('Motion Design', 'frameflow')),
                                array('item_text' => esc_html__('Brand Strategy', 'frameflow')),
                            ),
                        ),
                    ),
                ),
                array(
                    'name'     => 'section_style_items',
                    'label'    => esc_html__('Items', 'frameflow'),
                    'tab'      => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_dimensions_control(
                            'item_padding',
                            esc_html__('Item Padding', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-marquee__item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ]
                        ),
                        frameflow_widget_slider_control(
                            'item_gap',
                            esc_html__('Item Gap', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-marquee__item' => 'gap: {{SIZE}}{{UNIT}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'item_text_color',
                            esc_html__('Text Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-marquee__label' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'item_text_color_hover',
                            esc_html__('Text Color Hover', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-marquee__label:hover' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_typography_control(
                            'item_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-text-marquee__label'
                        ),
                        frameflow_widget_color_control(
                            'item_text_color_strong',
                            esc_html__('Text Color Strong', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-text-marquee__label strong' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_typography_control(
                            'item_typography_strong',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-text-marquee__label strong'
                        ),
                    ),
                ),
                frameflow_widget_animation_settings(),
            ),
        ),
    ),
    frameflow_get_class_widget_path()
);
