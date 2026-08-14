<?php
$title_tag = frameflow_widget_sanitize_title_tag(
    !empty($settings["title_tag"]) ? $settings["title_tag"] : "",
    "h6",
);
$step_number = isset($settings["step"]) ? absint($settings["step"]) : 0;
$step_text = sprintf('%02d', $step_number);
?>
<div class="pxl-process pxl-process5 <?php echo esc_attr(
    $settings["pxl_animate"],
); ?>" data-wow-delay="<?php echo esc_attr(
    $settings["pxl_animate_delay"],
); ?>ms">
    <div class="pxl-item--step">
        <span><?php echo esc_html($step_text); ?></span>
    </div>
    <<?php echo esc_attr(
        $title_tag,
    ); ?> class="pxl-item--title"><?php echo esc_html(
     $settings["title"],
 ); ?></<?php echo esc_attr($title_tag); ?>>
    <p class="pxl-item--description"><?php echo esc_html(
        $settings["description"],
    ); ?></p>
</div>
