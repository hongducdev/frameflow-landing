<?php

/**
 * @package Frameflow
 */

$archive_readmore_text = esc_html__('Read Articles', 'frameflow');
$archive_excerpt = true;
$archive_social = frameflow()->get_theme_opt('archive_social', true);
$featured_video = get_post_meta(get_the_ID(), 'featured-video-url', true);
$audio_url = get_post_meta(get_the_ID(), 'featured-audio-url', true);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('pxl-archive-post'); ?>>
    <div class="content-inner-post">
        <?php if (has_post_thumbnail()) {
        ?>
            <div class="pxl-item--featured">
                <?php
                if (has_post_format('quote')) {
                    $quote_text = get_post_meta(get_the_ID(), 'featured-quote-text', true);
                    $quote_cite = get_post_meta(get_the_ID(), 'featured-quote-cite', true);
                ?>
                    <div class="format-wrap">
                        <div class="quote-inner">
                            <div class="content-top">
                                <div class="link-icon">
                                    <a href="<?php echo esc_url(get_permalink()); ?>" title="<?php the_title_attribute(); ?>">
                                        <span>“</span>
                                    </a>
                                </div>
                                <div class="content-right">
                                    <?php frameflow()->blog->get_archive_meta_2(); ?>
                                    <div class="quote-text">
                                        <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html($quote_text); ?></a>
                                    </div>
                                </div>
                            </div>

                            <?php
                            if (!empty($quote_cite)) {
                            ?>
                                <p class="quote-cite">
                                    <?php echo esc_html($quote_cite); ?>
                                </p>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                <?php
                } elseif (has_post_format('link')) {
                    $link_url = get_post_meta(get_the_ID(), 'featured-link-url', true);
                    $link_text = get_post_meta(get_the_ID(), 'featured-link-text', true);
                ?>
                    <div class="format-wrap">
                        <div class="link-inner">
                            <div class="content-top">
                                <div class="link-icon">
                                    <a href="<?php echo esc_url($link_url); ?>">
                                        <svg version="1.1" id="Glyph" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                            viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                            <path d="M192.5,240.5c20.7-21,56-23,79,0h0.2c6.4,6.4,11,14.2,13.8,22.6c6.7-1.1,12.6-4,17.1-8.5l22.1-21.9
                                    c-5-9.6-11.4-18.4-19-26.2c-42-41.1-106.9-40-147.2,0l-80,80c-40.6,40.9-40.6,106.3,0,147.2c40.9,40.6,106.3,40.6,147.2,0l75.4-75.4
                                    c-22,3.6-43.1,1.6-62.7-5.3l-46.7,46.6c-21.1,21.3-57.9,21.3-79.2,0c-21.8-21.8-21.8-57.3,0-79C113.9,318.9,197.8,235.1,192.5,240.5
                                    L192.5,240.5z" />
                                            <path d="M319.5,271.5c-21,21.3-56.3,22.7-79,0c-0.2,0-0.2,0-0.2,0c-6.4-6.4-11-14.2-13.8-22.6c-6.7,1.1-12.6,4-17.1,8.5l-22.1,21.9
                                    c5,9.6,11.4,18.4,19,26.2c42,41.1,106.9,40,147.2,0l80-80c40.6-40.9,40.6-106.3,0-147.2c-40.9-40.6-106.3-40.6-147.2,0L211,153.8
                                    c22-3.6,43.1-1.6,62.7,5.3l46.7-46.6c21.1-21.3,57.9-21.3,79.2,0c21.8,21.8,21.8,57.3,0,79C398.1,193.1,314.2,276.9,319.5,271.5
                                    L319.5,271.5z" />
                                        </svg>
                                    </a>
                                </div>
                                <div class="content-right">
                                    <?php frameflow()->blog->get_archive_meta_2(); ?>
                                    <h4 class="post-title">
                                        <a href="<?php echo esc_url(get_permalink()); ?>" title="<?php the_title_attribute(); ?>">
                                            <?php if (is_sticky()) { ?>
                                                <i class="bi-check"></i>
                                            <?php } ?>
                                            <?php the_title(); ?>
                                        </a>
                                    </h4>
                                </div>
                            </div>

                            <div class="link-text">
                                <a class="link-text" target="_blank" href="<?php echo esc_url($link_url); ?>"><?php echo esc_html($link_text); ?></a>
                            </div>
                        </div>
                    </div>
                    <?php
                } elseif (has_post_format('video')) {
                    if (has_post_thumbnail()) {
                    ?>
                        <div class="format-wrap">
                            <div class="pxl-item--image">
                                <a href="<?php echo esc_url(get_permalink()); ?>"><?php the_post_thumbnail('full'); ?></a>
                                <?php
                                if (!empty($featured_video)) {
                                ?>
                                    <div class="pxl-video-popup">
                                        <div class="content-inner">
                                            <a class="video-play-button pxl-action-popup" href="<?php echo esc_url($featured_video); ?>">
                                                <i class="bi-play-fill"></i>
                                            </a>
                                        </div>
                                    </div>
                                <?php
                                } ?>
                            </div>
                        </div>
                    <?php
                    }
                } elseif (!empty($audio_url) && has_post_format('audio')) {
                    global $wp_embed;
                    pxl_print_html($wp_embed->run_shortcode('[embed]' . $audio_url . '[/embed]'));
                } else {
                    ?>
                    <div class="pxl-item--image">
                        <a href="<?php echo esc_url(get_permalink()); ?>"><?php the_post_thumbnail('full'); ?></a>
                    </div>
                <?php
                }
                ?>

                <div class="pxl-item--date">
                    <h5 class="pxl-item--date-day"><?php echo get_the_date('d'); ?></h5>
                    <div class="pxl-item--date-line"></div>
                    <h6 class="pxl-item--date-month"><?php echo get_the_date('M'); ?></h6>
                </div>

                <div class="pxl-item--category">
                    <div class="pxl-item--category-inner">
                        <?php the_terms(get_the_ID(), 'category', '', ' '); ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php
        $show_archive_text_block = (!has_post_format('link') && !has_post_format('quote'))
            || !has_post_thumbnail();
        if ($show_archive_text_block) {
        ?>
            <div class="pxl-item--content">
                <h4 class="pxl-item--title">
                    <a href="<?php echo esc_url(get_permalink()); ?>" title="<?php the_title_attribute(); ?>">
                        <?php if (is_sticky()) { ?>
                            <i class="bi-check"></i>
                        <?php } ?>
                        <?php the_title(); ?>
                    </a>
                </h4>
                <?php if ($archive_excerpt) { ?>
                    <div class="pxl-item--excerpt">
                        <?php
                        frameflow()->blog->get_excerpt(60);
                        wp_link_pages(array(
                            'before'      => '<div class="page-links">',
                            'after'       => '</div>',
                            'link_before' => '<span>',
                            'link_after'  => '</span>',
                        ));
                        ?>
                    </div>
                <?php } ?>
                <?php
                if (!empty($archive_readmore_text)) {
                ?>
                    <a class="pxl-item--readmore" href="<?php echo esc_url(get_permalink()); ?>">
                        <span class="btn--text">
                            <?php echo esc_html($archive_readmore_text); ?>
                        </span>
                        <div class="pxl-item--readmore-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="7" height="13" viewBox="0 0 7 13" fill="none">
                                <path d="M6.67521 6.67521L1.36271 11.9877C1.21301 12.1374 1.00997 12.2215 0.798257 12.2215C0.586546 12.2215 0.383506 12.1374 0.233804 11.9877C0.0841017 11.838 1.57737e-09 11.635 0 11.4233C-1.57737e-09 11.2115 0.0841017 11.0085 0.233804 10.8588L4.98251 6.11142L0.235132 1.36271C0.161007 1.28859 0.102208 1.20059 0.0620917 1.10374C0.0219755 1.00689 0.0013279 0.903086 0.0013279 0.798257C0.0013279 0.693429 0.0219755 0.589626 0.0620917 0.492777C0.102208 0.395928 0.161007 0.307929 0.235132 0.233804C0.309257 0.159679 0.397257 0.10088 0.494106 0.0607638C0.590955 0.0206476 0.694757 -7.81034e-10 0.799585 0C0.904414 7.81035e-10 1.00822 0.0206476 1.10507 0.0607638C1.20191 0.10088 1.28991 0.159679 1.36404 0.233804L6.67654 5.5463C6.75074 5.62042 6.80958 5.70846 6.84969 5.80537C6.88979 5.90228 6.91038 6.00615 6.91025 6.11103C6.91013 6.21591 6.8893 6.31974 6.84897 6.41655C6.80864 6.51337 6.74959 6.60127 6.67521 6.67521Z" fill="currentColor"/>
                            </svg>
                        </div>
                    </a>
                <?php } ?>
            </div>
        <?php
        }
        ?>
    </div>
</article>