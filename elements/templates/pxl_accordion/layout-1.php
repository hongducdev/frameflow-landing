<?php
$title_tag = frameflow_widget_sanitize_title_tag(!empty($settings['title_tag']) ? $settings['title_tag'] : '', 'h5');
$active = intval($settings['active']);
$accordion = $widget->get_settings('accordion');
$wg_id = pxl_get_element_id($settings);
if (!empty($accordion)) : ?>
    <div class="pxl-accordion pxl-accordion1 <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
        <?php foreach ($accordion as $key => $value):
            $is_active = ($key + 1) == $active;
            $pxl_id = isset($value['_id']) ? $value['_id'] : '';
            $title = isset($value['title']) ? $value['title'] : '';
            $desc = isset($value['desc']) ? $value['desc'] : '';
        ?>
            <div class="pxl-item <?php echo esc_attr($is_active ? 'active' : ''); ?>">
                <div class="pxl-item--title" data-target="<?php echo esc_attr('#' . $wg_id . '-' . $pxl_id); ?>">
            <<?php echo esc_attr($title_tag); ?> class="pxl-item--title-text"><?php echo wp_kses_post($title); ?></<?php echo esc_attr($title_tag); ?>>
                    <div class="pxl-item--title-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="9" height="5" viewBox="0 0 9 5" fill="none">
                            <path d="M0.118602 0.119241C0.156331 0.0814691 0.201137 0.0515041 0.250455 0.0310602C0.299773 0.0106158 0.352636 9.34601e-05 0.406024 9.34601e-05C0.459412 9.34601e-05 0.512276 0.0106158 0.561594 0.0310602C0.610912 0.0515041 0.655716 0.0814691 0.693446 0.119241L4.46852 3.89483L8.2436 0.119241C8.31983 0.0430117 8.42322 0.000186443 8.53102 0.000186443C8.63883 0.000186443 8.74222 0.0430117 8.81845 0.119241C8.89468 0.19547 8.9375 0.298859 8.9375 0.406663C8.9375 0.514467 8.89468 0.617856 8.81845 0.694085L4.75595 4.75658C4.71822 4.79436 4.67341 4.82432 4.62409 4.84477C4.57478 4.86521 4.52191 4.87573 4.46852 4.87573C4.41514 4.87573 4.36227 4.86521 4.31295 4.84477C4.26364 4.82432 4.21883 4.79436 4.1811 4.75658L0.118602 0.694085C0.0808296 0.656355 0.0508652 0.61155 0.0304213 0.562232C0.00997639 0.512914 -0.000545502 0.46005 -0.000545502 0.406663C-0.000545502 0.353275 0.00997639 0.300411 0.0304213 0.251093C0.0508652 0.201776 0.0808296 0.156971 0.118602 0.119241Z" fill="currentColor"/>
                        </svg>
                    </div>
                </div>
                <div id="<?php echo esc_attr($wg_id . '-' . $pxl_id); ?>" class="pxl-item--content" <?php if ($is_active) { ?>style="display: block;" <?php } ?>>
                    <div class="pxl-item--content-inner">
                        <?php echo wp_kses_post(nl2br($desc)); ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
