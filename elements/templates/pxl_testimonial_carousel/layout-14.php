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
$arrow_full_content_with_space = $widget->get_setting(
    'arrow_full_content_with_space',
    'none',
);
$arrow_full_content_with_space_value = (int) $widget->get_setting(
    'arrow_full_content_with_space_value',
    1200,
);
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
    <div class="pxl-swiper-slider pxl-testimonial-carousel pxl-testimonial-carousel14" <?php if (
        $drap !== false
    ): ?>data-cursor-drap="<?php echo esc_html('DRAG', 'frameflow'); ?>" <?php endif; ?>>
        <div class="pxl-carousel-inner">
            <div <?php pxl_print_html($widget->get_render_attribute_string('carousel')); ?>>
                <div class="pxl-swiper-wrapper">
                    <?php foreach ($settings['testimonial'] as $value):
                        $title = isset($value['title']) ? $value['title'] : '';
                        $avatar = isset($value['avatar']) ? $value['avatar'] : '';
                        $desc = isset($value['desc']) ? $value['desc'] : '';
                        ?>
                        <div class="pxl-swiper-slide">
                            <div class="pxl-item--inner <?php echo esc_attr(
                                $settings['pxl_animate'],
                            ); ?>">
                                <?php if (!empty($avatar['id'])) {
                                    $img = pxl_get_image_by_size([
                                        'attach_id' => $avatar['id'],
                                        'thumb_size' => '350x160',
                                        'class' => 'no-lazyload',
                                    ]);
                                    ?>
                                    <div class="pxl-item--avatar">
                                        <?php echo wp_kses_post($img['thumbnail']); ?>
                                    </div>
                                <?php
                                } ?>
                                <?php if (!empty($title)): ?>
                                    <span class="pxl-item--title"><?php echo pxl_print_html(
                                        $title,
                                    ); ?></span>
                                <?php endif; ?>
                                <?php if (!empty($desc)): ?>
                                    <p class="pxl-item--description"><?php echo pxl_print_html(
                                        $desc,
                                    ); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php
                    endforeach; ?>
                </div>
            </div>

            <?php if ($arrows !== false): ?>
                <?php
                $arrow_space_width =
                    max(0, $arrow_full_content_with_space_value) . 'px';
                $arrow_wrap_style = '';
                if ($arrow_full_content_with_space === 'end') {
                    $arrow_wrap_style =
                        'padding-right: max(15px, calc((100% - ' .
                        $arrow_space_width .
                        ') / 2));';
                }
                $arrow_wrap_style_attr =
                    $arrow_wrap_style !== ''
                        ? ' style="' . esc_attr($arrow_wrap_style) . '"'
                        : '';
                ?>
                <div class="pxl-swiper-arrow-wrap style-layout-13"<?php echo wp_kses_post(
                    $arrow_wrap_style_attr,
                ); ?>>
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
