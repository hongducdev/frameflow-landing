<?php

if (!defined('ABSPATH')) {
    exit();
}

class Frameflow_Admin_Widget_Usage extends Frameflow_Admin_Page
{
    protected $id = null;
    protected $page_title = null;
    protected $menu_title = null;
    public $parent = null;

    public function __construct()
    {
        $this->id = 'pxlart-widget-usage';
        $this->page_title = esc_html__('Widget Usage', 'frameflow');
        $this->menu_title = esc_html__('Widget Usage', 'frameflow');
        $this->parent = 'pxlart';

        parent::__construct();
    }

    public function display()
    {
        include_once get_template_directory() . '/inc/admin/views/admin-widget-usage.php';
    }
}

new Frameflow_Admin_Widget_Usage();

/**
 * Widget names registered by this theme.
 */
function frameflow_get_theme_widget_names()
{
    static $names = null;

    if (null !== $names) {
        return $names;
    }

    $names = [];
    $widgets_dir = get_template_directory() . '/elements/widgets';

    if (is_dir($widgets_dir)) {
        foreach (glob($widgets_dir . '/*.php') ?: [] as $widget_file) {
            $names[] = basename($widget_file, '.php');
        }
    }

    sort($names);

    return $names;
}

/**
 * Scan Elementor documents and count widget instances.
 *
 * @return array{
 *     usage: array<string, array{instances: int, documents: array<int, array{id: int, title: string, type: string, status: string, count: int}>}>,
 *     document_count: int
 * }
 */
function frameflow_get_elementor_widget_usage_report()
{
    static $report = null;

    if (null !== $report) {
        return $report;
    }

    global $wpdb;

    $rows = $wpdb->get_results(
        "
        SELECT pm.post_id, pm.meta_value, p.post_title, p.post_type, p.post_status
        FROM {$wpdb->postmeta} pm
        INNER JOIN {$wpdb->posts} p ON p.ID = pm.post_id
        WHERE pm.meta_key = '_elementor_data'
          AND pm.meta_value != ''
          AND p.post_type != 'revision'
          AND p.post_status NOT IN ('trash', 'auto-draft', 'inherit')
        ",
    );

    $usage = [];
    $document_count = 0;

    foreach ((array) $rows as $row) {
        $elements = json_decode($row->meta_value, true);
        if (!is_array($elements)) {
            continue;
        }

        $widget_names = [];
        frameflow_collect_elementor_widget_names($elements, $widget_names);
        if (empty($widget_names)) {
            continue;
        }

        $document_count++;
        $counts = array_count_values($widget_names);

        foreach ($counts as $widget_name => $count) {
            if (!isset($usage[$widget_name])) {
                $usage[$widget_name] = [
                    'instances' => 0,
                    'documents' => [],
                ];
            }

            $usage[$widget_name]['instances'] += (int) $count;
            $usage[$widget_name]['documents'][] = [
                'id' => (int) $row->post_id,
                'title' =>
                    $row->post_title !== ''
                        ? $row->post_title
                        : sprintf(__('#%d', 'frameflow'), $row->post_id),
                'type' => $row->post_type,
                'status' => $row->post_status,
                'count' => (int) $count,
            ];
        }
    }

    ksort($usage);

    $report = [
        'usage' => $usage,
        'document_count' => $document_count,
    ];

    return $report;
}

/**
 * Merge theme widget list with usage counts and apply a view filter.
 *
 * @param string $view theme|unused|all
 * @return array<int, array{name: string, title: string, is_theme: bool, instances: int, documents: array}>
 */
function frameflow_get_elementor_widget_usage_rows($view = 'theme')
{
    $report = frameflow_get_elementor_widget_usage_report();
    $usage = $report['usage'];
    $theme_widgets = frameflow_get_theme_widget_names();
    $theme_lookup = array_fill_keys($theme_widgets, true);
    $titles = frameflow_get_elementor_widget_titles(
        array_values(array_unique(array_merge(array_keys($usage), $theme_widgets))),
    );
    $rows = [];

    $widget_names = 'all' === $view ? array_keys($usage) : $theme_widgets;

    foreach ($widget_names as $widget_name) {
        $item = $usage[$widget_name] ?? [
            'instances' => 0,
            'documents' => [],
        ];

        if ('unused' === $view && $item['instances'] > 0) {
            continue;
        }

        $rows[] = [
            'name' => $widget_name,
            'title' => $titles[$widget_name] ?? $widget_name,
            'is_theme' => isset($theme_lookup[$widget_name]),
            'instances' => (int) $item['instances'],
            'documents' => $item['documents'],
        ];
    }

    usort($rows, static function ($a, $b) {
        if ($a['instances'] === $b['instances']) {
            return strcasecmp($a['name'], $b['name']);
        }

        return $b['instances'] <=> $a['instances'];
    });

    return $rows;
}

/**
 * Resolve Elementor widget titles when the plugin is available.
 *
 * @param array<int, string> $widget_names
 * @return array<string, string>
 */
function frameflow_get_elementor_widget_titles($widget_names)
{
    $titles = [];

    foreach ($widget_names as $widget_name) {
        $titles[$widget_name] = $widget_name;
    }

    $elementor = class_exists('\Elementor\Plugin') ? \Elementor\Plugin::$instance : null;
    if (!$elementor || empty($elementor->widgets_manager)) {
        return $titles;
    }

    $types = $elementor->widgets_manager->get_widget_types();

    foreach ($widget_names as $widget_name) {
        if (isset($types[$widget_name])) {
            $titles[$widget_name] = $types[$widget_name]->get_title();
        }
    }

    return $titles;
}
