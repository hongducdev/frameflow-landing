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
$arrows_type = $widget->get_setting('arrows_type', 'style-1');
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
if (
    isset($settings['testimonial']) &&
    !empty($settings['testimonial']) &&
    count($settings['testimonial'])
):
    ?>
    <div class="pxl-swiper-slider pxl-testimonial-carousel pxl-testimonial-carousel15" <?php if (
        $drap !== false
    ): ?>data-cursor-drap="<?php echo esc_html('DRAG', 'frameflow'); ?>" <?php endif; ?>>
        <div class="pxl-carousel-inner">
            <div <?php pxl_print_html($widget->get_render_attribute_string('carousel')); ?>>
                <div class="pxl-swiper-wrapper">
                    <?php foreach ($settings['testimonial'] as $value):

                        $title = isset($value['title']) ? $value['title'] : '';
                        $position = isset($value['position'])
                            ? $value['position']
                            : '';
                        $avatar = isset($value['avatar']) ? $value['avatar'] : '';
                        $desc = isset($value['desc']) ? $value['desc'] : '';
                        ?>
                        <div class="pxl-swiper-slide">
                            <div class="pxl-item--inner <?php echo esc_attr(
                                $settings['pxl_animate'],
                            ); ?>">
                                <svg class="pxl-item--shape" xmlns="http://www.w3.org/2000/svg" fill="none" aria-hidden="true">
                                    <path class="pxl-item--shape-fill" fill="currentColor"/>
                                    <path class="pxl-item--shape-stroke" fill="none" stroke="rgba(17,17,17,0.13)" stroke-width="1" vector-effect="non-scaling-stroke"/>
                                </svg>

                                <div class="pxl-item--quote" aria-hidden="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="23" viewBox="0 0 30 23" fill="none">
                                        <path d="M2.69663 21.1397C1.01124 19.2794 0 17.25 0 13.8676C0 7.94853 4.21348 2.70588 10.1124 0L11.6292 2.19853C6.06742 5.24265 4.88764 9.13235 4.55056 11.6691C5.39326 11.1618 6.57303 10.9926 7.75281 11.1618C10.7865 11.5 13.1461 13.8676 13.1461 17.0809C13.1461 18.6029 12.4719 20.125 11.4607 21.3088C10.2809 22.4926 8.93258 23 7.24719 23C5.39326 23 3.70787 22.1544 2.69663 21.1397ZM19.5506 21.1397C17.8652 19.2794 16.8539 17.25 16.8539 13.8676C16.8539 7.94853 21.0674 2.70588 26.9663 0L28.4831 2.19853C22.9213 5.24265 21.7416 9.13235 21.4045 11.6691C22.2472 11.1618 23.427 10.9926 24.6067 11.1618C27.6405 11.5 30 13.8676 30 17.0809C30 18.6029 29.3258 20.125 28.3146 21.3088C27.3034 22.4926 25.7865 23 24.1011 23C22.2472 23 20.5618 22.1544 19.5506 21.1397Z" fill="currentColor"/>
                                    </svg>
                                </div>

                                <?php if (!empty($desc)): ?>
                                    <p class="pxl-item--description"><?php echo pxl_print_html(
                                        $desc,
                                    ); ?></p>
                                <?php endif; ?>

                                <div class="pxl-item--bottom">
                                    <div class="pxl-item--author">
                                        <?php if (!empty($avatar['id'])) {
                                            $img = pxl_get_image_by_size([
                                                'attach_id' => $avatar['id'],
                                                'thumb_size' => '130x130',
                                                'class' => 'no-lazyload',
                                            ]);
                                            ?>
                                            <div class="pxl-item--avatar">
                                                <?php echo wp_kses_post($img['thumbnail']); ?>
                                            </div>
                                        <?php
                                        } ?>
                                        <div class="pxl-item--info">
                                            <?php if (!empty($title)): ?>
                                                <span class="pxl-item--title"><?php echo pxl_print_html(
                                                    $title,
                                                ); ?></span>
                                            <?php endif; ?>
                                            <?php if (!empty($position)): ?>
                                                <span class="pxl-item--position"><?php echo pxl_print_html(
                                                    $position,
                                                ); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    endforeach; ?>
                </div>
            </div>

            <?php if ($arrows !== false): ?>
                <div class="pxl-swiper-arrow-wrap <?php echo esc_attr(
                    $arrows_type,
                ); ?>">
                    <?php frameflow_include_swiper_arrows($widget); ?>
                </div>
            <?php endif; ?>
        </div>

        <?php if ($pagination !== false): ?>
            <div class="pxl-swiper-bottom">
                <div class="pxl-swiper-dots style-1"></div>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>
