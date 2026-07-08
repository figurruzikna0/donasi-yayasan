import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import daisyui from 'daisyui';

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
            colors: {
                brand: {
                    50: '#f0f7f4',
                    100: '#d4e9df',
                    200: '#a9d4c0',
                    300: '#75b89b',
                    400: '#4a9a7b',
                    500: '#2d7d62',
                    600: '#1e634d',
                    700: '#18513e',
                    800: '#154233',
                    900: '#12372b',
                    950: '#091f19',
                },
            },
        },
    },

    plugins: [forms, daisyui],

    daisyui: {
        themes: [
            {
                baitul: {
                    "color-scheme": "light",
                    "--rounded-box": "0.75rem",
                    "--rounded-btn": "0.5rem",

                    "primary": "#2d7d62",
                    "primary-content": "#ffffff",
                    "secondary": "#1e634d",
                    "secondary-content": "#ffffff",
                    "accent": "#d97706",
                    "accent-content": "#ffffff",
                    "neutral": "#2d3a3a",
                    "neutral-content": "#e2e8f0",
                    "base-100": "#fafbfa",
                    "base-200": "#f0f4f2",
                    "base-300": "#dce5e0",
                    "base-content": "#1a2e26",
                    "info": "#2563eb",
                    "success": "#2d7d62",
                    "warning": "#d97706",
                    "error": "#dc2626",
                },
            },
        ],
    },
};
