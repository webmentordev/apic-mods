import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            screens: {
                "1130px": {
                    "max": "1130px"
                },
                "1110px": {
                    "max": "1110px"
                },
                "900px": {
                    "max": "900px"
                },
                "890px": {
                    "max": "890px"
                },
                "790px": {
                    "max": "790px"
                },
                "750px": {
                    "max": "750px"
                },
                "650px": {
                    "max": "650px"
                },
                "620px": {
                    "max": "620px"
                },
                "580px": {
                    "max": "580px"
                },
                "530px": {
                    "max": "530px"
                },
                "480px": {
                    "max": "480px"
                }
            },
            colors: {
                "main": "#BDDF41",
                "dark": "#1D1D1D",
                "dark-light": "#2C2C2C"
            }
        },
    },

    plugins: [forms],
};
