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
    <div class="pxl-swiper-slider pxl-testimonial-carousel pxl-testimonial-carousel3" <?php if ($drap !== false) : ?>data-cursor-drap="<?php echo esc_html('DRAG', 'frameflow'); ?>" <?php endif; ?>>
        <div class="pxl-carousel-inner">
            <div <?php pxl_print_html($widget->get_render_attribute_string('carousel')); ?>>
                <div class="pxl-swiper-wrapper">
                    <?php foreach ($settings['testimonial'] as $key => $value):
                        $title = isset($value['title']) ? $value['title'] : '';
                        $position = isset($value['position']) ? $value['position'] : '';
                        $avatar = isset($value['avatar']) ? $value['avatar'] : '';
                        $desc = isset($value['desc']) ? $value['desc'] : '';
                        $client = isset($value['client']) ? $value['client'] : '';
                    ?>
                        <div class="pxl-swiper-slide">
                            <div class="pxl-item--inner <?php echo esc_attr($settings['pxl_animate']); ?>">
                                <?php if (!empty($client['value'])): ?>
                                    <div class="pxl-item--client">
                                        <?php \Elementor\Icons_Manager::render_icon($client, ['aria-hidden' => 'true']); ?>
                                    </div>
                                <?php endif; ?>
                                <p class="pxl-item--description"><?php echo pxl_print_html($desc); ?></p>
                                <div class="pxl-item--bottom">
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
                                    <div class="pxl-item--icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="17" viewBox="0 0 24 17" fill="none">
                                            <path d="M9.9 6.21C9.9 10.98 6.03 15.3 1.26 16.11V13.23C4.05 12.69 6.21 10.44 6.21 8.19C5.76 8.55 5.04 8.82 3.87 8.82C1.89 8.82 0 7.38 0 4.59C0 1.98 1.89 0 4.68 0C7.29 0 9.9 2.16 9.9 6.21ZM23.04 6.21C23.04 10.98 19.17 15.3 14.4 16.11V13.23C17.19 12.69 19.35 10.44 19.35 8.19C18.9 8.55 18.18 8.82 17.01 8.82C15.03 8.82 13.14 7.38 13.14 4.59C13.14 1.98 15.03 0 17.82 0C20.43 0 23.04 2.16 23.04 6.21Z" fill="currentColor"/>
                                        </svg>
                                    </div>
                                </div>
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
                <div class="pxl-swiper-arrow-wrap style-3">
                    <?php
                    frameflow_include_swiper_arrows($widget, 'style-3');
                    ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
<?php endif; ?>