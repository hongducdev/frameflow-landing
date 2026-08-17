(function ($) {
    "use strict";

    var pxl_widget_tabs_handler = function ($scope, $) {
        $scope
            .find(
                ".pxl-tabs.tab-effect-slide:not(.pxl-tabs7) .pxl-item--navigation-item",
            )
            .on("click", function (e) {
                e.preventDefault();
                var target = $(this).data("target");
                var parent = $(this).parents(".pxl-tabs");
                parent
                    .find(".pxl-item--content .pxl-item--content-item")
                    .slideUp(300);
                parent
                    .find(".pxl-item--navigation .pxl-item--navigation-item")
                    .removeClass("active");
                $(this).addClass("active");
                $(target).slideDown(300);
            });

        $scope
            .find(
                ".pxl-tabs.tab-effect-fade:not(.pxl-tabs7) .pxl-item--navigation-item, .pxl-tabs.tab-effect-cretive:not(.pxl-tabs7) .pxl-item--navigation-item",
            )
            .on("click", function (e) {
                e.preventDefault();
                var target = $(this).data("target");
                var parent = $(this).parents(".pxl-tabs");
                parent
                    .find(".pxl-item--content .pxl-item--content-item")
                    .removeClass("active");
                parent
                    .find(".pxl-item--navigation .pxl-item--navigation-item")
                    .removeClass("active");
                $(this).addClass("active");
                $(target).addClass("active");
            });

        // Start: Logic only for layout 2 (pxl-tabs2)
        $(document).on(
            "click",
            ".pxl-tabs2 .pxl-item--navigation-item",
            function (e) {
                e.preventDefault();
                var $navItem = $(this);
                var templateId = $navItem.data("template");

                if (!templateId) {
                    return;
                }

                $(".pxl-tabs2 .pxl-item--navigation-item").removeClass(
                    "active",
                );
                $navItem.addClass("active");

                var $allContents = $(".pxl-tabs2 .pxl-item--content-item");
                $allContents.removeClass("active");
                $allContents
                    .filter('[data-template="' + templateId + '"]')
                    .addClass("active");
            },
        );
        // End: Logic only for layout 2

        // Start: Logic only for layout 7 (pxl-tabs7) — split nav/content like layout 2
        $(document).on(
            "click",
            ".pxl-tabs7 .pxl-item--navigation-item",
            function (e) {
                e.preventDefault();
                var $navItem = $(this);
                // attr() keeps string keys; .data() coerces "1" → 1 and can break matching.
                var templateId = $navItem.attr("data-template");

                if (templateId === undefined || templateId === "") {
                    return;
                }

                var $allContents = $(".pxl-tabs7 .pxl-item--content-item");
                var $next = $allContents.filter(
                    '[data-template="' + templateId + '"]',
                );

                $(".pxl-tabs7 .pxl-item--navigation-item").removeClass(
                    "active",
                );
                $navItem.addClass("active");

                if (!$next.length || $next.hasClass("active")) {
                    return;
                }

                // Activate next first so both layers overlap during opacity crossfade.
                $next.addClass("active");
                $allContents.not($next).removeClass("active");
            },
        );
        // End: Logic only for layout 7

        // Start: Logic only for layout 3
        $scope.find(".pxl-tabs3").each(function () {
            var $tabs = $(this);
            var $nav = $tabs.find(".pxl-item--navigation").first();
            var $navItems = $nav.find(".pxl-item--navigation-item");
            var $switch = $nav.find(".pxl-item--navigation-switch").first();

            if ($navItems.length !== 2) {
                return;
            }
            var syncSwitchState = function ($activeItem) {
                if (!$activeItem || !$activeItem.length || !$switch.length) {
                    return;
                }

                $navItems.css("transition", "none");
                void $nav[0].getBoundingClientRect();

                var navRect = $nav[0].getBoundingClientRect();
                var itemRect = $activeItem[0].getBoundingClientRect();
                var left = itemRect.left - navRect.left;
                var width = itemRect.width;

                $navItems.css("transition", "");

                $switch.css({
                    left: left,
                    width: width,
                });
            };

            var $initialActive = $navItems.filter(".active").first();
            if (!$initialActive.length) {
                $initialActive = $navItems.first();
            }
            syncSwitchState($initialActive);

            $(window).on("resize", function () {
                syncSwitchState($navItems.filter(".active").first());
            });

            $navItems.on("click", function (e) {
                e.preventDefault();

                var $current = $(this);
                var target = $current.data("target");
                var templateId = $current.data("template");
                $navItems.removeClass("active");
                $current.addClass("active");
                syncSwitchState($current);

                if (templateId) {
                    $(
                        ".pxl-tabs3 .pxl-item--navigation-item[data-template]",
                    ).removeClass("active");
                    $(
                        ".pxl-tabs3 .pxl-item--navigation-item[data-template='" +
                            templateId +
                            "']",
                    ).addClass("active");

                    var $allContents = $(
                        ".pxl-tabs3 .pxl-item--content-item[data-template]",
                    );
                    $allContents.removeClass("active");
                    $allContents
                        .filter("[data-template='" + templateId + "']")
                        .addClass("active");
                    return;
                }

                if (!target) {
                    return;
                }

                $tabs
                    .find(".pxl-item--content .pxl-item--content-item")
                    .removeClass("active");
                $tabs.find(target).addClass("active");
            });
        });
        // End: Logic only for layout 3
    };

    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/pxl_tabs.default",
            pxl_widget_tabs_handler,
        );
    });
})(jQuery);
