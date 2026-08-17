(function ($) {
    var BG_PREFIX = "pxl-throwable-bg--";
    var ALLOWED_BG = { primary: true, secondary: true };

    function parseDataJsonAttr(node, attrName) {
        try {
            var raw = node.getAttribute(attrName);
            return raw ? JSON.parse(raw.replace(/&quot;/g, '"')) : [];
        } catch (e) {
            console.error("Invalid " + attrName + ":", e);
            return [];
        }
    }

    function isString(v) {
        return typeof v === "string" && v.trim().length > 0;
    }

    function looksLikeSvg(v) {
        return isString(v) && v.trim().startsWith("<");
    }

    function looksLikeUrl(v) {
        return (
            isString(v) &&
            (/^(https?:)?\/\//.test(v) ||
                /\.(svg|png|jpe?g|gif|webp)(\?.*)?$/i.test(v))
        );
    }

    function makeSvgNode(svgStr) {
        var span = document.createElement("span");
        span.className = "pxl-icon-svg pxl-icon";
        span.style.display = "inline-flex";
        span.style.alignItems = "center";
        span.innerHTML = svgStr;
        var svg = span.querySelector("svg");
        if (svg) {
            svg.setAttribute("width", "auto");
            svg.setAttribute("height", "clamp(16px, 4vw, 28px)");
            svg.style.width = "auto";
            svg.style.height = "clamp(16px, 4vw, 28px)";
            svg.style.display = "block";
            svg.style.verticalAlign = "middle";
            svg.style.pointerEvents = "none";
        }
        return span;
    }

    function makeImgNode(url) {
        var container = document.createElement("div");
        container.className = "pxl-icon";
        container.style.width = "auto";
        container.style.height = "clamp(16px, 4vw, 28px)";
        container.style.display = "flex";
        container.style.alignItems = "center";
        container.style.justifyContent = "center";
        container.style.overflow = "hidden";

        var img = document.createElement("img");
        img.src = url;
        img.alt = "";
        img.style.width = "auto";
        img.style.height = "clamp(16px, 4vw, 28px)";
        img.style.objectFit = "contain";
        img.style.objectPosition = "center";
        img.style.display = "block";

        container.appendChild(img);
        return container;
    }

    function makeClassIcon(cls) {
        var i = document.createElement("i");
        i.className = cls.trim() + " pxl-icon";
        i.style.fontSize = "auto";
        i.style.lineHeight = "1";
        return i;
    }

    function createIconNode(iconData) {
        var iconNode = null;
        if (iconData && typeof iconData === "object") {
            var rawValue = iconData.value || iconData.class || null;
            var svgStr = iconData.svg || iconData.SVG || null;
            var urlVal = iconData.url || iconData.URL || null;

            if (looksLikeSvg(svgStr)) {
                iconNode = makeSvgNode(svgStr);
            } else if (urlVal && looksLikeUrl(urlVal)) {
                iconNode = makeImgNode(urlVal);
            } else if (isString(rawValue)) {
                if (looksLikeSvg(rawValue)) {
                    iconNode = makeSvgNode(rawValue);
                } else if (looksLikeUrl(rawValue)) {
                    iconNode = makeImgNode(rawValue);
                } else {
                    iconNode = makeClassIcon(rawValue);
                }
            } else if (rawValue && typeof rawValue === "object") {
                var nestedUrl = rawValue.url || rawValue.URL || null;
                var nestedSvg = rawValue.svg || rawValue.SVG || null;
                if (looksLikeSvg(nestedSvg)) {
                    iconNode = makeSvgNode(nestedSvg);
                } else if (nestedUrl && looksLikeUrl(nestedUrl)) {
                    iconNode = makeImgNode(nestedUrl);
                }
            }
        } else if (isString(iconData)) {
            if (looksLikeSvg(iconData)) {
                iconNode = makeSvgNode(iconData);
            } else if (looksLikeUrl(iconData)) {
                iconNode = makeImgNode(iconData);
            } else {
                iconNode = makeClassIcon(iconData);
            }
        }
        return iconNode;
    }

    /**
     * Matter.js playground scoped to `.pxl-physics` (see `pxl_physics/layout-1.php`).
     */
    function initPhysicsArea(logoArea) {
        if (
            typeof Matter === "undefined" ||
            !logoArea ||
            logoArea.nodeType !== 1
        ) {
            return;
        }

        try {
            var Engine = Matter.Engine;
            var Render = Matter.Render;
            var Runner = Matter.Runner;
            var Bodies = Matter.Bodies;
            var Composite = Matter.Composite;
            var MouseConstraint = Matter.MouseConstraint;
            var Events = Matter.Events;
            var Body = Matter.Body;

            try {
                var rect = logoArea.getBoundingClientRect();
                var viewportHeight =
                    window.innerHeight || document.documentElement.clientHeight;
                var isVisible = rect.top < viewportHeight && rect.bottom > 0;
                if (!isVisible) {
                    if (typeof IntersectionObserver !== "undefined") {
                        var observer = new IntersectionObserver(
                            function (entries, obs) {
                                var i;
                                for (i = 0; i < entries.length; i++) {
                                    if (entries[i].isIntersecting) {
                                        obs.unobserve(entries[i].target);
                                        initPhysicsArea(logoArea);
                                        break;
                                    }
                                }
                            },
                            { root: null, threshold: 0.1 },
                        );
                        observer.observe(logoArea);
                    } else {
                        var onScroll = function () {
                            var r = logoArea.getBoundingClientRect();
                            var vh =
                                window.innerHeight ||
                                document.documentElement.clientHeight;
                            if (r.top < vh && r.bottom > 0) {
                                window.removeEventListener("scroll", onScroll, {
                                    passive: true,
                                });
                                initPhysicsArea(logoArea);
                            }
                        };
                        window.addEventListener("scroll", onScroll, {
                            passive: true,
                        });
                    }
                    return;
                }
            } catch (e) {
                /* ignore visibility probe */
            }

            if (typeof logoArea.destroyPhysics === "function") {
                logoArea.destroyPhysics();
            }

            var icons = parseDataJsonAttr(logoArea, "data-icons");
            var bgClasses = parseDataJsonAttr(logoArea, "data-bg-classes");

            var itemCount = icons.length;
            if (bgClasses.length > itemCount) {
                itemCount = bgClasses.length;
            }
            if (itemCount < 1) {
                return;
            }

            var w = logoArea.offsetWidth;
            var h = logoArea.offsetHeight;

            var engine = Engine.create();
            engine.world.gravity.x = 0;
            engine.world.gravity.y = 0.35;

            var MAX_VELOCITY = 8;
            var VELOCITY_DAMPING = 0.98;

            var render = Render.create({
                element: logoArea,
                engine: engine,
                options: {
                    width: w,
                    height: h,
                    background: "rgba(0,0,0,0)",
                    wireframes: false,
                    pixelRatio: window.devicePixelRatio,
                },
            });

            if (render.canvas) {
                render.canvas.style.zIndex = "0";
                render.canvas.style.position = "absolute";
                render.canvas.style.left = "0";
                render.canvas.style.top = "0";
            }

            var wallOptions = { isStatic: true, render: { visible: false } };
            var wallThickness = 10;
            var ceiling = Bodies.rectangle(w / 2, -wallThickness / 2, w, wallThickness, wallOptions);
            var ground = Bodies.rectangle(
                w / 2,
                h + wallThickness / 2,
                w,
                wallThickness,
                wallOptions,
            );
            var leftWall = Bodies.rectangle(-wallThickness / 2, h / 2, wallThickness, h, wallOptions);
            var rightWall = Bodies.rectangle(
                w + wallThickness / 2,
                h / 2,
                wallThickness,
                h,
                wallOptions,
            );

            var shapes = [];
            var placedBodies = [];
            var hitboxSyncQueued = false;
            var queueHitboxSync = function () {
                if (hitboxSyncQueued || typeof window.requestAnimationFrame === "undefined") {
                    return;
                }
                hitboxSyncQueued = true;
                window.requestAnimationFrame(function () {
                    window.requestAnimationFrame(function () {
                        hitboxSyncQueued = false;
                        shapes.forEach(function (pair) {
                            var el = pair.element;
                            var mw = Math.max(40, Math.ceil(el.offsetWidth));
                            var mh = Math.max(24, Math.ceil(el.offsetHeight));
                            var bw = pair._hitW;
                            var bh = pair._hitH;
                            if (
                                !bw ||
                                !bh ||
                                (Math.abs(mw - bw) < 1 && Math.abs(mh - bh) < 1)
                            ) {
                                return;
                            }
                            var sx = mw / bw;
                            var sy = mh / bh;
                            if (sx > 0 && sy > 0 && isFinite(sx) && isFinite(sy)) {
                                Body.scale(pair.body, sx, sy, pair.body.position);
                                pair._hitW = mw;
                                pair._hitH = mh;
                            }
                        });
                    });
                });
            };

            var index;
            for (index = 0; index < itemCount; index++) {
                var textElement = document.createElement("p");
                textElement.className = "pxl-throwable-element";
                Object.assign(textElement.style, {
                    opacity: "1",
                    position: "absolute",
                    display: "inline-flex",
                    alignItems: "center",
                    gap: "8px",
                    textAlign: "center",
                    pointerEvents: "none",
                    whiteSpace: "nowrap",
                    zIndex: "2",
                });

                var slug =
                    bgClasses &&
                    typeof bgClasses[index] !== "undefined" &&
                    bgClasses[index] !== null
                        ? String(bgClasses[index]).trim()
                        : "";
                if (!ALLOWED_BG[slug]) {
                    slug = "primary";
                }
                textElement.className =
                    "pxl-throwable-element " + BG_PREFIX + slug;
                textElement.style.padding = "0 clamp(16px, 4vw, 73px)";
                textElement.style.left = "0px";
                textElement.style.top = "0px";

                var iconData = Array.isArray(icons) ? icons[index] : null;
                var iconNode = null;
                try {
                    iconNode = createIconNode(iconData);
                } catch (e) {
                    /* icon parse */
                }

                if (iconNode) {
                    textElement.appendChild(iconNode);
                }

                logoArea.appendChild(textElement);

                var imgs = textElement.querySelectorAll("img");
                for (var ii = 0; ii < imgs.length; ii++) {
                    if (!imgs[ii].complete) {
                        imgs[ii].addEventListener("load", queueHitboxSync, {
                            once: true,
                        });
                    }
                }

                var measuredWidth = Math.max(
                    40,
                    Math.ceil(textElement.offsetWidth),
                );
                var measuredHeight = Math.max(
                    24,
                    Math.ceil(textElement.offsetHeight),
                );

                var inset = wallThickness + 16;
                var halfW = measuredWidth * 0.5;
                var halfH = measuredHeight * 0.5;
                var minX = Math.min(w * 0.5, halfW + inset);
                var maxX = Math.max(w * 0.5, w - halfW - inset);
                var bandTop = 28 + halfH;
                var bandBottom = Math.max(
                    bandTop + 48,
                    Math.min(h * 0.52, bandTop + 80 + itemCount * 14),
                );
                var minY = bandTop;
                var maxY = bandBottom;
                var spawnX = minX + Math.random() * (maxX - minX || 1);
                var spawnY =
                    minY + Math.random() * Math.max(24, maxY - minY);

                var spawnGap = 16;
                var tries = 48;
                while (tries-- > 0) {
                    var overlaps = false;
                    var px = spawnX;
                    var py = spawnY;
                    var pIndex;
                    for (pIndex = 0; pIndex < placedBodies.length; pIndex++) {
                        var placed = placedBodies[pIndex];
                        var collideX =
                            Math.abs(px - placed.x) <
                            halfW + placed.halfW + spawnGap;
                        var collideY =
                            Math.abs(py - placed.y) <
                            halfH + placed.halfH + spawnGap;
                        if (collideX && collideY) {
                            overlaps = true;
                            break;
                        }
                    }
                    if (!overlaps) {
                        break;
                    }
                    spawnX = minX + Math.random() * (maxX - minX || 1);
                    spawnY = minY + Math.random() * Math.max(24, maxY - minY);
                }

                var commonOpts = {
                    restitution: 0.2,
                    friction: 0.3,
                    frictionStatic: 0.8,
                    frictionAir: 0.02,
                    slop: 0.001,
                    render: { visible: false },
                };

                // Pill hitbox: rounded ends ≈ half pill height (capped by half width).
                var chamferR = Math.min(measuredWidth * 0.5, measuredHeight * 0.5);
                var body = Bodies.rectangle(
                    spawnX,
                    spawnY,
                    measuredWidth,
                    measuredHeight,
                    Object.assign({}, commonOpts, {
                        chamfer: { radius: chamferR },
                    }),
                );

                Body.setAngularVelocity(
                    body,
                    (Math.random() - 0.5) * 0.12,
                );

                (function (b) {
                    setTimeout(function () {
                        var angle = Math.random() * Math.PI * 2;
                        var forceMagnitude = 0.024 + Math.random() * 0.038;
                        Body.applyForce(b, b.position, {
                            x: Math.cos(angle) * forceMagnitude,
                            y: Math.sin(angle) * forceMagnitude,
                        });
                    }, Math.random() * 1000);
                })(body);

                shapes.push({
                    body: body,
                    element: textElement,
                    _hitW: measuredWidth,
                    _hitH: measuredHeight,
                });
                placedBodies.push({
                    x: spawnX,
                    y: spawnY,
                    halfW: halfW,
                    halfH: halfH,
                });
            }

            queueHitboxSync();

            var mouseControl = MouseConstraint.create(engine, {
                element: logoArea,
                constraint: { render: { visible: false } },
            });

            logoArea.addEventListener(
                "mousedown",
                function (e) {
                    if (e.button === 1) {
                        e.preventDefault();
                    }
                },
                false,
            );

            Composite.add(
                engine.world,
                [ground, ceiling, rightWall, leftWall, mouseControl].concat(
                    shapes.map(function (s) {
                        return s.body;
                    }),
                ),
            );

            Render.run(render);
            var runner = Runner.create();
            Runner.run(runner, engine);

            Events.on(engine, "afterUpdate", function () {
                shapes.forEach(function (pair) {
                    var body = pair.body;
                    var element = pair.element;
                    var velocity = body.velocity;
                    var speed = Math.sqrt(
                        velocity.x * velocity.x + velocity.y * velocity.y,
                    );

                    if (speed > MAX_VELOCITY) {
                        var scale = MAX_VELOCITY / speed;
                        Body.setVelocity(body, {
                            x: velocity.x * scale,
                            y: velocity.y * scale,
                        });
                    }

                    if (speed > 3) {
                        Body.setVelocity(body, {
                            x: velocity.x * VELOCITY_DAMPING,
                            y: velocity.y * VELOCITY_DAMPING,
                        });
                    }

                    var bounds = body.bounds;
                    var dx = 0;
                    var dy = 0;
                    if (bounds.min.x < 0) {
                        dx = -bounds.min.x;
                    } else if (bounds.max.x > w) {
                        dx = w - bounds.max.x;
                    }
                    if (bounds.min.y < 0) {
                        dy = -bounds.min.y;
                    } else if (bounds.max.y > h) {
                        dy = h - bounds.max.y;
                    }
                    if (dx !== 0 || dy !== 0) {
                        Body.setPosition(body, {
                            x: body.position.x + dx,
                            y: body.position.y + dy,
                        });
                        Body.setVelocity(body, {
                            x: dx !== 0 ? body.velocity.x * -0.35 : body.velocity.x,
                            y: dy !== 0 ? body.velocity.y * -0.35 : body.velocity.y,
                        });
                    }

                    element.style.display = "inline-flex";
                    element.style.transform =
                        "translate3d(" +
                        body.position.x +
                        "px, " +
                        body.position.y +
                        "px, 0px) translate(-50%, -50%) rotate(" +
                        body.angle +
                        "rad)";
                });
            });

            var resizeHandler = function () {
                if (!logoArea.isConnected) {
                    logoArea.destroyPhysics();
                    return;
                }
                w = logoArea.offsetWidth;
                h = logoArea.offsetHeight;
                render.canvas.width = w;
                render.canvas.height = h;
                render.options.pixelRatio = window.devicePixelRatio;

                Body.setPosition(ceiling, { x: w / 2, y: -wallThickness / 2 });
                Body.setPosition(ground, { x: w / 2, y: h + wallThickness / 2 });
                Body.setPosition(leftWall, { x: -wallThickness / 2, y: h / 2 });
                Body.setPosition(rightWall, {
                    x: w + wallThickness / 2,
                    y: h / 2,
                });
            };
            window.addEventListener("resize", resizeHandler);

            logoArea.destroyPhysics = function () {
                Render.stop(render);
                Runner.stop(runner);
                Composite.clear(engine.world);
                Engine.clear(engine);
                if (render.canvas && render.canvas.parentNode) {
                    render.canvas.remove();
                }
                render.textures = {};
                shapes.forEach(function (pair) {
                    var element = pair.element;
                    if (element && element.parentNode) {
                        element.parentNode.removeChild(element);
                    }
                });
                window.removeEventListener("resize", resizeHandler);
                delete logoArea.destroyPhysics;
            };
        } catch (err) {
            console.warn("Physics widget error:", err);
        }
    }

    var pxl_widget_physics_handler = function ($scope) {
        $scope.find(".pxl-physics").each(function () {
            initPhysicsArea(this);
        });
    };

    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/pxl_physics.default",
            pxl_widget_physics_handler,
        );
    });
})(jQuery);
