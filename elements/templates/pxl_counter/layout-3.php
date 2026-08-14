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
<div class="pxl-counter pxl-counter3 <?php echo esc_attr($animate_class); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
    <?php if ( $settings['icon_type'] == 'icon' && !empty($settings['pxl_icon']['value']) ) : ?>
        <div class="pxl-counter--icon">
            <?php \Elementor\Icons_Manager::render_icon( $settings['pxl_icon'], [ 'aria-hidden' => 'true', 'class' => '' ], 'i' ); ?>
        </div>
    <?php endif; ?>
    <?php if ( $settings['icon_type'] == 'image' && !empty($settings['icon_image']['id']) ) : ?>
        <div class="pxl-counter--icon">
            <?php $img_icon  = pxl_get_image_by_size( array(
                    'attach_id'  => $settings['icon_image']['id'],
                    'thumb_size' => 'full',
                ) );
                $thumbnail_icon    = $img_icon['thumbnail'];
            echo pxl_print_html($thumbnail_icon); ?>
        </div>
    <?php endif; ?>
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
        <?php if (!empty($settings['title'])) : ?>
            <span class="pxl-counter--title <?php echo esc_attr($settings['title_w']); ?>"><?php echo pxl_print_html($settings['title']); ?></span>
        <?php endif; ?>
        <?php if (!empty($settings['description'])) : ?>
            <p class="pxl-counter--description"><?php echo pxl_print_html($settings['description']); ?></p>
        <?php endif; ?>
    </div>
</div>