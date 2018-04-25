let mix = require('laravel-mix');

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

mix.sass('resources/assets/bootstrap/bootstrap.scss', 'public/assets/lib/bootstrap/css/bootstrap.css')
    .sass('resources/assets/app/main.scss', 'public/assets/css').options({
    processCssUrls: false
});;
