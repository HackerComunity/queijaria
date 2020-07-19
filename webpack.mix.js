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

mix
    .styles([
        "resources/views/assets/css/style.css"
    ], 'public/assets/css/style.css')

    .styles([
        "resources/views/assets/css/style-panel.css"
    ], 'public/assets/css/style-dash.css')

    .scripts([
        "resources/views/assets/js/script.js"
    ], 'public/assets/js/script.js')

    .copyDirectory('resources/views/assets/images', 'public/assets/images')
    .copyDirectory('resources/views/assets/DataTables', 'public/assets/DataTables')

    .options({
        processCssUrls: false
    })
    .version();
