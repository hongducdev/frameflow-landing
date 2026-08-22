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
    // CSS URL state: true = ready, "loading" = in flight
    var _loadedCss = {};
    var _cssWaiters = {};

    /**
     * Dynamically inject a <script> tag and call `callback` when loaded.
     * If the script was already loaded, callback fires immediately.
     */
    function filePart(url) {
        return String(url || "").split("?")[0];
    }

    function scriptAlreadyOnPage(url) {
        if (!url) {
            return true;
        }
        if (_loadedUrls[url] || _loadedUrls[filePart(url)]) {
            return true;
        }
        var file = filePart(url);
        var nodes = document.querySelectorAll("script[src]");
        for (var i = 0; i < nodes.length; i++) {
            if (nodes[i].src && nodes[i].src.indexOf(file) !== -1) {
                _loadedUrls[url] = true;
                return true;
            }
        }
        return false;
    }

    function loadScript(url, callback) {
        if (scriptAlreadyOnPage(url)) {
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

    function flushCssWaiters(url) {
        var waiters = _cssWaiters[url] || [];
        delete _cssWaiters[url];
        waiters.forEach(function (cb) {
            if (typeof cb === "function") cb();
        });
    }

    /**
     * Dynamically inject a <link rel="stylesheet"> if not already injected.
     * Calls `callback` after the stylesheet is applied (or immediately if already present).
     */
    function loadCss(url, callback) {
        function done() {
            if (typeof callback === "function") callback();
        }

        if (!url) {
            done();
            return;
        }

        if (_loadedCss[url] === true) {
            done();
            return;
        }

        if (_loadedCss[url] === "loading") {
            if (typeof callback === "function") {
                _cssWaiters[url] = _cssWaiters[url] || [];
                _cssWaiters[url].push(callback);
            }
            return;
        }

        var file = filePart(url);
        var links = document.querySelectorAll('link[rel="stylesheet"]');
        for (var i = 0; i < links.length; i++) {
            if (links[i].href && links[i].href.indexOf(file) !== -1) {
                _loadedCss[url] = true;
                done();
                return;
            }
        }

        _loadedCss[url] = "loading";
        _cssWaiters[url] = typeof callback === "function" ? [callback] : [];

        var link = document.createElement("link");
        var finished = false;
        link.rel = "stylesheet";
        link.href = url;
        function finish() {
            if (finished) {
                return;
            }
            finished = true;
            _loadedCss[url] = true;
            flushCssWaiters(url);
        }
        link.onload = finish;
        link.onerror = finish;
        document.head.appendChild(link);
        if (link.sheet) {
            finish();
        }
    }

    function loadStylesheets(urls, done) {
        urls = (urls || []).filter(Boolean);
        if (!urls.length) {
            if (typeof done === "function") done();
            return;
        }
        var remaining = urls.length;
        urls.forEach(function (url) {
            loadCss(url, function () {
                remaining--;
                if (remaining === 0 && typeof done === "function") done();
            });
        });
    }

    function loadRuleAssets(rule, done) {
        loadStylesheets(rule && rule.css, function () {
            loadScripts(rule && rule.js, done);
        });
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
                // wow.min.js already constructs and inits a global `wow` on load.
                // A second WOW() re-hides boxes the first instance already revealed
                // (visibility:hidden + animation-name:none), which cancels Case Animate.
                if (window.wow && typeof window.wow.sync === "function") {
                    window.wow.sync();
                    return;
                }
                if (typeof WOW === "function") {
                    window.wow = new WOW({ animateClass: "animated", offset: 80 });
                    window.wow.init();
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

    window.frameflowOnPageReady =
        window.frameflowOnPageReady ||
        function (fn) {
            if (typeof fn !== "function") {
                return;
            }
            if (window.frameflowPageReady) {
                fn();
                return;
            }
            var loader = document.getElementById("pxl-loadding");
            var loading = document.body && document.body.classList.contains("pxl-is-loading");
            if ((!loader && !loading) || (loader && loader.classList.contains("is-loaded"))) {
                window.frameflowPageReady = true;
                fn();
                return;
            }
            $(document).one("frameflow/loader/done", fn);
        };

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
            loadRuleAssets(rule, function () {
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

                // Load CSS first so WOW can cache animation names, then JS.
                loadRuleAssets(rule, rule.onLoaded || function () {});
            },
            { rootMargin: OBSERVER_MARGIN, threshold: 0 }
        );

        elements.forEach(function (el) {
            observer.observe(el);
        });
    }

    var _elementorFrontendReady = false;
    var _origOn = null;
    var _patchDepth = 0;

    $(window).on("elementor/frontend/init", function () {
        _elementorFrontendReady = true;
    });

    function patchedOn(types) {
        var fn = arguments[arguments.length - 1];
        if (
            _elementorFrontendReady &&
            this[0] === window &&
            typeof types === "string" &&
            types.indexOf("elementor/frontend/init") !== -1 &&
            typeof fn === "function"
        ) {
            fn.call(window);
            return this;
        }
        return _origOn.apply(this, arguments);
    }

    function withElementorInitPatch(run) {
        _patchDepth++;
        if (_patchDepth === 1) {
            _origOn = $.fn.on;
            $.fn.on = patchedOn;
        }
        run(function () {
            _patchDepth--;
            if (_patchDepth <= 0) {
                _patchDepth = 0;
                if (_origOn) {
                    $.fn.on = _origOn;
                }
            }
        });
    }

    function activateLazyWidget(el) {
        if (!el || el.getAttribute("data-pxl-lazy-done") === "1") {
            return;
        }
        el.setAttribute("data-pxl-lazy-done", "1");

        var css = el.getAttribute("data-pxl-css");
        var urls = [];
        try {
            urls = JSON.parse(el.getAttribute("data-pxl-js") || "[]") || [];
        } catch (e) {
            urls = [];
        }
        urls = urls.filter(Boolean);
        var missing = urls.filter(function (url) {
            return !scriptAlreadyOnPage(url);
        });

        function afterAssets() {
            var needsReadyTrigger =
                urls.length > 0 ||
                !!el.querySelector(
                    ".wow, .pxl-split-text, .TextOutlineAnimation, .text-scroll-reveal"
                );
            if (
                needsReadyTrigger &&
                window.elementorFrontend &&
                elementorFrontend.elementsHandler &&
                typeof elementorFrontend.elementsHandler.runReadyTrigger === "function"
            ) {
                elementorFrontend.elementsHandler.runReadyTrigger(el);
            }
            if (
                window.ScrollTrigger &&
                typeof ScrollTrigger.refresh === "function"
            ) {
                ScrollTrigger.refresh();
            }
            el.classList.add("pxl-lazy-widget--ready");
        }

        loadCss(css, function () {
            if (!missing.length) {
                afterAssets();
                return;
            }

            withElementorInitPatch(function (done) {
                loadScripts(missing, function () {
                    afterAssets();
                    done();
                });
            });
        });
    }

    function setupLazyWidgets() {
        var widgets = document.querySelectorAll(".pxl-lazy-widget");
        if (!widgets.length) {
            return;
        }

        if (!("IntersectionObserver" in window)) {
            widgets.forEach(activateLazyWidget);
            return;
        }

        var observer = new IntersectionObserver(
            function (entries) {
                entries.forEach(function (entry) {
                    if (!entry.isIntersecting) {
                        return;
                    }
                    observer.unobserve(entry.target);
                    activateLazyWidget(entry.target);
                });
            },
            { rootMargin: OBSERVER_MARGIN, threshold: 0 }
        );

        widgets.forEach(function (el) {
            observer.observe(el);
        });
    }

    // Kick off once DOM is ready, but wait out the site loader so
    // WOW/GSAP entrance effects do not finish behind the overlay.
    $(function () {
        window.frameflowOnPageReady(function () {
            if (!("IntersectionObserver" in window)) {
                rules.forEach(function (rule) {
                    loadRuleAssets(rule, rule.onLoaded || function () {});
                });
                setupLazyWidgets();
                return;
            }

            rules.forEach(function (rule) {
                setupObserver(rule);
            });
            setupLazyWidgets();
        });
    });

})(jQuery);
