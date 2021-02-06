const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss')

require('laravel-mix-alias')

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


 let appUrl = process.env.APP_URL

 
 if (typeof appUrl !== 'undefinded') {
    let url = appUrl.replace(/(^\w+:|^)\/\//, '');
    mix.options({
        hmrOptions: {
            host: url,
            port: 8082
        }
    })
 }

 let publicPath = '../../../public'

if (mix.inProduction()) {
    publicPath = 'dist/'
}

mix.setPublicPath(publicPath)



mix.alias({'@': 'resources/js'})

filePath = 'vendor/avored/'
// let filePath = ''

/******** AVORED ADMIN JS  **********/

mix.js('resources/js/avored.js', filePath + 'js/avored.js')
    // .extract(['vue', 'ant-design-vue'])

mix.js('resources/js/app.js', filePath + 'js/app.js')

/******** AVORED COPY IMAGES  **********/
mix.copyDirectory('resources/images', publicPath +  '/' + filePath + '/images')


/******** AVORED ADMIN CSS  **********/
mix.sass('resources/sass/app.scss', filePath + 'css/app.css')
    .options({
        processCssUrls: false,
        postCss: [ tailwindcss('tailwind.config.js') ],
    })
