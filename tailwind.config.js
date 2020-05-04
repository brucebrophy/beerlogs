module.exports = {
    purge: ["./resources/views/**/*.blade.php", "./resources/css/**/*.css"],
    theme: {
        fontFamily: {
            sans: ["Source Sans Pro"],
            mono: ["Source Code Pro", "SFMono-Regular"],
        },
        extend: {},
    },
    variants: {},
    plugins: [
        require("@tailwindcss/custom-forms"),
        require("tailwind-bootstrap-grid")(),
    ],
};
