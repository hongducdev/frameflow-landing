<?php
pxl_add_custom_widget(
    [
        "name" => "pxl_image_marquee",
        "title" => esc_html__("Case Image Marquee", "frameflow"),
        "icon" => "eicon-slider-push icon-brand-elementor",
        "categories" => ["pxltheme-core"],
        "scripts" => ["frameflow-image-marquee"],
        "params" => [
            "sections" => [
                [
                    "name" => "section_content",
                    "label" => esc_html__("Content", "frameflow"),
                    "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
                    "controls" => [
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
                                "size" => 60,
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
                            "name" => "pause_on_hover",
                            "label" => esc_html__("Pause on Hover", "frameflow"),
                            "type" => \Elementor\Controls_Manager::SWITCHER,
                            "default" => "yes",
                        ],
                        [
                            "name" => "enable_lightbox",
                            "label" => esc_html__("Lightbox Popup", "frameflow"),
                            "type" => \Elementor\Controls_Manager::SWITCHER,
                            "default" => "yes",
                        ],
                        [
                            "name" => "images",
                            "label" => esc_html__("Images", "frameflow"),
                            "type" => \Elementor\Controls_Manager::REPEATER,
                            "title_field" => "{{{ image.url }}}",
                            "controls" => [
                                frameflow_widget_media_control(
                                    "image",
                                    esc_html__("Image", "frameflow"),
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
                            "name" => "image_size",
                            "label" => esc_html__("Image Size", "frameflow"),
                            "type" => \Elementor\Controls_Manager::SLIDER,
                            "control_type" => "responsive",
                            "size_units" => ["px"],
                            "range" => [
                                "px" => [
                                    "min" => 80,
                                    "max" => 600,
                                ],
                            ],
                            "default" => [
                                "size" => 300,
                                "unit" => "px",
                            ],
                            "selectors" => [
                                "{{WRAPPER}} .pxl-image-marquee__item" =>
                                    "width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};",
                            ],
                        ],
                        [
                            "name" => "item_spacing",
                            "label" => esc_html__("Item Spacing", "frameflow"),
                            "type" => \Elementor\Controls_Manager::SLIDER,
                            "size_units" => ["px"],
                            "range" => [
                                "px" => [
                                    "min" => 0,
                                    "max" => 100,
                                ],
                            ],
                            "default" => [
                                "size" => 0,
                                "unit" => "px",
                            ],
                            "selectors" => [
                                "{{WRAPPER}} .pxl-image-marquee__item" =>
                                    "margin-inline-end: {{SIZE}}{{UNIT}};",
                            ],
                        ],
                        frameflow_widget_dimensions_control(
                            "image_border_radius",
                            esc_html__("Border Radius", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-image-marquee__item img" =>
                                    "border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
                            ],
                        ),
                        [
                            "name" => "show_edge_fade",
                            "label" => esc_html__("Edge Fade", "frameflow"),
                            "type" => \Elementor\Controls_Manager::SWITCHER,
                            "default" => "yes",
                        ],
                        [
                            "name" => "edge_fade_width",
                            "label" => esc_html__("Edge Fade Width", "frameflow"),
                            "type" => \Elementor\Controls_Manager::SLIDER,
                            "size_units" => ["px"],
                            "range" => [
                                "px" => [
                                    "min" => 40,
                                    "max" => 600,
                                ],
                            ],
                            "default" => [
                                "size" => 200,
                                "unit" => "px",
                            ],
                            "condition" => [
                                "show_edge_fade" => "yes",
                            ],
                            "selectors" => [
                                "{{WRAPPER}} .pxl-image-marquee__inner:before, {{WRAPPER}} .pxl-image-marquee__inner:after" =>
                                    "width: {{SIZE}}{{UNIT}};",
                            ],
                        ],
                        [
                            "name" => "color_overlay_1",
                            "label" => esc_html__(
                                "Fade Color (Left)",
                                "frameflow",
                            ),
                            "type" => \Elementor\Group_Control_Background::get_type(),
                            "control_type" => "group",
                            "types" => ["classic", "gradient"],
                            "selector" =>
                                "{{WRAPPER}} .pxl-image-marquee__inner:before",
                            "condition" => [
                                "show_edge_fade" => "yes",
                            ],
                        ],
                        [
                            "name" => "color_overlay_2",
                            "label" => esc_html__(
                                "Fade Color (Right)",
                                "frameflow",
                            ),
                            "type" => \Elementor\Group_Control_Background::get_type(),
                            "control_type" => "group",
                            "types" => ["classic", "gradient"],
                            "selector" =>
                                "{{WRAPPER}} .pxl-image-marquee__inner:after",
                            "condition" => [
                                "show_edge_fade" => "yes",
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
