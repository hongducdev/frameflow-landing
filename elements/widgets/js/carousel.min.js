;(function ($) {
    /**
     * Elementor Swiper bootstrap for theme carousels.
     *
     * Each widget registers: frontend/element_ready/{widget_name}.default
     * → pxl_swiper_handler($scope). Product carousel also runs
     * frameflowSyncProductCarouselArrowInsets() for negative-margin bleed.
     *
     * Source: elements/widgets/js/carousel.js → carousel.min.js (handle: pxl-swiper)
     */

    /**
     * Reads Elementor widget negative horizontal margins and writes
     * --pxl-arrow-inset-left/right on .pxl-product-carousel so arrow wrap
     * aligns to the original column width (not the bled overflow box).
     */
    function frameflowSyncProductCarouselArrowInsets($scope) {
        var $carousel = $scope.find(".pxl-product-carousel").first()
        if (!$carousel.length) {
            return
        }

        var $widget = $scope.hasClass("elementor-widget")
            ? $scope
            : $scope.closest(".elementor-widget-pxl_product_carousel")
        if (!$widget.length) {
            $widget = $carousel.closest(".elementor-element")
        }
        if (!$widget.length) {
            $widget = $carousel.parent()
        }

        var apply = function () {
            var insetL = 0
            var insetR = 0
            var targets = [$widget[0]]
            var container = $widget.children(".elementor-widget-container")[0]
            if (container) {
                targets.push(container)
            }

            targets.forEach(function (el) {
                if (!el) {
                    return
                }
                var style = window.getComputedStyle(el)
                var ml = parseFloat(style.marginLeft) || 0
                var mr = parseFloat(style.marginRight) || 0
                if (ml < 0) {
                    insetL = Math.max(insetL, -ml)
                }
                if (mr < 0) {
                    insetR = Math.max(insetR, -mr)
                }
            })

            $carousel[0].style.setProperty(
                "--pxl-arrow-inset-left",
                insetL + "px"
            )
            $carousel[0].style.setProperty(
                "--pxl-arrow-inset-right",
                insetR + "px"
            )
        }

        apply()
        setTimeout(apply, 50)
        setTimeout(apply, 300)

        $(window)
            .off("resize.pxlProductCarouselArrows." + $widget.data("id"))
            .on(
                "resize.pxlProductCarouselArrows." + ($widget.data("id") || "0"),
                apply
            )

        if (typeof ResizeObserver !== "undefined") {
            if ($carousel[0]._pxlArrowRO) {
                $carousel[0]._pxlArrowRO.disconnect()
            }
            var ro = new ResizeObserver(apply)
            ro.observe($widget[0])
            $carousel[0]._pxlArrowRO = ro
        }
    }

    function frameflowSyncTestimonial15Shapes($scope) {
        var $cards = $scope.find(
            ".pxl-testimonial-carousel15 .pxl-item--inner"
        )
        if (!$cards.length) {
            return
        }

        var draw = function (el) {
            var svg = el.querySelector(".pxl-item--shape")
            if (!svg) {
                return
            }
            var w = el.offsetWidth
            var h = el.offsetHeight
            if (w < 2 || h < 2) {
                return
            }

            var style = window.getComputedStyle(el)
            // Figma Rectangle 117: fixed 50×43 notch, 10px radii
            var nw = parseFloat(style.getPropertyValue("--pxl-notch-w")) || 50
            var nh = parseFloat(style.getPropertyValue("--pxl-notch-h")) || 43
            var r = parseFloat(style.getPropertyValue("--pxl-notch-r")) || 10
            nw = Math.min(nw, Math.max(0, w - r * 2))
            nh = Math.min(nh, Math.max(0, h - r * 2))
            r = Math.min(r, nw / 2, nh / 2)

            // Figma path: fixed 50×43 top-right notch with 10px corner radii
            // Use cubics (not arcs) so corner sweep matches Figma exactly.
            var c = r * 0.5523
            var d = [
                "M" + (w - nw - r) + " 0",
                "C" +
                    (w - nw - r + c) +
                    " 0 " +
                    (w - nw) +
                    " " +
                    (r - c) +
                    " " +
                    (w - nw) +
                    " " +
                    r,
                "V" + (nh - r),
                "C" +
                    (w - nw) +
                    " " +
                    (nh - r + c) +
                    " " +
                    (w - nw + r - c) +
                    " " +
                    nh +
                    " " +
                    (w - nw + r) +
                    " " +
                    nh,
                "H" + (w - r),
                "C" +
                    (w - r + c) +
                    " " +
                    nh +
                    " " +
                    w +
                    " " +
                    (nh + r - c) +
                    " " +
                    w +
                    " " +
                    (nh + r),
                "V" + (h - r),
                "C" +
                    w +
                    " " +
                    (h - r + c) +
                    " " +
                    (w - r + c) +
                    " " +
                    h +
                    " " +
                    (w - r) +
                    " " +
                    h,
                "H" + r,
                "C" +
                    (r - c) +
                    " " +
                    h +
                    " 0 " +
                    (h - r + c) +
                    " 0 " +
                    (h - r),
                "V" + r,
                "C0 " + (r - c) + " " + (r - c) + " 0 " + r + " 0",
                "Z",
            ].join(" ")

            svg.setAttribute("viewBox", "0 0 " + w + " " + h)
            svg.querySelectorAll("path").forEach(function (path) {
                path.setAttribute("d", d)
            })
        }

        var apply = function () {
            $cards.each(function () {
                draw(this)
            })
        }

        apply()
        setTimeout(apply, 50)
        setTimeout(apply, 300)

        if (typeof ResizeObserver !== "undefined") {
            $cards.each(function () {
                var el = this
                if (el._pxlShapeRO) {
                    el._pxlShapeRO.disconnect()
                }
                var ro = new ResizeObserver(function () {
                    draw(el)
                })
                ro.observe(el)
                el._pxlShapeRO = ro
            })
        }
    }

    function pxl_swiper_handler($scope) {
        $scope.find(".pxl-swiper-slider").each(function (index, element) {
            var $this = $(this)
            var fadeSlideMode = "fade"

            var settings = $this.find(".pxl-swiper-container").data().settings
            // Keep full slide set for filter restore; prune DOM before Swiper
            // so init does not destroy/recreate (that jumps Elementor preview scroll).
            var allSlides = $this.find(".pxl-swiper-slide")
            var $slideWrapper = $this.find(".pxl-swiper-wrapper")
            var $initialFilter = $this
                .find(".pxl-product-carousel--filter .filter-item.active")
                .first()
            var initialFilterTarget = $initialFilter.length
                ? $initialFilter.attr("data-filter-target")
                : null
            if (initialFilterTarget && initialFilterTarget !== "all") {
                $slideWrapper.empty()
                allSlides.each(function () {
                    var $slide = $(this)
                    if (
                        $slide.is(
                            "[data-filter^='" + initialFilterTarget + "']"
                        ) ||
                        $slide.is(
                            "[data-filter*='" + initialFilterTarget + "']"
                        )
                    ) {
                        $slideWrapper.append(this.outerHTML)
                    }
                })
            }
            var numberOfSlides = $this.find(".pxl-swiper-slide").length
            var carousel_settings = {
                direction: settings["slide_direction"],
                effect: settings["slide_mode"],
                wrapperClass: "pxl-swiper-wrapper",
                slideClass: "pxl-swiper-slide",
                slidesPerView: settings["slides_to_show"],
                slidesPerGroup: settings["slides_to_scroll"],
                slidesPerColumn: settings["slide_percolumn"],
                centeredSlides: settings["center"] || settings["center_slide"],
                allowTouchMove:
                    settings["allow_touch_move"] !== undefined
                        ? settings["allow_touch_move"]
                        : true,
                spaceBetween: 0,
                observer: true,
                observeParents: true,
                // mousewheel: true,
                parallax: true,
                navigation: {
                    nextEl: $this.find(".pxl-swiper-arrow-next")[0],
                    prevEl: $this.find(".pxl-swiper-arrow-prev")[0],
                },
                pagination: {
                    type: settings["pagination_type"],
                    el: $this.find(".pxl-swiper-dots")[0],
                    clickable: true,
                    modifierClass: "pxl-swiper-pagination-",
                    bulletClass: "pxl-swiper-pagination-bullet",
                    renderCustom: function (swiper, element, current, total) {
                        return current + " of " + total
                    },
                },
                speed: settings["speed"],
                watchSlidesProgress: true,
                watchSlidesVisibility: true,
                breakpoints: {
                    0: {
                        slidesPerView: settings["slides_to_show_xs"],
                        slidesPerGroup: settings["slides_to_scroll"],
                    },
                    576: {
                        slidesPerView: settings["slides_to_show_sm"],
                        slidesPerGroup: settings["slides_to_scroll"],
                    },
                    768: {
                        slidesPerView: settings["slides_to_show_md"],
                        slidesPerGroup: settings["slides_to_scroll"],
                    },
                    992: {
                        slidesPerView: settings["slides_to_show_lg"],
                        slidesPerGroup: settings["slides_to_scroll"],
                    },
                    1200: {
                        slidesPerView: settings["slides_to_show"],
                        slidesPerGroup: settings["slides_to_scroll"],
                    },
                    1400: {
                        slidesPerView: settings["slides_to_show_xxl"],
                        slidesPerGroup: settings["slides_to_scroll"],
                    },
                },
                on: {
                    init: function (swiper) {
                        const progress = 0
                        if (
                            $scope.find(".pxl-portfolio-carousel1").length > 0
                        ) {
                            animateFilterWhileDragging(progress)
                        }
                        setBoxHeight()

                        setTimeout(function () {
                            if (window.frameflowCarouselHelpers) {
                                window.frameflowCarouselHelpers.syncThumbs(swiper, 0)
                            }
                        }, 50)

                        if (typeof window.initRipples === "function") {
                            var initRippleOnSlides = function () {
                                var $allSlides =
                                    $scope.find(".pxl-swiper-slide")
                                if ($allSlides.length) {
                                    window.initRipples($allSlides)
                                }
                            }
                            setTimeout(initRippleOnSlides, 50)
                            setTimeout(initRippleOnSlides, 200)
                            setTimeout(initRippleOnSlides, 400)
                            setTimeout(initRippleOnSlides, 600)
                        }

                        setTimeout(function () {
                            if (window.frameflowCarouselHelpers) {
                                window.frameflowCarouselHelpers.replayWow(
                                    swiper,
                                    ".wow"
                                )
                            }
                            // ponytail: WOW.js hides .wow with visibility:hidden until
                            // scroll-into-view, but carousel slides live inside overflow:hidden
                            // so WOW never triggers. Force all .wow inside carousel visible.
                            $this.find(".wow").each(function () {
                                this.style.visibility = "visible"
                            })
                        }, 80)
                    },

                    slideChange: function (swiper) {
                        const currentIndex = swiper.activeIndex
                        const totalSlides = swiper.slides.length
                        const progress = currentIndex / (totalSlides - 1)

                        // Ensure autoplay continues with reverse direction
                        if (
                            (settings["reverse"] ||
                                settings["reverse"] === "true") &&
                            swiper.autoplay
                        ) {
                            if (
                                !swiper.autoplay.running &&
                                swiper.params &&
                                swiper.params.autoplay
                            ) {
                                // Restart autoplay if it stopped unexpectedly
                                setTimeout(function () {
                                    if (
                                        swiper.autoplay &&
                                        !swiper.autoplay.running
                                    ) {
                                        swiper.autoplay.start()
                                    }
                                }, 50)
                            }
                        }

                        if (window.frameflowCarouselHelpers) {
                            window.frameflowCarouselHelpers.syncThumbs(swiper, 300)
                        }

                        if (
                            $scope.find(".pxl-portfolio-carousel1").length > 0
                        ) {
                            animateFilterWhileDragging(progress)
                        }

                        if (
                            typeof window.cleanupInvisibleDuplicates ===
                            "function"
                        ) {
                            window.cleanupInvisibleDuplicates($scope)
                        }
                        if (typeof window.initRipples === "function") {
                            setTimeout(function () {
                                var $visibleSlides = $scope.find(
                                    ".pxl-swiper-slide.swiper-slide-visible"
                                )
                                if ($visibleSlides.length) {
                                    window.initRipples($visibleSlides)
                                }
                            }, 100)
                        }

                    },

                    slideChangeTransitionEnd: function (swiper) {
                        if (settings["slide_mode"] === fadeSlideMode) {
                            return
                        }
                        if (window.frameflowCarouselHelpers) {
                            window.frameflowCarouselHelpers.replayWow(
                                swiper,
                                ".wow"
                            )
                        }
                    },

                    slideChangeTransitionStart: function (swiper) {
                        if (settings["slide_mode"] !== fadeSlideMode) {
                            return
                        }
                        requestAnimationFrame(function () {
                            if (window.frameflowCarouselHelpers) {
                                window.frameflowCarouselHelpers.replayWow(
                                    swiper,
                                    ".wow"
                                )
                            }
                        })
                    },

                    imagesReady: function (swiper) {
                        if (typeof window.initRipples === "function") {
                            setTimeout(function () {
                                var $slides = $scope.find(
                                    ".pxl-swiper-slide.swiper-slide-visible"
                                )
                                if (!$slides.length) {
                                    $slides = $scope.find(".pxl-swiper-slide")
                                }
                                if ($slides.length) {
                                    window.initRipples($slides)
                                }
                            }, 100)
                            setTimeout(function () {
                                var $allSlides =
                                    $scope.find(".pxl-swiper-slide")
                                if ($allSlides.length) {
                                    window.initRipples($allSlides)
                                }
                            }, 300)
                        }
                    },

                    autoplayStart: function (swiper) {
                        // Ensure autoplay continues smoothly with reverse direction
                        if (
                            settings["reverse"] ||
                            settings["reverse"] === "true"
                        ) {
                            if (
                                swiper.autoplay &&
                                swiper.params &&
                                swiper.params.autoplay &&
                                swiper.params.autoplay.reverseDirection
                            ) {
                                // Autoplay is starting with reverse direction
                            }
                        }
                    },

                    autoplayStop: function (swiper) {
                        // Handle autoplay stop if needed
                    },

                    beforeDestroy: function (swiper) {
                        if (typeof window.destroyRipples === "function") {
                            window.destroyRipples($scope)
                        }
                    },
                },
            }

            if (
                settings["center_slide"] ||
                settings["center_slide"] === "true"
            ) {
                if (settings["loop"] || settings["loop"] === "true") {
                    carousel_settings["initialSlide"] = Math.floor(
                        numberOfSlides / 2
                    )
                } else {
                    if (carousel_settings["slidesPerView"] > 1) {
                        carousel_settings["initialSlide"] = Math.floor(
                            (numberOfSlides -
                                carousel_settings["slidesPerView"]) /
                                2
                        )
                    } else {
                        carousel_settings["initialSlide"] = Math.ceil(
                            numberOfSlides / 2 - 1
                        )
                    }
                }
            } else if (
                (settings["reverse"] || settings["reverse"] === "true") &&
                numberOfSlides > 0
            ) {
                if (settings["loop"] || settings["loop"] === "true") {
                    carousel_settings["initialSlide"] = Math.max(
                        0,
                        numberOfSlides - 1
                    )
                } else {
                    carousel_settings["initialSlide"] = Math.max(
                        0,
                        numberOfSlides - carousel_settings["slidesPerView"]
                    )
                }
            }

            if (settings["center_slide"] || settings["center_slide"] == "true")
                carousel_settings["centeredSlides"] = true

            if (settings["loop"] || settings["loop"] === "true") {
                carousel_settings["loop"] = true
            }

            if (settings["autoplay"] || settings["autoplay"] === "true") {
                carousel_settings["autoplay"] = {
                    delay: settings["delay"],
                    disableOnInteraction: settings["pause_on_interaction"],
                    pauseOnMouseEnter:
                        settings["pause_on_hover"] ||
                        settings["pause_on_hover"] === "true",
                }

                // Set reverse direction if enabled
                if (settings["reverse"] || settings["reverse"] === "true") {
                    carousel_settings["autoplay"]["reverseDirection"] = true
                }
            } else {
                carousel_settings["autoplay"] = false
            }

            // parallax
            if (settings["parallax"] === "true") {
                carousel_settings["parallax"] = true
            }

            if (settings["slide_mode"] === "fade") {
                carousel_settings["fadeEffect"] = {
                    crossFade: true,
                }
            }

            if (settings["slide_mode"] === "cards") {
                carousel_settings["centeredSlides"] = true
                carousel_settings["cardsEffect"] = {
                    perSlideRotate: 7,
                    // perSlideOffset: 0,
                }
            }

            if (settings["slide_mode"] === "carousel") {
                carousel_settings["modules"] = [EffectCarousel]
            }

            if (settings["slide_mode"] === "gl") {
                carousel_settings["modules"] = [SwiperGL]
            }

            // Coverflow Effect
            if (settings["slide_mode"] === "coverflow") {
                carousel_settings["centeredSlides"] = true
                carousel_settings["coverflowEffect"] = {
                    rotate: 0,
                    stretch: 175,
                    depth: 0,
                    scale: 1,
                    modifier: 1,
                    slideShadows: false,
                }
            }

            // Start Swiper Thumbnail
            var slide_thumbs = null
            if ($this.find(".pxl-swiper-thumbs").length > 0) {
                var thumb_settings = $this
                    .find(".pxl-swiper-thumbs")
                    .data().settings

                var thumb_carousel_settings = {
                    effect: "slide",
                    direction: "horizontal",
                    wrapperClass: "pxl-swiper-wrapper",
                    slideClass: "pxl-swiper-slide",
                    spaceBetween: 0,
                    slidesPerView: thumb_settings["slides_to_show"],
                    freeMode: true,
                    watchSlidesProgress: true,
                    slideToClickedSlide: true,
                }

                if (
                    thumb_settings["center_slide"] ||
                    thumb_settings["center_slide"] === "true"
                ) {
                    thumb_carousel_settings["centeredSlides"] = true
                }

                if (
                    thumb_settings["loop"] ||
                    thumb_settings["loop"] === "true"
                ) {
                    thumb_carousel_settings["loop"] = true
                }

                slide_thumbs = new Swiper(
                    $this.find(".pxl-swiper-thumbs")[0],
                    thumb_carousel_settings
                )
                carousel_settings["thumbs"] = { swiper: slide_thumbs }
            }
            // End Swiper Thumbnail

            var swiper = new Swiper(
                $this.find(".pxl-swiper-container")[0],
                carousel_settings
            )

            // Ensure autoplay with reverse direction works correctly after initialization
            if (
                (settings["reverse"] || settings["reverse"] === "true") &&
                swiper.autoplay
            ) {
                // Restart autoplay to ensure reverseDirection is properly applied
                setTimeout(function () {
                    if (swiper.autoplay && swiper.autoplay.running) {
                        swiper.autoplay.stop()
                        swiper.autoplay.start()
                    } else if (swiper.autoplay) {
                        swiper.autoplay.start()
                    }
                }, 100)
            }

            if (
                (settings["autoplay"] || settings["autoplay"] === "true") &&
                (settings["pause_on_hover"] ||
                    settings["pause_on_hover"] === "true")
            ) {
                $($this.find(".pxl-swiper-container")).on({
                    mouseenter: function mouseenter() {
                        this.swiper.autoplay.stop()
                    },
                    mouseleave: function mouseleave() {
                        this.swiper.autoplay.start()
                    },
                })
            }

            // Navigation-Carousel
            $(".pxl-navigation-carousel")
                .parents(".elementor-element")
                .addClass("pxl--hide-arrow")
            setTimeout(function () {
                $(".pxl-navigation-carousel .pxl-navigation-arrow-prev").on(
                    "click",
                    function () {
                        $(this)
                            .parents(".elementor-element")
                            .find(".pxl-swiper-arrow.pxl-swiper-arrow-prev")
                            .trigger("click")
                    }
                )
                $(".pxl-navigation-carousel .pxl-navigation-arrow-next").on(
                    "click",
                    function () {
                        $(this)
                            .parents(".elementor-element")
                            .find(".pxl-swiper-arrow.pxl-swiper-arrow-next")
                            .trigger("click")
                    }
                )
            }, 300)

            $(".pxl-portfolio-carousel2").on(
                "mouseenter",
                ".pxl-swiper-slide .pxl-post--inner",
                function () {
                    $(".pxl-post--inner").removeClass("active")
                    $(this).addClass("active")
                }
            )

            /* Arrow Custom */
            var section_tab = $(".pxl-pagination-carousel")
                .parents(".elementor-element:not(.elementor-inner-section)")
                .addClass("pxl--hide-arrow")
            var target = section_tab.find(".pxl-swiper-slider .pxl-swiper-dots")

            var target_tab = target
                .parents(".elementor-element.pxl--hide-arrow")
                .find(".pxl-pagination-carousel")
            target_tab.empty()

            var target_clone = target.clone()
            target_tab.append(target_clone)

            target_tab
                .find(".pxl-swiper-pagination-bullet")
                .each(function (index) {
                    var stepText = "Step " + (index + 1) + "."
                    $(this).text(stepText)
                })

            target_tab
                .find(".pxl-swiper-pagination-bullet")
                .on("click", function () {
                    var $this = $(this)
                    var $section = $this.parents(
                        ".elementor-element.pxl--hide-arrow"
                    )

                    $section
                        .find(
                            ".pxl-pagination-carousel .pxl-swiper-pagination-bullet"
                        )
                        .removeClass("swiper-pagination-bullet-active")
                        .attr("aria-current", "false")
                    $section
                        .find(
                            ".pxl-swiper-slider .pxl-swiper-pagination-bullet"
                        )
                        .removeClass("swiper-pagination-bullet-active")
                        .attr("aria-current", "false")

                    $this
                        .addClass("swiper-pagination-bullet-active")
                        .attr("aria-current", "true")
                    var index = $this.index()
                    $section
                        .find(
                            ".pxl-swiper-slider .pxl-swiper-pagination-bullet"
                        )
                        .eq(index)
                        .addClass("swiper-pagination-bullet-active")
                        .attr("aria-current", "true")

                    $section
                        .find(
                            ".pxl-swiper-slider .pxl-swiper-pagination-bullet"
                        )
                        .eq(index)
                        .trigger("click")
                })
            //

            $scope
                .find(".pxl--filter-inner .filter-item")
                .off("click.pxlCarouselFilter")
                .on("click.pxlCarouselFilter", function () {
                    var $button = $(this)
                    var target = $button.attr("data-filter-target")
                    var $parent = $button.closest(".pxl-swiper-slider")
                    if (
                        window.frameflowCarouselHelpers &&
                        typeof window.frameflowCarouselHelpers
                            .applyFilterAndReinit === "function"
                    ) {
                        var filtered = window.frameflowCarouselHelpers.applyFilterAndReinit(
                            {
                                target: target,
                                $button: $button,
                                $parent: $parent,
                                $sourceSlides: allSlides,
                                $container: $parent.find(".pxl-swiper-wrapper"),
                                swiper: swiper,
                                carouselSettings: carousel_settings,
                            }
                        )
                        swiper = filtered.swiper
                        numberOfSlides = filtered.numberOfSlides
                        $button
                            .siblings(".filter-item")
                            .removeClass("active")
                            .attr("aria-selected", "false")
                        $button
                            .addClass("active")
                            .attr("aria-selected", "true")
                    } else {
                        $button.siblings().removeClass("active")
                        $button.addClass("active")
                    }
                })
        })

        function setBoxHeight() {
            var $verticalCarousels = $(".swiper-vertical")
            if (!$verticalCarousels.length) {
                return
            }

            $verticalCarousels.each(function () {
                var $carousel = $(this)
                var $activeSlide = $carousel
                    .find(".pxl-swiper-slide.swiper-slide-active")
                    .not(".swiper-slide-duplicate")
                    .first()

                if (!$activeSlide.length) {
                    $activeSlide = $carousel
                        .find(".pxl-swiper-slide")
                        .not(".swiper-slide-duplicate")
                        .first()
                }

                if (!$activeSlide.length) {
                    return
                }

                var $slideInner = $activeSlide.find(
                    "> .pxl-item-wrapper > .pxl-item--inner, > .pxl-post--inner, > .pxl-swiper-slide-box"
                ).first()

                if (!$slideInner.length) {
                    $slideInner = $activeSlide.children().first()
                }

                var slideHeight = parseFloat($slideInner.outerHeight(true)) || 0
                var paddingTop =
                    parseFloat($activeSlide.css("padding-top")) || 0
                var paddingBottom =
                    parseFloat($activeSlide.css("padding-bottom")) || 0

                $carousel.height(slideHeight + paddingTop + paddingBottom + 2)
            })
        }

        function animateFilterWhileDragging(progress) {
            if (window.innerWidth <= 767) return
            const filterElements = document.querySelectorAll(
                ".pxl-portfolio-carousel1 .swiper-filter.style-2"
            )

            filterElements.forEach((filterElement) => {
                let translateX = progress * -1000
                let rotateY = progress * -1000
                let translateZ = 5 * progress * -1000

                gsap.to(filterElement, {
                    duration: 0.5,
                    x: translateX,
                    z: translateZ,
                    rotateY: rotateY,
                    opacity: 1,
                    ease: "power3.out",
                })
            })
        }
    }

    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/pxl_post_carousel.default",
            function ($scope) {
                pxl_swiper_handler($scope)
            }
        )
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/pxl_service_carousel.default",
            function ($scope) {
                pxl_swiper_handler($scope)
            }
        )
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/pxl_portfolio_carousel.default",
            function ($scope) {
                pxl_swiper_handler($scope)
            }
        )
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/pxl_slider_carousel.default",
            function ($scope) {
                pxl_swiper_handler($scope)
            }
        )

        elementorFrontend.hooks.addAction(
            "frontend/element_ready/pxl_slider.default",
            function ($scope) {
                pxl_swiper_handler($scope)
            }
        )

        elementorFrontend.hooks.addAction(
            "frontend/element_ready/pxl_team_carousel.default",
            function ($scope) {
                pxl_swiper_handler($scope)
            }
        )

        elementorFrontend.hooks.addAction(
            "frontend/element_ready/pxl_process.default",
            function ($scope) {
                pxl_swiper_handler($scope)
            }
        )

        elementorFrontend.hooks.addAction(
            "frontend/element_ready/pxl_image_carousel.default",
            function ($scope) {
                pxl_swiper_handler($scope)
            }
        )

        elementorFrontend.hooks.addAction(
            "frontend/element_ready/pxl_testimonial_carousel.default",
            function ($scope) {
                pxl_swiper_handler($scope)
                frameflowSyncTestimonial15Shapes($scope)
            }
        )

        elementorFrontend.hooks.addAction(
            "frontend/element_ready/pxl_text_carousel.default",
            function ($scope) {
                pxl_swiper_handler($scope)
            }
        )

        elementorFrontend.hooks.addAction(
            "frontend/element_ready/pxl_icon_box_carousel.default",
            function ($scope) {
                pxl_swiper_handler($scope)
            }
        )

        elementorFrontend.hooks.addAction(
            "frontend/element_ready/pxl_product_carousel.default",
            function ($scope) {
                pxl_swiper_handler($scope)
                frameflowSyncProductCarouselArrowInsets($scope)
            }
        )
    })
})(jQuery)
