<?php
/**
 * @var array $settings
 */
$title_tag = frameflow_widget_sanitize_title_tag(!empty($settings['title_tag']) ? $settings['title_tag'] : '', 'h3');
?>
<div class="pxl-text-box pxl-text-box3 <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
    <?php if (!empty($settings['sub_title'])) : ?>
        <p class="pxl-item--sub-title">
            <?php echo esc_html($settings['sub_title']); ?>
        </p>
    <?php endif; ?>
    <div class="pxl-item--divider"></div>
    <?php if (!empty($settings['title'])) : ?>
        <<?php echo esc_attr($title_tag); ?> class="pxl-item--title el-empty">
            <?php echo esc_html($settings['title']); ?>
        </<?php echo esc_attr($title_tag); ?>>
    <?php endif; ?>
</div>
