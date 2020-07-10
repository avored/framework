const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss')
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


let url = process.env.APP_URL.replace(/(^\w+:|^)\/\//, '');
mix.options({
   hmrOptions: {
       host: url,
       port: 8082 // Can't use 443 here because address already in use
   }
});

let publicPath = '../../public'

mix.setPublicPath(publicPath)


/******** AVORED ADMIN JS  **********/
mix.js('resources/js/app.js', 'vendor/avored/js/app.js')
mix.copyDirectory('resources/images', '../../public/vendor/avored/images');
/******** AVORED ADMIN CSS  **********/
mix.less('resources/less/app.less', 'vendor/avored/css/app.css', {
    lessOptions: {
        javascriptEnabled: true,
        modifyVars: {
            'primary-color': '#E64448',
            'link-color': '#C12E32',
            'border-radius-base': '5px',
        },
    }
}).options({
    processCssUrls: false,
    postCss: [ tailwindcss('tailwind.config.js') ],
})
