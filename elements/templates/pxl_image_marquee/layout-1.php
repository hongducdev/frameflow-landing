<?php
$images = isset($settings["images"]) ? $settings["images"] : [];
$valid = [];
foreach ($images as $row) {
    if (!empty($row["image"]["id"])) {
        $valid[] = $row;
    }
}

if (empty($valid)) {
    return;
}

$html_id = pxl_get_element_id($settings);
$speed_raw = isset($settings["marquee_speed"]["size"])
    ? floatval($settings["marquee_speed"]["size"])
    : 60;
$speed = $speed_raw > 0 ? $speed_raw : 60;
$direction = !empty($settings["marquee_direction"])
    ? $settings["marquee_direction"]
    : "left";
$pause_on_hover = !isset($settings["pause_on_hover"])
    ? true
    : !empty($settings["pause_on_hover"]);
$enable_lightbox = !isset($settings["enable_lightbox"])
    ? true
    : !empty($settings["enable_lightbox"]);
$show_edge_fade = !isset($settings["show_edge_fade"])
    ? true
    : !empty($settings["show_edge_fade"]);
$animate = !empty($settings["pxl_animate"]) ? $settings["pxl_animate"] : "";
$animate_delay = !empty($settings["pxl_animate_delay"])
    ? $settings["pxl_animate_delay"]
    : "";

$root_classes = ["pxl-image-marquee", "pxl-image-marquee1", $animate];
if ($show_edge_fade) {
    $root_classes[] = "has-edge-fade";
}
?>
<div
    id="<?php echo esc_attr($html_id); ?>"
    class="<?php echo esc_attr(implode(" ", array_filter($root_classes))); ?>"
    data-wow-delay="<?php echo esc_attr($animate_delay); ?>ms"
    data-marquee-speed="<?php echo esc_attr($speed); ?>"
    data-marquee-direction="<?php echo esc_attr($direction); ?>"
    data-pause-on-hover="<?php echo $pause_on_hover ? "true" : "false"; ?>"
>
    <div class="pxl-image-marquee__inner">
        <div class="pxl-image-marquee__track">
            <?php for ($loop = 0; $loop < 2; $loop++) : ?>
                <?php foreach ($valid as $item) :
                    $attach_id = (int) $item["image"]["id"];
                    $img = pxl_get_image_by_size([
                        "attach_id" => $attach_id,
                        "thumb_size" => "full",
                        "class" => "no-lazyload",
                    ]);
                    $thumbnail = !empty($img["thumbnail"]) ? $img["thumbnail"] : "";
                    $full_url = wp_get_attachment_image_url($attach_id, "full");
                    if (empty($full_url) && !empty($img["url"])) {
                        $full_url = $img["url"];
                    }
                    if (empty($thumbnail) || empty($full_url)) {
                        continue;
                    }
                    $alt = get_post_meta($attach_id, "_wp_attachment_image_alt", true);
                    ?>
                    <div
                        class="pxl-image-marquee__item"
                        <?php echo $loop > 0 ? ' aria-hidden="true"' : ""; ?>
                    >
                        <?php if ($enable_lightbox) : ?>
                            <a
                                class="pxl-image-marquee__link"
                                href="<?php echo esc_url($full_url); ?>"
                                <?php if ($loop === 0) : ?>
                                    data-elementor-open-lightbox="yes"
                                    data-elementor-lightbox-slideshow="<?php echo esc_attr(
                                        $html_id,
                                    ); ?>"
                                    <?php if (!empty($alt)) : ?>
                                        data-elementor-lightbox-title="<?php echo esc_attr(
                                            $alt,
                                        ); ?>"
                                    <?php endif; ?>
                                <?php else : ?>
                                    data-pxl-marquee-proxy="true"
                                    tabindex="-1"
                                <?php endif; ?>
                            >
                                <?php echo wp_kses_post($thumbnail); ?>
                            </a>
                        <?php else : ?>
                            <span class="pxl-image-marquee__media">
                                <?php echo wp_kses_post($thumbnail); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endfor; ?>
        </div>
    </div>
</div>
