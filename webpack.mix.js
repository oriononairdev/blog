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

mix
    .js('resources/js/app.js', 'public/js')
    .js('resources/js/blog/xterm.js', 'public/js/blog')
    .js('resources/js/blog/admin/text-editor.js', 'public/js/blog/admin')
    .postCss('resources/css/blog/app.css', 'public/css/blog', [require("tailwindcss")()])
    .postCss('resources/css/blog/admin/admin.css', 'public/css/blog', [require("tailwindcss")()])
    .postCss('resources/css/global.css', 'public/css/blog', [require("tailwindcss")()])
    .postCss('resources/css/blog/vendor/xterm.css', 'public/css/blog')
    .postCss('resources/css/blog/admin/vendor/easymde.css', 'public/css/blog/admin')
    .version();
