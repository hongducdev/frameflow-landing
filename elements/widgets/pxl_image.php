<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_image',
        'title' => esc_html__('Case Image', 'frameflow'),
        'icon' => 'eicon-e-image',
        'categories' => array('pxltheme-core'),
        'scripts' => array(
            'pxl-tweenmax',
            'frameflow-image',
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_content',
                    'label' => esc_html__('Content', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        frameflow_widget_select_control(
                            'source_type',
                            esc_html__('Source Type', 'frameflow'),
                            [
                                's_img' => 'Select Image',
                                'f_img' => 'Featured Image',
                                'g_img' => 'Gallery',
                            ],
                            ['default' => 's_img']
                        ),
                        frameflow_widget_media_control(
                            'image',
                            esc_html__('Choose Image', 'frameflow'),
                            [
                                'condition' => [
                                    'source_type' => ['s_img'],
                                ],
                            ]
                        ),
                        array(
                            'name' => 'gallery_images',
                            'label' => esc_html__('Gallery', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::GALLERY,
                            'default' => [],
                            'condition' => [
                                'source_type' => ['g_img'],
                            ],
                        ),
                        array(
                            'name' => 'gallery_interval',
                            'label' => esc_html__('Gallery Interval (ms)', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'default' => 3000,
                            'min' => 500,
                            'step' => 100,
                            'condition' => [
                                'source_type' => ['g_img'],
                            ],
                        ),
                        frameflow_widget_url_control(
                            'image_link',
                            esc_html__('Link', 'frameflow')
                        ),
                        frameflow_widget_select_control(
                            'image_type',
                            esc_html__('Image Type', 'frameflow'),
                            [
                                'img' => 'Image',
                                'bg' => 'Background',
                            ],
                            ['default' => 'img']
                        ),
                        frameflow_widget_text_control(
                            'img_size',
                            esc_html__('Image Size', 'frameflow'),
                            [
                                'description' => 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height).',
                                'condition' => [
                                    'image_type' => ['img'],
                                ],
                            ]
                        ),
                        array(
                            'name' => 'image_align',
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
                                '{{WRAPPER}} .pxl-image-single' => 'text-align: {{VALUE}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_style_img',
                    'label' => esc_html__('Image', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'image_max_height',
                            'label' => esc_html__('Image Max Height', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'description' => esc_html__('Enter number.', 'frameflow'),
                            'condition' => [
                                'image_type' => 'img',
                            ],
                            'size_units' => ['px', '%', 'vh'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 3000,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                                'vh' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-image-single img' => 'max-height: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'image_type' => 'img',
                            ],
                        ),
                        array(
                            'name' => 'image_width',
                            'label' => esc_html__('Image Width', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::CHOOSE,
                            'options' => [
                                'auto' => [
                                    'title' => esc_html__('Auto', 'frameflow'),
                                    'icon' => 'fas fa-arrows-alt-v',
                                ],
                                '100%' => [
                                    'title' => esc_html__('Full', 'frameflow'),
                                    'icon' => 'fas fa-arrows-alt-h',
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-image-single img' => 'width: {{VALUE}};',
                            ],
                            'condition' => [
                                'image_type' => 'img',
                            ],
                            'control_type' => 'responsive',
                        ),
                        frameflow_widget_select_control(
                            'image_object_fit',
                            esc_html__('Image Object Fit', 'frameflow'),
                            [
                                'cover' => 'Cover',
                                'contain' => 'Contain',
                            ],
                            [
                                'default' => 'cover',
                                'condition' => [
                                    'image_type' => 'img',
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-image-single img' => 'object-fit: {{VALUE}};',
                                ],
                            ]
                        ),
                        frameflow_widget_select_control(
                            'image_object_position',
                            esc_html__('Image Object Position', 'frameflow'),
                            [
                                'center' => 'Center',
                                'top' => 'Top',
                                'bottom' => 'Bottom',
                                'left' => 'Left',
                                'right' => 'Right',
                                'top left' => 'Top Left',
                                'top right' => 'Top Right',
                                'bottom left' => 'Bottom Left',
                                'bottom right' => 'Bottom Right',
                            ],
                            [
                                'default' => 'center',
                                'control_type' => 'responsive',
                                'condition' => [
                                    'image_type' => 'img',
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-image-single img' => 'object-position: {{VALUE}};',
                                ],
                            ]
                        ),
                        array(
                            'name' => 'image_height',
                            'label' => esc_html__('Image Height', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'description' => esc_html__('Enter number.', 'frameflow'),
                            'condition' => [
                                'image_type' => 'bg',
                            ],
                            'size_units' => ['px', '%', 'vh'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 3000,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                                'vh' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-image-single .pxl-item--bg' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        frameflow_widget_select_control(
                            'bg_position',
                            esc_html__('Background Position', 'frameflow'),
                            [
                                'center' => 'Center',
                                'top' => 'Top',
                                'bottom' => 'Bottom',
                            ],
                            [
                                'default' => 'center',
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-image-single .pxl-item--bg' => 'background-position: {{VALUE}};',
                                    '{{WRAPPER}} .pxl-image-single .pxl-item--bg.wrap-img-distortion img' => 'object-position: {{VALUE}};',
                                ],
                                'condition' => [
                                    'image_type' => 'bg',
                                ],
                            ]
                        ),
                        frameflow_widget_select_control(
                            'bg_size',
                            esc_html__('Background Size', 'frameflow'),
                            [
                                'cover' => 'Cover',
                                'contain' => 'Contain',
                                'auto' => 'Auto',
                                'initial' => 'Initial',
                            ],
                            [
                                'default' => 'cover',
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-image-single .pxl-item--bg' => 'background-size: {{VALUE}};',
                                    '{{WRAPPER}} .pxl-image-single .pxl-item--bg.wrap-img-distortion img' => 'object-fit: {{VALUE}};',
                                ],
                                'condition' => [
                                    'image_type' => 'bg',
                                ],
                            ]
                        ),    
                        array(
                            'name' => 'border_radius',
                            'label' => esc_html__('Border Radius', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => ['px'],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-image-single img, {{WRAPPER}} .pxl-item--inner, {{WRAPPER}} .pxl-item--bg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                        frameflow_widget_select_control(
                            'border_type',
                            esc_html__('Border Type', 'frameflow'),
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
                                    '{{WRAPPER}} .pxl-image-single img' => 'border-style: {{VALUE}} !important;',
                                ],
                            ]
                        ),
                        array(
                            'name' => 'border_width',
                            'label' => esc_html__('Border Width', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-image-single img' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                            ],
                            'condition' => [
                                'border_type!' => '',
                            ],
                            'responsive' => true,
                        ),
                        frameflow_widget_color_control(
                            'border_color',
                            esc_html__('Border Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-image-single img' => 'border-color: {{VALUE}} !important;',
                            ],
                            [
                                'default' => '',
                                'condition' => [
                                    'border_type!' => '',
                                ],
                            ]
                        ),
                        array(
                            'name'         => 'box_shadow',
                            'label' => esc_html__('Box Shadow', 'frameflow'),
                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                            'control_type' => 'group',
                            'selector'     => '{{WRAPPER}} .pxl-image-single img'
                        ),
                        frameflow_widget_select_control(
                            'img_style',
                            esc_html__('Image Style', 'frameflow'),
                            [
                                '' => esc_html__('Default', 'frameflow'),
                                'distortion' => esc_html__('Distortion', 'frameflow'),
                            ],
                            ['default' => '']
                        ),
                        frameflow_widget_select_control(
                            'img_effect',
                            esc_html__('Image Effect', 'frameflow'),
                            [
                                '' => 'None',
                                'pxl-image-effect1' => 'Zigzag',
                                'pxl-image-spin' => 'Spin',
                                'pxl-image-zoom' => 'Zoom',
                                'pxl-image-bounce' => 'Bounce',
                                'slide-up-down' => 'Slide Up Down',
                                'slide-top-to-bottom' => 'Slide Top To Bottom ',
                                'pxl-image-effect2' => 'Slide Bottom To Top ',
                                'slide-right-to-left' => 'Slide Right To Left ',
                                'slide-left-to-right' => 'Slide Left To Right ',
                                'pxl-hover1' => 'ZoomIn',
                                'pxl-hover2' => 'ZoomOut',
                                'pxl-animation-round' => 'Round',
                                'pxl-image-parallax' => 'Parallax Hover',
                                'pxl-parallax-scroll' => 'Parallax Scroll',
                            ],
                            [
                                'default' => '',
                                'condition' => [
                                    'image_type' => 'img',
                                    'source_type!' => 'g_img',
                                ],
                            ]
                        ),
                        frameflow_widget_select_control(
                            'parallax_scroll_type',
                            esc_html__('Parallax Scroll Type', 'frameflow'),
                            [
                                'y' => 'Effect Y',
                                'x' => 'Effect X',
                                'z' => 'Effect Z',
                            ],
                            [
                                'default' => 'y',
                                'condition' => [
                                    'img_effect' => 'pxl-parallax-scroll',
                                ],
                            ]
                        ),
                        frameflow_widget_text_control(
                            'parallax_scroll_value_x',
                            esc_html__('Parallax Value', 'frameflow'),
                            [
                                'condition' => [
                                    'img_effect' => 'pxl-parallax-scroll',
                                ],
                                'default' => '80',
                                'description' => esc_html__('Enter number.', 'frameflow'),
                            ]
                        ),
                        frameflow_widget_text_control(
                            'parallax_value',
                            esc_html__('Parallax Value', 'frameflow'),
                            [
                                'condition' => [
                                    'img_effect' => 'pxl-image-parallax',
                                ],
                                'default' => '40',
                                'description' => esc_html__('Enter number.', 'frameflow'),
                            ]
                        ),
                        array(
                            'name' => 'speed_effect',
                            'label' => esc_html__('Speed', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 100000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-image-single, {{WRAPPER}} .pxl-image-single img' => 'animation-duration: {{SIZE}}ms;',
                            ],
                            'condition' => [
                                'img_effect!' => ['pxl-hover1', 'pxl-parallax-scroll'],
                                'img_style!' => 'distortion',
                            ],
                            'description' => 'Enter number, unit is ms.',
                        ),
                        array(
                            'name' => 'img_display',
                            'label' => esc_html__('Hide on Screen <= 1400px', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => false,
                        ),
                        array(
                            'name' => 'hide_parallax_sm',
                            'label' => esc_html__('Disable Parallax on Mobile <= 767px', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => false,
                            'condition' => [
                                'img_effect' => ['pxl-parallax-scroll'],
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
