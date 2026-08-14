<?php
/**
 * Case Slider — Layout 1: each slide renders a pxl-template (template_type slider) via Elementor.
 */
if (! class_exists('\Elementor\Plugin')) {
    return;
}

$col_xs   = $widget->get_setting('col_xs', '1');
$col_sm   = $widget->get_setting('col_sm', '1');
$col_md   = $widget->get_setting('col_md', '1');
$col_lg   = $widget->get_setting('col_lg', '1');
$col_xl   = $widget->get_setting('col_xl', '1');
$col_xxl  = $widget->get_setting('col_xxl', '1');
if ($col_xxl === 'inherit' || $col_xxl === '') {
    $col_xxl = $col_xl;
}

$slides_to_scroll = $widget->get_setting('slides_to_scroll', '1');
$arrows           = $widget->get_setting('arrows', false);
$pagination       = $widget->get_setting('pagination', false);
$pagination_type  = $widget->get_setting('pagination_type', 'bullets');
$arrows_type      = $widget->get_setting('arrows_type', 'style-1');
$pause_on_hover   = $widget->get_setting('pause_on_hover', false);
$autoplay         = $widget->get_setting('autoplay', false);
$autoplay_speed   = $widget->get_setting('autoplay_speed', 5000);
$infinite         = $widget->get_setting('infinite', false);
$speed            = $widget->get_setting('speed', 500);
$drap             = $widget->get_setting('drap', false);
$slide_mode       = $widget->get_setting('slide_mode', 'slide');
if (! in_array($slide_mode, ['slide', 'fade'], true)) {
    $slide_mode = 'slide';
}

$opts = array(
    'slide_direction'      => 'horizontal',
    'slide_percolumn'      => 1,
    'slide_mode'           => $slide_mode,
    'center_slide'         => false,
    'slides_to_show'       => (int) $col_xl,
    'slides_to_show_xxl'   => (int) $col_xxl,
    'slides_to_show_lg'    => (int) $col_lg,
    'slides_to_show_md'    => (int) $col_md,
    'slides_to_show_sm'    => (int) $col_sm,
    'slides_to_show_xs'    => (int) $col_xs,
    'slides_to_scroll'     => (int) $slides_to_scroll,
    'arrow'                => (bool) $arrows,
    'pagination'           => (bool) $pagination,
    'pagination_type'      => $pagination_type,
    'autoplay'             => (bool) $autoplay,
    'pause_on_hover'       => (bool) $pause_on_hover,
    'pause_on_interaction' => true,
    'delay'                => (int) $autoplay_speed,
    'loop'                 => (bool) $infinite,
    'speed'                => (int) $speed,
);

$widget->add_render_attribute(
    'carousel',
    array(
        'class'         => 'pxl-swiper-container',
        'dir'           => is_rtl() ? 'rtl' : 'ltr',
        'data-settings' => wp_json_encode($opts),
    )
);

$slides = isset($settings['slides']) && is_array($settings['slides']) ? $settings['slides'] : array();

$has_slide = false;
foreach ($slides as $row) {
    if (! empty($row['slide_template']) && absint($row['slide_template']) > 0) {
        $has_slide = true;
        break;
    }
}

if (! $has_slide) {
    return;
}

$animate_class = isset($settings['pxl_animate']) ? $settings['pxl_animate'] : '';
$animate_delay = isset($settings['pxl_animate_delay']) ? $settings['pxl_animate_delay'] : 0;
?>
<div class="pxl-swiper-slider pxl-slider pxl-slider1"<?php if ($drap === 'yes') : ?> data-cursor-drap="<?php echo esc_attr__('DRAG', 'frameflow'); ?>"<?php endif; ?>>
    <div class="pxl-carousel-inner">
        <div <?php pxl_print_html($widget->get_render_attribute_string('carousel')); ?>>
            <div class="pxl-swiper-wrapper">
                <?php
                foreach ($slides as $slide) :
                    $template_id = isset($slide['slide_template']) ? absint($slide['slide_template']) : 0;
                    if ($template_id < 1) {
                        continue;
                    }

                    $slide_html = Elementor\Plugin::$instance->frontend->get_builder_content_for_display($template_id, true);

                    if ($slide_html === '' || $slide_html === false) {
                        continue;
                    }
                    ?>
                    <div class="pxl-swiper-slide">
                        <div class="pxl-item-wrapper">
                            <div class="pxl-item--inner <?php echo esc_attr($animate_class); ?>" data-wow-delay="<?php echo esc_attr($animate_delay); ?>ms">
                                <?php echo pxl_print_html($slide_html); ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php if ($pagination || $arrows) : ?>
        <div class="pxl-swiper-bottom">
            <?php if ($pagination) : ?>
                <div class="pxl-swiper-dots style-3"></div>
            <?php endif; ?>
        </div>
        <?php if ($arrows) : ?>
            <?php
            ?>
            <div class="pxl-swiper-arrow-wrap <?php echo esc_attr($arrows_type); ?>">
                <?php frameflow_include_swiper_arrows($widget); ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>
