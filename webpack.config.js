const defaultConfig = require("@wordpress/scripts/config/webpack.config");
module.exports = {
  ...defaultConfig,
  entry: {
    index: "./src/index.js",
    block: "./src/block.js",
    editor: "./src/editor.scss",
  },
  output: {
    path: __dirname + "/build",
    filename: "[name].js",
    publicPath: "/wp-content/plugins/contact-signup/build/",
  },
};
