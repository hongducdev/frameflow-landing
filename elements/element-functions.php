<?php
/**
 * Elementor widget helpers for Frameflow.
 *
 * - Registers widget JS handles (pxl-swiper, grids, marquees, â€¦)
 * - Layout option builders for legacy post/portfolio/service widgets removed
 * - Loaded by Case Theme Core when registering theme widgets
 *
 * Related: widget-control-factory.php, widget-function-settings.php
 */

require_once get_template_directory() . '/elements/widget-control-factory.php';
require_once get_template_directory() . '/elements/widget-function-settings.php';

/**
 * Register frontend scripts used by Elementor widgets (Swiper, GSAP, gridsâ€¦).
 */
if (!function_exists('frameflow_register_element_scripts')) {
    add_action('wp_enqueue_scripts', 'frameflow_register_element_scripts', 5);
    add_action('elementor/frontend/after_register_scripts', 'frameflow_register_element_scripts', 5);
    function frameflow_register_element_scripts()
    {
        $theme = wp_get_theme(get_template());
        wp_register_script('gsap', get_template_directory_uri() . '/assets/js/libs/gsap.min.js', array('jquery'), '3.5.0', true);
        wp_register_script('pxl-scroll-trigger', get_template_directory_uri() . '/assets/js/libs/scroll-trigger.min.js', array('jquery'), '3.10.5', true);
        wp_register_script('pxl-splitText', get_template_directory_uri() . '/assets/js/libs/split-text.min.js', array('jquery'), '3.6.1', true);
        wp_register_script('frameflow-draggable', get_template_directory_uri() . '/assets/js/libs/Draggable.min.js', ['jquery'], $theme->get('Version'), true);
        wp_register_script('frameflow-inertia-plugin', get_template_directory_uri() . '/assets/js/libs/InertiaPlugin.min.js', ['jquery'], $theme->get('Version'), true);
        wp_register_script('pxl-bundled-lenis', get_template_directory_uri() . '/assets/js/libs/bundled-lenis.min.js', array('jquery'), '1.0.0', true);
        wp_register_script('pxl-matter', get_template_directory_uri() . '/assets/js/libs/matter.min.js', array('jquery'), '0.18.0', true);

        wp_register_script('frameflow-particle', get_template_directory_uri() . '/elements/widgets/js/particle.min.js', ['jquery'], $theme->get('Version'), true);
        wp_register_script('frameflow-physics', get_template_directory_uri() . '/elements/widgets/js/phsics.js', ['jquery', 'pxl-matter'], $theme->get('Version'), true);
        wp_register_script('frameflow-parallax', get_template_directory_uri() . '/elements/widgets/js/parallax.min.js', ['jquery'], $theme->get('Version'), true);
        wp_register_script('pxl-post-grid', get_template_directory_uri() . '/elements/widgets/js/grid.min.js', ['isotope', 'jquery'], $theme->get('Version'), true);
        wp_localize_script('pxl-post-grid', 'main_data', array('ajax_url' => admin_url('admin-ajax.php')));
        wp_register_script('pxl-carousel-helpers', get_template_directory_uri() . '/elements/widgets/js/carousel-helpers.min.js', ['jquery'], $theme->get('Version'), true);
        wp_register_script('pxl-swiper', get_template_directory_uri() . '/elements/widgets/js/carousel.min.js', ['jquery', 'pxl-carousel-helpers'], $theme->get('Version'), true);
        wp_register_script('frameflow-image', get_template_directory_uri() . '/elements/widgets/js/image.min.js', ['jquery'], $theme->get('Version'), true);
        wp_register_script('frameflow-counter', get_template_directory_uri() . '/elements/widgets/js/counter.min.js', ['jquery'], $theme->get('Version'), true);
        wp_register_script('frameflow-accordion', get_template_directory_uri() . '/elements/widgets/js/accordion.min.js', ['jquery'], $theme->get('Version'), true);
        wp_register_script('frameflow-tabs', get_template_directory_uri() . '/elements/widgets/js/tabs.min.js', ['jquery'], $theme->get('Version'), true);
        wp_register_script('frameflow-client-marquee', get_template_directory_uri() . '/elements/widgets/js/client-marquee.min.js', ['jquery', 'gsap'], $theme->get('Version'), true);
        wp_register_script('frameflow-image-marquee', get_template_directory_uri() . '/elements/widgets/js/image-marquee.min.js', ['jquery', 'gsap'], $theme->get('Version'), true);
        wp_register_script('frameflow-process', get_template_directory_uri() . '/elements/widgets/js/process.min.js', ['jquery', 'gsap', 'pxl-scroll-trigger'], $theme->get('Version'), true);
        wp_register_script('frameflow-text-box-grid', get_template_directory_uri() . '/elements/widgets/js/text-box-grid.min.js', ['jquery'], $theme->get('Version'), true);
        wp_register_script('frameflow-text-marquee', get_template_directory_uri() . '/elements/widgets/js/text-marquee.min.js', ['jquery', 'gsap'], $theme->get('Version'), true);
        wp_register_script('frameflow-testimonial-marquee', get_template_directory_uri() . '/elements/widgets/js/testimonial-marquee.min.js', ['jquery', 'gsap'], $theme->get('Version'), true);
        wp_register_script('frameflow-countdown', get_template_directory_uri() . '/elements/widgets/js/countdown.min.js', ['jquery'], $theme->get('Version'), true);
        wp_register_script('pxl-countdown', get_template_directory_uri() . '/elements/widgets/js/pxl-countdown.min.js', ['jquery'], $theme->get('Version'), true);
        if (!wp_script_is('stellar-parallax', 'registered')) {
            wp_register_script('stellar-parallax', get_template_directory_uri() . '/assets/js/libs/stellar-parallax.min.js', ['jquery'], '0.6.2', ['in_footer' => true, 'strategy' => 'defer']);
        }
        wp_register_script('frameflow-elementor', get_template_directory_uri() . '/elements/widgets/js/elementor.min.js', ['jquery', 'stellar-parallax'], $theme->get('Version'), true);
        wp_register_script('frameflow-distortion', get_template_directory_uri() . '/assets/js/libs/distortion.min.js', ['jquery', 'imagesloaded'], $theme->get('Version'), true);
    }
}

if (!function_exists('frameflow_enqueue_element_runtime_scripts')) {
    add_action('elementor/frontend/after_enqueue_scripts', 'frameflow_enqueue_element_runtime_scripts');
    function frameflow_enqueue_element_runtime_scripts()
    {
        wp_enqueue_script('frameflow-elementor');
        wp_enqueue_script('frameflow-distortion');
    }
}

/**
 * Extra Elementor Icons
 */
if (!function_exists('frameflow_register_custom_icon_library')) {
    add_filter('elementor/icons_manager/native', 'frameflow_register_custom_icon_library');
    function frameflow_register_custom_icon_library($tabs)
    {
        $custom_tabs = [
            'pxl_bootstrap_icons' => [
                'name' => 'bootstrap_icons',
                'label' => esc_html__('Bootstrap Icons', 'frameflow'),
                'url' => false,
                'enqueue' => false,
                'prefix' => 'bi-',
                'displayPrefix' => 'bootstrap-icons',
                'labelIcon' => 'bi-yelp',
                'ver' => '1.0.1',
                'fetchJson' => get_template_directory_uri() . '/assets/fonts/bootstrap-icons/pxl-bootstrap-icons.js',
                'native' => true,
            ],
        ];
        $tabs = array_merge($custom_tabs, $tabs);
        return $tabs;
    }
}

/**
 * Get class widget path
 */
if (!function_exists('frameflow_get_class_widget_path')) {
    function frameflow_get_class_widget_path()
    {
        $upload_dir = wp_upload_dir();
        $cls_path = $upload_dir['basedir'] . '/elementor-widget/';
        if (!is_dir($cls_path)) {
            wp_mkdir_p($cls_path);
        }
        return $cls_path;
    }
}

/**
 * Map the portfolio_project_status option value to its display label.
 */
if (!function_exists('frameflow_get_portfolio_status_label')) {
    function frameflow_get_portfolio_status_label($status)
    {
        $labels = [
            'under-construction' => esc_html__('Under Construction', 'frameflow'),
            'completed'          => esc_html__('Completed', 'frameflow'),
            'planning'           => esc_html__('Planning', 'frameflow'),
            'sold-out'           => esc_html__('Sold Out', 'frameflow'),
        ];

        return isset($labels[$status]) ? $labels[$status] : '';
    }
}

if (!function_exists('frameflow_pxl_divider_scroll_enabled')) {
    /**
     * Switcher default is yes; only explicit empty (saved off) disables draw.
     *
     * @param array $settings Widget settings.
     */
    function frameflow_pxl_divider_scroll_enabled($settings)
    {
        if (!is_array($settings)) {
            return true;
        }

        if (!array_key_exists('scroll_animation', $settings)) {
            return true;
        }

        return ($settings['scroll_animation'] ?? '') === 'yes';
    }
}

if (!function_exists('frameflow_pxl_divider_scroll_draw_attrs')) {
    /**
     * Build scroll-draw classes/attributes for Case Divider.
     *
     * @param array $settings Widget settings.
     * @return array{class: string[], style: string, data: array<string, string>}
     */
    function frameflow_pxl_divider_scroll_draw_attrs($settings)
    {
        $scroll_animation = frameflow_pxl_divider_scroll_enabled($settings);
        $direction        = $settings['scroll_animation_direction'] ?? 'horizontal';
        $duration         = absint($settings['scroll_animation_duration'] ?? 800);
        $delay_raw        = $settings['scroll_animation_delay'] ?? ($settings['pxl_animate_delay'] ?? '0');
        $delay_ms         = absint(preg_replace('/\D/', '', (string) $delay_raw));

        $classes = ['pxl-el-divider'];

        if (!$scroll_animation) {
            $classes[] = $settings['pxl_animate'] ?? '';
        }

        $data = [];
        $style = '';

        if ($scroll_animation) {
            $is_vertical = in_array($direction, ['vertical', 'vertical-reverse'], true);
            $is_reverse  = in_array($direction, ['horizontal-reverse', 'vertical-reverse'], true);
            $classes[] = 'pxl-el-divider--scroll';
            $classes[] = $is_vertical
                ? 'pxl-el-divider--scroll-v'
                : 'pxl-el-divider--scroll-h';
            if ($is_reverse) {
                $classes[] = 'pxl-el-divider--scroll-reverse';
            }
            $style = sprintf(
                '--pxl-divider-duration:%1$dms;--pxl-divider-delay:%2$dms;',
                max(100, $duration),
                $delay_ms
            );
            $data = [
                'data-scroll-draw' => 'yes',
                'data-scroll-direction' => $direction,
                'data-scroll-duration' => (string) max(100, $duration),
                'data-scroll-delay' => (string) $delay_ms,
            ];
        }

        return [
            'class' => array_values(array_filter($classes)),
            'style' => $style,
            'data'  => $data,
        ];
    }
}

if (!function_exists('frameflow_pxl_divider_scroll_draw_markup')) {
    add_filter('elementor/widget/render_content', 'frameflow_pxl_divider_scroll_draw_markup', 10, 2);
    function frameflow_pxl_divider_scroll_draw_markup($content, $widget)
    {
        if (! is_object($widget) || ! method_exists($widget, 'get_name') || 'pxl_divider' !== $widget->get_name()) {
            return $content;
        }

        if (! is_string($content) || false === strpos($content, 'pxl-el-divider')) {
            return $content;
        }

        $settings = $widget->get_settings_for_display();
        $attrs    = frameflow_pxl_divider_scroll_draw_attrs($settings);

        if (! in_array('pxl-el-divider--scroll', $attrs['class'], true)) {
            return $content;
        }

        if (class_exists('WP_HTML_Tag_Processor')) {
            $processor = new WP_HTML_Tag_Processor($content);

            while ($processor->next_tag()) {
                $class_attr = $processor->get_attribute('class');

                if (! is_string($class_attr) || false === strpos($class_attr, 'pxl-el-divider')) {
                    continue;
                }

                foreach ($attrs['class'] as $class_name) {
                    $processor->add_class($class_name);
                }

                if ($attrs['style'] !== '') {
                    $existing_style = (string) $processor->get_attribute('style');
                    $processor->set_attribute('style', trim($existing_style . $attrs['style']));
                }

                foreach ($attrs['data'] as $attr_name => $attr_value) {
                    $processor->set_attribute($attr_name, $attr_value);
                }

                return $processor->get_updated_html();
            }
        }

        return $content;
    }
}

/**
 * Get post type options
 */
function frameflow_get_post_type_options($pt_supports = [])
{
    $post_types = get_post_types([
        'public' => true,
    ], 'objects');

    $excluded_post_type = [
        'page',
        'attachment',
        'revision',
        'nav_menu_item',
        'custom_css',
        'customize_changeset',
        'oembed_cache',
        'e-landing-page',
        'header',
        'footer',
        'mega-menu',
        'elementor_library'
    ];

    $result = [];

    if (!is_array($post_types)) {
        return $result;
    }

    $filter_by_supports = !empty($pt_supports);

    foreach ($post_types as $post_type) {
        if (!$post_type instanceof WP_Post_Type) {
            continue;
        }

        if (in_array($post_type->name, $excluded_post_type)) {
            continue;
        }

        // If filtering, only include supported types; otherwise include all
        if (!$filter_by_supports || in_array($post_type->name, $pt_supports)) {
            $result[$post_type->name] = $post_type->labels->singular_name;
        }
    }

    return $result;
}



/* Icon render */
function frameflow_elementor_icon_render($settings, $args = [])
{
    $args = wp_parse_args($args, [
        'prefix'     => '',
        'id'         => 'selected_icon',
        'loop'       => false,
        'tag'        => 'div',
        'wrap_class' => '',
        'class'      => '',
        'style'      => '',
        'before'     => '',
        'after'      => '',
        'atts'       => [],
        'animate_data' => '',
        'default_icon'    => [
            'value'   => '',
            'library' => ''
        ],
        'echo' => true
    ]);
    if ($args['loop']) {
        $icon = $args['id'];
    } else {
        $icon = $settings[$args['id']];
    }
    if (empty($icon['value'])) $icon = $args['default_icon'];
    if (empty($icon['value'])) return;

    if ('svg' === $icon['library']) {
        $args['before'] = '<span class="' . $args['wrap_class'] . ' ' . $args['class'] . '" data-settings="' . esc_attr($args['animate_data']) . '">';
        $args['after']  = '</span>';
    }
    ob_start();
    printf('%s', $args['before']);
?>
    <?php \Elementor\Icons_Manager::render_icon($icon, array_merge(
        [
            'aria-hidden' => 'true',
            'class'       => trim(implode(' ', ['pxl-icon', $args['class'], $args['wrap_class']])),
            'style'       => $args['style']
        ],
        $args['atts']
    ), $args['tag']); ?>
    <?php
    printf('%s', $args['after']);

    if ($args['echo']) {
        echo ob_get_clean();
    } else {
        return ob_get_clean();
    }
}

/**
 * Animation List
 */

function frameflow_widget_animate()
{
    $frameflow_animate = array(
        '' => 'None',
        'wow bounce' => 'bounce',
        'wow flash' => 'flash',
        'wow pulse' => 'pulse',
        'wow rubberBand' => 'rubberBand',
        'wow shake' => 'shake',
        'wow swing' => 'swing',
        'wow tada' => 'tada',
        'wow wobble' => 'wobble',
        'wow bounceIn' => 'bounceIn',
        'wow bounceInDown' => 'bounceInDown',
        'wow bounceInLeft' => 'bounceInLeft',
        'wow bounceInRight' => 'bounceInRight',
        'wow bounceInUp' => 'bounceInUp',
        'wow bounceOut' => 'bounceOut',
        'wow bounceOutDown' => 'bounceOutDown',
        'wow bounceOutLeft' => 'bounceOutLeft',
        'wow bounceOutRight' => 'bounceOutRight',
        'wow bounceOutUp' => 'bounceOutUp',
        'wow fadeIn' => 'fadeIn',
        'wow fadeInDown' => 'fadeInDown',
        'wow fadeInDownBig' => 'fadeInDownBig',
        'wow fadeInLeft' => 'fadeInLeft',
        'wow fadeInLeftBig' => 'fadeInLeftBig',
        'wow fadeInRight' => 'fadeInRight',
        'wow fadeInRightBig' => 'fadeInRightBig',
        'wow fadeInUp' => 'fadeInUp',
        'wow fadeInUpBig' => 'fadeInUpBig',
        'wow fadeOut' => 'fadeOut',
        'wow fadeOutDown' => 'fadeOutDown',
        'wow fadeOutDownBig' => 'fadeOutDownBig',
        'wow fadeOutLeft' => 'fadeOutLeft',
        'wow fadeOutLeftBig' => 'fadeOutLeftBig',
        'wow fadeOutRight' => 'fadeOutRight',
        'wow fadeOutRightBig' => 'fadeOutRightBig',
        'wow fadeOutUp' => 'fadeOutUp',
        'wow fadeOutUpBig' => 'fadeOutUpBig',
        'wow flip' => 'flip',
        'wow flipCase' => 'flipCase',
        'wow flipInX' => 'flipInX',
        'wow flipInY' => 'flipInY',
        'wow flipOutX' => 'flipOutX',
        'wow flipOutY' => 'flipOutY',
        'wow lightSpeedIn' => 'lightSpeedIn',
        'wow lightSpeedOut' => 'lightSpeedOut',
        'wow rotateIn' => 'rotateIn',
        'wow rotateInDownLeft' => 'rotateInDownLeft',
        'wow rotateInDownRight' => 'rotateInDownRight',
        'wow rotateInUpLeft' => 'rotateInUpLeft',
        'wow rotateInUpRight' => 'rotateInUpRight',
        'wow rotateOut' => 'rotateOut',
        'wow rotateOutDownLeft' => 'rotateOutDownLeft',
        'wow rotateOutDownRight' => 'rotateOutDownRight',
        'wow rotateOutUpLeft' => 'rotateOutUpLeft',
        'wow rotateOutUpRight' => 'rotateOutUpRight',
        'wow hinge' => 'hinge',
        'wow rollIn' => 'rollIn',
        'wow rollOut' => 'rollOut',
        'wow zoomInSmall' => 'zoomInSmall',
        'wow zoomIn' => 'zoomInBig',
        'wow zoomOut' => 'zoomOut',
        'wow skewIn' => 'skewInLeft',
        'wow skewInRight' => 'skewInRight',
        'wow skewInBottom' => 'skewInBottom',
        'wow RotatingY' => 'RotatingY',
        'wow PXLfadeInUp' => 'PXLfadeInUp',
        'wow fadeInPopup' => 'fadeInPopup',
        'wow PXLZoom' => 'PXLZoom',
        'wow PXLZoom2' => 'PXLZoom2',
    );
    return $frameflow_animate;
}

function frameflow_widget_animate_v2()
{
    $frameflow_animate_v2 = array(
        '' => 'None',
        'wow bounce' => 'bounce',
        'wow flash' => 'flash',
        'wow pulse' => 'pulse',
        'wow rubberBand' => 'rubberBand',
        'wow shake' => 'shake',
        'wow swing' => 'swing',
        'wow tada' => 'tada',
        'wow wobble' => 'wobble',
        'wow bounceIn' => 'bounceIn',
        'wow bounceInDown' => 'bounceInDown',
        'wow bounceInLeft' => 'bounceInLeft',
        'wow bounceInRight' => 'bounceInRight',
        'wow bounceInUp' => 'bounceInUp',
        'wow bounceOut' => 'bounceOut',
        'wow bounceOutDown' => 'bounceOutDown',
        'wow bounceOutLeft' => 'bounceOutLeft',
        'wow bounceOutRight' => 'bounceOutRight',
        'wow bounceOutUp' => 'bounceOutUp',
        'wow fadeIn' => 'fadeIn',
        'wow fadeInDown' => 'fadeInDown',
        'wow fadeInDownBig' => 'fadeInDownBig',
        'wow fadeInLeft' => 'fadeInLeft',
        'wow fadeInLeftBig' => 'fadeInLeftBig',
        'wow fadeInRight' => 'fadeInRight',
        'wow fadeInRightBig' => 'fadeInRightBig',
        'wow fadeInUp' => 'fadeInUp',
        'wow fadeInUpBig' => 'fadeInUpBig',
        'wow fadeOut' => 'fadeOut',
        'wow fadeOutDown' => 'fadeOutDown',
        'wow fadeOutDownBig' => 'fadeOutDownBig',
        'wow fadeOutLeft' => 'fadeOutLeft',
        'wow fadeOutLeftBig' => 'fadeOutLeftBig',
        'wow fadeOutRight' => 'fadeOutRight',
        'wow fadeOutRightBig' => 'fadeOutRightBig',
        'wow fadeOutUp' => 'fadeOutUp',
        'wow fadeOutUpBig' => 'fadeOutUpBig',
        'wow flip' => 'flip',
        'wow flipCase' => 'flipCase',
        'wow flipInX' => 'flipInX',
        'wow flipInY' => 'flipInY',
        'wow flipOutX' => 'flipOutX',
        'wow flipOutY' => 'flipOutY',
        'wow lightSpeedIn' => 'lightSpeedIn',
        'wow lightSpeedOut' => 'lightSpeedOut',
        'wow rotateIn' => 'rotateIn',
        'wow rotateInDownLeft' => 'rotateInDownLeft',
        'wow rotateInDownRight' => 'rotateInDownRight',
        'wow rotateInUpLeft' => 'rotateInUpLeft',
        'wow rotateInUpRight' => 'rotateInUpRight',
        'wow rotateOut' => 'rotateOut',
        'wow rotateOutDownLeft' => 'rotateOutDownLeft',
        'wow rotateOutDownRight' => 'rotateOutDownRight',
        'wow rotateOutUpLeft' => 'rotateOutUpLeft',
        'wow rotateOutUpRight' => 'rotateOutUpRight',
        'wow hinge' => 'hinge',
        'wow rollIn' => 'rollIn',
        'wow rollOut' => 'rollOut',
        'wow zoomInSmall' => 'zoomInSmall',
        'wow zoomIn' => 'zoomInBig',
        'wow zoomOut' => 'zoomOut',
        'wow skewIn' => 'skewInLeft',
        'wow skewInRight' => 'skewInRight',
        'wow RotatingY' => 'RotatingY',
        'wow PXLfadeInUp' => 'PXLfadeInUp',
        'TextOutlineAnimation' => 'Text Outline Animation',
        'pxl-split-text split-in-fade' => 'Slip Text In Fade',
        'pxl-split-text split-in-right' => 'Slip Text In Right',
        'pxl-split-text split-in-left'  => 'Slip Text In Left',
        'pxl-split-text split-in-up'    => 'Slip Text In Up',
        'pxl-split-text split-in-down'  => 'Slip Text In Down',
        'pxl-split-text split-in-rotate'  => 'Slip Text In Rotate',
        'pxl-split-text split-in-scale'  => 'Slip Text In Scale',
        'pxl-split-text split-words-scale'  => 'Split Words Scale',
        'pxl-split-text split-up'  => 'Split Up',
        'pxl-split-text split-lines-transform'  => 'Split Lines Transform',
        'pxl-split-text split-lines-transform-down'  => 'Split Lines Transform Down',
        'pxl-split-text split-lines-rotation-x'  => 'Split Lines Rotation X',
        'pxl-split-text split-words-blur'  => 'Split Words Blur',
        'pxl-split-text split-chars-blur-scroll'  => 'Split Chars Blur Scroll',
        'pxl-split-text btn-text-timeline'  => 'Btn Text Timeline',
        'wow PXLZoom' => 'PXLZoom',
        'wow PXLfadeInUp' => 'PXLfadeInUp',
        'wow PXLZoom2' => 'PXLZoom2',

    );
    return $frameflow_animate_v2;
}

if (!function_exists('frameflow_apply_highlight_animation')) {
    /**
     * Apply Case Animate classes to highlight shortcode spans in HTML.
     */
    function frameflow_apply_highlight_animation($html, $animate, $delay = '0')
    {
        $animate = trim((string) $animate);

        if ($animate === '' || $html === '' || $html === null) {
            return $html;
        }

        $delay_attr = sprintf(
            ' data-wow-delay="%1$dms" data-pxl-animate-delay="%1$dms"',
            absint($delay)
        );

        return preg_replace_callback(
            '/<span\s+class="([^"]*\b(?:pxl-title--highlight|pxl-text--highlight)\b[^"]*)"(\s[^>]*)?>/i',
            static function ($matches) use ($animate, $delay_attr) {
                $classes = trim($matches[1] . ' ' . $animate);
                $rest = $matches[2] ?? '';

                if (strpos($rest, 'data-wow-delay') === false) {
                    $rest = $delay_attr . $rest;
                }

                return '<span class="' . esc_attr($classes) . '"' . $rest . '>';
            },
            $html
        );
    }
}

if (!function_exists('frameflow_widget_color_type')) {
    function frameflow_widget_color_type($args = [])
    {
        $gradient_prefix_class = 'pxl-';
        $gradient_return_value = 'gradient';
        $args = wp_parse_args($args, [
            'label' => '',
            'prefix' => '',
            'selectors_class' => '',
            'condition' => []
        ]);
        $options = array(
            array(
                'name' => $args['prefix'] . '_color_type',
                'label' => esc_html__('Color Type', 'frameflow'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'normal' => 'Normal',
                    'gradient' => 'Gradient',
                ],
                'default' => 'normal',
            ),

            array(
                'name' => $args['prefix'] . '_normal_color',
                'label' => esc_html__('Normal Color', 'frameflow'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $args['selectors_class'] => 'color: {{VALUE}};',
                ],
                'condition' => [
                    $args['prefix'] . '_color_type' => ['normal'],
                ],
            ),

            array(
                'name'        => $args['prefix'] . '_gradient_color',
                'label' => $args['label'] . ' ' . esc_html__('Gradient Color', 'frameflow'),
                'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                'prefix_class' => $gradient_prefix_class,
                'return_value' => $gradient_return_value,
                'condition' => [
                    $args['prefix'] . '_color_type' => ['gradient'],
                ],
            ),
            array(
                'name'        => $args['prefix'] . 'pxl_start_popover',
                'label'       => ucfirst(str_replace('_', '', $args['prefix'])) . ' ' . esc_html__('Start Popover', 'frameflow'),
                'type'        => 'pxl_start_popover',
                'condition'   => $args['condition'],
            ),
            array(
                'name' => $args['prefix'] . '_gradient_color_from',
                'label' => esc_html__('From', 'frameflow'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $args['selectors_class'] => '--gradient-color-from: {{VALUE}};',
                ],
                'condition' => [
                    $args['prefix'] . '_gradient_color!' => '',
                ],
            ),
            array(
                'name' => $args['prefix'] . '_gradient_color_center',
                'label' => esc_html__('Center', 'frameflow'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $args['selectors_class'] => '--gradient-color-center: {{VALUE}};',
                ],
                'condition' => [
                    $args['prefix'] . '_gradient_color!' => '',
                ],
            ),
            array(
                'name' => $args['prefix'] . '_gradient_color_to',
                'label' => esc_html__('To', 'frameflow'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $args['selectors_class'] => '--gradient-color-to: {{VALUE}};',
                ],
                'condition' => [
                    $args['prefix'] . '_gradient_color!' => '',
                ],
            ),
            array(
                'name'        => $args['prefix'] . 'pxl_end_popover',
                'label'       => ucfirst(str_replace('_', '', $args['prefix'])) . ' ' . esc_html__('End Popover', 'frameflow'),
                'type'        => 'pxl_end_popover',
                'condition'   => $args['condition'],
            ),
        );
        return $options;
    }
}

if (!function_exists('frameflow_widget_gradient_color_rotate')) {
    function frameflow_widget_gradient_color_rotate($args = [])
    {
        $gradient_prefix_class = 'pxl-';
        $gradient_return_value = 'gradient';
        $args = wp_parse_args($args, [
            'label' => '',
            'prefix' => '',
            'selectors_class' => '',
            'condition' => []
        ]);
        $options = array(
            array(
                'name'        => $args['prefix'] . '_gradient_color',
                'label' => $args['label'] . ' ' . esc_html__('Gradient Color', 'frameflow'),
                'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                'prefix_class' => $gradient_prefix_class,
                'return_value' => $gradient_return_value,
                'condition'   => $args['condition'],
            ),
            array(
                'name'        => $args['prefix'] . 'pxl_start_popover',
                'label'       => ucfirst(str_replace('_', '', $args['prefix'])) . ' ' . esc_html__('Start Popover', 'frameflow'),
                'type'        => 'pxl_start_popover',
                'condition'   => $args['condition'],
            ),
            array(
                'name' => $args['prefix'] . '_gradient_color_from',
                'label' => esc_html__('From', 'frameflow'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $args['selectors_class'] => '--gradient-color-from: {{VALUE}};',
                ],
                'condition' => [
                    $args['prefix'] . '_gradient_color!' => '',
                ],
            ),
            array(
                'name' => $args['prefix'] . '_gradient_color_to',
                'label' => esc_html__('To', 'frameflow'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $args['selectors_class'] => '--gradient-color-to: {{VALUE}};',
                ],
                'condition' => [
                    $args['prefix'] . '_gradient_color!' => '',
                ],
            ),
            array(
                'name' => $args['prefix'] . '_gradient_angle',
                'label' => esc_html__('Angle', 'frameflow'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 360,
                        'step' => 10,
                    ],
                ],
            ),
            array(
                'name'        => $args['prefix'] . 'pxl_end_popover',
                'label'       => ucfirst(str_replace('_', '', $args['prefix'])) . ' ' . esc_html__('End Popover', 'frameflow'),
                'type'        => 'pxl_end_popover',
                'condition'   => $args['condition'],
            ),
        );
        return $options;
    }
}
function frameflow_get_img_link_url($settings)
{
    if ('none' === $settings['link_to']) {
        return false;
    }

    if ('custom' === $settings['link_to']) {
        if (empty($settings['link']['url'])) {
            return false;
        }

        return $settings['link'];
    }

    return [
        'url' => $settings['image']['url'],
    ];
}

if (!function_exists('frameflow_widget_allowed_title_tags')) {
    function frameflow_widget_allowed_title_tags()
    {
        return ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'span', 'div'];
    }
}

if (!function_exists('frameflow_widget_sanitize_title_tag')) {
    function frameflow_widget_sanitize_title_tag($tag, $default = 'h3')
    {
        return in_array($tag, frameflow_widget_allowed_title_tags(), true) ? $tag : $default;
    }
}

if (!function_exists('frameflow_widget_normalize_columns')) {
    function frameflow_widget_normalize_columns($settings, $defaults = [], $min = 1, $max = 6)
    {
        $defaults = wp_parse_args($defaults, [
            'xs'  => 1,
            'sm'  => 2,
            'md'  => 2,
            'lg'  => 3,
            'xl'  => 4,
            'xxl' => 4,
        ]);

        $columns = [];

        foreach ($defaults as $breakpoint => $default) {
            $setting_key = 'col_' . $breakpoint;
            $value       = isset($settings[$setting_key]) ? intval($settings[$setting_key]) : intval($default);
            $columns[$breakpoint] = max($min, min($max, $value));
        }

        return $columns;
    }
}

if (!function_exists('frameflow_widget_inline_css_vars')) {
    function frameflow_widget_inline_css_vars($vars)
    {
        if (!is_array($vars) || empty($vars)) {
            return '';
        }

        $declarations = [];

        foreach ($vars as $name => $value) {
            if ($name === '' || $value === null || $value === '') {
                continue;
            }

            $declarations[] = sprintf('%s: %s', $name, $value);
        }

        return implode('; ', $declarations);
    }
}
if (!function_exists('pxl_get_post_taxonomy')) {
    function pxl_get_post_taxonomy($taxonomy_name)
    {
        $taxonomy = $taxonomy_name;

        $term_list = array();

        $terms = get_terms(
            array(
                'taxonomy' => $taxonomy,
                'hide_empty' => true,
            )
        );

        foreach ($terms as $term) {
            $term_list[$term->slug] = $term->name;
        }

        return $term_list;
    }
}

/**
 * Get terms options for select controls
 */
if (!function_exists('pxl_get_terms_options')) {
    function pxl_get_terms_options($taxonomy, $args = array())
    {
        $defaults = array(
            'hide_empty' => false,
            'orderby' => 'name',
            'order' => 'ASC'
        );
        $args = wp_parse_args($args, $defaults);

        $terms = get_terms($taxonomy, $args);
        $options = array();

        if (!is_wp_error($terms) && !empty($terms)) {
            foreach ($terms as $term) {
                $options[$term->term_id] = $term->name;
            }
        }

        return $options;
    }
}

/**
 * Get posts options for select controls
 */
if (!function_exists('pxl_get_posts_options')) {
    function pxl_get_posts_options($post_type, $args = array())
    {
        $defaults = array(
            'post_type' => $post_type,
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'orderby' => 'title',
            'order' => 'ASC'
        );
        $args = wp_parse_args($args, $defaults);

        $posts = get_posts($args);
        $options = array();

        if (!empty($posts)) {
            foreach ($posts as $post) {
                $options[$post->ID] = $post->post_title;
            }
        }

        return $options;
    }
}
