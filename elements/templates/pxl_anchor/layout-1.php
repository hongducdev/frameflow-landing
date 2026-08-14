<?php
$template = (int)$widget->get_setting('content_template', '0');
if ($template > 0) {
	if (!has_action('pxl_anchor_target_hidden_panel_' . $template)) {
		add_action('pxl_anchor_target_hidden_panel_' . $template, 'frameflow_hook_anchor_hidden_panel');
	}
}

$mobile_menu_class = ($template == 1) ? 'pxl-anchor-mobile-menu' : '';
$wrapper_class     = $settings['pxl_animate'] . ' ' . $mobile_menu_class;
$data_target       = '.pxl-hidden-template-' . $template;
$data_delay_hover  = $settings['pxl_close_animate_delay'];
$data_wow_delay    = $settings['pxl_animate_delay'] . 'ms';

$icon_type         = $settings['icon_type'];
$has_custom_icon   = !empty($settings['pxl_icon']['value']);
?>
<div class="pxl-anchor-button pxl-cursor--cta <?php echo esc_attr($wrapper_class); ?>" data-target="<?php echo esc_attr($data_target); ?>" data-delay-hover="<?php echo esc_attr($data_delay_hover); ?>" data-wow-delay="<?php echo esc_attr($data_wow_delay); ?>">
	<?php if ($icon_type == 'default') : ?>
		<div class="pxl-anchor-dots">
			<span class="pxl-icon-dot pxl-icon-dot1"></span>
			<span class="pxl-icon-dot pxl-icon-dot2"></span>
			<span class="pxl-icon-dot pxl-icon-dot3"></span>
		</div>
	<?php elseif ($has_custom_icon) : ?>
		<?php \Elementor\Icons_Manager::render_icon($settings['pxl_icon'], ['aria-hidden' => 'true', 'class' => ''], 'i'); ?>
	<?php endif; ?>
</div>