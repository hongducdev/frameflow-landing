;(function ($) {
    "use strict"

    /**
     * Case Image Stack — card shuffle
     * Front card slides out, rest of the stack steps forward, exited card eases in at the back.
     */
    function applyPointerEvents(cards, order) {
        order.forEach(function (cardIdx, pos) {
            cards[cardIdx].style.pointerEvents = pos === 0 ? "auto" : "none"
        })
    }

    function initStack($el) {
        var cards = gsap.utils.toArray($el.find(".pxl-image-stack__card"))
        if (!cards.length) {
            return
        }

        var prev = $el.data("stackCtl")
        if (prev && typeof prev.destroy === "function") {
            prev.destroy()
        }

        var speed = parseFloat($el.data("speed")) || 70
        var direction = ($el.data("direction") || "down").toString().toLowerCase()
        var visible = parseInt($el.data("visible"), 10) || 3
        var pauseHover = $el.data("pause") !== false
        var total = cards.length
        visible = Math.max(1, Math.min(visible, total))

        var gap = parseFloat(getComputedStyle($el.get(0)).getPropertyValue("--pxl-stack-gap")) || 30
        var height = cards[0].offsetHeight || 420
        var scaleStep = 0.06
        var exitY = height * 0.44
        var exitDur = 0.45
        var enterDur = 0.5
        var cycle = gsap.utils.clamp(1.8, 4, 168 / Math.max(speed, 1))
        var hold = Math.max(0.7, cycle - exitDur - enterDur + 0.15)

        var order = cards.map(function (_, i) {
            return i
        })
        var currentTl = null
        var wait = null
        var paused = false
        var alive = true

        function posProps(pos) {
            var scale = Math.max(1 - pos * scaleStep, 0.7)
            var y = pos === 0 ? 0 : -(pos * gap + (height / 2) * (1 - scale))

            return {
                y: y,
                scale: scale,
                opacity: pos < visible ? 1 : 0,
                zIndex: 30 - pos * 10,
            }
        }

        function resetStack() {
            order = cards.map(function (_, i) {
                return i
            })
            gsap.killTweensOf(cards)
            order.forEach(function (cardIdx, pos) {
                gsap.set(cards[cardIdx], posProps(pos))
            })
            applyPointerEvents(cards, order)
        }

        gsap.set(cards, {
            x: 0,
            transformOrigin: "50% 50%",
            force3D: true,
        })
        resetStack()

        function scheduleNext() {
            if (wait) {
                wait.kill()
            }
            wait = gsap.delayedCall(hold, shuffle)
        }

        function shuffle() {
            if (!alive || !document.body.contains($el.get(0)) || paused || total < 2) {
                return
            }

            var frontIdx = order[0]
            var frontEl = cards[frontIdx]
            frontEl.style.pointerEvents = "none"

            var tl = gsap.timeline({
                onComplete: function () {
                    currentTl = null
                    applyPointerEvents(cards, order)
                    if (alive) {
                        scheduleNext()
                    }
                },
            })
            currentTl = tl

            tl.to(frontEl, {
                y: direction === "up" ? -exitY : exitY,
                opacity: 0,
                zIndex: 40,
                duration: exitDur,
                ease: "power2.in",
            })

            order.slice(1).forEach(function (cardIdx, i) {
                tl.to(
                    cards[cardIdx],
                    Object.assign({}, posProps(i), {
                        duration: exitDur,
                        ease: "power2.out",
                    }),
                    "<"
                )
            })

            order.push(order.shift())

            var backProps = posProps(order.length - 1)
            tl.set(frontEl, { zIndex: backProps.zIndex }).to(
                frontEl,
                {
                    y: backProps.y,
                    scale: backProps.scale,
                    opacity: backProps.opacity,
                    duration: enterDur,
                    ease: "power2.out",
                },
                "-=0.15"
            )
        }

        if (total > 1) {
            scheduleNext()
        }

        $el.off(".pxlStack")
        if (pauseHover) {
            $el.on("mouseenter.pxlStack", function () {
                paused = true
                if (wait) {
                    wait.pause()
                }
                if (currentTl) {
                    currentTl.pause()
                }
            })
            $el.on("mouseleave.pxlStack", function () {
                paused = false
                if (currentTl) {
                    currentTl.resume()
                } else if (alive && total > 1 && (!wait || !wait.isActive())) {
                    scheduleNext()
                } else if (wait) {
                    wait.resume()
                }
            })
        }

        $el.data("stackCtl", {
            destroy: function () {
                alive = false
                paused = false
                $el.off(".pxlStack")
                if (wait) {
                    wait.kill()
                    wait = null
                }
                if (currentTl) {
                    currentTl.kill()
                    currentTl = null
                }
                gsap.killTweensOf(cards)
                cards.forEach(function (card) {
                    card.style.pointerEvents = ""
                })
                $el.removeData("stackCtl")
            },
            restart: function () {
                resetStack()
                paused = false
                if (total > 1) {
                    scheduleNext()
                }
            },
        })
    }

    function handler($scope) {
        var $root = $scope.find(".pxl-image-stack")
        if (!$root.length || typeof gsap === "undefined") {
            return
        }

        $root.each(function () {
            initStack($(this))
        })
    }

    function reinitAllStacks() {
        $(".pxl-image-stack").each(function () {
            initStack($(this))
        })
    }

    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction("frontend/element_ready/pxl_image_stack.default", handler)
    })

    $(window).on("pageshow.pxlImageStack", function (e) {
        if (!e.originalEvent || !e.originalEvent.persisted) {
            return
        }
        reinitAllStacks()
        if (typeof window.frameflowInitWaterEffect === "function") {
            window.frameflowInitWaterEffect()
        }
    })
})(jQuery)
