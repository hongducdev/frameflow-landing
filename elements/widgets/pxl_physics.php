<?php
// Register Button Widget
pxl_add_custom_widget(
    array(
        'name' => 'pxl_physics',
        'title' => esc_html__('Case Physics', 'frameflow'),
        'icon' => 'eicon-icon',
        'categories' => array('pxltheme-core'),
        'scripts' => array(
            'pxl-matter',
            'frameflow-physics',
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'source_section',
                    'label' => esc_html__('Source Settings', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'texts',
                            'label' => esc_html__('List', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::REPEATER,

                            'controls' => array(
                                frameflow_widget_icons_control(
                                    'pxl_icon',
                                    esc_html__('Icon', 'frameflow')
                                ),
                                frameflow_widget_select_control(
                                    'background_color',
                                    esc_html__('Background', 'frameflow'),
                                    [
                                        'primary' => esc_html__('Primary', 'frameflow'),
                                        'secondary' => esc_html__('Secondary', 'frameflow'),
                                    ],
                                    [
                                        'label_block' => true,
                                        'default' => 'primary',
                                    ]
                                ),
                            ),
                        ),
                    ),
                ),
                array(
                    'name' => 'style_section',
                    'label' => esc_html__('Style Settings', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'height',
                            'label' => esc_html__('Height', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'default' => array(
                                'size' => 495,
                            ),
                            'selectors' => [
                                '{{WRAPPER}} .pxl-physics-item' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    frameflow_get_class_widget_path()
);
