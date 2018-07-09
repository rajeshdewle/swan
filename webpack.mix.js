let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 */

mix.js('resources/js/theme.js', 'assets/js/')
    .sass('resources/scss/theme.scss', 'assets/css/')
    .sass('resources/scss/woocommerce.scss', 'assets/css/'); // Optional
