<?php
/**
 * Shop AJAX fragments — JSON { content, sidebar } instead of full HTML page.
 *
 * Request any shop/taxonomy URL with ?pxl_shop_ajax=1
 *
 * @package Case-Themes
 */

defined('ABSPATH') || exit;

add_action('template_redirect', 'frameflow_shop_ajax_fragments', 5);
/**
 * Short-circuit shop archives into fragment JSON for filter AJAX.
 */
function frameflow_shop_ajax_fragments()
{
    // phpcs:ignore WordPress.Security.NonceVerification.Recommended
    if (empty($_GET['pxl_shop_ajax'])) {
        return;
    }

    if (!class_exists('WooCommerce') || is_admin() || wp_doing_cron()) {
        return;
    }

    if (!is_shop() && !is_product_taxonomy()) {
        status_header(400);
        wp_send_json_error(['message' => 'Not a shop archive'], 400);
    }

    // Don't bake the fragment flag into pagination / widget links.
    // phpcs:ignore WordPress.Security.NonceVerification.Recommended
    unset($_GET['pxl_shop_ajax'], $_REQUEST['pxl_shop_ajax']);

    nocache_headers();

    ob_start();
    woocommerce_content();
    $content = ob_get_clean();

    $sidebar = '';
    $sidebar_args = frameflow()->get_sidebar_args(['type' => 'shop', 'content_col' => '9']);
    if (!empty($sidebar_args['sidebar_class'])) {
        ob_start();
        echo '<div class="pxl-sidebar-sticky">';
        get_sidebar();
        echo '</div>';
        $sidebar = ob_get_clean();
    }

    /**
     * Filter shop AJAX fragment payload.
     *
     * @param array $payload { content: string, sidebar: string }
     */
    $payload = apply_filters('frameflow_shop_ajax_fragments', [
        'content' => $content,
        'sidebar' => $sidebar,
    ]);

    wp_send_json_success($payload);
}
