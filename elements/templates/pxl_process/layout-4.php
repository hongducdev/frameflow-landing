<?php
$title_tag = frameflow_widget_sanitize_title_tag(
    !empty($settings["title_tag"]) ? $settings["title_tag"] : "",
    "h6",
);
$step_number = isset($settings["step"]) ? absint($settings["step"]) : 0;
$step_text = sprintf('%02d', $step_number);
?>
<div class="pxl-process pxl-process4 <?php echo esc_attr(
    $settings["pxl_animate"],
); ?>" data-wow-delay="<?php echo esc_attr(
    $settings["pxl_animate_delay"],
); ?>ms">
    <div class="pxl-item--step">
        <svg width="82" height="82" viewBox="0 0 82 82" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M40.8889 0C47.4378 0 52.7467 5.30891 52.7467 11.8578V12.2617L53.0323 11.9761C57.6631 7.34533 65.171 7.34533 69.8017 11.9761C74.4325 16.6068 74.4325 24.1148 69.8017 28.7455L69.5161 29.0311H69.9201C76.4689 29.0311 81.7778 34.34 81.7778 40.8889C81.7778 47.4378 76.4689 52.7467 69.9201 52.7467H69.5162L69.8018 53.0323C74.4325 57.663 74.4325 65.1709 69.8018 69.8017C65.171 74.4324 57.6631 74.4324 53.0323 69.8017L52.7467 69.5161V69.92C52.7467 76.4689 47.4378 81.7778 40.8889 81.7778C34.3401 81.7778 29.0312 76.4689 29.0312 69.92V69.5161L28.7456 69.8017C24.1148 74.4324 16.6069 74.4324 11.9761 69.8017C7.34538 65.1709 7.34538 57.663 11.9761 53.0323L12.2617 52.7467H11.8578C5.30898 52.7467 6.10352e-05 47.4378 6.10352e-05 40.8889C6.10352e-05 34.34 5.30897 29.0311 11.8578 29.0311H12.2617L11.9761 28.7455C7.34539 24.1147 7.34539 16.6068 11.9761 11.9761C16.6069 7.34532 24.1148 7.34532 28.7456 11.9761L29.0312 12.2617V11.8578C29.0312 5.30891 34.3401 0 40.8889 0Z" fill="currentColor"/>
        </svg>
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
