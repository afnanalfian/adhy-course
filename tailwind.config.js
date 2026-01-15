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
    ens: {
        darkest:  "#3F0A0A", // Deep maroon (sidebar)
        darker:   "#5C1111", // Maroon stabil
        medium:   "#9F1D1D", // Merah elegan
        light:    "#C53030", // CTA / hover
        lighter:  "#E5BABA", // Border subtle
        lightest: "#FAF5F5", // Hampir putih
    },

    primary:   "#9F1D1D",
    secondary: "#3F0A0A",
},
backgroundImage: {
    "brand-gradient":
        "linear-gradient(135deg, #3F0A0A 0%, #5C1111 60%, #9F1D1D 100%)",
},

        },
    },

    plugins: [
        require("@tailwindcss/forms"),
    ],
};
