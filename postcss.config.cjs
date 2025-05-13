const tailwindcss = require('@tailwindcss/postcss');
const forms = require('@tailwindcss/forms');

module.exports = {
  plugins: [
    tailwindcss(),
    forms, 
    require('autoprefixer'),
  ],
};
