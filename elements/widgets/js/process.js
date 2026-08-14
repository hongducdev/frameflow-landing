(function ($) {
    "use strict";

    /**
     * Per-node store for gsap.matchMedia() contexts (or fallback shim with .revert).
     * Keys: layout3, …
     */
    function getProcessStore(rootEl) {
        if (!rootEl._pxlProcess) {
            rootEl._pxlProcess = {};
        }
        return rootEl._pxlProcess;
    }

    function revertStoreKey(rootEl, key) {
        var store = rootEl && rootEl._pxlProcess;
        if (!store || !store[key]) {
            return;
        }
        try {
            store[key].revert();
        } catch (e) {
            // ignore
        }
        delete store[key];
    }

    /**
     * @returns {function} Cleanup (kill timeline + clear transforms)
     */
    function layout3CreatePinnedScroll(rootEl) {
        var cards = rootEl.querySelectorAll(".pxl-process3__card");
        if (cards.length < 2) {
            return function () {};
        }

        var cs = window.getComputedStyle(rootEl);
        var staggerStr = cs.getPropertyValue("--pxl-process3-stagger").trim();
        var stagger = parseFloat(staggerStr);
        if (isNaN(stagger) || stagger < 0) {
            stagger = 86;
        }

        var pinStartStr = cs
            .getPropertyValue("--pxl-process3-pin-start")
            .trim();
        var pinStart = parseFloat(pinStartStr);
        if (isNaN(pinStart) || pinStart < 0) {
            pinStart = 120;
        }

        var extraStr = cs
            .getPropertyValue("--pxl-process3-scroll-extra")
            .trim();
        var scrollExtra = parseFloat(extraStr);
        if (isNaN(scrollExtra) || scrollExtra < 0) {
            scrollExtra = 0;
        }

        var intervals = cards.length - 1;
        var staggerScrollPx = intervals * stagger;
        var scrubBuffer = Math.max(32, Math.round(stagger * 0.2));
        var endScrollPx = Math.round(
            staggerScrollPx + scrollExtra + scrubBuffer,
        );

        gsap.set(rootEl, { paddingBottom: staggerScrollPx });
        function syncLayout3Padding(self) {
            var p =
                self && typeof self.progress === "number" ? self.progress : 0;
            if (p < 0) {
                p = 0;
            }
            if (p > 1) {
                p = 1;
            }
            var pb = Math.round((1 - p) * staggerScrollPx);
            rootEl.style.paddingBottom = pb > 0 ? pb + "px" : "0px";
        }

        gsap.set(cards, {
            y: function (index) {
                return index * stagger;
            },
        });

        var tl = gsap.timeline({
            scrollTrigger: {
                trigger: rootEl,
                start: "top " + pinStart + "px",
                end: "+=" + endScrollPx,
                pin: true,
                pinSpacing: false,
                scrub: 1,
                invalidateOnRefresh: true,
                onUpdate: syncLayout3Padding,
            },
        });

        if (tl.scrollTrigger) {
            syncLayout3Padding(tl.scrollTrigger);
        }

        var i;
        for (i = 1; i < cards.length; i++) {
            tl.fromTo(
                cards[i],
                { y: i * stagger },
                { y: 0, duration: 1, ease: "none" },
                i - 1,
            );
        }

        return function () {
            if (tl) {
                tl.kill();
            }
            gsap.set(cards, { clearProps: "transform" });
            rootEl.style.removeProperty("padding-bottom");
        };
    }

    /**
     * @returns {function} Cleanup
     */
    function layout9CreateScrollLine(rootEl) {
        var progress = rootEl.querySelector(".pxl-item--timeline-progress");
        var steps = rootEl.querySelectorAll(".pxl-item--list > .pxl-item");
        var triggers = [];

        if (!progress) {
            return function () {};
        }

        gsap.set(progress, { scaleY: 0, transformOrigin: "top center" });

        var lineTween = gsap.to(progress, {
            scaleY: 1,
            ease: "none",
            scrollTrigger: {
                trigger: rootEl,
                start: "top 75%",
                end: "bottom 25%",
                scrub: 0.6,
                invalidateOnRefresh: true,
            },
        });

        if (lineTween.scrollTrigger) {
            triggers.push(lineTween.scrollTrigger);
        }

        var i;
        for (i = 0; i < steps.length; i++) {
            (function (step) {
                var node = step.querySelector(".pxl-item--node");
                var branch = step.querySelector(".pxl-item--branch");

                if (node) {
                    gsap.set(node, { scale: 0 });
                }
                if (branch) {
                    gsap.set(branch, {
                        scaleX: 0,
                        transformOrigin: "center center",
                    });
                }

                var stepSt = ScrollTrigger.create({
                    trigger: step,
                    start: "top 82%",
                    once: true,
                    onEnter: function () {
                        if (node) {
                            gsap.to(node, {
                                scale: 1,
                                duration: 0.35,
                                ease: "back.out(2)",
                            });
                        }
                        if (branch) {
                            gsap.to(branch, {
                                scaleX: 1,
                                duration: 0.45,
                                ease: "power2.out",
                                delay: 0.08,
                            });
                        }
                    },
                });
                triggers.push(stepSt);
            })(steps[i]);
        }

        return function () {
            var j;
            for (j = 0; j < triggers.length; j++) {
                triggers[j].kill();
            }
            if (lineTween) {
                lineTween.kill();
            }
            gsap.set(progress, { clearProps: "transform" });
            for (i = 0; i < steps.length; i++) {
                var n = steps[i].querySelector(".pxl-item--node");
                var b = steps[i].querySelector(".pxl-item--branch");
                if (n) {
                    gsap.set(n, { clearProps: "transform" });
                }
                if (b) {
                    gsap.set(b, { clearProps: "transform" });
                }
            }
        };
    }

    function initLayout9(rootEl) {
        if (
            typeof gsap === "undefined" ||
            typeof ScrollTrigger === "undefined"
        ) {
            return;
        }

        if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
            return;
        }

        gsap.registerPlugin(ScrollTrigger);

        revertStoreKey(rootEl, "layout9");

        if (typeof gsap.matchMedia === "function") {
            var mm = gsap.matchMedia();
            getProcessStore(rootEl).layout9 = mm;
            mm.add("(min-width: 1024px)", function () {
                return layout9CreateScrollLine(rootEl);
            });
            return;
        }

        var cleanup = null;
        var mql = window.matchMedia("(min-width: 1024px)");

        function syncLayout9Mq() {
            if (cleanup) {
                cleanup();
                cleanup = null;
            }
            if (mql.matches) {
                cleanup = layout9CreateScrollLine(rootEl);
            }
        }

        syncLayout9Mq();

        if (typeof mql.addEventListener === "function") {
            mql.addEventListener("change", syncLayout9Mq);
        } else if (typeof mql.addListener === "function") {
            mql.addListener(syncLayout9Mq);
        }

        getProcessStore(rootEl).layout9 = {
            revert: function () {
                if (typeof mql.removeEventListener === "function") {
                    mql.removeEventListener("change", syncLayout9Mq);
                } else if (typeof mql.removeListener === "function") {
                    mql.removeListener(syncLayout9Mq);
                }
                if (cleanup) {
                    cleanup();
                }
                cleanup = null;
            },
        };
    }

    function initLayout3(rootEl) {
        if (
            typeof gsap === "undefined" ||
            typeof ScrollTrigger === "undefined"
        ) {
            return;
        }

        if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
            return;
        }

        gsap.registerPlugin(ScrollTrigger);

        revertStoreKey(rootEl, "layout3");

        if (typeof gsap.matchMedia === "function") {
            var mm = gsap.matchMedia();
            getProcessStore(rootEl).layout3 = mm;
            mm.add("(min-width: 1024px)", function () {
                return layout3CreatePinnedScroll(rootEl);
            });
            return;
        }

        // Older GSAP core (no gsap.matchMedia): use native matchMedia + cleanup shim
        var cleanup = null;
        var mql = window.matchMedia("(min-width: 1024px)");

        function syncLayout3Mq() {
            if (cleanup) {
                cleanup();
                cleanup = null;
            }
            if (mql.matches) {
                cleanup = layout3CreatePinnedScroll(rootEl);
            } else {
                gsap.set(rootEl.querySelectorAll(".pxl-process3__card"), {
                    clearProps: "transform",
                });
            }
        }

        syncLayout3Mq();

        if (typeof mql.addEventListener === "function") {
            mql.addEventListener("change", syncLayout3Mq);
        } else if (typeof mql.addListener === "function") {
            mql.addListener(syncLayout3Mq);
        }

        getProcessStore(rootEl).layout3 = {
            revert: function () {
                if (typeof mql.removeEventListener === "function") {
                    mql.removeEventListener("change", syncLayout3Mq);
                } else if (typeof mql.removeListener === "function") {
                    mql.removeListener(syncLayout3Mq);
                }
                if (cleanup) {
                    cleanup();
                }
                cleanup = null;
            },
        };
    }

    function pxl_process_widget_handler($scope) {
        if (
            typeof elementorFrontend !== "undefined" &&
            elementorFrontend.isEditMode &&
            elementorFrontend.isEditMode()
        ) {
            return;
        }

        $scope.find(".pxl-process3").each(function () {
            initLayout3(this);
        });

        $scope.find(".pxl-process9").each(function () {
            initLayout9(this);
        });

        // Future: $scope.find('.pxl-process2').each(function () { initLayout2(this); });
    }

    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/pxl_process.default",
            pxl_process_widget_handler,
        );
    });
})(jQuery);
