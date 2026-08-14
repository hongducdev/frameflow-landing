<?php
/**
 * The template to display the reviewers meta data (name, verified owner, review date)
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

global $comment;
$verified = wc_review_is_from_verified_owner($comment->comment_ID);

if ('0' === $comment->comment_approved) { ?>

	<p class="meta">
		<em class="woocommerce-review__awaiting-approval">
			<?php esc_html_e('Your review is awaiting approval', 'woocommerce'); ?>
		</em>
	</p>

<?php } else { ?>

	<p class="meta">
		<strong class="woocommerce-review__author"><?php comment_author(); ?></strong>
		<?php
  if (
      'yes' === get_option('woocommerce_review_rating_verification_label') &&
      $verified
  ) {
      echo '<em class="woocommerce-review__verified verified">(' .
          esc_attr__('verified owner', 'woocommerce') .
          ')</em> ';
  }

  $reviewed_at = sprintf(
      /* translators: 1: time 2: date */
      __('Reviewed at %1$s on %2$s', 'frameflow'),
      get_comment_time(),
      get_comment_date(),
  );
  ?>
		<time class="woocommerce-review__published-date" datetime="<?php echo esc_attr(
      get_comment_date('c'),
  ); ?>"><?php echo esc_html($reviewed_at); ?></time>
	</p>

	<?php }
