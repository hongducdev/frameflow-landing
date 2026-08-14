<?php
$title_tag = frameflow_widget_sanitize_title_tag(!empty($settings['title_tag']) ? $settings['title_tag'] : '', 'h5');
$active = intval($settings['active']);
$accordion = $widget->get_settings('accordion_5');
$wg_id = pxl_get_element_id($settings);
if (!empty($accordion)) : ?>
    <div class="pxl-accordion pxl-accordion5 <?php echo esc_attr($settings['pxl_animate'].' '.$settings['style_layout_2']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
        <?php foreach ($accordion as $key => $value):
            $is_active = ($key + 1) == $active;
            $pxl_id = isset($value['_id']) ? $value['_id'] : '';
            $title = isset($value['title_5']) ? $value['title_5'] : '';
            $desc = isset($value['desc_5']) ? $value['desc_5'] : '';
            $skill_experience = isset($value['skill_experience_5']) ? $value['skill_experience_5'] : '';
            $button_text = isset($value['button_text_5']) ? $value['button_text_5'] : '';
            $button_url = isset($value['button_url_5']) ? $value['button_url_5'] : '';
        ?>
            <div class="pxl-item <?php echo esc_attr($is_active ? 'active' : ''); ?>">
                <div class="pxl-item--title" data-target="<?php echo esc_attr('#' . $wg_id . '-' . $pxl_id); ?>">
            <<?php echo esc_attr($title_tag); ?> class="pxl-item--title-text"><?php echo wp_kses_post($title); ?></<?php echo esc_attr($title_tag); ?>>
                    <div class="pxl-item--title-icon">
                        <span class="pxl-accordion--plus"></span>
                    </div>
                </div>
                <div id="<?php echo esc_attr($wg_id . '-' . $pxl_id); ?>" class="pxl-item--content" <?php if ($is_active) { ?>style="display: block;" <?php } ?>>
                    <div class="pxl-item--content-inner">
                        <div class="pxl-item--content-position">
                            <h6 class="pxl-item--content-title">
                                <?php echo esc_html__('Position Description:', 'frameflow'); ?>
                            </h6>
                            <p class="pxl-item--content-desc">
                                <?php echo wp_kses_post(nl2br($desc)); ?>
                            </p>
                            <?php if (!empty($button_text) && !empty($button_url['url'])) { ?>
                                <a href="<?php echo esc_url($button_url['url']); ?>" <?php echo !empty($button_url['is_external']) ? 'target="_blank"' : ''; ?> <?php echo !empty($button_url['nofollow']) ? 'rel="nofollow"' : ''; ?> class="btn btn-triangle-fill pxl-icon--right">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14" viewBox="0 0 16 14" fill="none">
                                        <path d="M9.00011 0L7.31261 1.6875L11.2501 5.625L0 5.62507V7.87507L11.2501 7.875L7.31261 11.8125L9.00011 13.5L15.7501 6.75L9.00011 0Z" fill="#16232B"/>
                                    </svg>
                                    <span class="pxl--btn-text" data-text="<?php echo esc_html($button_text); ?>"><?php echo esc_html($button_text); ?></span>
                                </a>
                            <?php } ?>
                        </div>
                        <div class="pxl-item--content-skill">
                            <h6 class="pxl-item--content-title">
                                <?php echo esc_html__('Desired Skills and Experience:', 'frameflow'); ?>
                            </h6>
                            <p class="pxl-item--content-desc">
                                <?php echo wp_kses_post(nl2br($skill_experience)); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
