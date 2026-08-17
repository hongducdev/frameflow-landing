<?php

/**
 * Actions Hook for the theme
 *
 * @package Case-Themes
 */
add_action('after_setup_theme', 'frameflow_setup');
function frameflow_setup()
{
    //Set the content width in pixels, based on the theme's design and stylesheet.
    $GLOBALS['content_width'] = apply_filters('frameflow_content_width', 1200);

    // Make theme available for translation.
    load_theme_textdomain('frameflow', get_template_directory() . '/languages');

    // Custom Header
    add_theme_support('custom-header');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title.
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support('post-thumbnails');

    set_post_thumbnail_size(1170, 710);

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus([
        'primary' => esc_html__('Primary Desktop', 'frameflow'),
        'primary-mobile' => esc_html__('Primary Mobile', 'frameflow'),
    ]);

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for core custom logo.
    add_theme_support('custom-logo', [
        'height' => 250,
        'width' => 250,
        'flex-width' => true,
        'flex-height' => true,
    ]);
    add_theme_support('post-formats', ['video', 'audio', 'quote', 'link']);

    add_image_size('frameflow-thumb-small', 80, 70, true);
    add_image_size('frameflow-thumb-xs', 120, 104, true);
    add_image_size('frameflow-large', 952, 333, true);
    add_image_size('frameflow-thumb-related', 767, 444, true);
    add_image_size('frameflow-portfolio', 600, 600, true);

    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
    remove_theme_support('widgets-block-editor');
}

/**
 * Register Widgets Position.
 */
add_action('widgets_init', 'frameflow_widgets_position');
function frameflow_widgets_position()
{
    register_sidebar([
        'name' => esc_html__('Blog Sidebar', 'frameflow'),
        'id' => 'sidebar-blog',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title"><span>',
        'after_title' => '</span></h2><div class="widget-content">',
    ]);

    if (class_exists('ReduxFramework')) {
        register_sidebar([
            'name' => esc_html__('Page Sidebar', 'frameflow'),
            'id' => 'sidebar-page',
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</div></section>',
            'before_title' => '<h2 class="widget-title"><span>',
            'after_title' => '</span></h2><div class="widget-content">',
        ]);
    }

    if (class_exists('Woocommerce')) {
        register_sidebar([
            'name' => esc_html__('Shop Sidebar', 'frameflow'),
            'id' => 'sidebar-shop',
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h2 class="widget-title"><span>',
            'after_title' => '</span></h2><div class="widget-content">',
        ]);
    }
}

/**
 * Enqueue Styles Scripts : Front-End
 */
add_action('wp_enqueue_scripts', 'frameflow_scripts');
function frameflow_scripts()
{
    static $frameflow_version = null;

    if (null === $frameflow_version) {
        $frameflow_version = wp_get_theme(get_template());
    }

    /* Popup Libs — register only, lazy loader will enqueue on demand */
    wp_register_style(
        'magnific-popup',
        get_template_directory_uri() . '/assets/css/libs/magnific-popup.css',
        [],
        '1.1.0',
    );
    wp_register_script(
        'magnific-popup',
        get_template_directory_uri() . '/assets/js/libs/magnific-popup.min.js',
        ['jquery'],
        '1.1.0',
        ['in_footer' => true, 'strategy' => 'defer'],
    );
    /* Wow Libs — register only, lazy loader will enqueue on demand */
    wp_register_style(
        'wow-animate',
        get_template_directory_uri() . '/assets/css/libs/animate.min.css',
        [],
        '1.1.0',
    );
    wp_register_script(
        'wow-animate',
        get_template_directory_uri() . '/assets/js/libs/wow.min.js',
        ['jquery'],
        '1.0.0',
        ['in_footer' => true, 'strategy' => 'defer'],
    );

    /* Parallax Libs */
    wp_register_script(
        'stellar-parallax',
        get_template_directory_uri() . '/assets/js/libs/stellar-parallax.min.js',
        ['jquery'],
        '0.6.2',
        ['in_footer' => true, 'strategy' => 'defer'],
    );

    /* Nice Select */
    wp_enqueue_script(
        'nice-select',
        get_template_directory_uri() . '/assets/js/libs/nice-select.min.js',
        ['jquery'],
        'all',
        ['in_footer' => true, 'strategy' => 'defer'],
    );

    /* Divider Move on Menu */
    wp_enqueue_script(
        'modernizr',
        get_template_directory_uri() . '/assets/js/libs/modernizr.min.js',
        ['jquery'],
        'all',
        ['in_footer' => true, 'strategy' => 'defer'],
    );

    /* Counter Effect — register only, lazy loader will enqueue on demand */
    wp_register_script(
        'pxl-counter-slide',
        get_template_directory_uri() . '/assets/js/libs/counter-slide.min.js',
        ['jquery'],
        '1.0.0',
        ['in_footer' => true, 'strategy' => 'defer'],
    );

    /* Scroll Effect */
    wp_register_script(
        'pxl-scroll',
        get_template_directory_uri() . '/assets/js/libs/scroll.min.js',
        ['jquery'],
        '0.6.0',
        true,
    );

    /* Parallax Scroll */
    wp_enqueue_script(
        'pxl-parallax-background',
        get_template_directory_uri() . '/assets/js/libs/parallax-background.min.js',
        ['jquery'],
        $frameflow_version->get('Version'),
        ['in_footer' => true, 'strategy' => 'defer'],
    );
    wp_enqueue_script(
        'pxl-parallax-scroll',
        get_template_directory_uri() . '/assets/js/libs/parallax-scroll.min.js',
        ['jquery'],
        $frameflow_version->get('Version'),
        ['in_footer' => true, 'strategy' => 'defer'],
    );
    wp_register_script(
        'pxl-easing',
        get_template_directory_uri() . '/assets/js/libs/easing.min.js',
        ['jquery'],
        '1.3.0',
        true,
    );

    /* Tweenmax */
    wp_register_script(
        'pxl-tweenmax',
        get_template_directory_uri() . '/assets/js/libs/tweenmax.min.js',
        ['jquery'],
        '2.1.2',
        true,
    );

    /* Parallax Move Mouse — register only, lazy loader will enqueue on demand */
    wp_register_script(
        'pxl-parallax-move-mouse',
        get_template_directory_uri() . '/assets/js/libs/parallax-move-mouse.min.js',
        ['jquery'],
        '1.0.0',
        true,
    );

    /* Particles Background Libs — register only, lazy loader will enqueue on demand */
    wp_register_script(
        'particles-background',
        get_template_directory_uri() . '/assets/js/libs/particles.min.js',
        ['jquery'],
        '1.1.0',
        true,
    );

    /* jquery.ripples — always available for water-effect containers */
    wp_enqueue_script(
        'jquery-ripples',
        get_template_directory_uri() . '/assets/js/libs/ripples.min.js',
        ['jquery'],
        '0.5.3',
        true,
    );

    /* Woocommerce JS — split by context; enqueue .min.js from Mix */
    if (class_exists('WooCommerce') && function_exists('is_woocommerce')) {
        $is_wc =
            is_woocommerce() || is_cart() || is_checkout() || is_account_page();
        $is_shop_archive = is_shop() || is_product_taxonomy();
        $wc_js_uri = get_template_directory_uri() . '/woocommerce/js/';
        $ver = $frameflow_version->get('Version');

        $woo_deps = ['jquery'];
        if (function_exists('is_cart') && is_cart()) {
            $woo_deps[] = 'wc-cart';
        }
        wp_register_script(
            'pxl-woocommerce',
            $wc_js_uri . 'woocommerce.min.js',
            $woo_deps,
            $ver,
            true,
        );
        wp_register_script(
            'pxl-woocommerce-loop-swatches',
            $wc_js_uri . 'loop-swatches.min.js',
            ['jquery'],
            $ver,
            true,
        );
        wp_register_script(
            'pxl-woocommerce-shop-ajax',
            $wc_js_uri . 'shop-ajax.min.js',
            ['jquery', 'pxl-woocommerce'],
            $ver,
            true,
        );

        if (!wp_script_is('wc-jquery-ui-touchpunch', 'registered') && function_exists('WC')) {
            $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
            wp_register_script(
                'wc-jquery-ui-touchpunch',
                WC()->plugin_url() .
                    '/assets/js/jquery-ui-touch-punch/jquery-ui-touch-punch' .
                    $suffix .
                    '.js',
                ['jquery-ui-slider'],
                WC()->version,
                true,
            );
        }

        $price_deps = ['jquery', 'jquery-ui-slider'];
        if (wp_script_is('wc-jquery-ui-touchpunch', 'registered')) {
            $price_deps[] = 'wc-jquery-ui-touchpunch';
        }
        wp_register_script(
            'pxl-woocommerce-price-filter',
            $wc_js_uri . 'price-filter.min.js',
            $price_deps,
            $ver,
            true,
        );

        if ($is_wc || is_product()) {
            wp_enqueue_script('pxl-woocommerce');
            if (class_exists('WC_AJAX')) {
                wp_localize_script('pxl-woocommerce', 'frameflow_woo', [
                    'wc_ajax_url' => WC_AJAX::get_endpoint('%%endpoint%%'),
                    'cart_url' => wc_get_cart_url(),
                    'i18n_view_cart' => esc_html__('View Cart', 'frameflow'),
                    'i18n_add_to_cart' => esc_html__('Add to cart', 'frameflow'),
                ]);
            }
        }

        if ($is_shop_archive || is_product()) {
            wp_enqueue_script('pxl-woocommerce-loop-swatches');
        }

        if ($is_shop_archive) {
            wp_enqueue_script('pxl-woocommerce-shop-ajax');
            wp_enqueue_script('jquery-ui-slider');
            if (wp_script_is('wc-jquery-ui-touchpunch', 'registered')) {
                wp_enqueue_script('wc-jquery-ui-touchpunch');
            }
            wp_enqueue_script('pxl-woocommerce-price-filter');
        }
    }

    /* Icon */
    wp_enqueue_style(
        'bootstrap-icons',
        get_template_directory_uri() . '/assets/fonts/bootstrap-icons/css/bootstrap-icons.css',
    );
    /* Cookie */
    wp_register_script(
        'pxl-cookie',
        get_template_directory_uri() . '/assets/js/libs/cookie.min.js',
        ['jquery'],
        '1.4.1',
        true,
    );
    /* smooth scroll */
    $smooth_scroll = frameflow()->get_theme_opt('smooth_scroll', 'off');
    if ($smooth_scroll == 'on') {
        wp_enqueue_script('gsap');
        wp_enqueue_script('pxl-scroll-trigger');
        wp_enqueue_script('pxl-bundled-lenis');
    }

    /* Smooth Scroll */
    wp_enqueue_script(
        'pxl-jarallax',
        get_template_directory_uri() . '/assets/js/libs/jarallax.min.js',
        ['jquery'],
        '2.2.1',
    );
    wp_enqueue_style(
        'pxl-grid',
        get_template_directory_uri() . '/assets/css/grid.css',
        [],
        $frameflow_version->get('Version'),
    );
    wp_enqueue_style(
        'pxl-style',
        get_template_directory_uri() . '/assets/css/style.min.css',
        [],
        $frameflow_version->get('Version'),
    );
    wp_add_inline_style('pxl-style', frameflow_inline_styles());

    /* Theme WooCommerce CSS — separate from style.min.css; after WC core so theme wins cleanly.
     Always when WC active: cart sidebar is site-wide. */
    if (class_exists('WooCommerce')) {
        $pxl_wc_style_deps = ['pxl-style'];
        if (wp_style_is('woocommerce-general', 'registered')) {
            $pxl_wc_style_deps[] = 'woocommerce-general';
        }
        wp_enqueue_style(
            'pxl-woocommerce',
            get_template_directory_uri() . '/assets/css/woocommerce.min.css',
            $pxl_wc_style_deps,
            $frameflow_version->get('Version'),
        );
    }

    wp_enqueue_style(
        'pxl-base',
        get_template_directory_uri() . '/style.css',
        [],
        $frameflow_version->get('Version'),
    );
    wp_enqueue_style('pxl-google-fonts', frameflow_fonts_url(), [], null);
    wp_enqueue_script(
        'pxl-main',
        get_template_directory_uri() . '/assets/js/theme.min.js',
        ['jquery', 'jquery-ripples'],
        $frameflow_version->get('Version'),
        true,
    );

    wp_localize_script('pxl-main', 'main_data', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'footer_fixed_selector_footer' => trim(
            (string) frameflow()->get_opt('footer_fixed_selector_footer', ''),
        ),
        'footer_fixed_selector_main' => trim(
            (string) frameflow()->get_opt('footer_fixed_selector_main', ''),
        ),
    ]);

    /* Lazy Script Loader */
    wp_enqueue_script(
        'pxl-lazy-loader',
        get_template_directory_uri() . '/assets/js/pxl-lazy-loader.min.js',
        ['jquery', 'pxl-main'],
        $frameflow_version->get('Version'),
        true,
    );
    wp_localize_script('pxl-lazy-loader', 'pxl_lazy_scripts', [
        'wow' => get_template_directory_uri() . '/assets/js/libs/wow.min.js',
        'wow_css' => get_template_directory_uri() . '/assets/css/libs/animate.min.css',
        'magnific' => get_template_directory_uri() . '/assets/js/libs/magnific-popup.min.js',
        'magnific_css' => get_template_directory_uri() . '/assets/css/libs/magnific-popup.css',
        'counter' => get_template_directory_uri() . '/assets/js/libs/counter-slide.min.js',
        'particles' => get_template_directory_uri() . '/assets/js/libs/particles.min.js',
        'stellar' => get_template_directory_uri() . '/assets/js/libs/stellar-parallax.min.js',
        'parallax_mouse' =>
            get_template_directory_uri() . '/assets/js/libs/parallax-move-mouse.min.js',
    ]);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
    do_action('frameflow_scripts');
}

/**
 * Enqueue Styles Scripts : Back-End
 */
add_action('admin_enqueue_scripts', 'frameflow_admin_style');
function frameflow_admin_style()
{
    $theme = wp_get_theme(get_template());
    wp_enqueue_style(
        'frameflow-admin-style',
        get_template_directory_uri() . '/assets/css/admin.css',
        [],
        $theme->get('Version'),
    );
    wp_enqueue_style(
        'bootstrap-icons',
        get_template_directory_uri() . '/assets/fonts/bootstrap-icons/css/bootstrap-icons.css',
    );
}

add_action('elementor/editor/before_enqueue_scripts', function () {
    $theme = wp_get_theme(get_template());

    wp_enqueue_style(
        'frameflow-admin-style',
        get_template_directory_uri() . '/assets/css/admin.css',
    );
    wp_enqueue_style(
        'admin-bootstrap-icons',
        get_template_directory_uri() . '/assets/fonts/bootstrap-icons/css/bootstrap-icons.css',
    );
    wp_enqueue_script(
        'frameflow-elementor-custom-css-editor',
        get_template_directory_uri() . '/assets/js/elementor-custom-css-editor.js',
        ['jquery'],
        $theme->get('Version'),
        true,
    );
});

/* Preconnect Google Fonts */
add_action('wp_head', 'frameflow_preconnect_fonts', 1);
function frameflow_preconnect_fonts()
{
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}

/* Favicon */
add_action('wp_head', 'frameflow_site_favicon');
function frameflow_site_favicon()
{
    $favicon = frameflow()->get_theme_opt('favicon');
    if (!empty($favicon['url'])) {
        $favicon_sm = pxl_get_image_by_size([
            'attach_id' => $favicon['id'],
            'thumb_size' => '32x32',
        ]);
        $favicon_sm_url = $favicon_sm['url'];

        $favicon_xs = pxl_get_image_by_size([
            'attach_id' => $favicon['id'],
            'thumb_size' => '16x16',
        ]);
        $favicon_xs_url = $favicon_xs['url'];

        echo '<link rel="icon" type="image/png" sizes="32x32" href="' .
            esc_url($favicon_sm_url) .
            '"/>';
        echo '<link rel="icon" type="image/png" sizes="16x16" href="' .
            esc_url($favicon_xs_url) .
            '"/>';
    }
}

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
add_action('wp_head', 'frameflow_pingback_header');
function frameflow_pingback_header()
{
    if (is_singular() && pings_open()) {
        echo '<link rel="pingback" href="', esc_url(get_bloginfo('pingback_url')), '">';
    }
}

/* Hidden Panel */
add_action('pxl_anchor_target', 'frameflow_hook_anchor_templates_hidden_panel');
function frameflow_hook_anchor_templates_hidden_panel()
{
    $hidden_templates = frameflow_get_templates_slug('hidden-panel');
    if (empty($hidden_templates)) {
        return;
    }

    foreach ($hidden_templates as $slug => $values) {
        $args = [
            'slug' => $slug,
            'post_id' => $values['post_id'],
        ];
        if (did_action('pxl_anchor_target_hidden_panel_' . $values['post_id']) <= 0) {
            do_action('pxl_anchor_target_hidden_panel_' . $values['post_id'], $args);
        }
    }
}
if (!function_exists('frameflow_hook_anchor_hidden_panel')) {
    function frameflow_hook_anchor_hidden_panel($args)
    {
        $hidden_panel_position = get_post_meta($args['post_id'], 'hidden_panel_position', true);
        $hidden_panel_boxcolor = get_post_meta($args['post_id'], 'hidden_panel_boxcolor', true);
        $hidden_panel_overlay_color = get_post_meta(
            $args['post_id'],
            'hidden_panel_overlay_color',
            true,
        );
        $hidden_panel_height = get_post_meta($args['post_id'], 'hidden_panel_height', true);
        $hidden_panel_styles = [];
        $hidden_overlay_style_attr = '';
        if ($hidden_panel_overlay_color !== '' && $hidden_panel_overlay_color !== null) {
            $hidden_overlay_style_attr = sprintf(
                ' style="%s"',
                esc_attr('background-color:' . $hidden_panel_overlay_color),
            );
        }
        if ($hidden_panel_position === 'right' || $hidden_panel_position === 'left') {
            $hidden_panel_top = get_post_meta($args['post_id'], 'hidden_panel_top_position', true);
            $top_px =
                $hidden_panel_top !== '' && is_numeric($hidden_panel_top)
                    ? floatval($hidden_panel_top)
                    : 144;
            $hidden_panel_styles[] = sprintf('top:%spx', $top_px);

            $hidden_panel_min_height = trim(
                (string) get_post_meta($args['post_id'], 'hidden_panel_right_min_height', true),
            );
            if ($hidden_panel_min_height === '') {
                $hidden_panel_min_height = '100vh';
            }
            if (
                preg_match(
                    '/^(auto|(?:\d+|\d*\.\d+)(px|%|vh|vw|vmin|vmax|rem|em|svh|lvh|dvh))$/i',
                    $hidden_panel_min_height,
                )
            ) {
                $hidden_panel_styles[] = 'min-height:' . strtolower($hidden_panel_min_height);
            }

            $hidden_panel_side_space = get_post_meta(
                $args['post_id'],
                'hidden_panel_side_space',
                true,
            );
            if (!in_array($hidden_panel_side_space, ['start', 'end'], true)) {
                $hidden_panel_side_space = 'none';
            }
            if ($hidden_panel_side_space !== 'none') {
                $hcw = trim(
                    (string) get_post_meta($args['post_id'], 'hidden_panel_container_width', true),
                );
                if ($hcw !== '' && is_numeric($hcw)) {
                    $cw_num = max(0, floatval($hcw));
                    $cw_px =
                        abs($cw_num - round($cw_num)) < 1e-5
                            ? ((string) (int) round($cw_num)) . 'px'
                            : rtrim(rtrim(sprintf('%.4f', $cw_num), '0'), '.') . 'px';
                } else {
                    $default_cw = isset($GLOBALS['content_width'])
                        ? (float) $GLOBALS['content_width']
                        : 1200.0;
                    $default_cw = (float) apply_filters(
                        'frameflow_hidden_panel_fallback_container_width',
                        $default_cw,
                        $args['post_id'],
                    );
                    $default_cw = max(0, $default_cw);
                    $cw_px = ((string) (int) round($default_cw)) . 'px';
                }
                if ($hidden_panel_side_space === 'end') {
                    $hidden_panel_styles[] = sprintf(
                        'right:max(15px, calc((100vw - %s) / 2));left:auto',
                        $cw_px,
                    );
                } else {
                    $hidden_panel_styles[] = sprintf(
                        'left:max(15px, calc((100vw - %s) / 2));right:auto',
                        $cw_px,
                    );
                }
            }

            $hdw = get_post_meta($args['post_id'], 'hidden_panel_drawer_width', true);
            if ($hdw !== '' && is_numeric($hdw)) {
                $dm = max(1, (int) $hdw);
                $hidden_panel_styles[] = sprintf('max-width:min(100vw, %dpx)', $dm);
            }
        }
        if ($hidden_panel_height !== '' && $hidden_panel_height !== null) {
            $hidden_panel_styles[] = 'height:' . absint($hidden_panel_height) . 'px';
        }
        if ($hidden_panel_boxcolor !== '' && $hidden_panel_boxcolor !== null) {
            $hidden_panel_styles[] = 'background-color:' . $hidden_panel_boxcolor;
        }
        $hidden_panel_style_attr = '';
        if (!empty($hidden_panel_styles)) {
            $hidden_panel_style_attr = sprintf(
                ' style="%s"',
                esc_attr(implode(';', $hidden_panel_styles)),
            );
        }
        ?>
        <div class="pxl-hidden-panel-popup pxl-hidden-template-<?php echo esc_attr(
            $args['post_id'],
        ); ?> pxl-pos-<?php echo esc_attr($hidden_panel_position); ?>">
            <div class="pxl-popup--overlay pxl-cursor--cta"<?php echo !empty(
                $hidden_panel_overlay_color
            )
                ? ' style="' . esc_attr('background-color:' . $hidden_panel_overlay_color) . '"'
                : ''; ?>></div>
            <div class="pxl-popup--conent"<?php echo !empty($hidden_panel_styles)
                ? ' style="' . esc_attr(implode(';', $hidden_panel_styles)) . '"'
                : ''; ?>>
                <div class="pxl-conent-elementor">
                    <?php echo Elementor\Plugin::$instance->frontend->get_builder_content_for_display(
                        (int) $args['post_id'],
                    ); ?>
                </div>
            </div>
        </div>
    <?php
    }
}

/* Elementor Popup */
add_action('pxl_anchor_target', 'frameflow_hook_anchor_templates_popup');
function frameflow_hook_anchor_templates_popup()
{
    $popup_templates = frameflow_get_templates_slug('popup');
    if (empty($popup_templates)) {
        return;
    }

    foreach ($popup_templates as $slug => $values) {
        $args = [
            'slug' => $slug,
            'post_id' => $values['post_id'],
        ];
        if (did_action('pxl_anchor_target_popup_' . $values['post_id']) <= 0) {
            do_action('pxl_anchor_target_popup_' . $values['post_id'], $args);
        }
    }
}
/* Search Popup */
if (!function_exists('frameflow_hook_anchor_search')) {
    function frameflow_hook_anchor_search()
    {
        $logo_search_default = [
            'url' => get_template_directory_uri() . '/assets/img/logo.png',
            'id' => '',
        ];
        $logo_s_p = frameflow()->get_theme_opt('logo_s', $logo_search_default);
        if (empty($logo_s_p['url'])) {
            $logo_s_p = frameflow()->get_theme_opt('logo_s_p', $logo_search_default);
        }
        $placeholder_search_pu = frameflow()->get_theme_opt('placeholder_search_pu', 'Search...');
        ?>
        <div id="pxl-search-popup">
            <div class="pxl-item--overlay"></div>
            <div class="pxl-item--logo">
                <?php printf(
                    '<a href="%1$s" title="%2$s" rel="home">
                    <img src="%3$s" alt="%2$s" class="logo-light"/>
                    </a>',
                    esc_url(home_url('/')),
                    esc_attr(get_bloginfo('name')),
                    esc_url($logo_s_p['url']),
                ); ?>
            </div>
            <div class="pxl-item--conent">
                <div class="pxl-item--close pxl-close"></div>
                <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                    <input type="text" required placeholder="<?php echo esc_attr(
                        $placeholder_search_pu,
                    ); ?>" name="s" class="search-field" />
                    <button type="submit" class="search-submit rm-style-default"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <g clip-path="url(#clip0_243_485)">
                                <path d="M10.5 18C14.6421 18 18 14.6421 18 10.5C18 6.35786 14.6421 3 10.5 3C6.35786 3 3 6.35786 3 10.5C3 14.6421 6.35786 18 10.5 18Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M15.8047 15.8037L21.0012 21.0003" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </g>
                            <defs>
                                <clipPath id="clip0_243_485">
                                    <rect width="24" height="24" fill="black" />
                                </clipPath>
                            </defs>
                        </svg></button>
                    <div class="pxl--search-divider"></div>
                </form>
            </div>
        </div>
    <?php
    }
}
if (!function_exists('frameflow_hook_anchor_popup')) {
    function frameflow_hook_anchor_popup($args)
    {
        ?>
        <div id="pxl-popup-elementor" class="pxl-popup-elementor-wrap">
            <div class="pxl-item--overlay pxl-cursor--cta">
                <div class="pxl-item--flip pxl-item--flip1"></div>
                <div class="pxl-item--flip pxl-item--flip2"></div>
                <div class="pxl-item--flip pxl-item--flip3"></div>
                <div class="pxl-item--flip pxl-item--flip4"></div>
                <div class="pxl-item--flip pxl-item--flip5"></div>
            </div>
            <div class="pxl-item--close pxl-close pxl-cursor--cta"></div>
            <div class="pxl-item--conent">
                <div class="pxl-conent-elementor">
                    <?php echo Elementor\Plugin::$instance->frontend->get_builder_content_for_display(
                        (int) $args['post_id'],
                    ); ?>
                </div>
            </div>
        </div>
    <?php
    }
}

/* Page Popup */
add_action('pxl_anchor_target', 'frameflow_hook_anchor_templates_page_popup');
function frameflow_hook_anchor_templates_page_popup()
{
    $page_templates = frameflow_get_templates_slug('popup');
    if (empty($page_templates)) {
        return;
    }

    foreach ($page_templates as $slug => $values) {
        $args = [
            'slug' => $slug,
            'post_id' => $values['post_id'],
        ];
        if (did_action('pxl_anchor_target_page_popup_' . $values['post_id']) <= 0) {
            do_action('pxl_anchor_target_page_popup_' . $values['post_id'], $args);
        }
    }
}
if (!function_exists('frameflow_hook_anchor_page_popup')) {
    function frameflow_hook_anchor_page_popup($args)
    {
        ?>
        <div class="pxl-page-popup pxl-page-popup-template-<?php echo esc_attr(
            $args['post_id'],
        ); ?>">
            <div class="pxl-close-popup  pxl-cursor--cta ">x</div>
            <div class="pxl-popup--conent">
                <div class="pxl-conent-elementor">
                    <?php
                    $content_page = \Elementor\Plugin::$instance->frontend->get_builder_content_for_display(
                        (int) $args['post_id'],
                    );
                    pxl_print_html($content_page);?>
                </div>
            </div>
        </div>
    <?php
    }
}

/* Cart Sidebar */
if (!function_exists('frameflow_hook_anchor_cart')) {
    function frameflow_hook_anchor_cart()
    {
        if (did_action('frameflow_cart_sidebar_rendered')) {
            return;
        }
        do_action('frameflow_cart_sidebar_rendered');
        global $woocommerce; ?>
        <div id="pxl-cart-sidebar" class="pxl-popup-wrap">
            <div class="pxl-popup--overlay pxl-cursor--cta"></div>
            <div class="pxl-popup--conent pxl-widget-cart-sidebar">
                <div class="widget_shopping_cart">
                    <div class="widget_shopping_head">
                        <div class="pxl-item--close pxl-close pxl-cursor--cta"></div>
                        <div class="widget_shopping_title">
                            <?php echo esc_html__(
                                'Cart',
                                'frameflow',
                            ); ?> <span class="widget_cart_counter">(<?php echo sprintf(
     _n('%d item', '%d items', WC()->cart->cart_contents_count, 'frameflow'),
     WC()->cart->cart_contents_count,
 ); ?>)</span>
                        </div>
                    </div>
                    <div class="widget_shopping_cart_content">
                        <?php if (function_exists('frameflow_render_mini_cart_grouped_items')) {
                            frameflow_render_mini_cart_grouped_items();
                        } else {
                            woocommerce_mini_cart();
                        } ?>
                    </div>
                    <?php echo function_exists('frameflow_get_cart_sidebar_footer_html')
                        ? frameflow_get_cart_sidebar_footer_html()
                        : ''; ?>
                </div>
            </div>
        </div>
    <?php
    }
}

/** Show Cart Sidebar Hidden */
add_filter('woocommerce_add_to_cart_fragments', function ($fragments) {
    ob_start(); ?>
    <span class="pxl_cart_counter"><?php echo WC()->cart->cart_contents_count; ?></span>
<?php
$fragments['span.pxl_cart_counter'] = ob_get_clean();
return $fragments;
});
add_action('wp_footer', 'frameflow_cart_hidden_sidebar');
function frameflow_cart_hidden_sidebar()
{
    if (!class_exists('WooCommerce') || is_checkout()) {
        return;
    }
    ?>
    <script type="text/javascript">
        jQuery(function($) {
            $(document.body).on('added_to_cart', function(event, fragments) {
                if (!$('#pxl-cart-sidebar').length) {
                    return;
                }
                $('#pxl-cart-sidebar').addClass('active');
                $('body').addClass('body-overflow');
                $('.woocommerce-message').remove();

                if (fragments && fragments['span.pxl_cart_counter']) {
                    $('.pxl_cart_counter').replaceWith(fragments['span.pxl_cart_counter']);
                }
            });

            $(document).on('click', '#pxl-cart-sidebar .pxl-item--close, #pxl-cart-sidebar .pxl-popup--overlay', function() {
                $('body').removeClass('body-overflow');
                $('#pxl-cart-sidebar').removeClass('active');
            });
        });
    </script>
<?php
}

add_action('wp_footer', 'frameflow_render_cart_sidebar_once', 5);
function frameflow_render_cart_sidebar_once()
{
    if (!class_exists('WooCommerce') || is_checkout() || is_admin()) {
        return;
    }
    if (did_action('frameflow_cart_sidebar_rendered')) {
        return;
    }
    if (function_exists('frameflow_hook_anchor_cart')) {
        frameflow_hook_anchor_cart();
    }
}
