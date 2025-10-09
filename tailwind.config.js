/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/views/**/*.blade.php",  
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        sidebar: '#1e1f1e',
        sidebarBorder: '#6e6d6d',
        sidebarHover: '#2d2e2d',
      },
    },
  },
  plugins: [],
}
