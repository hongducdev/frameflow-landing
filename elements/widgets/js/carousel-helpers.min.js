;(function ($) {
    function getCurrentWowSlides(swiperInstance) {
        // Guard: init can fire before Swiper attaches slides (empty/broken markup).
        if (!swiperInstance || !swiperInstance.slides) {
            return $()
        }

        var $allSlides = $(swiperInstance.slides)
        var activeSlideEl = swiperInstance.slides[swiperInstance.activeIndex]
        var activeDataIndex = activeSlideEl
            ? $(activeSlideEl).attr("data-swiper-slide-index")
            : null

        if (activeDataIndex !== undefined && activeDataIndex !== null) {
            var $sameRealSlides = $allSlides.filter(function () {
                return (
                    String($(this).attr("data-swiper-slide-index")) ===
                    String(activeDataIndex)
                )
            })
            if ($sameRealSlides.length) {
                return $sameRealSlides
            }
        }

        return $allSlides.filter(".swiper-slide-active")
    }

    function replayWow(swiperInstance, selector) {
        if (
            typeof WOW === "undefined" ||
            !swiperInstance ||
            !swiperInstance.slides
        ) {
            return
        }

        var wowSelector = selector || ".wow"
        var $activeSlides = getCurrentWowSlides(swiperInstance)
        if (!$activeSlides.length) {
            return
        }

        var $wowItems = $activeSlides.find(wowSelector)
        if (!$wowItems.length) {
            return
        }

        $wowItems.each(function () {
            var $el = $(this)

            $el.removeClass("animated")
            this.style.animationName = "none"
            this.style.visibility = "hidden"
            void this.offsetWidth
            requestAnimationFrame(() => {
                this.style.animationName = ""
                this.style.visibility = "visible"
                $el.addClass("animated")
            })
        })
    }

    function syncThumbs(swiper, speed) {
        if (!swiper || !swiper.thumbs || !swiper.thumbs.swiper) {
            return
        }

        var thumbSwiper = swiper.thumbs.swiper
        var realIndex =
            swiper.realIndex !== undefined ? swiper.realIndex : swiper.activeIndex
        var thumbRealIndex =
            thumbSwiper.realIndex !== undefined
                ? thumbSwiper.realIndex
                : thumbSwiper.activeIndex

        if (thumbRealIndex === realIndex || thumbSwiper.animating) {
            return
        }

        if (thumbSwiper.params && thumbSwiper.params.loop) {
            thumbSwiper.slideToLoop(realIndex, speed || 0)
        } else {
            thumbSwiper.slideTo(realIndex, speed || 0)
        }
    }

    function applyFilterAndReinit(options) {
        var target = options.target
        var $button = options.$button
        var $parent = options.$parent
        var $sourceSlides = options.$sourceSlides
        var $container = options.$container
        var swiper = options.swiper
        var carouselSettings = options.carouselSettings

        $button.siblings().removeClass("active")
        $button.addClass("active")
        $parent.find(".pxl-swiper-slide").remove()

        if (target === "all") {
            $sourceSlides.each(function () {
                $container.append($(this)[0].outerHTML)
            })
        } else {
            $sourceSlides.each(function () {
                if (
                    $(this).is("[data-filter^='" + target + "']") ||
                    $(this).is("[data-filter*='" + target + "']")
                ) {
                    $container.append($(this)[0].outerHTML)
                }
            })
        }

        var numberOfSlides = $parent.find(".pxl-swiper-slide").length
        if (carouselSettings["centeredSlides"]) {
            if (carouselSettings["loop"]) {
                carouselSettings["initialSlide"] = Math.floor(numberOfSlides / 2)
            } else if (carouselSettings["slidesPerView"] > 1) {
                carouselSettings["initialSlide"] = Math.ceil(
                    (numberOfSlides - carouselSettings["slidesPerView"]) / 2
                )
            } else {
                carouselSettings["initialSlide"] = Math.ceil(numberOfSlides / 2 - 1)
            }
        }

        if (typeof window.destroyRipples === "function") {
            window.destroyRipples($parent)
        }

        swiper.destroy()
        var nextSwiper = new Swiper($parent.find(".pxl-swiper-container")[0], carouselSettings)

        if (typeof window.initRipples === "function") {
            setTimeout(function () {
                var $slides = $parent.find(".pxl-swiper-slide.swiper-slide-visible")
                if (!$slides.length) {
                    $slides = $parent.find(".pxl-swiper-slide")
                }
                if ($slides.length) {
                    window.initRipples($slides)
                }
            }, 150)
        }

        return {
            swiper: nextSwiper,
            numberOfSlides: numberOfSlides,
        }
    }

    window.frameflowCarouselHelpers = {
        replayWow: replayWow,
        syncThumbs: syncThumbs,
        applyFilterAndReinit: applyFilterAndReinit,
    }
})(jQuery)
