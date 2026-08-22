;(function ($) {
    "use strict"

    var pxl_widget_testimonial_marquee_handler = function ($scope, $) {
        var $marquee = $scope.find(".pxl-testimonial-marquee")
        if (!$marquee.length) {
            return
        }

        if (typeof gsap === "undefined") {
            return
        }

        $marquee.each(function () {
            var $instance = $(this)
            var $track = $instance.find(".pxl-testimonial-marquee__track")

            if (!$track.length) {
                return
            }

            var existingTimeline = $instance.data("pxlMarqueeTimeline")
            if (existingTimeline) {
                existingTimeline.kill()
            }

            var existingResize = $instance.data("pxlMarqueeResize")
            if (existingResize) {
                $(window).off("resize", existingResize)
            }

            function retrySetup(attachResize) {
                if (!attachResize) {
                    return
                }

                var n = parseInt($instance.data("pxlMarqueeRetries"), 10) || 0
                if (n >= 30) {
                    return
                }

                $instance.data("pxlMarqueeRetries", n + 1)
                setTimeout(function () {
                    setupMarquee(true)
                }, n < 10 ? 50 : 200)
            }

            function setupMarquee(attachResize) {
                if (attachResize === undefined) {
                    attachResize = true
                }

                if (!$instance.is(":visible")) {
                    retrySetup(attachResize)
                    return
                }

                var speedAttr = parseFloat($instance.data("marquee-speed"))
                var speed = !isNaN(speedAttr) && speedAttr > 0 ? speedAttr : 80
                var direction =
                    ($instance.data("marquee-direction") || "left").toString().toLowerCase() ===
                    "right"
                        ? "right"
                        : "left"

                gsap.set($track, { x: 0 })

                var trackEl = $track.get(0)
                if (!trackEl) {
                    return
                }

                if (
                    !window.frameflowMarqueeHelpers ||
                    typeof window.frameflowMarqueeHelpers.fillTrack !== "function"
                ) {
                    retrySetup(attachResize)
                    return
                }

                var distance = window.frameflowMarqueeHelpers.fillTrack(
                    $track,
                    $instance.get(0)
                )
                if (!distance || distance <= 0) {
                    retrySetup(attachResize)
                    return
                }

                $instance.data("pxlMarqueeRetries", 0)

                var tl = window.frameflowMarqueeHelpers.createTween(
                    $track,
                    distance,
                    speed,
                    direction
                )

                $instance.data("pxlMarqueeTimeline", tl)

                if (attachResize) {
                    var resizeHandler = function () {
                        if (!document.body.contains($instance.get(0))) {
                            $(window).off("resize", resizeHandler)
                            if (tl) {
                                tl.kill()
                            }
                            return
                        }

                        if (tl) {
                            tl.kill()
                        }
                        setupMarquee(false)
                    }

                    $(window).on("resize", resizeHandler)
                    $instance.data("pxlMarqueeResize", resizeHandler)
                }
            }

            setupMarquee(true)
        })
    }

    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/pxl_testimonial_marquee.default",
            pxl_widget_testimonial_marquee_handler
        )
    })

    $(function () {
        $(".elementor-widget-pxl_testimonial_marquee").each(function () {
            pxl_widget_testimonial_marquee_handler($(this), $)
        })
    })
})(jQuery)
