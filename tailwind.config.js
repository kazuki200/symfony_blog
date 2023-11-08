/** @type {import('tailwindcss').Config} */
module.exports = {
  mode: "jit",
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
    "node_modules/preline/dist/*.js",
  ],
  theme: {
    extend: {},
  },
  plugins: [require("preline/plugin")],
};
