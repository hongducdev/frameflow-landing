(function ($) {
    function clamp(value, min, max) {
        return Math.min(Math.max(value, min), max);
    }

    function lerp(a, b, t) {
        return a + (b - a) * t;
    }

    function bezierPoint(p0, p1, p2, p3, t) {
        var m = 1 - t;
        return {
            x:
                m * m * m * p0.x +
                3 * m * m * t * p1.x +
                3 * m * t * t * p2.x +
                t * t * t * p3.x,
            y:
                m * m * m * p0.y +
                3 * m * m * t * p1.y +
                3 * m * t * t * p2.y +
                t * t * t * p3.y,
        };
    }

    function samplePath(segments, totalPoints) {
        var raw = [];

        segments.forEach(function (segment) {
            var i;
            if (segment.type === "L") {
                var a = segment.points[0];
                var b = segment.points[1];
                for (i = 0; i <= 50; i++) {
                    raw.push({
                        x: lerp(a.x, b.x, i / 50),
                        y: lerp(a.y, b.y, i / 50),
                    });
                }
            } else {
                var p0 = segment.points[0];
                var p1 = segment.points[1];
                var p2 = segment.points[2];
                var p3 = segment.points[3];
                for (i = 0; i <= 50; i++) {
                    raw.push(bezierPoint(p0, p1, p2, p3, i / 50));
                }
            }
        });

        var dists = [0];
        for (var index = 1; index < raw.length; index++) {
            var dx = raw[index].x - raw[index - 1].x;
            var dy = raw[index].y - raw[index - 1].y;
            dists.push(dists[index - 1] + Math.sqrt(dx * dx + dy * dy));
        }

        var total = dists[dists.length - 1] || 0;
        var pts = [];

        for (var pointIndex = 0; pointIndex < totalPoints; pointIndex++) {
            var target = totalPoints === 1 ? 0 : (pointIndex / (totalPoints - 1)) * total;
            var lo = 0;
            var hi = raw.length - 1;

            while (lo < hi - 1) {
                var mid = (lo + hi) >> 1;
                if (dists[mid] < target) {
                    lo = mid;
                } else {
                    hi = mid;
                }
            }

            var t =
                dists[lo] === dists[hi]
                    ? 0
                    : (target - dists[lo]) / (dists[hi] - dists[lo]);

            pts.push({
                x: lerp(raw[lo].x, raw[hi].x, t),
                y: lerp(raw[lo].y, raw[hi].y, t),
            });
        }

        return { pts: pts, total: total };
    }

    function TextBoxGridCanvas($scope) {
        this.$scope = $scope;
        this.$grid = $scope.find(".pxl-text-box-grid");
        this.canvas = this.$grid.find(".pxl-text-box-grid--canvas").get(0);
        this.ctx = this.canvas ? this.canvas.getContext("2d") : null;
        this.rafId = null;
        this.resizeTimer = null;
        this.startTime = 0;
        this.paths = [];
        this.isDestroyed = false;
        this.config = {
            tail: 72,
            segHeight: 2.5,
            duration: 2200,
            segCount: 20,
            pointCount: 400,
            firstVertical: 28,
            outerCurveDepth: 52,
            outerCurveOffset: 22,
            innerCurveOffset: 26,
            trunkInset: 20,
        };
    }

    TextBoxGridCanvas.prototype.getCssVar = function (name, fallback) {
        var style = window.getComputedStyle(this.$grid.get(0));
        var value = parseFloat(style.getPropertyValue(name));
        return Number.isFinite(value) ? value : fallback;
    };

    TextBoxGridCanvas.prototype.getColor = function (name, fallback) {
        var style = window.getComputedStyle(this.$grid.get(0));
        var value = style.getPropertyValue(name).trim();
        return value || fallback;
    };

    TextBoxGridCanvas.prototype.measure = function () {
        if (!this.canvas || !this.ctx) {
            return false;
        }

        var gridEl = this.$grid.get(0);
        var rect = gridEl.getBoundingClientRect();
        var items = this.$grid.find(".pxl-item").toArray();
        var canvasSpace = this.getCssVar("--pxl-canvas-space", 0);
        var dpr = window.devicePixelRatio || 1;

        if (!rect.width || !rect.height || items.length < 2 || canvasSpace <= 0) {
            this.paths = [];
            return false;
        }

        this.canvas.width = Math.round(rect.width * dpr);
        this.canvas.height = Math.round(rect.height * dpr);
        this.canvas.style.width = rect.width + "px";
        this.canvas.style.height = rect.height + "px";
        this.ctx.setTransform(dpr, 0, 0, dpr, 0, 0);

        var connectorColor = this.getColor("--pxl-connector-color", "#e8e8e8");
        var particleColor = this.getColor("--pxl-particle-color", "#111111");
        var branchStarts = [];

        items.forEach(function (item) {
            var itemRect = item.getBoundingClientRect();
            branchStarts.push({
                x: itemRect.left - rect.left + itemRect.width / 2,
                y: itemRect.bottom - rect.top,
            });
        });

        var trunkX = rect.width / 2;
        var firstVertical = this.getCssVar(
            "--pxl-line-first-vertical",
            this.config.firstVertical,
        );
        var outerCurveDepth = this.getCssVar(
            "--pxl-line-curve-depth",
            this.config.outerCurveDepth,
        );
        var outerCurveOffset = this.getCssVar(
            "--pxl-line-outer-offset",
            this.config.outerCurveOffset,
        );
        var innerCurveOffset = this.getCssVar(
            "--pxl-line-inner-offset",
            this.config.innerCurveOffset,
        );
        var trunkInset = this.getCssVar(
            "--pxl-line-trunk-inset",
            this.config.trunkInset,
        );
        var trunkTop = clamp(
            Math.max.apply(
                null,
                branchStarts.map(function (point) {
                    return point.y + outerCurveDepth;
                }),
            ),
            0,
            rect.height - trunkInset - 40,
        );
        var trunkBottom = rect.height - trunkInset;

        this.paths = branchStarts.map(
            function (start, index) {
                var goRight = start.x < trunkX;
                var verticalStopY = start.y + firstVertical;
                var curveY = start.y + outerCurveDepth;
                var branchX = goRight
                    ? start.x + outerCurveOffset
                    : start.x - outerCurveOffset;
                var horizontalEnd = goRight
                    ? trunkX - innerCurveOffset
                    : trunkX + innerCurveOffset;
                var trunkJoinX = trunkX;
                var trunkJoinY = Math.max(curveY + innerCurveOffset, trunkTop);
                var segments = [
                    {
                        type: "L",
                        points: [{ x: start.x, y: start.y }, { x: start.x, y: verticalStopY }],
                    },
                    {
                        type: "C",
                        points: [
                            { x: start.x, y: verticalStopY },
                            { x: start.x, y: curveY },
                            { x: branchX, y: curveY },
                            { x: branchX, y: curveY },
                        ],
                    },
                    {
                        type: "L",
                        points: [
                            { x: branchX, y: curveY },
                            { x: horizontalEnd, y: curveY },
                        ],
                    },
                    {
                        type: "C",
                        points: [
                            { x: horizontalEnd, y: curveY },
                            {
                                x: horizontalEnd + (goRight ? innerCurveOffset : -innerCurveOffset),
                                y: curveY,
                            },
                            { x: trunkJoinX, y: trunkJoinY },
                            { x: trunkJoinX, y: trunkJoinY },
                        ],
                    },
                    {
                        type: "L",
                        points: [
                            { x: trunkJoinX, y: trunkJoinY },
                            { x: trunkJoinX, y: trunkBottom },
                        ],
                    },
                ];

                return $.extend(
                    {
                        delay: index * 450,
                        connectorColor: connectorColor,
                        particleColor: particleColor,
                        start: start,
                    },
                    samplePath(segments, this.config.pointCount),
                );
            }.bind(this),
        );

        return true;
    };

    TextBoxGridCanvas.prototype.drawBasePaths = function () {
        var ctx = this.ctx;
        ctx.lineWidth = 1.5;

        this.paths.forEach(function (path) {
            ctx.beginPath();
            ctx.strokeStyle = path.connectorColor;
            path.pts.forEach(function (point, index) {
                if (index === 0) {
                    ctx.moveTo(point.x, point.y);
                } else {
                    ctx.lineTo(point.x, point.y);
                }
            });
            ctx.stroke();
        });
    };

    TextBoxGridCanvas.prototype.drawParticles = function (timestamp) {
        var ctx = this.ctx;
        var config = this.config;

        this.paths.forEach(function (path) {
            var t = (((timestamp - path.delay) % config.duration) + config.duration) % config.duration;
            var headDist = (t / config.duration) * (path.total + config.tail);

            for (var segmentIndex = 0; segmentIndex < config.segCount; segmentIndex++) {
                var ratio = segmentIndex / (config.segCount - 1);
                var dist =
                    headDist - (config.segCount - 1 - segmentIndex) * (config.tail / config.segCount);

                if (dist < 0 || dist > path.total) {
                    continue;
                }

                var idx = clamp(
                    Math.floor((dist / path.total) * (config.pointCount - 1)),
                    0,
                    config.pointCount - 2,
                );
                var p0 = path.pts[idx];
                var p1 = path.pts[Math.min(config.pointCount - 1, idx + 1)];
                var angle = Math.atan2(p1.y - p0.y, p1.x - p0.x);

                ctx.save();
                ctx.translate(p0.x, p0.y);
                ctx.rotate(angle);
                ctx.globalAlpha = Math.pow(ratio, 1.2);
                ctx.fillStyle = path.particleColor || "#111111";
                ctx.fillRect(0, -config.segHeight / 2, config.tail / config.segCount + 0.5, config.segHeight);
                ctx.restore();
            }
        });

        ctx.globalAlpha = 1;
    };

    TextBoxGridCanvas.prototype.render = function (timestamp) {
        if (this.isDestroyed || !this.canvas || !this.ctx) {
            return;
        }

        if (!this.paths.length) {
            this.rafId = window.requestAnimationFrame(this.render.bind(this));
            return;
        }

        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
        this.drawBasePaths();
        this.drawParticles(timestamp);
        this.rafId = window.requestAnimationFrame(this.render.bind(this));
    };

    TextBoxGridCanvas.prototype.handleResize = function () {
        window.clearTimeout(this.resizeTimer);
        this.resizeTimer = window.setTimeout(
            function () {
                this.measure();
            }.bind(this),
            120,
        );
    };

    TextBoxGridCanvas.prototype.init = function () {
        if (!this.canvas || !this.ctx || !this.$grid.length) {
            return;
        }

        this.measure();
        this.boundResize = this.handleResize.bind(this);
        window.addEventListener("resize", this.boundResize, { passive: true });
        this.rafId = window.requestAnimationFrame(this.render.bind(this));
    };

    TextBoxGridCanvas.prototype.destroy = function () {
        this.isDestroyed = true;
        if (this.rafId) {
            window.cancelAnimationFrame(this.rafId);
        }
        if (this.boundResize) {
            window.removeEventListener("resize", this.boundResize);
        }
        window.clearTimeout(this.resizeTimer);
    };

    var instances = new WeakMap();

    var pxl_text_box_grid_handler = function ($scope) {
        var root = $scope.get(0);
        if (!root) {
            return;
        }

        if (instances.has(root)) {
            instances.get(root).destroy();
        }

        var instance = new TextBoxGridCanvas($scope);
        instance.init();
        instances.set(root, instance);
    };

    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/pxl_text_box_grid.default",
            pxl_text_box_grid_handler,
        );
    });
})(jQuery);
