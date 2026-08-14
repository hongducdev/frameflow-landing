<?php
/**
 * @var array $settings
 */
$title_tag = frameflow_widget_sanitize_title_tag(!empty($settings['title_tag']) ? $settings['title_tag'] : '', 'h3');
?>
<div class="pxl-text-box pxl-text-box4 <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
    <?php if (!empty($settings['title'])) : ?>
        <<?php echo esc_attr($title_tag); ?> class="pxl-item--title el-empty">
            <?php echo esc_html($settings['title']); ?>
        </<?php echo esc_attr($title_tag); ?>>
    <?php endif; ?>
    <?php if (!empty($settings['description'])) : ?>
        <p class="pxl-item--description el-empty">
            <?php echo esc_html($settings['description']); ?>
        </p>
    <?php endif; ?>
    <?php if (!empty($settings['list_items'])) : ?>
        <ul class="pxl-item--list">
            <?php foreach ($settings['list_items'] as $item) : ?>
                <li class="pxl-item--list-item">
                    <?php echo esc_html($item['item_title']); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>
