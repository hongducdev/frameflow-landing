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
    <div class="pxl-swiper-slider pxl-testimonial-carousel pxl-testimonial-carousel7" <?php if ($drap !== false) : ?>data-cursor-drap="<?php echo esc_html('DRAG', 'frameflow'); ?>" <?php endif; ?>>
        <div class="pxl-carousel-inner">
            <div <?php pxl_print_html($widget->get_render_attribute_string('carousel')); ?>>
                <div class="pxl-swiper-wrapper">
                    <?php foreach ($settings['testimonial'] as $key => $value):
                        $title = isset($value['title']) ? $value['title'] : '';
                        $position = isset($value['position']) ? $value['position'] : '';
                        $avatar = isset($value['avatar']) ? $value['avatar'] : '';
                        $desc = isset($value['desc']) ? $value['desc'] : '';
                        $star = isset($value['star']) ? $value['star'] : '';
                    ?>
                        <div class="pxl-swiper-slide">
                            <div class="pxl-item--inner <?php echo esc_attr($settings['pxl_animate']); ?>">
                                <?php if (!empty($avatar['id'])) {
                                    $img = pxl_get_image_by_size(array(
                                        'attach_id'  => $avatar['id'],
                                        'thumb_size' => '540x716',
                                        'class' => 'no-lazyload',
                                    ));
                                    $thumbnail = $img['thumbnail']; ?>
                                    <div class="pxl-item--avatar ">
                                        <?php echo wp_kses_post($thumbnail); ?>
                                    </div>
                                    <?php } ?>
                                <div class="pxl-item--content">
                                    <div class="pxl-item--info">
                                        <div class="pxl-item--qoute">
                                            <span></span>
                                            <span></span>
                                        </div>
                                        <div class="pxl-item--title-wrapper">
                                            <span class="pxl-item--title">
                                                <?php echo pxl_print_html($title); ?>
                                            </span>
                                            <?php if (!empty($star)) { ?>
                                                <div class="pxl-item--stars">
                                                    <?php for ($i = 1; $i <= $star; $i++) { ?>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                                          <g clip-path="url(#clip0_1850_489)">
                                                            <path d="M14 5.4091L8.913 5.07466L6.99721 0.261719L5.08143 5.07466L0 5.4091L3.89741 8.7184L2.61849 13.7384L6.99721 10.9707L11.376 13.7384L10.097 8.7184L14 5.4091Z" fill="#FF5B04"/>
                                                          </g>
                                                          <defs>
                                                            <clipPath id="clip0_1850_489">
                                                              <rect width="14" height="14" fill="white"/>
                                                            </clipPath>
                                                          </defs>
                                                        </svg>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <p class="pxl-item--position"><?php echo pxl_print_html($position); ?></p>
                                    </div>
                                    <p class="pxl-item--description"><?php echo pxl_print_html($desc); ?></p>
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
                <div class="pxl-swiper-arrow-wrap <?php echo esc_attr($arrows_type); ?>">
                    <?php
                    frameflow_include_swiper_arrows($widget);
                    ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
<?php endif; ?>