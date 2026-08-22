<?php
if (!defined('ABSPATH')) {
    exit();
}

/**
 * Per-widget CSS loader for Elementor widgets.
 *
 * Frontend first attempts to load CSS from the current Elementor documents.
 * A frontend Elementor hook then provides a full fallback for templates or
 * cached output that are not discoverable during wp_enqueue_scripts.
 */

function frameflow_widget_style_overrides()
{
    return [
        'pxl_icon_box_carousel' => 'pxl_icon_box',
        'pxl_post' => 'pxl_post',
    ];
}

function frameflow_widget_style_map()
{
    static $map = null;

    if (null !== $map) {
        return $map;
    }

    $map = [];
    $widgets_dir = get_template_directory() . '/elements/widgets';
    $styles_dir = get_template_directory() . '/assets/css/elements';

    if (is_dir($widgets_dir) && is_dir($styles_dir)) {
        foreach (glob($widgets_dir . '/*.php') ?: [] as $widget_file) {
            $widget_name = basename($widget_file, '.php');
            $default_file = $styles_dir . '/' . $widget_name . '.min.css';

            if (is_file($default_file)) {
                $map[$widget_name] = $widget_name;
            }
        }
    }

    $map = array_merge($map, frameflow_widget_style_overrides());

    return $map;
}

function frameflow_widget_style_handles()
{
    return array_values(array_unique(array_values(frameflow_widget_style_map())));
}

function frameflow_is_widget_style_handle($handle)
{
    return in_array($handle, frameflow_widget_style_handles(), true);
}

add_action('wp_enqueue_scripts', 'frameflow_register_widget_styles', 5);
add_action('elementor/frontend/after_register_styles', 'frameflow_register_widget_styles', 5);
function frameflow_register_widget_styles()
{
    $version = wp_get_theme(get_template())->get('Version');
    $base_uri = get_template_directory_uri() . '/assets/css/elements/';

    foreach (frameflow_widget_style_handles() as $handle) {
        if (wp_style_is($handle, 'registered')) {
            continue;
        }

        $file = $handle . '.min.css';
        wp_register_style($handle, $base_uri . $file, ['pxl-style'], $version);
    }
}

function frameflow_enqueue_widget_style_handle($handle)
{
    if (!frameflow_is_widget_style_handle($handle)) {
        return false;
    }

    if (!wp_style_is($handle, 'registered')) {
        frameflow_register_widget_styles();
    }

    wp_enqueue_style($handle);

    return true;
}

function frameflow_enqueue_all_widget_styles()
{
    foreach (frameflow_widget_style_handles() as $handle) {
        frameflow_enqueue_widget_style_handle($handle);
    }
}

/**
 * Styles that must always be available, even without widget render.
 * Useful for utility classes reused in templates/shortcodes.
 */
function frameflow_widget_always_enqueue_styles()
{
    return apply_filters('frameflow_widget_always_enqueue_styles', ['pxl_button', 'pxl_post']);
}

add_action('wp_enqueue_scripts', 'frameflow_enqueue_always_widget_styles', 20);
function frameflow_enqueue_always_widget_styles()
{
    foreach (frameflow_widget_always_enqueue_styles() as $handle) {
        frameflow_enqueue_widget_style_handle($handle);
    }
}

/**
 * Utility class to stylesheet-handle map for class-based loading.
 */
function frameflow_widget_style_class_map()
{
    return apply_filters('frameflow_widget_style_class_map', [
        'button' => 'pxl_button',
        'btn' => 'pxl_button',
        'btn-stroke' => 'pxl_button',
        'btn-submit' => 'pxl_button',
    ]);
}

/**
 * Collect page markup sources used for class detection.
 */
function frameflow_get_style_detection_sources()
{
    if (!is_singular()) {
        return [];
    }

    $post = get_queried_object();
    if (!($post instanceof WP_Post)) {
        return [];
    }

    $sources = [];

    if (!empty($post->post_content)) {
        $sources[] = $post->post_content;
    }

    $elementor_data = get_post_meta($post->ID, '_elementor_data', true);
    if (is_string($elementor_data) && $elementor_data !== '') {
        $sources[] = $elementor_data;
    }

    return $sources;
}

/**
 * Collect Elementor widget names from an Elementor data tree.
 */
function frameflow_collect_elementor_widget_names($elements, &$widget_names)
{
    if (!is_array($elements)) {
        return;
    }

    foreach ($elements as $element) {
        if (!is_array($element)) {
            continue;
        }

        if (
            isset($element['elType']) &&
            'widget' === $element['elType'] &&
            !empty($element['widgetType'])
        ) {
            $widget_names[] = $element['widgetType'];
        }

        if (!empty($element['elements']) && is_array($element['elements'])) {
            frameflow_collect_elementor_widget_names($element['elements'], $widget_names);
        }
    }
}

/**
 * Return Elementor widget names declared in a document's stored data.
 */
function frameflow_get_elementor_widget_names_from_document($post_id)
{
    static $cache = [];

    $post_id = absint($post_id);
    if ($post_id <= 0) {
        return [];
    }

    if (isset($cache[$post_id])) {
        return $cache[$post_id];
    }

    $raw_elementor_data = get_post_meta($post_id, '_elementor_data', true);
    if (!is_string($raw_elementor_data) || '' === $raw_elementor_data) {
        $cache[$post_id] = [];

        return $cache[$post_id];
    }

    $elements = json_decode($raw_elementor_data, true);
    if (!is_array($elements)) {
        $cache[$post_id] = [];

        return $cache[$post_id];
    }

    $widget_names = [];
    frameflow_collect_elementor_widget_names($elements, $widget_names);

    $cache[$post_id] = array_values(array_unique($widget_names));

    return $cache[$post_id];
}

/**
 * Enqueue widget styles for a specific Elementor document.
 */
function frameflow_enqueue_widget_styles_for_document($post_id)
{
    $map = frameflow_widget_style_map();
    $widget_names = frameflow_get_elementor_widget_names_from_document($post_id);

    foreach ($widget_names as $widget_name) {
        if (isset($map[$widget_name])) {
            frameflow_enqueue_widget_style_handle($map[$widget_name]);
        }
    }
}

/**
 * Collect Elementor document IDs rendered by the current frontend request.
 */
function frameflow_get_frontend_elementor_document_ids()
{
    static $document_ids = null;

    if (null !== $document_ids) {
        return $document_ids;
    }

    $document_ids = [];

    if (is_singular()) {
        $post = get_queried_object();
        if ($post instanceof WP_Post) {
            $document_ids[] = (int) $post->ID;
        }
    }

    $document_ids = array_merge(
        $document_ids,
        array_filter(
            array_map('intval', [
                frameflow()->get_opt('header_layout'),
                frameflow()->get_opt('header_layout_sticky'),
                frameflow()->get_opt('header_sticky_layout'),
                frameflow()->get_opt('header_mobile_layout'),
                frameflow_get_active_footer_layout(),
                frameflow()->get_theme_opt('ptitle_layout'),
                frameflow()->get_theme_opt('subscribe_layout'),
            ]),
        ),
    );

    if (function_exists('frameflow_get_mega_menu_builder_id')) {
        $document_ids = array_merge(
            $document_ids,
            array_map('intval', (array) frameflow_get_mega_menu_builder_id()),
        );
    }

    if (function_exists('frameflow_get_page_popup_builder_id')) {
        $document_ids = array_merge(
            $document_ids,
            array_map('intval', (array) frameflow_get_page_popup_builder_id()),
        );
    }

    if (function_exists('frameflow_get_templates_slug')) {
        foreach ((array) frameflow_get_templates_slug('popup') as $template) {
            if (!empty($template['post_id'])) {
                $document_ids[] = (int) $template['post_id'];
            }
        }
    }

    $document_ids = array_merge(
        $document_ids,
        array_map('intval', (array) apply_filters('pxl_theme_builder_layout_ids', [])),
    );

    $document_ids = apply_filters('frameflow_widget_style_document_ids', $document_ids);

    $document_ids = array_values(array_unique(array_filter(array_map('absint', $document_ids))));

    return $document_ids;
}

function frameflow_is_elementor_preview_request()
{
    return !is_admin() && isset($_GET['elementor-preview']);
}

/**
 * Enqueue widget styles from stored Elementor document data.
 *
 * This runs during script enqueue to avoid missing styles when frontend
 * output is served from Elementor cache and widget render hooks are skipped.
 */
add_action('wp_enqueue_scripts', 'frameflow_enqueue_widget_styles_from_elementor_data', 22);
function frameflow_enqueue_widget_styles_from_elementor_data()
{
    if (frameflow_is_elementor_preview_request()) {
        frameflow_enqueue_all_widget_styles();

        return;
    }

    $document_ids = frameflow_get_frontend_elementor_document_ids();

    if (frameflow_widget_lazy_load_enabled()) {
        $eager_ids = frameflow_get_eager_widget_style_document_ids();
        $document_ids = array_values(array_intersect($document_ids, $eager_ids));
    }

    foreach ($document_ids as $document_id) {
        frameflow_enqueue_widget_styles_for_document($document_id);
    }
}

add_action('wp_enqueue_scripts', 'frameflow_enqueue_widget_styles_by_class_usage', 25);
function frameflow_enqueue_widget_styles_by_class_usage()
{
    $class_map = frameflow_widget_style_class_map();
    if (empty($class_map)) {
        return;
    }

    $sources = frameflow_get_style_detection_sources();
    if (empty($sources)) {
        return;
    }

    foreach ($class_map as $class_name => $handle) {
        if (!frameflow_is_widget_style_handle($handle)) {
            continue;
        }

        $pattern = '/(?:^|\\s)' . preg_quote($class_name, '/') . '(?:\\s|$)/';

        foreach ($sources as $source) {
            if (preg_match($pattern, $source)) {
                frameflow_enqueue_widget_style_handle($handle);
                break;
            }
        }
    }
}

add_action('elementor/frontend/widget/before_render', 'frameflow_enqueue_widget_style_on_demand');
function frameflow_enqueue_widget_style_on_demand($widget)
{
    if (
        frameflow_widget_lazy_load_enabled() &&
        !frameflow_is_current_elementor_document_eager()
    ) {
        return;
    }

    $widget_name = $widget->get_name();
    $map = frameflow_widget_style_map();

    if (isset($map[$widget_name])) {
        frameflow_enqueue_widget_style_handle($map[$widget_name]);
    }
}

add_action(
    'elementor/editor/after_enqueue_styles',
    'frameflow_enqueue_all_widget_styles_in_editor',
);
add_action('elementor/preview/enqueue_styles', 'frameflow_enqueue_all_widget_styles_in_editor');
function frameflow_enqueue_all_widget_styles_in_editor()
{
    frameflow_enqueue_all_widget_styles();
}

add_action(
    'elementor/frontend/after_enqueue_styles',
    'frameflow_enqueue_widget_styles_frontend_fallback',
    20,
);
function frameflow_enqueue_widget_styles_frontend_fallback()
{
    if (is_admin()) {
        return;
    }

    if (frameflow_widget_lazy_load_enabled()) {
        return;
    }

    frameflow_enqueue_all_widget_styles();
}

function frameflow_widget_lazy_load_enabled()
{
    if (is_admin() || wp_doing_ajax() || frameflow_is_elementor_preview_request()) {
        return false;
    }

    if (isset($_GET['elementor-preview'])) {
        return false;
    }

    return (bool) apply_filters('frameflow_widget_lazy_load_enabled', true);
}

function frameflow_get_eager_widget_style_document_ids()
{
    static $ids = null;

    if (null !== $ids) {
        return $ids;
    }

    $ids = array_filter(
        array_map('intval', [
            frameflow()->get_opt('header_layout'),
            frameflow()->get_opt('header_layout_sticky'),
            frameflow()->get_opt('header_sticky_layout'),
            frameflow()->get_opt('header_mobile_layout'),
            frameflow()->get_theme_opt('ptitle_layout'),
        ]),
    );

    if (function_exists('frameflow_get_mega_menu_builder_id')) {
        $ids = array_merge($ids, array_map('intval', (array) frameflow_get_mega_menu_builder_id()));
    }

    if (function_exists('frameflow_get_page_popup_builder_id')) {
        $ids = array_merge($ids, array_map('intval', (array) frameflow_get_page_popup_builder_id()));
    }

    if (function_exists('frameflow_get_templates_slug')) {
        foreach ((array) frameflow_get_templates_slug('popup') as $template) {
            if (!empty($template['post_id'])) {
                $ids[] = (int) $template['post_id'];
            }
        }
    }

    $ids = array_values(array_unique(array_filter(array_map('absint', $ids))));

    return apply_filters('frameflow_eager_widget_style_document_ids', $ids);
}

function frameflow_get_current_elementor_document_id()
{
    if (!class_exists('\Elementor\Plugin')) {
        return 0;
    }

    $document = \Elementor\Plugin::$instance->documents->get_current();
    if (!$document) {
        return 0;
    }

    return (int) $document->get_main_id();
}

function frameflow_is_current_elementor_document_eager()
{
    $document_id = frameflow_get_current_elementor_document_id();
    if ($document_id <= 0) {
        return false;
    }

    return in_array($document_id, frameflow_get_eager_widget_style_document_ids(), true);
}

function frameflow_get_registered_style_src($handle)
{
    $styles = wp_styles();
    if (!isset($styles->registered[$handle])) {
        return '';
    }

    $src = $styles->registered[$handle]->src;
    if (!$src) {
        return '';
    }

    $ver = $styles->registered[$handle]->ver;
    if ($ver) {
        $src = add_query_arg('ver', $ver, $src);
    }

    return $src;
}

function frameflow_get_registered_script_src($handle)
{
    $scripts = wp_scripts();
    if (!isset($scripts->registered[$handle])) {
        return '';
    }

    $src = $scripts->registered[$handle]->src;
    if (!$src) {
        return '';
    }

    if (!preg_match('#^(https?:)?//#', $src)) {
        $src = $scripts->base_url . $src;
    }

    $ver = $scripts->registered[$handle]->ver;
    if ($ver) {
        $src = add_query_arg('ver', $ver, $src);
    }

    return $src;
}

function frameflow_get_widget_lazy_style_src($widget_name)
{
    $map = frameflow_widget_style_map();
    if (!isset($map[$widget_name])) {
        return '';
    }

    $handle = $map[$widget_name];
    if (in_array($handle, frameflow_widget_always_enqueue_styles(), true)) {
        return '';
    }

    if (!wp_style_is($handle, 'registered')) {
        frameflow_register_widget_styles();
    }

    return frameflow_get_registered_style_src($handle);
}

function frameflow_is_lazy_widget_script_handle($handle)
{
    $skip = apply_filters('frameflow_lazy_widget_script_skip', [
        'jquery',
        'jquery-core',
        'jquery-migrate',
        'gsap',
        'pxl-scroll-trigger',
        'pxl-splitText',
        'pxl-bundled-lenis',
        'pxl-matter',
        'pxl-marquee-helpers',
        'pxl-carousel-helpers',
        'frameflow-client-marquee',
        'frameflow-image-marquee',
        'frameflow-text-marquee',
        'frameflow-testimonial-marquee',
        'frameflow-elementor',
        'frameflow-distortion',
        'elementor-frontend',
        'elementor-webpack-runtime',
    ]);

    if (in_array($handle, $skip, true)) {
        return false;
    }

    return (bool) apply_filters('frameflow_is_lazy_widget_script_handle', true, $handle);
}

function frameflow_enqueue_kept_script_dependencies($handle)
{
    $scripts = wp_scripts();
    if (!is_string($handle) || $handle === '' || !isset($scripts->registered[$handle])) {
        return;
    }

    foreach ((array) $scripts->registered[$handle]->deps as $dep) {
        if (!is_string($dep) || $dep === '') {
            continue;
        }

        frameflow_enqueue_kept_script_dependencies($dep);

        if (!frameflow_is_lazy_widget_script_handle($dep) && wp_script_is($dep, 'registered')) {
            wp_enqueue_script($dep);
        }
    }
}

function frameflow_remember_widget_script_handles($handles, $eager)
{
    if (!isset($GLOBALS['frameflow_lazy_widget_script_handles'])) {
        $GLOBALS['frameflow_lazy_widget_script_handles'] = [
            'eager' => [],
            'lazy' => [],
        ];
    }

    $key = $eager ? 'eager' : 'lazy';

    foreach ((array) $handles as $handle) {
        if (!is_string($handle) || $handle === '' || !frameflow_is_lazy_widget_script_handle($handle)) {
            continue;
        }
        $GLOBALS['frameflow_lazy_widget_script_handles'][$key][$handle] = $handle;
    }
}

add_action('elementor/element/after_add_attributes', 'frameflow_mark_lazy_widget_assets', 20);
function frameflow_mark_lazy_widget_assets($element)
{
    if (!($element instanceof \Elementor\Widget_Base)) {
        return;
    }

    if (!frameflow_widget_lazy_load_enabled()) {
        return;
    }

    $script_handles = method_exists($element, 'get_script_depends')
        ? (array) $element->get_script_depends()
        : [];

    $eager = frameflow_is_current_elementor_document_eager();
    frameflow_remember_widget_script_handles($script_handles, $eager);

    if ($eager) {
        return;
    }

    $css = frameflow_get_widget_lazy_style_src($element->get_name());
    $scripts = [];

    foreach ($script_handles as $handle) {
        frameflow_enqueue_kept_script_dependencies($handle);

        if (!frameflow_is_lazy_widget_script_handle($handle)) {
            if (wp_script_is($handle, 'registered')) {
                wp_enqueue_script($handle);
            }
            continue;
        }
        $src = frameflow_get_registered_script_src($handle);
        if ($src) {
            $scripts[] = $src;
        }
    }

    $scripts = array_values(array_unique($scripts));

    if ($css === '' && empty($scripts)) {
        return;
    }

    $element->add_render_attribute('_wrapper', 'class', 'pxl-lazy-widget');

    if ($css !== '') {
        $element->add_render_attribute('_wrapper', 'data-pxl-css', esc_url($css));
    }

    if (!empty($scripts)) {
        $element->add_render_attribute('_wrapper', 'data-pxl-js', wp_json_encode($scripts));
    }
}

add_action('wp_print_footer_scripts', 'frameflow_dequeue_lazy_widget_scripts', 1);
function frameflow_dequeue_lazy_widget_scripts()
{
    if (!frameflow_widget_lazy_load_enabled()) {
        return;
    }

    $store = isset($GLOBALS['frameflow_lazy_widget_script_handles'])
        ? $GLOBALS['frameflow_lazy_widget_script_handles']
        : ['eager' => [], 'lazy' => []];

    $handles = array_diff_key($store['lazy'], $store['eager']);

    foreach ($handles as $handle) {
        wp_dequeue_script($handle);
    }
}

