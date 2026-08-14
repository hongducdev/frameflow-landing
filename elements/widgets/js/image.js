(function ($) {
    var pxl_widget_image_handler = function ($scope) {
        $scope.find(".pxl-image-gallery").each(function () {
            var $gallery = $(this)
            var prevTimer = $gallery.data("pxlGalleryTimer")
            if (prevTimer) {
                clearInterval(prevTimer)
            }

            var $items = $gallery.find(".pxl-image-gallery-item")
            if ($items.length < 2) {
                return
            }

            var index = $items.filter(".is-active").index()
            if (index < 0) {
                index = 0
                $items.eq(0).addClass("is-active")
            }

            var interval = parseInt($gallery.data("interval"), 10) || 3000
            if (interval < 500) {
                interval = 3000
            }

            var timer = setInterval(function () {
                $items.eq(index).removeClass("is-active")
                index = (index + 1) % $items.length
                $items.eq(index).addClass("is-active")
            }, interval)

            $gallery.data("pxlGalleryTimer", timer)
        })
    }

    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/pxl_image.default",
            pxl_widget_image_handler,
        )
    })
})(jQuery)
