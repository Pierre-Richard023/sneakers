/** @type {import('tailwindcss').Config} */

module.exports = {
    darkMode: 'class',
    content: [
        "./assets/**/*.js",
        "./assets/**/*.jsx",
        "./templates/**/*.html.twig",
        "./node_modules/flowbite/**/*.js"
    ],
    safelist: [
        'bg-sneaker_red',
        'bg-sneaker_blue',
        'bg-sneaker_yellow',
        'bg-sneaker_green',
        'bg-sneaker_orange',
        'bg-sneaker_purple',
        'bg-sneaker_pink',
        'bg-sneaker_brown',
        'bg-sneaker_black',
        'bg-sneaker_white',
        'bg-sneaker_gray',
    ],
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
                    normal: '#059669',
                    light: '#33B187',
                    dark: '#047753'
                },
                sneaker_red: '#FF0000',
                sneaker_blue: '#0000FF',
                sneaker_yellow: '#FFFF00',
                sneaker_green: '#008000',
                sneaker_orange: '#FFA500',
                sneaker_purple: '#800080',
                sneaker_pink: '#FFC0CB',
                sneaker_brown: '#A52A2A',
                sneaker_black: '#000000',
                sneaker_white: '#FFFFFF',
                sneaker_gray: '#808080',
            },
        },
    },
    plugins: [
        // require('@tailwindcss/forms'),
        require('flowbite/plugin'),

    ],
}

