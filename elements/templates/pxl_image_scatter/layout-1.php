<?php
$images = isset($settings['images']) ? $settings['images'] : [];
$valid = [];
foreach ($images as $row) {
    if (!empty($row['image']['id']) || !empty($row['image']['url'])) {
        $valid[] = $row;
    }
}

if (empty($valid)) {
    return;
}

$html_id = pxl_get_element_id($settings);
$duration = isset($settings['anim_duration']['size'])
    ? (float) $settings['anim_duration']['size']
    : 0.85;
$stagger = isset($settings['anim_stagger']['size'])
    ? (float) $settings['anim_stagger']['size']
    : 0.14;

if ($duration <= 0) {
    $duration = 0.85;
}
if ($stagger < 0) {
    $stagger = 0;
}

// Bottom-to-top reveal order for the 5 Figma slots (lowest card first).
$stagger_order = [4, 2, 3, 1, 0];
?>
<div
    id="<?php echo esc_attr($html_id); ?>"
    class="pxl-image-scatter"
    data-duration="<?php echo esc_attr($duration); ?>"
    data-stagger="<?php echo esc_attr($stagger); ?>"
>
    <div class="pxl-image-scatter__stage">
        <?php foreach ($valid as $index => $item):

            $slot = $index % 5;
            $image = $item['image'];
            ?>
            <div
                class="pxl-image-scatter__card"
                data-stagger="<?php echo esc_attr(
                    $stagger_order[$slot] + intdiv($index, 5) * 5,
                ); ?>"
            >
                <div class="pxl-image-scatter__motion">
                    <div class="pxl-image-scatter__frame">
                        <?php if (!empty($image['id'])): ?>
                            <?php
                            $img = pxl_get_image_by_size([
                                'attach_id' => $image['id'],
                                'thumb_size' => 'full',
                                'class' => 'no-lazyload',
                            ]);
                            if (!empty($img['thumbnail'])) {
                                echo pxl_print_html($img['thumbnail']);
                            }
                            ?>
                        <?php elseif (!empty($image['url'])): ?>
                            <img src="<?php echo esc_url($image['url']); ?>" alt="" />
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php
        endforeach; ?>
    </div>
</div>
