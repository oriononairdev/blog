const colors = require('tailwindcss/colors')

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
    ],
    theme: {
        fontFamily: {
            sans: [
                'Arial',
                'Helvetica',
                'Verdana',
                'Garamond',
            ],
            mono: [
                'Monaco',
                'Consolas',
                'Liberation Mono',
                'Courier New',
                'monospace',
            ],
        },
        extend: {
            borderWidth: {
                1: '1px',
                3: '3px',
                5: '5px',
            },
            fontSize: {
                xxs: '0.65rem',
            },
            lineHeight: {
                relaxed: 1.75,
            },
            spacing: {
                7: '1.75rem',
            },
            borderRadius: {
                xl: '12px',
                '2xl': '16px',
                '3xl': '24px',
            },
            rotate: {
                '-5': '-5deg',
            },
            colors: {
                "white-50": "hsla(0, 0%, 100%, 0.5)",
                "white-90": "hsla(0, 0%, 100%, 0.97)",
                orange: colors.orange,
            },
            animation: {
                'spin-slow': 'spin 15s linear infinite',
            }
        },
        container: {
            center: true,
        }
    },
    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/aspect-ratio'), require('@tailwindcss/typography'),],
};
