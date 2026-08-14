<?php
$title_tag = frameflow_widget_sanitize_title_tag(
    !empty($settings['title_tag']) ? $settings['title_tag'] : '',
    'h6'
);

$classes = array_filter([
    'pxl-process',
    'pxl-process8',
    !empty($settings['show_divider_top']) ? 'show-divider-top' : '',
    !empty($settings['show_divider_bottom']) ? 'show-divider-bottom' : '',
    $settings['pxl_animate'] ?? '',
]);
?>
<div
    class="<?php echo esc_attr(implode(' ', $classes)); ?>"
    data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms"
>
    <div class="pxl-item--step-wrapper">
        <span class="pxl-item--step">
            <?php echo pxl_print_html($settings['step']); ?>
        </span>

        <?php if ($settings['pxl_arrow'] === 'true'): ?>
            <div class="pxl-item--arrow">
                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="13" viewBox="0 0 19 13" fill="none">
                    <path d="M9.82759 12.9999C9.709 13.002 9.58943 12.9748 9.48395 12.9131C9.17962 12.736 9.08691 12.3512 9.27003 12.0638C9.28543 12.0384 11.1982 9.02006 14.8495 7.1206H0.655172C0.293845 7.1206 0 6.84274 0 6.50107C0 6.1594 0.293845 5.88155 0.655172 5.88155H14.8495C11.2185 3.99293 9.28412 0.961284 9.26512 0.930927C9.08593 0.64161 9.18519 0.256575 9.49083 0.0852765C9.80072 -0.0885 10.2089 0.0121727 10.394 0.306757C10.6918 0.755912 13.4841 4.78251 18.4926 5.89672C18.7923 5.96642 19 6.21454 19 6.50138C19 6.78822 18.7936 7.03696 18.4981 7.1048C13.4684 8.22304 10.6855 12.2549 10.3848 12.7112C10.2669 12.8899 10.0487 12.9959 9.82759 12.9999Z" fill="currentColor"/>
                </svg>
            </div>
        <?php endif; ?>
    </div>
    <<?php echo esc_attr($title_tag); ?> class="pxl-item--title">
        <?php echo esc_html($settings['title']); ?>
    </<?php echo esc_attr($title_tag); ?>>

    <p class="pxl-item--description">
        <?php echo esc_html($settings['description']); ?>
    </p>
</div>
