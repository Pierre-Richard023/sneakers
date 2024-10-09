/** @type {import('tailwindcss').Config} */

module.exports = {
    content: [
        "./assets/**/*.js",
        "./templates/**/*.html.twig",
        "./node_modules/flowbite/**/*.js"

    ],
    darkMode: 'class',
    theme: {
        extend: {
            colors: {
                primary: {
                    normal: '#5B2434', light: '#7A3E51', dark: '#451B29'
                },
                secondary: {
                    normal: '#D1920D', ligth: '#E0AB3F', dark: '#A86E0A'
                },
                danger:"#e11d48",
                success:"#059669",
                warning:"",
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('flowbite/plugin'),

    ],
}

