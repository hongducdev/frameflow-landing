<?php
$title_tag = frameflow_widget_sanitize_title_tag(!empty($settings['title_tag']) ? $settings['title_tag'] : '', 'h5');
$active = intval($settings['active']);
$accordion = $widget->get_settings('accordion');
$wg_id = pxl_get_element_id($settings);

// Layout 4 can be sourced from "service" posts (same query pattern as post grid/carousel).
if (!empty($settings['layout']) && (string) $settings['layout'] === '4') {
    $tax = ['service-category'];
    $select_post_by = $widget->get_setting('select_post_by', 'term_selected');

    $source = [];
    $post_ids = [];

    if ($select_post_by === 'post_selected') {
        $post_ids = $widget->get_setting('source_service_post_ids', '');
    } else {
        $source = $widget->get_setting('source_service', '');
    }

    $orderby = $widget->get_setting('orderby', 'date');
    $order   = $widget->get_setting('order', 'desc');
    $limit   = absint($widget->get_setting('limit', 6));

    extract(pxl_get_posts_of_grid('service', [
        'source'   => $source,
        'orderby'  => $orderby,
        'order'    => $order,
        'limit'    => $limit,
        'post_ids' => $post_ids,
        'tax'      => $tax,
    ]));

    if (!empty($posts) && is_array($posts)) {
        $accordion = [];
        foreach ($posts as $p) {
            $service_excerpt = get_post_meta($p->ID, 'service_excerpt', true);
            $desc = '';
            if (!empty($service_excerpt)) {
                $desc = $service_excerpt;
            } elseif (!empty($p->post_excerpt)) {
                $desc = $p->post_excerpt;
            } else {
                $desc = wp_trim_words(wp_strip_all_tags($p->post_content), 35, '');
            }

            $accordion[] = [
                '_id'   => (string) $p->ID,
                'title' => get_the_title($p->ID),
                'desc'  => $desc,
            ];
        }
    }
}

if (!empty($accordion)) : ?>
    <div class="pxl-accordion pxl-accordion4 <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
        <?php foreach ($accordion as $key => $value):
            $is_active = ($key + 1) == $active;
            $pxl_id = isset($value['_id']) ? $value['_id'] : '';
            $title = isset($value['title']) ? $value['title'] : '';
            $desc = isset($value['desc']) ? $value['desc'] : '';
            $post_id = is_numeric($pxl_id) ? intval($pxl_id) : 0;

            $thumbnail = '';
            $service_feature = [];

            if ($post_id) {
                if (has_post_thumbnail($post_id)) {
                    $img_id = get_post_thumbnail_id($post_id);
                    $img = pxl_get_image_by_size([
                        'attach_id'  => $img_id,
                        'thumb_size' => '767x668',
                    ]);

                    if (!empty($img['thumbnail'])) {
                        $thumbnail = $img['thumbnail'];
                    }
                }

                $meta_feature = get_post_meta($post_id, 'service_feature', true);
                if (!empty($meta_feature) && is_array($meta_feature)) {
                    $service_feature = $meta_feature;
                }
            }
        ?>
            <div class="pxl-item <?php echo esc_attr($is_active ? 'active' : ''); ?>">
                <div class="pxl-item--title" data-target="<?php echo esc_attr('#' . $wg_id . '-' . $pxl_id); ?>">
                    <div class="pxl-item--title-left">
                        <span class="pxl-item--title-order">
                            <?php if($key + 1 < 10) : ?>
                                0<?php echo esc_html($key + 1); ?>.&nbsp;
                            <?php else : ?>
                                <?php echo esc_html($key + 1); ?>.&nbsp;
                            <?php endif; ?>
                        </span>
                        <?php if (!empty($thumbnail)) : ?>
                            <div class="pxl-item--title-image">
                                <?php echo wp_kses_post($thumbnail); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="pxl-item--title-right">
                        <div class="pxl-item--title-right-header">
                                        <<?php echo esc_attr($title_tag); ?> class="pxl-item--title-text"><?php echo wp_kses_post($title); ?></<?php echo esc_attr($title_tag); ?>>
                            <div class="pxl-item--title-icon">
                                <span class="pxl-accordion--plus"></span>
                            </div>
                        </div>
                        <div class="pxl-item--title-right-content">
                            <div class="pxl-item--description">
                                <?php echo wp_kses_post(nl2br($desc)); ?>
                            </div>
                            <?php if (!empty($service_feature)) : ?>
                                <ul class="pxl-item--feature">
                                    <?php foreach ($service_feature as $feature_item) : ?>
                                        <li class="pxl-item--feature-item">
                                            <?php echo esc_html($feature_item); ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                            <a href="<?php echo esc_url(get_permalink($post_id)); ?>" class="pxl-item--button">
                                <span><?php echo esc_html__('View Details', 'frameflow'); ?></span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="14" viewBox="0 0 18 14" fill="none">
                                    <path d="M10.242 0L8.51397 1.74599L12.402 5.63398H0V8.08184H12.402L8.51397 11.9698L10.242 13.7158L17.1 6.85785L10.242 0Z" fill="#111111"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div id="<?php echo esc_attr($wg_id . '-' . $pxl_id); ?>" class="pxl-item--content" <?php if ($is_active) { ?>style="display: block;" <?php } ?>>
                    <div class="pxl-item--content-inner">

                        
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
