<?php
$editor_content = $widget->get_settings_for_display('text_ed');
$editor_content = $widget->parse_text_editor($editor_content);
$editor_content = frameflow_apply_highlight_animation(
	$editor_content,
	$settings['pxl_animate_highlight'] ?? '',
	$settings['pxl_animate_delay_highlight'] ?? '0'
);
$is_page_title_context = !empty($GLOBALS['frameflow_rendering_page_title']);

?>
<div class="pxl-text-editor <?php echo esc_attr($settings['style_hv']); ?> <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
	<div class="pxl-item--inner">
		<?php if ($is_page_title_context) { ?>
			<?php echo pxl_print_html($editor_content); ?>
		<?php } else { ?>
			<?php echo wp_kses_post($editor_content); ?>
		<?php } ?>
	</div>
</div>