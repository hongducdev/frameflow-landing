<?php $title_tag = frameflow_widget_sanitize_title_tag(!empty($settings['title_tag']) ? $settings['title_tag'] : '', 'h5'); ?>
<div class="pxl-icon-box pxl-icon-box2 <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
    <div class="pxl-item--header">
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
        <?php if (!empty($settings['link']['url'])): ?>
            <a href="<?php echo esc_url($settings['link']['url']); ?>" class="pxl-item--link" target="<?php echo esc_attr($settings['link']['is_external'] ? '_blank' : '_self'); ?>" rel="<?php echo esc_attr($settings['link']['nofollow'] ? 'nofollow' : ''); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                    <path d="M15.141 4.75V12.4688C15.141 12.705 15.0471 12.9315 14.8801 13.0985C14.7131 13.2655 14.4865 13.3594 14.2503 13.3594C14.0141 13.3594 13.7876 13.2655 13.6206 13.0985C13.4535 12.9315 13.3597 12.705 13.3597 12.4688V6.90234L5.38045 14.8801C5.21314 15.0474 4.98621 15.1414 4.74959 15.1414C4.51297 15.1414 4.28605 15.0474 4.11873 14.8801C3.95142 14.7128 3.85742 14.4859 3.85742 14.2493C3.85742 14.0126 3.95142 13.7857 4.11873 13.6184L12.098 5.64062H6.53158C6.29538 5.64062 6.06884 5.54679 5.90182 5.37977C5.73479 5.21274 5.64096 4.98621 5.64096 4.75C5.64096 4.51379 5.73479 4.28726 5.90182 4.12023C6.06884 3.95321 6.29538 3.85938 6.53158 3.85938H14.2503C14.4865 3.85938 14.7131 3.95321 14.8801 4.12023C15.0471 4.28726 15.141 4.51379 15.141 4.75Z" fill="currentColor"/>
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                    <path d="M15.141 4.75V12.4688C15.141 12.705 15.0471 12.9315 14.8801 13.0985C14.7131 13.2655 14.4865 13.3594 14.2503 13.3594C14.0141 13.3594 13.7876 13.2655 13.6206 13.0985C13.4535 12.9315 13.3597 12.705 13.3597 12.4688V6.90234L5.38045 14.8801C5.21314 15.0474 4.98621 15.1414 4.74959 15.1414C4.51297 15.1414 4.28605 15.0474 4.11873 14.8801C3.95142 14.7128 3.85742 14.4859 3.85742 14.2493C3.85742 14.0126 3.95142 13.7857 4.11873 13.6184L12.098 5.64062H6.53158C6.29538 5.64062 6.06884 5.54679 5.90182 5.37977C5.73479 5.21274 5.64096 4.98621 5.64096 4.75C5.64096 4.51379 5.73479 4.28726 5.90182 4.12023C6.06884 3.95321 6.29538 3.85938 6.53158 3.85938H14.2503C14.4865 3.85938 14.7131 3.95321 14.8801 4.12023C15.0471 4.28726 15.141 4.51379 15.141 4.75Z" fill="currentColor"/>
                </svg>
            </a>
        <?php endif; ?>
    </div>
                <<?php echo esc_attr($title_tag); ?> class="pxl-item--title el-empty">
        <?php echo pxl_print_html($settings['title']); ?>
                </<?php echo esc_attr($title_tag); ?>>
    <div class="pxl-item--description el-empty"><?php echo pxl_print_html($settings['desc_2']); ?></div>
</div>
