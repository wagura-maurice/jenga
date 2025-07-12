const mix = require('laravel-mix');
const path = require('path');

// Disable success notifications
mix.disableSuccessNotifications();

// Configure Vue
mix.vue()
   .js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .sourceMaps()
   .version();

// Webpack config
mix.webpackConfig({
    stats: {
        children: true,
    },
    resolve: {
        extensions: ['.js', '.vue', '.json'],
        alias: {
            '@': path.resolve('resources/js'),
            'vue$': 'vue/dist/vue.esm.js'
        }
    }
});

// Disable notifications
mix.disableSuccessNotifications();
