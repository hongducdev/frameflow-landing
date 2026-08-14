<?php
// Image size
$img_size = !empty($settings['img_size']) ? $settings['img_size'] : 'full';

// Outer wrapper
$btn_video_style = $settings['btn_video_style'];
$wrapper_class   = 'pxl-video-player pxl-video-player1 pxl-video-' . $btn_video_style . ' ' . $settings['pxl_animate'];
$data_wow_delay  = $settings['pxl_animate_delay'] . 'ms';

// Image section
$show_image   = ($settings['image_type'] != 'none' && !empty($settings['image']['url']));
$show_ripple  = ($settings['show_ripple'] == 'true');
$is_img_type  = ($settings['image_type'] == 'img');
$parallax_y   = ($settings['box_style'] == 'parallax') ? -60 : 0;
$parallax_data = wp_json_encode(['y' => $parallax_y]);
$image_bg_url = $settings['image']['url'] ?? '';

// Video button section
$has_video_link = !empty($settings['video_link']);
$btn_position   = $settings['btn_video_position'];
$is_btn_style   = ($btn_video_style == 'style-button');
$has_video_icon = !empty($settings['video_icon']['value']);
$has_label      = !empty($settings['label']);
$is_cursor_follow = isset($settings['enable_cursor_follow']) ? $settings['enable_cursor_follow'] === 'true' : true;
$is_cursor_follow = $is_cursor_follow && !$is_btn_style;

$btn_video_wrap_class = 'btn-video-wrap' . ($is_cursor_follow ? ' p-cursor' : '') . ' ' . $btn_position;
?>
<div class="<?php echo esc_attr($wrapper_class); ?>" data-wow-delay="<?php echo esc_attr($data_wow_delay); ?>">
    <div class="pxl-video--inner">
        <?php if ($show_image) :
            $img           = pxl_get_image_by_size(['attach_id' => $settings['image']['id'], 'thumb_size' => $img_size]);
            $thumbnail     = $img['thumbnail'];
            $thumbnail_url = $img['url'];
            $holder_class  = 'pxl-video--holder' . ($show_ripple ? ' hover-imge-ripple' : '');
        ?>
            <div class="<?php echo esc_attr($holder_class); ?>"
                <?php if ($show_ripple) : ?>
                data-image-url="<?php echo esc_url($thumbnail_url); ?>"
                style="background-image: url(<?php echo esc_url($thumbnail_url); ?>);"
                <?php endif; ?>>
                <?php if ($is_img_type) : ?>
                    <?php if (!empty($settings['image']['url'])) : ?>
                        <?php echo wp_kses_post($thumbnail); ?>
                    <?php endif; ?>
                <?php else : ?>
                    <div class="pxl-video--imagebg">
                        <div class="bg-image <?php echo esc_attr($settings['box_style']); ?>" data-parallax="<?php echo esc_attr($parallax_data); ?>" style="background-image: url(<?php echo esc_url($image_bg_url); ?>);"></div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if ($has_video_link) : ?>
            <div class="<?php echo esc_attr($btn_video_wrap_class); ?>">
                <a class="pxl-btn-video pxl-action-popup <?php echo esc_attr($btn_video_style); ?>" href="<?php echo esc_url($settings['video_link']); ?>">
                    <?php if ($is_btn_style) : ?>
                        <span class="pxl-btn-video__text"><?php echo pxl_print_html($settings['label_button']); ?></span>
                    <?php else : ?>
                        <?php if ($has_video_icon) : ?>
                            <?php \Elementor\Icons_Manager::render_icon($settings['video_icon'], ['aria-hidden' => 'true', 'class' => ''], 'i'); ?>
                        <?php else : ?>
                            <i class="bi-play-fill"></i>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if ($has_label) : ?>
                        <span class="label-text">
                            <?php echo pxl_print_html($settings['label']); ?>
                        </span>
                    <?php endif; ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>