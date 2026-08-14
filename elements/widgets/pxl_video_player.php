<?php
// Register Video Player Widget
pxl_add_custom_widget(
    array(
        'name' => 'pxl_video_player',
        'title' => esc_html__('Case Video Button', 'frameflow'),
        'icon' => 'eicon-play icon-brand-elementor',
        'categories' => array('pxltheme-core'),
        'scripts' => array(
            'tilt'
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        frameflow_widget_text_control(
                            'video_link',
                            esc_html__('Link', 'frameflow'),
                            ['default' => 'https://www.youtube.com/watch?v=SF4aHwxHtZ0']
                        ),
                        frameflow_widget_icons_control(
                            'video_icon',
                            esc_html__('Video Icon', 'frameflow')
                        ),
                        frameflow_widget_text_control(
                            'label',
                            esc_html__('Label', 'frameflow'),
                            ['default' => esc_html__('Label', 'frameflow')]
                        ),
                        frameflow_widget_select_control(
                            'image_type',
                            esc_html__('Image Type', 'frameflow'),
                            [
                                'none' => 'None',
                                'img' => 'Image',
                                'bg' => 'Background',
                            ],
                            ['default' => 'none']
                        ),
                        frameflow_widget_media_control(
                            'image',
                            esc_html__('Image', 'frameflow'),
                            [
                                'condition' => [
                                    'image_type' => ['img', 'bg'],
                                ],
                            ]
                        ),
                        frameflow_widget_text_control(
                            'img_size',
                            esc_html__('Image Size', 'frameflow'),
                            [
                                'description' => 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height).',
                                'condition' => [
                                    'image_type' => 'img',
                                ],
                            ]
                        ),
                        array(
                            'name' => 'img_border_radius',
                            'label' => esc_html__('Image Border Radius', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => ['px'],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-video-player .pxl-video--imagebg, {{WRAPPER}} .pxl-video-player .pxl-video--holder' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'condition' => [
                                'image_type' => ['img', 'bg'],
                            ],
                        ),
                        array(
                            'name' => 'image_height',
                            'label' => esc_html__('Image Height', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'description' => esc_html__('Enter number.', 'frameflow'),
                            'condition' => [
                                'image_type' => 'bg',
                            ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 3000,
                                ],
                            ],
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-video-player .pxl-video--imagebg' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        frameflow_widget_select_control(
                            'box_style',
                            esc_html__('Background Effect', 'frameflow'),
                            [
                                'parallax' => 'Parallax',
                                'default' => 'No Parallax',
                            ],
                            [
                                'default' => 'parallax',
                                'condition' => [
                                    'image_type' => ['bg'],
                                ],
                            ]
                        ),
                        frameflow_widget_select_control(
                            'btn_video_style',
                            esc_html__('Button Video Style', 'frameflow'),
                            [
                                'style1' => 'Style White',
                                'style-blur' => 'Style Blur',
                                'style-outline-2' => 'Style Outline',
                                'style-icon' => 'Style Icon',
                                'style-button' => 'Style Button',
                            ],
                            ['default' => 'style1']
                        ),
                        frameflow_widget_select_control(
                            'enable_cursor_follow',
                            esc_html__('Enable Cursor Follow', 'frameflow'),
                            [
                                'true' => esc_html__('Yes', 'frameflow'),
                                'false' => esc_html__('No', 'frameflow'),
                            ],
                            [
                                'default' => 'true',
                                'condition' => [
                                    'btn_video_style!' => 'style-button',
                                ],
                            ]
                        ),
                        frameflow_widget_text_control(
                            'label_button',
                            esc_html__('Label Button', 'frameflow'),
                            [
                                'condition' => [
                                    'btn_video_style' => 'style-button',
                                ],
                                'default' => 'Play',
                            ]
                        ),
                        frameflow_widget_select_control(
                            'show_ripple',
                            esc_html__('Show Ripple', 'frameflow'),
                            [
                                'true' => 'Yes',
                                'false' => 'No',
                            ],
                            ['default' => 'false']
                        ),
                        frameflow_widget_select_control(
                            'btn_video_position',
                            esc_html__('Button Video Position', 'frameflow'),
                            [
                                'p-center' => 'Center',
                                'p-top-left' => 'Top Left',
                                'p-top-right' => 'Top Right',
                                'p-bottom-left' => 'Bottom Left',
                                'p-bottom-right' => 'Bottom Right',
                            ],
                            [
                                'default' => 'p-center',
                                'condition' => [
                                    'image_type' => ['img', 'bg'],
                                ],
                            ]
                        ),
                        array(
                            'name' => 'top_positioon',
                            'label' => esc_html__('Top Position', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['px', '%'],
                            'control_type' => 'responsive',
                            'default' => [
                                'size' => 0,
                                'unit' => '%',
                            ],
                            'range' => [
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-video--holder + .btn-video-wrap.p-top-left, {{WRAPPER}} .pxl-video--holder + .btn-video-wrap.p-top-right' => 'top: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'btn_video_position' => ['p-top-left', 'p-top-right'],
                            ],
                        ),
                        array(
                            'name' => 'right_positioon',
                            'label' => esc_html__('Right Position', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['px', '%'],
                            'control_type' => 'responsive',
                            'default' => [
                                'size' => 0,
                                'unit' => '%',
                            ],
                            'range' => [
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-video--holder + .btn-video-wrap.p-top-right, {{WRAPPER}} .pxl-video--holder + .btn-video-wrap.p-bottom-right' => 'right: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'btn_video_position' => ['p-top-right', 'p-bottom-right'],
                            ],
                        ),
                        array(
                            'name' => 'bottom_positioon',
                            'label' => esc_html__('Bottom Position', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['px', '%'],
                            'control_type' => 'responsive',
                            'default' => [
                                'size' => 0,
                                'unit' => '%',
                            ],
                            'range' => [
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-video--holder + .btn-video-wrap.p-bottom-left, {{WRAPPER}} .pxl-video--holder + .btn-video-wrap.p-bottom-right' => 'bottom: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'btn_video_position' => ['p-bottom-left', 'p-bottom-right'],
                            ],
                        ),
                        array(
                            'name' => 'left_positioon',
                            'label' => esc_html__('Left Position', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['px', '%'],
                            'control_type' => 'responsive',
                            'default' => [
                                'size' => 0,
                                'unit' => '%',
                            ],
                            'range' => [
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-video--holder + .btn-video-wrap.p-top-left, {{WRAPPER}} .pxl-video--holder + .btn-video-wrap.p-bottom-left' => 'left: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'btn_video_position' => ['p-top-left', 'p-bottom-left'],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_general',
                    'label' => esc_html__('General', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(

                        array(
                            'name' => 'button_size',
                            'label' => esc_html__('Button Size', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'description' => esc_html__('Enter number.', 'frameflow'),
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 3000,
                                ],
                            ],
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-video-player .pxl-btn-video' => '--pxl-btn-video-size: {{SIZE}}{{UNIT}};',
                            ],
                        ),


                        array(
                            'name' => 'ic_border_radius',
                            'label' => esc_html__('Icon Border Radius', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => ['px'],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-video-player .pxl-btn-video' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                        frameflow_widget_select_control(
                            'btn_border_style',
                            esc_html__('Border Style', 'frameflow'),
                            [
                                '' => esc_html__('None', 'frameflow'),
                                'solid' => esc_html__('Solid', 'frameflow'),
                                'double' => esc_html__('Double', 'frameflow'),
                                'dotted' => esc_html__('Dotted', 'frameflow'),
                                'dashed' => esc_html__('Dashed', 'frameflow'),
                                'groove' => esc_html__('Groove', 'frameflow'),
                            ],
                            [
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-video-player .pxl-btn-video' => 'border-style: {{VALUE}};',
                                ],
                            ]
                        ),
                        array(
                            'name' => 'btn_border_width',
                            'label' => esc_html__('Border Width', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-video-player .pxl-btn-video' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'condition' => ['btn_border_style!' => ''],
                            'responsive' => true,
                        ),
                        frameflow_widget_color_control(
                            'btn_border_color',
                            esc_html__('Border Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-video-player .pxl-btn-video' => 'border-color: {{VALUE}};',
                            ],
                            ['condition' => ['btn_border_style!' => '']]
                        ),
                        frameflow_widget_color_control(
                            'btn_border_color_hv',
                            esc_html__('Hover Border Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-video-player .pxl-btn-video:hover' => 'border-color: {{VALUE}};',
                            ],
                            ['condition' => ['btn_border_style!' => '']]
                        ),

                        frameflow_widget_color_control(
                            'color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-video-player .pxl-btn-video i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-video-player .pxl-btn-video svg' => 'fill: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'color_hv',
                            esc_html__('Hover Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-video-player .pxl-btn-video:hover i' => 'color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'bgcolor',
                            esc_html__('Background Icon Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-video-player .pxl-btn-video' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-video-player .pxl-btn-video:hover' => 'border-color: {{VALUE}};',
                            ]
                        ),
                        frameflow_widget_color_control(
                            'bgcolor_hv',
                            esc_html__('Background Icon Hover Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-video-player .pxl-btn-video:hover' => 'background-color: {{VALUE}};',
                            ]
                        ),
                        array(
                            'name' => 'icon_size',
                            'label' => esc_html__('Icon Font Size', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'description' => esc_html__('Enter number.', 'frameflow'),
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 3000,
                                ],
                            ],
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-video-player i' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-video-player svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 't_width',
                            'label' => esc_html__('Max Width', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px', '%'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 3000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-video-player .pxl-video--inner' => 'max-width: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_lb',
                    'label' => esc_html__('Label', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_typography_control(
                            'lb_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-video-player .label-text'
                        ),
                        frameflow_widget_color_control(
                            'lb_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-video-player .label-text' => 'color: {{VALUE}};',
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
