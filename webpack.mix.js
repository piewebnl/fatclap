const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

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
  resolve: {
    alias: {
      '@': path.resolve(__dirname, 'resources/js')
    },
  },
});


mix.js('resources/js/app.js', 'public/js').sourceMaps();
mix.sass('resources/sass/app.scss', 'public/css')
  .options({
    processCssUrls: false,
    postCss: [tailwindcss('./tailwind.config.js')]
  })
  .browserSync({
    proxy: 'https://www.fatclap.test',
    files: [
      'public/css/app.css',
      'public/css/app.js'
    ]
  });
mix.version();
