<?php
if (!class_exists('Frameflow_Blog')) {
    class Frameflow_Blog
    {

        public function get_archive_meta($post_id = 0)
        {
            $post_date_on = frameflow()->get_theme_opt('post_date_on', true);
            $post_comments_on = frameflow()->get_theme_opt('post_comments_on', true);
            if ($post_date_on || $post_comments_on) : ?>
                <div class="post-metas">
                    <div class="meta-inner align-items-center">
                        <?php if ($post_date_on) : ?>
                            <span class="pxl-item--date">
                                <?php echo get_the_date('M d Y'); ?>
                            </span>
                        <?php endif; ?>

                        <?php if ($post_comments_on) : ?>
                            <span class="post-comments  align-items-center">
                                <a href="<?php comments_link(); ?>">
                                    <span><?php comments_number(esc_html__('No Comments', 'frameflow'), esc_html__(' 1 Comment', 'frameflow'), esc_html__('%  Comments', 'frameflow')); ?></span>
                                </a>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif;
        }

        public function get_all_categories_list()
        {
            $categories = get_categories();
            if (!empty($categories)) {
                echo '<div class="category-carousel">';
                foreach ($categories as $category) {
                    $bg_category = get_term_meta($category->term_id, 'bg_category', true);
                    $bg_url = !empty($bg_category['url']) ? esc_url($bg_category['url']) : '';
                    $category_link = get_category_link($category->term_id);

                    echo '<div class="category-item">';
                    if ($bg_url) {
                        echo '<div class="category-banner">
                        <a href="' . esc_url($category_link) . '">
                        <img src="' . $bg_url . '" alt="' . esc_attr($category->name) . '">
                        </a>
                        </div>';
                    }
                    echo '<a href="' . esc_url($category_link) . '" class="category-title">' . esc_html($category->name) . '</a> 
                    <span class="post-count">' . sprintf(__('%d posts', 'frameflow'), $category->count) . '</span>';
                    echo '</div>';
                }
                echo '</div>';
            }
        }

        public function get_archive_meta_2($post_id = 0)
        { ?>
            <div class="post-metas-2">
                <div class="meta-inner ">
                    <span class="post-date-category">
                        <span class="post-date-post"><?php echo get_the_date('d M'); ?> </span>
                        <span><?php the_terms($post_id, 'category', '', ', ', ''); ?></span>
                    </span>
                </div>
            </div>
        <?php }

        public function get_post_title()
        {
        ?>
            <h5 class="post-title">
                <a href="<?php echo esc_url(get_permalink()); ?>" title="<?php the_title_attribute(); ?>">
                    <?php the_title(); ?>
                </a>
            </h5>
        <?php
        }

        public function get_excerpt()
        {
            $archive_excerpt_length = 20;
            $frameflow_the_excerpt = get_the_excerpt();
            if (!empty($frameflow_the_excerpt)) {
                echo wp_trim_words($frameflow_the_excerpt, $archive_excerpt_length, $more = null);
            } else {
                echo wp_kses_post($this->get_excerpt_more($archive_excerpt_length));
            }
        }

        public function get_excerpt_more($length = 55, $post = null)
        {
            $post = get_post($post);

            if (empty($post) || 0 >= $length) {
                return '';
            }

            if (post_password_required($post)) {
                return esc_html__('Post password required.', 'frameflow');
            }

            $content = apply_filters('the_content', strip_shortcodes($post->post_content));
            $content = str_replace(']]>', ']]&gt;', $content);

            $excerpt_more = apply_filters('frameflow_excerpt_more', '&hellip;');
            $excerpt      = wp_trim_words($content, $length, $excerpt_more);

            return $excerpt;
        }

        public function get_post_metas()
        {
            $post_id = get_the_ID();
            if (! $post_id) {
                return;
            }

            $categories_html = get_the_category_list('', ', ', '', $post_id);
        ?>
            <div class="post-metas">
                <div class="meta-inner align-items-center">

                    <?php if ($categories_html) : ?>
                        <span class="post-categories align-items-center">
                            <?php echo wp_kses_post($categories_html); ?>
                        </span>
                    <?php endif; ?>

                    <span class="pxl-item--date">
                        <?php echo esc_html(get_the_date('M d, Y', $post_id)); ?>
                    </span>
                </div>
            </div>
        <?php
        }

        public function frameflow_set_post_views($postID)
        {
            $countKey = 'post_views_count';
            $count    = get_post_meta($postID, $countKey, true);
            if ($count == '') {
                $count = 0;
                delete_post_meta($postID, $countKey);
                add_post_meta($postID, $countKey, '0');
            } else {
                $count++;
                update_post_meta($postID, $countKey, $count);
            }
        }

        public function get_post_tags($taxonomy = 'post_tag')
        {
            $tags_list = get_the_term_list(get_the_ID(), $taxonomy, '', ' ');
            if ($tags_list && !is_wp_error($tags_list)) {
                echo '<div class="post-tags ">';
                printf('%2$s', '', $tags_list);
                echo '</div>';
            }
        }

        public function get_post_category($post_id = 0)
        {
            $post_category = has_category('', $post_id);
            $post_date = true;

            echo '<ul class="pxl-item--meta">';

            if ($post_category) {
                echo '<li class="item--category">';
                echo get_the_term_list($post_id, 'category', '', '');
                echo '</li>';
            }

            echo '</ul>';
        }

        public function get_post_share($post_id = 0)
        {
            $post_id = $post_id ? $post_id : get_the_ID();
            $post = get_post($post_id);
        ?>
            <div class="post-shares align-items-center">
                <h6 class="label"><?php echo esc_html__('Share Post', 'frameflow'); ?></h6>
                <div class="social-share">
                    <div class="social">
                        <a class="pxl-icon " title="<?php echo esc_attr__('Facebook', 'frameflow'); ?>" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_the_permalink($post_id)); ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                                <path d="M7.6062 4.9192V6.74913H6.25391V8.98658H7.6062V15.6364H10.382V8.98725H12.2452C12.2452 8.98725 12.4198 7.91447 12.5044 6.74113H10.3934V5.21087C10.3934 4.98246 10.6955 4.67481 10.995 4.67481H12.5085V2.34546H10.4511C7.53704 2.34546 7.6062 4.58492 7.6062 4.9192Z" fill="currentColor"/>
                            </svg>
                        </a>
                        <a class="pxl-icon " title="<?php echo esc_attr__('Twitter', 'frameflow'); ?>" target="_blank" href="https://twitter.com/intent/tweet?original_referer=<?php echo urldecode(home_url('/')); ?>&url=<?php echo urlencode(get_the_permalink($post_id)); ?>&text=<?php the_title(); ?>%20">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                <path d="M16.0962 4.30003C15.5443 4.55087 14.9495 4.7157 14.3332 4.79453C14.9638 4.4147 15.4512 3.8127 15.6805 3.08887C15.0857 3.4472 14.4263 3.69803 13.7312 3.84137C13.165 3.22503 12.3695 2.8667 11.4665 2.8667C9.78235 2.8667 8.40635 4.2427 8.40635 5.9412C8.40635 6.18487 8.43501 6.42137 8.48518 6.64353C5.93385 6.51453 3.66202 5.28903 2.14985 3.43287C1.88468 3.88437 1.73418 4.4147 1.73418 4.9737C1.73418 6.04153 2.27168 6.98753 3.10302 7.52503C2.59418 7.52503 2.12118 7.3817 1.70552 7.1667V7.1882C1.70552 8.67887 2.76618 9.92587 4.17085 10.2054C3.71995 10.3293 3.24638 10.3465 2.78768 10.2555C2.98233 10.8665 3.36355 11.4011 3.87774 11.7841C4.39194 12.1672 5.01325 12.3795 5.65435 12.3912C4.56764 13.2516 3.22056 13.7166 1.83452 13.7099C1.59085 13.7099 1.34718 13.6955 1.10352 13.6669C2.46518 14.5412 4.08485 15.05 5.81918 15.05C11.4665 15.05 14.5697 10.363 14.5697 6.29953C14.5697 6.16337 14.5697 6.03437 14.5625 5.8982C15.1645 5.4682 15.6805 4.92353 16.0962 4.30003Z" fill="currentColor"/>
                            </svg>
                        </a>
                        <a class="pxl-icon " title="<?php echo esc_attr__('Telegram', 'frameflow'); ?>" target="_blank" href="https://telegram.me/share/url?url=<?php echo urlencode(get_the_permalink($post_id)); ?>&text=<?php the_title(); ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M14.1738 3.17476C14.3509 3.10022 14.5448 3.07451 14.7352 3.10031C14.9256 3.12611 15.1056 3.20247 15.2565 3.32145C15.4074 3.44043 15.5236 3.59767 15.5931 3.77682C15.6626 3.95596 15.6828 4.15046 15.6516 4.34006L14.0262 14.1992C13.8685 15.1503 12.8251 15.6956 11.9529 15.2219C11.2233 14.8256 10.1397 14.215 9.16504 13.5779C8.6777 13.259 7.18489 12.2377 7.36835 11.511C7.52602 10.8897 10.0344 8.55478 11.4677 7.16659C12.0303 6.62121 11.7737 6.30659 11.1094 6.80826C9.45959 8.05383 6.81079 9.94798 5.93502 10.4812C5.16245 10.9513 4.75969 11.0316 4.27809 10.9513C3.39945 10.8051 2.5846 10.5786 1.91954 10.3027C1.02084 9.93006 1.06456 8.69453 1.91882 8.33476L14.1738 3.17476Z" fill="currentColor"/>
                            </svg>
                        </a>
                        <a class="pxl-icon " title="<?php echo esc_attr__('Pinterest', 'frameflow'); ?>" target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_the_post_thumbnail_url($post_id, 'full')); ?>&media=&description=<?php echo urlencode(the_title_attribute(array('echo' => false, 'post' => $post))); ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                <path d="M8.55354 1.70215C6.95412 1.71271 5.40809 2.27876 4.17998 3.30344C2.95186 4.32812 2.11801 5.74774 1.82108 7.31938C1.52416 8.89103 1.78263 10.517 2.55227 11.9191C3.3219 13.3212 4.55487 14.4123 6.04019 15.0056C5.94035 14.3525 5.94035 13.6879 6.04019 13.0348L6.8536 9.58548C6.72505 9.27305 6.66094 8.93788 6.66512 8.60006C6.66512 7.64403 7.22197 6.9245 7.91212 6.9245C8.03709 6.92261 8.16099 6.94775 8.27533 6.99821C8.38968 7.04866 8.49177 7.12324 8.5746 7.21683C8.65744 7.31042 8.71906 7.42081 8.75526 7.54044C8.79145 7.66006 8.80136 7.7861 8.7843 7.90991C8.7843 8.29118 8.62807 8.79571 8.46467 9.32461C8.37508 9.6163 8.28263 9.91586 8.2124 10.2061C8.1699 10.3587 8.16479 10.5192 8.1975 10.6742C8.23022 10.8291 8.2998 10.9739 8.40036 11.0963C8.50091 11.2186 8.62947 11.3149 8.77515 11.3771C8.92083 11.4392 9.07933 11.4653 9.23724 11.4531C10.4592 11.4531 11.4052 10.1567 11.4052 8.29476C11.4172 7.91635 11.3504 7.53956 11.2088 7.18841C11.0672 6.83727 10.8541 6.51946 10.5829 6.25523C10.3117 5.99101 9.98849 5.78617 9.63379 5.65375C9.27909 5.52134 8.9007 5.46426 8.52272 5.48615C8.11913 5.46879 7.71622 5.53351 7.33838 5.67639C6.96053 5.81927 6.61561 6.03734 6.3245 6.3174C6.03338 6.59746 5.80212 6.93369 5.64473 7.30572C5.48733 7.67776 5.40707 8.07786 5.4088 8.48181C5.40363 9.04454 5.57618 9.59454 5.90187 10.0535C5.9256 10.0798 5.94246 10.1115 5.95096 10.1459C5.95946 10.1803 5.95934 10.2162 5.9506 10.2505C5.89685 10.4677 5.7786 10.9407 5.75854 11.0339C5.73919 11.127 5.65534 11.1865 5.52705 11.127C4.6649 10.7235 4.12812 9.46723 4.12812 8.45243C4.12812 6.2795 5.7098 4.27928 8.68612 4.27928C11.0748 4.27928 12.9374 5.98351 12.9374 8.26538C12.9374 10.6397 11.4596 12.551 9.35548 12.551C9.04709 12.5615 8.74097 12.4948 8.4648 12.3572C8.18864 12.2196 7.95114 12.0152 7.7738 11.7627L7.34524 13.4039C7.13973 14.0414 6.85156 14.6493 6.4881 15.212C7.15783 15.4105 7.85364 15.5069 8.5521 15.498C10.3815 15.498 12.1361 14.7712 13.4297 13.4776C14.7233 12.184 15.45 10.4295 15.45 8.60006C15.45 6.77062 14.7233 5.01611 13.4297 3.7225C12.1361 2.42889 10.3815 1.70215 8.5521 1.70215" fill="currentColor"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        <?php
        }

        public function get_post_nav()
        {
            global $post;
            
            if ( ! $post instanceof WP_Post ) {
                return;
            }
            $previous = (is_attachment()) ? get_post($post->post_parent) : get_adjacent_post(false, '', true);
            $next     = get_adjacent_post(false, '', false);

            if (! $next && ! $previous)
                return;
        ?>
            <?php
            $next_post = get_next_post();
            $previous_post = get_previous_post();
            if (empty($previous_post) && empty($next_post)) return;

            ?>
            <div class="single-next-prev-nav row gx-0 justify-content-between align-items-center">
                <?php if (!empty($previous_post)): ?>
                    <div class="nav-next-prev prev col relative text-start">
                        <div class="nav-inner">
                            <?php previous_post_link('%link', ''); ?>
                            <div class="nav-label-wrap justify-content-center align-items-center">
                                <i class="bootstrap-icons bi-arrow-left"></i>
                            </div>
                            <div class="nav-title-wrap d-none d-sm-flex">
                                <span class="nav-label"><?php echo esc_html__('Previous Post', 'frameflow'); ?></span>
                                <div class="nav-title"><?php echo wp_trim_words(get_the_title($previous_post->ID), 5, '...'); ?></div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="grid-archive">
                    <a href="<?php echo get_post_type_archive_link('post'); ?>">
                        <div class="nav-archive-button">
                            <div class="archive-btn-square square-1"></div>
                            <div class="archive-btn-square square-2"></div>
                            <div class="archive-btn-square square-3"></div>
                        </div>
                    </a>
                </div>
                <?php if (!empty($next_post)) : ?>
                    <div class="nav-next-prev next col relative text-end justify-content-end">
                        <div class="nav-inner">
                            <?php next_post_link('%link', ''); ?>
                            <div class="nav-label-wrap justify-content-center align-items-center">
                                <i class="bootstrap-icons bi-arrow-right"></i>
                            </div>
                            <div class="nav-title-wrap  align-items-end d-none d-sm-flex">
                                <span class="nav-label"><?php echo esc_html__('Newer Post', 'frameflow'); ?></span>
                                <div class="nav-title"><?php echo wp_trim_words(get_the_title($next_post->ID), 5, '...'); ?></div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php
        }
        public function get_project_nav()
        {
            global $post;
            if ( ! $post instanceof WP_Post ) {
                return;
            }
            $previous = (is_attachment()) ? get_post($post->post_parent) : get_adjacent_post(false, '', true);
            $next     = get_adjacent_post(false, '', false);
            if (! $next && ! $previous)
                return;
        ?>
            <?php
            $next_post = get_next_post();
            $previous_post = get_previous_post();

            if (!empty($next_post) || !empty($previous_post)) {
            ?>
                <div class="pxl-project--navigation">
                    <div class="pxl--items">
                        <div class="pxl--item pxl--item-prev">
                            <?php if (is_a($previous_post, 'WP_Post') && get_the_title($previous_post->ID) != '') {
                            ?>
                                <a href="<?php echo esc_url(get_permalink($previous_post->ID)); ?>"><i class="far fa-arrow-left"></i>Prev Project</a>
                            <?php } ?>
                        </div>
                        <div class="pxl--item pxl--item-grid">
                        </div>
                        <div class="pxl--item pxl--item-next">
                            <?php if (is_a($next_post, 'WP_Post') && get_the_title($next_post->ID) != '') {
                            ?>
                                <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>">Next Project <i class="far fa-arrow-right"></i> </a>
                            <?php } ?>
                        </div>
                    </div><!-- .nav-links -->
                </div>
                <?php }
        }
        public function get_related_post()
        {
            global $post;
                if (!$post) return;
                $current_id = $post->ID;
                $posttags = get_the_category($post->ID);
                if (empty($posttags)) return;

                $tags = array();

                foreach ($posttags as $tag) {

                    $tags[] = $tag->term_id;
                }
                $post_number = '6';
                $query_similar = new WP_Query(array('posts_per_page' => $post_number, 'post_type' => 'post', 'post_status' => 'publish', 'category__in' => $tags, 'post__not_in'   => [$current_id]));

                if (count($query_similar->posts) > 1) {
                    wp_enqueue_script('swiper');
                    wp_enqueue_script('pxl-swiper');
                    $opts = [
                        'slide_direction'               => 'horizontal',
                        'slide_percolumn'               => '1',
                        'slide_mode'                    => 'slide',
                        'slides_to_show'                => 3,
                        'slides_to_show_lg'             => 3,
                        'slides_to_show_md'             => 2,
                        'slides_to_show_sm'             => 2,
                        'slides_to_show_xs'             => 1,
                        'slides_to_scroll'              => 1,
                        'slides_gutter'                 => 30,
                        'arrow'                         => true,
                        'dots'                          => false,
                        'dots_style'                    => 'bullets'
                    ];
                    $data_settings = wp_json_encode($opts);
                    $dir           = is_rtl() ? 'rtl' : 'ltr';

                    $author_id = $post->post_author;
                    $author = get_user_by('id', $author_id);

                ?>
                    <div class="pxl-related-post">
                        <div class="pxl-related-post-top">
                            <h3 class="widget-title"><?php echo esc_html__('Related Posts', 'frameflow'); ?></h3>
                            <div class="pxl-swiper-arrow-wrap style-3">
                                <div class="pxl-swiper-arrow pxl-swiper-arrow-prev">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M5.78034 3.96967C5.48747 3.67678 5.01257 3.67678 4.71969 3.96967L0.219694 8.46968C-0.0731812 8.76255 -0.0731812 9.23745 0.219694 9.53033L4.71969 14.0303C5.01257 14.3232 5.48747 14.3232 5.78034 14.0303C6.07322 13.7375 6.07322 13.2626 5.78034 12.9697L1.81067 9L5.78034 5.03033C6.07322 4.73743 6.07322 4.26257 5.78034 3.96967Z" fill="#1A1A1A"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M18 9C18 8.58578 17.6642 8.25 17.25 8.25H0.75C0.335775 8.25 0 8.58578 0 9C0 9.41422 0.335775 9.75 0.75 9.75H17.25C17.6642 9.75 18 9.41422 18 9Z" fill="#1A1A1A"/>
                                    </svg>
                                </div>
                                <div class="pxl-swiper-arrow pxl-swiper-arrow-next">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12.2197 3.96967C12.5125 3.67678 12.9874 3.67678 13.2803 3.96967L17.7803 8.46968C18.0732 8.76255 18.0732 9.23745 17.7803 9.53033L13.2803 14.0303C12.9874 14.3232 12.5125 14.3232 12.2197 14.0303C11.9268 13.7375 11.9268 13.2626 12.2197 12.9697L16.1893 9L12.2197 5.03033C11.9268 4.73743 11.9268 4.26257 12.2197 3.96967Z" fill="#1A1A1A"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0 9C0 8.58578 0.335786 8.25 0.75 8.25H17.25C17.6642 8.25 18 8.58578 18 9C18 9.41422 17.6642 9.75 17.25 9.75H0.75C0.335786 9.75 0 9.41422 0 9Z" fill="#1A1A1A"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="pxl-swiper-container pxl-mouse-wheel" data-settings="<?php echo esc_attr($data_settings) ?>" data-rtl="<?php echo esc_attr($dir) ?>">
                            <div class="pxl-related-post-inner pxl-swiper-wrapper swiper-wrapper wow fadeIn" data-wow-delay="300ms" data-wow-duration="1.2s">
                                <?php foreach ($query_similar->posts as $post):
                                    $thumbnail_url = '';
                                    if (has_post_thumbnail(get_the_ID()) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)) :
                                        $thumbnail_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'frameflow-thumb-related', false);
                                    endif;
                                    if ($post->ID !== $current_id) : ?>
                                        <div class="pxl-swiper-slide swiper-slide grid-item">
                                            <div class="pxl-post--inner">
                                                <div class="pxl-post--holder">
                                                    <div class="pxl-post--meta">
                                                        <div class="pxl-post--category">
                                                            <?php echo get_the_category_list($post->ID, ', ', ''); ?>
                                                        </div>  
                                                        <div class="pxl-item--date">
                                                            <?php echo get_the_date('Y/m/d', $post->ID); ?>
                                                        </div>
                                                    </div>
                                                    <h6 class="pxl-post--title">
                                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                    </h6>
                                                    <div class="pxl-post--button">
                                                        <a class="btn--readmore btn" href="<?php echo esc_url(get_permalink($post->ID)); ?>">
                                                            <span class="btn--text">
                                                                <?php echo esc_html__('Read More', 'frameflow'); ?>
                                                            </span>
                                                            <span class="btn-icon-left">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="13" viewBox="0 0 16 13" fill="none"><path d="M9.6 12.7999C9.39526 12.7999 9.19053 12.7219 9.03432 12.5657C8.7219 12.2532 8.7219 11.7467 9.03432 11.4343L13.2686 7.19999H0.800009C0.358159 7.19999 0 6.8418 0 6.39998C0 5.95813 0.358159 5.59997 0.800009 5.59997H13.2686L9.03432 1.36567C8.7219 1.05326 8.7219 0.546725 9.03432 0.234311C9.3467 -0.0781035 9.8533 -0.0781035 10.1657 0.234311L15.7657 5.8343L15.7674 5.83604C15.7677 5.83632 15.768 5.83667 15.7683 5.83695C15.7686 5.83723 15.7688 5.83751 15.7691 5.83778C15.7695 5.8382 15.7699 5.83862 15.7703 5.83904C15.7705 5.83918 15.7706 5.83932 15.7708 5.83949C15.7713 5.84005 15.7718 5.84057 15.7724 5.84109L15.7724 5.84116C15.8444 5.91483 15.8992 5.9989 15.937 6.08847C15.9371 6.08872 15.9372 6.089 15.9373 6.08924C15.9374 6.08952 15.9376 6.08983 15.9377 6.09011C15.9778 6.18543 15.9999 6.29015 15.9999 6.40002C15.9999 6.50989 15.9778 6.61461 15.9377 6.70993C15.9376 6.71017 15.9374 6.71052 15.9373 6.7108C15.9372 6.71104 15.9371 6.71128 15.937 6.71153C15.8992 6.80114 15.8444 6.88521 15.7724 6.95888L15.7724 6.95891C15.7718 6.95947 15.7713 6.95999 15.7708 6.96051C15.7707 6.96065 15.7705 6.96079 15.7703 6.96096C15.7699 6.96142 15.7695 6.9618 15.7691 6.96225C15.7688 6.9625 15.7686 6.96281 15.7683 6.96305C15.768 6.96333 15.7677 6.96368 15.7674 6.96396C15.7668 6.96455 15.7662 6.96514 15.7657 6.9657L10.1657 12.5657C10.0095 12.7219 9.80474 12.7999 9.6 12.7999Z" fill="#1A1A1A"></path></svg>
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <?php if (has_post_thumbnail()) { ?>
                                                    <div class="pxl-post--featured">
                                                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('frameflow-thumb-related'); ?></a>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                <?php endif;
                                endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php }

            wp_reset_postdata();
        }

    }
}
