<?php
/**
 * Shared Elementor style/settings sections for widgets.
 *
 * Includes: animation section, carousel arrow/pagination style sections,
 * grid filter styles. Prefer these helpers over duplicating controls per widget.
 *
 * Related: widget-control-factory.php (atomic controls), element-functions.php
 */
/**
 * Widget animation section controls.
 */
if (!function_exists("frameflow_widget_animation_settings")) {
    function frameflow_widget_animation_settings($args = [])
    {
        $args = wp_parse_args($args, [
            "tab" => \Elementor\Controls_Manager::TAB_STYLE,
            "condition" => [],
        ]);

        return [
            "name" => "section_animation",
            "label" => esc_html__("Animation", "frameflow"),
            "tab" => $args["tab"],
            "condition" => $args["condition"],
            "controls" => [
                [
                    "name" => "pxl_animate",
                    "label" => esc_html__("Case  Animate", "frameflow"),
                    "type" => \Elementor\Controls_Manager::SELECT,
                    "options" => frameflow_widget_animate(),
                    "default" => "",
                ],
                [
                    "name" => "pxl_animate_delay",
                    "label" => esc_html__("Animate Delay", "frameflow"),
                    "type" => \Elementor\Controls_Manager::TEXT,
                    "default" => "0",
                    "description" => esc_html__(
                        "Delay before animation starts (ms). Works with WOW, split text, and outline effects.",
                        "frameflow",
                    ),
                ],
            ],
        ];
    }
}

if (!function_exists("frameflow_widget_highlight_animation_controls")) {
    /**
     * Highlight-only Case Animate controls (shortcode spans).
     *
     * @param array $args {
     *     @type bool $use_v2 Use frameflow_widget_animate_v2() options.
     * }
     */
    function frameflow_widget_highlight_animation_controls($args = [])
    {
        $args = wp_parse_args($args, [
            "use_v2" => true,
        ]);

        $animate_options = $args["use_v2"]
            ? frameflow_widget_animate_v2()
            : frameflow_widget_animate();

        return [
            frameflow_widget_select_control(
                "pxl_animate_highlight",
                esc_html__("Case  Animate", "frameflow"),
                $animate_options,
                ["default" => ""]
            ),
            frameflow_widget_text_control(
                "pxl_animate_delay_highlight",
                esc_html__("Animate Delay", "frameflow"),
                [
                    "default" => "0",
                    "description" => esc_html__(
                        "Delay before highlight animation starts (ms). Works with WOW, split text, and outline effects.",
                        "frameflow",
                    ),
                ]
            ),
        ];
    }
}

if (!function_exists("frameflow_elementor_register_animation_controls")) {
    /**
     * Register Case Animate controls on native Elementor elements (e.g. Container).
     *
     * @param \Elementor\Element_Base $element
     * @param array                   $args {
     *     @type string $tab             Elementor controls tab.
     *     @type bool   $use_v2          Use frameflow_widget_animate_v2() options.
     * }
     */
    function frameflow_elementor_register_animation_controls($element, $args = [])
    {
        $args = wp_parse_args($args, [
            "tab" => \Elementor\Controls_Manager::TAB_STYLE,
            "use_v2" => false,
        ]);

        $animate_options = $args["use_v2"]
            ? frameflow_widget_animate_v2()
            : frameflow_widget_animate();

        $element->start_controls_section(
            "pxl_section_animation",
            [
                "label" => esc_html__("Animation", "frameflow"),
                "tab" => $args["tab"],
            ]
        );

        $element->add_control(
            "pxl_animate",
            [
                "label" => esc_html__("Case  Animate", "frameflow"),
                "type" => \Elementor\Controls_Manager::SELECT,
                "options" => $animate_options,
                "default" => "",
            ]
        );

        $element->add_control(
            "pxl_animate_delay",
            [
                "label" => esc_html__("Animate Delay", "frameflow"),
                "type" => \Elementor\Controls_Manager::TEXT,
                "default" => "0",
                "description" => esc_html__(
                    "Delay before animation starts (ms). Works with WOW, split text, and outline effects.",
                    "frameflow",
                ),
            ]
        );

        $element->end_controls_section();
    }
}

if (!function_exists("frameflow_elementor_apply_animation_attributes")) {
    /**
     * Apply animation classes and delay attributes to an Elementor element wrapper.
     *
     * @param \Elementor\Element_Base $element
     */
    function frameflow_elementor_apply_animation_attributes($element)
    {
        $pxl_animate = trim((string) $element->get_settings("pxl_animate"));

        if ($pxl_animate !== "") {
            foreach (preg_split("/\s+/", $pxl_animate) as $animate_class) {
                if ($animate_class !== "") {
                    $element->add_render_attribute("_wrapper", "class", $animate_class);
                }
            }
        }

        $pxl_animate_delay = $element->get_settings("pxl_animate_delay");

        if ($pxl_animate_delay !== null && $pxl_animate_delay !== "") {
            $delay = absint($pxl_animate_delay);
            $element->add_render_attribute("_wrapper", "data-wow-delay", $delay . "ms");
            $element->add_render_attribute(
                "_wrapper",
                "data-pxl-animate-delay",
                $delay . "ms"
            );
        }
    }
}

function frameflow_widget_carousel_pagination_style_section($args = [])
{
    $args = wp_parse_args($args, [
        "tab" => \Elementor\Controls_Manager::TAB_STYLE,
        "condition" => [],
    ]);

    $style1_arrow_wrap_condition = array_merge($args["condition"], [
        "arrows" => "true",
        "arrows_type" => "style-1",
    ]);

    $style7_arrow_wrap_condition = array_merge($args["condition"], [
        "arrows" => "true",
        "arrows_type" => "style-7",
    ]);

    return [
        "name" => "section_style_pagination",
        "label" => esc_html__("Pagination", "frameflow"),
        "tab" => $args["tab"],
        "condition" => $args["condition"],
        "controls" => [
            frameflow_widget_slider_control(
                "pagination_max_width",
                esc_html__("Max Width", "frameflow"),
                [
                    "{{WRAPPER}} .pxl-swiper-arrow-wrap" =>
                        "max-width: {{SIZE}}{{UNIT}};",
                ],
            ),
            [
                "name" => "pagination_gap",
                "label" => esc_html__("Gap", "frameflow"),
                "type" => \Elementor\Controls_Manager::SLIDER,
                "control_type" => "responsive",
                "size_units" => ["px"],
                "range" => [
                    "px" => [
                        "min" => 0,
                        "max" => 120,
                    ],
                ],
                "default" => [
                    "unit" => "px",
                    "size" => "",
                ],
                "selectors" => [
                    "{{WRAPPER}} .pxl-swiper-arrow-wrap" =>
                        "gap: {{SIZE}}{{UNIT}};",
                ],
            ],
            [
                "name" => "pagination_margin_top",
                "label" => esc_html__("Margin Top", "frameflow"),
                "type" => \Elementor\Controls_Manager::DIMENSIONS,
                "control_type" => "responsive",
                "size_units" => ["px"],
                "range" => [
                    "px" => [
                        "min" => -250,
                        "max" => 250,
                    ],
                ],
                "default" => [
                    "unit" => "px",
                    "size" => "",
                ],
                "selectors" => [
                    "{{WRAPPER}} .pxl-swiper-arrow-wrap" =>
                        "margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
                ],
            ],
            [
                "name" => "heading_pagination_style1_arrow_wrap",
                "label" => esc_html__("Arrows wrap (Style 1)", "frameflow"),
                "type" => \Elementor\Controls_Manager::HEADING,
                "separator" => "before",
                "condition" => $style1_arrow_wrap_condition,
            ],
            frameflow_widget_select_control(
                "pagination_style1_position",
                esc_html__("Style 1 — Position", "frameflow"),
                [
                    "" => esc_html__("Default", "frameflow"),
                    "absolute" => esc_html__("Absolute", "frameflow"),
                    "relative" => esc_html__("Relative", "frameflow"),
                    "fixed" => esc_html__("Fixed", "frameflow"),
                    "static" => esc_html__("Static", "frameflow"),
                ],
                [
                    "selectors" => [
                        "{{WRAPPER}} .pxl-swiper-arrow-wrap.style-1" =>
                            "position: {{VALUE}};",
                    ],
                    "condition" => $style1_arrow_wrap_condition,
                ],
            ),
            [
                "name" => "pagination_style1_top",
                "label" => esc_html__("Style 1 — Top", "frameflow"),
                "type" => \Elementor\Controls_Manager::SLIDER,
                "control_type" => "responsive",
                "size_units" => ["px", "%"],
                "range" => [
                    "px" => ["min" => -500, "max" => 500],
                    "%" => ["min" => -100, "max" => 100],
                ],
                "default" => [
                    "unit" => "%",
                    "size" => "",
                ],
                "selectors" => [
                    "{{WRAPPER}} .pxl-swiper-arrow-wrap.style-1" =>
                        "top: {{SIZE}}{{UNIT}};",
                ],
                "condition" => $style1_arrow_wrap_condition,
            ],
            [
                "name" => "pagination_style1_left",
                "label" => esc_html__("Style 1 — Left", "frameflow"),
                "type" => \Elementor\Controls_Manager::SLIDER,
                "control_type" => "responsive",
                "size_units" => ["px", "%", "em"],
                "range" => [
                    "px" => ["min" => -400, "max" => 400],
                    "%" => ["min" => -100, "max" => 100],
                ],
                "default" => [
                    "unit" => "px",
                    "size" => "",
                ],
                "selectors" => [
                    "{{WRAPPER}} .pxl-swiper-arrow-wrap.style-1" =>
                        "left: {{SIZE}}{{UNIT}};",
                ],
                "condition" => $style1_arrow_wrap_condition,
            ],
            [
                "name" => "pagination_style1_translate_y",
                "label" => esc_html__("Style 1 — Translate Y", "frameflow"),
                "type" => \Elementor\Controls_Manager::SLIDER,
                "control_type" => "responsive",
                "size_units" => ["%", "px"],
                "range" => [
                    "%" => ["min" => -100, "max" => 100],
                    "px" => ["min" => -200, "max" => 200],
                ],
                "default" => [
                    "unit" => "%",
                    "size" => "",
                ],
                "selectors" => [
                    "{{WRAPPER}} .pxl-swiper-arrow-wrap.style-1" =>
                        "transform: translateY({{SIZE}}{{UNIT}});",
                ],
                "condition" => $style1_arrow_wrap_condition,
            ],
            [
                "name" => "pagination_style1_width_extra",
                "label" => esc_html__(
                    "Style 1 — Width (calc 100% + …)",
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
                ],
                "default" => [
                    "unit" => "px",
                    "size" => "",
                ],
                "description" => esc_html__(
                    "Sets width to calc(100% + value). Theme default extension is 216px.",
                    "frameflow",
                ),
                "selectors" => [
                    "{{WRAPPER}} .pxl-swiper-arrow-wrap.style-1" =>
                        "width: calc(100% + {{SIZE}}{{UNIT}});",
                ],
                "condition" => $style1_arrow_wrap_condition,
            ],
            [
                "name" => "pagination_style1_margin_top",
                "label" => esc_html__("Style 1 — Margin Top", "frameflow"),
                "type" => \Elementor\Controls_Manager::SLIDER,
                "control_type" => "responsive",
                "size_units" => ["px"],
                "range" => [
                    "px" => [
                        "min" => -250,
                        "max" => 250,
                    ],
                ],
                "default" => [
                    "unit" => "px",
                    "size" => "",
                ],
                "selectors" => [
                    "{{WRAPPER}} .pxl-swiper-arrow-wrap.style-1" =>
                        "margin-top: {{SIZE}}{{UNIT}};",
                ],
                "condition" => $style1_arrow_wrap_condition,
            ],
            [
                "name" => "heading_pagination_style7_arrow_wrap",
                "label" => esc_html__("Arrows wrap (Style 7)", "frameflow"),
                "type" => \Elementor\Controls_Manager::HEADING,
                "separator" => "before",
                "condition" => $style7_arrow_wrap_condition,
            ],
            frameflow_widget_slider_control(
                "pagination_top",
                esc_html__("Style 7 — Top", "frameflow"),
                [
                    "{{WRAPPER}} .pxl-swiper-arrow-wrap.style-7" =>
                        "top: {{SIZE}}{{UNIT}};",
                ],
                [
                    "condition" => $style7_arrow_wrap_condition,
                ],
            ),
            frameflow_widget_slider_control(
                "pagination_left",
                esc_html__("Style 7 — Left", "frameflow"),
                [
                    "{{WRAPPER}} .pxl-swiper-arrow-wrap.style-7" =>
                        "left: {{SIZE}}{{UNIT}};",
                ],
                [
                    "condition" => $style7_arrow_wrap_condition,
                ],
            ),
            frameflow_widget_dimensions_control(
                "pagination_border_radius_7",
                esc_html__("Border Radius (Style 7)", "frameflow"),
                [
                    "{{WRAPPER}} .pxl-swiper-arrow-wrap.style-7" =>
                        "border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
                ],
                [
                    "condition" => $style7_arrow_wrap_condition,
                ],
            ),
            [
                "name" => "pagination_width",
                "label" => esc_html__("Width", "frameflow"),
                "type" => \Elementor\Controls_Manager::SLIDER,
                "control_type" => "responsive",
                "size_units" => ["px"],
                "range" => [
                    "px" => [
                        "min" => 24,
                        "max" => 120,
                    ],
                ],
                "default" => [
                    "unit" => "px",
                    "size" => "",
                ],
                "selectors" => [
                    "{{WRAPPER}} .pxl-swiper-arrow-wrap .pxl-swiper-arrow" =>
                        "width: {{SIZE}}{{UNIT}};",
                ],
            ],
            [
                "name" => "pagination_height",
                "label" => esc_html__("Height", "frameflow"),
                "type" => \Elementor\Controls_Manager::SLIDER,
                "control_type" => "responsive",
                "size_units" => ["px"],
                "range" => [
                    "px" => [
                        "min" => 24,
                        "max" => 120,
                    ],
                ],
                "default" => [
                    "unit" => "px",
                    "size" => "",
                ],
                "selectors" => [
                    "{{WRAPPER}} .pxl-swiper-arrow-wrap .pxl-swiper-arrow" =>
                        "height: {{SIZE}}{{UNIT}};",
                ],
            ],
            frameflow_widget_dimensions_control(
                'pagination_prev_border_radius',
                esc_html__('Previous Border Radius', 'frameflow'),
                [
                    '{{WRAPPER}} .pxl-swiper-arrow-wrap .pxl-swiper-arrow.pxl-swiper-arrow-prev' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ),
            frameflow_widget_dimensions_control(
                'pagination_prev_border_radius',
                esc_html__('Previous Border Radius', 'frameflow'),
                [
                    '{{WRAPPER}} .pxl-swiper-arrow-wrap .pxl-swiper-arrow.pxl-swiper-arrow-prev' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ),
            frameflow_widget_dimensions_control(
                'pagination_next_border_radius',
                esc_html__('Next Border Radius', 'frameflow'),
                [
                    '{{WRAPPER}} .pxl-swiper-arrow-wrap .pxl-swiper-arrow.pxl-swiper-arrow-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ),
            frameflow_widget_choose_control(
                'pagination_align_items',
                esc_html__('Alignment', 'frameflow'),
                [
                    'flex-start' => [
                        'title' => esc_html__('Left', 'frameflow'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'frameflow'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Right', 'frameflow'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                [
                    'selectors' => [
                        '{{WRAPPER}} .pxl-swiper-arrow-wrap' => 'align-items: {{VALUE}};',  
                    ],
                    'control_type' => 'responsive',
                ]
            ),
            frameflow_widget_choose_control(
                'pagination_justify_content',
                esc_html__('Justify Content', 'frameflow'),
                [
                    'flex-start' => [
                        'title' => esc_html__('Left', 'frameflow'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'frameflow'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Right', 'frameflow'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                [
                    'selectors' => [
                        '{{WRAPPER}} .pxl-swiper-arrow-wrap' => 'justify-content: {{VALUE}};',
                    ],
                    'control_type' => 'responsive',
                ]
            ),
            frameflow_widget_select_control(
                "arrows_icon_type",
                esc_html__("Arrow Icon", "frameflow"),
                [
                    "inherit" => esc_html__("Inherit", "frameflow"),
                    "default" => esc_html__("Default", "frameflow"),
                    "style-3" => esc_html__("Style 3", "frameflow"),
                    "style-4" => esc_html__("Style 4", "frameflow"),
                    "custom" => esc_html__("Custom", "frameflow"),
                ],
                [
                    "default" => "inherit",
                    "condition" => [
                        "arrows" => "true",
                    ],
                ],
            ),
            frameflow_widget_icons_control(
                "arrows_icon_prev",
                esc_html__("Previous Icon", "frameflow"),
                [
                    "condition" => [
                        "arrows" => "true",
                        "arrows_icon_type" => "custom",
                    ],
                ],
            ),
            frameflow_widget_icons_control(
                "arrows_icon_next",
                esc_html__("Next Icon", "frameflow"),
                [
                    "condition" => [
                        "arrows" => "true",
                        "arrows_icon_type" => "custom",
                    ],
                ],
            ),
            frameflow_widget_color_control(
                "pagination_color",
                esc_html__("Arrow Color", "frameflow"),
                [
                    "{{WRAPPER}} .pxl-swiper-arrow-wrap .pxl-swiper-arrow, {{WRAPPER}} .pxl-swiper-arrow-wrap .pxl-swiper-arrow svg" =>
                        "color: {{VALUE}};",
                    "{{WRAPPER}} .pxl-swiper-arrow-wrap .pxl-swiper-arrow svg path" =>
                        "fill: {{VALUE}};",
                ],
            ),
            frameflow_widget_color_control(
                "pagination_bg_color",
                esc_html__("Background", "frameflow"),
                [
                    "{{WRAPPER}} .pxl-swiper-arrow-wrap .pxl-swiper-arrow" =>
                        "background-color: {{VALUE}};",
                ],
            ),
            frameflow_widget_color_control(
                "pagination_hover_color",
                esc_html__("Hover Color", "frameflow"),
                [
                    "{{WRAPPER}} .pxl-swiper-arrow-wrap .pxl-swiper-arrow:hover" =>
                        "color: {{VALUE}};",
                    "{{WRAPPER}} .pxl-swiper-arrow-wrap .pxl-swiper-arrow:hover svg path" =>
                        "fill: {{VALUE}};",
                ],
            ),
            frameflow_widget_color_control(
                "pagination_hover_bg_color",
                esc_html__("Hover Background", "frameflow"),
                [
                    "{{WRAPPER}} .pxl-swiper-arrow-wrap .pxl-swiper-arrow:hover" =>
                        "background-color: {{VALUE}};",
                ],
            ),
            frameflow_widget_dimensions_control(
                "pagination_border_radius",
                esc_html__("Border Radius", "frameflow"),
                [
                    "{{WRAPPER}} .pxl-swiper-arrow-wrap .pxl-swiper-arrow" =>
                        "border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
                ],
            ),
            frameflow_widget_select_control(
                "pagination_border_type",
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
                        "{{WRAPPER}} .pxl-swiper-arrow-wrap .pxl-swiper-arrow" =>
                            "border-style: {{VALUE}} !important;",
                    ],
                ],
            ),
            frameflow_widget_dimensions_control(
                "pagination_border_width",
                esc_html__("Border Width", "frameflow"),
                [
                    "{{WRAPPER}} .pxl-swiper-arrow-wrap .pxl-swiper-arrow" =>
                        "border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;",
                ],
                ["condition" => ["pagination_border_type!" => ""]],
            ),
            frameflow_widget_color_control(
                "pagination_border_color",
                esc_html__("Border Color", "frameflow"),
                [
                    "{{WRAPPER}} .pxl-swiper-arrow-wrap .pxl-swiper-arrow" =>
                        "border-color: {{VALUE}};",
                ],
                ["condition" => ["pagination_border_type!" => ""]],
            ),
            frameflow_widget_color_control(
                "pagination_hover_border_color",
                esc_html__("Hover Border Color", "frameflow"),
                [
                    "{{WRAPPER}} .pxl-swiper-arrow-wrap .pxl-swiper-arrow:hover" =>
                        "border-color: {{VALUE}};",
                ],
                ["condition" => ["pagination_border_type!" => ""]],
            ),
        ],
    ];
}

if (
    !function_exists(
        "frameflow_widget_carousel_pagination_bullet_style_section",
    )
) {
    function frameflow_widget_carousel_pagination_bullet_style_section(
        $args = [],
    ) {
        $args = wp_parse_args($args, [
            "tab" => \Elementor\Controls_Manager::TAB_STYLE,
            "condition" => [],
            "wrapper_selector" => "{{WRAPPER}} .pxl-swiper-dots",
            "bottom_selector" => "{{WRAPPER}} .pxl-swiper-bottom",
            "bullet_selector" =>
                "{{WRAPPER}} .pxl-swiper-dots .pxl-swiper-pagination-bullet",
            "active_selector" =>
                "{{WRAPPER}} .pxl-swiper-dots .pxl-swiper-pagination-bullet.swiper-pagination-bullet-active",
        ]);

        return [
            "name" => "section_style_pagination_bullet",
            "label" => esc_html__("Pagination Bullet", "frameflow"),
            "tab" => $args["tab"],
            "condition" => $args["condition"],
            "controls" => [
                frameflow_widget_slider_control(
                    "pagination_bullet_max_width",
                    esc_html__("Max Width", "frameflow"),
                    [
                        $args["wrapper_selector"] =>
                            "width: 100%; max-width: {{SIZE}}{{UNIT}}; margin-left: auto; margin-right: auto;",
                        $args["bottom_selector"] =>
                            "width: 100%; max-width: {{SIZE}}{{UNIT}}; margin-left: auto; margin-right: auto;",
                    ],
                ),
                frameflow_widget_color_control(
                    "pagination_bullet_color",
                    esc_html__("Color", "frameflow"),
                    [
                        $args["bullet_selector"] =>
                            "background-color: {{VALUE}};",
                        $args["wrapper_selector"] .
                        ".pxl-swiper-pagination-progressbar" =>
                            "background-color: {{VALUE}};",
                    ],
                ),
                frameflow_widget_color_control(
                    "pagination_bullet_active_color",
                    esc_html__("Active Color", "frameflow"),
                    [
                        $args["active_selector"] =>
                            "background-color: {{VALUE}};",
                        $args["wrapper_selector"] .
                        ".pxl-swiper-pagination-progressbar .swiper-pagination-progressbar-fill" =>
                            "background-color: {{VALUE}};",
                    ],
                ),
            ],
        ];
    }
}

if (!function_exists("frameflow_widget_grid_filter_style_section")) {
    /**
     * Style controls for .pxl-grid-filter (Isotope / term filters).
     *
     * @param array $args {
     *     @type string $tab       Elementor tab ID.
     *     @type array  $condition Section visibility conditions.
     *     @type string $wrapper   Base selector prefix, default '{{WRAPPER}} .pxl-grid-filter'.
     * }
     */
    function frameflow_widget_grid_filter_style_section($args = [])
    {
        $args = wp_parse_args($args, [
            "tab" => \Elementor\Controls_Manager::TAB_STYLE,
            "condition" => [],
            "wrapper" => "{{WRAPPER}} .pxl-grid-filter",
        ]);

        $w = $args["wrapper"];
        $inner = $w . " .pxl--filter-inner";
        $item = $w . " .filter-item";
        $item_hover = $w . " .filter-item:hover";
        $item_active = $w . " .filter-item.active";
        $border_not_empty = ["filter_item_border_type!" => ""];

        return [
            "name" => "tab_style_filter_section",
            "label" => esc_html__("Filter", "frameflow"),
            "tab" => $args["tab"],
            "condition" => $args["condition"],
            "controls" => [
                frameflow_widget_typography_control(
                    "filter_typography",
                    esc_html__("Typography", "frameflow"),
                    $item,
                ),
                frameflow_widget_slider_control(
                    "filter_gap",
                    esc_html__("Gap", "frameflow"),
                    [
                        $inner => "gap: {{SIZE}}{{UNIT}};",
                    ],
                ),
                frameflow_widget_slider_control(
                    "filter_height",
                    esc_html__("Height", "frameflow"),
                    [
                        $item => "height: {{SIZE}}{{UNIT}};",
                    ],
                ),
                frameflow_widget_color_control(
                    "filter_background_color",
                    esc_html__("Background Color", "frameflow"),
                    [
                        $item => "background-color: {{VALUE}};",
                    ],
                ),
                frameflow_widget_color_control(
                    "filter_background_color_hover",
                    esc_html__("Background Color Hover", "frameflow"),
                    [
                        $item_hover => "background-color: {{VALUE}};",
                    ],
                ),
                frameflow_widget_color_control(
                    "filter_background_color_active",
                    esc_html__("Background Color Active", "frameflow"),
                    [
                        $item_active => "background-color: {{VALUE}};",
                    ],
                ),
                frameflow_widget_color_control(
                    "filter_color",
                    esc_html__("Color", "frameflow"),
                    [
                        $item => "color: {{VALUE}};",
                    ],
                ),
                frameflow_widget_color_control(
                    "filter_color_hover",
                    esc_html__("Color Hover", "frameflow"),
                    [
                        $item_hover => "color: {{VALUE}};",
                    ],
                ),
                frameflow_widget_color_control(
                    "filter_color_active",
                    esc_html__("Color Active", "frameflow"),
                    [
                        $item_active => "color: {{VALUE}};",
                    ],
                ),
                frameflow_widget_dimensions_control(
                    "filter_item_padding",
                    esc_html__("Padding", "frameflow"),
                    [
                        $item =>
                            "padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
                    ],
                ),
                frameflow_widget_select_control(
                    "filter_item_border_type",
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
                            $item => "border-style: {{VALUE}} !important;",
                        ],
                    ],
                ),
                frameflow_widget_dimensions_control(
                    "filter_item_border",
                    esc_html__("Border Width", "frameflow"),
                    [
                        $item =>
                            "border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;",
                    ],
                    ["condition" => $border_not_empty],
                ),
                frameflow_widget_color_control(
                    "filter_item_border_color",
                    esc_html__("Border Color", "frameflow"),
                    [
                        $item => "border-color: {{VALUE}};",
                    ],
                    ["condition" => $border_not_empty],
                ),
                frameflow_widget_color_control(
                    "filter_item_border_color_hover",
                    esc_html__("Border Color Hover", "frameflow"),
                    [
                        $item_hover => "border-color: {{VALUE}};",
                    ],
                    ["condition" => $border_not_empty],
                ),
                frameflow_widget_color_control(
                    "filter_item_border_color_active",
                    esc_html__("Border Color Active", "frameflow"),
                    [
                        $item_active => "border-color: {{VALUE}};",
                    ],
                    ["condition" => $border_not_empty],
                ),
                frameflow_widget_dimensions_control(
                    "filter_item_border_radius",
                    esc_html__("Border Radius", "frameflow"),
                    [
                        $item =>
                            "border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
                    ],
                ),
            ],
        ];
    }
}

if (!function_exists('frameflow_include_swiper_arrows')) {
    /**
     * Render swiper prev/next arrows from widget settings.
     *
     * @param object $widget Elementor widget instance.
     * @param string|false $inherit_fallback Template for inherit: default, style-3, or false to skip.
     * @return bool Whether arrow markup was rendered.
     */
    function frameflow_include_swiper_arrows($widget, $inherit_fallback = 'default')
    {
        if (!class_exists('\Elementor\Plugin')) {
            return false;
        }

        $arrows_icon_type = $widget->get_setting('arrows_icon_type', 'inherit');

        if ($arrows_icon_type === 'inherit') {
            if ($inherit_fallback === false) {
                return false;
            }
            $arrows_icon_type = $inherit_fallback;
        }

        if ($arrows_icon_type === 'custom') {
            $settings = $widget->get_settings_for_display();
            $prev_icon = isset($settings['arrows_icon_prev']) ? $settings['arrows_icon_prev'] : [];
            $next_icon = isset($settings['arrows_icon_next']) ? $settings['arrows_icon_next'] : [];

            echo '<div class="pxl-swiper-arrow pxl-swiper-arrow-prev">';
            if (!empty($prev_icon['value'])) {
                \Elementor\Icons_Manager::render_icon($prev_icon, ['aria-hidden' => 'true']);
            }
            echo '</div>';

            echo '<div class="pxl-swiper-arrow pxl-swiper-arrow-next">';
            if (!empty($next_icon['value'])) {
                \Elementor\Icons_Manager::render_icon($next_icon, ['aria-hidden' => 'true']);
            }
            echo '</div>';

            return true;
        }

        $icon_style_parts = ['style-3', 'style-4'];
        $arrow_part = in_array($arrows_icon_type, $icon_style_parts, true)
            ? 'swiper-arrows-' . $arrows_icon_type
            : 'swiper-arrows-default';

        $arrow_template_path = locate_template(
            'elements/templates/parts/' . $arrow_part . '.php',
            false,
            false
        );

        if (!$arrow_template_path) {
            return false;
        }

        include $arrow_template_path;

        return true;
    }
}
