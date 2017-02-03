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
	.when('/user/:id', {
		templateUrl: 'partials/user.html',
		controller: 'userController'
	})
	.when('/contact', {
		templateUrl: 'partials/contact.html',
		controller: 'contactController'
	})
	.otherwise({
		redirectTo: '/'
	});
});

myApp.filter('captalize', function(){
	return function(input) {
		if (!!input) {
			var firstLetter = input[0].toUpperCase();
			var restOfTheLetters = input.substr(1).toLowerCase();
			return firstLetter + restOfTheLetters;
		} else {
			return null;
		}
	};
});

myApp.controller('homeController', function($scope, $http) {

	$scope.ime = "";

	$http.get('data/users.json').success(function(data){
		$scope.users = $scope.shuffleArray(data);
	});

	$scope.showMessage = function() {
		var ime = $scope.getName();
		alert("Hello " + ime + '!');
	};

	$scope.getName = function() {
		return $scope.ime;
	};

	$scope.shuffleArray = function (array) {
	    for (var i = array.length - 1; i > 0; i--) {
	        var j = Math.floor(Math.random() * (i + 1));
	        var temp = array[i];
	        array[i] = array[j];
	        array[j] = temp;
	    }
	    return array;
	};

});

myApp.controller('contactController', function($scope) {
	$scope.x = 5;
});

myApp.controller('userController', function($scope, $http, $routeParams){
	$scope.user = {};

	$http.get('data/users.json').success(function(data){
		angular.forEach(data, function(value, key){
			if (value.id == $routeParams.id) {
				$scope.user = value;
			}
		});

	});
});