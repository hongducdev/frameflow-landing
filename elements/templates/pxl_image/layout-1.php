<?php
if (! empty($settings['image_link']['url'])) {
    $widget->add_render_attribute('image_link', 'href', $settings['image_link']['url']);

    if ($settings['image_link']['is_external']) {
        $widget->add_render_attribute('image_link', 'target', '_blank');
    }

    if ($settings['image_link']['nofollow']) {
        $widget->add_render_attribute('image_link', 'rel', 'nofollow');
    }
}
$html_id = pxl_get_element_id($settings);
if ($settings['img_effect'] == 'pxl-image-parallax') {
    wp_enqueue_script('pxl-parallax-move-mouse');
}
$img_effect_class = ! empty($settings['img_effect']) ? $settings['img_effect'] : '';
if (in_array($img_effect_class, ['pxl-image-border', 'pxl-image-distortion'], true)) {
    $img_effect_class = '';
}
$source_type = ! empty($settings['source_type']) ? $settings['source_type'] : 's_img';
$is_gallery = ($source_type === 'g_img' && ! empty($settings['gallery_images']) && is_array($settings['gallery_images']));
$gallery_interval = ! empty($settings['gallery_interval']) ? absint($settings['gallery_interval']) : 3000;
if ($gallery_interval < 500) {
    $gallery_interval = 3000;
}
?>
<div id="<?php echo esc_attr($html_id) ?>" class="pxl-image-single  
<?php if ($settings['hide_parallax_sm'] == 'true') {
    echo 'pxl-disable-parallax-sm';
} ?> 
<?php if ($settings['img_display'] == 'true') {
    echo 'pxl-hide-sr-lg';
} ?> 
<?php if (! $is_gallery && $img_effect_class !== '') {
    echo esc_attr($img_effect_class);
} ?> 
<?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms" <?php if (! $is_gallery && $settings['img_effect'] == 'pxl-image-tilt') : ?>data-maxtilt="<?php echo esc_attr($settings['max_tilt']); ?>" data-speedtilt="<?php echo esc_attr($settings['speed_tilt']); ?>" data-perspectivetilt="<?php echo esc_attr($settings['perspective_tilt']); ?>" <?php endif; ?> <?php if (! $is_gallery && $settings['img_effect'] == 'pxl-parallax-scroll') : ?>data-parallax='{"<?php echo esc_attr($settings['parallax_scroll_type']); ?>":<?php echo esc_attr($settings['parallax_scroll_value_x']); ?>}' <?php endif; ?>>
    <div class="pxl-item--inner">
        <?php if ($is_gallery) :
            $image_size = ! empty($settings['img_size']) ? $settings['img_size'] : 'full';
            $img_style = isset($settings['img_style']) ? $settings['img_style'] : '';
            $is_distortion = ($img_style === 'distortion');
            ?>
            <div class="pxl-image-gallery" data-interval="<?php echo esc_attr($gallery_interval); ?>">
                <?php
                $gallery_first = true;
                foreach ($settings['gallery_images'] as $gallery_image) :
                    $img_id = ! empty($gallery_image['id']) ? absint($gallery_image['id']) : 0;
                    if (! $img_id) {
                        continue;
                    }
                    $img = pxl_get_image_by_size(array(
                        'attach_id' => $img_id,
                        'thumb_size' => $image_size,
                        'class' => 'no-lazyload',
                    ));
                    $thumbnail = $img['thumbnail'];
                    $thumbnail_url = $img['url'];
                    $is_active_item = $gallery_first;
                    $gallery_first = false;
                    ?>
                    <?php switch ($settings['image_type']) {
                        case 'bg': ?>
                            <?php if ($is_distortion) : ?>
                                <div class="pxl-item--bg bg-image wrap-img-distortion pxl-image-gallery-item<?php echo $is_active_item ? ' is-active' : ''; ?>">
                                    <?php if (! empty($settings['image_link']['url'])) { ?><a <?php pxl_print_html($widget->get_render_attribute_string('image_link')); ?>><?php } ?>
                                        <?php echo wp_kses_post($thumbnail); ?>
                                        <div class="wrap-distort-canvas"></div>
                                    <?php if (! empty($settings['image_link']['url'])) { ?></a><?php } ?>
                                </div>
                            <?php else : ?>
                                <div class="pxl-item--bg bg-image pxl-image-gallery-item<?php echo $is_active_item ? ' is-active' : ''; ?>" style="background-image: url(<?php echo esc_url($thumbnail_url); ?>);"></div>
                            <?php endif; ?>
                            <?php break;
                        default: ?>
                            <?php
                            $item_image_classes = array('pxl-item--image', 'pxl-image-gallery-item');
                            if ($is_distortion) {
                                $item_image_classes[] = 'wrap-img-distortion';
                            }
                            if ($is_active_item) {
                                $item_image_classes[] = 'is-active';
                            }
                            ?>
                            <div class="<?php echo esc_attr(implode(' ', $item_image_classes)); ?>">
                                <?php if (! empty($settings['image_link']['url'])) { ?><a <?php pxl_print_html($widget->get_render_attribute_string('image_link')); ?>><?php } ?>
                                    <?php echo wp_kses_post($thumbnail); ?>
                                    <?php if ($is_distortion) : ?>
                                        <div class="wrap-distort-canvas"></div>
                                    <?php endif; ?>
                                <?php if (! empty($settings['image_link']['url'])) { ?></a><?php } ?>
                            </div>
                    <?php break;
                    } ?>
                <?php endforeach; ?>
            </div>
        <?php elseif (($source_type == 's_img' && ! empty($settings['image']['id'])) || ($source_type == 'f_img' && has_post_thumbnail())) :
            $image_size = !empty($settings['img_size']) ? $settings['img_size'] : 'full';
            if (!empty($settings['image']['id'])) : $img_id = $settings['image']['id'];
            endif;
            if ($source_type == 'f_img' && has_post_thumbnail()) {
                $img_id = get_post_thumbnail_id(get_the_ID());
            }
            $img  = pxl_get_image_by_size(array(
                'attach_id'  => $img_id,
                'thumb_size' => $image_size,
                'class' => 'no-lazyload'
            ));
            $thumbnail    = $img['thumbnail'];
            $thumbnail_url    = $img['url'];
            $img_style      = isset($settings['img_style']) ? $settings['img_style'] : '';
            $is_distortion  = ($img_style === 'distortion')
                || (($settings['img_effect'] ?? '') === 'pxl-image-distortion');
            ?>

            <?php switch ($settings['image_type']) {
                case 'bg': ?>
                    <?php if ($is_distortion) : ?>
                        <div class="pxl-item--bg bg-image wrap-img-distortion">
                            <?php if (! empty($settings['image_link']['url'])) { ?><a <?php pxl_print_html($widget->get_render_attribute_string('image_link')); ?>><?php } ?>
                                <?php if (! empty($img_id)) {
                                    echo wp_kses_post($thumbnail);
                                } ?>
                                <div class="wrap-distort-canvas"></div>
                            <?php if (! empty($settings['image_link']['url'])) { ?></a><?php } ?>
                        </div>
                    <?php else : ?>
                    <div class="pxl-item--bg bg-image " style="background-image: url(<?php echo esc_url($thumbnail_url); ?>);">
                    </div>
                    <?php endif; ?>
                <?php break;
                default: ?>
                    <?php
                    $item_image_classes = array('pxl-item--image');
                    if ($is_distortion) {
                        $item_image_classes[] = 'wrap-img-distortion';
                    }
                    ?>
                    <div class="<?php echo esc_attr(implode(' ', $item_image_classes)); ?>" data-parallax-value="<?php echo esc_attr($settings['parallax_value']); ?>">
                        <?php if (! empty($settings['image_link']['url'])) { ?><a <?php pxl_print_html($widget->get_render_attribute_string('image_link')); ?>><?php } ?>
                            <?php if (! empty($img_id)) {
                                echo wp_kses_post($thumbnail);
                            } ?>
                            <?php if ($is_distortion) : ?>
                                <div class="wrap-distort-canvas"></div>
                            <?php endif; ?>
                            <?php if (! empty($settings['image_link']['url'])) { ?></a><?php } ?>
                    </div>
            <?php break;
            } ?>
        <?php endif; ?>
    </div>
</div>
