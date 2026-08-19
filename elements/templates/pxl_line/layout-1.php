<?php
/**
 * Case Line — layout 1 (traveling dot).
 *
 * @var array $settings
 */
$pxl_animate = !empty($settings['pxl_animate']) ? $settings['pxl_animate'] : '';
$pxl_animate_delay = !empty($settings['pxl_animate_delay']) ? $settings['pxl_animate_delay'] : '0';
?>
<div
    class="pxl-line pxl-line--dot <?php echo esc_attr($pxl_animate); ?>"
    data-wow-delay="<?php echo esc_attr($pxl_animate_delay); ?>ms"
    aria-hidden="true"
>
    <span class="pxl-line__track"></span>
    <span class="pxl-line__marker-wrap">
        <span class="pxl-line__marker"></span>
    </span>
</div>
