const mix = require('webpack-mix');

mix
  .postCss('src/assets/css/tailwind.css', 'public/css/styles.css', [
    require('tailwindcss'),
    require('autoprefixer'),
  ]);
