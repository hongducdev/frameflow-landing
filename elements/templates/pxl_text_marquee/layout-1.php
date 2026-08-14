<?php
$items = isset($settings['items']) ? $settings['items'] : [];
if (!empty($items)) :
    $html_id   = pxl_get_element_id($settings);
    $speed_raw = isset($settings['marquee_speed']['size']) ? floatval($settings['marquee_speed']['size']) : 80;
    $speed     = $speed_raw > 0 ? $speed_raw : 80;
    $direction = !empty($settings['marquee_direction']) ? $settings['marquee_direction'] : 'left';
    $icon_html = '';
    $wrapper_class = trim(
        (isset($settings['style']) ? $settings['style'] : '') . ' ' .
        (isset($settings['pxl_animate']) ? $settings['pxl_animate'] : '')
    );
    $animate_delay = isset($settings['pxl_animate_delay']) ? $settings['pxl_animate_delay'] : 0;

    if (!empty($settings['marquee_icon'])) {
        ob_start();
        \Elementor\Icons_Manager::render_icon($settings['marquee_icon'], ['aria-hidden' => 'true']);
        $icon_html = ob_get_clean();
    }
?>
    <div id="<?php echo esc_attr($html_id); ?>" class="pxl-text-marquee pxl-text-marquee1 <?php echo esc_attr($wrapper_class); ?>" data-wow-delay="<?php echo esc_attr($animate_delay); ?>ms" data-marquee-speed="<?php echo esc_attr($speed); ?>" data-marquee-direction="<?php echo esc_attr($direction); ?>">
        <div class="pxl-text-marquee__inner">
            <div class="pxl-text-marquee__track">
                <?php foreach ($items as $item) :
                    $text = isset($item['item_text']) ? trim($item['item_text']) : '';
                    if ($text === '') {
                        continue;
                    }
                ?>
                    <div class="pxl-text-marquee__item">
                        <?php if (!empty($icon_html)) : ?>
                            <span class="pxl-text-marquee__icon">
                                <?php echo $icon_html; ?>
                            </span>
                        <?php endif; ?>
                        <div class="pxl-text-marquee__label"><?php echo wp_kses_post($text); ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
