<?php
$featured_class = !empty($settings['featured']) && $settings['featured'] === 'yes' ? ' is-featured' : '';
$popular_class  = !empty($settings['is_popular']) && $settings['is_popular'] === 'yes' ? ' is-popular' : '';
$title_tag      = frameflow_widget_sanitize_title_tag(!empty($settings['title_tag']) ? $settings['title_tag'] : '', 'h5');

$style_layout_1 = !empty($settings['style_layout_1']) ? ' ' . $settings['style_layout_1'] : '';
$btn_url      = !empty($settings['btn_link']['url']) ? esc_url($settings['btn_link']['url']) : '#';
$btn_target   = !empty($settings['btn_link']['is_external']) ? '_blank' : '';
$btn_nofollow = !empty($settings['btn_link']['nofollow']);

$btn_rel_parts = [];
if ($btn_nofollow) {
    $btn_rel_parts[] = 'nofollow';
}
if (!empty($btn_target)) {
    $btn_rel_parts[] = 'noopener';
}
$btn_rel = !empty($btn_rel_parts) ? implode(' ', $btn_rel_parts) : '';
?>
<div class="pxl-pricing pxl-pricing1<?php echo esc_attr($featured_class . $popular_class . ' ' . $style_layout_1 . ' ' . $settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">

    <?php if (!empty($settings['is_popular']) && $settings['is_popular'] === 'yes' && !empty($settings['badge_text'])) : ?>
        <div class="pxl-item--badge">
            <span><?php echo esc_html($settings['badge_text']); ?></span>
        </div>
    <?php endif; ?>
    <div class="pxl-item--header">
        <?php if (!empty($settings['pxl_icon']['value'])) : ?>
            <div class="pxl-item--icon">
                <?php \Elementor\Icons_Manager::render_icon($settings['pxl_icon'], ['aria-hidden' => 'true']); ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($settings['title'])) : ?>
            <<?php echo esc_attr($title_tag); ?> class="pxl-item--title"><?php echo esc_html($settings['title']); ?></<?php echo esc_attr($title_tag); ?>>
        <?php endif; ?>
    </div>
    <?php if (!empty($settings['price'])) : ?>
        <div class="pxl-item--price-wrap">
            <span class="pxl-item--price"><?php echo esc_html($settings['price']); ?></span>
            <?php if (!empty($settings['period'])) : ?>
                <span class="pxl-item--period"><?php echo esc_html($settings['period']); ?></span>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <?php if (!empty($settings['description'])) : ?>
        <p class="pxl-item--description"><?php echo esc_html($settings['description']); ?></p>
    <?php endif; ?>
    <?php if (!empty($settings['btn_text'])) : ?>
        <a
            class="pxl-item--btn btn btn-shadow btn-glossy"
            href="<?php echo esc_url($btn_url); ?>"
            <?php if (!empty($btn_target)) : ?>
                target="<?php echo esc_attr($btn_target); ?>"
            <?php endif; ?>
            <?php if (!empty($btn_rel)) : ?>
                rel="<?php echo esc_attr($btn_rel); ?>"
            <?php endif; ?>
        >
            <span><?php echo esc_html($settings['btn_text']); ?></span>
        </a>
    <?php endif; ?>
    <?php if (!empty($settings['features'])) : ?>
        <ul class="pxl-item--features">
            <?php foreach ($settings['features'] as $feature) :
                $is_active = !isset($feature['feature_active']) || $feature['feature_active'] === 'yes';
            ?>
                <li<?php if (!$is_active) : ?> class="is-inactive"<?php endif; ?>>
                    <?php if (!empty($feature['feature_icon']['value'])) : ?>
                        <span class="pxl-feature--icon">
                            <?php \Elementor\Icons_Manager::render_icon($feature['feature_icon'], ['aria-hidden' => 'true']); ?>
                        </span>
                    <?php endif; ?>
                    <span class="pxl-feature--text"><?php echo esc_html($feature['feature_text']); ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>
