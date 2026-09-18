const fs = require("fs");
const path = require("path");
const archiver = require("archiver");
const { scan } = require("./check-bom.cjs");

const themeDir = __dirname;
const themeName = path.basename(themeDir);
const distDir = path.join(themeDir, "dist");
const zipPath = path.join(distDir, `${themeName}.zip`);

// Never ship a BOM: it breaks WordPress redirects and makes the browser fall
// back to Quirks mode. See check-bom.cjs for details.
const bom = scan([themeDir]);
if (bom.found.length) {
    console.error(`Build stopped — ${bom.found.length} file(s) start with a UTF-8 BOM:`);
    bom.found.forEach((file) => console.error(`  - ${path.relative(themeDir, file)}`));
    console.error("Remove the 3 leading bytes (EF BB BF) and run the build again.");
    process.exit(1);
}

if (!fs.existsSync(distDir)) {
    fs.mkdirSync(distDir);
}

const output = fs.createWriteStream(zipPath);
const archive = archiver("zip", { zlib: { level: 9 } });

output.on("close", () => {
    console.log(`Theme zipped: ${zipPath} (${archive.pointer()} total bytes)`);
});

archive.on("error", (err) => {
    throw err;
});

archive.pipe(output);

const ignore = [
    "node_modules/**",
    ".git/**",
    ".gitignore",
    ".env",
    "dist/**",
    "bun.lock",
    "package-lock.json",
    "pnpm-lock.yaml",
    "yarn.lock",
    "bun.lockb",
    "build-zip.cjs",
    "check-bom.cjs",
    "**/*.bom-bak",
    "vite.config.*",
    "postcss.config.*",
    "tailwind.config.*",
    "README*",
    "webpack.mix.js",
    "mix-manifest.json",
];

const widgetJsDir = path.join(themeDir, "elements", "widgets", "js");
if (fs.existsSync(widgetJsDir)) {
    const widgetJsFiles = fs.readdirSync(widgetJsDir);
    widgetJsFiles.forEach((file) => {
        if (file.endsWith(".js") && !file.endsWith(".min.js")) {
            ignore.push(`elements/widgets/js/${file}`);
        }
    });
}

const wooJsDir = path.join(themeDir, "woocommerce", "js");
if (fs.existsSync(wooJsDir)) {
    fs.readdirSync(wooJsDir).forEach((file) => {
        if (file.endsWith(".js") && !file.endsWith(".min.js")) {
            ignore.push(`woocommerce/js/${file}`);
        }
    });
}

archive.glob("**/*", {
    cwd: themeDir,
    dot: true,
    ignore,
});

archive.finalize();
