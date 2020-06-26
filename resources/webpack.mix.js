let mix = require('laravel-mix');

mix.setPublicPath('../');

// mix.js('form_file', 'to_dir');

mix.js('js/scroll-top.js', '../publics/vue/scroll-top.js');
mix.js('js/recommend.js', '../publics/vue/recommend.js');
mix.js('js/shop-item.js', '../publics/vue/shop-item.js');
mix.js('js/shop-cart.js', '../publics/vue/shop-cart.js');