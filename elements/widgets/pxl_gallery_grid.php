<?php
/**
 * Case Gallery Grid — repeater images with isotope masonry + lightbox.
 */
pxl_add_custom_widget(
    array(
        'name'       => 'pxl_gallery_grid',
        'title'      => esc_html__('Case Gallery Grid', 'frameflow'),
        'icon'       => 'eicon-gallery-grid icon-brand-elementor',
        'categories' => array('pxltheme-core'),
        'scripts'    => array(
            'imagesloaded',
            'isotope',
            'pxl-post-grid',
        ),
        'params'     => array(
            'sections' => array(
                array(
                    'name'     => 'section_layout',
                    'label'    => esc_html__('Layout', 'frameflow'),
                    'tab'      => \Elementor\Controls_Manager::TAB_LAYOUT,
                    'controls' => array(
                        array(
                            'name'    => 'layout',
                            'label'   => esc_html__('Templates', 'frameflow'),
                            'type'    => 'layoutcontrol',
                            'default' => '1',
                            'options' => array(
                                '1' => array(
                                    'label' => esc_html__('Layout 1', 'frameflow'),
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_gallery_grid/layout1.webp',
                                ),
                            ),
                        ),
                    ),
                ),
                array(
                    'name'     => 'section_content',
                    'label'    => esc_html__('Content', 'frameflow'),
                    'tab'      => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name'        => 'gallery_images',
                            'label'       => esc_html__('Images', 'frameflow'),
                            'type'        => \Elementor\Controls_Manager::REPEATER,
                            'controls'    => array(
                                frameflow_widget_media_control(
                                    'image',
                                    esc_html__('Image', 'frameflow')
                                ),
                            ),
                            'title_field' => '{{{ image.url }}}',
                        ),
                    ),
                ),
                array(
                    'name'     => 'tab_grid',
                    'label'    => esc_html__('Grid', 'frameflow'),
                    'tab'      => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'controls' => array(
                        frameflow_widget_select_control(
                            'layout_mode',
                            esc_html__('Layout Mode', 'frameflow'),
                            array(
                                'masonry' => esc_html__('Masonry', 'frameflow'),
                                'fitRows' => esc_html__('Fit Rows', 'frameflow'),
                            ),
                            array('default' => 'masonry')
                        ),
                        frameflow_widget_text_control(
                            'img_size',
                            esc_html__('Image Size', 'frameflow'),
                            array(
                                'description' => 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Default: 370x300 (Width x Height)).',
                            )
                        ),
                        frameflow_widget_select_control(
                            'pxl_animate',
                            esc_html__('Case Animate', 'frameflow'),
                            frameflow_widget_animate(),
                            array('default' => '')
                        ),
                        ...frameflow_widget_responsive_columns_controls(
                            array(
                                'xs' => '1',
                                'sm' => '2',
                                'md' => '2',
                                'lg' => '3',
                                'xl' => '3',
                            ),
                            array(
                                'suffixes' => array(
                                    'xs' => esc_html__('XS Devices', 'frameflow'),
                                    'sm' => esc_html__('SM Devices', 'frameflow'),
                                    'md' => esc_html__('MD Devices', 'frameflow'),
                                    'lg' => esc_html__('LG Devices', 'frameflow'),
                                    'xl' => esc_html__('XL Devices', 'frameflow'),
                                ),
                            )
                        ),
                        frameflow_widget_dimensions_control(
                            'item_padding',
                            esc_html__('Item Padding', 'frameflow'),
                            array(
                                '{{WRAPPER}} .pxl-grid-inner' => 'margin-top: -{{TOP}}{{UNIT}}; margin-right: -{{RIGHT}}{{UNIT}}; margin-bottom: -{{BOTTOM}}{{UNIT}}; margin-left: -{{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-grid-inner .pxl-grid-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ),
                            array(
                                'size_units' => array('px'),
                                'default' => array(
                                    'top' => '15',
                                    'right' => '15',
                                    'bottom' => '15',
                                    'left' => '15',
                                ),
                            )
                        ),
                        array(
                            'name'     => 'grid_masonry',
                            'label'    => esc_html__('Grid Masonry', 'frameflow'),
                            'type'     => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                frameflow_widget_select_control(
                                    'text_align_m',
                                    esc_html__('Text Align', 'frameflow'),
                                    array(
                                        'left'   => esc_html__('Left', 'frameflow'),
                                        'center' => esc_html__('Center', 'frameflow'),
                                        'right'  => esc_html__('Right', 'frameflow'),
                                    ),
                                    array('default' => 'left')
                                ),
                                ...frameflow_widget_responsive_select_controls(
                                    array(
                                        'xs' => array(
                                            'name'    => 'col_xs_m',
                                            'default' => '1',
                                            'label'   => esc_html__('Columns: Screen <= 575', 'frameflow'),
                                            'options' => array(
                                                '1'   => '1',
                                                '2'   => '2',
                                                '1.5' => '2/3',
                                                '3'   => '3',
                                                '4'   => '4',
                                                '6'   => '6',
                                            ),
                                        ),
                                        'sm' => array(
                                            'name'    => 'col_sm_m',
                                            'default' => '2',
                                            'label'   => esc_html__('Columns: Screen <= 767', 'frameflow'),
                                            'options' => array(
                                                '1'   => '1',
                                                '2'   => '2',
                                                '1.5' => '2/3',
                                                '3'   => '3',
                                                '4'   => '4',
                                                '6'   => '6',
                                            ),
                                        ),
                                        'md' => array(
                                            'name'    => 'col_md_m',
                                            'default' => '2',
                                            'label'   => esc_html__('Columns: Screen <= 991', 'frameflow'),
                                            'options' => array(
                                                '1'   => '1',
                                                '2'   => '2',
                                                '1.5' => '2/3',
                                                '3'   => '3',
                                                '4'   => '4',
                                                '6'   => '6',
                                            ),
                                        ),
                                        'lg' => array(
                                            'name'    => 'col_lg_m',
                                            'default' => '3',
                                            'label'   => esc_html__('Columns: Screen <= 1199', 'frameflow'),
                                            'options' => array(
                                                '1'      => '1',
                                                '2'      => '2',
                                                '1.5'    => '2/3',
                                                '3'      => '3',
                                                '4'      => '4',
                                                '6'      => '6',
                                                'col-66' => 'Column 66%',
                                            ),
                                        ),
                                        'xl' => array(
                                            'name'    => 'col_xl_m',
                                            'default' => '3',
                                            'label'   => esc_html__('Columns: Screen => 1200', 'frameflow'),
                                            'options' => array(
                                                '1'      => '1',
                                                '2'      => '2',
                                                '1.5'    => '2/3',
                                                '3'      => '3',
                                                '4'      => '4',
                                                '6'      => '6',
                                                'col-66' => 'Column 66%',
                                            ),
                                        ),
                                    )
                                ),
                                frameflow_widget_text_control(
                                    'img_size_m',
                                    esc_html__('Image Size', 'frameflow'),
                                    array(
                                        'description' => 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Default: 370x300 (Width x Height)).',
                                    )
                                ),
                            ),
                        ),
                    ),
                ),
                array(
                    'name'     => 'section_style_image',
                    'label'    => esc_html__('Image', 'frameflow'),
                    'tab'      => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_dimensions_control(
                            'image_border_radius',
                            esc_html__('Border Radius', 'frameflow'),
                            array(
                                '{{WRAPPER}} .pxl-gallery-grid .pxl-item--image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ),
                            array(
                                'size_units' => array('px', '%'),
                            )
                        ),
                    ),
                ),
            ),
        ),
    ),
    frameflow_get_class_widget_path()
);
