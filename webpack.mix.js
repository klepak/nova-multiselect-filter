const mix = require('laravel-mix');

mix
    .setPublicPath('dist')
    .js('resources/js/filter.js', 'js')
    .version();

if (mix.inProduction()) {
    mix.sourceMaps();
}
