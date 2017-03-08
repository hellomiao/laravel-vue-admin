const { mix } = require('laravel-mix');

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

mix.js('resources/assets/js/admin.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css').combine([
    'node_modules/bootstrap3/dist/css/bootstrap.min.css',
    'node_modules/admin-lte/dist/css/AdminLTE.min.css',
    'node_modules/admin-lte/dist/css/skins/_all-skins.min.css',
    'node_modules/font-awesome/css/font-awesome.min.css',
    'node_modules/ionicons/dist/css/ionicons.min.css',
    'node_modules/toastr/toastr.scss',
    'node_modules/sweetalert2/dist/sweetalert2.min.css'
], 'public/css/admin.css').combine([
        'resources/assets/js/binaryajax.js',
        'resources/assets/js/exif.js',
        'public/js/admin.js','resources/assets/js/style.js'],
    'public/js/admin/admin.js');


