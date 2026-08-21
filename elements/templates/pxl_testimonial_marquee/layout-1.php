<?php
/**
 * Case Testimonial Marquee — Layout 1
 * Figma: 6026:305
 *
 * @var array $settings
 */
$testimonials = isset($settings['testimonials']) ? $settings['testimonials'] : [];
if (!empty($testimonials)):

    $html_id = pxl_get_element_id($settings);
    $speed_raw = isset($settings['marquee_speed']['size'])
        ? floatval($settings['marquee_speed']['size'])
        : 80;
    $speed = $speed_raw > 0 ? $speed_raw : 80;
    $direction = !empty($settings['marquee_direction']) ? $settings['marquee_direction'] : 'left';
    $layout = !empty($settings['layout']) ? $settings['layout'] : '1';
    $animate_delay = isset($settings['pxl_animate_delay']) ? $settings['pxl_animate_delay'] : 0;
    $animate_class = isset($settings['pxl_animate']) ? $settings['pxl_animate'] : '';
    $category_prefix = isset($settings['category_prefix'])
        ? trim($settings['category_prefix'])
        : esc_html__('for', 'frameflow');
    $theme_uri = get_template_directory_uri();
    $stars_src = $theme_uri . '/assets/imgs/testimonial-marquee/stars.svg';
    $avatar_bg_src = $theme_uri . '/assets/imgs/testimonial-marquee/avatar.svg';
    $avatar_logo_src = $theme_uri . '/assets/imgs/testimonial-marquee/envato.svg';
    ?>
    <div
        id="<?php echo esc_attr($html_id); ?>"
        class="pxl-testimonial-marquee pxl-testimonial-marquee<?php echo esc_attr(
            $layout,
        ); ?> <?php echo esc_attr($animate_class); ?>"
        data-wow-delay="<?php echo esc_attr($animate_delay); ?>ms"
        data-marquee-speed="<?php echo esc_attr($speed); ?>"
        data-marquee-direction="<?php echo esc_attr($direction); ?>"
    >
        <div class="pxl-testimonial-marquee__inner">
            <div class="pxl-testimonial-marquee__track">
                <?php for ($loop = 0; $loop < 2; $loop++): ?>
                    <?php foreach ($testimonials as $item):

                        $name = isset($item['name']) ? trim($item['name']) : '';
                        $position = isset($item['position']) ? trim($item['position']) : '';
                        $category = isset($item['category']) ? trim($item['category']) : '';
                        $description = isset($item['description'])
                            ? trim($item['description'])
                            : '';
                        $avatar = isset($item['avatar']) ? $item['avatar'] : [];
                        $star = isset($item['star']) ? intval($item['star']) : 5;
                        $star = max(0, min(5, $star));
                        $has_custom_avatar = !empty($avatar['id']) || !empty($avatar['url']);

                        if (
                            $name === '' &&
                            $position === '' &&
                            $category === '' &&
                            $description === '' &&
                            !$has_custom_avatar
                        ) {
                            continue;
                        }
                        ?>
                        <div class="pxl-item"<?php echo $loop > 0 ? ' aria-hidden="true"' : ''; ?>>
                            <div class="pxl-item--inner">
                                <div class="pxl-item--header">
                                    <div class="pxl-item--author">
                                        <div class="pxl-item--avatar">
                                            <?php if (!empty($avatar['id'])) {
                                                $img = pxl_get_image_by_size([
                                                    'attach_id' => $avatar['id'],
                                                    'thumb_size' => '67x67',
                                                    'class' => 'no-lazyload',
                                                ]);
                                                echo wp_kses_post($img['thumbnail']);
                                            } elseif (!empty($avatar['url'])) { ?>
                                                <img
                                                    src="<?php echo esc_url($avatar['url']); ?>"
                                                    alt="<?php echo esc_attr($name); ?>"
                                                    width="67"
                                                    height="67"
                                                />
                                            <?php } else { ?>
                                                <img
                                                    class="pxl-item--avatar-bg"
                                                    src="<?php echo esc_url($avatar_bg_src); ?>"
                                                    alt=""
                                                    width="67"
                                                    height="67"
                                                />
                                                <img
                                                    class="pxl-item--avatar-logo"
                                                    src="<?php echo esc_url($avatar_logo_src); ?>"
                                                    alt=""
                                                    width="24"
                                                    height="34"
                                                />
                                            <?php } ?>
                                        </div>
                                        <div class="pxl-item--meta">
                                            <?php if ($name !== ''): ?>
                                                <div class="pxl-item--name"><?php echo esc_html(
                                                    $name,
                                                ); ?></div>
                                            <?php endif; ?>
                                            <?php if ($position !== ''): ?>
                                                <div class="pxl-item--position"><?php echo esc_html(
                                                    $position,
                                                ); ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php if ($star > 0): ?>
                                        <div
                                            class="pxl-item--stars"
                                            data-stars="<?php echo esc_attr((string) $star); ?>"
                                            role="img"
                                            aria-label="<?php echo esc_attr(
                                                sprintf(
                                                    /* translators: %d: star rating out of 5 */
                                                    _n('%d star', '%d stars', $star, 'frameflow'),
                                                    $star,
                                                ),
                                            ); ?>"
                                        >
                                            <img
                                                src="<?php echo esc_url($stars_src); ?>"
                                                alt=""
                                                width="84"
                                                height="16"
                                            />
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <?php if ($category !== ''): ?>
                                    <div class="pxl-item--category">
                                        <?php if ($category_prefix !== ''): ?>
                                            <span class="pxl-item--category-prefix"><?php echo esc_html(
                                                $category_prefix,
                                            ); ?></span>
                                        <?php endif; ?>
                                        <span class="pxl-item--category-name"><?php echo esc_html(
                                            $category,
                                        ); ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if ($description !== ''): ?>
                                    <div class="pxl-item--description"><?php echo wp_kses_post(
                                        nl2br($description),
                                    ); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php
                    endforeach; ?>
                <?php endfor; ?>
            </div>
        </div>
    </div>
    <?php
endif;
