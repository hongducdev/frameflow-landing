<?php

/**
 * Theme functions: init, enqueue scripts and styles, include required files and widgets.
 *
 * @package Case-Themes
 * @since Frameflow 1.0
 */

if (!defined('DEV_MODE')) {
    define('DEV_MODE', true);
}

if (!defined('THEME_DEV_MODE_ELEMENTS') && is_user_logged_in()) {
    define('THEME_DEV_MODE_ELEMENTS', true);
}

require_once get_template_directory() . '/inc/classes/class-main.php';
require_once get_template_directory() . '/inc/widget-styles.php';

if (is_admin()) {
    require_once get_template_directory() . '/inc/admin/admin-init.php';
}

/**
 * Theme Require
 */
frameflow()->require_folder('inc');
frameflow()->require_folder('inc/classes');

require_once get_template_directory() . '/inc/theme-options/option-functions.php';

if (is_admin()) {
    require_once get_template_directory() . '/inc/theme-options/page-options.php';
    require_once get_template_directory() . '/inc/theme-options/theme-options.php';
}

if (class_exists('Woocommerce')) {
    frameflow()->require_folder('woocommerce');
}

/**
 * My Events WooCommerce Plugin Activation Code
 * Add this code to activate the My Events WooCommerce plugin
 */
if (!defined('ME_EVENTS_ACTIVATION_CODE')) {
    define('ME_EVENTS_ACTIVATION_CODE', true);
}

if (!function_exists('frameflow_ensure_wp_filesystem')) {
    add_action('elementor/controls/controls_registered', 'frameflow_ensure_wp_filesystem', 1);
    function frameflow_ensure_wp_filesystem()
    {
        global $wp_filesystem;

        if ($wp_filesystem) {
            return;
        }

        if (!function_exists('WP_Filesystem')) {
            require_once ABSPATH . 'wp-admin/includes/file.php';
        }

        WP_Filesystem();
    }
}
