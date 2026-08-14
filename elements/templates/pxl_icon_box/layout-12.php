<?php $title_tag = frameflow_widget_sanitize_title_tag(
    !empty($settings['title_tag']) ? $settings['title_tag'] : '',
    'h5',
); ?>
<div class="pxl-icon-box pxl-icon-box12 <?php echo esc_attr(
    $settings['pxl_animate'],
); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
    <div class="pxl-item--heading">
        <?php if ($settings['icon_type'] == 'icon' && !empty($settings['pxl_icon']['value'])): ?>
            <div class="pxl-item--icon">
                <?php \Elementor\Icons_Manager::render_icon($settings['pxl_icon'], [
                    'aria-hidden' => 'true',
                ]); ?>
            </div>
        <?php endif; ?>
        <?php if ($settings['icon_type'] == 'image' && !empty($settings['icon_image']['id'])): ?>
            <div class="pxl-item--icon">
                <?php
                $img_icon = pxl_get_image_by_size([
                    'attach_id' => $settings['icon_image']['id'],
                    'thumb_size' => 'full',
                ]);
                $thumbnail_icon = $img_icon['thumbnail'];
                echo pxl_print_html($thumbnail_icon);
                ?>
            </div>
        <?php endif; ?>
        <<?php echo esc_attr($title_tag); ?> class="pxl-item--title el-empty">
            <?php echo pxl_print_html($settings['title']); ?>
        </<?php echo esc_attr($title_tag); ?>>
    </div>

    <?php if (!empty($settings['desc'])): ?>
        <div class="pxl-item--description el-empty"><?php echo pxl_print_html(
            $settings['desc'],
        ); ?></div>
    <?php endif; ?>
</div>