const mix = require("laravel-mix");

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

mix.js("resources/js/app.js", "public/js")
    .js("resources/js/pages/users.js", "public/js/pages/users.js")
    .js("resources/js/pages/salesOrders.js", "public/js/pages/salesOrders.js")
    .js("resources/js/pages/tasks.js", "public/js/pages/tasks.js")
    .js("resources/js/pages/compensations.js", "public/js/pages/compensations.js")
    .js("resources/js/vendor/app.js", "public/js/vendor/app.js")
    .js("resources/js/widgets/searchBar.js", "public/js/widgets/searchBar.js")
    .sass("resources/sass/vendor/app.sass", "public/css/vendor/app.css")
    .sass("resources/sass/app.scss", "public/css")
    .options({
        hmrOptions: {
            host: 'sbz_crm.test',
            port: 3000
        }
    });

