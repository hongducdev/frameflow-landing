;(function ($) {
    "use strict"

    var boundModels = {}
    var currentModel = null
    var initialized = false
    var previewRefreshTimer = null

    function debounce(callback, delay) {
        clearTimeout(previewRefreshTimer)
        previewRefreshTimer = setTimeout(callback, delay)
    }

    function getPreviewFrame() {
        return document.getElementById("elementor-preview-iframe")
    }

    function getPreviewWindow() {
        var iframe = getPreviewFrame()

        if (!iframe || !iframe.contentWindow) {
            return null
        }

        return iframe.contentWindow
    }

    function getElementId(model) {
        if (!model || !model.get) {
            return ""
        }

        return model.get("id") || model.get("_id") || ""
    }

    function getStyleId(id) {
        return "pxl-elementor-custom-css-" + id
    }

    function getCssSelector(id) {
        if (!id) {
            return ""
        }

        return ".elementor-element.elementor-element-" + id
    }

    function escapeSelector(value) {
        if (!value) {
            return value
        }

        if (typeof CSS !== "undefined" && CSS.escape) {
            return CSS.escape(value)
        }

        return value.replace(/([ #;?%&,.+*~\':\"!^$\[\]()=>|\/@])/g, "\\$1")
    }

    function normalizeCss(css, selector) {
        if (!css || !selector) {
            return ""
        }

        return css.replace(/selector/g, selector)
    }

    function ensureStyleElement(doc, styleId) {
        var style = doc.getElementById(styleId)

        if (!style) {
            style = doc.createElement("style")
            style.id = styleId
            doc.head.appendChild(style)
        }

        return style
    }

    function removeStyleElement(doc, styleId) {
        var style = doc.getElementById(styleId)

        if (style && style.parentNode) {
            style.parentNode.removeChild(style)
        }
    }

    function getPreviewDocument() {
        var iframe = getPreviewFrame()
        var previewWindow = getPreviewWindow()

        if (iframe && iframe.contentDocument) {
            return iframe.contentDocument
        }

        if (!previewWindow || !previewWindow.document) {
            return null
        }

        return previewWindow.document
    }

    function getElementSelector(model) {
        return getCssSelector(getElementId(model))
    }

    function getPreviewSelector(model) {
        var id = escapeSelector(getElementId(model))

        if (!id) {
            return ""
        }

        return '[data-id="' + id + '"]'
    }

    function getIframeBodyClass(model) {
        var elementType = model && model.get ? model.get("elType") : ""

        if (!elementType) {
            return ""
        }

        return "elementor-element-edit-mode elementor-" + elementType
    }

    function getPreviewElement(model, doc) {
        var selector = getPreviewSelector(model)

        if (!selector || !doc || !doc.querySelector) {
            return null
        }

        return doc.querySelector(selector)
    }

    function forcePreviewElementLayout(model, css) {
        var doc = getPreviewDocument()
        var previewWindow = getPreviewWindow()
        var element = getPreviewElement(model, doc)
        var id = getElementId(model)
        var bodyClass = getIframeBodyClass(model)
        var styleId = getStyleId(id) + "-inline"
        var inlineCss = ""

        if (!doc || !previewWindow || !element || !id) {
            return
        }

        if (/\bposition\s*:\s*sticky\b/i.test(css)) {
            inlineCss += getPreviewSelector(model) + "{position:sticky;}"
        }

        if (!inlineCss) {
            removeStyleElement(doc, styleId)
            return
        }

        if (bodyClass && doc.body && !doc.body.classList.contains(bodyClass)) {
            doc.body.classList.add(bodyClass)
        }

        ensureStyleElement(doc, styleId).textContent = inlineCss
        previewWindow.requestAnimationFrame(function () {
            element.style.transform = "translateZ(0)"
            previewWindow.requestAnimationFrame(function () {
                element.style.transform = ""
            })
        })
    }

    function refreshPreview(model, css) {
        var previewWindow = getPreviewWindow()

        if (!previewWindow) {
            return
        }

        forcePreviewElementLayout(model, css)

        if (
            previewWindow.elementorFrontend &&
            previewWindow.elementorFrontend.elementsHandler
        ) {
            debounce(function () {
                try {
                    previewWindow.elementorFrontend.elementsHandler.runReadyTrigger(
                        getPreviewElement(model, getPreviewDocument())
                    )
                } catch (error) {}
            }, 30)
        }
    }

    function getSettings(model) {
        return model && model.get ? model.get("settings") : null
    }

    function getCustomCss(model) {
        var settings = getSettings(model)

        if (!settings || !settings.get) {
            return ""
        }

        return settings.get("pxl_custom_css") || ""
    }

    function updateCustomCss(model) {
        var doc = getPreviewDocument()
        var selector = getElementSelector(model)
        var css = getCustomCss(model)
        var id = getElementId(model)
        var styleId = getStyleId(id)
        var normalizedCss = normalizeCss(css, selector)

        if (!doc || !selector || !id) {
            return
        }

        if (!css.trim()) {
            removeStyleElement(doc, styleId)
            removeStyleElement(doc, styleId + "-inline")
            return
        }

        ensureStyleElement(doc, styleId).textContent = normalizedCss
        refreshPreview(model, normalizedCss)
    }

    function bindModel(model) {
        var id = model && model.get ? model.get("id") : ""
        var settings = getSettings(model)

        currentModel = model

        if (!id || !settings || !settings.on) {
            updateCustomCss(model)
            return
        }

        if (!boundModels[id]) {
            boundModels[id] = true

            settings.on("change:pxl_custom_css", function () {
                updateCustomCss(model)
            })
        }

        updateCustomCss(model)
    }

    function registerPanelHook(type) {
        elementor.hooks.addAction(
            "panel/open_editor/" + type,
            function (panel, model) {
                bindModel(model)
            }
        )
    }

    function init() {
        if (
            initialized ||
            typeof elementor === "undefined" ||
            !elementor.hooks
        ) {
            return false
        }

        initialized = true
        ;["widget", "section", "column", "container"].forEach(registerPanelHook)

        elementor.on("preview:loaded", function () {
            boundModels = {}

            if (currentModel) {
                bindModel(currentModel)
            }
        })

        return true
    }

    function bootstrap() {
        if (init()) {
            return
        }

        if ($) {
            $(window).one("elementor:init", init)
        }
    }

    bootstrap()
})(jQuery)
