var myApp = angular.module('myApp', ['ngRoute']);
myApp.config(['$routeProvider', '$interpolateProvider', function($routeProvider, $interpolateProvider){
	$interpolateProvider.startSymbol('{[');
	$interpolateProvider.endSymbol(']}');
}]);
