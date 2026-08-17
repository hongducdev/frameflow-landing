;(function ($) {
    "use strict"

    $(function () {
        // Shop filters — AJAX fragments (?pxl_shop_ajax=1)
        if (!$("body").hasClass("woocommerce") && !$("body").hasClass("woocommerce-page")) {
            return
        }
        if (!$("#pxl-content-main").length && !$("ul.products").length) {
            return
        }

        var shopXhr = null
        var FRAGMENT_PARAM = "pxl_shop_ajax"
        var filterLinkSel = [
            ".pxl_widget_attribute_filter a.pxl-filter-swatch",
            ".pxl_widget_product_type_filter a.pxl-filter-check",
            ".pxl_widget_availability_filter a.pxl-filter-check",
            ".widget_layered_nav a",
            ".woocommerce-widget-layered-nav-list a",
            ".widget_layered_nav_filters a",
            ".widget_rating_filter a",
        ].join(", ")
        var filterFormSel = [
            "form.woocommerce-ordering",
            ".widget_price_filter form",
            ".pxl_widget_price_filter form",
            "form.woocommerce-widget-layered-nav-dropdown",
        ].join(", ")

        function $loadTarget() {
            var $main = $("#pxl-content-main")
            if ($main.length) {
                return $main
            }
            return $("#pxl-content-area").first()
        }

        function toFragmentUrl(url) {
            try {
                var u = new URL(url, window.location.origin)
                u.searchParams.set(FRAGMENT_PARAM, "1")
                return u.href
            } catch (err) {
                var sep = url.indexOf("?") >= 0 ? "&" : "?"
                return url + sep + FRAGMENT_PARAM + "=1"
            }
        }

        function applyFragments(data) {
            if (!data) {
                return
            }
            var $main = $("#pxl-content-main")
            if ($main.length && typeof data.content === "string") {
                $main.html(data.content)
            } else if (typeof data.content === "string") {
                var $area = $("#pxl-content-area").first()
                if ($area.length) {
                    $area.html(data.content)
                }
            }

            var $sidebar = $("#pxl-sidebar-area")
            if ($sidebar.length && typeof data.sidebar === "string" && data.sidebar) {
                $sidebar.html(data.sidebar)
            }

            $(document.body).trigger("init_price_filter")
            $(document.body).trigger("pxl_init_price_filter")
        }

        function reinitShopUi() {
            if (typeof $.fn.niceSelect === "function") {
                $(
                    ".woocommerce-ordering .orderby, #pxl-sidebar-area select, .pxl-filter-dropdown, .pxl-nice-select"
                ).each(function () {
                    $(this).niceSelect()
                })
            }
            $("#pxl-content-main .quantity").each(function () {
                var $qty = $(this)
                if ($qty.find(".quantity-icon").length === 0) {
                    $qty.append(
                        '<span class="quantity-icon quantity-down pxl-icon--minus"></span><span class="quantity-icon quantity-up pxl-icon--plus"></span>'
                    )
                }
            })
        }

        function formToUrl($form) {
            var action = $form.attr("action") || window.location.href.split("?")[0]
            var qs = $form.serialize()
            if (!qs) {
                return action
            }
            qs = qs
                .split("&")
                .filter(function (part) {
                    return part.indexOf(FRAGMENT_PARAM + "=") !== 0
                })
                .join("&")
            if (!qs) {
                return action
            }
            return action + (action.indexOf("?") >= 0 ? "&" : "?") + qs
        }

        function loadShopUrl(url, push) {
            if (!url) {
                return
            }
            var $target = $loadTarget()
            if (shopXhr && shopXhr.readyState !== 4) {
                shopXhr.abort()
            }
            $target.addClass("pxl-shop-ajax-loading")
            $("#pxl-sidebar-area").addClass("pxl-shop-ajax-loading")
            $("body").addClass("pxl-shop-ajax-busy")

            shopXhr = $.ajax({
                url: toFragmentUrl(url),
                type: "GET",
                dataType: "json",
            })
                .done(function (res) {
                    if (!res || !res.success || !res.data) {
                        window.location.href = url
                        return
                    }
                    applyFragments(res.data)
                    if (push) {
                        history.pushState({ pxlShopAjax: 1 }, "", url)
                    }
                    reinitShopUi()
                    $(document.body).trigger("pxl_shop_ajax_updated")
                })
                .fail(function (xhr, status) {
                    if (status === "abort") {
                        return
                    }
                    window.location.href = url
                })
                .always(function () {
                    $target.removeClass("pxl-shop-ajax-loading")
                    $("#pxl-sidebar-area").removeClass("pxl-shop-ajax-loading")
                    $("body").removeClass("pxl-shop-ajax-busy")
                    shopXhr = null
                })
        }

        $(document).on("click", filterLinkSel, function (e) {
            var href = $(this).attr("href")
            if (!href || href === "#" || href.indexOf("javascript:") === 0) {
                return
            }
            e.preventDefault()
            loadShopUrl(href, true)
        })

        $(document).on("click", ".woocommerce-pagination a.page-numbers", function (e) {
            var href = $(this).attr("href")
            if (!href || href === "#") {
                return
            }
            e.preventDefault()
            loadShopUrl(href, true)
        })

        $(document).on("change", "form.woocommerce-ordering select.orderby", function (e) {
            e.preventDefault()
            e.stopPropagation()
            loadShopUrl(formToUrl($(this).closest("form")), true)
        })

        $(document).on(
            "change",
            "form.woocommerce-widget-layered-nav-dropdown select",
            function (e) {
                e.preventDefault()
                e.stopPropagation()
                loadShopUrl(formToUrl($(this).closest("form")), true)
            }
        )

        $(document).on("submit", filterFormSel, function (e) {
            e.preventDefault()
            loadShopUrl(formToUrl($(this)), true)
        })

        window.addEventListener("popstate", function (e) {
            if (e.state && e.state.pxlShopAjax) {
                loadShopUrl(window.location.href, false)
            }
        })

        if (!$("body").data("pxl-shop-ajax-state")) {
            history.replaceState({ pxlShopAjax: 1 }, "", window.location.href)
            $("body").data("pxl-shop-ajax-state", 1)
        }
    })
})(jQuery)
