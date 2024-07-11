/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                "love-red": "#ED2324",
                "soft-black": "#1A1A1C",
                "input-bg": "#292B30",
                "input-text": "#AAABAD",
                "tail": "#00B2B2",
                "rot": "#759116"
            },
            blur: {
                xs: '3px',
            },
            fontFamily: {
                sans: ['Ubuntu']
            },
        },
    },
    plugins: [],
}
