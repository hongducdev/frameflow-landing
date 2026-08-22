;(function ($) {
    "use strict"

    function parsePositive($root, key, fallback) {
        var value = parseFloat($root.data(key))
        if (isNaN(value) || value < 0) {
            return fallback
        }
        return value
    }

    function prefersReducedMotion() {
        return window.matchMedia && window.matchMedia("(prefers-reduced-motion: reduce)").matches
    }

    function killInstance($root) {
        var tl = $root.data("pxlImageScatterTimeline")
        if (tl) {
            tl.kill()
            $root.removeData("pxlImageScatterTimeline")
        }

        var st = $root.data("pxlImageScatterScrollTrigger")
        if (st) {
            st.kill()
            $root.removeData("pxlImageScatterScrollTrigger")
        }
    }

    function sortMotions($root) {
        return $root
            .find(".pxl-image-scatter__card")
            .toArray()
            .sort(function (a, b) {
                var orderA = parseInt(a.getAttribute("data-stagger"), 10)
                var orderB = parseInt(b.getAttribute("data-stagger"), 10)
                if (isNaN(orderA)) {
                    orderA = 0
                }
                if (isNaN(orderB)) {
                    orderB = 0
                }
                return orderA - orderB
            })
            .map(function (card) {
                return card.querySelector(".pxl-image-scatter__motion")
            })
            .filter(Boolean)
    }

    function setupScatter($root) {
        var rootEl = $root.get(0)
        if (!rootEl) {
            return
        }

        var motions = sortMotions($root)
        if (!motions.length) {
            return
        }

        killInstance($root)

        if (prefersReducedMotion()) {
            $root.addClass("is-reduced-motion")
            gsap.set(motions, { autoAlpha: 1, y: 0 })
            return
        }

        $root.removeClass("is-reduced-motion")

        var duration = parsePositive($root, "duration", 0.85)
        var stagger = parsePositive($root, "stagger", 0.14)
        var fromY = Math.max(rootEl.offsetHeight * 0.42, 160)

        gsap.set(motions, { autoAlpha: 0, y: fromY })

        var tl = gsap.timeline({
            paused: true,
            defaults: { ease: "power3.out" },
        })

        tl.to(motions, {
            autoAlpha: 1,
            y: 0,
            duration: duration,
            stagger: stagger,
        })

        $root.data("pxlImageScatterTimeline", tl)

        if (typeof ScrollTrigger === "undefined") {
            tl.play(0)
            return
        }

        var st = ScrollTrigger.create({
            trigger: rootEl,
            start: "top 82%",
            once: true,
            onEnter: function () {
                tl.play(0)
            },
        })

        $root.data("pxlImageScatterScrollTrigger", st)

        if (st.isActive) {
            tl.play(0)
        }
    }

    var pxl_widget_image_scatter_handler = function ($scope) {
        if (typeof gsap === "undefined") {
            $scope.find(".pxl-image-scatter").addClass("is-reduced-motion")
            return
        }

        if (typeof ScrollTrigger !== "undefined") {
            gsap.registerPlugin(ScrollTrigger)
        }

        $scope.find(".pxl-image-scatter").each(function () {
            setupScatter($(this))
        })
    }

    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/pxl_image_scatter.default",
            pxl_widget_image_scatter_handler
        )
    })
})(jQuery)
