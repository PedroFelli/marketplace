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
    .sass('resources/sass/app.scss', 'public/css');

mix.copy('resources/js/pagseguro_functions.js', 'public/js')
    .copy('public/vendor/jquery/jquery-3.2.1.min.js', 'public/js')
    .copy('public/vendor/animsition/js/animsition.min.js', 'public/js')
    .copy('public/vendor/bootstrap/js/popper.js', 'public/js')
    .copy('public/vendor/bootstrap/js/bootstrap.min.js', 'public/js')
    .copy('public/vendor/select2/select2.min.js', 'public/js')
    .copy('public/vendor/daterangepicker/moment.min.js', 'public/js')
    .copy('public/vendor/daterangepicker/daterangepicker.js', 'public/js')
    .copy('public/vendor/slick/slick.min.js', 'public/js')
    .copy('public/vendor/parallax100/parallax100.js', 'public/js')
    .copy('public/vendor/MagnificPopup/jquery.magnific-popup.min.js', 'public/js')
    .copy('public/vendor/isotope/isotope.pkgd.min.js', 'public/js')
    .copy('public/vendor/sweetalert/sweetalert.min.js', 'public/js')
    .copy('public/vendor/perfect-scrollbar/perfect-scrollbar.min.js', 'public/js')
    .copy('resources/js/pagseguro_events.js', 'public/js');

