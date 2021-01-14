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

    // Bootstrap css
    .sass('node_modules/bootstrap/scss/bootstrap.scss', 'public/css')

    // Tabler SCSS
    .sass('resources/sass/admin/admin.scss', 'public/css')

    // Tabler CSS
    .copy('node_modules/@tabler/core/dist/css/demo.css', 'public/css')
    .copy('node_modules/@tabler/core/dist/css/tabler-flags.min.css', 'public/css/tabler-flags.css')
    .copy('node_modules/@tabler/core/dist/css/tabler-payments.min.css', 'public/css/tabler-payments.css')

    // Tabler Fonts
    // .copy('node_modules/@tabler/icons/iconfont/fonts', 'public/fonts')
    .copy('node_modules/@tabler/icons/tabler-sprite.svg', 'public/fonts/tabler-sprite.svg')

    // Boostrap JS
    .scripts([
        'node_modules/bootstrap/dist/js/bootstrap.bundle.min.js'
    ], 'public/js/bootstrap.bundle.min.js')

    // Tabler JS
    .scripts([
        'node_modules/@tabler/core/dist/js/tabler.min.js',
    ], 'public/js/tabler.js')

    .sass('node_modules/font-awesome/scss/font-awesome.scss', 'public/css')

    .js('resources/js/admin.js', 'public/js')
    .copy('node_modules/jquery/dist/jquery.min.js', 'public/js/jquery.min.js')

    .copy('node_modules/select2/dist/js/select2.min.js', 'public/js/select2.min.js')
    .copy('node_modules/select2/dist/css/select2.min.css', 'public/css/select2.min.css')

    .copy('node_modules/@ttskch/select2-bootstrap4-theme/dist/select2-bootstrap4.min.css', 'public/css/select2-bootstrap4.min.css')
    .version();
