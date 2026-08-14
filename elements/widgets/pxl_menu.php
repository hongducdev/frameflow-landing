<?php
$menus = get_terms('nav_menu', array('hide_empty' => false));
$pxl_menus = array(
    '' => esc_html__('Default', 'frameflow')
);
if (is_array($menus) && ! empty($menus)) {
    foreach ($menus as $value) {
        if (is_object($value) && isset($value->name, $value->slug)) {
            $pxl_menus[$value->slug] = $value->name;
        }
    }
} else {
    $pxl_menus = '';
}
pxl_add_custom_widget(
    array(
        'name' => 'pxl_menu',
        'title' => esc_html__('Case Nav Menu', 'frameflow'),
        'icon' => 'eicon-nav-menu icon-brand-elementor',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        frameflow_widget_select_control(
                            'menu',
                            esc_html__('Select Menu', 'frameflow'),
                            $pxl_menus
                        ),
                        frameflow_widget_select_control(
                            'menu_type',
                            esc_html__('Menu Type', 'frameflow'),
                            [
                                'horizontal' => 'Horizontal',
                                'vertical' => 'Vertical',
                            ],
                            ['default' => 'horizontal']
                        ),
                        array(
                            'name' => 'align',
                            'label' => esc_html__('Alignment', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::CHOOSE,
                            'options' => [
                                'left' => [
                                    'title' => esc_html__('Left', 'frameflow'),
                                    'icon' => 'fa fa-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__('Center', 'frameflow'),
                                    'icon' => 'fa fa-align-center',
                                ],
                                'right' => [
                                    'title' => esc_html__('Right', 'frameflow'),
                                    'icon' => 'fa fa-align-right',
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-nav-menu .pxl-menu-primary' => 'text-align: {{VALUE}};',
                                '{{WRAPPER}} .pxl-nav-menu .pxl-menu-primary > li' => 'float: none;',
                            ],
                            'condition' => [
                                'menu_type' => 'horizontal',
                            ],
                        ),
                        array(
                            'name' => 'text_align',
                            'label' => esc_html__('Text Alignment', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::CHOOSE,
                            'options' => [
                                'left' => [
                                    'title' => esc_html__('Left', 'frameflow'),
                                    'icon' => 'fa fa-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__('Center', 'frameflow'),
                                    'icon' => 'fa fa-align-center',
                                ],
                                'right' => [
                                    'title' => esc_html__('Right', 'frameflow'),
                                    'icon' => 'fa fa-align-right',
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-nav-menu.pxl-nav-vertical' => 'text-align: {{VALUE}};',
                            ],
                            'condition' => [
                                'menu_type' => 'vertical',
                            ],
                        ),
                        array(
                            'name' => 'max_height',
                            'label' => esc_html__('Max Height', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['px', '%', 'vh'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-nav-menu.pxl-nav-vertical' => 'max-height: {{SIZE}}{{UNIT}};overflow-y: auto; scrollbar-width: none;',
                            ],
                            'condition' => [
                                'menu_type' => 'vertical',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_first_level',
                    'label' => esc_html__('First Level', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_select_control(
                            'hover_active_style',
                            esc_html__('Style', 'frameflow'),
                            [
                                'fr-style-default' => 'Default',
                                'fr-style-divider' => 'Divider Top',
                                'fr-style-divider1' => 'Divider Bottom',
                                'fr-style-box' => 'Box',
                            ],
                            [
                                'default' => 'fr-style-default',
                                'condition' => [
                                    'menu_type' => 'horizontal',
                                ],
                            ]
                        ),
                        frameflow_widget_color_control(
                            'box_color',
                            esc_html__('Box Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-nav-menu.fr-style-box .pxl-divider-move' => 'background-color: {{VALUE}} !important;',
                            ],
                            [
                                'condition' => [
                                    'hover_active_style' => ['fr-style-box'],
                                ],
                            ]
                        ),
                        frameflow_widget_dimensions_control(
                            'box_border_radius',
                            esc_html__('Box Border Radius', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-nav-menu.fr-style-box .pxl-divider-move' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            [
                                'condition' => [
                                    'hover_active_style' => ['fr-style-box'],
                                ],
                            ]
                        ),
                        frameflow_widget_color_control(
                            'dcolor',
                            esc_html__('Divider Color', 'frameflow'),
                            [
                                '{{WRAPPER}} .pxl-nav-menu.fr-style-divider1 .pxl-menu-primary > li > a:before' => 'background-color: {{VALUE}} !important;',
                            ],
                            [
                                'separator' => 'before',
                                'condition' => [
                                    'hover_active_style' => ['fr-style-divider'],
                                ],
                            ]
                        ),
                        array(
                            'name' => 'p_d',
                            'label' => esc_html__('Divider Position', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-nav-menu.fr-style-divider1 .pxl-menu-primary > li > a:before' => 'bottom: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-nav-menu.fr-style-divider3 .pxl-menu-primary > li > a:before' => 'bottom: {{SIZE}}{{UNIT}};',
                            ],

                            'condition' => [
                                'hover_active_style' => ['fr-style-divider1'],
                            ],
                        ),
                        frameflow_widget_control_tabs(
                            'first_level_style_tabs',
                            [
                                [
                                    'name' => 'tab_first_level_normal',
                                    'label' => esc_html__('Normal', 'frameflow'),
                                    'controls' => [
                                        frameflow_widget_color_control(
                                            'color',
                                            esc_html__('Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-nav-menu .pxl-menu-primary > li > a' => 'color: {{VALUE}};',
                                                '{{WRAPPER}} .pxl-nav-menu.fr-style-box .pxl-menu-primary > li' => 'color: {{VALUE}};',
                                            ]
                                        ),
                                        frameflow_widget_color_control(
                                            'arrow_color',
                                            esc_html__('Arrow Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-nav-menu .pxl-menu-primary > li > a i' => 'color: {{VALUE}};',
                                            ],
                                            [
                                                'condition' => [
                                                    'menu_type' => 'horizontal',
                                                ],
                                            ]
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'tab_first_level_hover',
                                    'label' => esc_html__('Hover', 'frameflow'),
                                    'controls' => [
                                        frameflow_widget_color_control(
                                            'color_hover',
                                            esc_html__('Color Hover', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-nav-menu:not(.fr-style-box) .pxl-menu-primary > li > a:hover' => 'color: {{VALUE}};',
                                                '{{WRAPPER}} .pxl-nav-menu:not(.fr-style-box) .pxl-menu-primary > li > a:hover i' => 'color: {{VALUE}};',
                                                '{{WRAPPER}} .pxl-nav-menu.fr-style-box .pxl-menu-primary > li.pxl-hover-active > a' => 'color: {{VALUE}} !important;',
                                                '{{WRAPPER}} .pxl-nav-menu.fr-style-box .pxl-menu-primary > li.pxl-hover-active > a i' => 'color: {{VALUE}} !important;',
                                            ]
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'tab_first_level_active',
                                    'label' => esc_html__('Active', 'frameflow'),
                                    'controls' => [
                                        frameflow_widget_color_control(
                                            'color_active',
                                            esc_html__('Color Active', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-nav-menu:not(.fr-style-box) .pxl-menu-primary > li.current-menu-ancestor > a:not(.is-one-page),{{WRAPPER}} .pxl-nav-menu:not(.fr-style-box) .pxl-menu-primary > li.current-menu-parent > a:not(.is-one-page), {{WRAPPER}} .pxl-nav-menu:not(.fr-style-box) .pxl-menu-primary > li.current_page_item > a:not(.is-one-page), {{WRAPPER}} .pxl-nav-menu:not(.fr-style-box) .pxl-menu-primary > li > a.pxl-onepage-active' => 'color: {{VALUE}} !important;',
                                                '{{WRAPPER}} .pxl-nav-menu.fr-style-box .pxl-menu-primary > li.pxl-shape-active > a:not(.is-one-page)' => 'color: {{VALUE}} !important;',
                                            ]
                                        ),
                                    ],
                                ],
                            ]
                        ),
                        frameflow_widget_typography_control(
                            'typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-nav-menu .pxl-menu-primary > li > a'
                        ),
                        array(
                            'name' => 'arrow_children_font_size',
                            'label' => esc_html__('Arrow Has Children - Font Size', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-nav-menu .pxl-menu-primary > li.menu-item-has-children > a i' => 'font-size: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'menu_type' => 'horizontal',
                            ],
                        ),
                        array(
                            'name' => 'arrow_space',
                            'label' => esc_html__('Arrow Space Left', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-nav-menu .pxl-menu-primary > li.menu-item-has-children > a i' => 'margin-left: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'item_space',
                            'label' => esc_html__('Item Spacer', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', 'em', '%', 'rem'],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-nav-menu .pxl-menu-primary > li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'condition' => [
                                'menu_type' => 'horizontal',
                            ],
                            'control_type' => 'responsive',
                        ),
                        array(
                            'name' => 'item_space1',
                            'label' => esc_html__('Extra Space Bottom', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-nav-menu .pxl-menu-primary > li' => 'padding-bottom: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'menu_type' => 'horizontal',
                            ],
                        ),
                        array(
                            'name' => 'item_space_vertical',
                            'label' => esc_html__('Item Spacer', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-nav-menu .pxl-menu-primary > li + li' => 'margin-top: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'menu_type' => 'vertical',
                            ],
                            'control_type' => 'responsive',
                        ),
                        array(
                            'name' => 'flex_grow',
                            'label' => esc_html__('Flex Grow', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::CHOOSE,
                            'options' => [
                                'inherit' => [
                                    'title' => esc_html__('Inherit', 'frameflow'),
                                    'icon' => 'fas fa-arrows-alt-v',
                                ],
                                '1' => [
                                    'title' => esc_html__('Full', 'frameflow'),
                                    'icon' => 'fas fa-arrows-alt-h',
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}}' => 'flex-grow: {{VALUE}};',
                            ],
                            'condition' => [
                                'menu_type' => 'horizontal',
                            ],
                        ),
                        frameflow_widget_select_control(
                            'menu_mega_type',
                            esc_html__('Menu Mega Type', 'frameflow'),
                            [
                                'pxl-mega-full-width' => 'Full Width',
                                'pxl-mega-boxed' => 'Boxed',
                            ],
                            ['default' => 'pxl-mega-full-width']
                        ),
                        array(
                            'name' => 'mega_space_left',
                            'label' => esc_html__('Mega Menu Spacer Left', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 3000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-nav-menu.pxl-mega-full-width .sub-menu.pxl-mega-menu' => 'margin-left: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'menu_mega_type' => 'pxl-mega-full-width',
                            ],
                            'control_type' => 'responsive',
                        ),
                        array(
                            'name' => 'mega_space_right',
                            'label' => esc_html__('Mega Menu Spacer Right', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 3000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-nav-menu.pxl-mega-full-width .sub-menu.pxl-mega-menu' => 'margin-right: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'menu_mega_type' => 'pxl-mega-full-width',
                            ],
                            'control_type' => 'responsive',
                        ),
                        array(
                            'name' => 'container_max_width',
                            'label' => esc_html__('Mega Menu Container Max Width', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 3000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-nav-menu.pxl-mega-boxed .pxl-megamenu > .sub-menu' => 'max-width: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'menu_mega_type' => 'pxl-mega-boxed',
                            ],
                            'control_type' => 'responsive',
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_sub_level',
                    'label' => esc_html__('Sub Level', 'frameflow'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        frameflow_widget_control_tabs(
                            'sub_level_style_tabs',
                            [
                                [
                                    'name' => 'tab_sub_level_normal',
                                    'label' => esc_html__('Normal', 'frameflow'),
                                    'controls' => [
                                        frameflow_widget_color_control(
                                            'sub_color',
                                            esc_html__('Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-nav-menu li.pxl-megamenu, {{WRAPPER}} .pxl-nav-menu .pxl-menu-primary li .sub-menu li > a, {{WRAPPER}} .pxl-nav-menu .pxl-menu-primary li .sub-menu li > a > span' => 'color: {{VALUE}};',
                                            ]
                                        ),
                                        frameflow_widget_color_control(
                                            'sub_bg_color',
                                            esc_html__('Box Background Color', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-menu-primary .sub-menu, {{WRAPPER}} .pxl-menu-primary .children' => 'background-color: {{VALUE}};',
                                            ],
                                            [
                                                'condition' => [
                                                    'menu_type' => 'horizontal',
                                                ],
                                            ]
                                        ),
                                    ],
                                ],
                                [
                                    'name' => 'tab_sub_level_hover',
                                    'label' => esc_html__('Hover', 'frameflow'),
                                    'controls' => [
                                        frameflow_widget_color_control(
                                            'sub_color_hover',
                                            esc_html__('Color Hover/Actvie', 'frameflow'),
                                            [
                                                '{{WRAPPER}} .pxl-nav-menu .pxl-menu-primary li .sub-menu li:hover > a,{{WRAPPER}} .pxl-nav-menu .pxl-menu-primary li .sub-menu li:hover > a span, {{WRAPPER}} .pxl-nav-menu .pxl-menu-primary li .sub-menu li.current_page_item > a,{{WRAPPER}} .pxl-nav-menu .pxl-menu-primary li .sub-menu li.current_page_item > a span, {{WRAPPER}} .pxl-nav-menu .pxl-menu-primary li .sub-menu li.current-menu-item > a, {{WRAPPER}} .pxl-nav-menu .pxl-menu-primary li .sub-menu li.current_page_ancestor > a, {{WRAPPER}} .pxl-nav-menu .pxl-menu-primary li .sub-menu li.current-menu-ancestor > a' => 'color: {{VALUE}} !important;',
                                                '{{WRAPPER}} .pxl-nav-menu.sub-style-default .sub-menu > li .pxl-menu-item-text::before' => 'background-color: {{VALUE}} !important;',
                                            ]
                                        ),
                                    ],
                                ],
                            ]
                        ),
                        frameflow_widget_typography_control(
                            'sub_typography',
                            esc_html__('Typography', 'frameflow'),
                            '{{WRAPPER}} .pxl-nav-menu .pxl-menu-primary li .sub-menu a, {{WRAPPER}} .pxl-heading .pxl-item--title'
                        ),
                        array(
                            'name' => 'sub_item_space',
                            'label' => esc_html__('Item Spacer', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-menu-primary .sub-menu li + li' => 'margin-top: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        frameflow_widget_select_control(
                            'hover_active_style_sub',
                            esc_html__('Hover/Active Style', 'frameflow'),
                            [
                                'sub-style-default' => 'Default',
                            ],
                            [
                                'default' => 'sub-style-default',
                                'condition' => [
                                    'menu_type' => 'horizontal',
                                ],
                            ]
                        ),
                        frameflow_widget_select_control(
                            'sub_show_effect',
                            esc_html__('Show Effect', 'frameflow'),
                            [
                                'show-effect-fade' => 'Fade',
                                'show-effect-slideup' => 'Slide Up',
                                'show-effect-dropdown' => 'Dropdown',
                                'show-effect-slidedown' => 'Slide Down 3D',
                            ],
                            [
                                'default' => 'show-effect-slideup',
                                'condition' => [
                                    'menu_type' => 'horizontal',
                                ],
                            ]
                        ),
                        array(
                            'name' => 'sub_hover_space_top',
                            'label' => esc_html__('Box Spacer Top', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-nav-menu .pxl-menu-primary .sub-menu' => 'margin-top: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'sub_hover_space_top_mega',
                            'label' => esc_html__('Box Spacer Top - Mega', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-nav-menu .pxl-menu-primary .sub-menu.pxl-mega-menu' => 'margin-top: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'sub_border_radius',
                            'label' => esc_html__('Border Radius', 'frameflow'),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => ['px'],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-menu-primary .sub-menu, {{WRAPPER}} .pxl-menu-primary .children' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                    ),
                ),
                frameflow_widget_animation_settings(),
            ),
        ),
    ),
    frameflow_get_class_widget_path()
);
