import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './backend/vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './backend/storage/framework/views/*.php',
        './backend/resources/**/*.blade.php',
        './frontend/resources/**/*.js',
        './frontend/resources/**/*.ts',
        './frontend/resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [],
};
