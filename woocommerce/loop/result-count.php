<?php
/**
 * Result Count
 *
 * Always show "Showing X–Y of Z results" (never "Showing all Z results").
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 10.8.0
 */

defined('ABSPATH') || exit;

if (!isset($orderedby)) {
    $orderedby = '';
}
?>
<p class="woocommerce-result-count" role="status" aria-relevant="all" <?php echo empty($orderedby) || 1 === intval($total) ? '' : 'data-is-sorted-by="true"'; ?>>
	<?php
 // phpcs:disable WordPress.Security
 if (1 === intval($total)) {
     _e('Showing the single result', 'woocommerce');
 } else {
     $per_page_int = (int) $per_page;
     if (-1 === $per_page_int || $per_page_int < 1) {
         $first = 1;
         $last = (int) $total;
     } else {
         $first = $per_page_int * (int) $current - $per_page_int + 1;
         $last = min((int) $total, $per_page_int * (int) $current);
     }
     $orderedby_placeholder = empty($orderedby) ? '%4$s' : '<span class="screen-reader-text">%4$s</span>';
     /* translators: 1: first result 2: last result 3: total results 4: sorted by */
     printf(
         _nx(
             'Showing %1$d&ndash;%2$d of %3$d result',
             'Showing %1$d&ndash;%2$d of %3$d results',
             $total,
             'with first and last result',
             'woocommerce',
         ) . $orderedby_placeholder,
         $first,
         $last,
         $total,
         esc_html($orderedby),
     );
 }
 // phpcs:enable WordPress.Security
 ?>
</p>
