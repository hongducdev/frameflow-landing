<?php
$html_id = pxl_get_element_id($settings);

if (!empty($settings['link']['url'])) {
    $widget->add_render_attribute('button', 'href', $settings['link']['url']);

    if ($settings['link']['is_external']) {
        $widget->add_render_attribute('button', 'target', '_blank');
    }

    if ($settings['link']['nofollow']) {
        $widget->add_render_attribute('button', 'rel', 'nofollow');
    }
}

$text_effect      = $settings['btn_text_effect'];
$btn_style        = $settings['btn_style'];
$has_btn_icon     = !empty($settings['btn_icon']);
$is_applied       = ($text_effect == 'btn-text-applied');

$anchor_class      = 'btn ' . $text_effect . ' ' . $btn_style . ' pxl-icon--' . $settings['icon_align'];
$wrapper_class     = $settings['pxl_animate'];
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
    <a <?php pxl_print_html($widget->get_render_attribute_string('button')); ?> class="<?php echo esc_attr($anchor_class); ?>">

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

        <?php if ($is_applied && $has_btn_icon) : ?>
            <span class="btn-icon-right">
                <?php \Elementor\Icons_Manager::render_icon($settings['btn_icon'], ['aria-hidden' => 'true', 'class' => ''], 'i'); ?>
            </span>
        <?php endif; ?>

    </a>
</div>
