(function ($) {
    "use strict";

    function parseHold($root) {
        var hold = parseFloat($root.data("hold"));
        if (isNaN(hold) || hold <= 0) {
            return 2;
        }
        return hold;
    }

    function readCssPx(el, prop, fallback) {
        var value = parseFloat(
            window.getComputedStyle(el).getPropertyValue(prop).trim(),
        );
        if (isNaN(value)) {
            return fallback;
        }
        return value;
    }

    function readCssDeg(el, prop, fallback) {
        var raw = window.getComputedStyle(el).getPropertyValue(prop).trim();
        var value = parseFloat(raw);
        if (isNaN(value)) {
            return fallback;
        }
        return value;
    }

    function prefersReducedMotion() {
        return (
            window.matchMedia &&
            window.matchMedia("(prefers-reduced-motion: reduce)").matches
        );
    }

    function killInstance($root) {
        var tl = $root.data("pxlImageFanTimeline");
        if (tl) {
            tl.kill();
            $root.removeData("pxlImageFanTimeline");
        }

        var st = $root.data("pxlImageFanScrollTrigger");
        if (st) {
            st.kill();
            $root.removeData("pxlImageFanScrollTrigger");
        }
    }

    function setOpenState(leftEl, centerEl, rightEl, offsetX, angle) {
        gsap.set(centerEl, { autoAlpha: 1, y: 0 });
        gsap.set(leftEl, {
            autoAlpha: 1,
            x: -offsetX,
            rotation: -angle,
        });
        gsap.set(rightEl, {
            autoAlpha: 1,
            x: offsetX,
            rotation: angle,
        });
    }

    function setCollapsedState(leftEl, centerEl, rightEl) {
        gsap.set(centerEl, { autoAlpha: 0, y: 48 });
        gsap.set([leftEl, rightEl], {
            autoAlpha: 0,
            x: 0,
            rotation: 0,
        });
    }

    function setupFan($root) {
        var rootEl = $root.get(0);
        if (!rootEl) {
            return;
        }

        var leftEl = $root
            .find(".pxl-image-fan__card--left .pxl-image-fan__motion")
            .get(0);
        var centerEl = $root
            .find(".pxl-image-fan__card--center .pxl-image-fan__motion")
            .get(0);
        var rightEl = $root
            .find(".pxl-image-fan__card--right .pxl-image-fan__motion")
            .get(0);

        if (!leftEl || !centerEl || !rightEl) {
            return;
        }

        killInstance($root);

        var offsetX = readCssPx(rootEl, "--fan-offset-x", 72);
        var angle = readCssDeg(rootEl, "--fan-angle", 19.8);
        var hold = parseHold($root);

        if (prefersReducedMotion()) {
            $root.addClass("is-reduced-motion");
            setOpenState(leftEl, centerEl, rightEl, offsetX, angle);
            return;
        }

        $root.removeClass("is-reduced-motion");
        setCollapsedState(leftEl, centerEl, rightEl);

        var tl = gsap.timeline({
            paused: true,
            repeat: -1,
            defaults: { ease: "power2.out" },
        });

        tl.to(centerEl, {
            autoAlpha: 1,
            y: 0,
            duration: 0.7,
        })
            .to(
                leftEl,
                {
                    autoAlpha: 1,
                    x: -offsetX,
                    rotation: -angle,
                    duration: 0.75,
                },
                "-=0.12",
            )
            .to(
                rightEl,
                {
                    autoAlpha: 1,
                    x: offsetX,
                    rotation: angle,
                    duration: 0.75,
                },
                "<",
            )
            .to({}, { duration: hold })
            .to(
                [leftEl, rightEl],
                {
                    autoAlpha: 0,
                    x: 0,
                    rotation: 0,
                    duration: 0.75,
                    ease: "power2.inOut",
                },
            )
            .to(
                centerEl,
                {
                    autoAlpha: 0,
                    y: 48,
                    duration: 0.65,
                    ease: "power2.in",
                },
                "-=0.15",
            )
            .to({}, { duration: 0.35 });

        $root.data("pxlImageFanTimeline", tl);

        if (typeof ScrollTrigger === "undefined") {
            tl.play(0);
            return;
        }

        var st = ScrollTrigger.create({
            trigger: rootEl,
            start: "top 85%",
            end: "bottom 10%",
            onEnter: function () {
                tl.play();
            },
            onEnterBack: function () {
                tl.play();
            },
            onLeave: function () {
                tl.pause();
            },
            onLeaveBack: function () {
                tl.pause();
            },
        });

        $root.data("pxlImageFanScrollTrigger", st);

        if (st.isActive) {
            tl.play();
        }
    }

    var pxl_widget_image_fan_handler = function ($scope) {
        if (typeof gsap === "undefined") {
            return;
        }

        if (typeof ScrollTrigger !== "undefined") {
            gsap.registerPlugin(ScrollTrigger);
        }

        $scope.find(".pxl-image-fan").each(function () {
            setupFan($(this));
        });
    };

    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/pxl_image_fan.default",
            pxl_widget_image_fan_handler,
        );
    });
})(jQuery);
