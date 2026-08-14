<?php
use Elementor\Controls_Manager;

pxl_add_custom_widget(
    [
        "name" => "pxl_profile",
        "title" => esc_html__("Case Profile", "frameflow"),
        "icon" => "eicon-person icon-brand-elementor",
        "categories" => ["pxltheme-core"],
        "params" => [
            "sections" => [
                [
                    "name" => "section_layout",
                    "label" => esc_html__("Layout", "frameflow"),
                    "tab" => Controls_Manager::TAB_LAYOUT,
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
                                        "/elements/widgets/img-layout/pxl_profile/layout1.webp",
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    "name" => "section_content",
                    "label" => esc_html__("Content", "frameflow"),
                    "tab" => Controls_Manager::TAB_CONTENT,
                    "controls" => [
                        frameflow_widget_media_control(
                            "profile_image",
                            esc_html__("Profile Image", "frameflow"),
                        ),
                        frameflow_widget_text_control(
                            "profile_img_size",
                            esc_html__("Profile Image Size", "frameflow"),
                            [
                                "description" => esc_html__(
                                    'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height).',
                                    "frameflow",
                                ),
                            ],
                        ),
                        frameflow_widget_media_control(
                            "signature_image",
                            esc_html__("Signature Image", "frameflow"),
                        ),
                        frameflow_widget_text_control(
                            "name",
                            esc_html__("Name", "frameflow"),
                            [
                                "label_block" => true,
                                "default" => esc_html__(
                                    "John Doe",
                                    "frameflow",
                                ),
                            ],
                        ),
                        frameflow_widget_text_control(
                            "position",
                            esc_html__("Position", "frameflow"),
                            [
                                "label_block" => true,
                                "default" => esc_html__(
                                    "Psychologist",
                                    "frameflow",
                                ),
                            ],
                        ),
                    ],
                ],
                [
                    "name" => "section_style_general",
                    "label" => esc_html__("General", "frameflow"),
                    "tab" => Controls_Manager::TAB_STYLE,
                    "controls" => [
                        frameflow_widget_choose_control(
                            "align",
                            esc_html__("Alignment", "frameflow"),
                            [
                                "flex-start" => [
                                    "title" => esc_html__("Left", "frameflow"),
                                    "icon" => "fa fa-align-left",
                                ],
                                "center" => [
                                    "title" => esc_html__(
                                        "Center",
                                        "frameflow",
                                    ),
                                    "icon" => "fa fa-align-center",
                                ],
                                "flex-end" => [
                                    "title" => esc_html__("Right", "frameflow"),
                                    "icon" => "fa fa-align-right",
                                ],
                            ],
                            [
                                "default" => "center",
                                "selectors" => [
                                    "{{WRAPPER}} .pxl-profile" =>
                                        "align-items: {{VALUE}};",
                                ],
                            ],
                        ),
                        [
                            "name" => "profile_height",
                            "label" => esc_html__("Profile Height", "frameflow"),
                            "type" => Controls_Manager::SLIDER,
                            "control_type" => "responsive",
                            "size_units" => ["px"],
                            "range" => [
                                "px" => [
                                    "min" => 200,
                                    "max" => 1200,
                                ],
                            ],
                            "default" => [
                                "size" => 687,
                                "unit" => "px",
                            ],
                            "selectors" => [
                                "{{WRAPPER}} .pxl-profile" =>
                                    "height: {{SIZE}}{{UNIT}};",
                            ],
                        ],
                        [
                            "name" => "info_height",
                            "label" => esc_html__("Info Height", "frameflow"),
                            "type" => Controls_Manager::SLIDER,
                            "control_type" => "responsive",
                            "size_units" => ["px"],
                            "range" => [
                                "px" => [
                                    "min" => 100,
                                    "max" => 600,
                                ],
                            ],
                            "default" => [
                                "size" => 286,
                                "unit" => "px",
                            ],
                            "selectors" => [
                                "{{WRAPPER}} .pxl-profile" =>
                                    "--height-info: {{SIZE}}{{UNIT}};",
                            ],
                        ],
                        frameflow_widget_dimensions_control(
                            "border_radius",
                            esc_html__("Border Radius", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-profile" =>
                                    "border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
                            ],
                        ),
                        frameflow_widget_color_control(
                            "gradient_color",
                            esc_html__("Gradient Color", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-profile" =>
                                    "--gradient-color: {{VALUE}};",
                            ],
                            [
                                "default" => "#ffffff",
                            ],
                        ),
                    ],
                ],
                [
                    "name" => "section_style_signature",
                    "label" => esc_html__("Signature", "frameflow"),
                    "tab" => Controls_Manager::TAB_STYLE,
                    "controls" => [
                        [
                            "name" => "signature_max_width",
                            "label" => esc_html__("Max Width", "frameflow"),
                            "type" => Controls_Manager::SLIDER,
                            "control_type" => "responsive",
                            "size_units" => ["px", "%"],
                            "range" => [
                                "px" => [
                                    "min" => 0,
                                    "max" => 400,
                                ],
                                "%" => [
                                    "min" => 0,
                                    "max" => 100,
                                ],
                            ],
                            "selectors" => [
                                "{{WRAPPER}} .pxl-profile .pxl-item--signature" =>
                                    "max-width: {{SIZE}}{{UNIT}};",
                            ],
                        ],
                        [
                            "name" => "signature_bottom",
                            "label" => esc_html__("Bottom Offset", "frameflow"),
                            "type" => Controls_Manager::SLIDER,
                            "control_type" => "responsive",
                            "size_units" => ["px", "%"],
                            "range" => [
                                "px" => [
                                    "min" => 0,
                                    "max" => 200,
                                ],
                                "%" => [
                                    "min" => 0,
                                    "max" => 50,
                                ],
                            ],
                            "selectors" => [
                                "{{WRAPPER}} .pxl-profile .pxl-item--signature" =>
                                    "margin-bottom: {{SIZE}}{{UNIT}};",
                            ],
                        ],
                        frameflow_widget_select_control(
                            "pxl_animate_signature",
                            esc_html__("Case  Animate", "frameflow"),
                            frameflow_widget_animate(),
                            ["default" => ""],
                        ),
                        frameflow_widget_text_control(
                            "pxl_animate_delay_signature",
                            esc_html__("Animate Delay", "frameflow"),
                            [
                                "default" => "0",
                                "description" => esc_html__(
                                    "Delay before animation starts (ms). Works with WOW, split text, and outline effects.",
                                    "frameflow",
                                ),
                            ],
                        ),
                    ],
                ],
                [
                    "name" => "section_style_name",
                    "label" => esc_html__("Name", "frameflow"),
                    "tab" => Controls_Manager::TAB_STYLE,
                    "controls" => [
                        frameflow_widget_title_tag_control(
                            "name_tag",
                            esc_html__("HTML Tag", "frameflow"),
                            "h5",
                        ),
                        frameflow_widget_color_control(
                            "name_color",
                            esc_html__("Color", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-profile .pxl-item--name" =>
                                    "color: {{VALUE}};",
                            ],
                        ),
                        frameflow_widget_typography_control(
                            "name_typography",
                            esc_html__("Typography", "frameflow"),
                            "{{WRAPPER}} .pxl-profile .pxl-item--name",
                        ),
                        [
                            "name" => "name_spacing",
                            "label" => esc_html__(
                                "Bottom Spacing",
                                "frameflow",
                            ),
                            "type" => Controls_Manager::SLIDER,
                            "control_type" => "responsive",
                            "size_units" => ["px"],
                            "range" => [
                                "px" => [
                                    "min" => 0,
                                    "max" => 60,
                                ],
                            ],
                            "selectors" => [
                                "{{WRAPPER}} .pxl-profile .pxl-item--name" =>
                                    "margin-bottom: {{SIZE}}{{UNIT}};",
                            ],
                        ],
                        frameflow_widget_select_control(
                            "pxl_animate_name",
                            esc_html__("Case  Animate", "frameflow"),
                            frameflow_widget_animate(),
                            ["default" => ""],
                        ),
                        frameflow_widget_text_control(
                            "pxl_animate_delay_name",
                            esc_html__("Animate Delay", "frameflow"),
                            [
                                "default" => "0",
                                "description" => esc_html__(
                                    "Delay before animation starts (ms). Works with WOW, split text, and outline effects.",
                                    "frameflow",
                                ),
                            ],
                        ),
                    ],
                ],
                [
                    "name" => "section_style_position",
                    "label" => esc_html__("Position", "frameflow"),
                    "tab" => Controls_Manager::TAB_STYLE,
                    "controls" => [
                        frameflow_widget_color_control(
                            "position_color",
                            esc_html__("Color", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-profile .pxl-item--position" =>
                                    "color: {{VALUE}};",
                            ],
                        ),
                        frameflow_widget_typography_control(
                            "position_typography",
                            esc_html__("Typography", "frameflow"),
                            "{{WRAPPER}} .pxl-profile .pxl-item--position",
                        ),
                        frameflow_widget_dimensions_control(
                            "position_margin",
                            esc_html__("Margin", "frameflow"),
                            [
                                "{{WRAPPER}} .pxl-profile .pxl-item--position" =>
                                    "margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
                            ],
                        ),
                        frameflow_widget_select_control(
                            "pxl_animate_position",
                            esc_html__("Case  Animate", "frameflow"),
                            frameflow_widget_animate(),
                            ["default" => ""],
                        ),
                        frameflow_widget_text_control(
                            "pxl_animate_delay_position",
                            esc_html__("Animate Delay", "frameflow"),
                            [
                                "default" => "0",
                                "description" => esc_html__(
                                    "Delay before animation starts (ms). Works with WOW, split text, and outline effects.",
                                    "frameflow",
                                ),
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
