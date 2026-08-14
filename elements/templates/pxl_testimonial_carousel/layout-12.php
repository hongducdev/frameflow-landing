<?php
$arrows = $widget->get_setting('arrows', false);
$pagination = $widget->get_setting('pagination', false);
$pagination_type = $widget->get_setting('pagination_type', 'bullets');
$arrows_type = $widget->get_setting('arrows_type', '');
$arrow_full_content_with_space = $widget->get_setting(
    'arrow_full_content_with_space',
    'none',
);
$arrow_full_content_with_space_value = (int) $widget->get_setting(
    'arrow_full_content_with_space_value',
    1200,
);
$pause_on_hover = $widget->get_setting('pause_on_hover', false);
$autoplay = $widget->get_setting('autoplay', false);
$autoplay_speed = $widget->get_setting('autoplay_speed', '5000');
$infinite = $widget->get_setting('infinite', false);
$speed = $widget->get_setting('speed', '500');
$drap = $widget->get_setting('drap', false);

$center_bg = $widget->get_setting('center_bg', []);
$center_label = $widget->get_setting(
    'center_label',
    esc_html__('Excellence Rated', 'frameflow'),
);
$center_rating = $widget->get_setting('center_rating', '4.9/5.0');
$center_subtitle = $widget->get_setting(
    'center_subtitle',
    esc_html__('Google Verified Experiences', 'frameflow'),
);
$center_star = (int) $widget->get_setting('center_star', 5);

// Desktop/tablet: 2 testimonials. Mobile (<768): 1.
$opts = [
    'slide_direction' => 'horizontal',
    'slide_percolumn' => 1,
    'slide_mode' => 'slide',
    'center_slide' => false,
    'slides_to_show' => 2,
    'slides_to_show_xxl' => 2,
    'slides_to_show_lg' => 2,
    'slides_to_show_md' => 2,
    'slides_to_show_sm' => 1,
    'slides_to_show_xs' => 1,
    'slides_to_scroll' => 1,
    'arrow' => (bool) $arrows,
    'pagination' => (bool) $pagination,
    'pagination_type' => $pagination_type,
    'autoplay' => (bool) $autoplay,
    'pause_on_hover' => (bool) $pause_on_hover,
    'pause_on_interaction' => true,
    'delay' => (int) $autoplay_speed,
    'loop' => (bool) $infinite,
    'speed' => (int) $speed,
];
$widget->add_render_attribute('carousel', [
    'class' => 'pxl-swiper-container',
    'dir' => is_rtl() ? 'rtl' : 'ltr',
    'data-settings' => wp_json_encode($opts),
]);

$render_side_card = static function ($value) use ($settings) {
    if (empty($value) || !is_array($value)) {
        return;
    }

    $title = isset($value['title']) ? $value['title'] : '';
    $position = isset($value['position']) ? $value['position'] : '';
    $avatar = isset($value['avatar']) ? $value['avatar'] : [];
    $desc = isset($value['desc']) ? $value['desc'] : '';
    ?>
    <div class="pxl-item--side">
        <div class="pxl-item--inner <?php echo esc_attr($settings['pxl_animate']); ?>">
            <?php if (!empty($avatar['id'])) {
                $img = pxl_get_image_by_size([
                    'attach_id' => $avatar['id'],
                    'thumb_size' => '190x190',
                    'class' => 'no-lazyload',
                ]);
                ?>
                <div class="pxl-item--avatar">
                    <?php echo wp_kses_post($img['thumbnail']); ?>
                </div>
            <?php } ?>
            <div class="pxl-item--info">
                <?php if (!empty($title)): ?>
                    <span class="pxl-item--title"><?php echo pxl_print_html($title); ?></span>
                <?php endif; ?>
                <?php if (!empty($position)): ?>
                    <p class="pxl-item--position"><?php echo pxl_print_html($position); ?></p>
                <?php endif; ?>
            </div>
            <div class="pxl-item--icon" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="19" viewBox="0 0 22 19" fill="none">
                    <path d="M17.4308 0C18.841 0 19.941 0.500471 20.7308 1.50141C21.5769 2.50235 22 3.86474 22 5.58858C22 8.14654 21.4359 10.4821 20.3077 12.5952C19.1231 14.7083 17.2333 16.6823 14.6385 18.5174C13.9615 19.0179 13.4256 19.1291 13.0308 18.851C12.8051 18.6842 12.6923 18.434 12.6923 18.1003C12.6923 17.8223 12.8897 17.5443 13.2846 17.2662C15.2026 15.6536 16.4436 14.4024 17.0077 13.5127C17.5154 12.6786 17.7692 11.7889 17.7692 10.8435C17.7692 9.84258 17.5436 9.06407 17.0923 8.508C16.641 8.00753 16.1333 7.56266 15.5692 7.17341C15.0051 6.83976 14.4974 6.4227 14.0462 5.92223C13.5949 5.42176 13.3692 4.67105 13.3692 3.67011C13.3692 2.66917 13.7359 1.80725 14.4692 1.08435C15.1462 0.361451 16.1333 0 17.4308 0ZM4.73846 0C6.14872 0 7.27692 0.500471 8.12308 1.50141C8.91282 2.50235 9.30769 3.86474 9.30769 5.58858C9.30769 8.14654 8.74359 10.4821 7.61538 12.5952C6.43077 14.7083 4.54103 16.6823 1.94615 18.5174C1.26923 19.0179 0.733334 19.1291 0.338462 18.851C0.112821 18.6842 0 18.434 0 18.1003C0 17.8223 0.197436 17.5443 0.592308 17.2662C2.51026 15.6536 3.75128 14.4024 4.31539 13.5127C4.82308 12.6786 5.07692 11.7889 5.07692 10.8435C5.07692 9.84258 4.85128 9.06407 4.4 8.508C3.94872 8.00753 3.44103 7.56266 2.87692 7.17341C2.31282 6.83976 1.80513 6.4227 1.35385 5.92223C0.902564 5.42176 0.676923 4.67105 0.676923 3.67011C0.676923 2.66917 1.04359 1.80725 1.77692 1.08435C2.45385 0.361451 3.44103 0 4.73846 0Z" fill="#B38F6F"/>
                </svg>
            </div>
            <?php if (!empty($desc)): ?>
                <p class="pxl-item--description"><?php echo pxl_print_html($desc); ?></p>
            <?php endif; ?>
        </div>
    </div>
    <?php
};

if (
    isset($settings['testimonial']) &&
    !empty($settings['testimonial']) &&
    count($settings['testimonial'])
):
    ?>
    <div class="pxl-swiper-slider pxl-testimonial-carousel pxl-testimonial-carousel12" <?php if (
        $drap !== false
    ): ?>data-cursor-drap="<?php echo esc_html('DRAG', 'frameflow'); ?>" <?php endif; ?>>
        <div class="pxl-carousel12-stage">
            <div class="pxl-item--center">
                <div class="pxl-item--center-inner">
                    <?php if (!empty($center_bg['id'])) {
                        $center_img = pxl_get_image_by_size([
                            'attach_id' => $center_bg['id'],
                            'thumb_size' => '600x760',
                            'class' => 'no-lazyload',
                        ]);
                        ?>
                        <div class="pxl-item--center-media">
                            <?php echo wp_kses_post($center_img['thumbnail']); ?>
                        </div>
                    <?php } ?>
                    <div class="pxl-item--center-overlay"></div>
                    <div class="pxl-item--center-content">
                        <?php if (!empty($center_label)): ?>
                            <span class="pxl-item--center-label"><?php echo esc_html(
                                $center_label,
                            ); ?></span>
                        <?php endif; ?>
                        <?php if (!empty($center_rating)): ?>
                            <span class="pxl-item--center-rating pxl-item--number-value"><?php echo esc_html(
                                $center_rating,
                            ); ?></span>
                        <?php endif; ?>
                        <?php if (!empty($center_subtitle)): ?>
                            <span class="pxl-item--center-subtitle pxl-item--number-title"><?php echo esc_html(
                                $center_subtitle,
                            ); ?></span>
                        <?php endif; ?>
                    </div>
                    <?php if ($center_star > 0): ?>
                        <div class="pxl-item--center-stars">
                            <?php for ($i = 0; $i < $center_star; $i++): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M10.697 3.87661L9.88149 0L9.06599 3.87661C8.79774 5.15181 8.16431 6.32144 7.24287 7.24287C6.32144 8.16431 5.15181 8.79774 3.87661 9.06599L0 9.88149L3.87661 10.697C5.1518 10.9652 6.32143 11.5987 7.24287 12.5202C8.16431 13.4416 8.79774 14.6112 9.06599 15.8864L9.88149 19.763L10.697 15.8864C10.9652 14.6112 11.5987 13.4416 12.5201 12.5202C13.4416 11.5987 14.6112 10.9652 15.8864 10.697L19.763 9.88149L15.8864 9.06599C14.6112 8.79774 13.4415 8.16431 12.5201 7.24287C11.5987 6.32144 10.9652 5.15181 10.697 3.87661Z" fill="white"/>
                                </svg>
                            <?php endfor; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="pxl-carousel-inner">
                <div <?php pxl_print_html($widget->get_render_attribute_string('carousel')); ?>>
                    <div class="pxl-swiper-wrapper">
                        <?php foreach ($settings['testimonial'] as $value): ?>
                            <div class="pxl-swiper-slide">
                                <?php $render_side_card($value); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <?php if ($pagination !== false || $arrows !== false): ?>
            <div class="pxl-swiper-bottom">
                <?php if ($pagination !== false): ?>
                    <div class="pxl-swiper-dots style-1"></div>
                <?php endif; ?>
            </div>
            <?php if ($arrows !== false): ?>
                <?php
                $arrow_space_width = max(0, $arrow_full_content_with_space_value) . 'px';
                $arrow_wrap_style = '';
                if ($arrow_full_content_with_space === 'end') {
                    $arrow_wrap_style =
                        'padding-right: max(15px, calc((100% - ' .
                        $arrow_space_width .
                        ') / 2));';
                }
                $arrow_wrap_style_attr =
                    $arrow_wrap_style !== ''
                        ? ' style="' . esc_attr($arrow_wrap_style) . '"'
                        : '';
                ?>
                <div class="pxl-swiper-arrow-wrap <?php echo esc_attr(
                    $arrows_type,
                ); ?>"<?php echo wp_kses_post($arrow_wrap_style_attr); ?>>
                    <?php frameflow_include_swiper_arrows($widget); ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
<?php endif; ?>
