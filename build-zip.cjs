const fs = require("fs");
const path = require("path");
const archiver = require("archiver");

const themeDir = __dirname;
const themeName = path.basename(themeDir);
const distDir = path.join(themeDir, "dist");
const zipPath = path.join(distDir, `${themeName}.zip`);

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
