<?php

/**
 * @package Case-Themes
 */

get_header(); ?>
<div class="error404--wrapper">
    <div class="error404--image error404--col">
        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/404-image.webp'); ?>" alt="404 Error Background Image">
    </div>
    <div class="error404--content error404--col">
        <h1 class="error404--title wow fadeInUp">
            <?php echo esc_html__('Looks like this page isn\'t available.', 'frameflow'); ?>
        </h1>
        <p class="error404--desc wow fadeInUp" data-wow-delay=".2s">
            <?php echo esc_html__('Looks like you\'re lost. The page you\'re looking for doesn\'t exist or has been moved.', 'frameflow'); ?>
        </p>
        <a class="error404--button btn btn-default pxl-icon--right wow fadeInUp" data-wow-delay=".4s" href="<?php echo esc_url(home_url('/')); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M12.9722 9.59692L7.34717 15.2219C7.18866 15.3804 6.97367 15.4695 6.74951 15.4695C6.52535 15.4695 6.31036 15.3804 6.15185 15.2219C5.99335 15.0634 5.9043 14.8484 5.9043 14.6243C5.9043 14.4001 5.99335 14.1851 6.15185 14.0266L11.1799 8.99997L6.15326 3.97192C6.07478 3.89344 6.01252 3.80026 5.97004 3.69772C5.92757 3.59517 5.9057 3.48526 5.9057 3.37427C5.9057 3.26327 5.92757 3.15336 5.97004 3.05082C6.01252 2.94827 6.07478 2.8551 6.15326 2.77661C6.23175 2.69812 6.32492 2.63587 6.42747 2.59339C6.53001 2.55091 6.63992 2.52905 6.75092 2.52905C6.86191 2.52905 6.97182 2.55091 7.07437 2.59339C7.17691 2.63587 7.27009 2.69812 7.34857 2.77661L12.9736 8.40161C13.0521 8.48009 13.1144 8.57331 13.1569 8.67592C13.1994 8.77853 13.2212 8.88851 13.221 8.99956C13.2209 9.11061 13.1989 9.22054 13.1561 9.32305C13.1134 9.42556 13.0509 9.51863 12.9722 9.59692Z" fill="white" fill-opacity="0.25"/></svg>
            <div class="btn-text-wrap">
                <span><?php echo esc_html__('Back to Hompage', 'frameflow'); ?></span>
                <span><?php echo esc_html__('Back to Hompage', 'frameflow'); ?></span>
            </div>
        </a>
    </div>
</div>
<?php
get_footer();
