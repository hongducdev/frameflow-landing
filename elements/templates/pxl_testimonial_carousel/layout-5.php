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
    <div class="pxl-swiper-slider pxl-testimonial-carousel pxl-testimonial-carousel5" <?php if ($drap !== false) : ?>data-cursor-drap="<?php echo esc_html('DRAG', 'frameflow'); ?>" <?php endif; ?>>
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
                                <?php if (!empty($avatar['id'])) {
                                    $img = pxl_get_image_by_size(array(
                                        'attach_id'  => $avatar['id'],
                                        'thumb_size' => '408x604',
                                        'class' => 'no-lazyload',
                                    ));
                                    $thumbnail = $img['thumbnail']; ?>
                                    <div class="pxl-item--avatar ">
                                        <?php echo wp_kses_post($thumbnail); ?>
                                    </div>
                                    <?php } ?>
                                <div class="pxl-item--content">
                                    <p class="pxl-item--description"><?php echo pxl_print_html($desc); ?></p>
                                    <div class="pxl-item--info">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="19" viewBox="0 0 23 19" fill="none" class="pxl-item--icon">
                                            <path d="M4.214 1.53104C4.43067 0.632873 5.23436 1.56919e-05 6.15828 3.79617e-05L8.00005 8.23546e-05C9.1046 0.000108978 10 0.895532 10 2.00008V17C10 18.1046 9.10457 19 8 19H2.53982C1.2455 19 0.292073 17.7892 0.595593 16.531L4.214 1.53104Z" fill="currentColor"/>
                                            <path d="M17.214 1.53104C17.4307 0.632873 18.2344 1.56919e-05 19.1583 3.79617e-05L21 8.23546e-05C22.1046 0.000108978 23 0.895532 23 2.00008V17C23 18.1046 22.1046 19 21 19H15.5398C14.2455 19 13.2921 17.7892 13.5956 16.531L17.214 1.53104Z" fill="currentColor"/>
                                        </svg>
                                        <div class="pxl-item--info-inner">
                                            <span class="pxl-item--title">
                                                <?php echo pxl_print_html($title); ?>
                                            </span>
                                            <p class="pxl-item--position"><?php echo pxl_print_html($position); ?></p>
                                        </div>
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
                <div class="pxl-swiper-arrow-wrap style-1">
                    <?php
                    if (!frameflow_include_swiper_arrows($widget, false)) {
                    ?>
                    <div class="pxl-swiper-arrow pxl-swiper-arrow-prev">
                        <svg xmlns="http://www.w3.org/2000/svg" width="9" height="15" viewBox="0 0 9 15" fill="none">
                            <path d="M0.276511 7.85319L6.52651 14.1032C6.70263 14.2793 6.9415 14.3783 7.19057 14.3783C7.43965 14.3783 7.67852 14.2793 7.85464 14.1032C8.03076 13.9271 8.1297 13.6882 8.1297 13.4391C8.1297 13.1901 8.03076 12.9512 7.85464 12.7751L2.26792 7.18991L7.85307 1.60319C7.94028 1.51598 8.00946 1.41245 8.05665 1.29851C8.10385 1.18457 8.12814 1.06245 8.12814 0.939126C8.12814 0.815799 8.10385 0.693678 8.05665 0.579738C8.00946 0.465798 7.94028 0.36227 7.85307 0.275064C7.76587 0.187858 7.66234 0.118682 7.5484 0.0714868C7.43446 0.0242913 7.31234 -9.18863e-10 7.18901 0C7.06568 9.18864e-10 6.94356 0.0242913 6.82962 0.0714868C6.71568 0.118682 6.61215 0.187858 6.52495 0.275064L0.27495 6.52506C0.187652 6.61226 0.118426 6.71584 0.0712423 6.82985C0.0240593 6.94386 -0.000154495 7.06606 -8.58307e-06 7.18945C0.000136375 7.31284 0.0246372 7.43498 0.0720892 7.54888C0.11954 7.66278 0.189009 7.76619 0.276511 7.85319Z" fill="currentColor"/>
                        </svg>
                    </div>
                    <div class="pxl-swiper-arrow pxl-swiper-arrow-next">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M14.4132 10.6632L8.16325 16.9132C7.98713 17.0894 7.74826 17.1883 7.49918 17.1883C7.25011 17.1883 7.01124 17.0894 6.83512 16.9132C6.659 16.7371 6.56006 16.4983 6.56006 16.2492C6.56006 16.0001 6.659 15.7612 6.83512 15.5851L12.4218 9.99997L6.83668 4.41325C6.74948 4.32604 6.6803 4.22251 6.63311 4.10857C6.58591 3.99463 6.56162 3.87251 6.56162 3.74918C6.56162 3.62586 6.58591 3.50374 6.63311 3.3898C6.6803 3.27586 6.74948 3.17233 6.83668 3.08512C6.92389 2.99792 7.02742 2.92874 7.14136 2.88155C7.2553 2.83435 7.37742 2.81006 7.50075 2.81006C7.62408 2.81006 7.7462 2.83435 7.86014 2.88155C7.97408 2.92874 8.0776 2.99792 8.16481 3.08512L14.4148 9.33512C14.5021 9.42232 14.5713 9.5259 14.6185 9.63991C14.6657 9.75392 14.6899 9.87612 14.6898 9.99951C14.6896 10.1229 14.6651 10.245 14.6177 10.3589C14.5702 10.4728 14.5007 10.5763 14.4132 10.6632Z" fill="currentColor"/>
                        </svg>
                    </div>
                    <?php } ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
<?php endif; ?>