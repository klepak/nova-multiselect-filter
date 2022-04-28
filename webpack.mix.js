let mix = require('laravel-mix')

require('./nova.mix')

mix
  .setPublicPath('dist')
  .js('resources/js/filter.js', 'js')
  .vue({ version: 3 })
  .nova('klepak/nova-multiselect-filter')
