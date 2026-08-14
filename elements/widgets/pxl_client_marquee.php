<?php
pxl_add_custom_widget(
    [
        "name" => "pxl_client_marquee",
        "title" => esc_html__("Case Client Marquee", "frameflow"),
        "icon" => "eicon-logo icon-brand-elementor",
        "categories" => ["pxltheme-core"],
        "scripts" => ["frameflow-client-marquee"],
        "params" => [
            "sections" => [
                [
                    "name" => "section_content",
                    "label" => esc_html__("Content", "frameflow"),
                    "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
                    "controls" => [
                        frameflow_widget_select_control(
                            "style",
                            esc_html__("Style", "frameflow"),
                            [
                                "style-1" => esc_html__("Style 1", "frameflow"),
                                "style-2" => esc_html__("Style 2", "frameflow"),
                                "style-3" => esc_html__("Style 3", "frameflow"),
                                "style-4" => esc_html__("Style 4", "frameflow"),
                                "style-5" => esc_html__("Style 5", "frameflow"),
                            ],
                            ["default" => "style-1"],
                        ),
                        frameflow_widget_select_control(
                            "sub_style_2",
                            esc_html__("Sub Style", "frameflow"),
                            [
                                "sub-style-2-1" => esc_html__(
                                    "Sub Style 1",
                                    "frameflow",
                                ),
                                "sub-style-2-2" => esc_html__(
                                    "Sub Style 2",
                                    "frameflow",
                                ),
                            ],
                            [
                                "default" => "sub-style-2-1",
                                "condition" => [
                                    "style" => "style-2",
                                ],
                            ],
                        ),
                        [
                            "name" => "marquee_speed",
                            "label" => esc_html__("Speed (px/s)", "frameflow"),
                            "type" => \Elementor\Controls_Manager::SLIDER,
                            "size_units" => ["px"],
                            "range" => [
                                "px" => [
                                    "min" => 10,
                                    "max" => 400,
                                ],
                            ],
                            "default" => [
                                "size" => 80,
                                "unit" => "px",
                            ],
                        ],
                        frameflow_widget_select_control(
                            "marquee_direction",
                            esc_html__("Direction", "frameflow"),
                            [
                                "left" => esc_html__("Left", "frameflow"),
                                "right" => esc_html__("Right", "frameflow"),
                            ],
                            ["default" => "left"],
                        ),
                        [
                            "name" => "clients",
                            "label" => esc_html__("Clients", "frameflow"),
                            "type" => \Elementor\Controls_Manager::REPEATER,
                            "controls" => [
                                frameflow_widget_select_control(
                                    "client_type",
                                    esc_html__("Client Type", "frameflow"),
                                    [
                                        "logo_image" => esc_html__(
                                            "Logo Image",
                                            "frameflow",
                                        ),
                                        "logo_icon" => esc_html__(
                                            "Logo Icon",
                                            "frameflow",
                                        ),
                                    ],
                                    ["default" => "logo_image"],
                                ),
                                frameflow_widget_media_control(
                                    "client_logo",
                                    esc_html__("Client Logo", "frameflow"),
                                    [
                                        "condition" => [
                                            "client_type" => "logo_image",
                                        ],
                                    ],
                                ),
                                [
                                    "name" => "client_logo_height",
                                    "label" => esc_html__(
                                        "Logo Height",
                                        "frameflow",
                                    ),
                                    "type" => \Elementor\Controls_Manager::SLIDER,
                                    "size_units" => ["px"],
                                    "range" => [
                                        "px" => [
                                            "min" => 20,
                                            "max" => 400,
                                        ],
                                    ],
                                    "condition" => [
                                        "client_type" => "logo_image",
                                    ],
                                ],
                                frameflow_widget_icons_control(
                                    "client_logo_icon",
                                    esc_html__("Client Logo Icon", "frameflow"),
                                    [
                                        "condition" => [
                                            "client_type" => "logo_icon",
                                        ],
                                    ],
                                ),
                                frameflow_widget_url_control(
                                    "client_link",
                                    esc_html__("Client Link", "frameflow"),
                                    [
                                        "default" => [
                                            "url" => "",
                                            "is_external" => true,
                                            "nofollow" => true,
                                        ],
                                    ],
                                ),
                            ],
                        ],
                    ],
                ],
                [
                    "name" => "section_style_items",
                    "label" => esc_html__("Items", "frameflow"),
                    "tab" => \Elementor\Controls_Manager::TAB_STYLE,
                    "controls" => [
                        [
                            "name" => "item_spacing",
                            "label" => esc_html__("Item Spacing", "frameflow"),
                            "type" => \Elementor\Controls_Manager::SLIDER,
                            "size_units" => ["px"],
                            "range" => [
                                "px" => [
                                    "min" => 0,
                                    "max" => 200,
                                ],
                            ],
                            "selectors" => [
                                "{{WRAPPER}} .pxl-client-marquee__item" =>
                                    "padding-inline: {{SIZE}}{{UNIT}};",
                            ],
                        ],
                        frameflow_widget_slider_control(
                            "width_box_client",
                            esc_html__("Width Box Client", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-client-marquee__item" =>
                                    "width: {{SIZE}}{{UNIT}} !important;",
                            ],
                            [
                                "condition" => [
                                    "style" => "style-4",
                                ],
                            ],
                        ),
                        frameflow_widget_slider_control(
                            "height_box_client",
                            esc_html__("Height Box Client", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-client-marquee__item" =>
                                    "height: {{SIZE}}{{UNIT}} !important;",
                            ],
                            [
                                "condition" => [
                                    "style" => "style-4",
                                ],
                            ],
                        ),
                        frameflow_widget_color_control(
                            "border_box_color",
                            esc_html__("Border Box Color", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-client-marquee__item + .pxl-client-marquee__item" =>
                                    "border-left-color: {{VALUE}};",
                            ],
                        ),
                        frameflow_widget_color_control(
                            "item_client_color",
                            esc_html__("Client Color", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-client-marquee__logo svg path" =>
                                    "fill: {{VALUE}};",
                            ],
                        ),
                        frameflow_widget_color_control(
                            "item_client_color_hover",
                            esc_html__("Client Color (Hover)", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-client-marquee__logo:hover svg path" =>
                                    "fill: {{VALUE}};",
                            ],
                        ),
                        [
                            "name" => "logo_max_height",
                            "label" => esc_html__(
                                "Logo Max Height",
                                "frameflow",
                            ),
                            "type" => \Elementor\Controls_Manager::SLIDER,
                            "size_units" => ["px"],
                            "range" => [
                                "px" => [
                                    "min" => 10,
                                    "max" => 200,
                                ],
                            ],
                            "selectors" => [
                                "{{WRAPPER}} .pxl-client-marquee__logo img" =>
                                    "max-height: {{SIZE}}{{UNIT}};",
                            ],
                        ],
                        [
                            "name" => "color_overlay_1",
                            "label" => esc_html__(
                                "Background (Overlay 1)",
                                "frameflow",
                            ),
                            "type" => \Elementor\Group_Control_Background::get_type(),
                            "control_type" => "group",
                            "types" => ["classic", "gradient"],
                            "selector" =>
                                "{{WRAPPER}} .pxl-client-marquee__inner:before",
                        ],
                        [
                            "name" => "color_overlay_2",
                            "label" => esc_html__(
                                "Background (Overlay 2)",
                                "frameflow",
                            ),
                            "type" => \Elementor\Group_Control_Background::get_type(),
                            "control_type" => "group",
                            "types" => ["classic", "gradient"],
                            "selector" =>
                                "{{WRAPPER}} .pxl-client-marquee__inner:after",
                        ],
                        frameflow_widget_slider_control(
                            "box_size_style_2",
                            esc_html__("Box Size", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-client-marquee__item-link" =>
                                    "width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};",
                            ],
                            [
                                "condition" => [
                                    "sub_style_2" => "sub-style-2-2",
                                ],
                            ],
                        ),
                        frameflow_widget_dimensions_control(
                            "box_border_radius_style_2",
                            esc_html__("Box Border Radius", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-client-marquee__item-link" =>
                                    "border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
                            ],
                            [
                                "condition" => [
                                    "sub_style_2" => "sub-style-2-2",
                                ],
                            ],
                        ),
                        frameflow_widget_color_control(
                            "box_border_color_style_2",
                            esc_html__("Box Border Color", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-client-marquee__item-link" =>
                                    "border-color: {{VALUE}};",
                            ],
                            [
                                "condition" => [
                                    "sub_style_2" => "sub-style-2-2",
                                ],
                            ],
                        ),
                        frameflow_widget_color_control(
                            "box_hover_border_color_style_2",
                            esc_html__("Box Hover Border Color", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-client-marquee__item-link:hover" =>
                                    "border-color: {{VALUE}};",
                            ],
                            [
                                "condition" => [
                                    "sub_style_2" => "sub-style-2-2",
                                ],
                            ],
                        ),
                        [
                            "name" => "style_3_image_width",
                            "label" => esc_html__(
                                "Style 3 Image Width",
                                "frameflow",
                            ),
                            "type" => \Elementor\Controls_Manager::SLIDER,
                            "control_type" => "responsive",
                            "size_units" => ["px", "%"],
                            "range" => [
                                "px" => [
                                    "min" => 0,
                                    "max" => 600,
                                ],
                                "%" => [
                                    "min" => 0,
                                    "max" => 100,
                                ],
                            ],
                            "selectors" => [
                                "{{WRAPPER}} .pxl-client-marquee.style-3 .pxl-client-marquee__logo img" =>
                                    "width: {{SIZE}}{{UNIT}};",
                            ],
                            "condition" => [
                                "style" => "style-3",
                            ],
                        ],
                        [
                            "name" => "style_3_image_height",
                            "label" => esc_html__(
                                "Style 3 Image Height",
                                "frameflow",
                            ),
                            "type" => \Elementor\Controls_Manager::SLIDER,
                            "control_type" => "responsive",
                            "size_units" => ["px", "%"],
                            "range" => [
                                "px" => [
                                    "min" => 0,
                                    "max" => 600,
                                ],
                                "%" => [
                                    "min" => 0,
                                    "max" => 100,
                                ],
                            ],
                            "selectors" => [
                                "{{WRAPPER}} .pxl-client-marquee.style-3 .pxl-client-marquee__logo img" =>
                                    "height: {{SIZE}}{{UNIT}}; object-fit: cover;",
                            ],
                            "condition" => [
                                "style" => "style-3",
                            ],
                        ],
                        [
                            "name" => "style_3_image_border_radius",
                            "label" => esc_html__(
                                "Style 3 Image Border Radius",
                                "frameflow",
                            ),
                            "type" => \Elementor\Controls_Manager::DIMENSIONS,
                            "size_units" => ["px", "%"],
                            "selectors" => [
                                "{{WRAPPER}} .pxl-client-marquee.style-3 .pxl-client-marquee__logo img" =>
                                    "border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
                            ],
                            "condition" => [
                                "style" => "style-3",
                            ],
                        ],
                    ],
                ],
                frameflow_widget_animation_settings(),
            ],
        ],
    ],
    frameflow_get_class_widget_path(),
);
