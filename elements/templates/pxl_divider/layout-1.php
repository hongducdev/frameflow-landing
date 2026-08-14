<?php
if (
    !empty($widget) &&
    is_object($widget) &&
    method_exists($widget, 'get_settings_for_display')
) {
    $settings = $widget->get_settings_for_display();
}
$settings = isset($settings) && is_array($settings) ? $settings : [];
$attrs    = frameflow_pxl_divider_scroll_draw_attrs($settings);
$delay    = absint($settings['pxl_animate_delay'] ?? 0) . 'ms';
?>
<div class="<?php echo esc_attr(implode(' ', $attrs['class'])); ?>" data-wow-delay="<?php echo esc_attr($delay); ?>"<?php
if ($attrs['style'] !== '') {
    echo ' style="' . esc_attr($attrs['style']) . '"';
}
foreach ($attrs['data'] as $attr_name => $attr_value) {
    echo ' ' . esc_attr($attr_name) . '="' . esc_attr($attr_value) . '"';
}
?>></div>
