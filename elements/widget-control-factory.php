<?php
/**
 * Shared Elementor control factories for Frameflow widgets.
 *
 * Thin wrappers around Controls_Manager types (select, choose, color,
 * typography, dimensions…). Use from elements/widgets/*.php configs.
 *
 * Related: widget-function-settings.php (full style sections)
 */
if (!function_exists('frameflow_widget_select_control')) {
    function frameflow_widget_select_control($name, $label, $options, $args = [])
    {
        return wp_parse_args($args, [
            'name' => $name,
            'label' => $label,
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => $options,
        ]);
    }
}

if (!function_exists('frameflow_widget_choose_control')) {
    /**
     * Factory function for Elementor choose control with responsive support.
     *
     * @param string $name
     * @param string $label
     * @param array $options
     * @param array $args
     * @return array
     */
    function frameflow_widget_choose_control($name, $label, $options, $args = [])
    {
        return wp_parse_args($args, [
            'name' => $name,
            'label' => $label,
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'options' => $options,
            'control_type' => 'responsive',
        ]);
    }
}

if (!function_exists('frameflow_widget_text_control')) {
    function frameflow_widget_text_control($name, $label, $args = [])
    {
        return wp_parse_args($args, [
            'name' => $name,
            'label' => $label,
            'type' => \Elementor\Controls_Manager::TEXT,
        ]);
    }
}

if (!function_exists('frameflow_widget_url_control')) {
    function frameflow_widget_url_control($name, $label, $args = [])
    {
        return wp_parse_args($args, [
            'name' => $name,
            'label' => $label,
            'type' => \Elementor\Controls_Manager::URL,
        ]);
    }
}

if (!function_exists('frameflow_widget_number_control')) {
    function frameflow_widget_number_control($name, $label, $args = [])
    {
        return wp_parse_args($args, [
            'name' => $name,
            'label' => $label,
            'type' => \Elementor\Controls_Manager::NUMBER,
        ]);
    }
}

if (!function_exists('frameflow_widget_media_control')) {
    function frameflow_widget_media_control($name, $label, $args = [])
    {
        return wp_parse_args($args, [
            'name' => $name,
            'label' => $label,
            'type' => \Elementor\Controls_Manager::MEDIA,
        ]);
    }
}

if (!function_exists('frameflow_widget_icons_control')) {
    function frameflow_widget_icons_control($name, $label, $args = [])
    {
        return wp_parse_args($args, [
            'name' => $name,
            'label' => $label,
            'type' => \Elementor\Controls_Manager::ICONS,
            'fa4compatibility' => 'icon',
        ]);
    }
}

if (!function_exists('frameflow_widget_wysiwyg_control')) {
    function frameflow_widget_wysiwyg_control($name, $label, $args = [])
    {
        return wp_parse_args($args, [
            'name' => $name,
            'label' => $label,
            'type' => \Elementor\Controls_Manager::WYSIWYG,
        ]);
    }
}

if (!function_exists('frameflow_widget_textarea_control')) {
    function frameflow_widget_textarea_control($name, $label, $args = [])
    {
        return wp_parse_args($args, [
            'name' => $name,
            'label' => $label,
            'type' => \Elementor\Controls_Manager::TEXTAREA,
        ]);
    }
}

if (!function_exists('frameflow_widget_is_switcher_on')) {
    /**
     * Theme switchers store "on" as true/yes/1 and "off" as empty or false.
     */
    function frameflow_widget_is_switcher_on($value)
    {
        return in_array((string) $value, ['true', 'yes', '1'], true);
    }
}

if (!function_exists('frameflow_widget_switcher_control')) {
    function frameflow_widget_switcher_control($name, $label, $conditions = null, $default = 'true')
    {
        $control = [
            'name' => $name,
            'label' => $label,
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => $default,
            'return_value' => 'true',
        ];

        if (!empty($conditions) && is_array($conditions)) {
            if (isset($conditions['terms']) || isset($conditions['relation'])) {
                $control['conditions'] = $conditions;
            } else {
                $control['condition'] = $conditions;
            }
        }

        return $control;
    }
}

if (!function_exists('frameflow_widget_color_control')) {
    function frameflow_widget_color_control($name, $label, $selectors, $args = [])
    {
        return wp_parse_args($args, [
            'name' => $name,
            'label' => $label,
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => $selectors,
        ]);
    }
}

if (!function_exists('frameflow_widget_typography_control')) {
    function frameflow_widget_typography_control($name, $label, $selector, $args = [])
    {
        return wp_parse_args($args, [
            'name' => $name,
            'label' => $label,
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => $selector,
        ]);
    }
}

if (!function_exists('frameflow_widget_dimensions_control')) {
    function frameflow_widget_dimensions_control($name, $label, $selectors, $args = [])
    {
        $defaults = [
            'name' => $name,
            'label' => $label,
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem', 'vh', 'vw', 'custom'],
            'selectors' => $selectors,
            'control_type' => 'responsive',
        ];

        return wp_parse_args($args, $defaults);
    }
}

if (!function_exists('frameflow_widget_slider_control')) {
    function frameflow_widget_slider_control($name, $label, $selectors = [], $args = [])
    {
        $defaults = [
            'name' => $name,
            'label' => $label,
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%', 'em', 'rem', 'vh', 'vw', 'custom'],
            'selectors' => $selectors,
            'control_type' => 'responsive',
        ];

        return wp_parse_args($args, $defaults);
    }
}

if (!function_exists('frameflow_widget_yes_no_select_control')) {
    function frameflow_widget_yes_no_select_control($name, $label, $args = [])
    {
        return frameflow_widget_select_control(
            $name,
            $label,
            [
                'true' => esc_html__('Enable', 'frameflow'),
                'false' => esc_html__('Disable', 'frameflow'),
            ],
            $args,
        );
    }
}

if (!function_exists('frameflow_widget_columns_control')) {
    function frameflow_widget_columns_control($name, $label, $default = '1', $args = [])
    {
        $column_options = [
            '1' => '1',
            '2' => '2',
            '3' => '3',
            '4' => '4',
            '5' => '5',
            '6' => '6',
        ];

        return frameflow_widget_select_control(
            $name,
            $label,
            $column_options,
            wp_parse_args($args, ['default' => $default]),
        );
    }
}

if (!function_exists('frameflow_widget_title_tag_control')) {
    function frameflow_widget_title_tag_control(
        $name = 'title_tag',
        $label = null,
        $default = 'h3',
        $args = [],
    ) {
        if ($label === null) {
            $label = esc_html__('Title HTML Tag', 'frameflow');
        }

        return frameflow_widget_select_control(
            $name,
            $label,
            [
                'h1' => 'H1',
                'h2' => 'H2',
                'h3' => 'H3',
                'h4' => 'H4',
                'h5' => 'H5',
                'h6' => 'H6',
                'div' => 'div',
                'span' => 'span',
                'p' => 'p',
            ],
            wp_parse_args($args, ['default' => $default]),
        );
    }
}

if (!function_exists('frameflow_widget_responsive_columns_controls')) {
    function frameflow_widget_responsive_columns_controls($defaults = [], $args = [])
    {
        $defaults = wp_parse_args($defaults, [
            'xs' => '1',
            'sm' => '2',
            'md' => '2',
            'lg' => '3',
            'xl' => '4',
            'xxl' => '4',
        ]);

        $args = wp_parse_args($args, [
            'prefix' => 'col_',
            'label_prefix' => esc_html__('Columns', 'frameflow'),
            'suffixes' => [
                'xs' => esc_html__('XS Devices', 'frameflow'),
                'sm' => esc_html__('SM Devices', 'frameflow'),
                'md' => esc_html__('MD Devices', 'frameflow'),
                'lg' => esc_html__('LG Devices', 'frameflow'),
                'xl' => esc_html__('XL Devices', 'frameflow'),
                'xxl' => esc_html__('XXL Devices', 'frameflow'),
            ],
            'control_args' => [],
        ]);

        $controls = [];

        foreach ($args['suffixes'] as $suffix => $label_suffix) {
            $controls[] = frameflow_widget_columns_control(
                $args['prefix'] . $suffix,
                sprintf('%s %s', $args['label_prefix'], $label_suffix),
                isset($defaults[$suffix]) ? (string) $defaults[$suffix] : '1',
                $args['control_args'],
            );
        }

        return $controls;
    }
}

if (!function_exists('frameflow_widget_responsive_select_controls')) {
    function frameflow_widget_responsive_select_controls($configs, $args = [])
    {
        $args = wp_parse_args($args, [
            'prefix' => 'col_',
            'control_args' => [],
        ]);

        $controls = [];

        foreach ($configs as $suffix => $config) {
            $config = wp_parse_args($config, [
                'name' => $args['prefix'] . $suffix,
                'label' => strtoupper($suffix),
                'options' => [],
                'default' => '',
                'args' => [],
            ]);

            $controls[] = frameflow_widget_select_control(
                $config['name'],
                $config['label'],
                $config['options'],
                wp_parse_args(
                    $config['args'],
                    wp_parse_args($args['control_args'], ['default' => $config['default']]),
                ),
            );
        }

        return $controls;
    }
}

if (!function_exists('frameflow_widget_control_tabs')) {
    /**
     * Inner Elementor tabs for Pxltheme_Core_Widget_Base (control_type => tab).
     *
     * @param string $name Tab group id.
     * @param array  $tabs Each item: name, label, controls.
     */
    function frameflow_widget_control_tabs($name, array $tabs)
    {
        return [
            'name' => $name,
            'control_type' => 'tab',
            'tabs' => $tabs,
        ];
    }
}

if (!function_exists('frameflow_widget_carousel_arrows_type_options')) {
    /**
     * Select options for Swiper carousel arrow style (.pxl-swiper-arrow-wrap).
     *
     * @return array<string, string>
     */
    function frameflow_widget_carousel_arrows_type_options()
    {
        $options = [
            'style-1' => esc_html__('Default', 'frameflow'),
            'style-2' => esc_html__('Style 2', 'frameflow'),
            'style-3' => esc_html__('Style 3', 'frameflow'),
            'style-4' => esc_html__('Style 4', 'frameflow'),
            'style-5' => esc_html__('Style 5', 'frameflow'),
            'style-6' => esc_html__('Style 6', 'frameflow'),
            'style-7' => esc_html__('Style 7', 'frameflow'),
        ];

        return apply_filters('frameflow_carousel_arrows_type_options', $options);
    }
}

if (!function_exists('frameflow_widget_carousel_arrows_type_control')) {
    /**
     * Elementor SELECT control for carousel arrows preset classes (style-1 … style-N).
     *
     * @param array<string, mixed> $args Passed to frameflow_widget_select_control (e.g. default, condition).
     */
    function frameflow_widget_carousel_arrows_type_control($args = [])
    {
        $args = wp_parse_args($args, [
            'default' => 'style-1',
        ]);

        return frameflow_widget_select_control(
            'arrows_type',
            esc_html__('Arrows Type', 'frameflow'),
            frameflow_widget_carousel_arrows_type_options(),
            $args,
        );
    }
}
