/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        primary: '#e50914',
        secondary: '#831010',
        dark: '#141414',
      },
    },
  },
  plugins: [],
}
