<?php
$list_classes = trim('pxl-list pxl-list1 ' . ($settings['pxl_animate'] ?? ''));
$animate_delay = $settings['pxl_animate_delay'] ?? '';
?>
<?php if (!empty($settings['lists']) && count($settings['lists'])): ?>
    <ul class="<?php echo esc_attr($list_classes); ?>" data-wow-delay="<?php echo esc_attr($animate_delay); ?>ms">
        <?php foreach ($settings['lists'] as $value): ?>
            <li class="pxl-item">
                <?php if (!empty($settings['pxl_icon']['value'])): ?>
                    <div class="pxl-item--icon">
                        <?php \Elementor\Icons_Manager::render_icon($settings['pxl_icon'], [
                            'aria-hidden' => 'true',
                            'class' => '',
                        ], 'i'); ?>
                    </div>
                <?php endif; ?>
                <div class="pxl-item--content">
                    <?php if (!empty($value['label'])): ?>
                        <label class="pxl-item--label"><?php echo pxl_print_html($value['label']); ?></label>
                    <?php endif; ?>
                    <?php if (!empty($value['content'])): ?>
                        <div class="pxl-item--content-text"><?php echo wp_kses_post($value['content']); ?></div>
                    <?php endif; ?>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
