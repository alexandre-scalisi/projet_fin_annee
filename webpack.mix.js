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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/form.js', 'public/js')
    .js('resources/js/form-livewire.js', 'public/js')
    .sass('resources/scss/app.scss', 'public/sass')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ])
    .copy('node_modules/font-awesome/css/font-awesome.min.css', 'public/css')
    .copy('node_modules/font-awesome/fonts/*', 'public/fonts')
    .options({
        postCss: [require('tailwindcss')]
    })
    

if (mix.inProduction()) {
    mix.version();
} 
