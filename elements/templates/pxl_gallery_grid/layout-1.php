<?php
/**
 * Case Gallery Grid — Layout 1
 */
$html_id = pxl_get_element_id($settings);

$col_xl = 12 / floatval($widget->get_setting('col_xl', 3));
$col_lg = 12 / floatval($widget->get_setting('col_lg', 3));
$col_md = 12 / floatval($widget->get_setting('col_md', 2));
$col_sm = 12 / floatval($widget->get_setting('col_sm', 2));
$col_xs = 12 / floatval($widget->get_setting('col_xs', 1));

$grid_sizer = "col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
$item_class_default = "pxl-grid-item col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";

$img_size = !empty($settings['img_size']) ? $settings['img_size'] : '370x300';
$pxl_animate = $widget->get_setting('pxl_animate', '');
$grid_masonry = $widget->get_setting('grid_masonry');
$layout_mode = $widget->get_setting('layout_mode', 'masonry');

$images = isset($settings['gallery_images']) && is_array($settings['gallery_images'])
    ? $settings['gallery_images']
    : array();

$valid = array();
foreach ($images as $row) {
    if (!empty($row['image']['id'])) {
        $valid[] = $row;
    }
}

if (count($valid) < 1) {
    return;
}

$widget->add_render_attribute(
    'wrapper',
    array(
        'id'    => $html_id,
        'class' => 'pxl-grid pxl-gallery-grid pxl-gallery-grid-layout1',
    )
);
?>
<div <?php pxl_print_html($widget->get_render_attribute_string('wrapper')); ?> data-layout="<?php echo esc_attr($layout_mode); ?>">
    <div class="pxl-grid-inner pxl-grid-masonry row" data-gutter="15">
        <div class="grid-sizer <?php echo esc_attr($grid_sizer); ?>"></div>
        <?php
        foreach ($valid as $key => $item) :
            $images_size = $img_size;
            $item_class = $item_class_default;

            if (isset($grid_masonry) && !empty($grid_masonry[$key]) && count($grid_masonry) > 1) {
                if ($grid_masonry[$key]['col_xl_m'] == 'col-66') {
                    $col_xl_m = '66-pxl';
                } else {
                    $col_xl_m = 12 / $grid_masonry[$key]['col_xl_m'];
                }
                if ($grid_masonry[$key]['col_lg_m'] == 'col-66') {
                    $col_lg_m = '66-pxl';
                } else {
                    $col_lg_m = 12 / $grid_masonry[$key]['col_lg_m'];
                }
                $col_md_m = 12 / $grid_masonry[$key]['col_md_m'];
                $col_sm_m = 12 / $grid_masonry[$key]['col_sm_m'];
                $col_xs_m = 12 / $grid_masonry[$key]['col_xs_m'];
                $text_masonry = !empty($grid_masonry[$key]['text_align_m'])
                    ? $grid_masonry[$key]['text_align_m']
                    : 'left';
                $item_class = "pxl-grid-item col-xl-{$col_xl_m} col-lg-{$col_lg_m} col-md-{$col_md_m} col-sm-{$col_sm_m} col-{$col_xs_m} text-{$text_masonry}";

                if (!empty($grid_masonry[$key]['img_size_m'])) {
                    $images_size = $grid_masonry[$key]['img_size_m'];
                }
            }

            $attach_id = (int) $item['image']['id'];
            $img = pxl_get_image_by_size(
                array(
                    'attach_id'  => $attach_id,
                    'thumb_size' => $images_size,
                    'class'      => 'no-lazyload',
                )
            );
            $thumbnail = $img['thumbnail'];
            $full_url = wp_get_attachment_image_url($attach_id, 'full');
            if (empty($full_url)) {
                $full_url = !empty($img['url']) ? $img['url'] : '';
            }
            ?>
            <div class="<?php echo esc_attr($item_class); ?>">
                <div class="pxl-item--inner <?php echo esc_attr($pxl_animate); ?>">
                    <div class="pxl-item--image">
                        <a href="<?php echo esc_url($full_url); ?>" data-elementor-lightbox-slideshow="<?php echo esc_attr($html_id); ?>">
                            <?php echo wp_kses_post($thumbnail); ?>
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
