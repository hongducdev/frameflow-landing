<?php
$title_tag = frameflow_widget_sanitize_title_tag(
    !empty($settings['title_tag']) ? $settings['title_tag'] : '',
    'h6',
);
$list =
    isset($settings['process_list_9']) && is_array($settings['process_list_9'])
        ? $settings['process_list_9']
        : [];
$img_size = !empty($settings['img_size_9']) ? $settings['img_size_9'] : '1434x400';

if (empty($list)) {
    return;
}

$process9_count = count($list);
?>
<div
    class="pxl-process pxl-process9 <?php echo esc_attr($settings['pxl_animate'] ?? ''); ?>"
    style="--step-count: <?php echo esc_attr($process9_count); ?>;"
    data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay'] ?? ''); ?>ms"
>
    <div class="pxl-item--timeline" aria-hidden="true">
        <span class="pxl-item--timeline-track"></span>
        <span class="pxl-item--timeline-progress"></span>
    </div>
    <div class="pxl-item--list">
        <?php foreach ($list as $key => $item) : ?>
            <?php
            $is_reverse = (int) $key % 2 === 1;
            $step_raw = isset($item['step_9']) ? $item['step_9'] : '';
            $step_num =
                $step_raw !== '' && $step_raw !== null
                    ? (int) $step_raw
                    : $key + 1;
            $step_label = sprintf(
                'STEP %02d',
                max(0, $step_num),
            );
            $image = isset($item['image_9']) ? $item['image_9'] : [];
            $image_html = '';

            if (!empty($image['id'])) {
                $img = pxl_get_image_by_size([
                    'attach_id' => $image['id'],
                    'thumb_size' => $img_size,
                    'class' => 'no-lazyload',
                ]);
                if (!empty($img['thumbnail'])) {
                    $image_html = wp_kses_post($img['thumbnail']);
                }
            }
            ?>
            <div
                class="pxl-item<?php echo $is_reverse ? ' is-reverse' : ''; ?>"
                data-step-index="<?php echo esc_attr((int) $key); ?>"
            >
                <?php if (!$is_reverse) : ?>
                    <?php if ($image_html !== '') : ?>
                        <div class="pxl-item--image wow fadeInLeft" data-wow-delay='<?php echo esc_attr($key * 300); ?>ms' >
                            <?php echo $image_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                        </div>
                    <?php endif; ?>
                    <div class="pxl-item--axis">
                        <span class="pxl-item--branch"></span>
                    </div>
                    <div class="pxl-item--content wow fadeInRight" data-wow-delay='<?php echo esc_attr($key * 300); ?>ms' >
                        <span class="pxl-item--step">
                            <?php echo esc_html($step_label); ?>
                        </span>
                        <<?php echo esc_attr($title_tag); ?> class="pxl-item--title">
                            <?php echo esc_html($item['title_9'] ?? ''); ?>
                        </<?php echo esc_attr($title_tag); ?>>
                        <p class="pxl-item--description">
                            <?php echo esc_html($item['description_9'] ?? ''); ?>
                        </p>
                    </div>
                <?php else : ?>
                    <div class="pxl-item--content wow fadeInLeft" data-wow-delay='<?php echo esc_attr($key * 300); ?>ms' >
                        <span class="pxl-item--step">
                            <?php echo esc_html($step_label); ?>
                        </span>
                        <<?php echo esc_attr($title_tag); ?> class="pxl-item--title">
                            <?php echo esc_html($item['title_9'] ?? ''); ?>
                        </<?php echo esc_attr($title_tag); ?>>
                        <p class="pxl-item--description">
                            <?php echo esc_html($item['description_9'] ?? ''); ?>
                        </p>
                    </div>
                    <div class="pxl-item--axis">
                        <span class="pxl-item--branch"></span>
                    </div>
                    <?php if ($image_html !== '') : ?>
                        <div class="pxl-item--image wow fadeInRight" data-wow-delay='<?php echo esc_attr($key * 300); ?>ms' >
                            <?php echo $image_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
