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
                            ],
                            ["default" => "style-1"],
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
                                frameflow_widget_text_control(
                                    "client_name",
                                    esc_html__("Client Name", "frameflow"),
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
                                "{{WRAPPER}} .pxl-client-marquee .pxl-item" =>
                                    "padding-inline: {{SIZE}}{{UNIT}};",
                            ],
                        ],
                    ],
                ],
                [
                    "name" => "section_style_items",
                    "label" => esc_html__("Item", "frameflow"),
                    "tab" => \Elementor\Controls_Manager::TAB_STYLE,
                    "controls" => [
                        frameflow_widget_color_control(
                            "item_background_color",
                            esc_html__("Item Background Color", "frameflow"),
                            [
                                "selectors" => [
                                    "{{WRAPPER}} .pxl-client-marquee .pxl-item" => "background-color: {{VALUE}};",
                                ],
                            ],
                        ),
                        frameflow_widget_dimensions_control(
                            "item_border_radius",
                            esc_html__("Item Border Radius", "frameflow"),
                            [
                                "selectors" => [
                                    "{{WRAPPER}} .pxl-client-marquee .pxl-item" => "border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
                                ],
                            ],
                        ),
                        frameflow_widget_color_control(
                            "item_border_color",
                            esc_html__("Item Border Color", "frameflow"),
                            [
                                "selectors" => [
                                    "{{WRAPPER}} .pxl-client-marquee .pxl-item" => "border-color: {{VALUE}};",
                                ],
                            ],
                        ),
                        frameflow_widget_typography_control(
                            "item_text_typography",
                            esc_html__("Item Text Typography", "frameflow"),
                            '{{WRAPPER}} .pxl-client-marquee .pxl-item--name'
                        ),
                        frameflow_widget_color_control(
                            "item_text_color",
                            esc_html__("Item Text Color", "frameflow"),
                            [
                                "selectors" => [
                                    "{{WRAPPER}} .pxl-client-marquee .pxl-item--name" => "color: {{VALUE}};",
                                ],
                            ],
                        ),
                    ]
                ],
                frameflow_widget_animation_settings(),
            ],
        ],
    ],
    frameflow_get_class_widget_path(),
);
