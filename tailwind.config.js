const { screens, maxWidth } = require('tailwindcss/defaultTheme')
const { colors } = require('tailwindcss/defaultTheme')


module.exports = {
    future: {},
    purge: {
        content: [
            './resources/views/**/*.blade.php',
            './resources/js/**/*.vue',
        ]
    },
    theme: {

        fontFamily: {
            'nunito': ['Nunito']
        },
        extend: {
            screens: {
                'xs': '480px',
                ...screens,
                'xxl': '1680px'
            },
            flex: {
                '1': '1 1 0%',
                auto: '1 1 auto',
                initial: '0 1 auto',
                none: 'none',
                '2': '2 2 0%',
            },
            minWidth: {
                '150': '150px',
                '480': '480px'
            },
            maxWidth: {
                ...maxWidth,
                '960': '960px',
                '1420': '1420px',
                '1920': '1920px'
            },
            colors: {
                nevada: '#636b6f', // gray
                zest: '#e57e1f', // orange
                donjuan: '#595358', // gray/purple
                skyblue: '#66c4ee', // blue
                silver: '#c0c0c0', // light gray
                salem: '#15A844', // green
                gainsboro: '#f0f0f0', // almost white
            }
        }

    },
    variants: {
        backgroundColor: ['hover', 'active', 'focus'],
        borderColor: ['hover', 'active', 'focus'],
    },
    plugins: [require("@tailwindcss/custom-forms")]
};
