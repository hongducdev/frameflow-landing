;(function ($) {
    function getBaseCount($track) {
        var stored = parseInt($track.data("pxlMarqueeBaseCount"), 10)
        if (!isNaN(stored) && stored > 0) {
            return stored
        }

        var n = $track.children().length
        var baseCount = n >= 2 && n % 2 === 0 ? n / 2 : n
        $track.data("pxlMarqueeBaseCount", baseCount)
        return baseCount
    }

    function measureLoopDistance($track, baseCount) {
        var $children = $track.children()
        var first = $children.get(0)
        var loopStart = $children.get(baseCount)

        if (first && loopStart) {
            var byOffset = Math.round(loopStart.offsetLeft - first.offsetLeft)
            if (Math.abs(byOffset) > 1) {
                return Math.abs(byOffset)
            }

            var byRect = Math.round(
                loopStart.getBoundingClientRect().left - first.getBoundingClientRect().left
            )
            if (Math.abs(byRect) > 1) {
                return Math.abs(byRect)
            }
        }

        var distance = 0
        var i
        for (i = 0; i < baseCount && i < $children.length; i++) {
            distance += $children.eq(i).outerWidth(true)
        }

        var trackEl = $track.get(0)
        if (trackEl) {
            var gap = parseFloat(
                window.getComputedStyle(trackEl).columnGap ||
                    window.getComputedStyle(trackEl).gap ||
                    "0"
            )
            if (!isNaN(gap) && gap > 0 && baseCount > 1) {
                distance += gap * (baseCount - 1)
            }
        }

        return Math.round(distance)
    }

    function fillTrack($track, containerEl, onClone) {
        var trackEl = $track.get(0)
        if (!trackEl || !containerEl) {
            return 0
        }

        trackEl.style.display = "flex"
        trackEl.style.flexWrap = "nowrap"
        trackEl.style.width = "max-content"

        var baseCount = getBaseCount($track)
        if (!baseCount) {
            return 0
        }

        var $base = $track.children().slice(0, baseCount)
        if (!$base.length) {
            return 0
        }

        var containerWidth = containerEl.offsetWidth || 0
        var guard = 0
        var lastScrollWidth = -1

        function cloneBase() {
            var $clones = $base.clone(true)
            $clones.attr("aria-hidden", "true")
            if (typeof onClone === "function") {
                $clones.each(function () {
                    onClone($(this))
                })
            }
            $track.append($clones)
        }

        while (trackEl.scrollWidth < containerWidth * 2 && guard < 12) {
            if (trackEl.scrollWidth === lastScrollWidth && lastScrollWidth > 0) {
                break
            }
            lastScrollWidth = trackEl.scrollWidth
            cloneBase()
            guard++
        }

        while ($track.children().length < baseCount * 3 && guard < 12) {
            cloneBase()
            guard++
        }

        return measureLoopDistance($track, baseCount)
    }

    function createTween($track, distance, speed, direction) {
        if (typeof gsap === "undefined" || !distance || distance <= 0) {
            return null
        }

        if (gsap.ticker && typeof gsap.ticker.wake === "function") {
            gsap.ticker.wake()
        }

        var duration = Math.max(distance / speed, 0.1)
        var fromX = direction === "left" ? 0 : -distance
        var toX = direction === "left" ? -distance : 0

        return gsap.fromTo(
            $track,
            { x: fromX },
            {
                x: toX,
                duration: duration,
                ease: "none",
                repeat: -1,
            }
        )
    }

    window.frameflowMarqueeHelpers = {
        fillTrack: fillTrack,
        createTween: createTween,
    }
})(jQuery)
