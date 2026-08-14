<?php
global $wp;
$html_id = pxl_get_element_id($settings);
?>
<div class="pxl-link-wrap">
    <h3 class="pxl-widget-title pxl-empty"><?php echo pxl_print_html($settings['wg_title']); ?></h3>
    <?php if (isset($settings['link']) && !empty($settings['link']) && count($settings['link'])):
        $current_url_path = home_url(add_query_arg(array(), $wp->request)); ?>
        <ul id="pxl-link-<?php echo esc_attr($html_id) ?>" class="pxl-link pxl-link-l1 <?php echo esc_attr($settings['style_vertical'] . ' ' . $settings['style_horizontal'] . ' ' . $settings['type'] . ' ' . $settings['sub_style_vertical_2']); ?>">
            <?php
            foreach ($settings['link'] as $key => $link):
                $icon_key = $widget->get_repeater_setting_key('pxl_icon', 'icons', $key);
                $widget->add_render_attribute($icon_key, [
                    'class' => $link['pxl_icon'],
                    'aria-hidden' => 'true',
                ]);
                $link_key = $widget->get_repeater_setting_key('link', 'value', $key);
                if (! empty($link['link']['url'])) {
                    $widget->add_render_attribute($link_key, 'href', $link['link']['url']);

                    if ($link['link']['is_external']) {
                        $widget->add_render_attribute($link_key, 'target', '_blank');
                    }

                    if ($link['link']['nofollow']) {
                        $widget->add_render_attribute($link_key, 'rel', 'nofollow');
                    }
                }
                $link_attributes = $widget->get_render_attribute_string($link_key);
                $active_cls = '';
                $current_id = get_the_ID();
                if ($current_id > 0) {
                    $current_url = get_the_permalink($current_id, false);
                    if ($link['link']['url'] == $current_url || $link['link']['url'] . '/' == $current_url || $link['link']['url'] == $current_url . '/')
                        $active_cls = 'active';
                }
                if ($link['link']['url'] == $current_url_path || $link['link']['url'] . '/' == $current_url_path || $link['link']['url'] == $current_url_path . '/')
                    $active_cls = 'active';
            ?>
                <li class="pxl-item--link <?php echo esc_attr($active_cls . ' ' . $settings['pxl_animate']) ?>">
                    <a <?php echo implode(' ', [$link_attributes]); ?>>
                        <?php
                        if (
                            !empty($link['pxl_icon']) &&
                            !empty($link['pxl_icon']['value'])
                        ) :
                        ?>
                            <div class="pxl-item--link-icon">
                                <?php
                                \Elementor\Icons_Manager::render_icon(
                                    $link['pxl_icon'],
                                    ['aria-hidden' => 'true'],
                                    'i'
                                );
                                ?>
                            </div>
                        <?php endif; ?>
                        <span><?php echo pxl_print_html($link['text']); ?></span>
                        <?php if ($settings['style_vertical'] == 'style-2-vertical'): ?>
                            <div class="pxl-item--link-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 11 11" fill="none">
                                    <path d="M10.6878 0.59375V8.3125C10.6878 8.46997 10.6253 8.621 10.5139 8.73235C10.4026 8.84369 10.2516 8.90625 10.0941 8.90625C9.93661 8.90625 9.78559 8.84369 9.67424 8.73235C9.56289 8.621 9.50033 8.46997 9.50033 8.3125V2.02691L1.01416 10.5138C0.902747 10.6252 0.75164 10.6878 0.59408 10.6878C0.43652 10.6878 0.285414 10.6252 0.174002 10.5138C0.0625904 10.4024 0 10.2513 0 10.0938C0 9.93619 0.0625904 9.78508 0.174002 9.67367L8.66092 1.1875H2.37533C2.21786 1.1875 2.06684 1.12494 1.95549 1.01359C1.84414 0.902245 1.78158 0.751222 1.78158 0.59375C1.78158 0.436278 1.84414 0.285255 1.95549 0.173905C2.06684 0.0625557 2.21786 0 2.37533 0H10.0941C10.2516 0 10.4026 0.0625557 10.5139 0.173905C10.6253 0.285255 10.6878 0.436278 10.6878 0.59375Z" fill="currentColor" />
                                </svg>
                            </div>
                        <?php endif; ?>
                        <?php if ($settings['style_vertical'] == 'style-3-vertical'): ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                                <path d="M5.39401 0.251055C5.72875 -0.0836849 6.27133 -0.0836849 6.60607 0.251055L11.749 5.39398C12.0837 5.72872 12.0837 6.27132 11.749 6.60605L6.60607 11.749C6.27134 12.0837 5.72874 12.0837 5.39401 11.749C5.05928 11.4142 5.0593 10.8717 5.39401 10.5369L9.07372 6.85717H0.857149C0.38378 6.85717 3.49814e-05 6.47338 0 6.00002C2.76113e-08 5.52662 0.383759 5.14286 0.857149 5.14286H9.07372L5.39401 1.46312C5.05928 1.1284 5.0593 0.585797 5.39401 0.251055Z" fill="currentColor" />
                            </svg>
                        <?php endif; ?>
                        <?php if ($settings['style_horizontal'] == 'style-2-horizontal'): ?>
                            <div class="pxl-item--link-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M15.6253 5V13.125C15.6253 13.2908 15.5595 13.4497 15.4423 13.5669C15.3251 13.6842 15.1661 13.75 15.0003 13.75C14.8346 13.75 14.6756 13.6842 14.5584 13.5669C14.4412 13.4497 14.3753 13.2908 14.3753 13.125V6.50859L5.44254 15.4422C5.32526 15.5595 5.1662 15.6253 5.00035 15.6253C4.8345 15.6253 4.67544 15.5595 4.55816 15.4422C4.44088 15.3249 4.375 15.1659 4.375 15C4.375 14.8341 4.44088 14.6751 4.55816 14.5578L13.4918 5.625H6.87535C6.70959 5.625 6.55062 5.55915 6.43341 5.44194C6.3162 5.32473 6.25035 5.16576 6.25035 5C6.25035 4.83424 6.3162 4.67527 6.43341 4.55806C6.55062 4.44085 6.70959 4.375 6.87535 4.375H15.0003C15.1661 4.375 15.3251 4.44085 15.4423 4.55806C15.5595 4.67527 15.6253 4.83424 15.6253 5Z" fill="currentColor" />
                                </svg>
                            </div>
                        <?php endif; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>