;(function ($) {
    "use strict"

    // Frameflow price filter slider — debounce auto-filter
    var DEBOUNCE_MS = 450
    var debounceTimer = null

    function clamp(val, min, max) {
        return Math.min(max, Math.max(min, val))
    }

    function scheduleFilter($form) {
        if (!$form || !$form.length) {
            return
        }
        clearTimeout(debounceTimer)
        debounceTimer = setTimeout(function () {
            $form.trigger("submit")
        }, DEBOUNCE_MS)
    }

    function readNum($el, attr, fallback) {
        var raw = $el.attr(attr)
        var n = parseFloat(raw)
        return isNaN(n) ? fallback : n
    }

    function initPriceFilter() {
        if (typeof $.fn.slider !== "function") {
            return false
        }

        $(".pxl_widget_price_filter .pxl-price-filter__slider").each(function () {
            var $slider = $(this)
            if ($slider.data("pxlPriceReady")) {
                return
            }

            var $form = $slider.closest("form")
            var $minInput = $form.find(".pxl-price-filter__input--min")
            var $maxInput = $form.find(".pxl-price-filter__input--max")
            var min = readNum($slider, "data-min", NaN)
            var max = readNum($slider, "data-max", NaN)
            var step = readNum($slider, "data-step", 1) || 1
            var currentMin = readNum($slider, "data-current-min", min)
            var currentMax = readNum($slider, "data-current-max", max)

            if (isNaN(min) || isNaN(max) || min === max) {
                return
            }

            currentMin = clamp(currentMin, min, max)
            currentMax = clamp(currentMax, min, max)
            if (currentMin > currentMax) {
                currentMin = min
                currentMax = max
            }

            $minInput.val(currentMin)
            $maxInput.val(currentMax)

            try {
                if ($slider.hasClass("ui-slider")) {
                    $slider.slider("destroy")
                }
            } catch (err) {
                // ignore
            }

            $slider.slider({
                range: true,
                min: min,
                max: max,
                step: step,
                values: [currentMin, currentMax],
                slide: function (event, ui) {
                    $minInput.val(ui.values[0])
                    $maxInput.val(ui.values[1])
                },
                stop: function (event, ui) {
                    $minInput.val(ui.values[0])
                    $maxInput.val(ui.values[1])
                    scheduleFilter($form)
                },
            })

            $slider.data("pxlPriceReady", 1)
        })

        return true
    }

    function syncInputsToSlider($input, shouldFilter) {
        var $form = $input.closest("form")
        var $slider = $form.find(".pxl-price-filter__slider")
        if (!$slider.data("pxlPriceReady") || typeof $.fn.slider !== "function") {
            return
        }

        var min = parseFloat($slider.slider("option", "min"))
        var max = parseFloat($slider.slider("option", "max"))
        var step = parseFloat($slider.slider("option", "step")) || 1
        var $minInput = $form.find(".pxl-price-filter__input--min")
        var $maxInput = $form.find(".pxl-price-filter__input--max")
        var minVal = parseFloat($minInput.val())
        var maxVal = parseFloat($maxInput.val())

        if (isNaN(minVal)) {
            minVal = min
        }
        if (isNaN(maxVal)) {
            maxVal = max
        }

        minVal = Math.round(minVal / step) * step
        maxVal = Math.round(maxVal / step) * step
        minVal = clamp(minVal, min, max)
        maxVal = clamp(maxVal, min, max)
        if (minVal > maxVal) {
            if ($input.hasClass("pxl-price-filter__input--min")) {
                minVal = maxVal
            } else {
                maxVal = minVal
            }
        }

        $minInput.val(minVal)
        $maxInput.val(maxVal)
        $slider.slider("values", [minVal, maxVal])

        if (shouldFilter) {
            scheduleFilter($form)
        }
    }

    function boot() {
        if (initPriceFilter()) {
            return
        }
        var tries = 0
        var timer = setInterval(function () {
            tries += 1
            if (initPriceFilter() || tries > 40) {
                clearInterval(timer)
            }
        }, 100)
    }

    $(function () {
        boot()
    })

    $(document.body).on("pxl_init_price_filter pxl_shop_ajax_updated", function () {
        initPriceFilter()
    })

    $(document).on("input", ".pxl_widget_price_filter .pxl-price-filter__input", function () {
        syncInputsToSlider($(this), true)
    })

    $(document).on("change", ".pxl_widget_price_filter .pxl-price-filter__input", function () {
        syncInputsToSlider($(this), true)
    })
})(jQuery)
