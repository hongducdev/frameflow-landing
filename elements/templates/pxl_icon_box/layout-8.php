<?php $title_tag = frameflow_widget_sanitize_title_tag(!empty($settings['title_tag']) ? $settings['title_tag'] : '', 'h5'); ?>
<div class="pxl-icon-box pxl-icon-box8 <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
    <?php if (!empty($settings['sub_title'])) : ?>
        <div class="pxl-item--sub-title">
            <span><?php echo esc_html($settings['sub_title']); ?></span>
        </div>
    <?php endif; ?>
    <?php if ($settings['icon_type'] == 'icon' && !empty($settings['pxl_icon']['value'])) : ?>
        <div class="pxl-item--icon">
            <?php \Elementor\Icons_Manager::render_icon($settings['pxl_icon'], ['aria-hidden' => 'true']); ?>
        </div>
    <?php endif; ?>
    <?php if ($settings['icon_type'] == 'image' && !empty($settings['icon_image']['id'])) : ?>
        <div class="pxl-item--icon">
            <?php $img_icon  = pxl_get_image_by_size(array(
                'attach_id'  => $settings['icon_image']['id'],
                'thumb_size' => 'full',
            ));
            $thumbnail_icon    = $img_icon['thumbnail'];
            echo pxl_print_html($thumbnail_icon); ?>
        </div>
    <?php endif; ?>
                    <<?php echo esc_attr($title_tag); ?> class="pxl-item--title el-empty">
        <?php echo pxl_print_html($settings['title']); ?>
                    </<?php echo esc_attr($title_tag); ?>>


    <div class="pxl-item--bottom">
        <div class="pxl-item--bottom-content">
                    <<?php echo esc_attr($title_tag); ?> class="pxl-item--title el-empty">
                <?php echo pxl_print_html($settings['title']); ?>
                    </<?php echo esc_attr($title_tag); ?>>
            <div class="pxl-item--description el-empty"><?php echo pxl_print_html($settings['desc']); ?></div>
            <?php if (!empty($settings['link']['url'])) : ?>
        </div>
            <a class="pxl-item--link" href="<?php echo esc_url($settings['link']['url']); ?>">
                <span><?php echo esc_html($settings['link_text']); ?></span>
                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none">
                    <path d="M12.2513 9.06376L6.93876 14.3763C6.78906 14.526 6.58602 14.6101 6.37431 14.6101C6.1626 14.6101 5.95956 14.526 5.80985 14.3763C5.66015 14.2266 5.57605 14.0235 5.57605 13.8118C5.57605 13.6001 5.66015 13.3971 5.80985 13.2474L10.5586 8.49997L5.81118 3.75126C5.73706 3.67714 5.67826 3.58914 5.63814 3.49229C5.59803 3.39544 5.57738 3.29164 5.57738 3.18681C5.57738 3.08198 5.59803 2.97818 5.63814 2.88133C5.67826 2.78448 5.73706 2.69648 5.81118 2.62235C5.88531 2.54823 5.97331 2.48943 6.07016 2.44931C6.167 2.4092 6.27081 2.38855 6.37564 2.38855C6.48046 2.38855 6.58427 2.4092 6.68112 2.44931C6.77796 2.48943 6.86596 2.54823 6.94009 2.62235L12.2526 7.93485C12.3268 8.00897 12.3856 8.09701 12.4257 8.19392C12.4658 8.29083 12.4864 8.3947 12.4863 8.49958C12.4862 8.60446 12.4654 8.70829 12.425 8.8051C12.3847 8.90192 12.3256 8.98982 12.2513 9.06376Z" fill="currentColor"/>
                </svg>
            </a>
        <?php endif; ?>
    </div>
</div>
