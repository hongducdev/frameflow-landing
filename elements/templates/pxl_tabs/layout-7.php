<?php
$mode_display = !empty($settings['mode_display_tabs_7']) ? $settings['mode_display_tabs_7'] : 'navigation';
$active_index = !empty($settings['tab_active']) ? (int) $settings['tab_active'] : 1;
$active_index = max($active_index, 1);
$effect = 'tab-effect-fade';
$animate = !empty($settings['pxl_animate']) ? $settings['pxl_animate'] : '';
$animate_delay = !empty($settings['pxl_animate_delay']) ? $settings['pxl_animate_delay'] : '';

$active_key = '';
if ($mode_display === 'navigation' && !empty($settings['tabs_7_navigation'][$active_index - 1]['tab_key'])) {
    $active_key = (string) $settings['tabs_7_navigation'][$active_index - 1]['tab_key'];
} elseif ($mode_display === 'content' && !empty($settings['tabs_7_content'][$active_index - 1]['tab_key'])) {
    $active_key = (string) $settings['tabs_7_content'][$active_index - 1]['tab_key'];
}

$arrow_svg = '<svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 44 44" fill="none" aria-hidden="true"><circle cx="22" cy="22" r="22" fill="currentColor"/><path d="M22.4 30.3916C22.2552 30.3944 22.1092 30.3592 21.9804 30.2796C21.6088 30.0508 21.4956 29.554 21.7192 29.1828C21.738 29.15 24.0736 25.2524 28.532 22.7996H11.2C10.7588 22.7996 10.4 22.4408 10.4 21.9996C10.4 21.5584 10.7588 21.1996 11.2 21.1996H28.532C24.0984 18.7608 21.7364 14.846 21.7132 14.8068C21.4944 14.4332 21.6156 13.936 21.9888 13.7148C22.3672 13.4904 22.8656 13.6204 23.0916 14.0008C23.4552 14.5808 26.8648 19.7804 32.9804 21.2192C33.3464 21.3092 33.6 21.6296 33.6 22C33.6 22.3704 33.348 22.6916 32.9872 22.7792C26.8456 24.2232 23.4476 29.4296 23.0804 30.0188C22.9364 30.2496 22.67 30.3864 22.4 30.3916Z" fill="#111111"/></svg>';
?>

<?php if ($mode_display === 'navigation' && !empty($settings['tabs_7_navigation']) && is_array($settings['tabs_7_navigation'])) : ?>
    <div class="pxl-tabs pxl-tabs7 <?php echo esc_attr($effect . ' ' . $animate); ?>" data-wow-delay="<?php echo esc_attr($animate_delay); ?>ms">
        <div class="pxl-item--navigation">
            <?php foreach ($settings['tabs_7_navigation'] as $key => $navigation) :
                $tab_key = !empty($navigation['tab_key']) ? (string) $navigation['tab_key'] : (string) ($key + 1);
                $is_active = false;
                if ($active_key && $tab_key === $active_key) {
                    $is_active = true;
                } elseif (!$active_key && ($key + 1) === $active_index) {
                    $is_active = true;
                }
                ?>
                <div
                    class="pxl-item--navigation-item pxl-cursor--cta<?php echo $is_active ? ' active' : ''; ?>"
                    data-template="<?php echo esc_attr($tab_key); ?>"
                >
                    <span class="pxl-item--navigation-item-icon">
                        <?php echo $arrow_svg; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                    </span>
                    <span class="pxl-item--navigation-item-text">
                        <?php echo pxl_print_html($navigation['title']); ?>
                    </span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>

<?php if ($mode_display === 'content' && !empty($settings['tabs_7_content']) && is_array($settings['tabs_7_content'])) : ?>
    <div class="pxl-tabs pxl-tabs7 pxl-tabs7--content <?php echo esc_attr($effect . ' ' . $animate); ?>" data-wow-delay="<?php echo esc_attr($animate_delay); ?>ms">
        <div class="pxl-item--content">
            <?php foreach ($settings['tabs_7_content'] as $key => $content) :
                $tab_key = !empty($content['tab_key']) ? (string) $content['tab_key'] : (string) ($key + 1);
                $is_active = false;
                if ($active_key && $tab_key === $active_key) {
                    $is_active = true;
                } elseif (!$active_key && ($key + 1) === $active_index) {
                    $is_active = true;
                }
                ?>
                <div
                    class="pxl-item--content-item<?php echo $is_active ? ' active' : ''; ?>"
                    data-template="<?php echo esc_attr($tab_key); ?>"
                >
                    <div class="pxl-item--image">
                        <?php if (!empty($content['image']['id'])) :
                            $img = pxl_get_image_by_size([
                                'attach_id' => $content['image']['id'],
                                'thumb_size' => 'full',
                            ]);
                            echo pxl_print_html($img['thumbnail']);
                        elseif (!empty($content['image']['url'])) : ?>
                            <img src="<?php echo esc_url($content['image']['url']); ?>" alt="">
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>
