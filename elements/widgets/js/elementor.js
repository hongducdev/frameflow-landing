;(function ($) {
    if (
        typeof gsap !== "undefined" &&
        typeof ScrollTrigger !== "undefined" &&
        typeof SplitText !== "undefined"
    ) {
        gsap.registerPlugin(ScrollTrigger, SplitText)
    }

    window.frameflowOnPageReady =
        window.frameflowOnPageReady ||
        function (fn) {
            if (typeof fn !== "function") {
                return
            }
            if (window.frameflowPageReady) {
                fn()
                return
            }
            var loader = document.getElementById("pxl-loadding")
            var loading = document.body && document.body.classList.contains("pxl-is-loading")
            if ((!loader && !loading) || (loader && loader.classList.contains("is-loaded"))) {
                window.frameflowPageReady = true
                fn()
                return
            }
            $(document).one("frameflow/loader/done", fn)
        }

    const PXLDIV_MAX_DIST = 140
    const PXLDIV_PEAK = 0.75
    const PXLDIV_SPREAD_MIN = 170
    const PXLDIV_SPREAD_MAX = 250

    const PXLBORDER_MAX_DIST = 300
    const PXLBORDER_PEAK = 0.75
    const PXLBORDER_SPREAD_MIN = 170
    const PXLBORDER_SPREAD_MAX = 300

    function pxl_clamp(v, a, b) {
        return v < a ? a : v > b ? b : v
    }

    function pxl_smoothstep(t) {
        return t * t * (3 - 2 * t)
    }

    function frameflowGetAnimateDelayMs(el) {
        if (!el || !el.getAttribute) {
            return 0
        }

        var raw =
            el.getAttribute("data-pxl-animate-delay") || el.getAttribute("data-wow-delay") || "0"

        return parseInt(String(raw).replace(/ms$/i, ""), 10) || 0
    }

    function frameflowGetAnimateDelaySec(el) {
        return frameflowGetAnimateDelayMs(el) / 1000
    }

    function frameflowMergeAnimateDelay(props, el, extraSec) {
        extraSec = extraSec || 0
        var delay = frameflowGetAnimateDelaySec(el) + extraSec

        if (delay > 0) {
            props.delay = (props.delay || 0) + delay
        }

        return props
    }

    function frameflowApplyPxlAnimated($el, extraDelayMs) {
        extraDelayMs = extraDelayMs || 0
        var delay = frameflowGetAnimateDelayMs($el[0]) + extraDelayMs

        if (delay > 0) {
            setTimeout(function () {
                $el.addClass("pxl-animated")
            }, delay)
            return
        }

        $el.addClass("pxl-animated")
    }

    function frameflowIsElementorEditMode() {
        return (
            window.elementorFrontend &&
            typeof elementorFrontend.isEditMode === "function" &&
            elementorFrontend.isEditMode()
        )
    }

    function frameflowReplayWowElement(el) {
        if (!el || !el.classList || !el.classList.contains("wow")) {
            return
        }

        var $el = $(el)
        var delay = parseInt(el.getAttribute("data-wow-delay"), 10) || 0

        $el.removeClass("animated")
        el.style.animationName = "none"
        el.style.visibility = "hidden"

        void el.offsetWidth

        var apply = function () {
            el.style.animationName = ""
            el.style.visibility = "visible"
            $el.addClass("animated")
        }

        if (delay > 0) {
            setTimeout(apply, delay)
        } else {
            requestAnimationFrame(apply)
        }
    }

    function frameflowCollectWowElements($root) {
        var $root = $root && $root.length ? $root : $(document)

        if ($root.is(".wow")) {
            return $root.add($root.find(".wow"))
        }

        return $root.find(".wow")
    }

    function frameflowReplayWowInScope($scope) {
        if (!frameflowIsElementorEditMode()) {
            return
        }

        var $root = $scope && $scope.length ? $scope : $(document)

        frameflowCollectWowElements($root).each(function () {
            frameflowReplayWowElement(this)
        })

        $root.find(".TextOutlineAnimation").each(function () {
            var el = this
            var $el = $(el)
            $el.removeClass("pxl-animated")
            void el.offsetWidth
            frameflowApplyPxlAnimated($el)
        })

        if (typeof wow !== "undefined" && typeof wow.sync === "function") {
            wow.sync()
        }
    }

    function frameflowSplitTextTrigger(el, config) {
        if (frameflowIsElementorEditMode()) {
            return null
        }

        return {
            scrollTrigger: Object.assign(
                {
                    trigger: el,
                    start: "top 86%",
                    toggleActions: "play none none none",
                },
                config || {}
            ),
        }
    }

    ;(function () {
        function addStyle() {
            if (document.head) {
                var style = document.createElement("style")
                style.textContent =
                    "body:not(.elementor-editor-active) .pxl-animate.pxl-invisible { opacity: 0 !important; visibility: hidden !important; }"
                document.head.appendChild(style)
            } else {
                setTimeout(addStyle, 10)
            }
        }
        addStyle()
    })()

    function frameflow_animation_handler($scope) {
        var $elements = $scope ? $scope.find(".pxl-animate") : $(document).find(".pxl-animate")

        if (frameflowIsElementorEditMode()) {
            $elements.each(function () {
                var $animate_el = $(this),
                    data = $animate_el.data("settings")
                $animate_el.removeClass("pxl-invisible")
                if (typeof data !== "undefined" && typeof data["animation"] !== "undefined") {
                    setTimeout(function () {
                        $animate_el.addClass("animated " + data["animation"])
                    }, data["animation_delay"] || 0)
                } else {
                    setTimeout(function () {
                        $animate_el.addClass("animated fadeInUp")
                    }, 300)
                }
            })

            if ($scope) {
                $scope
                    .find(
                        ".pxl-border-animated, .pxl-section-divider, .pxl-item--rotate-even, .pxl-item--rotate-odd"
                    )
                    .addClass("pxl-animated")

                $scope.find(".TextOutlineAnimation").each(function () {
                    frameflowApplyPxlAnimated($(this))
                })
            }

            return
        }

        $elements.each(function () {
            var $el = $(this)
            if (!$el.hasClass("pxl-invisible")) {
                $el.addClass("pxl-invisible")
            }
        })

        if (window.elementorFrontend && typeof elementorFrontend.waypoint === "function") {
            elementorFrontend.waypoint($elements, function () {
                var $animate_el = $(this),
                    data = $animate_el.data("settings")
                if (typeof data !== "undefined" && typeof data["animation"] !== "undefined") {
                    setTimeout(function () {
                        $animate_el
                            .removeClass("pxl-invisible")
                            .addClass("animated " + data["animation"])
                    }, data["animation_delay"] || 0)
                } else {
                    setTimeout(function () {
                        $animate_el.removeClass("pxl-invisible").addClass("animated fadeInUp")
                    }, 300)
                }
            })
        }

        if (
            $scope &&
            window.elementorFrontend &&
            typeof elementorFrontend.waypoint === "function"
        ) {
            const waypointElements = [
                ".pxl-border-animated",
                ".pxl-section-divider",
                ".TextOutlineAnimation",
                ".pxl-item--rotate-even",
                ".pxl-item--rotate-odd",
            ]
            elementorFrontend.waypoint($scope.find(waypointElements.join(", ")), function () {
                var $el = $(this)
                if ($el.hasClass("TextOutlineAnimation")) {
                    frameflowApplyPxlAnimated($el)
                    return
                }
                $el.addClass("pxl-animated")
            })
        }
    }

    function bind_divider_glow(container) {
        if (!container || container.getAttribute("data-divider-glow-bound") === "1") return

        var dividers = container.querySelectorAll(".pxl-section-divider")
        if (!dividers.length) return

        container.setAttribute("data-divider-glow-bound", "1")

        var state = {
            x: 0,
            y: 0,
            inside: false,
            raf: null,
        }

        function render() {
            state.raf = null
            var rect = container.getBoundingClientRect()
            if (!rect || rect.width === 0 || rect.height === 0) return

            var x = pxl_clamp(state.x - rect.left, 0, rect.width)
            var y = pxl_clamp(state.y - rect.top, 0, rect.height)

            dividers.forEach(function (divider) {
                var isHorizontal =
                    divider.classList.contains("pxl-section-divider--top") ||
                    divider.classList.contains("pxl-section-divider--bottom")
                var target = isHorizontal
                    ? divider.classList.contains("pxl-section-divider--top")
                        ? 0
                        : rect.height
                    : divider.classList.contains("pxl-section-divider--left")
                      ? 0
                      : rect.width
                var dist = Math.abs((isHorizontal ? y : x) - target)
                var t = state.inside ? pxl_clamp(1 - dist / PXLDIV_MAX_DIST, 0, 1) : 0
                var eased = pxl_smoothstep(t)
                var alpha = PXLDIV_PEAK * eased
                var spread = PXLDIV_SPREAD_MAX - (PXLDIV_SPREAD_MAX - PXLDIV_SPREAD_MIN) * eased

                divider.style.setProperty("--pxl-divider-gx", x + "px")
                divider.style.setProperty("--pxl-divider-gy", y + "px")
                divider.style.setProperty("--pxl-divider-alpha", alpha.toFixed(3))
                divider.style.setProperty("--pxl-divider-spread", spread.toFixed(1) + "px")
                divider.setAttribute("data-glow", state.inside && alpha > 0.003 ? "1" : "0")
            })
        }

        function schedule() {
            if (state.raf) return
            state.raf = requestAnimationFrame(render)
        }

        function handleMove(e) {
            state.x = e.clientX
            state.y = e.clientY
            state.inside = true
            schedule()
        }

        function handleLeave() {
            state.inside = false
            schedule()
        }

        var rect = container.getBoundingClientRect()
        state.x = rect.left + rect.width / 2
        state.y = rect.top + rect.height / 2

        container.addEventListener("mousemove", handleMove)
        container.addEventListener("mouseenter", handleMove)
        container.addEventListener("mouseleave", handleLeave)

        schedule()
    }

    function frameflow_section_divider_glow($scope) {
        if (window.innerWidth < 1024) return
        var $context = $scope && $scope.length ? $scope : $(document)
        var hosts = []

        $context.find(".pxl-section-divider").each(function () {
            var host = this.closest(".elementor-element")
            if (host && hosts.indexOf(host) === -1) {
                hosts.push(host)
            }
        })

        hosts.forEach(function (host) {
            bind_divider_glow(host)
        })
    }

    const BorderGlowManager = {
        instances: new Set(),
        x: 0,
        y: 0,
        raf: null,
        initialized: false,

        init() {
            if (this.initialized) return
            document.addEventListener(
                "pointermove",
                (e) => {
                    this.x = e.clientX
                    this.y = e.clientY
                    this.schedule()
                },
                { passive: true }
            )

            window.addEventListener("resize", () => this.updateAllRects(), {
                passive: true,
            })
            window.addEventListener("scroll", () => this.updateAllRects(), {
                passive: true,
            })
            this.initialized = true
        },

        register(instance) {
            this.init()
            this.instances.add(instance)
        },

        unregister(instance) {
            this.instances.delete(instance)
        },

        updateAllRects() {
            if (this.throttleTimer) return
            this.throttleTimer = setTimeout(() => {
                this.instances.forEach((inst) => {
                    if (inst.inViewport) {
                        inst.updateRect()
                    }
                })
                this.schedule()
                this.throttleTimer = null
            }, 100)
        },

        schedule() {
            if (this.raf) return
            this.raf = requestAnimationFrame(() => this.render())
        },

        render() {
            this.raf = null
            this.instances.forEach((inst) => {
                if (inst.inViewport) {
                    inst.render(this.x, this.y)
                }
            })
        },
    }

    function bind_border_glow(host) {
        if (!host || host.getAttribute("data-border-glow-bound") === "1") return

        const glowHost = host.querySelector(".pxl-border-glow")
        if (!glowHost) return

        host.setAttribute("data-border-glow-bound", "1")

        const topGlow = glowHost.querySelector(".pxl-bd-glow.top")
        const rightGlow = glowHost.querySelector(".pxl-bd-glow.right")
        const bottomGlow = glowHost.querySelector(".pxl-bd-glow.bottom")
        const leftGlow = glowHost.querySelector(".pxl-bd-glow.left")

        const instance = {
            host: host,
            inViewport: false,
            rect: null,
            obs: null,

            updateRect() {
                this.rect = this.host.getBoundingClientRect()
            },

            // Calculate distance from point to rectangle
            // Returns 0 if point is inside rectangle, otherwise distance to nearest edge
            distanceToRect(px, py, rect) {
                const dx = Math.max(0, Math.max(rect.left - px, px - rect.right))
                const dy = Math.max(0, Math.max(rect.top - py, py - rect.bottom))
                return Math.sqrt(dx * dx + dy * dy)
            },

            render(mx, my) {
                if (!this.inViewport) {
                    this.setAlpha(0)
                    return
                }

                if (!this.rect) this.updateRect()
                const rect = this.rect
                if (!rect || !rect.width || !rect.height) return

                const distance = this.distanceToRect(mx, my, rect)

                if (distance > PXLBORDER_MAX_DIST) {
                    this.setAlpha(0)
                    return
                }

                const x = pxl_clamp(mx - rect.left, 0, rect.width)
                const y = pxl_clamp(my - rect.top, 0, rect.height)

                const distTop = y
                const distRight = rect.width - x
                const distBottom = rect.height - y
                const distLeft = x

                const baseAlpha = pxl_clamp(1 - distance / PXLBORDER_MAX_DIST, 0, 1)
                const easedBase = pxl_smoothstep(baseAlpha)

                const tTop = pxl_clamp(1 - distTop / PXLBORDER_MAX_DIST, 0, 1)
                const tRight = pxl_clamp(1 - distRight / PXLBORDER_MAX_DIST, 0, 1)
                const tBottom = pxl_clamp(1 - distBottom / PXLBORDER_MAX_DIST, 0, 1)
                const tLeft = pxl_clamp(1 - distLeft / PXLBORDER_MAX_DIST, 0, 1)

                const alpha = PXLBORDER_PEAK * easedBase
                const spread =
                    PXLBORDER_SPREAD_MAX - (PXLBORDER_SPREAD_MAX - PXLBORDER_SPREAD_MIN) * easedBase

                this.host.style.setProperty("--pxl-bd-gx", x + "px")
                this.host.style.setProperty("--pxl-bd-gy", y + "px")
                this.host.style.setProperty("--pxl-bd-alpha", alpha.toFixed(3))
                this.host.style.setProperty("--pxl-bd-spread", spread.toFixed(1) + "px")

                if (topGlow) topGlow.style.opacity = (pxl_smoothstep(tTop) * easedBase).toFixed(3)
                if (rightGlow)
                    rightGlow.style.opacity = (pxl_smoothstep(tRight) * easedBase).toFixed(3)
                if (bottomGlow)
                    bottomGlow.style.opacity = (pxl_smoothstep(tBottom) * easedBase).toFixed(3)
                if (leftGlow)
                    leftGlow.style.opacity = (pxl_smoothstep(tLeft) * easedBase).toFixed(3)
            },

            setAlpha(val) {
                this.host.style.setProperty("--pxl-bd-alpha", val)
                if (topGlow) topGlow.style.opacity = val
                if (rightGlow) rightGlow.style.opacity = val
                if (bottomGlow) bottomGlow.style.opacity = val
                if (leftGlow) leftGlow.style.opacity = val
            },
        }

        instance.obs = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.target !== host) return
                    instance.inViewport = !!entry.isIntersecting
                    if (instance.inViewport) {
                        instance.updateRect()
                        BorderGlowManager.schedule()
                    } else {
                        instance.setAlpha(0)
                    }
                })
            },
            { threshold: 0.1 }
        )

        instance.obs.observe(host)
        BorderGlowManager.register(instance)

        // cleanup
        host._pxlBorderGlowCleanup = function () {
            if (instance.obs) instance.obs.disconnect()
            BorderGlowManager.unregister(instance)
            host.removeAttribute("data-border-glow-bound")
            delete host._pxlBorderGlowCleanup
        }
    }

    function frameflow_border_glow($scope) {
        if (window.innerWidth < 1024) return
        var $context = $scope && $scope.length ? $scope : $(document)
        $context.find(".pxl-border-section-anm").each(function () {
            bind_border_glow(this)
        })
    }

    function frameflow_polyfill_waypoint() {
        if (!window.elementorFrontend || typeof elementorFrontend.waypoint === "function") return
        elementorFrontend.waypoint = function ($elements, handler, options) {
            options = options || {}
            var triggerOnce = typeof options.triggerOnce === "boolean" ? options.triggerOnce : true
            var offset = options.offset
            var rootMargin = "0px 0px 0px 0px"
            if (typeof offset === "string" && /%$/.test(offset)) {
                var percent = parseFloat(offset)
                if (!isNaN(percent)) {
                    var bottomPercent = Math.max(0, 100 - percent)
                    rootMargin = "0px 0px -" + bottomPercent + "% 0px"
                }
            } else if (typeof offset === "number") {
                rootMargin = "0px 0px -" + offset + "px 0px"
            }
            if ("IntersectionObserver" in window) {
                var observer = new IntersectionObserver(
                    function (entries) {
                        entries.forEach(function (entry) {
                            if (entry.isIntersecting || entry.intersectionRatio > 0) {
                                handler.call(entry.target)
                                if (triggerOnce) {
                                    observer.unobserve(entry.target)
                                }
                            }
                        })
                    },
                    { root: null, rootMargin: rootMargin, threshold: 0 }
                )
                $($elements).each(function () {
                    var dom =
                        this instanceof Element
                            ? this
                            : this && this[0] instanceof Element
                              ? this[0]
                              : null
                    if (dom) observer.observe(dom)
                })
            } else {
                $($elements).each(function () {
                    handler.call(this)
                })
            }
        }
    }

    function frameflow_section_start_render() {
        var _elementor = typeof elementor !== "undefined" ? elementor : elementorFrontend

        _elementor.hooks.addFilter(
            "pxl_element_container/before-render",
            function (html, settings) {
                if (
                    typeof settings.pxl_parallax_bg_img !== "undefined" &&
                    settings.pxl_parallax_bg_img &&
                    settings.pxl_parallax_bg_img.url !== ""
                ) {
                    var scrollEffect = settings.pxl_parallax_bg_scroll_effect || "none"
                    var isDesktopViewport =
                        typeof window !== "undefined" &&
                        window.matchMedia &&
                        window.matchMedia("(min-width: 768px)").matches
                    if (scrollEffect === "stellar" && isDesktopViewport) {
                        var r = settings.pxl_parallax_bg_stellar_ratio
                        var ratio = r !== undefined && r !== null && r !== "" ? String(r) : "0.79"
                        html +=
                            '<div class="pxl-section-bg-parallax pxl--parallax" data-stellar-background-ratio="' +
                            ratio +
                            '"></div>'
                    } else {
                        html += '<div class="pxl-section-bg-parallax"></div>'
                    }
                }

                if (
                    typeof settings.pxl_color_offset !== "undefined" &&
                    settings.pxl_color_offset !== "none"
                ) {
                    html += '<div class="pxl-section-overlay-color"></div>'
                }

                if (
                    typeof settings.pxl_overlay_img !== "undefined" &&
                    settings.pxl_overlay_img &&
                    settings.pxl_overlay_img.url !== ""
                ) {
                    html +=
                        '<div class="pxl-overlay--image pxl-overlay--imageLeft"><div class="bg-image"></div></div>'
                }

                if (
                    typeof settings.pxl_overlay_img2 !== "undefined" &&
                    settings.pxl_overlay_img2 &&
                    settings.pxl_overlay_img2.url !== ""
                ) {
                    html +=
                        '<div class="pxl-overlay--image pxl-overlay--imageRight"><div class="bg-image"></div></div>'
                }

                return html
            }
        )

        // Chờ DOM ready trước khi tìm elements
        $(document).ready(function () {
            $(".pxl-section-bg-parallax")
                .closest(".elementor-element")
                .addClass("pxl-section-parallax-overflow")
        })
    }

    function frameflow_css_inline_js() {
        var _inline_css = "<style>"
        $(document)
            .find(".pxl-inline-css")
            .each(function () {
                var _this = $(this)
                _inline_css += _this.attr("data-css") + " "
                _this.remove()
            })
        _inline_css += "</style>"
        $("head").append(_inline_css)
    }

    function frameflow_section_before_render() {
        var _elementor = typeof elementor !== "undefined" ? elementor : elementorFrontend
        _elementor.hooks.addFilter(
            "pxl-custom-section/before-render",
            function (html, settings, el) {
                if (typeof settings["row_divider"] !== "undefined") {
                    if (
                        settings["row_divider"] === "angle-top" ||
                        settings["row_divider"] === "angle-bottom" ||
                        settings["row_divider"] === "angle-top-right" ||
                        settings["row_divider"] === "angle-bottom-left"
                    ) {
                        html =
                            '<svg class="pxl-row-angle" style="fill:#ffffff" xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 100 100" version="1.1" preserveAspectRatio="none" height="130px"><path stroke="" stroke-width="0" d="M0 100 L100 0 L200 100"></path></svg>'
                        return html
                    }
                    if (
                        settings["row_divider"] === "angle-top-bottom" ||
                        settings["row_divider"] === "angle-top-bottom-left"
                    ) {
                        html =
                            '<svg class="pxl-row-angle pxl-row-angle-top" style="fill:#ffffff" xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 100 100" version="1.1" preserveAspectRatio="none" height="130px"><path stroke="" stroke-width="0" d="M0 100 L100 0 L200 100"></path></svg><svg class="pxl-row-angle pxl-row-angle-bottom" style="fill:#ffffff" xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 100 100" version="1.1" preserveAspectRatio="none" height="130px"><path stroke="" stroke-width="0" d="M0 100 L100 0 L200 100"></path></svg>'
                        return html
                    }
                    if (
                        settings["row_divider"] === "wave-animation-top" ||
                        settings["row_divider"] === "wave-animation-bottom"
                    ) {
                        html =
                            '<svg class="pxl-row-angle" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" viewBox="0 0 1440 150" fill="#fff"><path d="M 0 26.1978 C 275.76 83.8152 430.707 65.0509 716.279 25.6386 C 930.422 -3.86123 1210.32 -3.98357 1439 9.18045 C 2072.34 45.9691 2201.93 62.4429 2560 26.198 V 172.199 L 0 172.199 V 26.1978 Z"><animate repeatCount="indefinite" fill="freeze" attributeName="d" dur="10s" values="M0 25.9086C277 84.5821 433 65.736 720 25.9086C934.818 -3.9019 1214.06 -5.23669 1442 8.06597C2079 45.2421 2208 63.5007 2560 25.9088V171.91L0 171.91V25.9086Z; M0 86.3149C316 86.315 444 159.155 884 51.1554C1324 -56.8446 1320.29 34.1214 1538 70.4063C1814 116.407 2156 188.408 2560 86.315V232.317L0 232.316V86.3149Z; M0 53.6584C158 11.0001 213 0 363 0C513 0 855.555 115.001 1154 115.001C1440 115.001 1626 -38.0004 2560 53.6585V199.66L0 199.66V53.6584Z; M0 25.9086C277 84.5821 433 65.736 720 25.9086C934.818 -3.9019 1214.06 -5.23669 1442 8.06597C2079 45.2421 2208 63.5007 2560 25.9088V171.91L0 171.91V25.9086Z"></animate></path></svg>'
                        return html
                    }
                    if (
                        settings["row_divider"] === "curved-top" ||
                        settings["row_divider"] === "curved-bottom"
                    ) {
                        html =
                            '<svg class="pxl-row-angle" xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 1920 128" version="1.1" preserveAspectRatio="none" style="fill:#ffffff"><path stroke-width="0" d="M-1,126a3693.886,3693.886,0,0,1,1921,2.125V-192H-7Z"></path></svg>'
                        return html
                    }
                }
            }
        )
    }

    var PXL_Icon_Contact_Form = function ($scope, $) {
        setTimeout(function () {
            $(".pxl--item").each(function () {
                var icon_input = $(this).find(".pxl--form-icon"),
                    control_wrap = $(this).find(".wpcf7-form-control")
                control_wrap.before(icon_input.clone())
                icon_input.remove()
            })
        }, 10)
    }

    function frameflow_split_text($scope) {
        var st = $scope.find(".pxl-split-text")
        if (st.length === 0) return

        if (
            typeof gsap === "undefined" ||
            typeof SplitText === "undefined" ||
            typeof ScrollTrigger === "undefined"
        ) {
            console.warn("GSAP, SplitText, or ScrollTrigger plugin not loaded")
            return
        }

        st.each(function (index, el) {
            // Cleanup previous instances
            if (el.pxl_split_anim) {
                el.pxl_split_anim.kill()
                el.pxl_split_anim = null
            }
            if (el.pxl_split_instance) {
                el.pxl_split_instance.revert()
                el.pxl_split_instance = null
            }

            var els = $(el).find("p").length > 0 ? $(el).find("p")[0] : el

            // Determine split type based on class
            let types = "lines, words, chars"
            if ($(el).hasClass("split-up") || $(el).hasClass("split-words-scale")) {
                types = "words"
            }

            const pxl_split = new SplitText(els, {
                type: types,
                lineThreshold: 0.5,
                linesClass: "split-line",
            })
            el.pxl_split_instance = pxl_split

            var split_type_set = pxl_split.chars // Default to chars
            if ($(el).hasClass("split-up") || $(el).hasClass("split-words-scale")) {
                split_type_set = pxl_split.words
            }

            gsap.set(els, { perspective: 400 })

            if ($(el).hasClass("split-up")) {
                el.pxl_split_anim = gsap.from(
                    split_type_set,
                    frameflowMergeAnimateDelay(
                        Object.assign(
                            {
                                opacity: 0,
                                duration: 0.65,
                                y: 60,
                                stagger: 0.065,
                                delay: 0.25,
                                ease: "expo.out",
                            },
                            frameflowSplitTextTrigger(el, {
                                toggleActions: "play none none none",
                            }) || {}
                        ),
                        el,
                        frameflowIsElementorEditMode() ? 0.15 : 0
                    )
                )
            } else if ($(el).hasClass("split-words-scale")) {
                split_type_set.forEach((elw, i) => {
                    gsap.set(elw, {
                        opacity: 0,
                        scale: i % 2 === 0 ? 0 : 2,
                        force3D: true,
                    })
                })

                el.pxl_split_anim = gsap.to(
                    split_type_set,
                    frameflowMergeAnimateDelay(
                        Object.assign(
                            {
                                duration: 0.8,
                                stagger: 0.04,
                                ease: "expo.out",
                                rotateX: 0,
                                scale: 1,
                                opacity: 1,
                            },
                            frameflowSplitTextTrigger(el, {
                                toggleActions: "play reverse play reverse",
                            }) || {}
                        ),
                        el,
                        frameflowIsElementorEditMode() ? 0.15 : 0
                    )
                )
            } else {
                var settings = frameflowMergeAnimateDelay(
                    Object.assign(
                        {
                            duration: 0.35,
                            stagger: 0.02,
                            ease: "Expo.out",
                        },
                        frameflowSplitTextTrigger(els, { once: true }) || {}
                    ),
                    el,
                    frameflowIsElementorEditMode() ? 0.15 : 0
                )

                if ($(el).hasClass("split-in-fade")) settings.opacity = 0
                if ($(el).hasClass("split-in-right")) {
                    settings.opacity = 0
                    settings.x = "50"
                }
                if ($(el).hasClass("split-in-left")) {
                    settings.opacity = 0
                    settings.x = "-50"
                }
                if ($(el).hasClass("split-in-up")) {
                    settings.opacity = 0
                    settings.y = "80"
                }
                if ($(el).hasClass("split-in-down")) {
                    settings.opacity = 0
                    settings.y = "-80"
                }
                if ($(el).hasClass("split-in-rotate")) {
                    settings.opacity = 0
                    settings.rotateX = "50deg"
                }
                if ($(el).hasClass("split-in-scale")) {
                    settings.opacity = 0
                    settings.scale = "0.5"
                }
                if ($(el).hasClass("split-lines-transform")) {
                    pxl_split.split({
                        type: "lines",
                        lineThreshold: 0.5,
                        linesClass: "split-line",
                    })
                    split_type_set = pxl_split.lines
                    settings.opacity = 0
                    settings.yPercent = 100
                    settings.autoAlpha = 0
                    settings.stagger = 0.1
                }

                if ($(el).hasClass("split-lines-transform-down")) {
                    pxl_split.split({
                        type: "lines",
                        lineThreshold: 0.5,
                        linesClass: "split-line",
                    })
                    split_type_set = pxl_split.lines
                    settings.opacity = 0
                    settings.yPercent = -100
                    settings.autoAlpha = 0
                    settings.stagger = 0.1
                }

                if ($(el).hasClass("split-chars-blur-scroll")) {
                    if (!split_type_set.length) return

                    if (
                        window.matchMedia &&
                        window.matchMedia("(prefers-reduced-motion: reduce)").matches
                    ) {
                        gsap.set(split_type_set, {
                            autoAlpha: 1,
                            xPercent: 0,
                            filter: "blur(0px)",
                        })
                        return
                    }

                    el.pxl_split_anim = gsap.fromTo(
                        split_type_set,
                        {
                            autoAlpha: 0,
                            xPercent: -100,
                            filter: "blur(8px)",
                        },
                        Object.assign(
                            {
                                autoAlpha: 1,
                                xPercent: 0,
                                filter: "blur(0px)",
                                duration: 1.5,
                                ease: "power4.out",
                                stagger: 0.05,
                            },
                            frameflowIsElementorEditMode()
                                ? {}
                                : {
                                      scrollTrigger: {
                                          trigger: el,
                                          start: "top 90%",
                                          end: "top 20%",
                                          scrub: 1,
                                      },
                                  }
                        )
                    )

                    return
                }

                if ($(el).hasClass("split-words-blur")) {
                    pxl_split.split({ type: "words" })
                    split_type_set = pxl_split.words

                    if (!split_type_set.length) return

                    gsap.set(split_type_set, {
                        opacity: 0,
                        y: 50,
                        filter: "blur(15px)",
                        force3D: true,
                    })

                    gsap.to(
                        split_type_set,
                        frameflowMergeAnimateDelay(
                            Object.assign(
                                {
                                    opacity: 1,
                                    y: 0,
                                    filter: "blur(0px)",
                                    duration: 0.6,
                                    ease: "power2.out",
                                    stagger: 0.05,
                                },
                                frameflowSplitTextTrigger(el, {
                                    toggleActions: "play none none none",
                                }) || {}
                            ),
                            el,
                            frameflowIsElementorEditMode() ? 0.15 : 0
                        )
                    )

                    return
                }

                if ($(el).hasClass("split-lines-rotation-x")) {
                    pxl_split.split({
                        type: "lines",
                        lineThreshold: 0.5,
                        linesClass: "split-line",
                    })
                    split_type_set = pxl_split.lines
                    settings.opacity = 0
                    settings.rotationX = -120
                    settings.transformOrigin = "top center -50"
                    settings.autoAlpha = 0
                    settings.stagger = 0.1
                }

                if ($(el).hasClass("btn-text-timeline")) {
                    settings.opacity = 0
                    settings.scale = "1.2"
                    settings.y = "-60"
                    settings.transformOrigin = "top center -50"
                    settings.autoAlpha = 0
                    settings.stagger = 0.05
                }

                if ($(el).hasClass("split-up")) {
                    pxl_split.split({ type: "words" })
                    split_type_set = pxl_split.words

                    $(split_type_set).each(function (index, elw) {
                        gsap.from(
                            elw,
                            {
                                opacity: 0,
                                duration: 1.5,
                                y: 80,
                                delay: 0.25,
                                ease: "power4",
                                stagger: {
                                    each: 0.15,
                                },
                            },
                            index * 0.1
                        )
                    })
                }

                el.pxl_split_anim = gsap.from(split_type_set, settings)
            }

            if ($(el).hasClass("hover-split-text")) {
                $(el).on("mouseenter", function () {
                    if (el.pxl_split_anim) el.pxl_split_anim.restart()
                })
            }
        })
    }

    function frameflow_zoom_point() {
        if (!window.elementorFrontend || typeof elementorFrontend.waypoint !== "function") return

        var $zoomPoints = $(document).find(".pxl-zoom-point")
        if ($zoomPoints.length === 0) return

        elementorFrontend.waypoint(
            $zoomPoints,
            function () {
                var $el = $(this)
                $el.addClass("pxl-zoom-active")
            },
            {
                offset: -100,
                triggerOnce: true,
            }
        )
    }

    function frameflow_scroll_fixed_section() {
        if (typeof gsap === "undefined" || typeof ScrollTrigger === "undefined") return

        ScrollTrigger.matchMedia({
            "(min-width: 991px)": function () {
                // Feature 1: Top Fixed Section pinned to Bottom Section
                const fixedTops = document.querySelectorAll(".pxl-section-fix-top")
                const fixedBottoms = document.querySelectorAll(".pxl-section-fix-bottom")

                fixedBottoms.forEach((fixedBottom, index) => {
                    const fixedTop = fixedTops[index]
                    if (fixedTop) {
                        ScrollTrigger.create({
                            trigger: fixedBottom,
                            pin: fixedTop,
                            start: "top bottom",
                            end: "bottom top",
                            scrub: 1, // Smooth scrub
                            pinSpacing: false,
                        })

                        const bottomOverlay = fixedBottom.querySelector(
                            ".pxl-section-overlay-color"
                        )
                        if (bottomOverlay) {
                            gsap.to(bottomOverlay, {
                                scrollTrigger: {
                                    trigger: fixedBottom,
                                    scrub: 1,
                                    start: "top bottom",
                                    end: "bottom top",
                                },
                            })
                        }
                    }
                })

                // Feature 2: Scroll Overlay Animation
                const overlayColors = document.querySelectorAll(".pxl-section-overlay-color")
                const overlayScrolls = document.querySelectorAll(".overlay-type-scroll")
                const bgColorScrolls = document.querySelectorAll(".pxl-bg-color-scroll")

                bgColorScrolls.forEach((bgColorScroll, index) => {
                    const overlayColor = overlayColors[index]
                    const overlayScroll = overlayScrolls[index]

                    if (overlayColor && overlayScroll) {
                        const data = overlayColor.dataset
                        const top = data.spaceTop || 0
                        const left = data.spaceLeft || 0
                        const right = data.spaceRight || 0
                        const bottom = data.spaceBottom || 0
                        const rTop = data.radiusTop || 0
                        const rLeft = data.radiusLeft || 0
                        const rRight = data.radiusRight || 0
                        const rBottom = data.radiusBottom || 0
                        const radius = `${rTop}px ${rRight}px ${rBottom}px ${rLeft}px`

                        gsap.to(overlayScroll, {
                            scrollTrigger: {
                                trigger: bgColorScroll,
                                scrub: 1,
                                pinSpacing: false,
                                start: "top bottom",
                                end: "bottom top",
                            },
                            left: left + "px",
                            right: right + "px",
                            top: top + "px",
                            bottom: bottom + "px",
                            borderRadius: radius,
                            ease: "none",
                        })
                    }
                })
            },
        })
    }

    function frameflow_animation_btn($scope) {
        const $section = $scope.find(
            ".pxl-video-player:not(.pxl-video-style-button) .pxl-video--inner"
        )
        const cursor = $section.find(".btn-video-wrap.p-cursor").get(0)

        if (!cursor || !$section.length || typeof gsap === "undefined") return

        if (cursor.__frameflowDestroy) {
            cursor.__frameflowDestroy()
        }

        const moveX = gsap.quickTo(cursor, "x", {
            duration: 0.25,
            ease: "power3.out",
        })
        const moveY = gsap.quickTo(cursor, "y", {
            duration: 0.25,
            ease: "power3.out",
        })
        const isCenterPosition = cursor.classList.contains("p-center")

        let rect = $section[0].getBoundingClientRect()
        let cursorWidth = 0
        let cursorHeight = 0
        let baseLeft = 0
        let baseTop = 0

        function clamp(value, min, max) {
            return Math.min(Math.max(value, min), max)
        }

        function syncMetrics(resetPosition) {
            if (!$section.length || !document.body.contains(cursor)) {
                return
            }

            rect = $section[0].getBoundingClientRect()
            if (resetPosition) {
                gsap.set(cursor, { x: 0, y: 0 })
            }

            const cursorRect = cursor.getBoundingClientRect()
            cursorWidth = cursorRect.width
            cursorHeight = cursorRect.height
            baseLeft = cursorRect.left - rect.left
            baseTop = cursorRect.top - rect.top
        }

        function moveInside(left, top) {
            const maxLeft = Math.max(0, rect.width - cursorWidth)
            const maxTop = Math.max(0, rect.height - cursorHeight)
            const clampedLeft = clamp(left, 0, maxLeft)
            const clampedTop = clamp(top, 0, maxTop)

            moveX(clampedLeft - baseLeft)
            moveY(clampedTop - baseTop)
        }

        function resetToDefaultPosition() {
            moveX(0)
            moveY(0)
        }

        function centerCursor() {
            moveInside(rect.width / 2 - cursorWidth / 2, rect.height / 2 - cursorHeight / 2)
        }

        function updateRect() {
            if ($section.length) {
                syncMetrics(true)
            }
        }
        window.addEventListener("scroll", updateRect, { passive: true })
        window.addEventListener("resize", updateRect, { passive: true })

        function onMove(e) {
            if (
                e.clientX < rect.left ||
                e.clientX > rect.right ||
                e.clientY < rect.top ||
                e.clientY > rect.bottom
            )
                return

            moveInside(
                e.clientX - rect.left - cursorWidth / 2,
                e.clientY - rect.top - cursorHeight / 2
            )
        }

        $section.on("mousemove", onMove)
        $section.on("mouseleave", isCenterPosition ? centerCursor : resetToDefaultPosition)

        syncMetrics(true)
        if (isCenterPosition) {
            centerCursor()
        } else {
            resetToDefaultPosition()
        }

        cursor.__frameflowDestroy = () => {
            $section.off("mousemove", onMove)
            $section.off("mouseleave", centerCursor)
            window.removeEventListener("scroll", updateRect)
            window.removeEventListener("resize", updateRect)
        }
    }

    function frameflow_scroll_text($scope) {
        if (
            typeof gsap === "undefined" ||
            typeof SplitText === "undefined" ||
            typeof ScrollTrigger === "undefined"
        ) {
            return
        }

        const elements = $scope.find(".pxl-non-existent-text-banner-caption")
        if (elements.length === 0) return

        let mm = gsap.matchMedia()

        mm.add("(min-width: 768px)", () => {
            elements.each(function () {
                const el = this

                // Cleanup previous animation and SplitText
                if (el.pxl_scroll_tween) {
                    el.pxl_scroll_tween.kill()
                    el.pxl_scroll_tween = null
                }
                if (el.pxl_split) {
                    el.pxl_split.revert()
                    el.pxl_split = null
                }

                const text = new SplitText(el, { type: "words, chars" })
                el.pxl_split = text

                $(text.words).children().first().addClass("first-char")

                el.pxl_scroll_tween = gsap.fromTo(
                    text.chars,
                    {
                        position: "relative",
                        display: "inline-block",
                        opacity: 0.1,
                        x: -10,
                        willChange: "opacity, transform",
                    },
                    {
                        opacity: 1,
                        x: 0,
                        stagger: 0.05,
                        ease: "none",
                        scrollTrigger: {
                            trigger: el,
                            toggleActions: "play pause reverse pause",
                            start: "top 85%",
                            end: "top 45%",
                            scrub: 1,
                            onRefresh: () => {
                                // Added to combat initialization order issues
                                if (el.pxl_scroll_tween) el.pxl_scroll_tween.invalidate()
                            },
                        },
                    }
                )
            })

            return () => {
                // Cleanup on context revert
                elements.each(function () {
                    if (this.pxl_scroll_tween) this.pxl_scroll_tween.kill()
                    if (this.pxl_split) this.pxl_split.revert()
                })
            }
        })
    }

    function frameflow_heading_text_scroll_reveal($scope) {
        if (
            typeof gsap === "undefined" ||
            typeof SplitText === "undefined" ||
            typeof ScrollTrigger === "undefined"
        ) {
            return
        }

        const $widgets = $scope.find(".pxl-heading.text-scroll-reveal")
        if (!$widgets.length) return

        $widgets.each(function () {
            const widgetEl = this
            const $widget = $(widgetEl)
            const $text = $widget.find(".pxl-heading--text").first()
            if (!$text.length) return

            if (widgetEl.__pxlScrollRevealCleanup) {
                widgetEl.__pxlScrollRevealCleanup()
            }

            const state = {
                split: null,
                tweens: [],
            }

            const element = $text.get(0)

            state.split = new SplitText(element, {
                type: "words, chars",
                wordsClass: "word",
                charsClass: "char",
            })

            const updateGradientAlignment = () => {
                const $words = element.querySelectorAll(".word")
                if (!$words || !$words.length) return

                const containerRect = element.getBoundingClientRect()
                const containerWidth = containerRect.width
                if (!containerWidth) return

                $words.forEach((wordEl) => {
                    const wordRect = wordEl.getBoundingClientRect()
                    const left = wordRect.left - containerRect.left
                    wordEl.style.backgroundSize = `${containerWidth}px 100%`
                    wordEl.style.backgroundPositionX = `${-left}px`
                })
            }

            updateGradientAlignment()

            let resizeRaf = null
            const onResize = () => {
                if (resizeRaf) cancelAnimationFrame(resizeRaf)
                resizeRaf = requestAnimationFrame(function () {
                    updateGradientAlignment()
                })
            }
            window.addEventListener("resize", onResize)

            const styles = window.getComputedStyle(widgetEl)
            const revealModeAttr = (widgetEl.getAttribute("data-pxl-sr-mode") || "")
                .trim()
                .toLowerCase()
            const revealMode = revealModeAttr === "auto" ? "auto" : "scroll"

            const opacityFromRaw = styles.getPropertyValue("--pxl-sr-opacity-from").trim()
            const opacityToRaw = styles.getPropertyValue("--pxl-sr-opacity-to").trim()
            const opacityFrom = opacityFromRaw !== "" ? parseFloat(opacityFromRaw) : 0.4
            const opacityTo = opacityToRaw !== "" ? parseFloat(opacityToRaw) : 1
            const scrollSpeedRaw = styles.getPropertyValue("--pxl-sr-speed").trim()
            const scrollSpeed =
                scrollSpeedRaw !== "" && !isNaN(parseFloat(scrollSpeedRaw))
                    ? Math.max(0.01, parseFloat(scrollSpeedRaw))
                    : 0.3
            const autoSpeedRaw = styles.getPropertyValue("--pxl-sr-auto-speed").trim()
            const autoSpeed =
                autoSpeedRaw !== "" && !isNaN(parseFloat(autoSpeedRaw))
                    ? Math.max(0.1, parseFloat(autoSpeedRaw))
                    : 2

            const opacityTargets =
                (state.split.words && state.split.words.length
                    ? state.split.words
                    : state.split.chars) || []
            if (!opacityTargets.length) return

            let tweenOpacity = null

            if (revealMode === "auto") {
                const autoDuration = Math.min(8, Math.max(0.4, autoSpeed))
                const autoStagger = Math.max(
                    0.01,
                    autoDuration / Math.max(opacityTargets.length, 1)
                )

                tweenOpacity = gsap.fromTo(
                    opacityTargets,
                    { opacity: isNaN(opacityFrom) ? 0.4 : opacityFrom },
                    {
                        opacity: isNaN(opacityTo) ? 1 : opacityTo,
                        duration: autoDuration,
                        stagger: autoStagger,
                        ease: "power1.out",
                        scrollTrigger: {
                            trigger: element,
                            start: "top 80%",
                            toggleActions: "play none none none",
                        },
                    }
                )
            } else {
                const baseStart = 80
                const clampedSpeed = Math.min(2, Math.max(0.05, scrollSpeed))
                const normalized = clampedSpeed / 0.3
                const baseRange = 60
                const dynamicRange = Math.max(10, baseRange / normalized)
                const endPos = baseStart - dynamicRange

                tweenOpacity = gsap.fromTo(
                    opacityTargets,
                    { opacity: isNaN(opacityFrom) ? 0.4 : opacityFrom },
                    {
                        opacity: isNaN(opacityTo) ? 1 : opacityTo,
                        duration: scrollSpeed,
                        stagger: Math.max(0.005, scrollSpeed / 15),
                        scrollTrigger: {
                            trigger: element,
                            start: `top ${baseStart}%`,
                            end: `top ${endPos}%`,
                            scrub: true,
                            toggleActions: "play play reverse reverse",
                        },
                    }
                )
            }

            state.tweens.push(tweenOpacity)

            widgetEl.__pxlScrollRevealCleanup = () => {
                state.tweens.forEach((tw) => tw && tw.kill && tw.kill())
                state.tweens = []
                if (state.split) {
                    state.split.revert()
                    state.split = null
                }
                window.removeEventListener("resize", onResize)
                if (resizeRaf) cancelAnimationFrame(resizeRaf)
                delete widgetEl.__pxlScrollRevealCleanup
            }

            $widget.on("remove", function () {
                if (widgetEl.__pxlScrollRevealCleanup) widgetEl.__pxlScrollRevealCleanup()
            })
        })
    }

    function frameflow_divider_in_viewport(el) {
        if (!el || typeof el.getBoundingClientRect !== "function") {
            return false
        }

        const rect = el.getBoundingClientRect()
        const vh = window.innerHeight || document.documentElement.clientHeight
        const vw = window.innerWidth || document.documentElement.clientWidth

        return rect.bottom > 0 && rect.top < vh && rect.right > 0 && rect.left < vw
    }

    function frameflow_divider_reveal_el(el) {
        if (!el || el.classList.contains("visible")) {
            return
        }
        el.classList.add("visible")
    }

    function frameflow_divider_try_reveal(el) {
        if (!el || el.classList.contains("visible")) {
            return true
        }

        const rect = el.getBoundingClientRect()
        const probe =
            rect.width > 0 || rect.height > 0
                ? el
                : el.closest(".elementor-widget-pxl_divider") || el

        if (frameflow_divider_in_viewport(probe)) {
            frameflow_divider_reveal_el(el)
            return true
        }

        return false
    }

    function frameflow_divider_prep_scroll_el(el) {
        if (!el) {
            return
        }

        const direction = el.getAttribute("data-scroll-direction") || "horizontal"
        const isVertical =
            direction === "vertical" || direction === "vertical-reverse"
        const isReverse =
            direction === "horizontal-reverse" || direction === "vertical-reverse"
        const axisClass = isVertical
            ? "pxl-el-divider--scroll-v"
            : "pxl-el-divider--scroll-h"

        el.classList.add("pxl-el-divider--scroll")
        if (
            !el.classList.contains("pxl-el-divider--scroll-h") &&
            !el.classList.contains("pxl-el-divider--scroll-v")
        ) {
            el.classList.add(axisClass)
        }
        el.classList.toggle("pxl-el-divider--scroll-reverse", isReverse)

        const duration = parseInt(el.getAttribute("data-scroll-duration"), 10)
        if (duration > 0) {
            el.style.setProperty("--pxl-divider-duration", duration + "ms")
        }

        const delay = parseInt(el.getAttribute("data-scroll-delay"), 10)
        if (!isNaN(delay) && delay >= 0) {
            el.style.setProperty("--pxl-divider-delay", delay + "ms")
        }

        if (el.classList.contains("wow")) {
            el.classList.remove("wow", "animated")
            el.style.visibility = ""
            el.style.animationName = ""
        }
    }

    function frameflow_divider_scroll_draw($scope) {
        const $dividers = $scope.find(
            ".pxl-el-divider--scroll, .pxl-el-divider[data-scroll-draw='yes']"
        )
        if (!$dividers.length) return

        $dividers.each(function () {
            frameflow_divider_prep_scroll_el(this)
        })

        const $targets = $scope.find(".pxl-el-divider--scroll")
        if (!$targets.length) return

        if (frameflowIsElementorEditMode()) {
            $targets.addClass("visible")
            return
        }

        const recheck = function () {
            $targets.each(function () {
                frameflow_divider_try_reveal(this)
            })
        }

        recheck()
        requestAnimationFrame(recheck)
        $(window).on("load.frameflowDivider", recheck)

        const pending = $targets.filter(function () {
            return !this.classList.contains("visible")
        })

        if (!pending.length) {
            return
        }

        if (!window.IntersectionObserver) {
            pending.addClass("visible")
            return
        }

        const onScrollFallback = function () {
            recheck()
            if (
                !$targets.filter(function () {
                    return !this.classList.contains("visible")
                }).length
            ) {
                $(window).off("scroll.frameflowDivider resize.frameflowDivider", onScrollFallback)
            }
        }

        $(window).on("scroll.frameflowDivider resize.frameflowDivider", onScrollFallback)

        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (!entry.isIntersecting) {
                        return
                    }

                    const divider = entry.target.classList.contains("pxl-el-divider")
                        ? entry.target
                        : entry.target.querySelector(".pxl-el-divider--scroll")

                    if (divider) {
                        frameflow_divider_reveal_el(divider)
                    }

                    observer.unobserve(entry.target)
                })
            },
            { threshold: 0, rootMargin: "0px" }
        )

        pending.each(function () {
            const el = this
            if (el._pxlDividerScrollObserved) {
                return
            }
            el._pxlDividerScrollObserved = true

            const rect = el.getBoundingClientRect()
            const observeEl =
                rect.width === 0 && rect.height === 0
                    ? el.closest(".elementor-widget-pxl_divider") || el
                    : el
            observer.observe(observeEl)
        })
    }

    function renderOrbit($scope) {
        $scope.find(".orbit").each(function () {
            const $orbit = $(this)
            const settings = $orbit.data("settings") || {}
            const size = settings.size || 70
            const count = settings.count || 1
            const icons = Array.isArray(settings.icons) ? settings.icons : []
            const itemClasses = Array.isArray(settings.itemClasses) ? settings.itemClasses : []
            const iconClass = settings.iconClass || "green"
            const randomStart = !!settings.randomStart
            const useRandomColor = !!settings.randomColor
            const borderColor = settings.borderColor || null

            $orbit.css("--d", size + "%").empty()
            if (borderColor) {
                $orbit.css("--orbit-border-color", borderColor)
            }

            const fragment = $(document.createDocumentFragment())

            const createItem = (idx) => {
                const dur = (6 + Math.random() * 6).toFixed(1) + "s"
                const $rot = $("<div>", { class: "rotator" }).css("--dur", dur)
                if (Math.random() > 0.5) $rot.addClass("reverse")

                let $item
                let iconChar = icons.length ? icons[idx % icons.length] : "⭐"
                const iconStr = typeof iconChar === "string" ? iconChar.trim() : ""
                const isSvg = iconStr.startsWith("<svg")
                const isImg = iconStr.startsWith("<img")
                let classes = ["item", "icon", iconClass]
                if (isSvg) classes.push("is-svg")
                if (isImg) classes.push("is-media")
                // Add class from itemClasses array if available
                if (itemClasses.length > 0) {
                    const itemClass = itemClasses[idx % itemClasses.length]
                    if (itemClass && itemClass.trim() !== "") {
                        classes.push(itemClass)
                    }
                }
                $item = $("<div>", {
                    class: classes.join(" "),
                }).html(iconChar)

                return $rot.append($item)
            }

            for (let i = 0; i < count; i++) {
                fragment.append(createItem(i))
            }

            $orbit.append(fragment)

            const $rotators = $orbit.find(".rotator")
            const c = $rotators.length
            if (c) {
                const baseAngles = Array.from({ length: c }, (_, idx) => (360 / c) * idx)
                if (randomStart) {
                    for (let i = baseAngles.length - 1; i > 0; i--) {
                        const j = Math.floor(Math.random() * (i + 1))
                        ;[baseAngles[i], baseAngles[j]] = [baseAngles[j], baseAngles[i]]
                    }
                }
                $rotators.each(function (i) {
                    $(this).css("--start", baseAngles[i] + "deg")
                })

                const orbitWidth = $orbit.innerWidth()
                if (orbitWidth > 0) {
                    const radius = orbitWidth / 2
                    const arcLength = (2 * Math.PI * radius) / c
                    const maxIconSize = Math.max(28, Math.min(60, arcLength - 8))
                    $orbit.css("--orbit-icon-size", `${maxIconSize}px`)
                }
            }

            const randCol = () =>
                "#" +
                Math.floor(Math.random() * 16777215)
                    .toString(16)
                    .padStart(6, "0")
            $orbit.find(".item").each(function () {
                const $it = $(this)
                let color = null

                if (useRandomColor) {
                    color = randCol()
                }

                if (color && !$it.hasClass("is-media")) {
                    if ($it.hasClass("is-svg")) {
                        $it.find("svg, path, circle, rect, polygon, polyline, ellipse, line").css({
                            fill: color,
                            color,
                        })
                    } else {
                        $it.css("color", color)
                    }
                }
            })
        })
    }

    var frameflowStellarParallaxState = {
        inited: false,
        lastCount: -1,
        debounceTimer: null,
        resizeBound: false,
    }

    function frameflowCanUseStellarParallax() {
        return (
            typeof window !== "undefined" &&
            window.matchMedia &&
            window.matchMedia("(min-width: 768px)").matches
        )
    }

    function frameflowResetStellarParallaxStyles() {
        document
            .querySelectorAll(".pxl-section-bg-parallax.pxl--parallax")
            .forEach(function (element) {
                element.style.removeProperty("background-position")
                var styleValue = element.getAttribute("style")
                if (styleValue !== null && styleValue.trim() === "") {
                    element.removeAttribute("style")
                }
            })
    }

    window.frameflowEnsureStellarParallax = function () {
        if (typeof jQuery === "undefined" || typeof jQuery.fn.stellar !== "function") {
            return
        }
        var $w = jQuery(window)

        if (!frameflowCanUseStellarParallax()) {
            if (frameflowStellarParallaxState.inited) {
                try {
                    $w.stellar("destroy")
                } catch (e) {
                    /* ignore */
                }
                frameflowStellarParallaxState.inited = false
            }
            frameflowStellarParallaxState.lastCount = -1
            frameflowResetStellarParallaxStyles()
            return
        }

        var count = document.querySelectorAll("[data-stellar-background-ratio]").length
        if (!count) {
            return
        }
        if (!frameflowStellarParallaxState.inited) {
            if (document.readyState !== "complete") {
                return
            }
            $w.stellar({ responsive: true })
            frameflowStellarParallaxState.inited = true
            frameflowStellarParallaxState.lastCount = count
            return
        }
        if (count !== frameflowStellarParallaxState.lastCount) {
            frameflowStellarParallaxState.lastCount = count
            try {
                $w.stellar("refresh")
            } catch (e) {
                /* ignore */
            }
        }
    }

    function frameflowScheduleStellarParallaxCheck() {
        if (frameflowStellarParallaxState.debounceTimer) {
            clearTimeout(frameflowStellarParallaxState.debounceTimer)
        }
        frameflowStellarParallaxState.debounceTimer = setTimeout(function () {
            frameflowStellarParallaxState.debounceTimer = null
            if (typeof window.frameflowEnsureStellarParallax === "function") {
                window.frameflowEnsureStellarParallax()
            }
        }, 200)
    }

    if (!frameflowStellarParallaxState.resizeBound) {
        frameflowStellarParallaxState.resizeBound = true
        window.addEventListener("resize", frameflowScheduleStellarParallaxCheck, {
            passive: true,
        })
    }

    function frameflow_parallax_bg() {
        if (typeof $.fn.parallaxBackground === "undefined") {
            console.warn("parallaxBackground plugin not loaded")
            return
        }

        $(document).find(".pxl-parallax-background").parallaxBackground({
            event: "mouse_move",
            animation_type: "shift",
            animate_duration: 2,
        })
        $(document).find(".pxl-pll-basic").parallaxBackground()
        $(document).find(".pxl-pll-rotate").parallaxBackground({
            animation_type: "rotate",
            zoom: 50,
            rotate_perspective: 500,
        })
        $(document).find(".pxl-pll-mouse-move").parallaxBackground({
            event: "mouse_move",
            animation_type: "shift",
            animate_duration: 2,
        })
        $(document).find(".pxl-pll-mouse-move-rotate").parallaxBackground({
            event: "mouse_move",
            animation_type: "rotate",
            animate_duration: 1,
            zoom: 70,
            rotate_perspective: 1000,
        })
    }

    function frameflow_post_carousel_handler($scope) {
        const rootEl = $scope && $scope[0] ? $scope[0] : document
        const stepsContainer = rootEl.querySelector(".pxl-grid-filter.style-3")
        const pill = rootEl.querySelector("#pxl-item-step-active-pill")
        const steps = Array.from(rootEl.querySelectorAll(".filter-item"))

        if (!stepsContainer || !pill || !steps.length) return

        const getActiveIndex = () => {
            const i = steps.findIndex((b) => b.classList.contains("active"))
            return i === -1 ? 0 : i
        }

        const setActive = (index) => {
            index = Math.min(Math.max(index, 0), steps.length - 1)
            steps.forEach((b) => b.classList.remove("active"))
            steps[index].classList.add("active")
            updatePill(index)
        }

        const updatePill = (index = getActiveIndex()) => {
            index = Math.min(Math.max(index, 0), steps.length - 1)
            const containerRect = stepsContainer.getBoundingClientRect()
            const stepRect = steps[index].getBoundingClientRect()
            const stepWidth = stepRect.width || steps[index].offsetWidth || 0
            const translateX = stepRect.left - containerRect.left

            pill.style.width = `${Math.max(0, stepWidth - 2)}px`
            pill.style.transform = `translateX(${translateX}px)`
        }

        steps.forEach((btn, index) => {
            btn.addEventListener("click", () => {
                setActive(index)
            })
        })

        setActive(getActiveIndex())

        const onResize = () => {
            if (rootEl !== document && !rootEl.isConnected) {
                window.removeEventListener("resize", onResize)
                return
            }
            updatePill()
        }

        window.addEventListener("resize", onResize, { passive: true })
    }

    function setupGlowAnimation($scope) {
        var $wrapper = $scope.find(".pxl-section-mouse-follower")
        if (!$wrapper.length) return

        // Check if already initialized
        if ($wrapper.data("glow-animation-initialized")) return

        var $mouseGlow = $wrapper.find(".pxl-section-mouse-follower-shape1")
        var $blobPurple = $wrapper.find(".pxl-section-mouse-follower-shape2")

        // Create HTML elements if they don't exist
        if (!$mouseGlow.length) {
            $mouseGlow = $('<div class="pxl-section-mouse-follower-shape1"></div>')
            $wrapper.append($mouseGlow)
        }
        if (!$blobPurple.length) {
            $blobPurple = $('<div class="pxl-section-mouse-follower-shape2"></div>')
            $wrapper.append($blobPurple)
        }

        var state = {
            glowIntensity: 0,
            mouseX: 0,
            mouseY: 0,
            isActive: false,
            rafId: null,
            isRunning: true,
            isAnimating: false,
        }

        // Unique namespace for this wrapper
        var namespace =
            "pxlGlow_" +
            ($wrapper[0] ? $wrapper[0].getAttribute("data-id") || Date.now() : Date.now())

        var rect = $wrapper[0] ? $wrapper[0].getBoundingClientRect() : null
        function updateRect() {
            rect = $wrapper[0] ? $wrapper[0].getBoundingClientRect() : null
        }
        window.addEventListener("resize", updateRect, { passive: true })
        window.addEventListener("scroll", updateRect, { passive: true })

        function handleMouseMove(e) {
            if (!state.isRunning) return

            if (!rect) updateRect()
            if (!rect) return

            var inside =
                e.clientX >= rect.left &&
                e.clientX <= rect.right &&
                e.clientY >= rect.top &&
                e.clientY <= rect.bottom
            if (!inside) {
                state.isActive = false
                $mouseGlow.css("opacity", 0)
                return
            }

            state.isActive = true
            state.mouseX = e.clientX - rect.left
            state.mouseY = e.clientY - rect.top

            $mouseGlow.css({
                left: state.mouseX + "px",
                top: state.mouseY + "px",
                opacity: 1,
            })
            $blobPurple.css("opacity", 1)

            if (!state.isAnimating) {
                state.isAnimating = true
                animate()
            }
        }

        // Bind mouse move event with unique namespace
        $(document).on("mousemove." + namespace, handleMouseMove)

        function animate() {
            if (!state.isRunning) return

            // Safety check: if element is removed from DOM, clean up
            if ($wrapper[0] && !$wrapper[0].isConnected) {
                var cleanup = $wrapper.data("glow-animation-cleanup")
                if (cleanup) cleanup()
                return
            }

            state.glowIntensity = (state.glowIntensity + 0.06) % (Math.PI * 2)

            if (!state.isActive) {
                state.isAnimating = false
                return
            }

            var scale = 1 + Math.sin(state.glowIntensity) * 0.2
            $mouseGlow.css("transform", "translate(-50%, -50%) scale(" + scale + ")")

            var blobScale = 1 + Math.cos(state.glowIntensity) * 0.15
            $blobPurple.css("transform", "translate(-50%, -50%) scale(" + blobScale + ")")

            state.rafId = requestAnimationFrame(animate)
        }

        // Start animation
        // state.rafId = requestAnimationFrame(animate); // Removed auto-start

        // Mark as initialized
        $wrapper.data("glow-animation-initialized", true)

        // Cleanup function
        $wrapper.data("glow-animation-cleanup", function () {
            state.isRunning = false
            if (state.rafId) {
                cancelAnimationFrame(state.rafId)
                state.rafId = null
            }
            window.removeEventListener("resize", updateRect)
            window.removeEventListener("scroll", updateRect)
            $(document).off("mousemove." + namespace)
            $wrapper.removeData("glow-animation-initialized")
            $wrapper.removeData("glow-animation-cleanup")
        })

        // Cleanup when element is removed
        $wrapper.on("remove", function () {
            var cleanup = $wrapper.data("glow-animation-cleanup")
            if (cleanup && typeof cleanup === "function") {
                cleanup()
            }
        })
    }

    function frameflow_post_image_flex_hover($scope) {
        frameflow_flex_slip_hover($scope, {
            track: ".pxl-post-slip1 .pxl-post-image--track",
            block: ".pxl-post-image--block",
            defaultActive: "center",
        })
    }

    function frameflow_collection_slip_flex_hover($scope) {
        frameflow_flex_slip_hover($scope, {
            track: ".pxl-collection-slip .pxl-collection-slip--track",
            block: ".pxl-collection-slip--block",
            defaultActive: "data",
            // grow keeps space filled mid-transition (px flex-basis leaves white gaps)
            mode: "grow",
        })
    }

    /**
     * Shared hover-expand flex panels (post slip / collection slip).
     * @param {jQuery} $scope
     * @param {{track:string,block:string,defaultActive:string,mode?:string}} opts
     */
    function frameflow_flex_slip_hover($scope, opts) {
        if (window.innerWidth < 1201) {
            return
        }
        const $root = $scope && $scope.length ? $scope : jQuery(document.body)
        const $tracks = $root.find(opts.track)
        if (!$tracks.length) {
            return
        }
        const mode = opts.mode === "grow" ? "grow" : "basis"

        function parseFlexData($track) {
            let active = parseFloat($track.attr("data-flex-active"))
            let inactive = parseFloat($track.attr("data-flex-inactive"))
            if (isNaN(active) || active <= 0) {
                active = 40
            }
            if (isNaN(inactive) || inactive <= 0) {
                inactive = (100 - active) / 2
            }
            return { active: active, inactive: inactive }
        }

        function normalizeWeights(activeRaw, inactiveRaw, count) {
            if (count < 2) {
                return { activeW: 1, inactiveW: 0 }
            }
            const sum = activeRaw + inactiveRaw * (count - 1)
            if (!isFinite(sum) || sum <= 0) {
                return { activeW: 1, inactiveW: 1 }
            }
            return { activeW: activeRaw / sum, inactiveW: inactiveRaw / sum }
        }

        function getGapPx(trackEl) {
            try {
                const styles = window.getComputedStyle(trackEl)
                const colGap = parseFloat(styles.columnGap) || 0
                return Math.max(0, colGap)
            } catch (e) {
                return 0
            }
        }

        function applyBasis(trackEl, $blocks, activeIndex, activeRaw, inactiveRaw) {
            const count = $blocks.length
            trackEl.style.flexWrap = "nowrap"

            if (mode === "grow") {
                $blocks.each(function (index) {
                    const grow = index === activeIndex ? activeRaw : inactiveRaw
                    this.style.flexGrow = String(grow)
                    this.style.flexShrink = "0"
                    this.style.flexBasis = "0%"
                    this.style.width = ""
                })
                return
            }

            const { activeW, inactiveW } = normalizeWeights(activeRaw, inactiveRaw, count)
            const gapPx = getGapPx(trackEl)
            const totalGaps = gapPx * Math.max(0, count - 1)
            const trackWidth = trackEl.clientWidth || 0
            const available = Math.max(0, trackWidth - totalGaps)
            const activePx = available * activeW
            const inactivePx = available * inactiveW

            $blocks.each(function (index) {
                const px = index === activeIndex ? activePx : inactivePx
                this.style.flexBasis = px + "px"
            })
        }

        function resolveDefaultActive($track, count) {
            if (opts.defaultActive === "data") {
                let idx = parseInt($track.attr("data-default-active"), 10)
                if (isNaN(idx) || idx < 0) {
                    idx = 0
                }
                if (idx >= count) {
                    idx = 0
                }
                return idx
            }
            return Math.floor((count - 1) / 2)
        }

        $tracks.each(function () {
            const $track = jQuery(this)
            const $blocks = $track.find(opts.block)

            if ($blocks.length < 2) {
                return
            }

            const count = $blocks.length
            const { active: activeRaw, inactive: inactiveRaw } = parseFlexData($track)
            const defaultActiveIndex = resolveDefaultActive($track, count)

            function setActiveIndex(activeIndex) {
                $blocks.removeClass("active")
                $blocks.eq(activeIndex).addClass("active")
            }

            function resetFlex() {
                applyBasis($track[0], $blocks, defaultActiveIndex, activeRaw, inactiveRaw)
                setActiveIndex(defaultActiveIndex)
            }

            resetFlex()

            $blocks.off("mouseenter.pxlFlexHover")
            $track.off("mouseleave.pxlFlexHover")
            $blocks.on("mouseenter.pxlFlexHover", function () {
                const idx = $blocks.index(this)
                applyBasis($track[0], $blocks, idx, activeRaw, inactiveRaw)
                setActiveIndex(idx)
            })

            $track.on("mouseleave.pxlFlexHover", function () {
                requestAnimationFrame(resetFlex)
            })

            const prevResize = $track.data("pxlFlexHoverResize")
            if (prevResize && typeof prevResize === "function") {
                window.removeEventListener("resize", prevResize)
            }
            const onResize = function () {
                if (window.innerWidth < 1201) {
                    return
                }
                requestAnimationFrame(resetFlex)
            }
            window.addEventListener("resize", onResize)
            $track.data("pxlFlexHoverResize", onResize)
        })
    }

    function frameflow_post_slip_horizontal_scroll($scope) {
        const $root = $scope && $scope.length ? $scope : jQuery(document.body)
        const $slips = $root.find(".pxl-post-slip2")

        if (!$slips.length || typeof gsap === "undefined" || typeof ScrollTrigger === "undefined") {
            return
        }

        gsap.registerPlugin(ScrollTrigger)

        $slips.each(function () {
            const slip = this
            const track = slip.querySelector(".pxl-post-image--track")
            const progress = slip.querySelector(".pxl-service--progress")
            const car = slip.querySelector(".pxl-service--progress-car")
            const line = slip.querySelector(".pxl-service--progress-line")

            if (!track) {
                return
            }

            if (slip._pxlPostSlipHorizontal) {
                slip._pxlPostSlipHorizontal.forEach(function (item) {
                    if (item && item.scrollTrigger) {
                        item.scrollTrigger.kill()
                    }
                    if (item && typeof item.kill === "function") {
                        item.kill()
                    }
                })
            }

            slip._pxlPostSlipHorizontal = []
            gsap.set(track, { clearProps: "transform" })

            if (car) {
                gsap.set(car, { x: 0 })
            }

            if (window.innerWidth < 1201) {
                return
            }

            const getTrackStartOffset = function () {
                const styles = window.getComputedStyle(track)
                const marginLeft = parseFloat(styles.marginLeft) || 0

                return Math.max(0, marginLeft)
            }

            const getDistance = function () {
                return Math.max(0, track.scrollWidth + getTrackStartOffset() - slip.clientWidth)
            }

            if (!getDistance()) {
                return
            }

            const trackTween = gsap.to(track, {
                x: function () {
                    return -getDistance()
                },
                ease: "none",
                scrollTrigger: {
                    trigger: slip,
                    start: "center center",
                    end: function () {
                        return "+=" + getDistance()
                    },
                    scrub: 1,
                    pin: slip,
                    invalidateOnRefresh: true,
                },
            })

            slip._pxlPostSlipHorizontal.push(trackTween)

            if (progress && car && line) {
                const carTween = gsap.to(car, {
                    x: function () {
                        const styles = window.getComputedStyle(progress)
                        const sizePoint = parseFloat(styles.getPropertyValue("--size-point")) || 35
                        const maxX = line.offsetWidth - car.offsetWidth - sizePoint

                        return Math.max(0, maxX)
                    },
                    ease: "none",
                    scrollTrigger: {
                        trigger: slip,
                        start: "center center",
                        end: function () {
                            return "+=" + getDistance()
                        },
                        scrub: 1,
                        invalidateOnRefresh: true,
                    },
                })

                slip._pxlPostSlipHorizontal.push(carTween)
            }
        })
    }

    $(document).ready(function () {
        window.frameflowOnPageReady(function () {
            if (window.elementorFrontend && typeof elementorFrontend.waypoint === "function") {
                frameflow_animation_handler()
            }
        })
        frameflow_section_divider_glow()
        frameflow_border_glow()
    })

    $(window).on("elementor/frontend/init", function () {
        frameflow_polyfill_waypoint()
        elementorFrontend.hooks.addAction("frontend/element_ready/global", function ($scope) {
            frameflow_divider_scroll_draw($scope)
            window.frameflowOnPageReady(function () {
                frameflow_animation_handler($scope)
                frameflowReplayWowInScope($scope)
            })
            frameflow_section_divider_glow($scope)
            frameflow_border_glow($scope)
            renderOrbit($scope)
            setupGlowAnimation($scope)
            frameflow_animation_btn($scope)
            frameflowScheduleStellarParallaxCheck()
        })
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/pxl_post_slip.default",
            function ($scope) {
                frameflow_post_image_flex_hover($scope)
                frameflow_post_slip_horizontal_scroll($scope)
            }
        )
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/pxl_collection_slip.default",
            function ($scope) {
                frameflow_collection_slip_flex_hover($scope)
            }
        )
        frameflow_section_start_render()
        frameflow_parallax_bg()
        frameflow_css_inline_js()
        frameflow_section_before_render()
        frameflow_zoom_point()
        frameflow_scroll_fixed_section()
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/pxl_divider.default",
            function ($scope) {
                frameflow_divider_scroll_draw($scope)
            }
        )
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/pxl_contact_form.default",
            PXL_Icon_Contact_Form
        )
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/pxl_heading.default",
            function ($scope) {
                window.frameflowOnPageReady(function () {
                    frameflow_split_text($scope)
                    frameflow_scroll_text($scope)
                    frameflow_heading_text_scroll_reveal($scope)
                    frameflowReplayWowInScope($scope)
                })
            }
        )
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/pxl_text_editor.default",
            function ($scope) {
                window.frameflowOnPageReady(function () {
                    frameflow_split_text($scope)
                    frameflowReplayWowInScope($scope)
                })
            }
        )
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/pxl_event_timeline.default",
            function ($scope) {
                frameflow_event_timeline_handler($scope)
            }
        )
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/pxl_post_carousel.default",
            function ($scope) {
                frameflow_post_carousel_handler($scope)
            }
        )
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/pxl_pricing.default",
            function ($scope) {
                pxl_pricing_handler($scope)
            }
        )
    })

    function pxl_pricing_handler($scope) {
        $scope.find(".pxl-pricing2").each(function () {
            var $container = $(this)
            var $quantityInput = $container.find("input.qty")
            var $subtotal = $container.find(".pxl-ticket-subtotal")
            var $priceLabel = $container.find(".pxl-ticket-price-main")
            var price = parseFloat($container.data("price")) || 0
            var currency = $container.data("currency") || "$"

            function updateSubtotal() {
                var qty = parseInt($quantityInput.val()) || 1
                var total = price * qty
                var formattedTotal =
                    currency +
                    total.toLocaleString(undefined, {
                        minimumFractionDigits: 0,
                        maximumFractionDigits: 2,
                    })
                $subtotal.html(formattedTotal)
            }

            $container.on("click", ".pxl-qty-up", function (e) {
                e.preventDefault()
                var val = parseInt($quantityInput.val()) || 1
                $quantityInput.val(val + 1).trigger("change")
            })

            $container.on("click", ".pxl-qty-down", function (e) {
                e.preventDefault()
                var val = parseInt($quantityInput.val()) || 1
                if (val > 1) {
                    $quantityInput.val(val - 1).trigger("change")
                }
            })

            $quantityInput.on("change", function () {
                updateSubtotal()
                var $btn = $container.find(".pxl-add-to-cart")
                var href = $btn.attr("href")
                if (href && href.indexOf("add-to-cart=") !== -1) {
                    var newHref = href.split("&quantity=")[0] + "&quantity=" + $(this).val()
                    $btn.attr("href", newHref)
                }
            })
        })
    }
    if (
        typeof gsap !== "undefined" &&
        typeof ScrollTrigger !== "undefined" &&
        typeof ScrollTrigger.normalizeScroll === "function"
    ) {
        gsap.registerPlugin(ScrollTrigger)
        try {
            ScrollTrigger.normalizeScroll({ allowNestedScroll: true })
        } catch (e) {
            console.warn(e)
        }
    }

    $(window).on("load", function () {
        if (typeof window.frameflowEnsureStellarParallax === "function") {
            window.frameflowEnsureStellarParallax()
        }
        if (typeof ScrollTrigger !== "undefined") {
            setTimeout(() => {
                ScrollTrigger.refresh()
            }, 500)
        }
    })
})(jQuery)
