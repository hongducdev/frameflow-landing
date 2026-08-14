<?php
$title_tag = frameflow_widget_sanitize_title_tag(!empty($settings['title_tag']) ? $settings['title_tag'] : '', 'h6');
$pxl_animate_item_delay = isset($settings['pxl_animate_item_delay']) ? (int) $settings['pxl_animate_item_delay'] : 0;
?>
<div class="pxl-process pxl-process2 <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
    <div class="pxl-item--list">
        <?php foreach ($settings['process_list'] as $key => $item): ?>
            <div class="pxl-item wow fadeInUp" data-wow-delay="<?php echo esc_attr($pxl_animate_item_delay + $key * 100); ?>ms">
                <div class="pxl-item--step">
                    <?php echo esc_html($key + 1); ?>
                </div>
                <div class="pxl-item--content">
                    <<?php echo esc_attr($title_tag); ?> class="pxl-item--title"><?php echo esc_html($item['title_2']); ?></<?php echo esc_attr($title_tag); ?>>
                    <p class="pxl-item--description"><?php echo esc_html($item['description_2']); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
