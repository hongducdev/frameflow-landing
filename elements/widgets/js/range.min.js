;(function ($) {
    var pxl_widget_range_handler = function ($scope, $) {
        setTimeout(function () {
            if (!window.elementorFrontend || typeof elementorFrontend.waypoint !== "function") {
                return
            }

            elementorFrontend.waypoint(
                $scope.find(".pxl-range"),
                function () {
                    var $el = $(this)
                    if ($el.hasClass("is-animated")) {
                        return
                    }

                    var reduceMotion =
                        window.matchMedia &&
                        window.matchMedia("(prefers-reduced-motion: reduce)").matches

                    if (reduceMotion) {
                        $el.addClass("is-animated is-complete")
                        return
                    }

                    $el.addClass("is-animated")

                    var completed = false
                    var complete = function () {
                        if (completed) {
                            return
                        }
                        completed = true
                        $el.addClass("is-complete")
                    }

                    var durationMs = 1200
                    var durationValue = window
                        .getComputedStyle($el[0])
                        .getPropertyValue("--pxl-range-duration")
                        .trim()

                    if (durationValue) {
                        durationMs = durationValue.endsWith("ms")
                            ? parseFloat(durationValue)
                            : parseFloat(durationValue) * 1000
                    }

                    $el.find(".pxl-range__fill").one("transitionend", function (event) {
                        if (
                            event.originalEvent &&
                            event.originalEvent.propertyName &&
                            event.originalEvent.propertyName !== "width"
                        ) {
                            return
                        }
                        complete()
                    })

                    window.setTimeout(complete, (isNaN(durationMs) ? 1200 : durationMs) + 50)
                },
                {
                    offset: "95%",
                    triggerOnce: true,
                }
            )
        }, 300)
    }

    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/pxl_range.default",
            pxl_widget_range_handler
        )
    })
})(jQuery)
