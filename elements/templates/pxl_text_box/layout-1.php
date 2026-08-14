<?php
/**
 * @var array $settings
 */
$title_tag = frameflow_widget_sanitize_title_tag(!empty($settings['title_tag']) ? $settings['title_tag'] : '', 'h3');
?>
<div class="pxl-text-box pxl-text-box1 <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
    <div class="pxl-item--content">
        <?php if (!empty($settings['sub_title'])) : ?>
            <div class="pxl-item--sub-title">
                <?php echo esc_html($settings['sub_title']); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($settings['title'])) : ?>
            <<?php echo esc_attr($title_tag); ?> class="pxl-item--title el-empty">
                <?php echo esc_html($settings['title']); ?>
            </<?php echo esc_attr($title_tag); ?>>
        <?php endif; ?>
    </div>

    <?php
    $has_link = !empty($settings['link']['url']);
    $has_button = !empty($settings['button_text']);
    ?>
    <?php if ($has_link && $has_button) : ?>
        <a
            class="pxl-item--button"
            href="<?php echo esc_url($settings['link']['url']); ?>"
            target="<?php echo esc_attr(!empty($settings['link']['is_external']) ? '_blank' : '_self'); ?>"
            rel="<?php echo esc_attr(!empty($settings['link']['nofollow']) ? 'nofollow' : ''); ?>"
        >
            <span><?php echo esc_html($settings['button_text']); ?></span>
            <svg xmlns="http://www.w3.org/2000/svg" width="7" height="13" viewBox="0 0 7 13" fill="none">
                <path d="M6.67521 6.67521L1.36271 11.9877C1.21301 12.1374 1.00997 12.2215 0.798257 12.2215C0.586546 12.2215 0.383506 12.1374 0.233804 11.9877C0.0841017 11.838 1.57737e-09 11.635 0 11.4233C-1.57737e-09 11.2115 0.0841017 11.0085 0.233804 10.8588L4.98251 6.11142L0.235132 1.36271C0.161007 1.28859 0.102208 1.20059 0.0620917 1.10374C0.0219755 1.00689 0.0013279 0.903086 0.0013279 0.798257C0.0013279 0.693429 0.0219755 0.589626 0.0620917 0.492777C0.102208 0.395928 0.161007 0.307929 0.235132 0.233804C0.309257 0.159679 0.397257 0.10088 0.494106 0.0607638C0.590955 0.0206476 0.694757 -7.81034e-10 0.799585 0C0.904414 7.81035e-10 1.00822 0.0206476 1.10507 0.0607638C1.20191 0.10088 1.28991 0.159679 1.36404 0.233804L6.67654 5.5463C6.75074 5.62042 6.80958 5.70846 6.84969 5.80537C6.88979 5.90228 6.91038 6.00615 6.91025 6.11103C6.91013 6.21591 6.8893 6.31974 6.84897 6.41655C6.80864 6.51337 6.74959 6.60127 6.67521 6.67521Z" fill="currentColor"/>
            </svg>
        </a>
    <?php endif; ?>
</div>
