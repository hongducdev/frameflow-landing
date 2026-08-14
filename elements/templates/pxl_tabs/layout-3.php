<?php
$html_id = pxl_get_element_id($settings);
?>
<?php if($settings['tabs_3_type'] == 'default'): ?>
    <div class="pxl-tabs pxl-tabs3 <?php echo esc_attr($settings['tab_effect'].' '.$settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
        <div class="pxl-item--navigation-wrap">
            <div class="pxl-item--navigation">
                <span class="pxl-item--navigation-switch"></span>
                <div class="pxl-item--navigation-item pxl-cursor--cta <?php if($settings['tab_active'] == 1) { echo 'active'; } ?>" data-target="#<?php echo esc_attr($html_id.'-1'); ?>">
                    <span class="pxl-item--navigation-item-text">
                        <?php echo pxl_print_html($settings['tabs_3_title_1']); ?>
                    </span>
                    <?php if(!empty($settings['tabs_3_subtitle_1'])): ?>
                        <div class="pxl-item--navigation-item-subtitle">
                            <?php if(!empty($settings['tabs_3_icon_subtitle_1'])): ?>
                                <div class="pxl-item--navigation-item-icon">
                                    <?php \Elementor\Icons_Manager::render_icon($settings['tabs_3_icon_subtitle_1'], ['aria-hidden' => 'true']); ?>
                                </div>
                            <?php endif; ?>
                            <span><?php echo pxl_print_html($settings['tabs_3_subtitle_1']); ?></span>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="pxl-item--navigation-item pxl-cursor--cta <?php if($settings['tab_active'] == 2) { echo 'active'; } ?>" data-target="#<?php echo esc_attr($html_id.'-2'); ?>">
                    <span class="pxl-item--navigation-item-text">
                        <?php echo pxl_print_html($settings['tabs_3_title_2']); ?>
                    </span>
                    <?php if(!empty($settings['tabs_3_subtitle_2'])): ?>
                        <div class="pxl-item--navigation-item-subtitle">
                            <?php if(!empty($settings['tabs_3_icon_subtitle_2'])): ?>
                                <div class="pxl-item--navigation-item-icon">
                                    <?php \Elementor\Icons_Manager::render_icon($settings['tabs_3_icon_subtitle_2'], ['aria-hidden' => 'true']); ?>
                                </div>
                            <?php endif; ?>
                            <span><?php echo pxl_print_html($settings['tabs_3_subtitle_2']); ?></span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="pxl-item--content">
            <?php if($settings['tabs_3_type_content'] == 'content'): ?>
                <?php if(!empty($settings['tabs_3_content_1'])): ?>
                    <div id="<?php echo esc_attr($html_id.'-1'); ?>" class="pxl-item--content-item <?php if($settings['tab_active'] == 1) { echo 'active'; } ?>">
                        <?php echo pxl_print_html($settings['tabs_3_content_1']); ?>
                    </div>
                <?php endif; ?>
                <?php if(!empty($settings['tabs_3_content_2'])): ?>
                    <div id="<?php echo esc_attr($html_id.'-2'); ?>" class="pxl-item--content-item <?php if($settings['tab_active'] == 2) { echo 'active'; } ?>">
                        <?php echo pxl_print_html($settings['tabs_3_content_2']); ?>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <?php if(!empty($settings['tabs_3_template_1'])): ?>
                    <div id="<?php echo esc_attr($html_id.'-1'); ?>" class="pxl-item--content-item <?php if($settings['tab_active'] == 1) { echo 'active'; } ?>">
                        <?php
                            $tab_content_1 = Elementor\Plugin::$instance->frontend->get_builder_content_for_display( (int)$settings['tabs_3_template_1']);
                            if(!empty($tab_content_1)):
                                pxl_print_html($tab_content_1);
                            endif;
                        ?>
                    </div>
                <?php endif; ?>
                <?php if(!empty($settings['tabs_3_template_2'])): ?>
                    <div id="<?php echo esc_attr($html_id.'-2'); ?>" class="pxl-item--content-item <?php if($settings['tab_active'] == 2) { echo 'active'; } ?>">
                        <?php
                            $tab_content_2 = Elementor\Plugin::$instance->frontend->get_builder_content_for_display( (int)$settings['tabs_3_template_2']);
                            if(!empty($tab_content_2)):
                                pxl_print_html($tab_content_2);
                            endif;
                        ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
<?php elseif($settings['tabs_3_type'] == 'split'): ?>
    <?php
    $mode_display = !empty($settings['mode_display_tabs_3']) ? $settings['mode_display_tabs_3'] : 'navigation';
    $active_index = !empty($settings['tab_active']) ? (int) $settings['tab_active'] : 1;
    $active_index = max(1, min($active_index, 2));

    $template_1 = !empty($settings['tabs_3_template_1']) ? (string) $settings['tabs_3_template_1'] : '';
    $template_2 = !empty($settings['tabs_3_template_2']) ? (string) $settings['tabs_3_template_2'] : '';
    $tab_key_1 = 'tab-1';
    $tab_key_2 = 'tab-2';
    $active_tab_key = $active_index === 2 ? $tab_key_2 : $tab_key_1;
    ?>

    <?php if($mode_display === 'navigation'): ?>
        <div class="pxl-tabs pxl-tabs3 <?php echo esc_attr($settings['tab_effect'].' '.$settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
            <div class="pxl-item--navigation-wrap">
                <div class="pxl-item--navigation">
                    <span class="pxl-item--navigation-switch"></span>
                    <div class="pxl-item--navigation-item pxl-cursor--cta <?php echo esc_attr($active_tab_key === $tab_key_1 ? 'active' : ''); ?>" data-template="<?php echo esc_attr($tab_key_1); ?>">
                        <span class="pxl-item--navigation-item-text">
                            <?php echo pxl_print_html($settings['tabs_3_title_1']); ?>
                        </span>
                        <?php if(!empty($settings['tabs_3_subtitle_1'])): ?>
                            <div class="pxl-item--navigation-item-subtitle">
                                <?php if(!empty($settings['tabs_3_icon_subtitle_1'])): ?>
                                    <div class="pxl-item--navigation-item-icon">
                                        <?php \Elementor\Icons_Manager::render_icon($settings['tabs_3_icon_subtitle_1'], ['aria-hidden' => 'true']); ?>
                                    </div>
                                <?php endif; ?>
                                <span><?php echo pxl_print_html($settings['tabs_3_subtitle_1']); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="pxl-item--navigation-item pxl-cursor--cta <?php echo esc_attr($active_tab_key === $tab_key_2 ? 'active' : ''); ?>" data-template="<?php echo esc_attr($tab_key_2); ?>">
                        <span class="pxl-item--navigation-item-text">
                            <?php echo pxl_print_html($settings['tabs_3_title_2']); ?>
                        </span>
                        <?php if(!empty($settings['tabs_3_subtitle_2'])): ?>
                            <div class="pxl-item--navigation-item-subtitle">
                                <?php if(!empty($settings['tabs_3_icon_subtitle_2'])): ?>
                                    <div class="pxl-item--navigation-item-icon">
                                        <?php \Elementor\Icons_Manager::render_icon($settings['tabs_3_icon_subtitle_2'], ['aria-hidden' => 'true']); ?>
                                    </div>
                                <?php endif; ?>
                                <span><?php echo pxl_print_html($settings['tabs_3_subtitle_2']); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="pxl-tabs pxl-tabs3 <?php echo esc_attr($settings['tab_effect'].' '.$settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
            <div class="pxl-item--content">
                <?php if($settings['tabs_3_type_content'] == 'content'): ?>
                    <?php if(!empty($settings['tabs_3_content_1'])): ?>
                        <div class="pxl-item--content-item <?php echo esc_attr($active_tab_key === $tab_key_1 ? 'active' : ''); ?>" data-template="<?php echo esc_attr($tab_key_1); ?>">
                            <?php echo pxl_print_html($settings['tabs_3_content_1']); ?>
                        </div>
                    <?php endif; ?>
                    <?php if(!empty($settings['tabs_3_content_2'])): ?>
                        <div class="pxl-item--content-item <?php echo esc_attr($active_tab_key === $tab_key_2 ? 'active' : ''); ?>" data-template="<?php echo esc_attr($tab_key_2); ?>">
                            <?php echo pxl_print_html($settings['tabs_3_content_2']); ?>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <?php if(!empty($settings['tabs_3_template_1'])): ?>
                        <div class="pxl-item--content-item <?php echo esc_attr($active_tab_key === $tab_key_1 ? 'active' : ''); ?>" data-template="<?php echo esc_attr($tab_key_1); ?>">
                            <?php
                                $tab_content_1 = Elementor\Plugin::$instance->frontend->get_builder_content_for_display((int) $settings['tabs_3_template_1']);
                                if(!empty($tab_content_1)):
                                    pxl_print_html($tab_content_1);
                                endif;
                            ?>
                        </div>
                    <?php endif; ?>
                    <?php if(!empty($settings['tabs_3_template_2'])): ?>
                        <div class="pxl-item--content-item <?php echo esc_attr($active_tab_key === $tab_key_2 ? 'active' : ''); ?>" data-template="<?php echo esc_attr($tab_key_2); ?>">
                            <?php
                                $tab_content_2 = Elementor\Plugin::$instance->frontend->get_builder_content_for_display((int) $settings['tabs_3_template_2']);
                                if(!empty($tab_content_2)):
                                    pxl_print_html($tab_content_2);
                                endif;
                            ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>