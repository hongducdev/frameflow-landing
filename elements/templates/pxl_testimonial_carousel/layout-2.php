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
    'slide_direction'               => 'horizontal',
    'slide_percolumn'               => 1,
    'slide_mode'                    => 'slide',
    'center_slide'                  => (bool)$center,
    'slides_to_show'                => (int)$col_xl,
    'slides_to_show_xxl'            => (int)$col_xxl,
    'slides_to_show_lg'             => (int)$col_lg,
    'slides_to_show_md'             => (int)$col_md,
    'slides_to_show_sm'             => (int)$col_sm,
    'slides_to_show_xs'             => (int)$col_xs,
    'slides_to_scroll'              => (int)$slides_to_scroll,
    'arrow'                         => (bool)$arrows,
    'pagination'                    => (bool)$pagination,
    'pagination_type'               => $pagination_type,
    'autoplay'                      => (bool)$autoplay,
    'pause_on_hover'                => (bool)$pause_on_hover,
    'pause_on_interaction'          => true,
    'delay'                         => (int)$autoplay_speed,
    'loop'                          => (bool)$infinite,
    'speed'                         => (int)$speed
];
$widget->add_render_attribute('carousel', [
    'class'         => 'pxl-swiper-container',
    'dir'           => is_rtl() ? 'rtl' : 'ltr',
    'data-settings' => wp_json_encode($opts)
]);
if (isset($settings['testimonial']) && !empty($settings['testimonial']) && count($settings['testimonial'])): ?>
    <div class="pxl-swiper-slider pxl-testimonial-carousel pxl-testimonial-carousel2" <?php if ($drap !== false) : ?>data-cursor-drap="<?php echo esc_html('DRAG', 'frameflow'); ?>" <?php endif; ?>>
        <div class="pxl-carousel-inner">
            <div <?php pxl_print_html($widget->get_render_attribute_string('carousel')); ?>>
                <div class="pxl-swiper-wrapper">
                    <?php foreach ($settings['testimonial'] as $key => $value):
                        $title = isset($value['title']) ? $value['title'] : '';
                        $position = isset($value['position']) ? $value['position'] : '';
                        $avatar = isset($value['avatar']) ? $value['avatar'] : '';
                        $desc = isset($value['desc']) ? $value['desc'] : '';
                    ?>
                        <div class="pxl-swiper-slide">
                            <div class="pxl-item--inner <?php echo esc_attr($settings['pxl_animate']); ?>">
                                <div class="pxl-item--top">
                                    <div class="pxl-item--top-wrapper">
                                        <?php if (!empty($avatar['id'])) {
                                            $img = pxl_get_image_by_size(array(
                                                'attach_id'  => $avatar['id'],
                                                'thumb_size' => '124x124',
                                                'class' => 'no-lazyload',
                                            ));
                                            $thumbnail = $img['thumbnail']; ?>
                                            <div class="pxl-item--avatar ">
                                                <?php echo wp_kses_post($thumbnail); ?>
                                            </div>
                                        <?php } ?>
                                        <div class="pxl-item--info">
                                            <span class="pxl-item--title">
                                                <?php echo pxl_print_html($title); ?>
                                            </span>
                                            <p class="pxl-item--position"><?php echo pxl_print_html($position); ?></p>
                                        </div>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="20" viewBox="0 0 26 20" fill="none" class="pxl-item--icon">
                                        <path d="M2.30854 18.2262C0.806459 16.6308 0 14.8415 0 11.9408C0 6.83667 3.58312 2.26188 8.79375 0L10.096 2.00958C5.2325 4.64042 4.28167 8.05437 3.9025 10.2069C4.68563 9.80146 5.71083 9.66 6.71562 9.75333C9.34646 9.99687 11.4202 12.1567 11.4202 14.8415C11.4202 16.1952 10.8824 17.4934 9.92523 18.4507C8.96802 19.4079 7.66975 19.9456 6.31604 19.9456C4.75125 19.9456 3.255 19.231 2.30854 18.2262ZM16.8919 18.2262C15.3898 16.6308 14.5833 14.8415 14.5833 11.9408C14.5833 6.83667 18.1665 2.26188 23.3771 0L24.6794 2.00958C19.8158 4.64042 18.865 8.05437 18.4858 10.2069C19.269 9.80146 20.2942 9.66 21.299 9.75333C23.9298 9.99687 26.0035 12.1567 26.0035 14.8415C26.0035 16.1952 25.4658 17.4934 24.5086 18.4507C23.5513 19.4079 22.2531 19.9456 20.8994 19.9456C19.3346 19.9456 17.8383 19.231 16.8919 18.2262Z" fill="currentColor"/>
                                    </svg>
                                </div>
                                <p class="pxl-item--description"><?php echo pxl_print_html($desc); ?></p>
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