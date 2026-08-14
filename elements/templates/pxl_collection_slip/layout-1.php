<?php
/**
 * Case Collection Slip — layout 1.
 * Hover expands a panel (same flex-basis mechanism as pxl_post_slip portfolio-1).
 */
$items = isset($settings['items']) && is_array($settings['items']) ? $settings['items'] : [];
$slip_flex_active = (float) $widget->get_setting('slip_flex_active', 67);
$slip_flex_inactive = (float) $widget->get_setting('slip_flex_inactive', 16.5);
$default_active = absint($widget->get_setting('default_active', 0));
$title_tag = frameflow_widget_sanitize_title_tag(
    isset($settings['title_tag']) ? $settings['title_tag'] : '',
    'h3'
);

$valid_items = [];
foreach ($items as $item) {
    $img_id = !empty($item['item_image']['id']) ? (int) $item['item_image']['id'] : 0;
    $img_url = '';
    if ($img_id) {
        $img = pxl_get_image_by_size([
            'attach_id' => $img_id,
            'thumb_size' => 'full',
        ]);
        $img_url = !empty($img['url']) ? $img['url'] : '';
    } elseif (!empty($item['item_image']['url'])) {
        $img_url = $item['item_image']['url'];
    }
    if ($img_url === '') {
        continue;
    }
    $valid_items[] = [
        'image' => $img_url,
        'subtitle' => isset($item['item_subtitle']) ? $item['item_subtitle'] : '',
        'title' => isset($item['item_title']) ? $item['item_title'] : '',
        'description' => isset($item['item_description']) ? $item['item_description'] : '',
        'button_text' => isset($item['item_button_text']) ? $item['item_button_text'] : '',
        'button_link' => isset($item['item_button_link']) ? $item['item_button_link'] : [],
    ];
}

$count = count($valid_items);
if ($count < 1) {
    return;
}

if ($default_active >= $count) {
    $default_active = 0;
}
?>
<div class="pxl-collection-slip pxl-collection-slip1">
    <div
        class="pxl-collection-slip--track"
        data-flex-active="<?php echo esc_attr($slip_flex_active); ?>"
        data-flex-inactive="<?php echo esc_attr($slip_flex_inactive); ?>"
        data-default-active="<?php echo esc_attr($default_active); ?>"
    >
        <?php foreach ($valid_items as $key => $item) :
            $is_active = ($key === $default_active);
            $block_class = 'pxl-collection-slip--block' . ($is_active ? ' active' : '');
            $btn_key = 'collection_btn_' . $key;
            $has_link = !empty($item['button_link']['url']);
            if ($has_link) {
                $widget->add_render_attribute($btn_key, 'href', $item['button_link']['url']);
                $widget->add_render_attribute($btn_key, 'class', 'pxl-collection-slip--button');
                if (!empty($item['button_link']['is_external'])) {
                    $widget->add_render_attribute($btn_key, 'target', '_blank');
                }
                if (!empty($item['button_link']['nofollow'])) {
                    $widget->add_render_attribute($btn_key, 'rel', 'nofollow');
                }
            }
            ?>
            <div class="<?php echo esc_attr($block_class); ?>">
                <div class="pxl-collection-slip--image" style="background-image: url(<?php echo esc_url($item['image']); ?>);">
                    <div class="pxl-collection-slip--overlay"></div>
                    <div class="pxl-collection-slip--content">
                        <?php if ($item['subtitle'] !== '') : ?>
                            <div class="pxl-collection-slip--subtitle"><?php echo esc_html($item['subtitle']); ?></div>
                        <?php endif; ?>
                        <?php if ($item['title'] !== '') : ?>
                            <<?php echo esc_attr($title_tag); ?> class="pxl-collection-slip--title">
                                <?php echo esc_html($item['title']); ?>
                            </<?php echo esc_attr($title_tag); ?>>
                        <?php endif; ?>
                        <?php if ($item['description'] !== '') : ?>
                            <p class="pxl-collection-slip--description"><?php echo esc_html($item['description']); ?></p>
                        <?php endif; ?>
                        <?php if ($item['button_text'] !== '') : ?>
                            <?php if ($has_link) : ?>
                                <a <?php pxl_print_html($widget->get_render_attribute_string($btn_key)); ?>>
                                    <?php echo esc_html($item['button_text']); ?>
                                </a>
                            <?php else : ?>
                                <span class="pxl-collection-slip--button"><?php echo esc_html($item['button_text']); ?></span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
