const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            divideColor: ['responsive', 'hover', 'focus', 'dark'],
            divideWidth: ['responsive', 'hover', 'focus', 'dark'],
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                p_primary: {
                    50: '#4A4A4A',
                    100: '#424242',
                    200: '#3A3A3A',
                    300: '#323232',
                    400: '#2A2A2A',
                    500: '#212121',
                    600: '#191919',
                    700: '#111111',
                    800: '#090909',
                    900: '#010101',
                },
                p_secondary: {
                    50: '#3B3B3B',
                    100: '#343434',
                    200: '#2D2D2D',
                    300: '#262626',
                    400: '#1F1F1F',
                    500: '#181818',
                    600: '#121212',
                    700: '#0C0C0C',
                    800: '#050505',
                    900: '#000000',
                },
                p_support: {
                    50: '#2A8587',
                    100: '#237D80',
                    200: '#1B7478',
                    300: '#146C70',
                    400: '#0C6369',
                    500: '#0D7377',
                    600: '#075B5F',
                    700: '#014447',
                    800: '#002C30',
                    900: '#001418',
                },
                p_accent: {
                    50: '#66FFF9',
                    100: '#5DFFF6',
                    200: '#54FFF3',
                    300: '#4BFFF0',
                    400: '#42FFED',
                    500: '#14FFEC',
                    600: '#11CCBE',
                    700: '#0D998F',
                    800: '#096661',
                    900: '#053333',
                },
            },
            variants: {
                extend: {
                    textColor: ['hover'],
                },
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
