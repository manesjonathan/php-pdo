/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ["./**/*.php"],
    theme: {
        extend: {
            backgroundImage: {
                'background': "url('../image/background_alt_2.webp')",
            }
        },
    },
    plugins: [
        require('tailwindcss-filters'),
    ],
}
