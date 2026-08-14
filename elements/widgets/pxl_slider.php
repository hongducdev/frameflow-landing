<?php
/**
 * Case Slider — Swiper carousel; each slide is an Elementor template (pxl-template, type: slider).
 */
$slider_templates = frameflow_get_templates_option(
    'slider',
    array(
        'key'   => '',
        'value' => esc_html__('— Select Template —', 'frameflow'),
    )
);
if (empty($slider_templates)) {
    $slider_templates = array(
        '' => esc_html__('No slider templates found. Create a Template with type «Slider».', 'frameflow'),
    );
}

$slider_help = sprintf(
    '%s <a href="%s" target="_blank" rel="noopener">%s</a>',
    esc_html__('Templates are edited under Frameflow / PXL Templates. Filter by template type Slider.', 'frameflow'),
    esc_url(admin_url('edit.php?post_type=pxl-template')),
    esc_html__('Open templates', 'frameflow')
);

pxl_add_custom_widget(
    array(
        'name'       => 'pxl_slider',
        'title'      => esc_html__('Case Slider', 'frameflow'),
        'icon'       => 'eicon-slides icon-brand-elementor',
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
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_text_carousel/layout1.webp',
                                ),
                                '2' => array(
                                    'label' => esc_html__('Layout 2', 'frameflow'),
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_slider/layout2.webp',
                                ),
                            ),
                        ),
                    ),
                ),
                array(
                    'name'  => 'section_slides',
                    'label' => esc_html__('Slides', 'frameflow'),
                    'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'slides_help',
                            'type' => \Elementor\Controls_Manager::RAW_HTML,
                            'raw'  => '<p class="elementor-control-field-description">' . wp_kses_post($slider_help) . '</p>',
                        ),
                        array(
                            'name'        => 'slides',
                            'label'       => esc_html__('Slider Templates', 'frameflow'),
                            'type'        => \Elementor\Controls_Manager::REPEATER,
                            'controls'    => array(
                                frameflow_widget_text_control(
                                    'slide_note',
                                    esc_html__('Slide Note (optional)', 'frameflow'),
                                    array(
                                        'label_block' => true,
                                        'description' => esc_html__('For editor list only — not shown on the front.', 'frameflow'),
                                    )
                                ),
                                frameflow_widget_select_control(
                                    'slide_template',
                                    esc_html__('Template', 'frameflow'),
                                    $slider_templates,
                                    array(
                                        'default'     => '',
                                        'description' => $slider_help,
                                    )
                                ),
                            ),
                            'title_field' => '{{{ slide_note }}}',
                            'condition'   => array(
                                'layout' => '1',
                            ),
                        ),
                        array(
                            'name'        => 'slides_2',
                            'label'       => esc_html__('Slides (layout 2)', 'frameflow'),
                            'type'        => \Elementor\Controls_Manager::REPEATER,
                            'controls'    => array(
                                frameflow_widget_text_control(
                                    'slide_note',
                                    esc_html__('Slide Note (optional)', 'frameflow'),
                                    array(
                                        'label_block'   => true,
                                        'description'   => esc_html__('For editor list only — not shown on the front.', 'frameflow'),
                                    )
                                ),
                                frameflow_widget_media_control(
                                    'slide_image',
                                    esc_html__('Image', 'frameflow'),
                                    array(
                                        'label_block' => true,
                                    )
                                ),
                                frameflow_widget_select_control(
                                    'slide_template',
                                    esc_html__('Template', 'frameflow'),
                                    $slider_templates,
                                    array(
                                        'default'     => '',
                                        'description' => $slider_help,
                                    )
                                ),
                            ),
                            'title_field' => '{{{ slide_note }}}',
                            'condition'   => array(
                                'layout' => '2',
                            ),
                        ),
                    ),
                ),
                array(
                    'name'  => 'section_style_slide',
                    'label' => esc_html__('Slide', 'frameflow'),
                    'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name'           => 'slide_inner_radius',
                            'label'          => esc_html__('Border Radius', 'frameflow'),
                            'type'           => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units'     => array('px', '%'),
                            'selectors'      => array(
                                '{{WRAPPER}} .pxl-slider .pxl-item--inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                            ),
                            'control_type'   => 'responsive',
                        ),
                        array(
                            'name'         => 'slide_min_height',
                            'label'        => esc_html__('Min Height', 'frameflow'),
                            'type'         => \Elementor\Controls_Manager::SLIDER,
                            'size_units'   => array('px', 'vh'),
                            'range'        => array(
                                'px' => array(
                                    'min' => 0,
                                    'max' => 1200,
                                ),
                                'vh' => array(
                                    'min' => 0,
                                    'max' => 100,
                                ),
                            ),
                            'control_type' => 'responsive',
                            'selectors'    => array(
                                '{{WRAPPER}} .pxl-slider .pxl-item--inner' => 'min-height: {{SIZE}}{{UNIT}};',
                            ),
                        ),
                        frameflow_widget_slider_control(
                            'slide_gap',
                            esc_html__('Gap', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-slider2 .pxl-item--inner' => 'gap: {{SIZE}}{{UNIT}};',
                            ],
                            [
                                'condition' => [
                                    'layout' => '2',
                                ],
                            ]
                        ),
                        frameflow_widget_color_control(
                            'content_background_color',
                            esc_html__('Content Background Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-slider2 .pxl-item--content' => 'background-color: {{VALUE}};',
                            ],
                            [
                                'condition' => [
                                    'layout' => '2',
                                ],
                            ]
                        )
                    ),
                ),
                array(
                    'name'  => 'section_settings_carousel',
                    'label' => esc_html__('Carousel Settings', 'frameflow'),
                    'tab'   => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'controls' => array(
                        array(
                            'name'           => 'item_padding_r',
                            'label'          => esc_html__('Item Padding', 'frameflow'),
                            'type'           => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units'     => array('px'),
                            'default'        => array(
                                'top'    => '0',
                                'right'  => '0',
                                'bottom' => '0',
                                'left'   => '0',
                            ),
                            'selectors'      => array(
                                '{{WRAPPER}} .pxl-swiper-container' => 'margin: -{{TOP}}{{UNIT}} -{{RIGHT}}{{UNIT}} -{{BOTTOM}}{{UNIT}} -{{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-swiper-container .pxl-swiper-slide' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ),
                            'control_type'   => 'responsive',
                        ),
                        ...frameflow_widget_responsive_select_controls(array(
                            'xs'  => array('label' => esc_html__('Columns XS', 'frameflow'), 'options' => array('1' => '1'), 'default' => '1'),
                            'sm'  => array('label' => esc_html__('Columns SM', 'frameflow'), 'options' => array('1' => '1', '2' => '2'), 'default' => '1'),
                            'md'  => array('label' => esc_html__('Columns MD', 'frameflow'), 'options' => array('1' => '1', '2' => '2'), 'default' => '1'),
                            'lg'  => array('label' => esc_html__('Columns LG', 'frameflow'), 'options' => array('1' => '1', '2' => '2', '3' => '3'), 'default' => '1'),
                            'xl'  => array('label' => esc_html__('Columns XL', 'frameflow'), 'options' => array('1' => '1', '2' => '2', '3' => '3', '4' => '4'), 'default' => '1'),
                            'xxl' => array('label' => esc_html__('Columns XXL', 'frameflow'), 'options' => array('1' => '1', '2' => '2', '3' => '3', '4' => '4'), 'default' => '1'),
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
                        frameflow_widget_select_control(
                            'slide_mode',
                            esc_html__('Effect', 'frameflow'),
                            array(
                                'slide' => esc_html__('Slider', 'frameflow'),
                                'fade'  => esc_html__('Fade', 'frameflow'),
                            ),
                            array('default' => 'slide')
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
