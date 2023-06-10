/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  purge: [
    './resources/views/**/*.blade.php'
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
