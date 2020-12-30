const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js').postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
])

    .sass('resources/sass/admin/admin.scss', 'public/css')

    .scripts([
        'node_modules/@tabler/core/src/js/autosize.js',
        'node_modules/@tabler/core/src/js/dropdown.js',
        'node_modules/@tabler/core/src/js/input-mask.js',
        'node_modules/@tabler/core/src/js/tabler.js',
    ], 'public/js/admin.js')

    .version();
