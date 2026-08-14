<?php
/**
 * Case Collection Box — layout 1.
 * Progressive gradient blur matches portfolio-carousel layout-4 / profile.
 *
 * @var array  $settings
 * @var object $widget
 */
$title_tag = frameflow_widget_sanitize_title_tag(
    !empty($settings['title_tag']) ? $settings['title_tag'] : '',
    'h3'
);
$img_size = !empty($settings['img_size']) ? $settings['img_size'] : 'full';
$has_image = !empty($settings['image']['id']) || !empty($settings['image']['url']);
$has_title = !empty($settings['title']);
$has_subtitle = !empty($settings['subtitle']);
$has_button = !empty($settings['button_text']);
$has_link = !empty($settings['button_link']['url']);
$pxl_animate = !empty($settings['pxl_animate']) ? $settings['pxl_animate'] : '';
$pxl_animate_delay = !empty($settings['pxl_animate_delay']) ? $settings['pxl_animate_delay'] : '0';

if (!$has_image && !$has_title && !$has_subtitle && !$has_button) {
    return;
}
?>
<div class="pxl-collection-box pxl-collection-box1 <?php echo esc_attr($pxl_animate); ?>" data-wow-delay="<?php echo esc_attr($pxl_animate_delay); ?>ms">
    <div class="pxl-item--inner">
        <?php if ($has_image) : ?>
            <div class="pxl-item--image">
                <?php
                if (!empty($settings['image']['id'])) {
                    $img = pxl_get_image_by_size([
                        'attach_id' => (int) $settings['image']['id'],
                        'thumb_size' => $img_size,
                        'class' => 'no-lazyload',
                    ]);
                    if (!empty($img['thumbnail'])) {
                        echo wp_kses_post($img['thumbnail']);
                    }
                } elseif (!empty($settings['image']['url'])) {
                    ?>
                    <img src="<?php echo esc_url($settings['image']['url']); ?>" alt="<?php echo esc_attr($has_title ? $settings['title'] : ''); ?>">
                    <?php
                }
                ?>
                <div class="pxl-item--front">
                    <?php if ($has_button) : ?>
                        <?php if ($has_link) :
                            $widget->add_render_attribute('collection_box_btn', 'href', $settings['button_link']['url']);
                            $widget->add_render_attribute('collection_box_btn', 'class', 'pxl-item--button');
                            if (!empty($settings['button_link']['is_external'])) {
                                $widget->add_render_attribute('collection_box_btn', 'target', '_blank');
                            }
                            if (!empty($settings['button_link']['nofollow'])) {
                                $widget->add_render_attribute('collection_box_btn', 'rel', 'nofollow');
                            }
                            ?>
                            <a <?php pxl_print_html($widget->get_render_attribute_string('collection_box_btn')); ?>>
                                <?php echo esc_html($settings['button_text']); ?>
                            </a>
                        <?php else : ?>
                            <div class="pxl-item--button"><?php echo esc_html($settings['button_text']); ?></div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($has_title || $has_subtitle) : ?>
            <div class="pxl-item--content">
                <?php if ($has_title) : ?>
                    <<?php echo esc_attr($title_tag); ?> class="pxl-item--title el-empty">
                        <?php echo esc_html($settings['title']); ?>
                    </<?php echo esc_attr($title_tag); ?>>
                <?php endif; ?>
                <?php if ($has_subtitle) : ?>
                    <div class="pxl-item--subtitle"><?php echo esc_html($settings['subtitle']); ?></div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
