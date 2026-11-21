const mix = require('laravel-mix');

mix
    .setPublicPath('dist')
    .js('resources/js/filter.js', 'js')
    .vue({ version: 3 })
    .version();

if (mix.inProduction()) {
    mix.sourceMaps();
}
