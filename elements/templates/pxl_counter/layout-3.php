<?php
/**
 * Case Counter — layout 3 (Figma 3776:605).
 * Title above a fading number; suffix sits smaller at the cap height.
 */
$widget->add_render_attribute('counter', [
    'class' => 'pxl-counter--value ' . (!empty($settings['effect']) ? $settings['effect'] : ''),
    'data-duration' => !empty($settings['duration']) ? $settings['duration'] : '',
    'data-startnumber' => !empty($settings['starting_number']) ? $settings['starting_number'] : '',
    'data-endnumber' => !empty($settings['ending_number']) ? $settings['ending_number'] : '',
    'data-to-value' => !empty($settings['ending_number']) ? $settings['ending_number'] : '',
    'data-delimiter' => !empty($settings['thousand_separator_char'])
        ? $settings['thousand_separator_char']
        : '',
]);
$animate_class = trim(
    (!empty($settings['pxl_animate']) ? $settings['pxl_animate'] : '') .
        ' ' .
        (!empty($settings['style']) ? $settings['style'] : ''),
);
?>
<div class="pxl-counter pxl-counter3 <?php echo esc_attr(
    $animate_class,
); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
    <?php if (!empty($settings['title'])): ?>
        <h6 class="pxl-counter--title <?php echo esc_attr(
            $settings['title_w'],
        ); ?>"><?php echo pxl_print_html($settings['title']); ?></h6>
    <?php endif; ?>
    <div class="pxl-counter--holder">
        <div class="pxl-counter--number">
            <span class="pxl-counter--prefix <?php echo empty($settings['prefix'])
                ? 'el-empty'
                : ''; ?>"><?php echo pxl_print_html($settings['prefix']); ?></span>
            <span <?php echo wp_kses_post(
                $widget->get_render_attribute_string('counter'),
            ); ?>><?php echo esc_html($settings['starting_number']); ?></span>
            <?php if (!empty($settings['suffix'])): ?>
                <span class="pxl-counter--suffix"><?php echo pxl_print_html(
                    $settings['suffix'],
                ); ?></span>
            <?php endif; ?>
        </div>
    </div>
</div>
