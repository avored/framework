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

let publicPath = '../../../public'

if (mix.inProduction()) {
    publicPath = 'dist/'
}
mix.setPublicPath(publicPath)

filePath = 'vendor/avored/'


/******** AVORED COPY IMAGES  **********/
mix.copyDirectory('resources/images', publicPath + '/' + filePath + '/images')


mix.js('resources/js/app.js', filePath + 'js/app.js')
    .postCss('resources/css/app.css', filePath + 'css/app.css', [
        require("tailwindcss"),
    ]);