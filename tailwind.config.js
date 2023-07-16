/** @type {import('tailwindcss').Config} */

module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/admin/**/*.html.twig",
  ],
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
        primary:'#5B2434',
        secondary:'#D1920D',
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}

