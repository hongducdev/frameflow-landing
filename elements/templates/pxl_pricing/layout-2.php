<?php
$featured_class = !empty($settings['featured']) && $settings['featured'] === 'yes' ? ' is-featured' : '';
$popular_class  = !empty($settings['is_popular']) && $settings['is_popular'] === 'yes' ? ' is-popular' : '';
$title_tag      = frameflow_widget_sanitize_title_tag(!empty($settings['title_tag']) ? $settings['title_tag'] : '', 'h5');

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
<div class="pxl-pricing pxl-pricing2 <?php echo esc_attr($featured_class . $popular_class . ' ' . $settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
    <div class="pxl-item--header">
        <?php if (!empty($settings['title'])) : ?>
            <<?php echo esc_attr($title_tag); ?> class="pxl-item--title"><?php echo esc_html($settings['title']); ?></<?php echo esc_attr($title_tag); ?>>
        <?php endif; ?>
        <?php if($settings['is_popular'] === 'yes' && !empty($settings['badge_text'])) : ?>
            <span class="pxl-item--badge"><?php echo esc_html(' / '.$settings['badge_text']); ?></span>
        <?php endif; ?>
    </div>
    <div class="pxl-item--body">
        <?php if (!empty($settings['description'])) : ?>
            <p class="pxl-item--description"><?php echo esc_html($settings['description']); ?></p>
        <?php endif; ?>
        <?php if (!empty($settings['price'])) : ?>
            <div class="pxl-item--price-wrap">
                <span class="pxl-item--price"><?php echo esc_html($settings['price']); ?></span>
                <?php if (!empty($settings['period'])) : ?>
                    <span class="pxl-item--period"><?php echo esc_html($settings['period']); ?></span>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($settings['btn_text'])) : ?>
            <a
                class="pxl-item--btn btn pxl-icon--right btn-spacing-icon"
                href="<?php echo esc_url($btn_url); ?>"
                <?php if (!empty($btn_target)) : ?>
                    target="<?php echo esc_attr($btn_target); ?>"
                <?php endif; ?>
                <?php if (!empty($btn_rel)) : ?>
                    rel="<?php echo esc_attr($btn_rel); ?>"
                <?php endif; ?>
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
                    <path d="M19.583 11.9066L13.3022 18.1874C13.1055 18.3841 12.8388 18.4946 12.5607 18.4946C12.2826 18.4946 12.0158 18.3841 11.8192 18.1874C11.6225 17.9908 11.5121 17.7241 11.5121 17.4459C11.5121 17.1678 11.6225 16.9011 11.8192 16.7045L16.3126 12.2128H3.48919C3.21156 12.2128 2.9453 12.1025 2.74899 11.9062C2.55267 11.7098 2.44238 11.4436 2.44238 11.166C2.44238 10.8883 2.55267 10.6221 2.74899 10.4257C2.9453 10.2294 3.21156 10.1191 3.48919 10.1191H16.3126L11.8209 5.62484C11.6243 5.42818 11.5138 5.16146 11.5138 4.88334C11.5138 4.60523 11.6243 4.33851 11.8209 4.14185C12.0176 3.9452 12.2843 3.83472 12.5624 3.83472C12.8405 3.83472 13.1073 3.9452 13.3039 4.14185L19.5848 10.4227C19.6824 10.5201 19.7598 10.6358 19.8126 10.7632C19.8653 10.8906 19.8924 11.0271 19.8922 11.165C19.8921 11.3029 19.8647 11.4394 19.8116 11.5666C19.7586 11.6939 19.6809 11.8094 19.583 11.9066Z" fill="currentColor"/>
                </svg>
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
</div>
