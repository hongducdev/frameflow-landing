;(function ($) {
    "use strict"

    if (window.frameflowSmoothHashInit) {
        return
    }
    window.frameflowSmoothHashInit = true

    var SKIP_SELECTOR = [
        ".pxl-anchor-button",
        ".pxl-case-badge__link",
        ".pxl-cart-sidebar-button",
        ".pxl-search-popup-button",
        ".pxl-action-popup",
        ".lightbox",
        "[data-elementor-open-lightbox]",
        "[data-fancybox]",
    ].join(",")

    function prefersReducedMotion() {
        return (
            typeof window.matchMedia === "function" &&
            window.matchMedia("(prefers-reduced-motion: reduce)").matches
        )
    }

    function stickyOffset() {
        var $sticky = $(".pxl-header-elementor-sticky.pxl-header-fixed")
        if (!$sticky.length) {
            $sticky = $(".pxl-header-elementor-sticky")
        }
        var $mobile = $("#pxl-header-mobile.pxl-header-mobile-fixed")
        return Math.max($sticky.outerHeight() || 0, $mobile.outerHeight() || 0)
    }

    function samePageHash(anchor) {
        if (!anchor || anchor.tagName !== "A") {
            return ""
        }
        if (anchor.target && anchor.target !== "_self") {
            return ""
        }
        if (anchor.hasAttribute("download")) {
            return ""
        }
        if (anchor.matches(SKIP_SELECTOR) || $(anchor).closest(".tabs, .elementor-tabs").length) {
            return ""
        }

        var href = anchor.getAttribute("href")
        if (!href || href.charAt(0) === "?") {
            return ""
        }

        var url
        try {
            url = new URL(href, window.location.href)
        } catch (err) {
            return href.charAt(0) === "#" ? href : ""
        }

        if (url.origin !== window.location.origin) {
            return ""
        }

        var currentPath = window.location.pathname.replace(/\/+$/, "") || "/"
        var targetPath = url.pathname.replace(/\/+$/, "") || "/"
        if (currentPath !== targetPath) {
            return ""
        }

        return url.hash || ""
    }

    function hashTarget(hash) {
        if (!hash || hash === "#") {
            return null
        }
        if (hash === "#top") {
            return document.body
        }

        var id = hash.slice(1)
        try {
            id = decodeURIComponent(id)
        } catch (err) {
            /* keep raw id */
        }
        if (!id) {
            return null
        }

        return document.getElementById(id)
    }

    function scrollToTarget(el, instant) {
        var offset = stickyOffset()
        var top = el === document.body ? 0 : Math.max(0, $(el).offset().top - offset)
        var lenis = window.lenisInstance

        if (lenis && typeof lenis.scrollTo === "function") {
            lenis.scrollTo(el === document.body ? 0 : el, {
                duration: instant ? 0 : 1.2,
                offset: el === document.body ? 0 : -offset,
                immediate: !!instant,
            })
            return
        }

        if (instant || prefersReducedMotion()) {
            window.scrollTo(0, top)
            return
        }

        $("html, body").stop(true).animate({ scrollTop: top }, 900)
    }

    function onAnchorClick(e) {
        if (e.isDefaultPrevented() || e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) {
            return
        }
        if (typeof e.which === "number" && e.which !== 1) {
            return
        }

        var anchor = e.currentTarget
        var hash = samePageHash(anchor)
        if (!hash) {
            return
        }

        var target = hashTarget(hash)
        if (!target) {
            return
        }

        e.preventDefault()
        scrollToTarget(target, prefersReducedMotion())

        if (history.pushState) {
            history.pushState(null, "", hash)
        }
    }

    $(document).on("click.frameflowSmoothHash", "a[href]", onAnchorClick)
})(jQuery)
