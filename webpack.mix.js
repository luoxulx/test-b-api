const mix = require('laravel-mix');
const BundleAnalyzerPlugin = require('webpack-bundle-analyzer').BundleAnalyzerPlugin;

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
mix.webpackConfig({
  plugins: [
    new BundleAnalyzerPlugin(),
  ]
}).js('resources/js/default.js', 'public/js')
  .sass('resources/sass/default.scss', 'public/css')
  .js('resources/js/b.js', 'public/js')
  .sass('resources/sass/b.scss', 'public/css');
