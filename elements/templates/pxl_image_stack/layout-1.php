<?php
$images = isset($settings['images']) ? $settings['images'] : [];
$valid = [];
foreach ($images as $row) {
    if (!empty($row['image']['id'])) {
        $valid[] = $row;
    }
}

if (empty($valid)) {
    return;
}

$html_id = pxl_get_element_id($settings);
$speed = isset($settings['stack_speed']['size']) ? floatval($settings['stack_speed']['size']) : 70;
$speed = $speed > 0 ? $speed : 70;
$direction = !empty($settings['stack_direction']) ? $settings['stack_direction'] : 'down';
$visible = isset($settings['visible_items']) ? max(1, intval($settings['visible_items'])) : 3;
$pause = !isset($settings['pause_on_hover']) ? true : !empty($settings['pause_on_hover']);
$animate = !empty($settings['pxl_animate']) ? $settings['pxl_animate'] : '';
$delay = !empty($settings['pxl_animate_delay']) ? $settings['pxl_animate_delay'] : '0';

$classes = array_filter(['pxl-image-stack', $animate]);
?>
<div
    id="<?php echo esc_attr($html_id); ?>"
    class="<?php echo esc_attr(implode(' ', $classes)); ?>"
    style="--pxl-stack-visible: <?php echo esc_attr($visible); ?>;"
    data-wow-delay="<?php echo esc_attr($delay); ?>ms"
    data-speed="<?php echo esc_attr($speed); ?>"
    data-direction="<?php echo esc_attr($direction); ?>"
    data-visible="<?php echo esc_attr($visible); ?>"
    data-pause="<?php echo $pause ? 'true' : 'false'; ?>"
>
    <div class="pxl-image-stack__stage">
        <?php foreach ($valid as $item):

            $id = (int) $item['image']['id'];
            $img = pxl_get_image_by_size([
                'attach_id' => $id,
                'thumb_size' => 'full',
                'class' => 'no-lazyload',
            ]);
            if (empty($img['thumbnail'])) {
                continue;
            }
            ?>
            <div class="pxl-image-stack__card">
                <div class="pxl-image-stack__media">
                    <?php echo wp_kses_post($img['thumbnail']); ?>
                </div>
            </div>
        <?php
        endforeach; ?>
    </div>
</div>
