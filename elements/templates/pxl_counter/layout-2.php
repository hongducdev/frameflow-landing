<?php
$widget->add_render_attribute('counter', [
    'class' => 'pxl-counter--value ' . (!empty($settings['effect']) ? $settings['effect'] : ''),
    'data-duration' => !empty($settings['duration']) ? $settings['duration'] : '',
    'data-startnumber' => !empty($settings['starting_number']) ? $settings['starting_number'] : '',
    'data-endnumber' => !empty($settings['ending_number']) ? $settings['ending_number'] : '',
    'data-to-value' => !empty($settings['ending_number']) ? $settings['ending_number'] : '',
    'data-delimiter' => !empty($settings['thousand_separator_char']) ? $settings['thousand_separator_char'] : '',
]);
$animate_class = trim((!empty($settings['pxl_animate']) ? $settings['pxl_animate'] : '') . ' ' . (!empty($settings['style']) ? $settings['style'] : ''));
?>
<div class="pxl-counter pxl-counter2 <?php echo esc_attr($animate_class); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
    <div class="pxl-counter--holder">
        <div class="pxl-counter--number">
            <span class="pxl-counter--prefix <?php echo empty($settings['prefix']) ? 'el-empty' : ''; ?>"><?php echo pxl_print_html($settings['prefix']); ?></span>
            <span <?php echo wp_kses_post($widget->get_render_attribute_string('counter')); ?>><?php echo esc_html($settings['starting_number']); ?></span>
            <?php if (!empty($settings['end_char_number'])) : ?>
                <span class="pxl-counter--end-char-number"><?php echo esc_html($settings['end_char_number']); ?></span>
            <?php endif; ?>
            <?php if (!empty($settings['suffix'])) : ?>
                <span class="pxl-counter--suffix"><?php echo pxl_print_html($settings['suffix']); ?></span>
            <?php endif; ?>
            <?php if (!empty($settings['unit_text'])) : ?>
                <span class="pxl-counter--unit"><?php echo pxl_print_html($settings['unit_text']); ?></span>
            <?php endif; ?>
        </div>
    </div>
    <?php if (!empty($settings['title'])) : ?>
        <h6 class="pxl-counter--title <?php echo esc_attr($settings['title_w']); ?>"><?php echo pxl_print_html($settings['title']); ?></h6>
    <?php endif; ?>
    <?php if (!empty($settings['description'])) : ?>
        <p class="pxl-counter--description"><?php echo pxl_print_html($settings['description']); ?></p>
    <?php endif; ?>
</div>