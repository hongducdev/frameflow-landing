<?php
$title_tag = frameflow_widget_sanitize_title_tag(!empty($settings['title_tag']) ? $settings['title_tag'] : '', 'h6');
?>
<div class="pxl-process pxl-process1 <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
    <div class="pxl-item--header <?php echo esc_attr($settings['show_divider_left'] ? 'show-divider-left' : ''); ?> <?php echo esc_attr($settings['show_divider_right'] ? 'show-divider-right' : ''); ?>">
        <span class="pxl-item--step">
            <?php echo esc_html($settings['step']); ?>
        </span>
    </div>
    <<?php echo esc_attr($title_tag); ?> class="pxl-item--title"><?php echo esc_html($settings['title']); ?></<?php echo esc_attr($title_tag); ?>>
    <p class="pxl-item--description"><?php echo esc_html($settings['description']); ?></p>
</div>
