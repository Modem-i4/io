const mix = require('laravel-mix');

require('laravel-mix-bundle-analyzer');
require('vuetifyjs-mix-extension');

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .vuetify('vuetify-loader');

if (mix.inProduction()) {
    mix.bundleAnalyzer();
}
