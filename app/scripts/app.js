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
	.when('/category/:category_name/', {
		templateUrl: 'partials/category.html',
		controller: 'categoryController'
	})
	.when('/category/:category_name/:id', {
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


myApp.controller('headerController', function($scope, $http) {
	$http.get('partials/categories.json')
	.success(function(data) {
		$scope.categories = data;
	});
});


myApp.controller('homeController', function($scope, $http) {

	$http.get('partials/categories.json')
	.success(function(data) {
		$scope.categories = data;
	});

});

myApp.controller('categoryController', function($scope, $http, $routeParams) {
	$http.get('partials/data.json')
	.success(function(data) {
		$scope.dishes = data[$routeParams.category_name];

		if (!$routeParams.id) {
			window.location.href = '#/category/' + $routeParams.category_name + "/" + $scope.dishes[0].id;
		} else {
			$scope.current = $scope.findInDishes($routeParams.id);
		}

	});

	$scope.findInDishes = function(id) {
		var marko = null;
		$scope.dishes.forEach(function(dish, key) {
			if (dish.id == id) {
				marko = dish;
			}
		});
		return marko;
	}




});

myApp.controller('cartController', function($scope, $http) {
	$scope.ime = "CART";
});
