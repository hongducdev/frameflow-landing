<?php
$html_id = pxl_get_element_id($settings);
$icon_type = !empty($settings['icon_type']) ? $settings['icon_type'] : 'icon';
$grad_id = $html_id . '-arc-grad';

$wrapper_class = trim(
    'pxl-icon-pulse ' .
    (isset($settings['pxl_animate']) ? $settings['pxl_animate'] : '')
);
$animate_delay = isset($settings['pxl_animate_delay']) && $settings['pxl_animate_delay'] !== ''
    ? $settings['pxl_animate_delay']
    : '0';
?>
<div id="<?php echo esc_attr($html_id); ?>" class="<?php echo esc_attr($wrapper_class); ?>" data-wow-delay="<?php echo esc_attr($animate_delay); ?>ms">
    <span class="pxl-icon-pulse--rings" aria-hidden="true">
        <span class="pxl-icon-pulse--ring pxl-icon-pulse--ring-1"></span>
        <span class="pxl-icon-pulse--ring pxl-icon-pulse--ring-2"></span>
    </span>
    <span class="pxl-icon-pulse--inner">
        <svg class="pxl-icon-pulse--progress" viewBox="0 0 100 100" aria-hidden="true" focusable="false">
            <defs>
                <linearGradient id="<?php echo esc_attr($grad_id); ?>" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" style="stop-color: var(--pulse-arc-color-1, #1FAF5A)" />
                    <stop offset="100%" style="stop-color: var(--pulse-arc-color-2, #7CFF4A)" />
                </linearGradient>
            </defs>
            <circle class="pxl-icon-pulse--track" cx="50" cy="50" r="42" />
            <circle class="pxl-icon-pulse--arc" cx="50" cy="50" r="42" stroke="url(#<?php echo esc_attr($grad_id); ?>)" />
        </svg>
        <span class="pxl-icon-pulse--icon">
            <?php if ($icon_type === 'icon' && !empty($settings['pxl_icon']['value'])) : ?>
                <?php \Elementor\Icons_Manager::render_icon($settings['pxl_icon'], ['aria-hidden' => 'true']); ?>
            <?php elseif ($icon_type === 'image' && !empty($settings['icon_image']['id'])) : ?>
                <?php
                $img = pxl_get_image_by_size([
                    'attach_id' => $settings['icon_image']['id'],
                    'thumb_size' => 'full',
                ]);
                echo pxl_print_html($img['thumbnail']);
                ?>
            <?php endif; ?>
        </span>
    </span>
</div>
