<?php
$is_coming_soon = frameflow_widget_is_switcher_on($settings['coming_soon'] ?? '');
$has_image = !empty($settings['image']['id']);
$has_title = !empty($settings['title']);
$has_category = !empty($settings['category']);
$has_button_text = !$is_coming_soon && !empty($settings['button_text']);
$has_link = !$is_coming_soon && !empty($settings['button_url']['url']);
$img_size = !empty($settings['img_size']) ? $settings['img_size'] : 'full';
$title_tag = frameflow_widget_sanitize_title_tag(
    !empty($settings['title_tag']) ? $settings['title_tag'] : '',
    'h5',
);
$animate = !empty($settings['pxl_animate']) ? $settings['pxl_animate'] : '';
$delay = !empty($settings['pxl_animate_delay']) ? $settings['pxl_animate_delay'] : '0';

$coming_soon_bg_type = $settings['select_background_background'] ?? '';
$coming_soon_video_link = $settings['select_background_video_link'] ?? '';
if (is_array($coming_soon_video_link)) {
    $coming_soon_video_url = !empty($coming_soon_video_link['url'])
        ? $coming_soon_video_link['url']
        : '';
} else {
    $coming_soon_video_url = is_string($coming_soon_video_link)
        ? trim($coming_soon_video_link)
        : '';
}

if ($coming_soon_video_url && $coming_soon_bg_type === '') {
    $coming_soon_bg_type = 'video';
}

$has_coming_soon_media =
    $is_coming_soon &&
    (($coming_soon_bg_type === 'video' && $coming_soon_video_url) ||
        ($coming_soon_bg_type === 'classic' &&
            (!empty($settings['select_background_image']['url']) ||
                !empty($settings['select_background_color']))) ||
        $coming_soon_bg_type === 'gradient');

if ($is_coming_soon) {
    if (!$has_coming_soon_media && !$has_title && !$has_category) {
        return;
    }
} elseif (!$has_image && !$has_title && !$has_category && !$has_button_text) {
    return;
}

$widget->add_render_attribute('showcase_button', 'class', 'btn btn-default pxl-icon--right');

if ($has_link) {
    $link_attrs = [
        'href' => $settings['button_url']['url'],
    ];
    if (!empty($settings['button_url']['is_external'])) {
        $link_attrs['target'] = '_blank';
    }
    if (!empty($settings['button_url']['nofollow'])) {
        $link_attrs['rel'] = 'nofollow';
    }

    $widget->add_render_attribute('showcase_image', $link_attrs);
    $widget->add_render_attribute('showcase_title', $link_attrs);
    $widget->add_render_attribute('showcase_button', $link_attrs);
}

$showcase_classes = ['pxl-showcase', 'pxl-showcase1'];
if ($is_coming_soon) {
    $showcase_classes[] = 'is-coming-soon';
}
if (!empty($animate)) {
    $showcase_classes[] = $animate;
}
?>
<div class="<?php echo esc_attr(
    implode(' ', $showcase_classes),
); ?>" data-wow-delay="<?php echo esc_attr($delay); ?>ms">
    <div class="pxl-item--inner">
        <?php if ($is_coming_soon): ?>
            <div class="pxl-item--image">
                <?php if ($coming_soon_video_url):

                    $play_once = ($settings['select_background_play_once'] ?? '') === 'yes';
                    $play_on_mobile =
                        ($settings['select_background_play_on_mobile'] ?? '') === 'yes';
                    $is_embed =
                        class_exists('\Elementor\Embed') &&
                        \Elementor\Embed::is_embed_video($coming_soon_video_url);
                    $container_classes = ['elementor-background-video-container'];
                    if (!$play_on_mobile) {
                        $container_classes[] = 'elementor-hidden-mobile';
                    }
                    $filetype = wp_check_filetype($coming_soon_video_url);
                    $video_type = !empty($filetype['type']) ? $filetype['type'] : 'video/mp4';
                    ?>
                    <div class="<?php echo esc_attr(implode(' ', $container_classes)); ?>">
                        <?php if ($is_embed): ?>
                            <div class="elementor-background-video-embed"></div>
                        <?php else: ?>
                            <video
                                class="elementor-background-video-hosted elementor-html5-video"
                                role="presentation"
                                autoplay
                                muted
                                playsinline
                                <?php echo $play_once ? '' : 'loop'; ?>
                            >
                                <source
                                    src="<?php echo esc_url($coming_soon_video_url); ?>"
                                    type="<?php echo esc_attr($video_type); ?>"
                                >
                            </video>
                        <?php endif; ?>
                    </div>
                <?php
                endif; ?>
            </div>
        <?php elseif ($has_image):

            $img = pxl_get_image_by_size([
                'attach_id' => (int) $settings['image']['id'],
                'thumb_size' => $img_size,
                'class' => 'no-lazyload',
            ]);
            $thumbnail = !empty($img['thumbnail']) ? $img['thumbnail'] : '';
            if (!empty($thumbnail)): ?>
                <div class="pxl-item--image">
                    <?php if ($has_link): ?>
                        <a <?php pxl_print_html(
                            $widget->get_render_attribute_string('showcase_image'),
                        ); ?>>
                            <?php echo wp_kses_post($thumbnail); ?>
                        </a>
                    <?php else: ?>
                        <?php echo wp_kses_post($thumbnail); ?>
                    <?php endif; ?>
                </div>
            <?php endif;
            ?>
        <?php
        endif; ?>

        <?php if ($has_title || $has_category || $has_button_text): ?>
            <div class="pxl-item--container">
                <?php if ($has_title || $has_category): ?>
                    <div class="pxl-item--content">
                        <?php if ($has_title): ?>
                            <<?php echo esc_attr($title_tag); ?> class="pxl-item--title">
                                <?php if ($has_link): ?>
                                    <a <?php pxl_print_html(
                                        $widget->get_render_attribute_string('showcase_title'),
                                    ); ?>>
                                        <?php echo esc_html($settings['title']); ?>
                                    </a>
                                <?php else: ?>
                                    <?php echo esc_html($settings['title']); ?>
                                <?php endif; ?>
                            </<?php echo esc_attr($title_tag); ?>>
                        <?php endif; ?>
                        <?php if ($has_category): ?>
                            <div class="pxl-item--category"><?php echo esc_html(
                                $settings['category'],
                            ); ?></div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php if ($has_button_text): ?>
                    <div class="pxl-item--readmore">
                        <?php if ($has_link): ?>
                            <a <?php pxl_print_html(
                                $widget->get_render_attribute_string('showcase_button'),
                            ); ?>>
                                <div class="pxl--btn-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none">
                                        <path d="M18.183 10.9642L12.2768 16.8704C12.1537 16.9936 11.9866 17.0627 11.8125 17.0627C11.6384 17.0627 11.4713 16.9936 11.3482 16.8704C11.2251 16.7473 11.1559 16.5803 11.1559 16.4061C11.1559 16.232 11.2251 16.065 11.3482 15.9418L16.1347 11.1561H3.28125C3.1072 11.1561 2.94028 11.087 2.81721 10.9639C2.69414 10.8408 2.625 10.6739 2.625 10.4999C2.625 10.3258 2.69414 10.1589 2.81721 10.0358C2.94028 9.91277 3.1072 9.84363 3.28125 9.84363H16.1347L11.3482 5.05792C11.2251 4.93478 11.1559 4.76777 11.1559 4.59363C11.1559 4.41948 11.2251 4.25247 11.3482 4.12933C11.4713 4.00619 11.6384 3.93701 11.8125 3.93701C11.9866 3.93701 12.1537 4.00619 12.2768 4.12933L18.183 10.0356C18.2441 10.0965 18.2925 10.1689 18.3255 10.2486C18.3585 10.3282 18.3755 10.4136 18.3755 10.4999C18.3755 10.5861 18.3585 10.6715 18.3255 10.7512C18.2925 10.8308 18.2441 10.9032 18.183 10.9642Z" fill="currentColor"/>
                                    </svg>
                                </div>
                                <span><?php echo esc_html($settings['button_text']); ?></span>
                            </a>
                        <?php else: ?>
                            <span class="btn btn-default pxl-icon--right">
                                <div class="pxl--btn-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none">
                                        <path d="M18.183 10.9642L12.2768 16.8704C12.1537 16.9936 11.9866 17.0627 11.8125 17.0627C11.6384 17.0627 11.4713 16.9936 11.3482 16.8704C11.2251 16.7473 11.1559 16.5803 11.1559 16.4061C11.1559 16.232 11.2251 16.065 11.3482 15.9418L16.1347 11.1561H3.28125C3.1072 11.1561 2.94028 11.087 2.81721 10.9639C2.69414 10.8408 2.625 10.6739 2.625 10.4999C2.625 10.3258 2.69414 10.1589 2.81721 10.0358C2.94028 9.91277 3.1072 9.84363 3.28125 9.84363H16.1347L11.3482 5.05792C11.2251 4.93478 11.1559 4.76777 11.1559 4.59363C11.1559 4.41948 11.2251 4.25247 11.3482 4.12933C11.4713 4.00619 11.6384 3.93701 11.8125 3.93701C11.9866 3.93701 12.1537 4.00619 12.2768 4.12933L18.183 10.0356C18.2441 10.0965 18.2925 10.1689 18.3255 10.2486C18.3585 10.3282 18.3755 10.4136 18.3755 10.4999C18.3755 10.5861 18.3585 10.6715 18.3255 10.7512C18.2925 10.8308 18.2441 10.9032 18.183 10.9642Z" fill="currentColor"/>
                                    </svg>
                                </div>
                                <span><?php echo esc_html($settings['button_text']); ?></span>
                            </span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
