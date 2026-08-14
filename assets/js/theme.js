(function ($) {
    "use strict";

    var pxl_scroll_top;
    var pxl_window_height;
    var pxl_window_width;
    var pxl_scroll_status = "";
    var pxl_last_scroll_top = 0;

    var scrollRAF = null;
    var $pinSpacer = null;
    var resizeTimeout = null;

    $(window).on("load", function () {
        setTimeout(function () {
            $(".pxl-loader").addClass("is-loaded");
        }, 60);
        $(".pxl-swiper-slider, .pxl-header-mobile-elementor").css(
            "opacity",
            "1",
        );
        pxl_window_width = $(window).width();
        pxl_window_height = $(window).height();
        $pinSpacer = $(".elementor > .pin-spacer");
        frameflow_header_sticky();
        frameflow_header_mobile();
        frameflow_scroll_to_top();
        frameflow_footer_fixed();
        dropdown_offices();
        frameflow_shop_quantity();
        frameflow_submenu_responsive();
        frameflow_panel_anchor_toggle();
        frameflow_slider_column_offset();
        frameflow_el_parallax();
        if (typeof window.frameflowEnsureStellarParallax === "function") {
            window.frameflowEnsureStellarParallax();
        }
        setTimeout(function () {
            if (typeof initTeamGridUrlState === "function") {
                initTeamGridUrlState();
            }
        }, 400);
    });

    $(window).on("scroll", function () {
        if (scrollRAF) cancelAnimationFrame(scrollRAF);

        scrollRAF = requestAnimationFrame(function () {
            pxl_scroll_top = $(window).scrollTop();
            pxl_scroll_status =
                pxl_scroll_top < pxl_last_scroll_top ? "up" : "down";
            pxl_last_scroll_top = pxl_scroll_top;

            frameflow_header_sticky();
            frameflow_scroll_to_top();
            frameflow_backtotop_update();
            frameflow_zoom_point_update();
            frameflow_ptitle_scroll_opacity();

            if (pxl_scroll_top < 100 && $pinSpacer && $pinSpacer.length) {
                $pinSpacer.removeClass("scroll-top-active");
            }

            scrollRAF = null;
        });
    });

    $(window).on("resize", function () {
        if (resizeTimeout) clearTimeout(resizeTimeout);

        resizeTimeout = setTimeout(function () {
            pxl_window_height = $(window).height();
            pxl_window_width = $(window).width();
            frameflow_submenu_responsive();
            frameflow_header_mobile();
            frameflow_slider_column_offset();
            frameflow_zoom_point();
            frameflow_footer_fixed();
            resizeTimeout = null;
        }, 150);
    });

    $(document).ready(function () {
        pxl_window_width = $(window).width();
        frameflow_backtotop_progess_bar();
        frameflow_type_file_upload();
        frameflow_zoom_point();
        if (pxl_window_width > 767) {
            frameflow_button_parallax();
        }

        setTimeout(function () {
            $(".pxl-section-bg-parallax")
                .closest(".elementor-element")
                .addClass("pxl-section-parallax-overflow");
        }, 500);

        $(".pxl-circle-svg svg").each(function () {
            var linearGradientId, linearGradientId1;
            var linearGradient = $(this).find(".linear-dot1");
            if (linearGradient.length > 0) {
                linearGradientId = linearGradient.attr("id");
            }
            var linearGradient1 = $(this).find(".linear-dot2");
            if (linearGradient1.length > 0) {
                linearGradientId1 = linearGradient1.attr("id");
            }
            frameflow_circle_svg(this, linearGradientId, linearGradientId1);
        });

        let runningColumnAnimations = 0;
        const maxColumnAnimations = 4;

        function animateColumn(colId, speed) {
            if (runningColumnAnimations >= maxColumnAnimations) return;

            const $col = $("#" + colId);
            if (!$col.length || $col.data("colTween")) return;

            const slideHeight = $col.outerHeight() / 2;
            if (slideHeight <= 0) return;

            const tween = gsap.to($col[0], {
                y: -slideHeight,
                ease: "none",
                duration: speed * 0.5,
                repeat: -1,
                modifiers: {
                    y: gsap.utils.unitize((y) => parseFloat(y) % slideHeight),
                },
                onStart: () => runningColumnAnimations++,
                onKill: () => {
                    runningColumnAnimations = Math.max(
                        0,
                        runningColumnAnimations - 1,
                    );
                    $col.removeData("colTween");
                },
            });

            $col.data("colTween", tween);
        }

        if (pxl_window_width > 767) {
            setTimeout(() => {
                if ($("#col1").length) animateColumn("col1", 34);
            }, 100);
            setTimeout(() => {
                if ($("#col2").length) animateColumn("col2", 32);
            }, 200);
            setTimeout(() => {
                if ($("#col3").length) animateColumn("col3", 30);
            }, 300);
            setTimeout(() => {
                if ($("#col4").length) animateColumn("col4", 28);
            }, 400);
        }

        $(".pxl-check-scroll .pxl-swiper-slide .filter-item").on(
            "mousedown",
            function () {
                $(this)
                    .closest(".pxl-swiper-slide")
                    .removeClass("visible")
                    .addClass("visible");
            },
        );

        setTimeout(function () {
            var $rowsParticles = $(".pxl-row-particles");
            if (typeof particlesJS !== "function" || !$rowsParticles.length)
                return;

            var isMobile =
                /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
                    navigator.userAgent,
                ) || window.innerWidth <= 768;
            if (isMobile) {
                $rowsParticles.hide();
                return;
            }

            $rowsParticles.each(function () {
                var $el = $(this);
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
        }, 400);

        /* Menu Mobile */
        $(".pxl-header-menu li.menu-item-has-children").each(function () {
            if ($(this).find(".pxl-menu-toggle").length === 0) {
                $(this).append('<span class="pxl-menu-toggle"></span>');
            }
        });

        $(document).on("click.pxl_menu", ".pxl-menu-toggle", function (e) {
            e.preventDefault();
            var $toggle = $(this);
            var $parentUl = $toggle.closest("ul");
            if ($toggle.hasClass("active")) {
                $parentUl
                    .find(".pxl-menu-toggle.active")
                    .not($toggle)
                    .toggleClass("active");
                $parentUl
                    .find(".sub-menu.active")
                    .toggleClass("active")
                    .slideToggle();
            } else {
                $parentUl.find(".pxl-menu-toggle.active").toggleClass("active");
                $parentUl
                    .find(".sub-menu.active")
                    .toggleClass("active")
                    .slideToggle();
                $toggle.toggleClass("active");
                $toggle
                    .parent()
                    .find("> .sub-menu")
                    .toggleClass("active")
                    .slideToggle();
            }
        });

        const setMobileMenuState = function (isOpen) {
            const $body = $("body");

            if (isOpen) {
                const scrollTop =
                    window.pageYOffset ||
                    document.documentElement.scrollTop ||
                    0;
                $body.data("pxl-mobile-scroll-top", scrollTop);
                $body.css({
                    position: "fixed",
                    top: -scrollTop + "px",
                    left: "0",
                    right: "0",
                    width: "100%",
                });
            } else {
                const savedScrollTop =
                    parseInt($body.data("pxl-mobile-scroll-top"), 10) || 0;
                $body.css({
                    position: "",
                    top: "",
                    left: "",
                    right: "",
                    width: "",
                });
                $body.removeData("pxl-mobile-scroll-top");
                window.scrollTo(0, savedScrollTop);
            }

            $("#pxl-nav-mobile").toggleClass("active", isOpen);
            $(".pxl-header-menu").toggleClass("active", isOpen);
            $body.toggleClass("body-overflow", isOpen);
        };

        $(document).on(
            "click.pxl_mobile_nav",
            "#pxl-nav-mobile, .pxl-anchor-mobile-menu",
            function (e) {
                e.preventDefault();
                const isOpen = !$(".pxl-header-menu").hasClass("active");
                setMobileMenuState(isOpen);
            },
        );

        $(document).on(
            "click.pxl_mobile_close",
            ".pxl-menu-close, .pxl-header-menu-backdrop, #pxl-header-mobile .pxl-menu-primary a.is-one-page",
            function (e) {
                if (!$(this).hasClass("is-one-page")) e.preventDefault();
                $(this)
                    .parents(".pxl-header-main")
                    .find(".pxl-header-menu")
                    .removeClass("active");
                setMobileMenuState(false);
            },
        );
        /* End Menu Mobile */

        /* Menu Vertical */
        $(".pxl-nav-vertical li.menu-item-has-children > a").append(
            '<span class="pxl-arrow-toggle"><i class="bi-chevron-right"></i></span>',
        );
        $(".pxl-nav-vertical li.menu-item-has-children > a").on(
            "click",
            function () {
                var $a = $(this);
                var $parentUl = $a.closest("ul");
                if ($a.hasClass("active")) {
                    $a.next().toggleClass("active").slideToggle();
                } else {
                    $parentUl
                        .find(".sub-menu.active")
                        .toggleClass("active")
                        .slideToggle();
                    $parentUl.find("a.active").toggleClass("active");
                    $a.find(".pxl-menu-toggle.active").toggleClass("active");
                    $a.toggleClass("active");
                    $a.next().toggleClass("active").slideToggle();
                }
            },
        );

        $(".comments-area .btn-submit").append(`
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M12.9719 9.59717L7.34692 15.2222C7.18841 15.3807 6.97343 15.4697 6.74927 15.4697C6.5251 15.4697 6.31012 15.3807 6.15161 15.2222C5.9931 15.0637 5.90405 14.8487 5.90405 14.6245C5.90405 14.4003 5.9931 14.1854 6.15161 14.0269L11.1797 9.00021L6.15302 3.97217C6.07453 3.89368 6.01227 3.80051 5.9698 3.69796C5.92732 3.59541 5.90546 3.48551 5.90546 3.37451C5.90546 3.26352 5.92732 3.15361 5.9698 3.05106C6.01227 2.94852 6.07453 2.85534 6.15302 2.77685C6.2315 2.69837 6.32468 2.63611 6.42722 2.59364C6.52977 2.55116 6.63968 2.5293 6.75067 2.5293C6.86167 2.5293 6.97158 2.55116 7.07412 2.59364C7.17667 2.63611 7.26984 2.69837 7.34833 2.77685L12.9733 8.40185C13.0519 8.48033 13.1142 8.57355 13.1567 8.67616C13.1991 8.77877 13.2209 8.88875 13.2208 8.9998C13.2207 9.11085 13.1986 9.22078 13.1559 9.32329C13.1132 9.4258 13.0507 9.51887 12.9719 9.59717Z" fill="currentColor"></path></svg><div class="btn-text-wrap"> <span> Post Your Comments </span> <span> Post Your Comments </span></div>
            `);

        /* Mega Menu Max Height */
        var $megaEl = $(
            "li.pxl-megamenu > .sub-menu > .pxl-mega-menu-elementor",
        );
        var m_h_mega = $megaEl.outerHeight();
        var w_h_mega = $(window).height();
        if (m_h_mega > w_h_mega) {
            $megaEl.css({
                "max-height": w_h_mega - 120 + "px",
                "overflow-y": "scroll",
                "overflow-x": "hidden",
            });
        }

        $("li.pxl-megamenu").hover(
            function () {
                $(this)
                    .parents(".elementor-element")
                    .addClass("section-mega-active");
            },
            function () {
                $(this)
                    .parents(".elementor-element")
                    .removeClass("section-mega-active");
            },
        );
        /* End Mega Menu Max Height */

        /* Search Popup */
        var $search_wrap_init = $("#pxl-search-popup");
        var search_field = $("#pxl-search-popup .search-field");
        var $body = $("body");

        $(".pxl-search-popup-button").on("click", function (e) {
            e.preventDefault();
            if (!$search_wrap_init.hasClass("active")) {
                $search_wrap_init.addClass("active");
                setTimeout(function () {
                    search_field.get(0).focus();
                }, 500);
            } else if (search_field.val() === "") {
                $search_wrap_init.removeClass("active");
                search_field.get(0).focus();
            }
            return false;
        });

        $(
            ".pxl-subscribe-popup .pxl-item--overlay, .pxl-subscribe-popup .pxl-item--close",
        ).on("click", function (e) {
            $(this).parents(".pxl-subscribe-popup").removeClass("pxl-active");
            e.preventDefault();
            return false;
        });

        $(
            "#pxl-search-popup .pxl-item--overlay, #pxl-search-popup .pxl-item--close",
        ).on("click", function (e) {
            $body.addClass("pxl-search-out-anim");
            setTimeout(function () {
                $body.removeClass("pxl-search-out-anim");
            }, 800);
            setTimeout(function () {
                $search_wrap_init.removeClass("active");
            }, 800);
            e.preventDefault();
            return false;
        });

        /* Scroll To Top */
        $(".pxl-scroll-top").click(function () {
            $("html, body").animate({ scrollTop: 0 }, 1200);
            $(this)
                .parents(".pxl-wapper")
                .find(".elementor > .pin-spacer")
                .addClass("scroll-top-active");
            return false;
        });

        /* Grid Filter Moving Border */
        $(".pxl-grid-filter").each(function () {
            var marker = $(this).find(".filter-marker"),
                item = $(this).find(".filter-item"),
                current = $(this).find(".filter-item.active");

            var offsettop = current.length ? current.position().top : 0;

            marker.css({
                top: offsettop + (current.length ? current.outerHeight() : 0),
                left: current.length ? current.position().left : 0,
                width: current.length ? current.outerWidth() : 0,
                display: "block",
            });

            item.mouseover(function () {
                var self = $(this),
                    offsetactop = self.position().top,
                    offsetleft = self.position().left,
                    width = self.outerWidth() || current.outerWidth(),
                    top = offsetactop == 0 ? 0 : offsetactop || offsettop,
                    left =
                        offsetleft == 0
                            ? 0
                            : offsetleft || current.position().left;

                marker.stop().animate(
                    {
                        top: top + (current.length ? current.outerHeight() : 0),
                        left: left,
                        width: width,
                    },
                    300,
                );
            });

            item.on("click", function () {
                current = $(this);
            });

            item.mouseleave(function () {
                var offsetlvtop = current.length ? current.position().top : 0;
                marker.stop().animate(
                    {
                        top:
                            offsetlvtop +
                            (current.length ? current.outerHeight() : 0),
                        left: current.length ? current.position().left : 0,
                        width: current.length ? current.outerWidth() : 0,
                    },
                    300,
                );
            });
        });

        /* Related Post/Event - Swiper Slider */
        $(".pxl-related-post, .pxl-related-event").each(function () {
            var $this = $(this);
            var $container = $this.find(".pxl-swiper-container");
            if ($container.length > 0 && typeof Swiper !== "undefined") {
                var settings = $container.data("settings");
                new Swiper($container[0], {
                    slidesPerView: settings["slides_to_show"] || 3,
                    slidesPerGroup: settings["slides_to_scroll"] || 1,
                    spaceBetween: settings["slides_gutter"] || 20,
                    loop: true,
                    navigation: {
                        nextEl: $this.find(".pxl-swiper-arrow-next")[0],
                        prevEl: $this.find(".pxl-swiper-arrow-prev")[0],
                    },
                    breakpoints: {
                        0: {
                            slidesPerView: settings["slides_to_show_xs"] || 1,
                        },
                        768: {
                            slidesPerView: settings["slides_to_show_sm"] || 2,
                        },
                        992: {
                            slidesPerView: settings["slides_to_show_md"] || 2,
                        },
                        1200: {
                            slidesPerView: settings["slides_to_show_lg"] || 3,
                        },
                    },
                });
            }
        });

        /* Grid Masonry Animation Delay */
        $(".pxl-grid-masonry").each(function () {
            var eltime = 80;
            var elt_inner = $(this).children().length;
            var _elt = elt_inner - 1;
            $(this)
                .find("> .pxl-grid-item > .wow")
                .each(function (index) {
                    $(this).css("animation-delay", eltime + "ms");
                    if (_elt === index) {
                        eltime = 80;
                        _elt = _elt + elt_inner;
                    } else {
                        eltime += 80;
                    }
                });
        });

        /* Button Text Animation Delays */
        $(".btn-text-nina").each(function () {
            var eltime = 0.045;
            $(this)
                .find("> .pxl--btn-text > span")
                .each(function () {
                    $(this).css("transition-delay", eltime + "s");
                    eltime += 0.045;
                });
        });

        $(".btn-text-nanuk").each(function () {
            var eltime = 0.05;
            $(this)
                .find("> .pxl--btn-text > span")
                .each(function () {
                    $(this).css("animation-delay", eltime + "s");
                    eltime += 0.05;
                });
        });

        $(".btn-text-smoke").each(function () {
            var eltime = 0.05;
            $(this)
                .find("> .pxl--btn-text > span > span > span")
                .each(function () {
                    $(this).css("--d", eltime + "s");
                    eltime += 0.05;
                });
        });

        $(
            ".btn-text-reverse .pxl-text--front, .btn-text-reverse .pxl-text--back",
        ).each(function () {
            var eltime = 0.05;
            $(this)
                .find(".pxl-text--inner > span")
                .each(function () {
                    $(this).css("transition-delay", eltime + "s");
                    eltime += 0.05;
                });
        });

        $(".label-text-fillter").on("click", function () {
            $(this).parents(".pxl-grid-filter").addClass("active");
        });
        $(".filter-item").on("click", function () {
            $(".pxl-grid-filter").removeClass("active");
        });

        /* Lightbox Popup — chỉ init nếu magnific-popup script đã được load sẵn.
         * Nếu chưa, pxl-lazy-loader.js sẽ load và init khi user scroll đến element. */
        if (typeof $.fn.magnificPopup === "function") {
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
        }

        /* Cart Sidebar Popup */
        $(".pxl-cart-sidebar-button").on("click", function () {
            $("body").addClass("body-overflow");
            $("#pxl-cart-sidebar").addClass("active");
        });
        $(
            "#pxl-cart-sidebar .pxl-popup--overlay, #pxl-cart-sidebar .pxl-item--close",
        ).on("click", function () {
            $("body").removeClass("body-overflow");
            $("#pxl-cart-sidebar").removeClass("active");
        });

        /* Hover Active Item */
        $(".pxl--widget-hover").each(function () {
            $(this).hover(function () {
                var $el = $(this);
                $el.parents(".elementor-row")
                    .find(".pxl--widget-hover")
                    .removeClass("pxl--item-active");
                $el.parents(".elementor-container")
                    .find(".pxl--widget-hover")
                    .removeClass("pxl--item-active");
                $el.addClass("pxl--item-active");
            });
        });

        /* Wobble Text Effect */
        var wobbleElements = document.querySelectorAll(".pxl-wobble");
        wobbleElements.forEach(function (el) {
            el.addEventListener("mouseover", function () {
                if (
                    !el.classList.contains("animating") &&
                    !el.classList.contains("mouseover")
                ) {
                    el.classList.add("animating", "mouseover");
                    var letters = el.innerText.split("");
                    setTimeout(
                        function () {
                            el.classList.remove("animating");
                        },
                        (letters.length + 1) * 50,
                    );

                    var animationName = el.dataset.animation || "pxl-jump";
                    el.innerText = "";
                    letters.forEach(function (letter) {
                        if (letter === " ") letter = "&nbsp;";
                        el.innerHTML +=
                            '<span class="letter">' + letter + "</span>";
                    });
                    el.querySelectorAll(".letter").forEach(
                        function (letter, i) {
                            setTimeout(function () {
                                letter.classList.add(animationName);
                            }, 50 * i);
                        },
                    );
                }
            });
            el.addEventListener("mouseout", function () {
                el.classList.remove("mouseover");
            });
        });

        /* Bounce / Effect Elements - IntersectionObserver */
        var boxEls = $(".el-bounce, .pxl-image-effect1, .el-effect-zigzag");
        if (boxEls.length > 0) {
            if ("IntersectionObserver" in window) {
                var bounceObserver = new IntersectionObserver(
                    function (entries) {
                        entries.forEach(function (entry) {
                            entry.target.classList.toggle(
                                "pxl-in-view",
                                entry.isIntersecting,
                            );
                        });
                    },
                    { threshold: 0.1 },
                );
                boxEls.each(function () {
                    bounceObserver.observe(this);
                });
            } else {
                boxEls.addClass("pxl-in-view");
            }
        }

        /* Select Theme Style */
        $(".widget.widget_search input").attr("required", true);
        $(".wpcf7-select").each(function () {
            var $this = $(this),
                numberOfOptions = $this.children("option").length;

            $this.addClass("pxl-select-hidden");
            $this.wrap('<div class="pxl-select"></div>');
            $this.after('<div class="pxl-select-higthlight"></div>');

            var $styledSelect = $this.next("div.pxl-select-higthlight");
            $styledSelect.text($this.children("option").eq(0).text());

            var $list = $("<ul />", {
                class: "pxl-select-options",
            }).insertAfter($styledSelect);

            for (var i = 0; i < numberOfOptions; i++) {
                $("<li />", {
                    text: $this.children("option").eq(i).text(),
                    rel: $this.children("option").eq(i).val(),
                }).appendTo($list);
            }

            var $listItems = $list.children("li");

            $styledSelect.click(function (e) {
                e.stopPropagation();
                $("div.pxl-select-higthlight.active")
                    .not(this)
                    .each(function () {
                        $(this)
                            .removeClass("active")
                            .next("ul.pxl-select-options")
                            .addClass("pxl-select-lists-hide");
                    });
                $(this).toggleClass("active");
            });

            $listItems.click(function (e) {
                e.stopPropagation();
                $styledSelect.text($(this).text()).removeClass("active");
                $this.val($(this).attr("rel"));
            });

            $(document).click(function () {
                $styledSelect.removeClass("active");
            });
        });

        /* Nice Select */
        $(
            ".woocommerce-ordering .orderby, #filter-label, .pxl-filter-dropdown, #pxl-sidebar-area select, .variations_form.cart .variations select, .pxl-open-table select, .pxl-nice-select, .pxl-post-list .nice-select",
        ).each(function () {
            $(this).niceSelect();
        });

        /* Typewriter */
        if ($(".pxl-title--typewriter").length) {
            function typewriterOut(elements, callback) {
                if (elements.length) {
                    elements
                        .eq(0)
                        .addClass("is-active")
                        .delay(3000)
                        .removeClass("is-active");
                    typewriterOut(elements.slice(1), callback);
                } else {
                    callback();
                }
            }

            function typewriterIn(elements, callback) {
                if (elements.length) {
                    elements
                        .eq(0)
                        .addClass("is-active")
                        .delay(3000)
                        .slideDown(3000, function () {
                            elements.eq(0).removeClass("is-active");
                            typewriterIn(elements.slice(1), callback);
                        });
                } else {
                    callback();
                }
            }

            function typewriterInfinite() {
                typewriterOut(
                    $(".pxl-title--typewriter .pxl-item--text"),
                    function () {
                        typewriterIn(
                            $(".pxl-title--typewriter .pxl-item--text"),
                            function () {
                                typewriterInfinite();
                            },
                        );
                    },
                );
            }
            typewriterInfinite();
        }
        /* End Typewriter */

        /* Mailchimp Checkbox */
        $(".mc4wp-form input:checkbox").change(function () {
            $(".mc4wp-form").toggleClass(
                "pxl-input-checked",
                $(this).is(":checked"),
            );
        });

        /* Shop Filter Sidebar */
        $(".pxl-filter-toggle").on("click", function () {
            $("body").addClass("body-overflow");
            $(".pxl-filter-sidebar").addClass("active");
        });
        $(
            ".pxl-filter-sidebar .pxl-sidebar-overlay, .pxl-filter-sidebar .pxl-close-sidebar",
        ).on("click", function () {
            $("body").removeClass("body-overflow");
            $(".pxl-filter-sidebar").removeClass("active");
        });
    });

    /* Header Sticky */
    function frameflow_header_sticky() {
        if ($("#pxl-header-elementor").hasClass("is-sticky")) {
            if (pxl_scroll_top > 100) {
                $(".pxl-header-elementor-sticky.pxl-sticky-stb").addClass(
                    "pxl-header-fixed",
                );
                $("#pxl-header-mobile").addClass("pxl-header-mobile-fixed");
            } else {
                $(".pxl-header-elementor-sticky.pxl-sticky-stb").removeClass(
                    "pxl-header-fixed",
                );
                $("#pxl-header-mobile").removeClass("pxl-header-mobile-fixed");
            }

            if (pxl_scroll_status === "up" && pxl_scroll_top > 100) {
                $(".pxl-header-elementor-sticky.pxl-sticky-stt").addClass(
                    "pxl-header-fixed",
                );
            } else {
                $(".pxl-header-elementor-sticky.pxl-sticky-stt").removeClass(
                    "pxl-header-fixed",
                );
            }
        }

        $(".pxl-header-elementor-sticky")
            .parents("body")
            .addClass("pxl-header-sticky");
    }

    /* Header Mobile */
    function frameflow_header_mobile() {
        if (pxl_window_width < 1199) {
            var h_header_mobile = $("#pxl-header-elementor").outerHeight();
            $("#pxl-header-elementor").css(
                "min-height",
                h_header_mobile + "px",
            );
        }
    }

    /* Scroll To Top */
    function frameflow_scroll_to_top() {
        if (pxl_scroll_top < pxl_window_height) {
            $(".pxl-scroll-top").addClass("pxl-off").removeClass("pxl-on");
        } else if (pxl_scroll_top > pxl_window_height) {
            $(".pxl-scroll-top").addClass("pxl-on").removeClass("pxl-off");
        }
    }

    /* Footer Fixed */
    function frameflow_footer_fixed() {
        setTimeout(function () {
            var defMain = ".pxl-footer-fixed #pxl-main";
            var footerSel =
                typeof main_data !== "undefined" &&
                main_data.footer_fixed_selector_footer
                    ? String(main_data.footer_fixed_selector_footer).trim()
                    : "";
            var mainSel =
                typeof main_data !== "undefined" &&
                main_data.footer_fixed_selector_main
                    ? String(main_data.footer_fixed_selector_main).trim()
                    : "";
            var $main = $(mainSel || defMain);
            if (!$main.length) return;

            var vw = $(window).width();
            if (vw <= 1200) {
                $main.css("margin-bottom", "");
                return;
            }

            var $footer;
            if (footerSel) {
                $footer = $(footerSel);
            } else {
                var $strip = $(".pxl-footer-fixed #pxl-footer-fixed-main");
                $footer = $strip.length
                    ? $strip
                    : $(".pxl-footer-fixed #pxl-footer-elementor");
            }
            if (!$footer.length) return;

            var h_footer = $footer.outerHeight() - 1;
            $main.css("margin-bottom", h_footer + "px");
        }, 600);
    }

    function dropdown_offices() {
        const filterDropdown = $("#filter-label");
        const items = document.querySelectorAll(".pxl-offices-list .pxl--item");

        if (!filterDropdown.length || items.length === 0) return;

        filterDropdown.on("change", function () {
            const selectedLabel = this.value.toLowerCase();
            items.forEach((item) => {
                const itemLabel = item.dataset.label?.toLowerCase() || "";
                item.classList.toggle(
                    "hidden",
                    selectedLabel !== "" && itemLabel !== selectedLabel,
                );
            });
        });
    }

    /* Button Parallax */
    function frameflow_button_parallax() {
        const $buttons = $(".btn.btn-circle, .pxl-anchor-button.style-2");
        if ($buttons.length === 0) return;

        $buttons.each(function () {
            const $btn = $(this);
            const $text = $btn.find("svg");
            let rect = null;
            let isAnimating = false;

            $btn.on("mouseenter", function () {
                rect = this.getBoundingClientRect();
                if ($text.length > 0)
                    gsap.set($text, { transformOrigin: "50% 50%" });
            });

            $btn.on("mousemove", function (e) {
                if (isAnimating || !rect) return;
                isAnimating = true;
                requestAnimationFrame(() => {
                    const centerX = rect.left + rect.width / 2;
                    const centerY = rect.top + rect.height / 2;
                    const targets =
                        $text.length > 0 ? [$btn[0], $text[0]] : [$btn[0]];
                    gsap.to(targets, {
                        duration: 0.2,
                        x: (e.clientX - centerX) * 0.5,
                        y: (e.clientY - centerY) * 0.5,
                        ease: "power2.out",
                        overwrite: "auto",
                    });
                    isAnimating = false;
                });
            });

            $btn.on("mouseleave", function () {
                rect = null;
                const targets =
                    $text.length > 0 ? [$btn[0], $text[0]] : [$btn[0]];
                gsap.to(targets, {
                    duration: 0.4,
                    x: 0,
                    y: 0,
                    ease: "elastic.out(1, 0.3)",
                    overwrite: "auto",
                });
            });
        });
    }

    /* WooCommerce Quantity */
    $(document).on("click.pxl_qty", ".quantity-up", function () {
        var $qty = $(this).parents(".quantity");
        $qty.find('input[type="number"]').get(0).stepUp();
        $(this)
            .parents(".woocommerce-cart-form")
            .find(".actions .button")
            .removeAttr("disabled");
        $qty.find('input[type="number"]').trigger("change");
    });

    $(document).on("click.pxl_qty", ".quantity-down", function () {
        var $qty = $(this).parents(".quantity");
        $qty.find('input[type="number"]').get(0).stepDown();
        $(this)
            .parents(".woocommerce-cart-form")
            .find(".actions .button")
            .removeAttr("disabled");
        $qty.find('input[type="number"]').trigger("change");
    });

    $(document).on("click.pxl_qty", ".quantity-icon", function () {
        var quantity_number = $(this)
            .parents(".quantity")
            .find('input[type="number"]')
            .val();
        var add_to_cart_button = $(this)
            .parents(".product, .woocommerce-product-inner")
            .find(".add_to_cart_button");
        if (add_to_cart_button.length > 0) {
            add_to_cart_button
                .attr("data-quantity", quantity_number)
                .attr(
                    "href",
                    "?add-to-cart=" +
                        add_to_cart_button.attr("data-product_id") +
                        "&quantity=" +
                        quantity_number,
                );
        }
    });

    function frameflow_shop_quantity() {
        "use strict";
        $("#pxl-wapper .quantity").each(function () {
            var $qty = $(this);
            if ($qty.find(".quantity-icon").length === 0) {
                $qty.append(
                    '<span class="quantity-icon quantity-down pxl-icon--minus"></span><span class="quantity-icon quantity-up pxl-icon--plus"></span>',
                );
            }
        });
        $(".woocommerce-cart-form .actions .button").removeAttr("disabled");
    }

    /* Menu Responsive Dropdown */
    function frameflow_submenu_responsive() {
        var $frameflow_menu = $(
            ".pxl-header-elementor-main, .pxl-header-elementor-sticky",
        );
        var winWidth = $(window).width();
        $frameflow_menu.find(".pxl-menu-primary li").each(function () {
            var $frameflow_submenu = $(this).find("> ul.sub-menu");
            if ($frameflow_submenu.length === 1) {
                if (
                    $frameflow_submenu.offset().left +
                        $frameflow_submenu.width() >
                    winWidth
                ) {
                    $frameflow_submenu.addClass("pxl-sub-reverse");
                }
            }
        });
    }

    function frameflow_panel_anchor_toggle() {
        "use strict";
        function frameflow_update_body_overflow() {
            var hasActivePopup = $(
                ".pxl-page-popup.active, .pxl-hidden-panel-popup.active, .pxl-popup-wrap.active",
            ).length;
            $("body").toggleClass("body-overflow", !!hasActivePopup);
        }

        $(document).on("click", ".pxl-anchor-button", function (e) {
            e.preventDefault();
            e.stopPropagation();
            var target = $(this).attr("data-target");
            var $target = $(target);
            $target.toggleClass("active");
            frameflow_update_body_overflow();

            if ($target.hasClass("active")) {
                $target
                    .find(".pxl-popup--conent .wow")
                    .addClass("animated")
                    .removeClass("aniOut");
                $target.find(".pxl-popup--conent .fadeInPopup").removeClass("aniOut");
                if ($target.find(".pxl-search-form").length > 0) {
                    setTimeout(function () {
                        $target
                            .find(".pxl-search-form .pxl-search-field")
                            .focus();
                    }, 1000);
                }
            } else {
                $target
                    .find(".pxl-popup--conent .wow")
                    .addClass("aniOut")
                    .removeClass("animated");
                $target.find(".pxl-popup--conent .fadeInPopup").addClass("aniOut");
            }
        });

        $(".pxl-post-taxonomy .pxl-count").each(function () {
            var content = $(this).html();
            if (content) {
                $(this).html(content.replace("(", "").replace(")", ""));
            }
        });

        $(".pxl-anchor-button").each(function () {
            var t_target = $(this).attr("data-target");
            var t_delay = $(this).attr("data-delay-hover");
            $(t_target)
                .find(".pxl-popup--conent")
                .css("transition-delay", t_delay + "ms");
            $(t_target)
                .find(".pxl-popup--overlay")
                .css("transition-delay", t_delay + "ms");
        });

        $(
            ".pxl-hidden-panel-popup .pxl-popup--overlay, .pxl-hidden-panel-popup .pxl-close-popup",
        ).on("click", function () {
            $(".pxl-hidden-panel-popup").removeClass("active");
            $(".pxl-popup--conent .wow")
                .addClass("aniOut")
                .removeClass("animated");
            $(".pxl-popup--conent .fadeInPopup").addClass("aniOut");
            frameflow_update_body_overflow();
        });

        $(".pxl-icon-box6 .btn-show-more").on("click", function () {
            $(this)
                .parents(".pxl-icon-box6")
                .addClass("active")
                .find(".content-2")
                .addClass("active");
        });

        $(".pxl-popup--close").on("click", function () {
            $(this).parent().removeClass("active");
            frameflow_update_body_overflow();
        });

        $(".pxl-close-popup").on("click", function () {
            $(".pxl-page-popup").removeClass("active");
            frameflow_update_body_overflow();
        });
    }

    /* Page Title Scroll Opacity */
    function frameflow_ptitle_scroll_opacity() {
        var $section = $("#pxl-page-title-elementor.pxl-scroll-opacity");
        if (!$section.length) return;
        var limit = $section.outerHeight();
        if (pxl_scroll_top <= limit) {
            $section
                .find(".elementor-widget")
                .css({ opacity: 1 - pxl_scroll_top / limit });
        }
    }

    /* Slider Column Offset */
    function frameflow_slider_column_offset() {
        if (pxl_window_width > 1200) {
            var content_w = ($("#pxl-main").width() - 1200) / 2;
            $(".pxl-slider2 .pxl-item--left").css(
                "padding-left",
                content_w + "px",
            );
        }
    }

    function frameflow_circle_svg(
        element,
        linearGradientId,
        linearGradientId1,
    ) {
        if ((window.innerWidth || document.documentElement.clientWidth) <= 1200)
            return;

        var svgEl = Snap(element);
        if (!svgEl) return;

        var size = 3.5;
        var filter = svgEl
            .filter(Snap.filter.shadow(0, 4, 30, "rgba(0, 255, 255, 0.6)"))
            .addClass("filter1");
        var filter1 = svgEl
            .filter(Snap.filter.shadow(0, 4, 30, "rgba(0, 255, 255, 0.1)"))
            .addClass("filter2");

        var circle1 = svgEl.circle(0, 0, size);
        circle1.attr({
            id: "circle1",
            class: "dot",
            fill: "url(#" + linearGradientId + ")",
            filter: filter,
        });

        var circle2 = svgEl.circle(0, 0, size);
        circle2.attr({
            id: "circle2",
            class: "dot",
            fill: "url(#" + linearGradientId1 + ")",
            filter: filter1,
        });

        var dotEl1 = svgEl.select("#circle1");
        var dotEl2 = svgEl.select("#circle2");
        var path = svgEl.select("path");
        var motionPathLength = path.getTotalLength();

        dotEl1.transform("t0,0");
        dotEl2.transform("t0,0");

        var carouselInnerEl = $(".pxl-carousel-inner,.pxl-swiper-arrow");
        var animation1, animation2;
        var isHovered = false;

        function animateDot1(forward) {
            animation1 = Snap.animate(
                forward ? 0 : motionPathLength,
                forward ? motionPathLength : 0,
                function (val) {
                    var point = svgEl.select("path").getPointAtLength(val);
                    dotEl1.attr({ cx: point.x, cy: point.y });
                },
                15000,
                function () {
                    if (!isHovered) {
                        dotEl1.transform("t0,0");
                        animateDot1(true);
                    }
                },
            );
        }

        function animateDot2(forward) {
            animation2 = Snap.animate(
                forward ? motionPathLength : 0,
                forward ? 0 : motionPathLength,
                function (val) {
                    var point = svgEl
                        .select("path")
                        .getPointAtLength(motionPathLength - val);
                    dotEl2.attr({ cx: point.x, cy: point.y });
                },
                15000,
                function () {
                    if (!isHovered) {
                        dotEl2.transform("t0,0");
                        animateDot2(false);
                    }
                },
            );
        }

        carouselInnerEl.on("mouseenter", function () {
            isHovered = true;
            if (animation1) animation1.pause();
            if (animation2) animation2.pause();
        });

        carouselInnerEl.on("mouseleave", function () {
            isHovered = false;
            if (animation1) animation1.stop();
            if (animation2) animation2.stop();
            dotEl1.transform("t0,0");
            dotEl2.transform("t0,0");
            animateDot1(true);
            animateDot2(false);
        });

        animateDot1(true);
        animateDot2(false);
    }

    /* Preloader / Image Loaded */
    $.fn.extend({
        jQueryImagesLoaded: function () {
            var $imgs = this.find('img[src!=""]');
            if (!$imgs.length) return $.Deferred().resolve().promise();

            var dfds = [];
            $imgs.each(function () {
                var dfd = $.Deferred();
                dfds.push(dfd);
                var img = new Image();
                img.onload = img.onerror = function () {
                    dfd.resolve();
                };
                img.src = this.src;
            });
            return $.when.apply($, dfds);
        },
    });

    function frameflow_el_parallax() {
        $(".el-parallax-wrap").on({
            mouseenter: function () {
                $(this)
                    .addClass("hovered")
                    .find(".el-parallax-item")
                    .css({ transition: "none" });
            },
            mouseleave: function () {
                $(this).removeClass("hovered").find(".el-parallax-item").css({
                    transition: "transform 0.5s ease",
                    transform: "translate3d(0px, 0px, 0px)",
                });
            },
            mousemove: function (e) {
                const $this = $(this);
                const bounds = this.getBoundingClientRect();
                const deltaX =
                    (bounds.left + bounds.width / 2 - e.clientX) * 0.07104;
                const deltaY =
                    (bounds.top + bounds.height / 2 - e.clientY) * 0.10656;
                requestAnimationFrame(() => {
                    $this.find(".el-parallax-item").css({
                        transform: `translate3d(${deltaX}px, ${deltaY}px, 0px)`,
                    });
                });
            },
        });
    }

    /* Team Grid URL State */
    function initTeamGridUrlState() {
        var $grids = $(".pxl-team-grid1");
        if (!$grids.length) return;

        function getCurrentUrl() {
            try {
                return new URL(window.location.href);
            } catch (e) {
                return null;
            }
        }

        var currentUrl = getCurrentUrl();
        var urlDep = currentUrl
            ? currentUrl.searchParams.get("team_dep")
            : null;
        var urlSearch = currentUrl
            ? currentUrl.searchParams.get("team_search")
            : null;

        $grids.each(function () {
            var $grid = $(this);
            var $select = $grid.find(".pxl-filter-dropdown");
            var $search = $grid.find(".grid-search-input");

            if ($select.length && urlDep) {
                var selectVal = urlDep === "all" ? "*" : "." + urlDep;
                if ($select.val() !== selectVal) {
                    $select.val(selectVal).trigger("change");
                    if (typeof $select.niceSelect === "function")
                        $select.niceSelect("update");
                }
            }

            if ($search.length && urlSearch) {
                var applySearchFromUrl = function () {
                    $search.val(urlSearch);
                    var inputEl = $search.get(0);
                    if (inputEl && typeof Event === "function") {
                        try {
                            inputEl.dispatchEvent(
                                new Event("input", { bubbles: true }),
                            );
                        } catch (e) {
                            var legacyEvt = document.createEvent("Event");
                            legacyEvt.initEvent("input", true, true);
                            inputEl.dispatchEvent(legacyEvt);
                        }
                    }
                    $search.trigger("input").trigger("keyup");
                };
                if (urlDep && $select.length) {
                    setTimeout(applySearchFromUrl, 800);
                } else {
                    applySearchFromUrl();
                }
            }

            if ($select.length) {
                $select
                    .off(".pxlTeamUrlState")
                    .on("change.pxlTeamUrlState", function () {
                        var val = $(this).val() || "";
                        var slug =
                            val === "" || val === "*"
                                ? "all"
                                : String(val).replace(/^\./, "");
                        var u = getCurrentUrl();
                        if (!u) return;
                        if (slug === "all") {
                            u.searchParams.delete("team_dep");
                        } else {
                            u.searchParams.set("team_dep", slug);
                        }
                        window.history.replaceState({}, "", u.toString());
                    });
            }

            if ($search.length) {
                var debounceTimer = null;
                $search
                    .off(".pxlTeamUrlState")
                    .on("input.pxlTeamUrlState", function () {
                        var value = $(this).val().trim();
                        if (debounceTimer) clearTimeout(debounceTimer);
                        debounceTimer = setTimeout(function () {
                            var u = getCurrentUrl();
                            if (!u) return;
                            if (value === "") {
                                u.searchParams.delete("team_search");
                            } else {
                                u.searchParams.set("team_search", value);
                            }
                            window.history.replaceState({}, "", u.toString());
                        }, 300);
                    });
            }
        });
    }

    /* Back To Top Progress Bar */
    var progressPath, pathLength, $scrollTopBtn;
    var pxl_doc_height;

    function frameflow_backtotop_progess_bar() {
        $scrollTopBtn = $(".pxl-scroll-top");
        if ($scrollTopBtn.length > 0) {
            progressPath = document.querySelector(".pxl-scroll-top path");
            pathLength = progressPath.getTotalLength();
            progressPath.style.transition =
                progressPath.style.WebkitTransition = "none";
            progressPath.style.strokeDasharray = pathLength + " " + pathLength;
            progressPath.style.strokeDashoffset = pathLength;
            progressPath.getBoundingClientRect();
            progressPath.style.transition =
                progressPath.style.WebkitTransition =
                    "stroke-dashoffset 10ms linear";

            pxl_doc_height = $(document).height();
            frameflow_backtotop_update();

            $(window).on("resize.backtotop", function () {
                pxl_doc_height = $(document).height();
            });
        }
    }

    function frameflow_backtotop_update() {
        if (!progressPath || !$scrollTopBtn) return;

        var height = document.documentElement.scrollHeight - pxl_window_height;
        if (height > 0) {
            progressPath.style.strokeDashoffset =
                pathLength - (pxl_scroll_top * pathLength) / height;
        }

        $scrollTopBtn.toggleClass("active-progress", pxl_scroll_top > 50);
    }

    /* Custom Type File Upload */
    function frameflow_type_file_upload() {
        var multipleSupport = typeof $("<input/>")[0].multiple !== "undefined",
            isIE = /msie/i.test(navigator.userAgent);

        $.fn.pxl_custom_type_file = function () {
            return this.each(function () {
                var $file = $(this).addClass("pxl-file-upload-hidden"),
                    $wrap = $('<div class="pxl-file-upload-wrapper">'),
                    $button = $(
                        '<button type="button" class="pxl-file-upload-button">Choose File</button>',
                    ),
                    $input = $(
                        '<input type="text" class="pxl-file-upload-input" placeholder="No File Choose" />',
                    ),
                    $label = $(
                        '<label class="pxl-file-upload-button" for="' +
                            $file[0].id +
                            '">Choose File</label>',
                    );

                $file.css({
                    position: "absolute",
                    opacity: "0",
                    visibility: "hidden",
                });
                $wrap
                    .insertAfter($file)
                    .append($file, $input, isIE ? $label : $button);
                $file.attr("tabIndex", -1);
                $button.attr("tabIndex", -1);

                $button.click(function () {
                    $file.focus().click();
                });

                $file.change(function () {
                    var filename;
                    if (multipleSupport) {
                        var files = Array.from($file[0].files).map(
                            function (f) {
                                return f.name;
                            },
                        );
                        filename = files.join(", ");
                    } else {
                        filename = $file.val().split("\\").pop();
                    }
                    $input.val(filename).attr("title", filename).focus();
                });

                $input.on({
                    blur: function () {
                        $file.trigger("blur");
                    },
                    keydown: function (e) {
                        if (e.which === 13) {
                            if (!isIE) $file.trigger("click");
                        } else if (e.which === 8 || e.which === 46) {
                            $file.replaceWith(($file = $file.clone(true)));
                            $file.trigger("change");
                            $input.val("");
                        } else if (e.which !== 9) {
                            return false;
                        }
                    },
                });
            });
        };
        $(".wpcf7-file[type=file]").pxl_custom_type_file();
    }

    /* Zoom Point */
    var zoomPointImages = [];

    function frameflow_zoom_point() {
        zoomPointImages = [];
        var $zoomElements = $(".pxl-zoom-point");
        if ($zoomElements.length === 0) return;

        $zoomElements.each(function () {
            var container = this;
            var scaleOffset = $(container).data("offset") || 0;
            var scaleAmount = ($(container).data("scale-mount") || 0) / 100;
            var images = container.querySelectorAll("[data-scroll-zoom]");
            if (!images.length) return;

            var observer = new IntersectionObserver(
                function (entries) {
                    entries.forEach(function (entry) {
                        var idx = entry.target._pxlZoomIdx;
                        if (zoomPointImages[idx]) {
                            zoomPointImages[idx].isVisible =
                                entry.isIntersecting;
                        }
                    });
                },
                { threshold: 0 },
            );

            images.forEach(function (image) {
                var parent = image.parentNode;
                var rect = parent.getBoundingClientRect();
                var scrollY =
                    window.pageYOffset || document.documentElement.scrollTop;
                var idx = zoomPointImages.length;
                image._pxlZoomIdx = idx;
                zoomPointImages.push({
                    element: image,
                    offset: scaleOffset,
                    scaleAmount: scaleAmount,
                    isVisible: false,
                    cachedTop: rect.top + scrollY,
                    cachedHeight: parent.offsetHeight,
                });
                observer.observe(image);
                updateZoomImage(zoomPointImages[idx]);
            });
        });
    }

    function frameflow_zoom_point_update() {
        for (var i = 0; i < zoomPointImages.length; i++) {
            if (zoomPointImages[i].isVisible)
                updateZoomImage(zoomPointImages[i]);
        }
    }

    function updateZoomImage(item) {
        var elPosY = item.cachedTop + item.offset;
        var elHeight = item.cachedHeight;

        if (
            elPosY > pxl_scroll_top + pxl_window_height ||
            elPosY + elHeight < pxl_scroll_top
        )
            return;

        var distance = pxl_scroll_top + pxl_window_height - elPosY;
        var percentage = Math.min(
            Math.max(distance / (pxl_window_height + elHeight), 0),
            1,
        );
        item.element.style.transform =
            "scale(" + (1 + item.scaleAmount * percentage * 100) + ")";
    }
})(jQuery);
