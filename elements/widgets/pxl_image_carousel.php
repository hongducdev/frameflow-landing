<?php
/**
 * Case Image Carousel — gallery of images in a Swiper carousel.
 */
pxl_add_custom_widget(
    array(
        'name'       => 'pxl_image_carousel',
        'title'      => esc_html__('Case Image Carousel', 'frameflow'),
        'icon'       => 'eicon-media-carousel icon-brand-elementor',
        'categories' => array('pxltheme-core'),
        'scripts'    => array(
            'swiper',
            'pxl-swiper',
        ),
        'params'     => array(
            'sections' => array(
                array(
                    'name'  => 'section_layout',
                    'label' => esc_html__('Layout', 'frameflow'),
                    'tab'   => \Elementor\Controls_Manager::TAB_LAYOUT,
                    'controls' => array(
                        array(
                            'name'    => 'layout',
                            'label'   => esc_html__('Templates', 'frameflow'),
                            'type'    => 'layoutcontrol',
                            'default' => '1',
                            'options' => array(
                                '1' => array(
                                    'label' => esc_html__('Layout 1', 'frameflow'),
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_image_carousel/layout1.webp',
                                ),
                            ),
                        ),
                    ),
                ),
                array(
                    'name'  => 'section_content',
                    'label' => esc_html__('Content', 'frameflow'),
                    'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name'        => 'carousel_images',
                            'label'       => esc_html__('Images', 'frameflow'),
                            'type'        => \Elementor\Controls_Manager::REPEATER,
                            'controls'    => array(
                                frameflow_widget_media_control(
                                    'slide_image',
                                    esc_html__('Image', 'frameflow')
                                ),
                                frameflow_widget_url_control(
                                    'slide_link',
                                    esc_html__('Link', 'frameflow')
                                ),
                                frameflow_widget_text_control(
                                    'caption',
                                    esc_html__('Caption', 'frameflow'),
                                    array(
                                        'label_block' => true,
                                    )
                                ),
                            ),
                            'title_field' => '{{{ caption }}}',
                        ),
                    ),
                ),
                array(
                    'name'  => 'section_style_image',
                    'label' => esc_html__('Image', 'frameflow'),
                    'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name'           => 'image_border_radius',
                            'label'          => esc_html__('Border Radius', 'frameflow'),
                            'type'           => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units'     => array('px', '%'),
                            'selectors'      => array(
                                '{{WRAPPER}} .pxl-image-carousel .pxl-item--image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ),
                            'control_type'   => 'responsive',
                        ),
                        frameflow_widget_select_control(
                            'image_object_fit',
                            esc_html__('Object Fit', 'frameflow'),
                            array(
                                'cover'    => esc_html__('Cover', 'frameflow'),
                                'contain'  => esc_html__('Contain', 'frameflow'),
                                'fill'     => esc_html__('Fill', 'frameflow'),
                            ),
                            array(
                                'default'   => 'cover',
                                'selectors' => array(
                                    '{{WRAPPER}} .pxl-image-carousel .pxl-item--image img' => 'object-fit: {{VALUE}};',
                                ),
                            )
                        ),
                        array(
                            'name'         => 'image_min_height',
                            'label'        => esc_html__('Min Height', 'frameflow'),
                            'type'         => \Elementor\Controls_Manager::SLIDER,
                            'size_units'   => array('px', 'vh'),
                            'range'        => array(
                                'px' => array(
                                    'min' => 0,
                                    'max' => 800,
                                ),
                                'vh' => array(
                                    'min' => 0,
                                    'max' => 100,
                                ),
                            ),
                            'control_type' => 'responsive',
                            'selectors'    => array(
                                '{{WRAPPER}} .pxl-image-carousel .pxl-item--image img' => 'min-height: {{SIZE}}{{UNIT}};',
                            ),
                        ),
                        array(
                            'name'         => 'image_max_height',
                            'label'        => esc_html__('Max Height', 'frameflow'),
                            'type'         => \Elementor\Controls_Manager::SLIDER,
                            'size_units'   => array('px', 'vh'),
                            'range'        => array(
                                'px' => array(
                                    'min' => 0,
                                    'max' => 800,
                                ),
                                'vh' => array(
                                    'min' => 0,
                                    'max' => 100,
                                ),
                            ),
                            'control_type' => 'responsive',
                            'selectors'    => array(
                                '{{WRAPPER}} .pxl-image-carousel .pxl-item--image img' => 'max-height: {{SIZE}}{{UNIT}};',
                            ),
                        ),
                    ),
                ),
                array(
                    'name'  => 'section_style_caption',
                    'label' => esc_html__('Caption', 'frameflow'),
                    'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name'      => 'caption_align',
                            'label'     => esc_html__('Alignment', 'frameflow'),
                            'type'      => \Elementor\Controls_Manager::CHOOSE,
                            'options'   => array(
                                'left'   => array(
                                    'title' => esc_html__('Left', 'frameflow'),
                                    'icon'  => 'eicon-text-align-left',
                                ),
                                'center' => array(
                                    'title' => esc_html__('Center', 'frameflow'),
                                    'icon'  => 'eicon-text-align-center',
                                ),
                                'right'  => array(
                                    'title' => esc_html__('Right', 'frameflow'),
                                    'icon'  => 'eicon-text-align-right',
                                ),
                            ),
                            'selectors' => array(
                                '{{WRAPPER}} .pxl-image-carousel .pxl-item--caption' => 'text-align: {{VALUE}};',
                            ),
                            'control_type' => 'responsive',
                        ),
                        frameflow_widget_title_tag_control('caption_tag', esc_html__('HTML Tag', 'frameflow'), 'div'),
                        frameflow_widget_color_control(
                            'caption_color',
                            esc_html__('Color', 'frameflow'),
                            array(
                                '{{WRAPPER}} .pxl-image-carousel .pxl-item--caption' => 'color: {{VALUE}};',
                            )
                        ),
                        frameflow_widget_typography_control(
                            'caption_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-image-carousel .pxl-item--caption'
                        ),
                        array(
                            'name'         => 'caption_spacing',
                            'label'        => esc_html__('Spacing Top', 'frameflow'),
                            'type'         => \Elementor\Controls_Manager::SLIDER,
                            'size_units'   => array('px'),
                            'range'        => array(
                                'px' => array(
                                    'min' => 0,
                                    'max' => 80,
                                ),
                            ),
                            'control_type' => 'responsive',
                            'selectors'    => array(
                                '{{WRAPPER}} .pxl-image-carousel .pxl-item--caption' => 'margin-top: {{SIZE}}{{UNIT}};',
                            ),
                        ),
                    ),
                ),
                array(
                    'name'  => 'section_settings_carousel',
                    'label' => esc_html__('Carousel Settings', 'frameflow'),
                    'tab'   => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'controls' => array(
                        frameflow_widget_text_control(
                            'img_size',
                            esc_html__('Image Size', 'frameflow'),
                            array(
                                'description' => esc_html__('Enter image size (e.g. large, full, or 800x600).', 'frameflow'),
                            )
                        ),
                        array(
                            'name'           => 'item_padding_r',
                            'label'          => esc_html__('Item Padding', 'frameflow'),
                            'type'           => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units'     => array('px'),
                            'default'        => array(
                                'top'    => '15',
                                'right'  => '15',
                                'bottom' => '15',
                                'left'   => '15',
                            ),
                            'selectors'      => array(
                                '{{WRAPPER}} .pxl-swiper-container' => 'margin: -{{TOP}}{{UNIT}} -{{RIGHT}}{{UNIT}} -{{BOTTOM}}{{UNIT}} -{{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-swiper-container .pxl-swiper-slide' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ),
                            'control_type'   => 'responsive',
                        ),
                        ...frameflow_widget_responsive_select_controls(array(
                            'xs'  => array('label' => esc_html__('Columns XS', 'frameflow'), 'options' => array('1' => '1', '2' => '2', '3' => '3'), 'default' => '1'),
                            'sm'  => array('label' => esc_html__('Columns SM', 'frameflow'), 'options' => array('1' => '1', '2' => '2', '3' => '3', '4' => '4'), 'default' => '2'),
                            'md'  => array('label' => esc_html__('Columns MD', 'frameflow'), 'options' => array('1' => '1', '2' => '2', '3' => '3', '4' => '4'), 'default' => '3'),
                            'lg'  => array('label' => esc_html__('Columns LG', 'frameflow'), 'options' => array('1' => '1', '2' => '2', '3' => '3', '4' => '4'), 'default' => '3'),
                            'xl'  => array('label' => esc_html__('Columns XL', 'frameflow'), 'options' => array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6'), 'default' => '3'),
                            'xxl' => array('label' => esc_html__('Columns XXL', 'frameflow'), 'options' => array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6'), 'default' => '3'),
                        )),
                        frameflow_widget_select_control(
                            'slides_to_scroll',
                            esc_html__('Slides to scroll', 'frameflow'),
                            array(
                                '1' => '1',
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                            ),
                            array('default' => '1')
                        ),
                        array(
                            'name'    => 'arrows',
                            'label'   => esc_html__('Show Arrows', 'frameflow'),
                            'type'    => \Elementor\Controls_Manager::SWITCHER,
                        ),
                        frameflow_widget_carousel_arrows_type_control(),
                        array(
                            'name'    => 'pagination',
                            'label'   => esc_html__('Show Pagination', 'frameflow'),
                            'type'    => \Elementor\Controls_Manager::SWITCHER,
                        ),
                        frameflow_widget_select_control(
                            'pagination_type',
                            esc_html__('Pagination Type', 'frameflow'),
                            array(
                                'bullets'     => esc_html__('Bullets', 'frameflow'),
                                'fraction'    => esc_html__('Fraction', 'frameflow'),
                                'progressbar' => esc_html__('Progressbar', 'frameflow'),
                            ),
                            array(
                                'default'   => 'bullets',
                                'condition' => array('pagination' => 'yes'),
                            )
                        ),
                        array(
                            'name'    => 'autoplay',
                            'label'   => esc_html__('Autoplay', 'frameflow'),
                            'type'    => \Elementor\Controls_Manager::SWITCHER,
                        ),
                        array(
                            'name'      => 'autoplay_speed',
                            'label'     => esc_html__('Autoplay Delay (ms)', 'frameflow'),
                            'type'      => \Elementor\Controls_Manager::NUMBER,
                            'default'   => 5000,
                            'condition' => array('autoplay' => 'yes'),
                        ),
                        array(
                            'name'    => 'pause_on_hover',
                            'label'   => esc_html__('Pause on Hover', 'frameflow'),
                            'type'    => \Elementor\Controls_Manager::SWITCHER,
                        ),
                        array(
                            'name'    => 'infinite',
                            'label'   => esc_html__('Infinite Loop', 'frameflow'),
                            'type'    => \Elementor\Controls_Manager::SWITCHER,
                        ),
                        array(
                            'name'    => 'speed',
                            'label'   => esc_html__('Animation Speed (ms)', 'frameflow'),
                            'type'    => \Elementor\Controls_Manager::NUMBER,
                            'default' => 500,
                        ),
                        array(
                            'name'    => 'drap',
                            'label'   => esc_html__('Show Scroll Drag', 'frameflow'),
                            'type'    => \Elementor\Controls_Manager::SWITCHER,
                        ),
                    ),
                ),
                frameflow_widget_carousel_pagination_style_section(),
                frameflow_widget_carousel_pagination_bullet_style_section(),
                frameflow_widget_animation_settings(),
            ),
        ),
    ),
    frameflow_get_class_widget_path()
);
