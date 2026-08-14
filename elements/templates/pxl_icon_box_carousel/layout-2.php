<?php
/**
 * Case Icon Box Carousel – Layout 2
 * Renders icon box items inside a Swiper carousel.
 */
$col_xs   = $widget->get_setting('col_xs', '1');
$col_sm   = $widget->get_setting('col_sm', '2');
$col_md   = $widget->get_setting('col_md', '3');
$col_lg   = $widget->get_setting('col_lg', '3');
$col_xl   = $widget->get_setting('col_xl', '3');
$col_xxl  = $widget->get_setting('col_xxl', '3');
if ($col_xxl === 'inherit' || $col_xxl === '') {
    $col_xxl = $col_xl;
}
$slides_to_scroll = $widget->get_setting('slides_to_scroll', '1');
$arrows          = $widget->get_setting('arrows', false);
$pagination      = $widget->get_setting('pagination', false);
$pagination_type = $widget->get_setting('pagination_type', 'bullets');
$arrows_type     = $widget->get_setting('arrows_type', 'style-1');
$pause_on_hover  = $widget->get_setting('pause_on_hover', false);
$autoplay        = $widget->get_setting('autoplay', false);
$autoplay_speed  = $widget->get_setting('autoplay_speed', 5000);
$infinite        = $widget->get_setting('infinite', false);
$speed           = $widget->get_setting('speed', 500);
$drap            = $widget->get_setting('drap', false);
$title_tag       = frameflow_widget_sanitize_title_tag(isset($settings['title_tag']) ? $settings['title_tag'] : '', 'h5');

$opts = [
    'slide_direction'        => 'horizontal',
    'slide_percolumn'        => 1,
    'slide_mode'              => 'slide',
    'center_slide'            => false,
    'slides_to_show'         => (int) $col_xl,
    'slides_to_show_xxl'     => (int) $col_xxl,
    'slides_to_show_lg'      => (int) $col_lg,
    'slides_to_show_md'      => (int) $col_md,
    'slides_to_show_sm'      => (int) $col_sm,
    'slides_to_show_xs'      => (int) $col_xs,
    'slides_to_scroll'       => (int) $slides_to_scroll,
    'arrow'                  => (bool) $arrows,
    'pagination'             => (bool) $pagination,
    'pagination_type'       => $pagination_type,
    'autoplay'               => (bool) $autoplay,
    'pause_on_hover'         => (bool) $pause_on_hover,
    'pause_on_interaction'   => true,
    'delay'                  => (int) $autoplay_speed,
    'loop'                   => (bool) $infinite,
    'speed'                  => (int) $speed,
];

$widget->add_render_attribute('carousel', [
    'class'         => 'pxl-swiper-container',
    'dir'           => is_rtl() ? 'rtl' : 'ltr',
    'data-settings' => wp_json_encode($opts),
]);

$icon_boxes = isset($settings['icon_boxes']) && is_array($settings['icon_boxes']) ? $settings['icon_boxes'] : [];

if (!empty($icon_boxes)) :
?>
<div class="pxl-swiper-slider pxl-icon-box-carousel pxl-icon-box-carousel2" <?php echo esc_attr($drap ? 'data-cursor-drap="' . esc_attr__('DRAG', 'frameflow') . '"' : ''); ?>>
    <div class="pxl-carousel-inner">
        <div <?php pxl_print_html($widget->get_render_attribute_string('carousel')); ?>>
            <div class="pxl-swiper-wrapper">
                <?php
                foreach ($icon_boxes as $key => $item) :
                    $item_title   = isset($item['title']) ? $item['title'] : '';
                    $item_desc    = isset($item['desc']) ? $item['desc'] : '';
                    $item_icon    = isset($item['pxl_icon']) ? $item['pxl_icon'] : [];
                    $icon_type    = isset($item['icon_type']) ? $item['icon_type'] : 'icon';
                    $icon_image   = isset($item['icon_image']) ? $item['icon_image'] : [];
                    $animate_class = isset($settings['pxl_animate']) ? $settings['pxl_animate'] : '';
                    $animate_delay = isset($settings['pxl_animate_delay']) ? $settings['pxl_animate_delay'] : 0;
                ?>
                <div class="pxl-swiper-slide">
                    <div class="pxl-item--inner <?php echo esc_attr($animate_class); ?>" data-wow-delay="<?php echo esc_attr($animate_delay); ?>ms">
                        <?php if ($icon_type === 'icon' && !empty($item_icon['value'])) : ?>
                            <div class="pxl-item--icon pxl-flex-center">
                                <?php \Elementor\Icons_Manager::render_icon($item_icon, ['aria-hidden' => 'true']); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($icon_type === 'image' && !empty($icon_image['id'])) : ?>
                            <div class="pxl-item--icon pxl-flex-center">
                                <?php
                                $img_icon = pxl_get_image_by_size([
                                    'attach_id'  => $icon_image['id'],
                                    'thumb_size' => 'full',
                                ]);
                                if (!empty($img_icon['thumbnail'])) {
                                    echo pxl_print_html($img_icon['thumbnail']);
                                }
                                ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($item_title !== '' || $item_desc !== '') : ?>
                            <?php if ($item_title !== '') : ?>
                                <<?php echo esc_attr($title_tag); ?> class="pxl-item--title"><?php echo pxl_print_html($item_title); ?></<?php echo esc_attr($title_tag); ?>>
                            <?php endif; ?>
                            <?php if ($item_desc !== '') : ?>
                                <div class="pxl-item--description"><?php echo pxl_print_html($item_desc); ?></div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php if ($pagination || $arrows) : ?>
        <div class="pxl-swiper-bottom">
            <?php if ($pagination) : ?>
                <div class="pxl-swiper-dots style-1"></div>
            <?php endif; ?>
        </div>
        <?php if ($arrows) : ?>
            <div class="pxl-swiper-arrow-wrap <?php echo esc_attr($arrows_type); ?>">
                <?php
                frameflow_include_swiper_arrows($widget);
                ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>
<?php endif;
