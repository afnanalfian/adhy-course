/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "class",

    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./resources/**/*.tsx",
        "./resources/**/*.ts",
        "./resources/**/*.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Inter", "ui-sans-serif", "system-ui"],
            },
    colors: {
        azwara: {
            darkest:  "#012A36", // Hijau teal sangat gelap
            darker:   "#014F56", // Teal tua elegan
            medium:   "#027373", // Teal medium, segar & profesional
            light:    "#38A3A5", // Teal terang untuk hover
            lighter:  "#A9D6D6", // Teal pastel lembut
            lightest: "#F2EFE7", // Sangat terang, hampir putih
        },

        primary:   "#027373",   // Teal medium
        secondary: "#014F56",   // Teal tua elegan
    },

    backgroundImage: {
        "brand-gradient":
            `linear-gradient(135deg, #012A36 0%, #014F56 80%, #027373 100%)`,
    },



        },
    },

    plugins: [
        require("@tailwindcss/forms"),
    ],
};
