/** @type {import('tailwindcss').Config} */

module.exports = {
    content: [
        "./assets/**/*.js",
        "./assets/**/*.jsx",
        "./templates/**/*.html.twig",
        "./node_modules/flowbite/**/*.js"

    ],
    darkMode: 'class',
    theme: {
        extend: {
            colors: {
                primary: {
                    normal: '#5B2434',
                    light: '#7A3E51',
                    dark: '#451B29'
                },
                secondary: {
                    normal: '#D1920D',
                    light: '#E0AB3F',
                    dark: '#A86E0A'
                },
                danger: {
                    normal: '#E11D48',
                    light: '#E7476D',
                    dark: '#B0193A'
                },
                success: {
                    normal: '#059669', light: '#33B187', dark: '#047753'
                },
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('flowbite/plugin'),

    ],
}

