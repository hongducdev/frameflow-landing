(function ($) {
    "use strict";

    var pxl_widget_text_marquee_handler = function ($scope, $) {
        var $marquee = $scope.find(".pxl-text-marquee");
        if (!$marquee.length) {
            return;
        }

        if (typeof gsap === "undefined") {
            return;
        }

        $marquee.each(function () {
            var $instance = $(this);
            var $track = $instance.find(".pxl-text-marquee__track");

            if (!$track.length) {
                return;
            }

            var existingTimeline = $instance.data("pxlMarqueeTimeline");
            if (existingTimeline) {
                existingTimeline.kill();
            }

            var existingResize = $instance.data("pxlMarqueeResize");
            if (existingResize) {
                $(window).off("resize", existingResize);
            }

            function splitLongPlainLabel(label) {
                var text = $.trim($("<div>").html(label).text().replace(/\s+/g, " "));

                if (text.length < 90) {
                    return [label];
                }

                var phraseStartPattern =
                    /\s+(?=(?:Reliable|End-to-End|Smart|Moving|Creative|Visual|Motion|Brand)\b)/g;
                var parts = text
                    .split(phraseStartPattern)
                    .map(function (part) {
                        return $.trim(part);
                    })
                    .filter(function (part) {
                        return part.length;
                    });

                if (parts.length <= 1) {
                    return [label];
                }

                return parts.map(function (part) {
                    return $("<div>").text(part).html();
                });
            }

            function normalizeMarqueeItems() {
                if ($instance.data("pxlMarqueeNormalized")) {
                    return;
                }

                var $children = $track.children(".pxl-text-marquee__item");
                if (!$children.length) {
                    return;
                }

                var baseItems = $children.toArray();
                var half = Math.floor(baseItems.length / 2);

                if (baseItems.length > 1 && baseItems.length % 2 === 0) {
                    var duplicated = true;

                    for (var i = 0; i < half; i++) {
                        if ($.trim($(baseItems[i]).text()) !== $.trim($(baseItems[i + half]).text())) {
                            duplicated = false;
                            break;
                        }
                    }

                    if (duplicated) {
                        baseItems = baseItems.slice(0, half);
                    }
                }

                var normalizedItems = [];

                $.each(baseItems, function () {
                    var $item = $(this);
                    var iconHtml = $item.find(".pxl-text-marquee__icon").first().prop("outerHTML") || "";
                    var $label = $item.find(".pxl-text-marquee__label").first();
                    var labels = [];

                    if ($label.length) {
                        var $content = $("<div>").html($label.html());
                        var $blocks = $content.children("p, div");

                        if ($blocks.length) {
                            $blocks.each(function () {
                                labels.push($(this).html());
                            });
                        } else {
                            labels = $content.html().replace(/<br\s*\/?>/gi, "\n").split(/\r\n|\r|\n|\|/);
                        }

                        labels = labels
                            .map(function (label) {
                                return $.trim(label);
                            })
                            .filter(function (label) {
                                return $.trim($("<div>").html(label).text().replace(/\s+/g, " ")).length;
                            });
                    }

                    if (!labels.length) {
                        var $textItem = $item.clone();
                        $textItem.find(".pxl-text-marquee__icon").remove();
                        labels = [$("<div>").text($.trim($textItem.text().replace(/\s+/g, " "))).html()];
                    }

                    labels = labels.reduce(function (result, label) {
                        return result.concat(splitLongPlainLabel(label));
                    }, []);

                    $.each(labels, function (_, label) {
                        if (!label) {
                            return;
                        }

                        normalizedItems.push({
                            icon: iconHtml,
                            label: label,
                        });
                    });
                });

                if (!normalizedItems.length) {
                    return;
                }

                $track.empty();

                for (var loop = 0; loop < 2; loop++) {
                    $.each(normalizedItems, function (_, item) {
                        var $newItem = $('<div class="pxl-text-marquee__item">');

                        if (loop > 0) {
                            $newItem.attr("aria-hidden", "true");
                        }

                        if (item.icon) {
                            $newItem.append(item.icon);
                        }

                        $("<span>", {
                            class: "pxl-text-marquee__label",
                        })
                            .html(item.label)
                            .appendTo($newItem);

                        $track.append($newItem);
                    });
                }

                $instance.data("pxlMarqueeNormalized", true);
            }

            function retrySetup(attachResize) {
                if (!attachResize) {
                    return;
                }

                var n = parseInt($instance.data("pxlMarqueeRetries"), 10) || 0;
                if (n >= 30) {
                    return;
                }

                $instance.data("pxlMarqueeRetries", n + 1);
                setTimeout(function () {
                    setupMarquee(true);
                }, n < 10 ? 50 : 200);
            }

            function setupMarquee(attachResize) {
                if (attachResize === undefined) {
                    attachResize = true;
                }

                if (!$instance.is(":visible")) {
                    retrySetup(attachResize);
                    return;
                }

                var speedAttr = parseFloat($instance.data("marquee-speed"));
                var speed = !isNaN(speedAttr) && speedAttr > 0 ? speedAttr : 80;
                var direction =
                    ($instance.data("marquee-direction") || "left").toString().toLowerCase() ===
                    "right"
                        ? "right"
                        : "left";

                gsap.set($track, { x: 0 });
                normalizeMarqueeItems();

                var trackEl = $track.get(0);
                if (!trackEl) {
                    return;
                }

                if (
                    !window.frameflowMarqueeHelpers ||
                    typeof window.frameflowMarqueeHelpers.fillTrack !== "function"
                ) {
                    retrySetup(attachResize);
                    return;
                }

                var distance = window.frameflowMarqueeHelpers.fillTrack(
                    $track,
                    $instance.get(0),
                );
                if (!distance || distance <= 0) {
                    retrySetup(attachResize);
                    return;
                }

                $instance.data("pxlMarqueeRetries", 0);

                var tl = window.frameflowMarqueeHelpers.createTween(
                    $track,
                    distance,
                    speed,
                    direction,
                );

                $instance.data("pxlMarqueeTimeline", tl);

                if (attachResize) {
                    var resizeHandler = function () {
                        if (!document.body.contains($instance.get(0))) {
                            $(window).off("resize", resizeHandler);
                            if (tl) {
                                tl.kill();
                            }
                            return;
                        }

                        if (tl) {
                            tl.kill();
                        }
                        setupMarquee(false);
                    };

                    $(window).on("resize", resizeHandler);
                    $instance.data("pxlMarqueeResize", resizeHandler);
                }
            }

            setupMarquee(true);
        });
    };

    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/pxl_text_marquee.default",
            pxl_widget_text_marquee_handler,
        );
    });

    $(function () {
        $(".elementor-widget-pxl_text_marquee").each(function () {
            pxl_widget_text_marquee_handler($(this), $);
        });
    });
})(jQuery);
