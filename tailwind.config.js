module.exports = {
    content: ["./resources/**/*.{js,ts,svelte}"],
    theme: {
        extend: {
            height: {
                "screen-no-nav": "84vh",
            },
            minHeight: {
                "screen-no-nav": "84vh",
            },
        },
    },
    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
        require("@tailwindcss/aspect-ratio"),
        require("@tailwindcss/line-clamp"),
    ],
};
