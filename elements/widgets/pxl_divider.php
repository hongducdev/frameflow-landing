<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_divider',
        'title' => esc_html__('Case Divider', 'frameflow'),
        'icon' => 'eicon-divider icon-brand-elementor',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name'         => 'select_background_hover',
                            'label'        => esc_html__('Background (Hover/Active)', 'frameflow'),
                            'type'         => \Elementor\Group_Control_Background::get_type(),
                            'control_type' => 'group',
                            'types'        => ['classic', 'gradient'],
                            'selector'     => '{{WRAPPER}} .pxl-el-divider',
                        ),
                        array(
                            'name' => 'divider_fill_height',
                            'label' => esc_html__('Fill Parent Height', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => '',
                            'return_value' => 'yes',
                            'label_on' => esc_html__('Yes', 'frameflow'),
                            'label_off' => esc_html__('No', 'frameflow'),
                            'prefix_class' => 'pxl-divider-fill-height-',
                            'description' => esc_html__(
                                'Enable when using % height. Set Min Height on the parent container/column first.',
                                'frameflow'
                            ),
                        ),
                        array(
                            'name' => 'divider_width',
                            'label' => esc_html__('Width', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px', '%'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 10000,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-el-divider' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'divider_height',
                            'label' => esc_html__('Height', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px','%'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 10000,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-el-divider' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_scroll_draw',
                    'label' => esc_html__('Scroll Draw', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'scroll_animation',
                            'label' => esc_html__('Scroll Draw Animation', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'yes',
                            'return_value' => 'yes',
                            'label_on' => esc_html__('Yes', 'frameflow'),
                            'label_off' => esc_html__('No', 'frameflow'),
                        ),
                        array(
                            'name' => 'scroll_animation_direction',
                            'label' => esc_html__('Draw Direction', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'horizontal',
                            'options' => [
                                'horizontal' => esc_html__('Horizontal (Left → Right)', 'frameflow'),
                                'horizontal-reverse' => esc_html__('Horizontal (Right → Left)', 'frameflow'),
                                'vertical' => esc_html__('Vertical (Top → Bottom)', 'frameflow'),
                                'vertical-reverse' => esc_html__('Vertical (Bottom → Top)', 'frameflow'),
                            ],
                            'condition' => [
                                'scroll_animation' => 'yes',
                            ],
                        ),
                        array(
                            'name' => 'scroll_animation_duration',
                            'label' => esc_html__('Draw Duration (ms)', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'default' => 800,
                            'min' => 100,
                            'max' => 5000,
                            'step' => 50,
                            'condition' => [
                                'scroll_animation' => 'yes',
                            ],
                        ),
                        array(
                            'name' => 'scroll_animation_delay',
                            'label' => esc_html__('Draw Delay', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => '0',
                            'description' => esc_html__(
                                'Delay before draw starts (ms) after scroll into view.',
                                'frameflow'
                            ),
                            'condition' => [
                                'scroll_animation' => 'yes',
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
