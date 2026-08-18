<?php

if (!defined('ABSPATH')) {
    exit();
}

$view = isset($_GET['view']) ? sanitize_key(wp_unslash($_GET['view'])) : 'theme';
if (!in_array($view, ['theme', 'unused', 'all'], true)) {
    $view = 'theme';
}

$report = frameflow_get_elementor_widget_usage_report();
$rows = frameflow_get_elementor_widget_usage_rows($view);
$theme_widgets = frameflow_get_theme_widget_names();
$theme_used = 0;

foreach ($theme_widgets as $widget_name) {
    if (!empty($report['usage'][$widget_name]['instances'])) {
        $theme_used++;
    }
}

$theme_unused = count($theme_widgets) - $theme_used;
$base_url = admin_url('admin.php?page=pxlart-widget-usage');
?>
<main>
	<div class="pxl-dashboard-wrap">
		<?php include_once get_template_directory() . '/inc/admin/views/admin-tabs.php'; ?>

		<header class="pxl-dsb-header">
			<div class="pxl-dsb-header-inner">
				<h4><?php esc_html_e('Elementor Widget Usage', 'frameflow'); ?></h4>
			</div>
			<p><?php esc_html_e(
       'Counts widget instances stored in Elementor documents (pages, templates, headers, footers, popups). Nested template widgets are counted on the template itself, not on every page that loads it.',
       'frameflow',
   ); ?></p>
		</header>

		<div class="pxl-widget-usage">
			<div class="pxl-widget-usage-summary">
				<div class="pxl-widget-usage-stat">
					<strong><?php echo esc_html((string) count($theme_widgets)); ?></strong>
					<span><?php esc_html_e('Theme widgets', 'frameflow'); ?></span>
				</div>
				<div class="pxl-widget-usage-stat">
					<strong><?php echo esc_html((string) $theme_used); ?></strong>
					<span><?php esc_html_e('Used', 'frameflow'); ?></span>
				</div>
				<div class="pxl-widget-usage-stat">
					<strong><?php echo esc_html((string) $theme_unused); ?></strong>
					<span><?php esc_html_e('Unused', 'frameflow'); ?></span>
				</div>
				<div class="pxl-widget-usage-stat">
					<strong><?php echo esc_html((string) $report['document_count']); ?></strong>
					<span><?php esc_html_e('Elementor documents', 'frameflow'); ?></span>
				</div>
			</div>

			<div class="pxl-widget-usage-toolbar">
				<nav class="pxl-widget-usage-filters">
					<a class="<?php echo 'theme' === $view ? 'is-active' : ''; ?>" href="<?php echo esc_url(
    $base_url,
); ?>">
						<?php esc_html_e('Theme widgets', 'frameflow'); ?>
					</a>
					<a class="<?php echo 'unused' === $view ? 'is-active' : ''; ?>" href="<?php echo esc_url(
    add_query_arg('view', 'unused', $base_url),
); ?>">
						<?php esc_html_e('Unused', 'frameflow'); ?>
					</a>
					<a class="<?php echo 'all' === $view ? 'is-active' : ''; ?>" href="<?php echo esc_url(
    add_query_arg('view', 'all', $base_url),
); ?>">
						<?php esc_html_e('All Elementor widgets', 'frameflow'); ?>
					</a>
				</nav>
				<input type="search" id="pxl-widget-usage-search" class="pxl-widget-usage-search" placeholder="<?php esc_attr_e(
        'Search widget…',
        'frameflow',
    ); ?>">
			</div>

			<table class="pxl-widget-usage-table">
				<thead>
					<tr>
						<th><?php esc_html_e('Widget', 'frameflow'); ?></th>
						<th><?php esc_html_e('Type', 'frameflow'); ?></th>
						<th><?php esc_html_e('Instances', 'frameflow'); ?></th>
						<th><?php esc_html_e('Documents', 'frameflow'); ?></th>
						<th><?php esc_html_e('Used in', 'frameflow'); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php if (empty($rows)): ?>
						<tr>
							<td colspan="5"><?php esc_html_e('No widgets found for this view.', 'frameflow'); ?></td>
						</tr>
					<?php
         /* translators: %d: number of documents */
         /* translators: %d: number of documents */
         else: ?>
						<?php foreach ($rows as $row): ?>
							<?php $search = strtolower($row['name'] . ' ' . $row['title']); ?>
							<tr class="pxl-widget-usage-row" data-search="<?php echo esc_attr($search); ?>">
								<td>
									<strong><?php echo esc_html($row['title']); ?></strong>
									<code><?php echo esc_html($row['name']); ?></code>
								</td>
								<td>
									<?php if ($row['is_theme']): ?>
										<span class="pxl-widget-usage-badge is-theme"><?php esc_html_e('Theme', 'frameflow'); ?></span>
									<?php else: ?>
										<span class="pxl-widget-usage-badge"><?php esc_html_e('Elementor', 'frameflow'); ?></span>
									<?php endif; ?>
								</td>
								<td>
									<strong><?php echo esc_html((string) $row['instances']); ?></strong>
								</td>
								<td><?php echo esc_html((string) count($row['documents'])); ?></td>
								<td>
									<?php if (empty($row['documents'])): ?>
										<span class="pxl-widget-usage-empty"><?php esc_html_e('Not used', 'frameflow'); ?></span>
									<?php else: ?>
										<details>
											<summary>
												<?php printf(
                esc_html(_n('%d document', '%d documents', count($row['documents']), 'frameflow')),
                count($row['documents']),
            ); ?>
											</summary>
											<ul>
												<?php foreach ($row['documents'] as $document): ?>
													<li>
														<a href="<?php echo esc_url(
                  admin_url('post.php?post=' . $document['id'] . '&action=elementor'),
              ); ?>">
															<?php echo esc_html($document['title']); ?>
														</a>
														<span>
															<?php echo esc_html($document['type']); ?>
															·
															<?php echo esc_html((string) $document['count']); ?>
															×
														</span>
													</li>
												<?php endforeach; ?>
											</ul>
										</details>
									<?php endif; ?>
								</td>
							</tr>
						<?php endforeach; ?>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</main>
<script>
	(function () {
		var input = document.getElementById('pxl-widget-usage-search');
		if (!input) {
			return;
		}

		input.addEventListener('input', function () {
			var query = this.value.toLowerCase().trim();
			document.querySelectorAll('.pxl-widget-usage-row').forEach(function (row) {
				var haystack = row.getAttribute('data-search') || '';
				row.style.display = haystack.indexOf(query) !== -1 ? '' : 'none';
			});
		});
	})();
</script>
