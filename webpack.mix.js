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

mix.sass('resources/sass/backoffice/style.scss', 'public/css/backoffice/style.css', {
    outputStyle: 'compressed'
})


mix.scripts([
    'resources/js/backoffice/scripts.js',
], 'public/js/backoffice/scripts.js');
