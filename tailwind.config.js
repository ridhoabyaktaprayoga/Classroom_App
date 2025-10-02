/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./app/View/Components/**/*",
        "./app/Livewire/**/*",
    ],
    theme: {
        extend: {},
    },
}