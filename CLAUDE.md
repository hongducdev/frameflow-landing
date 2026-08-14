# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Commands

- `npm install` — install Laravel Mix build dependencies.
- `npm run dev` — build development assets with source maps.
- `npm run watch` — rebuild assets on file changes.
- `npm run prod` — build production assets; minifies widget JS and runs PurgeCSS.
- `npm run zip` — create `dist/frameflow.zip`, excluding source/build-only files listed in `build-zip.cjs`.
- `npx prettier --write <file>` — format JS/PHP/SCSS files using `.prettierrc`.

No test or lint script is defined in `package.json`. For PHP changes, validate in WordPress with required plugins active, especially Elementor, Redux Framework, Case Theme Core/PXL hooks, and WooCommerce when touching shop code.

## Build system

- `webpack.mix.js` drives asset builds through Laravel Mix.
- Main SCSS source: `assets/scss/style.scss` → `assets/css/style.min.css`.
- Per-widget SCSS source: every non-partial `assets/scss/elements/*.scss` → `assets/css/elements/<name>.min.css`.
- Main JS source: `assets/js/theme.js` → `assets/js/theme.min.js`.
- Widget JS sources in `elements/widgets/js/*.js` are copied to `.min.js` in dev/watch and minified in production.
- `run-mix-webpack.cjs` invokes Mix webpack config directly and sets `NODE_ENV` from requested mode.
- Production PurgeCSS scans PHP, JS, and SCSS. Safelist covers Elementor, `pxl-*`, WooCommerce, WordPress/menu classes, grid containers, slider libraries, and animation hooks. Add safelist entries before relying on classes generated only at runtime.

## Theme bootstrap

- `functions.php` defines dev flags, loads `inc/classes/class-main.php`, `inc/widget-styles.php`, admin files, theme options, WooCommerce files when available, and then bulk-requires PHP under `inc`, `inc/classes`, and `template-parts/widgets` via `frameflow()->require_folder()`.
- `Frameflow_Main` in `inc/classes/class-main.php` is the theme singleton exposed by `frameflow()`. It owns header/footer/page/blog helpers and resolves options with theme option → page override precedence through `get_theme_opt()`, `get_page_opt()`, and `get_opt()`.
- `inc/theme-actions.php` sets up theme supports, menus, sidebars, frontend/admin enqueue logic, popups, hidden panels, cart sidebar behavior, and frontend hooks.
- `inc/theme-filters.php` adds body classes, Elementor CPT support, portfolio/service CPT and taxonomy config through PXL filters, template-builder layout IDs, icon/font filters, Swiper version selection, search query changes, and Contact Form 7 autop disabling.
- `inc/theme-config.php` maps Redux theme options to CSS custom properties via `frameflow_inline_styles()`, which is added to `pxl-style`.
- `inc/classes/class-css-generator.php` integrates Redux + scssc for option-driven SCSS output and inline CSS when Redux is present.

## Elementor/widget architecture

- Widget definitions live in `elements/widgets/*.php`. They are configuration arrays passed to `pxl_add_custom_widget(...)`; this function comes from Case Theme/PXL infrastructure, not this repository.
- Shared widget control factories live in `elements/widget-control-factory.php`; broader widget helpers and layout option builders live in `elements/element-functions.php`.
- Widget template/layout rendering is coordinated by `elements/element-templates.php` and related PXL/Elementor hooks.
- Runtime widget scripts are registered in `elements/element-functions.php` with handles like `pxl-swiper`, `frameflow-tabs`, `frameflow-counter`, etc. Widgets enqueue these handles through their config/templates.
- Per-widget CSS loading is centralized in `inc/widget-styles.php`. It maps widget names to `assets/css/elements/<handle>.min.css`, includes explicit overrides such as `pxl_icon_box_carousel` → `pxl_icon_box` and post/team variants → shared styles, and enqueues styles from Elementor document data, render hooks, class usage, editor/preview fallbacks, and a frontend fallback.
- When adding a widget, update all relevant layers together: widget PHP in `elements/widgets`, optional template/layout assets under `elements/widgets/img-layout`, SCSS in `assets/scss/elements`, optional JS in `elements/widgets/js`, script registration in `elements/element-functions.php`, and style override map in `inc/widget-styles.php` if CSS is shared.

## Templates, options, and content types

- Theme-builder templates use post type `pxl-template`; helper functions in `inc/theme-options/option-functions.php` query templates by `template_type` meta (`header`, `header-mobile`, `footer`, `page-title`, `hidden-panel`, `popup`, `tab`, `slider`, etc.).
- Header/footer/page-title/subscription/template selections are Redux options, with page-level overrides handled through `frameflow()->get_opt()`.
- Portfolio and service CPTs/taxonomies are registered through PXL filters in `inc/theme-filters.php`; slugs/names come from Redux options.
- WooCommerce code is conditionally loaded from `woocommerce/` and enqueued only on relevant WooCommerce pages where possible.

## Style and repository rules

- Cursor rules are present and apply: make surgical changes, avoid speculative abstractions, match existing style, and surface unclear assumptions before coding.
- Commit messages, when drafting them, should use Gitmoji + Conventional Commits: `<emoji> <type>[optional scope]: <description>`, imperative subject, ≤72 chars when possible.
- Prettier config uses LF, 4-space tabs, double quotes in JS, no semicolons, trailing commas where valid, and PHP plugin support.
- Existing generated/minified assets are committed. When editing SCSS or JS sources, run the relevant npm build and include generated CSS/JS changes if the task expects deployable theme output.