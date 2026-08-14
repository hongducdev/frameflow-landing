<?php $html_id = pxl_get_element_id($settings);
$is_new = \Elementor\Icons_Manager::is_migration_allowed();
if(isset($settings['tabs_5']) && !empty($settings['tabs_5']) && count($settings['tabs_5'])): 
    $tab_bd_ids = [];
    ?>
    <div class="pxl-tabs pxl-tabs8 <?php echo esc_attr($settings['tab_effect'].' '.$settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
        <div class="pxl-item--navigation">
            <?php foreach ($settings['tabs_5'] as $key => $title) :  ?>
                <div class="pxl-item--navigation-item pxl-cursor--cta <?php if($settings['tab_active'] == $key + 1) { echo 'active'; } ?>" data-target="#<?php echo esc_attr($html_id.'-'.$title['_id']); ?>">
                    <span class="pxl-item--navigation-item-text">
                        <?php echo pxl_print_html($title['title_5']); ?>
                    </span>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="pxl-item--content">
            <?php foreach ($settings['tabs_5'] as $key => $content) : ?>
                <div id="<?php echo esc_attr($html_id.'-'.$content['_id']); ?>" class="pxl-item--content-item <?php if($settings['tab_active'] == $key + 1) { echo 'active'; } ?>">
                    <?php
                        $tab_content = Elementor\Plugin::$instance->frontend->get_builder_content_for_display( (int)$content['content_template_id_5']);
                        $tab_bd_ids[] = (int)$content['content_template_id_5'];
                        if(!empty($tab_content)):
                            pxl_print_html($tab_content);
                        endif;
                    ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>