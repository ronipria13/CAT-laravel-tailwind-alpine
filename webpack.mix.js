const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
.js('resources/js/sweetalert2.js', 'public/js')
.js('resources/js/leaflet.js', 'public/js').sourceMaps()
.js('resources/js/tom-select.complete.js', 'public/js')
.sass('resources/sass/app.scss', 'public/css')
.css('resources/css/tom-select.default.css', 'public/css').sourceMaps()
.sass('resources/sass/leaflet.scss', 'public/css')
.postCss('resources/css/app.css', 'public/css', [
    require("tailwindcss"),
]);
