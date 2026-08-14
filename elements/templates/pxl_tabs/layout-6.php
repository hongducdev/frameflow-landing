<?php
$html_id = pxl_get_element_id($settings);
if (empty($settings['tabs_6']) || !is_array($settings['tabs_6'])) {
    return;
}

$tab_active = !empty($settings['tab_active']) ? (int) $settings['tab_active'] : 1;
$tab_active = max($tab_active, 1);
$animate = !empty($settings['pxl_animate']) ? $settings['pxl_animate'] : '';
$animate_delay = !empty($settings['pxl_animate_delay']) ? $settings['pxl_animate_delay'] : '';
?>
<div class="pxl-tabs pxl-tabs6 tab-effect-fade <?php echo esc_attr($animate); ?>" data-wow-delay="<?php echo esc_attr($animate_delay); ?>ms">
    <div class="pxl-item--navigation">
        <?php foreach ($settings['tabs_6'] as $key => $item) : ?>
            <div
                class="pxl-item--navigation-item pxl-cursor--cta<?php echo ($tab_active === $key + 1) ? ' active' : ''; ?>"
                data-target="#<?php echo esc_attr($html_id . '-' . $item['_id']); ?>"
            >
                <span class="pxl-item--navigation-item-text">
                    <?php echo pxl_print_html($item['title_6']); ?>
                </span>
                <span class="pxl-item--navigation-item-arrow" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                        <path d="M11.3662 18.6922C11.2335 18.6948 11.0996 18.6625 10.9816 18.5895C10.6409 18.3798 10.5372 17.9244 10.7421 17.5841C10.7594 17.5541 12.9003 13.9813 16.9872 11.7329H1.09954C0.695111 11.7329 0.366211 11.404 0.366211 10.9995C0.366211 10.5951 0.695111 10.2662 1.09954 10.2662H16.9872C12.9231 8.03064 10.7579 4.44207 10.7366 4.40614C10.5361 4.06367 10.6472 3.60791 10.9893 3.40514C11.3361 3.19944 11.793 3.31861 12.0002 3.66731C12.3335 4.19897 15.4589 8.96527 21.0649 10.2842C21.4004 10.3667 21.6329 10.6604 21.6329 10.9999C21.6329 11.3394 21.4019 11.6339 21.0711 11.7142C15.4413 13.0378 12.3265 17.8104 11.9899 18.3505C11.8579 18.562 11.6137 18.6874 11.3662 18.6922Z" fill="#B38F6F"/>
                    </svg>
                </span>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="pxl-item--content">
        <?php foreach ($settings['tabs_6'] as $key => $item) :
            $is_active = ($tab_active === $key + 1);
            $btn_link = !empty($item['btn_link_6']) && is_array($item['btn_link_6']) ? $item['btn_link_6'] : [];
            $btn_url = !empty($btn_link['url']) ? esc_url($btn_link['url']) : '';
            $btn_target = !empty($btn_link['is_external']) ? '_blank' : '';
            $btn_rel_parts = [];
            if (!empty($btn_link['nofollow'])) {
                $btn_rel_parts[] = 'nofollow';
            }
            if (!empty($btn_target)) {
                $btn_rel_parts[] = 'noopener';
            }
            $btn_rel = !empty($btn_rel_parts) ? implode(' ', $btn_rel_parts) : '';
            ?>
            <div
                id="<?php echo esc_attr($html_id . '-' . $item['_id']); ?>"
                class="pxl-item--content-item<?php echo $is_active ? ' active' : ''; ?>"
            >
                <div class="pxl-item--image">
                    <?php if (!empty($item['image_6']['id'])) :
                        $img = pxl_get_image_by_size([
                            'attach_id' => $item['image_6']['id'],
                            'thumb_size' => 'full',
                        ]);
                        echo pxl_print_html($img['thumbnail']);
                    elseif (!empty($item['image_6']['url'])) : ?>
                        <img src="<?php echo esc_url($item['image_6']['url']); ?>" alt="<?php echo esc_attr($item['title_6']); ?>">
                    <?php endif; ?>
                </div>

                <div class="pxl-item--card">
                    <?php if (!empty($item['label_6'])) : ?>
                        <div class="pxl-item--label"><?php echo esc_html($item['label_6']); ?></div>
                    <?php endif; ?>

                    <?php if (!empty($item['heading_6'])) : ?>
                        <h3 class="pxl-item--title"><?php echo esc_html($item['heading_6']); ?></h3>
                    <?php endif; ?>

                    <?php if (!empty($item['desc_6'])) : ?>
                        <div class="pxl-item--description"><?php echo esc_html($item['desc_6']); ?></div>
                    <?php endif; ?>

                    <?php if (!empty($item['btn_text_6']) && !empty($btn_url)) : ?>
                        <a
                            class="pxl-item--button btn btn-triangle-fill"
                            href="<?php echo esc_url($btn_url); ?>"
                            <?php if (!empty($btn_target)) : ?>
                                target="<?php echo esc_attr($btn_target); ?>"
                            <?php endif; ?>
                            <?php if (!empty($btn_rel)) : ?>
                                rel="<?php echo esc_attr($btn_rel); ?>"
                            <?php endif; ?>
                        >
                            <span><?php echo esc_html($item['btn_text_6']); ?></span>
                        </a>
                    <?php elseif (!empty($item['btn_text_6'])) : ?>
                        <span class="pxl-item--button btn">
                            <span><?php echo esc_html($item['btn_text_6']); ?></span>
                        </span>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
