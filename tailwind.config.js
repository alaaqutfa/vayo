import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import flowbitePlugin from "flowbite/plugin";

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "class",
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Aleo", ...defaultTheme.fontFamily.sans],
                arabic: ["Tajawal", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: "#012119",
                secondary: "#33FF99",
                "gray-custom": "#DBDBDB",
                accent: "#0033FF",
            },
        },
    },
    plugins: [
        forms,
        flowbitePlugin,
        function ({ addBase, theme }) {
            addBase({
                // متغيرات CSS لاستخدامها في أي مكان
                ":root": {
                    "--color-primary": theme("colors.primary"),
                    "--color-primary-rgb": "1, 33, 25",
                },
                // تجاوز كلاسات التركيز لجميع عناصر الإدخال
                "input:focus, textarea:focus, select:focus, [type='text']:focus, [type='email']:focus, [type='url']:focus, [type='password']:focus, [type='number']:focus, [type='date']:focus, [type='datetime-local']:focus, [type='month']:focus, [type='search']:focus, [type='tel']:focus, [type='time']:focus, [type='week']:focus, [multiple]:focus":
                    {
                        "--tw-ring-color": theme("colors.primary"),
                        "border-color": theme("colors.primary"),
                    },
                // تجاوز أزرار Flowbite
                ".bg-blue-500, .bg-blue-600, .hover\\:bg-blue-500:hover, .hover\\:bg-blue-600:hover, .bg-blue-700, .hover\\:bg-blue-700:hover":
                    {
                        "background-color": theme("colors.primary") + " !important",
                    },
                ".text-blue-500, .text-blue-600, .hover\\:text-blue-500:hover, .hover\\:text-blue-600:hover":
                    {
                        color: theme("colors.primary") + " !important",
                    },
                ".border-blue-500, .border-blue-600, .focus\\:border-blue-500:focus":
                    {
                        "border-color": theme("colors.primary") + " !important",
                    },
                ".ring-blue-500, .ring-blue-600, .focus\\:ring-blue-500:focus":
                    {
                        "--tw-ring-color": theme("colors.primary") + " !important",
                    },
                // أزرار Flowbite الرئيسية
                ".btn-primary, .bg-primary-600, .hover\\:bg-primary-600:hover":
                    {
                        "background-color": theme("colors.primary"),
                    },
            });
        },
    ],
};
