<?php
if (class_exists('WPCF7')) {
    $cf7 = get_posts('post_type="wpcf7_contact_form"&numberposts=-1');

    $contact_forms = array();
    if ($cf7) {
        foreach ($cf7 as $cform) {
            $contact_forms[$cform->ID] = $cform->post_title;
        }
    } else {
        $contact_forms[esc_html__('No contact forms found', 'frameflow')] = 0;
    }

    // Text-like CF7 inputs only (excludes acceptance/checkbox/radio/submit/file/textarea/select).
    $cf7_input_sel = '{{WRAPPER}} .pxl-contact-form input.wpcf7-form-control:not([type="checkbox"]):not([type="radio"]):not([type="submit"]):not([type="file"])';
    $cf7_input_hfc = $cf7_input_sel . ':hover, ' . $cf7_input_sel . ':focus';
    $cf7_input_hfca = $cf7_input_hfc . ', ' . $cf7_input_sel . ':active';
    $cf7_input_ph = $cf7_input_sel . '::placeholder, ' . $cf7_input_sel . '::-webkit-input-placeholder, ' . $cf7_input_sel . ':-ms-input-placeholder';

    pxl_add_custom_widget(
        array(
            'name' => 'pxl_contact_form',
            'title' => esc_html__('Case Contact Form', 'frameflow'),
            'icon' => 'eicon-atomic-form',
            'categories' => array('pxltheme-core'),
            'params' => array(
                'sections' => array(

                    // ── CONTENT ──────────────────────────────────────────────
                    array(
                        'name'     => 'tab_content',
                        'label'    => esc_html__('Content', 'frameflow'),
                        'tab'      => \Elementor\Controls_Manager::TAB_CONTENT,
                        'controls' => array(
                            frameflow_widget_select_control(
                                'form_id',
                                esc_html__('Select Form', 'frameflow'),
                                $contact_forms
                            ),
                        ),
                    ),

                    // ── STYLE: INPUT ──────────────────────────────────────────
                    array(
                        'name'     => 'tab_style_input',
                        'label'    => esc_html__('Input', 'frameflow'),
                        'tab'      => \Elementor\Controls_Manager::TAB_STYLE,
                        'controls' => array(
                            frameflow_widget_typography_control(
                                'input_typography',
                                esc_html__('Typography', 'frameflow'),
                                $cf7_input_sel
                            ),
                            array(
                                'name'         => 'input_height',
                                'label'        => esc_html__('Height', 'frameflow'),
                                'type'         => \Elementor\Controls_Manager::SLIDER,
                                'control_type' => 'responsive',
                                'size_units'   => ['px'],
                                'range'        => [
                                    'px' => ['min' => 0, 'max' => 300],
                                ],
                                'selectors'    => [
                                    $cf7_input_sel => 'height: {{SIZE}}{{UNIT}};',
                                ],
                            ),
                            array(
                                'name'         => 'input_padding',
                                'label'        => esc_html__('Padding', 'frameflow'),
                                'type'         => \Elementor\Controls_Manager::DIMENSIONS,
                                'size_units'   => ['px'],
                                'selectors'    => [
                                    $cf7_input_sel => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                                'control_type' => 'responsive',
                            ),
                            array(
                                'name'         => 'input_border_radius',
                                'label'        => esc_html__('Border Radius', 'frameflow'),
                                'type'         => \Elementor\Controls_Manager::DIMENSIONS,
                                'size_units'   => ['px'],
                                'selectors'    => [
                                    $cf7_input_sel => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                                'control_type' => 'responsive',
                            ),
                            array(
                                'name'         => 'input_box_shadow',
                                'label'        => esc_html__('Box Shadow', 'frameflow'),
                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                'control_type' => 'group',
                                'selector'     => $cf7_input_sel,
                            ),
                            array(
                                'name'         => 'input_width',
                                'label'        => esc_html__('Width', 'frameflow'),
                                'type'         => \Elementor\Controls_Manager::SLIDER,
                                'control_type' => 'responsive',
                                'size_units'   => ['px', '%'],
                                'range'        => [
                                    'px' => ['min' => 0, 'max' => 1200],
                                    '%'  => ['min' => 0, 'max' => 100],
                                ],
                                'selectors'    => [
                                    $cf7_input_sel => 'width: {{SIZE}}{{UNIT}};',
                                ],
                            ),
                            frameflow_widget_select_control(
                                'input_text_align',
                                esc_html__('Text Align', 'frameflow'),
                                [
                                    'left'   => esc_html__('Left', 'frameflow'),
                                    'center' => esc_html__('Center', 'frameflow'),
                                    'right'  => esc_html__('Right', 'frameflow'),
                                ],
                                [
                                    'selectors' => [
                                        $cf7_input_sel => 'text-align: {{VALUE}};',
                                    ],
                                ]
                            ),
                            array(
                                'name' => 'input_style_tabs',
                                'control_type' => 'tab',
                                'tabs' => [
                                    [
                                        'name' => 'tab_input_normal',
                                        'label' => esc_html__('Normal', 'frameflow'),
                                        'controls' => [
                                            frameflow_widget_color_control(
                                                'input_color',
                                                esc_html__('Color', 'frameflow'),
                                                [
                                                    $cf7_input_sel => 'color: {{VALUE}};',
                                                ]
                                            ),
                                            array(
                                                'name'         => 'input_background',
                                                'label'        => esc_html__('Background', 'frameflow'),
                                                'type'         => \Elementor\Group_Control_Background::get_type(),
                                                'control_type' => 'group',
                                                'types'        => ['classic', 'gradient'],
                                                'selector'     => $cf7_input_sel,
                                            ),
                                            frameflow_widget_select_control(
                                                'border_type',
                                                esc_html__('Border Type', 'frameflow'),
                                                [
                                                    ''        => esc_html__('None', 'frameflow'),
                                                    'solid'   => esc_html__('Solid', 'frameflow'),
                                                    'double'  => esc_html__('Double', 'frameflow'),
                                                    'dotted'  => esc_html__('Dotted', 'frameflow'),
                                                    'dashed'  => esc_html__('Dashed', 'frameflow'),
                                                    'groove'  => esc_html__('Groove', 'frameflow'),
                                                ],
                                                [
                                                    'selectors' => [
                                                        $cf7_input_sel => 'border-style: {{VALUE}};',
                                                    ],
                                                ]
                                            ),
                                            array(
                                                'name'      => 'border_width',
                                                'label'     => esc_html__('Border Width', 'frameflow'),
                                                'type'      => \Elementor\Controls_Manager::DIMENSIONS,
                                                'selectors' => [
                                                    $cf7_input_sel => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                                                ],
                                                'condition' => ['border_type!' => ''],
                                                'responsive' => true,
                                            ),
                                            frameflow_widget_color_control(
                                                'border_color',
                                                esc_html__('Border Color', 'frameflow'),
                                                [
                                                    $cf7_input_sel => 'border-color: {{VALUE}};',
                                                ],
                                                ['condition' => ['border_type!' => '']]
                                            ),
                                        ],
                                    ],
                                    [
                                        'name' => 'tab_input_hover',
                                        'label' => esc_html__('Hover', 'frameflow'),
                                        'controls' => [
                                            frameflow_widget_color_control(
                                                'input_color_hover',
                                                esc_html__('Color', 'frameflow'),
                                                [
                                                    $cf7_input_sel . ':hover'  => 'color: {{VALUE}};',
                                                    $cf7_input_sel . ':focus'  => 'color: {{VALUE}};',
                                                    $cf7_input_sel . ':active' => 'color: {{VALUE}};',
                                                ]
                                            ),
                                            array(
                                                'name'         => 'input_background_hover',
                                                'label'        => esc_html__('Background', 'frameflow'),
                                                'type'         => \Elementor\Group_Control_Background::get_type(),
                                                'control_type' => 'group',
                                                'types'        => ['classic', 'gradient'],
                                                'selector'     => $cf7_input_hfca,
                                            ),
                                            array(
                                                'name'         => 'input_box_shadow_hover',
                                                'label'        => esc_html__('Box Shadow', 'frameflow'),
                                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                                'control_type' => 'group',
                                                'selector'     => $cf7_input_hfc,
                                            ),
                                            frameflow_widget_select_control(
                                                'border_type_hover',
                                                esc_html__('Border Type', 'frameflow'),
                                                [
                                                    ''        => esc_html__('None', 'frameflow'),
                                                    'solid'   => esc_html__('Solid', 'frameflow'),
                                                    'double'  => esc_html__('Double', 'frameflow'),
                                                    'dotted'  => esc_html__('Dotted', 'frameflow'),
                                                    'dashed'  => esc_html__('Dashed', 'frameflow'),
                                                    'groove'  => esc_html__('Groove', 'frameflow'),
                                                ],
                                                [
                                                    'selectors' => [
                                                        $cf7_input_hfc => 'border-style: {{VALUE}} !important;',
                                                    ],
                                                ]
                                            ),
                                            array(
                                                'name'      => 'border_width_hover',
                                                'label'     => esc_html__('Border Width', 'frameflow'),
                                                'type'      => \Elementor\Controls_Manager::DIMENSIONS,
                                                'selectors' => [
                                                    $cf7_input_hfc => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                                                ],
                                                'condition'  => ['border_type_hover!' => ''],
                                                'responsive' => true,
                                            ),
                                            frameflow_widget_color_control(
                                                'border_color_hover',
                                                esc_html__('Border Color', 'frameflow'),
                                                [
                                                    $cf7_input_hfc => 'border-color: {{VALUE}};',
                                                ],
                                                ['condition' => ['border_type_hover!' => '']]
                                            ),
                                            frameflow_widget_color_control(
                                                'border_color_hv',
                                                esc_html__('Border Color Focus', 'frameflow'),
                                                [
                                                    $cf7_input_hfca => 'border-color: {{VALUE}};',
                                                ],
                                                ['condition' => ['border_type!' => '']]
                                            ),
                                        ],
                                    ],
                                ],
                            ),
                            frameflow_widget_dimensions_control(
                                'input_margin',
                                esc_html__('Margin', 'frameflow'),
                                [
                                    $cf7_input_sel => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                                ['size_units' => ['px']]
                            ),
                            // Spacer group
                            array(
                                'name'         => 'input_spacer_top',
                                'label'        => esc_html__('Spacer Top', 'frameflow'),
                                'type'         => \Elementor\Controls_Manager::SLIDER,
                                'control_type' => 'responsive',
                                'size_units'   => ['px'],
                                'range'        => ['px' => ['min' => 0, 'max' => 3000]],
                                'selectors'    => [
                                    '{{WRAPPER}} .pxl-contact-form .wpcf7-form-control-wrap' => 'margin-top: {{SIZE}}{{UNIT}};',
                                ],
                            ),
                            array(
                                'name'         => 'input_spacer_bottom',
                                'label'        => esc_html__('Spacer Bottom', 'frameflow'),
                                'type'         => \Elementor\Controls_Manager::SLIDER,
                                'control_type' => 'responsive',
                                'size_units'   => ['px'],
                                'range'        => ['px' => ['min' => 0, 'max' => 3000]],
                                'selectors'    => [
                                    '{{WRAPPER}} .pxl-contact-form .wpcf7-form-control-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                                ],
                            ),
                            array(
                                'name'         => 'input_spacer_left',
                                'label'        => esc_html__('Spacer Left', 'frameflow'),
                                'type'         => \Elementor\Controls_Manager::SLIDER,
                                'control_type' => 'responsive',
                                'size_units'   => ['px'],
                                'range'        => ['px' => ['min' => 0, 'max' => 3000]],
                                'selectors'    => [
                                    '{{WRAPPER}} .pxl-contact-form .row [class*="col-"]' => 'padding-left: {{SIZE}}{{UNIT}};',
                                    '{{WRAPPER}} .pxl-contact-form .row'                 => 'margin-left: -{{SIZE}}{{UNIT}};',
                                ],
                            ),
                            array(
                                'name'         => 'input_spacer_right',
                                'label'        => esc_html__('Spacer Right', 'frameflow'),
                                'type'         => \Elementor\Controls_Manager::SLIDER,
                                'control_type' => 'responsive',
                                'size_units'   => ['px'],
                                'range'        => ['px' => ['min' => 0, 'max' => 3000]],
                                'selectors'    => [
                                    '{{WRAPPER}} .pxl-contact-form .row [class*="col-"]' => 'padding-right: {{SIZE}}{{UNIT}};',
                                    '{{WRAPPER}} .pxl-contact-form .row'                 => 'margin-right: -{{SIZE}}{{UNIT}};',
                                ],
                            ),
                        ),
                    ),

                    // ── STYLE: PLACEHOLDER ────────────────────────────────────
                    array(
                        'name'     => 'tab_style_placeholder',
                        'label'    => esc_html__('Placeholder', 'frameflow'),
                        'tab'      => \Elementor\Controls_Manager::TAB_STYLE,
                        'controls' => array(
                            frameflow_widget_typography_control(
                                'placeholder_typography',
                                esc_html__('Typography', 'frameflow'),
                                $cf7_input_ph
                            ),
                            array(
                                'name' => 'placeholder_style_tabs',
                                'control_type' => 'tab',
                                'tabs' => [
                                    [
                                        'name' => 'tab_placeholder_normal',
                                        'label' => esc_html__('Normal', 'frameflow'),
                                        'controls' => [
                                            frameflow_widget_color_control(
                                                'placeholder_color',
                                                esc_html__('Color', 'frameflow'),
                                                [
                                                    $cf7_input_sel . '::placeholder'               => 'color: {{VALUE}};',
                                                    $cf7_input_sel . '::-webkit-input-placeholder' => 'color: {{VALUE}};',
                                                    $cf7_input_sel . ':-ms-input-placeholder'      => 'color: {{VALUE}};',
                                                ]
                                            ),
                                        ],
                                    ],
                                    [
                                        'name' => 'tab_placeholder_focus',
                                        'label' => esc_html__('Focus', 'frameflow'),
                                        'controls' => [
                                            frameflow_widget_color_control(
                                                'placeholder_color_focus',
                                                esc_html__('Color', 'frameflow'),
                                                [
                                                    $cf7_input_sel . ':focus::placeholder'               => 'color: {{VALUE}};',
                                                    $cf7_input_sel . ':focus::-webkit-input-placeholder' => 'color: {{VALUE}};',
                                                    $cf7_input_sel . ':focus:-ms-input-placeholder'      => 'color: {{VALUE}};',
                                                ]
                                            ),
                                        ],
                                    ],
                                ],
                            ),
                        ),
                    ),

                    // ── STYLE: TEXTAREA ───────────────────────────────────────
                    array(
                        'name'     => 'tab_style_textarea',
                        'label'    => esc_html__('Textarea', 'frameflow'),
                        'tab'      => \Elementor\Controls_Manager::TAB_STYLE,
                        'controls' => array(
                            frameflow_widget_typography_control(
                                'textarea_typography',
                                esc_html__('Typography', 'frameflow'),
                                '{{WRAPPER}} .pxl-contact-form .wpcf7-form-control.wpcf7-textarea'
                            ),
                            array(
                                'name'         => 'textarea_height',
                                'label'        => esc_html__('Height', 'frameflow'),
                                'type'         => \Elementor\Controls_Manager::SLIDER,
                                'control_type' => 'responsive',
                                'size_units'   => ['px'],
                                'range'        => ['px' => ['min' => 0, 'max' => 3000]],
                                'selectors'    => [
                                    '{{WRAPPER}} .pxl-contact-form .wpcf7-form-control.wpcf7-textarea' => 'height: {{SIZE}}{{UNIT}};',
                                ],
                            ),
                            array(
                                'name'         => 'textarea_padding',
                                'label'        => esc_html__('Padding', 'frameflow'),
                                'type'         => \Elementor\Controls_Manager::DIMENSIONS,
                                'size_units'   => ['px'],
                                'selectors'    => [
                                    '{{WRAPPER}} .pxl-contact-form .wpcf7-form-control.wpcf7-textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                                'control_type' => 'responsive',
                            ),
                            array(
                                'name'         => 'textarea_border_radius',
                                'label'        => esc_html__('Border Radius', 'frameflow'),
                                'type'         => \Elementor\Controls_Manager::DIMENSIONS,
                                'size_units'   => ['px'],
                                'selectors'    => [
                                    '{{WRAPPER}} .pxl-contact-form .wpcf7-form-control.wpcf7-textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                                'control_type' => 'responsive',
                            ),
                            array(
                                'name'         => 'textarea_box_shadow',
                                'label'        => esc_html__('Box Shadow', 'frameflow'),
                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                'control_type' => 'group',
                                'selector'     => '{{WRAPPER}} .pxl-contact-form .wpcf7-form-control.wpcf7-textarea',
                            ),
                            array(
                                'name' => 'textarea_style_tabs',
                                'control_type' => 'tab',
                                'tabs' => [
                                    [
                                        'name' => 'tab_textarea_normal',
                                        'label' => esc_html__('Normal', 'frameflow'),
                                        'controls' => [
                                            frameflow_widget_color_control(
                                                'textarea_color',
                                                esc_html__('Color', 'frameflow'),
                                                [
                                                    '{{WRAPPER}} .pxl-contact-form .wpcf7-form-control.wpcf7-textarea' => 'color: {{VALUE}};',
                                                ]
                                            ),
                                            array(
                                                'name'         => 'textarea_background',
                                                'label'        => esc_html__('Background', 'frameflow'),
                                                'type'         => \Elementor\Group_Control_Background::get_type(),
                                                'control_type' => 'group',
                                                'types'        => ['classic', 'gradient'],
                                                'selector'     => '{{WRAPPER}} .pxl-contact-form .wpcf7-form-control.wpcf7-textarea',
                                            ),
                                            frameflow_widget_select_control(
                                                'textarea_border_type',
                                                esc_html__('Border Type', 'frameflow'),
                                                [
                                                    ''        => esc_html__('None', 'frameflow'),
                                                    'solid'   => esc_html__('Solid', 'frameflow'),
                                                    'double'  => esc_html__('Double', 'frameflow'),
                                                    'dotted'  => esc_html__('Dotted', 'frameflow'),
                                                    'dashed'  => esc_html__('Dashed', 'frameflow'),
                                                    'groove'  => esc_html__('Groove', 'frameflow'),
                                                ],
                                                [
                                                    'selectors' => [
                                                        '{{WRAPPER}} .pxl-contact-form .wpcf7-form-control.wpcf7-textarea' => 'border-style: {{VALUE}} !important;',
                                                    ],
                                                ]
                                            ),
                                            array(
                                                'name'      => 'textarea_border_width',
                                                'label'     => esc_html__('Border Width', 'frameflow'),
                                                'type'      => \Elementor\Controls_Manager::DIMENSIONS,
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-contact-form .wpcf7-form-control.wpcf7-textarea' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                                                ],
                                                'condition' => ['textarea_border_type!' => ''],
                                                'responsive' => true,
                                            ),
                                            frameflow_widget_color_control(
                                                'textarea_border_color',
                                                esc_html__('Border Color', 'frameflow'),
                                                [
                                                    '{{WRAPPER}} .pxl-contact-form .wpcf7-form-control.wpcf7-textarea' => 'border-color: {{VALUE}};',
                                                ],
                                                ['condition' => ['textarea_border_type!' => '']]
                                            ),
                                        ],
                                    ],
                                    [
                                        'name' => 'tab_textarea_hover',
                                        'label' => esc_html__('Hover', 'frameflow'),
                                        'controls' => [
                                            array(
                                                'name'         => 'textarea_background_hover',
                                                'label'        => esc_html__('Background', 'frameflow'),
                                                'type'         => \Elementor\Group_Control_Background::get_type(),
                                                'control_type' => 'group',
                                                'types'        => ['classic', 'gradient'],
                                                'selector'     => '{{WRAPPER}} .pxl-contact-form .wpcf7-form-control.wpcf7-textarea:hover, {{WRAPPER}} .pxl-contact-form .wpcf7-form-control.wpcf7-textarea:focus, {{WRAPPER}} .pxl-contact-form .wpcf7-form-control.wpcf7-textarea:active',
                                            ),
                                            frameflow_widget_color_control(
                                                'textarea_border_color_focus',
                                                esc_html__('Border Color', 'frameflow'),
                                                [
                                                    '{{WRAPPER}} .pxl-contact-form .wpcf7-form-control.wpcf7-textarea:hover,{{WRAPPER}} .pxl-contact-form .wpcf7-form-control.wpcf7-textarea:focus,{{WRAPPER}} .pxl-contact-form .wpcf7-form-control.wpcf7-textarea:active' => 'border-color: {{VALUE}};',
                                                ],
                                                ['condition' => ['textarea_border_type!' => '']]
                                            ),
                                        ],
                                    ],
                                ],
                            ),
                            frameflow_widget_dimensions_control(
                                'textarea_margin',
                                esc_html__('Margin', 'frameflow'),
                                [
                                    '{{WRAPPER}} .pxl-contact-form .wpcf7-form-control.wpcf7-textarea' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                                ['size_units' => ['px']]
                            ),
                            // Textarea placeholder
                            frameflow_widget_color_control(
                                'textarea_placeholder_color',
                                esc_html__('Placeholder Color', 'frameflow'),
                                [
                                    '{{WRAPPER}} .pxl-contact-form .wpcf7-form-control.wpcf7-textarea::placeholder'               => 'color: {{VALUE}};',
                                    '{{WRAPPER}} .pxl-contact-form .wpcf7-form-control.wpcf7-textarea::-webkit-input-placeholder' => 'color: {{VALUE}};',
                                ]
                            ),
                        ),
                    ),

                    // ── STYLE: SELECT (DROPDOWN) ──────────────────────────────
                    array(
                        'name'     => 'tab_style_select',
                        'label'    => esc_html__('Select', 'frameflow'),
                        'tab'      => \Elementor\Controls_Manager::TAB_STYLE,
                        'controls' => array(
                            frameflow_widget_typography_control(
                                'select_typography',
                                esc_html__('Typography', 'frameflow'),
                                '{{WRAPPER}} .pxl-contact-form .pxl-select-higthlight'
                            ),
                            array(
                                'name'         => 'select_height',
                                'label'        => esc_html__('Height', 'frameflow'),
                                'type'         => \Elementor\Controls_Manager::SLIDER,
                                'control_type' => 'responsive',
                                'size_units'   => ['px'],
                                'range'        => ['px' => ['min' => 0, 'max' => 300]],
                                'selectors'    => [
                                    '{{WRAPPER}} .pxl-contact-form .pxl-select-higthlight' => 'height: {{SIZE}}{{UNIT}};',
                                ],
                            ),
                            array(
                                'name'         => 'select_padding',
                                'label'        => esc_html__('Padding', 'frameflow'),
                                'type'         => \Elementor\Controls_Manager::DIMENSIONS,
                                'size_units'   => ['px'],
                                'selectors'    => [
                                    '{{WRAPPER}} .pxl-contact-form .pxl-select-higthlight' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                                'control_type' => 'responsive',
                            ),
                            array(
                                'name'         => 'select_border_radius',
                                'label'        => esc_html__('Border Radius', 'frameflow'),
                                'type'         => \Elementor\Controls_Manager::DIMENSIONS,
                                'size_units'   => ['px'],
                                'selectors'    => [
                                    '{{WRAPPER}} .pxl-contact-form .pxl-select-higthlight' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                                'control_type' => 'responsive',
                            ),
                            array(
                                'name'         => 'select_box_shadow',
                                'label'        => esc_html__('Box Shadow', 'frameflow'),
                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                'control_type' => 'group',
                                'selector'     => '{{WRAPPER}} .pxl-contact-form .pxl-select-higthlight',
                            ),
                            array(
                                'name' => 'select_style_tabs',
                                'control_type' => 'tab',
                                'tabs' => [
                                    [
                                        'name' => 'tab_select_normal',
                                        'label' => esc_html__('Normal', 'frameflow'),
                                        'controls' => [
                                            frameflow_widget_color_control(
                                                'select_color',
                                                esc_html__('Color', 'frameflow'),
                                                [
                                                    '{{WRAPPER}} .pxl-contact-form .pxl-select-higthlight,{{WRAPPER}} .pxl-contact-form .pxl-select-higthlight:before' => 'color: {{VALUE}};',
                                                ]
                                            ),
                                            array(
                                                'name'         => 'select_background',
                                                'label'        => esc_html__('Background', 'frameflow'),
                                                'type'         => \Elementor\Group_Control_Background::get_type(),
                                                'control_type' => 'group',
                                                'types'        => ['classic', 'gradient'],
                                                'selector'     => '{{WRAPPER}} .pxl-contact-form .pxl-select-higthlight',
                                            ),
                                            frameflow_widget_select_control(
                                                'select_border_type',
                                                esc_html__('Border Type', 'frameflow'),
                                                [
                                                    ''        => esc_html__('None', 'frameflow'),
                                                    'solid'   => esc_html__('Solid', 'frameflow'),
                                                    'double'  => esc_html__('Double', 'frameflow'),
                                                    'dotted'  => esc_html__('Dotted', 'frameflow'),
                                                    'dashed'  => esc_html__('Dashed', 'frameflow'),
                                                    'groove'  => esc_html__('Groove', 'frameflow'),
                                                ],
                                                [
                                                    'selectors' => [
                                                        '{{WRAPPER}} .pxl-contact-form .pxl-select-higthlight' => 'border-style: {{VALUE}} !important;',
                                                    ],
                                                ]
                                            ),
                                            array(
                                                'name'      => 'select_border_width',
                                                'label'     => esc_html__('Border Width', 'frameflow'),
                                                'type'      => \Elementor\Controls_Manager::DIMENSIONS,
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-contact-form .pxl-select-higthlight' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                                                ],
                                                'condition' => ['select_border_type!' => ''],
                                                'responsive' => true,
                                            ),
                                            frameflow_widget_color_control(
                                                'select_border_color',
                                                esc_html__('Border Color', 'frameflow'),
                                                [
                                                    '{{WRAPPER}} .pxl-contact-form .pxl-select-higthlight' => 'border-color: {{VALUE}};',
                                                ],
                                                ['condition' => ['select_border_type!' => '']]
                                            ),
                                        ],
                                    ],
                                    [
                                        'name' => 'tab_select_hover',
                                        'label' => esc_html__('Hover', 'frameflow'),
                                        'controls' => [
                                            frameflow_widget_color_control(
                                                'select_color_hover',
                                                esc_html__('Color', 'frameflow'),
                                                [
                                                    '{{WRAPPER}} .pxl-contact-form .pxl-select-higthlight:hover,{{WRAPPER}} .pxl-contact-form .pxl-select-higthlight:hover:before,{{WRAPPER}} .pxl-contact-form .pxl-select-higthlight.active' => 'color: {{VALUE}};',
                                                ]
                                            ),
                                            array(
                                                'name'         => 'select_background_hover',
                                                'label'        => esc_html__('Background', 'frameflow'),
                                                'type'         => \Elementor\Group_Control_Background::get_type(),
                                                'control_type' => 'group',
                                                'types'        => ['classic', 'gradient'],
                                                'selector'     => '{{WRAPPER}} .pxl-contact-form .pxl-select-higthlight:hover, {{WRAPPER}} .pxl-contact-form .pxl-select-higthlight.active',
                                            ),
                                            frameflow_widget_color_control(
                                                'select_border_color_focus',
                                                esc_html__('Border Color', 'frameflow'),
                                                [
                                                    '{{WRAPPER}} .pxl-contact-form .pxl-select-higthlight:hover,{{WRAPPER}} .pxl-contact-form .pxl-select-higthlight:focus' => 'border-color: {{VALUE}};',
                                                ],
                                                ['condition' => ['select_border_type!' => '']]
                                            ),
                                            frameflow_widget_color_control(
                                                'select_border_color_hover',
                                                esc_html__('Border Color Active', 'frameflow'),
                                                [
                                                    '{{WRAPPER}} .pxl-contact-form .pxl-select-higthlight:hover,{{WRAPPER}} .pxl-contact-form .pxl-select-higthlight.active' => 'border-color: {{VALUE}} !important;',
                                                ],
                                                ['condition' => ['select_border_type!' => '']]
                                            ),
                                        ],
                                    ],
                                ],
                            ),

                            // ── Dropdown Options (.pxl-select-options) ──────────
                            array(
                                'name'      => 'heading_select_options',
                                'label'     => esc_html__('Dropdown Options', 'frameflow'),
                                'type'      => \Elementor\Controls_Manager::HEADING,
                                'separator' => 'before',
                            ),
                            frameflow_widget_typography_control(
                                'select_options_typography',
                                esc_html__('Typography', 'frameflow'),
                                '{{WRAPPER}} .pxl-contact-form .pxl-select-options li'
                            ),
                            array(
                                'name' => 'select_options_style_tabs',
                                'control_type' => 'tab',
                                'tabs' => [
                                    [
                                        'name' => 'tab_select_options_normal',
                                        'label' => esc_html__('Normal', 'frameflow'),
                                        'controls' => [
                                            frameflow_widget_color_control(
                                                'select_options_color',
                                                esc_html__('Color', 'frameflow'),
                                                [
                                                    '{{WRAPPER}} .pxl-contact-form .pxl-select-options li' => 'color: {{VALUE}};',
                                                ]
                                            ),
                                            array(
                                                'name'         => 'select_options_bg',
                                                'label'        => esc_html__('List Background', 'frameflow'),
                                                'type'         => \Elementor\Group_Control_Background::get_type(),
                                                'control_type' => 'group',
                                                'types'        => ['classic', 'gradient'],
                                                'selector'     => '{{WRAPPER}} .pxl-contact-form .pxl-select-options',
                                            ),
                                        ],
                                    ],
                                    [
                                        'name' => 'tab_select_options_hover',
                                        'label' => esc_html__('Hover', 'frameflow'),
                                        'controls' => [
                                            frameflow_widget_color_control(
                                                'select_options_color_hover',
                                                esc_html__('Color', 'frameflow'),
                                                [
                                                    '{{WRAPPER}} .pxl-contact-form .pxl-select-options li:hover, {{WRAPPER}} .pxl-contact-form .pxl-select-options li.active' => 'color: {{VALUE}};',
                                                ]
                                            ),
                                            frameflow_widget_color_control(
                                                'select_options_item_bg_hover',
                                                esc_html__('Item Background', 'frameflow'),
                                                [
                                                    '{{WRAPPER}} .pxl-contact-form .pxl-select-options li:hover, {{WRAPPER}} .pxl-contact-form .pxl-select-options li.active' => 'background-color: {{VALUE}};',
                                                ]
                                            ),
                                        ],
                                    ],
                                ],
                            ),
                            array(
                                'name'         => 'select_options_padding',
                                'label'        => esc_html__('List Padding', 'frameflow'),
                                'type'         => \Elementor\Controls_Manager::DIMENSIONS,
                                'size_units'   => ['px'],
                                'selectors'    => [
                                    '{{WRAPPER}} .pxl-contact-form .pxl-select-options' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                                'control_type' => 'responsive',
                            ),
                            array(
                                'name'         => 'select_options_item_padding',
                                'label'        => esc_html__('Item Padding', 'frameflow'),
                                'type'         => \Elementor\Controls_Manager::DIMENSIONS,
                                'size_units'   => ['px'],
                                'selectors'    => [
                                    '{{WRAPPER}} .pxl-contact-form .pxl-select-options li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                                'control_type' => 'responsive',
                            ),
                            array(
                                'name'         => 'select_options_border_radius',
                                'label'        => esc_html__('Border Radius', 'frameflow'),
                                'type'         => \Elementor\Controls_Manager::DIMENSIONS,
                                'size_units'   => ['px'],
                                'selectors'    => [
                                    '{{WRAPPER}} .pxl-contact-form .pxl-select-options' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                                'control_type' => 'responsive',
                            ),
                            array(
                                'name'         => 'select_options_box_shadow',
                                'label'        => esc_html__('Box Shadow', 'frameflow'),
                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                'control_type' => 'group',
                                'selector'     => '{{WRAPPER}} .pxl-contact-form .pxl-select-options',
                            ),
                            frameflow_widget_select_control(
                                'select_options_border_type',
                                esc_html__('Border Type', 'frameflow'),
                                [
                                    ''        => esc_html__('None', 'frameflow'),
                                    'solid'   => esc_html__('Solid', 'frameflow'),
                                    'double'  => esc_html__('Double', 'frameflow'),
                                    'dotted'  => esc_html__('Dotted', 'frameflow'),
                                    'dashed'  => esc_html__('Dashed', 'frameflow'),
                                    'groove'  => esc_html__('Groove', 'frameflow'),
                                ],
                                [
                                    'selectors' => [
                                        '{{WRAPPER}} .pxl-contact-form .pxl-select-options' => 'border-style: {{VALUE}} !important;',
                                    ],
                                ]
                            ),
                            array(
                                'name'      => 'select_options_border_width',
                                'label'     => esc_html__('Border Width', 'frameflow'),
                                'type'      => \Elementor\Controls_Manager::DIMENSIONS,
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-contact-form .pxl-select-options' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                                ],
                                'condition' => ['select_options_border_type!' => ''],
                                'responsive' => true,
                            ),
                            frameflow_widget_color_control(
                                'select_options_border_color',
                                esc_html__('Border Color', 'frameflow'),
                                [
                                    '{{WRAPPER}} .pxl-contact-form .pxl-select-options' => 'border-color: {{VALUE}} !important;',
                                ],
                                ['condition' => ['select_options_border_type!' => '']]
                            ),
                        ),
                    ),

                    // ── STYLE: BUTTON ─────────────────────────────────────────
                    array(
                        'name'     => 'tab_style_button',
                        'label'    => esc_html__('Button', 'frameflow'),
                        'tab'      => \Elementor\Controls_Manager::TAB_STYLE,
                        'controls' => array_merge(
                            array(
                                frameflow_widget_typography_control(
                                    'button_typography',
                                    esc_html__('Button Typography', 'frameflow'),
                                    '{{WRAPPER}} .pxl-contact-form .wpcf7-submit, {{WRAPPER}} .pxl-contact-form button'
                                ),
                                array(
                                    'name' => 'button_style_tabs',
                                    'control_type' => 'tab',
                                    'tabs' => [
                                        [
                                            'name' => 'tab_button_normal',
                                            'label' => esc_html__('Normal', 'frameflow'),
                                            'controls' => [
                                                frameflow_widget_color_control(
                                                    'button_color',
                                                    esc_html__('Color', 'frameflow'),
                                                    [
                                                        '{{WRAPPER}} .pxl-contact-form .wpcf7-submit, {{WRAPPER}} .pxl-contact-form button' => 'color: {{VALUE}};',
                                                    ]
                                                ),
                                                frameflow_widget_color_control(
                                                    'button_icon_color',
                                                    esc_html__('Icon Color', 'frameflow'),
                                                    [
                                                        '{{WRAPPER}} .pxl-contact-form .wpcf7-submit i, {{WRAPPER}} .pxl-contact-form button i'             => 'color: {{VALUE}};',
                                                        '{{WRAPPER}} .pxl-contact-form .wpcf7-submit svg path, {{WRAPPER}} .pxl-contact-form button svg path' => 'fill: {{VALUE}};',
                                                    ]
                                                ),
                                                frameflow_widget_color_control(
                                                    'button_bg_color',
                                                    esc_html__('Background Color', 'frameflow'),
                                                    [
                                                        '{{WRAPPER}} .pxl-contact-form .wpcf7-submit, {{WRAPPER}} .pxl-contact-form button' => 'background-color: {{VALUE}};',
                                                    ]
                                                ),
                                            ],
                                        ],
                                        [
                                            'name' => 'tab_button_hover',
                                            'label' => esc_html__('Hover', 'frameflow'),
                                            'controls' => [
                                                frameflow_widget_color_control(
                                                    'button_color_hover',
                                                    esc_html__('Color', 'frameflow'),
                                                    [
                                                        '{{WRAPPER}} .pxl-contact-form .wpcf7-submit:hover, {{WRAPPER}} .pxl-contact-form button:hover, {{WRAPPER}} .pxl-contact-form .wpcf7-submit:focus, {{WRAPPER}} .pxl-contact-form button:focus' => 'color: {{VALUE}};',
                                                    ]
                                                ),
                                                frameflow_widget_color_control(
                                                    'button_icon_color_hover',
                                                    esc_html__('Icon Color', 'frameflow'),
                                                    [
                                                        '{{WRAPPER}} .pxl-contact-form .wpcf7-submit:hover i, {{WRAPPER}} .pxl-contact-form .wpcf7-submit:focus i'         => 'color: {{VALUE}};',
                                                        '{{WRAPPER}} .pxl-contact-form .wpcf7-submit:hover svg path, {{WRAPPER}} .pxl-contact-form .wpcf7-submit:focus svg path' => 'fill: {{VALUE}};',
                                                        '{{WRAPPER}} .pxl-contact-form button:hover svg path, {{WRAPPER}} .pxl-contact-form button:focus svg path' => 'fill: {{VALUE}};',
                                                    ]
                                                ),
                                                frameflow_widget_color_control(
                                                    'button_bg_color_hover',
                                                    esc_html__('Background Color', 'frameflow'),
                                                    [
                                                        '{{WRAPPER}} .pxl-contact-form .wpcf7-submit:hover, {{WRAPPER}} .pxl-contact-form button:hover, {{WRAPPER}} .pxl-contact-form .wpcf7-submit:focus, {{WRAPPER}} .pxl-contact-form button:focus' => 'background-color: {{VALUE}};',
                                                    ]
                                                ),
                                            ],
                                        ],
                                    ],
                                ),
                            ),
                            frameflow_widget_color_type([
                                'prefix'          => 'gr',
                                'label'           => 'Button',
                                'selectors_class' => '.pxl-contact-form',
                            ]),
                            array(
                                array(
                                    'name'         => 'button_padding',
                                    'label'        => esc_html__('Padding', 'frameflow'),
                                    'type'         => \Elementor\Controls_Manager::DIMENSIONS,
                                    'size_units'   => ['px'],
                                    'selectors'    => [
                                        '{{WRAPPER}} .pxl-contact-form .wpcf7-submit, {{WRAPPER}} .pxl-contact-form button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                    ],
                                    'control_type' => 'responsive',
                                ),
                                array(
                                    'name'         => 'button_margin',
                                    'label'        => esc_html__('Margin', 'frameflow'),
                                    'type'         => \Elementor\Controls_Manager::DIMENSIONS,
                                    'size_units'   => ['px'],
                                    'selectors'    => [
                                        '{{WRAPPER}} .pxl-contact-form .wpcf7-submit, {{WRAPPER}} .pxl-contact-form button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                    ],
                                    'control_type' => 'responsive',
                                ),
                                array(
                                    'name'         => 'button_border_radius',
                                    'label'        => esc_html__('Border Radius', 'frameflow'),
                                    'type'         => \Elementor\Controls_Manager::DIMENSIONS,
                                    'size_units'   => ['px'],
                                    'selectors'    => [
                                        '{{WRAPPER}} .pxl-contact-form .wpcf7-submit, {{WRAPPER}} .pxl-contact-form button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                    ],
                                    'control_type' => 'responsive',
                                ),
                                array(
                                    'name'         => 'button_box_shadow',
                                    'label'        => esc_html__('Box Shadow', 'frameflow'),
                                    'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                    'control_type' => 'group',
                                    'selector'     => '{{WRAPPER}} .pxl-contact-form .wpcf7-submit, {{WRAPPER}} .pxl-contact-form button',
                                ),
                                frameflow_widget_select_control(
                                    'button_border_type',
                                    esc_html__('Border Type', 'frameflow'),
                                    [
                                        ''        => esc_html__('None', 'frameflow'),
                                        'solid'   => esc_html__('Solid', 'frameflow'),
                                        'double'  => esc_html__('Double', 'frameflow'),
                                        'dotted'  => esc_html__('Dotted', 'frameflow'),
                                        'dashed'  => esc_html__('Dashed', 'frameflow'),
                                        'groove'  => esc_html__('Groove', 'frameflow'),
                                    ],
                                    [
                                        'selectors' => [
                                            '{{WRAPPER}} .pxl-contact-form .wpcf7-submit' => 'border-style: {{VALUE}} !important;',
                                        ],
                                    ]
                                ),
                                array(
                                    'name'      => 'button_border_width',
                                    'label'     => esc_html__('Border Width', 'frameflow'),
                                    'type'      => \Elementor\Controls_Manager::DIMENSIONS,
                                    'selectors' => [
                                        '{{WRAPPER}} .pxl-contact-form .wpcf7-submit' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                                    ],
                                    'condition'  => ['button_border_type!' => ''],
                                    'responsive' => true,
                                ),
                                frameflow_widget_color_control(
                                    'button_border_color',
                                    esc_html__('Border Color', 'frameflow'),
                                    [
                                        '{{WRAPPER}} .pxl-contact-form .wpcf7-submit' => 'border-color: {{VALUE}} !important;',
                                    ],
                                    ['condition' => ['button_border_type!' => '']]
                                ),
                                frameflow_widget_slider_control(
                                    'btn_width',
                                    esc_html__('Width', 'frameflow'),
                                    [
                                        '{{WRAPPER}} .pxl-contact-form .wpcf7-submit, {{WRAPPER}} .pxl-contact-form button' => 'width: {{SIZE}}{{UNIT}};',
                                    ]
                                ),
                                array(
                                    'name'    => 'btn_height',
                                    'label'   => esc_html__('Height', 'frameflow'),
                                    'type'    => \Elementor\Controls_Manager::SLIDER,
                                    'control_type' => 'responsive',
                                    'size_units' => ['px'],
                                    'range' => ['px' => ['min' => 0, 'max' => 100]],
                                    'selectors' => [
                                        '{{WRAPPER}} .pxl-contact-form .wpcf7-submit, {{WRAPPER}} .pxl-contact-form button' => 'height: {{SIZE}}{{UNIT}};',
                                    ],
                                ),
                                array(
                                    'name'         => 'btn_spacer_top',
                                    'label'        => esc_html__('Spacer Top', 'frameflow'),
                                    'type'         => \Elementor\Controls_Manager::SLIDER,
                                    'control_type' => 'responsive',
                                    'size_units'   => ['px'],
                                    'range'        => ['px' => ['min' => 0, 'max' => 3000]],
                                    'selectors'    => [
                                        '{{WRAPPER}} .pxl-contact-form .wpcf7-submit' => 'margin-top: {{SIZE}}{{UNIT}};',
                                    ],
                                ),
                            ),
                        ),
                    ),

                    // ── STYLE: ACCEPTANCE (checkbox) ────────────────────────
                    array(
                        'name'     => 'tab_style_acceptance',
                        'label'    => esc_html__('Acceptance', 'frameflow'),
                        'tab'      => \Elementor\Controls_Manager::TAB_STYLE,
                        'controls' => array(
                            frameflow_widget_typography_control(
                                'acceptance_label_typography',
                                esc_html__('Label Typography', 'frameflow'),
                                '{{WRAPPER}} .pxl-contact-form .wpcf7-acceptance .wpcf7-list-item-label, {{WRAPPER}} .pxl-contact-form .wpcf7-checkbox .wpcf7-list-item-label'
                            ),
                            frameflow_widget_color_control(
                                'acceptance_label_color',
                                esc_html__('Label Color', 'frameflow'),
                                [
                                    '{{WRAPPER}} .pxl-contact-form .wpcf7-acceptance .wpcf7-list-item-label, {{WRAPPER}} .pxl-contact-form .wpcf7-checkbox .wpcf7-list-item-label' => 'color: {{VALUE}};',
                                ]
                            ),
                            frameflow_widget_dimensions_control(
                                'acceptance_label_spacing',
                                esc_html__('Label Spacing', 'frameflow'),
                                [
                                    '{{WRAPPER}} .pxl-contact-form .wpcf7-acceptance .wpcf7-list-item-label, {{WRAPPER}} .pxl-contact-form .wpcf7-checkbox .wpcf7-list-item-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                            ),
                            frameflow_widget_dimensions_control(
                                'acceptance_label_padding',
                                esc_html__('Label Padding', 'frameflow'),
                                [
                                    '{{WRAPPER}} .pxl-contact-form .wpcf7-acceptance .wpcf7-list-item, {{WRAPPER}} .pxl-contact-form .wpcf7-acceptance > label, {{WRAPPER}} .pxl-contact-form .wpcf7-checkbox .wpcf7-list-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                            ),
                            array(
                                'name' => 'acceptance_link_style_tabs',
                                'control_type' => 'tab',
                                'tabs' => [
                                    [
                                        'name' => 'tab_acceptance_link_normal',
                                        'label' => esc_html__('Normal', 'frameflow'),
                                        'controls' => [
                                            frameflow_widget_color_control(
                                                'acceptance_link_color',
                                                esc_html__('Link Color', 'frameflow'),
                                                [
                                                    '{{WRAPPER}} .pxl-contact-form .wpcf7-acceptance .wpcf7-list-item-label a, {{WRAPPER}} .pxl-contact-form .wpcf7-checkbox .wpcf7-list-item-label a' => 'color: {{VALUE}};',
                                                ]
                                            ),
                                            frameflow_widget_select_control(
                                                'acceptance_link_decoration',
                                                esc_html__('Link Underline', 'frameflow'),
                                                [
                                                    'underline'   => esc_html__('Underline', 'frameflow'),
                                                    'none'        => esc_html__('None', 'frameflow'),
                                                ],
                                                [
                                                    'default' => 'underline',
                                                    'selectors' => [
                                                        '{{WRAPPER}} .pxl-contact-form .wpcf7-acceptance .wpcf7-list-item-label a, {{WRAPPER}} .pxl-contact-form .wpcf7-checkbox .wpcf7-list-item-label a' => 'text-decoration: {{VALUE}};',
                                                    ],
                                                ]
                                            ),
                                        ],
                                    ],
                                    [
                                        'name' => 'tab_acceptance_link_hover',
                                        'label' => esc_html__('Hover', 'frameflow'),
                                        'controls' => [
                                            frameflow_widget_color_control(
                                                'acceptance_link_hover_color',
                                                esc_html__('Link Color', 'frameflow'),
                                                [
                                                    '{{WRAPPER}} .pxl-contact-form .wpcf7-acceptance .wpcf7-list-item-label a:hover, {{WRAPPER}} .pxl-contact-form .wpcf7-checkbox .wpcf7-list-item-label a:hover' => 'color: {{VALUE}};',
                                                ]
                                            ),
                                        ],
                                    ],
                                ],
                            ),
                            array(
                                'name'         => 'acceptance_checkbox_size',
                                'label'        => esc_html__('Checkbox Size', 'frameflow'),
                                'type'         => \Elementor\Controls_Manager::SLIDER,
                                'control_type' => 'responsive',
                                'size_units'   => ['px'],
                                'range'        => ['px' => ['min' => 12, 'max' => 48]],
                                'selectors'    => [
                                    '{{WRAPPER}} .pxl-contact-form .wpcf7-acceptance .wpcf7-list-item .wpcf7-list-item-label:before, {{WRAPPER}} .pxl-contact-form .wpcf7-acceptance > label .wpcf7-list-item-label:before, {{WRAPPER}} .pxl-contact-form .wpcf7-checkbox .wpcf7-list-item .wpcf7-list-item-label:before' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                                    '{{WRAPPER}} .pxl-contact-form .wpcf7-acceptance .wpcf7-list-item .wpcf7-list-item-label:after, {{WRAPPER}} .pxl-contact-form .wpcf7-acceptance > label .wpcf7-list-item-label:after, {{WRAPPER}} .pxl-contact-form .wpcf7-checkbox .wpcf7-list-item .wpcf7-list-item-label:after' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                                    '{{WRAPPER}} .pxl-contact-form .wpcf7-acceptance .wpcf7-list-item input, {{WRAPPER}} .pxl-contact-form .wpcf7-acceptance > label input, {{WRAPPER}} .pxl-contact-form .wpcf7-checkbox .wpcf7-list-item input' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                                ],
                            ),
                            array(
                                'name'         => 'acceptance_label_indent',
                                'label'        => esc_html__('Text Indent', 'frameflow'),
                                'description'  => esc_html__('Space from checkbox to label text.', 'frameflow'),
                                'type'         => \Elementor\Controls_Manager::SLIDER,
                                'control_type' => 'responsive',
                                'size_units'   => ['px'],
                                'range'        => ['px' => ['min' => 20, 'max' => 80]],
                                'selectors'    => [
                                    '{{WRAPPER}} .pxl-contact-form .wpcf7-acceptance .wpcf7-list-item, {{WRAPPER}} .pxl-contact-form .wpcf7-acceptance > label, {{WRAPPER}} .pxl-contact-form .wpcf7-checkbox .wpcf7-list-item' => 'padding-left: {{SIZE}}{{UNIT}};',
                                ],
                            ),
                            array(
                                'name' => 'acceptance_checkbox_style_tabs',
                                'control_type' => 'tab',
                                'tabs' => [
                                    [
                                        'name' => 'tab_acceptance_checkbox_normal',
                                        'label' => esc_html__('Normal', 'frameflow'),
                                        'controls' => [
                                            frameflow_widget_color_control(
                                                'acceptance_checkbox_bg',
                                                esc_html__('Background', 'frameflow'),
                                                [
                                                    '{{WRAPPER}} .pxl-contact-form .wpcf7-acceptance .wpcf7-list-item .wpcf7-list-item-label:before, {{WRAPPER}} .pxl-contact-form .wpcf7-acceptance > label .wpcf7-list-item-label:before, {{WRAPPER}} .pxl-contact-form .wpcf7-checkbox .wpcf7-list-item .wpcf7-list-item-label:before' => 'background-color: {{VALUE}};',
                                                ]
                                            ),
                                            frameflow_widget_select_control(
                                                'acceptance_checkbox_border_type',
                                                esc_html__('Border Type', 'frameflow'),
                                                [
                                                    ''        => esc_html__('None', 'frameflow'),
                                                    'solid'   => esc_html__('Solid', 'frameflow'),
                                                    'double'  => esc_html__('Double', 'frameflow'),
                                                    'dotted'  => esc_html__('Dotted', 'frameflow'),
                                                    'dashed'  => esc_html__('Dashed', 'frameflow'),
                                                ],
                                                [
                                                    'selectors' => [
                                                        '{{WRAPPER}} .pxl-contact-form .wpcf7-acceptance .wpcf7-list-item .wpcf7-list-item-label:before, {{WRAPPER}} .pxl-contact-form .wpcf7-acceptance > label .wpcf7-list-item-label:before, {{WRAPPER}} .pxl-contact-form .wpcf7-checkbox .wpcf7-list-item .wpcf7-list-item-label:before' => 'border-style: {{VALUE}};',
                                                    ],
                                                ]
                                            ),
                                            array(
                                                'name'      => 'acceptance_checkbox_border_width',
                                                'label'     => esc_html__('Border Width', 'frameflow'),
                                                'type'      => \Elementor\Controls_Manager::DIMENSIONS,
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-contact-form .wpcf7-acceptance .wpcf7-list-item .wpcf7-list-item-label:before, {{WRAPPER}} .pxl-contact-form .wpcf7-acceptance > label .wpcf7-list-item-label:before, {{WRAPPER}} .pxl-contact-form .wpcf7-checkbox .wpcf7-list-item .wpcf7-list-item-label:before' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                                ],
                                                'condition'  => ['acceptance_checkbox_border_type!' => ''],
                                                'responsive' => true,
                                            ),
                                            frameflow_widget_color_control(
                                                'acceptance_checkbox_border_color',
                                                esc_html__('Border Color', 'frameflow'),
                                                [
                                                    '{{WRAPPER}} .pxl-contact-form .wpcf7-acceptance .wpcf7-list-item .wpcf7-list-item-label:before, {{WRAPPER}} .pxl-contact-form .wpcf7-acceptance > label .wpcf7-list-item-label:before, {{WRAPPER}} .pxl-contact-form .wpcf7-checkbox .wpcf7-list-item .wpcf7-list-item-label:before' => 'border-color: {{VALUE}};',
                                                ],
                                                ['condition' => ['acceptance_checkbox_border_type!' => '']]
                                            ),
                                        ],
                                    ],
                                    [
                                        'name' => 'tab_acceptance_checkbox_checked',
                                        'label' => esc_html__('Checked', 'frameflow'),
                                        'controls' => [
                                            frameflow_widget_color_control(
                                                'acceptance_checkbox_bg_checked',
                                                esc_html__('Background', 'frameflow'),
                                                [
                                                    '{{WRAPPER}} .pxl-contact-form .wpcf7-acceptance .wpcf7-list-item input:checked + .wpcf7-list-item-label:before, {{WRAPPER}} .pxl-contact-form .wpcf7-acceptance > label input:checked + .wpcf7-list-item-label:before, {{WRAPPER}} .pxl-contact-form .wpcf7-checkbox .wpcf7-list-item input:checked + .wpcf7-list-item-label:before' => 'background-color: {{VALUE}};',
                                                ]
                                            ),
                                            frameflow_widget_color_control(
                                                'acceptance_checkmark_color',
                                                esc_html__('Checkmark Color', 'frameflow'),
                                                [
                                                    '{{WRAPPER}} .pxl-contact-form .wpcf7-acceptance .wpcf7-list-item .wpcf7-list-item-label:after, {{WRAPPER}} .pxl-contact-form .wpcf7-acceptance > label .wpcf7-list-item-label:after, {{WRAPPER}} .pxl-contact-form .wpcf7-checkbox .wpcf7-list-item .wpcf7-list-item-label:after' => 'color: {{VALUE}};',
                                                ]
                                            ),
                                        ],
                                    ],
                                ],
                            ),
                            array(
                                'name'         => 'acceptance_checkbox_radius',
                                'label'        => esc_html__('Checkbox Border Radius', 'frameflow'),
                                'type'         => \Elementor\Controls_Manager::DIMENSIONS,
                                'size_units'   => ['px', '%'],
                                'selectors'    => [
                                    '{{WRAPPER}} .pxl-contact-form .wpcf7-acceptance .wpcf7-list-item .wpcf7-list-item-label:before, {{WRAPPER}} .pxl-contact-form .wpcf7-acceptance > label .wpcf7-list-item-label:before, {{WRAPPER}} .pxl-contact-form .wpcf7-checkbox .wpcf7-list-item .wpcf7-list-item-label:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                                'control_type' => 'responsive',
                            ),
                            array(
                                'name'         => 'acceptance_checkmark_size',
                                'label'        => esc_html__('Checkmark Size', 'frameflow'),
                                'type'         => \Elementor\Controls_Manager::SLIDER,
                                'control_type' => 'responsive',
                                'size_units'   => ['px'],
                                'range'        => ['px' => ['min' => 8, 'max' => 28]],
                                'selectors'    => [
                                    '{{WRAPPER}} .pxl-contact-form .wpcf7-acceptance .wpcf7-list-item .wpcf7-list-item-label:after, {{WRAPPER}} .pxl-contact-form .wpcf7-acceptance > label .wpcf7-list-item-label:after, {{WRAPPER}} .pxl-contact-form .wpcf7-checkbox .wpcf7-list-item .wpcf7-list-item-label:after' => 'font-size: {{SIZE}}{{UNIT}};',
                                ],
                            ),
                            array(
                                'name'         => 'acceptance_margin',
                                'label'        => esc_html__('Margin', 'frameflow'),
                                'type'         => \Elementor\Controls_Manager::DIMENSIONS,
                                'size_units'   => ['px'],
                                'selectors'    => [
                                    '{{WRAPPER}} .pxl-contact-form .wpcf7-form-control-wrap:has(.wpcf7-acceptance), {{WRAPPER}} .pxl-contact-form .wpcf7-form-control-wrap:has(.wpcf7-checkbox)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                                'control_type' => 'responsive',
                                'separator'    => 'before',
                            ),
                        ),
                    ),

                    // ── STYLE: EXTRA ──────────────────────────────────────────
                    array(
                        'name'     => 'extra',
                        'label'    => esc_html__('Extra', 'frameflow'),
                        'tab'      => \Elementor\Controls_Manager::TAB_STYLE,
                        'controls' => array(
                            frameflow_widget_color_control(
                                'title_box_color',
                                esc_html__('Title Box Color', 'frameflow'),
                                [
                                    '{{WRAPPER}} .pxl-contact-form h3' => 'color: {{VALUE}};',
                                ]
                            ),
                            frameflow_widget_typography_control(
                                'title_box_typography',
                                esc_html__('Title Box Typography', 'frameflow'),
                                '{{WRAPPER}} .pxl-contact-form h3'
                            ),
                            frameflow_widget_dimensions_control(
                                'title_box_spacing',
                                esc_html__('Title Box Spacing', 'frameflow'),
                                [
                                    '{{WRAPPER}} .pxl-contact-form h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                            ),
                            frameflow_widget_color_control(
                                'des_box_color',
                                esc_html__('Description Box Color', 'frameflow'),
                                [
                                    '{{WRAPPER}} .pxl-contact-form p' => 'color: {{VALUE}};',
                                ]
                            ),
                            frameflow_widget_color_control(
                                'bgbcolor',
                                esc_html__('Background Color', 'frameflow'),
                                [
                                    '{{WRAPPER}} .pxl-contact-form .wrap-form' => 'background-color: {{VALUE}};',
                                ]
                            ),
                            array(
                                'name'         => 'box_padding',
                                'label'        => esc_html__('Box Padding', 'frameflow'),
                                'type'         => \Elementor\Controls_Manager::DIMENSIONS,
                                'size_units'   => ['px'],
                                'selectors'    => [
                                    '{{WRAPPER}} .pxl-contact-form .wrap-form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                                ],
                                'control_type' => 'responsive',
                            ),
                            array(
                                'name'         => 'ntt_padding',
                                'label'        => esc_html__('Notice Margin', 'frameflow'),
                                'type'         => \Elementor\Controls_Manager::DIMENSIONS,
                                'size_units'   => ['px'],
                                'selectors'    => [
                                    '{{WRAPPER}} .pxl-contact-form .wpcf7-response-output' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                                ],
                                'control_type' => 'responsive',
                            ),
                            array(
                                'name'         => 'item_padding',
                                'label'        => esc_html__('Item Padding', 'frameflow'),
                                'type'         => \Elementor\Controls_Manager::DIMENSIONS,
                                'size_units'   => ['px'],
                                'selectors'    => [
                                    '{{WRAPPER}} .pxl-contact-form .row'                        => 'margin-top: -{{TOP}}{{UNIT}}; margin-right: -{{RIGHT}}{{UNIT}}; margin-bottom: -{{BOTTOM}}{{UNIT}}; margin-left: -{{LEFT}}{{UNIT}} !important;',
                                    '{{WRAPPER}} .pxl-contact-form .input-filled:not(.label-text)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                                ],
                                'control_type' => 'responsive',
                            ),
                            frameflow_widget_color_control(
                                'notification_color',
                                esc_html__('Notification Color', 'frameflow'),
                                [
                                    '{{WRAPPER}} .pxl-contact-form .wpcf7-form .wpcf7-response-output' => 'color: {{VALUE}};',
                                ]
                            ),
                            frameflow_widget_color_control(
                                'label_color',
                                esc_html__('Label Color', 'frameflow'),
                                [
                                    '{{WRAPPER}} .pxl-contact-form label, .pxl-contact-form .label'          => 'color: {{VALUE}};',
                                    '{{WRAPPER}} .pxl-contact-form .wpcf7-list-item-label'                                 => 'color: {{VALUE}};',
                                ]
                            ),
                            frameflow_widget_typography_control(
                                'label_typography',
                                esc_html__('Label Typography', 'frameflow'),
                                '{{WRAPPER}} .pxl-contact-form label, .pxl-contact-form .label, {{WRAPPER}} .pxl-contact-form .wpcf7-list-item-label'
                            ),
                            array(
                                'name'         => 'label_spacer_bottom',
                                'label'        => esc_html__('Label Spacer Bottom', 'frameflow'),
                                'type'         => \Elementor\Controls_Manager::SLIDER,
                                'control_type' => 'responsive',
                                'size_units'   => ['px'],
                                'range'        => ['px' => ['min' => 0, 'max' => 3000]],
                                'selectors'    => [
                                    '{{WRAPPER}} .pxl-contact-form label, .pxl-contact-form .label' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                                    '{{WRAPPER}} .pxl-contact-form .wpcf7-list-item-label' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                                ],
                            ),
                            frameflow_widget_color_control(
                                'icon_color',
                                esc_html__('Icon Color', 'frameflow'),
                                [
                                    '{{WRAPPER}} .pxl-contact-form .pxl--form-icon' => 'color: {{VALUE}};',
                                ]
                            ),
                        ),
                    ),

                    // ── STYLE: BOX ────────────────────────────────────────────
                    array(
                        'name'     => 'section_style_box',
                        'label'    => esc_html__('Box', 'frameflow'),
                        'tab'      => \Elementor\Controls_Manager::TAB_STYLE,
                        'controls' => array(
                            frameflow_widget_media_control(
                                'image_box',
                                esc_html__('Image Box', 'frameflow')
                            ),
                            frameflow_widget_textarea_control(
                                'desc',
                                esc_html__('Description', 'frameflow'),
                                [
                                    'rows'       => 10,
                                    'show_label' => false,
                                ]
                            ),
                            frameflow_widget_typography_control(
                                'box_desc_typography',
                                esc_html__('Description Typography', 'frameflow'),
                                '{{WRAPPER}} .pxl-contact-form .pxl-contact-meta p'
                            ),
                            frameflow_widget_color_control(
                                'box_desc_color',
                                esc_html__('Description Color', 'frameflow'),
                                [
                                    '{{WRAPPER}} .pxl-contact-form .pxl-contact-meta p' => 'color: {{VALUE}};',
                                ]
                            ),
                            array(
                                'name'         => 'box_border_radius',
                                'label'        => esc_html__('Border Radius', 'frameflow'),
                                'type'         => \Elementor\Controls_Manager::DIMENSIONS,
                                'size_units'   => ['px'],
                                'selectors'    => [
                                    '{{WRAPPER}} .pxl-contact-form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};overflow: hidden;',
                                ],
                            ),
                            array(
                                'name'         => 'box_paddingd',
                                'label'        => esc_html__('Box Padding', 'frameflow'),
                                'type'         => \Elementor\Controls_Manager::DIMENSIONS,
                                'size_units'   => ['px', '%', 'vw', 'vh'],
                                'selectors'    => [
                                    '{{WRAPPER}} .pxl-contact-form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                                'control_type' => 'responsive',
                            ),
                            array(
                                'name'         => 'box_paddingd_form',
                                'label'        => esc_html__('Box Padding Form', 'frameflow'),
                                'type'         => \Elementor\Controls_Manager::DIMENSIONS,
                                'size_units'   => ['px', '%', 'vw', 'vh'],
                                'selectors'    => [
                                    '{{WRAPPER}} .pxl-contact-form .wpcf7-form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                                'control_type' => 'responsive',
                            ),
                            frameflow_widget_color_control(
                                'bg_color',
                                esc_html__('Background Color', 'frameflow'),
                                [
                                    '{{WRAPPER}} .pxl-contact-form' => 'background-color: {{VALUE}};',
                                ]
                            ),
                            array(
                                'name'         => 'box_shadow',
                                'label'        => esc_html__('Box Shadow', 'frameflow'),
                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                'control_type' => 'group',
                                'selector'     => '{{WRAPPER}} .pxl-contact-form',
                            ),
                        ),
                    ),

                    frameflow_widget_animation_settings(),
                ),
            ),
        ),
        frameflow_get_class_widget_path()
    );
}
