<?php
$html_id = pxl_get_element_id($settings);
$mode_display = $settings['mode_display_tabs_2'];

$active_index    = !empty($settings['tab_active']) ? (int) $settings['tab_active'] : 1;
$active_index    = max($active_index, 1);
$active_template = '';
if (
    isset($settings['tabs_2_content'])
    && !empty($settings['tabs_2_content'])
    && isset($settings['tabs_2_content'][$active_index - 1]['content_template_2'])
) {
    $active_template = $settings['tabs_2_content'][$active_index - 1]['content_template_2'];
}

if (!empty($settings['tabs_2_navigation'])):
    ?>
    <div class="pxl-tabs pxl-tabs2 <?php echo esc_attr($settings['tab_effect'].' '.$settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
        <div class="pxl-item--navigation">
            <?php foreach ($settings['tabs_2_navigation'] as $key => $navigation) :
                $template_id = !empty($navigation['content_template_id']) ? $navigation['content_template_id'] : '';
                $is_active = false;
                if ($template_id && $active_template && $template_id === $active_template) {
                    $is_active = true;
                } elseif (!$active_template && ($key + 1) === $active_index) {
                    $is_active = true;
                }
                ?>
                <div
                    class="pxl-item--navigation-item pxl-cursor--cta <?php echo esc_attr($is_active ? 'active' : ''); ?>"
                    data-template="<?php echo esc_attr($template_id); ?>"
                >
                    <span class="pxl-item--navigation-item-text">
                        <?php echo pxl_print_html($navigation['title']); ?>
                    </span>
                    <div class="pxl-item--navigation-item-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                            <path d="M5.39401 0.251055C5.72875 -0.0836849 6.27133 -0.0836849 6.60607 0.251055L11.749 5.39398C12.0837 5.72872 12.0837 6.27132 11.749 6.60605L6.60607 11.749C6.27134 12.0837 5.72874 12.0837 5.39401 11.749C5.05928 11.4142 5.0593 10.8717 5.39401 10.5369L9.07372 6.85717H0.857149C0.38378 6.85717 3.49814e-05 6.47338 0 6.00002C2.76113e-08 5.52662 0.383759 5.14286 0.857149 5.14286H9.07372L5.39401 1.46312C5.05928 1.1284 5.0593 0.585797 5.39401 0.251055Z" fill="currentColor"/>
                        </svg>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>

<?php
$templates = frameflow_get_templates_option('tab', []) ;
if(isset($settings['tabs_2_content']) && !empty($settings['tabs_2_content']) && count($settings['tabs_2_content'])):
    ?>
    <div class="pxl-tabs pxl-tabs2 <?php echo esc_attr($settings['tab_effect'].' '.$settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
        <div class="pxl-item--content">
            <?php foreach ($settings['tabs_2_content'] as $key => $content) :
                $template_id = !empty($content['content_template_2']) ? $content['content_template_2'] : '';
                $is_active = false;
                if ($template_id && $active_template && $template_id === $active_template) {
                    $is_active = true;
                } elseif (!$active_template && ($key + 1) === $active_index) {
                    $is_active = true;
                }
                ?>
                <div
                    class="pxl-item--content-item <?php echo esc_attr($is_active ? 'active' : ''); ?>"
                    data-template="<?php echo esc_attr($template_id); ?>"
                >
                    <?php
                        $tab_content = Elementor\Plugin::$instance->frontend->get_builder_content_for_display( (int)$content['content_template_2']);
                        $tab_bd_ids[] = (int)$content['content_template_2'];
                        if(!empty($tab_content)):
                            pxl_print_html($tab_content);
                        endif;
                    ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>