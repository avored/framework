const { vue } = require('laravel-mix');
const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss')

// require('laravel-mix-alias')

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



 let publicPath = '../../../public'

if (mix.inProduction()) {
    publicPath = 'dist/'
}

mix.setPublicPath(publicPath)

mix.webpackConfig({
    module: {
        rules: [{
            test: /\.mjs$/i,
            resolve: { byDependency: { esm: { fullySpecified: false } } },
        }],
    },
})
// mix.alias({'@': 'resources/js'})

filePath = 'vendor/avored/'
// let filePath = ''

/******** AVORED ADMIN JS  **********/

mix.js('resources/js/avored.js', filePath + 'js/avored.js').vue({version: 2})
    // .extract(['vue', 'ant-design-vue'])

mix.js('resources/js/app.js', filePath + 'js/app.js').vue({version: 2})

/******** AVORED COPY IMAGES  **********/
mix.copyDirectory('resources/images', publicPath +  '/' + filePath + '/images')


/******** AVORED ADMIN CSS  **********/
mix.sass('resources/sass/app.scss', filePath + 'css/app.css')
    .options({
        processCssUrls: false,
        postCss: [ tailwindcss('tailwind.config.js') ],
    })
