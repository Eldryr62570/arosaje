/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    extend: {
      fontFamily: {
        'mont': ['Montserrat', 'sans-serif'],
        'romono': ['Roboto Mono', 'sans-serif'],
        'roboto': ['Roboto', 'sans-serif'],
        'space': ['Space Grotesk', 'sans-serif'],
      },
    },
  },
  plugins: [],
}
