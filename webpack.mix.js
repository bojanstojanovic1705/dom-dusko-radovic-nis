const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/style.scss', 'public/css')
    .sass('resources/sass/admin.scss', 'public/css/admin')
    .sourceMaps();

if (mix.inProduction()) {
    mix.version();
}
