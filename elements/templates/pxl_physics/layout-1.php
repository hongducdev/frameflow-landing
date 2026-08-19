<?php
$allowed_bg = ['primary', 'secondary'];

$raw_rows = isset($settings['texts']) && is_array($settings['texts']) ? $settings['texts'] : [];
$display_rows = [];
if (!empty($widget) && is_object($widget) && method_exists($widget, 'get_settings_for_display')) {
    $dr = $widget->get_settings_for_display('texts');
    $display_rows = is_array($dr) ? $dr : [];
}
$row_count = max(count($raw_rows), count($display_rows));
$text_rows = [];
for ($i = 0; $i < $row_count; $i++) {
    $r = isset($raw_rows[$i]) && is_array($raw_rows[$i]) ? $raw_rows[$i] : [];
    $d = isset($display_rows[$i]) && is_array($display_rows[$i]) ? $display_rows[$i] : [];
    $text_rows[] = array_replace_recursive($r, $d);
}

$list_icon = [];
$list_labels = [];
$list_bgs = [];

if (!empty($text_rows)):

    foreach ($text_rows as $value) {
        if (!is_array($value)) {
            $value = [];
        }

        $list_icon[] = $value['pxl_icon'] ?? '';
        $list_labels[] = isset($value['text']) ? (string) $value['text'] : '';

        $from = isset($value['gradient_from']) ? trim((string) $value['gradient_from']) : '';
        $to = isset($value['gradient_to']) ? trim((string) $value['gradient_to']) : '';
        $type = isset($value['background_type']) ? (string) $value['background_type'] : '';
        if ($type === '') {
            $type = $from !== '' || $to !== '' ? 'gradient' : 'theme';
        }

        if ($type === 'gradient') {
            $list_bgs[] = [
                'type' => 'gradient',
                'from' => $from,
                'to' => $to !== '' ? $to : $from,
            ];
            continue;
        }

        $slug = isset($value['background_color']) ? (string) $value['background_color'] : 'primary';
        $slug = trim($slug);
        if (!in_array($slug, $allowed_bg, true)) {
            $slug = 'primary';
        }
        $list_bgs[] = [
            'type' => 'theme',
            'slug' => $slug,
        ];
    }
    $widget->add_render_attribute('lists_text', [
        'class' => 'pxl-physics pxl-physics-item',
        'data-icons' => wp_json_encode($list_icon, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
        'data-labels' => wp_json_encode(
            $list_labels,
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES,
        ),
        'data-bgs' => wp_json_encode($list_bgs, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
    ]);
    ?>
    <div <?php pxl_print_html($widget->get_render_attribute_string('lists_text')); ?>>
    </div>
<?php
endif; ?>
