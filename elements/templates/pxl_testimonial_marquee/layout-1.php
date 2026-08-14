<?php
$testimonials = isset($settings['testimonials']) ? $settings['testimonials'] : [];
if (!empty($testimonials)) :
    $html_id = pxl_get_element_id($settings);
    $speed_raw = isset($settings['marquee_speed']['size']) ? floatval($settings['marquee_speed']['size']) : 80;
    $speed = $speed_raw > 0 ? $speed_raw : 80;
    $direction = !empty($settings['marquee_direction']) ? $settings['marquee_direction'] : 'left';
    $layout = !empty($settings['layout']) ? $settings['layout'] : '1';
    $animate_delay = isset($settings['pxl_animate_delay']) ? $settings['pxl_animate_delay'] : 0;
?>
    <div id="<?php echo esc_attr($html_id); ?>" class="pxl-testimonial-marquee pxl-testimonial-marquee<?php echo esc_attr($layout); ?> <?php echo esc_attr(isset($settings['pxl_animate']) ? $settings['pxl_animate'] : ''); ?>" data-wow-delay="<?php echo esc_attr($animate_delay); ?>ms" data-marquee-speed="<?php echo esc_attr($speed); ?>" data-marquee-direction="<?php echo esc_attr($direction); ?>">
        <div class="pxl-testimonial-marquee__inner">
            <div class="pxl-testimonial-marquee__track">
                <?php for ($loop = 0; $loop < 2; $loop++) : ?>
                    <?php foreach ($testimonials as $item) :
                        $name = isset($item['name']) ? trim($item['name']) : '';
                        $position = isset($item['position']) ? trim($item['position']) : '';
                        $description = isset($item['description']) ? trim($item['description']) : '';

                        if ($name === '' && $position === '' && $description === '') {
                            continue;
                        }
                    ?>
                        <div class="pxl-item" <?php echo $loop > 0 ? ' aria-hidden="true"' : ''; ?>>
                            <div class="pxl-item--inner">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="25" viewBox="0 0 28 25" fill="none">
                                    <path d="M6.95652 0L9.65217 1.94915C9.01449 2.68362 8.31884 3.81356 7.56522 5.33898C6.86957 6.80791 6.28986 8.41808 5.82609 10.1695C5.36232 11.9209 5.18841 13.6441 5.30435 15.339C5.71014 15.226 6.05797 15.1412 6.34783 15.0847C6.69565 14.9718 7.04348 14.9153 7.3913 14.9153C8.66667 14.9153 9.73913 15.339 10.6087 16.1864C11.5362 16.9774 12 18.1073 12 19.5763C12 21.2147 11.5072 22.5424 10.5217 23.5593C9.53623 24.5198 8.28986 25 6.78261 25C4.57971 25 2.89855 24.209 1.73913 22.6271C0.57971 21.0452 0 19.1243 0 16.8644C0 15.2825 0.26087 13.5028 0.782609 11.5254C1.36232 9.49153 2.17391 7.45763 3.21739 5.42373C4.26087 3.33333 5.50725 1.52542 6.95652 0ZM22.9565 0L25.6522 1.94915C25.0145 2.68362 24.3188 3.81356 23.5652 5.33898C22.8696 6.80791 22.2899 8.41808 21.8261 10.1695C21.3623 11.9209 21.1884 13.6441 21.3043 15.339C21.7101 15.226 22.058 15.1412 22.3478 15.0847C22.6957 14.9718 23.0435 14.9153 23.3913 14.9153C24.6667 14.9153 25.7391 15.339 26.6087 16.1864C27.5362 16.9774 28 18.1073 28 19.5763C28 21.2147 27.5072 22.5424 26.5217 23.5593C25.5362 24.5198 24.2899 25 22.7826 25C20.5797 25 18.8986 24.209 17.7391 22.6271C16.5797 21.0452 16 19.1243 16 16.8644C16 15.2825 16.2609 13.5028 16.7826 11.5254C17.3623 9.49153 18.1739 7.45763 19.2174 5.42373C20.2609 3.33333 21.5072 1.52542 22.9565 0Z" fill="currentColor" />
                                </svg>
                                <?php if ($name !== '') : ?>
                                    <div class="pxl-item--name"><?php echo esc_html($name); ?></div>
                                <?php endif; ?>
                                <?php if ($position !== '') : ?>
                                    <div class="pxl-item--position"><?php echo esc_html($position); ?></div>
                                <?php endif; ?>
                                <div class="pxl-item--divider"></div>
                                <?php if ($description !== '') : ?>
                                    <div class="pxl-item--description"><?php echo wp_kses_post(nl2br($description)); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endfor; ?>
            </div>
        </div>
    </div>
<?php endif; ?>