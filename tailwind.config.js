const path = require('path');

module.exports = {
  purge: [
    path.resolve('src', 'assets', 'css', '*.css'),
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {},
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
