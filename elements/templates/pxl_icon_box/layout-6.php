<?php $title_tag = frameflow_widget_sanitize_title_tag(!empty($settings['title_tag']) ? $settings['title_tag'] : '', 'h5'); ?>
<div class="pxl-icon-box pxl-icon-box6 <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
    <?php if ($settings['icon_type'] == 'icon' && !empty($settings['pxl_icon']['value'])) : ?>
        <div class="pxl-item--icon pxl-flex-center">
            <?php \Elementor\Icons_Manager::render_icon($settings['pxl_icon'], ['aria-hidden' => 'true']); ?>
        </div>
    <?php endif; ?>
    <?php if ($settings['icon_type'] == 'image' && !empty($settings['icon_image']['id'])) : ?>
        <div class="pxl-item--icon pxl-flex-center pxl-mr-25">
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
    <div class="pxl-item--description el-empty"><?php echo pxl_print_html($settings['desc']); ?></div>
    <a href="<?php echo esc_url($settings['link']['url']); ?>" class="pxl-item--link">
        <?php echo esc_html($settings['link_text']); ?>
        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none">
            <path d="M12.2513 9.06376L6.93879 14.3763C6.78909 14.526 6.58605 14.6101 6.37434 14.6101C6.16263 14.6101 5.95959 14.526 5.80988 14.3763C5.66018 14.2266 5.57608 14.0235 5.57608 13.8118C5.57608 13.6001 5.66018 13.3971 5.80988 13.2474L10.5586 8.49997L5.81121 3.75126C5.73709 3.67714 5.67829 3.58914 5.63817 3.49229C5.59806 3.39544 5.57741 3.29164 5.57741 3.18681C5.57741 3.08198 5.59806 2.97818 5.63817 2.88133C5.67829 2.78448 5.73709 2.69648 5.81121 2.62235C5.88534 2.54823 5.97334 2.48943 6.07019 2.44931C6.16704 2.4092 6.27084 2.38855 6.37567 2.38855C6.48049 2.38855 6.5843 2.4092 6.68115 2.44931C6.77799 2.48943 6.86599 2.54823 6.94012 2.62235L12.2526 7.93485C12.3268 8.00897 12.3857 8.09701 12.4258 8.19392C12.4659 8.29083 12.4865 8.3947 12.4863 8.49958C12.4862 8.60446 12.4654 8.70829 12.425 8.8051C12.3847 8.90192 12.3257 8.98982 12.2513 9.06376Z" fill="currentColor"/>
        </svg>
    </a>
</div>
