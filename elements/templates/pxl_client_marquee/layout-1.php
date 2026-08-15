<?php
$clients = isset($settings['clients']) ? $settings['clients'] : [];
if (!empty($clients)) :
    $html_id   = pxl_get_element_id($settings);
    $speed_raw = isset($settings['marquee_speed']['size']) ? floatval($settings['marquee_speed']['size']) : 80;
    $speed     = $speed_raw > 0 ? $speed_raw : 80;
    $direction = !empty($settings['marquee_direction']) ? $settings['marquee_direction'] : 'left';
    $style     = !empty($settings['style']) ? $settings['style'] : 'style-1';
    $wrapper_class = trim(
        'pxl-client-marquee pxl-client-marquee1 ' .
        $style . ' ' .
        (isset($settings['pxl_animate']) ? $settings['pxl_animate'] : '')
    );
    $animate_delay = isset($settings['pxl_animate_delay']) && $settings['pxl_animate_delay'] !== ''
        ? $settings['pxl_animate_delay']
        : '0';
?>
    <div id="<?php echo esc_attr($html_id); ?>" class="<?php echo esc_attr($wrapper_class); ?>" data-wow-delay="<?php echo esc_attr($animate_delay); ?>ms" data-marquee-speed="<?php echo esc_attr($speed); ?>" data-marquee-direction="<?php echo esc_attr($direction); ?>">
        <div class="pxl-items--inner">
            <div class="pxl-items--track">
                <?php for ($loop = 0; $loop < 2; $loop++) : ?>
                    <?php foreach ($clients as $item) :
                        $type = isset($item['client_type']) ? $item['client_type'] : '';
                        $name = isset($item['client_name']) ? $item['client_name'] : '';

                        $logo_style_attr = '';
                        if (
                            $type === 'logo_image'
                            && !empty($item['client_logo_height']['size'])
                        ) {
                            $logo_h = floatval($item['client_logo_height']['size']);
                            if ($logo_h > 0) {
                                $logo_style_attr = ' style="--pxl-logo-h: ' . esc_attr($logo_h) . 'px;"';
                            }
                        }
                    ?>
                        <div class="pxl-item">
                            <div class="pxl-item--inner">
                                <?php if ($type == 'logo_icon' && !empty($item['client_logo_icon']['value'])) : ?>
                                    <span class="pxl-item--logo">
                                        <?php \Elementor\Icons_Manager::render_icon($item['client_logo_icon'], ['aria-hidden' => 'true']); ?>
                                    </span>
                                <?php endif; ?>
                                <?php if ($type == 'logo_image' && !empty($item['client_logo']['id'])) : ?>
                                    <span class="pxl-item--logo"<?php echo $logo_style_attr; ?>>
                                        <?php $img_icon  = pxl_get_image_by_size(array(
                                            'attach_id'  => $item['client_logo']['id'],
                                            'thumb_size' => 'full',
                                        ));
                                        $thumbnail_icon    = $img_icon['thumbnail'];
                                        echo pxl_print_html($thumbnail_icon); ?>
                                    </span>
                                <?php endif; ?>
                                <?php if (!empty($name)) : ?>
                                    <span class="pxl-item--name">
                                        <?php echo esc_html($name); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endfor; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
