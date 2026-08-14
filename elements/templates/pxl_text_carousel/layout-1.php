<?php
$col_xs = $widget->get_setting('col_xs', '1');
$col_sm = $widget->get_setting('col_sm', '1');
$col_md = $widget->get_setting('col_md', '1');
$col_lg = $widget->get_setting('col_lg', '1');
$col_xl = $widget->get_setting('col_xl', '1');
$col_xxl = $widget->get_setting('col_xxl', '1');
if ($col_xxl === 'inherit') {
    $col_xxl = $col_xl;
}

$slides_to_scroll = $widget->get_setting('slides_to_scroll', '1');
$arrows = $widget->get_setting('arrows', false);
$pagination = $widget->get_setting('pagination', false);
$pagination_type = $widget->get_setting('pagination_type', 'bullets');
$pause_on_hover = $widget->get_setting('pause_on_hover', false);
$autoplay = $widget->get_setting('autoplay', false);
$autoplay_speed = $widget->get_setting('autoplay_speed', 5000);
$infinite = $widget->get_setting('infinite', false);
$speed = $widget->get_setting('speed', 500);
$drap = $widget->get_setting('drap', false);

$opts = [
    'slide_direction' => 'horizontal',
    'slide_percolumn' => 1,
    'slide_mode' => 'slide',
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

$widget->add_render_attribute(
    'carousel',
    [
        'class' => 'pxl-swiper-container',
        'dir' => is_rtl() ? 'rtl' : 'ltr',
        'data-settings' => wp_json_encode($opts),
    ]
);

$text_items = isset($settings['text_items']) && is_array($settings['text_items']) ? $settings['text_items'] : [];

if (!empty($text_items)) : ?>
    <div class="pxl-swiper-slider pxl-text-carousel pxl-text-carousel1" <?php if ($drap !== false) : ?>data-cursor-drap="<?php echo esc_attr__('DRAG', 'frameflow'); ?>"<?php endif; ?>>
        <div class="pxl-carousel-inner">
            <div <?php pxl_print_html($widget->get_render_attribute_string('carousel')); ?>>
                <div class="pxl-swiper-wrapper">
                    <?php foreach ($text_items as $key => $item) :
                        $item_title = isset($item['item_title']) ? $item['item_title'] : '';
                        $item_text = isset($item['item_text']) ? $item['item_text'] : '';

                        if (empty($item_text)) {
                            continue;
                        }

                    ?>
                        <div class="pxl-swiper-slide">
                            <div class="pxl-item--inner <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
                                <h6 class="pxl-item--title"><?php echo esc_html($item_title); ?></h6>
                                <div class="pxl-item--text"><?php echo esc_html($item_text); ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <?php if ($pagination !== false || $arrows !== false) : ?>
            <div class="pxl-swiper-bottom">
                <?php if ($pagination !== false) : ?>
                    <div class="pxl-swiper-dots"></div>
                <?php endif; ?>
            </div>
            <?php if ($arrows !== false) : ?>
                <div class="pxl-swiper-arrow-wrap style-2">
                    <?php
                    frameflow_include_swiper_arrows($widget);
                    ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
<?php endif; ?>
