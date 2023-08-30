const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    mode: 'jit',
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },

            colors: {
                'empex-green': '#2d9735',
                'empex-yellow': '#f5cb58',
                'empex-red': '#fc5c5c',
                'empex-gray': '#e9f3ed',
            },

            backgroundColor: {
                'empex-green': '#2d9735',
                'empex-yellow': '#f5cb58',
                'empex-red': '#fc5c5c',
                'empex-gray': '#e9f3ed',
            },

            textColor: {
                'empex-green': '#2d9735',
                'empex-yellow': '#f5cb58',
                'empex-red': '#fc5c5c',
                'empex-gray': '#e9f3ed',
            },

            borderColor: {
                'empex-green': '#2d9735',
                'empex-yellow': '#f5cb58',
                'empex-red': '#fc5c5c',
                'empex-gray': '#e9f3ed',
            },

            placeholderColor: {
                'empex-green': '#2d9735',
                'empex-yellow': '#f5cb58',
                'empex-red': '#fc5c5c',
                'empex-gray': '#e9f3ed',
            },

            ringColor: {
                'empex-green': '#2d9735',
                'empex-yellow': '#f5cb58',
                'empex-red': '#fc5c5c',
                'empex-gray': '#e9f3ed',
            },
            animation: {
                marquee: 'marquee 10s linear infinite',
                marquee2: 'marquee2 10s linear infinite',
            },
            keyframes: {
                marquee: {
                    '0%': { transform: 'translateY(0%)' },
                    '100%': { transform: 'translateY(-100%)' },
                },
                marquee2: {
                    '0%': { transform: 'translateY(0%)' },
                    '100%': { transform: 'translateY(-100%)' },
                }
            }
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('@tailwindcss/line-clamp')
    ],
};
