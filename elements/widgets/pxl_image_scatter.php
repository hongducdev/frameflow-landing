<?php
/**
 * Case Image Scatter — overlapping tilted screenshot cards.
 * Layout: elements/templates/pxl_image_scatter/layout-1.php
 * Styles: assets/scss/elements/pxl_image_scatter.scss
 * Motion: elements/widgets/js/image-scatter.js
 */
pxl_add_custom_widget(
    [
        'name' => 'pxl_image_scatter',
        'title' => esc_html__('Case Image Scatter', 'frameflow'),
        'icon' => 'eicon-gallery-justified icon-brand-elementor',
        'categories' => ['pxltheme-core'],
        'scripts' => ['gsap', 'pxl-scroll-trigger', 'frameflow-image-scatter'],
        'params' => [
            'sections' => [
                [
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => [
                        [
                            'name' => 'images',
                            'label' => esc_html__('Images', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'title_field' => '{{{ image.url }}}',
                            'default' => [[], [], [], [], []],
                            'controls' => [
                                frameflow_widget_media_control(
                                    'image',
                                    esc_html__('Image', 'frameflow'),
                                ),
                            ],
                        ],
                        [
                            'name' => 'anim_duration',
                            'label' => esc_html__('Duration (s)', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['s'],
                            'range' => [
                                's' => [
                                    'min' => 0.2,
                                    'max' => 2,
                                    'step' => 0.05,
                                ],
                            ],
                            'default' => [
                                'unit' => 's',
                                'size' => 0.85,
                            ],
                        ],
                        [
                            'name' => 'anim_stagger',
                            'label' => esc_html__('Stagger (s)', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['s'],
                            'range' => [
                                's' => [
                                    'min' => 0,
                                    'max' => 0.6,
                                    'step' => 0.02,
                                ],
                            ],
                            'default' => [
                                'unit' => 's',
                                'size' => 0.14,
                            ],
                        ],
                    ],
                ],
                [
                    'name' => 'section_style_frame',
                    'label' => esc_html__('Frame', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => [
                        frameflow_widget_slider_control(
                            'frame_radius',
                            esc_html__('Border Radius', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-image-scatter' =>
                                    '--scatter-radius: {{SIZE}}{{UNIT}};',
                            ],
                            [
                                'size_units' => ['px'],
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 40,
                                    ],
                                ],
                                'default' => [
                                    'unit' => 'px',
                                    'size' => 10,
                                ],
                            ],
                        ),
                        frameflow_widget_color_control(
                            'frame_border_color',
                            esc_html__('Border Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-image-scatter' => '--scatter-border: {{VALUE}};',
                            ],
                        ),
                        frameflow_widget_color_control(
                            'frame_glass_color',
                            esc_html__('Glass Background', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-image-scatter' => '--scatter-glass: {{VALUE}};',
                            ],
                        ),
                    ],
                ],
            ],
        ],
    ],
    frameflow_get_class_widget_path(),
);
