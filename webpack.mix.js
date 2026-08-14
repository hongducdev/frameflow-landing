const fs = require("fs");
const mix = require("laravel-mix");
const purgecss = require("@fullhuman/postcss-purgecss");
const path = require("path");

const isProduction = mix.inProduction();
const isWatch = process.argv.includes("--watch");

// Frameflow WordPress Theme - Mix Asset Management

// Sass compile options
// The SCSS codebase uses legacy @import — silence deprecation warnings
const sassOptions = {
    sassOptions: {
        silenceDeprecations: [
            "import",
            "global-builtin",
            "color-functions",
            "legacy-js-api",
        ],
        quietDeps: true,
    },
};

mix.webpackConfig({
    cache: {
        type: "filesystem",
    },
    watchOptions: isWatch
        ? {
              ignored: [
                  "**/node_modules/**",
                  "**/dist/**",
                  "**/assets/css/**",
                  "**/assets/js/**/*.min.js",
                  "**/assets/css/elements/**/*.min.css",
              ],
          }
        : undefined,
});

// -------------------------
// CSS / SCSS
// -------------------------
// Compile main stylesheet from SCSS source
mix.sass("assets/scss/style.scss", "assets/css/style.min.css", sassOptions);

// WooCommerce styles — separate file, enqueued only when WC is active
mix.sass(
    "assets/scss/woocommerce.scss",
    "assets/css/woocommerce.min.css",
    sassOptions
);

// -------------------------
// Widget CSS (On-Demand Loading)
// -------------------------
// Dynamically compile all SCSS files in assets/scss/elements
// Automatically picks up any new widget style added.
const elementsScssDir = path.resolve(__dirname, "assets/scss/elements");
fs.readdirSync(elementsScssDir).forEach(file => {
    if (file.endsWith(".scss") && !file.startsWith("_")) {
        const name = path.basename(file, ".scss");
        mix.sass(
            `assets/scss/elements/${file}`,
            `assets/css/elements/${name}.min.css`,
            sassOptions
        );
    }
});

// -------------------------
// JavaScript
// -------------------------
// Compile main theme JS
mix.js("assets/js/theme.js", "assets/js/theme.min.js");

const jsFiles = [
    "assets/js/pxl-lazy-loader.js",
    "elements/widgets/js/accordion.js",
    "elements/widgets/js/carousel-helpers.js",
    "elements/widgets/js/carousel.js",
    "elements/widgets/js/client-marquee.js",
    "elements/widgets/js/image-marquee.js",
    "elements/widgets/js/countdown.js",
    "elements/widgets/js/counter.js",
    "elements/widgets/js/elementor.js",
    "elements/widgets/js/grid.js",
    "elements/widgets/js/image.js",
    "elements/widgets/js/parallax.js",
    "elements/widgets/js/particle.js",
    "elements/widgets/js/phsics.js",
    "elements/widgets/js/pie-chart.js",
    "elements/widgets/js/process.js",
    "elements/widgets/js/pxl-countdown.js",
    "elements/widgets/js/tabs.js",
    "elements/widgets/js/text-box-grid.js",
    "elements/widgets/js/text-marquee.js",
    "elements/widgets/js/testimonial-marquee.js",
    "woocommerce/js/woocommerce.js",
    "woocommerce/js/shop-ajax.js",
    "woocommerce/js/price-filter.js",
    "woocommerce/js/loop-swatches.js",
];

if (isProduction) {
    jsFiles.forEach(file => mix.minify(file));
} else {
    jsFiles.forEach(file => {
        mix.copy(file, file.replace(/\.js$/, ".min.js"));
    });
}

// -------------------------
// Options
// -------------------------
mix.options({
    // Disable URL rewriting in CSS (keep asset paths as-is)
    processCssUrls: false,

    // PostCSS plugins
    postCss: [
        // Auto-add vendor prefixes
        require("autoprefixer"),

        // Remove unused CSS safely in production builds
        ...(isProduction
            ? [
                  purgecss({
                      content: [
                          "./**/*.php",
                          "./assets/js/**/*.js",
                          "./assets/scss/**/*.scss",
                      ],
                      defaultExtractor: (content) =>
                          content.match(/[\w-/:]+(?<!:)/g) || [],
                      safelist: {
                          standard: [
                              // Elementor
                              /^elementor-/,

                              // Theme / widgets
                              /^pxl-/,

                              // WooCommerce
                              /^woocommerce/,
                              /^wc-/,
                              /^cart/,
                              /^checkout/,

                              // WordPress core / menus / alignment
                              /^wp-/,
                              /^align/,
                              /^menu-item/,
                              /^current-menu/,

                              // Layout helpers
                              /^row/,
                              /^col-/,
                              /^container/,

                              // Sliders / galleries
                              /^swiper-/,
                              /^slick-/,

                              // Misc JS / animation hooks
                              /^mfp-/,
                              /^tippy-/,
                              /^animate/,
                              /^is-/,
                          ],
                          keyframes: true,
                      },
                  }),
              ]
            : []),
    ],
});

// Source maps for development only; cheaper mode builds faster
if (!isProduction) {
    mix.sourceMaps(false, "eval-cheap-module-source-map");
}

// Disable Mix manifest (WordPress doesn't use it)
mix.disableNotifications();
