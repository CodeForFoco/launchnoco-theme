var elixir = require('laravel-elixir');
elixir.config.assetsPath = 'assets/';
elixir.config.publicPath = 'assets/';
elixir(function(mix) {
    mix.sass('theme.scss', 'style.css')
        .scripts(['assets/js/inc/', 'main.js' ], 'assets/js/app.js')
        .copy('node_modules/font-awesome/fonts', 'assets/fonts');
});