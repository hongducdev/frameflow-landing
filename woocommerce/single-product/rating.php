<?php
/**
 * Single Product Rating
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

if (!defined('ABSPATH')) {
    exit;
}

global $product;

if (!wc_review_ratings_enabled()) {
    return;
}

$review_count = (int) $product->get_review_count();
$average = (float) $product->get_average_rating();
$average_display =
    $review_count > 0 ? wc_format_decimal($average, 1) : '0';
$rating_for_stars = $review_count > 0 ? $average : 0;

/* translators: %s: rating */
$label = sprintf(
    __('Rated %s out of 5', 'woocommerce'),
    $average_display,
);
?>
<div class="woocommerce-product-rating<?php echo $review_count < 1
    ? ' is-empty'
    : ''; ?>">
	<div class="star-rating" role="img" aria-label="<?php echo esc_attr(
     $label,
 ); ?>">
		<span style="width:<?php echo esc_attr(
      ($rating_for_stars / 5) * 100,
  ); ?>%">
			<?php
   /* translators: %s: rating */
   printf(
       esc_html__('Rated %s out of 5', 'woocommerce'),
       '<strong class="rating">' . esc_html($average_display) . '</strong>',
   );
   ?>
		</span>
	</div>
	<span class="woocommerce-product-rating__average"><?php echo esc_html(
     $average_display,
 ); ?></span>
	<?php if (comments_open()): ?>
		<a href="#reviews" class="woocommerce-review-link" rel="nofollow"><?php echo $review_count > 0
      ? sprintf(
          /* translators: %d: review count */
          esc_html__('( %d Review )', 'frameflow'),
          $review_count,
      )
      : esc_html__('( 0 review )', 'frameflow'); ?></a>
	<?php else: ?>
		<span class="woocommerce-review-link"><?php echo $review_count > 0
      ? sprintf(
          /* translators: %d: review count */
          esc_html__('( %d Review )', 'frameflow'),
          $review_count,
      )
      : esc_html__('( 0 review )', 'frameflow'); ?></span>
	<?php endif; ?>
</div>
