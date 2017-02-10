var myApp = angular.module('myApp', ['ngRoute']);



myApp.config(function ($routeProvider){
	$routeProvider
	.when('/', {
		templateUrl: 'partials/home.html',
		controller: 'homeController'
	})
	.when('/home', {
		redirectTo: '/'
	})
	.when('/category/:category_name', {
		templateUrl: 'partials/category.html',
		controller: 'categoryController'
	})
	.when('/cart', {
		templateUrl: 'partials/cart.html',
		controller: 'cartController'
	})
	.otherwise({
		redirectTo: '/'
	});
});




myApp.controller('homeController', function($scope, $http) {

	$scope.ime = "Hello World";

});

myApp.controller('categoryController', function($scope, $http, $routeParams) {
	$scope.ime = "SUPA";


	console.log($routeParams.category_name);

});

myApp.controller('cartController', function($scope, $http) {
	$scope.ime = "CART";
});
