/**
 * PXL Lazy Script Loader
 * Load heavy third-party scripts only when user scrolls near the elements that need them.
 * Uses IntersectionObserver with a generous rootMargin so scripts load slightly before entering view.
 *
 * @package Frameflow
 */
(function ($) {
    "use strict";

    // Already-loaded script URLs (avoid double-loading)
    var _loadedUrls = {};
    // Already-injected CSS URLs
    var _loadedCss = {};

    /**
     * Dynamically inject a <script> tag and call `callback` when loaded.
     * If the script was already loaded, callback fires immediately.
     */
    function loadScript(url, callback) {
        if (_loadedUrls[url]) {
            if (typeof callback === "function") callback();
            return;
        }
        _loadedUrls[url] = true;
        var script = document.createElement("script");
        script.src = url;
        script.async = true;
        script.onload = function () {
            if (typeof callback === "function") callback();
        };
        script.onerror = function () {
            // Mark as failed so we don't retry infinitely, but still call callback
            if (typeof callback === "function") callback();
        };
        document.body.appendChild(script);
    }

    /**
     * Dynamically inject a <link rel="stylesheet"> if not already injected.
     */
    function loadCss(url) {
        if (_loadedCss[url] || !url) return;
        _loadedCss[url] = true;
        var link = document.createElement("link");
        link.rel = "stylesheet";
        link.href = url;
        document.head.appendChild(link);
    }

    /**
     * Load multiple scripts sequentially and fire `done` when all are loaded.
     * @param {string[]} urls
     * @param {function} done
     */
    function loadScripts(urls, done) {
        if (!urls || urls.length === 0) {
            if (typeof done === "function") done();
            return;
        }
        var remaining = urls.length;
        function onOne() {
            remaining--;
            if (remaining === 0 && typeof done === "function") done();
        }
        urls.forEach(function (url) {
            loadScript(url, onOne);
        });
    }

    // -------------------------------------------------------------------------
    // Rules: which scripts to load for which selectors
    // pxl_lazy_scripts is localized from PHP (wp_localize_script)
    // -------------------------------------------------------------------------
    var scripts = (typeof pxl_lazy_scripts !== "undefined") ? pxl_lazy_scripts : {};

    /**
     * Each rule:
     *   selector  – CSS selector for elements to observe
     *   css       – array of CSS URLs to load (optional)
     *   js        – array of JS URLs to load
     *   onLoaded  – callback fired once ALL js are loaded (receives the matched element)
     *   once      – if true, stop observing after first trigger (default true)
     */
    var rules = [];

    // ---- WOW Animate --------------------------------------------------------
    if (scripts.wow) {
        rules.push({
            selector: ".wow",
            css: [scripts.wow_css],
            js: [scripts.wow],
            once: true, // init once globally
            onLoaded: function () {
                if (typeof WOW === "function") {
                    new WOW({ animateClass: "animated", offset: 80 }).init();
                }
            },
        });
    }

    // ---- Magnific Popup -----------------------------------------------------
    if (scripts.magnific) {
        rules.push({
            selector: ".pxl-action-popup, .pxl-gallery-lightbox, a.lightbox",
            css: [scripts.magnific_css],
            js: [scripts.magnific],
            once: true,
            onLoaded: function () {
                if (typeof $.fn.magnificPopup !== "function") return;
                $(".pxl-action-popup").magnificPopup({
                    type: "iframe",
                    mainClass: "mfp-fade",
                    removalDelay: 160,
                    preloader: false,
                    fixedContentPos: false,
                });
                $(".pxl-gallery-lightbox").each(function () {
                    $(this).magnificPopup({
                        delegate: "a.lightbox",
                        type: "image",
                        gallery: { enabled: true },
                        mainClass: "mfp-fade",
                    });
                });
            },
        });
    }

    // ---- Counter Slide ------------------------------------------------------
    if (scripts.counter) {
        rules.push({
            selector: ".pxl-counter",
            js: [scripts.counter],
            once: true,
            onLoaded: function () {
                // Counter widgets initialise themselves via their own widget JS,
                // just ensure the lib is present.
            },
        });
    }

    // ---- Particles ----------------------------------------------------------
    if (scripts.particles) {
        rules.push({
            selector: ".pxl-row-particles",
            js: [scripts.particles],
            once: true,
            onLoaded: function () {
                var isMobile =
                    /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
                        navigator.userAgent
                    ) || window.innerWidth <= 768;
                if (isMobile) {
                    $(".pxl-row-particles").hide();
                    return;
                }
                $(".pxl-row-particles").each(function () {
                    var $el = $(this);
                    if (typeof particlesJS !== "function") return;
                    particlesJS($el.attr("id"), {
                        particles: {
                            number: { value: $el.data("number") },
                            color: { value: $el.data("color") },
                            shape: { type: "circle" },
                            size: {
                                value: $el.data("size"),
                                random: $el.data("size-random"),
                            },
                            line_linked: { enable: false },
                            move: {
                                enable: true,
                                speed: 2,
                                direction: $el.data("move-direction"),
                                random: true,
                                out_mode: "out",
                            },
                        },
                        retina_detect: true,
                    });
                });
            },
        });
    }

    // ---- Stellar Parallax ---------------------------------------------------
    if (scripts.stellar) {
        rules.push({
            selector: "[data-stellar-ratio]",
            js: [scripts.stellar],
            once: true,
            onLoaded: function () {
                if (typeof $.fn.stellar === "function") {
                    $(window).stellar({
                        responsive: true,
                        positionProperty: "transform",
                        horizontalScrolling: false,
                    });
                }
            },
        });
    }

    // ---- Parallax Move Mouse ------------------------------------------------
    if (scripts.parallax_mouse) {
        rules.push({
            selector: ".pxl-parallax-move-mouse-el",
            js: [scripts.parallax_mouse],
            once: true,
            onLoaded: function () {},
        });
    }

    // =========================================================================
    // Observer engine
    // =========================================================================

    // rootMargin: pre-load 300px before the element enters viewport
    var OBSERVER_MARGIN = "300px";

    function frameflowIsElementorContext() {
        if (document.body.classList.contains("elementor-editor-active")) {
            return true;
        }
        if (typeof window.elementor !== "undefined") {
            return true;
        }
        if (
            typeof window.elementorFrontend !== "undefined" &&
            typeof elementorFrontend.isEditMode === "function" &&
            elementorFrontend.isEditMode()
        ) {
            return true;
        }
        return false;
    }

    function frameflowReplayVisibleWowElements() {
        if (!frameflowIsElementorContext()) {
            return;
        }

        document.querySelectorAll(".wow").forEach(function (el) {
            var delay = parseInt(el.getAttribute("data-wow-delay"), 10) || 0;

            el.classList.remove("animated");
            el.style.animationName = "none";
            el.style.visibility = "hidden";

            void el.offsetWidth;

            var apply = function () {
                el.style.animationName = "";
                el.style.visibility = "visible";
                el.classList.add("animated");
            };

            if (delay > 0) {
                setTimeout(apply, delay);
            } else {
                requestAnimationFrame(apply);
            }
        });
    }

    // In Elementor editor/preview, skip lazy loading entirely so preview is correct
    if (frameflowIsElementorContext()) {
        // Load everything immediately in editor
        rules.forEach(function (rule) {
            if (rule.css) rule.css.forEach(loadCss);
            loadScripts(rule.js, function () {
                if (typeof rule.onLoaded === "function") {
                    rule.onLoaded();
                }
                if (rule.selector === ".wow") {
                    setTimeout(frameflowReplayVisibleWowElements, 50);
                }
            });
        });
        return;
    }

    function setupObserver(rule) {
        var elements = document.querySelectorAll(rule.selector);
        if (!elements || elements.length === 0) return;

        var triggered = false;

        var observer = new IntersectionObserver(
            function (entries) {
                var shouldLoad = entries.some(function (e) {
                    return e.isIntersecting;
                });
                if (!shouldLoad) return;

                if (rule.once) {
                    if (triggered) return;
                    triggered = true;
                    elements.forEach(function (el) {
                        observer.unobserve(el);
                    });
                    observer.disconnect();
                }

                // Load CSS first (non-blocking, fire and forget)
                if (rule.css) rule.css.forEach(loadCss);

                // Load JS then fire callback
                loadScripts(rule.js, rule.onLoaded || function () {});
            },
            { rootMargin: OBSERVER_MARGIN, threshold: 0 }
        );

        elements.forEach(function (el) {
            observer.observe(el);
        });
    }

    // Kick off once DOM is ready
    $(function () {
        if (!("IntersectionObserver" in window)) {
            // Fallback: load everything immediately on older browsers
            rules.forEach(function (rule) {
                if (rule.css) rule.css.forEach(loadCss);
                loadScripts(rule.js, rule.onLoaded || function () {});
            });
            return;
        }

        rules.forEach(function (rule) {
            setupObserver(rule);
        });
    });

})(jQuery);
