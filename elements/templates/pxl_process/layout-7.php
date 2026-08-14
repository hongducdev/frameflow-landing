<?php
$title_tag = frameflow_widget_sanitize_title_tag(!empty($settings['title_tag']) ? $settings['title_tag'] : '', 'h6');
?>
<div class="pxl-process pxl-process7 <?php echo esc_attr($settings['show_divider_top'] ? 'show-divider-top' : ''); ?> <?php echo esc_attr($settings['show_divider_bottom'] ? 'show-divider-bottom' : ''); ?> <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
    <span class="pxl-item--step">
        <?php echo esc_html(sprintf('%02d', $settings['step'])); ?>.
    </span>
    <div class="pxl-item--content">
        <<?php echo esc_attr($title_tag); ?> class="pxl-item--title"><?php echo esc_html($settings['title']); ?></<?php echo esc_attr($title_tag); ?>>
        <p class="pxl-item--description"><?php echo esc_html($settings['description']); ?></p>
    </div>
    <?php if ($settings['pxl_arrow'] == 'true') : ?>
        <div class="pxl-item--arrow">
            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                <path d="M16.6614 10.1302L11.3176 15.474C11.1503 15.6413 10.9234 15.7353 10.6868 15.7353C10.4501 15.7353 10.2232 15.6413 10.0559 15.474C9.88858 15.3067 9.79459 15.0797 9.79459 14.8431C9.79459 14.6065 9.88858 14.3796 10.0559 14.2122L13.8789 10.3907H2.96875C2.73254 10.3907 2.50601 10.2969 2.33898 10.1299C2.17196 9.96284 2.07812 9.73631 2.07812 9.5001C2.07812 9.26389 2.17196 9.03736 2.33898 8.87033C2.50601 8.70331 2.73254 8.60947 2.96875 8.60947H13.8789L10.0574 4.78572C9.89007 4.61841 9.79607 4.39148 9.79607 4.15487C9.79607 3.91825 9.89007 3.69132 10.0574 3.52401C10.2247 3.35669 10.4516 3.2627 10.6882 3.2627C10.9249 3.2627 11.1518 3.35669 11.3191 3.52401L16.6629 8.86776C16.7459 8.95061 16.8118 9.04905 16.8566 9.15743C16.9015 9.26581 16.9246 9.38199 16.9244 9.49929C16.9243 9.6166 16.901 9.73273 16.8558 9.841C16.8107 9.94927 16.7446 10.0476 16.6614 10.1302Z" fill="currentColor"/>
            </svg>
        </div>
    <?php endif; ?>
</div>
