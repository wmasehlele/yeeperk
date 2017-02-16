var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

//compile sass
elixir(function(mix) {
    mix.sass([
    	'bootstrap.scss'], 
    	'public/css/bootstrap/bootstrap.css'
    );
});
//mix all the css files
elixir(function(mix) {
    mix.styles([
    	'app-main.css',
    	'app-login.css'], 
    	'public/css/app-main-all.css'
    );
});
//mix all the JS files
elixir(function(mix) {
    mix.scripts([
    	'app-main.js',
    	'validator.js'], 
    	'public/js/app-main-all.js'
    );
});
//mix all the angular JS files
elixir(function(mix) {
    mix.scripts([
    	'angular-app/app.js',
    	'angular-app/app-service.js',
    	'angular-app/parent-controller.js',
    	'angular-app/webcontact/web-contact-controller.js',
        'angular-app/account/membersarea-controller.js'],  
    	'public/js/angular-app-all.js'
    );
});
elixir(function(mix) {
    //copoy dependency libraries
    mix.copy([
    	'node_modules/bootstrap-sass/assets/javascripts/bootstrap.min.js',
    	'node_modules/angular/angular.min.js',
    	'node_modules/angular-route/angular-route.min.js',
    	'node_modules/jquery/dist/jquery.min.js',
    	'node_modules/jquery.easing/jquery.easing.min.js'], 
    	'public/plugins/'
    );
    //copy font awsome
    mix.copy([
    	'node_modules/font-awesome/*'], 
    	'public/font-awesome/'
    );    
});