<?php
/**
 * @var array $settings
 * @var \Elementor\Widget_Base $widget
 */
$title_tag = frameflow_widget_sanitize_title_tag(!empty($settings['title_tag']) ? $settings['title_tag'] : '', 'h3');
$items = !empty($settings['items']) && is_array($settings['items']) ? $settings['items'] : [];
$columns = frameflow_widget_normalize_columns($settings, [
    'xs'  => 1,
    'sm'  => 2,
    'md'  => 2,
    'lg'  => 3,
    'xl'  => 4,
    'xxl' => 4,
], 1, 4);
$grid_style = frameflow_widget_inline_css_vars([
    '--pxl-col-xs'  => $columns['xs'],
    '--pxl-col-sm'  => $columns['sm'],
    '--pxl-col-md'  => $columns['md'],
    '--pxl-col-lg'  => $columns['lg'],
    '--pxl-col-xl'  => $columns['xl'],
    '--pxl-col-xxl' => $columns['xxl'],
]);
$item_icon_svg = '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none"><path d="M14.781 13.7198C14.8507 13.7895 14.906 13.8722 14.9437 13.9632C14.9814 14.0543 15.0008 14.1519 15.0008 14.2504C15.0008 14.349 14.9814 14.4465 14.9437 14.5376C14.906 14.6286 14.8507 14.7114 14.781 14.781C14.7114 14.8507 14.6286 14.906 14.5376 14.9437C14.4465 14.9814 14.349 15.0008 14.2504 15.0008C14.1519 15.0008 14.0543 14.9814 13.9632 14.9437C13.8722 14.906 13.7895 14.8507 13.7198 14.781L7.50042 8.56073L1.28104 14.781C1.14031 14.9218 0.94944 15.0008 0.750417 15.0008C0.551394 15.0008 0.360523 14.9218 0.219792 14.781C0.0790615 14.6403 3.92322e-09 14.4494 0 14.2504C-3.92322e-09 14.0514 0.0790615 13.8605 0.219792 13.7198L6.4401 7.50042L0.219792 1.28104C0.0790615 1.14031 0 0.94944 0 0.750417C0 0.551394 0.0790615 0.360523 0.219792 0.219792C0.360523 0.0790615 0.551394 0 0.750417 0C0.94944 0 1.14031 0.0790615 1.28104 0.219792L7.50042 6.4401L13.7198 0.219792C13.8605 0.0790615 14.0514 -3.92322e-09 14.2504 0C14.4494 3.92322e-09 14.6403 0.0790615 14.781 0.219792C14.9218 0.360523 15.0008 0.551394 15.0008 0.750417C15.0008 0.94944 14.9218 1.14031 14.781 1.28104L8.56073 7.50042L14.781 13.7198Z" fill="currentColor"/></svg>';
?>
<?php if (!empty($items)) : ?>
    <div
        class="pxl-text-box-grid pxl-text-box-grid1 <?php echo esc_attr($settings['pxl_animate']); ?>"
        data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms"
        style="<?php echo esc_attr($grid_style); ?>"
    >
        <canvas class="pxl-text-box-grid--canvas" aria-hidden="true"></canvas>
        <?php foreach ($items as $item) :
            $item_title = isset($item['item_title']) ? $item['item_title'] : '';
            $item_description = isset($item['item_description']) ? $item['item_description'] : '';
            ?>
            <div class="pxl-item">
                <div class="pxl-item--inner">
                    <div class="pxl-item--icon">
                        <?php echo wp_kses_post($item_icon_svg); ?>
                    </div>
                    <<?php echo esc_attr($title_tag); ?> class="pxl-item--title">
                        <?php echo esc_html($item_title); ?>
                    </<?php echo esc_attr($title_tag); ?>>

                    <?php if (!empty($item_description)) : ?>
                        <p class="pxl-item--description">
                            <?php echo esc_html($item_description); ?>
                        </p>
                    <?php endif; ?>

                    <div class="pxl-item--dot">
                        <span></span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
