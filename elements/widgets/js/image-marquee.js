(function ($) {
    "use strict"

    var pxl_widget_image_marquee_handler = function ($scope, $) {
        var $marquee = $scope.find(".pxl-image-marquee")
        if (!$marquee.length) {
            return
        }

        if (typeof gsap === "undefined") {
            return
        }

        $marquee.each(function () {
            var $instance = $(this)
            var $track = $instance.find(".pxl-image-marquee__track")

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

            $instance.off(".pxlImageMarquee")

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
                var speed = !isNaN(speedAttr) && speedAttr > 0 ? speedAttr : 60
                var direction =
                    ($instance.data("marquee-direction") || "left")
                        .toString()
                        .toLowerCase() === "right"
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
                    $instance.get(0),
                    function ($item) {
                        $item.find(".pxl-image-marquee__link").each(function () {
                            $(this)
                                .attr("data-pxl-marquee-proxy", "true")
                                .attr("tabindex", "-1")
                                .removeAttr("data-elementor-open-lightbox")
                                .removeAttr("data-elementor-lightbox-slideshow")
                                .removeAttr("data-elementor-lightbox-title")
                        })
                    }
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

            if ($instance.data("pause-on-hover") !== false) {
                $instance.on("mouseenter.pxlImageMarquee", function () {
                    var tl = $instance.data("pxlMarqueeTimeline")
                    if (tl) {
                        tl.pause()
                    }
                })

                $instance.on("mouseleave.pxlImageMarquee", function () {
                    var tl = $instance.data("pxlMarqueeTimeline")
                    if (tl) {
                        tl.resume()
                    }
                })
            }

            // Second track copy has no lightbox attrs — open matching first-copy link.
            $instance.on(
                "click.pxlImageMarquee",
                ".pxl-image-marquee__link[data-pxl-marquee-proxy]",
                function (e) {
                    e.preventDefault()
                    var href = $(this).attr("href")
                    if (!href) {
                        return
                    }

                    var $source = $instance
                        .find(
                            '.pxl-image-marquee__item:not([aria-hidden="true"]) .pxl-image-marquee__link[href="' +
                                href +
                                '"]',
                        )
                        .first()

                    if ($source.length) {
                        $source.get(0).click()
                    }
                },
            )
        })
    }

    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/pxl_image_marquee.default",
            pxl_widget_image_marquee_handler,
        )
    })

    $(function () {
        $(".elementor-widget-pxl_image_marquee").each(function () {
            pxl_widget_image_marquee_handler($(this), $)
        })
    })
})(jQuery)
