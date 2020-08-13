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


let publicPath = '../../public'

mix.setPublicPath(publicPath)



mix.alias({'@': 'resources/js'})


/******** AVORED ADMIN JS  **********/
mix.js('resources/js/avored.js', 'vendor/avored/js/avored.js')
    // .extract(['vue', 'ant-design-vue'])

mix.js('resources/js/app.js', 'vendor/avored/js/app.js')

/******** AVORED COPY IMAGES  **********/
mix.copyDirectory('resources/images', publicPath + '/vendor/avored/images')


/******** AVORED ADMIN CSS  **********/
mix.sass('resources/sass/app.scss', 'vendor/avored/css/app.css')
    .options({
        processCssUrls: false,
        postCss: [ tailwindcss('tailwind.config.js') ],
    })
