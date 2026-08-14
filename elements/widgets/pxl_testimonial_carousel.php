<?php
/**
 * Case Testimonial Carousel — Elementor widget (pxl_testimonial_carousel).
 *
 * Templates: elements/templates/pxl_testimonial_carousel/layout-*.php
 * Styles: assets/scss/elements/pxl_testimonial_carousel.scss
 * JS: elements/widgets/js/carousel.js (hook pxl_testimonial_carousel.default)
 */
$slides_to_show = range(1, 10);
$slides_to_show = array_combine($slides_to_show, $slides_to_show);

pxl_add_custom_widget(
    [
        "name" => "pxl_testimonial_carousel",
        "title" => esc_html__("Case Testimonial Carousel", "frameflow"),
        "icon" => "eicon-testimonial icon-brand-elementor",
        "categories" => ["pxltheme-core"],
        "scripts" => ["swiper", "pxl-swiper"],
        "params" => [
            "sections" => [
                [
                    "name" => "section_layout",
                    "label" => esc_html__("Layout", "frameflow"),
                    "tab" => \Elementor\Controls_Manager::TAB_LAYOUT,
                    "controls" => [
                        [
                            "name" => "layout",
                            "label" => esc_html__("Templates", "frameflow"),
                            "type" => "layoutcontrol",
                            "default" => "1",
                            "options" => [
                                "1" => [
                                    "label" => esc_html__(
                                        "Layout 1",
                                        "frameflow",
                                    ),
                                    "image" =>
                                        get_template_directory_uri() .
                                        "/elements/widgets/img-layout/pxl_testimonial_carousel/layout1.webp",
                                ],
                                "2" => [
                                    "label" => esc_html__(
                                        "Layout 2",
                                        "frameflow",
                                    ),
                                    "image" =>
                                        get_template_directory_uri() .
                                        "/elements/widgets/img-layout/pxl_testimonial_carousel/layout2.webp",
                                ],
                                "3" => [
                                    "label" => esc_html__(
                                        "Layout 3",
                                        "frameflow",
                                    ),
                                    "image" =>
                                        get_template_directory_uri() .
                                        "/elements/widgets/img-layout/pxl_testimonial_carousel/layout3.webp",
                                ],
                                "4" => [
                                    "label" => esc_html__(
                                        "Layout 4",
                                        "frameflow",
                                    ),
                                    "image" =>
                                        get_template_directory_uri() .
                                        "/elements/widgets/img-layout/pxl_testimonial_carousel/layout4.webp",
                                ],
                                "5" => [
                                    "label" => esc_html__(
                                        "Layout 5",
                                        "frameflow",
                                    ),
                                    "image" =>
                                        get_template_directory_uri() .
                                        "/elements/widgets/img-layout/pxl_testimonial_carousel/layout5.webp",
                                ],
                                "6" => [
                                    "label" => esc_html__(
                                        "Layout 6",
                                        "frameflow",
                                    ),
                                    "image" =>
                                        get_template_directory_uri() .
                                        "/elements/widgets/img-layout/pxl_testimonial_carousel/layout6.webp",
                                ],
                                "7" => [
                                    "label" => esc_html__(
                                        "Layout 7",
                                        "frameflow",
                                    ),
                                    "image" =>
                                        get_template_directory_uri() .
                                        "/elements/widgets/img-layout/pxl_testimonial_carousel/layout7.webp",
                                ],
                                "8" => [
                                    "label" => esc_html__(
                                        "Layout 8",
                                        "frameflow",
                                    ),
                                    "image" =>
                                        get_template_directory_uri() .
                                        "/elements/widgets/img-layout/pxl_testimonial_carousel/layout8.webp",
                                ],
                                "9" => [
                                    "label" => esc_html__(
                                        "Layout 9",
                                        "frameflow",
                                    ),
                                    "image" =>
                                        get_template_directory_uri() .
                                        "/elements/widgets/img-layout/pxl_testimonial_carousel/layout9.webp",
                                ],
                                "10" => [
                                    "label" => esc_html__(
                                        "Layout 10",
                                        "frameflow",
                                    ),
                                    "image" =>
                                        get_template_directory_uri() .
                                        "/elements/widgets/img-layout/pxl_testimonial_carousel/layout10.webp",
                                ],
                                "11" => [
                                    "label" => esc_html__(
                                        "Layout 11",
                                        "frameflow",
                                    ),
                                    "image" =>
                                        get_template_directory_uri() .
                                        "/elements/widgets/img-layout/pxl_testimonial_carousel/layout11.webp",
                                ],
                                "12" => [
                                    "label" => esc_html__(
                                        "Layout 12",
                                        "frameflow",
                                    ),
                                    "image" =>
                                        get_template_directory_uri() .
                                        "/elements/widgets/img-layout/pxl_testimonial_carousel/layout12.webp",
                                ],
                                "13" => [
                                    "label" => esc_html__(
                                        "Layout 13",
                                        "frameflow",
                                    ),
                                    "image" =>
                                        get_template_directory_uri() .
                                        "/elements/widgets/img-layout/pxl_testimonial_carousel/layout13.webp",
                                ],
                                "14" => [
                                    "label" => esc_html__(
                                        "Layout 14",
                                        "frameflow",
                                    ),
                                    "image" =>
                                        get_template_directory_uri() .
                                        "/elements/widgets/img-layout/pxl_testimonial_carousel/layout14.webp",
                                ],
                                "15" => [
                                    "label" => esc_html__(
                                        "Layout 15",
                                        "frameflow",
                                    ),
                                    "image" =>
                                        get_template_directory_uri() .
                                        "/elements/widgets/img-layout/pxl_testimonial_carousel/layout15.webp",
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    "name" => "section_content",
                    "label" => esc_html__("Content", "frameflow"),
                    "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
                    "controls" => [
                        [
                            "name" => "testimonial",
                            "type" => \Elementor\Controls_Manager::REPEATER,
                            "controls" => [
                                frameflow_widget_media_control(
                                    "avatar",
                                    esc_html__("Avatar", "frameflow"),
                                ),
                                frameflow_widget_text_control(
                                    "title",
                                    esc_html__("Title", "frameflow"),
                                    ["label_block" => true],
                                ),
                                frameflow_widget_text_control(
                                    "position",
                                    esc_html__("Position", "frameflow"),
                                ),
                                frameflow_widget_textarea_control(
                                    "desc",
                                    esc_html__("Description", "frameflow"),
                                    ["show_label" => false],
                                ),
                                frameflow_widget_wysiwyg_control(
                                    "feature",
                                    esc_html__("Feature", "frameflow"),
                                    ["show_label" => false],
                                ),
                                frameflow_widget_url_control(
                                    "link",
                                    esc_html__("Link", "frameflow"),
                                ),
                                frameflow_widget_icons_control(
                                    "client",
                                    esc_html__("Client", "frameflow"),
                                    ["label_block" => true],
                                ),
                                frameflow_widget_number_control(
                                    "star",
                                    esc_html__("Star", "frameflow"),
                                    [
                                        "min" => 0,
                                        "max" => 5,
                                        "step" => 1,
                                    ],
                                ),
                                frameflow_widget_text_control(
                                    "number",
                                    esc_html__("Number", "frameflow"),
                                ),
                                frameflow_widget_text_control(
                                    "number_title",
                                    esc_html__("Number Title", "frameflow"),
                                ),
                            ],
                            "title_field" => "{{{ title }}}",
                        ],
                    ],
                ],
                [
                    "name" => "section_content_center",
                    "label" => esc_html__("Center Rating", "frameflow"),
                    "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
                    "condition" => [
                        "layout" => "12",
                    ],
                    "controls" => [
                        frameflow_widget_media_control(
                            "center_bg",
                            esc_html__("Background Image", "frameflow"),
                        ),
                        frameflow_widget_text_control(
                            "center_label",
                            esc_html__("Label", "frameflow"),
                            [
                                "default" => esc_html__(
                                    "Excellence Rated",
                                    "frameflow",
                                ),
                                "label_block" => true,
                            ],
                        ),
                        frameflow_widget_text_control(
                            "center_rating",
                            esc_html__("Rating", "frameflow"),
                            [
                                "default" => "4.9/5.0",
                                "label_block" => true,
                            ],
                        ),
                        frameflow_widget_text_control(
                            "center_subtitle",
                            esc_html__("Subtitle", "frameflow"),
                            [
                                "default" => esc_html__(
                                    "Google Verified Experiences",
                                    "frameflow",
                                ),
                                "label_block" => true,
                            ],
                        ),
                        frameflow_widget_number_control(
                            "center_star",
                            esc_html__("Stars", "frameflow"),
                            [
                                "min" => 0,
                                "max" => 5,
                                "step" => 1,
                                "default" => 5,
                            ],
                        ),
                    ],
                ],

                [
                    "name" => "section_style_general",
                    "label" => esc_html__("General", "frameflow"),
                    "tab" => \Elementor\Controls_Manager::TAB_STYLE,
                    "controls" => [
                        frameflow_widget_select_control(
                            "style_layout_6",
                            esc_html__("Style Layout 6", "frameflow"),
                            [
                                "style-layout-6-1" => "Style 1",
                                "style-layout-6-2" => "Style 2",
                            ],
                            [
                                "default" => "style-layout-6-1",
                                "condition" => [
                                    "layout" => "6",
                                ],
                            ],
                        ),
                        frameflow_widget_color_control(
                            "box_color",
                            esc_html__("Box Color", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--inner" =>
                                    "background-color: {{VALUE}};",
                            ],
                            [
                                "condition" => [
                                    "layout" => "1",
                                ],
                            ],
                        ),
                        frameflow_widget_color_control(
                            "box_gradient_color_from",
                            esc_html__("Gradient Color From", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--inner" =>
                                    "--gradient-color-from: {{VALUE}};",
                            ],
                            [
                                "condition" => [
                                    "layout" => "2",
                                ],
                            ],
                        ),
                        frameflow_widget_color_control(
                            "box_gradient_color_to",
                            esc_html__("Gradient Color To", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--inner" =>
                                    "--gradient-color-to: {{VALUE}};",
                            ],
                            [
                                "condition" => [
                                    "layout" => "2",
                                ],
                            ],
                        ),
                        frameflow_widget_color_control(
                            "gradient_overlay_color",
                            esc_html__("Gradient Overlay Color", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-testimonial-carousel9" =>
                                    "--gradient-color: {{VALUE}};",
                            ],
                            [
                                "condition" => [
                                    "layout" => "9",
                                ],
                            ],
                        ),
                        [
                            "name" => "box_padding",
                            "label" => esc_html__("Box Padding", "frameflow"),
                            "type" => \Elementor\Controls_Manager::DIMENSIONS,
                            "size_units" => ["px"],
                            "selectors" => [
                                "{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--inner" =>
                                    "padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
                            ],
                            "control_type" => "responsive",
                        ],
                        frameflow_widget_select_control(
                            "border_type",
                            esc_html__("Border Type", "frameflow"),
                            [
                                "" => esc_html__("None", "frameflow"),
                                "solid" => esc_html__("Solid", "frameflow"),
                                "double" => esc_html__("Double", "frameflow"),
                                "dotted" => esc_html__("Dotted", "frameflow"),
                                "dashed" => esc_html__("Dashed", "frameflow"),
                                "groove" => esc_html__("Groove", "frameflow"),
                            ],
                            [
                                "selectors" => [
                                    "{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--inner" =>
                                        "border-style: {{VALUE}};",
                                ],
                            ],
                        ),
                        [
                            "name" => "border_width",
                            "label" => esc_html__("Border Width", "frameflow"),
                            "type" => \Elementor\Controls_Manager::DIMENSIONS,
                            "selectors" => [
                                "{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--inner" =>
                                    "border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;",
                            ],
                            "condition" => [
                                "border_type!" => "",
                            ],
                            "responsive" => true,
                        ],
                        array_merge(
                            frameflow_widget_control_tabs('border_style_tabs', [
                                [
                                    'name' => 'tab_border_normal',
                                    'label' => esc_html__('Normal', 'frameflow'),
                                    'controls' => [
                                        frameflow_widget_color_control(
                                            'border_color',
                                            esc_html__('Border Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--inner' =>
                                                    'border-color: {{VALUE}};',
                                            ],
                                            [
                                                'default' => '',
                                            ]
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'tab_border_hover',
                                    'label' => esc_html__('Hover', 'frameflow'),
                                    'controls' => [
                                        frameflow_widget_color_control(
                                            'border_color_hover',
                                            esc_html__('Border Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-testimonial-carousel .pxl-swiper-slide.swiper-slide-active .pxl-item--inner, {{WRAPPER}} .pxl-testimonial-carousel .pxl-item--inner:hover' =>
                                                    'border-color: {{VALUE}};',
                                            ],
                                            [
                                                'default' => '',
                                            ]
                                        ),
                                    ],
                                ],
                            ]),
                            [
                                'condition' => [
                                    'border_type!' => '',
                                ],
                            ]
                        ),
                    ],
                ],
                [
                    "name" => "section_style_avatar",
                    "label" => esc_html__("Avatar", "frameflow"),
                    "tab" => \Elementor\Controls_Manager::TAB_STYLE,
                    "controls" => [
                        frameflow_widget_slider_control(
                            "avatar_width",
                            esc_html__("Width", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--avatar img" =>
                                    "width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; flex: 0 0 {{SIZE}}{{UNIT}};",
                            ],
                            [
                                "size_units" => ["px", "%"],
                                "range" => [
                                    "px" => [
                                        "min" => 0,
                                        "max" => 500,
                                    ],
                                ],
                            ],
                        ),
                        frameflow_widget_dimensions_control(
                            "avatar_border_radius",
                            esc_html__("Border Radius", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--avatar img" =>
                                    "border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; object-fit: cover;",
                            ],
                        ),
                    ],
                ],
                [
                    "name" => "section_style_icon",
                    "label" => esc_html__("Icon", "frameflow"),
                    "tab" => \Elementor\Controls_Manager::TAB_STYLE,
                    "controls" => [
                        frameflow_widget_color_control(
                            "icon_color",
                            esc_html__("Color", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--icon" =>
                                    "color: {{VALUE}};",
                                "{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--icon svg" =>
                                    "fill: {{VALUE}};",
                            ],
                        ),
                    ],
                ],
                [
                    "name" => "section_style_title",
                    "label" => esc_html__("Title", "frameflow"),
                    "tab" => \Elementor\Controls_Manager::TAB_STYLE,
                    "controls" => [
                        frameflow_widget_color_control(
                            "title_color",
                            esc_html__("Color", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--title" =>
                                    "color: {{VALUE}} !important;",
                            ],
                        ),
                        frameflow_widget_typography_control(
                            "title_typography",
                            esc_html__("Typography", "frameflow"),
                            "{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--title",
                        ),
                        frameflow_widget_dimensions_control(
                            "title_margin",
                            esc_html__("Margin", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--title" =>
                                    "margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
                            ],
                        ),
                    ],
                ],
                [
                    "name" => "section_style_position",
                    "label" => esc_html__("Position", "frameflow"),
                    "tab" => \Elementor\Controls_Manager::TAB_STYLE,
                    "controls" => [
                        frameflow_widget_color_control(
                            "position_color",
                            esc_html__("Color", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--position" =>
                                    "color: {{VALUE}} !important;",
                            ],
                        ),
                        frameflow_widget_color_control(
                            "position_bg_color",
                            esc_html__("Background Color", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-testimonial-carousel15 .pxl-item--position" =>
                                    "background-color: {{VALUE}};",
                            ],
                            [
                                "condition" => [
                                    "layout" => "15",
                                ],
                            ],
                        ),
                        frameflow_widget_typography_control(
                            "position_typography",
                            esc_html__("Typography", "frameflow"),
                            "{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--position",
                        ),
                        frameflow_widget_dimensions_control(
                            "position_margin",
                            esc_html__("Margin", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--position" =>
                                    "margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
                            ],
                        ),
                    ],
                ],
                [
                    "name" => "section_style_desc",
                    "label" => esc_html__("Description", "frameflow"),
                    "tab" => \Elementor\Controls_Manager::TAB_STYLE,
                    "controls" => [
                        frameflow_widget_color_control(
                            "line_color",
                            esc_html__("Under Line Color", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--desc" =>
                                    "border-color: {{VALUE}} !important;",
                            ],
                            [
                                "condition" => [
                                    "layout" => "1",
                                ],
                            ],
                        ),
                        frameflow_widget_color_control(
                            "desc_color",
                            esc_html__("Color", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--description, {{WRAPPER}} .pxl-testimonial-carousel .pxl-item--desc" =>
                                    "color: {{VALUE}} !important;",
                            ],
                        ),
                        frameflow_widget_typography_control(
                            "desc_typography",
                            esc_html__("Typography", "frameflow"),
                            "{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--description, {{WRAPPER}} .pxl-testimonial-carousel .pxl-item--desc",
                        ),
                        frameflow_widget_slider_control(
                            "desc_max_width",
                            esc_html__("Max Width", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--description, {{WRAPPER}} .pxl-testimonial-carousel .pxl-item--desc" =>
                                    "max-width: {{SIZE}}{{UNIT}};",
                            ],
                        ),
                        frameflow_widget_dimensions_control(
                            "desc_margin",
                            esc_html__("Margin", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--description, {{WRAPPER}} .pxl-testimonial-carousel .pxl-item--desc" =>
                                    "margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
                            ],
                        ),
                    ],
                ],
                [
                    "name" => "section_style_feature",
                    "label" => esc_html__("Feature", "frameflow"),
                    "tab" => \Elementor\Controls_Manager::TAB_STYLE,
                    "controls" => [
                        frameflow_widget_color_control(
                            "feature_color",
                            esc_html__("Color", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--feature" =>
                                    "color: {{VALUE}} !important;",
                            ],
                        ),
                        frameflow_widget_typography_control(
                            "feature_typography",
                            esc_html__("Typography", "frameflow"),
                            "{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--feature",
                        ),
                        frameflow_widget_dimensions_control(
                            "feature_margin",
                            esc_html__("Margin", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--feature" =>
                                    "margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
                            ],
                        ),
                    ],
                ],
                [
                    "name" => "section_style_number",
                    "label" => esc_html__("Number", "frameflow"),
                    "tab" => \Elementor\Controls_Manager::TAB_STYLE,
                    "controls" => [
                        frameflow_widget_color_control(
                            "number_color",
                            esc_html__("Color", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--number-value" =>
                                    "color: {{VALUE}} !important;",
                            ],
                        ),
                        frameflow_widget_typography_control(
                            "number_typography",
                            esc_html__("Typography", "frameflow"),
                            "{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--number-value",
                        ),
                        frameflow_widget_color_control(
                            "number_title_color",
                            esc_html__("Title Color", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--number-title" =>
                                    "color: {{VALUE}} !important;",
                            ],
                        ),
                        frameflow_widget_typography_control(
                            "number_title_typography",
                            esc_html__("Title Typography", "frameflow"),
                            "{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--number-title",
                        ),
                        frameflow_widget_color_control(
                            "number_border_color",
                            esc_html__("Border Color", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--number" =>
                                    "border-color: {{VALUE}} !important;",
                            ],
                        ),
                        frameflow_widget_slider_control(
                            "max_width_number_title",
                            esc_html__("Max Width Number Title", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--number-title" =>
                                    "max-width: {{SIZE}}{{UNIT}} !important;",
                            ],
                        ),
                    ],
                ],
                [
                    "name" => "section_style_center_label",
                    "label" => esc_html__("Center Label", "frameflow"),
                    "tab" => \Elementor\Controls_Manager::TAB_STYLE,
                    "condition" => [
                        "layout" => "12",
                    ],
                    "controls" => [
                        frameflow_widget_color_control(
                            "center_label_color",
                            esc_html__("Color", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-testimonial-carousel12 .pxl-item--center-label" =>
                                    "color: {{VALUE}} !important;",
                            ],
                        ),
                        frameflow_widget_typography_control(
                            "center_label_typography",
                            esc_html__("Typography", "frameflow"),
                            "{{WRAPPER}} .pxl-testimonial-carousel12 .pxl-item--center-label",
                        ),
                        frameflow_widget_dimensions_control(
                            "center_label_margin",
                            esc_html__("Margin", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-testimonial-carousel12 .pxl-item--center-label" =>
                                    "margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
                            ],
                        ),
                    ],
                ],
                [
                    "name" => "section_style_center_rating",
                    "label" => esc_html__("Center Rating", "frameflow"),
                    "tab" => \Elementor\Controls_Manager::TAB_STYLE,
                    "condition" => [
                        "layout" => "12",
                    ],
                    "controls" => [
                        frameflow_widget_color_control(
                            "center_rating_color",
                            esc_html__("Color", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-testimonial-carousel12 .pxl-item--center-rating" =>
                                    "color: {{VALUE}} !important;",
                            ],
                        ),
                        frameflow_widget_typography_control(
                            "center_rating_typography",
                            esc_html__("Typography", "frameflow"),
                            "{{WRAPPER}} .pxl-testimonial-carousel12 .pxl-item--center-rating",
                        ),
                        frameflow_widget_dimensions_control(
                            "center_rating_margin",
                            esc_html__("Margin", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-testimonial-carousel12 .pxl-item--center-rating" =>
                                    "margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
                            ],
                        ),
                    ],
                ],
                [
                    "name" => "section_style_center_subtitle",
                    "label" => esc_html__("Center Subtitle", "frameflow"),
                    "tab" => \Elementor\Controls_Manager::TAB_STYLE,
                    "condition" => [
                        "layout" => "12",
                    ],
                    "controls" => [
                        frameflow_widget_color_control(
                            "center_subtitle_color",
                            esc_html__("Color", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-testimonial-carousel12 .pxl-item--center-subtitle" =>
                                    "color: {{VALUE}} !important;",
                            ],
                        ),
                        frameflow_widget_typography_control(
                            "center_subtitle_typography",
                            esc_html__("Typography", "frameflow"),
                            "{{WRAPPER}} .pxl-testimonial-carousel12 .pxl-item--center-subtitle",
                        ),
                        frameflow_widget_dimensions_control(
                            "center_subtitle_margin",
                            esc_html__("Margin", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-testimonial-carousel12 .pxl-item--center-subtitle" =>
                                    "margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
                            ],
                        ),
                    ],
                ],
                [
                    "name" => "section_settings_carousel",
                    "label" => esc_html__("Settings", "frameflow"),
                    "tab" => \Elementor\Controls_Manager::TAB_SETTINGS,
                    "controls" => [
                        [
                            "name" => "item_padding_r",
                            "label" => esc_html__("Item Padding", "frameflow"),
                            "type" => \Elementor\Controls_Manager::DIMENSIONS,
                            "size_units" => ["px"],
                            "default" => [
                                "top" => "15",
                                "right" => "15",
                                "bottom" => "15",
                                "left" => "15",
                            ],
                            "selectors" => [
                                "{{WRAPPER}} .pxl-swiper-container" =>
                                    "margin-top: -{{TOP}}{{UNIT}}; margin-right: -{{RIGHT}}{{UNIT}}; margin-bottom: -{{BOTTOM}}{{UNIT}}; margin-left: -{{LEFT}}{{UNIT}};",
                                "{{WRAPPER}} .pxl-swiper-container .pxl-swiper-slide" =>
                                    "padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
                            ],
                            "control_type" => "responsive",
                        ],
                        ...frameflow_widget_responsive_select_controls([
                            "xs" => [
                                "label" => esc_html__(
                                    "Columns XS Devices",
                                    "frameflow",
                                ),
                                "options" => [
                                    "auto" => "Auto",
                                    "1" => "1",
                                    "2" => "2",
                                    "3" => "3",
                                    "4" => "4",
                                    "6" => "6",
                                ],
                                "default" => "1",
                            ],
                            "sm" => [
                                "label" => esc_html__(
                                    "Columns SM Devices",
                                    "frameflow",
                                ),
                                "options" => [
                                    "auto" => "Auto",
                                    "1" => "1",
                                    "2" => "2",
                                    "3" => "3",
                                    "4" => "4",
                                    "6" => "6",
                                ],
                                "default" => "2",
                            ],
                            "md" => [
                                "label" => esc_html__(
                                    "Columns MD Devices",
                                    "frameflow",
                                ),
                                "options" => [
                                    "auto" => "Auto",
                                    "1" => "1",
                                    "2" => "2",
                                    "3" => "3",
                                    "4" => "4",
                                    "6" => "6",
                                ],
                                "default" => "3",
                            ],
                            "lg" => [
                                "label" => esc_html__(
                                    "Columns LG Devices",
                                    "frameflow",
                                ),
                                "options" => [
                                    "auto" => "Auto",
                                    "1" => "1",
                                    "2" => "2",
                                    "3" => "3",
                                    "4" => "4",
                                    "6" => "6",
                                ],
                                "default" => "3",
                            ],
                            "xl" => [
                                "label" => esc_html__(
                                    "Columns XL Devices",
                                    "frameflow",
                                ),
                                "options" => [
                                    "auto" => "Auto",
                                    "1" => "1",
                                    "2" => "2",
                                    "3" => "3",
                                    "4" => "4",
                                    "5" => "5",
                                    "6" => "6",
                                ],
                                "default" => "3",
                            ],
                            "xxl" => [
                                "label" => esc_html__(
                                    "Columns XXL Devices",
                                    "frameflow",
                                ),
                                "options" => [
                                    "1" => "1",
                                    "2" => "2",
                                    "3" => "3",
                                    "4" => "4",
                                    "5" => "5",
                                    "6" => "6",
                                ],
                                "default" => "3",
                            ],
                        ]),

                        frameflow_widget_select_control(
                            "slides_to_scroll",
                            esc_html__("Slides to scroll", "frameflow"),
                            [
                                "1" => "1",
                                "2" => "2",
                                "3" => "3",
                                "4" => "4",
                                "5" => "5",
                                "6" => "6",
                            ],
                            ["default" => "1"],
                        ),
                        [
                            "name" => "arrows",
                            "label" => esc_html__("Show Arrows", "frameflow"),
                            "type" => \Elementor\Controls_Manager::SWITCHER,
                        ],
                        frameflow_widget_carousel_arrows_type_control(),
                        frameflow_widget_select_control(
                            "arrow_full_content_with_space",
                            esc_html__(
                                "Arrow Full Content with Space",
                                "frameflow",
                            ),
                            [
                                "none" => esc_html__("None", "frameflow"),
                                "start" => esc_html__("Start", "frameflow"),
                                "end" => esc_html__("End", "frameflow"),
                            ],
                            [
                                "prefix_class" =>
                                    "pxl-arrow-full-content-with-space-",
                                "default" => "none",
                                "condition" => [
                                    "arrows" => "true",
                                ],
                            ],
                        ),
                        [
                            "name" => "arrow_full_content_with_space_value",
                            "label" => esc_html__(
                                "Arrow Full Content with Space Value",
                                "frameflow",
                            ),
                            "type" => \Elementor\Controls_Manager::NUMBER,
                            "default" => 1200,
                            "condition" => [
                                "arrow_full_content_with_space!" => "none",
                            ],
                            "control_type" => "responsive",
                        ],
                        [
                            "name" => "pagination",
                            "label" => esc_html__(
                                "Show Pagination",
                                "frameflow",
                            ),
                            "type" => \Elementor\Controls_Manager::SWITCHER,
                            "default" => false,
                        ],
                        frameflow_widget_select_control(
                            "pagination_type",
                            esc_html__("Pagination Type", "frameflow"),
                            [
                                "bullets" => "Bullets",
                                "fraction" => "Fraction",
                                "progressbar" => "Progressbar",
                            ],
                            [
                                "default" => "bullets",
                                "condition" => [
                                    "pagination" => "true",
                                ],
                            ],
                        ),

                        frameflow_widget_color_control(
                            "dot_progressbar_color",
                            esc_html__("Progressbar Color", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-swiper-dots.pxl-swiper-pagination-progressbar .swiper-pagination-progressbar-fill" =>
                                    "background-color: {{VALUE}};",
                            ],
                            [
                                "condition" => [
                                    "pagination_type" => "progressbar",
                                ],
                            ],
                        ),

                        [
                            "name" => "pause_on_hover",
                            "label" => esc_html__(
                                "Pause on Hover",
                                "frameflow",
                            ),
                            "type" => \Elementor\Controls_Manager::SWITCHER,
                        ],
                        [
                            "name" => "autoplay",
                            "label" => esc_html__("Autoplay", "frameflow"),
                            "type" => \Elementor\Controls_Manager::SWITCHER,
                        ],
                        [
                            "name" => "autoplay_speed",
                            "label" => esc_html__(
                                "Autoplay Delay",
                                "frameflow",
                            ),
                            "type" => \Elementor\Controls_Manager::NUMBER,
                            "default" => 5000,
                            "condition" => [
                                "autoplay" => "true",
                            ],
                        ],
                        [
                            "name" => "infinite",
                            "label" => esc_html__("Infinite Loop", "frameflow"),
                            "type" => \Elementor\Controls_Manager::SWITCHER,
                        ],
                        [
                            "name" => "speed",
                            "label" => esc_html__(
                                "Animation Speed",
                                "frameflow",
                            ),
                            "type" => \Elementor\Controls_Manager::NUMBER,
                            "default" => 500,
                        ],
                        [
                            "name" => "drap",
                            "label" => esc_html__(
                                "Show Scroll Drap",
                                "frameflow",
                            ),
                            "type" => \Elementor\Controls_Manager::SWITCHER,
                            "default" => false,
                        ],
                        [
                            "name" => "center",
                            "label" => esc_html__("Center", "frameflow"),
                            "type" => \Elementor\Controls_Manager::SWITCHER,
                            "default" => false,
                        ],
                    ],
                ],
                frameflow_widget_carousel_pagination_style_section(),
                frameflow_widget_carousel_pagination_bullet_style_section(),
                frameflow_widget_animation_settings(),
            ],
        ],
    ],
    frameflow_get_class_widget_path(),
);
