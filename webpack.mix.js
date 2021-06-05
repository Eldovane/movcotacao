const path = require('path');
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
  .postCss(path.resolve('src', 'assets', 'css', 'tailwind.css'), path.resolve('public', 'css', 'styles.css'), [
    tailwindcss,
    autoprefixer,
  ]);
