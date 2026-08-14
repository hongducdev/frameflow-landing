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
    <div class="pxl-swiper-slider pxl-testimonial-carousel pxl-testimonial-carousel4" <?php if ($drap !== false) : ?>data-cursor-drap="<?php echo esc_html('DRAG', 'frameflow'); ?>" <?php endif; ?>>
        <div class="pxl-carousel-inner">
            <div <?php pxl_print_html($widget->get_render_attribute_string('carousel')); ?>>
                <div class="pxl-swiper-wrapper">
                    <?php foreach ($settings['testimonial'] as $key => $value):
                        $title = isset($value['title']) ? $value['title'] : '';
                        $position = isset($value['position']) ? $value['position'] : '';
                        $avatar = isset($value['avatar']) ? $value['avatar'] : '';
                        $star = isset($value['star']) ? $value['star'] : '';
                        $desc = isset($value['desc']) ? $value['desc'] : '';
                        $number = isset($value['number']) ? $value['number'] : '';
                        $number_title = isset($value['number_title']) ? $value['number_title'] : '';
                    ?>
                        <div class="pxl-swiper-slide">
                            <div class="pxl-item--inner <?php echo esc_attr($settings['pxl_animate']); ?>">
                                <div class="pxl-item--icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="15" viewBox="0 0 19 15" fill="none">
                                        <path d="M1.70787 13.7868C0.640449 12.5735 0 11.25 0 9.04412C0 5.18382 2.66854 1.76471 6.4045 0L7.36517 1.43382C3.8427 3.41912 3.09551 5.95588 2.88202 7.6103C3.41573 7.27941 4.16292 7.16912 4.91011 7.27941C6.83146 7.5 8.32584 9.04412 8.32584 11.1397C8.32584 12.1324 7.89888 13.125 7.25843 13.8971C6.51124 14.6691 5.6573 15 4.58989 15C3.41573 15 2.34831 14.4485 1.70787 13.7868ZM12.382 13.7868C11.3146 12.5735 10.6742 11.25 10.6742 9.04412C10.6742 5.18382 13.3427 1.76471 17.0787 0L18.0393 1.43382C14.5169 3.41912 13.7697 5.95588 13.5562 7.6103C14.0899 7.27941 14.8371 7.16912 15.5843 7.27941C17.5056 7.5 19 9.04412 19 11.1397C19 12.1324 18.573 13.125 17.9326 13.8971C17.2921 14.6691 16.3315 15 15.264 15C14.0899 15 13.0225 14.4485 12.382 13.7868Z" fill="currentColor"/>
                                    </svg>
                                </div>
                                <div class="pxl-item--top">
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
                                            <div class="pxl-item--star">
                                                <?php for ($i = 1; $i <= $star; $i++): ?>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                                        <g clip-path="url(#clip0_1054_927)">
                                                            <path d="M14 5.4091L8.913 5.07466L6.99721 0.261719L5.08143 5.07466L0 5.4091L3.89741 8.7184L2.61849 13.7384L6.99721 10.9707L11.376 13.7384L10.097 8.7184L14 5.4091Z" fill="currentColor"/>
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_1054_927">
                                                            <rect width="14" height="14" fill="white"/>
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                <?php endfor; ?>
                                            </div>
                                        </span>
                                        <p class="pxl-item--position"><?php echo pxl_print_html($position); ?></p>
                                    </div>
                                </div>
                                <p class="pxl-item--description"><?php echo pxl_print_html($desc); ?></p>
                                <div class="pxl-item--number">
                                    <span class="pxl-item--number-value">
                                        <?php echo pxl_print_html($number); ?>
                                    </span>
                                    <span class="pxl-item--number-title">
                                        <?php echo pxl_print_html($number_title); ?>
                                    </span>
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
                <?php
                $arrow_space_width = max(0, $arrow_full_content_with_space_value) . 'px';
                $arrow_wrap_style = '';
                if ($arrow_full_content_with_space === 'end') {
                    $arrow_wrap_style = 'padding-right: max(15px, calc((100% - ' . $arrow_space_width . ') / 2));';
                }
                $arrow_wrap_style_attr = $arrow_wrap_style !== '' ? ' style="' . esc_attr($arrow_wrap_style) . '"' : '';
                ?>
                <div class="pxl-swiper-arrow-wrap <?php echo esc_attr($arrows_type); ?>"<?php echo wp_kses_post($arrow_wrap_style_attr); ?>>
                    <?php
                    frameflow_include_swiper_arrows($widget);
                    ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
<?php endif; ?>