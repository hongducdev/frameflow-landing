<?php $html_id = pxl_get_element_id($settings);
$is_new = \Elementor\Icons_Manager::is_migration_allowed();
if(isset($settings['tabs']) && !empty($settings['tabs']) && count($settings['tabs'])): 
    $tab_bd_ids = [];
    ?>
    <div class="pxl-tabs pxl-tabs1 <?php echo esc_attr($settings['tab_effect'].' '.$settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
        <div class="pxl-item--navigation">
            <?php foreach ($settings['tabs'] as $key => $title) :  ?>
                <div class="pxl-item--navigation-item pxl-cursor--cta <?php if($settings['tab_active'] == $key + 1) { echo 'active'; } ?>" data-target="#<?php echo esc_attr($html_id.'-'.$title['_id']); ?>">
                    <span class="pxl-item--navigation-item-text">
                        <?php echo pxl_print_html($title['title']); ?>
                    </span>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="pxl-item--content">
            <?php foreach ($settings['tabs'] as $key => $content) : ?>
                <div id="<?php echo esc_attr($html_id.'-'.$content['_id']); ?>" class="pxl-item--content-item <?php if($settings['tab_active'] == $key + 1) { echo 'active'; } ?>">
                    <div class="pxl-item--content-title">
                        <?php echo pxl_print_html($content['title']); ?>
                    </div>
                    <?php if(!empty($content['label'])): ?>
                        <h6 class="pxl-item--content-label">
                            <?php pxl_print_html($content['label']); ?>
                        </h6>
                    <?php endif; ?>
                    <div class="pxl-item--content-description">
                        <?php echo pxl_print_html($content['desc']); ?>
                    </div>        
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>