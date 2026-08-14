<div class="pxl-icon-box pxl-icon-box3 <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
    <div class="pxl-item--inner">
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
        <div class="pxl-item--description el-empty"><?php echo pxl_print_html($settings['desc_2']); ?></div>
    </div>
    <?php if (!empty($settings['link']['url'])): ?>
        <a href="<?php echo esc_url($settings['link']['url']); ?>" class="pxl-item--link" target="<?php echo esc_attr($settings['link']['is_external'] ? '_blank' : '_self'); ?>" rel="<?php echo esc_attr($settings['link']['nofollow'] ? 'nofollow' : ''); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                <path d="M16.6614 10.1301L11.3176 15.4738C11.1503 15.6412 10.9234 15.7352 10.6868 15.7352C10.4501 15.7352 10.2232 15.6412 10.0559 15.4738C9.88859 15.3065 9.79459 15.0796 9.79459 14.843C9.79459 14.6064 9.88859 14.3794 10.0559 14.2121L13.8789 10.3906H2.96875C2.73254 10.3906 2.50601 10.2968 2.33898 10.1297C2.17196 9.96272 2.07812 9.73619 2.07812 9.49998C2.07812 9.26377 2.17196 9.03723 2.33898 8.87021C2.50601 8.70319 2.73254 8.60935 2.96875 8.60935H13.8789L10.0574 4.7856C9.89007 4.61829 9.79607 4.39136 9.79607 4.15474C9.79607 3.91812 9.89007 3.6912 10.0574 3.52388C10.2247 3.35657 10.4516 3.26257 10.6882 3.26257C10.9249 3.26257 11.1518 3.35657 11.3191 3.52388L16.6629 8.86763C16.7459 8.95049 16.8118 9.04893 16.8566 9.15731C16.9015 9.26569 16.9246 9.38187 16.9244 9.49917C16.9243 9.61648 16.901 9.7326 16.8558 9.84088C16.8107 9.94915 16.7446 10.0474 16.6614 10.1301Z" fill="currentColor"/>
            </svg>
        </a> 
    <?php endif; ?>
</div>