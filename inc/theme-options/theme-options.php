<?php
add_action('after_setup_theme', 'frameflow_setup_option', 1);
function frameflow_setup_option()
{
    if (!class_exists('ReduxFramework')) {
        return;
    }
    if (class_exists('ReduxFrameworkPlugin')) {
        remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
    }

    $opt_name = frameflow()->get_option_name();
    $version = frameflow()->get_version();

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => '', //$theme->get('Name'),
        // Name that appears at the top of your panel
        'display_version'      => $version,
        // Version that appears at the top of your panel
        'menu_type'            => 'submenu', //class_exists('Pxltheme_Core') ? 'submenu' : '',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__('Theme Options', 'frameflow'),
        'page_title'           => esc_html__('Theme Options', 'frameflow'),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => false,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => false,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-admin-generic',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => true,
        // Show the time the page took to load, etc
        'update_notice'        => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field
        'show_options_object' => false,
        // OPTIONAL -> Give you extra features
        'page_priority'        => 80,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'pxlart', //class_exists('Frameflow_Admin_Page') ? 'case' : '',
        // For a full list of options, visit: //codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => 'pxlart-theme-options',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        ),
    );

    Redux::SetArgs($opt_name, $args);

    /*--------------------------------------------------------------
# General
--------------------------------------------------------------*/

    Redux::setSection($opt_name, array(
        'title'  => esc_html__('General', 'frameflow'),
        'icon'   => 'el-icon-home',
        'fields' => array()
    ));

    Redux::setSection($opt_name, array(
        'title'  => esc_html__('Colors', 'frameflow'),
        'icon'       => 'el el-circle-arrow-right',
        'subsection' => true,
        'fields' => array(
            array(
                'id'          => 'primary_color',
                'type'        => 'color',
                'title'       => esc_html__('Primary Color', 'frameflow'),
                'transparent' => false,
                'default'     => ''
            ),
            array(
                'id'          => 'secondary_color',
                'type'        => 'color',
                'title'       => esc_html__('Secondary Color', 'frameflow'),
                'transparent' => false,
                'default'     => ''
            ),
            array(
                'id'          => 'third_color',
                'type'        => 'color',
                'title'       => esc_html__('Third Color', 'frameflow'),
                'transparent' => false,
                'default'     => ''
            ),
            array(
                'id'          => 'four_color',
                'type'        => 'color',
                'title'       => esc_html__('Four Color', 'frameflow'),
                'transparent' => false,
                'default'     => ''
            ),
            array(
                'id'       => 'body_bg_color',
                'type'     => 'color',
                'title'    => esc_html__('Body Background Color', 'frameflow'),
                'transparent' => false,
                'default'     => ''
            ),
            array(
                'id'          => 'gradient_color',
                'type'        => 'color_gradient',
                'title'       => esc_html__('Gradient Color One', 'frameflow'),
                'transparent' => false,
                'default'  => array(
                    'from' => '',
                    'to'   => '',
                ),
            ),
            array(
                'id'          => 'gradient_color_two',
                'type'        => 'color_gradient',
                'title'       => esc_html__('Gradient Color Two', 'frameflow'),
                'transparent' => false,
                'default'  => array(
                    'from' => '',
                    'to'   => '',
                ),
            ),
        )
    ));

    Redux::setSection($opt_name, array(
        'title'      => esc_html__('Favicon', 'frameflow'),
        'icon'       => 'el el-circle-arrow-right',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'favicon',
                'type'     => 'media',
                'title'    => esc_html__('Favicon', 'frameflow'),
                'default'  => '',
                'url'      => false
            ),
        )
    ));

    Redux::setSection($opt_name, array(
        'title'      => esc_html__('Mouse', 'frameflow'),
        'icon'       => 'el el-circle-arrow-right',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'mouse_move_animation',
                'type'     => 'switch',
                'title'    => esc_html__('Mouse Move Animation', 'frameflow'),
                'default'  => false
            ),
        )
    ));
    Redux::setSection($opt_name, array(
        'title'      => esc_html__('Search Popup', 'frameflow'),
        'icon'       => 'el el-circle-arrow-right',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'logo_s_p',
                'type'     => 'media',
                'title'    => esc_html__('Logo Search Popup', 'frameflow'),
                'default' => array(
                    'url' => get_template_directory_uri() . '/assets/img/logo.png'
                ),
            ),
            array(
                'id'      => 'placeholder_search_pu',
                'type'    => 'text',
                'title'   => esc_html__('Placeholder', 'frameflow'),
                'default' => 'Type Your Search Words...',
            )
        )
    ));
    Redux::setSection($opt_name, array(
        'title'      => esc_html__('Loader', 'frameflow'),
        'icon'       => 'el el-circle-arrow-right',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'site_loader',
                'type'     => 'switch',
                'title'    => esc_html__('Loader', 'frameflow'),
                'default'  => false
            ),
            array(
                'id'       => 'loader_logo',
                'type'     => 'media',
                'title'    => esc_html__('Logo', 'frameflow'),
                'url'      => false,
                'required' => array(0 => 'site_loader', 1 => 'equals', 2 => true),
            ),
            array(
                'id'       => 'loader_logo_height',
                'type'     => 'dimensions',
                'title'    => esc_html__('Logo Height', 'frameflow'),
                'width'    => false,
                'unit'     => 'px',
                'output'    => array('.pxl-loader .loader-logo img'),
                'required' => array(0 => 'site_loader', 1 => 'equals', 2 => true),
            ),
        )
    ));

    Redux::setSection($opt_name, array(
        'title'      => esc_html__('Cookie Policy', 'frameflow'),
        'icon'       => 'el el-circle-arrow-right',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'cookie_policy',
                'type'     => 'button_set',
                'title'    => esc_html__('Cookie Policy', 'frameflow'),
                'options'  => array(
                    'show' => esc_html__('Show', 'frameflow'),
                    'hide' => esc_html__('Hide', 'frameflow'),
                ),
                'default'  => 'hide',
            ),
            array(
                'id'      => 'cookie_policy_description',
                'type'    => 'text',
                'title'   => esc_html__('Description', 'frameflow'),
                'default' => '',
                'required' => array(0 => 'cookie_policy', 1 => 'equals', 2 => 'show'),
            ),
            array(
                'id'          => 'cookie_policy_description_typo',
                'type'        => 'typography',
                'title'       => esc_html__('Description Font', 'frameflow'),
                'google'      => true,
                'font-backup' => false,
                'all_styles'  => true,
                'line-height'  => true,
                'font-size'  => true,
                'text-align'  => false,
                'color'  => false,
                'output'      => array('.pxl-cookie-policy .pxl-item--description'),
                'units'       => 'px',
                'required' => array(0 => 'cookie_policy', 1 => 'equals', 2 => 'show'),
            ),
            array(
                'id'      => 'cookie_policy_btntext',
                'type'    => 'text',
                'title'   => esc_html__('Button Text', 'frameflow'),
                'default' => '',
                'required' => array(0 => 'cookie_policy', 1 => 'equals', 2 => 'show'),
            ),
            array(
                'id'    => 'cookie_policy_link',
                'type'  => 'select',
                'title' => esc_html__('Button Link', 'frameflow'),
                'data'  => 'page',
                'args'  => array(
                    'post_type'      => 'page',
                    'posts_per_page' => -1,
                    'orderby'        => 'title',
                    'order'          => 'ASC',
                ),
                'required' => array(0 => 'cookie_policy', 1 => 'equals', 2 => 'show'),
            ),
        )
    ));

    Redux::setSection($opt_name, array(
        'title'      => esc_html__('Smooth Scroll', 'frameflow'),
        'icon'       => 'el el-circle-arrow-right',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'smooth_scroll',
                'type'     => 'button_set',
                'title'    => esc_html__('Smooth Scroll', 'frameflow'),
                'options'  => array(
                    'on' => esc_html__('On', 'frameflow'),
                    'off' => esc_html__('Off', 'frameflow'),
                ),
                'default'  => 'off',
            ),
        )
    ));



    /*--------------------------------------------------------------
# Header
--------------------------------------------------------------*/

    Redux::setSection($opt_name, array(
        'title'  => esc_html__('Header', 'frameflow'),
        'icon'   => 'el el-indent-left',
        'fields' => array_merge(
            frameflow_header_opts(),
            array(
                array(
                    'id'       => 'sticky_scroll',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Sticky Scroll', 'frameflow'),
                    'options'  => array(
                        'pxl-sticky-stt' => esc_html__('Scroll To Top', 'frameflow'),
                        'pxl-sticky-stb'  => esc_html__('Scroll To Bottom', 'frameflow'),
                    ),
                    'default'  => 'pxl-sticky-stb',
                ),
                array(
                    'id'       => 'logo_s',
                    'type'     => 'media',
                    'title'    => esc_html__('Logo Search Popup', 'frameflow'),
                    'default' => array(
                        'url' => get_template_directory_uri() . '/assets/img/logo.png'
                    ),
                    'url'      => false,
                    'required' => array(0 => 'mobile_display', 1 => 'equals', 2 => 'show'),
                ),
            )
        )
    ));

    Redux::setSection($opt_name, array(
        'title'      => esc_html__('Mobile', 'frameflow'),
        'icon'       => 'el el-circle-arrow-right',
        'subsection' => true,
        'fields'     => array_merge(
            frameflow_header_mobile_opts(),
            array(
                array(
                    'id'       => 'mobile_display',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Display', 'frameflow'),
                    'options'  => array(
                        'show'  => esc_html__('Show', 'frameflow'),
                        'hide'  => esc_html__('Hide', 'frameflow'),
                    ),
                    'default'  => 'show'
                ),
                array(
                    'id'       => 'pm_menu',
                    'type'     => 'select',
                    'title'    => esc_html__('Select Menu Mobile', 'frameflow'),
                    'options'  => frameflow_get_nav_menu_slug(),
                    'default' => '-1',
                ),
                array(
                    'id'       => 'opt_mobile_style',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Style', 'frameflow'),
                    'options'  => array(
                        'light'  => esc_html__('Light', 'frameflow'),
                        'dark'  => esc_html__('Dark', 'frameflow'),
                    ),
                    'default'  => 'light',
                    'required' => array(0 => 'mobile_display', 1 => 'equals', 2 => 'show'),
                ),
                array(
                    'id'          => 'mobile_header_bg_light',
                    'type'        => 'color',
                    'title'       => esc_html__('Mobile Header Background (Light)', 'frameflow'),
                    'subtitle'    => esc_html__('Applies when Style is Light (#pxl-header-mobile.style-light).', 'frameflow'),
                    'transparent' => false,
                    'default'     => '',
                    'required'    => array(0 => 'mobile_display', 1 => 'equals', 2 => 'show'),
                ),
                array(
                    'id'          => 'mobile_header_bg_dark',
                    'type'        => 'color',
                    'title'       => esc_html__('Mobile Header Background (Dark)', 'frameflow'),
                    'subtitle'    => esc_html__('Applies when Style is Dark (#pxl-header-mobile.style-dark).', 'frameflow'),
                    'transparent' => false,
                    'default'     => '',
                    'required'    => array(0 => 'mobile_display', 1 => 'equals', 2 => 'show'),
                ),
                array(
                    'id'       => 'logo_m',
                    'type'     => 'media',
                    'title'    => esc_html__('Logo', 'frameflow'),
                    'default' => array(
                        'url' => get_template_directory_uri() . '/assets/img/logo.png'
                    ),
                    'url'      => false,
                    'required' => array(0 => 'mobile_display', 1 => 'equals', 2 => 'show'),
                ),
                array(
                    'id'       => 'logo_height',
                    'type'     => 'dimensions',
                    'title'    => esc_html__('Logo Height', 'frameflow'),
                    'width'    => false,
                    'units'    => 'px',
                    'required' => array(0 => 'mobile_display', 1 => 'equals', 2 => 'show'),
                ),
                array(
                    'id'       => 'search_mobile',
                    'type'     => 'switch',
                    'title'    => esc_html__('Search Form', 'frameflow'),
                    'default'  => true,
                    'required' => array(0 => 'mobile_display', 1 => 'equals', 2 => 'show'),
                ),
                array(
                    'id'      => 'search_placeholder_mobile',
                    'type'    => 'text',
                    'title'   => esc_html__('Search Text Placeholder', 'frameflow'),
                    'default' => '',
                    'subtitle' => esc_html__('Default: Search...', 'frameflow'),
                    'required' => array(0 => 'search_mobile', 1 => 'equals', 2 => true),
                )
            )
        )
    ));

    /*--------------------------------------------------------------
# Page Title area
--------------------------------------------------------------*/

    Redux::setSection($opt_name, array(
        'title'  => esc_html__('Page Title', 'frameflow'),
        'icon'   => 'el-icon-map-marker',
        'fields' => array_merge(
            frameflow_page_title_opts(),
            array(
                array(
                    'id'       => 'ptitle_scroll_opacity',
                    'title'    => esc_html__('Scroll Opacity', 'frameflow'),
                    'type'     => 'switch',
                    'default'  => false,
                ),
                array(
                    'id'       => 'ptitle_description',
                    'type'     => 'textarea',
                    'title'    => esc_html__('Description', 'frameflow'),
                    'default'  => 'At Frameflow, we bring together talented professionals who are passionate about solving complex business challenges.',
                ),
            )
        )
    ));


    Redux::setSection($opt_name, array(
        'title' => esc_html__('Page', 'frameflow'),
        'icon'  => 'el-icon-website',
        'fields'     => array()
    ));

    Redux::setSection($opt_name, array(
        'title' => esc_html__('Single Page', 'frameflow'),
        'icon'  => 'el el-circle-arrow-right',
        'subsection' => true,
        'fields'     => array_merge(
            frameflow_sidebar_pos_opts(['prefix' => 'page_']),
            array()
        )
    ));

    /*--------------------------------------------------------------
# Footer
--------------------------------------------------------------*/

    Redux::setSection($opt_name, array(
        'title'  => esc_html__('Footer', 'frameflow'),
        'icon'   => 'el el-website',
        'fields' => array_merge(
            frameflow_footer_opts(),
            array(
                array(
                    'id'       => 'back_totop_on',
                    'type'     => 'switch',
                    'title'    => esc_html__('Button Back to Top', 'frameflow'),
                    'default'  => false,
                ),
                array(
                    'id'       => 'footer_fixed',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Footer Fixed', 'frameflow'),
                    'options'  => array(
                        'on' => esc_html__('On', 'frameflow'),
                        'off' => esc_html__('Off', 'frameflow'),
                    ),
                    'default'  => 'off',
                ),
            )
        )

    ));

    /*--------------------------------------------------------------
# Typography
--------------------------------------------------------------*/
    Redux::setSection($opt_name, array(
        'title'  => esc_html__('Typography', 'frameflow'),
        'icon'   => 'el-icon-text-width',
        'fields' => array(
            array(
                'id'       => 'pxl_body_typography',
                'type'     => 'select',
                'title'    => esc_html__('Body Font Type', 'frameflow'),
                'options'  => array(
                    'default-font'  => esc_html__('Default Font', 'frameflow'),
                    'google-font'  => esc_html__('Google Font', 'frameflow'),
                ),
                'default'  => 'default-font',
            ),

            array(
                'id'          => 'font_body',
                'type'        => 'typography',
                'title'       => esc_html__('Body Google Font', 'frameflow'),
                'google'      => true,
                'font-backup' => false,
                'all_styles'  => true,
                'line-height'  => true,
                'font-size'  => true,
                'text-align'  => false,
                'output'      => array('body'),
                'units'       => 'px',
                'required' => array(0 => 'pxl_body_typography', 1 => 'equals', 2 => 'google-font'),
                'force_output' => true
            ),

            array(
                'id'       => 'pxl_heading_typography',
                'type'     => 'select',
                'title'    => esc_html__('Heading Font Type', 'frameflow'),
                'options'  => array(
                    'default-font'  => esc_html__('Default Font', 'frameflow'),
                    'google-font'  => esc_html__('Google Font', 'frameflow'),
                ),
                'default'  => 'default-font',
            ),

            array(
                'id'          => 'font_heading',
                'type'        => 'typography',
                'title'       => esc_html__('Heading Google Font', 'frameflow'),
                'google'      => true,
                'font-backup' => false,
                'all_styles'  => true,
                'text-align'  => false,
                'line-height'  => false,
                'font-size'  => false,
                'font-style'  => false,
                'output'      => array('h1,h2,h3,h4,h5,h6,.ft-heading,.product_title'),
                'units'       => 'px',
                'required' => array(0 => 'pxl_heading_typography', 1 => 'equals', 2 => 'google-font'),
                'force_output' => true
            ),

            array(
                'id'          => 'theme_default',
                'type'        => 'typography',
                'title'       => esc_html__('Theme Default', 'frameflow'),
                'subtitle'    => esc_html__('UI / button font (.ft-theme-default). Leave empty to use Schibsted Grotesk.', 'frameflow'),
                'google'      => true,
                'font-backup' => false,
                'all_styles'  => false,
                'line-height'  => false,
                'font-size'  => false,
                'color'  => false,
                'font-style'  => false,
                'font-weight'  => false,
                'text-align'  => false,
                'units'       => 'px',
                'force_output' => true
            ),

        )
    ));
}
