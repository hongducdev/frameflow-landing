<?php
// Register Logo Widget
pxl_add_custom_widget(
    array(
        'name' => 'pxl_logo',
        'title' => esc_html__('Case Logo', 'frameflow'),
        'icon' => 'eicon-image icon-brand-elementor',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        frameflow_widget_media_control(
                            'logo',
                            esc_html__('Logo', 'frameflow')
                        ),
                        frameflow_widget_url_control(
                            'logo_link',
                            esc_html__('Link', 'frameflow'),
                            [
                                'condition' => [
                                    'logo_style' => ['style-1'],
                                ],
                            ]
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style',
                    'label' => esc_html__('Style', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_select_control(
                            'logo_style',
                            esc_html__('Style', 'frameflow'),
                            [
                                'style-1' => esc_html__('Style 1', 'frameflow'),
                                'style-2' => esc_html__('Style 2', 'frameflow'),
                            ],
                            ['default' => 'style-1']
                        ),
                        array(
                            'name' => 'logo_align',
                            'label' => esc_html__('Image Alignment', 'frameflow'),
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
                            'selectors' => [
                                '{{WRAPPER}} .pxl-logo' => 'text-align: {{VALUE}};',
                            ],
                        ),
                        frameflow_widget_slider_control(
                            'logo_height',
                            esc_html__('Image Height', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-logo img' => 'max-height: {{SIZE}}{{UNIT}};',
                            ],
                            [
                                'description' => esc_html__('Enter number.', 'frameflow'),
                                'size_units' => ['px', 'vw'],
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 3000,
                                    ],
                                    'vw' => [
                                        'min' => 0,
                                        'max' => 10,
                                    ],
                                ],
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
