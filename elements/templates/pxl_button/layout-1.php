<?php
$html_id  = pxl_get_element_id($settings);
$btn_action      = $settings['btn_action'];
$is_popup_action = ($btn_action === 'pxl-atc-popup');

if (!$is_popup_action && !empty($settings['link']['url'])) {
    $widget->add_render_attribute('button', 'href', $settings['link']['url']);

    if ($settings['link']['is_external']) {
        $widget->add_render_attribute('button', 'target', '_blank');
    }

    if ($settings['link']['nofollow']) {
        $widget->add_render_attribute('button', 'rel', 'nofollow');
    }
}

if ($is_popup_action) {
    $widget->add_render_attribute('button', 'href', 'javascript:void(0)');
}

$template = (int) $widget->get_setting('popup_template', '0');
if ($template > 0) {
    if (!has_action('pxl_anchor_target_page_popup_' . $template)) {
        add_action('pxl_anchor_target_page_popup_' . $template, 'frameflow_hook_anchor_page_popup');
    }
}

$text_effect      = $settings['btn_text_effect'];
$btn_style        = $settings['btn_style'];
$has_btn_icon     = !empty($settings['btn_icon']);
$is_applied       = ($text_effect == 'btn-text-applied');

$anchor_class      = 'btn ' . $text_effect . ' ' . $btn_style . ' ' . $settings['btn_w'] . ' pxl-icon--' . $settings['icon_align'];
if ($is_popup_action) {
    $anchor_class .= ' pxl-anchor-button';
}
$wrapper_class     = $settings['btn_action'] . ' ' . $settings['pxl_animate'];
$data_target       = $template > 0 ? '.pxl-page-popup-template-' . $template : '';
$data_wow_delay    = $settings['pxl_animate_delay'] . 'ms';
$btn_text_data     = $settings['text'];

$show_icon_standalone = !$is_applied && $btn_style !== 'btn-svg';
$show_icon_left       = $is_applied;
$is_btn_svg           = ($btn_style === 'btn-svg');

$render_chars = function (string $text) {
    $chars = preg_split('//u', $text, -1, PREG_SPLIT_NO_EMPTY);
    foreach ($chars as $value) {
        if ($value === ' ') {
            echo '<span class="spacer">&nbsp;</span>';
        } else {
            echo '<span>' . $value . '</span>';
        }
    }
};

$render_chars_applied = function (string $text) {
    $chars      = preg_split('//u', $text, -1, PREG_SPLIT_NO_EMPTY);
    $totalChars = count($chars) - 1;
    echo '<span class="chars">';
    foreach ($chars as $index => $value) {
        $class = ($value === ' ') ? 'spacer' : '';
        $char  = ($value === ' ') ? '&nbsp;' : htmlspecialchars($value);
        echo '<span class="' . $class . '" style="--chars-index: ' . $index . '; --chars-last-index: ' . ($totalChars - $index) . ';">' . $char . '</span>';
    }
    echo '</span>';
};

$render_chars_split = function (string $text) {
    $chars = str_split($text);
    foreach ($chars as $value) {
        if ($value === ' ') {
            echo '<span class="spacer">&nbsp;</span>';
        } else {
            echo '<span>' . $value . '</span>';
        }
    }
};
?>
<div id="pxl-<?php echo esc_attr($html_id); ?>" class="pxl-button <?php echo esc_attr($wrapper_class); ?>" data-wow-delay="<?php echo esc_attr($data_wow_delay); ?>">
    <a <?php pxl_print_html($widget->get_render_attribute_string('button')); ?> class="<?php echo esc_attr($anchor_class); ?>"<?php if ($data_target) : ?> data-target="<?php echo esc_attr($data_target); ?>"<?php endif; ?>>

        <?php if ($is_btn_svg && $has_btn_icon) : ?>
            <span class="btn-svg-bg" aria-hidden="true">
                <?php \Elementor\Icons_Manager::render_icon($settings['btn_icon'], ['aria-hidden' => 'true', 'class' => ''], 'i'); ?>
            </span>
        <?php endif; ?>

        <?php if ($show_icon_standalone && $has_btn_icon) : ?>
            <div class="pxl--btn-icon">
                <?php \Elementor\Icons_Manager::render_icon($settings['btn_icon'], ['aria-hidden' => 'true', 'class' => ''], 'i'); ?>
            </div>
        <?php endif; ?>

        <?php if ($show_icon_left && $has_btn_icon) : ?>
            <span class="btn-icon-left">
                <?php \Elementor\Icons_Manager::render_icon($settings['btn_icon'], ['aria-hidden' => 'true', 'class' => ''], 'i'); ?>
            </span>
        <?php endif; ?>

        <?php if($btn_style == 'custom_icon_1') : ?>
            <span class="btn-icon-custom">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="17" viewBox="0 0 14 17" fill="none">
                    <path d="M13.7858 9.04574C14.0714 8.74631 14.0714 8.25369 13.7858 7.95426L6.41619 0.226989C6.27801 0.0821023 6.08916 0 5.89571 0H0.736963C0.331633 0 0 0.347727 0 0.772727C0 0.975568 0.0783023 1.17358 0.216483 1.31847L7.06564 8.5L0.216483 15.6815C-0.0690903 15.981 -0.0690903 16.4736 0.216483 16.773C0.354664 16.9179 0.54351 17 0.736963 17H5.89571C6.08916 17 6.27801 16.9179 6.41619 16.773L13.7858 9.04574Z" fill="white" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="17" viewBox="0 0 14 17" fill="none">
                    <path d="M13.7858 9.04574C14.0714 8.74631 14.0714 8.25369 13.7858 7.95426L6.41619 0.226989C6.27801 0.0821023 6.08916 0 5.89571 0H0.736963C0.331633 0 0 0.347727 0 0.772727C0 0.975568 0.0783023 1.17358 0.216483 1.31847L7.06564 8.5L0.216483 15.6815C-0.0690903 15.981 -0.0690903 16.4736 0.216483 16.773C0.354664 16.9179 0.54351 17 0.736963 17H5.89571C6.08916 17 6.27801 16.9179 6.41619 16.773L13.7858 9.04574Z" fill="white" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="17" viewBox="0 0 14 17" fill="none">
                    <path d="M13.7858 9.04574C14.0714 8.74631 14.0714 8.25369 13.7858 7.95426L6.41619 0.226989C6.27801 0.0821023 6.08916 0 5.89571 0H0.736963C0.331633 0 0 0.347727 0 0.772727C0 0.975568 0.0783023 1.17358 0.216483 1.31847L7.06564 8.5L0.216483 15.6815C-0.0690903 15.981 -0.0690903 16.4736 0.216483 16.773C0.354664 16.9179 0.54351 17 0.736963 17H5.89571C6.08916 17 6.27801 16.9179 6.41619 16.773L13.7858 9.04574Z" fill="white" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="17" viewBox="0 0 14 17" fill="none">
                    <path d="M13.7858 9.04574C14.0714 8.74631 14.0714 8.25369 13.7858 7.95426L6.41619 0.226989C6.27801 0.0821023 6.08916 0 5.89571 0H0.736963C0.331633 0 0 0.347727 0 0.772727C0 0.975568 0.0783023 1.17358 0.216483 1.31847L7.06564 8.5L0.216483 15.6815C-0.0690903 15.981 -0.0690903 16.4736 0.216483 16.773C0.354664 16.9179 0.54351 17 0.736963 17H5.89571C6.08916 17 6.27801 16.9179 6.41619 16.773L13.7858 9.04574Z" fill="white" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="17" viewBox="0 0 14 17" fill="none">
                    <path d="M13.7858 9.04574C14.0714 8.74631 14.0714 8.25369 13.7858 7.95426L6.41619 0.226989C6.27801 0.0821023 6.08916 0 5.89571 0H0.736963C0.331633 0 0 0.347727 0 0.772727C0 0.975568 0.0783023 1.17358 0.216483 1.31847L7.06564 8.5L0.216483 15.6815C-0.0690903 15.981 -0.0690903 16.4736 0.216483 16.773C0.354664 16.9179 0.54351 17 0.736963 17H5.89571C6.08916 17 6.27801 16.9179 6.41619 16.773L13.7858 9.04574Z" fill="white" />
                </svg>
            </span>
        <?php endif; ?>

        <?php if($btn_style == 'btn-default') : ?>
            <div class="btn-text-wrap">
                <span>
                    <?php echo esc_html($settings['text']); ?>
                </span>
                <span>
                    <?php echo esc_html($settings['text']); ?>
                </span>
            </div>
        <?php else : ?>
            <span class="pxl--btn-text" data-text="<?php echo esc_attr($btn_text_data); ?>">
                <?php if ($text_effect == 'btn-text-nina' || $text_effect == 'btn-text-nanuk') : ?>
                    <?php $render_chars($settings['text']); ?>
                <?php elseif ($is_applied) : ?>
                    <?php $render_chars_applied($settings['text']); ?>
                <?php elseif ($text_effect == 'btn-text-smoke' || $text_effect == 'btn-text-reverse') : ?>
                    <span class="pxl-text--front">
                        <span class="pxl-text--inner"><?php $render_chars_split($settings['text']); ?></span>
                    </span>
                    <span class="pxl-text--back">
                        <span class="pxl-text--inner"><?php $render_chars_split($settings['text']); ?></span>
                </span>
                <?php else : ?>
                    <?php pxl_print_html($settings['text']); ?>
                <?php endif; ?>
            </span>
        <?php endif; ?>

        <?php if ($is_applied && $has_btn_icon) : ?>
            <span class="btn-icon-right">
                <?php \Elementor\Icons_Manager::render_icon($settings['btn_icon'], ['aria-hidden' => 'true', 'class' => ''], 'i'); ?>
            </span>
        <?php endif; ?>

    </a>
</div>