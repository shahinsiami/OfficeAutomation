const mix = require('laravel-mix');

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
//
module: {
    rules: [
        {
            test: /\.m?js$/,
            exclude: /(node_modules|bower_components)/,
            use: {
                loader: 'babel-loader',
                options: {
                    presets: ['@babel/preset-env']
                }
            }
        }
    ]
}
mix
    //automation
    .js('resources/assets/js/automation/automation.js', 'public/js/automation/')//adminpanel
    //automation
    //panel
    // .js('resources/assets/js/panel/panel.js', 'public/js/panel/')//adminpanel
    .sass('resources/assets/css/panel/panel.scss', 'public/css/panel/').options({globalVueStyles: 'resources/assets/css/general/variables.scss'})//panel
    //panel
 

//bootstrap
;
