<?php
/**
 * @var array $settings
 * @var \Elementor\Widget_Base $widget
 */
$title_tag = frameflow_widget_sanitize_title_tag(!empty($settings['title_tag']) ? $settings['title_tag'] : '', 'h5');
$items = !empty($settings['items']) && is_array($settings['items']) ? $settings['items'] : [];
$show_connector = !empty($settings['show_connector']);
$columns = frameflow_widget_normalize_columns(
    $settings,
    [
        'xs' => 1,
        'sm' => 1,
        'md' => 2,
        'lg' => 3,
        'xl' => 3,
        'xxl' => 3,
    ],
    1,
    4,
);
$grid_style = frameflow_widget_inline_css_vars([
    '--pxl-col-xs' => $columns['xs'],
    '--pxl-col-sm' => $columns['sm'],
    '--pxl-col-md' => $columns['md'],
    '--pxl-col-lg' => $columns['lg'],
    '--pxl-col-xl' => $columns['xl'],
    '--pxl-col-xxl' => $columns['xxl'],
]);
$total_items = count($items);
?>
<?php if (!empty($items)) : ?>
    <div
        class="pxl-feature-grid pxl-feature-grid1 <?php echo esc_attr($settings['pxl_animate']); ?><?php echo $show_connector ? ' has-connector' : ''; ?>"
        data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms"
        style="<?php echo esc_attr($grid_style); ?>"
    >
        <?php foreach ($items as $index => $item) :
            $item_title = isset($item['item_title']) ? $item['item_title'] : '';
            $item_description = isset($item['item_description']) ? $item['item_description'] : '';
            $item_icon = isset($item['pxl_icon']) ? $item['pxl_icon'] : [];
            $header_classes = [];

            if ($show_connector && $total_items > 1) {
                if ($index > 0) {
                    $header_classes[] = 'show-divider-left';
                }
                if ($index < $total_items - 1) {
                    $header_classes[] = 'show-divider-right';
                }
            }
            ?>
            <div class="pxl-item">
                <div class="pxl-item--inner">
                    <div class="pxl-item--header <?php echo esc_attr(implode(' ', $header_classes)); ?>">
                        <?php if (!empty($item_icon['value'])) : ?>
                            <div class="pxl-item--icon">
                                <?php \Elementor\Icons_Manager::render_icon($item_icon, ['aria-hidden' => 'true']); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if (!empty($item_title)) : ?>
                        <<?php echo esc_attr($title_tag); ?> class="pxl-item--title">
                            <?php echo esc_html($item_title); ?>
                        </<?php echo esc_attr($title_tag); ?>>
                    <?php endif; ?>

                    <?php if (!empty($item_description)) : ?>
                        <p class="pxl-item--description">
                            <?php echo esc_html($item_description); ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
