<?php
/**
 * @var array $settings
 * @var object $widget
 */
$name_tag = frameflow_widget_sanitize_title_tag(
    !empty($settings["name_tag"]) ? $settings["name_tag"] : "",
    "h5",
);
$profile_img_size = !empty($settings["profile_img_size"])
    ? $settings["profile_img_size"]
    : "full";
$has_profile = !empty($settings["profile_image"]["id"]);
$has_signature = !empty($settings["signature_image"]["id"]);
$has_name = !empty($settings["name"]);
$has_position = !empty($settings["position"]);
$pxl_animate_signature = !empty($settings["pxl_animate_signature"])
    ? $settings["pxl_animate_signature"]
    : "";
$pxl_animate_delay_signature = !empty($settings["pxl_animate_delay_signature"])
    ? $settings["pxl_animate_delay_signature"]
    : "0";
$pxl_animate_name = !empty($settings["pxl_animate_name"])
    ? $settings["pxl_animate_name"]
    : "";
$pxl_animate_delay_name = !empty($settings["pxl_animate_delay_name"])
    ? $settings["pxl_animate_delay_name"]
    : "0";
$pxl_animate_position = !empty($settings["pxl_animate_position"])
    ? $settings["pxl_animate_position"]
    : "";
$pxl_animate_delay_position = !empty($settings["pxl_animate_delay_position"])
    ? $settings["pxl_animate_delay_position"]
    : "0";
?>
<div class="pxl-profile pxl-profile1 <?php echo esc_attr(
    $settings["pxl_animate"],
); ?>" data-wow-delay="<?php echo esc_attr(
    $settings["pxl_animate_delay"],
); ?>ms">
    <?php if ($has_profile):
        $profile_img = pxl_get_image_by_size([
            "attach_id" => $settings["profile_image"]["id"],
            "thumb_size" => $profile_img_size,
            "class" => "no-lazyload",
        ]);
        $profile_thumbnail = $profile_img["thumbnail"];
        ?>
        <div class="pxl-item--avatar">
            <?php echo wp_kses_post($profile_thumbnail); ?>
        </div>
    <?php
    endif; ?>

    <div class="pxl-item--info">
        <?php if ($has_signature):
            $signature_img = pxl_get_image_by_size([
                "attach_id" => $settings["signature_image"]["id"],
                "thumb_size" => "full",
                "class" => "no-lazyload",
            ]);
            $signature_thumbnail = $signature_img["thumbnail"];
            ?>
            <div
                class="pxl-item--signature <?php echo esc_attr(
                    $pxl_animate_signature,
                ); ?>"
                data-wow-delay="<?php echo esc_attr(
                    $pxl_animate_delay_signature,
                ); ?>ms"
                data-pxl-animate-delay="<?php echo esc_attr(
                    $pxl_animate_delay_signature,
                ); ?>ms"
            >
                <?php echo wp_kses_post($signature_thumbnail); ?>
            </div>
        <?php
        endif; ?>
        <?php if ($has_name): ?>
            <<?php echo esc_attr(
                $name_tag,
            ); ?> class="pxl-item--name el-empty <?php echo esc_attr(
                $pxl_animate_name,
            ); ?>" data-wow-delay="<?php echo esc_attr(
                $pxl_animate_delay_name,
            ); ?>ms" data-pxl-animate-delay="<?php echo esc_attr(
                $pxl_animate_delay_name,
            ); ?>ms">
                <?php echo esc_html($settings["name"]); ?>
            </<?php echo esc_attr($name_tag); ?>>
        <?php endif; ?>

        <?php if ($has_position): ?>
            <p
                class="pxl-item--position el-empty <?php echo esc_attr(
                    $pxl_animate_position,
                ); ?>"
                data-wow-delay="<?php echo esc_attr(
                    $pxl_animate_delay_position,
                ); ?>ms"
                data-pxl-animate-delay="<?php echo esc_attr(
                    $pxl_animate_delay_position,
                ); ?>ms"
            >
                <?php echo esc_html($settings["position"]); ?>
            </p>
        <?php endif; ?>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>
