const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');

module.exports = {
    //mode: 'jit',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    safelist: [
        'bg-rose-500', 'bg-sky-300', 'bg-sky-500', 'bg-bluegray-500', 'bg-bluegray-900',
    ],
    darkMode: 'class',
    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            backgroundColor: ['active', 'hover', 'focus'],
            borderRadius: ['active', 'hover', 'focus'],
            textColor: ['active', 'hover', 'focus'],
        },
        colors: {
            transparent: 'transparent',
            current: 'currentColor',
            black: colors.black,
            white: colors.white,
            gray: colors.gray,
            coolgray: colors.gray,
            bluegray: colors.slate,
            warmgray: colors.stone,
            red: colors.red,
            blue: colors.blue,
            sky: colors.sky,
            green: colors.green,
            teal: colors.teal,
            yellow: colors.yellow,
            amber: colors.amber,
            purple: colors.purple,
            indigo: colors.indigo,
            pink: colors.pink,
            rose: colors.rose,
        },
        zIndex: {
            '0': 0,
            '10': 10,
            '20': 20,
            '30': 30,
            '40': 40,
            '50': 50,
            '100': 100,
            '1000': 1000,
            '1001': 1001,
            'auto': 'auto',
        }
    },
    plugins: [
        require('@tailwindcss/aspect-ratio'),
        require('@tailwindcss/forms'),
        require('@tailwindcss/line-clamp'),
        require('@tailwindcss/typography'),
        require('@themesberg/flowbite/plugin'),
    ],
};
