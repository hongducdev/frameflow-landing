<?php

//Custom products layout on archive page
add_filter('loop_shop_columns', 'frameflow_loop_shop_columns', 20);
function frameflow_loop_shop_columns()
{
    $columns = isset($_GET['product-column'])
        ? sanitize_text_field($_GET['product-column'])
        : 3;
    return $columns;
}

// Change number of products that are displayed per page (shop page)
add_filter('loop_shop_per_page', 'frameflow_loop_shop_per_page', 20);
function frameflow_loop_shop_per_page($limit)
{
    $limit = isset($_GET['product-limit'])
        ? sanitize_text_field($_GET['product-limit'])
        : 12;
    return $limit;
}

/* Remove result count & product ordering & item product category..... */
function frameflow_cwoocommerce_remove_function()
{
    remove_action(
        'woocommerce_after_shop_loop_item',
        'woocommerce_template_loop_add_to_cart',
        10,
        0,
    );
    remove_action(
        'woocommerce_after_shop_loop_item_title',
        'woocommerce_template_loop_rating',
        5,
        0,
    );
    remove_action(
        'woocommerce_after_shop_loop_item_title',
        'woocommerce_template_loop_price',
        10,
        0,
    );
    remove_action(
        'woocommerce_shop_loop_item_title',
        'woocommerce_template_loop_product_title',
        10,
        0,
    );
    remove_action(
        'woocommerce_before_shop_loop_item_title',
        'woocommerce_template_loop_product_thumbnail',
        10,
        0,
    );
    remove_action(
        'woocommerce_before_shop_loop_item_title',
        'woocommerce_show_product_loop_sale_flash',
        10,
    );
    remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
    remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);

    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
    remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
}
add_action('init', 'frameflow_cwoocommerce_remove_function');

/* Product Category - Shop top bar */
add_action('woocommerce_before_shop_loop', 'frameflow_woocommerce_nav_top', 2);
function frameflow_woocommerce_nav_top()
{
    ?>
	<div class="woocommerce-topbar">
		<div class="woocommerce-result-count">
			<?php woocommerce_result_count(); ?>
		</div>
		<div class="woocommerce-topbar-ordering">
			<?php woocommerce_catalog_ordering(); ?>
		</div>
	</div>
<?php
}

add_filter('woocommerce_after_shop_loop_item', 'frameflow_woocommerce_product');
function frameflow_woocommerce_product()
{
    global $product;
    if (!($product instanceof WC_Product)) {
        return;
    }

    $product_id = $product->get_id();
    $in_stock = $product->is_in_stock();
    ?>
	<div class="woocommerce-product-inner">
		<div class="woocommerce-product-header">
			<?php woocommerce_show_product_loop_sale_flash(); ?>
			<a class="woocommerce-product-details" href="<?php the_permalink(); ?>">
				<?php if (has_post_thumbnail()) {
        woocommerce_template_loop_product_thumbnail();
    } else {
        echo wc_placeholder_img();
    } ?>
			</a>
			<?php if ($in_stock): ?>
				<div class="woocommerce-product--buttons">
					<?php if (class_exists('WPCleverWoosw')): ?>
						<div class="woocommerce-wishlist">
							<?php echo do_shortcode('[woosw id="' . esc_attr($product_id) . '"]'); ?>
						</div>
					<?php endif; ?>
					<?php if (class_exists('WPCleverWoosc')): ?>
						<div class="woocommerce-compare">
							<?php echo do_shortcode('[woosc id="' . esc_attr($product_id) . '"]'); ?>
						</div>
					<?php endif; ?>
					<div class="woocommerce-add-to-cart">
						<?php woocommerce_template_loop_add_to_cart(); ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
		<div class="woocommerce-product-content">
			<h4 class="woocommerce-product--title">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h4>
			<?php woocommerce_template_loop_price(); ?>
			<?php frameflow_loop_render_color_swatches($product); ?>
		</div>
	</div>
	<?php
}

/**
 * Request-cached available variations (shop loop hits this twice per card).
 *
 * @param WC_Product_Variable $product Product.
 * @return array
 */
function frameflow_loop_get_available_variations($product)
{
    static $cache = [];
    $id = $product->get_id();
    if (!isset($cache[$id])) {
        $cache[$id] = $product->get_available_variations();
    }
    return $cache[$id];
}

/**
 * Color attribute taxonomy for loop swatches (WVS color type, else pa_color).
 *
 * @param WC_Product $product Product.
 * @return string Taxonomy name or empty.
 */
function frameflow_loop_get_color_attribute($product)
{
    if (!$product || !$product->is_type('variable')) {
        return '';
    }

    $attributes = $product->get_variation_attributes();
    if (empty($attributes)) {
        return '';
    }

    if (function_exists('woo_variation_swatches')) {
        $frontend = woo_variation_swatches()->get_frontend();
        foreach (array_keys($attributes) as $taxonomy) {
            $attr_tax = $frontend->get_attribute_taxonomy_by_name($taxonomy);
            if ($attr_tax && $frontend->is_color_attribute($attr_tax)) {
                return $taxonomy;
            }
        }
    }

    return isset($attributes['pa_color']) ? 'pa_color' : '';
}

/**
 * Slim variation payload for loop JS (id, attrs, stock, image).
 *
 * @param WC_Product_Variable $product Product.
 * @return array
 */
function frameflow_loop_get_variations_payload($product)
{
    $payload = [];

    foreach (frameflow_loop_get_available_variations($product) as $variation) {
        if (empty($variation['variation_id'])) {
            continue;
        }

        $image = [];
        if (!empty($variation['image']['src'])) {
            $image = [
                'src' => $variation['image']['src'],
                'srcset' => $variation['image']['srcset'] ?? '',
                'sizes' => $variation['image']['sizes'] ?? '',
                'alt' => $variation['image']['alt'] ?? '',
            ];
        }

        $payload[] = [
            'variation_id' => (int) $variation['variation_id'],
            'attributes' => $variation['attributes'],
            'is_in_stock' => !empty($variation['is_in_stock']),
            'is_purchasable' => !empty($variation['is_purchasable']),
            'image' => $image,
        ];
    }

    return $payload;
}

/**
 * Resolve variation ID from selected attrs + defaults / first in-stock match.
 *
 * @param WC_Product_Variable $product Product.
 * @param array               $selected_attrs Map of attribute_name => slug.
 * @return int Variation ID or 0.
 */
function frameflow_loop_resolve_variation_id($product, $selected_attrs = [])
{
    if (!$product || !$product->is_type('variable')) {
        return 0;
    }

    $wanted = [];
    foreach ($product->get_default_attributes() as $key => $value) {
        $wanted['attribute_' . sanitize_title($key)] = $value;
    }
    foreach ($selected_attrs as $key => $value) {
        $attr_key = strpos($key, 'attribute_') === 0 ? $key : 'attribute_' . sanitize_title($key);
        $wanted[$attr_key] = $value;
    }

    foreach (frameflow_loop_get_available_variations($product) as $variation) {
        if (
            empty($variation['variation_id']) ||
            empty($variation['is_purchasable']) ||
            empty($variation['is_in_stock'])
        ) {
            continue;
        }

        $ok = true;
        foreach ($wanted as $attr_key => $attr_val) {
            if ($attr_val === '' || $attr_val === null) {
                continue;
            }
            $var_val = $variation['attributes'][$attr_key] ?? '';
            if ($var_val !== '' && $var_val !== $attr_val) {
                $ok = false;
                break;
            }
        }

        if ($ok) {
            return (int) $variation['variation_id'];
        }
    }

    return 0;
}

/**
 * Default selected color slug for a variable product.
 *
 * @param WC_Product $product Product.
 * @param string     $color_attr Taxonomy.
 * @return string
 */
function frameflow_loop_default_color_value($product, $color_attr)
{
    $defaults = $product->get_default_attributes();
    if (!empty($defaults[$color_attr])) {
        return $defaults[$color_attr];
    }

    $short = str_replace('pa_', '', $color_attr);
    if (!empty($defaults[$short])) {
        return $defaults[$short];
    }

    $options = $product->get_variation_attributes()[$color_attr] ?? [];
    return $options ? (string) reset($options) : '';
}

/**
 * Render color swatches under loop product content.
 *
 * @param WC_Product $product Product.
 */
function frameflow_loop_render_color_swatches($product)
{
    if (!$product || !$product->is_type('variable')) {
        return;
    }

    $color_attr = frameflow_loop_get_color_attribute($product);
    if (!$color_attr) {
        return;
    }

    $options = $product->get_variation_attributes()[$color_attr] ?? [];
    if (!$options) {
        return;
    }

    $default_color = frameflow_loop_default_color_value($product, $color_attr);
    $attr_name = 'attribute_' . sanitize_title($color_attr);
    $terms = wc_get_product_terms($product->get_id(), $color_attr, ['fields' => 'all']);
    $term_map = [];
    foreach ($terms as $term) {
        $term_map[$term->slug] = $term;
    }

    $wvs_frontend = function_exists('woo_variation_swatches')
        ? woo_variation_swatches()->get_frontend()
        : null;
    ?>
	<div class="pxl-loop-swatches" data-product_id="<?php echo esc_attr(
     $product->get_id(),
 ); ?>" data-color_attribute="<?php echo esc_attr($attr_name); ?>" data-variations="<?php echo esc_attr(wp_json_encode(frameflow_loop_get_variations_payload($product))); ?>">
		<?php foreach ($options as $option):

      $term = $term_map[$option] ?? null;
      $label = $term ? $term->name : $option;
      $color = '';
      if ($term) {
          $color = $wvs_frontend
              ? $wvs_frontend->get_product_attribute_color($term)
              : get_term_meta($term->term_id, 'product_attribute_color', true);
      }
      $selected_class = $option === $default_color ? ' selected' : '';
      $style = $color ? 'background-color:' . esc_attr($color) . ';' : '';
      ?>
			<button type="button" class="pxl-loop-swatch<?php echo esc_attr(
       $selected_class,
   ); ?>" data-attribute_name="<?php echo esc_attr($attr_name); ?>" data-value="<?php echo esc_attr(
    $option,
); ?>" style="<?php echo esc_attr($style); ?>" title="<?php echo esc_attr(
    $label,
); ?>" aria-label="<?php echo esc_attr($label); ?>"></button>
		<?php
  endforeach; ?>
	</div>
	<?php
}

/* Removes the "shop" title on the main shop page */
function frameflow_hide_page_title()
{
    return false;
}
add_filter('woocommerce_show_page_title', 'frameflow_hide_page_title');

/* Replace text Onsale — archive: SALE; single: SALE OFF - X% */
add_filter('woocommerce_sale_flash', 'frameflow_custom_sale_text', 10, 3);
function frameflow_custom_sale_text($text, $post, $_product)
{
    if (!($_product instanceof WC_Product)) {
        return $text;
    }

    if (is_product()) {
        $pct = frameflow_get_sale_percentage($_product);
        if ($pct > 0) {
            return '<span class="onsale">' .
                sprintf(
                    /* translators: %d: discount percentage */
                    esc_html__('Sale off - %d%%', 'frameflow'),
                    $pct,
                ) .
                '</span>';
        }
        return '<span class="onsale">' . esc_html__('Sale off', 'frameflow') . '</span>';
    }

    return '<span class="onsale">' . esc_html__('SALE', 'frameflow') . '</span>';
}

/**
 * Best-effort sale % for simple/variable products.
 *
 * @param WC_Product $product Product.
 * @return int
 */
function frameflow_get_sale_percentage($product)
{
    if ($product->is_type('variable')) {
        $prices = $product->get_variation_prices(true);
        $regulars = $prices['regular_price'] ?? [];
        $sales = $prices['sale_price'] ?? [];
        $max = 0;
        foreach ($regulars as $id => $regular) {
            $regular = (float) $regular;
            $sale = isset($sales[$id]) ? (float) $sales[$id] : $regular;
            if ($regular > 0 && $sale < $regular) {
                $max = max($max, (int) round((($regular - $sale) / $regular) * 100));
            }
        }
        return $max;
    }

    $regular = (float) $product->get_regular_price();
    $sale = (float) $product->get_sale_price();
    if ($regular > 0 && $sale > 0 && $sale < $regular) {
        return (int) round((($regular - $sale) / $regular) * 100);
    }
    return 0;
}

/* Sale flash lives in summary (gallery badge hidden via CSS) */
add_action('woocommerce_single_product_summary', 'woocommerce_show_product_sale_flash', 3);

add_action(
    'woocommerce_before_single_product_summary',
    'frameflow_woocommerce_single_summer_start',
    0,
);
function frameflow_woocommerce_single_summer_start()
{
    ?>
	<?php echo '<div class="woocommerce-summary-wrap row">'; ?>
<?php
} /* Product Single: Gallery wrappers */
add_action(
    'woocommerce_before_single_product_summary',
    'frameflow_woocommerce_single_gallery_start',
    0,
);
function frameflow_woocommerce_single_gallery_start()
{
    ?>
	<?php echo '<div class="woocommerce-gallery col-xl-6 col-lg-6 col-md-6"><div class="woocommerce-gallery-inner">'; ?>
<?php
}
add_action(
    'woocommerce_before_single_product_summary',
    'frameflow_woocommerce_single_gallery_end',
    30,
);
function frameflow_woocommerce_single_gallery_end()
{
    ?>
	<?php echo '</div></div><div class="woocommerce-summary-inner col-xl-6 col-lg-6 col-md-6">'; ?>
<?php
}

add_action(
    'woocommerce_after_single_product_summary',
    'frameflow_woocommerce_single_summer_end',
    1,
);
function frameflow_woocommerce_single_summer_end()
{
    echo '</div></div>';
}

remove_action(
    'woocommerce_after_single_product_summary',
    'woocommerce_output_product_data_tabs',
    10,
);
remove_action(
    'woocommerce_after_single_product_summary',
    'woocommerce_upsell_display',
    15,
);
remove_action(
    'woocommerce_after_single_product_summary',
    'woocommerce_output_related_products',
    20,
);

add_action(
    'woocommerce_after_single_product_summary',
    'frameflow_woocommerce_single_reviews',
    10,
);
function frameflow_woocommerce_single_reviews()
{
    if (!comments_open()) {
        return;
    }
    echo '<div class="pxl-product-reviews">';
    comments_template();
    echo '</div>';
}

add_filter('woocommerce_reviews_title', 'frameflow_woocommerce_reviews_title', 10, 3);
function frameflow_woocommerce_reviews_title($reviews_title, $count, $product)
{
    return esc_html__('Reviews', 'frameflow');
}

add_filter(
    'woocommerce_product_review_comment_form_args',
    'frameflow_product_review_comment_form_args',
);
function frameflow_product_review_comment_form_args($comment_form)
{
    $comment_form['title_reply'] = esc_html__(
        'Submit Your Review',
        'frameflow',
    );
    $comment_form['label_submit'] = esc_html__(
        'Submit Your Review',
        'frameflow',
    );
    $comment_form['comment_notes_before'] =
        '<p class="comment-notes"><span id="email-notes">' .
        esc_html__(
            'Your email will remain confidential. Required fields are marked *',
            'frameflow',
        ) .
        '</span></p>';

    if (!empty($comment_form['comment_field'])) {
        $comment_form['comment_field'] = preg_replace(
            '/(<label for="comment">)(.*?)(<\/label>)/s',
            '$1' .
                esc_html__('Enter Your Review', 'frameflow') .
                '&nbsp;<span class="required">*</span>$3',
            $comment_form['comment_field'],
            1,
        );
    }

    return $comment_form;
}

add_filter('comment_form_field_cookies', 'frameflow_product_review_cookies_field');
function frameflow_product_review_cookies_field($field)
{
    if (!is_product()) {
        return $field;
    }

    $consent_id = 'wp-comment-cookies-consent';
    return '<p class="comment-form-cookies-consent"><input id="' .
        esc_attr($consent_id) .
        '" name="wp-comment-cookies-consent" type="checkbox" value="yes" /> <label for="' .
        esc_attr($consent_id) .
        '">' .
        esc_html__(
            'Save my name, email, and website in this browser for the next time I review.',
            'frameflow',
        ) .
        '</label></p>';
}

/* Ajax update cart item fragments */ add_filter(
    'woocommerce_add_to_cart_fragments',
    'frameflow_woocommerce_add_to_cart_fragments',
    10,
    1,
);
function frameflow_woocommerce_add_to_cart_fragments($fragments)
{
    ob_start(); ?>
	<span class="header-count cart_total"><?php echo WC()->cart->cart_contents_count; ?></span>
	<?php
 $fragments['.cart_total'] = ob_get_clean();
 $fragments['.mini-cart-count'] =
     '<span class="mini-cart-total mini-cart-count">' . WC()->cart->cart_contents_count . '</span>';
 ob_start();
 ?>
	<span class="widget_cart_counter">(<?php echo sprintf(
     _n('%d item', '%d items', WC()->cart->cart_contents_count, 'frameflow'),
     WC()->cart->cart_contents_count,
 ); ?>)</span>
	<?php
 $fragments['span.widget_cart_counter'] = ob_get_clean();
 ob_start();
 ?>
	<span class="widget_cart_counter_header"><?php echo WC()->cart->cart_contents_count; ?></span>
<?php
$fragments['span.widget_cart_counter_header'] = ob_get_clean();
$fragments['div.widget_shopping_cart_footer'] = frameflow_get_cart_sidebar_footer_html();
return $fragments;
}

function frameflow_get_cart_sidebar_footer_html()
{
    if (!function_exists('WC') || !WC()->cart || WC()->cart->is_empty()) {
        return '<div class="widget_shopping_cart_footer is-empty" hidden></div>';
    }
    ob_start();
    ?>
	<div class="widget_shopping_cart_footer">
		<p class="total"><strong><?php esc_html_e(
      'Total',
      'frameflow',
  ); ?>:</strong> <?php echo WC()->cart->get_cart_subtotal(); ?></p>
		<?php do_action('woocommerce_widget_shopping_cart_before_buttons'); ?>
		<p class="buttons">
			<a href="<?php echo esc_url(
       wc_get_cart_url(),
   ); ?>" class="btn btn-shop wc-forward"><?php esc_html_e(
    'View Cart',
    'frameflow',
); ?><span class="btn-icon-left">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="13" viewBox="0 0 16 13" fill="none">
					<path d="M9.6 12.7999C9.39526 12.7999 9.19053 12.7219 9.03432 12.5657C8.7219 12.2532 8.7219 11.7467 9.03432 11.4343L13.2686 7.19999H0.800009C0.358159 7.19999 0 6.8418 0 6.39998C0 5.95813 0.358159 5.59997 0.800009 5.59997H13.2686L9.03432 1.36567C8.7219 1.05326 8.7219 0.546725 9.03432 0.234311C9.3467 -0.0781035 9.8533 -0.0781035 10.1657 0.234311L15.7657 5.8343L15.7674 5.83604C15.7677 5.83632 15.768 5.83667 15.7683 5.83695C15.7686 5.83723 15.7688 5.83751 15.7691 5.83778C15.7695 5.8382 15.7699 5.83862 15.7703 5.83904C15.7705 5.83918 15.7706 5.83932 15.7708 5.83949C15.7713 5.84005 15.7718 5.84057 15.7724 5.84109L15.7724 5.84116C15.8444 5.91483 15.8992 5.9989 15.937 6.08847C15.9371 6.08872 15.9372 6.089 15.9373 6.08924C15.9374 6.08952 15.9376 6.08983 15.9377 6.09011C15.9778 6.18543 15.9999 6.29015 15.9999 6.40002C15.9999 6.50989 15.9778 6.61461 15.9377 6.70993C15.9376 6.71017 15.9374 6.71052 15.9373 6.7108C15.9372 6.71104 15.9371 6.71128 15.937 6.71153C15.8992 6.80114 15.8444 6.88521 15.7724 6.95888L15.7724 6.95891C15.7718 6.95947 15.7713 6.95999 15.7708 6.96051C15.7707 6.96065 15.7705 6.96079 15.7703 6.96096C15.7699 6.96142 15.7695 6.9618 15.7691 6.96225C15.7688 6.9625 15.7686 6.96281 15.7683 6.96305C15.768 6.96333 15.7677 6.96368 15.7674 6.96396C15.7668 6.96455 15.7662 6.96514 15.7657 6.9657L10.1657 12.5657C10.0095 12.7219 9.80474 12.7999 9.6 12.7999Z" fill="#1A1A1A"></path>
				</svg>
			</span></a>
			<a href="<?php echo esc_url(
       wc_get_checkout_url(),
   ); ?>" class="btn checkout wc-forward"><?php esc_html_e(
    'Checkout',
    'frameflow',
); ?><span class="btn-icon-left">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="13" viewBox="0 0 16 13" fill="none">
					<path d="M9.6 12.7999C9.39526 12.7999 9.19053 12.7219 9.03432 12.5657C8.7219 12.2532 8.7219 11.7467 9.03432 11.4343L13.2686 7.19999H0.800009C0.358159 7.19999 0 6.8418 0 6.39998C0 5.95813 0.358159 5.59997 0.800009 5.59997H13.2686L9.03432 1.36567C8.7219 1.05326 8.7219 0.546725 9.03432 0.234311C9.3467 -0.0781035 9.8533 -0.0781035 10.1657 0.234311L15.7657 5.8343L15.7674 5.83604C15.7677 5.83632 15.768 5.83667 15.7683 5.83695C15.7686 5.83723 15.7688 5.83751 15.7691 5.83778C15.7695 5.8382 15.7699 5.83862 15.7703 5.83904C15.7705 5.83918 15.7706 5.83932 15.7708 5.83949C15.7713 5.84005 15.7718 5.84057 15.7724 5.84109L15.7724 5.84116C15.8444 5.91483 15.8992 5.9989 15.937 6.08847C15.9371 6.08872 15.9372 6.089 15.9373 6.08924C15.9374 6.08952 15.9376 6.08983 15.9377 6.09011C15.9778 6.18543 15.9999 6.29015 15.9999 6.40002C15.9999 6.50989 15.9778 6.61461 15.9377 6.70993C15.9376 6.71017 15.9374 6.71052 15.9373 6.7108C15.9372 6.71104 15.9371 6.71128 15.937 6.71153C15.8992 6.80114 15.8444 6.88521 15.7724 6.95888L15.7724 6.95891C15.7718 6.95947 15.7713 6.95999 15.7708 6.96051C15.7707 6.96065 15.7705 6.96079 15.7703 6.96096C15.7699 6.96142 15.7695 6.9618 15.7691 6.96225C15.7688 6.9625 15.7686 6.96281 15.7683 6.96305C15.768 6.96333 15.7677 6.96368 15.7674 6.96396C15.7668 6.96455 15.7662 6.96514 15.7657 6.9657L10.1657 12.5657C10.0095 12.7219 9.80474 12.7999 9.6 12.7999Z" fill="#1A1A1A"></path>
				</svg>
			</span></a>
		</p>
	</div>
	<?php return ob_get_clean();
}

add_filter('wc_add_to_cart_message_html', '__return_empty_string');

/**
 * Silence noisy cart-page success flashes ("Cart updated.", "X removed.") —
 * qty/remove update via AJAX; no full-page notice banner.
 */
add_filter('woocommerce_add_success', 'frameflow_silence_cart_ajax_notices');
function frameflow_silence_cart_ajax_notices($message)
{
    if (!function_exists('is_cart') || !is_cart()) {
        return $message;
    }
    if ($message === __('Cart updated.', 'woocommerce')) {
        return '';
    }
    $plain = wp_strip_all_tags($message);
    if (
        false !== strpos($message, 'restore-item') ||
        preg_match('/\bremoved\.?\s*$/i', $plain)
    ) {
        return '';
    }
    return $message;
}

add_action('woocommerce_single_product_summary', 'frameflow_woocommerce_sg_product_rating', 10);
function frameflow_woocommerce_sg_product_rating()
{
    ?>
	<div class="woocommerce-sg-product-rating">
		<?php woocommerce_template_single_rating(); ?>
	</div>
<?php
}

add_action('woocommerce_single_product_summary', 'frameflow_woocommerce_sg_product_price', 15);
function frameflow_woocommerce_sg_product_price()
{
    $shipping_url = apply_filters('frameflow_product_shipping_note_url', '#');
    ?>
	<div class="woocommerce-sg-product-price">
		<?php woocommerce_template_single_price(); ?>
		<p class="woocommerce-sg-product-taxnote">
			<?php echo esc_html__('Tax included.', 'frameflow'); ?>
			<a href="<?php echo esc_url($shipping_url); ?>"><?php echo esc_html__(
    'Shipping',
    'frameflow',
); ?></a>
			<?php echo esc_html__('calculated at checkout.', 'frameflow'); ?>
		</p>
	</div>
<?php
}

add_action('woocommerce_single_product_summary', 'frameflow_woocommerce_sg_product_stock', 16);
function frameflow_woocommerce_sg_product_stock()
{
    global $product;
    if (!($product instanceof WC_Product)) {
        return;
    }

    $in_stock = $product->is_in_stock();
    ?>
	<div class="woocommerce-sg-product-stock <?php echo $in_stock ? 'is-in-stock' : 'is-out-of-stock'; ?>">
		<span class="woocommerce-sg-product-stock__dot" aria-hidden="true"></span>
		<p class="woocommerce-sg-product-stock__text">
			<?php if ($in_stock): ?>
				<span class="woocommerce-sg-product-stock__label"><?php echo esc_html__(
        'In Stock and ready to ship',
        'frameflow',
    ); ?></span>
			<?php else: ?>
				<span class="woocommerce-sg-product-stock__label"><?php echo esc_html__(
        'Out of stock',
        'frameflow',
    ); ?></span>
			<?php endif; ?>
		</p>
	</div>
<?php
}

/* Excerpt after variations / before qty — matches Figma */
add_action('woocommerce_before_add_to_cart_button', 'frameflow_woocommerce_sg_product_excerpt', 5);
function frameflow_woocommerce_sg_product_excerpt()
{
    if (!is_product()) {
        return;
    }
    ?>
	<div class="woocommerce-sg-product-excerpt">
		<?php woocommerce_template_single_excerpt(); ?>
	</div>
<?php
}

add_action('woocommerce_before_add_to_cart_quantity', 'frameflow_woocommerce_sg_qty_label', 5);
function frameflow_woocommerce_sg_qty_label()
{
    if (!is_product()) {
        return;
    }
    echo '<span class="woocommerce-sg-qty-label">' . esc_html__('Quantity:', 'frameflow') . '</span>';
}

add_action('woocommerce_after_add_to_cart_button', 'frameflow_woocommerce_sg_buy_now', 20);
function frameflow_woocommerce_sg_buy_now()
{
    if (!is_product()) {
        return;
    }
    ?>
	<button type="submit" name="pxl_buy_now" value="1" class="pxl-buy-now-button button alt">
		<?php echo esc_html__('Buy it Now', 'frameflow'); ?>
	</button>
	<?php
}

add_filter('woocommerce_add_to_cart_redirect', 'frameflow_buy_now_redirect');
function frameflow_buy_now_redirect($url)
{
    if (!empty($_REQUEST['pxl_buy_now'])) {
        return wc_get_checkout_url();
    }
    return $url;
}

add_action('woocommerce_single_product_summary', 'frameflow_woocommerce_sg_product_button', 30);
function frameflow_woocommerce_sg_product_button()
{
    global $product; ?>
	<div class="woocommerce-sg-product-button">
		<?php if (class_exists('WPCleverWoosw')) { ?>
			<div class="woocommerce-wishlist">
				<?php echo do_shortcode('[woosw id="' . esc_attr($product->get_id()) . '"]'); ?>
			</div>
		<?php } ?>
		<?php if (class_exists('WPCleverWoosc')) { ?>
			<div class="woocommerce-btn-item woocommerce-compare">
				<?php echo do_shortcode('[woosc id="' . esc_attr($product->get_id()) . '"]'); ?>
			</div>
		<?php } ?>
	</div>
<?php
}

/**
 * Product accordion sections from Product Options metabox.
 *
 * @return array<int, array{key: string, title: string}>
 */
function frameflow_sg_product_accordion_sections()
{
    return [
        [
            'key' => 'sg_product_details',
            'title' => __('Details', 'frameflow'),
        ],
        [
            'key' => 'sg_product_care',
            'title' => __('Product Care', 'frameflow'),
        ],
        [
            'key' => 'sg_product_shipping',
            'title' => __('Shipping & Returns', 'frameflow'),
        ],
    ];
}

/**
 * Sanitize editor HTML for accordion body.
 *
 * @param string $raw Editor HTML from product meta.
 * @return string
 */
function frameflow_sg_product_accordion_body($raw)
{
    $raw = trim((string) $raw);
    if ($raw === '' || $raw === '<p></p>' || $raw === '<p><br></p>' || $raw === '<p><br data-mce-bogus="1"></p>') {
        return '';
    }

    return wp_kses_post($raw);
}

add_action('woocommerce_single_product_summary', 'frameflow_woocommerce_sg_product_accordion', 35);
function frameflow_woocommerce_sg_product_accordion()
{
    if (!is_product()) {
        return;
    }

    $items = [];
    foreach (frameflow_sg_product_accordion_sections() as $section) {
        $body = frameflow_sg_product_accordion_body(frameflow()->get_page_opt($section['key'], ''));
        if ($body === '') {
            continue;
        }
        $items[] = [
            'title' => $section['title'],
            'body' => $body,
        ];
    }

    if (!$items) {
        return;
    }
    ?>
	<div class="pxl-product-accordion" data-pxl-accordion>
		<?php foreach ($items as $i => $item): ?>
			<div class="pxl-product-accordion__item is-open">
				<button
					type="button"
					class="pxl-product-accordion__toggle"
					aria-expanded="true"
					aria-controls="pxl-product-accordion-panel-<?php echo esc_attr((string) $i); ?>"
					id="pxl-product-accordion-heading-<?php echo esc_attr((string) $i); ?>"
				>
					<span class="pxl-product-accordion__title"><?php echo esc_html($item['title']); ?></span>
					<span class="pxl-product-accordion__icon" aria-hidden="true">
						<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M4 10L8 6L12 10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</span>
				</button>
				<div
					class="pxl-product-accordion__panel"
					id="pxl-product-accordion-panel-<?php echo esc_attr((string) $i); ?>"
					role="region"
					aria-labelledby="pxl-product-accordion-heading-<?php echo esc_attr((string) $i); ?>"
				>
					<div class="pxl-product-accordion__content">
						<?php echo $item['body']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in formatter ?>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
	<?php
}

add_action('woocommerce_single_product_summary', 'frameflow_woocommerce_sg_product_why', 38);
function frameflow_woocommerce_sg_product_why()
{
    if (!is_product()) {
        return;
    }

    $items = apply_filters('frameflow_product_why_items', [
        [
            'label' => __('Global Delivery:', 'frameflow'),
            'text' => __('Fast and fully tracked shipping worldwide.', 'frameflow'),
        ],
        [
            'label' => __('Safe Payment:', 'frameflow'),
            'text' => __('Encrypted transactions for absolute security.', 'frameflow'),
        ],
        [
            'label' => __('Easy Returns:', 'frameflow'),
            'text' => __('Hassle-free 14-day exchange and quality warranty.', 'frameflow'),
        ],
    ]);

    if (empty($items)) {
        return;
    }
    ?>
	<ul class="woocommerce-sg-product-why">
		<?php foreach ($items as $item): ?>
			<li>
				<span class="woocommerce-sg-product-why__icon" aria-hidden="true">
					<svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M3.5 9.5L7.5 13.5L15.5 5.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
				</span>
				<p>
					<strong><?php echo esc_html($item['label']); ?></strong>
					<span><?php echo esc_html($item['text']); ?></span>
				</p>
			</li>
		<?php endforeach; ?>
	</ul>
	<?php
}

add_action('woocommerce_single_product_summary', 'frameflow_woocommerce_sg_product_meta', 40);
function frameflow_woocommerce_sg_product_meta()
{
    global $product;
    if (!($product instanceof WC_Product)) {
        return;
    }

    $cats = wc_get_product_category_list($product->get_id(), ', ');
    $tags = wc_get_product_tag_list($product->get_id(), ', ');
    ?>
	<div class="product_meta woocommerce-sg-product-meta">
		<?php if ($cats): ?>
			<span class="posted_in">
				<?php echo esc_html__('Category:', 'frameflow'); ?>
				<span class="woocommerce-sg-product-meta__value"><?php echo wp_kses_post($cats); ?></span>
			</span>
		<?php endif; ?>
		<?php if ($tags): ?>
			<span class="tagged_as">
				<?php echo esc_html__('Tag:', 'frameflow'); ?>
				<span class="woocommerce-sg-product-meta__value"><?php echo wp_kses_post($tags); ?></span>
			</span>
		<?php endif; ?>
		<span class="sku_wrapper">
			<?php echo esc_html__('Product ID:', 'frameflow'); ?>
			<span class="woocommerce-sg-product-meta__value"><?php echo esc_html(
       (string) $product->get_id(),
   ); ?></span>
		</span>
	</div>
	<?php
}

/* Related products */
add_filter('woocommerce_output_related_products_args', 'frameflow_related_products_args', 20);
function frameflow_related_products_args($args)
{
    $args['posts_per_page'] = 4;
    $args['columns'] = 4;
    return $args;
} /* Pagination Args */
add_filter('woocommerce_pagination_args', 'frameflow_filter_woocommerce_pagination_args', 10, 1);
function frameflow_filter_woocommerce_pagination_args($array)
{
    $array['end_size'] = 1;
    $array['mid_size'] = 1;
    $array = array_merge($array, [
        'prev_text' => '<i class="lnil lnil-chevron-left"></i>',
        'next_text' => '<i class="lnil lnil-chevron-right"></i>',
        'type' => 'plain',
    ]);
    return $array;
} /* Flex Slider Arrow */
add_filter(
    'woocommerce_single_product_carousel_options',
    'frameflow_update_woo_flexslider_options',
);
function frameflow_update_woo_flexslider_options($options)
{
    $options['directionNav'] = false;
    $options['controlNav'] = 'thumbnails';
    return $options;
} /* Thumbnail sizes */
add_filter('woocommerce_get_image_size_single', function ($size) {
    $size['width'] = 500;
    $size['height'] = 707;
    $size['crop'] = 1;
    return $size;
});
add_filter('woocommerce_get_image_size_gallery_thumbnail', function ($size) {
    $size['width'] = 280;
    $size['height'] = 360;
    $size['crop'] = 1;
    return $size;
});
add_filter('woocommerce_get_image_size_thumbnail', function ($size) {
    $size['width'] = 600;
    $size['height'] = 830;
    $size['crop'] = 1;
    return $size;
});
add_filter(
    'woocommerce_loop_add_to_cart_link',
    'frameflow_woocommerce_loop_add_to_cart_link',
    10,
    3,
);
function frameflow_woocommerce_loop_add_to_cart_link($button, $product, $args)
{
    $url = $product->add_to_cart_url();
    $class = isset($args['class']) ? $args['class'] : 'button';
    $attributes = isset($args['attributes']) ? $args['attributes'] : [];
    $text = $product->add_to_cart_text();
    $quantity = isset($args['quantity']) ? $args['quantity'] : 1;
    if ($product->is_type('variable')) {
        $color_attr = frameflow_loop_get_color_attribute($product);
        $selected = [];
        if ($color_attr) {
            $color_val = frameflow_loop_default_color_value($product, $color_attr);
            if ($color_val !== '') {
                $selected['attribute_' . sanitize_title($color_attr)] = $color_val;
            }
        }
        $variation_id = frameflow_loop_resolve_variation_id($product, $selected);
        if ($variation_id) {
            $url = remove_query_arg('added-to-cart', add_query_arg('add-to-cart', $variation_id));
            $class = preg_replace('/\bproduct_type_variable\b/', 'product_type_simple', $class);
            if (strpos($class, 'ajax_add_to_cart') === false) {
                $class .= ' ajax_add_to_cart';
            }
            if (strpos($class, 'add_to_cart_button') === false) {
                $class .= ' add_to_cart_button';
            }
            $attributes['data-product_id'] = (string) $variation_id;
            $attributes['data-product_sku'] = '';
            $attributes['aria-label'] = sprintf(
                /* translators: %s: product name */
                __('Add to cart: “%s”', 'frameflow'),
                $product->get_name(),
            );
            $text = __('Add to cart', 'frameflow');
        }
    }
    $class .= ' pxl-loop-atc';
    $icon = '<span class="pxl-loop-atc-icon" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17" fill="none">
  <path d="M18 0H1.5C1.10218 0 0.720644 0.158035 0.43934 0.43934C0.158035 0.720644 0 1.10218 0 1.5V15C0 15.3978 0.158035 15.7794 0.43934 16.0607C0.720644 16.342 1.10218 16.5 1.5 16.5H18C18.3978 16.5 18.7794 16.342 19.0607 16.0607C19.342 15.7794 19.5 15.3978 19.5 15V1.5C19.5 1.10218 19.342 0.720644 19.0607 0.43934C18.7794 0.158035 18.3978 0 18 0ZM18 15H1.5V1.5H18V15ZM14.25 4.5C14.25 5.69347 13.7759 6.83807 12.932 7.68198C12.0881 8.52589 10.9435 9 9.75 9C8.55653 9 7.41193 8.52589 6.56802 7.68198C5.72411 6.83807 5.25 5.69347 5.25 4.5C5.25 4.30109 5.32902 4.11032 5.46967 3.96967C5.61032 3.82902 5.80109 3.75 6 3.75C6.19891 3.75 6.38968 3.82902 6.53033 3.96967C6.67098 4.11032 6.75 4.30109 6.75 4.5C6.75 5.29565 7.06607 6.05871 7.62868 6.62132C8.19129 7.18393 8.95435 7.5 9.75 7.5C10.5456 7.5 11.3087 7.18393 11.8713 6.62132C12.4339 6.05871 12.75 5.29565 12.75 4.5C12.75 4.30109 12.829 4.11032 12.9697 3.96967C13.1103 3.82902 13.3011 3.75 13.5 3.75C13.6989 3.75 13.8897 3.82902 14.0303 3.96967C14.171 4.11032 14.25 4.30109 14.25 4.5Z" fill="currentColor"/>
</svg></span>';
    return sprintf(
        '<a href="%s" data-quantity="%s" class="%s" %s><span class="pxl-text--hide">%s</span>%s<span class="pxl-cart-loader"></span></a>',
        esc_url($url),
        esc_attr($quantity),
        esc_attr(trim($class)),
        wc_implode_html_attributes($attributes),
        esc_html($text),
        $icon,
    );
}

/**
 * Chosen product category slugs from ?filter_product_cat=.
 *
 * @return string[]
 */
function frameflow_get_filter_product_cats()
{
    // phpcs:ignore WordPress.Security.NonceVerification.Recommended
    if (empty($_GET['filter_product_cat'])) {
        return [];
    }
    // phpcs:ignore WordPress.Security.NonceVerification.Recommended
    $raw = explode(',', wc_clean(wp_unslash($_GET['filter_product_cat'])));
    return array_values(array_filter(array_map('sanitize_title', $raw)));
}

/**
 * Chosen stock statuses from ?filter_stock_status= (instock|outofstock).
 *
 * @return string[]
 */
function frameflow_get_filter_stock_statuses()
{
    // phpcs:ignore WordPress.Security.NonceVerification.Recommended
    if (empty($_GET['filter_stock_status'])) {
        return [];
    }
    // phpcs:ignore WordPress.Security.NonceVerification.Recommended
    $raw = explode(',', wc_clean(wp_unslash($_GET['filter_stock_status'])));
    $allowed = ['instock', 'outofstock'];
    return array_values(array_intersect(array_map('sanitize_title', $raw), $allowed));
}

/**
 * Apply Product type + Availability filters to the main shop query.
 *
 * @param WP_Query $q Query.
 */
function frameflow_shop_filter_product_query($q)
{
    $cats = frameflow_get_filter_product_cats();
    if ($cats) {
        $tax_query = (array) $q->get('tax_query');
        $tax_query[] = [
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => $cats,
            'operator' => 'IN',
            'include_children' => true,
        ];
        $q->set('tax_query', $tax_query);
    }

    $stock = frameflow_get_filter_stock_statuses();
    if ($stock) {
        $meta_query = (array) $q->get('meta_query');
        $meta_query[] = [
            'key' => '_stock_status',
            'value' => $stock,
            'compare' => 'IN',
        ];
        $q->set('meta_query', $meta_query);
    }
}
add_action('woocommerce_product_query', 'frameflow_shop_filter_product_query');

/**
 * Keep custom filter query args on widget page URLs.
 *
 * @param string $link Link.
 * @return string
 */
function frameflow_preserve_shop_filter_query_args($link)
{
    foreach (['filter_product_cat', 'filter_stock_status'] as $key) {
        // phpcs:ignore WordPress.Security.NonceVerification.Recommended
        if (isset($_GET[$key]) && $_GET[$key] !== '') {
            $link = add_query_arg($key, wc_clean(wp_unslash($_GET[$key])), $link);
        }
    }
    return $link;
}
add_filter('woocommerce_widget_get_current_page_url', 'frameflow_preserve_shop_filter_query_args');

/**
 * Shop/archive URL with active Woo + theme filters (for checklist widgets).
 *
 * @return string
 */
function frameflow_shop_filter_get_current_url()
{
    if (is_shop()) {
        $link = get_permalink(wc_get_page_id('shop'));
    } elseif (is_product_category()) {
        $link = get_term_link(get_query_var('product_cat'), 'product_cat');
    } elseif (is_product_tag()) {
        $link = get_term_link(get_query_var('product_tag'), 'product_tag');
    } else {
        $queried = get_queried_object();
        $link =
            $queried && !empty($queried->slug) && !empty($queried->taxonomy)
                ? get_term_link($queried->slug, $queried->taxonomy)
                : get_permalink(wc_get_page_id('shop'));
    }

    if (is_wp_error($link) || !$link) {
        $link = get_permalink(wc_get_page_id('shop'));
    }

    foreach (['min_price', 'max_price', 'orderby', 'post_type', 'rating_filter'] as $key) {
        // phpcs:ignore WordPress.Security.NonceVerification.Recommended
        if (isset($_GET[$key])) {
            $link = add_query_arg($key, wc_clean(wp_unslash($_GET[$key])), $link);
        }
    }

    if (get_search_query()) {
        $link = add_query_arg('s', rawurlencode(htmlspecialchars_decode(get_search_query())), $link);
    }

    if (class_exists('WC_Query') && method_exists('WC_Query', 'get_layered_nav_chosen_attributes')) {
        $chosen = WC_Query::get_layered_nav_chosen_attributes();
        if ($chosen) {
            foreach ($chosen as $name => $data) {
                $filter_name = wc_attribute_taxonomy_slug($name);
                if (!empty($data['terms'])) {
                    $link = add_query_arg('filter_' . $filter_name, implode(',', $data['terms']), $link);
                }
                if ('or' === ($data['query_type'] ?? '')) {
                    $link = add_query_arg('query_type_' . $filter_name, 'or', $link);
                }
            }
        }
    }

    $cats = frameflow_get_filter_product_cats();
    if ($cats) {
        $link = add_query_arg('filter_product_cat', implode(',', $cats), $link);
    }

    $stock = frameflow_get_filter_stock_statuses();
    if ($stock) {
        $link = add_query_arg('filter_stock_status', implode(',', $stock), $link);
    }

    return (string) apply_filters('woocommerce_widget_get_current_page_url', $link);
}
