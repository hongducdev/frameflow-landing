(function ($) {
    var pxl_widget_accordion_handler = function ($scope, $) {
        $scope
            .find(".pxl-accordion .pxl-item")
            .on("click", function (e) {
                e.preventDefault();
                var $item = $(this);

                if ($item.hasClass("active")) {
                    return;
                }

                var pxl_target = $item.find(".pxl-item--title").data("target");
                var pxl_parent = $item.parents(".pxl-accordion");

                pxl_parent.find(".pxl-item").not($item).each(function () {
                    var $other = $(this);
                    $other.removeClass("active");
                    var otherTarget = $other.find(".pxl-item--title").data("target");
                    if (otherTarget) {
                        $(otherTarget).slideUp(400);
                    }
                });

                $item.addClass("active");
                $(pxl_target).slideDown(400);
            });
    };
    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/pxl_accordion.default",
            pxl_widget_accordion_handler,
        );
    });
})(jQuery);
