const { mix } = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
    .js('resources/assets/js/main.js', 'public/js')
    .js('resources/assets/js/edit.js', 'public/js')
    .js('resources/assets/js/outcome_add.js', 'public/js')
    .js('resources/assets/js/income_add.js', 'public/js')
    .js('resources/assets/js/income_edit.js', 'public/js')
    .js('resources/assets/js/transfer.js', 'public/js')
    .js('resources/assets/js/transfer_edit.js', 'public/js')
    .js('resources/assets/js/debt.js', 'public/js')
    .js('resources/assets/js/debt_edit.js', 'public/js')
    .js('resources/assets/js/category_edit.js', 'public/js')
    .js('resources/assets/js/subcategory_edit.js', 'public/js')
    .js('resources/assets/js/outcome_edit.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .sass('resources/assets/sass/transfer.scss', 'public/css')
    .sass('resources/assets/sass/transfer_edit.scss', 'public/css')
    .sass('resources/assets/sass/debts.scss', 'public/css')
    .sass('resources/assets/sass/debt_edit.scss', 'public/css')
    .sass('resources/assets/sass/category_edit.scss', 'public/css')
    .sass('resources/assets/sass/subcategory_edit.scss', 'public/css')
    .sass('resources/assets/sass/outcomes.scss', 'public/css')
    .sass('resources/assets/sass/outcomes_edit.scss', 'public/css')
    .sass('resources/assets/sass/income_edit.scss', 'public/css')
    .sass('resources/assets/sass/style.scss', 'public/css');
