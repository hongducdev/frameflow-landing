(function ($) {
    "use strict";

    var pxl_widget_testimonial_marquee_handler = function ($scope, $) {
        var $marquee = $scope.find(".pxl-testimonial-marquee");
        if (!$marquee.length) {
            return;
        }

        if (typeof gsap === "undefined") {
            return;
        }

        $marquee.each(function () {
            var $instance = $(this);
            var $track = $instance.find(".pxl-testimonial-marquee__track");

            if (!$track.length) {
                return;
            }

            var existingTimeline = $instance.data("pxlMarqueeTimeline");
            if (existingTimeline) {
                existingTimeline.kill();
            }

            var existingResize = $instance.data("pxlMarqueeResize");
            if (existingResize) {
                $(window).off("resize", existingResize);
            }

            function setupMarquee(attachResize) {
                if (attachResize === undefined) {
                    attachResize = true;
                }

                if (!$instance.is(":visible")) {
                    return;
                }

                var speedAttr = parseFloat($instance.data("marquee-speed"));
                var speed = !isNaN(speedAttr) && speedAttr > 0 ? speedAttr : 80;
                var direction =
                    ($instance.data("marquee-direction") || "left")
                        .toString()
                        .toLowerCase() === "right"
                        ? "right"
                        : "left";

                gsap.set($track, { x: 0 });

                var trackEl = $track.get(0);
                if (!trackEl) {
                    return;
                }

                var $children = $track.children();
                if ($children.length <= 1) {
                    return;
                }

                var half = Math.floor($children.length / 2);
                var distance = 0;

                for (var i = 0; i < half; i++) {
                    distance += $children.eq(i).outerWidth(true);
                }

                distance = Math.round(distance);
                if (!distance || distance <= 0) {
                    return;
                }

                var duration = distance / speed;

                var fromX = direction === "left" ? 0 : -distance;
                var toX = direction === "left" ? -distance : 0;

                var tl = gsap.fromTo(
                    $track,
                    { x: fromX },
                    {
                        x: toX,
                        duration: duration,
                        ease: "none",
                        repeat: -1,
                    },
                );

                $instance.data("pxlMarqueeTimeline", tl);

                if (attachResize) {
                    var resizeHandler = function () {
                        if (!document.body.contains($instance.get(0))) {
                            $(window).off("resize", resizeHandler);
                            if (tl) {
                                tl.kill();
                            }
                            return;
                        }

                        if (tl) {
                            tl.kill();
                        }
                        setupMarquee(false);
                    };

                    $(window).on("resize", resizeHandler);
                    $instance.data("pxlMarqueeResize", resizeHandler);
                }
            }

            setupMarquee(true);
        });
    };

    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/pxl_testimonial_marquee.default",
            pxl_widget_testimonial_marquee_handler,
        );
    });
})(jQuery);
