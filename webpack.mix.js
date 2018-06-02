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

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');
mix.js('resources/assets/js/blog.js', 'public/js')
    .sass('resources/assets/sass/blog/blog.scss', 'public/css');

mix.scripts([
    'node_modules/toastr/build/toastr.min.js',
    'node_modules/select2/dist/js/select2.js',
    'resources/assets/js/bootstrap-datetimepicker.min.js'
], 'public/js/vendor.js');

mix.scripts(['resources/assets/js/summer-note.js'], 'public/js/summer-note.js');
mix.styles(['resources/assets/css/summer-note.css'], 'public/css/summer-note.css');
mix.styles(['resources/assets/sass/blog/navbar-black.scss'], 'public/css/navbar-black.css');
mix.styles([
    'node_modules/toastr/build/toastr.min.css',
    'resources/assets/css/bootstrap-datetimepicker.min.css'
], 'public/css/vendor.css');