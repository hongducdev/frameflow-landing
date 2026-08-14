<?php
$style_class = $settings['style'] ?? 'default';
$sub_style_class = '';

if (in_array($style_class, ['default', 'style-1'], true)) {
    $sub_style_class = $settings['sub_style'] ?? '';
} elseif ($style_class === 'style-3') {
    $sub_style_class = $settings['sub_style_3'] ?? '';
} elseif ($style_class === 'style-6') {
    $sub_style_class = $settings['sub_style_6'] ?? '';
}

$list_classes = trim('pxl-list pxl-list1 ' . ($settings['pxl_animate'] ?? '') . ' ' . $style_class . ' ' . $sub_style_class);
?>
<?php if (isset($settings['lists']) && !empty($settings['lists']) && count($settings['lists'])): ?>
    <ul class="<?php echo esc_attr($list_classes); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
        <?php foreach ($settings['lists'] as $key => $value): ?>
            <li class="pxl-item">
                <?php if (!empty($settings['pxl_icon']['value'])) : ?>
                    <div class="pxl-item--icon">
                        <?php \Elementor\Icons_Manager::render_icon($settings['pxl_icon'], ['aria-hidden' => 'true', 'class' => ''], 'i'); ?>
                    </div>
                <?php endif; ?>
                <?php if ($settings['style'] == 'style-5'): ?>
                    <span class="pxl-item--dot"></span>
                <?php endif; ?>
                <div class="pxl-item--content">
                    <?php if (!empty($value['label'])) : ?>
                        <label class="pxl-item--label"><?php echo pxl_print_html($value['label']); ?></label>
                    <?php endif; ?>
                    <?php if (!empty($value['content'])) : ?>
                        <div class="pxl-item--content-text"><?php echo wp_kses_post($value['content']) ?></div>
                    <?php endif; ?>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>