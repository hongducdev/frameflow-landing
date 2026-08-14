<?php
$title_tag = frameflow_widget_sanitize_title_tag(!empty($settings['title_tag']) ? $settings['title_tag'] : '', 'h5');
$active = intval($settings['active']);
$accordion = $widget->get_settings('accordion');
$wg_id = pxl_get_element_id($settings);
if (!empty($accordion)) : ?>
    <div class="pxl-accordion pxl-accordion3 <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
        <?php foreach ($accordion as $key => $value):
            $is_active = ($key + 1) == $active;
            $pxl_id = isset($value['_id']) ? $value['_id'] : '';
            $title = isset($value['title']) ? $value['title'] : '';
            $desc = isset($value['desc']) ? $value['desc'] : '';
        ?>
            <div class="pxl-item <?php echo esc_attr($is_active ? 'active' : ''); ?>">
                <div class="pxl-item--title" data-target="<?php echo esc_attr('#' . $wg_id . '-' . $pxl_id); ?>">
                    <div class="pxl-item--title-inner">
                        <span class="pxl-item--title-order">
                            <?php if($key + 1 < 10) : ?>
                                0<?php echo esc_html($key + 1); ?>.&nbsp;
                            <?php else : ?>
                                <?php echo esc_html($key + 1); ?>.&nbsp;
                            <?php endif; ?>
                        </span>
                    <<?php echo esc_attr($title_tag); ?> class="pxl-item--title-text"><?php echo wp_kses_post($title); ?></<?php echo esc_attr($title_tag); ?>>
                    </div>
                    <div class="pxl-item--title-icon">
                        <span class="pxl-accordion--plus"></span>
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
