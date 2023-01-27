/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ["./**/*.php"],
    theme: {
        extend: {
            backgroundImage: {
                'background': "url('../image/background.webp')",
            }
        },
    },
    plugins: [
        require('tailwindcss-filters'),
    ],
}
