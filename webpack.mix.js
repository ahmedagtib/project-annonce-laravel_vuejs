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

mix.js('resources/js_admin/app.js', 'public/js_admin')
   .sass('resources/sass_admin/app.scss', 'public/css_admin');

mix.js('resources/js_user/app.js', 'public/js_user')
   .sass('resources/sass_user/app.scss', 'public/css_user'); 




     
