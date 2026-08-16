<?php
$html_id = pxl_get_element_id($settings);

$hold = isset($settings['hold_duration']['size'])
    ? (float) $settings['hold_duration']['size']
    : 2;
if ($hold <= 0) {
    $hold = 2;
}

$slots = [
    'left' => $settings['image_left'] ?? [],
    'center' => $settings['image_center'] ?? [],
    'right' => $settings['image_right'] ?? [],
];
?>
<div
    id="<?php echo esc_attr($html_id); ?>"
    class="pxl-image-fan"
    data-hold="<?php echo esc_attr($hold); ?>"
>
    <div class="pxl-image-fan__stage">
        <?php foreach ($slots as $slot => $image) : ?>
            <div class="pxl-image-fan__card pxl-image-fan__card--<?php echo esc_attr($slot); ?>">
                <div class="pxl-image-fan__motion">
                    <div class="pxl-image-fan__frame">
                        <?php if (!empty($image['id'])) : ?>
                            <?php
                            $img = pxl_get_image_by_size([
                                'attach_id' => $image['id'],
                                'thumb_size' => 'full',
                            ]);
                            echo pxl_print_html($img['thumbnail']);
                            ?>
                        <?php elseif (!empty($image['url'])) : ?>
                            <img src="<?php echo esc_url($image['url']); ?>" alt="" />
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
