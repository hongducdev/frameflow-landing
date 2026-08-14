<?php
/**
 * Case Countdown — layout 1 (Figma 3404:52).
 * Numbers + period labels; live tick via frameflow-countdown / countdown.js.
 */
$date = !empty($settings['date']) ? $settings['date'] : '';
$day = !empty($settings['day']) ? $settings['day'] : esc_html__('Day', 'frameflow');
$days = !empty($settings['days']) ? $settings['days'] : esc_html__('Days', 'frameflow');
$hour = !empty($settings['hour']) ? $settings['hour'] : esc_html__('Hour', 'frameflow');
$hours = !empty($settings['hours']) ? $settings['hours'] : esc_html__('Hours', 'frameflow');
$minute = !empty($settings['minute']) ? $settings['minute'] : esc_html__('Minute', 'frameflow');
$minutes = !empty($settings['minutes']) ? $settings['minutes'] : esc_html__('Minutes', 'frameflow');
$second = !empty($settings['second']) ? $settings['second'] : esc_html__('Second', 'frameflow');
$seconds = !empty($settings['seconds']) ? $settings['seconds'] : esc_html__('Seconds', 'frameflow');

$animate_class = !empty($settings['pxl_animate']) ? $settings['pxl_animate'] : '';
?>
<div
    class="pxl-countdown pxl-countdown1 <?php echo esc_attr($animate_class); ?>"
    data-wow-delay="<?php echo esc_attr(!empty($settings['pxl_animate_delay']) ? $settings['pxl_animate_delay'] : 0); ?>ms"
    data-day="<?php echo esc_attr($day); ?>"
    data-days="<?php echo esc_attr($days); ?>"
    data-hour="<?php echo esc_attr($hour); ?>"
    data-hours="<?php echo esc_attr($hours); ?>"
    data-minute="<?php echo esc_attr($minute); ?>"
    data-minutes="<?php echo esc_attr($minutes); ?>"
    data-second="<?php echo esc_attr($second); ?>"
    data-seconds="<?php echo esc_attr($seconds); ?>"
>
    <div data-count-down="<?php echo esc_attr($date); ?>"></div>
</div>
