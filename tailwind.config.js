import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                // Menggunakan font sans-serif yang lebih modern dan tegas
                sans: ['Inter', 'Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Palet warna Konstruksi Profesional
                'construction-yellow': '#FACC15', // Kuning Safety
                'construction-black': '#0F172A',  // Hitam Slate sangat gelap
                'construction-gray': '#F8FAFC',   // Latar belakang putih abu-abu
            },
        },
    },

    plugins: [forms],
};