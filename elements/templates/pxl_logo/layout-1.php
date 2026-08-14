<?php
if (! empty($settings['logo_link']['url'])) {
    $widget->add_render_attribute('logo_link', 'href', $settings['logo_link']['url']);

    if ($settings['logo_link']['is_external']) {
        $widget->add_render_attribute('logo_link', 'target', '_blank');
    }

    if ($settings['logo_link']['nofollow']) {
        $widget->add_render_attribute('logo_link', 'rel', 'nofollow');
    }
}
if (!empty($settings['logo']['id'])) :
    $img  = pxl_get_image_by_size(array(
        'attach_id'  => $settings['logo']['id'],
        'thumb_size' => 'full',
    ));
    $thumbnail    = $img['thumbnail'];
?>
    <div class="pxl-logo <?php echo esc_attr($settings['logo_style'] . ' ' . $settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
        <?php if ($settings['logo_style'] == 'style-2') { ?>
            <div class="pxl-logo--divider pxl-logo--divider-1"></div>
        <?php } ?>
        <?php if (! empty($settings['logo_link']['url'])) { ?>
            <a <?php pxl_print_html($widget->get_render_attribute_string('logo_link')); ?>>
                <?php echo wp_kses_post($thumbnail); ?>
            </a>
        <?php } else { ?>
            <div class="pxl-logo--inner">
                <?php echo wp_kses_post($thumbnail); ?>
            </div>
        <?php } ?>
        <?php if ($settings['logo_style'] == 'style-2') { ?>
            <div class="pxl-logo--divider pxl-logo--divider-2"></div>
        <?php } ?>
    </div>
<?php endif; ?>