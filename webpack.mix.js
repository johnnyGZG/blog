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

mix.copyDirectory('node_modules/bootstrap/dist','public/adminLTE/bootstrap')
    .copyDirectory('node_modules/bootstrap-data-table','public/adminLTE/plugins/bootstrap-data-table')
    .copyDirectory('node_modules/bootstrap-datepicker','public/adminLTE/plugins/bootstrap-datepicker')
    .copyDirectory('node_modules/select2','public/adminLTE/plugins/select2');

mix.copy('node_modules/jquery/dist/jquery.min.js','public/js');

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');
