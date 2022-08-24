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
            }
          }
    },
    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/aspect-ratio"),
    ],
};
