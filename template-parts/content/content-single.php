<?php

/**
 * Template part for displaying posts in loop
 *
 * @package Case-Themes
 */

if (has_post_thumbnail()) {
    $content_inner_cls = 'single-post-inner has-post-thumbnail';
    $meta_class    = '';
} else {
    $content_inner_cls = 'single-post-inner  no-post-thumbnail';
    $meta_class = '';
}

if (class_exists('\Elementor\Plugin') && \Elementor\Plugin::$instance->documents->get($id)->is_built_with_elementor()) {
    $post_content_classes = 'single-elementor-content';
} else {
    $post_content_classes = '';
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('pxl-single-post'); ?>>
    <div class="<?php echo esc_attr($content_inner_cls); ?>">
        <div class="post-content overflow-hidden">
            <div class="content-inner clearfix <?php echo esc_attr($post_content_classes); ?>">
                <?php
                the_content();
                ?></div>
            <div class="<?php echo trim(implode(' ', ['navigation page-links clearfix empty-none'])); ?>">
                <?php
                wp_link_pages();
                ?></div>
        </div>
        <?php
        ob_start();
        frameflow()->blog->get_post_tags();
        $tags_html = trim(ob_get_clean());

        if (!empty($tags_html)) :
        ?>
            <div class="post-tags-share d-flex">
                <div class="post-tags-wrap">
                    <?php echo wp_kses_post($tags_html); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <?php frameflow()->blog->get_post_nav(); ?>
</article>