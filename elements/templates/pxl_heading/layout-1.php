<?php
// Base IDs & Shortcuts
$html_id = pxl_get_element_id($settings);

$title_tag   = frameflow_widget_sanitize_title_tag(isset($settings['title_tag']) ? $settings['title_tag'] : '', 'h3');

$h_title_style   = isset($settings['h_title_style']) ? $settings['h_title_style'] : '';
$highlight_style = isset($settings['highlight_style']) ? $settings['highlight_style'] : '';
$pxl_animate     = isset($settings['pxl_animate']) ? $settings['pxl_animate'] : '';
$pxl_heading_text_effect = isset($settings['pxl_heading_text_effect']) ? $settings['pxl_heading_text_effect'] : '';
$pxl_sr_mode = isset($settings['pxl_sr_mode']) ? $settings['pxl_sr_mode'] : 'scroll';

$editor_title = $widget->get_settings_for_display('title', '');
if (!empty($editor_title)) {
	$editor_title = $widget->parse_text_editor($editor_title);
	$editor_title = frameflow_apply_highlight_animation(
		$editor_title,
		$settings['pxl_animate_highlight'] ?? '',
		$settings['pxl_animate_delay_highlight'] ?? '0'
	);
}

// Wrapper Class
$highlight_image_class = !empty($settings['highlight_text_image']['id']) ? 'highlight-text-image' : '';
$wrapper_class         = trim("pxl-heading px-sub-title-default-style {$highlight_image_class} {$pxl_heading_text_effect}");

// Sub Title
$has_sub_title = !empty($settings['sub_title']);
$sub_title     = $has_sub_title ? $settings['sub_title'] : '';
$pxl_animate_sub       = isset($settings['pxl_animate_sub']) ? $settings['pxl_animate_sub'] : '';
$pxl_animate_delay_sub = isset($settings['pxl_animate_delay_sub']) ? $settings['pxl_animate_delay_sub'] : '0';
$subtitle_class        = trim("pxl-item--subtitle pxl-sub-title-default {$pxl_animate_sub}");

$sub_title_text_class = [];
if (!empty($settings['sub_title_color']) && !empty($settings['sub_title_color_gradient'])) {
	$sub_title_text_class[] = 'text-gradient';
}
if (!empty($settings['sub_title_color_gradient2'])) {
	$sub_title_text_class[] = 'text-gradient-first';
}
$sub_title_text_class_str = implode(' ', $sub_title_text_class);

// Title Class
$title_class       = trim("pxl-item--title {$h_title_style} {$highlight_style} {$pxl_animate}");
$pxl_animate_delay = isset($settings['pxl_animate_delay']) ? $settings['pxl_animate_delay'] : '0';

// Title Logic
$is_outline = ($h_title_style == 'style-outline');
?>

<div
	id="pxl-<?php echo esc_attr($html_id); ?>"
	class="<?php echo esc_attr($wrapper_class); ?>"
	data-pxl-sr-mode="<?php echo esc_attr($pxl_sr_mode); ?>"
>
	<div class="pxl-heading--inner">
		<?php if ($has_sub_title) : ?>
			<div class="<?php echo esc_attr($subtitle_class); ?>" data-wow-delay="<?php echo esc_attr($pxl_animate_delay_sub); ?>ms" data-pxl-animate-delay="<?php echo esc_attr($pxl_animate_delay_sub); ?>ms">
				<span class="pxl-item--subtext">
					<span class="<?php echo esc_attr($sub_title_text_class_str); ?>">
						<?php echo esc_attr($sub_title); ?>
					</span>
				</span>
			</div>
		<?php endif; ?>

		<<?php echo esc_attr($title_tag); ?> class="<?php echo esc_attr($title_class); ?>" data-wow-delay="<?php echo esc_attr($pxl_animate_delay); ?>ms" data-pxl-animate-delay="<?php echo esc_attr($pxl_animate_delay); ?>ms">
			<span class="pxl-heading--text">
				<?php if (!empty($editor_title)) : ?>
					<?php if ($is_outline) : ?>
						<span class="pxl-text-line-backdrop">
							<span><?php echo wp_kses_post($editor_title); ?></span>
							<svg stroke-width="2" class="svg-text-line"><text dominant-baseline="middle" text-anchor="middle" x="50%" y="50%"><?php echo wp_kses_post($editor_title); ?></text></svg>
						</span>
					<?php else : ?>
						<?php echo wp_kses_post($editor_title); ?>
					<?php endif; ?>
				<?php endif; ?>
			</span>
		</<?php echo esc_attr($title_tag); ?>>
	</div>
</div>
