<?php
global $wp;

$title_tag = frameflow_widget_sanitize_title_tag(!empty($settings['title_tag']) ? $settings['title_tag'] : '', 'h5');
$accordion = [];
$wg_id = pxl_get_element_id($settings);
$current_url = trailingslashit(home_url(add_query_arg([], $wp->request)));

if (!empty($settings['layout']) && (string) $settings['layout'] === '6') {
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
    $order = $widget->get_setting('order', 'desc');
    $limit = absint($widget->get_setting('limit', 6));

    extract(pxl_get_posts_of_grid('service', [
        'source' => $source,
        'orderby' => $orderby,
        'order' => $order,
        'limit' => $limit,
        'post_ids' => $post_ids,
        'tax' => $tax,
    ]));

    if (!empty($posts) && is_array($posts)) {
        foreach ($posts as $p) {
            $service_feature = get_post_meta($p->ID, 'service_feature', true);

            $accordion[] = [
                '_id' => (string) $p->ID,
                'title' => get_the_title($p->ID),
                'features' => !empty($service_feature) && is_array($service_feature) ? $service_feature : [],
                'url' => get_permalink($p->ID),
            ];
        }
    }
}

if (!empty($accordion)) : ?>
    <div class="pxl-accordion pxl-accordion6 <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
        <?php foreach ($accordion as $key => $value) :
            $pxl_id = isset($value['_id']) ? $value['_id'] : '';
            $title = isset($value['title']) ? $value['title'] : '';
            $features = isset($value['features']) && is_array($value['features']) ? $value['features'] : [];
            $url = isset($value['url']) ? $value['url'] : '';
            $is_active = !empty($url) && trailingslashit($url) === $current_url;
        ?>
            <div class="pxl-item <?php echo esc_attr($is_active ? 'active' : ''); ?>">
                <div class="pxl-item--title" data-target="<?php echo esc_attr('#' . $wg_id . '-' . $pxl_id); ?>">
                    <<?php echo esc_attr($title_tag); ?> class="pxl-item--title-text"><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
                    <div class="pxl-item--title-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M8.03059 10.8549L12.7376 6.14794C12.8702 6.0153 12.9447 5.8354 12.9447 5.64782C12.9447 5.46024 12.8702 5.28035 12.7376 5.14771C12.6049 5.01507 12.425 4.94055 12.2375 4.94055C12.0499 4.94055 11.87 5.01507 11.7373 5.14771L7.53106 9.35516L3.3236 5.14888C3.25792 5.08321 3.17996 5.03111 3.09415 4.99557C3.00834 4.96002 2.91636 4.94173 2.82348 4.94173C2.7306 4.94173 2.63863 4.96002 2.55282 4.99557C2.46701 5.03111 2.38904 5.08321 2.32337 5.14888C2.25769 5.21456 2.20559 5.29253 2.17005 5.37834C2.13451 5.46415 2.11621 5.55612 2.11621 5.649C2.11621 5.74188 2.13451 5.83385 2.17005 5.91966C2.20559 6.00547 2.25769 6.08344 2.32337 6.14912L7.03035 10.8561C7.09602 10.9218 7.17403 10.974 7.25989 11.0095C7.34575 11.0451 7.43779 11.0633 7.53071 11.0632C7.62364 11.0631 7.71563 11.0446 7.80141 11.0089C7.88719 10.9731 7.96507 10.9208 8.03059 10.8549Z" fill="currentColor"/>
                        </svg>
                    </div>
                </div>
                <div id="<?php echo esc_attr($wg_id . '-' . $pxl_id); ?>" class="pxl-item--content" <?php if ($is_active) { ?>style="display: block;" <?php } ?>>
                    <div class="pxl-item--content-inner">
                        <?php if (!empty($features)) : ?>
                            <ul class="pxl-item--feature">
                                <?php foreach ($features as $feature_item) : ?>
                                    <li class="pxl-item--feature-item"><?php echo esc_html($feature_item); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
