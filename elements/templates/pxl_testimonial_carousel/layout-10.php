<?php
$col_xs = $widget->get_setting('col_xs', '');
$col_sm = $widget->get_setting('col_sm', '');
$col_md = $widget->get_setting('col_md', '');
$col_lg = $widget->get_setting('col_lg', '');
$col_xl = $widget->get_setting('col_xl', '');
$col_xxl = $widget->get_setting('col_xxl', '');
if ($col_xxl == 'inherit') {
    $col_xxl = $col_xl;
}
$slides_to_scroll = $widget->get_setting('slides_to_scroll');
$arrows = $widget->get_setting('arrows', false);
$pagination = $widget->get_setting('pagination', false);
$pagination_type = $widget->get_setting('pagination_type', 'bullets');
$arrows_type = $widget->get_setting('arrows_type', '');
$arrow_full_content_with_space = $widget->get_setting('arrow_full_content_with_space', 'none');
$arrow_full_content_with_space_value = (int) $widget->get_setting('arrow_full_content_with_space_value', 1200);
$pause_on_hover = $widget->get_setting('pause_on_hover', false);
$autoplay = $widget->get_setting('autoplay', false);
$autoplay_speed = $widget->get_setting('autoplay_speed', '5000');
$infinite = $widget->get_setting('infinite', false);
$speed = $widget->get_setting('speed', '500');
$drap = $widget->get_setting('drap', false);
$center = $widget->get_setting('center', false);
$opts = [
    'slide_direction' => 'horizontal',
    'slide_percolumn' => 1,
    'slide_mode' => 'slide',
    'center_slide' => (bool) $center,
    'slides_to_show' => (int) $col_xl,
    'slides_to_show_xxl' => (int) $col_xxl,
    'slides_to_show_lg' => (int) $col_lg,
    'slides_to_show_md' => (int) $col_md,
    'slides_to_show_sm' => (int) $col_sm,
    'slides_to_show_xs' => (int) $col_xs,
    'slides_to_scroll' => (int) $slides_to_scroll,
    'arrow' => (bool) $arrows,
    'pagination' => (bool) $pagination,
    'pagination_type' => $pagination_type,
    'autoplay' => (bool) $autoplay,
    'pause_on_hover' => (bool) $pause_on_hover,
    'pause_on_interaction' => true,
    'delay' => (int) $autoplay_speed,
    'loop' => (bool) $infinite,
    'speed' => (int) $speed,
];
$widget->add_render_attribute('carousel', [
    'class' => 'pxl-swiper-container',
    'dir' => is_rtl() ? 'rtl' : 'ltr',
    'data-settings' => wp_json_encode($opts),
]);
if (isset($settings['testimonial']) && !empty($settings['testimonial']) && count($settings['testimonial'])): ?>
    <div class="pxl-swiper-slider pxl-testimonial-carousel pxl-testimonial-carousel10" <?php if ($drap !== false) : ?>data-cursor-drap="<?php echo esc_html('DRAG', 'frameflow'); ?>" <?php endif; ?>>
        <div class="pxl-carousel-inner">
            <div <?php pxl_print_html($widget->get_render_attribute_string('carousel')); ?>>
                <div class="pxl-swiper-wrapper">
                    <?php foreach ($settings['testimonial'] as $key => $value):
                        $title = isset($value['title']) ? $value['title'] : '';
                        $position = isset($value['position']) ? $value['position'] : '';
                        $desc = isset($value['desc']) ? $value['desc'] : '';
                    ?>
                        <div class="pxl-swiper-slide">
                            <div class="pxl-item--inner <?php echo esc_attr($settings['pxl_animate']); ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="34" height="26" viewBox="0 0 34 26" fill="none">
                                    <path d="M3.01845 23.7587C1.05446 21.679 0 19.3465 0 15.5654C0 8.9119 4.68499 2.94845 11.498 0L13.2007 2.61958C6.84157 6.04899 5.59834 10.4992 5.10257 13.3051C6.12652 12.7766 7.467 12.5922 8.78078 12.7139C12.2206 13.0314 14.9321 15.8468 14.9321 19.3465C14.9321 21.1111 14.229 22.8035 12.9774 24.0512C11.7258 25.299 10.0283 26 8.25831 26C6.21233 26 4.25596 25.0685 3.01845 23.7587ZM22.0864 23.7587C20.1224 21.679 19.0679 19.3465 19.0679 15.5654C19.0679 8.9119 23.7529 2.94845 30.5659 0L32.2686 2.61958C25.9095 6.04899 24.6663 10.4992 24.1705 13.3051C25.1944 12.7766 26.5349 12.5922 27.8487 12.7139C31.2885 13.0314 34 15.8468 34 19.3465C34 21.1111 33.2969 22.8035 32.0453 24.0512C30.7937 25.299 29.0962 26 27.3262 26C25.2802 26 23.3239 25.0685 22.0864 23.7587Z" fill="#B49070"/>
                                </svg>
                                <?php if (!empty($desc)): ?>
                                    <div class="pxl-item--desc"><?php echo wp_kses_post($desc); ?></div>
                                <?php endif; ?>
                                <?php if (!empty($title)): ?>
                                    <h6 class="pxl-item--title"><?php echo esc_html($title); ?></h6>
                                <?php endif; ?>
                                <?php if (!empty($position)): ?>
                                    <div class="pxl-item--position"><?php echo esc_html($position); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php if ($pagination !== false || $arrows !== false): ?>
            <div class="pxl-swiper-bottom ">
                <?php if ($pagination !== false): ?>
                    <div class="pxl-swiper-dots style-1"></div>
                <?php endif; ?>
            </div>
            <?php if ($arrows !== false): ?>
                <?php
                $arrow_space_width = max(0, $arrow_full_content_with_space_value) . 'px';
                $arrow_wrap_style = '';
                if ($arrow_full_content_with_space === 'end') {
                    $arrow_wrap_style = 'padding-right: max(15px, calc((100% - ' . $arrow_space_width . ') / 2));';
                }
                $arrow_wrap_style_attr = $arrow_wrap_style !== '' ? ' style="' . esc_attr($arrow_wrap_style) . '"' : '';
                ?>
                <div class="pxl-swiper-arrow-wrap style-2"<?php echo wp_kses_post($arrow_wrap_style_attr); ?>>
                    <?php
                    frameflow_include_swiper_arrows($widget);
                    ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
<?php endif; ?>
