<?php
pxl_add_custom_widget(
    [
        "name" => "pxl_testimonial_marquee",
        "title" => esc_html__("Case Testimonial Marquee", "frameflow"),
        "icon" => "eicon-testimonial icon-brand-elementor",
        "categories" => ["pxltheme-core"],
        "scripts" => ["frameflow-testimonial-marquee"],
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
                                    "label" => esc_html__("Layout 1", "frameflow"),
                                    "image" =>
                                        get_template_directory_uri() .
                                        "/elements/widgets/img-layout/pxl_testimonial_marquee/layout1.webp",
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
                            "name" => "testimonials",
                            "label" => esc_html__("Testimonials", "frameflow"),
                            "type" => \Elementor\Controls_Manager::REPEATER,
                            "title_field" => "{{{ name }}}",
                            "controls" => [
                                frameflow_widget_text_control(
                                    "name",
                                    esc_html__("Name", "frameflow"),
                                    [
                                        "default" => esc_html__("John Doe", "frameflow"),
                                        "label_block" => true,
                                    ],
                                ),
                                frameflow_widget_text_control(
                                    "position",
                                    esc_html__("Position", "frameflow"),
                                    [
                                        "default" => esc_html__("CEO, Company", "frameflow"),
                                        "label_block" => true,
                                    ],
                                ),
                                frameflow_widget_textarea_control(
                                    "description",
                                    esc_html__("Description", "frameflow"),
                                    [
                                        "default" => esc_html__(
                                            "This is an amazing testimonial from our client.",
                                            "frameflow",
                                        ),
                                        "show_label" => true,
                                    ],
                                ),
                            ],
                            "default" => [
                                [
                                    "name" => esc_html__("Sarah Johnson", "frameflow"),
                                    "position" => esc_html__(
                                        "Marketing Director",
                                        "frameflow",
                                    ),
                                    "description" => esc_html__(
                                        "Working with this team transformed our brand presence completely.",
                                        "frameflow",
                                    ),
                                ],
                                [
                                    "name" => esc_html__("Michael Chen", "frameflow"),
                                    "position" => esc_html__(
                                        "Founder, TechStart",
                                        "frameflow",
                                    ),
                                    "description" => esc_html__(
                                        "Exceptional service and outstanding results every single time.",
                                        "frameflow",
                                    ),
                                ],
                                [
                                    "name" => esc_html__("Emily Davis", "frameflow"),
                                    "position" => esc_html__(
                                        "Creative Lead",
                                        "frameflow",
                                    ),
                                    "description" => esc_html__(
                                        "A seamless experience from start to finish. Highly recommended.",
                                        "frameflow",
                                    ),
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    "name" => "section_style_items",
                    "label" => esc_html__("Items", "frameflow"),
                    "tab" => \Elementor\Controls_Manager::TAB_STYLE,
                    "controls" => [
                        frameflow_widget_color_control(
                            "item_background_color",
                            esc_html__("Background Color", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-testimonial-marquee .pxl-item" =>
                                    "background-color: {{VALUE}};",
                            ],
                        ),
                        frameflow_widget_dimensions_control(
                            "item_padding",
                            esc_html__("Item Padding", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-testimonial-marquee .pxl-item" =>
                                    "padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
                            ],
                        ),
                        frameflow_widget_slider_control(
                            "item_gap",
                            esc_html__("Item Gap", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-testimonial-marquee .pxl-item--inner" =>
                                    "gap: {{SIZE}}{{UNIT}};",
                            ],
                        ),
                    ],
                ],
                [
                    "name" => "section_style_name",
                    "label" => esc_html__("Name", "frameflow"),
                    "tab" => \Elementor\Controls_Manager::TAB_STYLE,
                    "controls" => [
                        frameflow_widget_color_control(
                            "name_color",
                            esc_html__("Color", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-testimonial-marquee .pxl-item--name" =>
                                    "color: {{VALUE}} !important;",
                            ],
                        ),
                        frameflow_widget_typography_control(
                            "name_typography",
                            esc_html__("Typography", "frameflow"),
                            "{{WRAPPER}} .pxl-testimonial-marquee .pxl-item--name",
                        ),
                        frameflow_widget_dimensions_control(
                            "name_margin",
                            esc_html__("Margin", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-testimonial-marquee .pxl-item--name" =>
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
                                "{{WRAPPER}} .pxl-testimonial-marquee .pxl-item--position" =>
                                    "color: {{VALUE}} !important;",
                            ],
                        ),
                        frameflow_widget_typography_control(
                            "position_typography",
                            esc_html__("Typography", "frameflow"),
                            "{{WRAPPER}} .pxl-testimonial-marquee .pxl-item--position",
                        ),
                        frameflow_widget_dimensions_control(
                            "position_margin",
                            esc_html__("Margin", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-testimonial-marquee .pxl-item--position" =>
                                    "margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
                            ],
                        ),
                    ],
                ],
                [
                    "name" => "section_style_description",
                    "label" => esc_html__("Description", "frameflow"),
                    "tab" => \Elementor\Controls_Manager::TAB_STYLE,
                    "controls" => [
                        frameflow_widget_color_control(
                            "description_color",
                            esc_html__("Color", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-testimonial-marquee .pxl-item--description" =>
                                    "color: {{VALUE}} !important;",
                            ],
                        ),
                        frameflow_widget_typography_control(
                            "description_typography",
                            esc_html__("Typography", "frameflow"),
                            "{{WRAPPER}} .pxl-testimonial-marquee .pxl-item--description",
                        ),
                        frameflow_widget_slider_control(
                            "description_max_width",
                            esc_html__("Max Width", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-testimonial-marquee .pxl-item--description" =>
                                    "max-width: {{SIZE}}{{UNIT}};",
                            ],
                        ),
                        frameflow_widget_dimensions_control(
                            "description_margin",
                            esc_html__("Margin", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-testimonial-marquee .pxl-item--description" =>
                                    "margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
                            ],
                        ),
                    ],
                ],
                frameflow_widget_animation_settings(),
            ],
        ],
    ],
    frameflow_get_class_widget_path(),
);
