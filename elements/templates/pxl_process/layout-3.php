<?php
$title_tag = frameflow_widget_sanitize_title_tag(!empty($settings['title_tag']) ? $settings['title_tag'] : '', 'h6');
$list = isset($settings['process_list_3']) && is_array($settings['process_list_3']) ? $settings['process_list_3'] : [];

if (empty($list)) {
    return;
}
$process3_count = count($list);
?>
<div class="pxl-process pxl-process3 <?php echo esc_attr($settings['pxl_animate']); ?>" style="--step-count: <?php echo esc_attr($process3_count); ?>;" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
    <div class="pxl-process3__track">
        <?php foreach ($list as $key => $item) : ?>
            <?php
            $step_raw = isset($item['step_3']) ? $item['step_3'] : '';
            $step_label = ($step_raw !== '' && $step_raw !== null) ? $step_raw : (string) ($key + 1);
            ?>
            <div class="pxl-process3__slot" style="--stack: <?php echo esc_attr((int) $key); ?>;">
                <div class="pxl-item pxl-process3__card">
                    <div class="pxl-item--step">
                        <span class="pxl-item--step-label">
                            <?php echo esc_html('Step. '); ?>
                        </span>
                        <span class="pxl-item--step-number">
                            <?php echo esc_html($step_label); ?>
                        </span>
                    </div>
                    <div class="pxl-item--content">
                        <<?php echo esc_attr($title_tag); ?> class="pxl-item--title"><?php echo esc_html($item['title_3'] ?? ''); ?></<?php echo esc_attr($title_tag); ?>>
                        <p class="pxl-item--description"><?php echo esc_html($item['description_3'] ?? ''); ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
