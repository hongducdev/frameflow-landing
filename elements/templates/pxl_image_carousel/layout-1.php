<?php
/**
 * Case Image Carousel — Layout 1
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

$slides_to_scroll  = $widget->get_setting('slides_to_scroll', '1');
$arrows            = $widget->get_setting('arrows', false);
$pagination        = $widget->get_setting('pagination', false);
$pagination_type   = $widget->get_setting('pagination_type', 'bullets');
$arrows_type       = $widget->get_setting('arrows_type', 'style-1');
$pause_on_hover    = $widget->get_setting('pause_on_hover', false);
$autoplay          = $widget->get_setting('autoplay', false);
$autoplay_speed    = $widget->get_setting('autoplay_speed', 5000);
$infinite          = $widget->get_setting('infinite', false);
$speed             = $widget->get_setting('speed', 500);
$drap              = $widget->get_setting('drap', false);

$image_size = ! empty($settings['img_size']) ? $settings['img_size'] : 'large';
$caption_tag = frameflow_widget_sanitize_title_tag(isset($settings['caption_tag']) ? $settings['caption_tag'] : '', 'div');

$opts = array(
    'slide_direction'      => 'horizontal',
    'slide_percolumn'      => 1,
    'slide_mode'           => 'slide',
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

$slides = isset($settings['carousel_images']) && is_array($settings['carousel_images']) ? $settings['carousel_images'] : array();

$slide_count = 0;
foreach ($slides as $row) {
    if (! empty($row['slide_image']['id'])) {
        ++$slide_count;
    }
}

if ($slide_count < 1) {
    return;
}
?>
<div class="pxl-swiper-slider pxl-image-carousel pxl-image-carousel1 pxl-image-carousel2"<?php if ($drap === 'yes') : ?> data-cursor-drap="<?php echo esc_attr__('DRAG', 'frameflow'); ?>"<?php endif; ?>>
    <div class="pxl-carousel-inner">
        <div <?php pxl_print_html($widget->get_render_attribute_string('carousel')); ?>>
            <div class="pxl-swiper-wrapper">
                <?php
                foreach ($slides as $key => $item) :
                    $img          = isset($item['slide_image']) ? $item['slide_image'] : array();
                    $link         = isset($item['slide_link']) ? $item['slide_link'] : array();
                    $caption      = isset($item['caption']) ? $item['caption'] : '';
                    $animate_class = isset($settings['pxl_animate']) ? $settings['pxl_animate'] : '';
                    $animate_delay = isset($settings['pxl_animate_delay']) ? $settings['pxl_animate_delay'] : 0;

                    if (empty($img['id'])) {
                        continue;
                    }

                    $link_key = 'slide_link_' . $key;
                    if (! empty($link['url'])) {
                        $widget->add_render_attribute($link_key, 'href', $link['url']);
                        if (! empty($link['is_external'])) {
                            $widget->add_render_attribute($link_key, 'target', '_blank');
                        }
                        if (! empty($link['nofollow'])) {
                            $widget->add_render_attribute($link_key, 'rel', 'nofollow');
                        }
                    }

                    $img_html = pxl_get_image_by_size(
                        array(
                            'attach_id'  => $img['id'],
                            'thumb_size' => $image_size,
                            'class'      => 'no-lazyload',
                        )
                    );
                    $thumbnail = isset($img_html['thumbnail']) ? $img_html['thumbnail'] : '';
                    ?>
                <div class="pxl-swiper-slide">
                    <div class="pxl-item-wrapper">
                        <div class="pxl-item--inner <?php echo esc_attr($animate_class); ?>" data-wow-delay="<?php echo esc_attr($animate_delay); ?>ms">
                            <div class="pxl-item--image">
                                <?php if (! empty($link['url'])) : ?>
                                    <a <?php pxl_print_html($widget->get_render_attribute_string($link_key)); ?>>
                                        <?php echo wp_kses_post($thumbnail); ?>
                                    </a>
                                <?php else : ?>
                                    <?php echo wp_kses_post($thumbnail); ?>
                                <?php endif; ?>
                            </div>
                            <?php if ($caption !== '') : ?>
                                <<?php echo esc_attr($caption_tag); ?> class="pxl-item--caption"><?php echo pxl_print_html($caption); ?></<?php echo esc_attr($caption_tag); ?>>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                    <?php
                endforeach;
                ?>
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
            <div class="pxl-swiper-arrow-wrap <?php echo esc_attr($arrows_type); ?>">
                <?php
                frameflow_include_swiper_arrows($widget);
                ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>
