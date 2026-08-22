<?php

if (!function_exists('frameflow_is_site_loader_active')) {
    function frameflow_is_site_loader_active()
    {
        if (is_admin() || wp_doing_ajax()) {
            return false;
        }

        if (isset($_GET['elementor-preview'])) {
            return false;
        }

        if (!function_exists('frameflow')) {
            return false;
        }

        $site_loader = frameflow()->get_opt('site_loader', false);
        $loader_logo = frameflow()->get_opt('loader_logo');

        return !empty($site_loader) && is_array($loader_logo) && !empty($loader_logo['url']);
    }
}

if (!class_exists('Frameflow_Page')) {

    class Frameflow_Page
    {
        public function get_site_loader()
        {
            if (!frameflow_is_site_loader_active()) {
                return;
            }

            $loader_logo = frameflow()->get_opt('loader_logo');
            $loader_logo_height = frameflow()->get_opt('loader_logo_height', []);
            $loader_logo_height_style = '';

            if (is_array($loader_logo_height) && !empty($loader_logo_height['height'])) {
                $height_value = trim((string) $loader_logo_height['height']);
                $height_unit = !empty($loader_logo_height['units']) ? trim((string) $loader_logo_height['units']) : 'px';

                if ($height_value !== '') {
                    if (preg_match('/[a-z%]+$/i', $height_value)) {
                        $loader_logo_height_style = $height_value;
                    } else {
                        $loader_logo_height_style = $height_value . $height_unit;
                    }
                }
            }

            if (!empty($loader_logo['url'])) { ?>
                <div id="pxl-loadding" class="pxl-loader">
                    <div class="loader-circle">
                        <div class="loader-line-mask">
                            <div class="loader-line"></div>
                        </div>
                        <div class="loader-logo"><img src="<?php echo esc_url($loader_logo['url']); ?>" alt=""<?php if ($loader_logo_height_style !== '') : ?> style="height:<?php echo esc_attr($loader_logo_height_style); ?>;width:auto;"<?php endif; ?> /></div>
                    </div>
                </div>
            <?php }
        }

        public function get_link_pages()
        {
            wp_link_pages(array(
                'before' => '<div class="page-links">',
                'after' => '</div>',
                'link_before' => '<span>',
                'link_after' => '</span>',
            ));
        }

        public function get_page_title()
        {
            $titles = $this->get_title();
            $pt_mode = frameflow()->get_theme_opt('pt_mode');
            $ptitle_layout = frameflow()->get_theme_opt('ptitle_layout');
            $ptitle_scroll_opacity = frameflow()->get_opt('ptitle_scroll_opacity');
            $custom_main_title = frameflow()->get_opt('sg_page_title_text');
            if (empty($custom_main_title)) {
                $custom_main_title = frameflow()->get_opt('custom_main_title');
            }
            $ptitle_description = frameflow()->get_opt('ptitle_description');
            $pt_mode_page = frameflow()->get_page_opt('pt_mode', '-1');
            if ($pt_mode_page != '-1') {
                $pt_mode = $pt_mode_page;
            }
            $ptitle_layout_page = frameflow()->get_page_opt('ptitle_layout', '-1');
            if ($ptitle_layout_page != '-1') {
                $ptitle_layout = $ptitle_layout_page;
            }
            $ptitle_layout = (int)$ptitle_layout;

            if ($pt_mode == 'none') return;
            if ($pt_mode == 'bd' && $ptitle_layout > 0 && class_exists('Pxltheme_Core') && is_callable('Elementor\Plugin::instance')) {
                $previous_flag = isset($GLOBALS['frameflow_rendering_page_title']) ? $GLOBALS['frameflow_rendering_page_title'] : false;
                $GLOBALS['frameflow_rendering_page_title'] = true;
            ?>
                <div id="pxl-page-title-elementor" class="<?php if ($ptitle_scroll_opacity == true) {
                    echo 'pxl-scroll-opacity';
                } ?>">
                    <?php echo Elementor\Plugin::$instance->frontend->get_builder_content_for_display($ptitle_layout); ?>
                </div>
            <?php
                $GLOBALS['frameflow_rendering_page_title'] = $previous_flag;
            } else {
                wp_enqueue_script('stellar-parallax'); ?>
                <div id="pxl-page-title-default" class="pxl--parallax" data-stellar-background-ratio="0.79">
                    <div class="pxl-page-title--top">
                        <div class="pxl-page-title--top-inner">
                        </div>
                    </div>
                    <div class="container pxl-page-title--content">
                        <h2 class="pxl-page-title wow fadeInUp"><?php if (!empty($custom_main_title)) {
                            echo wp_kses_post($custom_main_title);
                        } else {
                            echo wp_kses_post($titles['title']);
                        } ?></h2>
                        <div class="pxl-page-title--description wow fadeInUp" data-wow-delay="0.2s">
                            <?php echo wp_kses_post($ptitle_description); ?>
                        </div>
                        <div class="pxl-page-title--bg" style="background-image: url(<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/page-title-bg.webp);">
                        </div>
                    </div>
                </div>
            <?php }
        }

        public function get_title()
        {
            $title = '';
            if (! is_archive()) {
                if (is_home()) {
                    if (! is_front_page() && $page_for_posts = get_option('page_for_posts')) {
                        $title = get_post_meta($page_for_posts, 'sg_page_title_text', true);
                        if (empty($title)) {
                            $title = get_post_meta($page_for_posts, 'custom_title', true);
                        }
                        if (empty($title)) {
                            $title = get_the_title($page_for_posts);
                        }
                    }
                    if (is_front_page()) {
                        $title = esc_html__('Blog', 'frameflow');
                    }
                }
                elseif (is_page()) {
                    $title = get_post_meta(get_the_ID(), 'sg_page_title_text', true);
                    if (! $title) {
                        $title = get_post_meta(get_the_ID(), 'custom_title', true);
                    }
                    if (! $title) {
                        $title = get_the_title();
                    }
                } elseif (is_404()) {
                    $title = esc_html__('404 Error', 'frameflow');
                } elseif (is_search()) {
                    $title = esc_html__('Search results', 'frameflow');
                } elseif (is_singular('lp_course')) {
                    $title = esc_html__('Course', 'frameflow');
                } else {
                    $title = get_post_meta(get_the_ID(), 'custom_title', true);
                    if (! $title) {
                        $title = get_the_title();
                    }
                }
            } else {
                $title = get_the_archive_title();
                if ((class_exists('WooCommerce') && is_shop())) {
                    $title = get_post_meta(wc_get_page_id('shop'), 'custom_title', true);
                    if (!$title) {
                        $title = get_the_title(get_option('woocommerce_shop_page_id'));
                    }
                }
            }

            return array(
                'title' => $title,
            );
        }

        public function get_breadcrumb($args = array())
        {
            $args = wp_parse_args($args, array(
                'wrapper_class' => 'pxl-breadcrumb',
                'separator' => '',
            ));

            $wrapper_classes = array_filter(array_map('sanitize_html_class', explode(' ', $args['wrapper_class'])));
            $wrapper_class = implode(' ', $wrapper_classes);
            $separator_html = trim($args['separator']);
            $separator_allowed_html = array(
                'i' => array(
                    'class' => array(),
                    'aria-hidden' => array(),
                ),
                'span' => array(
                    'class' => array(),
                    'aria-hidden' => array(),
                ),
                'svg' => array(
                    'class' => array(),
                    'aria-hidden' => array(),
                    'xmlns' => array(),
                    'width' => array(),
                    'height' => array(),
                    'viewBox' => array(),
                    'fill' => array(),
                    'stroke' => array(),
                    'stroke-width' => array(),
                    'role' => array(),
                    'focusable' => array(),
                ),
                'path' => array(
                    'd' => array(),
                    'fill' => array(),
                    'stroke' => array(),
                    'stroke-width' => array(),
                    'stroke-linecap' => array(),
                    'stroke-linejoin' => array(),
                ),
            );

            if (! class_exists('CASE_Breadcrumb')) {
                return;
            }

            $breadcrumb = new CASE_Breadcrumb();
            $entries = $breadcrumb->get_entries();

            if (empty($entries)) {
                return;
            }

            ob_start();

            foreach ($entries as $index => $entry) {
                $entry = wp_parse_args($entry, array(
                    'label' => '',
                    'url'   => ''
                ));

                $entry_label = $entry['label'];

                if (!empty($_GET['blog_title'])) {
                    $blog_title = sanitize_text_field(wp_unslash($_GET['blog_title']));
                    $entry_label = str_replace('_', ' ', $blog_title);
                }

                if (empty($entry_label)) {
                    continue;
                }

                echo '<li>';
                if (! empty($separator_html) && $index > 0) {
                    printf(
                        '<span class="breadcrumb-separator" aria-hidden="true">%s</span>',
                        wp_kses($separator_html, $separator_allowed_html)
                    );
                }

                if (! empty($entry['url'])) {
                    printf(
                        '<a class="breadcrumb-hidden" href="%1$s">%2$s</a>',
                        esc_url($entry['url']),
                        esc_attr($entry_label)
                    );
                } else {
                    printf('<span class="breadcrumb-entry" >%s</span>', esc_html($entry_label));
                }

                echo '</li>';
            }

            $output = ob_get_clean();

            if ($output) {
                $breadcrumb_allowed_html = array(
                    'ul' => array(
                        'class' => array(),
                    ),
                    'li' => array(
                        'class' => array(),
                    ),
                    'a' => array(
                        'class' => array(),
                        'href' => array(),
                        'target' => array(),
                        'rel' => array(),
                    ),
                    'span' => array(
                        'class' => array(),
                        'aria-hidden' => array(),
                    ),
                    'i' => array(
                        'class' => array(),
                        'aria-hidden' => array(),
                    ),
                    'svg' => array(
                        'class' => array(),
                        'aria-hidden' => array(),
                        'xmlns' => array(),
                        'width' => array(),
                        'height' => array(),
                        'viewBox' => array(),
                        'fill' => array(),
                        'stroke' => array(),
                        'stroke-width' => array(),
                        'role' => array(),
                        'focusable' => array(),
                    ),
                    'path' => array(
                        'd' => array(),
                        'fill' => array(),
                        'stroke' => array(),
                        'stroke-width' => array(),
                        'stroke-linecap' => array(),
                        'stroke-linejoin' => array(),
                    ),
                );

                printf(
                    '<ul class="%1$s">%2$s</ul>',
                    esc_attr($wrapper_class),
                    wp_kses($output, $breadcrumb_allowed_html)
                );
            }
        }

        public function get_pagination($query = null, $ajax = false)
        {

            if ($ajax) {
                add_filter('paginate_links', 'frameflow_ajax_paginate_links');
            }

            $classes = array();

            if (empty($query)) {
                $query = $GLOBALS['wp_query'];
            }

            if (empty($query->max_num_pages) || ! is_numeric($query->max_num_pages) || $query->max_num_pages < 2) {
                return;
            }

            $paged = $query->get('paged', '');

            if (! $paged && is_front_page() && ! is_home()) {
                $paged = $query->get('page', '');
            }

            $paged = $paged ? intval($paged) : 1;

            $pagenum_link = html_entity_decode(get_pagenum_link());
            $query_args   = array();
            $url_parts    = explode('?', $pagenum_link);

            if (isset($url_parts[1])) {
                wp_parse_str($url_parts[1], $query_args);
            }

            $pagenum_link = remove_query_arg(array_keys($query_args), $pagenum_link);
            $pagenum_link = trailingslashit($pagenum_link) . '%_%';
            $paginate_links_args = array(
                'base'     => $pagenum_link,
                'total'    => $query->max_num_pages,
                'current'  => $paged,
                'mid_size' => 1,
                'add_args' => array_map('urlencode', $query_args),
                'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none"><path d="M12.2514 9.06388L6.93888 14.3764C6.78918 14.5261 6.58614 14.6102 6.37443 14.6102C6.16272 14.6102 5.95968 14.5261 5.80998 14.3764C5.66027 14.2267 5.57617 14.0236 5.57617 13.8119C5.57617 13.6002 5.66027 13.3972 5.80998 13.2475L10.5587 8.50009L5.8113 3.75138C5.73718 3.67726 5.67838 3.58926 5.63826 3.49241C5.59815 3.39556 5.5775 3.29176 5.5775 3.18693C5.5775 3.0821 5.59815 2.9783 5.63826 2.88145C5.67838 2.7846 5.73718 2.6966 5.8113 2.62248C5.88543 2.54835 5.97343 2.48955 6.07028 2.44944C6.16713 2.40932 6.27093 2.38867 6.37576 2.38867C6.48059 2.38867 6.58439 2.40932 6.68124 2.44944C6.77809 2.48955 6.86609 2.54835 6.94021 2.62248L12.2527 7.93498C12.3269 8.0091 12.3858 8.09713 12.4259 8.19404C12.466 8.29095 12.4865 8.39482 12.4864 8.49971C12.4863 8.60459 12.4655 8.70841 12.4251 8.80522C12.3848 8.90204 12.3258 8.98994 12.2514 9.06388Z" fill="currentColor" transform="rotate(180 8.5 8.5)" /></svg>',
                'next_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none"><path d="M12.2514 9.06388L6.93888 14.3764C6.78918 14.5261 6.58614 14.6102 6.37443 14.6102C6.16272 14.6102 5.95968 14.5261 5.80998 14.3764C5.66027 14.2267 5.57617 14.0236 5.57617 13.8119C5.57617 13.6002 5.66027 13.3972 5.80998 13.2475L10.5587 8.50009L5.8113 3.75138C5.73718 3.67726 5.67838 3.58926 5.63826 3.49241C5.59815 3.39556 5.5775 3.29176 5.5775 3.18693C5.5775 3.0821 5.59815 2.9783 5.63826 2.88145C5.67838 2.7846 5.73718 2.6966 5.8113 2.62248C5.88543 2.54835 5.97343 2.48955 6.07028 2.44944C6.16713 2.40932 6.27093 2.38867 6.37576 2.38867C6.48059 2.38867 6.58439 2.40932 6.68124 2.44944C6.77809 2.48955 6.86609 2.54835 6.94021 2.62248L12.2527 7.93498C12.3269 8.0091 12.3858 8.09713 12.4259 8.19404C12.466 8.29095 12.4865 8.39482 12.4864 8.49971C12.4863 8.60459 12.4655 8.70841 12.4251 8.80522C12.3848 8.90204 12.3258 8.98994 12.2514 9.06388Z" fill="currentColor"/></svg>',
            );
            if ($ajax) {
                $paginate_links_args['format'] = '?page=%#%';
            }
            $links = paginate_links($paginate_links_args);
            if ($links):
            ?>
                <nav class="pxl-pagination-wrap <?php echo esc_attr($ajax ? 'ajax' : ''); ?>">
                    <div class="pxl-pagination-links">
                        <?php
                        echo '' . $links;
                        ?>
                    </div>
                </nav>
<?php
            endif;
        }
    }
}
