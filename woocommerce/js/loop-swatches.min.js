;(function ($) {
    "use strict"

    function resolveVariation(variations, selectedAttrs) {
        if (!variations || !variations.length) {
            return null
        }
        for (var i = 0; i < variations.length; i++) {
            var variation = variations[i]
            if (!variation.is_in_stock || !variation.is_purchasable) {
                continue
            }
            var ok = true
            $.each(selectedAttrs, function (attrKey, attrVal) {
                if (!attrVal) {
                    return
                }
                var varVal = variation.attributes[attrKey] || ""
                if (varVal !== "" && varVal !== attrVal) {
                    ok = false
                    return false
                }
            })
            if (ok) {
                return variation
            }
        }
        return null
    }

    function applyVariation($product, variation) {
        var $btn = $product
            .find(
                ".woocommerce-product--buttons .add_to_cart_button, .woocommerce-product--buttons a.button"
            )
            .first()
        if (!$btn.length) {
            return
        }
        if (variation && variation.variation_id) {
            var id = String(variation.variation_id)
            $btn.attr("href", "?add-to-cart=" + id)
            $btn.attr("data-product_id", id)
            $btn.addClass("ajax_add_to_cart add_to_cart_button")
            $btn.removeClass("product_type_variable").addClass("product_type_simple")
            if (variation.image && variation.image.src) {
                var $img = $product.find(".woocommerce-product-header img").first()
                if ($img.length) {
                    $img.attr("src", variation.image.src)
                    if (variation.image.srcset) {
                        $img.attr("srcset", variation.image.srcset)
                    }
                    if (variation.image.sizes) {
                        $img.attr("sizes", variation.image.sizes)
                    }
                    if (variation.image.alt) {
                        $img.attr("alt", variation.image.alt)
                    }
                }
            }
        }
    }

    $(document.body).on("click", ".pxl-loop-swatch", function (e) {
        e.preventDefault()
        e.stopPropagation()
        var $swatch = $(this)
        var $wrap = $swatch.closest(".pxl-loop-swatches")
        var $product = $swatch.closest("li.product, .product")
        var attrName = $swatch.attr("data-attribute_name")
        var value = $swatch.attr("data-value")
        var variations = $wrap.data("variations")
        if (typeof variations === "string") {
            try {
                variations = JSON.parse(variations)
            } catch (err) {
                variations = []
            }
        }
        variations = variations || []

        $wrap.find(".pxl-loop-swatch").removeClass("selected")
        $swatch.addClass("selected")

        var selectedAttrs = {}
        selectedAttrs[attrName] = String(value)
        applyVariation($product, resolveVariation(variations, selectedAttrs))
    })
})(jQuery)
