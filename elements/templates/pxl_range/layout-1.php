<?php
/**
 * Case Range — layout 1 (Figma 6003:224).
 * Fills once to the set percent; tooltip appears after the animation.
 */
$percent = isset($settings['percent']['size']) ? (float) $settings['percent']['size'] : 88;
$percent = max(0, min(100, $percent));
$duration = isset($settings['duration']['size']) ? (float) $settings['duration']['size'] : 1.2;
$tooltip = isset($settings['tooltip_text']) ? (string) $settings['tooltip_text'] : '';
$animate_class = !empty($settings['pxl_animate']) ? $settings['pxl_animate'] : '';
$aria_label = trim($tooltip !== '' ? $tooltip . ', ' . $percent . '%' : $percent . '%');
?>
<div
    class="pxl-range pxl-range1 <?php echo esc_attr($animate_class); ?>"
    style="--pxl-range-percent: <?php echo esc_attr(
        $percent,
    ); ?>%; --pxl-range-duration: <?php echo esc_attr($duration); ?>s;"
    data-wow-delay="<?php echo esc_attr(
        !empty($settings['pxl_animate_delay']) ? $settings['pxl_animate_delay'] : 0,
    ); ?>ms"
    role="img"
    aria-label="<?php echo esc_attr($aria_label); ?>"
>
    <?php if ($tooltip !== ''): ?>
        <div class="pxl-range__tooltip">
            <span class="pxl-range__label"><?php echo esc_html($tooltip); ?></span>
            <span class="pxl-range__caret" aria-hidden="true"></span>
        </div>
    <?php endif; ?>
    <div class="pxl-range__bar">
        <span class="pxl-range__fill" aria-hidden="true">
            <span class="pxl-range__thumb">
                <span class="pxl-range__thumb-dot"></span>
            </span>
        </span>
    </div>
</div>
