<?php
$templates_df = ['0' => esc_html__('None', 'frameflow')];
$templates = $templates_df + frameflow_get_templates_option('hidden-panel');
pxl_add_custom_widget(
    array(
        'name' => 'pxl_close_popup',
        'title' => esc_html__('Case Close Popup', 'frameflow'),
        'icon' => 'eicon-editor-close icon-brand-elementor',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        frameflow_widget_slider_control(
                            'size',
                            esc_html__('Size', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-close-popup span' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
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
                            'height',
                            esc_html__('Height', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-close-popup span:before, {{WRAPPER}} .pxl-close-popup span:after' => 'height: {{SIZE}}{{UNIT}};',
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
                        frameflow_widget_color_control(
                            'icon_color',
                            esc_html__('Icon Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-close-popup span:before, {{WRAPPER}} .pxl-close-popup span:after' => 'background-color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'icon_coloraa',
                            esc_html__('Icon Color Hover', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-close-popup:hover span:before, {{WRAPPER}} .pxl-close-popup:hover span:after' => 'background-color: {{VALUE}};',
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
