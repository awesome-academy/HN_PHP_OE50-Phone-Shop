const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/scriptchart.js', 'public/js')
    .js('node_modules/chart.js/dist/chart.js', 'public/js')
    .js('resources/js/notification.js', 'public/js')
    .js('resources/js/trans.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();
