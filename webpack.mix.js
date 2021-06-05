const mix = require('webpack-mix');
const tailwindcss = require('tailwindcss');
const autoprefixer = require('autoprefixer');
const LiveReloadPlugin = require('webpack-livereload-plugin');

mix
  .webpackConfig({
    plugins: [
      new LiveReloadPlugin(),
    ]
  })
  .postCss('src/assets/css/tailwind.css', 'public/css/styles.css', [
    tailwindcss,
    autoprefixer,
  ]);
