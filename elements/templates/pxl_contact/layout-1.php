<?php $title_tag = frameflow_widget_sanitize_title_tag(!empty($settings['title_tag']) ? $settings['title_tag'] : '', 'h5'); ?>
<div class="pxl-contact <?php echo esc_attr($settings['style']); ?> <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
    <div class="pxl-item--header">
        <?php if (!empty($settings['pxl_icon']['value'])) : ?>
            <div class="pxl-item--icon">
                <?php \Elementor\Icons_Manager::render_icon($settings['pxl_icon'], ['aria-hidden' => 'true']); ?>
            </div>
        <?php endif; ?>
        <?php if ($settings['style'] === 'style-3' && !empty($settings['link']['url'])) : ?>
            <div class="pxl-item--link">
                <a
                    href="<?php echo esc_url($settings['link']['url']); ?>"
                    target="<?php echo esc_attr(!empty($settings['link']['is_external']) ? '_blank' : '_self'); ?>"
                    rel="<?php echo esc_attr(!empty($settings['link']['nofollow']) ? 'nofollow' : ''); ?>"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none">
                        <path d="M2.61902 1.11523H15.8848V14.381H14.3966V3.66009L2.38773 15.669L1.33105 14.6129L13.3405 2.60342H2.61902V1.11523Z" fill="#111111"/>
                    </svg>
                </a>
            </div>
        <?php endif; ?>
    </div>
    <div class="pxl-item--content">
        <?php if (!empty($settings['title'])) : ?>
            <<?php echo esc_attr($title_tag); ?> class="pxl-item--title el-empty">
                <?php echo pxl_print_html($settings['title']); ?>
            </<?php echo esc_attr($title_tag); ?>>
        <?php endif; ?>
        <?php if (!empty($settings['description'])) : ?>
            <div class="pxl-item--description el-empty">
                <?php echo pxl_print_html($settings['description']); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
