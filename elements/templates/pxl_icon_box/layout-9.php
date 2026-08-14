<?php $title_tag = frameflow_widget_sanitize_title_tag(!empty($settings['title_tag']) ? $settings['title_tag'] : '', 'h5'); ?>
<div class="pxl-icon-box pxl-icon-box9 <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
    <div class="pxl-item--content">
        <?php if (!empty($settings['image']['id'])) : ?>
            <div class="pxl-item--image">
                <?php echo wp_get_attachment_image($settings['image']['id'], 'full'); ?>
            </div>
        <?php endif; ?>
        <div class="pxl-item--info">
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
            <div class="pxl-item--description el-empty">
                <?php echo pxl_print_html($settings['desc']); ?>
            </div>
        </div>
    </div>
    <?php if (!empty($settings['link']['url'])) : ?>
        <a class="pxl-item--link btn btn-default pxl-icon--right" href="<?php echo esc_url($settings['link']['url']); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                <path d="M10.089 7.46427L5.71403 11.8393C5.59074 11.9626 5.42354 12.0318 5.24919 12.0318C5.07483 12.0318 4.90763 11.9626 4.78434 11.8393C4.66106 11.716 4.5918 11.5488 4.5918 11.3744C4.5918 11.2001 4.66106 11.0329 4.78434 10.9096L8.69504 6.99998L4.78544 3.08927C4.72439 3.02823 4.67597 2.95576 4.64293 2.876C4.60989 2.79624 4.59289 2.71076 4.59289 2.62443C4.59289 2.5381 4.60989 2.45262 4.64293 2.37286C4.67597 2.2931 4.72439 2.22063 4.78544 2.15959C4.84648 2.09854 4.91895 2.05012 4.99871 2.01708C5.07847 1.98404 5.16395 1.96704 5.25028 1.96704C5.33661 1.96704 5.42209 1.98404 5.50185 2.01708C5.58161 2.05012 5.65408 2.09854 5.71512 2.15959L10.0901 6.53459C10.1512 6.59563 10.1997 6.66813 10.2327 6.74794C10.2657 6.82774 10.2827 6.91328 10.2826 6.99966C10.2825 7.08603 10.2653 7.17153 10.2321 7.25126C10.1989 7.33099 10.1503 7.40338 10.089 7.46427Z" fill="currentColor"/>
            </svg>
            <div class="btn-text-wrap">
                <span>
                    <?php echo esc_html($settings['link_text']); ?>
                </span>
                <span>
                    <?php echo esc_html($settings['link_text']); ?>
                </span>
            </div>
        </a>
    <?php endif; ?>
</div>
