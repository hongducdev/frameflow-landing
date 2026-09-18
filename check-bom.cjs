/**
 * check-bom.cjs — block UTF-8 BOM files before the theme is packaged or deployed.
 *
 * Why this exists:
 *   A UTF-8 BOM (bytes EF BB BF) placed before the opening "<?php" tag is treated
 *   as literal output by PHP. That output happens before any header is sent, so
 *   WordPress can no longer send Location:/Set-Cookie headers and every redirect
 *   degrades into a blank body that contains only the BOM. The browser then sees
 *   a document without a DOCTYPE and reports "This page is in Quirks mode".
 *
 * Usage:
 *   node check-bom.cjs                  # scan the theme directory
 *   node check-bom.cjs <dir> [dir...]   # scan specific directories (e.g. WP root)
 *   node check-bom.cjs --all            # also scan .js/.css/.json/.html/.svg/.txt
 *
 * Exit code 1 when any BOM is found.
 */
const fs = require("fs");
const path = require("path");

const BOM = Buffer.from([0xef, 0xbb, 0xbf]);
const PHP_EXT = [".php", ".phtml", ".inc"];
const TEXT_EXT = [".js", ".css", ".json", ".html", ".svg", ".txt"];
const SKIP_DIRS = new Set(["node_modules", ".git", "dist", ".idea", ".vscode", ".sass-cache"]);

/**
 * Collect every file with one of the given extensions below `dir`.
 */
function walk(dir, exts, out = []) {
    let entries;
    try {
        entries = fs.readdirSync(dir, { withFileTypes: true });
    } catch {
        return out;
    }

    for (const entry of entries) {
        const full = path.join(dir, entry.name);
        if (entry.isDirectory()) {
            if (!SKIP_DIRS.has(entry.name)) {
                walk(full, exts, out);
            }
        } else if (entry.isFile() && exts.includes(path.extname(entry.name).toLowerCase())) {
            out.push(full);
        }
    }

    return out;
}

/**
 * Read the first bytes of a file, or null when it cannot be read.
 */
function firstBytes(file, length = 3) {
    let fd;
    try {
        fd = fs.openSync(file, "r");
        const buf = Buffer.alloc(length);
        const read = fs.readSync(fd, buf, 0, length, 0);
        return buf.subarray(0, read);
    } catch {
        return null;
    } finally {
        if (fd !== undefined) {
            fs.closeSync(fd);
        }
    }
}

/**
 * Scan `roots` (defaults to the theme directory) for BOM files.
 * @returns {{ files: number, found: string[] }}
 */
function scan(roots = [], options = {}) {
    const exts = options.all ? PHP_EXT.concat(TEXT_EXT) : PHP_EXT;
    const dirs = roots.length ? roots : [__dirname];
    const list = dirs.reduce(
        (acc, dir) => (fs.existsSync(dir) ? walk(path.resolve(dir), exts, acc) : acc),
        []
    );

    const found = list.filter((file) => {
        const head = firstBytes(file);
        return head !== null && head.length === 3 && head.equals(BOM);
    });

    return { files: list.length, found };
}

if (require.main === module) {
    const args = process.argv.slice(2);
    const roots = args.filter((arg) => !arg.startsWith("-"));
    const relative = (file) => path.relative(process.cwd(), file).replace(/\\/g, "/");
    const { files, found } = scan(roots, { all: args.includes("--all") });

    console.log(`check-bom: scanned ${files} file(s) in ${roots.length ? roots.join(", ") : "theme"}`);

    if (!found.length) {
        console.log("check-bom: OK — no UTF-8 BOM found");
        process.exit(0);
    }

    console.error(`check-bom: FAILED — ${found.length} file(s) start with a UTF-8 BOM:`);
    found.forEach((file) => console.error(`  - ${relative(file)}`));
    console.error("Remove the 3 leading bytes (EF BB BF) and retry.");
    process.exit(1);
}

module.exports = { scan, BOM, PHP_EXT, TEXT_EXT };
