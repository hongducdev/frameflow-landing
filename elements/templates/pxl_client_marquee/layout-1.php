<?php
$clients = isset($settings['clients']) ? $settings['clients'] : [];
if (!empty($clients)) :
    $html_id   = pxl_get_element_id($settings);
    $speed_raw = isset($settings['marquee_speed']['size']) ? floatval($settings['marquee_speed']['size']) : 80;
    $speed     = $speed_raw > 0 ? $speed_raw : 80;
    $direction = !empty($settings['marquee_direction']) ? $settings['marquee_direction'] : 'left';
?>
    <div id="<?php echo esc_attr($html_id); ?>" class="pxl-client-marquee pxl-client-marquee1 <?php echo esc_attr($settings['style'] . ' ' . $settings['sub_style_2'] . ' ' . $settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms" data-marquee-speed="<?php echo esc_attr($speed); ?>" data-marquee-direction="<?php echo esc_attr($direction); ?>">
        <div class="pxl-client-marquee__inner">
            <div class="pxl-client-marquee__track">
                <?php for ($loop = 0; $loop < 2; $loop++) : ?>
                    <?php foreach ($clients as $item) :
                        $type = isset($item['client_type']) ? $item['client_type'] : '';
                        $logo = isset($item['client_logo']) ? $item['client_logo'] : [];
                        $link = isset($item['client_link']) ? $item['client_link'] : [];

                        $url         = isset($link['url']) ? $link['url'] : '';
                        $target_attr = !empty($link['is_external']) ? ' target="_blank"' : '';
                        $rel_attr    = !empty($link['nofollow']) ? ' rel="nofollow"' : '';

                        $logo_style_attr = '';
                        if (
                            $settings['style'] === 'style-5'
                            && $type === 'logo_image'
                            && !empty($item['client_logo_height']['size'])
                        ) {
                            $logo_h = floatval($item['client_logo_height']['size']);
                            if ($logo_h > 0) {
                                $logo_style_attr = ' style="--pxl-logo-h: ' . esc_attr($logo_h) . 'px;"';
                            }
                        }
                    ?>
                        <div class="pxl-client-marquee__item">
                            <?php if (!empty($url)) : ?>
                                <a class="pxl-client-marquee__item-link" href="<?php echo esc_url($url); ?>"<?php echo !empty($link['is_external']) ? ' target="' . esc_attr('_blank') . '"' : ''; ?><?php echo !empty($link['nofollow']) ? ' rel="' . esc_attr('nofollow') . '"' : ''; ?>>
                            <?php endif; ?>

                            <div class="pxl-client-marquee__item-inner">
                                <?php if ($type == 'logo_icon' && !empty($item['client_logo_icon']['value'])) : ?>
                                    <span class="pxl-client-marquee__logo">
                                        <?php \Elementor\Icons_Manager::render_icon($item['client_logo_icon'], ['aria-hidden' => 'true']); ?>
                                    </span>
                                <?php endif; ?>
                                <?php if ($type == 'logo_image' && !empty($item['client_logo']['id'])) : ?>
                                    <span class="pxl-client-marquee__logo"<?php echo $logo_style_attr; ?>>
                                        <?php $img_icon  = pxl_get_image_by_size(array(
                                            'attach_id'  => $item['client_logo']['id'],
                                            'thumb_size' => 'full',
                                        ));
                                        $thumbnail_icon    = $img_icon['thumbnail'];
                                        echo pxl_print_html($thumbnail_icon); ?>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <?php if (!empty($url)) : ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endfor; ?>
            </div>
        </div>
    </div>
<?php endif; ?>

