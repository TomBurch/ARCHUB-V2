module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.{js,ts}",
        "./resources/**/*.svelte",
    ],
    theme: {
        extend: {
            height: {
                'screen-no-nav': '84vh',
            },
            minHeight: {
                'screen-no-nav': '84vh',
            },
            typography: {
                DEFAULT: {
                    css: {
                        color: 'gray-200'
                    }
                }
            },
        }
    },
    plugins: [
        require("@tailwindcss/forms"),
        require('@tailwindcss/typography'),
        require("@tailwindcss/aspect-ratio"),
    ],
};
