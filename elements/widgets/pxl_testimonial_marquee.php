<?php
/**
 * Case Testimonial Marquee — Envato-style review cards.
 * Templates: elements/templates/pxl_testimonial_marquee/
 * Styles: assets/scss/elements/pxl_testimonial_marquee.scss
 * Figma: 6026:305
 */
pxl_add_custom_widget(
    [
        'name' => 'pxl_testimonial_marquee',
        'title' => esc_html__('Case Testimonial Marquee', 'frameflow'),
        'icon' => 'eicon-testimonial icon-brand-elementor',
        'categories' => ['pxltheme-core'],
        'scripts' => ['frameflow-testimonial-marquee'],
        'params' => [
            'sections' => [
                [
                    'name' => 'section_layout',
                    'label' => esc_html__('Layout', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
                    'controls' => [
                        [
                            'name' => 'layout',
                            'label' => esc_html__('Templates', 'frameflow'),
                            'type' => 'layoutcontrol',
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__('Layout 1', 'frameflow'),
                                    'image' =>
                                        get_template_directory_uri() .
                                        '/elements/widgets/img-layout/pxl_testimonial_marquee/layout1.webp',
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => [
                        [
                            'name' => 'marquee_speed',
                            'label' => esc_html__('Speed (px/s)', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 10,
                                    'max' => 400,
                                ],
                            ],
                            'default' => [
                                'size' => 80,
                                'unit' => 'px',
                            ],
                        ],
                        frameflow_widget_select_control(
                            'marquee_direction',
                            esc_html__('Direction', 'frameflow'),
                            [
                                'left' => esc_html__('Left', 'frameflow'),
                                'right' => esc_html__('Right', 'frameflow'),
                            ],
                            ['default' => 'left'],
                        ),
                        frameflow_widget_text_control(
                            'category_prefix',
                            esc_html__('Category Prefix', 'frameflow'),
                            [
                                'default' => esc_html__('for', 'frameflow'),
                            ],
                        ),
                        [
                            'name' => 'testimonials',
                            'label' => esc_html__('Testimonials', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'title_field' => '{{{ name }}}',
                            'controls' => [
                                frameflow_widget_media_control(
                                    'avatar',
                                    esc_html__('Avatar', 'frameflow'),
                                ),
                                frameflow_widget_text_control(
                                    'name',
                                    esc_html__('Name', 'frameflow'),
                                    [
                                        'default' => esc_html__('Ranksper', 'frameflow'),
                                        'label_block' => true,
                                    ],
                                ),
                                frameflow_widget_text_control(
                                    'position',
                                    esc_html__('Date', 'frameflow'),
                                    [
                                        'default' => esc_html__('6 months ago', 'frameflow'),
                                        'label_block' => true,
                                    ],
                                ),
                                frameflow_widget_text_control(
                                    'category',
                                    esc_html__('Category', 'frameflow'),
                                    [
                                        'default' => esc_html__('Customer Support', 'frameflow'),
                                        'label_block' => true,
                                    ],
                                ),
                                frameflow_widget_number_control(
                                    'star',
                                    esc_html__('Stars', 'frameflow'),
                                    [
                                        'min' => 0,
                                        'max' => 5,
                                        'step' => 1,
                                        'default' => 5,
                                    ],
                                ),
                                frameflow_widget_textarea_control(
                                    'description',
                                    esc_html__('Description', 'frameflow'),
                                    [
                                        'default' => esc_html__(
                                            "The theme is highly customizable and has great addons. but the support makes this theme even better. best support I've had with any theme.",
                                            'frameflow',
                                        ),
                                        'show_label' => true,
                                    ],
                                ),
                            ],
                            'default' => [
                                [
                                    'name' => esc_html__('Ranksper', 'frameflow'),
                                    'position' => esc_html__('6 months ago', 'frameflow'),
                                    'category' => esc_html__('Customer Support', 'frameflow'),
                                    'star' => 5,
                                    'description' => esc_html__(
                                        "The theme is highly customizable and has great addons. but the support makes this theme even better. best support I've had with any theme.",
                                        'frameflow',
                                    ),
                                ],
                                [
                                    'name' => esc_html__('Staceeandco', 'frameflow'),
                                    'position' => esc_html__('11 months ago', 'frameflow'),
                                    'category' => esc_html__('Customizability', 'frameflow'),
                                    'star' => 5,
                                    'description' => esc_html__(
                                        'Every aspect of this theme is well-made. The design, the professionalism, the many features and options, the customization, and their support are on point. I am very pleased with this theme.',
                                        'frameflow',
                                    ),
                                ],
                                [
                                    'name' => esc_html__('pw8816', 'frameflow'),
                                    'position' => esc_html__('2 months ago', 'frameflow'),
                                    'category' => esc_html__('Design Quality', 'frameflow'),
                                    'star' => 5,
                                    'description' => esc_html__(
                                        'Excellent theme! The design is sleek, responsive, and highly customizable. It runs smoothly without any bugs, making website building effortless. The developers provide great support and regular updates. Perfect for any website!',
                                        'frameflow',
                                    ),
                                ],
                                [
                                    'name' => esc_html__('Maximilianheisel', 'frameflow'),
                                    'position' => esc_html__('5 months ago', 'frameflow'),
                                    'category' => esc_html__('Customer Support', 'frameflow'),
                                    'star' => 5,
                                    'description' => esc_html__(
                                        "Just bought this theme and it's amazing! Looks great and customer support is really helpful. 5 stars well deserved!!",
                                        'frameflow',
                                    ),
                                ],
                                [
                                    'name' => esc_html__('schnacker66', 'frameflow'),
                                    'position' => esc_html__('3 week ago', 'frameflow'),
                                    'category' => esc_html__('Customizability', 'frameflow'),
                                    'star' => 5,
                                    'description' => esc_html__(
                                        'Just my opinion: this is a great, flexible theme that makes it easy and creative to create exceptionally clear designs. And: the support works wonderfully.',
                                        'frameflow',
                                    ),
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'name' => 'section_style_items',
                    'label' => esc_html__('Items', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => [
                        frameflow_widget_color_control(
                            'item_background_color',
                            esc_html__('Background Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-testimonial-marquee .pxl-item' =>
                                    'background-color: {{VALUE}};',
                            ],
                        ),
                        frameflow_widget_color_control(
                            'item_border_color',
                            esc_html__('Border Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-testimonial-marquee .pxl-item' =>
                                    'border-color: {{VALUE}};',
                            ],
                        ),
                        frameflow_widget_slider_control(
                            'item_border_radius',
                            esc_html__('Border Radius', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-testimonial-marquee .pxl-item' =>
                                    'border-radius: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        frameflow_widget_dimensions_control(
                            'item_padding',
                            esc_html__('Item Padding', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-testimonial-marquee .pxl-item--inner' =>
                                    'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                        frameflow_widget_slider_control(
                            'item_gap',
                            esc_html__('Item Gap', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-testimonial-marquee .pxl-testimonial-marquee__track' =>
                                    'gap: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        frameflow_widget_slider_control(
                            'item_width',
                            esc_html__('Item Width', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-testimonial-marquee .pxl-item' =>
                                    'width: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        frameflow_widget_slider_control(
                            'avatar_size',
                            esc_html__('Avatar Size', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-testimonial-marquee .pxl-item--avatar' =>
                                    'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; flex-basis: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                    ],
                ],
                [
                    'name' => 'section_style_name',
                    'label' => esc_html__('Name', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => [
                        frameflow_widget_color_control(
                            'name_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-testimonial-marquee .pxl-item--name' =>
                                    'color: {{VALUE}} !important;',
                            ],
                        ),
                        frameflow_widget_typography_control(
                            'name_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-testimonial-marquee .pxl-item--name',
                        ),
                        frameflow_widget_dimensions_control(
                            'name_margin',
                            esc_html__('Margin', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-testimonial-marquee .pxl-item--name' =>
                                    'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                    ],
                ],
                [
                    'name' => 'section_style_position',
                    'label' => esc_html__('Date', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => [
                        frameflow_widget_color_control(
                            'position_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-testimonial-marquee .pxl-item--position' =>
                                    'color: {{VALUE}} !important;',
                            ],
                        ),
                        frameflow_widget_typography_control(
                            'position_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-testimonial-marquee .pxl-item--position',
                        ),
                        frameflow_widget_dimensions_control(
                            'position_margin',
                            esc_html__('Margin', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-testimonial-marquee .pxl-item--position' =>
                                    'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                    ],
                ],
                [
                    'name' => 'section_style_category',
                    'label' => esc_html__('Category', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => [
                        frameflow_widget_color_control(
                            'category_prefix_color',
                            esc_html__('Prefix Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-testimonial-marquee .pxl-item--category-prefix' =>
                                    'color: {{VALUE}} !important;',
                            ],
                        ),
                        frameflow_widget_color_control(
                            'category_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-testimonial-marquee .pxl-item--category-name' =>
                                    'color: {{VALUE}} !important;',
                            ],
                        ),
                        frameflow_widget_typography_control(
                            'category_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-testimonial-marquee .pxl-item--category',
                        ),
                        frameflow_widget_dimensions_control(
                            'category_margin',
                            esc_html__('Margin', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-testimonial-marquee .pxl-item--category' =>
                                    'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                    ],
                ],
                [
                    'name' => 'section_style_description',
                    'label' => esc_html__('Description', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => [
                        frameflow_widget_color_control(
                            'description_color',
                            esc_html__('Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-testimonial-marquee .pxl-item--description' =>
                                    'color: {{VALUE}} !important;',
                            ],
                        ),
                        frameflow_widget_typography_control(
                            'description_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-testimonial-marquee .pxl-item--description',
                        ),
                        frameflow_widget_slider_control(
                            'description_max_width',
                            esc_html__('Max Width', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-testimonial-marquee .pxl-item--description' =>
                                    'max-width: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        frameflow_widget_dimensions_control(
                            'description_margin',
                            esc_html__('Margin', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-testimonial-marquee .pxl-item--description' =>
                                    'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
