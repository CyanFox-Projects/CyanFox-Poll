import preset from './vendor/filament/support/tailwind.config.preset'

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    presets: [preset],
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",

        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',

        './lang/**/*.php',

        './vendor/robsontenorio/mary/src/View/Components/**/*.php',

        './vendor/rappasoft/laravel-livewire-tables/resources/views/**/*.blade.php',
        './app/Livewire/**/*.php',
    ],
    theme: {
        extend: {},
    },
    plugins: [
        require("daisyui"),
    ],
}
