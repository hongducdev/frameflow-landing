const { spawn } = require("child_process");
const path = require("path");

const mode = process.argv[2] || "dev";
const isProduction = mode === "prod";
const isWatch = mode === "watch";

const webpackBin = path.resolve(__dirname, "node_modules/webpack/bin/webpack.js");
const mixWebpackConfig = path.resolve(
    __dirname,
    "node_modules/laravel-mix/setup/webpack.config.js"
);

const args = [webpackBin, `--config=${mixWebpackConfig}`];

if (isWatch) {
    args.push("--watch", "--progress");
}

const child = spawn(process.execPath, args, {
    stdio: "inherit",
    env: {
        ...process.env,
        NODE_ENV: isProduction ? "production" : "development",
        MIX_FILE: "webpack.mix",
    },
});

child.on("exit", (code, signal) => {
    if (code === null) {
        process.exit(signal === "SIGINT" ? 130 : 1);
    }
    process.exit(code);
});
