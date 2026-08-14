;(function ($) {
    "use strict"

    $(document).on("click", ".cart-total-wrap", function () {
        $(".widget-cart-sidebar").toggleClass("open")
        $(this).toggleClass("cart-open")
        $(".site-overlay").toggleClass("open")
    })

    $(document).on("click", ".site-overlay", function () {
        $(this).removeClass("open")
        $(this).parents("#page").find(".widget-cart-sidebar").removeClass("open")
    })

    $(document).on("click", ".woocommerce-tab-heading", function () {
        $(this).toggleClass("open")
        $(this).parent().find(".woocommerce-tab-content").slideToggle("")
    })

    $(document).on("click", ".pxl-product-accordion__toggle", function () {
        var $btn = $(this)
        var $item = $btn.closest(".pxl-product-accordion__item")
        var $panel = $item.children(".pxl-product-accordion__panel")
        var open = $item.hasClass("is-open")
        if (open) {
            $item.removeClass("is-open")
            $btn.attr("aria-expanded", "false")
            $panel.stop(true, true).slideUp(200)
        } else {
            $item.addClass("is-open")
            $btn.attr("aria-expanded", "true")
            $panel.stop(true, true).slideDown(200)
        }
    })

    $(document).on(
        "click",
        ".site-menu-right .h-btn-cart, .mobile-menu-cart .h-btn-cart",
        function (e) {
            e.preventDefault()
            $(this).parents("#ct-header-wrap").find(".widget_shopping_cart").toggleClass("open")
            $(".ct-hidden-sidebar").removeClass("open")
            $(".ct-search-popup").removeClass("open")
        }
    )

    $(document).on("click", ".woocommerce-add-to-cart a.button", function () {
        $(this).parents(".woocommerce-product-inner").addClass("cart-added")
    })

    $(document).on("click", ".woocommerce-archive-layout .layout-grid", function () {
        $(this).addClass("active")
        $(this).parent().find(".layout-list").removeClass("active")
        $(this)
            .parents(".site-main")
            .find("ul.products")
            .addClass("ct-products-grid")
            .removeClass("ct-products-list")
    })

    $(document).on("click", ".woocommerce-archive-layout .layout-list", function () {
        $(this).addClass("active")
        $(this).parent().find(".layout-grid").removeClass("active")
        $(this)
            .parents(".site-main")
            .find("ul.products")
            .addClass("ct-products-list")
            .removeClass("ct-products-grid")
    })

    $(document).on("click", ".woocommerce .products .quantity input", function () {
        return false
    })

    $(document).on("change input", ".woocommerce .products .quantity .qty", function () {
        var $btn = $(this).parents(".product").find(".add_to_cart_button")
        var qty = $(this).val()
        $btn.attr("data-quantity", qty)
        $btn.attr("href", "?add-to-cart=" + $btn.attr("data-product_id") + "&quantity=" + qty)
    })

    $(document).on("click", ".pxl-item--attr .pxl-button--info", function () {
        $(this).toggleClass("active")
    })

    $(document).ready(function () {
        $(".single_variation_wrap").addClass("clearfix")
        $(".woocommerce-variation-add-to-cart").addClass("clearfix")

        $(".woocommerce-archive-layout .layout-list.active")
            .parents(".site-main")
            .find("ul.products")
            .addClass("ct-products-list")
            .removeClass("ct-products-grid")

        $(".flex-viewport").parents(".woocommerce-gallery-inner").addClass("flex-slider-active")

        $('.woocommerce-add-to-cart a.button.product_type_grouped:not(".no-animate")').append(
            '<i class="caseicon-link4"></i>'
        )

        if ($(".ct-product-carousel6, .ct-product-carousel9").length) {
            setTimeout(function () {
                var icon =
                    '<span class="pxl-cart-icon" aria-hidden="true"><svg viewBox="0 0 24 24" width="1em" height="1em" fill="currentColor"><path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2S15.9 22 17 22s2-.9 2-2-.9-2-2-2zM7.17 14h9.92c.75 0 1.41-.41 1.75-1.03L22 6.5a1 1 0 0 0-.87-1.5H6.21L5.27 3.43A1 1 0 0 0 4.33 3H2a1 1 0 1 0 0 2h1.64l3.09 10.37-.76 1.38A2 2 0 0 0 7.7 20H20a1 1 0 1 0 0-2H7.7l.47-.85z"/></svg></span>'
                $(
                    ".ct-product-carousel6.woocommerce .woocommerce-product-inner .woocommerce-add-to--cart .button"
                )
                    .not(":has(.pxl-cart-icon)")
                    .append(icon)
                $(
                    ".ct-product-carousel9.woocommerce .woocommerce-product-inner .woocommerce-add-to--cart .button"
                )
                    .not(":has(.pxl-cart-icon)")
                    .append(icon)
            }, 300)
        }
    })

    $(document).on("qv_loader_stop", function () {
        var $qty = $("#yith-quick-view-modal .quantity")
        if ($qty.length && !$qty.find(".quantity-icon").length) {
            $qty.append(
                '<span class="quantity-icon quantity-down pxl-icon--caretdown"></span><span class="quantity-icon quantity-up pxl-icon--caretup"></span>'
            )
        }
    })

    $(document).on("click", "#yith-quick-view-modal .quantity-up", function () {
        var input = $(this).parents(".quantity").find('input[type="number"]').get(0)
        if (input) {
            input.stepUp()
        }
    })

    $(document).on("click", "#yith-quick-view-modal .quantity-down", function () {
        var input = $(this).parents(".quantity").find('input[type="number"]').get(0)
        if (input) {
            input.stepDown()
        }
    })

    function frameflowWcAjaxUrl(endpoint) {
        var tpl =
            (typeof frameflow_woo !== "undefined" && frameflow_woo.wc_ajax_url) ||
            (typeof wc_add_to_cart_params !== "undefined" && wc_add_to_cart_params.wc_ajax_url) ||
            ""
        if (!tpl) {
            return ""
        }
        return tpl.toString().replace("%%endpoint%%", endpoint)
    }

    function frameflowApplyCartFragments(fragments) {
        if (!fragments) {
            return
        }
        $.each(fragments, function (key, value) {
            $(key).replaceWith(value)
        })
        $(document.body).trigger("wc_fragments_refreshed")
    }

    function frameflowOpenCartSidebar() {
        var $sidebar = $("#pxl-cart-sidebar")
        if (!$sidebar.length) {
            return
        }
        $sidebar.addClass("active")
        $("body").addClass("body-overflow")
    }

    function frameflowAtcLabel($button) {
        return (
            (typeof frameflow_woo !== "undefined" && frameflow_woo.i18n_add_to_cart) ||
            $button.data("pxlAtcLabel") ||
            "Add to cart"
        )
    }

    function frameflowViewCartLabel() {
        return (
            (typeof frameflow_woo !== "undefined" && frameflow_woo.i18n_view_cart) ||
            (typeof wc_add_to_cart_params !== "undefined" && wc_add_to_cart_params.i18n_view_cart) ||
            "View Cart"
        )
    }

    function frameflowSetAtcAsViewCart($button) {
        if (!$button || !$button.length) {
            return
        }
        if (!$button.data("pxlAtcLabel")) {
            $button.data("pxlAtcLabel", $.trim($button.text()))
        }
        $button
            .removeClass("loading")
            .addClass("added is-view-cart")
            .prop("disabled", false)
            .text(frameflowViewCartLabel())
        $button.siblings("a.added_to_cart").remove()
        $button.closest("form.cart").find("> a.added_to_cart").remove()
    }

    function frameflowResetAtcButton($button) {
        if (!$button || !$button.length || !$button.hasClass("is-view-cart")) {
            return
        }
        $button
            .removeClass("added is-view-cart loading")
            .text(frameflowAtcLabel($button))
            .prop("disabled", false)
    }

    $(document.body).on("wc_cart_button_updated", function (e, $button) {
        if (!$button || !$button.closest("form.cart").length) {
            return
        }
        $button.siblings("a.added_to_cart").remove()
        frameflowSetAtcAsViewCart($button)
    })

    $(document).on("click", ".single_add_to_cart_button", function (e) {
        var $button = $(this)
        var $form = $button.closest("form.cart")

        if (!$form.length || $button.hasClass("pxl-buy-now-button")) {
            return
        }

        if ($button.hasClass("is-view-cart")) {
            e.preventDefault()
            e.stopImmediatePropagation()
            frameflowOpenCartSidebar()
            return
        }

        if ($button.hasClass("disabled") || $button.is(":disabled")) {
            e.preventDefault()
            return
        }

        var ajaxUrl = frameflowWcAjaxUrl("add_to_cart")
        if (!ajaxUrl) {
            return
        }

        e.preventDefault()
        e.stopImmediatePropagation()

        var variationId = parseInt($form.find('input[name="variation_id"]').val(), 10) || 0
        var productId =
            variationId > 0
                ? variationId
                : parseInt(
                      $form.find('input[name="product_id"]').val() ||
                          $form.find('[name="add-to-cart"]').val(),
                      10
                  ) || 0
        var quantity = $form.find("input.qty").val() || 1

        if (!productId) {
            return
        }
        if ($button.data("pxlAtcBusy")) {
            return
        }

        if (!$button.data("pxlAtcLabel")) {
            $button.data("pxlAtcLabel", $.trim($button.text()))
        }

        $button.data("pxlAtcBusy", true).addClass("loading").prop("disabled", true)

        $.ajax({
            type: "POST",
            url: ajaxUrl,
            data: {
                product_id: productId,
                quantity: quantity,
            },
            dataType: "json",
            success: function (response) {
                if (!response) {
                    return
                }
                if (response.error && response.product_url) {
                    window.location = response.product_url
                    return
                }
                frameflowApplyCartFragments(response.fragments)
                $(document.body).trigger("added_to_cart", [
                    response.fragments,
                    response.cart_hash,
                    $button,
                ])
                frameflowOpenCartSidebar()
                frameflowSetAtcAsViewCart($button)
                $(".woocommerce-message").remove()
                $form.find("a.added_to_cart").remove()
            },
            error: function (xhr) {
                if (window.console && console.warn) {
                    console.warn("frameflow ATC ajax failed", xhr && xhr.status)
                }
            },
            complete: function () {
                $button.data("pxlAtcBusy", false).removeClass("loading")
                if (!$button.hasClass("is-view-cart")) {
                    $button.prop("disabled", false)
                }
            },
        })
    })

    $(document).on("reset_data hide_variation", "form.variations_form", function () {
        frameflowResetAtcButton($(this).find(".single_add_to_cart_button"))
    })

    // Cart page: qty/remove update via WC AJAX — no full reload / notice banner
    ;(function () {
        var qtyTimer = null

        function frameflowCartEnsureQtyIcons() {
            $(".woocommerce-cart-form .quantity").each(function () {
                var $qty = $(this)
                if ($qty.find(".quantity-icon").length === 0) {
                    $qty.append(
                        '<span class="quantity-icon quantity-down pxl-icon--minus"></span><span class="quantity-icon quantity-up pxl-icon--plus"></span>'
                    )
                }
            })
        }

        function frameflowStripCartNoiseNotices() {
            $(".woocommerce-notices-wrapper .woocommerce-message, .woocommerce-message[role='alert']").each(
                function () {
                    var text = $.trim($(this).text()).toLowerCase()
                    if (
                        text.indexOf("cart updated") !== -1 ||
                        /\bremoved\.?\s*$/.test(text) ||
                        text.indexOf("removed.") !== -1
                    ) {
                        $(this).remove()
                    }
                }
            )
        }

        function frameflowAjaxUpdateCartQty() {
            var $form = $(".woocommerce-cart-form")
            if (!$form.length || $form.hasClass("processing")) {
                return
            }
            if (typeof wc_cart_params === "undefined") {
                return
            }

            var $btn = $form.find(':input[type="submit"][name="update_cart"]')
            $form.find(':input[type="submit"]').removeAttr("clicked")
            $btn.prop("disabled", false).attr("clicked", "true")
            $form.trigger("submit")
        }

        $(document).on(
            "change",
            ".woocommerce-cart-form .cart_item .qty",
            function () {
                clearTimeout(qtyTimer)
                qtyTimer = setTimeout(frameflowAjaxUpdateCartQty, 400)
            }
        )

        $(document.body).on("updated_wc_div updated_cart_totals", function () {
            frameflowStripCartNoiseNotices()
            frameflowCartEnsureQtyIcons()
            $(document.body).trigger("wc_fragment_refresh")
        })

        $(document.body).on("item_removed_from_classic_cart", function () {
            frameflowStripCartNoiseNotices()
        })

        $(function () {
            if ($("body").hasClass("woocommerce-cart")) {
                frameflowCartEnsureQtyIcons()
                frameflowStripCartNoiseNotices()
            }
        })
    })()
})(jQuery)
